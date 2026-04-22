<?php
/**
 * Template Name: Nexus Über Mich
 * Description: Nischen-Positionsseite für Solar- und Wärmepumpen-Anbieter
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$audit_url    = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$request_url  = function_exists( 'nexus_get_primary_request_url' ) ? nexus_get_primary_request_url() : home_url( '/solar-waermepumpen-leadgenerierung/#energie-anfrage' );
$request_cta  = function_exists( 'nexus_get_primary_request_cta_label' ) ? nexus_get_primary_request_cta_label() : 'Anfrage stellen';

$hero_facts = [
	[
		'label' => 'Rolle',
		'text'  => 'Spezialist für Anfrage-Systeme in der Solar- und Wärmepumpen-Nische',
	],
	[
		'label' => 'Fokus',
		'text'  => 'Landingpages, technisches SEO, GTM Server-Side, CRM-Attribution',
	],
	[
		'label' => 'Arbeitsweise',
		'text'  => 'Diagnose, Priorisierung nach CPL-Hebel, iterative Umsetzung',
	],
	[
		'label' => 'Standort',
		'text'  => 'Pattensen bei Hannover, Projekte DACH-weit',
	],
];

$proof_stats = [
	[
		'label' => 'CPL vorher:',
		'value' => '120 €',
	],
	[
		'label' => 'CPL nachher:',
		'value' => '20 €',
	],
	[
		'label' => 'Leads:',
		'value' => '1.750+',
	],
];

$proof_story_steps = [
	[
		'label' => 'Vorher',
		'title' => '120 € CPL und ein Vertrieb, der falsche Anfragen abarbeitet.',
		'text'  => 'Das Mandat kam nicht wegen Design. Es kam wegen zu teurer Leads, defektem Tracking und einer Website, die zwar erklärt, aber nicht vorqualifiziert.',
	],
	[
		'label' => 'Eingriff',
		'title' => 'Nicht mehr Traffic. Erst ein sauberes System.',
		'text'  => 'Landingpages neu aufgebaut. GTM Server-Side und Consent Mode V2 sauber gezogen. Bitrix24 so angebunden, dass aus Klicks wieder belastbare Vertriebssignale werden.',
	],
	[
		'label' => 'Danach',
		'title' => '20 € CPL. 1.750+ Leads.',
		'text'  => 'Das Projekt läuft weiter. Genau deshalb ist die Zahl nicht die Story. Die Story ist, dass das System wieder lernt, welcher Klick am Ende Umsatz bringt.',
	],
];

$diagnostic_signals = [
	[
		'title' => 'Marke statt Kaufabsicht.',
		'text'  => 'Die Seite zieht Marken-Traffic. Für kaufnahe Suchanfragen kurz vor der Entscheidung fehlt Sichtbarkeit. Dann kommen Besuche, aber kaum gute Anfragen.',
	],
	[
		'title' => 'Events ohne Abschlussbezug.',
		'text'  => 'Im Werbekonto gibt es Conversions. Im CRM fehlt, welche Anfrage gekauft hat. Dann optimiert das Team auf Aktivität statt auf Umsatz.',
	],
	[
		'title' => 'Technik statt Entscheidungslogik.',
		'text'  => 'Die Seite erklärt Module, Förderungen oder COP-Werte. Aber sie baut keinen klaren Weg aus Nutzen, Proof, Einwandabbau und CTA.',
	],
];

$project_phases = [
	[
		'label' => 'Woche 1–2',
		'title' => 'Audit',
		'text'  => [
			'Ein regionaler Wärmepumpen-Anbieter, 18 Mitarbeiter. Website generiert Traffic, aber kaum Anfragen. Ich prüfe Landingpage-Struktur, Tracking-Setup, Anzeigen-Attribution und Search Console.',
			'Typischer Befund: Die Seite rankt für Marke, nicht für kaufnahe Keywords. Conversion-Events fehlen oder sind doppelt. Die Landingpage erklärt Technik statt Entscheidungslogik.',
		],
	],
	[
		'label' => 'Woche 3–4',
		'title' => 'Priorisierung',
		'text'  => [
			'Drei Hebel zuerst: Landingpage auf Entscheidungslogik umbauen (Nutzen, Proof, Einwandabbau, klare CTA). GTM Server-Side aufsetzen, Consent Mode V2 sauberziehen. CRM-Anbindung mit vollständiger Attribution von Klick bis Vertragsabschluss.',
		],
	],
	[
		'label' => 'Monat 2–3',
		'title' => 'Umsetzung',
		'text'  => [
			'Neue Landingpage live, Tracking sauber, CRM-Pipeline sichtbar. Leadkosten beginnen zu fallen, sobald die Datenrückmeldung an die Anzeigenplattformen stabil ist.',
		],
	],
	[
		'label' => 'Monat 4+',
		'title' => 'Weiterentwicklung',
		'text'  => [
			'Datenbasiert weiterarbeiten: welche Landingpage-Varianten konvertieren besser, welche Regionen sind effizient, welches Angebot senkt CPL weiter. Kein Dauer-Retainer aus Gewohnheit, sondern weil der nächste Hebel bereits sichtbar ist.',
		],
	],
];

$background_paragraphs = [
	'Mein Zugang ist Medienwissenschaften, nicht Design. Deshalb schaue ich zuerst auf Sprache, Entscheidung und Signalqualität.',
	'Über Jahre habe ich B2B-WordPress-Systeme für Maschinenbau und Dienstleistung gebaut. Technisch sauber war selten das eigentliche Problem.',
	'Das Solar-Mandat hat die Richtung festgezogen. 120 € CPL, frustrierter Inhaber, Tracking ohne belastbare Rückmeldung.',
	'Als der CPL auf 20 € fiel, war klar, wo die Methode am stärksten greift. Seitdem konzentriere ich mich auf Solar- und Wärmepumpen-Anbieter im DACH-Raum.',
];

$not_fit_points = [
	'Reine Design-Relaunches ohne Vertriebsziel.',
	'Unternehmen, die keine eigene Leadgenerierung wollen, sondern ausschließlich auf Leadportale setzen.',
	'Projekte außerhalb von Solar und Wärmepumpen.',
	'Kunden, die ein Tracking-Setup wollen, aber keine Consent-Konsequenzen akzeptieren.',
];

get_header();
?>

<main id="main" class="site-main">
	<div class="nexus-about" data-track-section="about_page">

		<!-- Sektion 1: Hero -->
		<section id="about-hero" class="nx-section about-hero">
			<div class="nx-container">
				<div class="about-hero__grid">
					<div class="about-hero__copy">
						<span class="nx-badge nx-badge--gold">ÜBER MICH</span>
						<h1 class="about-hero__title">Ich baue Anfrage-Systeme für Solar- und Wärmepumpen-Anbieter.</h1>
						<p class="about-hero__lead">
							WordPress-Systeme, die qualifizierte Anfragen liefern statt nur Besucher zu zählen. Spezialisiert auf die Nische, messbar in Leadkosten und Pipeline.
						</p>

						<dl class="about-hero__facts">
							<?php foreach ( $hero_facts as $fact ) : ?>
								<div class="about-hero__fact">
									<dt><?php echo esc_html( $fact['label'] ); ?></dt>
									<dd><?php echo esc_html( $fact['text'] ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<p class="about-hero__actions">
							<a
								href="<?php echo esc_url( $request_url ); ?>"
								class="nx-btn nx-btn--primary"
								data-track-action="cta_about_hero_request"
								data-track-category="lead_gen"
								data-track-section="about_hero"
							>
								<?php echo esc_html( $request_cta ); ?>
							</a>
							<a
								href="<?php echo esc_url( $audit_url ); ?>"
								class="about-close__secondary-link"
								data-track-action="cta_about_hero_audit"
								data-track-category="lead_gen"
								data-track-section="about_hero"
							>
								Audit starten
							</a>
						</p>
					</div>

					<aside class="about-profile-card" aria-label="Profil">
						<figure class="about-profile-card__media">
							<img
								src="<?php echo esc_url( hu_get_profile_image_url() ); ?>"
								alt="Porträt von Haşim Üner"
								loading="eager"
								width="340"
								height="420"
							/>
						</figure>
						<div class="about-profile-card__body">
							<span class="about-profile-card__eyebrow">Haşim Üner</span>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<!-- Sektion 2: Warum diese Nische + Proof -->
		<section id="about-priority" class="nx-section about-section about-priority">
			<div class="nx-container">
				<div class="about-priority__grid">
					<div class="about-why">
						<h2 class="nx-headline-section">Warum diese Nische.</h2>
						<p>
							Der Markt ist überhitzt: viele Anbieter, steigende Leadkosten, schlechte Qualität aus Leadportalen. Wer heute wachsen will, braucht ein eigenes Anfrage-System mit sauberer Technik, nicht den nächsten Portal-Vertrag. Genau das baue ich.
						</p>
					</div>

					<div class="about-proof" aria-labelledby="about-proof-title">
						<h2 id="about-proof-title" class="nx-headline-section">Das bisher stärkste Ergebnis.</h2>
						<div class="about-proof__stats" aria-label="Proof-Zahlen">
							<?php foreach ( $proof_stats as $stat ) : ?>
								<div class="about-proof__stat">
									<span class="about-proof__stat-label"><?php echo esc_html( $stat['label'] ); ?></span>
									<strong class="about-proof__stat-value"><?php echo esc_html( $stat['value'] ); ?></strong>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="about-proof__story" aria-label="Proof-Verlauf">
							<?php foreach ( $proof_story_steps as $step ) : ?>
								<article class="about-proof-story">
									<span class="about-proof-story__label"><?php echo esc_html( $step['label'] ); ?></span>
									<h3><?php echo esc_html( $step['title'] ); ?></h3>
									<p><?php echo esc_html( $step['text'] ); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Sektion 3: Diagnose -->
		<section id="about-diagnosis" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Woran ich schnell sehe, dass ein Setup Geld verliert.</h2>
					<p class="about-diagnosis__lead">Nicht an Farben. Nicht an einem fehlenden Button. Sondern an wiederkehrenden Mustern in Suchintention, Tracking und Landingpage-Logik.</p>
				</div>

				<div class="about-diagnosis__grid">
					<?php foreach ( $diagnostic_signals as $signal ) : ?>
						<article class="about-diagnosis-card">
							<h3><?php echo esc_html( $signal['title'] ); ?></h3>
							<p><?php echo esc_html( $signal['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- Sektion 4: Ein typisches Projekt -->
		<section id="about-project" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Wie ein Projekt mit mir aussieht.</h2>
				</div>

				<div class="about-project-timeline">
					<?php foreach ( $project_phases as $phase ) : ?>
						<div class="about-project-phase">
							<span class="about-project-phase__label"><?php echo esc_html( $phase['label'] ); ?></span>
							<h3><?php echo esc_html( $phase['title'] ); ?></h3>
							<?php foreach ( $phase['text'] as $paragraph ) : ?>
								<p><?php echo esc_html( $paragraph ); ?></p>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- Sektion 5: Hintergrund -->
		<section id="about-background" class="nx-section about-section">
			<div class="nx-container">
				<div class="about-background">
					<h2 class="nx-headline-section">Wie ich zur Nische gekommen bin.</h2>
					<?php foreach ( $background_paragraphs as $paragraph ) : ?>
						<p><?php echo esc_html( $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- Sektion 6: Nächste Schritte -->
		<section id="about-paths" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Die zwei sinnvollen nächsten Schritte.</h2>
				</div>

				<div class="about-paths">
					<article class="about-path about-path--primary">
						<h3>Anfrage stellen</h3>
						<p>Wenn klar ist, dass Sie Ihr eigenes Anfrage-System für Solar oder Wärmepumpe aufbauen wollen, gehen Sie direkt ins qualifizierte Formular.</p>
						<a
							href="<?php echo esc_url( $request_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_paths_request"
							data-track-category="lead_gen"
							data-track-section="about_paths"
						>
							<?php echo esc_html( $request_cta ); ?>
						</a>
					</article>

					<article class="about-path">
						<h3>Audit starten</h3>
						<p>Wenn Sie erst sehen wollen, wo Ihr Setup Nachfrage verliert, nehmen Sie den Soft-Einstieg über das KI-Audit und gehen danach ins Formular.</p>
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_paths_audit"
							data-track-category="lead_gen"
							data-track-section="about_paths"
						>
							Audit starten
						</a>
					</article>
				</div>
			</div>
		</section>

		<!-- Sektion 7: Anti-Pitch -->
		<section id="about-not-fit" class="nx-section about-section">
			<div class="nx-container">
				<div class="about-not-fit">
					<h2 class="nx-headline-section">Wofür ich nicht der Richtige bin.</h2>
					<ul class="about-not-fit__list">
						<?php foreach ( $not_fit_points as $point ) : ?>
							<li><?php echo esc_html( $point ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>

		<!-- Sektion 8: Finaler CTA -->
		<section id="about-close" class="nx-section about-close">
			<div class="nx-container">
				<div class="about-close__inner">
					<h2 class="nx-headline-section">Prüfen wir Ihren Status quo.</h2>
					<p>Der Growth Audit zeigt in 30–45 Minuten, wo Ihr Anfrage-System konkret klemmt – von der Landingpage bis zur Attribution. Kein Verkaufsgespräch, keine Präsentation. Entweder der Fit passt, oder ich sage Ihnen, welcher Partner besser wäre.</p>
					<p class="about-close__actions">
						<a
							href="<?php echo esc_url( $request_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_final_request"
							data-track-category="lead_gen"
							data-track-section="about_close"
						>
							<?php echo esc_html( $request_cta ); ?>
						</a>
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="about-close__secondary-link"
							data-track-action="cta_about_final_audit"
							data-track-category="lead_gen"
							data-track-section="about_close"
						>
							Audit starten
						</a>
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
