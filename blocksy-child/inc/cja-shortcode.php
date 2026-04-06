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
	$css_path            = get_stylesheet_directory() . '/assets/css/cja-audit.css';
	$js_path             = get_stylesheet_directory() . '/assets/js/cja-audit.js';
	$contact_url         = function_exists( 'nexus_get_contact_url' ) ? nexus_get_contact_url() : home_url( '/kontakt/' );
	$cta_url             = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : '';
	$legacy_webhook_url  = (string) apply_filters( 'cja_audit_webhook_url', 'https://n8n.hasimuener.de/webhook/cja-analyze' );
	$default_start_url   = (string) preg_replace( '#/webhook/[^/?]+$#', '/webhook/audit', $legacy_webhook_url );
	$default_status_url  = (string) preg_replace( '#/webhook/[^/?]+$#', '/webhook/audit-status', $legacy_webhook_url );
	$webhook_start_url   = (string) apply_filters( 'cja_audit_webhook_start_url', $default_start_url );
	$webhook_status_url  = (string) apply_filters( 'cja_audit_webhook_status_url', $default_status_url );
	$css_version         = file_exists( $css_path ) ? (string) filemtime( $css_path ) : '1.0.0';
	$js_version          = file_exists( $js_path ) ? (string) filemtime( $js_path ) : '1.0.0';

	if ( $default_start_url === $legacy_webhook_url ) {
		$webhook_start_url = (string) apply_filters( 'cja_audit_webhook_start_url', 'https://n8n.hasimuener.de/webhook/audit' );
	}

	if ( $default_status_url === $legacy_webhook_url ) {
		$webhook_status_url = (string) apply_filters( 'cja_audit_webhook_status_url', 'https://n8n.hasimuener.de/webhook/audit-status' );
	}

	if ( '' === $cta_url ) {
		$cta_url = $contact_url;
	}

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
			'webhookStartUrl' => esc_url_raw( $webhook_start_url ),
			'webhookStatusUrl' => esc_url_raw( $webhook_status_url ),
			'legacyWebhookUrl' => esc_url_raw( $legacy_webhook_url ),
			'webhookUrl' => esc_url_raw( $legacy_webhook_url ),
			'pollInterval' => 4500,
			'pollTimeout' => 180000,
		]
	);

	ob_start();
	?>
	<div class="cja-wrapper" id="cja-app" data-track-section="growth_audit_instant">
		<span id="form" class="cja-anchor" aria-hidden="true"></span>

		<div class="cja-phase cja-hero" id="cja-input">
			<span class="cja-overline">60-Sekunden-Diagnose für WordPress-B2B-Websites</span>
			<h1 class="cja-headline">In 60 Sekunden sehen Sie, wo Ihre Website Leads verliert.</h1>
			<p class="cja-subtitle">Der Audit zeigt direkt, wo Performance, Tracking, SEO und Content Nachfrage bremsen und welche Hebel zuerst Wirkung versprechen.</p>

			<div class="cja-input-group">
				<label class="screen-reader-text" for="cja-url-input">Website-URL</label>
				<input type="text" id="cja-url-input" placeholder="ihre-domain.de" autocomplete="off" inputmode="url" autocapitalize="off" spellcheck="false" aria-describedby="cja-error">
				<button id="cja-submit" type="button" data-track-action="cja_start_analysis" data-track-category="lead_gen" data-track-section="growth_audit_input">Diagnose starten</button>
			</div>
			<p class="cja-input-help">Starten Sie mit Ihrer Startseite oder der wichtigsten Angebotsseite. Sie sehen direkt die größten Reibungen und priorisierten Hebel.</p>

			<div class="cja-trust-line" aria-label="Audit-Vertrauen">
				<span>Keine E-Mail nötig</span>
				<span>WordPress- und B2B-Fokus</span>
				<span>Priorisierte Hebel statt Tool-Score</span>
			</div>

			<div class="cja-preview" aria-label="Ergebnisvorschau">
				<div class="cja-preview-head">
					<p class="cja-preview-kicker">Sie sehen direkt</p>
					<h2 class="cja-preview-title">Kein generischer Score, sondern ein klarer Diagnose-Einstieg.</h2>
				</div>

				<div class="cja-preview-grid">
					<article class="cja-preview-item">
						<span class="cja-preview-index">01</span>
						<h3>Wo Anfragen verloren gehen</h3>
						<p>Versprechen, Proof, CTA und Reibung im Anfragepfad Ihrer Website.</p>
					</article>
					<article class="cja-preview-item">
						<span class="cja-preview-index">02</span>
						<h3>Welche Signale fehlen</h3>
						<p>Tracking, SEO, Content und Performance dort, wo Nachfrage messbar werden sollte.</p>
					</article>
					<article class="cja-preview-item">
						<span class="cja-preview-index">03</span>
						<h3>Was zuerst Sinn ergibt</h3>
						<p>Priorisierte Hebel statt Maßnahmenliste ohne Reihenfolge oder Kontext.</p>
					</article>
				</div>
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
				<p class="cja-cta-kicker">Nächster Schritt</p>
				<h2>Wenn Sie diese Hebel sauber priorisieren wollen</h2>
				<p>Wir ordnen das Ergebnis gemeinsam ein, trennen Quick Wins von strukturellen Themen und klären, welcher nächste Schritt wirklich sinnvoll ist.</p>
				<div class="cja-cta-actions">
					<a href="<?php echo esc_url( $cta_url ); ?>" class="cja-cta-button" data-track-action="cja_results_contact" data-track-category="lead_gen" data-track-section="growth_audit_results">Ergebnis gemeinsam einordnen</a>
					<?php if ( $contact_url !== $cta_url ) : ?>
						<a href="<?php echo esc_url( $contact_url ); ?>" class="cja-cta-link" data-track-action="cja_results_contact_alt" data-track-category="lead_gen" data-track-section="growth_audit_results">Lieber erst eine Frage schicken</a>
					<?php endif; ?>
				</div>
				<div class="cja-cta-meta">15 Min · konkrete Prioritäten · ohne Verpflichtungsdruck</div>
			</div>

			<div class="cja-footer-line">Basierend auf WGOS — WordPress Growth Operating System</div>
		</div>
	</div>
	<?php

	return (string) ob_get_clean();
}

add_shortcode( 'cja_audit', 'cja_audit_shortcode' );
