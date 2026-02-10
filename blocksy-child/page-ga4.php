<?php
/**
 * Template Name: GA4 Tracking Landing
 * Description: GA4 & Tracking Setup – Service-Seite
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="ga4-page" data-track-section="ga4_landing">
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
