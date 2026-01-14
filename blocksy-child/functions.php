<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * INCLUDES: Shortcodes, Schema & Snippets (Alles wird geladen!)
 * FIXED: Kein Inline-Style mehr, Dropdowns funktionieren wieder.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN AUS DEM INC-ORDNER LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';

// Liste der wichtigen Dateien
$files_to_load = [
    'shortcodes.php',  
    'org-schema.php',  
    'schema.php',      
    'snippets.php',    
    'custom.php'       
];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS (HIER IST DER FIX) ---
add_action( 'wp_enqueue_scripts', function () {
    // 1. Parent & Child Styles laden
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.0.2' );

    // 2. HOMEPAGE ASSETS (Nur auf der Startseite)
    if ( is_front_page() ) {
        // CSS sauber registrieren (Zwingt Browser zum Neuladen)
        wp_enqueue_style( 
            'nexus-homepage-css', 
            get_stylesheet_directory_uri() . '/assets/css/homepage.css', 
            [], 
            time() 
        );

        // JS laden
        wp_enqueue_script( 
            'nexus-home', 
            get_stylesheet_directory_uri() . '/assets/js/homepage.js', 
            [], 
            time(), 
            true 
        );
    }
    
    // 3. Blog Assets
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// --- 3. SCHRIFTEN & KLEINKRAM (PERFORMANCE) ---
// Der "Critical CSS" Block wurde hier entfernt!
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    
    // Preload Fonts
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    
    // Footer Background Fix (der darf bleiben)
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );
?>