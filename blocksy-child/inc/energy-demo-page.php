<?php
/**
 * EnergieFahrplan demo route and template fallback.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the canonical request path for the EnergieFahrplan demo.
 *
 * @return string
 */
function hu_get_energy_demo_request_path() {
	return trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/energie-fahrplan-demo/' ), PHP_URL_PATH ), '/' ) );
}

/**
 * Check whether the current request targets the demo route.
 *
 * @return bool
 */
function hu_is_energy_demo_request_path() {
	return function_exists( 'nexus_get_current_request_path' ) && nexus_get_current_request_path() === hu_get_energy_demo_request_path();
}

/**
 * Prevent canonical redirects from fighting the virtual demo route.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function hu_disable_canonical_redirect_for_energy_demo( $redirect_url ) {
	if ( hu_is_energy_demo_request_path() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'hu_disable_canonical_redirect_for_energy_demo' );

/**
 * Turn /energie-fahrplan-demo/ into a virtual page when no WP page owns the slug.
 *
 * @param bool     $preempt Existing preempt flag.
 * @param WP_Query $wp_query Current query.
 * @return bool
 */
function hu_preempt_energy_demo_404( $preempt, $wp_query ) {
	if ( is_admin() || wp_doing_ajax() || ! ( $wp_query instanceof WP_Query ) ) {
		return $preempt;
	}

	if ( ! hu_is_energy_demo_request_path() || ! HU_FEATURE_ENERGY_DEMO_ROUTE ) {
		return $preempt;
	}

	$wp_query->is_404            = false;
	$wp_query->is_page           = true;
	$wp_query->is_singular       = true;
	$wp_query->is_home           = false;
	$wp_query->is_archive        = false;
	$wp_query->is_posts_page     = false;
	$wp_query->queried_object    = null;
	$wp_query->queried_object_id = 0;
	$wp_query->query_vars['pagename'] = 'energie-fahrplan-demo';
	unset( $wp_query->query['error'], $wp_query->query_vars['error'] );

	status_header( 200 );

	return true;
}
add_filter( 'pre_handle_404', 'hu_preempt_energy_demo_404', 10, 2 );

/**
 * Use the native demo template for the virtual route and real WP page.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function hu_use_virtual_energy_demo_template( $template ) {
	if ( ! hu_is_energy_demo_request_path() || ! HU_FEATURE_ENERGY_DEMO_ROUTE ) {
		return $template;
	}

	$virtual_template = get_stylesheet_directory() . '/page-energie-fahrplan-demo.php';

	if ( file_exists( $virtual_template ) ) {
		return $virtual_template;
	}

	return $template;
}
add_filter( 'template_include', 'hu_use_virtual_energy_demo_template', 99 );

/**
 * Remove 404 body classes for the virtual demo route.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function hu_add_virtual_energy_demo_body_class( $classes ) {
	if ( ! hu_is_energy_demo_request_path() ) {
		return $classes;
	}

	$classes   = array_diff( $classes, [ 'error404' ] );
	$classes[] = 'page';
	$classes[] = 'page-energie-fahrplan-demo';
	$classes[] = 'page-template-page-energie-fahrplan-demo';

	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'hu_add_virtual_energy_demo_body_class', 20 );
