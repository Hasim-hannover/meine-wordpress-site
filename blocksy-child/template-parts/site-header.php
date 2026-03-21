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
$cases_url    = function_exists( 'nexus_get_results_url' ) ? nexus_get_results_url() : home_url( '/ergebnisse/' );
$home_label   = sprintf(
	/* translators: %s: site or brand name. */
	__( 'Startseite - %s', 'blocksy-child' ),
	$brand_text
);
?>

<?php if ( function_exists( 'nexus_is_audit_linkedin_page' ) && nexus_is_audit_linkedin_page() ) : ?>
<header class="nx-site-header nx-site-header--audit is-visible" data-site-header role="banner">
	<div class="nx-container">
		<div class="nx-site-header__shell nx-site-header__shell--audit">
			<div class="nx-site-header__brand-block">
				<span class="nx-site-header__eyebrow">Website Audit</span>
				<a
					class="site-logo nx-site-header__brand"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
					aria-label="<?php echo esc_attr( $home_label ); ?>"
				>
					<?php echo esc_html( $brand_text ); ?>
				</a>
			</div>

			<div class="nx-site-header__audit-meta" aria-label="Audit-Microcopy">
				<span>fundierte Ersteinschätzung</span>
				<span>kein Pflicht-Call</span>
			</div>

			<div class="nx-site-header__audit-actions">
				<div class="nx-site-header__theme-toggle-slot">
					<?php
					if ( function_exists( 'nexus_get_theme_toggle_html' ) ) {
						echo nexus_get_theme_toggle_html(
							[
								'source' => 'audit-linkedin-header',
							]
						);
					}
					?>
				</div>
				<a class="nx-site-header__audit-link nx-site-header__audit-link--primary" href="#audit-form">Audit starten</a>
			</div>
		</div>
	</div>
</header>
<?php return; endif; ?>

<?php if ( function_exists( 'nexus_is_audit_page' ) && nexus_is_audit_page() ) : ?>
<header class="nx-site-header nx-site-header--audit is-visible" data-site-header role="banner">
	<div class="nx-container">
		<div class="nx-site-header__shell nx-site-header__shell--audit">
			<div class="nx-site-header__brand-block">
				<span class="nx-site-header__eyebrow">Growth Audit</span>
				<a
					class="site-logo nx-site-header__brand"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
					aria-label="<?php echo esc_attr( $home_label ); ?>"
				>
					<?php echo esc_html( $brand_text ); ?>
				</a>
			</div>

			<div class="nx-site-header__audit-meta" aria-label="Audit-Microcopy">
				<span>manuelle Ersteinschätzung</span>
				<span>schriftliche Rückmeldung in 48h</span>
			</div>

			<div class="nx-site-header__audit-actions">
				<div class="nx-site-header__theme-toggle-slot">
					<?php
					if ( function_exists( 'nexus_get_theme_toggle_html' ) ) {
						echo nexus_get_theme_toggle_html(
							[
								'source' => 'audit-header',
							]
						);
					}
					?>
				</div>
				<a class="nx-site-header__audit-link" href="<?php echo esc_url( $cases_url ); ?>">Einblicke</a>
				<a class="nx-site-header__audit-link nx-site-header__audit-link--primary" href="#form">Zum Flow</a>
			</div>
		</div>
	</div>
</header>
<?php return; endif; ?>

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
