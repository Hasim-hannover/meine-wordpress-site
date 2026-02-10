<?php
/**
 * Front Page Template
 *
 * Lädt den Content aus dem WordPress Block-Editor.
 * SEO-Meta: zentral in inc/seo-meta.php
 *
 * @package Blocksy_Child
 */

get_header();
?>

<main id="main" class="site-main" data-track-section="homepage">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
