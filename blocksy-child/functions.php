<?php
/**
 * Blocksy Child Theme functions and definitions
 *
 * @package Blocksy Child
 */

// Stellt sicher, dass diese Datei nicht direkt aufgerufen wird.
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Definiert den Pfad zum Child-Theme-Verzeichnis für saubere Lade-Anweisungen.
 */
define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

/**
 * Lädt das Haupt-Stylesheet des Child-Themes.
 */
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri() );
} );

/**
 * Lädt die Konfigurationsdateien des Themes, die für Skripte, Styles und Shortcodes zuständig sind.
 */
require_once CHILD_THEME_PATH . '/inc/theme-setup.php';
require_once CHILD_THEME_PATH . '/inc/shortcodes.php';

/**
 * ===================================================================
 * KORRIGIERTER RANK MATH FILTER
 * ===================================================================
 * Macht den Inhalt der Startseite, der durch Shortcodes generiert wird,
 * für die Rank Math SEO-Analyse im WordPress-Editor sichtbar.
 *
 * @param string $content Der ursprüngliche Inhalt aus dem Editor.
 * @return string Der neue Inhalt, der an Rank Math übergeben wird.
 */
add_filter( 'rank_math/analyzer/content', function( $content ) {
    // Führt diesen Code nur auf der designierten Startseite aus.
    if ( ! is_front_page() ) {
        return $content;
    }

    // Erstellt einen leeren String, um den Inhalt zu sammeln.
    $custom_content = '';

    // Definiert die KORREKTEN Shortcodes in der richtigen Reihenfolge.
    $shortcodes = [
        '[hu_hero]',
        '[hu_partner]',
        '[hu_erfolge]',
        '[hu_prozess]',
        '[hu_faq]',
        '[hu_blog]',
        '[hu_cta]',
    ];

    // Führt jeden Shortcode aus und fügt das Ergebnis zum Inhalt hinzu.
    foreach ( $shortcodes as $shortcode ) {
        $custom_content .= do_shortcode( $shortcode );
    }

    // Gibt den reinen Textinhalt (ohne HTML) an Rank Math zurück.
    return strip_tags( $custom_content );
} );