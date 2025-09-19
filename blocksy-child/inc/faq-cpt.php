<?php
// Registriert den Custom Post Type "FAQ"
function register_faq_post_type() {
  register_post_type('faq', [
    'labels' => [
      'name'          => __('FAQs'),
      'singular_name' => __('FAQ'),
      'menu_name'     => __('FAQs'),
    ],
    'public'      => true,
    'has_archive' => false,
    'rewrite'     => ['slug' => 'faq'],
    'supports'    => ['title','editor','page-attributes'],
  ]);
}
add_action('init', 'register_faq_post_type');
?>
