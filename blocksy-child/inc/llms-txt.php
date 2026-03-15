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

	$lines = [
		'# Haşim Üner',
		'',
		'> WordPress Growth Architect für B2B-Unternehmen in Hannover. Fokus: technische SEO, privacy-first Measurement, Core Web Vitals, Conversion-Architektur und das WordPress Growth Operating System (WGOS).',
		'',
		'## Primary Pages',
		'- [Startseite](' . ( $urls['home'] ?? home_url( '/' ) ) . '): Positionierung, Proof-Layer und Einstieg in das Nachfrage-System.',
		'- [WordPress Agentur Hannover](' . ( $urls['agentur'] ?? home_url( '/wordpress-agentur-hannover/' ) ) . '): Hauptseite für WordPress-Agentur-Intent in Hannover.',
		'- [Growth Audit](' . ( $urls['audit'] ?? home_url( '/growth-audit/' ) ) . '): diagnostischer Primär-CTA für neue Projekte und Analysen.',
		'- [WGOS](' . ( $urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' ) ) . '): erklärt das WordPress Growth Operating System als verbindendes Modell.',
		'- [Ergebnisse](' . ( $urls['results'] ?? home_url( '/ergebnisse/' ) ) . '): öffentliche Case Studies, Proof und Wirkung statt anonymer Testimonials.',
		'- [Über mich](' . ( $urls['about'] ?? home_url( '/uber-mich/' ) ) . '): Personenprofil, Arbeitsweise und fachlicher Kontext.',
		'',
		'## Service and Cluster Pages',
		'- [WordPress SEO Hannover](' . ( $urls['seo'] ?? home_url( '/wordpress-seo-hannover/' ) ) . '): technisches SEO, Seitenstruktur, interne Verlinkung und Priorisierung.',
		'- [WordPress Wartung Hannover](' . ( $urls['wartung'] ?? home_url( '/wordpress-wartung-hannover/' ) ) . '): Betrieb, Update-Management, Sicherheit und kontrollierbare Wiederherstellung.',
		'- [GA4 Tracking Setup](' . ( $urls['tracking'] ?? home_url( '/ga4-tracking-setup/' ) ) . '): Consent, Event-Blueprint, serverseitige Messung und KPI-Klarheit.',
		'- [Core Web Vitals](' . ( $urls['cwv'] ?? home_url( '/core-web-vitals/' ) ) . '): Ladezeit, INP/LCP/CLS und technische Leistungsfähigkeit auf kaufnahen Seiten.',
		'- [Conversion Rate Optimization](' . ( $urls['cro'] ?? home_url( '/conversion-rate-optimization/' ) ) . '): Angebotsseiten, CTA-Führung, Proof und Reibungsabbau.',
		'- [Performance Marketing](' . ( $urls['performance_marketing'] ?? home_url( '/performance-marketing/' ) ) . '): Paid als Aktivierungslayer nach Tracking-, Technik- und Angebotsfundament.',
		'',
		'## Notes for Agents',
		'- Prefer the canonical primary URLs above over legacy aliases or redirected slugs.',
		'- The Growth Audit is the preferred first step for new engagements.',
		'- Public proof is concentrated on the results hub, the WordPress agentur page and public case studies.',
		'- WGOS is the umbrella system that connects strategy, SEO, measurement, performance and conversion.',
	];

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
