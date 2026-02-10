<?php
/**
 * Template Part: Related Content
 *
 * Zeigt verwandte Inhalte (Blog-Posts, Service-Seiten) für
 * interne Verlinkung und das Owned-Lead-Flywheel.
 *
 * Kann per Parameter gesteuert werden:
 *   set_query_var( 'related_heading', 'Das könnte Sie auch interessieren' );
 *   set_query_var( 'related_count', 3 );
 *   set_query_var( 'related_type', 'post' ); // 'post' | 'page' | 'any'
 *   get_template_part( 'template-parts/related-content' );
 *
 * [Flywheel] template-parts/related-content: Interne Verlinkung stärken
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading       = get_query_var( 'related_heading', __( 'Verwandte Inhalte', 'blocksy-child' ) );
$count         = (int) get_query_var( 'related_count', 3 );
$related_type  = get_query_var( 'related_type', 'post' );
$current_id    = get_the_ID();

// ── Query: verwandte Beiträge aus gleicher Kategorie ──────────────
$args = [
	'post_type'      => $related_type,
	'posts_per_page' => $count,
	'post__not_in'   => [ $current_id ],
	'post_status'    => 'publish',
	'orderby'        => 'date',
	'order'          => 'DESC',
];

// Für Posts: gleiche Kategorie bevorzugen
if ( 'post' === $related_type && is_singular( 'post' ) ) {
	$categories = get_the_category( $current_id );
	if ( $categories ) {
		$args['cat'] = $categories[0]->term_id;
	}
}

// Für Pages: manuelle ACF-Auswahl (falls vorhanden)
if ( 'page' === $related_type && function_exists( 'get_field' ) ) {
	$manual_related = get_field( 'related_pages', $current_id );
	if ( is_array( $manual_related ) && ! empty( $manual_related ) ) {
		$args = [
			'post_type'      => 'page',
			'post__in'       => wp_list_pluck( $manual_related, 'ID' ),
			'posts_per_page' => $count,
			'post_status'    => 'publish',
			'orderby'        => 'post__in',
		];
	}
}

$related_query = new WP_Query( $args );

if ( ! $related_query->have_posts() ) {
	wp_reset_postdata();
	return;
}
?>

<section class="related-content" data-track-section="related_content" aria-label="<?php echo esc_attr( $heading ); ?>">
	<h2 class="related-content__heading"><?php echo esc_html( $heading ); ?></h2>

	<div class="related-content__grid">
		<?php while ( $related_query->have_posts() ) :
			$related_query->the_post();
		?>
			<article class="related-content__card">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="related-content__thumb" data-track-action="related_click" data-track-category="internal_link">
						<?php the_post_thumbnail( 'medium', [
							'loading' => 'lazy',
							'class'   => 'related-content__image',
						] ); ?>
					</a>
				<?php endif; ?>

				<div class="related-content__body">
					<?php
					$cats = get_the_category();
					if ( $cats ) :
					?>
						<span class="related-content__category"><?php echo esc_html( $cats[0]->name ); ?></span>
					<?php endif; ?>

					<h3 class="related-content__title">
						<a href="<?php the_permalink(); ?>" data-track-action="related_click" data-track-category="internal_link">
							<?php the_title(); ?>
						</a>
					</h3>

					<p class="related-content__excerpt">
						<?php echo esc_html( wp_trim_words( get_the_excerpt(), 15, '…' ) ); ?>
					</p>
				</div>
			</article>
		<?php endwhile; ?>
	</div>
</section>

<?php
wp_reset_postdata();
