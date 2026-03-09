<?php
/**
 * Versioned review landing page shell.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_url = nexus_get_page_url( [ 'case-studies' ], home_url( '/case-studies/' ) );
$wgos_url  = nexus_get_page_url(
	[ 'wordpress-growth-operating-system', 'wgos' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$about_url = nexus_get_page_url( [ 'uber-mich' ], home_url( '/uber-mich/' ) );
$call_url  = apply_filters( 'nexus_review_calendar_url', 'https://cal.com/hasim/30min' );
?>

<div class="audit-wrapper" id="audit-main-wrapper">
	<nav class="smart-nav" aria-label="Seiten-Navigation">
		<ul>
			<li><a href="#start" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
			<li><a href="#form" title="Formular"><div class="nav-dot"></div><span class="nav-text">Formular</span></a></li>
			<li><a href="#journey" title="Ablauf"><div class="nav-dot"></div><span class="nav-text">Ablauf</span></a></li>
			<li><a href="#preview" title="Ergebnis"><div class="nav-dot"></div><span class="nav-text">Ergebnis</span></a></li>
			<li><a href="#vorteile" title="Vorteile"><div class="nav-dot"></div><span class="nav-text">Vorteile</span></a></li>
			<li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
		</ul>
	</nav>

	<div class="audit-container">
		<main class="audit-content">
			<section id="start" class="audit-hero-centered audit-section nx-reveal">
				<div class="hero-pill">Persoenlich - 48h - 5 kurze Fragen</div>
				<h1>
					Kein Tool-Audit.<br>
					<span class="text-highlight">Ein persoenlicher Startseiten-Review.</span>
				</h1>
				<p class="hero-sub-short">
					Sie beantworten fuenf kurze Fragen. Ich schaue mir die Seite persoenlich an
					und sende Ihnen innerhalb von 48 Stunden die drei wichtigsten Anfragebremsen
					plus die sinnvollste Prioritaet.
				</p>

				<div class="review-kpi-strip" aria-label="Review-Ueberblick">
					<div class="review-kpi">
						<strong>1 Seite</strong>
						<span>Startseite oder kaufnahe Angebotsseite.</span>
					</div>
					<div class="review-kpi">
						<strong>Persoenliche Rueckmeldung</strong>
						<span>Kein automatischer Score. Kein PDF von der Stange.</span>
					</div>
					<div class="review-kpi">
						<strong>48 Stunden</strong>
						<span>Sie erhalten eine klare Priorisierung statt Tool-Rauschen.</span>
					</div>
				</div>
			</section>

			<section id="form" class="audit-section nx-reveal">
				<div class="black-box black-box--centered review-box">
					<div class="review-form-layout">
						<div class="review-form-main">
							<div class="box-head">
								<h3>Startseiten-Review anfordern</h3>
								<p>Der Fokus liegt auf Botschaft, Proof, Anfragefuehrung und dem ersten Eindruck der Seite.</p>
							</div>

							<form id="review-request-form" class="review-funnel" novalidate>
								<input type="hidden" name="company_website" value="">
								<input type="hidden" name="started_at" value="">

								<div class="review-progress" aria-hidden="true">
									<div class="review-progress-track">
										<div class="review-progress-fill" id="review-progress-fill"></div>
									</div>
									<ol class="review-progress-steps">
										<li class="is-active">Seite</li>
										<li>Ziel</li>
										<li>Zielgruppe</li>
										<li>Problem</li>
										<li>Kontakt</li>
									</ol>
								</div>

								<div class="review-step is-active" data-step="0">
									<span class="review-step-kicker">Schritt 1 von 5</span>
									<h4>Welche Seite soll ich pruefen?</h4>
									<p class="review-step-copy">Am staerksten wirkt das fuer Startseiten oder kaufnahe Angebotsseiten.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://ihre-seite.de" required autocomplete="url">
									</div>
								</div>

								<div class="review-step" data-step="1">
									<span class="review-step-kicker">Schritt 2 von 5</span>
									<h4>Was soll diese Seite konkret verkaufen oder ausloesen?</h4>
									<p class="review-step-copy">Je klarer dieses Ziel ist, desto schaerfer wird die Rueckmeldung.</p>
									<div class="review-field">
										<label for="review-offer">Seitenziel</label>
										<textarea id="review-offer" name="offer" rows="4" placeholder="Zum Beispiel: qualifizierte Erstgespraeche fuer unser B2B-Angebot." required></textarea>
									</div>
								</div>

								<div class="review-step" data-step="2">
									<span class="review-step-kicker">Schritt 3 von 5</span>
									<h4>Wen soll die Seite ueberzeugen?</h4>
									<p class="review-step-copy">Ich bewerte die Seite immer gegen die konkrete Zielgruppe, nicht abstrakt.</p>
									<div class="review-field">
										<label for="review-audience">Zielgruppe</label>
										<textarea id="review-audience" name="audience" rows="4" placeholder="Zum Beispiel: B2B-Marketing-Leiter in mittelstaendischen Industrieunternehmen." required></textarea>
									</div>
								</div>

								<div class="review-step" data-step="3">
									<span class="review-step-kicker">Schritt 4 von 5</span>
									<h4>Wo vermuten Sie gerade den groessten Blocker?</h4>
									<p class="review-step-copy">Das ersetzt keine Diagnose, hilft mir aber, die Rueckmeldung spitzer zu machen.</p>
									<div class="review-option-group" role="radiogroup" aria-labelledby="review-issue-heading">
										<span id="review-issue-heading" class="screen-reader-text">Groesster Blocker</span>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="too_few_inquiries" required>
											<span>Zu wenig qualifizierte Anfragen</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="weak_message" required>
											<span>Das Seitenversprechen ist zu unscharf</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="weak_conversion" required>
											<span>Die Seite fuehrt nicht sauber zur Anfrage</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="second_opinion" required>
											<span>Ich will eine zweite strategische Meinung</span>
										</label>
									</div>
								</div>

								<div class="review-step" data-step="4">
									<span class="review-step-kicker">Schritt 5 von 5</span>
									<h4>Wohin soll die Rueckmeldung gehen?</h4>
									<p class="review-step-copy">Sie erhalten die Einschaetzung innerhalb von 48 Stunden an diese Adresse.</p>
									<div class="review-field-grid">
										<div class="review-field">
											<label for="review-name">Name</label>
											<input id="review-name" name="name" type="text" required autocomplete="name">
										</div>
										<div class="review-field">
											<label for="review-company">Unternehmen</label>
											<input id="review-company" name="company" type="text" required autocomplete="organization">
										</div>
										<div class="review-field review-field-full">
											<label for="review-email">Geschaeftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
										<div class="review-field review-field-full">
											<label for="review-context">Optional: Was sollte ich im Review auf keinen Fall uebersehen?</label>
											<textarea id="review-context" name="extra_context" rows="4" placeholder="Zum Beispiel: Die Seite soll bereits naechste Woche in eine Kampagne gehen."></textarea>
										</div>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
									<button type="button" class="review-prev-btn" data-review-prev hidden>Zurueck</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Review anfordern</button>
								</div>

								<p class="audit-form-meta">
									Keine automatisierte Sofortdiagnose. Stattdessen eine persoenliche Einschaetzung mit klarer Priorisierung.
								</p>
							</form>

							<div id="review-request-success" class="review-success" hidden>
								<div class="review-success-pill">Anfrage eingegangen</div>
								<h3>Der Review ist jetzt im System.</h3>
								<p class="review-success-copy">
									Sie erhalten innerhalb von 48 Stunden eine persoenliche Rueckmeldung zu
									<span id="review-success-url"></span>.
								</p>
								<div class="review-success-grid">
									<div class="review-success-card">
										<strong>3 wichtigste Bremsen</strong>
										<span>Keine Vollanalyse, sondern die Punkte mit der groessten Hebelwirkung.</span>
									</div>
									<div class="review-success-card">
										<strong>1 klare Prioritaet</strong>
										<span>Was zuerst Wirkung bringt und was bewusst warten kann.</span>
									</div>
									<div class="review-success-card">
										<strong>Persoenliche Einschaetzung</strong>
										<span>Kein Tool-Score, sondern eine verstaendliche strategische Rueckmeldung.</span>
									</div>
								</div>
								<div class="review-success-actions">
									<a class="audit-submit-btn review-success-link" href="<?php echo esc_url( $call_url ); ?>" target="_blank" rel="noopener">Wenn es dringend ist: Direkt Termin buchen</a>
								</div>
							</div>
						</div>

						<aside class="review-form-aside">
							<div class="review-aside-card">
								<span class="review-aside-kicker">Sie erhalten</span>
								<h4>Eine Rueckmeldung, die wie Beratung klingt. Nicht wie ein Tool.</h4>
								<ul class="review-aside-list">
									<li>Was auf der Seite am staerksten bremst</li>
									<li>Warum genau diese Stelle Conversion kostet</li>
									<li>Was zuerst angepasst werden sollte</li>
								</ul>
							</div>
							<div class="review-aside-card review-aside-card-muted">
								<span class="review-aside-kicker">Wichtig</span>
								<p>Der Review ist bewusst eng gefasst: eine Seite, ein klares Ziel, eine priorisierte Einschaetzung.</p>
							</div>
						</aside>
					</div>

					<div class="trust-strip">
						<div class="trust-item">
							<div class="trust-ic">✓</div>
							<div><strong>Persoenlich statt automatisch.</strong> Ich schaue mir die Seite selbst an.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">⏱</div>
							<div><strong>Rueckmeldung in 48 Stunden.</strong> Kein Warten auf ein grosses Audit-Projekt.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">🧭</div>
							<div><strong>Klare Priorisierung.</strong> Nicht alles. Sondern das, was zuerst Wirkung bringt.</div>
						</div>
					</div>
				</div>
			</section>

			<section id="journey" class="journey-preview audit-section nx-reveal">
				<h2 class="journey-headline">So laeuft der Review ab</h2>
				<p class="journey-subline">
					Der Funnel qualifiziert die Anfrage. Die eigentliche Diagnose kommt bewusst als persoenliche Rueckmeldung.
				</p>
				<div class="journey-steps-preview">
					<div class="journey-step-preview">
						<div class="step-marker">1</div>
						<div class="step-content">
							<h4>Sie schicken die Seite und den Kontext</h4>
							<p>Fuenf kurze Fragen reichen, damit die Analyse nicht im luftleeren Raum landet.</p>
						</div>
					</div>
					<div class="journey-step-preview">
						<div class="step-marker">2</div>
						<div class="step-content">
							<h4>Ich pruefe die Seite persoenlich</h4>
							<p>Mit Fokus auf Botschaft, Proof, Anfragefuehrung und ersten Eindruck der Seite.</p>
						</div>
					</div>
					<div class="journey-step-preview">
						<div class="step-marker">3</div>
						<div class="step-content">
							<h4>Sie erhalten eine priorisierte Rueckmeldung</h4>
							<p>Kein Punktesalat, sondern die Hebel, die jetzt am ehesten Anfragen wahrscheinlicher machen.</p>
						</div>
					</div>
				</div>
			</section>

			<section id="preview" class="report-preview-section audit-section nx-reveal">
				<div class="preview-text">
					<span class="preview-kicker">Was Sie bekommen</span>
					<h2>Keine XXL-Analyse.<br>Eine klare Entscheidungsgrundlage.</h2>
					<p class="preview-desc">
						Der Review ist dafuer da, schneller bessere Entscheidungen an der Seite zu treffen.
						Nicht dafuer, moeglichst viele Buzzwords in ein PDF zu packen.
					</p>
					<ul>
						<li><strong>Die 3 groessten Bremsen:</strong> Wo die Seite gerade Nachfrage verliert.</li>
						<li><strong>Die staerkste Prioritaet:</strong> Was zuerst bearbeitet werden sollte.</li>
						<li><strong>Die Begruendung:</strong> Warum genau diese Stelle Conversion oder Vertrauen kostet.</li>
						<li><strong>Der naechste Schritt:</strong> Ob eine kleine Korrektur reicht oder ein groesserer Umbau sinnvoll ist.</li>
					</ul>
				</div>
				<div class="preview-visual">
					<div class="review-output-card">
						<span class="review-output-kicker">Beispielhafte Struktur</span>
						<div class="review-output-row">
							<strong>Hebel #1</strong>
							<span>Seitenversprechen zu allgemein</span>
						</div>
						<div class="review-output-row">
							<strong>Hebel #2</strong>
							<span>Proof zu spaet oder zu duenn</span>
						</div>
						<div class="review-output-row">
							<strong>Hebel #3</strong>
							<span>CTA nicht klar genug priorisiert</span>
						</div>
						<div class="review-output-note">Dazu kommt die Einordnung, welcher Hebel zuerst Wirkung bringt.</div>
					</div>
				</div>
			</section>

			<section id="vorteile" class="audit-usp-section audit-section nx-reveal">
				<h2 class="audit-usp-headline">Warum dieser Funnel strategisch staerker ist</h2>
				<div class="usp-grid">
					<div class="usp-card">
						<span class="usp-icon">🧠</span>
						<div class="usp-title">Expertise statt Tool-Effekt</div>
						<div class="usp-text">Sie verkaufen Beratung, nicht den naechsten kostenlosen Analyse-Bot.</div>
					</div>
					<div class="usp-card">
						<span class="usp-icon">🎯</span>
						<div class="usp-title">Bessere Qualifizierung</div>
						<div class="usp-text">Das Formular sammelt bereits Ziel, Zielgruppe und wahrgenommenen Blocker.</div>
					</div>
					<div class="usp-card">
						<span class="usp-icon">🤝</span>
						<div class="usp-title">Natuerlicher Sales-Uebergang</div>
						<div class="usp-text">Die Rueckmeldung fuehrt logisch in ein Gespraech, ohne nach Leadmagnet-Kette zu wirken.</div>
					</div>
				</div>
			</section>

			<section id="faq" class="audit-faq-section audit-section nx-reveal">
				<h2 class="audit-faq-headline">Haeufige Fragen</h2>
				<details>
					<summary>Was genau bekomme ich innerhalb von 48 Stunden?</summary>
					<div class="faq-ans">Eine persoenliche Einschaetzung mit den drei wichtigsten Anfragebremsen, einer klaren Prioritaet und einer Empfehlung fuer den naechsten Schritt.</div>
				</details>
				<details>
					<summary>Ist das nur fuer Startseiten gedacht?</summary>
					<div class="faq-ans">Am besten funktioniert es fuer Startseiten und kaufnahe Angebotsseiten. Also fuer Seiten, auf denen aus Aufmerksamkeit moeglichst schnell Vertrauen und Kontakt werden sollen.</div>
				</details>
				<details>
					<summary>Muss ich danach einen Call buchen?</summary>
					<div class="faq-ans">Nein. Wenn die Rueckmeldung fuer Sie schon genug Klarheit schafft, ist das in Ordnung. Ein Gespraech ist nur der logische naechste Schritt, wenn Sie die Prioritaet direkt gemeinsam besprechen wollen.</div>
				</details>
				<details>
					<summary>Warum kein automatischer Sofort-Audit?</summary>
					<div class="faq-ans">Weil ein Tool aus einer einzelnen URL schnell zu viel behauptet. Diese Variante ist enger, glaubwuerdiger und naeher an echter Beratung.</div>
				</details>
			</section>

			<div class="audit-link-cluster">
				<a href="<?php echo esc_url( $cases_url ); ?>">Case Studies -&gt;</a>
				<a href="<?php echo esc_url( $wgos_url ); ?>">WGOS als System -&gt;</a>
				<a href="<?php echo esc_url( $about_url ); ?>">Mehr ueber den Ansatz -&gt;</a>
			</div>
		</main>
	</div>
</div>
