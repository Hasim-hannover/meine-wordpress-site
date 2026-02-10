<?php
/**
 * Template Part: Trust Section
 *
 * Trust-Elemente in Nähe jedes CTA.
 * Logo-Leiste, Zertifikate, Kundenstimmen oder Trust-Badges.
 *
 * Usage:
 *   set_query_var( 'trust_variant', 'compact' ); // 'full' | 'compact'
 *   get_template_part( 'template-parts/trust-section' );
 *
 * [CRO] template-parts/trust-section: Trust-Elemente in CTA-Nähe
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$variant = get_query_var( 'trust_variant', 'compact' );
?>

<aside class="trust-section trust-section--<?php echo esc_attr( $variant ); ?>" data-track-section="trust_elements" aria-label="<?php esc_attr_e( 'Vertrauensindikatoren', 'blocksy-child' ); ?>">

	<?php if ( 'full' === $variant ) : ?>

		<div class="trust-section__grid">
			<div class="trust-section__item">
				<span class="trust-section__icon" aria-hidden="true">🔒</span>
				<span class="trust-section__text"><?php esc_html_e( 'DSGVO-konform', 'blocksy-child' ); ?></span>
			</div>
			<div class="trust-section__item">
				<span class="trust-section__icon" aria-hidden="true">⚡</span>
				<span class="trust-section__text"><?php esc_html_e( 'Core Web Vitals: grün', 'blocksy-child' ); ?></span>
			</div>
			<div class="trust-section__item">
				<span class="trust-section__icon" aria-hidden="true">📊</span>
				<span class="trust-section__text"><?php esc_html_e( '100% Data Ownership', 'blocksy-child' ); ?></span>
			</div>
			<div class="trust-section__item">
				<span class="trust-section__icon" aria-hidden="true">🎯</span>
				<span class="trust-section__text"><?php esc_html_e( 'Keine langen Verträge', 'blocksy-child' ); ?></span>
			</div>
		</div>

	<?php else : ?>

		<p class="trust-section__inline">
			<?php
			echo esc_html__( '✓ DSGVO-konform', 'blocksy-child' );
			echo ' &nbsp;·&nbsp; ';
			echo esc_html__( '✓ Keine Laufzeit', 'blocksy-child' );
			echo ' &nbsp;·&nbsp; ';
			echo esc_html__( '✓ 100% Owned Data', 'blocksy-child' );
			?>
		</p>

	<?php endif; ?>

</aside>
