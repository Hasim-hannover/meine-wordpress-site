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

/**
 * Return legacy offer pages that can be cleaned up in WordPress admin.
 *
 * @return array<int, array<string, mixed>>
 */
function nexus_get_legacy_offer_cleanup_candidates() {
	$candidates = [];

	foreach ( nexus_get_legacy_offer_redirect_map() as $legacy_path => $target_url ) {
		$page_path = trim( (string) $legacy_path, '/' );
		$page      = '' !== $page_path ? get_page_by_path( $page_path, OBJECT, 'page' ) : null;

		if ( ! $page instanceof WP_Post ) {
			continue;
		}

		$candidates[] = [
			'id'          => (int) $page->ID,
			'title'       => (string) $page->post_title,
			'status'      => (string) $page->post_status,
			'legacy_path' => $legacy_path,
			'target_url'  => (string) $target_url,
		];
	}

	return $candidates;
}

/**
 * Find menu items that still point to legacy offer pages.
 *
 * @return array<int, array<string, mixed>>
 */
function nexus_get_legacy_offer_menu_items() {
	$matches      = [];
	$legacy_paths = array_keys( nexus_get_legacy_offer_redirect_map() );

	foreach ( wp_get_nav_menus() as $menu ) {
		$items = wp_get_nav_menu_items(
			$menu->term_id,
			[
				'post_status' => 'any',
			]
		);

		if ( empty( $items ) ) {
			continue;
		}

		foreach ( $items as $item ) {
			$item_path = trailingslashit( '/' . ltrim( (string) wp_parse_url( (string) $item->url, PHP_URL_PATH ), '/' ) );

			if ( ! in_array( $item_path, $legacy_paths, true ) ) {
				continue;
			}

			$matches[] = [
				'id'         => (int) $item->ID,
				'title'      => wp_strip_all_tags( (string) $item->title ),
				'menu_name'  => (string) $menu->name,
				'legacy_path'=> $item_path,
			];
		}
	}

	return $matches;
}

/**
 * Return the admin URL that runs the legacy page cleanup.
 *
 * @return string
 */
function nexus_get_legacy_offer_cleanup_url() {
	return wp_nonce_url(
		add_query_arg(
			[
				'nexus_cleanup_legacy_pages' => '1',
			],
			admin_url()
		),
		'nexus_cleanup_legacy_pages'
	);
}

/**
 * Draft legacy offer pages and remove remaining nav menu items that point to them.
 *
 * @return array<string, array<int, string>>
 */
function nexus_cleanup_legacy_offer_pages() {
	$results = [
		'drafted'       => [],
		'already_draft' => [],
		'menus_removed' => [],
		'not_found'     => [],
		'errors'        => [],
	];

	$candidates     = nexus_get_legacy_offer_cleanup_candidates();
	$legacy_map     = nexus_get_legacy_offer_redirect_map();
	$found_paths    = [];
	$candidate_ids  = [];

	foreach ( $candidates as $candidate ) {
		$page_id     = (int) $candidate['id'];
		$page_status = (string) $candidate['status'];
		$legacy_path = (string) $candidate['legacy_path'];
		$label       = sprintf( '%1$s (%2$s)', (string) $candidate['title'], $legacy_path );

		$found_paths[]   = $legacy_path;
		$candidate_ids[] = $page_id;

		update_post_meta( $page_id, 'seo_noindex', 1 );

		if ( 'draft' === $page_status ) {
			$results['already_draft'][] = $label;
			continue;
		}

		$update = wp_update_post(
			[
				'ID'          => $page_id,
				'post_status' => 'draft',
			],
			true
		);

		if ( is_wp_error( $update ) ) {
			$results['errors'][] = sprintf( '%1$s: %2$s', $label, $update->get_error_message() );
			continue;
		}

		$results['drafted'][] = $label;
	}

	foreach ( array_keys( $legacy_map ) as $legacy_path ) {
		if ( ! in_array( $legacy_path, $found_paths, true ) ) {
			$results['not_found'][] = $legacy_path;
		}
	}

	foreach ( wp_get_nav_menus() as $menu ) {
		$items = wp_get_nav_menu_items(
			$menu->term_id,
			[
				'post_status' => 'any',
			]
		);

		if ( empty( $items ) ) {
			continue;
		}

		foreach ( $items as $item ) {
			$item_path  = trailingslashit( '/' . ltrim( (string) wp_parse_url( (string) $item->url, PHP_URL_PATH ), '/' ) );
			$object_id  = isset( $item->object_id ) ? (int) $item->object_id : 0;
			$path_match = in_array( $item_path, array_keys( $legacy_map ), true );
			$id_match   = in_array( $object_id, $candidate_ids, true );

			if ( ! $path_match && ! $id_match ) {
				continue;
			}

			$deleted = wp_delete_post( (int) $item->ID, true );

			if ( ! $deleted ) {
				$results['errors'][] = sprintf(
					'Nav-Item "%1$s" im Menü "%2$s" konnte nicht entfernt werden.',
					wp_strip_all_tags( (string) $item->title ),
					(string) $menu->name
				);
				continue;
			}

			$results['menus_removed'][] = sprintf(
				'%1$s -> %2$s',
				wp_strip_all_tags( (string) $item->title ),
				(string) $menu->name
			);
		}
	}

	return $results;
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

	if (
		isset( $_GET['nexus_cleanup_legacy_pages'] ) &&
		'1' === $_GET['nexus_cleanup_legacy_pages'] &&
		current_user_can( 'manage_options' )
	) {
		check_admin_referer( 'nexus_cleanup_legacy_pages' );

		$results = nexus_cleanup_legacy_offer_pages();
		set_transient( 'nexus_cleanup_legacy_pages_notice', $results, MINUTE_IN_SECONDS );

		wp_safe_redirect(
			remove_query_arg(
				[
					'nexus_cleanup_legacy_pages',
					'_wpnonce',
				]
			)
		);
		exit;
	}
} );

add_action( 'admin_notices', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$results = get_transient( 'nexus_cleanup_legacy_pages_notice' );

	if ( is_array( $results ) ) {
		delete_transient( 'nexus_cleanup_legacy_pages_notice' );

		$parts = [];

		if ( ! empty( $results['drafted'] ) ) {
			$parts[] = sprintf( '%d Seite(n) auf Draft gesetzt', count( $results['drafted'] ) );
		}

		if ( ! empty( $results['already_draft'] ) ) {
			$parts[] = sprintf( '%d Seite(n) waren bereits Draft', count( $results['already_draft'] ) );
		}

		if ( ! empty( $results['menus_removed'] ) ) {
			$parts[] = sprintf( '%d Menüeintrag/-träge entfernt', count( $results['menus_removed'] ) );
		}

		if ( ! empty( $results['not_found'] ) ) {
			$parts[] = sprintf( '%d Slug(s) nicht im Admin gefunden', count( $results['not_found'] ) );
		}

		$class = empty( $results['errors'] ) ? 'notice-success' : 'notice-warning';
		echo '<div class="notice ' . esc_attr( $class ) . ' is-dismissible"><p><strong>Legacy-Cleanup abgeschlossen.</strong> ' . esc_html( implode( ' · ', $parts ) ) . '</p>';

		if ( ! empty( $results['errors'] ) ) {
			echo '<p>' . esc_html( implode( ' | ', $results['errors'] ) ) . '</p>';
		}

		echo '</div>';
		return;
	}

	$candidates = nexus_get_legacy_offer_cleanup_candidates();
	$menu_items = nexus_get_legacy_offer_menu_items();

	if ( empty( $candidates ) && empty( $menu_items ) ) {
		return;
	}

	$cleanup_url = nexus_get_legacy_offer_cleanup_url();
	$page_count  = count( $candidates );
	$menu_count  = count( $menu_items );

	echo '<div class="notice notice-warning"><p><strong>Legacy-Angebotsseiten gefunden.</strong> ';
	echo esc_html(
		sprintf(
			'%1$d Seite(n) und %2$d Menüeintrag/-träge verweisen noch auf auslaufende Slugs.',
			$page_count,
			$menu_count
		)
	);
	echo ' <a class="button button-secondary" href="' . esc_url( $cleanup_url ) . '">Legacy-Seiten bereinigen</a></p></div>';
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
