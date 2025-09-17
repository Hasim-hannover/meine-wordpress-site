<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Blocksy Child – Fonts & Basics (Raidboxes-ready, ohne Cloudflare)
 * Champions-League-Version (optimiert: filemtime versioning, Reihenfolge, defer, nur Startseite)
 */

/* 1) Parent- und Child-Styles laden (mit Cache-Busting per filemtime) */
add_action('wp_enqueue_scripts', function () {
    $child_css_path  = get_stylesheet_directory() . '/style.css';
    $parent_css_path = get_template_directory()   . '/style.css';

    $ver_child  = file_exists($child_css_path)  ? filemtime($child_css_path)  : wp_get_theme()->get('Version');
    $ver_parent = file_exists($parent_css_path) ? filemtime($parent_css_path) : null;

    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css', [], $ver_parent);
    wp_enqueue_style('blocksy-child-style',  get_stylesheet_directory_uri() . '/style.css', ['blocksy-parent-style'], $ver_child);
}, 10);


/* 2) Fonts lokal einbinden + Preload (sehr früh) */
add_action('wp_head', function () {
    $theme_uri = get_stylesheet_directory_uri();
    ?>
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2"    as="font" type="font/woff2" crossorigin="anonymous">

    <style id="blocksy-custom-fonts">
      @font-face{
        font-family:'Satoshi';
        src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2') format('woff2');
        font-weight:400; font-style:normal; font-display:swap;
      }
      @font-face{
        font-family:'Satoshi';
        src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2') format('woff2');
        font-weight:700; /* korrigiert: kein Intervall, fester Bold-Wert */
        font-style:normal; font-display:swap;
      }
      body,button,input,textarea,select{
        font-family:'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-weight:400;
      }
      h1,h2,h3,h4,h5,h6{ font-weight:700; }
    </style>
    <?php
}, 1);


/* 3) (Optional) Blocksy-Customizer Default auf Satoshi setzen (wirkt nur im Customizer) */
add_action('wp_head', function () {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
      if(typeof wp!=='undefined' && wp.customize){
        wp.customize('font_family_primary',   s=>s.set('Satoshi'));
        wp.customize('font_family_secondary', s=>s.set('Satoshi'));
      }
    });
    </script>
    <?php
}, 100);


/* 4) (Optional) Schlanke Cache-Header NUR für Font-Dateien – Raidboxes-kompatibel */
add_action('send_headers', function () {
    if (empty($_SERVER['REQUEST_URI'])) return;
    $uri = $_SERVER['REQUEST_URI'];
    if (preg_match('~\.(woff2|woff|ttf|otf)$~i', $uri)) {
        header('Cache-Control: public, max-age=31536000, immutable'); // 1 Jahr
        header_remove('Pragma');
        header_remove('Expires');
    }
});


/* 5) (Nur falls du dynamische Seiten NICHT cachen willst – normalerweise NICHT nötig) */
// add_filter('wp_headers', function($headers){
//     $headers['X-Raidboxes-Dynamic-Cache'] = 'bypass';
//     return $headers;
// });


/* 6) Ajax-Endpunkt für PDF-Report einbinden (falls vorhanden) */
$ajax_file = get_stylesheet_directory() . '/inc/ajax-generate-report.php';
if ( file_exists($ajax_file) ) { require_once $ajax_file; }


// ===================================================================
// START: Code für die Startseite
// ===================================================================

/**
 * 7) src-Assets NUR auf der Startseite laden – FRÜHER als homepage.css/js
 *    (Prio 5 vor Standard-10, plus filemtime-Versionen, plus defer)
 */
add_action('wp_enqueue_scripts', function () {
    if ( ! is_front_page() ) return;

    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();

    // CSS aus src
    $css_src = $base . '/assets/src/css/main.css';
    if ( file_exists($css_src) ) {
        wp_enqueue_style(
            'child-src',
            $base_uri . '/assets/src/css/main.css',
            [],
            filemtime($css_src)
        );
    }

    // JS aus src
    $js_src = $base . '/assets/src/js/main.js';
    if ( file_exists($js_src) ) {
        wp_enqueue_script(
            'child-src',
            $base_uri . '/assets/src/js/main.js',
            [],
            filemtime($js_src),
            true // im Footer
        );
        if ( function_exists('wp_script_add_data') ) {
            wp_script_add_data('child-src', 'defer', true);
        }
    }
}, 5); // vor hu_homepage_assets()


/**
 * 8) Stile und Skripte für die Startseite (buildfreie Assets)
 */
add_action('wp_enqueue_scripts', 'hu_homepage_assets', 10);
function hu_homepage_assets() {
    if ( ! is_front_page() ) return;

    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();

    // CSS
    $css = $base . '/assets/css/homepage.css';
    if ( file_exists($css) ) {
        wp_enqueue_style(
            'hu-homepage-styles',
            $base_uri . '/assets/css/homepage.css',
            [],
            filemtime($css)
        );
    }

    // JS
    $js = $base . '/assets/js/homepage.js';
    if ( file_exists($js) ) {
        wp_enqueue_script(
            'hu-homepage-script',
            $base_uri . '/assets/js/homepage.js',
            [],
            filemtime($js),
            true
        );
        if ( function_exists('wp_script_add_data') ) {
            wp_script_add_data('hu-homepage-script', 'defer', true);
        }
    }
}


/**
 * 9) Meta-Tags und JSON-LD in den <head> der Startseite einfügen
 */
add_action('wp_head', 'hu_homepage_head_content', 20);
function hu_homepage_head_content() {
    if ( ! is_front_page() ) return;

    // gängige SEO-Plugins erkennen
    $seo_plugin_active = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || class_exists('All_in_One_SEO_Pack');

    // ===== Meta/OG/Twitter – nur wenn KEIN SEO-Plugin aktiv ist =====
    if ( ! $seo_plugin_active ) {
    ?>
    <link rel="canonical" href="https://hasimuener.de/">
    <meta name="description" content="Ihr strategischer Partner für digitales Wachstum. Gemeinsam finden wir den klaren Weg zum Erfolg für Ihr Shopify- oder WordPress-Projekt in Hannover.">
    <meta name="theme-color" content="#0d0d0d">
    <meta property="og:locale" content="de_DE">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://hasimuener.de/">
    <meta property="og:site_name" content="Hasim Üner – Digital Growth Partner">
    <meta property="og:title" content="Shopify &amp; WordPress Growth Architect | Hasim Üner Hannover">
    <meta property="og:description" content="Ihr strategischer Partner für digitales Wachstum. Ich verbinde Technologie & Marketing zu einer ganzheitlichen Strategie für messbaren Erfolg.">
    <meta property="og:image" content="https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Shopify &amp; WordPress Growth Architect | Hasim Üner Hannover">
    <meta name="twitter:description" content="Ihr strategischer Partner für digitales Wachstum. Ganzheitliche Strategie für messbaren Erfolg.">
    <meta name="twitter:image" content="https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp">
    <?php
    }

    // ===== JSON-LD Schema =====
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "https://hasimuener.de/#website",
      "url": "https://hasimuener.de/",
      "name": "Hasim Üner",
      "inLanguage": "de-DE",
      "publisher": { "@id": "https://hasimuener.de/#org" },
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://hasimuener.de/?s={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "WebPage",
      "@id": "https://hasimuener.de/#webpage",
      "url": "https://hasimuener.de/",
      "name": "Shopify & WordPress Growth Architect | Hasim Üner Hannover",
      "isPartOf": { "@id": "https://hasimuener.de/#website" },
      "about": { "@id": "https://hasimuener.de/#org" },
      "inLanguage": "de-DE",
      "primaryImageOfPage": {
        "@type": "ImageObject",
        "url": "https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp"
      },
      "mainEntity": { "@id": "https://hasimuener.de/#org" }
    },
    {
      "@type": "ProfessionalService",
      "@id": "https://hasimuener.de/#org",
      "name": "Hasim Üner – Digital Growth Partner",
      "url": "https://hasimuener.de/",
      "description": "Strategischer Growth-Partner für WordPress & Shopify: Entwicklung, SEO, Tracking und Conversion-Optimierung.",
      "logo": { "@type": "ImageObject", "url": "https://hasimuener.de/wp-content/uploads/2025/08/cropped-Logo-hasim-uener-1.webp" },
      "image": { "@type": "ImageObject", "url": "https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp" },
      "telephone": "+49 176 81407134",
      "email": "hallo@hasimuener.de",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Warschauer Str. 5",
        "postalCode": "30982",
        "addressLocality": "Pattensen",
        "addressRegion": "Niedersachsen",
        "addressCountry": "DE"
      },
      "geo": { "@type": "GeoCoordinates", "latitude": 52.27419, "longitude": 9.73462 },
      "areaServed": ["Hannover","Niedersachsen","DACH"],
      "openingHoursSpecification": [
        { "@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday"], "opens": "08:30", "closes": "16:00" }
      ],
      "priceRange": "€€€",
      "founder": { "@id": "https://hasimuener.de/#person" },
      "owner": { "@id": "https://hasimuener.de/#person" },
      "sameAs": ["https://www.linkedin.com/in/hasim-uener/"],
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "contactType": "customer service",
          "email": "hallo@hasimuener.de",
          "telephone": "+49 176 81407134",
          "availableLanguage": ["de","en"],
          "areaServed": ["DE","AT","CH"]
        }
      ],
      "hasOfferCatalog": {
        "@type": "OfferCatalog",
        "name": "Kernleistungen",
        "itemListElement": [
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Shopify Lösungen", "url": "https://hasimuener.de/shopify-agentur-hannover/" } },
          { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "WordPress Lösungen", "url": "https://hasimuener.de/wordpress-agentur-hannover/" } }
        ]
      }
    },
    {
      "@type": "FAQPage",
      "@id": "https://hasimuener.de/#faq",
      "mainEntity": [
        { "@type": "Question", "name": "Wie schnell kann unser Projekt starten?", "acceptedAnswer": { "@type": "Answer", "text": "Nach unserem Erstgespräch meist innerhalb von 3–5 Werktagen. Einfache WordPress-Sites sind oft in 2–3 Wochen live, komplexere E-Commerce-Projekte in 4–8 Wochen." } },
        { "@type": "Question", "name": "Was kostet eine professionelle Website?", "acceptedAnswer": { "@type": "Answer", "text": "Starter-Projekte beginnen ab 3.500€. Im Erstgespräch klären wir den Bedarf und erstellen ein passgenaues Angebot." } },
        { "@type": "Question", "name": "Bieten Sie auch Wartung & Support an?", "acceptedAnswer": { "@type": "Answer", "text": "Ja. Flexible Service-Pakete für Updates, Backups, Sicherheits-Checks und Performance-Monitoring." } },
        { "@type": "Question", "name": "Wie wird der Erfolg des Projekts gemessen?", "acceptedAnswer": { "@type": "Answer", "text": "Über KPIs wie Conversion-Rate, ROAS, CPL oder organischen Traffic. Sie erhalten transparente Reportings." } }
      ]
    },
    {
      "@type": "Person",
      "@id": "https://hasimuener.de/#person",
      "name": "Hasim Üner",
      "url": "https://hasimuener.de/ueber-mich/",
      "image": { "@type": "ImageObject", "url": "https://hasimuener.de/wp-content/uploads/2024/09/1f15d682-34e3-475d-9be1-add51e9b9d3b.jpg" },
      "jobTitle": "Growth Architect – WordPress & Shopify",
      "worksFor": { "@id": "https://hasimuener.de/#org" },
      "sameAs": ["https://www.linkedin.com/in/hasim-uener/"]
    }
  ]
}
</script>
<?php
} // Ende hu_homepage_head_content()
