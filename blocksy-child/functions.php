<?php
/**
 * Blocksy Child - Nexus Final Champions Edition
 * Bereinigt: Keine doppelten Einträge, maximale Performance.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STYLE.CSS & SCRIPTS LADEN
add_action( 'wp_enqueue_scripts', function () {
    // Version 6.0.0 erzwingt sofortiges Neuladen (Cache Buster)
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '6.0.0-CHAMPIONS' );

    // JS nur laden, wo nötig
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '6.0.0', true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// 2. CRITICAL LAYOUT (Das verhindert das Flackern!)
add_action( 'wp_head', function () {
    ?>
    <style id="nexus-critical-layout">
        /* SOFORTIGES Grid & Sichtbarkeit für das Menü (Keine Verzögerung!) */
        .ct-header nav .menu-item.mega > .sub-menu {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 0 !important;
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        /* Footer sofort dunkel machen */
        .ft { 
            background: #0a0a0a !important; 
            width: 100% !important; 
            display: block !important; 
        }
    </style>
    <?php

    // Homepage CSS direkt inline laden (Turbo Speed)
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) {
            echo '<style id="nexus-home-critical">' . file_get_contents( $css ) . '</style>';
        }
    }
}, 1 );

// 3. SATOSHI SCHRIFT VORLADEN
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    // Preload für schnellste Anzeige
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    // Fallback Definition im Head
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
}, 5 );