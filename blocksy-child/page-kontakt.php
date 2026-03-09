<?php
/**
 * Native contact page for the canonical /kontakt/ path.
 *
 * @package Blocksy_Child
 */

get_header();

$privacy_url   = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) ) : home_url( '/datenschutz/' );
$imprint_url   = function_exists( 'nexus_get_page_url' ) ? nexus_get_page_url( [ 'impressum' ], home_url( '/impressum/' ) ) : home_url( '/impressum/' );
$audit_url     = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );
$calendar_url  = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : 'https://cal.com/hasim/30min';
$rest_endpoint = rest_url( 'nexus/v1/contact-request' );
$focus_options = function_exists( 'nexus_get_contact_focus_options' ) ? nexus_get_contact_focus_options() : [];
$mail_link     = 'mailto:kontakt@hasimuener.de';
$phone_link    = 'tel:+4917681407134';

$quick_contacts = [
	[
		'label' => 'E-Mail',
		'value' => 'kontakt@hasimuener.de',
		'copy'  => 'Für konkrete Rückfragen oder ersten Kontext.',
		'url'   => $mail_link,
	],
	[
		'label' => 'Strategiegespräch',
		'value' => '30 Minuten buchen',
		'copy'  => 'Für Einordnung, Priorisierung oder zweite Meinung.',
		'url'   => $calendar_url,
	],
	[
		'label' => 'Telefon',
		'value' => '0176 81407134',
		'copy'  => 'Für kurze Abstimmungen oder wenn es eilt.',
		'url'   => $phone_link,
	],
];

$social_profiles = [
	[
		'name' => 'LinkedIn',
		'url'  => 'https://www.linkedin.com/in/hasim-%C3%BCner/',
	],
	[
		'name' => 'Instagram',
		'url'  => 'https://www.instagram.com/hasimuener/',
	],
	[
		'name' => 'GitHub',
		'url'  => 'https://github.com/Hasim-hannover',
	],
];
?>

<main id="main" class="site-main contact-page" data-track-section="contact_page">
	<div class="contact-page__shell">
		<section class="contact-hero" aria-labelledby="contact-title">
			<div class="contact-hero__copy nx-reveal">
				<span class="contact-eyebrow">Kontakt</span>
				<h1 id="contact-title" class="contact-title">Kurze Nachricht. Klare Rückmeldung.</h1>
				<p class="contact-lead">
					Wenn klar ist, woran Ihre WordPress-Seite, Angebotsseite oder Growth-Logik gerade hängt,
					reicht hier ein kurzer Kontext. Kein langer Anfrageprozess, nur die nötigen Infos.
				</p>
				<p class="contact-meta">Antwort in der Regel innerhalb von 48 Stunden. Fokus: WordPress, SEO, CRO und Tracking.</p>

				<div class="contact-actions">
					<a class="contact-button contact-button--primary" href="#kontakt-form">Nachricht senden</a>
					<a class="contact-button" href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer">Strategiegespräch</a>
				</div>
			</div>
		</section>

		<div class="contact-main-grid">
			<section class="contact-form-panel nx-reveal" id="kontakt-form" aria-labelledby="contact-form-title">
				<div class="contact-section-head">
					<span class="contact-section-head__eyebrow">Schlankes Formular</span>
					<h2 id="contact-form-title">Schreiben Sie kurz, was gerade blockiert.</h2>
					<p>
						Mehr braucht es für den Erstkontakt nicht. Kein Pflicht-Briefing, keine unnötigen Felder.
					</p>
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
						<label for="contact-context">Unternehmen oder Website <span>optional</span></label>
						<input
							id="contact-context"
							name="company_or_website"
							type="text"
							autocomplete="organization"
							placeholder="z. B. Muster GmbH oder https://example.de"
						>
					</div>

					<fieldset class="contact-focus">
						<legend>Worum geht es grob?</legend>
						<div class="contact-focus__grid">
							<?php
							$focus_index = 0;
							foreach ( $focus_options as $focus_key => $focus_label ) :
								$focus_id = 'contact-focus-' . $focus_index;
								?>
								<label class="contact-focus__option" for="<?php echo esc_attr( $focus_id ); ?>">
									<input
										id="<?php echo esc_attr( $focus_id ); ?>"
										type="radio"
										name="focus"
										value="<?php echo esc_attr( $focus_key ); ?>"
										<?php checked( 0, $focus_index ); ?>
									>
									<span><?php echo esc_html( $focus_label ); ?></span>
								</label>
								<?php
								$focus_index++;
							endforeach;
							?>
						</div>
					</fieldset>

					<div class="contact-field">
						<label for="contact-message">Anliegen</label>
						<textarea
							id="contact-message"
							name="message"
							rows="7"
							required
							placeholder="Kurzkontext: Welche Seite, welches Angebot oder welcher Funnel blockiert gerade? Was soll stattdessen passieren?"
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
						<button class="contact-submit" type="submit">Nachricht senden</button>
						<p class="contact-form__hint">
							Oder direkt an <a href="<?php echo esc_url( $mail_link ); ?>">kontakt@hasimuener.de</a> schreiben.
						</p>
					</div>

					<p class="contact-form__feedback" data-contact-feedback aria-live="polite"></p>
				</form>
			</section>

			<aside class="contact-sidebar">
				<section class="contact-panel nx-reveal" aria-labelledby="contact-direct-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Direkte Wege</span>
						<h2 id="contact-direct-title">Ohne Umwege</h2>
					</div>

					<div class="contact-link-list">
						<?php foreach ( $quick_contacts as $contact ) : ?>
							<a class="contact-link-item" href="<?php echo esc_url( $contact['url'] ); ?>"<?php echo 0 === strpos( $contact['url'], 'http' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
								<span class="contact-link-item__label"><?php echo esc_html( $contact['label'] ); ?></span>
								<strong><?php echo esc_html( $contact['value'] ); ?></strong>
								<span><?php echo esc_html( $contact['copy'] ); ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</section>

				<section class="contact-panel nx-reveal" aria-labelledby="contact-social-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Social</span>
						<h2 id="contact-social-title">Profile</h2>
					</div>

					<div class="contact-social-list">
						<?php foreach ( $social_profiles as $profile ) : ?>
							<a class="contact-social-link" href="<?php echo esc_url( $profile['url'] ); ?>" target="_blank" rel="me noopener noreferrer">
								<?php echo esc_html( $profile['name'] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
				</section>

				<section class="contact-panel contact-panel--note nx-reveal" aria-labelledby="contact-note-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Hinweis</span>
						<h2 id="contact-note-title">Wenn es um eine konkrete Seite geht</h2>
					</div>
					<p class="contact-note">
						Dann ist der <a href="<?php echo esc_url( $audit_url ); ?>">Growth Audit</a> oft der bessere Einstieg als eine offene Anfrage.
					</p>
					<p class="contact-panel__meta">
						<a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
						<span aria-hidden="true">·</span>
						<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
					</p>
				</section>
			</aside>
		</div>
	</div>
</main>

<?php get_footer(); ?>
