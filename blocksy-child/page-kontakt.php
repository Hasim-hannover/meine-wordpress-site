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

$direct_paths = [
	[
		'eyebrow' => 'Direkt per E-Mail',
		'title'   => 'Für konkrete Rückfragen oder einen ersten Kontext.',
		'copy'    => 'Wenn bereits klar ist, welche Seite, welches Angebot oder welcher Funnel gerade blockiert, ist E-Mail oft der schnellste Weg.',
		'url'     => $mail_link,
		'label'   => 'kontakt@hasimuener.de',
	],
	[
		'eyebrow' => 'Strategiegespräch',
		'title'   => 'Für Priorisierung, Einordnung oder eine schnelle zweite Meinung.',
		'copy'    => 'Sinnvoll, wenn mehrere Themen zusammenhängen und Sie die Reihenfolge klären wollen.',
		'url'     => $calendar_url,
		'label'   => '30 Minuten buchen',
	],
	[
		'eyebrow' => 'Telefon',
		'title'   => 'Für kurze Abstimmungen oder wenn es zeitkritisch ist.',
		'copy'    => 'Kein Callcenter, kein Vertriebsloop. Direkter Kontakt.',
		'url'     => $phone_link,
		'label'   => '0176 81407134',
	],
];

$social_profiles = [
	[
		'name'  => 'LinkedIn',
		'copy'  => 'Der beste Kanal für fachliche Updates, Cases und direkten Erstkontakt.',
		'url'   => 'https://www.linkedin.com/in/hasim-%C3%BCner/',
		'label' => 'Profil öffnen',
	],
	[
		'name'  => 'Instagram',
		'copy'  => 'Einblicke in Projekte, Arbeitsweise und aktuelle Themen in kompakter Form.',
		'url'   => 'https://www.instagram.com/hasimuener/',
		'label' => 'Instagram ansehen',
	],
	[
		'name'  => 'GitHub',
		'copy'  => 'Technischer Kontext, Theme-Arbeit und Umsetzungsnähe statt nur Oberfläche.',
		'url'   => 'https://github.com/Hasim-hannover',
		'label' => 'Repository ansehen',
	],
];

$contact_topics = [
	[
		'title' => 'WordPress als Anfragesystem',
		'copy'  => 'Wenn Ihre Website gut aussieht, aber zu wenig qualifizierte Anfragen erzeugt oder keine klare Angebotslogik hat.',
	],
	[
		'title' => 'SEO und kaufnahe Einstiegsseiten',
		'copy'  => 'Wenn Sichtbarkeit da ist, aber Money Pages, interne Verlinkung oder Conversion-Führung zu weich bleiben.',
	],
	[
		'title' => 'Tracking, CRO und Priorisierung',
		'copy'  => 'Wenn Daten, CTAs, Proof oder Formulare nicht sauber zusammenspielen und dadurch Nachfrage verloren geht.',
	],
	[
		'title' => 'Growth Audit als Einstieg',
		'copy'  => 'Wenn Sie eine fokussierte Diagnose für eine konkrete Start-, Angebots- oder Kampagnenseite brauchen.',
	],
];

$briefing_points = [
	'welche Seite oder welcher Funnel betroffen ist',
	'was die Seite aktuell auslösen soll',
	'welche Hürde gerade am meisten stört',
	'ob es eine Frist, Kampagne oder interne Deadline gibt',
];
?>

<main id="main" class="site-main contact-page" data-track-section="contact_page">
	<div class="contact-page__shell">
		<section class="contact-hero" aria-labelledby="contact-title">
			<div class="contact-hero__copy nx-reveal">
				<span class="contact-eyebrow">Kontakt</span>
				<h1 id="contact-title" class="contact-title">Direkter Kontakt statt langem Anfrageprozess.</h1>
				<p class="contact-lead">
					Wenn klar ist, woran Ihre WordPress-Seite, Angebotsseite oder Growth-Logik gerade hängt,
					reicht eine präzise Nachricht. Für alles andere gibt es hier den schnellsten Einstieg:
					schlankes Formular, E-Mail, Telefon oder Strategiegespräch.
				</p>

				<div class="contact-badges" aria-label="Kontaktvorteile">
					<span class="contact-badge">Antwort in der Regel innerhalb von 48 Stunden</span>
					<span class="contact-badge">B2B, WordPress, SEO, CRO, Tracking</span>
					<span class="contact-badge">Kein Sales-Theater, nur klare Einordnung</span>
				</div>

				<div class="contact-actions">
					<a class="contact-button contact-button--primary" href="#kontakt-form">Nachricht senden</a>
					<a class="contact-button" href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer">Strategiegespräch</a>
				</div>
			</div>

			<aside class="contact-hero__rail nx-reveal" aria-label="Direkte Kontaktwege">
				<div class="contact-hero-card">
					<span class="contact-hero-card__eyebrow">Schnellster Weg</span>
					<h2>Kurze Nachricht, klare Rückmeldung.</h2>
					<p>
						Je konkreter URL, Angebotsziel oder Engpass beschrieben sind, desto präziser fällt
						die erste Rückmeldung aus.
					</p>
					<ul class="contact-hero-list">
						<li>eine betroffene Seite oder Kampagne benennen</li>
						<li>das gewünschte Ergebnis kurz beschreiben</li>
						<li>optional: Deadline oder internen Druckpunkt nennen</li>
					</ul>
					<a class="contact-hero-card__link" href="<?php echo esc_url( $audit_url ); ?>">Wenn es seitenfokussiert ist: Growth Audit ansehen</a>
				</div>
			</aside>
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
						<h2 id="contact-direct-title">Wenn das Formular nicht der beste Kanal ist.</h2>
					</div>

					<div class="contact-stack">
						<?php foreach ( $direct_paths as $path ) : ?>
							<article class="contact-card">
								<span class="contact-card__eyebrow"><?php echo esc_html( $path['eyebrow'] ); ?></span>
								<h3><?php echo esc_html( $path['title'] ); ?></h3>
								<p><?php echo esc_html( $path['copy'] ); ?></p>
								<a href="<?php echo esc_url( $path['url'] ); ?>"<?php echo 0 === strpos( $path['url'], 'http' ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
									<?php echo esc_html( $path['label'] ); ?>
								</a>
							</article>
						<?php endforeach; ?>
					</div>
				</section>

				<section class="contact-panel nx-reveal" aria-labelledby="contact-social-title">
					<div class="contact-section-head contact-section-head--tight">
						<span class="contact-section-head__eyebrow">Social Profiles</span>
						<h2 id="contact-social-title">Fachlich folgen oder direkt schreiben.</h2>
					</div>

					<div class="contact-stack">
						<?php foreach ( $social_profiles as $profile ) : ?>
							<article class="contact-card contact-card--social">
								<h3><?php echo esc_html( $profile['name'] ); ?></h3>
								<p><?php echo esc_html( $profile['copy'] ); ?></p>
								<a href="<?php echo esc_url( $profile['url'] ); ?>" target="_blank" rel="me noopener noreferrer">
									<?php echo esc_html( $profile['label'] ); ?>
								</a>
							</article>
						<?php endforeach; ?>
					</div>
				</section>
			</aside>
		</div>

		<section class="contact-topics nx-reveal" aria-labelledby="contact-topics-title">
			<div class="contact-section-head">
				<span class="contact-section-head__eyebrow">Wobei ich helfen kann</span>
				<h2 id="contact-topics-title">Typische Anlässe für den Erstkontakt.</h2>
				<p>
					Nicht alles braucht direkt ein großes Projekt. Oft reicht zuerst eine saubere Einordnung,
					was der nächste sinnvolle Schritt ist.
				</p>
			</div>

			<div class="contact-topics__grid">
				<?php foreach ( $contact_topics as $topic ) : ?>
					<article class="contact-topic-card">
						<h3><?php echo esc_html( $topic['title'] ); ?></h3>
						<p><?php echo esc_html( $topic['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="contact-briefing nx-reveal" aria-labelledby="contact-briefing-title">
			<div class="contact-briefing__intro">
				<span class="contact-section-head__eyebrow">Was hilfreich ist</span>
				<h2 id="contact-briefing-title">Was eine Rückmeldung schneller und besser macht.</h2>
			</div>

			<div class="contact-briefing__grid">
				<div class="contact-briefing-card">
					<ul class="contact-briefing-list">
						<?php foreach ( $briefing_points as $point ) : ?>
							<li><?php echo esc_html( $point ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="contact-briefing-card contact-briefing-card--accent">
					<h3>Wenn es sehr seitenfokussiert ist</h3>
					<p>
						Geht es konkret um eine Startseite, Angebotsseite oder Kampagnen-Landing,
						ist der <a href="<?php echo esc_url( $audit_url ); ?>">Growth Audit</a> meist der schnellere und sauberere Einstieg.
					</p>
					<p class="contact-briefing-card__meta">
						Rechtliches: <a href="<?php echo esc_url( $imprint_url ); ?>" rel="nofollow">Impressum</a>
						<span aria-hidden="true">·</span>
						<a href="<?php echo esc_url( $privacy_url ); ?>" rel="nofollow">Datenschutz</a>
					</p>
				</div>
			</div>
		</section>
	</div>
</main>

<?php get_footer(); ?>
