<?php
/**
 * Template Name: Whitelabel & Weiterentwicklung
 * Description: Anonymisierte Whitelabel-Arbeit, laufende Weiterentwicklung und Delivery im Hintergrund.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url    = nexus_get_audit_url();
$results_url  = nexus_get_results_url();
$wgos_url     = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
$portrait_url = 'https://hasimuener.de/wp-content/uploads/2026/01/Hasim-Uener-Prtraeit_Startseite.webp';

$focus_areas = [
	[
		'title' => 'Money Pages & Angebotslogik',
		'copy'  => 'Struktur, Messaging, Proof, CTA-Reihenfolge und Einwandabbau für Seiten, die nicht nur gut aussehen, sondern Entscheidungen tragen sollen.',
	],
	[
		'title' => 'Technical SEO & Performance',
		'copy'  => 'Fundament-Arbeit, die häufig unsichtbar bleibt, aber spätere Reichweite und Conversion-Effizienz überhaupt erst belastbar macht.',
	],
	[
		'title' => 'Tracking & Entscheidungslogik',
		'copy'  => 'Saubere Events, Consent, Attribution und Priorisierung, damit Teams nicht aus Reporting-Rauschen die falschen Schlüsse ziehen.',
	],
	[
		'title' => 'Delivery im Hintergrund',
		'copy'  => 'Whitelabel heißt oft: schnell im Team andocken, Verantwortung übernehmen und nach außen unsichtbar bleiben, ohne dass Qualität leidet.',
	],
];

$pattern_cards = [
	[
		'title' => 'Von unscharfen Seiten zu klaren Nachfragepfaden',
		'copy'  => 'Typischer Hebel: Positionierung schärfen, Beweisführung ordnen, CTAs priorisieren. Ergebnis: höhere Gesprächsqualität statt nur mehr Formularen.',
	],
	[
		'title' => 'Von Datenschatten zu belastbaren Signalen',
		'copy'  => 'Typischer Hebel: Tracking reparieren, Conversion-Definitionen geradeziehen, Consent-Reibung auflösen. Ergebnis: weniger Bauchgefühl in Entscheidungen.',
	],
	[
		'title' => 'Von punktuellen Fixes zu laufender Systempflege',
		'copy'  => 'Laufende Weiterentwicklung bedeutet nicht Dauerbeschäftigung, sondern wiederkehrend an den größten Reibungsverlusten arbeiten, bevor sie teuer werden.',
	],
];

$work_modes = [
	[
		'title' => 'Whitelabel für Agenturen',
		'copy'  => 'Im Hintergrund an Strategie, UX, SEO, Tracking oder Conversion arbeiten, während die Kundenbeziehung bei der Agentur bleibt.',
	],
	[
		'title' => 'Laufende Weiterentwicklung für bestehende Systeme',
		'copy'  => 'Für Teams, bei denen Fundament und Kernlogik stehen, aber Priorisierung, Monitoring und kontrollierte Iteration dauerhaft gebraucht werden.',
	],
	[
		'title' => 'Sparringspartner für anspruchsvolle Fälle',
		'copy'  => 'Wenn Positionierung, Technik und Conversion gleichzeitig klemmen und einfache Paketlogik den Fall eher verdeckt als klärt.',
	],
];

$skill_items = [
	'Technical SEO',
	'CRO & Conversion-Architektur',
	'WordPress-Systemaufbau',
	'Privacy-first Tracking',
	'Page Messaging',
	'Performance-Fundament',
	'Weiterentwicklungs-Setup',
	'Whitelabel Delivery',
];
?>

<main id="main" class="site-main wl-proof-page" data-track-section="whitelabel_proof">
	<section class="nx-section wl-hero">
		<div class="nx-container">
			<div class="wl-hero__grid">
				<div class="wl-hero__copy">
					<span class="nx-badge nx-badge--gold">Whitelabel &amp; laufende Weiterentwicklung</span>
					<h1 class="wl-hero__title">Whitelabel-Arbeit und laufende Weiterentwicklung. Viel Wirkung bleibt im Hintergrund.</h1>
					<p class="wl-hero__subtitle">
						Ein Teil meiner stärksten Arbeit darf nicht als öffentliche Case Study erscheinen.
						Nicht weil sie schwächer wäre, sondern weil sie in Agentur-Setups, laufender Systemarbeit
						oder sensiblen Projekten bewusst unsichtbar bleibt. Genau deshalb ist diese Seite wichtig.
					</p>

					<div class="wl-metrics" role="list" aria-label="Whitelabel-Kennzahlen">
						<div class="wl-metric" role="listitem">
							<strong>Whitelabel</strong>
							<span>unsichtbare Delivery im Hintergrund</span>
						</div>
						<div class="wl-metric" role="listitem">
							<strong>laufend</strong>
							<span>kontrollierte Weiterentwicklung statt Einzelfix</span>
						</div>
						<div class="wl-metric" role="listitem">
							<strong>klar</strong>
							<span>Rolle: im Hintergrund Wirkung erzeugen</span>
						</div>
					</div>

					<ul class="results-bullet-list wl-hero__list">
						<li>für Agenturen, Inhouse-Teams und Gründer mit komplexeren WordPress-Fällen</li>
						<li>mit Fokus auf Struktur, Messbarkeit, Performance und Conversion statt Einzeldisziplinen</li>
						<li>als Delivery, Sparring oder laufende Systempflege</li>
					</ul>

					<div class="wl-hero__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_whitelabel_hero_audit" data-track-category="lead_gen">Audit starten</a>
						<a href="<?php echo esc_url( $results_url ); ?>" class="nx-btn nx-btn--ghost">Alle Ergebnisse</a>
					</div>
				</div>

				<aside class="nx-card wl-portrait-card">
					<div class="wl-portrait-card__media">
						<img
							src="<?php echo esc_url( $portrait_url ); ?>"
							alt="Haşim Üner Portrait für die Whitelabel- und Weiterentwicklungs-Seite"
							loading="eager"
							width="960"
							height="1200"
						>
					</div>
					<div class="wl-portrait-card__body">
						<span class="wl-portrait-card__eyebrow">Haşim Üner</span>
						<h2 class="wl-portrait-card__title">Proof ohne Logos funktioniert nur mit klarer Haltung.</h2>
						<p class="wl-portrait-card__copy">
							Wenn Arbeit nicht öffentlich werden darf, muss die Seite etwas anderes leisten:
							sie muss Verantwortung, Eingriffstiefe und Wiederholbarkeit sichtbar machen.
						</p>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<section class="nx-section wl-section-alt" id="arbeitsfelder">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--ghost">Typische Eingriffstiefe</span>
				<h2 class="nx-headline-section">Woran ich im Hintergrund meist arbeite</h2>
				<p class="nx-subheadline">Nicht als Skill-Folie, sondern als reale Verantwortung in Projekten, die laufen müssen.</p>
			</div>

			<div class="results-card-grid">
				<?php foreach ( $focus_areas as $area ) : ?>
					<article class="nx-card results-card results-card--gold">
						<h3 class="results-card__title"><?php echo esc_html( $area['title'] ); ?></h3>
						<p class="results-card__copy"><?php echo esc_html( $area['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section" id="muster">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--gold">Anonymisierte Ergebnismuster</span>
				<h2 class="nx-headline-section">Was sich in diesen Projekten typischerweise verbessert</h2>
				<p class="nx-subheadline">Keine erfundenen Logos. Keine geschönten Slides. Sondern die Muster, die in Whitelabel-Arbeit und laufender Weiterentwicklung immer wieder auftauchen.</p>
			</div>

			<div class="results-framework__grid">
				<?php foreach ( $pattern_cards as $pattern ) : ?>
					<article class="nx-card nx-card--flat results-framework__card">
						<h3 class="results-framework__title"><?php echo esc_html( $pattern['title'] ); ?></h3>
						<p class="results-framework__copy"><?php echo esc_html( $pattern['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section wl-section-alt" id="zusammenarbeit">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--ghost">Zusammenarbeit</span>
				<h2 class="nx-headline-section">In welchen Modi diese Arbeit meist passiert</h2>
				<p class="nx-subheadline">Je nach Fall als operative Unterstützung, laufende Optimierung oder strategischer Sparringspartner.</p>
			</div>

			<div class="results-framework__grid">
				<?php foreach ( $work_modes as $mode ) : ?>
					<article class="nx-card nx-card--flat results-framework__card">
						<h3 class="results-framework__title"><?php echo esc_html( $mode['title'] ); ?></h3>
						<p class="results-framework__copy"><?php echo esc_html( $mode['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section" id="skills">
		<div class="nx-container">
			<div class="results-cro-card results-cro-card--compact">
				<div>
					<span class="results-cro-card__eyebrow">Wenn man es Skills nennen will</span>
					<h2 class="results-cro-card__title">Die Themen wiederholen sich. Die Verantwortung auch.</h2>
					<p class="results-cta__copy">
						Der Unterschied ist nicht, dass diese Begriffe irgendwo auf einer Folie stehen.
						Der Unterschied ist, dass sie in echten Projekten unter Zeitdruck, mit Übergaben
						und ohne öffentliche Sichtbarkeit funktionieren müssen.
					</p>
				</div>
				<div class="wl-skill-cloud" aria-label="Typische Arbeitsfelder">
					<?php foreach ( $skill_items as $skill_item ) : ?>
						<span><?php echo esc_html( $skill_item ); ?></span>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="nx-section results-cta">
		<div class="nx-container">
			<div class="results-cta__shell">
				<div>
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2 class="results-cta__title">Wenn Ihre Seite eher nach Systemarbeit als nach Schönheitskorrektur verlangt</h2>
					<p class="results-cta__copy">
						Dann lohnt kein loses Leistungsmenü. Dann lohnt zuerst eine Diagnose, die die größten
						Reibungsverluste sichtbar macht und daraus eine saubere Reihenfolge ableitet.
					</p>
				</div>
				<div class="results-cta__actions">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_whitelabel_footer_audit" data-track-category="lead_gen">Audit starten</a>
					<a href="<?php echo esc_url( $wgos_url ); ?>" class="nx-btn nx-btn--ghost">WGOS ansehen</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
