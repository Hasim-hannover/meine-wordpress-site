<?php
/**
 * Blocksy Child Theme - Finale, stabile Version
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
    // Lädt die globale style.css auf ALLEN Seiten.
    wp_enqueue_style(
        'blocksy-child-style',
        get_stylesheet_uri(),
        [ 'blocksy-stylesheet' ],
        filemtime( get_stylesheet_directory() . '/style.css' )
    );

    // Lädt Homepage-Assets NUR auf der Startseite.
    if ( is_front_page() ) {
        wp_enqueue_style(
            'homepage-style',
            get_stylesheet_directory_uri() . '/assets/css/homepage.css',
            [],
            filemtime( get_stylesheet_directory() . '/assets/css/homepage.css' )
        );
        wp_enqueue_script(
            'homepage-script',
            get_stylesheet_directory_uri() . '/assets/js/homepage.js',
            [], null, true
        );
    }

    // Lädt Blog-Assets NUR auf der Blog-Seite und auf Einzelbeiträgen.
    if ( is_home() || is_single() ) {
         wp_enqueue_style(
            'blog-archive-style',
            get_stylesheet_directory_uri() . '/assets/css/blog-archive.css',
             [],
             filemtime( get_stylesheet_directory() . '/assets/css/blog-archive.css' )
        );
    }
}, 100 );

add_action( 'wp_head', function () {
    ?>
    <style id="local-fonts">
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Regular.woff2') format('woff2'); font-weight: 400; font-display: swap; }
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Medium.woff2') format('woff2'); font-weight: 500; font-display: swap; }
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Bold.woff2') format('woff2'); font-weight: 700; font-display: swap; }
    </style>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "hasim-hannover.de",
        "url": "https://hasim-hannover.de/",
        "logo": "https://hasim-hannover.de/wp-content/uploads/2024/04/hasim-hannover-logo-white.svg",
        "contactPoint": { "@type": "ContactPoint", "telephone": "+49-162-3727548", "contactType": "customer service" }
    }
    </script>
    <?php
}, 1 );