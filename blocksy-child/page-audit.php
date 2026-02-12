<?php
/**
 * Template Name: Customer Journey Audit
 * Description: Landing Page — Customer Journey Audit (Formular + Report)
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="audit-page-wrapper" data-track-section="audit_landing">

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
