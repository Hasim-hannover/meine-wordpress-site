<?php
// === Setup laden (falls du es nutzt) ===
require_once get_stylesheet_directory() . '/inc/theme-setup.php';

// === Schema laden ===
require_once get_stylesheet_directory() . '/inc/schema.php';

// === Assets einhängen ===
add_action('wp_enqueue_scripts', function () {
    // Parent + Child
    wp_enqueue_style(
        'blocksy-child-style',
        get_stylesheet_uri(),
        [], // Blocksy lädt parent idR. selbst; wenn doppelt: parent-Style manuell entfernen
        filemtime(get_stylesheet_directory() . '/style.css')
    );

    // Globales JS auf JEDER Seite
    $site_js_path = get_stylesheet_directory() . '/assets/js/site.js';
    if (file_exists($site_js_path)) {
        wp_enqueue_script(
            'hu-site-script',
            get_stylesheet_directory_uri() . '/assets/js/site.js',
            [],
            filemtime($site_js_path),
            true
        );
    }
}, 20);

// === Schema im <head> ausgeben (auf JEDER Seite) ===
add_action('wp_head', function () {
    if (!function_exists('hu_get_schema')) return;
    $schema = hu_get_schema(); // aus inc/schema.php
    if (!empty($schema)) {
        echo '<script type="application/ld+json">' .
            wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
            '</script>';
    }
}, 20);
