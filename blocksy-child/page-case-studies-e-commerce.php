<?php
/**
 * Template Name: Ergebnisse Hub
 * Description: Flache Proof-Seite mit E3, DOMDAR und Whitelabel — ohne Hub-Architektur.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url      = nexus_get_audit_url();
$wgos_url       = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
$e3_url         = nexus_get_page_url(
	[ 'e3-new-energy', 'case-studies/e3-new-energy', 'case-e3' ],
	home_url( '/e3-new-energy/' )
);
$domdar_url     = nexus_get_page_url(
	[ 'case-study-domdar', 'domdar' ],
	home_url( '/case-study-domdar/' )
);
$whitelabel_url = nexus_get_whitelabel_page_url();
?>

<main id="main" class="site-main results-hub" data-track-section="results_hub">

	<!-- 1. Hero -->
	<section class="nx-section results-hero">
		<div class="nx-container">
			<div class="results-hero__inner">
				<h1 class="results-hero__title">Ergebnisse.</h1>
				<p class="results-hero__subtitle">
					Zwei öffentliche Cases mit Zahlen. Dazu 12&nbsp;Whitelabel-Projekte und 4&nbsp;laufende Retainer.
				</p>

				<div class="results-metrics" role="list" aria-label="Kennzahlen im Überblick">
					<div class="results-metric" role="listitem">
						<strong>1.750+</strong>
						<span>Leads</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>-83%</strong>
						<span>CPL</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>12%</strong>
						<span>Sales-Conversion</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>16+</strong>
						<span>Projekte</span>
					</div>
				</div>

				<div class="results-hero__actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_hero_audit" data-track-category="lead_gen">Audit starten</a>
				</div>
			</div>
		</div>
	</section>

	<!-- 2. E3 New Energy -->
	<section class="nx-section results-case">
		<div class="nx-container">
			<article class="results-case-card results-case-card--success">
				<div class="results-case-card__content">
					<span class="results-case-card__kicker">Öffentlicher Case · B2B Leadgen</span>
					<h2 class="results-case-card__title">E3 New Energy</h2>
					<p class="results-case-card__context">
						Vom externen Lead-Einkauf zum eigenen Nachfragesystem mit klarer Conversion-Architektur.
					</p>

					<div class="results-case-card__stats">
						<span class="results-case-card__stat">1.750+ Leads</span>
						<span class="results-case-card__stat">-83% CPL</span>
						<span class="results-case-card__stat">12% Sales-Conversion</span>
					</div>

					<ul class="results-bullet-list">
						<li>Extern eingekaufte Leads durch eigenes System ersetzt</li>
						<li>Tracking, Landingpages und Qualifizierung in der richtigen Reihenfolge verbunden</li>
						<li>Wirkung, Vorgehen und Grenzen offen dokumentiert</li>
					</ul>

					<div class="results-case-card__actions">
						<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_e3" data-track-category="trust">Case Study lesen →</a>
					</div>
				</div>
			</article>
		</div>
	</section>

	<!-- 3. DOMDAR -->
	<section class="nx-section results-case">
		<div class="nx-container">
			<article class="results-case-card results-case-card--gold">
				<div class="results-case-card__content">
					<span class="results-case-card__kicker">Öffentlicher Case · E-Commerce</span>
					<h2 class="results-case-card__title">DOMDAR</h2>
					<p class="results-case-card__context">
						Profitabilität aus Bundle-Logik und Recovery-Loops ohne zusätzliches Mediabudget.
					</p>

					<div class="results-case-card__stats">
						<span class="results-case-card__stat">120 € AOV</span>
						<span class="results-case-card__stat">4,6% Conversion Rate</span>
						<span class="results-case-card__stat">0 € mehr Ad-Spend</span>
					</div>

					<ul class="results-bullet-list">
						<li>Mehr Deckungsbeitrag ohne zusätzliches Mediabudget</li>
						<li>Bundles, Recovery-Loops und Operations als gemeinsamer Hebel</li>
						<li>Ideal für E-Commerce-Mechanik jenseits klassischer Leadgen-Logik</li>
					</ul>

					<div class="results-case-card__actions">
						<a href="<?php echo esc_url( $domdar_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_domdar" data-track-category="trust">Case Study lesen →</a>
					</div>
				</div>
			</article>
		</div>
	</section>

	<!-- 4. Whitelabel & Retainer -->
	<section class="nx-section results-case">
		<div class="nx-container">
			<article class="results-case-card results-case-card--highlight">
				<div class="results-case-card__content">
					<span class="results-case-card__kicker">Anonymisierter Proof</span>
					<h2 class="results-case-card__title">Whitelabel &amp; laufende Retainer</h2>
					<p class="results-case-card__context">
						12&nbsp;Projekte und 4&nbsp;Retainer zeigen wiederholbare Zusammenarbeit — ohne öffentliche Logos.
						Typische Eingriffstiefen: SEO, CRO, Tracking, Delivery und Sparring.
					</p>

					<div class="results-case-card__actions">
						<a href="<?php echo esc_url( $whitelabel_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_whitelabel" data-track-category="trust">Mehr erfahren →</a>
					</div>
				</div>
			</article>
		</div>
	</section>

	<!-- 5. Finaler CTA -->
	<section class="nx-section results-cta">
		<div class="nx-container">
			<div class="results-final-cta">
				<h2 class="results-final-cta__title">Prüfen wir Ihren Status&nbsp;quo.</h2>
				<p class="results-final-cta__copy">
					Der Growth Audit zeigt, wo Ihre WordPress-Seite Nachfrage verliert.
				</p>
				<div class="results-final-cta__actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_footer_audit" data-track-category="lead_gen">Audit starten</a>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_results_footer_wgos" data-track-category="trust">WGOS ansehen</a>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
