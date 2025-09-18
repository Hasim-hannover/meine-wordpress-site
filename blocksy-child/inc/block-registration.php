<?php
if ( ! defined('ABSPATH') ) { exit; }

add_action('acf/init', 'hu_register_blocks');
function hu_register_blocks() {
    if (!function_exists('acf_register_block_type')) return;

    acf_register_block_type([
        'name'            => 'faq-container',
        'title'           => __('FAQ Container'),
        'render_template' => 'blocks/faq-container/faq-container.php',
        'category'        => 'layout',
        'icon'            => 'archive',
        'mode'            => 'preview',
        'supports'        => [ 'mode' => false, 'align' => false ],
    ]);

    acf_register_block_type([
        'name'            => 'faq-item',
        'title'           => __('FAQ Item'),
        'render_template' => 'blocks/faq-item/faq-item.php',
        'category'        => 'layout',
        'icon'            => 'editor-help',
        'parent'          => ['acf/faq-container'],
        'mode'            => 'preview',
        'supports'        => [ 'mode' => false, 'align' => false ],
        'enqueue_style'   => get_stylesheet_directory_uri() . '/blocks/faq-item/faq-item.css',
    ]);
}