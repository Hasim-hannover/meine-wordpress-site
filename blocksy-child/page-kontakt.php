<?php
/**
 * Native contact page for the canonical /kontakt/ path.
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
$calendar_url         = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : 'https://cal.com/hasim/30min';
$requested_focus      = isset( $_GET['focus'] ) ? sanitize_key( wp_unslash( $_GET['focus'] ) ) : '';
$selected_focus       = isset( $focus_options[ $requested_focus ] ) ? $requested_focus : '';
$requested_type       = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : '';
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
	[
		'label' => 'Instagram',
		'url'   => 'https://www.instagram.com/hasimuener/',
		'note'  => 'Persönlichere Einblicke, Visuals und laufende Themen.',
	],
];

if ( '' === $selected_type && 'pilot' === $selected_focus ) {
	$selected_type = 'project';
}

if ( '' === $selected_type && isset( $request_type_options['project'] ) ) {
	$selected_type = 'project';
}

$is_project_type       = 'project' === $selected_type;
$is_general_type       = 'general' === $selected_type;
$is_client_type        = 'client' === $selected_type;
$show_timeline_field   = ! $is_general_type;
$show_budget_field     = $is_project_type;
$focus_label           = $is_general_type ? 'Worum geht es?' : ( $is_client_type ? 'Wobei kann ich unterstützen?' : 'Wobei benötigen Sie Unterstützung?' );
$focus_help            = $is_general_type ? 'Wählen Sie den Bereich, damit das Anliegen direkt passend eingeordnet werden kann.' : 'Wählen Sie den Hebel, der fachlich am nächsten an Ihrem Anliegen liegt.';
$message_label         = $is_general_type ? 'Ihre Frage oder Nachricht' : 'Kurzbeschreibung';
$message_help          = $is_general_type ? 'Schildern Sie kurz Ihre Frage, Anfrage oder den Anlass.' : ( $is_client_type ? 'Beschreiben Sie kurz Status, Blocker oder die nächste Entscheidung.' : 'Beschreiben Sie Ziel, Hürde und das gewünschte Ergebnis.' );
$message_placeholder   = $is_general_type ? 'Worum geht es und welche Rückmeldung wäre hilfreich?' : ( $is_client_type ? 'Worum geht es gerade, was blockiert und was soll als Nächstes entschieden werden?' : ( 'pilot' === $selected_focus ? 'Welche bestehende Seite ist kritisch, woran scheitert sie aktuell und was soll nach Bewertung und erstem Eingriff besser funktionieren?' : 'Worum geht es im Projekt, was ist das Ziel und was soll sich konkret verbessern?' ) );
$submit_label          = $is_general_type ? 'Anfrage senden' : ( $is_client_type ? 'Kundenanliegen senden' : 'Projektanfrage senden' );
$timeline_label        = $is_client_type ? 'Dringlichkeit' : 'Zeitfenster';
$message_minlength     = $is_general_type ? 18 : 24;
?>

<main id="main" class="site-main contact-page" data-track-section="contact_page">
	<div class="contact-page__shell">
		<section class="contact-hero" aria-labelledby="contact-title">
			<div class="contact-hero__copy nx-reveal">
				<span class="contact-eyebrow"><?php echo esc_html( 'Kontakt' ); ?></span>
				<h1 id="contact-title" class="contact-title">Projektanfrage, Rückfrage oder direkter Termin.</h1>
				<p class="contact-lead">
					Ein zentraler Einstieg für neue Projekte, allgemeine Fragen und bestehende Kunden.
					Die Seite bleibt bewusst schlank, qualifiziert aber die wichtigsten Punkte direkt vor.
				</p>
				<p class="contact-lead">
					Wenn das Thema bereits klar ist, führt ein zweiter CTA direkt zu <span class="contact-inline-highlight">cal.com</span>.
					Wenn noch Kontext fehlt, reicht die Anfrage in wenigen Feldern.
				</p>

				<div class="contact-hero__actions">
					<a class="contact-btn contact-btn--primary" href="#kontakt-form">Anfrage starten</a>
					<a class="contact-btn contact-btn--ghost" href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer" data-track-action="cta_click_contact_call">Direkt Termin buchen</a>
				</div>

				<ul class="contact-hero__meta" aria-label="Kontaktvorteile">
					<li>Antwort in der Regel innerhalb von 24 Stunden</li>
					<li>Direkter Kontakt statt Sales-Team</li>
					<li>Geeignet für Projekte, Fragen und Bestandskunden</li>
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
						<a class="contact-btn contact-btn--primary" href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer" data-track-action="cta_click_contact_call_panel">30-Minuten-Termin buchen</a>
					</div>
					<p class="contact-note-card__meta">Ideal, wenn Ziel, Timing und Kontext bereits klar sind.</p>
				</section>

				<section class="contact-note-card nx-reveal" aria-labelledby="contact-routing-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Routing</span>
						<h2 id="contact-routing-title">Drei klare Einstiege statt eines offenen Formulars.</h2>
					</div>
					<ul class="contact-list">
						<li><strong>Projektanfrage</strong> für Relaunch, SEO, CRO, Performance, Tracking oder Pilotprojekte.</li>
						<li><strong>Allgemeine Anfrage</strong> für Rückfragen, Kooperationen und kurze Abstimmungen.</li>
						<li><strong>Bestehender Kunde</strong> für Priorisierung, Support und nächste Schritte im laufenden Setup.</li>
					</ul>
				</section>

				<section class="contact-note-card nx-reveal" aria-labelledby="contact-social-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Social</span>
						<h2 id="contact-social-title">Vorab ein Eindruck?</h2>
					</div>
					<p>LinkedIn, GitHub und Instagram geben schnellen Kontext zu Arbeitsweise, Systemdenken und aktuellen Themen.</p>
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
					<h2 id="contact-form-title">In wenigen Angaben zum passenden nächsten Schritt.</h2>
				</div>

				<form
					class="contact-form"
					data-contact-form
					action="<?php echo esc_url( $rest_endpoint ); ?>"
					method="post"
				>
					<div class="contact-form__honeypot" aria-hidden="true">
						<label for="contact-company-website">Website</label>
						<input id="contact-company-website" type="text" name="company_website" tabindex="-1" autocomplete="off">
					</div>

					<fieldset class="contact-intent">
						<legend>Worum geht es?</legend>
						<p class="contact-field__help">Nicht sicher? Wählen Sie einfach die Option, die am ehesten passt.</p>
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

					<div class="contact-form__row">
						<div class="contact-field">
							<label for="contact-name">Name</label>
							<input id="contact-name" name="name" type="text" autocomplete="name" required>
						</div>

						<div class="contact-field">
							<label for="contact-email">E-Mail</label>
							<input id="contact-email" name="email" type="email" autocomplete="email" required>
						</div>
					</div>

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

					<div class="contact-field">
						<label for="contact-focus" data-contact-focus-label><?php echo esc_html( $focus_label ); ?></label>
						<p id="contact-focus-help" class="contact-field__help" data-contact-focus-help><?php echo esc_html( $focus_help ); ?></p>
						<select id="contact-focus" name="focus" required data-contact-focus-select>
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
					</div>

					<div class="contact-form__row">
						<div class="contact-field<?php echo $show_timeline_field ? '' : ' is-hidden'; ?>" data-contact-context-field="timeline">
							<label for="contact-timeline" data-contact-timeline-label><?php echo esc_html( $timeline_label ); ?></label>
							<select id="contact-timeline" name="timeline" data-contact-timeline-select data-required-when-visible="1"<?php echo $show_timeline_field ? ' required' : ''; ?>>
								<option value="" selected>Bitte auswählen</option>
								<?php foreach ( $timeline_options as $timeline_key => $timeline_option_label ) : ?>
									<option value="<?php echo esc_attr( $timeline_key ); ?>"><?php echo esc_html( $timeline_option_label ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="contact-field<?php echo $show_budget_field ? '' : ' is-hidden'; ?>" data-contact-context-field="budget">
							<label for="contact-budget">Budget <span>optional</span></label>
							<select id="contact-budget" name="budget">
								<option value="" selected>Optional auswählen</option>
								<?php foreach ( $budget_options as $budget_key => $budget_label ) : ?>
									<option value="<?php echo esc_attr( $budget_key ); ?>"><?php echo esc_html( $budget_label ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="contact-field">
						<label for="contact-message" data-contact-message-label><?php echo esc_html( $message_label ); ?></label>
						<p id="contact-message-help" class="contact-field__help" data-contact-message-help><?php echo esc_html( $message_help ); ?></p>
						<textarea
							id="contact-message"
							name="message"
							rows="7"
							required
							minlength="<?php echo esc_attr( (string) $message_minlength ); ?>"
							aria-describedby="contact-message-help"
							placeholder="<?php echo esc_attr( $message_placeholder ); ?>"
							data-contact-message
						></textarea>
					</div>

					<label class="contact-consent">
						<input type="checkbox" name="consent" value="1" required>
						<span>
							Ich stimme zu, dass meine Angaben zur Bearbeitung meiner Anfrage verarbeitet werden.
							Mehr dazu in der <a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutzerklärung</a>.
						</span>
					</label>

					<div class="contact-form__actions">
						<button class="contact-submit" type="submit"><?php echo esc_html( $submit_label ); ?></button>
						<a class="contact-form__aux-link" href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer">Lieber direkt Termin buchen</a>
					</div>

					<p class="contact-form__feedback" data-contact-feedback aria-live="polite"></p>
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
