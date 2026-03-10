<?php
/**
 * WGOS asset content model.
 *
 * Hub = WGOS page. Spokes = hierarchical WGOS assets powered by a dedicated CPT.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the allowed WGOS asset phases.
 *
 * Centralized so ACF, templates and future queries stay in sync.
 *
 * @return array<string, string>
 */
function nexus_get_wgos_asset_phase_options() {
	return [
		'Fundament' => __( '1. Fundament', 'blocksy-child' ),
		'Aufbau'    => __( '2. Aufbau', 'blocksy-child' ),
		'Skalierung' => __( '3. Skalierung', 'blocksy-child' ),
	];
}

/**
 * Convert a stored phase key into a readable label.
 *
 * @param string $phase Stored phase key.
 * @return string
 */
function nexus_get_wgos_asset_phase_label( $phase ) {
	$options = nexus_get_wgos_asset_phase_options();
	$phase   = (string) $phase;

	if ( isset( $options[ $phase ] ) ) {
		return $options[ $phase ];
	}

	$legacy_map = [
		'fundament' => 'Fundament',
		'aufbau'    => 'Aufbau',
		'skalierung' => 'Skalierung',
	];

	$legacy_key = strtolower( $phase );
	if ( isset( $legacy_map[ $legacy_key ], $options[ $legacy_map[ $legacy_key ] ] ) ) {
		return $options[ $legacy_map[ $legacy_key ] ];
	}

	return $options[ $phase ] ?? $phase;
}

/**
 * Read WGOS asset meta with support for the renamed ACF fields.
 *
 * @param int    $post_id      Asset post ID.
 * @param string $field_name   New field name.
 * @param string $legacy_name  Previous field name.
 * @param mixed  $default      Fallback value.
 * @return mixed
 */
function nexus_get_wgos_asset_field( $post_id, $field_name, $legacy_name, $default = '' ) {
	$value = nexus_get_field( $field_name, null, $post_id );

	if ( null !== $value && '' !== $value && false !== $value ) {
		return $value;
	}

	return nexus_get_field( $legacy_name, $default, $post_id );
}

/**
 * Normalize labels and slugs into one stable lookup key.
 *
 * @param string $value Raw lookup value.
 * @return string
 */
function nexus_get_wgos_asset_lookup_key( $value ) {
	return sanitize_title( wp_strip_all_tags( (string) $value ) );
}

/**
 * Build a per-request lookup table for published WGOS assets.
 *
 * Supports both explicit slugs and labels from the WGOS hub tables.
 *
 * @return array<string, WP_Post>
 */
function nexus_get_wgos_asset_lookup_map() {
	static $map = null;

	if ( null !== $map ) {
		return $map;
	}

	$map   = [];
	$posts = get_posts(
		[
			'post_type'              => 'wgos_asset',
			'post_status'            => 'publish',
			'posts_per_page'         => -1,
			'orderby'                => 'menu_order title',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		]
	);

	foreach ( $posts as $post ) {
		$title_key = nexus_get_wgos_asset_lookup_key( $post->post_title );
		$slug_key  = nexus_get_wgos_asset_lookup_key( $post->post_name );

		if ( $title_key ) {
			$map[ $title_key ] = $post;
		}

		if ( $slug_key ) {
			$map[ $slug_key ] = $post;
		}
	}

	return $map;
}

/**
 * Resolve a published WGOS asset by its hub label or slug.
 *
 * @param string $value Asset label or slug.
 * @return WP_Post|null
 */
function nexus_get_wgos_asset( $value ) {
	$key = nexus_get_wgos_asset_lookup_key( $value );

	if ( '' === $key ) {
		return null;
	}

	$map = nexus_get_wgos_asset_lookup_map();

	return $map[ $key ] ?? null;
}

/**
 * Return short hover copy for a linked WGOS asset.
 *
 * @param WP_Post $asset Asset post object.
 * @return string
 */
function nexus_get_wgos_asset_hover_text( $asset ) {
	$excerpt = trim( (string) $asset->post_excerpt );

	if ( '' !== $excerpt ) {
		return $excerpt;
	}

	$deliverables = nexus_get_wgos_asset_field( $asset->ID, 'wgos_deliverables', 'wgos_asset_deliverables', '' );

	if ( is_string( $deliverables ) && '' !== trim( $deliverables ) ) {
		return trim( $deliverables );
	}

	return '';
}

/**
 * Render a hub table label that links to the WGOS asset when available.
 *
 * Falls back to plain text until a matching published asset exists.
 *
 * @param string $label Hub-visible asset label.
 * @return string
 */
function nexus_render_wgos_asset_label( $label ) {
	$label = (string) $label;
	$asset = nexus_get_wgos_asset( $label );

	if ( ! $asset instanceof WP_Post ) {
		return esc_html( $label );
	}

	$hint = nexus_get_wgos_asset_hover_text( $asset );

	if ( '' === $hint ) {
		$hint = __( 'Detailseite mit Kontext, Leistungsumfang und Einsatz im WGOS.', 'blocksy-child' );
	}

	return sprintf(
		'<span class="wgos-asset-link-wrap"><span class="wgos-asset-link">%1$s</span><span class="wgos-asset-link__panel"><span class="wgos-asset-link__text">%2$s</span><a class="wgos-asset-link__cta" href="%3$s" data-track-action="cta_wgos_asset_table" data-track-category="navigation">%4$s</a></span></span>',
		esc_html( $label ),
		esc_html( $hint ),
		esc_url( get_permalink( $asset ) ),
		esc_html__( 'Mehr erfahren', 'blocksy-child' )
	);
}

/**
 * Resolve the WGOS hub page ID.
 *
 * @return int
 */
function nexus_get_wgos_page_id() {
	$template_page_id = nexus_get_page_id_by_template( 'page-wgos.php' );

	if ( $template_page_id ) {
		return $template_page_id;
	}

	return nexus_get_page_id( [ 'wgos', 'wordpress-growth-operating-system' ] );
}

/**
 * Resolve the WGOS hub page URL.
 *
 * @return string
 */
function nexus_get_wgos_url() {
	$page_id = nexus_get_wgos_page_id();

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	return home_url( '/wgos/' );
}

/**
 * Register the hierarchical WGOS asset post type.
 *
 * The post type is public, searchable and block-editor ready so new asset
 * spokes can be added without creating more static templates.
 *
 * @return void
 */
function nexus_register_wgos_asset_post_type() {
	register_post_type(
		'wgos_asset',
		[
			'labels' => [
				'name'                  => __( 'WGOS Assets', 'blocksy-child' ),
				'singular_name'         => __( 'WGOS Asset', 'blocksy-child' ),
				'menu_name'             => __( 'WGOS Assets', 'blocksy-child' ),
				'name_admin_bar'        => __( 'WGOS Asset', 'blocksy-child' ),
				'add_new'               => __( 'Neu', 'blocksy-child' ),
				'add_new_item'          => __( 'Neues WGOS Asset', 'blocksy-child' ),
				'edit_item'             => __( 'WGOS Asset bearbeiten', 'blocksy-child' ),
				'new_item'              => __( 'Neues WGOS Asset', 'blocksy-child' ),
				'view_item'             => __( 'WGOS Asset ansehen', 'blocksy-child' ),
				'view_items'            => __( 'WGOS Assets ansehen', 'blocksy-child' ),
				'search_items'          => __( 'WGOS Assets suchen', 'blocksy-child' ),
				'not_found'             => __( 'Keine WGOS Assets gefunden.', 'blocksy-child' ),
				'not_found_in_trash'    => __( 'Keine WGOS Assets im Papierkorb gefunden.', 'blocksy-child' ),
				'all_items'             => __( 'Alle WGOS Assets', 'blocksy-child' ),
				'archives'              => __( 'WGOS Asset Archiv', 'blocksy-child' ),
				'attributes'            => __( 'WGOS Asset Attribute', 'blocksy-child' ),
				'insert_into_item'      => __( 'In WGOS Asset einfügen', 'blocksy-child' ),
				'uploaded_to_this_item' => __( 'Zu diesem WGOS Asset hochgeladen', 'blocksy-child' ),
				'parent_item_colon'     => __( 'Übergeordnetes WGOS Asset:', 'blocksy-child' ),
			],
			'description'         => __( 'Hierarchische WGOS Asset-Detailseiten als skalierbare Spokes unter dem WGOS-Hub.', 'blocksy-child' ),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'show_in_rest'        => true,
			'exclude_from_search' => false,
			// Der öffentliche Hub bleibt page-wgos.php; der CPT liefert nur die Spokes.
			'has_archive'         => false,
			'rewrite'             => [
				'slug'       => 'wgos-assets',
				'with_front' => false,
				'feeds'      => false,
				'pages'      => true,
			],
			'hierarchical'        => true,
			'menu_icon'           => 'dashicons-networking',
			'menu_position'       => 24,
			'supports'            => [
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'page-attributes',
				'revisions',
				'custom-fields',
			],
			'capability_type'     => 'page',
			'map_meta_cap'        => true,
			'can_export'          => true,
			'delete_with_user'    => false,
		]
	);
}
add_action( 'init', 'nexus_register_wgos_asset_post_type' );

// Das Template rendert den Hero selbst; der Blocksy-Standardtitel waere doppelt.
add_filter( 'blocksy:post_types:wgos_asset:has_page_title', '__return_false' );
