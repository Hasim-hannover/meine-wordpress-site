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
		'fundament' => __( 'Fundament', 'blocksy-child' ),
		'aufbau'    => __( 'Aufbau', 'blocksy-child' ),
		'skalierung' => __( 'Skalierung', 'blocksy-child' ),
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

	return $options[ $phase ] ?? $phase;
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
