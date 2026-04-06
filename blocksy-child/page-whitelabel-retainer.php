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

$results_url         = nexus_get_results_url();
$wgos_url            = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
$whitelabel_fit_url  = function_exists( 'nexus_get_whitelabel_calendar_url' ) ? nexus_get_whitelabel_calendar_url() : 'https://cal.com/hasim-uener/whitelabel-fit-gesprach?overlayCalendar=true';
$portrait_url        = hu_get_portrait_image_url();

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

?>

<main id="main" class="site-main wl-proof-page" data-track-section="whitelabel_proof">
	<section class="nx-section wl-hero">
		<div class="nx-container">
			<div class="wl-hero__content">
				<span class="nx-badge nx-badge--gold">Whitelabel · Weiterentwicklung · WordPress</span>
				<h1 class="wl-hero__title">Starke Ergebnisse. Im Hintergrund.</h1>
				<p class="wl-hero__subtitle">
					Für Agenturen und Teams, die einen verlässlichen WordPress-Partner brauchen — für Strategie, SEO, Tracking und Conversion, ohne eigenen Headcount.
				</p>

				<div class="wl-hero__actions">
					<a href="<?php echo esc_url( $whitelabel_fit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_whitelabel_hero_fit_call" data-track-category="lead_gen">Whitelabel-Fit-Gespräch buchen</a>
					<a href="<?php echo esc_url( $results_url ); ?>" class="wl-text-link" data-track-action="cta_whitelabel_hero_results" data-track-category="trust">Ergebnisse ansehen</a>
				</div>

				<figure class="wl-hero__portrait">
					<img
						src="<?php echo esc_url( $portrait_url ); ?>"
						alt="Haşim Üner – Whitelabel WordPress Partner"
						loading="eager"
						width="120"
						height="148"
					>
					<figcaption>Haşim Üner · WordPress Growth Architect</figcaption>
				</figure>
			</div>
		</div>
	</section>

	<section class="nx-section wl-section-alt" id="arbeitsfelder">
		<div class="nx-container">
			<div class="nx-section-header">
				<span class="nx-badge nx-badge--ghost">Eingriffstiefe</span>
				<h2 class="nx-headline-section">Woran ich im Hintergrund arbeite</h2>
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
				<span class="nx-badge nx-badge--gold">Ergebnismuster</span>
				<h2 class="nx-headline-section">Was sich typischerweise verbessert</h2>
			</div>

			<div class="results-framework__grid">
				<?php foreach ( $pattern_cards as $pattern ) : ?>
					<article class="nx-card nx-card--flat results-framework__card">
						<h3 class="results-framework__title"><?php echo esc_html( $pattern['title'] ); ?></h3>
						<p class="results-framework__copy"><?php echo esc_html( $pattern['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="results-framework__grid" style="margin-top: var(--space-8, 2rem);">
				<?php foreach ( $work_modes as $mode ) : ?>
					<article class="nx-card nx-card--flat results-framework__card">
						<h3 class="results-framework__title"><?php echo esc_html( $mode['title'] ); ?></h3>
						<p class="results-framework__copy"><?php echo esc_html( $mode['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="nx-section results-cta">
		<div class="nx-container">
			<div class="results-cta__shell">
				<div>
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2 class="results-cta__title">Wenn Sie einen verlässlichen Partner im Hintergrund suchen</h2>
					<p class="results-cta__copy">
						Dann ist kein loses Leistungsmenü hilfreich. Im Whitelabel-Fit-Gespräch klären wir kurz,
						ob ich fachlich, technisch und operativ zu Ihrem Setup passe und welche Form der Zusammenarbeit sinnvoll wäre.
					</p>
				</div>
				<div class="results-cta__actions">
					<a href="<?php echo esc_url( $whitelabel_fit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_whitelabel_footer_fit_call" data-track-category="lead_gen">Whitelabel-Fit-Gespräch buchen</a>
					<a href="<?php echo esc_url( $results_url ); ?>" class="wl-text-link" data-track-action="cta_whitelabel_footer_results" data-track-category="trust">Ergebnisse ansehen</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
