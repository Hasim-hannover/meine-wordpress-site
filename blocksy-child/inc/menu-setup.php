<?php
/**
 * NEXUS MENU SETUP
 *
 * Erstellt das fokussierte Hauptmenü für die Neukunden-Navigation:
 * System | Ergebnisse | Insights | Über mich | Audit starten
 *
 * Einmal-Setup: Wird beim Theme-Switch oder manuell via ?nexus_rebuild_menu=1 ausgelöst.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detect audit CTA items even if the stored WordPress menu label is outdated.
 *
 * @param WP_Post $item Menu item object.
 * @return bool
 */
function nexus_is_audit_cta_menu_item( $item ) {
	$classes = isset( $item->classes ) && is_array( $item->classes ) ? $item->classes : [];
	$title   = isset( $item->title ) ? wp_strip_all_tags( (string) $item->title ) : '';
	$url     = isset( $item->url ) ? (string) $item->url : '';
	$path    = $url ? wp_parse_url( $url, PHP_URL_PATH ) : '';

	if ( in_array( 'nav-cta-button', $classes, true ) ) {
		return true;
	}

	// Legacy paths stay here so older menu items are still normalized at render time.
	$audit_paths = [
		'/audit/',
		'/customer-journey-audit/',
		'/growth-audit/',
		'/360-audit/',
	];

	if ( $path && in_array( trailingslashit( $path ), $audit_paths, true ) ) {
		return true;
	}

	$title = strtolower( $title );

	return false !== strpos( $title, 'journey audit' )
		|| false !== strpos( $title, 'growth audit' )
		|| false !== strpos( $title, 'free journey audit' );
}

/**
 * Detect results/proof menu items even if the stored WordPress label is outdated.
 *
 * @param WP_Post $item Menu item object.
 * @return bool
 */
function nexus_is_results_menu_item( $item ) {
	$classes = isset( $item->classes ) && is_array( $item->classes ) ? $item->classes : [];
	$title   = isset( $item->title ) ? wp_strip_all_tags( (string) $item->title ) : '';
	$url     = isset( $item->url ) ? (string) $item->url : '';
	$path    = $url ? wp_parse_url( $url, PHP_URL_PATH ) : '';

	if ( in_array( 'nav-results-link', $classes, true ) ) {
		return true;
	}

	$results_paths = [
		'/case-studies/',
		'/case-studies-e-commerce/',
		'/ergebnisse/',
	];

	if ( $path && in_array( trailingslashit( $path ), $results_paths, true ) ) {
		return true;
	}

	$title = strtolower( $title );

	return false !== strpos( $title, 'case stud' )
		|| false !== strpos( $title, 'ergebnisse' )
		|| false !== strpos( $title, 'proof' );
}

/**
 * Hauptmenü programmatisch erstellen.
 */
function nexus_setup_main_menu() {

	$menu_name = 'Nexus Hauptmenü';

	// Bestehendes Menü löschen falls vorhanden (Neuaufbau)
	$existing = wp_get_nav_menu_object( $menu_name );
	if ( $existing ) {
		wp_delete_nav_menu( $existing->term_id );
	}

	$menu_id = wp_create_nav_menu( $menu_name );
	if ( is_wp_error( $menu_id ) ) {
		return;
	}

	// ── 1. System (Top-Level) ──────────────────────────────────────
	$system_id = nexus_get_page_id( [ 'wordpress-growth-operating-system', 'wgos' ] );
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'System',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $system_id,
		'menu-item-type'      => $system_id ? 'post_type' : 'custom',
		'menu-item-url'       => $system_id ? '' : home_url( '/wordpress-growth-operating-system/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 2. Ergebnisse (Top-Level) ──────────────────────────────────
	$cases_id = nexus_get_results_page_id();
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Ergebnisse',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $cases_id,
		'menu-item-type'      => $cases_id ? 'post_type' : 'custom',
		'menu-item-url'       => $cases_id ? '' : nexus_get_results_url(),
		'menu-item-status'    => 'publish',
		'menu-item-classes'   => 'nav-results-link',
	] );

	// ── 3. Insights (Top-Level) ────────────────────────────────────
	$blog_page_id = get_option( 'page_for_posts' );
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Insights',
		'menu-item-object'    => $blog_page_id ? 'page' : '',
		'menu-item-object-id' => $blog_page_id ?: 0,
		'menu-item-type'      => $blog_page_id ? 'post_type' : 'custom',
		'menu-item-url'       => $blog_page_id ? '' : home_url( '/blog/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 4. Über mich (Top-Level) ──────────────────────────────────
	$about_id = nexus_get_page_id( [ 'uber-mich' ] );
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Über mich',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $about_id,
		'menu-item-type'      => $about_id ? 'post_type' : 'custom',
		'menu-item-url'       => $about_id ? '' : home_url( '/uber-mich/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 5. Audit CTA (Top-Level) ───────────────────────────────────
	$audit_id = nexus_get_audit_page_id();
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Audit starten',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $audit_id,
		'menu-item-type'      => $audit_id ? 'post_type' : 'custom',
		'menu-item-url'       => $audit_id ? '' : nexus_get_audit_url(),
		'menu-item-status'    => 'publish',
		'menu-item-classes'   => 'nav-cta-button',
	] );

	// ── Menü den Header-Locations zuweisen ─────────────────────────
	$locations = get_theme_mod( 'nav_menu_locations', [] );
	$locations['primary']      = $menu_id;
	$locations['primary-slim'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

// Bei Theme-Aktivierung ausführen
add_action( 'after_switch_theme', 'nexus_setup_main_menu' );

/**
 * Create the proof hub pages that are routed via page-slug templates.
 *
 * Triggered manually for admins so production content does not change unexpectedly.
 *
 * @return void
 */
function nexus_seed_results_pages() {
	$pages = [
		[
			'slug'   => 'ergebnisse',
			'title'  => 'Ergebnisse',
			'update' => [ 'Case Studies', 'Case Studies E-Commerce', 'Results', 'Ergebnisse' ],
		],
		[
			'slug'   => 'whitelabel-retainer',
			'title'  => 'Whitelabel & Retainer',
			'update' => [],
		],
	];

	foreach ( $pages as $page ) {
		$existing = get_page_by_path( $page['slug'] );

		if ( $existing instanceof WP_Post ) {
			if ( in_array( $existing->post_title, $page['update'], true ) ) {
				wp_update_post(
					[
						'ID'         => $existing->ID,
						'post_title' => $page['title'],
					]
				);
			}

			continue;
		}

		wp_insert_post(
			[
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_title'   => $page['title'],
				'post_name'    => $page['slug'],
				'post_content' => '',
			]
		);
	}
}

// Manuell auslösen: ?nexus_rebuild_menu=1 (nur für Admins)
add_action( 'admin_init', function () {
	if (
		isset( $_GET['nexus_rebuild_menu'] ) &&
		$_GET['nexus_rebuild_menu'] === '1' &&
		current_user_can( 'manage_options' )
	) {
		nexus_setup_main_menu();
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-success is-dismissible"><p>Nexus Hauptmenü wurde erstellt.</p></div>';
		} );
	}

	if (
		isset( $_GET['nexus_seed_results_pages'] ) &&
		'1' === $_GET['nexus_seed_results_pages'] &&
		current_user_can( 'manage_options' )
	) {
		nexus_seed_results_pages();
		nexus_setup_main_menu();
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-success is-dismissible"><p>Ergebnisse- und Whitelabel-Seiten wurden angelegt bzw. aktualisiert.</p></div>';
		} );
	}
} );

/**
 * Normalize the primary nav CTA at render time.
 *
 * This keeps the live header label stable even if the stored menu item in
 * WordPress still carries an outdated title from an older setup.
 */
add_filter( 'wp_nav_menu_objects', function ( $items, $args ) {
	if ( empty( $items ) || empty( $args ) ) {
		return $items;
	}

	$theme_location = isset( $args->theme_location ) ? (string) $args->theme_location : '';
	$menu_name      = isset( $args->menu->name ) ? (string) $args->menu->name : '';
	$is_primary_like_menu = in_array( $theme_location, [ 'primary', 'primary-slim' ], true )
		|| in_array( $menu_name, [ 'Nexus Hauptmenü', 'Hauptmenü Slim' ], true );

	$audit_url = nexus_get_audit_url();
	$results_url = nexus_get_results_url();
	$is_results_context = nexus_is_results_context();

	foreach ( $items as $item ) {
		if ( nexus_is_results_menu_item( $item ) ) {
			$item->title = 'Ergebnisse';
			$item->url   = $results_url;

			if ( ! isset( $item->classes ) || ! is_array( $item->classes ) ) {
				$item->classes = [];
			}

			if ( ! in_array( 'nav-results-link', $item->classes, true ) ) {
				$item->classes[] = 'nav-results-link';
			}

			if ( $is_primary_like_menu && $is_results_context ) {
				foreach ( [ 'current-menu-item', 'current_page_item' ] as $class_name ) {
					if ( ! in_array( $class_name, $item->classes, true ) ) {
						$item->classes[] = $class_name;
					}
				}
			}

			continue;
		}

		if ( ! nexus_is_audit_cta_menu_item( $item ) ) {
			continue;
		}

		$item->title = 'Audit starten';
		$item->url   = $audit_url;

		if ( ! isset( $item->classes ) || ! is_array( $item->classes ) ) {
			$item->classes = [];
		}

		if ( ! in_array( 'nav-cta-button', $item->classes, true ) ) {
			$item->classes[] = 'nav-cta-button';
		}
	}

	return $items;
}, 20, 2 );
