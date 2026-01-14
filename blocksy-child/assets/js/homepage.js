// ... existing code ...

/**
 * NEXUS: Homepage Scripts & Styles laden
 * Lädt das JS nur auf der Startseite, um Performance zu sparen.
 */
function nexus_enqueue_homepage_assets() {
    if ( is_front_page() ) {
        
        // JavaScript laden (im Footer)
        wp_enqueue_script(
            'nexus-homepage-js', 
            get_stylesheet_directory_uri() . '/assets/js/homepage.js', 
            array(), // Keine Abhängigkeiten (Vanilla JS)
            filemtime( get_stylesheet_directory() . '/assets/js/homepage.js' ), // Cache-Busting automatisch
            true // WICHTIG: Im Footer laden, damit DOM ready ist
        );

        // CSS laden (falls noch nicht automatisch passiert)
        wp_enqueue_style(
            'nexus-homepage-css',
            get_stylesheet_directory_uri() . '/assets/css/homepage.css',
            array(),
            filemtime( get_stylesheet_directory() . '/assets/css/homepage.css' )
        );
    }
}
add_action( 'wp_enqueue_scripts', 'nexus_enqueue_homepage_assets' );