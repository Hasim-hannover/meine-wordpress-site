<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * = "================================================================="
 * Blocksy Child Theme: functions.php (Finale & vollständige Version)
 * "================================================================="
 * Enthält alle Funktionen (Fonts, SEO, etc.). Der Custom Header ist
 * jetzt aktiviert.
 */

// -------------------------------------------------------------------
// 1. SCHALTER: Blocksy-Header entfernen & eigenen Header laden
// -------------------------------------------------------------------
// Dieser Code ist jetzt AKTIV.
function hu_override_blocksy_header() {
    remove_action('blocksy:header:render', 'blocksy_output_header');
    add_action('blocksy:header:render', function() {
        get_template_part('template-parts/header/site-header');
    });
}
add_action('after_setup_theme', 'hu_override_blocksy_header');


// -------------------------------------------------------------------
// 2. Alle Styles & Scripts laden
// -------------------------------------------------------------------
add_action('wp_enqueue_scripts', function () {
    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();

    // -- Parent- und Child-Theme Haupt-Stylesheets --
    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css', [], null);
    if (file_exists($base . '/style.css')) {
        wp_enqueue_style('blocksy-child-style', $base_uri . '/style.css', ['blocksy-parent-style'], filemtime($base . '/style.css'));
    }

    // -- Eigene Header Assets (werden jetzt verwendet) --
    $header_css = $base . '/assets/css/header.css';
    if (file_exists($header_css)) {
        wp_enqueue_style('hu-header-styles', $base_uri . '/assets/css/header.css', [], filemtime($header_css));
    }
    $header_js = $base . '/assets/js/header.js';
    if (file_exists($header_js)) {
        wp_enqueue_script('hu-header-script', $base_uri . '/assets/js/header.js', [], filemtime($header_js), true);
    }

    // -- Homepage-spezifische Assets --
    if (is_front_page()) {
        $homepage_css = $base . '/assets/css/homepage.css';
        if (file_exists($homepage_css)) {
            wp_enqueue_style('hu-homepage-styles', $base_uri . '/assets/css/homepage.css', [], filemtime($homepage_css));
        }
        $homepage_js = $base . '/assets/js/homepage.js';
        if (file_exists($homepage_js)) {
            wp_enqueue_script('hu-homepage-script', $base_uri . '/assets/js/homepage.js', [], filemtime($homepage_js), true);
        }
    }
}, 15);


// -------------------------------------------------------------------
// 3. Alle Inhalte für den <head> (Fonts, Meta, Schema, etc.)
// -------------------------------------------------------------------
add_action('wp_head', function () {
    // ---- Lokale Fonts ----
    $theme_uri = get_stylesheet_directory_uri();
    ?>
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2"    as="font" type="font/woff2" crossorigin="anonymous">
    <style id="blocksy-custom-fonts">
      @font-face{ font-family:'Satoshi'; src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2') format('woff2'); font-weight:400; font-style:normal; font-display:swap; }
      @font-face{ font-family:'Satoshi'; src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2') format('woff2'); font-weight:700; font-style:normal; font-display:swap; }
      body,button,input,textarea,select{ font-family:'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; font-weight:400; }
      h1,h2,h3,h4,h5,h6{ font-weight:700; }
    </style>
    <?php

    // ---- Customizer Helfer-Script ----
    if ( is_customize_preview() ) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded',function(){
          if(typeof wp!=='undefined' && wp.customize){
            wp.customize('font_family_primary',   s => s.set('Satoshi'));
            wp.customize('font_family_secondary', s => s.set('Satoshi'));
          }
        });
        </script>
        <?php
    }

    // ---- SEO Meta & JSON-LD (nur auf der Startseite) ----
    if ( ! is_front_page() ) return;

    $seo_plugin_active = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || class_exists('All_in_One_SEO_Pack');
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

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type' => 'WebSite',
                '@id'   => 'https://hasimuener.de/#website',
                'url'   => 'https://hasimuener.de/',
                'name'  => 'Hasim Üner',
                'inLanguage' => 'de-DE',
                'publisher'  => [ '@id' => 'https://hasimuener.de/#org' ],
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => 'https://hasimuener.de/?s={search_term_string}',
                    'query-input' => 'required name=search_term_string',
                ],
            ],
            [
                '@type' => 'WebPage',
                '@id'   => 'https://hasimuener.de/#webpage',
                'url'   => 'https://hasimuener.de/',
                'name'  => 'Shopify & WordPress Growth Architect | Hasim Üner Hannover',
                'isPartOf' => [ '@id' => 'https://hasimuener.de/#website' ],
                'about'    => [ '@id' => 'https://hasimuener.de/#org' ],
                'inLanguage' => 'de-DE',
                'primaryImageOfPage' => [
                    '@type' => 'ImageObject',
                    'url'   => 'https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp',
                ],
                'mainEntity' => [ '@id' => 'https://hasimuener.de/#org' ],
            ],
            [
                '@type' => 'ProfessionalService',
                '@id'   => 'https://hasimuener.de/#org',
                'name'  => 'Hasim Üner – Digital Growth Partner',
                'url'   => 'https://hasimuener.de/',
                'description' => 'Strategischer Growth-Partner für WordPress & Shopify: Entwicklung, SEO, Tracking und Conversion-Optimierung.',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url'   => 'https://hasimuener.de/wp-content/uploads/2025/08/cropped-Logo-hasim-uener-1.webp',
                ],
                'image' => [
                    '@type' => 'ImageObject',
                    'url'   => 'https://hasimuener.de/wp-content/uploads/2025/09/Gemini_Generated_Image_ku26wmku26wmku26.webp',
                ],
                'telephone' => '+49 176 81407134',
                'email'     => 'hallo@hasimuener.de',
                'address'   => [
                    '@type' => 'PostalAddress',
                    'streetAddress'   => 'Warschauer Str. 5',
                    'postalCode'      => '30982',
                    'addressLocality' => 'Pattensen',
                    'addressRegion'   => 'Niedersachsen',
                    'addressCountry'  => 'DE',
                ],
                'geo' => [
                    '@type' => 'GeoCoordinates',
                    'latitude'  => 52.27419,
                    'longitude' => 9.73462,
                ],
                'areaServed' => ['Hannover','Niedersachsen','DACH'],
                'openingHoursSpecification' => [[
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday'],
                    'opens'  => '08:30',
                    'closes' => '16:00',
                ]],
                'priceRange' => '€€€',
                'founder'   => [ '@id' => 'https://hasimuener.de/#person' ],
                'owner'     => [ '@id' => 'https://hasimuener.de/#person' ],
                'sameAs'    => ['https://www.linkedin.com/in/hasim-uener/'],
                'contactPoint' => [[
                    '@type' => 'ContactPoint',
                    'contactType' => 'customer service',
                    'email' => 'hallo@hasimuener.de',
                    'telephone' => '+49 176 81407134',
                    'availableLanguage' => ['de','en'],
                    'areaServed' => ['DE','AT','CH'],
                ]],
                'hasOfferCatalog' => [
                    '@type' => 'OfferCatalog',
                    'name'  => 'Kernleistungen',
                    'itemListElement' => [
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'Shopify Lösungen','url'=>'https://hasimuener.de/shopify-agentur-hannover/']],
                        ['@type'=>'Offer','itemOffered'=>['@type'=>'Service','name'=>'WordPress Lösungen','url'=>'https://hasimuener.de/wordpress-agentur-hannover/']],
                    ],
                ],
            ],
            [
                '@type' => 'FAQPage',
                '@id'   => 'https://hasimuener.de/#faq',
                'mainEntity' => [
                    ['@type'=>'Question','name'=>'Wie schnell kann unser Projekt starten?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Nach unserem Erstgespräch meist innerhalb von 3–5 Werktagen. Einfache WordPress-Sites sind oft in 2–3 Wochen live, komplexere E-Commerce-Projekte in 4–8 Wochen.']],
                    ['@type'=>'Question','name'=>'Was kostet eine professionelle Website?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Starter-Projekte beginnen ab 3.500€. Im Erstgespräch klären wir den Bedarf und erstellen ein passgenaues Angebot.']],
                    ['@type'=>'Question','name'=>'Bieten Sie auch Wartung & Support an?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Ja. Flexible Service-Pakete für Updates, Backups, Sicherheits-Checks und Performance-Monitoring.']],
                    ['@type'=>'Question','name'=>'Wie wird der Erfolg des Projekts gemessen?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Über KPIs wie Conversion-Rate, ROAS, CPL oder organischen Traffic. Sie erhalten transparente Reportings.']],
                ],
            ],
            [
                '@type' => 'Person',
                '@id'   => 'https://hasimuener.de/#person',
                'name'  => 'Hasim Üner',
                'url'   => 'https://hasimuener.de/ueber-mich/',
                'image' => [
                    '@type' => 'ImageObject',
                    'url'   => 'https://hasimuener.de/wp-content/uploads/2024/09/1f15d682-34e3-475d-9be1-add51e9b9d3b.jpg',
                ],
                'jobTitle' => 'Growth Architect – WordPress & Shopify',
                'worksFor' => [ '@id' => 'https://hasimuener.de/#org' ],
                'sameAs'   => ['https://www.linkedin.com/in/hasim-uener/'],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';

}, 1);


// -------------------------------------------------------------------
// 4. Helfer- & Server-Funktionen
// -------------------------------------------------------------------

/**
 * Setzt langlebige Cache-Header für Font-Dateien.
 */
add_action('send_headers', function () {
    if ( empty($_SERVER['REQUEST_URI']) ) return;
    if ( preg_match('~\.(woff2|woff|ttf|otf)$~i', $_SERVER['REQUEST_URI']) ) {
        header('Cache-Control: public, max-age=31536000, immutable');
        header_remove('Pragma');
        header_remove('Expires');
    }
});

/**
 * Lädt Ajax-Handler, falls die Datei existiert.
 */
$ajax_file = get_stylesheet_directory() . '/inc/ajax-generate-report.php';
if ( file_exists($ajax_file) ) {
    require_once $ajax_file;
}

