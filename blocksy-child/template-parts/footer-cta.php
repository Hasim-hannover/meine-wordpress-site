<?php
/**
 * Template Part: Footer CTA
 *
 * Wiederverwendbarer Bottom-CTA-Block für Service- und Blog-Seiten.
 * Tracking-ready mit data-track-* Attributen.
 *
 * Usage:
 *   set_query_var( 'cta_heading', 'Wo verbrennt Ihre Website Geld?' );
 *   set_query_var( 'cta_text', 'Unser Free Journey Audit prüft Tech, SEO & Content.' );
 *   set_query_var( 'cta_url', '/customer-journey-audit/' );
 *   set_query_var( 'cta_button_text', 'Zum Growth-Audit' );
 *   set_query_var( 'cta_action', 'cta_footer_audit' );
 *   get_template_part( 'template-parts/footer-cta' );
 *
 * [CRO] template-parts/footer-cta: Conversion-optimierter Bottom-CTA
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading     = get_query_var( 'cta_heading', __( 'Wo verbrennt Ihre Website gerade Geld?', 'blocksy-child' ) );
$text        = get_query_var( 'cta_text', __( 'Ein Speed-Test reicht nicht. Unser Free Journey Audit prüft Tech, SEO & Content im Zusammenspiel.', 'blocksy-child' ) );
$url         = get_query_var( 'cta_url', home_url( '/customer-journey-audit/' ) );
$button_text = get_query_var( 'cta_button_text', __( 'Kostenloser Journey Audit starten', 'blocksy-child' ) );
$action      = get_query_var( 'cta_action', 'cta_footer_audit' );
?>

<section class="nexus-footer-cta" data-track-section="footer_cta">
	<div class="nexus-footer-cta__inner">
		<h3 class="nexus-footer-cta__heading"><?php echo esc_html( $heading ); ?></h3>
		<p class="nexus-footer-cta__text"><?php echo esc_html( $text ); ?></p>

		<a href="<?php echo esc_url( $url ); ?>"
		   class="btn btn-primary nexus-footer-cta__btn"
		   data-track-action="<?php echo esc_attr( $action ); ?>"
		   data-track-category="lead_gen">
			<?php echo esc_html( $button_text ); ?>
		</a>

		<?php get_template_part( 'template-parts/trust-section' ); ?>
	</div>
</section>
