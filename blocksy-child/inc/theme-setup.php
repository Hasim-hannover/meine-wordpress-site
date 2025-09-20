<?php
/**
 * Theme setup.
 *
 * @package Blocksy
 */

if ( ! function_exists( 'ct_enqueue_assets' ) ) {
	/**
	 * Enqueue theme related assets.
	 *
	 * @return void
	 */
	function ct_enqueue_assets() {
		// KORREKTE BEDINGUNG: Prüft, ob dies die als Startseite definierte Seite ist.
		if ( get_option('page_on_front') == get_the_ID() ) {
			wp_enqueue_style(
				'blocksy-child-homepage',
				get_stylesheet_directory_uri() . '/assets/css/homepage.css',
				[], // Abhängigkeiten
				filemtime(get_stylesheet_directory() . '/assets/css/homepage.css') // Cache-Busting
			);

            /*
             * Aktuell nicht benötigt, aber für später aufbewahrt.
			wp_enqueue_script(
				'blocksy-child-homepage',
				get_stylesheet_directory_uri() . '/assets/js/homepage.js',
				[],
				filemtime(get_stylesheet_directory() . '/assets/js/homepage.js'),
				true
			);
            */
		}
	}
}

add_action( 'wp_enqueue_scripts', 'ct_enqueue_assets' );