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
/**
 * Macht den Inhalt von der Startseite, der durch Shortcodes generiert wird,
 * für die Rank Math SEO-Analyse sichtbar.
 *
 * @param string $content Der ursprüngliche Inhalt aus dem Editor (der leer ist).
 * @return string Der neue Inhalt, der an Rank Math übergeben wird.
 */
add_filter( 'rank_math/frontend/builder/content', function( $content ) {
    // Wir führen diesen Code nur auf der Startseite aus.
    if ( ! is_front_page() ) {
        return $content;
    }

    // Wir holen uns den Inhalt aus den Shortcode-Funktionen.
    // WICHTIG: Die Reihenfolge hier muss der Reihenfolge auf deiner Seite entsprechen.
    $custom_content = '';
    $custom_content .= do_shortcode('[homepage_hero_shortcode]');
    $custom_content .= do_shortcode('[homepage_partner_shortcode]');
    $custom_content .= do_shortcode('[homepage_about_shortcode]');
    $custom_content .= do_shortcode('[homepage_services_shortcode]');
    $custom_content .= do_shortcode('[homepage_cta_shortcode]');
    $custom_content .= do_shortcode('[homepage_faq_shortcode]');

    // Wir entfernen alle HTML-Tags, damit Rank Math reinen Text analysiert.
    // Und wir geben den zusammengebauten Inhalt zurück.
    return strip_tags( $custom_content );
});