
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

