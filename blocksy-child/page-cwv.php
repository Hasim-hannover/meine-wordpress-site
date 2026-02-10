<?php
/**
 * Template Name: Core Web Vitals
 * Description: Service Landing Page — Core Web Vitals Optimierung
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="cwv-page-wrapper" data-track-section="cwv_landing">
	<?php get_template_part( 'template-parts/breadcrumb' ); ?>

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
