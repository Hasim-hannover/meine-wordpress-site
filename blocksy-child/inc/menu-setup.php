<?php
/**
 * NEXUS MENU SETUP
 *
 * Erstellt das fokussierte Hauptmenü fuer die Neukunden-Navigation:
 * System | Case Studies | Insights | Über mich | Audit starten
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

	// ── 2. Case Studies (Top-Level) ────────────────────────────────
	$cases_id = nexus_get_page_id( [ 'case-studies' ] );
	wp_update_nav_menu_item( $menu_id, 0, [
		'menu-item-title'     => 'Case Studies',
		'menu-item-object'    => 'page',
		'menu-item-object-id' => $cases_id,
		'menu-item-type'      => $cases_id ? 'post_type' : 'custom',
		'menu-item-url'       => $cases_id ? '' : home_url( '/case-studies/' ),
		'menu-item-status'    => 'publish',
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
