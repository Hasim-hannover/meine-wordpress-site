<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * ===================================================================
 * Blocksy Child Theme: functions.php
 * ===================================================================
 *
 * Hauptfunktionen für das Child-Theme.
 *
 * 1.  Core Setup:      Parent- und Child-Styles laden, Cache-Busting.
 * 2.  Fonts:           Lokale Fonts laden, Preload und Caching-Header.
 * 3.  Asset Loading:   Laden von CSS- & JS-Dateien nur auf der Startseite.
 * 4.  SEO & Meta:      Meta-Tags und JSON-LD Schema für die Startseite.
 * 5.  Custom Header:   Eigener Header mit Navigationsmenü und CTA.
 * 6.  Helpers & Ajax:  Optionale Helfer und Einbindung von Ajax-Endpunkten.
 *
 * @package Blocksy-Child
 * @author Hasim Üner
 * @version 1.0
 */


/*
 * ===================================================================
 * 1. Core Setup
 * ===================================================================
 */

/**
 * Lädt Parent- und Child-Stylesheets mit Cache-Busting.
 * Die Version wird aus dem Zeitstempel der letzten Dateiänderung generiert.
 */
add_action('wp_enqueue_scripts', function () {
    // Pfade zu den CSS-Dateien
    $child_css_path  = get_stylesheet_directory() . '/style.css';
    $parent_css_path = get_template_directory()   . '/style.css';

    // Dateizeitstempel für Cache-Busting
    $ver_child  = file_exists($child_css_path)  ? filemtime($child_css_path)  : wp_get_theme()->get('Version');
    $ver_parent = file_exists($parent_css_path) ? filemtime($parent_css_path) : null;

    // Stylesheets in die Warteschlange einreihen
    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css', [], $ver_parent);
    wp_enqueue_style('blocksy-child-style',  get_stylesheet_directory_uri() . '/style.css', ['blocksy-parent-style'], $ver_child);
}, 10);


/*
 * ===================================================================
 * 2. Fonts
 * ===================================================================
 */

/**
 * Bindet lokale Fonts ein, setzt Preload-Header und fügt Caching-Header hinzu.
 */
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
        font-weight:700; font-style:normal; font-display:swap;
      }
      /* Globale Font-Zuweisung */
      body,button,input,textarea,select{
        font-family:'Satoshi', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-weight:400;
      }
      h1,h2,h3,h4,h5,h6{ font-weight:700; }
    </style>
    <?php
}, 1);

/**
 * (Optional) Setzt die Default-Schrift im Blocksy Customizer auf 'Satoshi'.
 * Dies ist nur eine visuelle Hilfe im Backend.
 */
add_action('wp_head', function () {
    if ( ! is_customize_preview() ) return;
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
}, 100);

/**
 * Setzt langlebige Cache-Header für Font-Dateien.
 * Kompatibel mit Hostings wie Raidboxes.
 */
add_action('send_headers', function () {
    if ( empty($_SERVER['REQUEST_URI']) ) return;
    if ( preg_match('~\.(woff2|woff|ttf|otf)$~i', $_SERVER['REQUEST_URI']) ) {
        header('Cache-Control: public, max-age=31536000, immutable');
        header_remove('Pragma');
        header_remove('Expires');
    }
});


/*
 * ===================================================================
 * 3. Asset Loading (Homepage-spezifisch)
 * ===================================================================
 */

/**
 * Lädt CSS- und JS-Dateien aus dem 'src'-Ordner nur auf der Startseite.
 * Wird früh ausgeführt (Priorität 5).
 */
add_action('wp_enqueue_scripts', function () {
    if ( ! is_front_page() ) return;

    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();
    $ver_src_css = $base . '/assets/src/css/main.css';
    $ver_src_js  = $base . '/assets/src/js/main.js';

    // CSS aus 'src' laden
    if ( file_exists($ver_src_css) ) {
        wp_enqueue_style('child-src-styles', $base_uri . '/assets/src/css/main.css', [], filemtime($ver_src_css));
    }

    // JS aus 'src' laden (im Footer, mit defer)
    if ( file_exists($ver_src_js) ) {
        wp_enqueue_script('child-src-script', $base_uri . '/assets/src/js/main.js', [], filemtime($ver_src_js), true);
        wp_script_add_data('child-src-script', 'defer', true);
    }
}, 5);


/**
 * Lädt die primären CSS- und JS-Dateien für die Startseite.
 * Wird nach den 'src'-Assets geladen (Priorität 10).
 */
add_action('wp_enqueue_scripts', function () {
    if ( ! is_front_page() ) return;

    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();
    $ver_home_css = $base . '/assets/css/homepage.css';
    $ver_home_js  = $base . '/assets/js/homepage.js';

    // Homepage CSS
    if ( file_exists($ver_home_css) ) {
        wp_enqueue_style('hu-homepage-styles', $base_uri . '/assets/css/homepage.css', [], filemtime($ver_home_css));
    }

    // Homepage JS (im Footer, mit defer)
    if ( file_exists($ver_home_js) ) {
        wp_enqueue_script('hu-homepage-script', $base_uri . '/assets/js/homepage.js', [], filemtime($ver_home_js), true);
        wp_script_add_data('hu-homepage-script', 'defer', true);
    }
}, 10);


/*
 * ===================================================================
 * 4. SEO & Meta (Homepage-spezifisch)
 * ===================================================================
 */

/**
 * Fügt Meta-Tags (OG, Twitter) und JSON-LD Schema zum Head der Startseite hinzu.
 */
add_action('wp_head', function () {
    if ( ! is_front_page() ) return;

    // Meta/OG-Tags nur ausgeben, wenn kein gängiges SEO-Plugin aktiv ist
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

    // JSON-LD Schema für Rich Snippets
    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            // ... (Hier bleibt dein komplettes, gut strukturiertes JSON-LD)
            [
                '@type' => 'WebSite',
                '@id'   => 'https://hasimuener.de/#website',
                'url'   => 'https://hasimuener.de/',
                'name'  => 'Hasim Üner',
                'inLanguage' => 'de-DE',
                'publisher'  => [ '@id' => 'https://hasimuener.de/#org' ],
            ],
            [
                '@type' => 'ProfessionalService',
                '@id'   => 'https://hasimuener.de/#org',
                'name'  => 'Hasim Üner – Digital Growth Partner',
                'url'   => 'https://hasimuener.de/',
                 'address'   => [
                    '@type' => 'PostalAddress',
                    'streetAddress'   => 'Warschauer Str. 5',
                    'postalCode'      => '30982',
                    'addressLocality' => 'Pattensen',
                    'addressRegion'   => 'Niedersachsen',
                    'addressCountry'  => 'DE',
                ]
                // ... etc.
            ],
            // ... etc.
        ],
    ];

    echo '<script type="application/ld+json">' .
         wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) .
         '</script>';
}, 20);


/*
 * ===================================================================
 * 5. Custom Header
 * ===================================================================
 */

/**
 * Registriert eine neue Menü-Position 'hu_header'.
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'hu_header' => __('HU Header Navigation', 'blocksy-child'),
    ]);
});

/**
 * Fügt das benutzerdefinierte Header-Markup direkt nach dem <body>-Tag ein.
 */
add_action('wp_body_open', function () {
    ?>
    <header class="hu-header" role="banner">
      <div class="hu-header__inner">
        <a class="hu-logo" href="<?php echo esc_url( home_url('/') ); ?>" aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?>">
          <?php
          if ( function_exists('the_custom_logo') && has_custom_logo() ) {
              the_custom_logo();
          } else {
              echo '<strong class="hu-logo__text">'. esc_html( get_bloginfo('name') ) .'</strong>';
          }
          ?>
        </a>

        <nav id="hu-nav" class="hu-nav" role="navigation" aria-label="<?php esc_attr_e('Hauptmenü','blocksy-child'); ?>">
          <?php
          wp_nav_menu([
              'theme_location' => 'hu_header',
              'container'      => false,
              'menu_class'     => 'hu-menu',
              'fallback_cb'    => '__return_false',
              'depth'          => 2, // Erlaubt ein Level an Untermenüs
          ]);
          ?>
          <a class="hu-cta" href="/kontakt/">Gratis Growth Blueprint</a>
        </nav>

        </div>
    </header>
    <script>
      // Minimalistisches JS für ein Burger-Menü-Toggle
      (function(){
        var burger = document.querySelector('.hu-burger');
        var nav    = document.getElementById('hu-nav');
        if ( !burger || !nav ) return;

        burger.addEventListener('click', function(){
          var isExpanded = burger.getAttribute('aria-expanded') === 'true';
          burger.setAttribute('aria-expanded', !isExpanded);
          nav.classList.toggle('is-open');
        });
      })();
    </script>
    <?php
}, 5);


/*
 * ===================================================================
 * 6. Helpers & Ajax
 * ===================================================================
 */

/**
 * (Optional) Raidboxes Dynamic Cache für bestimmte Seiten umgehen.
 * In der Regel NICHT notwendig.
 */
// add_filter('wp_headers', function($headers){
//     $headers['X-Raidboxes-Dynamic-Cache'] = 'bypass';
//     return $headers;
// });

/**
 * Lädt Ajax-Handler, falls die Datei existiert.
 */
$ajax_file = get_stylesheet_directory() . '/inc/ajax-generate-report.php';
if ( file_exists($ajax_file) ) {
    require_once $ajax_file;
}