<?php
/**
 * Growth Audit shortcode for the instant analysis flow.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the instant Growth Audit app.
 *
 * @return string
 */
function cja_audit_shortcode() {
	$css_path     = get_stylesheet_directory() . '/assets/css/cja-audit.css';
	$js_path      = get_stylesheet_directory() . '/assets/js/cja-audit.js';
	$contact_url  = home_url( '/kontakt/' );
	$webhook_url  = (string) apply_filters( 'cja_audit_webhook_url', 'https://n8n.hasimuener.de/webhook/cja-analyze' );
	$css_version  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0';
	$js_version   = file_exists( $js_path ) ? (string) filemtime( $js_path ) : '1.0.0';

	wp_enqueue_style(
		'cja-audit',
		get_stylesheet_directory_uri() . '/assets/css/cja-audit.css',
		[ 'nexus-design-system' ],
		$css_version
	);

	wp_enqueue_script(
		'cja-audit',
		get_stylesheet_directory_uri() . '/assets/js/cja-audit.js',
		[],
		$js_version,
		true
	);

	wp_script_add_data( 'cja-audit', 'defer', true );

	wp_localize_script(
		'cja-audit',
		'cjaConfig',
		[
			'webhookUrl' => esc_url_raw( $webhook_url ),
		]
	);

	ob_start();
	?>
	<div class="cja-wrapper" id="cja-app" data-track-section="growth_audit_instant">
		<span id="form" class="cja-anchor" aria-hidden="true"></span>

		<div class="cja-phase cja-hero" id="cja-input">
			<span class="cja-overline">Kostenloser Growth Audit</span>
			<h1 class="cja-headline">Was kostet Sie Ihre Website an Leads?</h1>
			<p class="cja-subtitle">Performance, SEO, Tracking, Content: in 30 Sekunden sehen Sie, wo Ihr größtes Wachstumspotenzial liegt.</p>

			<div class="cja-input-group">
				<label class="screen-reader-text" for="cja-url-input">Website-URL</label>
				<input type="text" id="cja-url-input" placeholder="ihre-website.de" autocomplete="off" inputmode="url" autocapitalize="off" spellcheck="false" aria-describedby="cja-error">
				<button id="cja-submit" type="button" data-track-action="cja_start_analysis" data-track-category="lead_gen" data-track-section="growth_audit_input">Jetzt analysieren</button>
			</div>

			<div class="cja-trust-line">
				<span aria-hidden="true">🔒</span>
				<span>Keine E-Mail nötig · Ergebnis sofort · 100% kostenlos</span>
			</div>

			<div class="cja-error" id="cja-error" aria-live="polite" hidden></div>
		</div>

		<div class="cja-phase cja-loading" id="cja-loading" hidden>
			<div class="cja-spinner" aria-hidden="true"></div>
			<div class="cja-loading-step" id="cja-loading-step" aria-live="polite">Website wird geladen...</div>
			<div class="cja-loading-url" id="cja-loading-url"></div>
			<div class="cja-progress-track" aria-hidden="true">
				<div class="cja-progress-bar" id="cja-progress-bar"></div>
			</div>
		</div>

		<div class="cja-phase cja-results" id="cja-results" hidden>
			<div class="cja-score-header" id="cja-score-header"></div>
			<div class="cja-modules" id="cja-modules"></div>
			<div class="cja-revenue-shell" id="cja-revenue"></div>

			<div class="cja-cta-section cja-reveal">
				<h2>Diese Probleme lösen?</h2>
				<p>Sie erhalten einen ausführlichen Report mit priorisierten Handlungsempfehlungen, abgestimmt auf Ihre Branche und Ihre Ziele.</p>
				<a href="<?php echo esc_url( $contact_url ); ?>" class="cja-cta-button" data-track-action="cja_results_contact" data-track-category="lead_gen" data-track-section="growth_audit_results">Kostenloses Strategiegespräch buchen</a>
				<div class="cja-cta-meta">15 Min · Unverbindlich · Konkrete nächste Schritte</div>
			</div>

			<div class="cja-footer-line">Powered by WGOS — WordPress Growth Operating System</div>
		</div>
	</div>
	<?php

	return (string) ob_get_clean();
}

add_shortcode( 'cja_audit', 'cja_audit_shortcode' );
