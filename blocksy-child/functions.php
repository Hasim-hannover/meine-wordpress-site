<?php
/**
 * =========================================
 * DIAGNOSE-MODUS - NICHT FÜR DEN LIVEBETRIEB
 * =========================================
 * Dieser Code dient nur dazu, den kritischen Fehler zu finden.
 */

// Laden des Haupt-Stylesheets des Eltern-Themes.
add_action( 'wp_enqueue_scripts', 'blocksy_child_enqueue_styles' );
function blocksy_child_enqueue_styles() {
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_directory_uri() . '/style.css' );
}

// --- Start der Fehlersuche ---

// Schritt 2: Entferne das '#' vor der nächsten Zeile und speichere.
// require_once get_stylesheet_directory() . '/inc/theme-setup.php';

// Schritt 3: Wenn die Seite immer noch läuft, entferne das '#' vor der nächsten Zeile und speichere.
// require_once get_stylesheet_directory() . '/inc/shortcodes.php';