<?php
/**
 * Theme Setup: Einbinden von Styles und Skripten.
 * FINALE VERSION mit korrigierter Lade-Priorität zur Behebung von FOUC.
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Lädt die JavaScript-Dateien des Child-Themes.
 */
function ct_enqueue_assets() {
    // Lädt das dedizierte JavaScript für die Startseite.
    if ( is_front_page() ) {
        wp_enqueue_script(
            'blocksy-child-homepage',
            get_stylesheet_directory_uri() . '/assets/js/homepage.js',
            [],
            filemtime( get_stylesheet_directory() . '/assets/js/homepage.js' ),
            true // Lädt das Skript im Footer.
        );
    }
}
add_action( 'wp_enqueue_scripts', 'ct_enqueue_assets' );


/**
 * Fügt das CSS der Startseite mit HÖCHSTER PRIORITÄT in den <head> ein.
 * Das verhindert das "Aufblitzen" von ungestyltem Inhalt (FOUC).
 */
function hu_inline_homepage_styles() {
    // Führt diesen Code nur auf der Startseite aus.
    if ( is_front_page() ) {
        $css_path = get_stylesheet_directory() . '/assets/css/homepage.css';
        if ( file_exists( $css_path ) ) {
            // Liest den Inhalt der CSS-Datei.
            $css_content = file_get_contents( $css_path );
            // Gibt das CSS direkt in einem <style>-Tag aus.
            echo '<style id="hu-homepage-inline-styles">' . $css_content . '</style>';
        }
    }
}
// Die Priorität "1" sorgt dafür, dass dieser Code ganz am Anfang der Warteschlange ausgeführt wird.
add_action( 'wp_head', 'hu_inline_homepage_styles', 1 );