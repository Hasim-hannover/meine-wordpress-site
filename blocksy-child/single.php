<?php
/**
 * NEXUS Single Post Template
 *
 * Features: Dynamisches Hero-Bild, Breadcrumb, Share, Related Content, Footer-CTA.
 * Tracking-ready via data-track-* Attribute.
 *
 * [Flywheel] single.php: Blog Post mit Breadcrumb, Related Content, Footer-CTA
 *
 * @package Blocksy_Child
 */

get_header();
?>

<main id="main" class="site-main nexus-single-container">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php
		$hero_bg  = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$bg_style = $hero_bg
			? 'background-image: url(' . esc_url( $hero_bg ) . ');'
			: 'background: linear-gradient(to bottom, #1a1a1a, #0a0a0a);';
		?>

		<header class="nexus-article-hero has-bg" style="<?php echo esc_attr( $bg_style ); ?>" data-track-section="article_hero">

			<div class="nexus-hero-overlay"></div>

			<div class="nexus-hero-inner">

				<div class="nexus-meta-top">
					<?php get_template_part( 'template-parts/breadcrumb' ); ?>
					<span class="separator">|</span>
					<span class="nexus-date"><?php echo esc_html( get_the_date( 'd. M Y' ) ); ?></span>
					<span class="separator">|</span>
					<span class="nexus-reading-time"><?php
						printf(
							/* translators: %d: reading time in minutes */
							esc_html__( '⏱ %d Min. Lesezeit', 'blocksy-child' ),
							nexus_get_reading_time()
						);
					?></span>
				</div>

				<h1 class="nexus-title"><?php the_title(); ?></h1>

				<div class="nexus-hero-footer">
					<div class="nexus-author-row">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
						<div class="nexus-author-info">
							<span class="by"><?php esc_html_e( 'Written by', 'blocksy-child' ); ?></span>
							<span class="name"><?php the_author(); ?></span>
						</div>
					</div>

					<?php if ( function_exists( 'nexus_render_share_buttons' ) ) { nexus_render_share_buttons(); } ?>
				</div>

			</div>
		</header>

		   <div class="nexus-post-layout">
			   <aside class="nexus-sidebar">
				   <div class="sticky-toc">
					   <h3>Inhalt</h3>
					   <ul id="toc-list"></ul>
				   </div>
			   </aside>
			   <article class="nexus-article-content" id="article-content" data-track-section="article_content">
				   <?php the_content(); ?>
			   </article>
		   </div>

		<div class="nexus-bottom-share" data-track-section="article_share">
			<h3><?php esc_html_e( 'Diesen Artikel teilen', 'blocksy-child' ); ?></h3>
			<?php if ( function_exists( 'nexus_render_share_buttons' ) ) { nexus_render_share_buttons(); } ?>
		</div>

		<?php
		// Related Content (gleiche Kategorie)
		set_query_var( 'related_heading', __( 'Das könnte Sie auch interessieren', 'blocksy-child' ) );
		set_query_var( 'related_count', 3 );
		set_query_var( 'related_type', 'post' );
		get_template_part( 'template-parts/related-content' );
		?>

		<?php get_template_part( 'template-parts/footer-cta' ); ?>

	<?php endwhile; ?>

</main>

<?php
get_footer();