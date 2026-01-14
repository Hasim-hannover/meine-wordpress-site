<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * INCLUDES: Shortcodes, Schema & Snippets (Alles wird geladen!)
 * NEXUS MERGE: Bereinigt vom "Zombie-CSS", behält alle Module.
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
    // 1. Parent & Child Styles (Wichtig: Version hochsetzen für Cache-Busting)
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], time() ); // time() erzwingt Neuladen

    // 2. JS für Homepage (inkl. Menü-Fix)
    if ( is_front_page() ) {
        // CSS für Homepage separat laden (Das ersetzt das "Critical CSS")
        wp_enqueue_style( 
            'nexus-homepage-css', 
            get_stylesheet_directory_uri() . '/assets/css/homepage.css', 
            [], 
            time() 
        );

        // JS für Homepage
        wp_enqueue_script( 
            'nexus-home', 
            get_stylesheet_directory_uri() . '/assets/js/homepage.js', 
            [], 
            time(), 
            true 
        );
    }
    
    // 3. JS für Blog
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );


// --- 3. SCHRIFTEN (PERFORMANCE) ---
// (Dieser Teil bleibt, da er wichtig für die Ladezeit ist)
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    
    // Kleiner Fix für Footer-Farbe (Optional, falls nötig)
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );

// WICHTIG: Der Abschnitt "CRITICAL CSS" (mit nexus-home-critical) wurde GELÖSCHT.
// Das löst das Menü-Problem, da nun keine Inline-Styles mehr blockieren.
?>