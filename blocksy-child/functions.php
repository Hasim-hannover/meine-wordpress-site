<?php
/**
 * Blocksy Child - Nexus Final Turbo
 * Fix für: Menü-Layout, Footer-Verzögerung & Satoshi
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STYLE.CSS LADEN (Standard)
add_action( 'wp_enqueue_scripts', function () {
    // Version 3.0.0 erzwingt sofortiges Neuladen beim Nutzer
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '3.0.0' );

    // Skripte
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '3.0.0', true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '3.0.0', true );
    }
}, 20 ); // Priorität 20 = Früher als vorher

// 2. CRITICAL CSS (KILLT DIE VERZÖGERUNG!)
// Wir schreiben das Layout direkt in den Kopf. Das verhindert das "Springen".
add_action( 'wp_head', function () {
    ?>
    <style id="nexus-critical-layout">
        /* SOFORTIGES Menü Grid */
        .ct-header nav .menu-item.mega > .sub-menu {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 20px !important;
        }
        /* SOFORTIGER Footer Hintergrund */
        .ft {
            background: #0a0a0a !important;
            width: 100% !important;
            display: block !important;
            opacity: 1 !important;
        }
    </style>
    <?php
    
    // Homepage CSS inline wenn vorhanden
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) echo '<style id="nexus-home-critical">' . file_get_contents( $css ) . '</style>';
    }
}, 1 );

// 3. SATOSHI LOKAL & PRELOAD
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>
        @font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }
    </style>";
}, 5 );