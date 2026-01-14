<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * INCLUDES: Shortcodes, Schema & Snippets (Alles wird geladen!)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN AUS DEM INC-ORDNER LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';

// Liste der wichtigen Dateien, die geladen werden MÜSSEN ("Rippe")
$files_to_load = [
    'shortcodes.php',  // Deine Resultate
    'org-schema.php',  // Dein "Ork Schema" (SEO)
    'schema.php',      // Fallback Name für Schema
    'snippets.php',    // Deine Code Snippets
    'custom.php'       // Weitere Custom Functions
];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS ---
add_action( 'wp_enqueue_scripts', function () {
    // Version hochsetzen (Cache Buster für CSS Änderungen)
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.0.0-FINAL' );

    // JS für Homepage
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '6.0.0', true );
    }
    // JS für Blog
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// --- 3. CRITICAL CSS (HOMEPAGE RETTUNG) ---
add_action( 'wp_head', function () {
    // Footer Background Fix
    echo '<style>.ft { background: #0a0a0a; }</style>';

    // Homepage CSS direkt laden (verhindert weiße Seite)
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) {
            echo '<style id="nexus-home-critical">' . file_get_contents( $css ) . '</style>';
        }
    }
}, 1 );

// --- 4. SCHRIFTEN (PERFORMANCE) ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
}, 5 );