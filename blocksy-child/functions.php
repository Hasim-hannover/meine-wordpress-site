<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * INCLUDES: Shortcodes, Schema & Snippets (Alles wird geladen!)
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';
// ACHTUNG: Prüfe bitte unbedingt 'snippets.php' oder 'custom.php' nach dem "Geister-Titel" Code!
$files_to_load = ['shortcodes.php', 'org-schema.php', 'schema.php', 'snippets.php', 'custom.php'];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS ---
add_action( 'wp_enqueue_scripts', function () {
    $child_version = '9.1.1'; // Version hochgezählt
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], $child_version );

    // A) STARTSEITE & ARCHIV (Das Grid-Layout)
    if ( is_front_page() || is_home() || is_archive() ) {
        wp_enqueue_style( 
            'nexus-homepage-css', 
            get_stylesheet_directory_uri() . '/assets/css/homepage.css', 
            [], 
            time() 
        );
        
        wp_enqueue_script( 
            'nexus-home', 
            get_stylesheet_directory_uri() . '/assets/js/homepage.js', 
            [], 
            time(), 
            true 
        );
    }
    
    // B) EINZELNER BLOG-POST (Das Lese-Erlebnis)
    if ( is_single() ) {
        // Hier laden wir das neue CSS für die Analyse-Ansicht
        wp_enqueue_style( 
            'nexus-single-css', 
            get_stylesheet_directory_uri() . '/assets/css/single.css', 
            [], 
            time() 
        );

        // Optional: JS für die Progress-Bar & TOC
        if (file_exists(get_stylesheet_directory() . '/assets/js/blog-archive.js')) {
            wp_enqueue_script( 
                'nexus-blog', 
                get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', 
                [], 
                '6.0.0', 
                true 
            );
        }
    }

    // C) BLOG ARCHIVE LOGIK (Nur auf der Blog-Übersicht)
    if ( is_home() ) {
         wp_enqueue_script( 'nexus-blog-archive', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }

}, 20 ); // <--- HIER wird die Funktion EINMALIG und KORREKT geschlossen.

// --- 3. PERFORMANCE & SCHRIFTEN ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );

/**
 * FIX: Titel-Steuerung (Nur für Blog-Beiträge!)
 * 1. 'blocksy:post_types:post:has_page_title' -> Zielt NUR auf den Typ "post" (Artikel).
 * 2. Seiten (Typ "page") werden NICHT beeinflusst.
 */
add_filter('blocksy:post_types:post:has_page_title', '__return_false');

/**
 * FIX: Titel-Steuerung für SEITEN (Page)
 * Deaktiviert den Blocksy-Titel NUR auf spezifischen Landingpages,
 * damit wir dort volle Design-Kontrolle haben.
 */
add_filter('blocksy:post_types:page:has_page_title', function ($has_title) {
    
    // Liste der Seiten-IDs oder Slugs, wo der Titel WEG soll:
    // Beispiel: 'wordpress-agentur-hannover', 'seo-audit', 'kontakt'
    if ( is_page( array( 'wordpress-agentur-hannover', 'seo-landingpage-slug-hier-einfuegen' ) ) ) {
        return false;
    }

    // Auf allen anderen Seiten (Impressum etc.) bleibt der Titel da.
    return $has_title;
});