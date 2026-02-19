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
	'acf.php',            // ACF Feldgruppen-Registrierung (SEO, KPI, Comparison)
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

// ── 2. PERFORMANCE: FONT PRELOADING ──────────────────────────────
add_action( 'wp_head', function () {
	$font_uri = get_stylesheet_directory_uri() . '/fonts';

	printf(
		'<link rel="preload" href="%s/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( $font_uri )
	);

	printf(
		"<style>@font-face { font-family: 'Satoshi'; src: url('%s/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>\n",
		esc_url( $font_uri )
	);

	// Footer Background Fix
	echo '<style>.ft { background: #0a0a0a; }</style>' . "\n";
}, 5 );

// ── 3. BLOCKSY TITLE OVERRIDE ────────────────────────────────────
add_filter( 'blocksy:post_types:post:has_page_title', '__return_false' );

// --- 4b. SITEMAP (Rank Math Pro) ---
// WordPress-native Sitemap deaktivieren → Rank Math übernimmt /sitemap_index.xml
add_filter( 'wp_sitemaps_enabled', '__return_false' );

// Rewrite Rules flushen bei Theme-Aktivierung (nötig für Rank Math Sitemap-Routen)
add_action( 'after_switch_theme', function() {
    flush_rewrite_rules();
} );

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

        <a href="https://instagram.com/hasimuener" target="_blank" rel="noopener" class="nexus-share-btn instagram" title="Auf Instagram besuchen">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
        </a>

        <button onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>');alert('Link in Zwischenablage kopiert!');" class="nexus-share-btn copy" title="Link kopieren">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
        </button>
    </div>
    <?php
}


// Audit Live Assets: zentral in inc/enqueue.php (Section H) verwaltet.
