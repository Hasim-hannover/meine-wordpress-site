<?php
/**
 * Blocksy Child – Growth Architect Edition
 *
 * Schlank: nur require-Aufrufe nach inc/.
 * Structure Layer im Repo → Content Layer im Editor.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ── 1. MODULE LADEN (inc/) ────────────────────────────────────────
$inc_dir = get_stylesheet_directory() . '/inc/';

$modules = [
	'helpers.php',        // Utility-Funktionen (muss zuerst geladen werden)
	'mail.php',           // Zentraler Brevo-Mail-Router für Transaktionsmails
	'crm.php',            // Gemeinsame CRM-Grundlage für Kontakte, Blog-Abos und Projektanfragen
	'wgos-assets.php',    // CPT + Helper für WGOS Asset-Spokes
	'wgos-asset-registry.php', // Versionierte WGOS Asset-Registry + Sync
	'glossary.php',       // Glossar-Hub + CPT für definitorische Begriffe
	'glossary-registry.php', // Versionierte Glossar-Registry + Sync
	'wgos-cluster-pages.php', // Versionierte Cluster-/Pillar-Pages und Blog-Asset-Bridges
	'acf.php',            // ACF Feldgruppen-Registrierung (SEO, KPI, Comparison)
	'audit-page.php',     // Audit-Shell-Fallback für die Audit-Landing-Page
	'tools-page.php',     // Versionierter Tools-Hub + Fallback für die Tools-Seite
	'header.php',         // Eigener globaler Header + Navigation
	'review-crm.php',     // Growth-Audit-Intake + WordPress CRM
	'contact-page.php',   // Kontakt-Route, schlanke Kontaktform und Mailversand
	'blog-notify.php',    // Blog-Benachrichtigungen, DOI und Artikel-Mails
	'llms-txt.php',       // Dynamische /llms.txt-Route für KI-Agenten und Entitätskontext
	'seo-cockpit.php',    // Search Console basiertes SEO-Cockpit mit optionaler Koko-Erkennung
	'enqueue.php',        // CSS/JS Asset-Management
	'seo-meta.php',       // OG Tags, Canonical, Indexierungssteuerung
	'org-schema.php',     // JSON-LD Structured Data
	'shortcodes.php',     // Startseiten-Shortcodes
	'client-portal.php',  // Client Portal Dashboard
	'admin-manager.php',  // Backend-Felder für Portal
	'snippets.php',       // Nav Button, Security, Login-Redirect
	'menu-setup.php',     // Hauptmenü-Struktur (einmalig)
];

foreach ( $modules as $module ) {
	$path = $inc_dir . $module;
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

// ── 1b. MENÜ-SLOT: POSITIONIERTES HAUPTMENÜ ──────────────────────
add_action( 'after_setup_theme', 'blocksy_child_register_slim_nav_menu', 20 );
function blocksy_child_register_slim_nav_menu() {
	register_nav_menus(
		array(
			'primary-slim' => __( 'Hauptmenü Slim (Positioniert)', 'blocksy-child' ),
		)
	);
}

// ── 2. TYPOGRAFIE & BRANDING: SELF-HOSTED FONTS ──────────────────
add_action( 'wp_enqueue_scripts', 'theme_self_hosted_fonts', 1 );
function theme_self_hosted_fonts() {
	$fonts_css_path = get_stylesheet_directory() . '/fonts.css';

	if ( ! file_exists( $fonts_css_path ) ) {
		return;
	}

	wp_enqueue_style(
		'self-hosted-fonts',
		get_stylesheet_directory_uri() . '/fonts.css',
		array(),
		filemtime( $fonts_css_path )
	);
}

add_action( 'wp_head', 'hu_preload_self_hosted_fonts', 1 );
function hu_preload_self_hosted_fonts() {
	$font_dir = get_stylesheet_directory();
	$font_uri = get_stylesheet_directory_uri() . '/fonts';

	if ( file_exists( $font_dir . '/fonts/Satoshi-Variable.woff2' ) ) {
		printf(
			'<link rel="preload" href="%s/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( $font_uri )
		);
	}

	if ( file_exists( $font_dir . '/fonts/figtree-400.woff2' ) ) {
		printf(
			'<link rel="preload" href="%s/figtree-400.woff2" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( $font_uri )
		);
	}
}

add_action( 'wp_enqueue_scripts', 'remove_google_fonts', 100 );
function remove_google_fonts() {
	global $wp_styles;

	wp_deregister_style( 'google-fonts' );
	wp_dequeue_style( 'google-fonts' );
	wp_deregister_style( 'blocksy-fonts' );
	wp_dequeue_style( 'blocksy-fonts' );

	if ( ! ( $wp_styles instanceof WP_Styles ) ) {
		return;
	}

	foreach ( $wp_styles->registered as $handle => $style ) {
		if ( empty( $style->src ) ) {
			continue;
		}

		if ( false === strpos( $style->src, 'fonts.googleapis.com' ) && false === strpos( $style->src, 'fonts.gstatic.com' ) ) {
			continue;
		}

		wp_dequeue_style( $handle );
		wp_deregister_style( $handle );
	}
}

add_filter( 'blocksy:typography:google:use-remote', '__return_false' );

function hu_normalize_brand_text( $text ) {
	if ( ! is_string( $text ) || '' === $text ) {
		return $text;
	}

	return strtr(
		$text,
		[
			'Hasim' => 'Haşim',
			'HASIM' => 'HAŞIM',
			'hasim' => 'haşim',
		]
	);
}

function hu_get_site_wordmark_text() {
	$site_name = trim( (string) get_bloginfo( 'name' ) );

	if ( '' === $site_name ) {
		return 'HAŞIM ÜNER';
	}

	return hu_normalize_brand_text( $site_name );
}

function hu_get_site_wordmark_html() {
	$wordmark = hu_get_site_wordmark_text();

	return sprintf(
		'<a href="%1$s" class="site-logo" rel="home" aria-label="%2$s">%3$s</a>',
		esc_url( home_url( '/' ) ),
		esc_attr(
			sprintf(
				/* translators: %s: site wordmark. */
				__( 'Startseite - %s', 'blocksy-child' ),
				$wordmark
			)
		),
		esc_html( $wordmark )
	);
}

add_filter( 'get_custom_logo', 'hu_override_custom_logo_with_wordmark', 10, 2 );
function hu_override_custom_logo_with_wordmark( $html, $blog_id ) {
	if ( is_admin() ) {
		return $html;
	}

	return hu_get_site_wordmark_html();
}

function hu_get_brand_logo_url() {
	$logo_path = get_stylesheet_directory() . '/assets/brand/hasim-uener-light-copper.svg';
	$logo_url  = get_stylesheet_directory_uri() . '/assets/brand/hasim-uener-light-copper.svg';

	if ( file_exists( $logo_path ) ) {
		return (string) apply_filters( 'hu_brand_logo_url', add_query_arg( 'v', (string) filemtime( $logo_path ), $logo_url ) );
	}

	return (string) apply_filters( 'hu_brand_logo_url', '' );
}

function hu_get_brand_image_type( $url ) {
	$path_info = wp_parse_url( (string) $url, PHP_URL_PATH );
	$extension = is_string( $path_info ) ? strtolower( pathinfo( $path_info, PATHINFO_EXTENSION ) ) : '';
	$mime_map  = [
		'svg'  => 'image/svg+xml',
		'png'  => 'image/png',
		'webp' => 'image/webp',
		'ico'  => 'image/x-icon',
		'jpg'  => 'image/jpeg',
		'jpeg' => 'image/jpeg',
		'gif'  => 'image/gif',
	];

	return isset( $mime_map[ $extension ] ) ? $mime_map[ $extension ] : 'image/svg+xml';
}

function hu_get_brand_favicon_assets() {
	$base_dir = get_stylesheet_directory() . '/assets/brand/';
	$base_uri = get_stylesheet_directory_uri() . '/assets/brand/';
	$assets   = [];

	$variants = [
		'light' => 'favicon-copper.svg',
		'dark'  => 'favicon-dark.svg',
	];

	foreach ( $variants as $variant => $file_name ) {
		$path = $base_dir . $file_name;

		if ( ! file_exists( $path ) ) {
			continue;
		}

		$assets[ $variant ] = [
			'path'    => $path,
			'url'     => add_query_arg( 'v', (string) filemtime( $path ), $base_uri . $file_name ),
			'type'    => hu_get_brand_image_type( $file_name ),
		];
	}

	return $assets;
}

add_action( 'after_setup_theme', 'hu_prefer_theme_brand_favicons', 20 );
function hu_prefer_theme_brand_favicons() {
	if ( [] === hu_get_brand_favicon_assets() ) {
		return;
	}

	remove_action( 'wp_head', 'wp_site_icon', 99 );
	remove_action( 'admin_head', 'wp_site_icon' );
	remove_action( 'login_head', 'wp_site_icon' );
}

function hu_output_brand_favicon_meta() {
	$favicons = hu_get_brand_favicon_assets();

	if ( [] === $favicons ) {
		return;
	}

	if ( ! empty( $favicons['light']['url'] ) ) :
		?>
	<link rel="icon" type="<?php echo esc_attr( $favicons['light']['type'] ?? 'image/svg+xml' ); ?>" href="<?php echo esc_url( $favicons['light']['url'] ); ?>">
	<link rel="shortcut icon" href="<?php echo esc_url( $favicons['light']['url'] ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( $favicons['light']['url'] ); ?>">
		<?php
	endif;

	if ( ! empty( $favicons['dark']['url'] ) ) :
		?>
	<link rel="icon" type="<?php echo esc_attr( $favicons['dark']['type'] ?? 'image/svg+xml' ); ?>" media="(prefers-color-scheme: dark)" href="<?php echo esc_url( $favicons['dark']['url'] ); ?>">
		<?php
	endif;
}

add_action( 'wp_head', 'hu_output_brand_favicon_meta', 5 );
add_action( 'admin_head', 'hu_output_brand_favicon_meta', 5 );
add_action( 'login_head', 'hu_output_brand_favicon_meta', 5 );

add_action( 'wp_head', 'hu_output_brand_head_support', 6 );
function hu_output_brand_head_support() {
	?>
	<style>.ft { background: var(--bg, #0a0a0a); }</style>
	<script>
	(function () {
		function applyWordmark() {
			var logoLinks = document.querySelectorAll('.site-branding[data-id="logo"] .site-logo-container');
			if (!logoLinks.length) {
				return;
			}

			logoLinks.forEach(function (link) {
				if (!link) {
					return;
				}

				link.classList.add('site-logo');
				link.setAttribute('aria-label', 'Startseite - HAŞIM ÜNER');

				if (!link.textContent || !link.textContent.trim()) {
					link.textContent = 'HAŞIM ÜNER';
				}
			});
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', applyWordmark);
		} else {
			applyWordmark();
		}
	})();
	</script>
	<?php
}

add_action(
	'wp_head',
	function () {
		?>
		<script>
		(function () {
			var theme = 'dark';

			if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
				theme = 'light';
			}

			document.documentElement.setAttribute('data-nx-theme', theme);
			document.documentElement.setAttribute('data-theme', theme);
			document.documentElement.style.colorScheme = theme;
		})();
		</script>
		<?php
	},
	1
);

// ── 3. BLOCKSY TITLE OVERRIDE ────────────────────────────────────
add_filter( 'blocksy:post_types:post:has_page_title', '__return_false' );

// --- 4b. SITEMAP ---
// Die native WordPress-Sitemap (/wp-sitemap.xml) ist aktiv.
// Legacy-Redirect: /sitemap_index.xml (fruehere Plugin-URL) leitet auf die
// native Sitemap weiter, damit externe Backlinks und GSC-Eintraege erhalten bleiben.
add_action(
	'template_redirect',
	function() {
		if ( is_admin() || wp_doing_ajax() ) {
			return;
		}

		$request_uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
		$request_path = wp_parse_url( $request_uri, PHP_URL_PATH );
		$request_path = '/' . ltrim( (string) $request_path, '/' );

		if ( '/sitemap_index.xml' !== untrailingslashit( $request_path ) ) {
			return;
		}

		nocache_headers();
		wp_safe_redirect( home_url( '/wp-sitemap.xml' ), 302 );
		exit;
	},
	1
);

// Rewrite Rules flushen bei Theme-Aktivierung.
add_action( 'after_switch_theme', function() {
    flush_rewrite_rules();
} );

// --- 4c. SITEMAP: noindex-Seiten ausschließen ---
// Entfernt Posts aus der Sitemap, die per ACF oder Legacy-Meta als noindex markiert sind.
add_filter( 'wp_sitemaps_posts_query_args', function ( $args, $post_type ) {
	$args['meta_query'] = isset( $args['meta_query'] ) ? $args['meta_query'] : [];

	$args['meta_query'][] = [
		'relation' => 'AND',
		[
			'relation' => 'OR',
			[
				'key'     => 'seo_noindex',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'seo_noindex',
				'value'   => '1',
				'compare' => '!=',
			],
		],
		[
			'relation' => 'OR',
			[
				'key'     => 'rank_math_robots',
				'compare' => 'NOT EXISTS',
			],
			[
				'key'     => 'rank_math_robots',
				'value'   => 'noindex',
				'compare' => 'NOT LIKE',
			],
		],
	];

	return $args;
}, 10, 2 );

// Entferne die native Users-Sitemap (z.B. /wp-sitemap-users-1.xml).
// Gründe: die Seite ist eine persönliche Autoren-/User-Seite ("Über mich")
// und soll nicht als eigenständige Sitemap-Quelle ausgegeben werden.
// Wir versuchen hier robust zwei Ebenen: den Sitemap-Provider entfernen
// und zusätzlich direkte Anfragen an die Users-Sitemap mit 410 beantworten.
add_filter( 'wp_sitemaps_add_provider', function ( $provider, $name ) {
	if ( 'users' === $name ) {
		return false;
	}

	return $provider;
}, 10, 2 );

add_filter( 'wp_sitemaps_register_providers', function ( $providers ) {
	if ( isset( $providers['users'] ) ) {
		unset( $providers['users'] );
	}

	return $providers;
} );

// Fallback: blockiere direkte Aufrufe an die users-Sitemap (sicherheits-/hygienegrund).
add_action( 'template_redirect', function() {
	if ( ! isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$request_path = wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH );
	$request_path = '/' . ltrim( (string) $request_path, '/' );

	if ( preg_match( '#^/wp-sitemap-users(?:-\d+)?\.xml$#', untrailingslashit( $request_path ) ) ) {
		// Gone — signalisiert Crawlern, dass die Ressource nicht (mehr) existiert.
		status_header( 410 );
		nocache_headers();
		exit;
	}
}, 0 );

/**
 * ACCESSIBILITY FIX 6a: Skip-Link für Tastatur-Navigation.
 * So kommen Keyboard-Nutzer direkt zum Hauptinhalt.
 */
add_action( 'wp_body_open', 'hasim_skip_to_content' );
function hasim_skip_to_content() {
	echo '<a href="#main" class="skip-to-content" style="position:absolute;top:-100px;left:16px;background:#b46a3c;color:#fff8f3;padding:10px 16px;border:1px solid rgba(255,248,243,0.18);border-radius:999px;font-weight:800;font-size:13px;letter-spacing:0.01em;box-shadow:0 16px 34px rgba(180,106,60,0.28);z-index:99999;text-decoration:none;transition:top 0.2s ease;" onfocus="this.style.top=\'16px\'" onblur="this.style.top=\'-100px\'">Zum Hauptinhalt springen</a>';
}

function nexus_get_theme_toggle_html( $args = [] ) {
	$args   = wp_parse_args(
		$args,
		[
			'source' => 'default',
		]
	);
	$source = sanitize_key( $args['source'] );

	ob_start();
	?>
	<div class="nx-theme-toggle" data-nx-theme-toggle data-nx-theme-toggle-source="<?php echo esc_attr( $source ); ?>">
		<div class="nx-theme-toggle__group" role="group" aria-label="<?php esc_attr_e( 'Farbschema wählen', 'blocksy-child' ); ?>">
			<button type="button" class="nx-theme-toggle__button" data-theme-value="dark" aria-pressed="false" aria-label="<?php esc_attr_e( 'Dunkles Farbschema aktivieren', 'blocksy-child' ); ?>" title="<?php esc_attr_e( 'Dunkel', 'blocksy-child' ); ?>">
				<span class="nx-theme-toggle__icon" aria-hidden="true">D</span>
				<span><?php esc_html_e( 'Dunkel', 'blocksy-child' ); ?></span>
			</button>
			<button type="button" class="nx-theme-toggle__button" data-theme-value="light" aria-pressed="false" aria-label="<?php esc_attr_e( 'Helles Farbschema aktivieren', 'blocksy-child' ); ?>" title="<?php esc_attr_e( 'Hell', 'blocksy-child' ); ?>">
				<span class="nx-theme-toggle__icon" aria-hidden="true">H</span>
				<span><?php esc_html_e( 'Hell', 'blocksy-child' ); ?></span>
			</button>
		</div>
	</div>
	<?php

	return trim( ob_get_clean() );
}

add_action( 'wp_body_open', 'nexus_render_theme_toggle', 15 );
function nexus_render_theme_toggle() {
	echo nexus_get_theme_toggle_html(
		[
			'source' => 'fallback',
		]
	);
}

/**
 * ACCESSIBILITY FIX 6b: Automatische ARIA-Labels für Kennzahlen-Blöcke.
 * Kein vorhandener wp_footer-Hook in dieser Datei gefunden, daher neuer Hook.
 */
add_action( 'wp_footer', 'hasim_add_metric_aria_labels_script', 25 );
function hasim_add_metric_aria_labels_script() {
	if ( is_admin() ) {
		return;
	}
	?>
	<script>
	(function () {
		'use strict';

		function normalize(text) {
			return (text || '').replace(/\s+/g, ' ').trim();
		}

		function applyMetricAriaLabels() {
			var metricItems = document.querySelectorAll('.wp-metric, .wgos-trust-item, .nx-metric');
			if (!metricItems.length) return;

			metricItems.forEach(function (item) {
				var value = item.querySelector('.wp-metric-value, .wgos-trust-value, .nx-metric__value');
				var label = item.querySelector('.wp-metric-label, .wgos-trust-label, .nx-metric__label');
				if (!value || !label) return;

				var valueText = normalize(value.textContent);
				var labelText = normalize(label.textContent);
				if (!valueText || !labelText) return;

				value.setAttribute('aria-label', labelText + ': ' + valueText);
				value.setAttribute('role', 'text');
			});
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', applyMetricAriaLabels);
		} else {
			applyMetricAriaLabels();
		}

		// Re-run nach Counter-Animation, damit Endwerte im Label stehen.
		window.setTimeout(applyMetricAriaLabels, 2400);
	})();
	</script>
	<?php
}

/**
 * SEO HINWEIS:
 * Kein zusätzliches Homepage-Schema in functions.php, da bereits
 * strukturierte Daten via inc/org-schema.php und Rank-Math-Integration vorhanden sind.
 * So vermeiden wir JSON-LD-Duplikate.
 */

/**
 * NEXUS FEATURE: Automatische Lesezeit
 */

// --- 5. TOC & SCROLL-SPY ---
// Wird jetzt zentral über nexus-core.js gesteuert (NexusCore.initToc)
/**
 * NEXUS GLOBAL HELPER: Share Buttons (Definition)
 * Das hier ist nur der BAUPLAN. Es zeigt noch nichts an!
 */
function nexus_render_share_buttons() {
    ?>
    <div class="nexus-share-box">
        <span class="share-label">Teilen:</span>
        
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="nexus-share-btn linkedin" title="Auf LinkedIn teilen">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
        </a>

        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_the_permalink()); ?>" target="_blank" rel="noopener" class="nexus-share-btn whatsapp" title="Per WhatsApp senden">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </a>

        <button onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>');alert('Link in Zwischenablage kopiert!');" class="nexus-share-btn copy" title="Link kopieren">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
        </button>
    </div>
    <?php
}


// Audit Live Assets: zentral in inc/enqueue.php (Section H) verwaltet.
