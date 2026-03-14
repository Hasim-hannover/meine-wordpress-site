<?php
/**
 * Template Name: Kostenlose Tools
 * Description: Tool Hub — Audit, ROI-Rechner und weitere kostenlose Tools
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

		// Render the versioned tools shell directly from the template.
		if ( function_exists( 'nexus_get_tools_hub_shell_markup' ) ) {
			echo nexus_get_tools_hub_shell_markup(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			get_template_part( 'template-parts/tools-page-shell' );
		}
	endwhile;
	?>
</div>

<?php get_footer(); ?>
