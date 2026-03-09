<?php
/**
 * Native page template for slug: datenschutz
 *
 * Replaces the editor-managed privacy text with a maintained legal page
 * that reflects the current no-cookie setup of the public site.
 *
 * @package Blocksy_Child
 */

get_header();

while ( have_posts() ) :
	the_post();

	$imprint_url = function_exists( 'nexus_get_page_url' )
		? nexus_get_page_url( [ 'impressum' ], home_url( '/impressum/' ) )
		: home_url( '/impressum/' );
	$contact_url = function_exists( 'nexus_get_page_url' )
		? nexus_get_page_url( [ 'kontaktiere-mich', 'kontakt' ], home_url( '/kontaktiere-mich/' ) )
		: home_url( '/kontaktiere-mich/' );
	$rights_url = '#rechte';
	?>
	<main id="main" class="site-main privacy-page" data-track-section="privacy_page">
		<style>
			.privacy-page {
				--privacy-bg: rgba(255, 255, 255, 0.04);
				--privacy-bg-strong: rgba(255, 255, 255, 0.07);
				--privacy-border: rgba(255, 255, 255, 0.12);
				--privacy-accent: var(--theme-palette-color-1, #ff8a00);
				--privacy-accent-soft: rgba(255, 138, 0, 0.12);
				--privacy-text: var(--theme-text-color, #f5f5f5);
				--privacy-muted: rgba(255, 255, 255, 0.72);
				padding: clamp(2rem, 4vw, 4rem) 1.25rem 5rem;
				background:
					radial-gradient(circle at top left, rgba(255, 138, 0, 0.18), transparent 32rem),
					radial-gradient(circle at top right, rgba(6, 182, 212, 0.12), transparent 24rem),
					var(--theme-palette-color-5, #0a0a0a);
			}

			.privacy-shell {
				max-width: 1180px;
				margin: 0 auto;
			}

			.privacy-hero {
				padding: clamp(1.75rem, 4vw, 3rem);
				border: 1px solid var(--privacy-border);
				border-radius: 28px;
				background:
					linear-gradient(145deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.03)),
					radial-gradient(circle at top right, rgba(255, 138, 0, 0.14), transparent 18rem);
				box-shadow: 0 24px 80px rgba(0, 0, 0, 0.22);
			}

			.privacy-kicker {
				display: inline-flex;
				align-items: center;
				gap: 0.5rem;
				padding: 0.42rem 0.8rem;
				border-radius: 999px;
				border: 1px solid rgba(255, 138, 0, 0.28);
				background: rgba(255, 138, 0, 0.08);
				color: #ffd39e;
				font-size: 0.82rem;
				font-weight: 700;
				letter-spacing: 0.04em;
				text-transform: uppercase;
			}

			.privacy-title {
				margin: 1rem 0 0.8rem;
				font-size: clamp(2rem, 5vw, 4rem);
				line-height: 1.05;
				color: #fff;
			}

			.privacy-lead {
				max-width: 52rem;
				margin: 0;
				font-size: clamp(1rem, 1.3vw, 1.18rem);
				line-height: 1.7;
				color: var(--privacy-muted);
			}

			.privacy-statement {
				margin-top: 1.5rem;
				padding: 1.15rem 1.2rem;
				border-radius: 18px;
				border: 1px solid rgba(16, 185, 129, 0.25);
				background: rgba(16, 185, 129, 0.1);
				color: #effef7;
			}

			.privacy-statement strong {
				color: #fff;
			}

			.privacy-facts {
				display: grid;
				grid-template-columns: repeat(3, minmax(0, 1fr));
				gap: 1rem;
				margin-top: 1.5rem;
			}

			.privacy-fact {
				padding: 1rem 1.05rem;
				border-radius: 20px;
				border: 1px solid var(--privacy-border);
				background: var(--privacy-bg);
			}

			.privacy-fact__value {
				display: block;
				font-size: 1.7rem;
				font-weight: 800;
				line-height: 1;
				color: #fff;
			}

			.privacy-fact__label {
				display: block;
				margin-top: 0.45rem;
				font-size: 0.92rem;
				line-height: 1.5;
				color: var(--privacy-muted);
			}

			.privacy-actions {
				display: flex;
				flex-wrap: wrap;
				gap: 0.85rem;
				margin-top: 1.5rem;
			}

			.privacy-button {
				display: inline-flex;
				align-items: center;
				justify-content: center;
				padding: 0.9rem 1.15rem;
				border-radius: 999px;
				border: 1px solid var(--privacy-border);
				background: var(--privacy-bg);
				color: #fff;
				font-weight: 700;
				text-decoration: none;
				transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
			}

			.privacy-button:hover,
			.privacy-button:focus-visible {
				transform: translateY(-1px);
				border-color: rgba(255, 138, 0, 0.35);
				background: var(--privacy-bg-strong);
			}

			.privacy-button--primary {
				background: linear-gradient(135deg, rgba(255, 138, 0, 0.95), rgba(214, 112, 0, 0.95));
				border-color: rgba(255, 138, 0, 0.45);
				color: #0b0b0b;
			}

			.privacy-grid {
				display: grid;
				grid-template-columns: minmax(0, 0.95fr) minmax(0, 1.45fr);
				gap: 1.4rem;
				margin-top: 1.4rem;
			}

			.privacy-card,
			.privacy-section {
				border: 1px solid var(--privacy-border);
				border-radius: 24px;
				background: var(--privacy-bg);
				backdrop-filter: blur(10px);
			}

			.privacy-card {
				padding: 1.3rem;
				position: sticky;
				top: 1.5rem;
				height: fit-content;
			}

			.privacy-card h2,
			.privacy-section h2 {
				margin: 0 0 0.85rem;
				font-size: 1.15rem;
				line-height: 1.3;
				color: #fff;
			}

			.privacy-card p,
			.privacy-card li,
			.privacy-section p,
			.privacy-section li {
				color: var(--privacy-muted);
				line-height: 1.7;
			}

			.privacy-card ul,
			.privacy-section ul {
				margin: 0.8rem 0 0;
				padding-left: 1.15rem;
			}

			.privacy-sections {
				display: grid;
				gap: 1rem;
			}

			.privacy-section {
				padding: 1.35rem;
			}

			.privacy-section h3 {
				margin: 1.1rem 0 0.5rem;
				font-size: 1rem;
				color: #fff;
			}

			.privacy-section a,
			.privacy-card a {
				color: #ffd39e;
				text-underline-offset: 0.18em;
			}

			.privacy-note {
				margin-top: 0.9rem;
				padding: 0.95rem 1rem;
				border-radius: 16px;
				background: var(--privacy-accent-soft);
				border: 1px solid rgba(255, 138, 0, 0.2);
			}

			.privacy-meta {
				display: grid;
				gap: 0.75rem;
				margin-top: 1rem;
			}

			.privacy-meta__item {
				padding: 0.95rem 1rem;
				border-radius: 16px;
				background: rgba(255, 255, 255, 0.03);
				border: 1px solid rgba(255, 255, 255, 0.08);
			}

			.privacy-meta__label {
				display: block;
				margin-bottom: 0.28rem;
				font-size: 0.78rem;
				font-weight: 700;
				letter-spacing: 0.04em;
				text-transform: uppercase;
				color: #ffd39e;
			}

			.privacy-meta__value {
				display: block;
				color: #fff;
				line-height: 1.55;
			}

			@media (max-width: 920px) {
				.privacy-facts,
				.privacy-grid {
					grid-template-columns: 1fr;
				}

				.privacy-card {
					position: static;
				}
			}
		</style>

		<div class="privacy-shell">
			<section class="privacy-hero" aria-labelledby="privacy-title">
				<span class="privacy-kicker">Datenschutz</span>
				<h1 id="privacy-title" class="privacy-title">Keine Cookies. Kein GTM. Kein Banner-Theater.</h1>
				<p class="privacy-lead">
					Diese oeffentlich zugaengliche Website setzt bei normalen Besuchen aktuell keine Cookies,
					laedt keine Analyse- oder Marketing-Tracker und verwendet kein Google Tag Manager.
					Wenn Sie nur lesen und navigieren, bleibt Ihr Browser fuer Tracking-Zwecke unangetastet.
				</p>

				<div class="privacy-statement">
					<strong>Darum sehen Sie keinen Cookie-Banner:</strong>
					Fuer oeffentliche Besuche werden derzeit keine einwilligungspflichtigen Tracking-
					oder Marketing-Technologien eingesetzt.
				</div>

				<div class="privacy-facts" aria-label="Datenschutz-Kurzueberblick">
					<div class="privacy-fact">
						<span class="privacy-fact__value">0</span>
						<span class="privacy-fact__label">Cookies fuer oeffentliche Besuche</span>
					</div>
					<div class="privacy-fact">
						<span class="privacy-fact__value">0</span>
						<span class="privacy-fact__label">Analytics-, Ads- oder GTM-Skripte beim Seitenaufruf</span>
					</div>
					<div class="privacy-fact">
						<span class="privacy-fact__value">Nur aktiv</span>
						<span class="privacy-fact__label">Formulardaten, wenn Sie uns selbst etwas senden</span>
					</div>
				</div>

				<div class="privacy-actions">
					<a class="privacy-button privacy-button--primary" href="<?php echo esc_url( $imprint_url ); ?>">Zum Impressum</a>
					<a class="privacy-button" href="<?php echo esc_url( $rights_url ); ?>">Ihre Rechte</a>
					<a class="privacy-button" href="<?php echo esc_url( $contact_url ); ?>">Kontakt</a>
				</div>
			</section>

			<div class="privacy-grid">
				<aside class="privacy-card" aria-labelledby="privacy-overview">
					<h2 id="privacy-overview">Kurzueberblick</h2>
					<p>
						Die Seite ist bewusst schlank aufgebaut. Es gibt aktuell keine oeffentlichen
						Tracking-Cookies, keine Consent-Plattform, kein GTM, kein Google Analytics
						und keine Marketing-Pixel.
					</p>

					<ul>
						<li>keine Cookies fuer normale Seitenaufrufe</li>
						<li>keine Reichweiten- oder Werbetracker beim Laden der Seite</li>
						<li>keine automatischen Social-Media-Embeds</li>
						<li>keine extern geladenen Webfonts von Google</li>
						<li>personenbezogene Daten nur bei aktiver Kontaktaufnahme</li>
					</ul>

					<div class="privacy-meta" aria-label="Verantwortlicher und Stand">
						<div class="privacy-meta__item">
							<span class="privacy-meta__label">Verantwortlicher</span>
							<span class="privacy-meta__value">
								Hasim Uener<br>
								Warschauer Str. 5<br>
								30982 Pattensen<br>
								Deutschland
							</span>
						</div>
						<div class="privacy-meta__item">
							<span class="privacy-meta__label">Kontakt</span>
							<span class="privacy-meta__value">
								E-Mail: <a href="mailto:kontakt@hasimuener.de">kontakt@hasimuener.de</a><br>
								Telefon: <a href="tel:+4917681407134">0176 81407134</a>
							</span>
						</div>
						<div class="privacy-meta__item">
							<span class="privacy-meta__label">Stand</span>
							<span class="privacy-meta__value"><time datetime="2026-03-09">9. Maerz 2026</time></span>
						</div>
					</div>
				</aside>

				<div class="privacy-sections">
					<section class="privacy-section" aria-labelledby="privacy-controller">
						<h2 id="privacy-controller">1. Verantwortlicher</h2>
						<p>
							Verantwortlich fuer die Datenverarbeitung auf dieser Website ist Hasim Uener,
							Warschauer Str. 5, 30982 Pattensen, Deutschland.
							Die vollstaendigen Anbieterangaben finden Sie im
							<a href="<?php echo esc_url( $imprint_url ); ?>">Impressum</a>.
						</p>
					</section>

					<section class="privacy-section" aria-labelledby="privacy-cookies">
						<h2 id="privacy-cookies">2. Cookies, Tracking und Browser-Speicher</h2>
						<p>
							Bei der rein informatorischen Nutzung dieser oeffentlich zugaenglichen Website
							setzen wir aktuell keine Cookies. Ebenso werden beim normalen Seitenaufruf
							keine Analyse-, Remarketing- oder Marketing-Skripte geladen.
						</p>
						<ul>
							<li>kein Google Tag Manager</li>
							<li>kein Google Analytics</li>
							<li>kein Google Ads Conversion Tracking</li>
							<li>keine Retargeting-Pixel</li>
							<li>keine persistente Browser-Speicherung fuer Tracking- oder Komfortzwecke</li>
							<li>kein Cookie-Banner fuer oeffentliche Besuche erforderlich</li>
						</ul>
						<div class="privacy-note">
							Diese Aussage bezieht sich auf die oeffentliche Nutzung der Website. Technisch
							notwendige WordPress-Cookies koennen nur im geschuetzten Administrationsbereich
							fuer eingeloggte Nutzer entstehen.
						</div>
					</section>

					<section class="privacy-section" aria-labelledby="privacy-logs">
						<h2 id="privacy-logs">3. Hosting und Server-Logfiles</h2>
						<p>
							Beim Aufruf der Website verarbeitet der Hosting-Dienstleister technisch
							erforderliche Verbindungsdaten, damit die Seite ausgeliefert und vor Missbrauch
							geschuetzt werden kann. Dazu koennen insbesondere IP-Adresse, Datum und Uhrzeit,
							angeforderte URL, Referrer, Browsertyp und Betriebssystem gehoeren.
						</p>
						<p>
							Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO.
							Das berechtigte Interesse liegt in der sicheren, stabilen und performanten
							Bereitstellung der Website. Die konkrete Speicherdauer richtet sich nach dem
							jeweiligen Hosting- und Sicherheits-Setup.
						</p>
					</section>

					<section class="privacy-section" aria-labelledby="privacy-contact">
						<h2 id="privacy-contact">4. Kontaktaufnahme und Formulare</h2>
						<p>
							Wenn Sie uns per E-Mail kontaktieren oder ein Formular absenden, verarbeiten wir
							die von Ihnen uebermittelten Daten ausschliesslich zur Bearbeitung Ihrer Anfrage.
							Das betrifft insbesondere Kontakt- und Projektangaben, die Sie selbst eingeben.
						</p>

						<h3>Growth-Audit-Anfrage</h3>
						<p>
							Auf der Seite zum Growth Audit koennen Sie eine Anfrage stellen. Dabei werden
							insbesondere Name, geschaeftliche E-Mail-Adresse, Unternehmen, URL der zu
							pruefenden Seite sowie Ihre inhaltlichen Angaben zur Anfrage verarbeitet.
						</p>
						<p>
							Die Daten werden intern im WordPress-Backend gespeichert und fuer die
							Bearbeitung der Anfrage per E-Mail weiterverarbeitet. Rechtsgrundlage ist
							Art. 6 Abs. 1 lit. b DSGVO, soweit es um vorvertragliche Kommunikation geht,
							und im Uebrigen Art. 6 Abs. 1 lit. f DSGVO.
						</p>

						<h3>Missbrauchsschutz</h3>
						<p>
							Bei Formularanfragen kann die IP-Adresse kurzfristig verarbeitet werden, um
							Spam und missbraeuchliche Serienanfragen zu begrenzen. Rechtsgrundlage ist
							Art. 6 Abs. 1 lit. f DSGVO. Das berechtigte Interesse liegt im Schutz der
							Website und der Kommunikationskanaele.
						</p>

						<h3>Speicherdauer</h3>
						<p>
							Anfragedaten speichern wir nur so lange, wie es fuer die Bearbeitung, fuer
							Anschlusskommunikation oder zur Erfuellung gesetzlicher Pflichten erforderlich ist.
						</p>
					</section>

					<section class="privacy-section" aria-labelledby="privacy-links">
						<h2 id="privacy-links">5. Externe Links und Drittseiten</h2>
						<p>
							Diese Website verlinkt an einzelnen Stellen auf externe Angebote, zum Beispiel
							auf Cal.com fuer Terminbuchungen sowie auf Profile bei LinkedIn, Instagram oder
							GitHub. Solche Inhalte werden nicht automatisch eingebettet. Eine Datenuebertragung
							an den jeweiligen Anbieter findet daher regelmaessig erst statt, wenn Sie den
							Link aktiv anklicken.
						</p>
						<p>
							Fuer die Datenverarbeitung auf den verlinkten Drittseiten sind ausschliesslich
							deren Betreiber verantwortlich. Bitte beachten Sie die jeweiligen
							Datenschutzhinweise der Anbieter.
						</p>
					</section>

					<section class="privacy-section" aria-labelledby="privacy-security">
						<h2 id="privacy-security">6. Sicherheit</h2>
						<p>
							Diese Website nutzt eine verschluesselte Verbindung per HTTPS, damit uebermittelte
							Daten waehrend der Uebertragung geschuetzt sind. Vollstaendige Sicherheit kann
							bei Internetkommunikation dennoch nie garantiert werden.
						</p>
					</section>

					<section class="privacy-section" id="rechte" aria-labelledby="privacy-rights">
						<h2 id="privacy-rights">7. Ihre Rechte</h2>
						<p>
							Sie haben nach Massgabe der DSGVO insbesondere folgende Rechte:
						</p>
						<ul>
							<li>Auskunft ueber die verarbeiteten personenbezogenen Daten</li>
							<li>Berichtigung unrichtiger Daten</li>
							<li>Loeschung, soweit keine gesetzlichen Pflichten entgegenstehen</li>
							<li>Einschraenkung der Verarbeitung</li>
							<li>Widerspruch gegen Verarbeitungen auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO</li>
							<li>Datenuebertragbarkeit, soweit anwendbar</li>
							<li>Beschwerde bei einer Datenschutz-Aufsichtsbehoerde</li>
						</ul>
						<p>
							Zustaendig ist insbesondere die Aufsichtsbehoerde Ihres ueblichen Aufenthaltsorts
							oder die fuer Niedersachsen zustaendige Datenschutzaufsicht.
						</p>
					</section>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
