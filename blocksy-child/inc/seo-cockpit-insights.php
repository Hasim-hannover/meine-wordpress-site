<?php
/**
 * SEO Cockpit insight rules, WordPress context and drilldown helpers.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return one Search Console row key by index.
 *
 * @param array<string, mixed> $row   Search Console row.
 * @param int                  $index Key index.
 * @return string
 */
function nexus_get_seo_cockpit_row_key( $row, $index = 0 ) {
	return isset( $row['keys'][ $index ] ) ? (string) $row['keys'][ $index ] : '';
}

/**
 * Return one table row cell value from a Search Console row.
 *
 * @param array<string, mixed> $row Search Console row.
 * @return string
 */
function nexus_get_seo_cockpit_row_label( $row ) {
	return nexus_get_seo_cockpit_row_key( $row, 0 );
}

/**
 * Resolve a cluster slug from one frontend URL if the path matches a cluster route.
 *
 * @param string $url Frontend URL.
 * @return string
 */
function nexus_get_seo_cockpit_cluster_slug_from_url( $url ) {
	$path = wp_parse_url( $url, PHP_URL_PATH );
	$slug = sanitize_title( basename( trim( (string) $path, '/' ) ) );

	if ( '' === $slug || ! function_exists( 'nexus_get_wgos_cluster_page' ) ) {
		return '';
	}

	return nexus_get_wgos_cluster_page( $slug ) ? $slug : '';
}

/**
 * Resolve one known legacy redirect target for a frontend URL.
 *
 * @param string $url Frontend URL.
 * @return string
 */
function nexus_get_seo_cockpit_redirect_target_for_url( $url ) {
	if ( ! function_exists( 'nexus_get_legacy_offer_redirect_map' ) ) {
		return '';
	}

	$path = wp_parse_url( $url, PHP_URL_PATH );
	$path = trailingslashit( '/' . ltrim( (string) $path, '/' ) );
	$map  = nexus_get_legacy_offer_redirect_map();

	if ( empty( $map[ $path ] ) ) {
		return '';
	}

	return (string) $map[ $path ];
}

/**
 * Return a default internal-link payload.
 *
 * @param string $status Status key.
 * @param string $note   Human note.
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_default_internal_links( $status = 'pending', $note = '' ) {
	return [
		'status'               => sanitize_key( (string) $status ),
		'incoming_links'       => 0,
		'incoming_documents'   => 0,
		'outgoing_links'       => 0,
		'outgoing_unique_urls' => 0,
		'top_sources'          => [],
		'top_targets'          => [],
		'context'              => [
			'incoming_links'       => 0,
			'incoming_documents'   => 0,
			'outgoing_links'       => 0,
			'outgoing_unique_urls' => 0,
			'top_sources'          => [],
			'top_targets'          => [],
		],
		'sitewide'             => [
			'incoming_links'       => 0,
			'incoming_sources'     => 0,
			'top_sources'          => [],
			'outgoing_links'       => 0,
			'outgoing_unique_urls' => 0,
			'top_targets'          => [],
			'shell'                => '',
			'shell_label'          => '',
			'sources'              => [],
		],
		'totals'               => [
			'incoming_links'       => 0,
			'incoming_sources'     => 0,
			'outgoing_links'       => 0,
			'outgoing_unique_urls' => 0,
		],
		'note'                 => '' !== $note ? $note : 'Interne Link-Zaehlung ist noch nicht verfuegbar.',
	];
}

/**
 * Resolve one frontend URL to a local WordPress object where possible.
 *
 * @param string $url Frontend URL.
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_wp_context_for_url( $url ) {
	static $cache = [];

	$url = nexus_normalize_seo_cockpit_url( $url );

	if ( isset( $cache[ $url ] ) ) {
		return $cache[ $url ];
	}

	$front_page_id = absint( get_option( 'page_on_front' ) );
	$posts_page_id = absint( get_option( 'page_for_posts' ) );
	$resolved_id   = url_to_postid( $url );
	$cluster_slug  = nexus_get_seo_cockpit_cluster_slug_from_url( $url );
	$redirect_url  = nexus_get_seo_cockpit_redirect_target_for_url( $url );

	if ( 0 === $resolved_id && home_url( '/' ) === $url ) {
		$resolved_id = $front_page_id;
	}

	if ( 0 === $resolved_id && $posts_page_id && nexus_normalize_seo_cockpit_url( get_permalink( $posts_page_id ) ) === $url ) {
		$resolved_id = $posts_page_id;
	}

	$context = [
		'resolved'               => false,
		'url'                    => $url,
		'post_id'                => 0,
		'post_title'             => '',
		'post_type'              => '',
		'post_status'            => '',
		'page_type'              => '',
		'template'               => '',
		'modified_at'            => 0,
		'seo_title'              => '',
		'seo_description'        => '',
		'seo_title_present'      => false,
		'seo_description_present' => false,
		'title_source'           => '',
		'description_source'     => '',
		'canonical'              => '',
		'canonical_present'      => false,
		'noindex'                => false,
		'in_sitemap'             => false,
		'word_count'             => 0,
		'internal_links'         => nexus_get_seo_cockpit_default_internal_links( 'pending', 'Interne Link-Zaehlung ist fuer eine spaetere Stufe vorbereitet.' ),
		'edit_link'              => '',
		'frontend_link'          => $url,
		'snippet_issues'         => [],
	];

	if ( '' !== $redirect_url ) {
		$context = [
			'resolved'                => true,
			'url'                     => $url,
			'post_id'                 => 0,
			'post_title'              => 'Legacy Redirect',
			'post_type'               => '',
			'post_status'             => 'redirect',
			'page_type'               => 'legacy_redirect',
			'template'                => '',
			'modified_at'             => 0,
			'seo_title'               => '',
			'seo_description'         => '',
			'seo_title_present'       => false,
			'seo_description_present' => false,
			'title_source'            => '',
			'description_source'      => '',
			'canonical'               => $redirect_url,
			'canonical_present'       => true,
			'noindex'                 => false,
			'in_sitemap'              => false,
			'word_count'              => 0,
			'internal_links'          => nexus_get_seo_cockpit_default_internal_links( 'n/a', 'Diese URL wird serverseitig auf ein kanonisches Ziel weitergeleitet.' ),
			'edit_link'               => '',
			'frontend_link'           => $redirect_url,
			'snippet_issues'          => [],
		];

		$cache[ $url ] = $context;

		return $context;
	}

	if ( $resolved_id ) {
		$post = get_post( $resolved_id );

		if ( $post instanceof WP_Post ) {
			if ( '' !== $cluster_slug && 'publish' !== (string) $post->post_status ) {
				$cluster_defaults = function_exists( 'nexus_get_wgos_cluster_page_seo_defaults' ) ? nexus_get_wgos_cluster_page_seo_defaults( $cluster_slug ) : null;
				$context          = [
					'resolved'                => true,
					'url'                     => $url,
					'post_id'                 => $resolved_id,
					'post_title'              => get_the_title( $resolved_id ),
					'post_type'               => (string) $post->post_type,
					'post_status'             => (string) $post->post_status,
					'page_type'               => 'virtual_cluster',
					'template'                => 'page-wgos-pillar.php',
					'modified_at'             => (int) get_post_modified_time( 'U', true, $resolved_id ),
					'seo_title'               => (string) ( $cluster_defaults['title'] ?? '' ),
					'seo_description'         => (string) ( $cluster_defaults['description'] ?? '' ),
					'seo_title_present'       => '' !== (string) ( $cluster_defaults['title'] ?? '' ),
					'seo_description_present' => '' !== (string) ( $cluster_defaults['description'] ?? '' ),
					'title_source'            => 'virtual_cluster',
					'description_source'      => 'virtual_cluster',
					'canonical'               => home_url( '/' . $cluster_slug . '/' ),
					'canonical_present'       => true,
					'noindex'                 => false,
					'in_sitemap'              => false,
					'word_count'              => nexus_get_seo_cockpit_post_word_count( $resolved_id ),
					'internal_links'          => nexus_get_seo_cockpit_default_internal_links( 'pending', 'Interne Link-Zaehlung ist fuer eine spaetere Stufe vorbereitet.' ),
					'edit_link'               => (string) get_edit_post_link( $resolved_id, 'raw' ),
					'frontend_link'           => home_url( '/' . $cluster_slug . '/' ),
					'snippet_issues'          => nexus_get_seo_cockpit_snippet_issues(
						[
							'title'       => (string) ( $cluster_defaults['title'] ?? '' ),
							'description' => (string) ( $cluster_defaults['description'] ?? '' ),
						]
					),
				];

				$cache[ $url ] = $context;

				return $context;
			}

			$seo_context = nexus_get_seo_cockpit_post_seo_context( $resolved_id );
			$template    = 'page' === $post->post_type ? ( get_page_template_slug( $resolved_id ) ?: 'default' ) : $post->post_type;
			$page_type   = $post->post_type;

			if ( $front_page_id === $resolved_id ) {
				$page_type = 'front_page';
			} elseif ( $posts_page_id === $resolved_id ) {
				$page_type = 'blog_index';
			}

			$context = [
				'resolved'                => true,
				'url'                     => $url,
				'post_id'                 => $resolved_id,
				'post_title'              => get_the_title( $resolved_id ),
				'post_type'               => (string) $post->post_type,
				'post_status'             => (string) $post->post_status,
				'page_type'               => $page_type,
				'template'                => (string) $template,
				'modified_at'             => (int) get_post_modified_time( 'U', true, $resolved_id ),
				'seo_title'               => (string) ( $seo_context['title'] ?? '' ),
				'seo_description'         => (string) ( $seo_context['description'] ?? '' ),
				'seo_title_present'       => '' !== (string) ( $seo_context['title'] ?? '' ),
				'seo_description_present' => '' !== (string) ( $seo_context['description'] ?? '' ),
				'title_source'            => (string) ( $seo_context['title_source'] ?? '' ),
				'description_source'      => (string) ( $seo_context['description_source'] ?? '' ),
				'canonical'               => (string) ( $seo_context['canonical'] ?? '' ),
				'canonical_present'       => '' !== (string) ( $seo_context['canonical'] ?? '' ),
				'noindex'                 => ! empty( $seo_context['noindex'] ),
				'in_sitemap'              => nexus_is_seo_cockpit_post_in_sitemap( $post, ! empty( $seo_context['noindex'] ) ),
				'word_count'              => nexus_get_seo_cockpit_post_word_count( $resolved_id ),
				'internal_links'          => nexus_get_seo_cockpit_default_internal_links( 'pending', 'Interne Link-Zaehlung ist fuer eine spaetere Stufe vorbereitet.' ),
				'edit_link'               => (string) get_edit_post_link( $resolved_id, 'raw' ),
				'frontend_link'           => (string) get_permalink( $resolved_id ),
				'snippet_issues'          => nexus_get_seo_cockpit_snippet_issues( $seo_context ),
			];
		}
	}

	if ( 0 === $resolved_id && '' !== $cluster_slug ) {
		$cluster_defaults = function_exists( 'nexus_get_wgos_cluster_page_seo_defaults' ) ? nexus_get_wgos_cluster_page_seo_defaults( $cluster_slug ) : null;
		$context          = [
			'resolved'                => true,
			'url'                     => $url,
			'post_id'                 => 0,
			'post_title'              => function_exists( 'nexus_get_wgos_cluster_page' ) && is_array( nexus_get_wgos_cluster_page( $cluster_slug ) ) ? (string) nexus_get_wgos_cluster_page( $cluster_slug )['title'] : '',
			'post_type'               => '',
			'post_status'             => 'virtual',
			'page_type'               => 'virtual_cluster',
			'template'                => 'page-wgos-pillar.php',
			'modified_at'             => 0,
			'seo_title'               => (string) ( $cluster_defaults['title'] ?? '' ),
			'seo_description'         => (string) ( $cluster_defaults['description'] ?? '' ),
			'seo_title_present'       => '' !== (string) ( $cluster_defaults['title'] ?? '' ),
			'seo_description_present' => '' !== (string) ( $cluster_defaults['description'] ?? '' ),
			'title_source'            => 'virtual_cluster',
			'description_source'      => 'virtual_cluster',
			'canonical'               => home_url( '/' . $cluster_slug . '/' ),
			'canonical_present'       => true,
			'noindex'                 => false,
			'in_sitemap'              => false,
			'word_count'              => 0,
			'internal_links'          => nexus_get_seo_cockpit_default_internal_links( 'pending', 'Interne Link-Zaehlung ist fuer eine spaetere Stufe vorbereitet.' ),
			'edit_link'               => '',
			'frontend_link'           => home_url( '/' . $cluster_slug . '/' ),
			'snippet_issues'          => nexus_get_seo_cockpit_snippet_issues(
				[
					'title'       => (string) ( $cluster_defaults['title'] ?? '' ),
					'description' => (string) ( $cluster_defaults['description'] ?? '' ),
				]
			),
		];
	}

	if ( function_exists( 'nexus_get_seo_cockpit_internal_link_context' ) ) {
		$context['internal_links'] = nexus_get_seo_cockpit_internal_link_context(
			(string) ( $context['frontend_link'] ?: $url ),
			$context
		);
	}

	$cache[ $url ] = $context;

	return $context;
}

/**
 * Build a WordPress context map for one page report.
 *
 * @param array<int, array<string, mixed>> $rows Page rows.
 * @return array<string, array<string, mixed>>
 */
function nexus_get_seo_cockpit_page_context_map( $rows ) {
	$urls = [];

	foreach ( (array) $rows as $row ) {
		$url = nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) );
		if ( '' !== $url ) {
			$urls[ $url ] = $url;
		}
	}

	$contexts = [];
	foreach ( $urls as $url ) {
		$contexts[ $url ] = nexus_get_seo_cockpit_wp_context_for_url( $url );
	}

	return $contexts;
}

/**
 * Return the effective SEO context for one post.
 *
 * @param int $post_id Post ID.
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_post_seo_context( $post_id ) {
	$post_id = absint( $post_id );

	if ( function_exists( 'hu_get_singular_post_seo_context' ) ) {
		$context = hu_get_singular_post_seo_context( $post_id );
		if ( is_array( $context ) ) {
			return $context;
		}
	}

	$post = get_post( $post_id );
	if ( ! ( $post instanceof WP_Post ) ) {
		return [];
	}

	$forced           = function_exists( 'hu_get_forced_singular_seo' ) ? hu_get_forced_singular_seo( $post_id ) : [];
	$cluster_defaults = function_exists( 'nexus_get_wgos_cluster_page_seo_defaults' ) ? nexus_get_wgos_cluster_page_seo_defaults( $post ) : null;
	$stored_title     = function_exists( 'hu_get_stored_seo_value' ) ? hu_get_stored_seo_value( $post_id, 'seo_title', 'rank_math_title' ) : '';
	$stored_desc      = function_exists( 'hu_get_stored_seo_value' ) ? hu_get_stored_seo_value( $post_id, 'seo_description', 'rank_math_description' ) : '';
	$title            = $stored_title;
	$description      = $stored_desc;
	$title_source     = '' !== $stored_title ? 'stored' : 'fallback';
	$desc_source      = '' !== $stored_desc ? 'stored' : 'fallback';

	if ( ! empty( $forced['title'] ) ) {
		$title        = (string) $forced['title'];
		$title_source = 'forced';
	} elseif ( '' === $title && 'post' === $post->post_type && function_exists( 'hu_get_post_title_pattern' ) ) {
		$title        = hu_get_post_title_pattern( $post_id );
		$title_source = 'post_pattern';
	} elseif ( '' === $title && is_array( $cluster_defaults ) && ! empty( $cluster_defaults['title'] ) ) {
		$title        = (string) $cluster_defaults['title'];
		$title_source = 'cluster_default';
	} elseif ( '' === $title ) {
		$title = get_the_title( $post_id );
	}

	if ( ! empty( $forced['description'] ) ) {
		$description = (string) $forced['description'];
		$desc_source = 'forced';
	} elseif ( '' === $description && is_array( $cluster_defaults ) && ! empty( $cluster_defaults['description'] ) ) {
		$description = (string) $cluster_defaults['description'];
		$desc_source = 'cluster_default';
	} elseif ( '' === $description ) {
		$excerpt     = get_post_field( 'post_excerpt', $post_id );
		$description = '' !== trim( $excerpt ) ? wp_trim_words( wp_strip_all_tags( $excerpt ), 25, '…' ) : '';
	}

	$acf_noindex       = function_exists( 'get_field' ) ? get_field( 'seo_noindex', $post_id ) : false;
	$rank_math_robots  = get_post_meta( $post_id, 'rank_math_robots', true );
	$rank_math_noindex = is_array( $rank_math_robots ) ? in_array( 'noindex', $rank_math_robots, true ) : 'noindex' === $rank_math_robots;
	$noindex           = (bool) ( $acf_noindex || $rank_math_noindex );

	return [
		'title'              => trim( wp_strip_all_tags( (string) $title ) ),
		'description'        => trim( wp_strip_all_tags( (string) $description ) ),
		'canonical'          => (string) get_permalink( $post_id ),
		'robots'             => $noindex ? 'noindex, nofollow' : 'index, follow',
		'noindex'            => $noindex,
		'title_source'       => $title_source,
		'description_source' => $desc_source,
	];
}

/**
 * Return estimated word count for one post.
 *
 * @param int $post_id Post ID.
 * @return int
 */
function nexus_get_seo_cockpit_post_word_count( $post_id ) {
	$content = (string) get_post_field( 'post_content', $post_id );
	$text    = wp_strip_all_tags( strip_shortcodes( $content ) );

	if ( '' === $text ) {
		return 0;
	}

	preg_match_all( '/[\p{L}\p{N}\']+/u', $text, $matches );

	return ! empty( $matches[0] ) ? count( $matches[0] ) : 0;
}

/**
 * Determine whether a post should be expected in the native sitemap layer.
 *
 * @param WP_Post $post    Post object.
 * @param bool    $noindex Whether the page is noindex.
 * @return bool
 */
function nexus_is_seo_cockpit_post_in_sitemap( $post, $noindex = false ) {
	if ( ! ( $post instanceof WP_Post ) ) {
		return false;
	}

	$type_object = get_post_type_object( $post->post_type );

	if ( 'publish' !== $post->post_status || ! $type_object || ! $type_object->public || $noindex ) {
		return false;
	}

	if ( function_exists( 'wp_sitemaps_get_server' ) ) {
		return true;
	}

	return false;
}

/**
 * Return snippet weakness flags for one SEO context.
 *
 * @param array<string, mixed> $seo_context SEO context.
 * @return array<int, string>
 */
function nexus_get_seo_cockpit_snippet_issues( $seo_context ) {
	$title       = trim( (string) ( $seo_context['title'] ?? '' ) );
	$description = trim( (string) ( $seo_context['description'] ?? '' ) );
	$issues      = [];

	$title_length = mb_strlen( $title );
	$desc_length  = mb_strlen( $description );

	if ( '' === $title ) {
		$issues[] = 'title_missing';
	} elseif ( $title_length < 35 ) {
		$issues[] = 'title_short';
	} elseif ( $title_length > 60 ) {
		$issues[] = 'title_long';
	}

	if ( '' === $description ) {
		$issues[] = 'description_missing';
	} elseif ( $desc_length < 90 ) {
		$issues[] = 'description_short';
	} elseif ( $desc_length > 160 ) {
		$issues[] = 'description_long';
	}

	return $issues;
}

/**
 * Return one sortable severity score.
 *
 * @param string $severity Severity label.
 * @return int
 */
function nexus_get_seo_cockpit_severity_score( $severity ) {
	$map = [
		'critical' => 400,
		'high'     => 300,
		'medium'   => 200,
		'low'      => 100,
	];

	return $map[ sanitize_key( (string) $severity ) ] ?? 0;
}

/**
 * Create a normalized insight payload.
 *
 * @param array<string, mixed> $insight Raw insight data.
 * @return array<string, mixed>
 */
function nexus_build_seo_cockpit_insight( $insight ) {
	return [
		'type'               => strtoupper( str_replace( '-', '_', sanitize_key( (string) ( $insight['type'] ?? 'unknown' ) ) ) ),
		'severity'           => sanitize_key( (string) ( $insight['severity'] ?? 'low' ) ),
		'label'              => trim( wp_strip_all_tags( (string) ( $insight['label'] ?? '' ) ) ),
		'reason'             => trim( wp_strip_all_tags( (string) ( $insight['reason'] ?? '' ) ) ),
		'url'                => nexus_normalize_seo_cockpit_url( (string) ( $insight['url'] ?? '' ) ),
		'query'              => trim( wp_strip_all_tags( (string) ( $insight['query'] ?? '' ) ) ),
		'metrics'            => is_array( $insight['metrics'] ?? null ) ? $insight['metrics'] : [],
		'recommended_action' => trim( wp_strip_all_tags( (string) ( $insight['recommended_action'] ?? '' ) ) ),
	];
}

/**
 * Build the full insight list for one snapshot.
 *
 * @param array<string, mixed> $snapshot Snapshot payload.
 * @return array<int, array<string, mixed>>
 */
function nexus_get_seo_cockpit_insights( $snapshot ) {
	$insights     = [];
	$overall_ctr  = (float) ( $snapshot['overview']['current']['ctr'] ?? 0 );
	$page_context = isset( $snapshot['page_contexts'] ) && is_array( $snapshot['page_contexts'] ) ? $snapshot['page_contexts'] : [];
	$seen         = [];

	foreach ( (array) ( $snapshot['query_page_rows'] ?? [] ) as $row ) {
		$url         = nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) );
		$query       = nexus_get_seo_cockpit_row_key( $row, 1 );
		$impressions = (float) ( $row['impressions'] ?? 0 );
		$ctr         = (float) ( $row['ctr'] ?? 0 );
		$position    = (float) ( $row['position'] ?? 0 );

		if ( '' === $url || '' === $query ) {
			continue;
		}

		if ( $position >= 8 && $position <= 20 && $impressions >= 25 ) {
			$insights[] = nexus_build_seo_cockpit_insight(
				[
					'type'               => 'QUICK_WIN',
					'severity'           => $position <= 12 && $impressions >= 80 ? 'high' : 'medium',
					'label'              => sprintf( 'Quick Win fuer "%s"', $query ),
					'reason'             => sprintf( 'Die URL rankt bereits auf Position %.1f bei %.0f Impressionen.', $position, $impressions ),
					'url'                => $url,
					'query'              => $query,
					'metrics'            => [
						'position'    => $position,
						'impressions' => $impressions,
						'ctr'         => $ctr,
					],
					'recommended_action' => 'Title, Description und interne Links dieser Seite zuerst nachschärfen.',
				]
			);
		}

		if ( $position <= 12 && $impressions >= 120 && $ctr < max( 0.01, $overall_ctr * 0.65 ) ) {
			$insights[] = nexus_build_seo_cockpit_insight(
				[
					'type'               => 'CTR_OPPORTUNITY',
					'severity'           => $impressions >= 300 ? 'high' : 'medium',
					'label'              => sprintf( 'CTR-Chance fuer "%s"', $query ),
					'reason'             => sprintf( 'Viele Impressionen (%.0f), aber nur %.1f%% CTR bei Position %.1f.', $impressions, $ctr * 100, $position ),
					'url'                => $url,
					'query'              => $query,
					'metrics'            => [
						'position'    => $position,
						'impressions' => $impressions,
						'ctr'         => $ctr,
						'baseline_ctr' => $overall_ctr,
					],
					'recommended_action' => 'Snippet gezielt auf Suchintention und Proof dieser Query ausrichten.',
				]
			);
		}

		if ( $position > 20 && $position <= 40 && $impressions >= 15 ) {
			$insights[] = nexus_build_seo_cockpit_insight(
				[
					'type'               => 'LOW_SIGNAL',
					'severity'           => $impressions >= 60 ? 'medium' : 'low',
					'label'              => sprintf( 'Schwaches Signal fuer "%s"', $query ),
					'reason'             => sprintf( 'Die URL erscheint bereits, liegt aber mit Position %.1f noch ausserhalb der Top 20.', $position ),
					'url'                => $url,
					'query'              => $query,
					'metrics'            => [
						'position'    => $position,
						'impressions' => $impressions,
					],
					'recommended_action' => 'Cluster-Links, Suchintention und Seitentiefe dieser URL schrittweise stärken.',
				]
			);
		}
	}

	$current_pages  = [];
	$previous_pages = [];

	foreach ( (array) ( $snapshot['current_page_rows'] ?? [] ) as $row ) {
		$current_pages[ nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) ) ] = $row;
	}

	foreach ( (array) ( $snapshot['previous_page_rows'] ?? [] ) as $row ) {
		$previous_pages[ nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) ) ] = $row;
	}

	foreach ( $current_pages as $url => $row ) {
		$current_clicks      = (float) ( $row['clicks'] ?? 0 );
		$current_impressions = (float) ( $row['impressions'] ?? 0 );
		$previous_row        = $previous_pages[ $url ] ?? [];
		$previous_clicks     = (float) ( $previous_row['clicks'] ?? 0 );
		$previous_impressions = (float) ( $previous_row['impressions'] ?? 0 );

		if ( ( $previous_clicks >= 5 && $current_clicks < ( $previous_clicks * 0.7 ) ) || ( $previous_impressions >= 50 && $current_impressions < ( $previous_impressions * 0.7 ) ) ) {
			$drop = $previous_clicks > 0 ? ( ( $current_clicks - $previous_clicks ) / $previous_clicks ) * 100 : 0;

			$insights[] = nexus_build_seo_cockpit_insight(
				[
					'type'               => 'DECAY',
					'severity'           => $drop <= -50 ? 'high' : 'medium',
					'label'              => 'Traffic-Rueckgang auf dieser URL',
					'reason'             => sprintf( 'Klicks oder Impressionen sind gegenueber dem Vergleichsfenster deutlich gefallen (%.1f%%).', $drop ),
					'url'                => $url,
					'query'              => '',
					'metrics'            => [
						'current_clicks'       => $current_clicks,
						'previous_clicks'      => $previous_clicks,
						'current_impressions'  => $current_impressions,
						'previous_impressions' => $previous_impressions,
					],
					'recommended_action' => 'Aendere diese Seite zuerst nicht blind. Pruefe Query-Verschiebungen, Snippet und interne Verlinkung.',
				]
			);
		}

		$context = $page_context[ $url ] ?? [];
		if ( ! empty( $context['snippet_issues'] ) && $current_impressions >= 30 ) {
			$insights[] = nexus_build_seo_cockpit_insight(
				[
					'type'               => 'SNIPPET_WEAKNESS',
					'severity'           => $current_impressions >= 120 ? 'high' : 'medium',
					'label'              => 'Snippet-Schwaeche auf dieser URL',
					'reason'             => sprintf( 'Die Seite sammelt Impressionen, aber Title/Description zeigen Luecken: %s.', implode( ', ', (array) $context['snippet_issues'] ) ),
					'url'                => $url,
					'query'              => '',
					'metrics'            => [
						'impressions'    => $current_impressions,
						'snippet_issues' => $context['snippet_issues'],
					],
					'recommended_action' => 'SEO-Title und Description gegen Suchintention, Klarheit und Laenge nachschleifen.',
				]
			);
		}
	}

	$grouped_queries = [];

	foreach ( (array) ( $snapshot['query_page_rows'] ?? [] ) as $row ) {
		$query       = nexus_get_seo_cockpit_row_key( $row, 1 );
		$normalized  = nexus_normalize_seo_cockpit_query( $query );
		$url         = nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) );
		$impressions = (float) ( $row['impressions'] ?? 0 );

		if ( '' === $normalized || '' === $url || $impressions < 10 ) {
			continue;
		}

		if ( ! isset( $grouped_queries[ $normalized ] ) ) {
			$grouped_queries[ $normalized ] = [
				'query'           => $query,
				'total_impressions' => 0.0,
				'urls'            => [],
			];
		}

		$grouped_queries[ $normalized ]['total_impressions'] += $impressions;
		$grouped_queries[ $normalized ]['urls'][ $url ] = [
			'url'         => $url,
			'impressions' => $impressions,
			'position'    => (float) ( $row['position'] ?? 0 ),
		];
	}

	foreach ( $grouped_queries as $group ) {
		if ( count( $group['urls'] ) < 2 || $group['total_impressions'] < 50 ) {
			continue;
		}

		$urls = array_values( $group['urls'] );
		usort(
			$urls,
			static function ( $left, $right ) {
				return ( $right['impressions'] <=> $left['impressions'] );
			}
		);

		$top_urls = array_slice( $urls, 0, 2 );

		$insights[] = nexus_build_seo_cockpit_insight(
			[
				'type'               => 'POSSIBLE_CANNIBALIZATION',
				'severity'           => count( $urls ) >= 3 ? 'high' : 'medium',
				'label'              => sprintf( 'Moegliche Kannibalisierung fuer "%s"', $group['query'] ),
				'reason'             => sprintf( 'Mehrere URLs sammeln fuer dieselbe Query Impressionen (gesamt %.0f).', $group['total_impressions'] ),
				'url'                => (string) ( $top_urls[0]['url'] ?? '' ),
				'query'              => (string) $group['query'],
				'metrics'            => [
					'urls'              => $top_urls,
					'total_impressions' => $group['total_impressions'],
				],
				'recommended_action' => 'Primaerseite festlegen und interne Links sowie Snippets auf diese URL konzentrieren.',
			]
		);
	}

	$deduped = [];

	foreach ( $insights as $insight ) {
		$key = implode(
			'|',
			[
				(string) $insight['type'],
				(string) $insight['url'],
				(string) $insight['query'],
			]
		);

		if ( isset( $seen[ $key ] ) ) {
			continue;
		}

		$seen[ $key ] = true;
		$deduped[]    = $insight;
	}

	usort(
		$deduped,
		static function ( $left, $right ) {
			$severity_diff = nexus_get_seo_cockpit_severity_score( (string) ( $right['severity'] ?? '' ) ) <=> nexus_get_seo_cockpit_severity_score( (string) ( $left['severity'] ?? '' ) );

			if ( 0 !== $severity_diff ) {
				return $severity_diff;
			}

			$left_impressions  = (float) ( $left['metrics']['impressions'] ?? $left['metrics']['total_impressions'] ?? 0 );
			$right_impressions = (float) ( $right['metrics']['impressions'] ?? $right['metrics']['total_impressions'] ?? 0 );

			return $right_impressions <=> $left_impressions;
		}
	);

	return array_slice( $deduped, 0, 20 );
}

/**
 * Build a compact problem-page table from snapshot insights and contexts.
 *
 * @param array<string, mixed> $snapshot Snapshot payload.
 * @return array<int, array<string, mixed>>
 */
function nexus_get_seo_cockpit_problem_pages( $snapshot ) {
	$pages         = [];
	$page_contexts = isset( $snapshot['page_contexts'] ) && is_array( $snapshot['page_contexts'] ) ? $snapshot['page_contexts'] : [];

	foreach ( (array) ( $snapshot['current_page_rows'] ?? [] ) as $row ) {
		$url = nexus_normalize_seo_cockpit_url( nexus_get_seo_cockpit_row_key( $row, 0 ) );
		if ( '' === $url ) {
			continue;
		}

		$pages[ $url ] = [
			'url'           => $url,
			'row'           => $row,
			'context'       => $page_contexts[ $url ] ?? nexus_get_seo_cockpit_wp_context_for_url( $url ),
			'insights'      => [],
			'primary'       => null,
			'detail_url'    => nexus_get_seo_cockpit_detail_url( $url ),
		];
	}

	foreach ( (array) ( $snapshot['insights'] ?? [] ) as $insight ) {
		$url = nexus_normalize_seo_cockpit_url( (string) ( $insight['url'] ?? '' ) );
		if ( '' === $url || ! isset( $pages[ $url ] ) ) {
			continue;
		}

		$pages[ $url ]['insights'][] = $insight;

		if ( null === $pages[ $url ]['primary'] || nexus_get_seo_cockpit_severity_score( $insight['severity'] ) > nexus_get_seo_cockpit_severity_score( $pages[ $url ]['primary']['severity'] ) ) {
			$pages[ $url ]['primary'] = $insight;
		}
	}

	$pages = array_values(
		array_filter(
			$pages,
			static function ( $page ) {
				return ! empty( $page['primary'] );
			}
		)
	);

	usort(
		$pages,
		static function ( $left, $right ) {
			$severity_diff = nexus_get_seo_cockpit_severity_score( (string) ( $right['primary']['severity'] ?? '' ) ) <=> nexus_get_seo_cockpit_severity_score( (string) ( $left['primary']['severity'] ?? '' ) );

			if ( 0 !== $severity_diff ) {
				return $severity_diff;
			}

			return (float) ( $right['row']['impressions'] ?? 0 ) <=> (float) ( $left['row']['impressions'] ?? 0 );
		}
	);

	return array_slice( $pages, 0, 10 );
}

/**
 * Return the detail payload for one URL drilldown.
 *
 * @param string   $url       Frontend URL.
 * @param bool     $force     Force refresh.
 * @param int|null $range_days Optional selected range.
 * @return array<string, mixed>|WP_Error
 */
function nexus_get_seo_cockpit_url_detail( $url, $force = false, $range_days = null ) {
	$property   = nexus_get_seo_cockpit_property();
	$url        = nexus_normalize_seo_cockpit_url( $url );
	$range_days = null === $range_days ? nexus_get_seo_cockpit_requested_range_days() : absint( $range_days );
	$ranges     = nexus_get_seo_cockpit_date_ranges( $range_days );
	$query_cap  = nexus_get_seo_cockpit_row_cap( 'detail_queries' );
	$device_cap = nexus_get_seo_cockpit_row_cap( 'detail_devices' );

	if ( '' === $property || '' === $url ) {
		return new WP_Error( 'nexus_seo_missing_detail_context', 'Für den URL-Drilldown fehlt Property oder URL.' );
	}

	$cache_key = nexus_get_seo_cockpit_cache_key( 'detail', [ $property, $range_days, $url ] );
	$cached    = get_transient( $cache_key );

	if ( ! $force && is_array( $cached ) ) {
		return $cached;
	}

	$filters = [
		[
			'dimension'  => 'page',
			'expression' => $url,
		],
	];

	$current = nexus_get_seo_cockpit_aggregate_metrics( $property, $ranges['current_start'], $ranges['current_end'], $filters );
	if ( is_wp_error( $current ) ) {
		return $current;
	}

	$previous = nexus_get_seo_cockpit_aggregate_metrics( $property, $ranges['previous_start'], $ranges['previous_end'], $filters );
	if ( is_wp_error( $previous ) ) {
		return $previous;
	}

	$trend = nexus_get_seo_cockpit_date_series( $property, $ranges['current_start'], $ranges['current_end'], $filters );
	if ( is_wp_error( $trend ) ) {
		return $trend;
	}

	$queries = nexus_get_seo_cockpit_report_rows(
		$property,
		$ranges['current_start'],
		$ranges['current_end'],
		[ 'query' ],
		$filters,
		(int) $query_cap['limit'],
		$query_cap
	);
	if ( is_wp_error( $queries ) ) {
		return $queries;
	}

	$previous_queries = nexus_get_seo_cockpit_report_rows(
		$property,
		$ranges['previous_start'],
		$ranges['previous_end'],
		[ 'query' ],
		$filters,
		(int) $query_cap['limit'],
		$query_cap
	);
	if ( is_wp_error( $previous_queries ) ) {
		return $previous_queries;
	}

	$devices = nexus_get_seo_cockpit_report_rows(
		$property,
		$ranges['current_start'],
		$ranges['current_end'],
		[ 'device' ],
		$filters,
		(int) $device_cap['limit'],
		$device_cap
	);
	if ( is_wp_error( $devices ) ) {
		return $devices;
	}

	$snapshot   = nexus_get_seo_cockpit_snapshot( false, $range_days );
	$insights   = [];
	$context    = nexus_get_seo_cockpit_wp_context_for_url( $url );
	$inspection = function_exists( 'nexus_get_seo_cockpit_cached_url_inspection' ) ? nexus_get_seo_cockpit_cached_url_inspection( $url ) : null;
	$koko       = function_exists( 'nexus_get_seo_cockpit_koko_detail_data' ) ? nexus_get_seo_cockpit_koko_detail_data( $url, $context, $ranges ) : [];
	$diagnostics = function_exists( 'nexus_get_seo_cockpit_diagnostics' ) ? nexus_get_seo_cockpit_diagnostics( $url ) : [];

	if ( ! is_wp_error( $snapshot ) ) {
		foreach ( (array) ( $snapshot['insights'] ?? [] ) as $insight ) {
			if ( $url === nexus_normalize_seo_cockpit_url( (string) ( $insight['url'] ?? '' ) ) ) {
				$insights[] = $insight;
			}
		}
	}

	$detail = [
		'generated_at'     => current_time( 'timestamp' ),
		'property'         => $property,
		'url'              => $url,
		'range_days'       => $range_days,
		'ranges'           => $ranges,
		'overview'         => [
			'current'  => $current,
			'previous' => $previous,
		],
		'trend'            => $trend,
		'top_queries'      => $queries,
		'previous_queries' => $previous_queries,
		'devices'          => $devices,
		'context'          => $context,
		'insights'         => $insights,
		'inspection'       => $inspection,
		'koko'             => $koko,
		'diagnostics'      => $diagnostics,
	];

	set_transient( $cache_key, $detail, nexus_get_seo_cockpit_refresh_interval_seconds() );

	return $detail;
}
