<?php
/**
 * Single template for WGOS assets.
 *
 * Structure first: asset metadata above, editor-maintained diagnosis/solution below,
 * then the global audit CTA to keep the page inside the primary funnel.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$wgos_url  = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wgos/' );
?>

<main id="main" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$post_id      = get_the_ID();
		$credits      = function_exists( 'nexus_get_wgos_asset_field' ) ? nexus_get_wgos_asset_field( $post_id, 'wgos_credits', 'wgos_asset_credits', '' ) : nexus_get_field( 'wgos_credits', '', $post_id );
		$deliverables = function_exists( 'nexus_get_wgos_asset_field' ) ? nexus_get_wgos_asset_field( $post_id, 'wgos_deliverables', 'wgos_asset_deliverables', '' ) : nexus_get_field( 'wgos_deliverables', '', $post_id );
		$phase_key    = function_exists( 'nexus_get_wgos_asset_field' ) ? nexus_get_wgos_asset_field( $post_id, 'wgos_phase', 'wgos_asset_phase', '' ) : nexus_get_field( 'wgos_phase', '', $post_id );
		$phase_label  = function_exists( 'nexus_get_wgos_asset_phase_label' )
			? nexus_get_wgos_asset_phase_label( $phase_key )
			: $phase_key;
		$excerpt      = has_excerpt() ? get_the_excerpt() : '';
		$ancestors    = array_reverse( get_post_ancestors( $post_id ) );
		?>

		<div class="wgos-wrapper">
			<section class="wgos-hero">
				<div class="wgos-container wgos-hero__inner">
					<p class="wgos-section-intro">
						<a class="wgos-link--arrow" href="<?php echo esc_url( $wgos_url ); ?>">WGOS Hub</a>
						<?php foreach ( $ancestors as $ancestor_id ) : ?>
							<span aria-hidden="true"> / </span>
							<a class="wgos-link--arrow" href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>">
								<?php echo esc_html( get_the_title( $ancestor_id ) ); ?>
							</a>
						<?php endforeach; ?>
					</p>

					<?php if ( $phase_label ) : ?>
						<span class="wgos-kicker"><?php echo esc_html( sprintf( 'WGOS Asset / %s', $phase_label ) ); ?></span>
					<?php endif; ?>

					<h1 class="wgos-hero__title"><?php the_title(); ?></h1>

					<?php if ( $excerpt ) : ?>
						<p class="wgos-hero__subtitle"><?php echo esc_html( $excerpt ); ?></p>
					<?php elseif ( $deliverables ) : ?>
						<p class="wgos-hero__subtitle"><?php echo esc_html( $deliverables ); ?></p>
					<?php endif; ?>

					<div class="wgos-hero__actions">
						<a href="<?php echo esc_url( $wgos_url . '#credits' ); ?>" class="wgos-btn wgos-btn--outline">Zur WGOS-Uebersicht</a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track-action="cta_wgos_asset_hero_audit" data-track-category="lead_gen">Growth Audit starten</a>
					</div>
				</div>
			</section>

			<section class="wgos-section wgos-section--gray">
				<div class="wgos-container">
					<h2 class="wgos-h2">Asset-Kontext</h2>
					<p class="wgos-section-intro">Dieses Asset ist ein einzelner Baustein im WGOS. Die Wirkung entsteht erst, wenn Reihenfolge, Engpass und Conversion-Pfad zusammenpassen.</p>

					<div class="wgos-credit-phase">
						<div class="wgos-table-wrap">
							<table class="wgos-credits-table wgos-credits-table--compact">
								<tbody>
									<tr>
										<td><?php esc_html_e( 'Phase', 'blocksy-child' ); ?></td>
										<td><?php echo esc_html( $phase_label ? $phase_label : __( 'Nicht definiert', 'blocksy-child' ) ); ?></td>
									</tr>
									<tr>
										<td><?php esc_html_e( 'Credits', 'blocksy-child' ); ?></td>
										<td>
											<?php
											echo '' !== $credits
												? esc_html( number_format_i18n( (float) $credits ) )
												: esc_html__( 'Nicht definiert', 'blocksy-child' );
											?>
										</td>
									</tr>
									<tr>
										<td><?php esc_html_e( 'Deliverables', 'blocksy-child' ); ?></td>
										<td><?php echo $deliverables ? esc_html( $deliverables ) : esc_html__( 'Nicht definiert', 'blocksy-child' ); ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>

			<section class="wgos-section wgos-section--white">
				<div class="wgos-container">
					<h2 class="wgos-h2">Problem, Diagnose und Loesung</h2>
					<div class="wgos-prose">
						<?php the_content(); ?>
					</div>
				</div>
			</section>

			<section class="wgos-section wgos-section--gray">
				<div class="wgos-container">
					<div class="wgos-principle-shell">
						<span class="wgos-principle-kicker">Systemkontext</span>
						<h2 class="wgos-h2">Ein Asset ist nur dann wirksam, wenn das Fundament stimmt.</h2>
						<p>Performance, Measurement und Conversion sind keine isolierten Baustellen. Im WGOS werden sie in eine belastbare Reihenfolge gebracht, damit ein einzelner Hebel nicht am naechsten Engpass verpufft.</p>
						<p class="wgos-inline-cta wgos-inline-cta--principle">
							<a href="<?php echo esc_url( $wgos_url ); ?>">Zurueck ins WGOS und die Gesamtlogik ansehen</a>
						</p>
					</div>
				</div>
			</section>

			<?php
			set_query_var( 'cta_heading', 'Dieses Asset funktioniert nur im Kontext des gesamten WGOS.' );
			set_query_var( 'cta_text', 'Der Growth Audit zeigt, ob jetzt genau dieses Asset priorisiert werden sollte oder ob erst Tracking, Performance oder Conversion sauber sortiert werden muessen.' );
			set_query_var( 'cta_url', $audit_url );
			set_query_var( 'cta_button_text', 'Growth Audit starten' );
			set_query_var( 'cta_action', 'cta_wgos_asset_footer_audit' );
			get_template_part( 'template-parts/footer-cta' );
			?>
		</div>
	<?php endwhile; ?>
</main>

<?php
get_footer();
