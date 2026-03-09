<?php
/**
 * Global site header.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand_text   = function_exists( 'hu_get_site_wordmark_text' ) ? hu_get_site_wordmark_text() : 'HAŞIM ÜNER';
$eyebrow_text = nexus_get_site_header_eyebrow();
$panel_id     = 'nx-site-header-panel';
$home_label   = sprintf(
	/* translators: %s: site or brand name. */
	__( 'Startseite - %s', 'blocksy-child' ),
	$brand_text
);
?>

<header class="nx-site-header" data-site-header role="banner">
	<div class="nx-container">
		<div class="nx-site-header__shell">
			<div class="nx-site-header__brand-block">
				<span class="nx-site-header__eyebrow"><?php echo esc_html( $eyebrow_text ); ?></span>
				<a
					class="site-logo nx-site-header__brand"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
					aria-label="<?php echo esc_attr( $home_label ); ?>"
				>
					<?php echo esc_html( $brand_text ); ?>
				</a>
			</div>

			<nav class="nx-site-header__nav" aria-label="<?php esc_attr_e( 'Primäre Navigation', 'blocksy-child' ); ?>">
				<?php nexus_render_site_header_menu( 'desktop' ); ?>
			</nav>

			<div class="nx-site-header__actions">
				<div class="nx-site-header__theme-toggle-slot">
					<?php
					if ( function_exists( 'nexus_get_theme_toggle_html' ) ) {
						echo nexus_get_theme_toggle_html(
							[
								'source' => 'header',
							]
						);
					}
					?>
				</div>
				<!-- Primary CTA Button -->
				<?php
				$cta_url = apply_filters( 'nexus_audit_calendar_url', 'https://cal.com/hasim/30min' );
				?>
				<a href="<?php echo esc_url( $cta_url ); ?>" class="nx-header-cta-btn" data-track-action="cta_header_growth_audit" data-track-category="lead_gen">
					Growth Audit starten
				</a>

				<button
					type="button"
					class="nx-site-header__toggle"
					data-site-header-toggle
					aria-expanded="false"
					aria-controls="<?php echo esc_attr( $panel_id ); ?>"
					aria-label="<?php esc_attr_e( 'Navigation öffnen', 'blocksy-child' ); ?>"
				>
					<span class="nx-site-header__toggle-line"></span>
					<span class="nx-site-header__toggle-line"></span>
					<span class="nx-site-header__toggle-line"></span>
				</button>
			</div>
		</div>

		<div id="<?php echo esc_attr( $panel_id ); ?>" class="nx-site-header__panel" data-site-header-panel hidden>
			<nav class="nx-site-header__mobile-nav" aria-label="<?php esc_attr_e( 'Mobiles Menü', 'blocksy-child' ); ?>">
				<?php nexus_render_site_header_menu( 'mobile' ); ?>
			</nav>
		</div>
	</div>
</header>
