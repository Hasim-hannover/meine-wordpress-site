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
    "@graph": [
      {
        "@type": "Organization",
        "name": "Hasim Üner - Growth Partner",
        "url": "https://hasimuener.de/",
        "logo": "https://hasimuener.de/wp-content/uploads/2025/08/Logo_Hasim-Uener-.png",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Warschauer Str. 5",
          "addressLocality": "Pattensen",
          "addressRegion": "Niedersachsen",
          "postalCode": "30982",
          "addressCountry": "DE"
        },
        "contactPoint": {
          "@type": "ContactPoint",
          "email": "hallo@hasimuener.de",
          "contactType": "Customer Service"
        }
      },
      {
        "@type": "Person",
        "name": "Hasim Üner",
        "url": "https://hasimuener.de/uber-mich/",
        "jobTitle": "Growth Partner & Digital Architect",
        "worksFor": {
          "@type": "Organization",
          "name": "Hasim Üner - Growth Partner"
        },
        "sameAs": [
          "https://www.linkedin.com/in/hasim-uener/"
        ]
      },
      {
        "@type": "FAQPage",
        "mainEntity": [
          {
            "@type": "Question",
            "name": "Wie schnell kann unser Projekt starten?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Nach unserem Erstgespräch meist innerhalb von 3-5 Werktagen. Einfache WordPress-Sites sind oft in 2-3 Wochen live, komplexere E-Commerce Projekte in 4-8 Wochen."
            }
          },
          {
            "@type": "Question",
            "name": "Was kostet eine professionelle Website?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Starter-Projekte beginnen ab 3.500€. In unserem kostenlosen Erstgespräch ermitteln wir den genauen Bedarf und erstellen ein passgenaues Angebot."
            }
          },
          {
            "@type": "Question",
            "name": "Bieten Sie auch Wartung & Support an?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Ja. Ich biete flexible Service-Pakete für regelmäßige Updates, Backups, Sicherheits-Checks und Performance-Monitoring an."
            }
          },
          {
            "@type": "Question",
            "name": "Wie wird der Erfolg des Projekts gemessen?",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "Anhand klar definierter KPIs, die wir gemeinsam festlegen: z.B. Conversion-Rate, ROAS, Cost-per-Lead oder organischen Traffic. Sie erhalten transparente Reportings."
            }
          }
        ]
      },
      {
        "@type": "Service",
        "name": "E-Commerce & Shopify Lösungen",
        "serviceType": "Shopify Development",
        "provider": {
          "@type": "Person",
          "name": "Hasim Üner"
        },
        "description": "Für Online-Shops, die nicht nur gut aussehen, sondern vor allem verkaufen und durch Daten profitabel wachsen sollen."
      },
      {
        "@type": "Service",
        "name": "Website & WordPress Lösungen",
        "serviceType": "WordPress Development",
        "provider": {
          "@type": "Person",
          "name": "Hasim Üner"
        },
        "description": "Für Dienstleister & B2B-Unternehmen, deren Website als überzeugende Lead-Quelle arbeiten und die Marke optimal repräsentieren soll."
      }
    ]
  }
  </script>
    <?php
}, 1 );