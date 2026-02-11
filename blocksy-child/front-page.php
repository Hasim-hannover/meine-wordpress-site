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

<?php
set_query_var( 'related_heading', 'Das könnte Sie auch interessieren' );
set_query_var( 'related_count', 3 );
set_query_var( 'related_type', 'post' );
get_template_part( 'template-parts/related-content' );
?>
</main>

<?php
get_footer();
