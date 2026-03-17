<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System - strategische Systemseite
 *
 * Content bleibt template-driven; SEO-Meta liegt zentral in inc/seo-meta.php.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$audit_url    = nexus_get_audit_url();
$calendar_url = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' );
$cases_url    = nexus_get_results_url();
$asset_hub_url = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : home_url( '/wgos-systemlandkarte/' );
$page_url     = get_permalink( get_queried_object_id() );

if ( ! $page_url ) {
	$page_url = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
}

$nav_items = [
	[
		'id'    => 'problem',
		'label' => 'Problem',
	],
	[
		'id'    => 'failure',
		'label' => 'Taktiken',
	],
	[
		'id'    => 'system',
		'label' => 'System',
	],
	[
		'id'    => 'module',
		'label' => 'Module',
	],
	[
		'id'    => 'proof',
		'label' => 'Proof',
	],
	[
		'id'    => 'audit',
		'label' => 'Audit',
	],
	[
		'id'    => 'faq',
		'label' => 'FAQ',
	],
];

$hero_snapshot = [
	[
		'phase' => 'Phase 01',
		'title' => 'Strategie + Fundament',
		'text'  => 'Angebotslogik, Prioritäten und technische Tragfähigkeit werden zuerst geklärt.',
	],
	[
		'phase' => 'Phase 02',
		'title' => 'Messbarkeit + Sichtbarkeit',
		'text'  => 'Datenqualität und Nachfrageaufbau greifen kontrolliert ineinander.',
	],
	[
		'phase' => 'Phase 03',
		'title' => 'Conversion + Weiterentwicklung',
		'text'  => 'Die Website lernt aus Signalen und führt klarer zur Anfrage.',
	],
];

$hero_proof = [
	[
		'context' => 'E3 New Energy',
		'value'   => '1.750+',
		'label'   => 'Leads im Skalierungsfenster',
	],
	[
		'context' => 'E3 New Energy',
		'value'   => '-83%',
		'label'   => 'CPL vs. Lead-Einkauf',
	],
	[
		'context' => 'DOMDAR',
		'value'   => '120 EUR',
		'label'   => 'AOV nach 9 Monaten',
	],
];

$problem_points = [
	'Traffic ist da, aber Anfragequalität bleibt unscharf.',
	'SEO, Tracking, Content und Ads folgen verschiedenen Logiken.',
	'Reporting wächst, Entscheidungssicherheit nicht.',
	'Gute Einzelseiten existieren, aber kein gemeinsamer Anfragepfad.',
];

$failure_cards = [
	[
		'title'   => 'SEO ohne Messbarkeit',
		'surface' => 'Mehr Sichtbarkeit fühlt sich nach Fortschritt an.',
		'result'  => 'Ohne belastbare Signale bleibt unklar, welche Seiten echte Nachfrage tragen.',
	],
	[
		'title'   => 'Tracking ohne Operating Model',
		'surface' => 'Dashboards sehen sauber aus.',
		'result'  => 'Wenn Angebotslogik und Seitenpfade nicht stimmen, dokumentiert Tracking nur besser denselben Blindflug.',
	],
	[
		'title'   => 'Relaunch ohne Reihenfolge',
		'surface' => 'Die Website wirkt moderner.',
		'result'  => 'Strategische Lücken, Conversion-Brüche und Prioritätsfehler bleiben bestehen.',
	],
	[
		'title'   => 'Ads vor dem Fundament',
		'surface' => 'Mehr Budget erzeugt kurzfristig Bewegung.',
		'result'  => 'Technische Reibung und schwache Landingpages machen Nachfrage teuer statt planbar.',
	],
];

$system_phases = [
	[
		'step'    => '01',
		'label'   => 'Orientierung',
		'title'   => 'Strategie + Fundament',
		'copy'    => 'Hier wird festgelegt, was die Website leisten soll und ob die WordPress-Basis dafür trägt.',
		'outcome' => 'Aus Aktionismus wird eine saubere Prioritätenlogik.',
	],
	[
		'step'    => '02',
		'label'   => 'Signale',
		'title'   => 'Messbarkeit + Sichtbarkeit',
		'copy'    => 'Datenqualität und Nachfrageaufbau werden auf dieselbe Zielsetzung ausgerichtet.',
		'outcome' => 'Sichtbarkeit wird beurteilbar statt nur messbar.',
	],
	[
		'step'    => '03',
		'label'   => 'Nachfrage',
		'title'   => 'Conversion + Weiterentwicklung',
		'copy'    => 'Proof, Nutzerführung und Priorisierung machen die nächste Entscheidung belastbar.',
		'outcome' => 'Mehr qualifizierte Anfragen bei weniger Blindflug.',
	],
];

$system_principles = [
	'Reihenfolge ist Teil der Leistung, nicht nur die Umsetzung.',
	'Jedes Modul stärkt die nächste Ebene statt isoliert zu laufen.',
	'Der Audit klärt Einstiegspunkt, Tiefe und Priorität.',
];

$core_areas = [
	[
		'number'  => '01',
		'title'   => 'Strategie',
		'summary' => 'Richtet Angebot, Seitenrollen und Prioritäten aus.',
		'function'=> 'Schärft Positionierung, Angebotslogik und Roadmap.',
		'impact'  => 'Verhindert parallele Einzelmaßnahmen ohne gemeinsames Ziel.',
		'outcome' => 'Klarere Richtung für Seiten, Inhalte und Entscheidungen.',
	],
	[
		'number'  => '02',
		'title'   => 'Technisches Fundament',
		'summary' => 'Macht WordPress tragfähig, schnell und stabil.',
		'function'=> 'Sichert Performance, Sicherheit, Updates und technische Robustheit.',
		'impact'  => 'Reduziert Reibung für Nutzer, Editor und spätere Skalierung.',
		'outcome' => 'Eine belastbare Basis für Sichtbarkeit und Conversion.',
	],
	[
		'number'  => '03',
		'title'   => 'Messbarkeit',
		'summary' => 'Macht Wirkung und Engpässe sichtbar.',
		'function'=> 'Setzt Tracking, Consent, Events und relevante KPIs sauber auf.',
		'impact'  => 'Ersetzt Vermutungen durch belastbare Signale entlang des Anfragepfads.',
		'outcome' => 'Bessere Priorisierung statt Reporting-Rauschen.',
	],
	[
		'number'  => '04',
		'title'   => 'Sichtbarkeit',
		'summary' => 'Bringt die richtigen Angebote in die richtige Nachfrage.',
		'function'=> 'Verbindet Seitenstruktur, technische SEO und Suchintentionen.',
		'impact'  => 'Fokussiert Sichtbarkeit auf kaufnahe Themen statt breiten Traffic.',
		'outcome' => 'Mehr relevante Besuche mit strategischem Anschluss.',
	],
	[
		'number'  => '05',
		'title'   => 'Conversion',
		'summary' => 'Übersetzt Klarheit in nächste Schritte.',
		'function'=> 'Ordnet Nutzerführung, Proof, CTA-Logik und Formulare.',
		'impact'  => 'Senkt Zögern zwischen Verstehen, Vertrauen und Anfrage.',
		'outcome' => 'Höhere Anfragewahrscheinlichkeit und bessere Lead-Qualität.',
	],
	[
		'number'  => '06',
		'title'   => 'Weiterentwicklung',
		'summary' => 'Hält das System lernfähig.',
		'function'=> 'Bewertet Wirkung laufend und priorisiert nächste Hebel.',
		'impact'  => 'Verhindert Relaunch-Denken und hektische Maßnahmenwechsel.',
		'outcome' => 'Kontrolliert steigende Performance statt Neustarts.',
	],
];

$proof_metrics = [
	[
		'case'    => 'E3 New Energy',
		'value'   => '1.750+',
		'label'   => 'Leads im 5-Monats-Skalierungsfenster',
		'context' => 'nach Fundament, sauberer Landingpage-Logik und skalierter Nachfrage',
	],
	[
		'case'    => 'E3 New Energy',
		'value'   => '-83%',
		'label'   => 'Cost per Lead gegenüber Lead-Einkauf',
		'context' => 'weil Tracking, Qualifizierung und Performance nicht mehr gegeneinander gearbeitet haben',
	],
	[
		'case'    => 'DOMDAR',
		'value'   => '120 EUR',
		'label'   => 'Average Order Value nach 9 Monaten',
		'context' => 'ohne zusätzliches Ad-Budget, durch Angebotsstruktur, Recovery-Loops und weniger Reibung',
	],
];

$case_references = [
	[
		'title' => 'E3 New Energy',
		'copy'  => 'Vom Lead-Einkauf zur eigenen Pipeline: 1.750+ Leads im System, 12 % Sales-Conversion und deutlich geringere Abhängigkeit von Zukauf-Leads.',
	],
	[
		'title' => 'DOMDAR',
		'copy'  => 'Profitabilität aus bestehendem Traffic: von 46 EUR AOV und 1,5 % CR zu 120 EUR AOV und 4,6 % Conversion durch Struktur, Recovery und Operations.',
	],
	[
		'title' => 'Wiederkehrendes Muster',
		'copy'  => 'Nicht der lauteste Hebel gewinnt, sondern die bessere Reihenfolge: erst Ordnung in Technik, Daten und Angebotslogik, dann Skalierung.',
	],
];

$fit_items = [
	'eine bestehende Website und echtes Nachfragepotenzial vorhanden sind.',
	'mehrere Maßnahmen laufen, aber die Reihenfolge unklar ist.',
	'Klarheit, Ownership und saubere Priorisierung wichtiger sind als schnelle Einzeltricks.',
];

$audit_steps = [
	[
		'number' => '01',
		'title'  => 'Seite und Ziel einreichen',
		'text'   => 'Sie schicken die URL und den größten Klärungsbedarf in einem fokussierten Intake.',
	],
	[
		'number' => '02',
		'title'  => 'Prioritäten in 48 Stunden',
		'text'   => 'Sie erhalten eine persönliche Rückmeldung mit Engpässen, Reihenfolge und nächsten sinnvollen Schritten.',
	],
	[
		'number' => '03',
		'title'  => 'Nächsten Schritt wählen',
		'text'   => 'Kleine Korrektur, Folgeanalyse, Strategiecall oder Umsetzung - passend zur Lage, nicht pauschal.',
	],
];

$packages = [
	[
		'name'     => 'Fundament',
		'tagline'  => 'Grundlage, Messbarkeit und Stabilität ordnen',
		'price'    => 'ab 1.500 EUR',
		'credits'  => '30 Credits / Monat',
		'featured' => false,
		'trigger'  => 'Richtig, wenn die Website zuerst tragfähig, messbar und priorisierbar werden muss.',
		'features' => [
			'3 Monate Fokus auf Technik, Tracking und Priorisierung',
			'1 Strategietermin pro Monat',
			'Roadmap für Fundament, Messbarkeit und erste Conversion-Bremsen',
			'Monatlicher Review mit klaren Entscheidungen',
		],
	],
	[
		'name'     => 'Systemaufbau',
		'tagline'  => 'Sichtbarkeit und Conversion auf saubere Basis setzen',
		'price'    => 'ab 2.800 EUR',
		'credits'  => '60 Credits / Monat',
		'featured' => true,
		'trigger'  => 'Richtig, wenn aus einer Website ein belastbares Nachfrage-System werden soll.',
		'features' => [
			'6 Monate für Reihenfolge, Sichtbarkeit und Conversion',
			'2 Strategietermine pro Monat',
			'Ausbau von Angebotsseiten, SEO-Struktur und Nutzerführung',
			'Regelmäßige Review- und Priorisierungsschleifen',
		],
	],
	[
		'name'     => 'Weiterentwicklung',
		'tagline'  => 'System kontrolliert ausbauen und weiter nachschärfen',
		'price'    => 'ab 4.500 EUR',
		'credits'  => '100+ Credits / Monat',
		'featured' => false,
		'trigger'  => 'Richtig, wenn Fundament und Kernlogik stehen und das System weiter wachsen soll.',
		'features' => [
			'12 Monate für kontinuierliche Systempflege und Ausbau',
			'Wöchentlicher Strategie-Slot',
			'Weiterentwicklung von Reporting, Automationen und Engpass-Themen',
			'Laufende Priorisierung auf Basis echter Signale',
		],
	],
];

$credit_examples = [
	[
		'asset'   => 'CWV Optimierung',
		'focus'   => 'Technisches Fundament',
		'credits' => '15',
	],
	[
		'asset'   => 'Server-Side Tracking (sGTM & Matomo)',
		'focus'   => 'Messbarkeit',
		'credits' => '15',
	],
	[
		'asset'   => 'Technical SEO Audit',
		'focus'   => 'Sichtbarkeit',
		'credits' => '10',
	],
	[
		'asset'   => 'Pillar Page',
		'focus'   => 'Sichtbarkeit',
		'credits' => '25',
	],
	[
		'asset'   => 'Landing Page (Neu)',
		'focus'   => 'Conversion',
		'credits' => '20',
	],
];

$guarantee_points = [
	'Klare Priorisierung statt blinder Umsetzungslisten.',
	'Volle Ownership von Code, Inhalten, Tracking und Zugängen.',
	'Transparente Entscheidungen statt Black-Box-Retainer.',
];

$faq_items = [
	[
		'question' => 'Für wen ist WGOS sinnvoll?',
		'answer'   => 'Für Unternehmen mit bestehender WordPress-Website, echtem Nachfragepotenzial und dem Wunsch, SEO, Daten, Technik und Conversion nicht mehr getrennt zu behandeln.',
	],
	[
		'question' => 'Brauche ich davor einen Relaunch?',
		'answer'   => 'In vielen Fällen nein. Häufig fehlt zuerst nicht ein neuer Look, sondern eine belastbare Reihenfolge zwischen Fundament, Daten, Sichtbarkeit und Conversion.',
	],
	[
		'question' => 'Warum beginnt der Einstieg mit dem Growth Audit?',
		'answer'   => 'Weil die richtige Reihenfolge nie pauschal ist. Der Audit zeigt, wo das System trägt, wo es bricht und was zuerst sinnvoll ist.',
	],
	[
		'question' => 'Was passiert nach dem Audit?',
		'answer'   => 'Danach ist klar, ob zuerst eine kleine Korrektur, eine vertiefte Folgeanalyse, ein Strategiecall oder direkte Umsetzung sinnvoll ist. Das System startet nicht mit Vermutung, sondern mit Klarheit.',
	],
	[
		'question' => 'Bleibt das System nach der Zusammenarbeit bei uns?',
		'answer'   => 'Ja. Code, Inhalte, Setups und Zugänge bleiben bei Ihnen. WGOS ist auf Ownership gebaut, nicht auf Abhängigkeit.',
	],
];

$faq_schema = [
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'@id'        => trailingslashit( $page_url ) . '#faq',
	'url'        => $page_url,
	'inLanguage' => 'de',
	'publisher'  => [
		'@id' => home_url( '/#organization' ),
	],
	'mainEntity' => [],
];

foreach ( $faq_items as $faq_item ) {
	$faq_schema['mainEntity'][] = [
		'@type'          => 'Question',
		'name'           => $faq_item['question'],
		'acceptedAnswer' => [
			'@type' => 'Answer',
			'text'  => $faq_item['answer'],
		],
	];
}
?>

<main id="main" class="site-main">
	<div class="wgos-wrapper">

		<nav class="wgos-smart-nav" id="wgos-nav" aria-label="WGOS Seitennavigation">
			<ul>
				<?php foreach ( $nav_items as $nav_item ) : ?>
					<li>
						<a href="#<?php echo esc_attr( $nav_item['id'] ); ?>">
							<span class="wgos-nav-dot"></span>
							<span class="wgos-nav-text"><?php echo esc_html( $nav_item['label'] ); ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

			<section class="wgos-hero">
				<div class="wgos-container">
					<div class="wgos-hero-grid">
						<div class="wgos-hero-copy">
							<span class="wgos-kicker">WordPress Growth Operating System</span>
							<h1 class="wgos-hero__title">WordPress Growth Operating System für planbare Nachfrage.</h1>
							<p class="wgos-hero__subtitle">WGOS ordnet Strategie, Technik, Daten, Sichtbarkeit und Conversion in ein Operating Model, damit Wachstum steuerbar wird statt von Einzelmaßnahmen abzuhängen.</p>

							<ul class="wgos-hero__bullets">
								<li>Struktur statt Taktik-Sammlung</li>
								<li>Klare Prioritäten statt Aktionismus</li>
								<li>Ownership statt Black Box</li>
							</ul>

							<div class="wgos-trust-strip wgos-trust-strip--hero" aria-label="Ausgewählte Ergebnisbelege">
								<?php foreach ( $hero_proof as $hero_proof_item ) : ?>
									<div class="wgos-trust-item">
										<span class="wgos-trust-context"><?php echo esc_html( $hero_proof_item['context'] ); ?></span>
										<span class="wgos-trust-value"><?php echo esc_html( $hero_proof_item['value'] ); ?></span>
										<span class="wgos-trust-label"><?php echo esc_html( $hero_proof_item['label'] ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>

								<div class="wgos-hero__actions">
									<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit_hero">Growth Audit starten (0€)</a>
									<a href="#system" class="wgos-btn wgos-btn--ghost" data-track="cta_click_system">WGOS in 60 Sekunden verstehen</a>
								</div>
								<p class="nx-cta-microcopy">0 € · Rückmeldung in 48h · kein Pflicht‑Call</p>

							<p class="wgos-hero__microcopy">Der Growth Audit ist der nächste Schritt, wenn die Systemlogik fachlich passt.</p>
						</div>

						<aside class="wgos-hero-card" aria-label="WGOS System-Snapshot">
							<span class="wgos-principle-kicker">System-Snapshot</span>
							<div class="wgos-phase-list">
									<?php foreach ( $hero_snapshot as $snapshot_item ) : ?>
										<article class="wgos-phase-list__item">
											<span class="wgos-phase-list__label"><?php echo esc_html( $snapshot_item['phase'] ); ?></span>
											<h3><?php echo esc_html( $snapshot_item['title'] ); ?></h3>
											<p><?php echo esc_html( $snapshot_item['text'] ); ?></p>
										</article>
									<?php endforeach; ?>
							</div>
							<p class="wgos-hero-card__note">Sechs Module. Drei Phasen. Eine Reihenfolge, die Nachfrage steuerbar macht.</p>
						</aside>
					</div>
				</div>
			</section>

			<section id="problem" class="wgos-section wgos-section--white nx-reveal">
				<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Problem</span>
						<h2 class="wgos-h2">Wachstum scheitert heute selten am Willen. Meist scheitert es an fehlender Systemlogik.</h2>
					</div>

					<div class="wgos-problem-grid">
						<div class="wgos-prose">
							<p>Viele Unternehmen machen nicht zu wenig. Sie machen zu vieles parallel: Relaunch, SEO, Tracking, Ads, Content, CRO. Genau dadurch wirkt die Website beschäftigt, aber nicht strategisch geführt.</p>
							<p class="wgos-bold-statement">Der Engpass ist selten Aktivität. Der Engpass ist fehlende Reihenfolge.</p>
						</div>

						<div class="wgos-issue-list" aria-label="Typische Probleme">
							<?php foreach ( $problem_points as $problem_point ) : ?>
							<article class="wgos-issue-card">
								<p><?php echo esc_html( $problem_point ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
				</div>
			</section>

			<section id="failure" class="wgos-section wgos-section--gray nx-reveal">
				<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Warum Taktiken kippen</span>
						<h2 class="wgos-h2">Isolierte Maßnahmen sehen nach Fortschritt aus. Strategisch erzeugen sie oft nur neues Rauschen.</h2>
						<p class="wgos-section-intro">WGOS beginnt nicht mit dem beliebtesten Hebel, sondern mit der Reihenfolge, in der Hebel überhaupt wirksam werden.</p>
					</div>

					<div class="wgos-failure-grid">
						<?php foreach ( $failure_cards as $failure_card ) : ?>
							<article class="wgos-failure-card">
								<span class="wgos-failure-card__eyebrow">Typischer Startfehler</span>
								<h3><?php echo esc_html( $failure_card['title'] ); ?></h3>
								<p class="wgos-failure-card__surface"><?php echo esc_html( $failure_card['surface'] ); ?></p>
								<p class="wgos-failure-card__result"><strong>Folge:</strong> <?php echo esc_html( $failure_card['result'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>

			<section id="system" class="wgos-section wgos-section--white nx-reveal">
				<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Systemübersicht</span>
						<h2 class="wgos-h2">WGOS ordnet Wachstum in ein belastbares Operating Model.</h2>
						<p class="wgos-section-intro">Kein Leistungsbaukasten, kein Kanalmix ohne Zusammenhang, kein hübscher Relaunch ohne System. Sondern ein Modell, das Nachfrage strukturiert.</p>
					</div>

					<div class="wgos-overview-grid">
						<div class="wgos-principle-shell">
							<p class="wgos-definition__statement">Erst Ordnung in Strategie, Fundament und Daten. Dann wird Sichtbarkeit wertvoll. Danach skaliert Conversion.</p>
							<ul class="wgos-checklist">
								<?php foreach ( $system_principles as $system_principle ) : ?>
									<li><?php echo esc_html( $system_principle ); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>

						<div class="wgos-phase-grid" aria-label="WGOS Phasen">
							<?php foreach ( $system_phases as $system_phase ) : ?>
								<article class="wgos-phase-card">
									<div class="wgos-phase-card__top">
										<span class="wgos-phase-card__step"><?php echo esc_html( $system_phase['step'] ); ?></span>
										<div>
											<span class="wgos-phase-card__eyebrow"><?php echo esc_html( $system_phase['label'] ); ?></span>
											<h3><?php echo esc_html( $system_phase['title'] ); ?></h3>
										</div>
									</div>
									<p><?php echo esc_html( $system_phase['copy'] ); ?></p>
									<div class="wgos-phase-card__meta">
										<span>Ergebnis</span>
										<p><?php echo esc_html( $system_phase['outcome'] ); ?></p>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

			<section id="module" class="wgos-section wgos-section--gray nx-reveal">
				<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Modulare Bausteine</span>
						<h2 class="wgos-h2">Sechs Module. Klare Funktion. Sauberer systemischer Effekt.</h2>
						<p class="wgos-section-intro">Jeder Baustein hat eine Aufgabe im System. Entscheidend ist nicht maximale Menge, sondern die richtige Tiefe zur richtigen Zeit.</p>
					</div>

					<div class="wgos-component-grid">
						<?php foreach ( $core_areas as $core_area ) : ?>
							<details class="wgos-component-card nx-reveal">
								<summary class="wgos-component-card__top">
									<span class="wgos-core-card__number"><?php echo esc_html( $core_area['number'] ); ?></span>
									<div>
										<h3><?php echo esc_html( $core_area['title'] ); ?></h3>
										<p class="wgos-component-card__summary"><?php echo esc_html( $core_area['summary'] ); ?></p>
									</div>
								</summary>
								<dl class="wgos-component-card__details">
									<div>
										<dt>Funktion</dt>
										<dd><?php echo esc_html( $core_area['function'] ); ?></dd>
									</div>
									<div>
										<dt>Wirkung</dt>
										<dd><?php echo esc_html( $core_area['impact'] ); ?></dd>
									</div>
									<div>
										<dt>Erwartbares Ergebnis</dt>
										<dd><?php echo esc_html( $core_area['outcome'] ); ?></dd>
									</div>
								</dl>
							</details>
						<?php endforeach; ?>
					</div>

					<div class="wgos-asset-hub-bridge">
						<div class="wgos-note-card">
							<h3>Alle Bausteine tiefer sehen?</h3>
							<p>Die WGOS-Systemlandkarte zeigt die zugehörigen Assets strukturiert, gruppiert und direkt verlinkt.</p>
							<a href="<?php echo esc_url( $asset_hub_url ); ?>" class="wgos-link--arrow">Zur WGOS Asset-Landkarte</a>
						</div>
					</div>
				</div>
			</section>

			<section id="proof" class="wgos-section wgos-section--white nx-reveal">
				<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Proof / Wirkung</span>
						<h2 class="wgos-h2">Ruhige Belege statt großer Behauptungen.</h2>
						<p class="wgos-section-intro">WGOS verkauft kein Heilsversprechen. Die Glaubwürdigkeit entsteht dort, wo Reihenfolge, Ausgangslage und Ergebnis zusammenpassen.</p>
					</div>

					<div class="wgos-proof-layout">
						<div class="wgos-proof-grid">
							<?php foreach ( $proof_metrics as $proof_metric ) : ?>
								<article class="wgos-proof-card">
									<span class="wgos-proof-card__case"><?php echo esc_html( $proof_metric['case'] ); ?></span>
									<strong class="wgos-proof-card__value"><?php echo esc_html( $proof_metric['value'] ); ?></strong>
									<p class="wgos-proof-card__label"><?php echo esc_html( $proof_metric['label'] ); ?></p>
									<p class="wgos-proof-card__context"><?php echo esc_html( $proof_metric['context'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>

						<div class="wgos-proof-reference-card">
							<h3>Was diese Zahlen wirklich belegen</h3>
							<div class="wgos-proof-reference-list">
								<?php foreach ( $case_references as $case_reference ) : ?>
									<article class="wgos-proof-reference-item">
										<h4><?php echo esc_html( $case_reference['title'] ); ?></h4>
										<p><?php echo esc_html( $case_reference['copy'] ); ?></p>
									</article>
								<?php endforeach; ?>
							</div>
							<a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Alle Case Studies ansehen</a>
						</div>
					</div>
				</div>
			</section>

			<section id="audit" class="wgos-section wgos-section--gray nx-reveal">
				<div class="wgos-container">
					<div class="wgos-audit-shell">
						<div class="wgos-audit-copy">
							<span class="wgos-principle-kicker">Audit-Einstieg</span>
							<h2 class="wgos-h2">Wenn die Logik passt, beginnt der nächste Schritt mit Diagnose.</h2>
							<div class="wgos-prose">
								<p>Der Growth Audit ist der operative Einstieg ins System: fokussierter Intake, persönliche Rückmeldung innerhalb von 48 Stunden und klare Prioritäten statt Sofort-Pitch.</p>
							</div>

							<div class="wgos-hero__actions">
								<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Growth Audit starten</a>
							</div>

							<p class="wgos-hero__microcopy">Lieber erst sprechen? <a href="<?php echo esc_url( $calendar_url ); ?>" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespräch vereinbaren</a>.</p>
						</div>

						<div class="wgos-audit-aside">
							<div class="wgos-audit-results">
								<h3>So läuft der Einstieg</h3>
								<ol class="wgos-audit-steps" aria-label="Growth Audit Ablauf">
									<?php foreach ( $audit_steps as $audit_step ) : ?>
										<li class="wgos-audit-step">
											<span class="wgos-audit-step__number"><?php echo esc_html( $audit_step['number'] ); ?></span>
											<div>
												<h4><?php echo esc_html( $audit_step['title'] ); ?></h4>
												<p><?php echo esc_html( $audit_step['text'] ); ?></p>
											</div>
										</li>
									<?php endforeach; ?>
								</ol>
							</div>

							<div class="wgos-audit-results wgos-audit-results--fit">
								<h3>Sinnvoll, wenn ...</h3>
								<ul class="wgos-checklist wgos-checklist--compact">
									<?php foreach ( $fit_items as $fit_item ) : ?>
										<li><?php echo esc_html( $fit_item ); ?></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>

		<section id="pakete" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
					<div class="wgos-section-head">
						<span class="wgos-principle-kicker">Zusammenarbeitsmodell</span>
						<h2 class="wgos-h2">Wenn die Diagnose steht, folgt die passende Systemtiefe.</h2>
						<p class="wgos-section-intro">Die Pakete verkaufen nicht das System. Sie geben dem System nach dem Audit den passenden Umfang.</p>
					</div>

					<div class="wgos-pricing-grid">
						<?php foreach ( $packages as $package ) : ?>
							<article class="wgos-pricing-card<?php echo $package['featured'] ? ' wgos-pricing-card--featured' : ''; ?> nx-reveal">
								<?php if ( $package['featured'] ) : ?>
									<span class="wgos-pricing-badge">Häufigster Start</span>
								<?php endif; ?>

							<div class="wgos-pricing-card__head">
								<h3><?php echo esc_html( $package['name'] ); ?></h3>
								<p class="wgos-pricing-card__tagline"><?php echo esc_html( $package['tagline'] ); ?></p>
							</div>

							<div class="wgos-pricing-card__price"><?php echo esc_html( $package['price'] ); ?><small>/Monat</small></div>
							<div class="wgos-pricing-card__credits"><?php echo esc_html( $package['credits'] ); ?></div>

								<ul class="wgos-pricing-card__features">
									<?php foreach ( $package['features'] as $feature ) : ?>
										<li><?php echo esc_html( $feature ); ?></li>
									<?php endforeach; ?>
								</ul>

								<p class="wgos-pricing-card__ideal"><?php echo esc_html( $package['trigger'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>

				<div id="credits" class="wgos-credit-summary nx-reveal">
					<div class="wgos-credit-summary__copy">
						<h3>Credits ordnen den Umfang, nicht die Strategie.</h3>
						<p>Credits schaffen Planbarkeit: Ein Asset hat einen festen Wert, unabhängig vom realen Zeitaufwand. So sprechen wir über Priorität und Wirkung, nicht über Minuten.</p>
					</div>

					<div class="wgos-table-wrap">
						<table class="wgos-credits-table wgos-credits-table--compact">
							<thead>
								<tr>
									<th>Beispiel-Asset</th>
									<th>Fokus</th>
									<th>Credits</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $credit_examples as $credit_example ) : ?>
									<tr>
										<td><?php echo nexus_render_wgos_asset_label( $credit_example['asset'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
										<td><?php echo esc_html( $credit_example['focus'] ); ?></td>
										<td><?php echo esc_html( $credit_example['credits'] ); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>

						<p class="wgos-credit-summary__note">Die genaue Priorisierung entsteht im Audit und in der laufenden Systemarbeit, nicht über starre Tabellen.</p>
					</div>

					<p class="wgos-section-note">Die Paketwahl entsteht erst nach Diagnose. Vorher wäre sie reine Spekulation.</p>
				</div>
			</section>

			<section class="wgos-section wgos-section--gray nx-reveal">
				<div class="wgos-container">
					<div class="wgos-principle-shell wgos-guarantee-shell">
						<span class="wgos-principle-kicker">Zusagen</span>
						<h2 class="wgos-h2">Was ich zusage</h2>
						<ul class="wgos-checklist wgos-checklist--guarantee">
							<?php foreach ( $guarantee_points as $guarantee_point ) : ?>
								<li><?php echo esc_html( $guarantee_point ); ?></li>
							<?php endforeach; ?>
						</ul>
						<p class="wgos-expectation">Keine Garantie auf fixe Lead-Zahlen. Die Zusage ist eine andere: saubere Diagnose, klare Reihenfolge, nachvollziehbare Umsetzung und ein System, das Ihnen gehört.</p>
					</div>
				</div>
			</section>

		<section id="faq" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">FAQ</span>
					<h2 class="wgos-h2">Die wichtigsten Fragen, kurz und klar.</h2>
				</div>

				<div class="wgos-faq">
					<?php foreach ( $faq_items as $faq_item ) : ?>
						<details class="nx-faq__item">
							<summary><?php echo esc_html( $faq_item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $faq_item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

			<section class="wgos-section wgos-section--gray wgos-final-cta nx-reveal">
				<div class="wgos-container">
					<div class="wgos-final-cta__inner">
						<span class="wgos-principle-kicker">Nächster Schritt</span>
						<h2 class="wgos-h2">Erst Klarheit. Dann die richtige Reihenfolge.</h2>
						<p class="wgos-prose">Wenn aus Ihrer WordPress-Website kein Sammelbecken einzelner Maßnahmen mehr werden soll, sondern ein strukturiertes Nachfrage-System, dann beginnt der sinnvolle nächste Schritt mit einem klaren Audit.</p>

						<div class="wgos-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Growth Audit starten</a>
						</div>

						<p class="wgos-hero__microcopy">Persönliche Rückmeldung in 48 Stunden. Kein Pitch, wenn kein fachlicher Fit da ist. <a href="<?php echo esc_url( $calendar_url ); ?>" data-track="cta_click_calendar" target="_blank" rel="noopener noreferrer">Strategiegespräch vereinbaren</a>.</p>
					</div>
				</div>
			</section>

	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ); ?></script>

<?php get_footer(); ?>
