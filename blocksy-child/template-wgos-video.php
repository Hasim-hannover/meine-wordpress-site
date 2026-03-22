<?php
/**
 * Template Name: WGOS Video Fullscreen
 * Description: Zeigt das WGOS Explainer Video ohne Header/Footer
 */

// Kein wp_head/wp_footer — komplett saubere Seite.
// Video-HTML direkt aus der Datei im Theme-Verzeichnis ausliefern.
$video_file = get_stylesheet_directory() . '/wgos-video.html';

if ( file_exists( $video_file ) ) {
	readfile( $video_file );
} else {
	echo '<!DOCTYPE html><html><body style="background:#0a0a0a;color:#ededed;font-family:system-ui;display:flex;align-items:center;justify-content:center;height:100vh"><p>Video-Datei nicht gefunden.</p></body></html>';
}
exit; // WordPress-Footer etc. verhindern
