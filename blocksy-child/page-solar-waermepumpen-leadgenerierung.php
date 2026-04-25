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
				<header class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--ghost">Zwei Wege</span>
					<h2 id="modell-title">Nachfrage mieten — oder eigene Anfrage-Infrastruktur aufbauen.</h2>
					<p>Zwei Modelle, zwei Wirtschaftlichkeiten. Das eine setzt jeden Monat neu auf Portal-Budget. Das andere baut ein Anfrage-System, das in 9 Monaten 83 % günstiger arbeitet.</p>
				</header>

				<div class="energy-compare" role="group" aria-label="Vergleich: Modell A Portal-Leads vs. Modell B eigenes Anfrage-System">
					<article class="energy-compare__card energy-compare__card--alt">
						<header class="energy-compare__head">
							<span class="energy-compare__label energy-compare__label--alt">Modell A</span>
							<h3>Nachfrage mieten</h3>
							<p class="energy-compare__sub">Aroundhome &middot; Check24 &middot; DAA</p>
						</header>
						<ul class="energy-compare__list">
							<li>
								<strong>bis 150 € pro Lead</strong>
								<span>50 % gehen nicht ans Telefon</span>
							</li>
							<li>
								<strong>Kein Überblick</strong>
								<span>Welcher Kanal lohnt sich wirklich?</span>
							</li>
							<li>
								<strong>Abhängigkeit</strong>
								<span>Budget-Stopp = Nachfrage-Stopp</span>
							</li>
						</ul>
						<footer class="energy-compare__verdict energy-compare__verdict--alt">
							Status quo: teuer &amp; kurzlebig
						</footer>
					</article>

					<div class="energy-compare__bridge" aria-hidden="true">
						<span class="energy-compare__bridge-pill">System-Diagnose<small>priorisierte Hebel</small></span>
					</div>

					<article class="energy-compare__card energy-compare__card--success">
						<header class="energy-compare__head">
							<span class="energy-compare__label energy-compare__label--success">Modell B</span>
							<h3>Eigenes Anfrage-System</h3>
							<p class="energy-compare__sub">Fundament &middot; Conversion &middot; Skalierung</p>
						</header>
						<ol class="energy-compare__steps">
							<li>
								<span class="energy-compare__step-num">1</span>
								<div>
									<strong>Fundament ordnen</strong>
									<span>Tracking &amp; Datenebene &middot; Privacy-first &middot; Entscheidungssignale</span>
								</div>
							</li>
							<li>
								<span class="energy-compare__step-num">2</span>
								<div>
									<strong>Conversion-Pfade schärfen</strong>
									<span>Formular &middot; Call &middot; Buchung &middot; 8-Sekunden-Regel</span>
								</div>
							</li>
							<li>
								<span class="energy-compare__step-num">3</span>
								<div>
									<strong>Skalieren</strong>
									<span>Money Pages &amp; Proof &middot; bleibende Assets &middot; Unabhängigkeit</span>
								</div>
							</li>
						</ol>
						<footer class="energy-compare__verdict energy-compare__verdict--success">
							Bleibendes Anfrage-Asset
						</footer>
					</article>
				</div>

				<aside class="energy-compare__outcome" aria-label="Referenz E3 New Energy">
					<div class="energy-compare__outcome-head">
						<span class="nx-badge nx-badge--gold">Referenz E3 New Energy &middot; 9 Monate</span>
						<h3>Was das in der Praxis bedeutet.</h3>
					</div>
					<div class="energy-compare__outcome-grid">
						<div class="energy-compare__outcome-stat">
							<strong>&minus;83 %</strong>
							<span>Kosten pro Anfrage</span>
						</div>
						<div class="energy-compare__outcome-stat">
							<strong>1.750+</strong>
							<span>qualifizierte Anfragen</span>
						</div>
						<div class="energy-compare__outcome-stat">
							<strong>12 %</strong>
							<span>Abschlussquote</span>
						</div>
					</div>
					<div class="energy-compare__outcome-actions">
						<a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_compare_request" data-track-category="lead_gen" data-track-section="energy_compare" data-track-funnel-stage="energy_compare"><?php echo esc_html( $request_cta ); ?></a>
						<span class="energy-compare__outcome-microcopy">2 Minuten &middot; kein Pitch &middot; Antwort per E-Mail in 48 h</span>
					</div>
				</aside>
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
