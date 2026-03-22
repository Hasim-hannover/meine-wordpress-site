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

$audit_url   = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$e3_url      = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'e3-new-energy' ], home_url( '/e3-new-energy/' ) ) : home_url( '/e3-new-energy/' );
$wgos_url    = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'wordpress-growth-operating-system', 'wgos' ], home_url( '/wordpress-growth-operating-system/' ) ) : home_url( '/wordpress-growth-operating-system/' );
$agentur_url = function_exists( 'nexus_get_primary_public_url' ) ? nexus_get_primary_public_url( 'agentur', home_url( '/wordpress-agentur-hannover/' ) ) : home_url( '/wordpress-agentur-hannover/' );
$privacy_url = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) ) : home_url( '/datenschutz/' );
$results_url = function_exists( 'nexus_get_results_url' ) ? nexus_get_results_url() : home_url( '/ergebnisse/' );
$page_url    = function_exists( 'nexus_get_energy_systems_url' ) ? nexus_get_energy_systems_url() : home_url( '/solar-waermepumpen-leadgenerierung/' );
$flow_steps  = function_exists( 'nexus_get_energy_intake_flow_definition' ) ? nexus_get_energy_intake_flow_definition() : [];

$pain_cards = [
	[
		'title' => 'Nachfrage ist da, aber die Website sortiert sie schlecht.',
		'text'  => 'Solar-, Wärmepumpen- und Speicher-Anbieter verlieren oft nicht am Markt, sondern zwischen erster Relevanz, Vertrauen und nächstem Schritt.',
	],
	[
		'title' => 'Formulare sammeln zu viel, qualifizieren aber zu wenig.',
		'text'  => 'Der Vertrieb bekommt Neugier und echte Kaufabsicht im selben Prozess, weil Übergänge, Fragen und Friktion nicht sauber gebaut sind.',
	],
	[
		'title' => 'Tracking beantwortet die wichtigen Vertriebsfragen nicht.',
		'text'  => 'Es ist unklar, welche Seite, welche Anfragequalität und welcher Kanal wirklich wirtschaftlich tragen.',
	],
	[
		'title' => 'Landingpages reden zu breit statt kaufnah.',
		'text'  => 'Wenn Zielgruppen, Regionen und Entscheidungsphasen nicht sauber getrennt sind, wirkt selbst guter Traffic schnell teuer.',
	],
];

$solution_cards = [
	[
		'eyebrow' => 'Website & Landingpages',
		'title'   => 'Die Website wird als Vertriebssystem gebaut.',
		'text'    => 'Nicht als digitale Broschüre, sondern als klar strukturierter Pfad zu relevanten Anfragen.',
		'items'   => [
			'Angebotsseiten mit klarem Zielgruppen- und Relevanz-Fokus',
			'Landingpages für Regionen, Leistungen und unterschiedliche Entscheidungslagen',
			'Formulare und CTA-Logik, die Komfort und Qualifizierung verbinden',
		],
	],
	[
		'eyebrow' => 'Tracking & Messbarkeit',
		'title'   => 'Nachfrage wird messbar statt nur sichtbar.',
		'text'    => 'Damit nicht nur Klicks oder Form-Sends zählen, sondern Anfragequalität, Übergabe und Reibungsverluste.',
		'items'   => [
			'Privacy-first Tracking mit sauberer Event-Logik',
			'Messpunkte entlang von CTA, Formular und Anfragepfad',
			'Saubere Entscheidungsgrundlage für Marketing und Vertrieb',
		],
	],
	[
		'eyebrow' => 'CRO & Anfragequalität',
		'title'   => 'Mehr qualifizierte Gespräche statt mehr Rauschen.',
		'text'    => 'Gute CRO erhöht nicht nur die Conversion Rate, sondern sortiert den Prozess für echte Kaufbereitschaft.',
		'items'   => [
			'Bessere Vorqualifizierung ohne Formularballast',
			'Mehr Relevanz im Hero, Proof und nächstem Schritt',
			'Weniger Streuverlust für Innendienst und Vertrieb',
		],
	],
	[
		'eyebrow' => 'SEO & WordPress',
		'title'   => 'Suchintention, Struktur und technische Umsetzung greifen zusammen.',
		'text'    => 'Gerade im Energie-Umfeld reicht Sichtbarkeit allein nicht. Die Seite muss Suchanlass, Vertrauen und Conversion verbinden.',
		'items'   => [
			'Informationsarchitektur für Leistungen, Regionen und Kaufnähe',
			'Technische Umsetzung in einem kontrollierbaren WordPress-Setup',
			'Keine Blackbox, sondern wartbare Weiterentwicklung',
		],
	],
];

$fit_cards = [
	'Solar-Anbieter mit regionaler oder überregionaler Nachfrage.',
	'Wärmepumpen-Anbieter und SHK-Unternehmen mit Wärmepumpenfokus.',
	'Speicher- und Energielösungen mit erklärungsbedürftigem Anfrageprozess.',
	'Energievertriebe oder kombinierte Anbieter mit mehreren Angebotslinien.',
	'Teams, bei denen Website, Marketing und Vertrieb digital sauberer zusammenspielen sollen.',
];

$industry_points = [
	[
		'title' => 'Nicht jeder Besucher ist gleich weit.',
		'text'  => 'Ein Teil vergleicht gerade erst, ein anderer sucht schon konkret den nächsten Schritt. Die Website muss diese Unterschiede ohne Chaos auffangen.',
	],
	[
		'title' => 'Vertrauen entsteht nicht erst im Gespräch.',
		'text'  => 'Gerade bei erklärungsbedürftigen Energielösungen entscheiden Proof, Klarheit und Routing häufig vor dem ersten Kontakt.',
	],
	[
		'title' => 'Marketing und Vertrieb brauchen denselben Datenrahmen.',
		'text'  => 'Sonst skaliert die Nachfrage auf eine Struktur, die gute Leads zu spät erkennt oder falsch weitergibt.',
	],
];

$journey_cards = [
	[
		'label' => 'Frühe Phase',
		'title' => 'Noch Orientierung',
		'text'  => 'Hier braucht es Klarheit, Vergleichbarkeit und schnelle Relevanz. Zu breite Seiten verlieren diese Nutzer früh.',
	],
	[
		'label' => 'Mittlere Phase',
		'title' => 'Konkretes Interesse',
		'text'  => 'Jetzt zählen Proof, regionale Passung, klare Leistungslogik und ein sauberer nächster Schritt.',
	],
	[
		'label' => 'Späte Phase',
		'title' => 'Anfragebereit',
		'text'  => 'Hier darf das Formular nicht bremsen. Komfort, Vorqualifizierung und Vertrauen müssen direkt ineinandergreifen.',
	],
];

$proof_kpis = [
	[
		'value' => '1.750+',
		'label' => 'Leads im System',
	],
	[
		'value' => '-83 %',
		'label' => 'Cost per Lead',
	],
	[
		'value' => '12 %',
		'label' => 'Sales-Conversion',
	],
];

$process_steps = [
	[
		'number' => '01',
		'title'  => 'Analyse',
		'text'   => 'Wir klären, wo Nachfrage, Vertrauen und Anfrageprozess heute tatsächlich brechen.',
	],
	[
		'number' => '02',
		'title'  => 'Priorisierung',
		'text'   => 'Nicht alles gleichzeitig, sondern zuerst der wirtschaftlich stärkste Hebel.',
	],
	[
		'number' => '03',
		'title'  => 'Umsetzung',
		'text'   => 'Landingpages, Tracking, CTA-Logik, Formulare und WordPress-Struktur greifen sauber zusammen.',
	],
	[
		'number' => '04',
		'title'  => 'Weiterentwicklung',
		'text'   => 'Das Setup bleibt messbar, wartbar und vertriebsnah statt nach dem Launch wieder zu veralten.',
	],
];

$faq_items = [
	[
		'question' => 'Arbeiten Sie für Endkunden oder für Unternehmen aus dem Energie-Umfeld?',
		'answer'   => 'Ich arbeite B2B. Die Seite richtet sich an Unternehmen, die selbst an Privatkunden, Gewerbe oder KMU verkaufen und ihre Website als Anfrage-System nutzen wollen.',
	],
	[
		'question' => 'Ist das einfach eine Branchen-Version Ihrer WordPress-Agentur-Seite?',
		'answer'   => 'Nein. Diese Seite ist enger geschnitten: für Solar-, Wärmepumpen-, Speicher- und angrenzende Energie-Anbieter mit Fokus auf Anfragequalität, Tracking und Conversion im Vertriebsprozess.',
	],
	[
		'question' => 'Brauchen wir dafür sofort einen Relaunch?',
		'answer'   => 'Oft nicht. Häufig reicht zuerst eine saubere Priorisierung: Landingpages, Tracking, CTA-Logik oder Formularprozess. Ein Relaunch ist nur sinnvoll, wenn die Struktur selbst der Engpass ist.',
	],
	[
		'question' => 'Ist das eher SEO, CRO oder Tracking?',
		'answer'   => 'In der Praxis ist genau diese Trennung das Problem. Sichtbarkeit, Nutzerführung, Messbarkeit und Vorqualifizierung greifen direkt ineinander. Ich arbeite an der Verbindung statt an isolierten Gewerken.',
	],
	[
		'question' => 'Was passiert nach dem Formular?',
		'answer'   => 'Sie erhalten eine persönliche Einordnung. Wenn ein Growth Audit der sinnvollste nächste Schritt ist, wird das klar benannt. Wenn zuerst eine andere Priorität zählt, wird auch das sauber eingeordnet.',
	],
	[
		'question' => 'Passt das auch für Anbieter mit mehreren Regionen oder mehreren Leistungen?',
		'answer'   => 'Ja. Gerade dann ist die Struktur besonders wichtig, weil Zielgruppen, Regionen und Leistungslogik auf der Website schnell ineinander laufen.',
	],
];

$service_schema = [
	'@context'    => 'https://schema.org',
	'@type'       => 'Service',
	'@id'         => trailingslashit( $page_url ) . '#service',
	'name'        => 'Website als Vertriebssystem für Solar- und Wärmepumpen-Anbieter',
	'serviceType' => 'B2B Website-, Tracking- und Conversion-System für Solar-, Wärmepumpen-, Speicher- und Energie-Anbieter',
	'url'         => $page_url,
	'description' => 'B2B-Landingpage für Solar-, Wärmepumpen- und Speicher-Anbieter: Website als Vertriebssystem mit Tracking, CRO, SEO und intelligenter Vorqualifizierung.',
	'provider'    => [
		'@type' => 'Person',
		'name'  => 'Haşim Üner',
		'url'   => home_url( '/' ),
	],
	'audience'    => [
		'@type'        => 'Audience',
		'audienceType' => 'B2B-Unternehmen aus Solar, Wärmepumpe, Speicher und Energielösungen',
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
		'description'   => 'Growth Audit als diagnostischer Einstieg in Website-, Tracking- und Conversion-Optimierung.',
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

$form_values  = [];
$form_error   = '';
$form_success = null;

if (
	'POST' === $_SERVER['REQUEST_METHOD']
	&& isset( $_POST['intake_variant'] )
	&& 'energy_systems' === sanitize_key( (string) wp_unslash( $_POST['intake_variant'] ) )
) {
	$form_values = wp_unslash( $_POST );
	$submission  = function_exists( 'nexus_process_review_request_submission' )
		? nexus_process_review_request_submission( $form_values )
		: new WP_Error( 'missing_handler', 'Die Anfrage konnte gerade nicht verarbeitet werden.' );

	if ( is_wp_error( $submission ) ) {
		$form_error = $submission->get_error_message();
	} else {
		unset( $submission['http_status'] );
		$form_success = $submission;
		$form_values  = [];
	}
}

$option_labels = [];
foreach ( $flow_steps as $step ) {
	if ( empty( $step['name'] ) || empty( $step['options'] ) || ! is_array( $step['options'] ) ) {
		continue;
	}

	$option_labels[ $step['name'] ] = [];
	foreach ( $step['options'] as $option_value => $option_definition ) {
		$option_labels[ $step['name'] ][ $option_value ] = isset( $option_definition['label'] ) ? (string) $option_definition['label'] : (string) $option_value;
	}
}

$get_value = static function( $field_name ) use ( $form_values ) {
	$value = $form_values[ $field_name ] ?? '';

	if ( is_array( $value ) ) {
		return '';
	}

	return trim( (string) $value );
};

$get_summary_value = static function( $field_name ) use ( $get_value, $option_labels ) {
	$value = $get_value( $field_name );

	if ( '' === $value ) {
		if ( 'measurement_state' === $field_name ) {
			return 'Nur wenn relevant';
		}

		return 'Noch offen';
	}

	if ( isset( $option_labels[ $field_name ][ $value ] ) ) {
		return $option_labels[ $field_name ][ $value ];
	}

	if ( 'page_url' === $field_name ) {
		$host = wp_parse_url( $value, PHP_URL_HOST );

		return is_string( $host ) && '' !== $host ? $host : $value;
	}

	if ( 'current_challenge' === $field_name ) {
		return function_exists( 'nexus_truncate' ) ? nexus_truncate( $value, 72 ) : $value;
	}

	return $value;
};

get_header();
?>
<main id="main" class="site-main">
	<div class="energy-page-wrapper" data-track-section="energy_service_landing">
		<section class="nx-section nx-hero energy-hero" id="hero">
			<div class="nx-container">
				<div class="energy-hero__grid">
					<div class="energy-hero__copy">
						<span class="nx-badge nx-badge--gold">B2B für Solar, Wärmepumpe, Speicher und Energielösungen</span>
						<h1 class="nx-hero__title">Website für Solar- und Wärmepumpen-Anbieter, die qualifizierte Anfragen erzeugt.</h1>
						<p class="nx-hero__subtitle">
							Wenn Nachfrage da ist, aber Landingpages, Formulare, Tracking und Nutzerführung Potenzial verlieren,
							wird aus Sichtbarkeit kein belastbarer Anfrageprozess. Genau dort setze ich an.
						</p>
						<div class="energy-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_hero_audit" data-track-category="lead_gen"><?php echo esc_html( nexus_get_audit_cta_label() ); ?></a>
							<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_energy_hero_case" data-track-category="trust">E3 Case Study ansehen</a>
							<a href="#energie-anfrage" class="energy-text-link" data-track-action="cta_energy_hero_form" data-track-category="lead_gen">Oder direkt Ihr Setup einordnen</a>
						</div>
						<p class="nx-cta-microcopy">B2B statt Endkunden-Marketing. Diagnose vor Pitch. WordPress, Tracking und CRO als System.</p>
						<div class="energy-hero__signals" aria-label="Schnelle Einordnung">
							<div class="energy-signal-card">
								<strong>B2B-only</strong>
								<span>Ich arbeite für Unternehmen, nicht für Endkunden.</span>
							</div>
							<div class="energy-signal-card">
								<strong>Vertriebssystem statt Broschüre</strong>
								<span>Website, Tracking und Anfragepfad greifen operativ zusammen.</span>
							</div>
							<div class="energy-signal-card">
								<strong>Proof statt Behauptung</strong>
								<span>E3 New Energy zeigt, wie aus Zukauf echte Lead-Struktur werden kann.</span>
							</div>
						</div>
					</div>

					<aside class="energy-hero__panel" aria-labelledby="energy-hero-panel-title">
						<span class="energy-panel__eyebrow">Worum es hier nicht geht</span>
						<h2 id="energy-hero-panel-title">Kein generisches Branchen-Marketing.</h2>
						<p>
							Die Kernfrage ist nicht, ob der Markt Nachfrage hat. Die Kernfrage ist,
							ob Website, Tracking und Anfrageprozess diese Nachfrage sauber in qualifizierte Gespräche übersetzen.
						</p>
						<ul class="energy-check-list">
							<li>klarer Zielgruppenfit statt breiter Leistungsfläche</li>
							<li>messbarer Anfragepfad statt Bauchgefühl</li>
							<li>Vorqualifizierung ohne Formularballast</li>
							<li>technische Umsetzung in einem kontrollierbaren WordPress-Setup</li>
						</ul>
						<p class="energy-panel__meta">Diese Seite ist bewusst thematisch enger geschnitten als <a href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a> und führt kaufnäher in denselben Systemgedanken.</p>
					</aside>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-section--alt" id="reibung">
			<div class="nx-container">
				<div class="energy-section__head">
					<span class="nx-badge nx-badge--ghost">Problem / Reibung</span>
					<h2>Viele Anbieter verlieren nicht am Markt, sondern an ihrer digitalen Struktur.</h2>
					<p>Gerade im Energie-Umfeld liegen Nachfrage, Beratungsaufwand und Vertriebsdruck oft schon an. Die Website macht daraus aber zu selten einen sauberen, messbaren Anfrageprozess.</p>
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

		<section class="nx-section energy-section" id="loesung">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--gold">Leistung / Lösung</span>
					<h2>Ich ordne Website, Tracking und Conversion so, dass qualifizierte Anfragen wahrscheinlicher werden.</h2>
					<p>Nicht als Sammlung einzelner Gewerke, sondern als zusammenhängendes Nachfrage-System in WordPress.</p>
				</div>
				<div class="energy-solution-grid">
					<?php foreach ( $solution_cards as $solution_card ) : ?>
						<article class="energy-solution-card">
							<span class="energy-solution-card__eyebrow"><?php echo esc_html( $solution_card['eyebrow'] ); ?></span>
							<h3><?php echo esc_html( $solution_card['title'] ); ?></h3>
							<p><?php echo esc_html( $solution_card['text'] ); ?></p>
							<ul>
								<?php foreach ( $solution_card['items'] as $solution_item ) : ?>
									<li><?php echo esc_html( $solution_item ); ?></li>
								<?php endforeach; ?>
							</ul>
						</article>
					<?php endforeach; ?>
				</div>
				<p class="energy-inline-note">
					Die technische Basis dahinter ist kein Zufallsprodukt, sondern baut auf demselben <a href="<?php echo esc_url( $wgos_url ); ?>">WGOS-Systemverständnis</a> auf, das auch andere Money Pages und Proof-Strecken trägt.
				</p>
			</div>
		</section>

		<section class="nx-section energy-section energy-section--alt" id="zielgruppenfit">
			<div class="nx-container">
				<div class="energy-fit-layout">
					<div class="energy-section__head energy-section__head--left">
						<span class="nx-badge nx-badge--ghost">Für wen</span>
						<h2>Diese Seite passt, wenn Ihre Website ein echter Vertriebskanal werden soll.</h2>
						<p>Besonders für Teams, die Nachfrage nicht nur einsammeln, sondern besser einordnen, steuern und auswerten wollen.</p>
					</div>
					<div class="energy-fit-grid" aria-label="Zielgruppenfit">
						<?php foreach ( $fit_cards as $fit_card ) : ?>
							<div class="energy-fit-card"><?php echo esc_html( $fit_card ); ?></div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section" id="branchenverstaendnis">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--gold">Branchenverständnis</span>
					<h2>Im Energie-Vertrieb muss die Website vier Dinge gleichzeitig leisten.</h2>
					<p>Vertrauen aufbauen, Orientierung geben, Vorqualifizierung leisten und Conversion sauber ermöglichen. Wenn einer dieser Punkte bricht, wird Nachfrage teuer oder unbrauchbar.</p>
				</div>

				<div class="energy-understanding-grid">
					<div class="energy-understanding-stack">
						<?php foreach ( $industry_points as $industry_point ) : ?>
							<article class="energy-understanding-card">
								<h3><?php echo esc_html( $industry_point['title'] ); ?></h3>
								<p><?php echo esc_html( $industry_point['text'] ); ?></p>
							</article>
						<?php endforeach; ?>
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
			</div>
		</section>

		<section class="nx-section energy-section energy-proof" id="proof">
			<div class="nx-container">
				<div class="energy-proof__layout">
					<div class="energy-proof__copy">
						<span class="nx-badge nx-badge--gold">Proof / Case Study</span>
						<h2>E3 New Energy ist der naheliegende Proof für genau diese Logik.</h2>
						<p>
							Die E3-Case-Study zeigt nicht einfach mehr Sichtbarkeit, sondern die Wirkung sauberer Reihenfolge:
							Tracking, Funnel-Führung, Vorqualifizierung und Conversion arbeiteten erstmals als System.
						</p>
						<div class="energy-proof__actions">
							<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_proof_case" data-track-category="trust">E3 Case Study lesen</a>
							<a href="<?php echo esc_url( $results_url ); ?>" class="energy-text-link" data-track-action="cta_energy_proof_results" data-track-category="trust">Weitere Ergebnisse ansehen</a>
						</div>
						<p class="energy-proof__note">Wichtig: Die Case Study ist Proof und nicht Blaupause. Ihre Website braucht eine eigene Priorisierung, keine kopierte Maßnahme.</p>
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
						<div class="energy-proof-quote">
							<strong>Weshalb relevant?</strong>
							<p>Weil hier genau sichtbar wird, wie bessere Seitenstruktur, Tracking und qualifizierter Übergang aus Nachfrage belastbare Gespräche machen.</p>
						</div>
					</aside>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-section--alt" id="prozess">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--ghost">Prozess</span>
					<h2>Vom Engpass zur belastbaren Website-Struktur.</h2>
					<p>Erst Klarheit, dann Priorität, dann Umsetzung. Nicht andersherum.</p>
				</div>
				<div class="energy-process-grid">
					<?php foreach ( $process_steps as $process_step ) : ?>
						<article class="energy-process-card">
							<span class="energy-process-card__number"><?php echo esc_html( $process_step['number'] ); ?></span>
							<h3><?php echo esc_html( $process_step['title'] ); ?></h3>
							<p><?php echo esc_html( $process_step['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section energy-form-section" id="energie-anfrage">
			<div class="nx-container">
				<div class="energy-form-shell">
					<div class="energy-form-shell__intro">
						<span class="nx-badge nx-badge--gold">Multi-Step-Form</span>
						<h2>Ihr Setup in wenigen Antworten sauber einordnen.</h2>
						<p>
							Eine Frage pro Schritt, große klickbare Antworten, Auto-Advance bei Auswahl und Kontaktangaben erst am Ende.
							Ohne generischen Fragebogen, ohne Plugin-Overhead, ohne unnötige Reibung.
						</p>
						<div class="energy-form-points">
							<div class="energy-form-point">
								<strong>Komfort</strong>
								<span>große Antwortkarten, mobil stark nutzbar, schneller Flow</span>
							</div>
							<div class="energy-form-point">
								<strong>Qualifizierung</strong>
								<span>Branchenfit, Engpass, Nachfragequelle und Timing werden sofort sichtbar</span>
							</div>
							<div class="energy-form-point">
								<strong>Barrierefreiheit</strong>
								<span>Tastatur, Fokusführung, Statusansagen und reduzierte Bewegung sind mitgedacht</span>
							</div>
						</div>
					</div>

					<div class="energy-form-shell__flow">
						<div class="energy-form-shell__main">
							<?php if ( $form_success ) : ?>
								<div id="energy-request-success" class="review-success energy-review-success is-server-success" role="status" aria-live="polite" aria-atomic="true">
									<div class="review-success-pill">Anfrage eingegangen</div>
									<h3>Die Einordnung ist jetzt im System.</h3>
									<p class="review-success-copy"><?php echo esc_html( $form_success['message'] ?? 'Danke. Die Anfrage ist eingegangen.' ); ?></p>
									<div class="review-success-meta">
										<span>persönliche Rückmeldung</span>
										<span>diagnose vor pitch</span>
										<span>keine generische agenturstrecke</span>
									</div>
									<div class="review-success-actions">
										<a class="cta-btn" href="<?php echo esc_url( $e3_url ); ?>">E3 Case Study lesen</a>
										<a class="audit-text-link" href="<?php echo esc_url( $audit_url ); ?>">Growth Audit ansehen</a>
									</div>
								</div>
							<?php else : ?>
								<form
									id="energy-intake-form"
									class="review-funnel energy-intake-form"
									action="<?php echo esc_url( trailingslashit( $page_url ) . '#energie-anfrage' ); ?>"
									method="post"
									data-energy-form
									novalidate
								>
									<input type="hidden" name="company_website" value="">
									<input type="hidden" name="started_at" value="">
									<input type="hidden" name="audit_type" value="growth_audit">
									<input type="hidden" name="intake_variant" value="energy_systems">
									<input type="hidden" name="ads_source" value="">
									<input type="hidden" name="ads_keyword" value="">

									<div class="review-progress energy-progress" aria-label="Fortschritt im Branchen-Flow">
										<div class="review-progress-head">
											<div class="review-progress-copy">
												<span class="review-progress-eyebrow">Eine Frage pro View</span>
												<strong id="energy-progress-current" aria-live="polite" aria-atomic="true">Abschnitt 1 von <?php echo esc_html( (string) count( $flow_steps ) ); ?>: <?php echo ! empty( $flow_steps[0]['title_short'] ) ? esc_html( $flow_steps[0]['title_short'] ) : 'Leistung'; ?></strong>
											</div>
											<span class="review-progress-meta" aria-hidden="true">ca. 60-90 Sekunden</span>
										</div>
										<div
											class="review-progress-track"
											id="energy-progress-track"
											role="progressbar"
											aria-label="Fortschritt im Anfrage-Flow"
											aria-valuemin="1"
											aria-valuemax="<?php echo esc_attr( (string) count( $flow_steps ) ); ?>"
											aria-valuenow="1"
											aria-valuetext="Abschnitt 1 von <?php echo esc_attr( (string) count( $flow_steps ) ); ?>: <?php echo ! empty( $flow_steps[0]['title_short'] ) ? esc_attr( $flow_steps[0]['title_short'] ) : 'Leistung'; ?>"
										>
											<div class="review-progress-fill" id="energy-progress-fill"></div>
										</div>
										<p class="energy-progress-note">Sichtbar ist immer nur die aktuelle Frage. Ihre bisherigen Angaben bleiben erhalten und werden im Flow sauber weitergef&uuml;hrt.</p>
									</div>

									<div class="screen-reader-text" aria-live="assertive" aria-atomic="true" data-energy-step-live></div>

									<details class="review-mobile-summary">
										<summary>Ihre Angaben bisher</summary>
										<dl class="review-brief-list review-brief-list--mobile">
											<?php foreach ( $flow_steps as $step ) : ?>
												<?php if ( empty( $step['name'] ) || empty( $step['summary_label'] ) ) : ?>
													<?php continue; ?>
												<?php endif; ?>
												<div class="review-brief-row">
													<dt><?php echo esc_html( $step['summary_label'] ); ?></dt>
													<dd data-energy-summary="<?php echo esc_attr( $step['name'] ); ?>"><?php echo esc_html( $get_summary_value( $step['name'] ) ); ?></dd>
												</div>
											<?php endforeach; ?>
										</dl>
									</details>

									<noscript>
										<p class="energy-noscript-note">Ohne JavaScript bleibt das Formular vollständig nutzbar, aber ohne Schrittlogik und Auto-Advance.</p>
									</noscript>

									<?php foreach ( $flow_steps as $index => $step ) : ?>
										<?php
										$step_id         = isset( $step['id'] ) ? (string) $step['id'] : 'step-' . (string) $index;
										$field_key       = isset( $step['name'] ) ? (string) $step['name'] : '';
										$choice_error_id = 'energy-error-' . $step_id;
										$is_active       = 0 === $index;
										?>
										<section
											id="<?php echo esc_attr( 'energy-step-' . $step_id ); ?>"
											class="review-step energy-step<?php echo esc_attr( $is_active ? ' is-active' : '' ); ?>"
											data-energy-step-id="<?php echo esc_attr( $step_id ); ?>"
											data-energy-step-index="<?php echo esc_attr( (string) $index ); ?>"
											data-energy-step-label="<?php echo esc_attr( $step['title_short'] ); ?>"
											data-energy-field="<?php echo esc_attr( $field_key ); ?>"
											data-energy-kind="<?php echo esc_attr( $step['kind'] ); ?>"
											<?php if ( ! empty( $step['next'] ) ) : ?>
												data-energy-next-step="<?php echo esc_attr( $step['next'] ); ?>"
											<?php endif; ?>
											<?php if ( ! empty( $step['auto_advance'] ) ) : ?>
												data-energy-auto-advance="true"
											<?php endif; ?>
											<?php if ( ! empty( $step['show_when']['field'] ) && ! empty( $step['show_when']['values'] ) ) : ?>
												data-energy-show-field="<?php echo esc_attr( $step['show_when']['field'] ); ?>"
												data-energy-show-values="<?php echo esc_attr( implode( ',', array_map( 'sanitize_key', (array) $step['show_when']['values'] ) ) ); ?>"
											<?php endif; ?>
											<?php if ( ! empty( $step['next_by_value'] ) ) : ?>
												data-energy-next-map="<?php echo esc_attr( wp_json_encode( $step['next_by_value'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) ); ?>"
											<?php endif; ?>
										>
											<span class="review-step-kicker">Abschnitt <?php echo esc_html( (string) ( $index + 1 ) ); ?> von <?php echo esc_html( (string) count( $flow_steps ) ); ?></span>
											<h3 class="energy-step__title"><?php echo esc_html( $step['question'] ); ?></h3>
											<p class="review-step-copy"><?php echo esc_html( $step['description'] ); ?></p>

											<?php if ( 'single_choice' === $step['kind'] ) : ?>
												<fieldset class="review-choice-block energy-choice-block" aria-describedby="<?php echo esc_attr( trim( 'energy-help-' . $step_id . ' ' . $choice_error_id ) ); ?>">
													<legend><?php echo esc_html( $step['summary_label'] ); ?></legend>
													<p class="review-choice-help" id="<?php echo esc_attr( 'energy-help-' . $step_id ); ?>"><?php echo esc_html( $step['description'] ); ?></p>
													<div class="review-option-group energy-option-group">
														<?php foreach ( $step['options'] as $option_value => $option_definition ) : ?>
															<label class="review-option energy-option">
																<input
																	type="radio"
																	name="<?php echo esc_attr( $field_key ); ?>"
																	value="<?php echo esc_attr( $option_value ); ?>"
																	data-energy-label="<?php echo esc_attr( $option_definition['label'] ); ?>"
																	<?php checked( $get_value( $field_key ), $option_value ); ?>
																	required
																>
																<div class="review-option-copy">
																	<strong data-energy-option-label><?php echo esc_html( $option_definition['label'] ); ?></strong>
																	<span><?php echo esc_html( $option_definition['description'] ); ?></span>
																</div>
															</label>
														<?php endforeach; ?>
													</div>
													<p class="energy-field-error energy-choice-error" id="<?php echo esc_attr( $choice_error_id ); ?>" data-energy-choice-error="<?php echo esc_attr( $field_key ); ?>"></p>
												</fieldset>
											<?php elseif ( 'contact' === $step['kind'] ) : ?>
												<div class="review-field-grid energy-field-grid">
													<?php foreach ( $step['fields'] as $field ) : ?>
														<?php
														$field_name        = (string) $field['name'];
														$field_id          = 'energy-field-' . $field_name;
														$field_value       = $get_value( $field_name );
														$field_help_id     = ! empty( $field['help'] ) ? $field_id . '-help' : '';
														$field_error_id    = $field_id . '-error';
														$field_description = trim( implode( ' ', array_filter( [ $field_help_id, $field_error_id ] ) ) );
														$is_checkbox       = 'checkbox' === $field['type'];
														$is_textarea       = 'textarea' === $field['type'];
														?>
														<?php if ( $is_checkbox ) : ?>
															<div class="review-consent-card energy-consent-card">
																<label class="review-consent" for="<?php echo esc_attr( $field_id ); ?>">
																	<input
																		id="<?php echo esc_attr( $field_id ); ?>"
																		name="<?php echo esc_attr( $field_name ); ?>"
																		type="checkbox"
																		value="<?php echo esc_attr( $field['value'] ); ?>"
																		<?php checked( $field_value, $field['value'] ); ?>
																		<?php echo ! empty( $field['required'] ) ? 'required' : ''; ?>
																		aria-describedby="<?php echo esc_attr( $field_error_id ); ?>"
																	>
																	<span>
																		<?php echo esc_html( $field['label'] ); ?>
																		<a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutzerklärung</a>.
																	</span>
																</label>
																<p class="energy-field-error" id="<?php echo esc_attr( $field_error_id ); ?>" data-energy-field-error="<?php echo esc_attr( $field_name ); ?>"></p>
															</div>
														<?php else : ?>
															<div class="review-field<?php echo esc_attr( $is_textarea || 'page_url' === $field_name ? ' review-field-full' : '' ); ?>">
																<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $field['label'] ); ?></label>
																<?php if ( ! empty( $field['help'] ) ) : ?>
																	<p class="review-field-help" id="<?php echo esc_attr( $field_help_id ); ?>"><?php echo esc_html( $field['help'] ); ?></p>
																<?php endif; ?>
																<?php if ( $is_textarea ) : ?>
																	<textarea
																		id="<?php echo esc_attr( $field_id ); ?>"
																		name="<?php echo esc_attr( $field_name ); ?>"
																		rows="<?php echo esc_attr( (string) ( $field['rows'] ?? 4 ) ); ?>"
																		<?php echo ! empty( $field['maxlength'] ) ? 'maxlength="' . esc_attr( (string) $field['maxlength'] ) . '"' : ''; ?>
																		<?php echo ! empty( $field['required'] ) ? 'required' : ''; ?>
																		<?php echo '' !== $field_description ? 'aria-describedby="' . esc_attr( $field_description ) . '"' : ''; ?>
																		placeholder="<?php echo esc_attr( $field['placeholder'] ?? '' ); ?>"
																	><?php echo esc_textarea( $field_value ); ?></textarea>
																<?php else : ?>
																	<input
																		id="<?php echo esc_attr( $field_id ); ?>"
																		name="<?php echo esc_attr( $field_name ); ?>"
																		type="<?php echo esc_attr( $field['type'] ); ?>"
																		value="<?php echo esc_attr( $field_value ); ?>"
																		<?php echo ! empty( $field['autocomplete'] ) ? 'autocomplete="' . esc_attr( $field['autocomplete'] ) . '"' : ''; ?>
																		<?php echo ! empty( $field['inputmode'] ) ? 'inputmode="' . esc_attr( $field['inputmode'] ) . '"' : ''; ?>
																		<?php echo ! empty( $field['required'] ) ? 'required' : ''; ?>
																		<?php echo '' !== $field_description ? 'aria-describedby="' . esc_attr( $field_description ) . '"' : ''; ?>
																		<?php echo ! empty( $field['placeholder'] ) ? 'placeholder="' . esc_attr( $field['placeholder'] ) . '"' : ''; ?>
																	>
																<?php endif; ?>
																<p class="energy-field-error" id="<?php echo esc_attr( $field_error_id ); ?>" data-energy-field-error="<?php echo esc_attr( $field_name ); ?>"></p>
															</div>
														<?php endif; ?>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										</section>
									<?php endforeach; ?>

									<div
										id="energy-form-feedback"
										class="review-form-feedback<?php echo '' !== $form_error ? ' is-visible is-error' : ''; ?>"
										aria-live="<?php echo '' !== $form_error ? 'assertive' : 'polite'; ?>"
										aria-atomic="true"
										<?php echo '' !== $form_error ? 'role="alert"' : ''; ?>
									><?php echo esc_html( $form_error ); ?></div>

									<div class="review-actions energy-actions">
										<button type="button" class="review-prev-btn" data-energy-prev hidden>Zurück</button>
										<button type="button" class="audit-submit-btn" data-energy-next-button>Weiter</button>
										<button type="submit" class="audit-submit-btn" data-energy-submit hidden>Growth Audit passend einordnen</button>
									</div>

									<p class="energy-form-meta">Nur Rückmeldungen zu dieser Anfrage. Kein Newsletter-Opt-in, keine Weitergabe, kein Sales-Call als Pflichtschritt.</p>
								</form>

								<div id="energy-request-success" class="review-success energy-review-success" role="status" aria-live="polite" aria-atomic="true" hidden>
									<div class="review-success-pill">Anfrage eingegangen</div>
									<h3>Die Einordnung ist jetzt im System.</h3>
									<p id="energy-success-message" class="review-success-copy">Danke. Ich melde mich mit einer priorisierten ersten Einschätzung zu Website, Tracking und Anfrageprozess.</p>
									<div class="review-success-meta">
										<span>persönliche Rückmeldung</span>
										<span>diagnose vor pitch</span>
										<span>keine generische agenturstrecke</span>
									</div>
									<div class="review-success-actions">
										<a class="cta-btn" href="<?php echo esc_url( $e3_url ); ?>">E3 Case Study lesen</a>
										<a class="audit-text-link" href="<?php echo esc_url( $audit_url ); ?>">Growth Audit ansehen</a>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<aside class="energy-form-shell__aside" aria-labelledby="energy-aside-title">
							<h3 id="energy-aside-title">Ihre Anfrage in Klartext</h3>
							<p>So lässt sich sofort erkennen, ob eher Nachfrage, Website-Struktur, Messbarkeit oder Vorqualifizierung zuerst zählt.</p>
							<dl class="review-brief-list">
								<?php foreach ( $flow_steps as $step ) : ?>
									<?php if ( empty( $step['name'] ) || empty( $step['summary_label'] ) ) : ?>
										<?php continue; ?>
									<?php endif; ?>
									<div class="review-brief-row">
										<dt><?php echo esc_html( $step['summary_label'] ); ?></dt>
										<dd data-energy-summary="<?php echo esc_attr( $step['name'] ); ?>"><?php echo esc_html( $get_summary_value( $step['name'] ) ); ?></dd>
									</div>
								<?php endforeach; ?>
							</dl>
							<div class="energy-form-shell__aside-note">
								<strong>Warum dieser Flow?</strong>
								<p>Er fragt zuerst Systemsignale ab und erst spät persönliche Daten. Dadurch steigt Komfort, aber die Anfrage bleibt trotzdem sauber vorqualifiziert.</p>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</section>

		<section class="nx-section energy-section" id="faq">
			<div class="nx-container">
				<div class="energy-section__head energy-section__head--narrow">
					<span class="nx-badge nx-badge--ghost">FAQ</span>
					<h2>Häufige Fragen zur Zusammenarbeit im Energie-Umfeld.</h2>
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
					<h2>Wenn Nachfrage da ist, sollte die Website sie nicht wieder verlieren.</h2>
					<p>Sie können direkt in den Growth Audit gehen oder Ihr Setup auf dieser Seite erst kurz vorqualifizieren. Beides führt bewusst in dieselbe Diagnose-Logik.</p>
					<div class="energy-cta-box__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_footer_audit" data-track-category="lead_gen"><?php echo esc_html( nexus_get_audit_cta_label() ); ?></a>
						<a href="#energie-anfrage" class="nx-btn nx-btn--ghost" data-track-action="cta_energy_footer_form" data-track-category="lead_gen">Setup einordnen</a>
					</div>
					<p class="energy-cta-box__microcopy">Zur thematischen Einordnung: <a href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a>, <a href="<?php echo esc_url( $wgos_url ); ?>">WGOS</a> und die <a href="<?php echo esc_url( $e3_url ); ?>">E3 Case Study</a> bleiben bewusst separate Seiten, damit diese Landingpage nicht zu einer generischen Sammelseite wird.</p>
				</div>
			</div>
		</section>
	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>

<?php get_footer(); ?>
