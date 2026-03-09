<?php
/**
 * Template Part: Footer CTA
 *
 * Wiederverwendbarer Bottom-CTA-Block für Service- und Blog-Seiten.
 * Tracking-ready mit data-track-* Attributen.
 *
 * Usage:
 *   set_query_var( 'cta_heading', 'Wo verbrennt Ihre Website Geld?' );
 *   set_query_var( 'cta_text', 'Der Audit prüft Tech, SEO und Conversion im Zusammenspiel.' );
 *   set_query_var( 'cta_url', '/growth-audit/' );
 *   set_query_var( 'cta_button_text', 'Audit starten' );
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

$heading     = get_query_var( 'cta_heading', __( 'Wo verliert Ihre WordPress-Seite heute Anfragen?', 'blocksy-child' ) );
$text        = get_query_var( 'cta_text', __( 'Der Audit zeigt, wo Sichtbarkeit, Vertrauen oder Conversion im Zusammenspiel wegbrechen.', 'blocksy-child' ) );
$url         = get_query_var( 'cta_url', nexus_get_audit_url() );
$button_text = get_query_var( 'cta_button_text', __( 'Audit starten', 'blocksy-child' ) );
$action      = get_query_var( 'cta_action', 'cta_footer_audit' );
$imprint_url = nexus_get_page_url( [ 'impressum' ], home_url( '/impressum/' ) );
$privacy_url = nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) );
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

		<p class="nexus-footer-cta__legal">
			Keine Cookies bei oeffentlichen Seitenaufrufen.
			<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
			<span aria-hidden="true">·</span>
			<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
		</p>

		<?php get_template_part( 'template-parts/trust-section' ); ?>
	</div>
</section>
