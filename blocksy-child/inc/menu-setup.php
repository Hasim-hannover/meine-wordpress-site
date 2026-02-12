<?php
/**
 * NEXUS MENU SETUP
 *
 * Erstellt das Hauptmenü mit der empfohlenen Struktur:
 * WordPress Agentur | Leistungen (Mega) | WGOS | Tools | Blog | Über mich
 *
 * Einmal-Setup: Wird beim Theme-Switch oder manuell via ?nexus_rebuild_menu=1 ausgelöst.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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

	// Hilfsfunktion: Seite per Slug finden
	$get_page_id = function ( $slug ) {
		$page = get_page_by_path( $slug );
		return $page ? $page->ID : 0;
	};

	// ── 1. WordPress Agentur (Top-Level, direkt verlinkt) ──────────
	$agentur_id = $get_page_id( 'wordpress-agentur' );
	$item_agentur = wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'WordPress Agentur',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $agentur_id,
		'menu-item-type'      => $agentur_id ? 'post_type' : 'custom',
		'menu-item-url'       => $agentur_id ? '' : home_url( '/wordpress-agentur/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 2. Leistungen (Mega-Menü Parent) ───────────────────────────
	$item_leistungen = wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'   => 'Leistungen',
		'menu-item-type'    => 'custom',
		'menu-item-url'     => '#',
		'menu-item-status'  => 'publish',
		'menu-item-classes' => 'mega',
	] );

	// Leistungen Sub-Items
	$services = [
		[ 'slug' => 'wordpress-seo-hannover', 'title' => 'SEO Hannover' ],
		[ 'slug' => 'conversion-rate-optimization', 'title' => 'CRO & UX' ],
		[ 'slug' => 'core-web-vitals', 'title' => 'Core Web Vitals' ],
		[ 'slug' => 'ga4-tracking-setup', 'title' => 'GA4 & Tracking' ],
		[ 'slug' => 'meta-ads', 'title' => 'Meta Ads' ],
		[ 'slug' => 'performance-marketing', 'title' => 'Performance Marketing' ],
	];

	foreach ( $services as $service ) {
		$page_id = $get_page_id( $service['slug'] );
		wp_update_nav_menu_item( $menu_id, 0, [
			'menu-item-title'           => $service['title'],
			'menu-item-object'          => 'page',
			'menu-item-object-id'       => $page_id,
			'menu-item-type'            => $page_id ? 'post_type' : 'custom',
			'menu-item-url'             => $page_id ? '' : home_url( '/' . $service['slug'] . '/' ),
			'menu-item-parent-id'       => $item_leistungen,
			'menu-item-status'          => 'publish',
		] );
	}

	// ── 3. WGOS (Top-Level, direkt verlinkt) ───────────────────────
	$wgos_id = $get_page_id( 'wordpress-growth-operating-system' );
	if ( ! $wgos_id ) {
		$wgos_id = $get_page_id( 'wgos' );
	}
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'WGOS',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $wgos_id,
		'menu-item-type'      => $wgos_id ? 'post_type' : 'custom',
		'menu-item-url'       => $wgos_id ? '' : home_url( '/wgos/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 4. Tools (Top-Level) ───────────────────────────────────────
	$tools_id = $get_page_id( 'kostenlose-tools' );
	if ( ! $tools_id ) {
		$tools_id = $get_page_id( 'tools' );
	}
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Tools',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $tools_id,
		'menu-item-type'      => $tools_id ? 'post_type' : 'custom',
		'menu-item-url'       => $tools_id ? '' : home_url( '/kostenlose-tools/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 5. Blog (Top-Level) ────────────────────────────────────────
	$blog_page_id = get_option( 'page_for_posts' );
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Blog',
		'menu-item-object'    => $blog_page_id ? 'page' : '',
		'menu-item-object-id' => $blog_page_id ?: 0,
		'menu-item-type'      => $blog_page_id ? 'post_type' : 'custom',
		'menu-item-url'       => $blog_page_id ? '' : home_url( '/blog/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── 6. Über mich (Top-Level) ──────────────────────────────────
	$about_id = $get_page_id( 'uber-mich' );
	if ( ! $about_id ) {
		$about_id = $get_page_id( 'ueber-mich' );
	}
	if ( ! $about_id ) {
		$about_id = $get_page_id( 'about' );
	}
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Über mich',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $about_id,
		'menu-item-type'      => $about_id ? 'post_type' : 'custom',
		'menu-item-url'       => $about_id ? '' : home_url( '/uber-mich/' ),
		'menu-item-status'    => 'publish',
	] );

	// ── Menü der primären Location zuweisen ────────────────────────
	$locations = get_theme_mod( 'nav_menu_locations', [] );
	$locations['primary'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );
}

// Bei Theme-Aktivierung ausführen
add_action( 'after_switch_theme', 'nexus_setup_main_menu' );

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
} );
