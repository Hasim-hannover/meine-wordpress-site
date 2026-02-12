<?php
/**
 * Template Name: Nexus Über Mich
 *
 * Profil-/About-Seite. Content kommt aus dem Gutenberg-Editor.
 * SEO-Meta: zentral in inc/seo-meta.php
 *
 * @package Blocksy_Child
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="nexus-about" data-track-section="about_page">
		<div class="nexus-container">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>
</main>

<?php
get_footer();
