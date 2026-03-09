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
			<li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
		</ul>
	</nav>

	<div class="audit-container">
			<main class="audit-content">
				<section id="start" class="audit-hero-centered audit-section nx-reveal">
					<div class="hero-pill">Persönlich - 48h - 5 Fragen</div>
					<h1>
						Kein Tool-Audit.<br>
						<span class="text-highlight">Ein persönlicher Startseiten-Review.</span>
					</h1>
					<p class="hero-sub-short">
						Fünf kurze Antworten genügen. Sie erhalten innerhalb von 48 Stunden
						die drei stärksten Bremsen plus die nächste sinnvolle Priorität.
					</p>

					<div class="review-kpi-strip" aria-label="Review-Überblick">
						<div class="review-kpi">
							<strong>1 Seite</strong>
							<span>Startseite oder Sales-Page.</span>
						</div>
						<div class="review-kpi">
							<strong>Persönlich</strong>
							<span>Keine Tool-Ausgabe von der Stange.</span>
						</div>
						<div class="review-kpi">
							<strong>48 Stunden</strong>
							<span>Klare Priorität statt Score-Rauschen.</span>
						</div>
					</div>
				</section>

			<section id="form" class="audit-section nx-reveal">
				<div class="black-box black-box--centered review-box">
						<div class="review-form-layout">
							<div class="review-form-main">
								<div class="box-head">
									<h3>Startseiten-Review anfordern</h3>
									<p>Ich prüfe Botschaft, Proof und Anfrageführung.</p>
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
									<h4>Welche Seite soll ich prüfen?</h4>
									<p class="review-step-copy">Am besten Startseite oder kaufnahe Angebotsseite.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://ihre-seite.de" required autocomplete="url">
									</div>
								</div>

								<div class="review-step" data-step="1">
									<span class="review-step-kicker">Schritt 2 von 5</span>
										<h4>Was soll diese Seite konkret verkaufen oder auslösen?</h4>
									<p class="review-step-copy">Ein klarer Satz reicht.</p>
									<div class="review-field">
										<label for="review-offer">Seitenziel</label>
											<textarea id="review-offer" name="offer" rows="4" placeholder="Zum Beispiel: qualifizierte Erstgespräche für unser B2B-Angebot." required></textarea>
									</div>
								</div>

								<div class="review-step" data-step="2">
									<span class="review-step-kicker">Schritt 3 von 5</span>
									<h4>Wen soll die Seite überzeugen?</h4>
									<p class="review-step-copy">Kurz und konkret reicht vollkommen.</p>
									<div class="review-field">
										<label for="review-audience">Zielgruppe</label>
										<textarea id="review-audience" name="audience" rows="4" placeholder="Zum Beispiel: B2B-Marketing-Leiter in mittelständischen Industrieunternehmen." required></textarea>
									</div>
								</div>

								<div class="review-step" data-step="3">
									<span class="review-step-kicker">Schritt 4 von 5</span>
									<h4>Wo vermuten Sie gerade den größten Blocker?</h4>
									<p class="review-step-copy">Ihr Eindruck hilft bei der Einordnung.</p>
									<div class="review-option-group" role="radiogroup" aria-labelledby="review-issue-heading">
										<span id="review-issue-heading" class="screen-reader-text">Größter Blocker</span>
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
												<span>Die Seite führt nicht sauber zur Anfrage</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="second_opinion" required>
											<span>Ich will eine zweite strategische Meinung</span>
										</label>
									</div>
								</div>

								<div class="review-step" data-step="4">
									<span class="review-step-kicker">Schritt 5 von 5</span>
									<h4>Wohin soll die Rückmeldung gehen?</h4>
									<p class="review-step-copy">Dorthin geht die Rückmeldung innerhalb von 48 Stunden.</p>
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
											<label for="review-email">Geschäftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
										<div class="review-field review-field-full">
											<label for="review-context">Optional: Was sollte ich im Review auf keinen Fall übersehen?</label>
											<textarea id="review-context" name="extra_context" rows="4" placeholder="Zum Beispiel: Die Seite soll bereits nächste Woche in eine Kampagne gehen."></textarea>
										</div>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
										<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Review anfordern</button>
								</div>

								<p class="audit-form-meta">
									Keine Sofortdiagnose. Eine persönliche Einschätzung mit klarer Priorisierung.
								</p>
							</form>

							<div id="review-request-success" class="review-success" hidden>
								<div class="review-success-pill">Anfrage eingegangen</div>
								<h3>Der Review ist jetzt im System.</h3>
								<p class="review-success-copy">
									Sie erhalten innerhalb von 48 Stunden eine persönliche Rückmeldung zu
									<span id="review-success-url"></span>.
								</p>
								<div class="review-success-grid">
									<div class="review-success-card">
										<strong>3 wichtigste Bremsen</strong>
										<span>Keine Vollanalyse, sondern die Punkte mit der größten Hebelwirkung.</span>
									</div>
									<div class="review-success-card">
										<strong>1 klare Priorität</strong>
										<span>Was zuerst Wirkung bringt und was bewusst warten kann.</span>
									</div>
									<div class="review-success-card">
										<strong>Persönliche Einschätzung</strong>
										<span>Kein Tool-Score, sondern eine verständliche strategische Rückmeldung.</span>
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
								<h4>Kurz. Klar. Priorisiert.</h4>
								<ul class="review-aside-list">
									<li>Die 3 stärksten Bremsen</li>
									<li>Die wichtigste Priorität</li>
									<li>Eine klare Begründung</li>
								</ul>
							</div>
							<div class="review-aside-card review-aside-card-muted">
								<span class="review-aside-kicker">Wichtig</span>
								<p>Bewusst eng gefasst: eine Seite, ein Ziel, eine Priorität.</p>
							</div>
						</aside>
					</div>

					<div class="trust-strip">
						<div class="trust-item">
							<div class="trust-ic">01</div>
							<div><strong>Persönlich.</strong> Keine Bot-Ausgabe.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">02</div>
							<div><strong>48 Stunden.</strong> Kein langes Audit-Projekt.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">03</div>
							<div><strong>Klare Priorität.</strong> Erst der stärkste Hebel.</div>
						</div>
					</div>
				</div>
			</section>

			<section id="journey" class="journey-preview audit-section nx-reveal">
				<h2 class="journey-headline">So läuft der Review ab</h2>
				<p class="journey-subline">
					Drei Schritte. Keine Analyse-Show.
				</p>
				<div class="journey-steps-preview">
					<div class="journey-step-preview">
						<div class="step-marker">1</div>
						<div class="step-content">
							<h4>Sie schicken die Seite und den Kontext</h4>
							<p>Fünf kurze Antworten reichen.</p>
						</div>
					</div>
					<div class="journey-step-preview">
						<div class="step-marker">2</div>
						<div class="step-content">
							<h4>Ich prüfe die Seite persönlich</h4>
							<p>Mit Fokus auf Botschaft, Proof und Anfrageführung.</p>
						</div>
					</div>
					<div class="journey-step-preview">
						<div class="step-marker">3</div>
						<div class="step-content">
							<h4>Sie erhalten eine priorisierte Rückmeldung</h4>
							<p>Drei Bremsen. Eine Priorität. Ein nächster Schritt.</p>
						</div>
					</div>
				</div>
			</section>

			<section id="preview" class="report-preview-section audit-section nx-reveal">
				<div class="preview-text">
					<span class="preview-kicker">Was Sie bekommen</span>
					<h2>Keine Textwand.<br>Eine klare Entscheidungsgrundlage.</h2>
					<p class="preview-desc">
						Kompakt genug für schnelle Entscheidungen. Konkret genug für die nächste Maßnahme.
					</p>
					<div class="preview-deliverables" aria-label="Review-Inhalte">
						<div class="preview-deliverable">
							<strong>3 Bremsen</strong>
							<span>Wo die Seite gerade verliert.</span>
						</div>
						<div class="preview-deliverable">
							<strong>1 Priorität</strong>
							<span>Was zuerst Wirkung bringt.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Begründung</strong>
							<span>Warum genau dieser Hebel zählt.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Nächster Schritt</strong>
							<span>Kleine Korrektur oder größerer Umbau.</span>
						</div>
					</div>
				</div>
				<div class="preview-visual">
					<div class="review-output-card">
						<span class="review-output-kicker">Beispiel</span>
						<div class="review-output-row">
							<strong>Größte Bremse</strong>
							<span>Das Seitenversprechen bleibt zu allgemein.</span>
						</div>
						<div class="review-output-row">
							<strong>Zuerst anpassen</strong>
							<span>Hero und CTA vor dem restlichen Seitenumbau schärfen.</span>
						</div>
						<div class="review-output-note">Danach lässt sich Proof gezielt nach oben ziehen.</div>
					</div>
				</div>
			</section>

			<section id="faq" class="audit-faq-section audit-section nx-reveal">
				<h2 class="audit-faq-headline">Häufige Fragen</h2>
				<details>
					<summary>Was genau bekomme ich innerhalb von 48 Stunden?</summary>
					<div class="faq-ans">Drei wichtigste Bremsen, eine klare Priorität und ein sinnvoller nächster Schritt.</div>
				</details>
				<details>
					<summary>Ist das nur für Startseiten gedacht?</summary>
					<div class="faq-ans">Am besten für Startseiten und kaufnahe Angebotsseiten.</div>
				</details>
				<details>
					<summary>Muss ich danach einen Call buchen?</summary>
					<div class="faq-ans">Nein. Ein Call ist nur sinnvoll, wenn Sie den nächsten Schritt direkt besprechen wollen.</div>
				</details>
			</section>

			<div class="audit-link-cluster">
				<a href="<?php echo esc_url( $cases_url ); ?>">Case Studies -&gt;</a>
				<a href="<?php echo esc_url( $wgos_url ); ?>">WGOS als System -&gt;</a>
				<a href="<?php echo esc_url( $about_url ); ?>">Mehr über den Ansatz -&gt;</a>
			</div>
		</main>
	</div>
</div>
