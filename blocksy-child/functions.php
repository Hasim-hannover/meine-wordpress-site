<?php
/**
 * Blocksy Child Theme - Finale, stabile Version mit SEO-optimiertem Schema
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
    // Lädt die globale style.css auf ALLEN Seiten.
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [ 'blocksy-stylesheet' ], filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Lädt Homepage-Assets NUR auf der Startseite.
    if ( is_front_page() ) {
        wp_enqueue_style( 'homepage-style', get_stylesheet_directory_uri() . '/assets/css/homepage.css', [], filemtime( get_stylesheet_directory() . '/assets/css/homepage.css' ) );
        wp_enqueue_script( 'homepage-script', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], null, true );
    }

    // Lädt Blog-Assets NUR auf der Blog-Seite und auf Einzelbeiträgen.
    if ( is_home() || is_single() ) {
         // Lädt das JavaScript für den Blog-Filter
         wp_enqueue_script( 'blog-archive-script', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], null, true );
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
        "@type": "ProfessionalService",
        "name": "Hasim Üner - Growth Partner",
        "url": "https://hasimuener.de/",
        "logo": "https://hasimuener.de/wp-content/uploads/2025/08/Logo_Hasim-Uener-.png",
        "telephone": "+49-162-3727548",
        "priceRange": "€€",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Warschauer Str. 5",
            "addressLocality": "Pattensen",
            "addressRegion": "Niedersachsen",
            "postalCode": "30982",
            "addressCountry": "DE"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "52.264660",
            "longitude": "9.761210"
        },
        "areaServed": {
            "@type": "GeoCircle",
            "geoMidpoint": {
                "@type": "GeoCoordinates",
                "latitude": "52.375892",
                "longitude": "9.732011"
            },
            "geoRadius": "30000"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "email": "hallo@hasimuener.de",
            "contactType": "Customer Service"
        },
        "founder": {
            "@type": "Person",
            "name": "Hasim Üner",
            "url": "https://hasimuener.de/uber-mich/",
            "jobTitle": "Growth Partner & Digital Architect",
            "sameAs": [
                "https://www.linkedin.com/in/hasim-uener/"
            ]
        }
    }
    </script>
    <?php
}, 1 );