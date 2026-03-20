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

	// ── GLOBAL: Core JS (Scroll-Spy, FAQ, Counter, Progress Bar) ──
	hu_enqueue_js( 'nexus-core-js', 'nexus-core.js' );
	hu_enqueue_js( 'nexus-site-header-js', 'site-header.js', [ 'nexus-core-js' ] );

	$calendar_embed = function_exists( 'nexus_get_audit_calendar_embed_config' ) ? nexus_get_audit_calendar_embed_config() : [];

	if ( ! empty( $calendar_embed['origin'] ) && ! empty( $calendar_embed['cal_link'] ) && ! empty( $calendar_embed['url'] ) ) {
		hu_enqueue_js( 'nexus-cal-embed-js', 'cal-embed.js', [ 'nexus-core-js' ] );
		wp_localize_script(
			'nexus-cal-embed-js',
			'NexusCalEmbedConfig',
			[
				'bookingUrl'     => esc_url_raw( (string) $calendar_embed['url'] ),
				'calOrigin'      => esc_url_raw( (string) $calendar_embed['origin'] ),
				'calLink'        => sanitize_text_field( (string) $calendar_embed['cal_link'] ),
				'bookingLinks'   => array_values(
					array_filter(
						array_map(
							static function ( $entry ) {
								if ( ! is_array( $entry ) ) {
									return null;
								}

								$url      = isset( $entry['url'] ) ? esc_url_raw( (string) $entry['url'] ) : '';
								$cal_link = isset( $entry['cal_link'] ) ? sanitize_text_field( (string) $entry['cal_link'] ) : '';

								if ( '' === $url || '' === $cal_link ) {
									return null;
								}

								return [
									'url'      => $url,
									'calLink'  => $cal_link,
								];
							},
							(array) ( $calendar_embed['booking_links'] ?? [] )
						)
					)
				),
				'namespace'      => 'nexus-audit-call',
				'embedScriptUrl' => esc_url_raw( 'https://app.cal.com/embed/embed.js' ),
			]
		);
	}


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
				'successMessage' => 'Fast geschafft. Bitte bestätigen Sie Ihre Anmeldung über die E-Mail in Ihrem Postfach.',
				'errorMessage'   => 'Das hat gerade nicht funktioniert. Bitte prüfen Sie Ihre E-Mail-Adresse oder versuchen Sie es gleich noch einmal.',
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
		hu_enqueue_css( 'nexus-blog-archive-css', 'blog-archive.css', [ 'nexus-design-system' ] );
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
		hu_enqueue_css( 'nexus-related-content-css', 'related-content.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-footer-cta-css', 'footer-cta.css', [ 'nexus-design-system' ] );
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
		$contact_requested_type = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : '';
		$contact_type_options   = function_exists( 'nexus_get_contact_request_type_options' ) ? nexus_get_contact_request_type_options() : [];
		$contact_is_scoped_landing = in_array( $contact_requested_type, [ 'audit', 'analysis', 'implementation', 'ongoing' ], true )
			&& isset( $contact_type_options[ $contact_requested_type ] );

		wp_localize_script(
			'nexus-contact-js',
			'NexusContactConfig',
			[
				'restEndpoint'     => esc_url_raw( rest_url( 'nexus/v1/contact-request' ) ),
				'successMessage'   => 'Danke. Ihre Anfrage ist eingegangen. Sie erhalten innerhalb von 24 Stunden eine Rückmeldung.',
				'errorMessage'     => 'Die Anfrage konnte gerade nicht gesendet werden. Bitte versuchen Sie es erneut.',
				'callUrl'          => esc_url_raw( function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' ) ),
				'isScopedLanding'  => $contact_is_scoped_landing,
			]
		);
	}

	// ── F) Template: Agentur Service ──────────────────────────────
	if ( is_page_template( 'page-wordpress-agentur.php' ) || is_page_template( 'page-wordpress-agentur-hannover.php' ) || is_page( 'wordpress-agentur' ) || is_page( 'wordpress-agentur-hannover' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-agentur-css', 'agentur.css', [ 'nexus-home-css' ] );
	}

	// ── F1) Template: Energy Systems Landing ──────────────────────
	if ( is_page( 'solar-waermepumpen-leadgenerierung' ) || is_page( 'website-fuer-solar-und-waermepumpen-anbieter' ) || is_page_template( 'page-solar-waermepumpen-leadgenerierung.php' ) || is_page_template( 'page-website-fuer-solar-und-waermepumpen-anbieter.php' ) ) {
		hu_enqueue_css( 'nexus-review-funnel-css', 'review-funnel.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-energy-systems-css', 'energy-systems.css', [ 'nexus-review-funnel-css' ] );
		hu_enqueue_js( 'nexus-energy-intake-js', 'energy-intake.js', [ 'nexus-core-js' ] );
		wp_localize_script(
			'nexus-energy-intake-js',
			'NexusEnergyFormConfig',
			[
				'restEndpoint' => esc_url_raw( rest_url( 'nexus/v1/audit-request' ) ),
				'submitLabel'  => 'Growth Audit passend einordnen',
				'errorMessage' => 'Die Anfrage konnte gerade nicht gesendet werden. Bitte versuchen Sie es erneut.',
			]
		);
	}

	// ── G) Template: WGOS System ──────────────────────────────────
	if ( is_page_template( 'page-wgos.php' ) || is_page( 'wgos' ) || is_page( 'wordpress-growth-operating-system' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );
	}

	// ── G1b) Template: KI-Integration Dachseite ──────────────────
	if ( is_page_template( 'page-ki-integration.php' ) || is_page( 'ki-integration-wordpress' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );

		wp_add_inline_style(
			'blocksy-child-style',
			'
			.page-template-page-ki-integration .entry-header .entry-title,
			.page-template-page-ki-integration .ct-page-title,
			.page-template-page-ki-integration-php .entry-header .entry-title,
			.page-template-page-ki-integration-php .ct-page-title,
			.page-ki-integration-wordpress .entry-header .entry-title,
			.page-ki-integration-wordpress .ct-page-title {
				display: none !important;
			}
		'
		);
	}

	// ── G2) Template: WGOS Asset Hub ──────────────────────────────
	if ( is_page_template( 'page-wgos-assets.php' ) || is_page( 'wgos-systemlandkarte' ) || is_page( 'wgos-asset-hub' ) || is_page( 'systemlandkarte' ) ) {
		hu_enqueue_css( 'nexus-home-css', 'homepage.css', [ 'nexus-design-system' ] );
		hu_enqueue_css( 'nexus-wgos-css', 'wgos.css', [ 'nexus-home-css' ] );
		hu_enqueue_css( 'nexus-wgos-assets-css', 'wgos-assets.css', [ 'nexus-wgos-css' ] );
		hu_enqueue_js( 'nexus-wgos-js', 'wgos.js', [ 'nexus-core-js' ] );

		$explorer_path = get_stylesheet_directory() . '/assets/js/wgos-asset-explorer.js';

		if ( file_exists( $explorer_path ) ) {
			hu_enqueue_js( 'nexus-wgos-asset-explorer-js', 'wgos-asset-explorer.js', [ 'wp-element' ] );

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
			/* Hide Blocksy page title/header on audit page */
			.page-template-page-audit .entry-header,
			.page-template-page-audit .ct-page-title,
			.page-template-page-audit-php .entry-header,
			.page-template-page-audit-php .ct-page-title {
				display: none !important;
			}

			/*
			 * Blocksy Container Breakout
			 * .audit-wrapper is ALWAYS in the HTML (from audit-page-shell.php).
			 * These rules work regardless of whether page-audit.php template
			 * loads or Blocksy falls back to the_content() rendering.
			 */

			/* Break .audit-wrapper out of any restrictive parent container */
			.audit-wrapper {
				width: 100vw !important;
				max-width: 100vw !important;
				margin-left: calc(-50vw + 50%) !important;
				margin-right: 0 !important;
				padding-left: 0 !important;
				padding-right: 0 !important;
				box-sizing: border-box !important;
			}

			/* Remove constraints from every ancestor up to body */
			.page-template-page-audit .site-main,
			.page-template-page-audit .ct-container,
			.page-template-page-audit .content-area,
			.page-template-page-audit .entry-content,
			.page-template-page-audit-php .site-main,
			.page-template-page-audit-php .ct-container,
			.page-template-page-audit-php .content-area,
			.page-template-page-audit-php .entry-content {
				max-width: none !important;
				padding-left: 0 !important;
				padding-right: 0 !important;
				margin-left: 0 !important;
				margin-right: 0 !important;
				width: 100% !important;
				overflow: visible !important;
			}
			.page-template-page-audit .ct-container,
			.page-template-page-audit-php .ct-container {
				display: block !important;
			}

			/* Also target by slug body class (always present) */
			body.page-growth-audit .site-main,
			body.page-growth-audit .ct-container,
			body.page-growth-audit .content-area,
			body.page-growth-audit .entry-content {
				max-width: none !important;
				padding-left: 0 !important;
				padding-right: 0 !important;
				margin-left: 0 !important;
				margin-right: 0 !important;
				width: 100% !important;
				overflow: visible !important;
			}
			body.page-growth-audit .ct-container {
				display: block !important;
			}
			body.page-growth-audit .entry-header {
				display: none !important;
			}
		'
		);
		// Problem-Sektion (#lead-loss): Bulletproof-Inline-CSS auf blocksy-child-style
		// (lädt IMMER) mit harten Fallback-Werten für jede CSS-Variable.
		// Damit funktioniert die Problem-Sektion unabhängig davon, ob externe
		// CSS-Dateien gecacht, kombiniert oder verzögert geladen werden.
		wp_add_inline_style(
			'blocksy-child-style',
			'
			.review-problem-shell {
				padding: clamp(1.45rem, 3vw, 2.1rem) !important;
				border-radius: 28px !important;
				border: 1px solid var(--audit-border-strong, hsl(30 3% 18%)) !important;
				background: linear-gradient(180deg, hsla(8,82%,64%,0.06), transparent 28%), var(--audit-glass, linear-gradient(180deg, hsl(0 0% 100% / 0.045), hsl(30 10% 100% / 0.04))) !important;
				box-shadow: var(--audit-shadow-card, 0 8px 24px hsl(30 25% 2% / 0.42)) !important;
			}
			.review-problem-shell .review-section-head h2 {
				font-size: clamp(1.65rem, 3vw, 2.3rem) !important;
				font-weight: 360 !important;
				line-height: 1.14 !important;
				letter-spacing: -0.02em !important;
				margin: 0 0 0.7rem !important;
			}
			.review-problem-solution-grid {
				display: grid !important;
				grid-template-columns: 1.15fr 0.85fr !important;
				gap: clamp(1.5rem, 3vw, 2.5rem) !important;
				align-items: start !important;
				margin-top: clamp(1.5rem, 3vw, 2.5rem) !important;
			}
			.review-problem-grid {
				display: grid !important;
				grid-template-columns: 1fr !important;
				gap: 0.75rem !important;
			}
			.review-problem-card {
				padding: 0.85rem 1rem !important;
				border-radius: 14px !important;
				border: 1px solid var(--border, hsl(30 4% 13%)) !important;
				background: var(--audit-surface, linear-gradient(180deg, hsl(30 5% 9% / 0.92), hsl(30 6% 6% / 0.98))) !important;
				box-shadow: var(--audit-shadow-card, 0 8px 24px hsl(30 25% 2% / 0.42)) !important;
			}
			.review-problem-card h3 {
				margin: 0.4rem 0 0.35rem !important;
				padding: 0 !important;
				font-size: 0.92rem !important;
				font-weight: 700 !important;
				line-height: 1.35 !important;
				color: var(--text-main, hsl(30 4% 90%)) !important;
			}
			.review-problem-card p {
				margin: 0 !important;
				padding: 0 !important;
				font-size: 0.88rem !important;
				line-height: 1.62 !important;
				color: var(--audit-text-soft, hsl(30 3% 58%)) !important;
			}
			.review-problem-index {
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				width: 1.6rem !important;
				height: 1.6rem !important;
				border-radius: 999px !important;
				border: 1px solid hsla(8,82%,64%,0.24) !important;
				background: hsla(8,82%,64%,0.1) !important;
				color: var(--red, hsl(8 82% 64%)) !important;
				font-size: 0.7rem !important;
				font-weight: 800 !important;
			}
			.review-flow-strip--system {
				display: grid !important;
				grid-template-columns: 1fr !important;
				gap: 0.85rem !important;
				padding: clamp(1rem, 2vw, 1.5rem) !important;
				border-radius: 20px !important;
			}
			.review-flow-step {
				display: grid !important;
				grid-template-columns: auto 1fr !important;
				gap: 0.75rem !important;
				align-items: start !important;
				padding: 0.95rem 1rem !important;
				border: 1px solid var(--border, hsl(30 4% 13%)) !important;
				border-radius: 18px !important;
				background: linear-gradient(180deg, hsla(23,50%,47%,0.08), transparent 32%), var(--audit-glass, linear-gradient(180deg, hsl(0 0% 100% / 0.045), hsl(30 10% 100% / 0.04))) !important;
				box-shadow: var(--audit-shadow-card, 0 8px 24px hsl(30 25% 2% / 0.42)) !important;
			}
			.review-flow-step-index {
				display: inline-flex !important;
				align-items: center !important;
				justify-content: center !important;
				width: 2rem !important;
				height: 2rem !important;
				border-radius: 999px !important;
				background: var(--audit-accent-soft, hsl(23 50% 47% / 0.1)) !important;
				border: 1px solid var(--audit-border-accent, hsl(23 50% 47% / 0.28)) !important;
				color: var(--gold, #b46a3c) !important;
				font-size: 0.8rem !important;
				font-weight: 800 !important;
			}
			.review-flow-step-copy {
				display: grid !important;
				gap: 0.18rem !important;
			}
			.review-flow-step-copy strong {
				color: var(--text-main, hsl(30 4% 90%)) !important;
				font-size: 0.92rem !important;
				font-weight: 700 !important;
			}
			.review-flow-step-copy span {
				color: var(--audit-text-soft, hsl(30 3% 58%)) !important;
				font-size: 0.85rem !important;
			}
			@media (max-width: 860px) {
				.review-problem-solution-grid {
					grid-template-columns: 1fr !important;
				}
			}
			@media (max-width: 720px) {
				.review-problem-shell,
				.review-problem-card {
					padding: 1.15rem !important;
				}
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
 * Disable core block styles on the fully versioned homepage.
 *
 * The homepage is rendered from PHP templates and does not need the global
 * block library in its critical rendering path.
 *
 * @return void
 */
function hu_disable_core_block_styles_on_homepage() {
	if ( is_admin() || ! is_front_page() ) {
		return;
	}

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'hu_disable_core_block_styles_on_homepage', 100 );

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

	hu_mark_script_for_defer( $handle );
}

/**
 * Return theme script handles that should stay blocking/immediate.
 *
 * Keep core boot logic and the global header runtime outside the defer path.
 *
 * @return array<int, string>
 */
function hu_get_non_deferred_script_handles() {
	$handles = apply_filters(
		'hu_non_deferred_script_handles',
		[
			'nexus-core-js',
			'nexus-site-header-js',
		]
	);

	$handles = array_filter(
		array_map(
			static function ( $handle ) {
				return sanitize_key( (string) $handle );
			},
			(array) $handles
		)
	);

	return array_values( array_unique( $handles ) );
}

/**
 * Check whether a theme script should receive defer.
 *
 * @param string $handle Script handle.
 * @return bool
 */
function hu_should_defer_script( $handle ) {
	$handle = sanitize_key( (string) $handle );

	if ( '' === $handle || 0 !== strpos( $handle, 'nexus-' ) ) {
		return false;
	}

	return ! in_array( $handle, hu_get_non_deferred_script_handles(), true );
}

/**
 * Mark a script handle for deferred loading with a WordPress strategy plus fallback.
 *
 * @param string $handle Script handle.
 * @return void
 */
function hu_mark_script_for_defer( $handle ) {
	global $hu_deferred_script_handles;

	if ( ! hu_should_defer_script( $handle ) ) {
		return;
	}

	if ( ! is_array( $hu_deferred_script_handles ) ) {
		$hu_deferred_script_handles = [];
	}

	$hu_deferred_script_handles[] = sanitize_key( (string) $handle );
	$hu_deferred_script_handles   = array_values( array_unique( $hu_deferred_script_handles ) );

	wp_script_add_data( $handle, 'strategy', 'defer' );
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
	global $hu_deferred_script_handles, $hu_module_script_handles;

	if ( empty( $hu_module_script_handles ) || ! in_array( $handle, $hu_module_script_handles, true ) ) {
		if ( empty( $hu_deferred_script_handles ) || ! in_array( $handle, $hu_deferred_script_handles, true ) ) {
			return $tag;
		}

		if ( false !== strpos( $tag, ' defer' ) || false !== strpos( $tag, ' async' ) ) {
			return $tag;
		}

		return preg_replace( '/<script\b/', '<script defer', $tag, 1 ) ?: $tag;
	}

	return sprintf(
		'<script type="module" src="%1$s" id="%2$s-js"></script>' . "\n",
		esc_url( $src ),
		esc_attr( $handle )
	);
}
add_filter( 'script_loader_tag', 'hu_filter_module_script_tag', 10, 3 );
