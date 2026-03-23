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
		'title' => 'Formulare sammeln zu viel, qualifizieren zu wenig.',
		'text'  => 'Der Vertrieb bekommt Neugier und Kaufabsicht im selben Prozess, weil Übergänge und Friktion nicht sauber gebaut sind.',
	],
	[
		'title' => 'Tracking beantwortet die wichtigen Vertriebsfragen nicht.',
		'text'  => 'Unklar welche Seite, welche Anfragequalität und welcher Kanal wirtschaftlich tragen.',
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

$faq_items = [
	[
		'question' => 'Arbeiten Sie für Endkunden oder für Unternehmen aus dem Energie-Umfeld?',
		'answer'   => 'Ich arbeite B2B. Die Seite richtet sich an Unternehmen, die selbst an Privatkunden, Gewerbe oder KMU verkaufen und ihre Website als Anfrage-System nutzen wollen.',
	],
	[
		'question' => 'Brauchen wir dafür sofort einen Relaunch?',
		'answer'   => 'Oft nicht. Häufig reicht zuerst eine saubere Priorisierung: Landingpages, Tracking, CTA-Logik oder Formularprozess. Ein Relaunch ist nur sinnvoll, wenn die Struktur selbst der Engpass ist.',
	],
	[
		'question' => 'Was passiert nach dem Formular?',
		'answer'   => 'Sie erhalten eine persönliche Einordnung. Wenn ein Growth Audit der sinnvollste nächste Schritt ist, wird das klar benannt. Wenn zuerst eine andere Priorität zählt, wird auch das sauber eingeordnet.',
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
						<p class="nx-hero__subtitle">Wenn Nachfrage da ist, aber Landingpages, Tracking und Nutzerführung Potenzial verlieren &mdash; genau dort setze ich an.</p>
						<div class="energy-hero__actions">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_hero_audit" data-track-category="lead_gen"><?php echo esc_html( nexus_get_audit_cta_label() ); ?></a>
							<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_energy_hero_case" data-track-category="trust">E3 Case Study ansehen</a>
							<a href="#energie-anfrage" class="energy-text-link" data-track-action="cta_energy_hero_form" data-track-category="lead_gen">Oder direkt Ihr Setup einordnen</a>
						</div>
						<p class="nx-cta-microcopy">B2B-only &middot; Diagnose vor Pitch &middot; E3 als Proof</p>
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
						<p>Vom Lead-Einkauf zum eigenen Nachfragesystem &mdash; im Energiemarkt, mit derselben Logik.</p>
						<div class="energy-proof__actions">
							<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_proof_case" data-track-category="trust">Case Study lesen</a>
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
					<span class="nx-badge nx-badge--ghost">Problem / Reibung</span>
					<h2>Was im Energie-Vertrieb digital oft bremst.</h2>
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
					<span class="nx-badge nx-badge--gold">Branchenverständnis</span>
					<h2>Im Energie-Vertrieb muss die Website Vertrauen, Orientierung und Vorqualifizierung gleichzeitig leisten.</h2>
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

		<section class="nx-section energy-section energy-form-section" id="energie-anfrage">
			<div class="nx-container">
				<div class="energy-form-shell">
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
												<strong id="energy-progress-current" aria-live="polite" aria-atomic="true">Abschnitt 1 von <?php echo esc_html( (string) count( $flow_steps ) ); ?>: <?php echo ! empty( $flow_steps[0]['title_short'] ) ? esc_html( $flow_steps[0]['title_short'] ) : 'Leistung'; ?></strong>
											</div>
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
											<h3 class="energy-step__title"><?php echo esc_html( $step['question'] ); ?></h3>

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
					<h2>Wenn Nachfrage da ist, sollte die Website sie nicht verlieren.</h2>
					<div class="energy-cta-box__actions">
						<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_energy_footer_audit" data-track-category="lead_gen"><?php echo esc_html( nexus_get_audit_cta_label() ); ?></a>
						<a href="#energie-anfrage" class="nx-btn nx-btn--ghost" data-track-action="cta_energy_footer_form" data-track-category="lead_gen">Setup einordnen</a>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

<script type="application/ld+json"><?php echo wp_json_encode( $service_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
<script type="application/ld+json"><?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>

<?php get_footer(); ?>
