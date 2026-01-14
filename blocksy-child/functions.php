<?php
/**
 * Blocksy Child - Nexus Emergency Fix
 * REPARATUR: Homepage Styles wiederhergestellt.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STANDARD STYLES & SCRIPTS
add_action( 'wp_enqueue_scripts', function () {
    // Haupt-Style laden
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '7.2.0-RESCUE' );

    // JS laden
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '6.0.0', true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// 2. CRITICAL CSS & HOMEPAGE STYLE (WICHTIG!)
add_action( 'wp_head', function () {
    // Kleiner Footer Fix (behalten wir sicherheitshalber)
    echo '<style>.ft { background: #0a0a0a; }</style>';

    // --- HIER WAR DER FEHLER: DAS MUSS DRIN BLEIBEN! ---
    // Lädt die assets/css/homepage.css direkt in den Header
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) {
            echo '<style id="nexus-home-critical">' . file_get_contents( $css ) . '</style>';
        }
    }
}, 1 );

// 3. FONTS PRELOAD
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
}, 5 );