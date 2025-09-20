<?php
/**
 * The template for displaying the front page.
 * FINALE VERSION: Lädt den Inhalt aus dem WordPress Editor
 * und führt die darin enthaltenen Shortcodes explizit aus.
 *
 * @package Blocksy Child
 */

get_header();
?>

<main id="main" class="site-main">
	<?php
	// Start the Loop.
	while ( have_posts() ) :
		the_post();

		// Holt den rohen Inhalt aus dem Editor.
		$raw_content = get_the_content();

		// Führt die Shortcodes im Inhalt aus und gibt das fertige HTML aus.
		echo do_shortcode( $raw_content );

	endwhile; // End the loop.
	?>
</main>

<?php
get_footer();