<?php
/**
 * Blocksy Child Theme Functions
 * Die finale, reparierte und vollständige Version, die alle Systeme vereint.
 *
 * @package Blocksy Child
 */

// =============================================================================
// SCHRITT 1: DEIN ÖKOSYSTEM WIEDERHERSTELLEN
// Diese Zeile ist entscheidend. Sie lädt deine Setup-Datei, die dann
// dein Schema und andere wichtige Funktionen lädt.
// =============================================================================
require_once get_stylesheet_directory() . '/inc/theme-setup.php';


// =============================================================================
// SCHRITT 2: EFFIZIENTES LADEN VON CSS & JAVASCRIPT
// Dies ist unsere optimierte Funktion, die sicherstellt, dass die richtigen
// Dateien nur auf den richtigen Seiten geladen werden.
// =============================================================================
add_action('wp_enqueue_scripts', 'hu_load_theme_assets', 20);

function hu_load_theme_assets()
{
    // Lade die Parent- und Child-Haupt-Stylesheets auf JEDER Seite.
    wp_enqueue_style(
        'blocksy-parent-style',
        get_template_directory_uri() . '/style.css',
        [],
        wp_get_theme('blocksy')->get('Version')
    );

    wp_enqueue_style(
        'blocksy-child-style',
        get_stylesheet_uri(),
        ['blocksy-parent-style'],
        filemtime(get_stylesheet_directory() . '/style.css') // Cache-Buster
    );

    // Lade die spezifischen Assets nur dort, wo sie gebraucht werden.
    if (is_front_page()) {
        // --- NUR FÜR DIE STARTSEITE ---
        $css_path_home = get_stylesheet_directory() . '/assets/css/homepage.css';
        $js_path_home = get_stylesheet_directory() . '/assets/js/homepage.js';

        if (file_exists($css_path_home)) {
            wp_enqueue_style(
                'hu-homepage-style',
                get_stylesheet_directory_uri() . '/assets/css/homepage.css',
                [],
                filemtime($css_path_home) // Cache-Buster
            );
        }

        if (file_exists($js_path_home)) {
            wp_enqueue_script(
                'hu-homepage-script',
                get_stylesheet_directory_uri() . '/assets/js/homepage.js',
                [], // Keine Abhängigkeiten -> Effizient
                filemtime($js_path_home), // Cache-Buster
                true
            );
        }
    } elseif (is_home()) {
        // --- NUR FÜR DIE BLOG-ÜBERSICHT ---
        $css_path_archive = get_stylesheet_directory() . '/assets/css/blog-archive.css';
        if (file_exists($css_path_archive)) {
            wp_enqueue_style(
                'hu-blog-archive-style',
                get_stylesheet_directory_uri() . '/assets/css/blog-archive.css',
                [],
                filemtime($css_path_archive) // Cache-Buster
            );
        }
    } elseif (is_singular('post')) {
        // --- NUR FÜR EINZELNE BLOGARTIKEL ---
        $css_path_single = get_stylesheet_directory() . '/assets/css/blog-single.css';
        $js_path_single = get_stylesheet_directory() . '/assets/js/blog-single.js';

        if (file_exists($css_path_single)) {
            wp_enqueue_style(
                'hu-single-post-style',
                get_stylesheet_directory_uri() . '/assets/css/blog-single.css',
                [],
                filemtime($css_path_single) // Cache-Buster
            );
        }

        if (file_exists($js_path_single)) {
            wp_enqueue_script(
                'hu-single-post-script',
                get_stylesheet_directory_uri() . '/assets/js/blog-single.js',
                [],
                filemtime($js_path_single), // Cache-Buster
                true
            );
        }
    }
}

