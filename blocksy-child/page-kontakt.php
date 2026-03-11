<?php
/**
 * Native contact page for the canonical /kontakt/ path.
 *
 * @package Blocksy_Child
 */

get_header();

$privacy_url    = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) ) : home_url( '/datenschutz/' );
$rest_endpoint  = rest_url( 'nexus/v1/contact-request' );
$focus_options  = function_exists( 'nexus_get_contact_focus_options' ) ? nexus_get_contact_focus_options() : [];
$budget_options = function_exists( 'nexus_get_contact_budget_options' ) ? nexus_get_contact_budget_options() : [];
$requested_focus = isset( $_GET['focus'] ) ? sanitize_key( wp_unslash( $_GET['focus'] ) ) : '';
$selected_focus  = isset( $focus_options[ $requested_focus ] ) ? $requested_focus : '';
$is_pilot_request = 'pilot' === $selected_focus;
?>

<main id="main" class="site-main contact-page" data-track-section="contact_page">
	<div class="contact-page__shell">
		<section class="contact-hero" aria-labelledby="contact-title">
			<div class="contact-hero__copy nx-reveal">
				<span class="contact-eyebrow"><?php echo esc_html( $is_pilot_request ? 'Pilotprojekt' : 'Projektanfrage' ); ?></span>
				<h1 id="contact-title" class="contact-title"><?php echo esc_html( $is_pilot_request ? 'Pilotprojekt anfragen' : 'Projekt anfragen' ); ?></h1>
				<p class="contact-lead">
					<?php
					echo esc_html(
						$is_pilot_request
							? 'Wenn Sie zuerst einen gedeckelten Proof-of-Value fuer Ihre wichtigste Money Page wollen, senden Sie hier die Eckdaten.'
							: 'Wenn Sie Ihre WordPress-Website strategisch weiterentwickeln moechten, lassen Sie uns kurz sprechen.'
					);
					?>
				</p>
				<p class="contact-lead">
					<?php
					echo esc_html(
						$is_pilot_request
							? 'Ich pruefe, ob sich aus dem Pilot in 5 Tagen ein belastbarer naechster Schritt oder eine groessere Zusammenarbeit ableiten laesst.'
							: 'In einem kurzen Gespraech klaeren wir, ob und wie ich Sie unterstuetzen kann.'
					);
					?>
				</p>
			</div>
		</section>

		<div class="contact-flow">
			<section class="contact-note-card nx-reveal" aria-labelledby="contact-strategy-title">
				<div class="contact-section-head contact-section-head--tight">
					<span class="contact-section-head__eyebrow"><?php echo esc_html( $is_pilot_request ? 'Pilotprojekt' : 'Strategiegespraech' ); ?></span>
					<h2 id="contact-strategy-title"><?php echo esc_html( $is_pilot_request ? 'Gedeckelter Einstieg fuer den ersten Proof-of-Value' : 'Kostenloses 30-Minuten Strategiegespraech' ); ?></h2>
				</div>
				<p>
					<?php
					echo esc_html(
						$is_pilot_request
							? 'Das Pilotprojekt fokussiert eine kritische Seite, priorisiert die drei groessten Hebel und schafft eine belastbare Entscheidungsgrundlage ohne offenen Scope.'
							: 'In einem kurzen Gespraech werfen wir gemeinsam einen Blick auf Ihre Website, Ihre Ziele und moegliche Wachstumspotenziale.'
					);
					?>
				</p>
				<p>
					<?php
					echo esc_html(
						$is_pilot_request
							? 'Wenn Ergebnisse und Freigabe passen, kann daraus spaeter eine anonymisierte Referenz werden.'
							: 'Kein Verkaufsgespraech - sondern eine ehrliche Einschaetzung.'
					);
					?>
				</p>
			</section>

			<section class="contact-form-panel nx-reveal" id="kontakt-form" aria-labelledby="contact-form-title">
				<div class="contact-section-head">
					<span class="contact-section-head__eyebrow"><?php echo esc_html( $is_pilot_request ? 'Pilotprojekt' : 'Projektanfrage' ); ?></span>
					<h2 id="contact-form-title"><?php echo esc_html( $is_pilot_request ? 'Die wichtigsten Eckdaten fuer das Pilotprojekt' : 'Die wichtigsten Eckdaten in wenigen Feldern' ); ?></h2>
					<p>
						<?php
						echo esc_html(
							$is_pilot_request
								? 'So laesst sich schnell einschaetzen, ob die Seite fuer einen 5-Tage-Pilot fachlich und strategisch passt.'
								: 'So laesst sich schnell einschaetzen, ob das Projekt fachlich und strategisch passt.'
						);
						?>
					</p>
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
						<label for="contact-focus">Wobei benötigen Sie Unterstützung?</label>
						<select id="contact-focus" name="focus" required>
							<option value="" <?php selected( '', $selected_focus ); ?> disabled>Bitte auswählen</option>
							<?php foreach ( $focus_options as $focus_key => $focus_label ) : ?>
								<option value="<?php echo esc_attr( $focus_key ); ?>" <?php selected( $selected_focus, $focus_key ); ?>><?php echo esc_html( $focus_label ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="contact-field">
						<label for="contact-message">Projektbeschreibung</label>
						<p id="contact-message-help" class="contact-field__help">Beschreiben Sie kurz Ihr Ziel oder Ihr Projekt.</p>
						<textarea
							id="contact-message"
							name="message"
							rows="7"
							required
							minlength="24"
							aria-describedby="contact-message-help"
							placeholder="<?php echo esc_attr( $is_pilot_request ? 'Welche Seite ist kritisch, woran scheitert sie aktuell und was soll sich nach dem Pilot veraendern?' : 'Beschreiben Sie kurz Ihr Ziel oder Ihr Projekt.' ); ?>"
						></textarea>
					</div>

					<div class="contact-field">
						<label for="contact-budget">Budget <span>optional</span></label>
						<select id="contact-budget" name="budget">
							<option value="" selected>Optional auswählen</option>
							<?php foreach ( $budget_options as $budget_key => $budget_label ) : ?>
								<option value="<?php echo esc_attr( $budget_key ); ?>"><?php echo esc_html( $budget_label ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<label class="contact-consent">
						<input type="checkbox" name="consent" value="1" required>
						<span>
							Ich stimme zu, dass meine Angaben zur Bearbeitung meiner Anfrage verarbeitet werden.
							Mehr dazu in der <a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutzerklärung</a>.
						</span>
					</label>

					<div class="contact-form__actions">
						<button class="contact-submit" type="submit"><?php echo esc_html( $is_pilot_request ? 'Pilotprojekt anfragen' : 'Strategiegespraech anfragen' ); ?></button>
					</div>

					<p class="contact-form__feedback" data-contact-feedback aria-live="polite"></p>
				</form>

				<div class="contact-form__postcopy">
					<p class="contact-postcopy__lead">
						<?php
						echo esc_html(
							$is_pilot_request
								? 'Sie erhalten innerhalb von 24 Stunden eine Rueckmeldung. Wenn es passt, definieren wir die Zielseite und den Start des Pilotprojekts.'
								: 'Sie erhalten innerhalb von 24 Stunden eine Rueckmeldung. Wenn es passt, vereinbaren wir ein kurzes Strategiegespraech.'
						);
						?>
					</p>
					<p class="contact-postcopy__note">
						Ich arbeite hauptsächlich mit Unternehmen, Selbstständigen und Organisationen,
						die ihre WordPress-Website strategisch weiterentwickeln möchten.
					</p>
					<p class="contact-postcopy__note">
						Um eine hohe Qualität sicherzustellen, arbeite ich nur mit einer begrenzten Anzahl an Projekten gleichzeitig.
					</p>
				</div>
			</section>
		</div>
	</div>
</main>

<?php get_footer(); ?>
