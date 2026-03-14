<?php
/**
 * NEXUS Custom Header
 *
 * Rendert einen projekt-eigenen Header im Child-Theme und blendet den
 * Blocksy Header visuell aus, damit Navigation, Sticky-Verhalten und
 * Mobile-Menue zentral gesteuert werden.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detect the blog area that uses the dedicated blog header template.
 *
 * @return bool
 */
function nexus_is_blog_header_context() {
	return is_home() || is_archive() || is_singular( 'post' );
}

add_filter( 'body_class', 'nexus_add_custom_header_body_class' );
/**
 * Mark the frontend so the custom header CSS can disable the theme header.
 *
 * @param array $classes Existing body classes.
 * @return array
 */
function nexus_add_custom_header_body_class( $classes ) {
	if ( is_admin() ) {
		return $classes;
	}

	if ( nexus_is_blog_header_context() ) {
		$classes[] = 'nx-blog-header-active';
		return $classes;
	}

	$classes[] = 'nx-custom-header-active';

	return $classes;
}

add_action( 'wp_body_open', 'nexus_render_site_header', 20 );
/**
 * Render the custom global site header once per request.
 *
 * @return void
 */
function nexus_render_site_header() {
	static $rendered = false;

	if ( $rendered || is_admin() || is_feed() ) {
		return;
	}

	if ( function_exists( 'wp_is_json_request' ) && wp_is_json_request() ) {
		return;
	}

	if ( nexus_is_blog_header_context() ) {
		return;
	}

	$rendered = true;

	get_template_part( 'template-parts/site-header' );
}

/**
 * Resolve the preferred nav location for the custom header.
 *
 * @return string
 */
function nexus_get_site_header_menu_location() {
	$locations = [ 'primary-slim', 'primary' ];

	foreach ( $locations as $location ) {
		if ( has_nav_menu( $location ) ) {
			return $location;
		}
	}

	return '';
}

/**
 * Provide a sane navigation fallback if no WordPress menu is assigned.
 *
 * @return array<int, array<string, mixed>>
 */
function nexus_get_site_header_fallback_items() {
	$blog_page_id = (int) get_option( 'page_for_posts' );
	$wgos_page_id = nexus_get_page_id( [ 'wordpress-growth-operating-system', 'wgos' ] );
	$about_page_id = nexus_get_page_id( [ 'uber-mich' ] );
	$primary_urls = function_exists( 'nexus_get_primary_public_url_map' ) ? nexus_get_primary_public_url_map() : [];

	return [
		[
			'label'  => __( 'System', 'blocksy-child' ),
			'url'    => $primary_urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' ),
			'active' => $wgos_page_id ? is_page( $wgos_page_id ) : false,
			'class'  => '',
		],
		[
			'label'  => __( 'Ergebnisse', 'blocksy-child' ),
			'url'    => nexus_get_results_url(),
			'active' => nexus_is_results_context(),
			'class'  => '',
		],
		[
			'label'  => __( 'Insights', 'blocksy-child' ),
			'url'    => $blog_page_id ? get_permalink( $blog_page_id ) : ( $primary_urls['blog'] ?? home_url( '/blog/' ) ),
			'active' => is_home() || is_archive() || is_singular( 'post' ),
			'class'  => '',
		],
		[
			'label'  => __( 'Über mich', 'blocksy-child' ),
			'url'    => $primary_urls['about'] ?? home_url( '/uber-mich/' ),
			'active' => $about_page_id ? is_page( $about_page_id ) : false,
			'class'  => '',
		],
		[
			'label'  => __( 'Audit starten', 'blocksy-child' ),
			'url'    => $primary_urls['audit'] ?? nexus_get_audit_url(),
			'active' => nexus_is_audit_page(),
			'class'  => 'nav-cta-button',
		],
	];
}

/**
 * Render the menu markup for desktop or mobile header contexts.
 *
 * @param string $context Menu context, e.g. desktop or mobile.
 * @return void
 */
function nexus_render_site_header_menu( $context = 'desktop' ) {
	$context    = sanitize_key( $context );
	$location   = nexus_get_site_header_menu_location();
	$menu_class = 'nx-site-header__menu nx-site-header__menu--' . $context;

	if ( $location ) {
		wp_nav_menu(
			[
				'theme_location' => $location,
				'container'      => false,
				'menu_class'     => $menu_class,
				'fallback_cb'    => false,
				'depth'          => 2,
			]
		);

		return;
	}

	$fallback_items = nexus_get_site_header_fallback_items();

	if ( empty( $fallback_items ) ) {
		return;
	}

	echo '<ul class="' . esc_attr( $menu_class ) . '">';

	foreach ( $fallback_items as $item ) {
		$item_class = ! empty( $item['class'] ) ? ' ' . sanitize_html_class( $item['class'] ) : '';
		$link_class = ! empty( $item['active'] ) ? ' aria-current="page"' : '';

		printf(
			'<li class="menu-item%1$s"><a href="%2$s"%3$s>%4$s</a></li>',
			esc_attr( $item_class ),
			esc_url( $item['url'] ),
			$link_class,
			esc_html( $item['label'] )
		);
	}

	echo '</ul>';
}

/**
 * Resolve the compact header eyebrow text.
 *
 * @return string
 */
function nexus_get_site_header_eyebrow() {
	$description = trim( (string) get_bloginfo( 'description' ) );

	if ( '' !== $description ) {
		return $description;
	}

	return __( 'WordPress Growth Architect', 'blocksy-child' );
}
