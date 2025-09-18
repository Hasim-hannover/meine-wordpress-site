<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * ===================================================================
 * Blocksy Child Theme: functions.php (Der Dirigent)
 * ===================================================================
 * Diese Datei lädt nur die spezialisierten Konfigurationsdateien.
 * Die eigentliche Logik liegt im /inc Ordner.
 */

// Lädt Theme-Einstellungen (Styles, Scripts, Fonts, etc.)
require_once get_stylesheet_directory() . '/inc/theme-setup.php';

// Lädt die Registrierung für alle ACF Gutenberg Blöcke
require_once get_stylesheet_directory() . '/inc/block-registration.php';