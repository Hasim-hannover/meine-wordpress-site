<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * FINALER STAND: Layout-Logik + Titel-Killer (Doppelt abgesichert)
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
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.4.0' );

    // A) NUR Startseite & Archiv
    if ( is_front_page() || is_home() || is_archive() ) {
        wp_enqueue_style( 'nexus-home-css', get_stylesheet_directory_uri() . '/assets/css/homepage.css', [], time() );
        wp_enqueue_script( 'nexus-home-js', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], time(), true );
    }

    // B) NUR Blog-Archive
    if ( is_home() ) {
         wp_enqueue_script( 'nexus-archive-js', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }

    // C) NUR Einzelbeitrag (Blog Post)
    if ( is_single() ) {
        if ( file_exists( get_stylesheet_directory() . '/assets/css/single.css' ) ) {
            wp_enqueue_style( 'nexus-single-css', get_stylesheet_directory_uri() . '/assets/css/single.css', [], time() );
        }
    }
    
    // D) CSS-NOTBREMSE GEGEN TITEL (Wird auf jeder Seite geladen)
    // Das hier versteckt den Titel visuell, falls der PHP-Filter unten ignoriert wird.
    $custom_css = "
        .page .entry-header .entry-title, 
        .page .ct-page-title,
        .single-post .entry-header .entry-title,
        .single-post .ct-page-title {
            display: none !important;
        }
    ";
    wp_add_inline_style( 'blocksy-child-style', $custom_css );

}, 20 );

// --- 3. PERFORMANCE & FONTS ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );

// --- 4. DER LOGIK-KILLER (PHP) ---

// Titel auf Blog-Posts (post) entfernen
add_filter('blocksy:post_types:post:has_page_title', '__return_false');

// Titel auf ALLEN Seiten (page) entfernen (Agentur, Kontakt, etc.)
add_filter('blocksy:post_types:page:has_page_title', '__return_false');