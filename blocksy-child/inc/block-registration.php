<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Registriert alle benutzerdefinierten ACF Gutenberg Blöcke.
 * FINALE VERSION
 */
add_action('acf/init', 'hu_register_blocks');
function hu_register_blocks() {

    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Block 1: Der äußere Container
    acf_register_block_type([
        'name'            => 'faq-container',
        'title'           => __('FAQ Container'),
        'description'     => __('Ein Container für mehrere FAQ-Items.'),
        'render_template' => 'blocks/faq-container/faq-container.php',
        'category'        => 'layout',
        'icon'            => 'archive',
        'mode'            => 'preview',
        'supports'        => [
            'mode' => false,
            'align' => false,
        ],
    ]);

    // Block 2: Das einzelne aufklappbare Item
    acf_register_block_type([
        'name'            => 'faq-item',
        'title'           => __('FAQ Item'),
        'description'     => __('Ein einzelnes aufklappbares Frage-Antwort-Element.'),
        'render_template' => 'blocks/faq-item/faq-item.php',
        'category'        => 'layout',
        'icon'            => 'editor-help',
        'parent'          => ['acf/faq-container'], // Wichtig: Kann nur im Container platziert werden
        'mode'            => 'preview',
        'supports'        => [
            'mode' => false,
            'align' => false,
        ],
        'enqueue_style'   => get_stylesheet_directory_uri() . '/blocks/faq-item/faq-item.css',
    ]);
    // Block 3: Der Hero-Bereich
acf_register_block_type([
    'name'            => 'hero-block',
    'title'           => __('Hero Block'),
    'description'     => __('Der Hauptbereich der Startseite mit Titel, Untertitel, Karten und Statistiken.'),
    'render_template' => 'blocks/hero-block/hero-block.php',
    'category'        => 'common',
    'icon'            => 'align-wide',
    'supports'        => [
        'mode' => false,
        'align' => false,
    ],
]);

}
