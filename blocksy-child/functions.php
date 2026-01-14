<?php
/**
 * Blocksy Child - Nexus Champions League Edition
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STYLES & SCRIPTS
add_action( 'wp_enqueue_scripts', function () {
    // Version 4.0.0 erzwingt das Update für das neue Design
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '4.0.0-CHAMPIONS' );

    // JS laden
    if ( is_front_page() ) {
        wp_enqueue_script( 'nexus-home', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], '4.0.0', true );
    }
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '4.0.0', true );
    }
}, 20 );

// 2. CRITICAL CSS (Anti-Flackern)
add_action( 'wp_head', function () {
    ?>
    <style id="nexus-critical-layout">
        /* Sofortiges Grid für das Menü */
        .ct-header nav .menu-item.mega > .sub-menu {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 30px !important;
            opacity: 0; /* Erst unsichtbar, dann Fade-In */
            animation: nexusFadeIn 0.3s forwards;
        }
        @keyframes nexusFadeIn { to { opacity: 1; } }
        
        /* Footer Stabilisierung */
        .ft { background: #0a0a0a; width: 100%; display: block; }
    </style>
    <?php
    // Inline Homepage CSS
    if ( is_front_page() ) {
        $css = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css ) ) echo '<style id="nexus-home-critical">' . file_get_contents( $css ) . '</style>';
    }
}, 1 );

// 3. SATOSHI PRELOAD
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
}, 5 );