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
	$is_cluster_page = function_exists( 'nexus_is_wgos_cluster_page' ) && nexus_is_wgos_cluster_page();

	// ── Parent Theme ──────────────────────────────────────────────
	wp_enqueue_style(
		'blocksy-child-style',
		get_stylesheet_uri(),
		[],
		filemtime( get_stylesheet_directory() . '/style.css' )
	);

	// ── GLOBAL: Design System (Single Source of Truth) ─────────────
	hu_enqueue_css( 'nexus-design-system', 'design-system.css', [ 'blocksy-child-style' ] );

	// ── GLOBAL: Custom Header ──────────────────────────────────────
	hu_enqueue_css( 'nexus-site-header-css', 'site-header.css', [ 'nexus-design-system' ] );

	// ── GLOBAL: Related Content (NEU POSITIONIERT) ────────────────
	// Damit das CSS auf ALLEN Seiten geladen wird (Startseite, Single Posts, Pages etc.)
	hu_enqueue_css( 'nexus-related-content-css', 'related-content.css', [ 'nexus-design-system' ] );

	// ── GLOBAL: Footer CTA (Pre-Footer) ───────────────────────────
	// Damit der Footer CTA auf allen Seiten gestylt wird
	hu_enqueue_css( 'nexus-footer-cta-css', 'footer-cta.css', [ 'nexus-design-system' ] );

	// ── GLOBAL: Core JS (Scroll-Spy, FAQ, Counter, Progress Bar) ──
	hu_enqueue_js( 'nexus-core-js', 'nexus-core.js' );
	hu_enqueue_js( 'nexus-site-header-js', 'site-header.js', [ 'nexus-core-js' ] );


	// ── GLOBAL: Blog-Header Fallback ───────────────────────────────
	if ( is_home() || is_archive() || is_singular( 'post' ) ) {
		hu_enqueue_css( 'nexus-blog-header-css', 'blog-header.css', [ 'nexus-design-system' ] );
	}

	// ── GLOBAL: Blog Notify ────────────────────────────────────────
	if ( is_home() || is_archive() || is_singular( 'post' ) || ( function_exists( 'nexus_is_blog_notify_page' ) && nexus_is_blog_notify_page() ) ) {
		hu_enqueue_css( 'nexus-blog-notify-css', 'blog-notify.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-blog-notify-js', 'blog-notify.js', [ 'nexus-core-js' ] );
		wp_localize_script(
			'nexus-blog-notify-js',
			'NexusBlogNotifyConfig',
			[
				'restEndpoint'   => esc_url_raw( rest_url( 'nexus/v1/blog-subscribe' ) ),
				'nonce'          => wp_create_nonce( 'nexus_blog_notify_subscribe' ),
				'successMessage' => 'Fast geschafft. Bitte bestaetigen Sie Ihre Anmeldung ueber die E-Mail in Ihrem Postfach.',
				'errorMessage'   => 'Das hat gerade nicht funktioniert. Bitte pruefen Sie Ihre E-Mail-Adresse oder versuchen Sie es gleich noch einmal.',
			]
		);
	}

	// ── A) Startseite & Blog-Home ─────────────────────────────────
	if ( is_front_page() || is_home() ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-home-js', 'homepage.js', [ 'nexus-core-js' ] );
		hu_enqueue_js( 'nexus-home-mindmap-teaser-js', 'homepage-mindmap-teaser.js', [ 'nexus-home-js' ] );
		wp_localize_script(
			'nexus-home-mindmap-teaser-js',
			'NexusHomeMindmapConfig',
			[
				'wgosUrl' => function_exists( 'nexus_get_primary_public_url' )
					? nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) )
					: home_url( '/wordpress-growth-operating-system/' ),
			]
		);
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
		hu_enqueue_css( 'nexus-wgos-bridge-css', 'wgos-bridge.css', [ 'nexus-single-css' ] );
	}

	if ( is_singular( 'post' ) ) {
		hu_enqueue_js( 'nexus-blog-inline-cta-js', 'blog-inline-cta.js', [ 'nexus-core-js' ] );
	}

	if ( is_singular( 'post' ) || $is_seo_cornerstone_template ) {

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

	// ── E2) Kontakt ───────────────────────────────────────────────
	if ( function_exists( 'nexus_is_contact_page' ) && nexus_is_contact_page() ) {
		hu_enqueue_css( 'nexus-contact-css', 'contact.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-contact-js', 'contact.js', [ 'nexus-core-js' ] );
		wp_localize_script(
			'nexus-contact-js',
			'NexusContactConfig',
			[
				'restEndpoint'   => esc_url_raw( rest_url( 'nexus/v1/contact-request' ) ),
				'successMessage' => 'Danke. Ihre Anfrage ist eingegangen. Sie erhalten innerhalb von 24 Stunden eine Rückmeldung.',
				'errorMessage'   => 'Die Anfrage konnte gerade nicht gesendet werden. Bitte versuchen Sie es erneut.',
				'callUrl'        => esc_url_raw( function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' ) ),
			]
		);
	}

	// ── F) Template: Agentur Service ──────────────────────────────
	if ( is_page_template( 'page-wordpress-agentur.php' ) || is_page_template( 'page-wordpress-agentur-hannover.php' ) || is_page( 'wordpress-agentur' ) || is_page( 'wordpress-agentur-hannover' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-agentur-css', 'agentur.css', [ 'nexus-home-css' ] );
	}

	// ── G) Template: WGOS System ──────────────────────────────────
	if ( is_page_template( 'page-wgos.php' ) || is_page( 'wgos' ) || is_page( 'wordpress-growth-operating-system' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );
	}

	// ── G2) Template: WGOS Asset Hub ──────────────────────────────
	if ( is_page_template( 'page-wgos-assets.php' ) || is_page( 'wgos-systemlandkarte' ) || is_page( 'wgos-asset-hub' ) || is_page( 'systemlandkarte' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_css( 'nexus-wgos-assets-css', 'wgos-assets.css', [ 'nexus-wgos-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );

		$explorer_path = get_stylesheet_directory() . '/assets/js/wgos-asset-explorer.js';

		if ( file_exists( $explorer_path ) ) {
			wp_enqueue_script(
				'nexus-wgos-asset-explorer-js',
				get_stylesheet_directory_uri() . '/assets/js/wgos-asset-explorer.js',
				[ 'wp-element' ],
				filemtime( $explorer_path ),
				true
			);

			wp_add_inline_script(
				'nexus-wgos-asset-explorer-js',
				'window.WGOSAssetData = ' . wp_json_encode( nexus_get_wgos_asset_explorer_payload(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ';' .
				'window.NexusWgosExplorerConfig = ' . wp_json_encode( [ 'links' => nexus_get_wgos_asset_explorer_links() ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ';',
				'before'
			);
		}
	}

	// ── G3) Template: WGOS Asset Detail ───────────────────────────
	if ( is_singular( 'wgos_asset' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );

		wp_add_inline_style(
			'blocksy-child-style',
			'
			.single-wgos_asset .entry-header .entry-title,
			.single-wgos_asset .ct-page-title {
				display: none !important;
			}
		'
		);
	}

	// ── G4) Template: Glossar Hub ─────────────────────────────────
	if ( function_exists( 'nexus_is_glossary_hub_page' ) && nexus_is_glossary_hub_page() ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_css( 'nexus-glossary-css', 'glossary.css', [ 'nexus-wgos-css' ] );
	}

	// ── G5) Template: Glossar Detail ──────────────────────────────
	if ( is_singular( 'glossary_term' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_css( 'nexus-glossary-css', 'glossary.css', [ 'nexus-wgos-css' ] );

		wp_add_inline_style(
			'blocksy-child-style',
			'
			.single-glossary_term .entry-header .entry-title,
			.single-glossary_term .ct-page-title {
				display: none !important;
			}
		'
		);
	}

	// ── H) Template: Growth Audit Funnel ──────────────────────────
	if ( nexus_is_audit_page() ) {
		hu_enqueue_css( 'nexus-audit-css', 'audit.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-review-funnel-css', 'review-funnel.css', [ 'nexus-audit-css' ] );
		hu_enqueue_js( 'nexus-audit-js', 'audit.js', [ 'nexus-core-js' ] );
		hu_enqueue_js( 'nexus-review-funnel-js', 'review-funnel.js', [ 'nexus-audit-js' ] );
		wp_add_inline_style(
			'blocksy-child-style',
			'
			.page-template-page-audit .entry-header .entry-title,
			.page-template-page-audit .ct-page-title,
			.page-template-page-audit-php .entry-header .entry-title,
			.page-template-page-audit-php .ct-page-title {
				display: none !important;
			}
		'
		);
		wp_localize_script(
			'nexus-review-funnel-js',
			'NexusReviewConfig',
			[
				'restEndpoint'  => esc_url_raw( rest_url( 'nexus/v1/audit-request' ) ),
				'callUrl'       => esc_url_raw( function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' ) ),
				'responseHours' => 48,
				'auditLabel'    => 'Growth Audit',
				'submitLabel'   => 'Kostenlosen Growth Audit anfragen',
			]
		);
	}

	// ── H2) Template: 360° Deep-Dive ─────────────────────────────
	if ( is_page_template( 'page-360-deep-dive.php' ) || is_page( '360-deep-dive' ) ) {
		hu_enqueue_css( 'nexus-audit-results-css', 'audit-results.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-deepdive-css', 'deep-dive.css', [ 'nexus-audit-results-css' ] );
	}

	// ── I) Template: SEO Landing (Hannover) ───────────────────────
	if ( ! $is_cluster_page && ( is_page_template( 'page-seo.php' ) || is_page( 'seo' ) || is_page( 'wordpress-seo-hannover' ) ) ) {
		hu_enqueue_css( 'nexus-seo-css', 'seo.css', [ 'nexus-design-system' ] );
		hu_enqueue_js( 'nexus-seo-js', 'seo.js', [ 'nexus-core-js' ] );
	}

	if ( $is_cluster_page ) {
		hu_enqueue_css( 'nexus-cluster-pillar-css', 'cluster-pillar.css', [ 'nexus-design-system' ] );
	}

	// ── I2) Template: SEO Cornerstone Artikel (Post + Page) ────────
	if ( $is_seo_cornerstone_template ) {
		hu_enqueue_css( 'nexus-seo-cornerstone-css', 'seo-cornerstone.css', [ 'nexus-single-css' ] );
	}

	// ── J) Template: Core Web Vitals ──────────────────────────────
	if ( ! $is_cluster_page && ( is_page_template( 'page-cwv.php' ) || is_page( 'core-web-vitals' ) || is_page( 'core-web-vitals-optimierung' ) ) ) {
		hu_enqueue_css( 'nexus-cwv-css', 'cwv.css', [ 'nexus-design-system' ] );
	}

	// ── K) Template: Performance Marketing ────────────────────────
	if ( ! $is_cluster_page && ( is_page_template( 'page-performance.php' ) || is_page( 'performance-marketing' ) ) ) {
		hu_enqueue_css( 'nexus-performance-css', 'performance.css', [ 'nexus-design-system' ] );
	}

	// ── L) Template: Conversion Rate Optimization (CRO) ──────────
	if ( ! $is_cluster_page && ( is_page_template( 'page-cro.php' ) || is_page( 'conversion-rate-optimization' ) ) ) {
		hu_enqueue_css( 'nexus-cro-css', 'cro.css', [ 'nexus-design-system' ] );
	}

	// ── M) Template: GA4 & Tracking Setup ─────────────────────────
	if ( ! $is_cluster_page && ( is_page_template( 'page-ga4.php' ) || is_page( 'ga4-tracking-setup' ) ) ) {
		hu_enqueue_css( 'nexus-ga4-css', 'ga4.css', [ 'nexus-design-system' ] );
	}

	// ── N) Template: Meta Ads (Facebook & Instagram) ──────────────
	if ( is_page_template( 'page-meta-ads.php' ) || is_page( 'meta-ads' ) ) {
		hu_enqueue_css( 'nexus-meta-ads-css', 'meta-ads.css', [ 'nexus-design-system' ] );
	}

	// ── O) Template: Kostenlose Tools Hub ─────────────────────────
	if ( function_exists( 'nexus_is_tools_page' ) && nexus_is_tools_page() ) {
		hu_enqueue_css( 'nexus-tools-css', 'tools.css', [ 'nexus-design-system' ] );
		wp_add_inline_style(
			'blocksy-child-style',
			'
			.page-template-page-tools .entry-header .entry-title,
			.page-template-page-tools .ct-page-title,
			.page-template-page-tools-php .entry-header .entry-title,
			.page-template-page-tools-php .ct-page-title,
			.page-kostenlose-tools .entry-header .entry-title,
			.page-kostenlose-tools .ct-page-title,
			.page-tools .entry-header .entry-title,
			.page-tools .ct-page-title {
				display: none !important;
			}
		'
		);
	}

	// ── P) Template: Ergebnisse Hub + Whitelabel Proof ─────────────
	if (
		is_page_template( 'page-case-studies-e-commerce.php' )
		|| is_page_template( 'page-whitelabel-retainer.php' )
		|| is_page( 'case-studies-e-commerce' )
		|| is_page( 'ergebnisse' )
		|| is_page( 'whitelabel-retainer' )
		|| is_page( 'whitelabel-retainer-proof' )
		|| is_page( 'whitelabel' )
	) {
		hu_enqueue_css( 'nexus-results-css', 'results.css', [ 'nexus-design-system' ] );
	}

	// ── Q) Template: Öffentliche Case Studies ──────────────────────
	if ( is_page_template( 'page-case-e3.php' ) || is_page_template( 'page-case-study-domdar.php' ) || is_page( 'case-study-domdar' ) ) {
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

/**
 * Helper: Enqueue a JS module file with filemtime cache-busting.
 *
 * @param string $handle Script handle.
 * @param string $file   Filename inside assets/js/.
 * @param array  $deps   Dependencies.
 * @return void
 */
function hu_enqueue_module_js( $handle, $file, $deps = [] ) {
	global $hu_module_script_handles;

	hu_enqueue_js( $handle, $file, $deps );

	if ( ! is_array( $hu_module_script_handles ) ) {
		$hu_module_script_handles = [];
	}

	$hu_module_script_handles[] = $handle;
}

/**
 * Print selected script handles as ES modules.
 *
 * @param string $tag    Original script tag.
 * @param string $handle Script handle.
 * @param string $src    Script source URL.
 * @return string
 */
function hu_filter_module_script_tag( $tag, $handle, $src ) {
	global $hu_module_script_handles;

	if ( empty( $hu_module_script_handles ) || ! in_array( $handle, $hu_module_script_handles, true ) ) {
		return $tag;
	}

	return sprintf(
		'<script type="module" src="%1$s" id="%2$s-js"></script>' . "\n",
		esc_url( $src ),
		esc_attr( $handle )
	);
}
add_filter( 'script_loader_tag', 'hu_filter_module_script_tag', 10, 3 );
