<?php
/**
 * Blocksy Child Theme - Finale, stabile Version
 * mit radikal getrenntem, seiten-spezifischem Schema-Markup
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Funktion zum Laden der Stylesheets und Skripte
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
         wp_enqueue_script( 'blog-archive-script', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], null, true );
    }
}, 100 );

// Funktion NUR für das Schema.org Markup
add_action( 'wp_head', function () {
    // Schriften werden immer geladen
    ?>
    <style id="local-fonts">
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Regular.woff2') format('woff2'); font-weight: 400; font-display: swap; }
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Medium.woff2') format('woff2'); font-weight: 500; font-display: swap; }
        @font-face { font-family: 'Satoshi'; src: url('/wp-content/themes/blocksy-child/fonts/Satoshi-Bold.woff2') format('woff2'); font-weight: 700; font-display: swap; }
    </style>
    <?php

    // Das komplexe Startseiten-Schema wird NUR hier geladen.
    if ( is_front_page() ) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
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
                        "geoMidpoint": { "@type": "GeoCoordinates", "latitude": "52.375892", "longitude": "9.732011" },
                        "geoRadius": "30000"
                    },
                    "founder": { "@type": "Person", "name": "Hasim Üner" }
                },
                {
                    "@type": "FAQPage",
                    "mainEntity": [
                        {
                            "@type": "Question",
                            "name": "Wie schnell kann unser Projekt starten?",
                            "acceptedAnswer": { "@type": "Answer", "text": "Nach unserem Erstgespräch meist innerhalb von 3-5 Werktagen..." }
                        },
                        {
                            "@type": "Question",
                            "name": "Was kostet eine professionelle Website?",
                            "acceptedAnswer": { "@type": "Answer", "text": "Starter-Projekte beginnen ab 3.500€..." }
                        },
                        {
                            "@type": "Question",
                            "name": "Bieten Sie auch Wartung & Support an?",
                            "acceptedAnswer": { "@type": "Answer", "text": "Ja. Ich biete flexible Service-Pakete an..." }
                        },
                        {
                            "@type": "Question",
                            "name": "Wie wird der Erfolg des Projekts gemessen?",
                            "acceptedAnswer": { "@type": "Answer", "text": "Anhand klar definierter KPIs, die wir gemeinsam festlegen..." }
                        }
                    ]
                }
            ]
        }
        </script>
        <?php
    }
}, 1 );