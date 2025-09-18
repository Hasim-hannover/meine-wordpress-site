<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Registriert alle benutzerdefinierten ACF Gutenberg Blöcke.
 */
add_action('acf/init', 'hu_register_blocks');
function hu_register_blocks() {

    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // FAQ Accordion Block
    acf_register_block_type([
        'name'            => 'faq-accordion',
        'title'           => __('FAQ Akkordeon'),
        'description'     => __('Ein Block für aufklappbare Fragen und Antworten.'),
        'render_template' => 'blocks/faq-accordion/faq-accordion.php',
        'category'        => 'layout',
        'icon'            => 'editor-help',
        'keywords'        => ['faq', 'accordion', 'fragen'],
        'enqueue_style'   => get_stylesheet_directory_uri() . '/blocks/faq-accordion/faq-accordion.css',
        'enqueue_script'  => get_stylesheet_directory_uri() . '/blocks/faq-accordion/faq-accordion.js',
    ]);

    // Hier registrieren wir in Zukunft weitere Blöcke...

}