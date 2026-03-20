<?php
/**
 * Dynamic llms.txt route for AI agents and citation-oriented crawlers.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the canonical request path for llms.txt.
 *
 * @return string
 */
function nexus_get_llms_txt_request_path() {
	return trailingslashit( '/llms.txt' );
}

/**
 * Check whether the current request targets llms.txt.
 *
 * @return bool
 */
function nexus_is_llms_txt_request() {
	return nexus_get_current_request_path() === nexus_get_llms_txt_request_path();
}

/**
 * Build the markdown response for llms.txt from the primary public URL map.
 *
 * @return string
 */
function nexus_get_llms_txt_content() {
	$urls = function_exists( 'nexus_get_primary_public_url_map' ) ? nexus_get_primary_public_url_map() : [];
	$links = [
		'Startseite'                         => $urls['home'] ?? home_url( '/' ),
		'Growth Audit'                      => $urls['audit'] ?? home_url( '/growth-audit/' ),
		'WordPress Agentur Hannover'        => $urls['agentur'] ?? home_url( '/wordpress-agentur-hannover/' ),
		'WordPress Growth Operating System' => $urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' ),
		'Ergebnisse'                        => $urls['results'] ?? home_url( '/ergebnisse/' ),
		'Blog'                              => $urls['blog'] ?? home_url( '/blog/' ),
	];

	$lines = [
		'# Haşim Üner',
		'',
		'> WordPress Growth Architect für B2B in Hannover. Einstieg über den Growth Audit: Diagnose von SEO, Tracking, Core Web Vitals und Conversion-Reibung mit priorisierten nächsten Schritten statt isolierten Einzelmaßnahmen.',
		'',
		'## Wichtige URLs',
	];

	foreach ( $links as $label => $url ) {
		$path = wp_parse_url( (string) $url, PHP_URL_PATH );
		$path = is_string( $path ) && '' !== $path ? $path : '/';
		$path = '/' === $path ? '/' : trailingslashit( '/' . ltrim( $path, '/' ) );

		$lines[] = sprintf(
			'- [%1$s](%2$s)',
			(string) $label,
			$path
		);
	}

	return implode( "\n", $lines ) . "\n";
}

/**
 * Prevent canonical redirects from interfering with llms.txt.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function nexus_disable_canonical_redirect_for_llms_txt( $redirect_url ) {
	if ( nexus_is_llms_txt_request() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'nexus_disable_canonical_redirect_for_llms_txt' );

/**
 * Render the llms.txt payload directly from WordPress.
 *
 * @return void
 */
function nexus_render_llms_txt() {
	if ( is_admin() || wp_doing_ajax() || ! nexus_is_llms_txt_request() ) {
		return;
	}

	nocache_headers();
	status_header( 200 );
	header( 'Content-Type: text/plain; charset=' . get_option( 'blog_charset' ) );
	echo nexus_get_llms_txt_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit;
}
add_action( 'template_redirect', 'nexus_render_llms_txt', 0 );
