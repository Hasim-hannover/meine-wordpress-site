<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * FINALER STAND: Layout-Logik + Titel-Killer (Global)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';
$files_to_load = ['shortcodes.php', 'org-schema.php', 'schema.php', 'snippets.php', 'custom.php'];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS (Der Traffic-Controller) ---
add_action( 'wp_enqueue_scripts', function () {
    
    // Parent Theme Styles
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.3.0' );

    // A) NUR Startseite & Archiv (Grid-Layout & JS)
    if ( is_front_page() || is_home() || is_archive() ) {
        wp_enqueue_style( 'nexus-home-css', get_stylesheet_directory_uri() . '/assets/css/homepage.css', [], time() );
        wp_enqueue_script( 'nexus-home-js', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], time(), true );
    }

    // B) NUR Blog-Archive (Kategorie-Seiten etc.)
    if ( is_home() ) {
         wp_enqueue_script( 'nexus-archive-js', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }

    // C) NUR Einzelbeitrag (Dein Analyse-Design)
    // WICHTIG: Das hattest du gelöscht. Ich habe es wieder eingefügt, 
    // damit deine Blog-Artikel ("Analysen") gut aussehen!
    if ( is_single() ) {
        if ( file_exists( get_stylesheet_directory() . '/assets/css/single.css' ) ) {
            wp_enqueue_style( 'nexus-single-css', get_stylesheet_directory_uri() . '/assets/css/single.css', [], time() );
        }
        if ( file_exists( get_stylesheet_directory() . '/assets/js/blog-archive.js' ) ) {
            wp_enqueue_script( 'nexus-single-js', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
        }
    }

}, 20 );

// --- 3. PERFORMANCE & FONTS ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );

// --- 4. DER TITEL-KILLER (RADIKAL) ---

// A) Titel auf Blog-Posts (post) entfernen -> Dein single.php Layout greift.
add_filter('blocksy:post_types:post:has_page_title', '__return_false');

// B) Titel auf ALLEN Seiten (page) entfernen -> Auch auf deiner Agentur-Seite.
// HINWEIS: Wenn du auf dem Impressum einen Titel brauchst, füge ihn dort einfach im Editor als H1 ein.
add_filter('blocksy:post_types:page:has_page_title', '__return_false');