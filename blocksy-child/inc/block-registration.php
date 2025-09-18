<?php
if ( ! defined('ABSPATH') ) { exit; }

/**
 * Registriert alle benutzerdefinierten ACF Gutenberg Blöcke.
 */
add_action('acf/init', 'hu_register_blocks');
function hu_register_blocks() {

    // Prüfen, ob ACF Pro aktiv ist
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Hier werden wir in Zukunft unsere Blöcke registrieren.
    // Beispiel: acf_register_block_type([...]);

}