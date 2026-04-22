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

$audit_url      = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$whitelabel_url = function_exists( 'nexus_get_whitelabel_page_url' ) ? nexus_get_whitelabel_page_url() : home_url( '/whitelabel-retainer/' );

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
	'Mein Zugang ist Medienwissenschaften, nicht Design. Ich habe über Jahre B2B-WordPress-Systeme gebaut – von Maschinenbau bis Dienstleistung.',
	'Der Punkt, an dem die Nische unvermeidlich wurde, war ein Solar-Mandat: 120 € CPL, frustrierter Inhaber, defektes Tracking. Als die Leadkosten auf 20 € fielen, wurde klar, wo meine Methode am besten greift. Seitdem konzentriere ich mich auf Solar- und Wärmepumpen-Anbieter im DACH-Raum.',
];

$not_fit_points = [
	'Reine Design-Relaunches ohne Vertriebsziel.',
	'Unternehmen, die keine eigene Leadgenerierung wollen, sondern ausschließlich auf Leadportale setzen.',
	'Projekte außerhalb von Solar und Wärmepumpen, es sei denn als Whitelabel für eine Agentur.',
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
								href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_hero_audit"
							data-track-category="lead_gen"
							data-track-section="about_hero"
						>
							Growth Audit starten
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
						<p>
							Mandat in der Solar-Nische. Hebel: überarbeitete Landingpages, GTM Server-Side, Consent Mode V2, CRM-Attribution über Bitrix24. Laufendes Projekt, die Zahl ist nicht das Finale.
						</p>
					</div>
				</div>
			</div>
		</section>

		<!-- Sektion 3: Ein typisches Projekt -->
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

		<!-- Sektion 4: Hintergrund -->
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

		<!-- Sektion 5: Zwei Wege -->
		<section id="about-paths" class="nx-section about-section">
			<div class="nx-container">
				<div class="nx-section-header about-section__header">
					<h2 class="nx-headline-section">Zwei Wege der Zusammenarbeit.</h2>
				</div>

				<div class="about-paths">
					<article class="about-path about-path--primary">
						<h3>Direkt für Solar- und Wärmepumpen-Anbieter</h3>
						<p>Wenn Sie als Anbieter Ihre eigene Leadgenerierung aufbauen wollen: Growth Audit als Einstieg, danach Umsetzung oder laufende Weiterentwicklung.</p>
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_paths_audit"
							data-track-category="lead_gen"
							data-track-section="about_paths"
						>
							Growth Audit starten
						</a>
					</article>

					<article class="about-path">
						<h3>Whitelabel für Agenturen</h3>
						<p>Wenn Sie als Performance- oder SEO-Agentur einen technischen Partner für GTM Server-Side, Landingpages und Attribution brauchen: ich liefere im Hintergrund, Ihre Kundenbeziehung bleibt unangetastet.</p>
						<a
							href="<?php echo esc_url( $whitelabel_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_paths_whitelabel"
							data-track-category="navigation"
							data-track-section="about_paths"
						>
							Whitelabel &amp; Retainer
						</a>
					</article>
				</div>
			</div>
		</section>

		<!-- Sektion 6: Anti-Pitch -->
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

		<!-- Sektion 7: Finaler CTA -->
		<section id="about-close" class="nx-section about-close">
			<div class="nx-container">
				<div class="about-close__inner">
					<h2 class="nx-headline-section">Prüfen wir Ihren Status quo.</h2>
					<p>Der Growth Audit zeigt in 30–45 Minuten, wo Ihr Anfrage-System konkret klemmt – von der Landingpage bis zur Attribution. Kein Verkaufsgespräch, keine Präsentation. Entweder der Fit passt, oder ich sage Ihnen, welcher Partner besser wäre.</p>
					<p class="about-close__actions">
						<a
							href="<?php echo esc_url( $audit_url ); ?>"
							class="nx-btn nx-btn--ghost"
							data-track-action="cta_about_final_audit"
							data-track-category="lead_gen"
							data-track-section="about_close"
						>
							Growth Audit starten
						</a>
						<a
							href="<?php echo esc_url( $whitelabel_url ); ?>"
							class="about-close__secondary-link"
							data-track-action="cta_about_final_whitelabel"
							data-track-category="navigation"
							data-track-section="about_close"
						>
							Whitelabel &amp; Weiterentwicklung
						</a>
					</p>
				</div>
			</div>
		</section>

	</div>
</main>

<?php get_footer(); ?>
