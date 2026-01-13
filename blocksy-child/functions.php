<?php
/**
 * Blocksy Child Theme - Nexus Edition (Final Cleaned)
 * Alle Funktionen zentralisiert. Keine doppelten Ladevorgänge.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// 1. ASSETS & STYLES LADEN (Optimiert)
add_action( 'wp_enqueue_scripts', function () {
    // A. Das Wichtigste: Die Child-Theme style.css
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [ 'blocksy-stylesheet' ], filemtime( get_stylesheet_directory() . '/style.css' ) );

    // B. Javascript Logik
    if ( is_front_page() ) {
        // Lädt homepage.js nur EINMAL
        wp_enqueue_script( 'nexus-homepage-js', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], filemtime( get_stylesheet_directory() . '/assets/js/homepage.js' ), true );
    }

    if ( is_home() || is_single() ) {
         wp_enqueue_script( 'nexus-blog-js', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], filemtime( get_stylesheet_directory() . '/assets/js/blog-archive.js' ), true );
    }
}, 100 );

// 2. CRITICAL CSS INLINEN (Performance-Boost für Startseite)
// Statt die CSS-Datei normal zu laden, drucken wir sie direkt in den Header. Das verhindert Flackern (FOUC).
add_action( 'wp_head', function () {
    if ( is_front_page() ) {
        $css_path = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css_path ) ) {
            echo '<style id="nexus-homepage-inline">' . file_get_contents( $css_path ) . '</style>';
        }
    }
}, 1 ); // Priorität 1 = Ganz oben im Head

// 3. LOKALE SCHRIFTEN (Satoshi)
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
}, 5 );

// 4. SCHEMA MARKUP (SEO für Startseite)
add_action( 'wp_head', function () {
    if ( ! is_front_page() ) { return; }
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
            }
        ]
    }
    </script>
    <?php
}, 10 );