<?php
/**
 * Blocksy Child - Nexus Final Edition
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. CSS & SCRIPTS (Der Fix!)
add_action( 'wp_enqueue_scripts', function () {
    // Wir definieren eine Version, die sich garantiert ändert
    // Ändere '1.5.0' jedes Mal, wenn du CSS änderst und es nicht sichtbar wird.
    $version = '1.5.0-nexus-fix'; 

    // Style.css laden
    wp_enqueue_style( 
        'blocksy-child-style', 
        get_stylesheet_uri(), 
        [ 'blocksy-stylesheet' ], 
        $version // Hier zwingen wir das Update
    );

    // JS laden
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], $version, true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], $version, true );
    }
}, 100 );

// 2. CRITICAL CSS (Bleibt gleich)
add_action( 'wp_head', function () {
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) echo '<style id="nexus-critical">' . file_get_contents( $css ) . '</style>';
    }
}, 1 );

// 3. SATOSHI LOKAL (Bleibt gleich)
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo "<style>
        @font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }
        @font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-VariableItalic.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: italic; }
    </style>";
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
}, 5 );