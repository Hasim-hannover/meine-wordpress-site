<?php
/**
 * Native page template for the canonical slug:
 * /solar-waermepumpen-leadgenerierung/
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$request_url = function_exists( 'nexus_get_primary_request_url' ) ? nexus_get_primary_request_url() : home_url( '/anfrage/#energie-anfrage' );
$request_cta = function_exists( 'nexus_get_primary_request_cta_label' ) ? nexus_get_primary_request_cta_label() : 'Anfrage stellen';
$page_url    = function_exists( 'nexus_get_energy_systems_url' ) ? nexus_get_energy_systems_url() : home_url( '/solar-waermepumpen-leadgenerierung/' );

$pain_cards = [
	[
		'title' => '80 € pro Lead — und die Hälfte geht nicht ans Telefon.',
		'text'  => 'Sie kaufen Anfragen bei Aroundhome, Check24 oder DAA. Aber die Hälfte sind Mieter ohne Dach, Preisvergleicher ohne Budget oder Kontakte, die schon bei drei anderen Anbietern angefragt haben. Ihr Vertrieb verliert Stunden mit Leuten, die nie kaufen werden.',
	],
	[
		'title' => 'Kein Überblick, welcher Kanal sich wirklich lohnt.',
		'text'  => 'Google Ads, Portal-Leads, Empfehlungen — aber niemand kann sauber sagen, wo die guten Abschlüsse herkommen. Ohne diese Klarheit investieren Sie blind.',
	],
	[
		'title' => 'Seit 2024 kommen die Anfragen nicht mehr von allein.',
		'text'  => 'Der PV-Boom ist vorbei. Der Markt normalisiert sich. Wer jetzt keine eigene Anfrage-Infrastruktur hat, ist abhängig von Portalen — und deren Preisen.',
	],
];


$journey_cards = [
	[
		'label' => 'Phase 1',
		'title' => '„Lohnt sich das überhaupt?"',
		'text'  => 'Googelt Kosten, liest Vergleiche, ist skeptisch. Hier entscheidet sich in 8 Sekunden, ob Ihre Seite relevant wirkt.',
	],
	[
		'label' => 'Phase 2',
		'title' => '„Wer macht das bei uns in der Region?"',
		'text'  => 'Sucht lokale Anbieter, vergleicht Bewertungen, will Referenzen sehen. Wenn Ihre Seite hier keinen Proof liefert, geht er zum Nächsten.',
	],
	[
		'label' => 'Phase 3',
		'title' => '„Ich will ein Angebot — aber einfach."',
		'text'  => 'Will nicht 20 Felder ausfüllen. Will nicht 3 Tage auf einen Rückruf warten. Hier verlieren Sie die meisten Anfragen.',
	],
];

$proof_kpis = [
	[
		'value' => '1.750+',
		'label' => 'qualifizierte Anfragen',
	],
	[
		'value' => '–83 %',
		'label' => 'Kosten pro Anfrage',
	],
	[
		'value' => '12 %',
		'label' => 'Abschlussquote',
	],
];

$faq_items = [
	[
		'question' => 'Was kostet das?',
		'answer'   => 'Das hängt vom Umfang ab. Typische Retainer starten bei 2.500–4.000 €/Monat. Bei einem CPL von 80 € und 50 Anfragen/Monat investieren Sie aktuell 4.000 € in Portal-Leads mit 10 % Abschlussquote. Mein System zielt darauf, diese Kosten um 50–80 % zu senken — der Retainer refinanziert sich in den meisten Fällen innerhalb von 8–12 Wochen.',
	],
	[
		'question' => 'Funktioniert das auch für kleinere Betriebe mit 5–10 Mitarbeitern?',
		'answer'   => 'Ja, wenn Sie aktuell mindestens 20 Anfragen pro Monat verarbeiten und Kosten pro Anfrage spürbar sind. Unter dieser Schwelle ist oft ein schlankerer Ansatz sinnvoller — das klären wir im Erstgespräch.',
	],
	[
		'question' => 'Warum nicht einfach mehr Google Ads schalten?',
		'answer'   => 'Mehr Budget auf schlechte Seiten heißt mehr Geld für dieselben unqualifizierten Anfragen. Erst wenn Seite, Formular und Tracking sauber arbeiten, lohnt sich mehr Reichweite.',
	],
	[
		'question' => 'Brauchen wir eine neue Website?',
		'answer'   => 'Meistens nicht. In 80 % der Fälle reicht eine Optimierung der bestehenden Seite: bessere Formulare, klarere Struktur, sauberes Tracking. Ob ein Relaunch nötig ist, zeigt der erste Audit.',
	],
	[
		'question' => 'Wir nutzen schon eine Agentur — warum sollten wir wechseln?',
		'answer'   => 'Müssen Sie nicht. Ich ergänze oft bestehende Setups — besonders bei Tracking, Vorqualifizierung und Seitenstruktur. Wenn Ihre aktuelle Agentur alles abdeckt und Ihre Abschlussquote stimmt, brauchen Sie mich nicht.',
	],
];

$service_schema = [
	'@context'    => 'https://schema.org',
	'@type'       => 'Service',
	'@id'         => trailingslashit( $page_url ) . '#service',
	'name'        => 'Website als Vertriebssystem für Solar- und Wärmepumpen-Anbieter',
	'serviceType' => 'Aufbau eigener Anfrage-Systeme zur Ablösung von Portal-Leads für Solar-, Wärmepumpen-, Speicher- und Energie-Anbieter',
	'url'         => $page_url,
	'description' => 'Eigenes Anfrage-System für Solar- und Wärmepumpen-Betriebe: Schluss mit teuren Portal-Leads. Referenz E3 New Energy — 83 % weniger Kosten pro Anfrage in 9 Monaten.',
	'provider'    => [
		'@type' => 'Person',
		'name'  => 'Haşim Üner',
		'url'   => home_url( '/' ),
	],
	'audience'    => [
		'@type'        => 'Audience',
		'audienceType' => 'Solar-, Wärmepumpen-, Speicher- und Energie-Anbieter im DACH-Raum',
	],
	'areaServed'  => [
		[
			'@type' => 'Country',
			'name'  => 'Deutschland',
		],
	],
	'offers'      => [
		'@type'         => 'Offer',
		'price'         => '0',
		'priceCurrency' => 'EUR',
		'description'   => 'Diagnostische System-Einordnung für Ihre Anfrage-Prozesse.',
	],
];

$faq_schema = [
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'@id'        => trailingslashit( $page_url ) . '#faq',
	'url'        => trailingslashit( $page_url ) . '#faq',
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

get_header();
?>
<main id="main" class="site-main">
	<div class="energy-page-wrapper" data-track-section="energy_service_landing" data-track-funnel-stage="energy_landing">
		<section class="nx-section nx-hero energy-hero" id="hero">
			<div class="nx-container">
				<div class="energy-hero__grid">
					<div class="energy-hero__copy">
						<span class="nx-badge nx-badge--gold">Für Solar- und Wärmepumpen-Betriebe mit 10–25 Mitarbeitern</span>
						<h1 class="nx-hero__title">Schluss mit teuren Portal-Leads, die nicht ans Telefon gehen.</h1>
						<p class="nx-hero__subtitle">Ich baue Solar- und Wärmepumpen-Anbietern ein eigenes Anfrage-System &mdash; damit Ihr Vertrieb nur noch mit Interessenten spricht, die wirklich kaufen wollen.</p>
						<p class="nx-cta-microcopy">Referenz E3 New Energy: –83 % Kosten pro Anfrage &middot; 1.750+ qualifizierte Anfragen in 9 Monaten &middot; 12 % Abschlussquote</p>
						<div class="energy-hero__actions">
							<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_hero_request" data-track-category="lead_gen" data-track-section="energy_hero" data-track-funnel-stage="energy_hero"><?php echo esc_html( $request_cta ); ?></a>
						</div>
					</div>

				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-diagram-section" id="modell" aria-labelledby="modell-title">
			<div class="nx-container">
				<h2 id="modell-title" class="screen-reader-text">Modell A: Nachfrage mieten vs. Modell B: Infrastruktur aufbauen</h2>
				<div class="energy-diagram" role="img" aria-label="Vergleichsdiagramm: Modell A (Portal-Leads) vs. Modell B (eigenes Anfrage-System) mit den drei Schritten Fundament, Conversion und Skalierung. Referenz E3 New Energy: &minus;83 % Kosten, 1.750 Anfragen, 12 % Abschlussquote.">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1300 730" class="energy-diagram__svg" aria-hidden="true" focusable="false">
						<defs>
							<linearGradient id="energyDiagramSystemGradient" x1="0%" y1="0%" x2="100%" y2="100%">
								<stop offset="0%" stop-color="#06b6d4" stop-opacity="0.9" />
								<stop offset="100%" stop-color="#0ea5e9" stop-opacity="0.7" />
							</linearGradient>
							<filter id="energyDiagramGlow" x="-30%" y="-30%" width="160%" height="160%">
								<feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur1" />
								<feGaussianBlur in="SourceGraphic" stdDeviation="14" result="blur2" />
								<feMerge>
									<feMergeNode in="blur2" />
									<feMergeNode in="blur1" />
									<feMergeNode in="SourceGraphic" />
								</feMerge>
							</filter>
							<pattern id="energyDiagramGrid" width="40" height="40" patternUnits="userSpaceOnUse">
								<path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.8" />
							</pattern>
						</defs>

						<rect x="0" y="0" width="1300" height="730" fill="url(#energyDiagramGrid)" />

						<text x="45" y="55" fill="#ffffff" font-size="28" font-weight="800" letter-spacing="-0.5">Eigenes Anfrage-System für Solar &amp; Wärmepumpen</text>
						<text x="45" y="82" fill="#64748b" font-size="15" font-weight="450">Haşim Üner · Unabhängig von Portal-Leads</text>

						<g transform="translate(80, 200)">
							<rect x="-10" y="-10" width="300" height="200" rx="24" fill="#1f1f1f" fill-opacity="0.4" stroke="#ff4444" stroke-width="2" stroke-dasharray="6 4" />
							<text x="15" y="20" fill="#ff4444" font-size="14" font-weight="700" letter-spacing="0.5">MODELL A: NACHFRAGE MIETEN</text>

							<circle cx="50" cy="65" r="18" fill="none" stroke="#6b7280" stroke-width="1.8" />
							<text x="85" y="62" fill="#9ca3af" font-size="13" font-weight="500">bis 150 € pro Lead</text>
							<text x="85" y="80" fill="#6b7280" font-size="11">50 % gehen nicht ans Telefon</text>

							<circle cx="50" cy="115" r="18" fill="none" stroke="#6b7280" stroke-width="1.8" />
							<text x="85" y="112" fill="#9ca3af" font-size="13" font-weight="500">Kein Überblick</text>
							<text x="85" y="130" fill="#6b7280" font-size="11">Welcher Kanal lohnt sich?</text>

							<circle cx="50" cy="165" r="18" fill="none" stroke="#6b7280" stroke-width="1.8" />
							<text x="85" y="162" fill="#9ca3af" font-size="13" font-weight="500">Abhängigkeit</text>
							<text x="85" y="180" fill="#6b7280" font-size="11">Budget-Stopp = Nachfrage-Stopp</text>

							<text x="140" y="210" fill="#4b5563" font-size="10" text-anchor="middle">Aroundhome · Check24 · DAA</text>
						</g>

						<g transform="translate(880, 120)">
							<rect x="-10" y="-10" width="370" height="520" rx="24" fill="#1a2a1a" fill-opacity="0.3" stroke="#22c55e" stroke-width="2" stroke-dasharray="6 4" />
							<text x="15" y="20" fill="#22c55e" font-size="14" font-weight="700" letter-spacing="0.5">MODELL B: INFRASTRUKTUR AUFBAUEN</text>

							<rect x="15" y="45" width="320" height="100" rx="12" fill="#192a3d" fill-opacity="0.5" stroke="rgba(6,182,212,0.4)" stroke-width="1.2" />
							<circle cx="55" cy="85" r="16" fill="none" stroke="#06b6d4" stroke-width="2" />
							<text x="55" y="90" fill="#06b6d4" font-size="12" text-anchor="middle" font-weight="700">1</text>
							<text x="85" y="76" fill="#ffffff" font-size="14" font-weight="700">Fundament ordnen</text>
							<text x="85" y="96" fill="#94a3b8" font-size="11">Tracking &amp; Datenebene</text>
							<text x="85" y="114" fill="#64748b" font-size="10">Privacy-first · Entscheidungssignale</text>

							<path d="M 175 150 L 175 170" fill="none" stroke="#06b6d4" stroke-width="2" stroke-dasharray="4 4">
								<animate attributeName="stroke-dashoffset" from="0" to="-16" dur="1s" repeatCount="indefinite" />
							</path>

							<rect x="15" y="175" width="320" height="100" rx="12" fill="#192a3d" fill-opacity="0.5" stroke="rgba(255,138,0,0.4)" stroke-width="1.2" />
							<circle cx="55" cy="215" r="16" fill="none" stroke="#ff8a00" stroke-width="2" />
							<text x="55" y="220" fill="#ff8a00" font-size="12" text-anchor="middle" font-weight="700">2</text>
							<text x="85" y="206" fill="#ffffff" font-size="14" font-weight="700">Conversion-Pfade schärfen</text>
							<text x="85" y="226" fill="#94a3b8" font-size="11">Formular · Call · Buchung</text>
							<text x="85" y="244" fill="#64748b" font-size="10">Reibung entfernen · 8-Sekunden-Regel</text>

							<path d="M 175 280 L 175 300" fill="none" stroke="#ff8a00" stroke-width="2" stroke-dasharray="4 4">
								<animate attributeName="stroke-dashoffset" from="0" to="-16" dur="1s" repeatCount="indefinite" />
							</path>

							<rect x="15" y="305" width="320" height="100" rx="12" fill="#192a3d" fill-opacity="0.5" stroke="rgba(34,197,94,0.4)" stroke-width="1.2" />
							<circle cx="55" cy="345" r="16" fill="none" stroke="#22c55e" stroke-width="2" />
							<text x="55" y="350" fill="#22c55e" font-size="12" text-anchor="middle" font-weight="700">3</text>
							<text x="85" y="336" fill="#ffffff" font-size="14" font-weight="700">Skalieren</text>
							<text x="85" y="356" fill="#94a3b8" font-size="11">Money Pages &amp; Proof</text>
							<text x="85" y="374" fill="#64748b" font-size="10">Bleibende Assets · Unabhängigkeit</text>

							<rect x="15" y="425" width="320" height="65" rx="12" fill="#0a0a0a" fill-opacity="0.8" stroke="rgba(255,138,0,0.5)" stroke-width="1.5" />
							<text x="175" y="450" fill="#ff8a00" font-size="16" font-weight="800" text-anchor="middle">-83% Kosten · 1.750 Anfragen</text>
							<text x="175" y="474" fill="#22c55e" font-size="13" font-weight="700" text-anchor="middle">12% Abschlussquote</text>
							<text x="175" y="485" fill="#64748b" font-size="9" text-anchor="middle">Referenz: E3 New Energy</text>
						</g>

						<g transform="translate(520, 310)">
							<circle cx="60" cy="30" r="55" fill="#0a0a0a" stroke="url(#energyDiagramSystemGradient)" stroke-width="2.5" filter="url(#energyDiagramGlow)">
								<animate attributeName="r" values="55;58;55" dur="3s" repeatCount="indefinite" />
							</circle>
							<text x="60" y="15" fill="#ffffff" font-size="12" font-weight="700" text-anchor="middle">System-</text>
							<text x="60" y="33" fill="#ffffff" font-size="12" font-weight="700" text-anchor="middle">Diagnose</text>
							<text x="60" y="48" fill="#ff8a00" font-size="10" font-weight="700" text-anchor="middle">Priorisierte</text>
							<text x="60" y="60" fill="#ff8a00" font-size="10" font-weight="700" text-anchor="middle">Hebel</text>

							<path d="M 120 30 C 250 30, 380 130, 510 130" fill="none" stroke="#22c55e" stroke-width="2" stroke-dasharray="8 6">
								<animate attributeName="stroke-dashoffset" from="0" to="-28" dur="1s" repeatCount="indefinite" />
							</path>
							<text x="350" y="70" fill="#22c55e" font-size="12" font-weight="600">Direkter Weg</text>

							<line x1="20" y1="80" x2="-100" y2="150" stroke="#ff4444" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
							<text x="-150" y="170" fill="#ff4444" font-size="10" transform="rotate(-30 -150 170)">vermeiden</text>
						</g>

						<path d="M 380 300 C 300 300, 250 300, 200 300" fill="none" stroke="#ff4444" stroke-width="1.5" stroke-dasharray="5 5" opacity="0.5">
							<animate attributeName="stroke-dashoffset" from="0" to="-20" dur="2s" repeatCount="indefinite" />
						</path>
						<text x="280" y="280" fill="#ff4444" font-size="10">Status Quo: teuer &amp; ineffektiv</text>

						<g transform="translate(80, 650)">
							<rect x="0" y="0" width="280" height="30" rx="15" fill="#0a0a0a" fill-opacity="0.7" stroke="rgba(255,255,255,0.1)" />
							<circle cx="15" cy="15" r="5" fill="#ff4444" />
							<text x="30" y="19" fill="#9ca3af" font-size="10">Altes Modell: Portal-Abhängigkeit</text>
							<circle cx="150" cy="15" r="5" fill="#22c55e" />
							<text x="165" y="19" fill="#9ca3af" font-size="10">Eigenes System</text>
						</g>
					</svg>

					<div class="energy-diagram__legend" aria-hidden="true">
						<div class="energy-diagram__legend-item"><span class="energy-diagram__legend-dot energy-diagram__legend-dot--alt"></span> Portale &amp; Abhängigkeit</div>
						<div class="energy-diagram__legend-item"><span class="energy-diagram__legend-dot energy-diagram__legend-dot--system"></span> Fundament &amp; Daten</div>
						<div class="energy-diagram__legend-item"><span class="energy-diagram__legend-dot energy-diagram__legend-dot--convert"></span> Conversion schärfen</div>
						<div class="energy-diagram__legend-item"><span class="energy-diagram__legend-dot energy-diagram__legend-dot--scale"></span> Skalierung &amp; Assets</div>
					</div>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-proof" id="proof">
			<div class="nx-container">
				<div class="energy-proof__layout">
					<div class="energy-proof__copy">
						<span class="nx-badge nx-badge--gold">Proof / Case Study</span>
						<h2>E3 New Energy.</h2>
						<p>E3 New Energy ist ein regionaler Energieanbieter für Photovoltaik, Wärmepumpen und Speicherlösungen. Ausgangslage: Hohe Kosten pro Anfrage durch Portal-Zukauf, keine eigene digitale Anfrage-Infrastruktur. In 9 Monaten: eigenes System aufgebaut, Kosten pro Anfrage um 83 % gesenkt, Vertrieb arbeitet nur noch mit vorqualifizierten Anfragen.</p>
						<div class="energy-proof__actions">
							<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_proof_request" data-track-category="lead_gen" data-track-section="energy_proof" data-track-funnel-stage="energy_proof"><?php echo esc_html( $request_cta ); ?></a>
						</div>
					</div>

					<aside class="energy-proof__panel" aria-label="Ergebniskennzahlen">
						<div class="energy-proof-kpi-grid">
							<?php foreach ( $proof_kpis as $proof_kpi ) : ?>
								<div class="energy-proof-kpi">
									<strong><?php echo esc_html( $proof_kpi['value'] ); ?></strong>
									<span><?php echo esc_html( $proof_kpi['label'] ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-section--alt" id="reibung">
			<div class="nx-container">
				<div class="energy-section__head">
					<span class="nx-badge nx-badge--ghost">Alltag im Vertrieb</span>
					<h2>Kommt Ihnen das bekannt vor?</h2>
				</div>
				<div class="energy-pain-grid">
					<?php foreach ( $pain_cards as $index => $pain_card ) : ?>
						<article class="energy-pain-card">
							<span class="energy-pain-card__index"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h3><?php echo esc_html( $pain_card['title'] ); ?></h3>
							<p><?php echo esc_html( $pain_card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section" id="branchenverstaendnis">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--gold">So denkt Ihr Kunde</span>
					<h2>Was ein Hausbesitzer durchmacht, bevor er bei Ihnen anfragt.</h2>
				</div>

				<div class="energy-journey-shell" aria-label="Entscheidungsphasen">
					<?php foreach ( $journey_cards as $journey_card ) : ?>
						<article class="energy-journey-card">
							<span class="energy-journey-card__label"><?php echo esc_html( $journey_card['label'] ); ?></span>
							<h3><?php echo esc_html( $journey_card['title'] ); ?></h3>
							<p><?php echo esc_html( $journey_card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-section--alt" id="erstgespraech">
			<div class="nx-container">
				<div class="nx-cta-box energy-cta-box">
					<h2>Nicht sicher, ob das für Sie passt?</h2>
					<p>2 Minuten. Kein Pitch. Sie beschreiben Ihre Situation — ich melde mich innerhalb von 48 Stunden mit einer konkreten Einordnung per E-Mail.</p>
					<div class="energy-cta-box__actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_erstgespraech" data-track-category="lead_gen" data-track-section="energy_midpage" data-track-funnel-stage="energy_midpage"><?php echo esc_html( $request_cta ); ?></a>
					</div>
				</div>
			</div>
		</section>


		<section class="nx-section energy-section" id="faq">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--ghost">Häufige Fragen</span>
					<h2>Was Solar- und Wärmepumpen-Betriebe vor dem Erstgespräch wissen wollen.</h2>
				</div>
				<div class="nx-faq energy-faq">
					<?php foreach ( $faq_items as $index => $faq_item ) : ?>
						<details class="nx-faq__item"<?php echo 0 === $index ? ' open' : ''; ?>>
							<summary><?php echo esc_html( $faq_item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $faq_item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-final-cta" id="abschluss">
			<div class="nx-container">
				<div class="nx-cta-box energy-cta-box">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Eigene Anfragen statt Portal-Abhängigkeit. In 2 Minuten Situation einordnen — Ergebnis per E-Mail.</h2>
					<p class="nx-cta-microcopy">Referenz E3 New Energy: –83 % Kosten pro Anfrage &middot; 1.750+ qualifizierte Anfragen in 9 Monaten &middot; 12 % Abschlussquote</p>
					<div class="energy-cta-box__actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_footer_request" data-track-category="lead_gen" data-track-section="energy_footer" data-track-funnel-stage="energy_footer"><?php echo esc_html( $request_cta ); ?></a>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>

<?php get_footer(); ?>
