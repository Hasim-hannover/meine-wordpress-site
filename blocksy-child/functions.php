<?php
/**
 * Blocksy Child Theme functions and definitions
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

// Lädt das Haupt-Stylesheet
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri() );
} );

// Lädt die Theme-Konfigurationsdateien
require_once CHILD_THEME_PATH . '/inc/theme-setup.php';
require_once CHILD_THEME_PATH . '/inc/shortcodes.php';

/**
 * ===================================================================
 * FINALE RANK MATH INTEGRATION (per JavaScript)
 * ===================================================================
 * Lädt das Integrations-Skript, das den Shortcode-Inhalt für die
 * Rank Math Analyse im Editor bereitstellt.
 */
add_action( 'admin_enqueue_scripts', function( $hook ) {
    // Stellt sicher, dass das Skript nur auf "post.php" (Beiträge/Seiten bearbeiten) geladen wird.
    if ( 'post.php' !== $hook ) {
        return;
    }

    // Holt die ID des aktuellen Posts
    $post_id = get_the_ID();
    // Holt die ID der als Startseite festgelegten Seite
    $front_page_id = get_option( 'page_on_front' );

    // Lädt das Skript nur, wenn die bearbeitete Seite die Startseite ist.
    if ( $post_id == $front_page_id ) {
        wp_enqueue_script(
            'rank-math-child-integration',
            get_stylesheet_directory_uri() . '/assets/js/rank-math-integration.js',
            [ 'wp-hooks', 'wp-data' ], // Wichtige Abhängigkeiten für Rank Math
            filemtime( get_stylesheet_directory() . '/assets/js/rank-math-integration.js' ),
            true
        );
    }
} );
/**
 * Leitet alle Autoren-Archivseiten auf die "Über Mich"-Seite um.
 * Das vermeidet doppelten Inhalt und verbessert die User Experience.
 */
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        wp_redirect( home_url( '/ueber-mich/' ), 301 );
        exit;
    }
} );

// Lädt die Schema.org Markup Logik.
require_once get_stylesheet_directory() . '/inc/schema.php';