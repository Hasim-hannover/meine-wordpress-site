<?php
/**
 * Theme Setup: Einbinden von Styles und Skripten.
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Lädt die CSS- und JS-Dateien des Child-Themes.
 * Diese Funktion wird über einen Hook in WordPress aufgerufen.
 */
function ct_enqueue_assets() {
    // Lädt das dedizierte Stylesheet für die Startseite nur auf der Startseite.
    if ( is_front_page() ) {
        wp_enqueue_style(
            'blocksy-child-homepage',
            get_stylesheet_directory_uri() . '/assets/css/homepage.css',
            [],
            filemtime( get_stylesheet_directory() . '/assets/css/homepage.css' )
        );

        // Lädt das dedizierte JavaScript für die Startseite und behebt den PageSpeed-Fehler.
        wp_enqueue_script(
            'blocksy-child-homepage',
            get_stylesheet_directory_uri() . '/assets/js/homepage.js',
            [],
            filemtime( get_stylesheet_directory() . '/assets/js/homepage.js' ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ct_enqueue_assets', 15 );