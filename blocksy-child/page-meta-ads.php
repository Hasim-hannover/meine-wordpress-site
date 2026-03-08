<?php
/**
 * Template Name: Meta Ads Archiv (Optional)
 * Description: Optionaler Paid-Social-Layer ausserhalb des Kern-Funnels
 *
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="ma-page" data-track-section="meta_ads_landing">

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</div>

<?php get_footer(); ?>
