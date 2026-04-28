<?php
/**
 * Template Name: Energie-Fahrplan
 */
get_header();

$dist_path = get_stylesheet_directory() . '/energie-fahrplan/dist';
$index_file = $dist_path . '/index.html';

echo '<div id="energie-fahrplan-app" style="min-height: 80vh;">';

if ( file_exists( $index_file ) ) {
    $html = file_get_contents( $index_file );
    
    // Extract everything inside <head> (e.g. styles, scripts)
    preg_match('/<head>(.*?)<\/head>/s', $html, $head_matches);
    if ( !empty($head_matches[1]) ) {
        echo $head_matches[1];
    }
    
    // Extract everything inside <body> (e.g. <div id="root"></div> and module preloads)
    preg_match('/<body>(.*?)<\/body>/s', $html, $body_matches);
    if ( !empty($body_matches[1]) ) {
        echo $body_matches[1];
    } else {
        // Fallback if parsing fails
        echo $html;
    }
} else {
    echo '<p style="padding: 2rem; text-align: center; color: red;">Kritischer Fehler: App-Build nicht gefunden. Bitte den Build-Prozess ausführen (dist-Ordner fehlt).</p>';
}

echo '</div>';

get_footer();
?>