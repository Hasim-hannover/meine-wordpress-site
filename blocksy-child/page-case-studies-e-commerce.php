<?php
/**
 * Ergebnisse-Hub routed via /case-studies-e-commerce/.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url      = nexus_get_audit_url();
$wgos_url       = nexus_get_page_url(
	[ 'wordpress-growth-operating-system', 'wgos' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$e3_url         = nexus_get_page_url(
	[ 'e3-new-energy', 'case-studies/e3-new-energy', 'case-e3' ],
	home_url( '/e3-new-energy/' )
);
$domdar_url     = nexus_get_page_url(
	[ 'case-study-domdar', 'domdar' ],
	home_url( '/case-study-domdar/' )
);
$whitelabel_url = nexus_get_whitelabel_page_url();

$proof_cards = [
	[
		'badge'   => 'Öffentlicher Deep Dive',
		'title'   => 'E3 New Energy',
		'copy'    => 'B2B-Leadgen mit harter Zahlenlage: vom externen Lead-Einkauf zum eigenen Nachfrage-System mit klarer Conversion-Architektur.',
		'stats'   => [ '1.750+ Leads', '-83 % CPL', '12 % Sales-Conversion' ],
		'cta'     => 'Case öffnen',
		'url'     => $e3_url,
		'accent'  => 'success',
	],
	[
		'badge'   => 'Öffentlicher Deep Dive',
		'title'   => 'DOMDAR',
		'copy'    => 'Sustainable Commerce ohne Mehrbudget: Profitabilität aus Bundle-Logik, Recovery-Loops und operativer Entlastung.',
		'stats'   => [ '120 € AOV', '4,6 % Conversion Rate', '0 € mehr Ad-Spend' ],
		'cta'     => 'Case öffnen',
		'url'     => $domdar_url,
		'accent'  => 'gold',
	],
	[
		'badge'   => 'Anonymisierter Proof',
		'title'   => 'Whitelabel & Retainer',
		'copy'    => '12 Whitelabel-Projekte und 4 laufende Retainer zeigen, wie die Arbeit aussieht, wenn Vertrauen da ist, aber Logos nicht öffentlich werden.',
		'stats'   => [ '12 Projekte', '4 laufende Retainer', 'SEO + CRO + Tracking + Delivery' ],
		'cta'     => 'Seite ansehen',
		'url'     => $whitelabel_url,
		'accent'  => 'highlight',
	],
];

$framework_cards = [
	[
		'title' => 'Öffentliche Cases',
		'copy'  => 'Tiefe Einblicke mit Zahlen, Reihenfolge und klarer Herleitung. Gut für Entscheider, die Ursache und Wirkung verstehen wollen.',
	],
	[
		'title' => 'Anonymisierte Delivery',
		'copy'  => 'Whitelabel-Projekte zeigen Muster statt Logos: wiederkehrende Hebel, typische Engpässe und die Art der Verantwortung im Hintergrund.',
	],
	[
		'title' => 'Laufende Retainer',
		'copy'  => 'Retainer sind der stärkste Vertrauensbeweis: Wer im System bleibt, kauft keine Einzelleistung, sondern wiederholbare Wirkung.',
	],
];

$cro_points = [
	'Weniger Selbstaussage, mehr sichtbare Wirkung und belastbare Muster.',
	'Ein Besucher kann sich selbst einordnen: public case, anonymisierte Arbeit oder laufende Systempflege.',
	'Die Navigation bleibt schlank, aber der Proof wird breiter und glaubwürdiger.',
];
?>

<main id="main" class="site-main results-hub" data-track-section="results_hub">
	<section class="nx-section results-hero">
		<div class="nx-container">
			<div class="results-hero__inner">
				<span class="nx-badge nx-badge--gold">Ergebnisse</span>
				<h1 class="results-hero__title">Sichtbare Cases. Verdeckte Systemarbeit. Ein gemeinsamer Proof-Layer.</h1>
				<p class="results-hero__subtitle">
					Nicht jede Zusammenarbeit darf öffentlich als Case Study auftauchen.
					Deshalb bündelt dieser Hub drei Formen von Nachweis: zwei offene Deep Dives
					und eine dritte Seite für Whitelabel-Arbeit, laufende Retainer und typische Eingriffstiefen.
				</p>

				<div class="results-metrics" role="list" aria-label="Ergebnisse-Überblick">
					<div class="results-metric" role="listitem">
						<strong>2</strong>
						<span>öffentliche Deep Dives</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>12</strong>
						<span>Whitelabel-Projekte</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>4</strong>
						<span>laufende Retainer</span>
					</div>
					<div class="results-metric" role="listitem">
						<strong>1</strong>
						<span>gemeinsame Logik: Reihenfolge vor Aktionismus</span>
					</div>
				</div>

				<div class="results-hero__actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_hero_audit" data-track-category="lead_gen">Audit starten</a>
					<a href="<?php echo esc_url( $whitelabel_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_results_hero_whitelabel" data-track-category="trust">Whitelabel &amp; Retainer</a>
				</div>
			</div>
		</div>
	</section>

	<section class="nx-section results-grid-section" id="proof-grid">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--ghost">Proof-Formate</span>
				<h2 class="nx-headline-section">Drei Wege, dieselbe Arbeitsweise zu prüfen.</h2>
				<p class="nx-subheadline">Nicht jede Seite erfüllt dieselbe Aufgabe. Zusammen zeigen sie Reichweite, Tiefe und Wiederholbarkeit.</p>
			</div>

			<div class="results-card-grid">
				<?php foreach ( $proof_cards as $card ) : ?>
					<article class="nx-card results-card results-card--<?php echo esc_attr( $card['accent'] ); ?>">
						<span class="results-card__badge"><?php echo esc_html( $card['badge'] ); ?></span>
						<h3 class="results-card__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="results-card__copy"><?php echo esc_html( $card['copy'] ); ?></p>
						<ul class="results-card__stats" aria-label="<?php echo esc_attr( $card['title'] . ' Kennzahlen' ); ?>">
							<?php foreach ( $card['stats'] as $stat ) : ?>
								<li><?php echo esc_html( $stat ); ?></li>
							<?php endforeach; ?>
						</ul>
						<div class="results-card__actions">
							<a href="<?php echo esc_url( $card['url'] ); ?>" class="nx-btn nx-btn--ghost"><?php echo esc_html( $card['cta'] ); ?></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section results-framework">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--gold">Warum das so aufgebaut ist</span>
				<h2 class="nx-headline-section">Ein guter Proof-Hub verkauft keine Selbstdarstellung.</h2>
				<p class="nx-subheadline">Er hilft Besuchern zu verstehen, wie belastbar die Arbeit über unterschiedliche Projektsituationen hinweg ist.</p>
			</div>

			<div class="results-framework__grid">
				<?php foreach ( $framework_cards as $card ) : ?>
					<article class="nx-card nx-card--flat results-framework__card">
						<h3 class="results-framework__title"><?php echo esc_html( $card['title'] ); ?></h3>
						<p class="results-framework__copy"><?php echo esc_html( $card['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="results-cro-card">
				<div>
					<span class="results-cro-card__eyebrow">CRO-Sicht</span>
					<h3 class="results-cro-card__title">Warum das stärker ist als eine reine Skill-Seite</h3>
				</div>
				<ul class="results-bullet-list">
					<?php foreach ( $cro_points as $point ) : ?>
						<li><?php echo esc_html( $point ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<section class="nx-section results-cta">
		<div class="nx-container">
			<div class="results-cta__shell">
				<div>
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2 class="results-cta__title">Erst Proof prüfen. Dann die eigene Situation einordnen.</h2>
					<p class="results-cta__copy">
						Wenn Sie wissen wollen, welche dieser Muster auf Ihre WordPress-Seite zutreffen,
						ist der sinnvollste Schritt der Growth Audit. Wenn Sie erst die Systemlogik dahinter
						verstehen wollen, gehen Sie über die WGOS-Seite tiefer.
					</p>
				</div>
				<div class="results-cta__actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_results_footer_audit" data-track-category="lead_gen">Audit starten</a>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost">WGOS ansehen</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
