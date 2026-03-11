<?php
/**
 * Template Name: WGOS Asset Hub
 * Description: Klickbare WGOS Asset-Landkarte
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url    = nexus_get_audit_url();
$calendar_url = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : 'https://cal.com/hasim/30min';
$wgos_url     = function_exists( 'nexus_get_wgos_url' ) ? nexus_get_wgos_url() : home_url( '/wordpress-growth-operating-system/' );
$payload      = function_exists( 'nexus_get_wgos_asset_explorer_payload' ) ? nexus_get_wgos_asset_explorer_payload() : [
	'wgosAssetPhases'  => [],
	'wgosAssetModules' => [],
	'wgosAssets'       => [],
	'summary'          => [],
];
$summary      = isset( $payload['summary'] ) && is_array( $payload['summary'] ) ? $payload['summary'] : [];
$asset_count  = isset( $summary['totalAssets'] ) ? (int) $summary['totalAssets'] : count( $payload['wgosAssets'] );
$publish_count = isset( $summary['publishedAssets'] ) ? (int) $summary['publishedAssets'] : 0;
$draft_count   = isset( $summary['draftAssets'] ) ? (int) $summary['draftAssets'] : 0;
?>

<main id="main" class="site-main">
	<div class="wgos-wrapper">
		<section class="wgos-hero">
			<div class="wgos-container">
				<div class="wgos-hero-grid">
					<div class="wgos-hero-copy">
						<span class="wgos-kicker">WGOS Systemlandkarte</span>
						<h1 class="wgos-hero__title">Alle WGOS Assets auf einen Blick.</h1>
						<p class="wgos-hero__subtitle">Diese Seite ist die operative Ebene unter dem WGOS-System. Hier sehen Sie alle Bausteine klickbar, nach Abschnitten geordnet und mit sauberer Verbindung zu den einzelnen Asset-Detailseiten.</p>

						<ul class="wgos-hero__bullets">
							<li>Nach Phasen und Kernbereichen sortiert</li>
							<li>Jedes Asset direkt klickbar</li>
							<li>Saubere Brücke zwischen System und Umsetzung</li>
						</ul>

						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $wgos_url ); ?>" class="wgos-btn wgos-btn--outline">Zum WGOS-System</a>
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
						</div>

						<p class="wgos-hero__microcopy">Die Systemseite erklärt die Logik. Diese Seite zeigt die Bausteine, aus denen das System praktisch gebaut wird.</p>
					</div>

					<aside class="wgos-hero-card" aria-label="Nutzen der Systemlandkarte">
						<span class="wgos-principle-kicker">Was diese Seite leistet</span>
						<dl class="wgos-hero-card__list">
							<div class="wgos-hero-card__row">
								<dt>Orientierung</dt>
								<dd>Sie sehen sofort, welche Assets zu welchem Kernbereich gehören.</dd>
							</div>
							<div class="wgos-hero-card__row">
								<dt>Priorisierung</dt>
								<dd>Assets werden nicht lose, sondern im Kontext von Reihenfolge und Wirkung verstanden.</dd>
							</div>
							<div class="wgos-hero-card__row">
								<dt>Tiefe</dt>
								<dd>Von hier aus gelangen Sie direkt in die einzelnen Asset-Detailseiten.</dd>
							</div>
						</dl>
					</aside>
				</div>

				<div class="wgos-trust-strip" aria-label="Systemlandkarte Kennzahlen">
					<div class="wgos-trust-item">
						<span class="wgos-trust-value"><?php echo esc_html( (string) $asset_count ); ?></span>
						<span class="wgos-trust-label">definierte Assets</span>
					</div>
					<div class="wgos-trust-item">
						<span class="wgos-trust-value"><?php echo esc_html( (string) $publish_count ); ?></span>
						<span class="wgos-trust-label">publizierte Detailseiten</span>
					</div>
					<div class="wgos-trust-item">
						<span class="wgos-trust-value"><?php echo esc_html( (string) $draft_count ); ?></span>
						<span class="wgos-trust-label">Assets in Vorbereitung</span>
					</div>
				</div>
			</div>
		</section>

		<section id="explorer" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Asset Explorer</span>
					<h2 class="wgos-h2">Klickbare Bausteine statt versteckter Einzelleistungen.</h2>
					<p class="wgos-section-intro">Jedes Asset ist einem klaren Abschnitt zugeordnet und lässt sich direkt öffnen. So bleibt WGOS als System sichtbar, auch wenn man tiefer in einzelne Bausteine geht.</p>
				</div>

				<div id="wgos-asset-explorer-root" class="wgos-asset-explorer-root"></div>
				<noscript>
					<p class="wgos-section-intro">Der Explorer benötigt JavaScript. Die einzelnen Assets sind weiterhin über die WGOS Asset-Detailseiten erreichbar.</p>
				</noscript>
			</div>
		</section>

		<section class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-contrast-grid">
					<article class="wgos-contrast-card">
						<h3>Wie diese Ebene genutzt wird</h3>
						<ul class="wgos-checklist wgos-checklist--compact">
							<li>Sie dient als Landkarte für alle vorhandenen WGOS-Bausteine.</li>
							<li>Sie macht die Struktur hinter Credits, Modulen und Detailseiten sichtbar.</li>
							<li>Sie hilft, einzelne Assets im Gesamtsystem einzuordnen.</li>
						</ul>
					</article>

					<article class="wgos-contrast-card">
						<h3>Warum das sinnvoll ist</h3>
						<ul class="wgos-checklist wgos-checklist--compact">
							<li>Die Hauptseite bleibt strategisch und klar.</li>
							<li>Die operative Tiefe bekommt ihren eigenen, besseren Ort.</li>
							<li>Neue Assets lassen sich später sauber ergänzen statt in statische Listen zu kippen.</li>
						</ul>
					</article>
				</div>
			</div>
		</section>

		<section class="wgos-section wgos-section--white wgos-final-cta nx-reveal">
			<div class="wgos-container">
				<div class="wgos-final-cta__inner">
					<span class="wgos-principle-kicker">Nächster Schritt</span>
					<h2 class="wgos-h2">Erst die Systemlogik verstehen. Dann den richtigen Baustein priorisieren.</h2>
					<p class="wgos-prose">Wenn Sie nicht nur wissen wollen, welche Assets es gibt, sondern welche davon in Ihrer Lage zuerst sinnvoll sind, ist der Growth Audit der richtige Einstieg.</p>

					<div class="wgos-hero__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
						<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespräch vereinbaren</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>
