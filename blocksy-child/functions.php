<?php
/**
 * Blocksy Child Theme Functions
 *
 * @package Blocksy Child
 */

// Korrektes Einbinden von Parent- und Child-Theme-Stylesheets
add_action('wp_enqueue_scripts', 'hu_enqueue_theme_styles');
function hu_enqueue_theme_styles()
{
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
        filemtime(get_stylesheet_directory() . '/style.css')
    );
}


// Assets für die Startseite (front-page.php) laden
add_action('wp_enqueue_scripts', 'hu_enqueue_homepage_assets');
function hu_enqueue_homepage_assets()
{
    if (is_front_page()) {
        $css_path = get_stylesheet_directory() . '/assets/css/homepage.css';
        $js_path = get_stylesheet_directory() . '/assets/js/homepage.js';

        if (file_exists($css_path)) {
            wp_enqueue_style(
                'hu-homepage-style',
                get_stylesheet_directory_uri() . '/assets/css/homepage.css',
                [],
                filemtime($css_path)
            );
        }

        if (file_exists($js_path)) {
            wp_enqueue_script(
                'hu-homepage-script',
                get_stylesheet_directory_uri() . '/assets/js/homepage.js',
                [], // Keine Abhängigkeiten wie jQuery nötig -> effizienter
                filemtime($js_path),
                true
            );
        }
    }
}


// Assets für die Blog-Übersichtsseite (home.php) laden
add_action('wp_enqueue_scripts', 'hu_enqueue_blog_archive_assets');
function hu_enqueue_blog_archive_assets()
{
    if (is_home()) {
        $css_path = get_stylesheet_directory() . '/assets/css/blog-archive.css';
        if (file_exists($css_path)) {
            wp_enqueue_style(
                'hu-blog-archive-style',
                get_stylesheet_directory_uri() . '/assets/css/blog-archive.css',
                [],
                filemtime($css_path)
            );
        }
    }
}


// Assets für einzelne Blogartikel (single-post.php) laden
add_action('wp_enqueue_scripts', 'hu_enqueue_single_post_assets');
function hu_enqueue_single_post_assets()
{
    if (is_singular('post')) {
        $css_path = get_stylesheet_directory() . '/assets/css/blog-single.css';
        $js_path = get_stylesheet_directory() . '/assets/js/blog-single.js';

        if (file_exists($css_path)) {
            wp_enqueue_style(
                'hu-single-post-style',
                get_stylesheet_directory_uri() . '/assets/css/blog-single.css',
                [],
                filemtime($css_path)
            );
        }

        if (file_exists($js_path)) {
            wp_enqueue_script(
                'hu-single-post-script',
                get_stylesheet_directory_uri() . '/assets/js/blog-single.js',
                [],
                filemtime($js_path),
                true
            );
        }
    }
}

