<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Registriert alle benutzerdefinierten Blöcke mit der nativen WordPress-Funktion.
 */
add_action('init', 'hu_register_native_blocks');
function hu_register_native_blocks() {

    // Prüfen, ob die Funktion existiert (ab WP 5.0)
    if (!function_exists('register_block_type')) {
        return;
    }

    // Block 1: Der äußere Container
    register_block_type( get_stylesheet_directory() . '/blocks/faq-container', [
        'render_callback' => 'hu_render_block',
    ]);

    // Block 2: Das einzelne aufklappbare Item
    register_block_type( get_stylesheet_directory() . '/blocks/faq-item', [
        'render_callback' => 'hu_render_block',
    ]);
}

/**
 * Eine universelle Render-Funktion, die einfach die PHP-Datei des Blocks lädt.
 */
function hu_render_block($attributes, $content, $block) {
    // Baue den Pfad zur Template-Datei des Blocks zusammen
    $template_path = get_stylesheet_directory() . '/blocks/' . $block->name . '/' . $block->name . '.php';

    if (file_exists($template_path)) {
        ob_start();
        include $template_path;
        return ob_get_clean();
    }

    return '<div>Block Template not found: ' . esc_html($template_path) . '</div>';
}