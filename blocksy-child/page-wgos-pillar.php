<?php
/**
 * Shared renderer for versioned WGOS cluster pages.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page = function_exists( 'nexus_get_wgos_cluster_page' ) ? nexus_get_wgos_cluster_page() : null;

get_header();
?>

<main id="main" class="site-main">
	<?php
	if ( is_array( $page ) && function_exists( 'nexus_render_wgos_cluster_page' ) ) {
		echo nexus_render_wgos_cluster_page( $page ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	}
	?>
</main>

<?php
get_footer();
