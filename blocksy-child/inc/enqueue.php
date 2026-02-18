<?php
/**
 * NEXUS Asset Management (CSS/JS Enqueue)
 *
 * Zentrale Registrierung aller Styles und Scripts.
 * Cache-Busting via filemtime(), kein Inline-CSS/JS in Templates.
 *
 * [Speed] Enqueue-Logik: Conditional Loading per Template/Seitentyp.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'hu_enqueue_assets', 20 );

/**
 * Enqueue all theme styles and scripts conditionally.
 *
 * @return void
 */
function hu_enqueue_assets() {
	// ── Q) Template: Alle Lösungen ───────────────────────────────
	if ( is_page_template( 'page-loesungen.php' ) ) {
		hu_enqueue_css( 'nexus-solutions-css', 'solutions.css', [ 'nexus-design-system' ] );
	}

	$css_dir = get_stylesheet_directory() . '/assets/css/';
	$css_uri = get_stylesheet_directory_uri() . '/assets/css/';
	$js_dir  = get_stylesheet_directory() . '/assets/js/';
	$js_uri  = get_stylesheet_directory_uri() . '/assets/js/';
	$queried_id = get_queried_object_id();
	$is_seo_cornerstone_template = $queried_id && 'page-seo-cornerstone.php' === get_page_template_slug( $queried_id );

	// ── Parent Theme ──────────────────────────────────────────────
	wp_enqueue_style(
		'blocksy-child-style',
		get_stylesheet_uri(),
		[],
		filemtime( get_stylesheet_directory() . '/style.css' )
	);

	// ── GLOBAL: Design System (Single Source of Truth) ─────────────
	hu_enqueue_css( 'nexus-design-system', 'design-system.css', [ 'blocksy-child-style' ] );

	// ── GLOBAL: Related Content (NEU POSITIONIERT) ────────────────
	// Damit das CSS auf ALLEN Seiten geladen wird (Startseite, Single Posts, Pages etc.)
	hu_enqueue_css( 'nexus-related-content-css', 'related-content.css', [ 'nexus-design-system' ] );

	// ── GLOBAL: Footer CTA (Pre-Footer) ───────────────────────────
	// Damit der Footer CTA auf allen Seiten gestylt wird
	hu_enqueue_css( 'nexus-footer-cta-css', 'footer-cta.css', [ 'nexus-design-system' ] );

	// ── GLOBAL: Core JS (Scroll-Spy, FAQ, Counter, Progress Bar) ──
	hu_enqueue_js( 'nexus-core-js', 'nexus-core.js' );

	// ── A) Startseite & Blog-Home ─────────────────────────────────
	if ( is_front_page() || is_home() ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-home-js', 'homepage.js', [ 'nexus-core-js' ] );
		hu_enqueue_js( 'nexus-home-mindmap-teaser-js', 'homepage-mindmap-teaser.js', [ 'nexus-home-js' ] );
	}

	// ── B) Blog-Archive Scripts ───────────────────────────────────
	if ( is_home() ) {
		hu_enqueue_js( 'nexus-archive-js', 'blog-archive.js', [ 'nexus-core-js' ] );
	}

	// ── C) Kategorie-Seiten (Pillar Hub) ──────────────────────────
	if ( is_category() ) {
		hu_enqueue_css( 'nexus-category-hub-css', 'category-hub.css', [ 'nexus-design-system' ] );
	}

	// ── C2) Sonstige Archiv-Seiten (Tag, Datum etc.) ──────────────
	if ( is_archive() && ! is_home() && ! is_category() ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
	}

	// ── D) Einzelbeitrag (Blog Post) ──────────────────────────────
	if ( is_singular( 'post' ) || $is_seo_cornerstone_template ) {
		hu_enqueue_css( 'nexus-single-css', 'single.css', [ 'nexus-design-system' ] );

		// Hide duplicate title from Blocksy (single posts + cornerstone template)
		wp_add_inline_style( 'blocksy-child-style', '
			.single-post .entry-header .entry-title,
			.single-post .ct-page-title,
			.page-template-page-seo-cornerstone .entry-header .entry-title,
			.page-template-page-seo-cornerstone .ct-page-title,
			.single-template-page-seo-cornerstone .entry-header .entry-title,
			.single-template-page-seo-cornerstone .ct-page-title {
				display: none !important;
			}
		' );
	}

	// ── E) Template: Über Mich ────────────────────────────────────
	if ( is_page_template( 'template-about.php' ) ) {
		hu_enqueue_css( 'nexus-about-css', 'about-page.css', [ 'nexus-design-system' ] );
	}

	// ── F) Template: Agentur Service ──────────────────────────────
	if ( is_page_template( 'page-wordpress-agentur.php' ) || is_page( 'wordpress-agentur' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-agentur-css', 'agentur.css', [ 'nexus-home-css' ] );
	}

	// ── G) Template: WGOS System ──────────────────────────────────
	if ( is_page_template( 'page-wgos.php' ) || is_page( 'wgos' ) || is_page( 'wordpress-growth-operating-system' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );
	}

	// ── H) Template: Customer Journey Audit ───────────────────────
	if ( is_page_template( 'page-audit.php' ) || is_page( 'audit' ) || is_page( 'customer-journey-audit' ) ) {
		hu_enqueue_css( 'nexus-audit-css', 'audit.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-audit-results-css', 'audit-results.css', [ 'nexus-audit-css' ] );
		hu_enqueue_js( 'nexus-audit-js', 'audit.js', [ 'nexus-core-js' ] );
		hu_enqueue_js( 'nexus-audit-live-js', 'audit-live.js', [ 'nexus-audit-js' ] );
	}

	// ── H2) Template: 360° Deep-Dive ─────────────────────────────
	if ( is_page_template( 'page-360-deep-dive.php' ) || is_page( '360-deep-dive' ) ) {
		hu_enqueue_css( 'nexus-audit-results-css', 'audit-results.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-deepdive-css', 'deep-dive.css', [ 'nexus-audit-results-css' ] );
	}

	// ── I) Template: SEO Landing (Hannover) ───────────────────────
	if ( is_page_template( 'page-seo.php' ) || is_page( 'seo' ) || is_page( 'wordpress-seo-hannover' ) ) {
		hu_enqueue_css( 'nexus-seo-css', 'seo.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-seo-js', 'seo.js', [ 'nexus-core-js' ] );
	}

	// ── I2) Template: SEO Cornerstone Artikel (Post + Page) ────────
	if ( $is_seo_cornerstone_template ) {
		hu_enqueue_css( 'nexus-seo-cornerstone-css', 'seo-cornerstone.css', [ 'nexus-single-css' ] );
	}

	// ── J) Template: Core Web Vitals ──────────────────────────────
	if ( is_page_template( 'page-cwv.php' ) || is_page( 'core-web-vitals' ) ) {
		hu_enqueue_css( 'nexus-cwv-css', 'cwv.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-cwv-js', 'cwv.js', [ 'nexus-core-js' ] );
	}

	// ── K) Template: Performance Marketing ────────────────────────
	if ( is_page_template( 'page-performance.php' ) || is_page( 'performance-marketing' ) ) {
		hu_enqueue_css( 'nexus-performance-css', 'performance.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-performance-js', 'performance.js', [ 'nexus-core-js' ] );
	}

	// ── L) Template: Conversion Rate Optimization (CRO) ──────────
	if ( is_page_template( 'page-cro.php' ) || is_page( 'conversion-rate-optimization' ) ) {
		hu_enqueue_css( 'nexus-cro-css', 'cro.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-cro-js', 'cro.js', [ 'nexus-core-js' ] );
	}

	// ── M) Template: GA4 & Tracking Setup ─────────────────────────
	if ( is_page_template( 'page-ga4.php' ) || is_page( 'ga4-tracking-setup' ) ) {
		hu_enqueue_css( 'nexus-ga4-css', 'ga4.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-ga4-js', 'ga4.js', [ 'nexus-core-js' ] );
	}

	// ── N) Template: Meta Ads (Facebook & Instagram) ──────────────
	if ( is_page_template( 'page-meta-ads.php' ) || is_page( 'meta-ads' ) ) {
		hu_enqueue_css( 'nexus-meta-ads-css', 'meta-ads.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-meta-ads-js', 'meta-ads.js', [ 'nexus-core-js' ] );
	}

	// ── O) Template: Kostenlose Tools Hub ─────────────────────────
	if ( is_page_template( 'page-tools.php' ) || is_page( 'tools' ) || is_page( 'kostenlose-tools' ) ) {
		hu_enqueue_css( 'nexus-tools-css', 'tools.css', [ 'nexus-design-system' ] );
	}

	// ── P) Template: Case Study – E3 New Energy ───────────────────
	if ( is_page_template( 'page-case-e3.php' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-case-study-css', 'case-study.css', [ 'nexus-home-css' ] );
	}
}

/**
 * Helper: Enqueue a CSS file with filemtime cache-busting.
 *
 * @param string $handle  Stylesheet handle.
 * @param string $file    Filename inside assets/css/.
 * @param array  $deps    Dependencies.
 * @return void
 */
function hu_enqueue_css( $handle, $file, $deps = [] ) {
	$path = get_stylesheet_directory() . '/assets/css/' . $file;
	if ( ! file_exists( $path ) ) {
		return;
	}
	wp_enqueue_style(
		$handle,
		get_stylesheet_directory_uri() . '/assets/css/' . $file,
		$deps,
		filemtime( $path )
	);
}

/**
 * Helper: Enqueue a JS file with filemtime cache-busting (footer, defer).
 *
 * @param string $handle  Script handle.
 * @param string $file    Filename inside assets/js/.
 * @param array  $deps    Dependencies.
 * @return void
 */
function hu_enqueue_js( $handle, $file, $deps = [] ) {
	$path = get_stylesheet_directory() . '/assets/js/' . $file;
	if ( ! file_exists( $path ) ) {
		return;
	}
	wp_enqueue_script(
		$handle,
		get_stylesheet_directory_uri() . '/assets/js/' . $file,
		$deps,
		filemtime( $path ),
		true
	);
}
