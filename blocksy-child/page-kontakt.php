<?php
/**
 * Native contact page for the canonical /kontakt/ path.
 *
 * Supports intent-based display via query params for dedicated
 * contact routing entry points.
 *
 * @package Blocksy_Child
 */

get_header();

$privacy_url          = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) ) : home_url( '/datenschutz/' );
$rest_endpoint        = rest_url( 'nexus/v1/contact-request' );
$request_type_options = function_exists( 'nexus_get_contact_request_type_options' ) ? nexus_get_contact_request_type_options() : [];
$focus_options        = function_exists( 'nexus_get_contact_focus_options' ) ? nexus_get_contact_focus_options() : [];
$budget_options       = function_exists( 'nexus_get_contact_budget_options' ) ? nexus_get_contact_budget_options() : [];
$timeline_options     = function_exists( 'nexus_get_contact_timeline_options' ) ? nexus_get_contact_timeline_options() : [];
$calendar_url         = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' );
$agentur_url          = function_exists( 'nexus_get_primary_public_url' ) ? nexus_get_primary_public_url( 'agentur', home_url( '/wordpress-agentur-hannover/' ) ) : home_url( '/wordpress-agentur-hannover/' );
$wartung_url          = function_exists( 'nexus_get_primary_public_url' ) ? nexus_get_primary_public_url( 'wartung', home_url( '/wordpress-wartung-hannover/' ) ) : home_url( '/wordpress-wartung-hannover/' );
$results_url          = function_exists( 'nexus_get_results_url' ) ? nexus_get_results_url() : home_url( '/ergebnisse/' );
$requested_focus      = isset( $_GET['focus'] ) ? sanitize_key( wp_unslash( $_GET['focus'] ) ) : '';
$requested_type       = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : '';
$selected_focus       = isset( $focus_options[ $requested_focus ] ) ? $requested_focus : '';
$selected_type        = isset( $request_type_options[ $requested_type ] ) ? $requested_type : '';
$social_links         = [
	[
		'label' => 'LinkedIn',
		'url'   => 'https://www.linkedin.com/in/hasim-%C3%BCner/',
		'note'  => 'Profil, Einblicke und direkter Kontext zur Arbeit.',
	],
	[
		'label' => 'GitHub',
		'url'   => 'https://github.com/Hasim-hannover',
		'note'  => 'Öffentliche Systemarbeit, Code und technische Tiefe.',
	],
];

if ( '' === $selected_type && 'followup_scope' === $selected_focus ) {
	$selected_type = 'analysis';
}

if ( '' === $selected_type && isset( $request_type_options['audit'] ) ) {
	$selected_type = 'audit';
}

$is_audit_type          = 'audit' === $selected_type;
$is_analysis_type       = 'analysis' === $selected_type;
$is_implementation_type = 'implementation' === $selected_type;
$is_ongoing_type        = 'ongoing' === $selected_type;
$is_general_type        = 'general' === $selected_type;
$is_client_type         = 'client' === $selected_type;
$has_explicit_type     = '' !== $requested_type && isset( $request_type_options[ $requested_type ] );
$show_timeline_field   = in_array( $selected_type, [ 'analysis', 'implementation', 'ongoing', 'client' ], true );
$show_budget_field     = in_array( $selected_type, [ 'implementation', 'ongoing' ], true );
$type_copy_map         = [
	'audit'          => [
		'focus_label'         => 'Was soll zuerst diagnostiziert werden?',
		'focus_help'          => 'Wählen Sie die Fläche, auf der aktuell die größte Unklarheit liegt.',
		'message_label'       => 'Kurzbeschreibung',
		'message_help'        => 'Welche URL ist relevant? Was ist unklar? Welches Ergebnis wünschen Sie sich?',
		'message_placeholder' => "1. Seite: Welche URL ist relevant?\n2. Unklarheit: Was bremst gerade?\n3. Ziel: Was soll sich verbessern?",
		'submit_label'        => 'Growth Audit anfragen',
		'timeline_label'      => 'Zeitfenster',
	],
	'analysis'       => [
		'focus_label'         => 'Was soll vertieft werden?',
		'focus_help'          => 'Wählen Sie den Bereich, der fachlich als Nächstes genauer geprüft werden soll.',
		'message_label'       => 'Kurzbeschreibung',
		'message_help'        => 'Welche Erkenntnis fehlt noch? Was soll genauer geprüft oder priorisiert werden?',
		'message_placeholder' => "1. Fokus: Was soll vertieft werden?\n2. Hürde: Wo bleibt noch Unklarheit?\n3. Ziel: Welche Entscheidung soll danach leichter werden?",
		'submit_label'        => 'Folgeanalyse anfragen',
		'timeline_label'      => 'Zeitfenster',
	],
	'implementation' => [
		'focus_label'         => 'Was soll umgesetzt oder korrigiert werden?',
		'focus_help'          => 'Wählen Sie den Hebel, der fachlich am nächsten an Ihrem Umsetzungsbedarf liegt.',
		'message_label'       => 'Kurzbeschreibung',
		'message_help'        => 'Was ist das Ziel? Was ist die aktuelle Hürde? Welches Ergebnis wünschen Sie sich?',
		'message_placeholder' => "1. Ziel: Was soll erreicht werden?\n2. Hürde: Was steht aktuell im Weg?\n3. Ergebnis: Was soll sich konkret verbessern?",
		'submit_label'        => 'Umsetzung anfragen',
		'timeline_label'      => 'Zeitfenster',
	],
	'ongoing'        => [
		'focus_label'         => 'Was soll laufend weiterentwickelt werden?',
		'focus_help'          => 'Wählen Sie den Bereich, der dauerhaft sauber betreut oder weiterentwickelt werden soll.',
		'message_label'       => 'Kurzbeschreibung',
		'message_help'        => 'Welche Themen laufen bereits und wo soll laufend mehr Klarheit, Stabilität oder Wirkung entstehen?',
		'message_placeholder' => "1. System: Was läuft bereits?\n2. Engpass: Was blockiert oder kostet gerade Wirkung?\n3. Weiterentwicklung: Was soll planbar besser werden?",
		'submit_label'        => 'Weiterentwicklung anfragen',
		'timeline_label'      => 'Zeitfenster',
	],
	'general'        => [
		'focus_label'         => 'Worum geht es?',
		'focus_help'          => 'Wählen Sie den Bereich, damit das Anliegen direkt passend eingeordnet werden kann.',
		'message_label'       => 'Ihre Frage oder Nachricht',
		'message_help'        => 'Schildern Sie kurz Ihre Frage, Anfrage oder den Anlass.',
		'message_placeholder' => 'Worum geht es und welche Rückmeldung wäre hilfreich?',
		'submit_label'        => 'Anfrage senden',
		'timeline_label'      => 'Zeitfenster',
	],
	'client'         => [
		'focus_label'         => 'Wobei kann ich unterstützen?',
		'focus_help'          => 'Wählen Sie den Bereich, damit Priorisierung und Rückmeldung direkt anschließen können.',
		'message_label'       => 'Kurzbeschreibung',
		'message_help'        => 'Beschreiben Sie kurz Status, Blocker oder die nächste Entscheidung.',
		'message_placeholder' => 'Worum geht es gerade, was blockiert und was soll als Nächstes entschieden werden?',
		'submit_label'        => 'Kundenanliegen senden',
		'timeline_label'      => 'Dringlichkeit',
	],
];
$current_type_copy     = isset( $type_copy_map[ $selected_type ] ) ? $type_copy_map[ $selected_type ] : $type_copy_map['audit'];
$focus_label           = $current_type_copy['focus_label'];
$focus_help            = $current_type_copy['focus_help'];
$message_label         = $current_type_copy['message_label'];
$message_help          = $current_type_copy['message_help'];
$message_placeholder   = $current_type_copy['message_placeholder'];
$submit_label          = $current_type_copy['submit_label'];
$timeline_label        = $current_type_copy['timeline_label'];
$message_minlength     = $is_general_type ? 18 : 24;

$is_scoped_landing     = $has_explicit_type && ! $is_general_type && ! $is_client_type;
$current_type_label    = isset( $request_type_options[ $selected_type ]['label'] ) ? (string) $request_type_options[ $selected_type ]['label'] : 'Kontakt';

$hero_eyebrow = $is_scoped_landing ? $current_type_label : 'Kontakt';
$hero_title   = $is_scoped_landing ? $current_type_label : 'Growth Audit, Folgeanalyse oder Weiterentwicklung.';
$hero_lead    = $is_scoped_landing
	? 'Beschreiben Sie Ihr Anliegen in wenigen Feldern. Sie erhalten eine persönliche Einschätzung und eine saubere Einordnung ohne Sales-Nebel.'
	: 'Ein zentraler Einstieg für Growth Audit, fokussierte Folgeanalyse, Umsetzung / Optimierung, laufende Weiterentwicklung, allgemeine Anfragen und Bestandskunden.';
$hero_cta     = $is_scoped_landing ? 'Anfrage ausfüllen' : 'Anfrage starten';

$auto_scroll  = $has_explicit_type || '' !== $selected_focus;
?>

<main id="main" class="site-main contact-page<?php echo $is_scoped_landing ? ' contact-page--scoped' : ''; ?>" data-track-section="contact_page"<?php echo $auto_scroll ? ' data-contact-autoscroll' : ''; ?>>
	<div class="contact-page__shell">
		<section class="contact-hero" aria-labelledby="contact-title">
			<div class="contact-hero__copy nx-reveal">
				<span class="contact-eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></span>
				<h1 id="contact-title" class="contact-title"><?php echo esc_html( $hero_title ); ?></h1>
				<p class="contact-lead"><?php echo esc_html( $hero_lead ); ?></p>

				<?php if ( ! $is_scoped_landing ) : ?>
					<p class="contact-lead">
						Wenn das Thema bereits klar ist, führt ein zweiter CTA direkt zu <span class="contact-inline-highlight">cal.com</span>.
						Wenn noch Kontext fehlt, reicht die Anfrage in wenigen Feldern.
					</p>
				<?php endif; ?>

				<div class="contact-hero__actions">
					<a class="contact-btn contact-btn--primary" href="#kontakt-form"><?php echo esc_html( $hero_cta ); ?></a>
					<a class="contact-btn contact-btn--ghost" href="<?php echo esc_url( $calendar_url ); ?>" data-track-action="cta_click_contact_call">Direkt Termin buchen</a>
				</div>

				<ul class="contact-hero__meta" aria-label="Kontaktvorteile">
					<li>Antwort in der Regel innerhalb von 24 Stunden</li>
					<li>Direkter Kontakt statt Sales-Team</li>
					<?php if ( $is_scoped_landing ) : ?>
						<li>Unverbindlich und kostenfrei</li>
					<?php else : ?>
						<li>Geeignet für Diagnose, Folgeanalyse, Weiterentwicklung und Bestandskunden</li>
					<?php endif; ?>
				</ul>
			</div>
		</section>

		<div class="contact-grid">
			<div class="contact-rail">
				<section class="contact-note-card contact-note-card--accent nx-reveal" aria-labelledby="contact-direct-call-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Direkttermin</span>
						<h2 id="contact-direct-call-title">Wenn das Thema klar ist, direkt buchen.</h2>
					</div>
					<p>
						Für konkrete Projektgespräche, Priorisierung oder nächste Entscheidungen ist ein kurzes Gespräch oft schneller
						als mehrere Mails.
					</p>
					<div class="contact-note-card__actions">
						<a class="contact-btn contact-btn--primary" href="<?php echo esc_url( $calendar_url ); ?>" data-track-action="cta_click_contact_call_panel">30-Minuten-Termin buchen</a>
					</div>
					<p class="contact-note-card__meta">Ideal, wenn Ziel, Timing und Kontext bereits klar sind.</p>
				</section>

				<section class="contact-note-card nx-reveal" aria-labelledby="contact-routing-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Routing</span>
						<h2 id="contact-routing-title">Klare Einstiege statt eines offenen Formulars.</h2>
					</div>
					<ul class="contact-list">
						<?php foreach ( $request_type_options as $request_type_option ) : ?>
							<li><strong><?php echo esc_html( $request_type_option['label'] ); ?></strong> <?php echo esc_html( $request_type_option['description'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				</section>

				<section class="contact-note-card nx-reveal" aria-labelledby="contact-entry-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Einordnung</span>
						<h2 id="contact-entry-title">Vor der Anfrage noch kurz orientieren?</h2>
					</div>
					<ul class="contact-list">
						<li><a href="<?php echo esc_url( $agentur_url ); ?>">WordPress Agentur Hannover</a> ist der breite Einstieg für Angebotsseiten, SEO, Tracking und Conversion.</li>
						<li><a href="<?php echo esc_url( $wartung_url ); ?>">WordPress Wartung Hannover</a> passt, wenn Betrieb, Updates und Stabilisierung im Vordergrund stehen.</li>
						<li><a href="<?php echo esc_url( $results_url ); ?>">Ergebnisse</a> ist der richtige Schritt, wenn Sie zuerst offenen Proof und Cases sehen wollen.</li>
					</ul>
				</section>

				<section class="contact-note-card nx-reveal" aria-labelledby="contact-social-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Social</span>
						<h2 id="contact-social-title">Vorab ein Eindruck?</h2>
					</div>
					<p>LinkedIn und GitHub geben schnellen Kontext zu Arbeitsweise, Systemdenken und aktuellen Themen.</p>
					<div class="contact-social" aria-label="Social Links">
						<?php foreach ( $social_links as $social_link ) : ?>
							<a class="contact-social__link" href="<?php echo esc_url( $social_link['url'] ); ?>" target="_blank" rel="noopener noreferrer">
								<span class="contact-social__label"><?php echo esc_html( $social_link['label'] ); ?></span>
								<span class="contact-social__note"><?php echo esc_html( $social_link['note'] ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</section>
			</div>

			<section class="contact-form-panel nx-reveal" id="kontakt-form" aria-labelledby="contact-form-title">
				<div class="contact-section-head">
					<span class="contact-section-head__eyebrow">Anfrage</span>
					<h2 id="contact-form-title">
						<?php echo $is_scoped_landing ? 'In wenigen Angaben zur sauberen Einordnung.' : 'In wenigen Angaben zum passenden nächsten Schritt.'; ?>
					</h2>
				</div>

				<div class="contact-error-summary is-hidden" role="alert" aria-live="assertive" data-contact-error-summary>
					<p class="contact-error-summary__title">Bitte prüfen Sie folgende Felder:</p>
					<ul class="contact-error-summary__list" data-contact-error-list></ul>
				</div>

				<form
					class="contact-form"
					data-contact-form
					action="<?php echo esc_url( $rest_endpoint ); ?>"
					method="post"
					novalidate
				>
					<div class="contact-form__honeypot" aria-hidden="true">
						<label for="contact-company-website">Website</label>
						<input id="contact-company-website" type="text" name="company_website" tabindex="-1" autocomplete="off">
					</div>

					<input type="hidden" name="ads_source" id="ads_source" value="">
					<input type="hidden" name="ads_keyword" id="ads_keyword" value="">
					<input type="hidden" name="utm_medium" id="utm_medium" value="">
					<input type="hidden" name="utm_campaign" id="utm_campaign" value="">
					<input type="hidden" name="gclid" id="gclid" value="">
					<input type="hidden" name="matchtype" id="matchtype" value="">

					<?php if ( $is_scoped_landing ) : ?>
						<div class="contact-type-status" data-contact-type-status>
							<span class="contact-type-status__label">Anfragetyp:</span>
							<strong class="contact-type-status__value"><?php echo esc_html( $current_type_label ); ?></strong>
							<button type="button" class="contact-type-status__change" data-contact-type-expand aria-expanded="false">ändern</button>
						</div>
					<?php endif; ?>

					<fieldset class="contact-intent<?php echo $is_scoped_landing ? ' contact-intent--collapsed' : ''; ?>" data-contact-intent>
						<?php if ( ! $is_scoped_landing ) : ?>
							<legend>Worum geht es?</legend>
							<p class="contact-field__help">Nicht sicher? Wählen Sie einfach die Option, die am ehesten passt.</p>
						<?php else : ?>
							<legend class="sr-only">Anfragetyp</legend>
						<?php endif; ?>
						<div class="contact-intent__grid">
							<?php foreach ( $request_type_options as $type_key => $definition ) : ?>
								<label class="contact-intent__option">
									<input
										type="radio"
										name="request_type"
										value="<?php echo esc_attr( $type_key ); ?>"
										<?php checked( $selected_type, $type_key ); ?>
										required
										data-contact-type-input
									>
									<span class="contact-intent__card">
										<strong><?php echo esc_html( $definition['label'] ); ?></strong>
										<span><?php echo esc_html( $definition['description'] ); ?></span>
									</span>
								</label>
							<?php endforeach; ?>
						</div>
					</fieldset>

					<div class="contact-field" data-contact-field="focus">
						<label for="contact-focus" data-contact-focus-label><?php echo esc_html( $focus_label ); ?></label>
						<p id="contact-focus-help" class="contact-field__help" data-contact-focus-help><?php echo esc_html( $focus_help ); ?></p>
						<select id="contact-focus" name="focus" required data-contact-focus-select aria-describedby="contact-focus-help contact-focus-error">
							<option value="" <?php selected( '', $selected_focus ); ?> disabled>Bitte auswählen</option>
							<?php foreach ( $focus_options as $focus_key => $focus_definition ) : ?>
								<option
									value="<?php echo esc_attr( $focus_key ); ?>"
									data-types="<?php echo esc_attr( implode( ',', array_map( 'sanitize_key', (array) $focus_definition['types'] ) ) ); ?>"
									<?php selected( $selected_focus, $focus_key ); ?>
								>
									<?php echo esc_html( $focus_definition['label'] ); ?>
								</option>
							<?php endforeach; ?>
						</select>
						<p class="contact-field__error is-hidden" id="contact-focus-error" aria-live="polite"></p>
					</div>

					<div class="contact-field" data-contact-field="message">
						<label for="contact-message" data-contact-message-label><?php echo esc_html( $message_label ); ?></label>
						<p id="contact-message-help" class="contact-field__help" data-contact-message-help><?php echo esc_html( $message_help ); ?></p>
						<textarea
							id="contact-message"
							name="message"
							rows="6"
							required
							minlength="<?php echo esc_attr( (string) $message_minlength ); ?>"
							aria-describedby="contact-message-help contact-message-error"
							placeholder="<?php echo esc_attr( $message_placeholder ); ?>"
							data-contact-message
						></textarea>
						<p class="contact-field__error is-hidden" id="contact-message-error" aria-live="polite"></p>
					</div>

					<div class="contact-form__row">
						<div class="contact-field" data-contact-field="name">
							<label for="contact-name">Name</label>
							<input id="contact-name" name="name" type="text" autocomplete="name" required aria-describedby="contact-name-error">
							<p class="contact-field__error is-hidden" id="contact-name-error" aria-live="polite"></p>
						</div>

						<div class="contact-field" data-contact-field="email">
							<label for="contact-email">E-Mail</label>
							<input id="contact-email" name="email" type="email" autocomplete="email" required aria-describedby="contact-email-error">
							<p class="contact-field__error is-hidden" id="contact-email-error" aria-live="polite"></p>
						</div>
					</div>

					<details class="contact-optional" data-contact-optional>
						<summary class="contact-optional__toggle">
							<span class="contact-optional__label">Mehr Kontext <span class="contact-optional__hint">(optional)</span></span>
							<svg class="contact-optional__icon" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true"><path d="M5 7l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</summary>
						<div class="contact-optional__body">
							<div class="contact-form__row">
								<div class="contact-field">
									<label for="contact-website">Website URL <span>optional</span></label>
									<input
										id="contact-website"
										name="website_url"
										type="url"
										autocomplete="url"
										inputmode="url"
										placeholder="https://example.de"
									>
								</div>

								<div class="contact-field">
									<label for="contact-linkedin">LinkedIn <span>optional</span></label>
									<input
										id="contact-linkedin"
										name="linkedin_url"
										type="url"
										autocomplete="url"
										inputmode="url"
										placeholder="https://linkedin.com/in/..."
									>
								</div>
							</div>

							<div class="contact-form__row">
								<div class="contact-field<?php echo $show_budget_field ? '' : ' is-hidden'; ?>" data-contact-context-field="budget">
									<label for="contact-budget">Budget <span>optional</span></label>
									<select id="contact-budget" name="budget">
										<option value="" selected>Optional auswählen</option>
										<?php foreach ( $budget_options as $budget_key => $budget_label ) : ?>
											<option value="<?php echo esc_attr( $budget_key ); ?>"><?php echo esc_html( $budget_label ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>

								<div class="contact-field<?php echo $show_timeline_field ? '' : ' is-hidden'; ?>" data-contact-context-field="timeline">
									<label for="contact-timeline" data-contact-timeline-label><?php echo esc_html( $timeline_label ); ?> <span>optional</span></label>
									<select id="contact-timeline" name="timeline" data-contact-timeline-select>
										<option value="" selected>Optional auswählen</option>
										<?php foreach ( $timeline_options as $timeline_key => $timeline_option_label ) : ?>
											<option value="<?php echo esc_attr( $timeline_key ); ?>"><?php echo esc_html( $timeline_option_label ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</details>

					<label class="contact-consent" data-contact-field="consent">
						<input type="checkbox" name="consent" value="1" required aria-describedby="contact-consent-error">
						<span>
							Ich stimme zu, dass meine Angaben zur Bearbeitung meiner Anfrage verarbeitet werden.
							Mehr dazu in der <a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutzerklärung</a>.
						</span>
						<p class="contact-field__error is-hidden" id="contact-consent-error" aria-live="polite"></p>
					</label>

					<div class="contact-form__actions">
						<button class="contact-submit" type="submit" data-contact-submit><?php echo esc_html( $submit_label ); ?></button>
						<a class="contact-form__aux-link" href="<?php echo esc_url( $calendar_url ); ?>">Lieber direkt Termin buchen</a>
					</div>

					<div class="contact-form__feedback" data-contact-feedback aria-live="polite" role="status"></div>
				</form>

				<div class="contact-form__postcopy">
					<p class="contact-postcopy__lead">Antwort in der Regel innerhalb von 24 Stunden. Kein Vertriebsteam, sondern direkter Kontakt.</p>
					<p class="contact-postcopy__note">Wenn ein kurzes Gespräch sinnvoller ist als E-Mail-Pingpong, schicke ich direkt den passenden nächsten Schritt oder den Terminlink.</p>
				</div>
			</section>
		</div>
	</div>
</main>

<?php get_footer(); ?>
