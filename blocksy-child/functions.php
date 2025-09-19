<?php
/**
 * Blocksy Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy Child
 */

// Laden des Haupt-Stylesheets des Eltern-Themes.
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_styles' );
function blocksy_child_enqueue_styles() {
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_directory_uri() . '/style.css' );
}

/**
 * Custom Theme Setup
 */
if ( file_exists( __DIR__ . '/inc/theme-setup.php' ) ) {
    require_once __DIR__ . '/inc/theme-setup.php';
}
