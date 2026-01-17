<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * INCLUDES: Shortcodes, Schema & Snippets (Alles wird geladen!)
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

// --- 2. STYLES & SCRIPTS ---
add_action( 'wp_enqueue_scripts', function () {
    $child_version = '9.0.5';
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], $child_version );

    // Nexus CSS (Jetzt auf Startseite, Blog und Archiv verfügbar)
    if ( is_front_page() || is_home() || is_archive() || is_single() ) {
        wp_enqueue_style( 
            'nexus-homepage-css', 
            get_stylesheet_directory_uri() . '/assets/css/homepage.css', 
            [], 
            time() 
        );
    }

    // Menü-Logik (JS)
    wp_enqueue_script( 
        'nexus-home', 
        get_stylesheet_directory_uri() . '/assets/js/homepage.js', 
        [], 
        time(), 
        true 
    );
    
    // Blog Archive Logik
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// --- 3. PERFORMANCE & SCHRIFTEN ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );