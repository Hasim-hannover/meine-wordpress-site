<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Lädt alle globalen Styles, Scripts und Konfigurationen für das Theme.
 */

// 1. Alle globalen Styles & Scripts laden
add_action('wp_enqueue_scripts', function () {
    $base     = get_stylesheet_directory();
    $base_uri = get_stylesheet_directory_uri();

    // -- Parent- und Child-Theme Haupt-Stylesheets --
    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css', [], null);
    if (file_exists($base . '/style.css')) {
        wp_enqueue_style('blocksy-child-style', $base_uri . '/style.css', ['blocksy-parent-style'], filemtime($base . '/style.css'));
    }

    // -- HINWEIS: Diese Homepage-Assets werden wir später entfernen, sobald alle Blöcke umgebaut sind --
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

    // -- NEU: FAQ‑CSS und -JS einbinden --
    $faq_css = $base . '/assets/css/faq.css';
    if (file_exists($faq_css)) {
        wp_enqueue_style('hu-faq-styles', $base_uri . '/assets/css/faq.css', [], filemtime($faq_css));
    }

    $faq_js = $base . '/assets/js/faq.js';
    if (file_exists($faq_js)) {
        wp_enqueue_script('hu-faq-script', $base_uri . '/assets/js/faq.js', [], filemtime($faq_js), true);
    }

}, 15);


// 2. Alle Inhalte für den <head> (Fonts, Meta, Schema, etc.)
add_action('wp_head', function () {
    // ---- Lokale Fonts ----
    $theme_uri = get_stylesheet_directory_uri();
    ?>
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2"    as="font" type="font/woff2" crossorigin="anonymous">
    <style id="blocksy-custom-fonts">
      @font-face{ font-family:'Satoshi'; src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Regular.woff2') format('woff2'); font-weight:400; font-style:normal; font-display:swap; }
      @font-face{ font-family:'Satoshi'; src:url('<?php echo esc_url($theme_uri); ?>/fonts/Satoshi-Bold.woff2') format('woff2'); font-weight:700; font-style:normal; font-display:swap; }
    </style>
    <?php

    // ---- SEO Meta & JSON-LD (nur auf der Startseite) ----
    if ( ! is_front_page() ) return;

    $seo_plugin_active = defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION') || class_exists('All_in_One_SEO_Pack');
    if ( ! $seo_plugin_active ) {
        ?>
        <link rel="canonical" href="https://hasimuener.de/">
        <meta name="description" content="Ihr strategischer Partner für digitales Wachstum. Gemeinsam finden wir den klaren Weg zum Erfolg für Ihr Shopify- oder WordPress-Projekt in Hannover.">
        <?php
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            // Dein kompletter Schema-Code kommt hier rein...
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>';

}, 1);

// ... hier könnten später weitere allgemeine Helferfunktionen rein ...
