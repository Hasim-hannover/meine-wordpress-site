<?php
/**
 * Template Name: Kostenlose Tools
 * Description: Tool Hub — ROI-Rechner, Customer Journey Audit & weitere kostenlose Tools
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="tools-hub-page" data-track-section="tools_hub">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
