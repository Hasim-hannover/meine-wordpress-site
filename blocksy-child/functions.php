<?php
/**
 * Blocksy Child Theme - Nexus Edition
 * Stabil getrennte Funktionen für maximale Sicherheit.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. STYLES & SCRIPTS LADEN
add_action( 'wp_enqueue_scripts', function () {
    // Globale Style.css
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [ 'blocksy-stylesheet' ], filemtime( get_stylesheet_directory() . '/style.css' ) );

    // Startseite
    if ( is_front_page() ) {
        wp_enqueue_style( 'homepage-style', get_stylesheet_directory_uri() . '/assets/css/homepage.css', [], filemtime( get_stylesheet_directory() . '/assets/css/homepage.css' ) );
        wp_enqueue_script( 'homepage-script', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], null, true );
    }

    // Blog
    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'blog-archive-script', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], null, true );
    }
}, 100 );

// 2. SCHRIFTEN LADEN (Immer & Überall)
add_action( 'wp_head', function () {
    $font_path = get_stylesheet_directory_uri() . '/fonts';
    ?>
    <style id="nexus-local-fonts">
        @font-face {
            font-family: 'Satoshi';
            src: url('<?php echo $font_path; ?>/Satoshi-Variable.woff2') format('woff2-variations');
            font-weight: 300 900;
            font-display: swap;
            font-style: normal;
        }
        @font-face {
            font-family: 'Satoshi';
            src: url('<?php echo $font_path; ?>/Satoshi-VariableItalic.woff2') format('woff2-variations');
            font-weight: 300 900;
            font-display: swap;
            font-style: italic;
        }
    </style>
    <?php
}, 5 ); // Priorität 5: Lädt sehr früh

// 3. SCHEMA MARKUP (Nur Startseite)
add_action( 'wp_head', function () {
    if ( ! is_front_page() ) { return; } // Abbruch, wenn nicht Startseite
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
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "Warschauer Str. 5",
                    "addressLocality": "Pattensen",
                    "postalCode": "30982",
                    "addressCountry": "DE"
                },
                "founder": { "@type": "Person", "name": "Hasim Üner" }
            },
            {
                "@type": "FAQPage",
                "mainEntity": [
                    { "@type": "Question", "name": "Wie schnell kann unser Projekt starten?", "acceptedAnswer": { "@type": "Answer", "text": "Meist innerhalb von 3-5 Werktagen..." } },
                    { "@type": "Question", "name": "Was kostet eine professionelle Website?", "acceptedAnswer": { "@type": "Answer", "text": "Starter-Projekte ab 3.500€..." } }
                ]
            }
        ]
    }
    </script>
    <?php
}, 10 );