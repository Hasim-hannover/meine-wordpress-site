<?php
/**
 * Blocksy Child - Nexus Final Champions Edition
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STYLE.CSS & SCRIPTS LADEN
add_action( 'wp_enqueue_scripts', function () {
    // Stylesheet laden
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '7.0.0-FINAL' );

    // JS nur laden, wo nötig
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '6.0.0', true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }
}, 20 );

// 2. SATOSHI SCHRIFT VORLADEN (Performance)
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
}, 5 );