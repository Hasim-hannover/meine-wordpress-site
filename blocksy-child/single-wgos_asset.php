<?php
/**
 * Single template for WGOS assets.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$wgos_url  = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wgos/' );
$hub_url   = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : $wgos_url . '#module';
?>

<main id="main" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$excerpt       = has_excerpt() ? get_the_excerpt() : '';
		$ancestors     = array_reverse( get_post_ancestors( get_the_ID() ) );
		$hub_focus_url = $hub_url;
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

					<span class="wgos-kicker">WGOS Asset</span>

					<h1 class="wgos-hero__title"><?php the_title(); ?></h1>

					<?php if ( $excerpt ) : ?>
						<p class="wgos-hero__subtitle"><?php echo esc_html( $excerpt ); ?></p>
					<?php endif; ?>

					<div class="wgos-hero__actions">
						<a href="<?php echo esc_url( $hub_focus_url ); ?>" class="wgos-btn wgos-btn--outline">Zur Asset-Landkarte</a>
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track-action="cta_wgos_asset_hero_audit" data-track-category="lead_gen">Growth Audit starten</a>
					</div>
				</div>
			</section>

			<section class="wgos-section wgos-section--white">
				<div class="wgos-container">
					<h2 class="wgos-h2">Problem, Diagnose und Lösung</h2>
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
						<p>Performance, Measurement und Conversion sind keine isolierten Baustellen. Im WGOS werden sie in eine belastbare Reihenfolge gebracht, damit ein einzelner Hebel nicht am nächsten Engpass verpufft.</p>
						<p class="wgos-inline-cta wgos-inline-cta--principle">
							<a href="<?php echo esc_url( $hub_focus_url ); ?>">Dieses Asset in der Systemlandkarte einordnen</a>
						</p>
					</div>
				</div>
			</section>

			<?php
			set_query_var( 'cta_heading', 'Dieses Asset funktioniert nur im Kontext des gesamten WGOS.' );
			set_query_var( 'cta_text', 'Der Growth Audit zeigt, ob jetzt genau dieses Asset priorisiert werden sollte oder ob erst Tracking, Performance oder Conversion sauber sortiert werden müssen.' );
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
