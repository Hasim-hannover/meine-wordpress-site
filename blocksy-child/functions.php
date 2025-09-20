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
 * Lädt Skripte, Styles und andere Theme-Konfigurationen.
 */
if ( file_exists( __DIR__ . '/inc/theme-setup.php' ) ) {
    require_once __DIR__ . '/inc/theme-setup.php';
}


/**
 * NEU: Lädt die Shortcodes für die Startseite.
 * Ohne diesen Teil weiß WordPress nichts von den Shortcodes.
 */
$shortcodes_path = get_stylesheet_directory() . '/inc/shortcodes.php';

if ( file_exists( $shortcodes_path ) ) {
    require_once $shortcodes_path;
} else {
    // Zeigt eine Fehlermeldung im Backend an, falls die Datei fehlt.
    if ( current_user_can('manage_options') ) {
        wp_die('FEHLER: Die Datei /inc/shortcodes.php konnte nicht gefunden werden. Bitte Pfad prüfen!');
    }
}