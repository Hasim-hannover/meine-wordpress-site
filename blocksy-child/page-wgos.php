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

$audit_url                    = nexus_get_audit_url();
$calendar_url                 = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' );
$cases_url                    = nexus_get_results_url();
$asset_hub_url                = function_exists( 'nexus_get_wgos_asset_hub_url' ) ? nexus_get_wgos_asset_hub_url() : home_url( '/wgos-systemlandkarte/' );
$page_url                     = get_permalink( get_queried_object_id() );
$public_proof                 = function_exists( 'nexus_get_public_proof_data' ) ? nexus_get_public_proof_data() : [];
$canonical_ownership_sentence = function_exists( 'nexus_get_public_ownership_sentence' ) ? nexus_get_public_ownership_sentence() : 'Code, Inhalte, Zugänge und Setups bleiben bei Ihnen. Laufende Zusammenarbeit bedeutet Weiterentwicklung, nicht Abhängigkeit.';
$framework_label              = function_exists( 'nexus_get_public_framework_label' ) ? nexus_get_public_framework_label() : 'WGOS = WordPress Growth Operating System';
$audit_cta_label              = function_exists( 'nexus_get_audit_cta_label' ) ? nexus_get_audit_cta_label() : 'Growth Audit starten';
$audit_compact_microcopy      = function_exists( 'nexus_get_audit_compact_microcopy' ) ? nexus_get_audit_compact_microcopy() : '0 € · Rückmeldung in 48h · kein Pflicht-Call';
$diagram_svg_markup           = '';
$diagram_svg_path             = get_stylesheet_directory() . '/assets/brand/wgos-system-diagram.svg';

if ( ! $page_url ) {
	$page_url = nexus_get_primary_public_url( 'wgos', home_url( '/wordpress-growth-operating-system/' ) );
}

if ( file_exists( $diagram_svg_path ) ) {
	$diagram_svg_markup = (string) file_get_contents( $diagram_svg_path );
}

$nav_items = [
	[
		'id'    => 'system',
		'label' => 'System',
	],
	[
		'id'    => 'module',
		'label' => 'Kernbereiche',
	],
	[
		'id'    => 'pakete',
		'label' => 'Pakete',
	],
	[
		'id'    => 'proof',
		'label' => 'Wirkung',
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

$hero_badges = [
	'Klare Reihenfolge',
	'Messbare Entwicklung',
	'Volle Ownership',
];

$hero_proof = [
	[
		'context' => 'E3 New Energy',
		'value'   => $public_proof['metrics']['lead_count']['value'] ?? '1.750+',
		'label'   => 'qualifizierte Leads',
	],
	[
		'context' => 'E3 New Energy',
		'value'   => $public_proof['metrics']['sales_conversion']['value'] ?? '12 %',
		'label'   => 'Sales-Conversion',
	],
	[
		'context' => 'E3 New Energy',
		'value'   => $public_proof['metrics']['cpl_reduction']['value'] ?? '-83 %',
		'label'   => 'CPL gegenüber Lead-Einkauf',
	],
];

$shortform_items = [
	[
		'label' => 'Was',
		'text'  => 'Ein System, das Strategie, Technik, Daten, Sichtbarkeit und Conversion in eine belastbare Reihenfolge bringt.',
	],
	[
		'label' => 'Für wen',
		'text'  => 'Für Unternehmen mit bestehender WordPress-Website, Nachfragepotenzial und dem Bedarf an klarer Priorisierung.',
	],
	[
		'label' => 'Welches Problem',
		'text'  => 'Viele Websites sammeln Maßnahmen, aber führen keine planbare Nachfrage über einen klaren Anfragepfad.',
	],
	[
		'label' => 'Was ist anders',
		'text'  => 'Ein zusammenhängendes Nachfrage-System mit klarer Reihenfolge.',
	],
];

$core_areas = [
	[
		'number' => '01',
		'title'  => 'Strategie',
		'intro'  => 'Schärft Positionierung und Prioritäten.',
		'points' => [
			'Angebotslogik und Seitenrollen sauber ausrichten',
			'Klare Roadmap für die nächsten 90 Tage',
			'Prioritäten für Inhalte, Technik und Conversion synchronisieren',
		],
	],
	[
		'number' => '02',
		'title'  => 'Technisches Fundament',
		'intro'  => 'Macht WordPress schnell, stabil und wartbar.',
		'points' => [
			'Performance und Core Web Vitals stabilisieren',
			'Sicherheit, Updates und Betriebsroutinen absichern',
			'Eine robuste Basis für spätere Sichtbarkeit und Conversion schaffen',
		],
	],
	[
		'number' => '03',
		'title'  => 'Messbarkeit',
		'intro'  => 'Macht Wirkung entlang des Anfragepfads sichtbar.',
		'points' => [
			'Tracking, Consent und Events sauber aufsetzen',
			'Relevante KPIs entlang des Anfragepfads',
			'Datenqualität für Priorisierung und Reviews verbessern',
		],
	],
	[
		'number' => '04',
		'title'  => 'Sichtbarkeit',
		'intro'  => 'Baut kaufnahe Nachfrage systematisch auf.',
		'points' => [
			'Seitenstruktur an Suchintentionen ausrichten',
			'Technisches SEO und Content-Hubs verbinden',
			'Kaufnahe Themen priorisieren statt breiten Traffic sammeln',
			'Relevante Besuche mit strategischem Anschluss aufbauen',
		],
	],
	[
		'number' => '05',
		'title'  => 'Conversion',
		'intro'  => 'Führt Besucher klar zur Anfrage.',
		'points' => [
			'Nutzerführung, Proof und CTA-Logik verzahnen',
			'Formulare und Angebotsseiten auf Klarheit ausrichten',
			'Anfragewahrscheinlichkeit und Lead-Qualität erhöhen',
		],
	],
	[
		'number' => '06',
		'title'  => 'Weiterentwicklung',
		'intro'  => 'Hält das System lernfähig und steuerbar.',
		'points' => [
			'Wirkung laufend auswerten und priorisieren',
			'KI, Automatisierung und neue Hebel kontrolliert einführen',
			'Performance kontrolliert weiterentwickeln statt neu starten',
		],
	],
];

$packages = [
	[
		'name'     => 'Fundament',
		'tagline'  => 'Fokussierte Optimierungen und priorisierte Maßnahmen',
		'price'    => '2.250 €',
		'credits'  => '30 Credits',
		'featured' => false,
		'trigger'  => 'Für klar umrissene Ausbaustufen, gezielte Engpass-Beseitigung und technische Grundlagenarbeit.',
		'features' => [
			'Priorisierte Maßnahmen mit definiertem Scope',
			'Strategietermin zur Ausrichtung',
			'Roadmap für Fundament, Messbarkeit und erste Hebel',
			'Review mit klaren Entscheidungsgrundlagen',
		],
	],
	[
		'name'     => 'Systemaufbau',
		'tagline'  => 'Mehrere Module sauber aufbauen und strategisch verzahnen',
		'price'    => '4.200 €',
		'credits'  => '60 Credits',
		'featured' => true,
		'trigger'  => 'Für Unternehmen, die Sichtbarkeit, Conversion und Datenqualität gleichzeitig auf ein belastbares Niveau bringen wollen.',
		'features' => [
			'Strukturierter Ausbau über mehrere WGOS-Module',
			'Regelmäßige Strategietermine',
			'Verzahnung von Angebotsseiten, SEO-Struktur und Nutzerführung',
			'Laufende Priorisierung auf Basis echter Signale',
		],
	],
	[
		'name'     => 'Weiterentwicklung',
		'tagline'  => 'Langfristige Systemtiefe und operative Schlagkraft',
		'price'    => '6.900 €',
		'credits'  => '100 Credits',
		'featured' => false,
		'trigger'  => 'Für tiefere Eingriffe, langfristige Weiterentwicklung und spürbar mehr operative Kapazität im System.',
		'features' => [
			'Kontinuierlicher Systemausbau mit maximaler Tiefe',
			'Wöchentlicher Strategie-Slot',
			'Weiterentwicklung von Reporting, Automationen und Engpass-Themen',
			'Höchste Planbarkeit durch effizienten Ressourceneinsatz',
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

$proof_metrics = [
	[
		'case'  => 'E3 New Energy',
		'value' => $public_proof['metrics']['lead_count']['value'] ?? '1.750+',
		'label' => 'qualifizierte Leads',
	],
	[
		'case'  => 'E3 New Energy',
		'value' => $public_proof['metrics']['cpl_reduction']['value'] ?? '-83 %',
		'label' => 'Kosten pro Lead',
	],
	[
		'case'  => 'Kernseiten',
		'value' => '98/100',
		'label' => 'Mobile Performance',
	],
];

$faq_items = [
	[
		'question' => 'Für wen ist das WGOS gebaut?',
		'answer'   => 'Für Unternehmen mit bestehender WordPress-Website, echtem Nachfragepotenzial und dem Wunsch, SEO, Daten, Technik und Conversion nicht mehr getrennt zu behandeln.',
	],
	[
		'question' => 'Brauche ich davor einen Relaunch?',
		'answer'   => 'In vielen Fällen nein. Häufig fehlt zuerst nicht ein neuer Look, sondern eine belastbare Reihenfolge zwischen Fundament, Daten, Sichtbarkeit und Conversion.',
	],
	[
		'question' => 'Warum Credits statt Stunden?',
		'answer'   => 'Weil Credits Strategie, Umsetzung und Optimierung in derselben Logik halten. Sie sehen priorisierte Arbeitspakete statt verstreuter Zeitbuchungen und können Tiefe sauber planen.',
	],
	[
		'question' => 'Bleibt das System nach der Zusammenarbeit bei uns?',
		'answer'   => $canonical_ownership_sentence,
	],
	[
		'question' => 'Was kostet die Zusammenarbeit?',
		'answer'   => 'Der Einstieg beginnt ab 1.500 €/Monat. Die passende Tiefe ergibt sich aus dem Growth Audit. Details stehen in der Paket-Übersicht oben.',
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
						<span class="wgos-kicker"><?php echo esc_html( $framework_label ); ?></span>
						<h1 class="wgos-hero__title"><?php echo esc_html( $framework_label ); ?> für planbare Nachfrage.</h1>
						<p class="wgos-hero__subtitle">WGOS beschreibt die Reihenfolge hinter planbarer Nachfrage: Strategie und Fundament zuerst, dann Messbarkeit und Sichtbarkeit, danach Conversion und Weiterentwicklung.</p>

						<ul class="wgos-hero__bullets">
							<?php foreach ( $hero_badges as $hero_badge ) : ?>
								<li><?php echo esc_html( $hero_badge ); ?></li>
							<?php endforeach; ?>
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
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit" data-track-action="cta_click_audit" data-track-category="lead_gen" data-track-section="hero"><?php echo esc_html( $audit_cta_label ); ?></a>
							<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" data-track-action="cta_click_calendar" data-track-category="lead_gen" data-track-section="hero">Strategiegespräch vereinbaren</a>
						</div>
						<p class="nx-cta-microcopy"><?php echo esc_html( $audit_compact_microcopy ); ?></p>
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
						<p class="wgos-hero-card__note">Sechs Bereiche. Drei Phasen. Eine Reihenfolge, die Nachfrage steuerbar macht.</p>
					</aside>
				</div>
			</div>
		</section>

		<section id="problem" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">WGOS-Kurzform</span>
					<h2 class="wgos-h2">Die Kurzform für schnelle Einordnung.</h2>
				</div>

				<dl class="wgos-shortform-grid">
					<?php foreach ( $shortform_items as $shortform_item ) : ?>
						<div class="wgos-shortform-card">
							<dt><?php echo esc_html( $shortform_item['label'] ); ?></dt>
							<dd><?php echo esc_html( $shortform_item['text'] ); ?></dd>
						</div>
					<?php endforeach; ?>
				</dl>
			</div>
		</section>

		<section id="system" class="wgos-section wgos-section--gray nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Systemdiagramm</span>
					<h2 class="wgos-h2">Das System auf einen Blick.</h2>
				</div>

				<div class="wgos-diagram-card">
					<div class="wgos-diagram-frame" aria-label="WGOS Systemdiagramm">
						<?php if ( '' !== $diagram_svg_markup ) : ?>
							<?php echo $diagram_svg_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php endif; ?>
					</div>
					<p class="wgos-diagram-caption">Sechs Bereiche. Eine Reihenfolge. Jeder Schritt baut auf dem vorherigen auf.</p>
				</div>
			</div>
		</section>

		<section id="module" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Kernbereiche</span>
					<h2 class="wgos-h2">Die sechs Bereiche im Detail.</h2>
					<p class="wgos-section-intro">Hier liegt die Tiefe: jeder Bereich hat eine klare Aufgabe im System und stärkt den nächsten Schritt.</p>
				</div>

				<div class="wgos-component-grid">
					<?php foreach ( $core_areas as $core_area ) : ?>
						<article class="wgos-core-area-card nx-reveal">
							<div class="wgos-core-area-card__top">
								<span class="wgos-core-card__number"><?php echo esc_html( $core_area['number'] ); ?></span>
								<div>
									<h3><?php echo esc_html( $core_area['title'] ); ?></h3>
									<?php if ( '' !== $core_area['intro'] ) : ?>
										<p class="wgos-core-area-card__intro"><?php echo esc_html( $core_area['intro'] ); ?></p>
									<?php endif; ?>
								</div>
							</div>
							<ul class="wgos-core-area-list">
								<?php foreach ( $core_area['points'] as $core_point ) : ?>
									<li><?php echo esc_html( $core_point ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="wgos-asset-hub-bridge">
					<div class="wgos-note-card">
						<h3>Alle Bausteine tiefer sehen?</h3>
						<p>Die WGOS-Systemlandkarte zeigt die zugehörigen Assets strukturiert, gruppiert und direkt verlinkt.</p>
						<a href="<?php echo esc_url( $asset_hub_url ); ?>" class="wgos-link--arrow" data-track="cta_click_explorer" data-track-action="cta_click_explorer" data-track-category="navigation" data-track-section="core_areas">Zur WGOS Asset-Landkarte</a>
					</div>
				</div>
			</div>
		</section>

		<section id="pakete" class="wgos-section wgos-section--packages nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Pakete + Credits</span>
					<h2 class="wgos-h2">Nach dem Audit folgt die passende Tiefe.</h2>
					<p class="wgos-section-intro">Die Paketwahl ordnet Kapazität und Systemtiefe. Die Credits-Tabelle macht sichtbar, wie die Arbeit konkret strukturiert wird.</p>
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

							<div class="wgos-pricing-card__price"><?php echo esc_html( $package['price'] ); ?></div>
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
						<h3>Credits sind die operative Einheit im WGOS.</h3>
						<p>Jedes Asset und Arbeitspaket hat einen definierten Credit-Wert. So lassen sich Maßnahmen, Prioritäten und Weiterentwicklung klar planen - unabhängig davon, ob es um Tracking, SEO, CRO oder technische Optimierung geht.</p>
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

					<p class="wgos-credit-summary__note">Priorisierung entsteht im Audit, nicht vorab.</p>
				</div>
			</div>
		</section>

		<section id="proof" class="wgos-section wgos-section--white nx-reveal">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Ergebnisse</span>
					<h2 class="wgos-h2">Ergebnisse.</h2>
				</div>

				<div class="wgos-proof-band">
					<div class="wgos-proof-grid wgos-proof-grid--compact">
						<?php foreach ( $proof_metrics as $proof_metric ) : ?>
							<article class="wgos-proof-card">
								<strong class="wgos-proof-card__value"><?php echo esc_html( $proof_metric['value'] ); ?></strong>
								<p class="wgos-proof-card__label"><?php echo esc_html( $proof_metric['label'] ); ?></p>
								<span class="wgos-proof-card__case"><?php echo esc_html( $proof_metric['case'] ); ?></span>
							</article>
						<?php endforeach; ?>
					</div>

					<div class="wgos-proof-link-row">
						<a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow" data-track="cta_click_results" data-track-action="cta_click_results" data-track-category="trust" data-track-section="proof">Ergebnisse ansehen</a>
					</div>
				</div>
			</div>
		</section>

		<section id="faq" class="wgos-section wgos-section--gray nx-reveal">
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

		<section id="audit" class="wgos-section wgos-section--white wgos-final-cta nx-reveal">
			<div class="wgos-container">
				<div class="wgos-final-cta__inner">
					<span class="wgos-principle-kicker">Nächster Schritt</span>
					<h2 class="wgos-h2">Der nächste Schritt.</h2>
					<p class="wgos-prose">Eine Einordnung reicht, um die richtige Reihenfolge zu finden.</p>

					<div class="wgos-hero__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit" data-track-action="cta_click_audit" data-track-category="lead_gen" data-track-section="final_cta"><?php echo esc_html( $audit_cta_label ); ?></a>
						<a href="<?php echo esc_url( $calendar_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_calendar" data-track-action="cta_click_calendar" data-track-category="lead_gen" data-track-section="final_cta">Strategiegespräch vereinbaren</a>
					</div>
				</div>
			</div>
		</section>

	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ); ?></script>

<?php get_footer(); ?>
