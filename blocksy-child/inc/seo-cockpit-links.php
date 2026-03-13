<?php
/**
 * SEO Cockpit internal link graph helpers.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return linkable public post types for the internal graph.
 *
 * @return array<int, string>
 */
function nexus_get_seo_cockpit_linkable_post_types() {
	$types = get_post_types(
		[
			'public' => true,
		],
		'objects'
	);

	$allowed = [];

	foreach ( (array) $types as $type => $object ) {
		if ( ! ( $object instanceof WP_Post_Type ) ) {
			continue;
		}

		if ( in_array( $type, [ 'attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset' ], true ) ) {
			continue;
		}

		$allowed[] = (string) $type;
	}

	return array_values( array_unique( $allowed ) );
}

/**
 * Normalize one internal link target for graph usage.
 *
 * Query strings are stripped so tracking parameters do not fragment counts.
 *
 * @param string $url Raw link target.
 * @return string
 */
function nexus_normalize_seo_cockpit_internal_link_target( $url ) {
	$normalized = nexus_normalize_seo_cockpit_url( $url );

	if ( '' === $normalized ) {
		return '';
	}

	$parts = wp_parse_url( $normalized );
	if ( ! is_array( $parts ) ) {
		return '';
	}

	$scheme = strtolower( (string) ( $parts['scheme'] ?? 'https' ) );
	$host   = strtolower( (string) ( $parts['host'] ?? '' ) );
	$path   = isset( $parts['path'] ) ? '/' . ltrim( (string) $parts['path'], '/' ) : '/';

	if ( '' === $host ) {
		return '';
	}

	if ( '/' !== $path ) {
		$path = trailingslashit( $path );
	}

	return $scheme . '://' . $host . $path;
}

/**
 * Extract internal links from one post content blob.
 *
 * @param string $content Post content.
 * @return array<int, string>
 */
function nexus_get_seo_cockpit_internal_links_from_content( $content ) {
	$content = (string) $content;

	if ( '' === trim( $content ) ) {
		return [];
	}

	preg_match_all( '/<a\s[^>]*href=(["\'])(.*?)\1/i', $content, $matches );

	if ( empty( $matches[2] ) || ! is_array( $matches[2] ) ) {
		return [];
	}

	$home_host = strtolower( (string) wp_parse_url( home_url( '/' ), PHP_URL_HOST ) );
	$links     = [];

	foreach ( $matches[2] as $href ) {
		$href = trim( html_entity_decode( (string) $href, ENT_QUOTES, 'UTF-8' ) );

		if ( '' === $href || '#' === $href || 0 === strpos( $href, '#' ) ) {
			continue;
		}

		if ( preg_match( '#^(mailto:|tel:|javascript:)#i', $href ) ) {
			continue;
		}

		$target = nexus_normalize_seo_cockpit_internal_link_target( $href );
		if ( '' === $target ) {
			continue;
		}

		$target_host = strtolower( (string) wp_parse_url( $target, PHP_URL_HOST ) );
		if ( '' === $target_host || $target_host !== $home_host ) {
			continue;
		}

		$links[] = $target;
	}

	return $links;
}

/**
 * Return the cached internal link graph.
 *
 * Counts are based on published public post content only. Global navigation,
 * widgets and theme-injected links are intentionally excluded for now.
 *
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_internal_link_graph() {
	$cache_key = nexus_get_seo_cockpit_cache_key( 'link_graph', [ home_url( '/' ) ] );
	$cached    = get_transient( $cache_key );

	if ( is_array( $cached ) ) {
		return $cached;
	}

	$post_ids = get_posts(
		[
			'post_type'              => nexus_get_seo_cockpit_linkable_post_types(),
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'fields'                 => 'ids',
			'orderby'                => 'ID',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		]
	);

	$nodes = [];

	foreach ( (array) $post_ids as $post_id ) {
		$post_id    = absint( $post_id );
		$source_url = nexus_normalize_seo_cockpit_internal_link_target( get_permalink( $post_id ) );

		if ( '' === $source_url ) {
			continue;
		}

		if ( ! isset( $nodes[ $source_url ] ) ) {
			$nodes[ $source_url ] = [
				'url'              => $source_url,
				'incoming_links'   => 0,
				'incoming_sources' => [],
				'outgoing_links'   => 0,
				'outgoing_targets' => [],
			];
		}

		$links = nexus_get_seo_cockpit_internal_links_from_content( (string) get_post_field( 'post_content', $post_id ) );

		foreach ( $links as $target_url ) {
			if ( $source_url === $target_url ) {
				continue;
			}

			if ( ! isset( $nodes[ $target_url ] ) ) {
				$nodes[ $target_url ] = [
					'url'              => $target_url,
					'incoming_links'   => 0,
					'incoming_sources' => [],
					'outgoing_links'   => 0,
					'outgoing_targets' => [],
				];
			}

			$nodes[ $source_url ]['outgoing_links']++;
			$nodes[ $source_url ]['outgoing_targets'][ $target_url ] = isset( $nodes[ $source_url ]['outgoing_targets'][ $target_url ] )
				? $nodes[ $source_url ]['outgoing_targets'][ $target_url ] + 1
				: 1;

			$nodes[ $target_url ]['incoming_links']++;
			$nodes[ $target_url ]['incoming_sources'][ $source_url ] = isset( $nodes[ $target_url ]['incoming_sources'][ $source_url ] )
				? $nodes[ $target_url ]['incoming_sources'][ $source_url ] + 1
				: 1;
		}
	}

	foreach ( $nodes as $url => $node ) {
		$incoming_sources = (array) $node['incoming_sources'];
		$outgoing_targets = (array) $node['outgoing_targets'];

		arsort( $incoming_sources );
		arsort( $outgoing_targets );

		$nodes[ $url ] = [
			'url'                   => $url,
			'incoming_links'        => (int) $node['incoming_links'],
			'incoming_documents'    => count( $incoming_sources ),
			'outgoing_links'        => (int) $node['outgoing_links'],
			'outgoing_unique_urls'  => count( $outgoing_targets ),
			'top_sources'           => array_map(
				static function ( $source_url, $count ) {
					return [
						'url'   => (string) $source_url,
						'count' => (int) $count,
					];
				},
				array_keys( array_slice( $incoming_sources, 0, 5, true ) ),
				array_values( array_slice( $incoming_sources, 0, 5, true ) )
			),
			'top_targets'           => array_map(
				static function ( $target_url, $count ) {
					return [
						'url'   => (string) $target_url,
						'count' => (int) $count,
					];
				},
				array_keys( array_slice( $outgoing_targets, 0, 5, true ) ),
				array_values( array_slice( $outgoing_targets, 0, 5, true ) )
			),
		];
	}

	$graph = [
		'built_at'   => current_time( 'timestamp' ),
		'post_count' => count( (array) $post_ids ),
		'nodes'      => $nodes,
		'note'       => 'Gezählt aus veröffentlichten öffentlichen Inhalten. Menüs, Footer und theme-injizierte Links sind noch nicht enthalten.',
	];

	set_transient( $cache_key, $graph, nexus_get_seo_cockpit_refresh_interval_seconds() );

	return $graph;
}

/**
 * Return one internal-link context payload for a URL.
 *
 * @param string $url Frontend URL.
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_internal_link_context( $url ) {
	$url   = nexus_normalize_seo_cockpit_internal_link_target( $url );
	$graph = nexus_get_seo_cockpit_internal_link_graph();
	$node  = isset( $graph['nodes'][ $url ] ) && is_array( $graph['nodes'][ $url ] ) ? $graph['nodes'][ $url ] : null;

	if ( ! is_array( $node ) ) {
		return [
			'status'              => 'measured',
			'incoming_links'      => 0,
			'incoming_documents'  => 0,
			'outgoing_links'      => 0,
			'outgoing_unique_urls' => 0,
			'top_sources'         => [],
			'top_targets'         => [],
			'note'                => (string) ( $graph['note'] ?? '' ),
		];
	}

	return [
		'status'               => 'measured',
		'incoming_links'       => (int) ( $node['incoming_links'] ?? 0 ),
		'incoming_documents'   => (int) ( $node['incoming_documents'] ?? 0 ),
		'outgoing_links'       => (int) ( $node['outgoing_links'] ?? 0 ),
		'outgoing_unique_urls' => (int) ( $node['outgoing_unique_urls'] ?? 0 ),
		'top_sources'          => isset( $node['top_sources'] ) && is_array( $node['top_sources'] ) ? $node['top_sources'] : [],
		'top_targets'          => isset( $node['top_targets'] ) && is_array( $node['top_targets'] ) ? $node['top_targets'] : [],
		'note'                 => (string) ( $graph['note'] ?? '' ),
	];
}
