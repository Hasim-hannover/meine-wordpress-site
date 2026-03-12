<?php
/**
 * Versioned growth audit landing page shell.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_url = nexus_get_results_url();
$e3_url    = nexus_get_page_url( [ 'e3-new-energy' ], home_url( '/e3-new-energy/' ) );
?>

<div class="audit-wrapper" id="audit-main-wrapper">
	<nav class="smart-nav" aria-label="Seiten-Navigation">
		<ul>
			<li><a href="#start" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
			<li><a href="#proof" title="Proof"><div class="nav-dot"></div><span class="nav-text">Proof</span></a></li>
			<li><a href="#deliverables" title="Ergebnis"><div class="nav-dot"></div><span class="nav-text">Ergebnis</span></a></li>
			<li><a href="#example" title="Beispiel"><div class="nav-dot"></div><span class="nav-text">Beispiel</span></a></li>
			<li><a href="#form" title="Formular"><div class="nav-dot"></div><span class="nav-text">Formular</span></a></li>
			<li><a href="#quality" title="Warum"><div class="nav-dot"></div><span class="nav-text">Warum</span></a></li>
			<li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
		</ul>
	</nav>

	<div class="audit-container">
		<main class="audit-content">
			<section id="start" class="audit-hero-centered audit-section nx-reveal review-hero-shell">
				<div class="review-hero-layout">
					<div class="review-hero-main">
						<div class="review-hero-kicker">Growth Audit für B2B-WordPress-Seiten</div>
						<h1>Wo Ihre Seite gerade Anfragen ausbremst.</h1>
						<p class="hero-sub-short">
							Ich prüfe Ihre Startseite oder kaufnahe Angebotsseite manuell und KI-unterstützt.
							Sie erhalten innerhalb von 48 Stunden eine präzise Ersteinschätzung mit den 3 stärksten Bremsen,
							der wirtschaftlich wichtigsten Priorität und dem nächsten sinnvollen Schritt.
						</p>

						<div class="audit-hero-proof" aria-label="Trust-Chips">
							<span>0 € Einstieg</span>
							<span>manuell geprüft</span>
							<span>Rückmeldung in 48h</span>
						</div>

						<div class="audit-hero-actions">
							<a class="audit-submit-btn audit-hero-cta-btn" href="#form" data-track-action="cta_hero_growth_audit" data-track-category="lead_gen">Kostenlosen Growth Audit anfragen</a>
						</div>
						<p class="review-hero-microcopy">Eine konkrete Seite reicht. Kein Pflicht-Call.</p>
					</div>

					<aside class="review-offer-panel" aria-label="Leistungsumfang">
						<span class="review-offer-kicker">Sie bekommen zurück</span>
						<h2>Eine erste Priorisierung, die sofort brauchbar ist.</h2>
						<p class="review-offer-copy">
							Kein Tool-Score, kein PDF-Ballast, keine künstlich große Analyse.
							Der Einstieg bleibt bewusst eng, damit die Einordnung konkret bleibt, auch wenn das Urteil gegen direkte Umsetzung spricht.
						</p>

						<div class="review-offer-list">
							<div class="review-offer-item">
								<strong>3 stärkste Bremsen</strong>
								<span>Wo Vertrauen, Klarheit oder Anfrageführung auf der Seite aktuell wegbrechen.</span>
							</div>
							<div class="review-offer-item">
								<strong>1 wirtschaftliche Priorität</strong>
								<span>Welcher Hebel zuerst zählt und warum genau dort begonnen werden sollte.</span>
							</div>
							<div class="review-offer-item">
								<strong>1 nächster Schritt</strong>
								<span>Direkt umsetzbar oder klar benannt, wenn vor jeder Umsetzung zuerst Fundament fehlt.</span>
							</div>
						</div>

						<div class="review-offer-timeline">
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Prüfobjekt</span>
								<strong>1 Startseite oder kaufnahe Angebotsseite in WordPress</strong>
							</div>
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Ablauf</span>
								<strong>Anfrage senden, schriftliche Rückmeldung in 48 Stunden</strong>
							</div>
						</div>
					</aside>
				</div>
			</section>

			<section id="proof" class="review-proof-section audit-section nx-reveal" aria-labelledby="review-proof-headline">
				<div class="review-proof-bar">
					<div class="review-proof-intro">
						<span class="review-section-kicker">Vertrauen vor dem Formular</span>
						<h2 id="review-proof-headline">Zurückhaltend im Auftritt. Präzise in der Prüfung.</h2>
						<p>
							Der Growth Audit soll schnell Klarheit schaffen, nicht Autorität simulieren.
							Deshalb basiert der Einstieg auf wenigen, belastbaren Signalen statt auf Show-off.
						</p>
					</div>
					<div class="review-proof-grid" aria-label="Vertrauenssignale">
						<article class="review-proof-pill">
							<strong>Persönlich geprüft</strong>
							<span>keine automatisierte Standardauswertung</span>
						</article>
						<article class="review-proof-pill">
							<strong>0 € Einstieg</strong>
							<span>kostenloser Erstkontakt ohne Verpflichtung</span>
						</article>
						<article class="review-proof-pill">
							<strong>Kein Pflicht-Call</strong>
							<span>die Rückmeldung kommt zuerst schriftlich</span>
						</article>
						<article class="review-proof-pill">
							<strong>Relevante Kontexte</strong>
							<span>Lead-/B2B-Seiten und E-Commerce-Setups</span>
						</article>
						<article class="review-proof-pill">
							<strong>Öffentlicher B2B-Kontext</strong>
							<span><a class="review-inline-link" href="<?php echo esc_url( $e3_url ); ?>">E3 New Energy ansehen</a></span>
						</article>
					</div>
				</div>
			</section>

			<section id="deliverables" class="review-value-section audit-section nx-reveal" aria-labelledby="review-value-headline">
				<div class="review-section-head">
					<span class="review-section-kicker">Was Sie bekommen</span>
					<h2 id="review-value-headline">Kurz. Priorisiert. Direkt lesbar.</h2>
					<p>Der Audit ist keine Sammlung von Beobachtungen, sondern eine erste wirtschaftliche Einordnung Ihrer Seite, auch wenn die erste Empfehlung lautet: noch nicht direkt umsetzen.</p>
				</div>
				<div class="review-value-grid" aria-label="Audit-Inhalte">
					<article class="review-value-card">
						<strong>die 3 stärksten Anfragebremsen</strong>
						<span>Wo Ihre Seite gerade Relevanz, Vertrauen oder Klarheit verliert.</span>
					</article>
					<article class="review-value-card">
						<strong>die wichtigste Priorität</strong>
						<span>Welcher Hebel zuerst Wirkung verspricht und was bewusst warten kann.</span>
					</article>
					<article class="review-value-card">
						<strong>ein klarer nächster Schritt</strong>
						<span>Was Sie direkt schärfen können, ohne in Aktionismus zu geraten.</span>
					</article>
				</div>
			</section>

			<section id="example" class="report-preview-section audit-section nx-reveal" aria-labelledby="preview-headline">
				<div class="preview-text">
					<span class="preview-kicker">Beispiel einer Rückmeldung</span>
					<h2 id="preview-headline">So konkret fällt die Ersteinschätzung aus.</h2>
					<p class="preview-desc">
						Redigiert und anonymisiert. Ziel ist nicht Vollständigkeit, sondern eine schnelle Priorisierung,
						die vor dem Formular bereits zeigt, wie nutzbar die Rückmeldung später wirklich ist.
					</p>
					<div class="preview-deliverables" aria-label="Merkmale der Rückmeldung">
						<div class="preview-deliverable">
							<strong>klare Problembenennung</strong>
							<span>Die stärkste Bremse wird direkt benannt, nicht in Audit-Sprache verpackt.</span>
						</div>
						<div class="preview-deliverable">
							<strong>kurze Begründung</strong>
							<span>Warum genau diese Stelle Relevanz, Vertrauen oder Anfragebereitschaft bremst.</span>
						</div>
						<div class="preview-deliverable">
							<strong>wirtschaftliche Priorisierung</strong>
							<span>Was zuerst geändert werden sollte, bevor weitere Arbeit Zeit und Budget bindet.</span>
						</div>
						<div class="preview-deliverable">
							<strong>nächster sinnvoller Schritt</strong>
							<span>Kleine Korrektur oder ein größerer Folgeprozess, wenn der Bruch struktureller ist.</span>
						</div>
					</div>
				</div>
				<div class="preview-visual">
					<div class="review-output-card">
						<span class="review-output-kicker">Anonymisiertes Beispiel</span>
						<div class="review-output-row">
							<strong>Stärkste Bremse</strong>
							<span>Der erste Screen macht nicht klar genug, für wen die Seite ist und warum genau diese Anfrage sinnvoll wäre.</span>
						</div>
						<div class="review-output-row">
							<strong>Warum das bremst</strong>
							<span>Relevanz und Vertrauen gehen verloren, bevor Proof, Details oder CTA überhaupt greifen können.</span>
						</div>
						<div class="review-output-row">
							<strong>Wirtschaftlich erste Priorität</strong>
							<span>Hero, Subline und erste CTA-Führung schärfen, bevor weitere Detailoptimierungen Zeit binden.</span>
						</div>
						<div class="review-output-row">
							<strong>Nächster sinnvoller Schritt</strong>
							<span>Den ersten Screen überarbeiten und danach Proof sowie Angebotsseite gegen denselben Fokus nachziehen.</span>
						</div>
						<div class="review-output-note">Wenn danach noch strukturelle Brüche sichtbar bleiben, klären wir den nächsten vertieften Schritt erst im persönlichen Kontakt.</div>
					</div>
				</div>
			</section>

			<section id="form" class="audit-section nx-reveal">
				<div class="black-box black-box--centered review-box">
					<div class="review-form-layout">
						<div class="review-form-main">
							<div class="box-head review-form-frame-head">
								<div>
									<span class="review-form-kicker">Growth Audit anfragen</span>
									<h3>Vier kurze Schritte für eine brauchbare Diagnose.</h3>
									<p>Je konkreter Seite, Reibung und Ziel benannt sind, desto präziser fällt die Rückmeldung aus.</p>
								</div>
								<div class="review-form-eta" aria-label="Formular-Microcopy">
									<span>ca. 2 Minuten</span>
									<span>kein Pflicht-Call</span>
									<span>Rückmeldung in 48h</span>
								</div>
							</div>

							<form id="review-request-form" class="review-funnel" novalidate>
								<input type="hidden" name="company_website" value="">
								<input type="hidden" name="started_at" value="">
								<input type="hidden" name="audit_type" value="growth_audit">

								<div class="review-progress" aria-hidden="true">
									<div class="review-progress-track">
										<div class="review-progress-fill" id="review-progress-fill"></div>
									</div>
									<ol class="review-progress-steps">
										<li class="is-active">Seite</li>
										<li>Priorität</li>
										<li>Kontext</li>
										<li>Kontakt</li>
									</ol>
								</div>

								<div class="review-step is-active" data-step="0">
									<span class="review-step-kicker">Schritt 1 von 4</span>
									<h4>Welche Seite soll ich prüfen?</h4>
									<p class="review-step-copy">Am besten genau die Startseite oder Angebotsseite, die Anfragen tragen soll.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://www.beispiel.de" required autocomplete="url">
										<p class="review-field-help">Bitte nur eine konkrete Seite angeben, nicht die ganze Website.</p>
									</div>
								</div>

								<div class="review-step" data-step="1" data-review-radio-message="Bitte Reibung und Ziel für diese Seite auswählen.">
									<span class="review-step-kicker">Schritt 2 von 4</span>
									<h4>Worauf soll ich zuerst schauen?</h4>
									<p class="review-step-copy">So wird die Rückmeldung nicht nur richtig, sondern auch wirtschaftlich priorisiert.</p>

									<div class="review-choice-stack">
										<fieldset class="review-choice-block">
											<legend>Wo liegt gerade die größte Reibung?</legend>
											<p class="review-choice-help">Nur den Bereich wählen, der aktuell am meisten klärt.</p>
											<div class="review-option-group">
												<label class="review-option">
													<input type="radio" name="focus_area" value="positioning_page_message" required>
													<div class="review-option-copy">
														<strong data-review-label>Positionierung / Seitenbotschaft</strong>
														<span>Wenn nicht schnell klar wird, warum genau diese Seite relevant ist.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="focus_area" value="conversion_inquiry_flow" required>
													<div class="review-option-copy">
														<strong data-review-label>Conversion / Anfrageführung</strong>
														<span>Wenn Besucher nicht sauber zur Anfrage oder Kontaktaufnahme geführt werden.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="focus_area" value="seo_visibility" required>
													<div class="review-option-copy">
														<strong data-review-label>SEO / Sichtbarkeit</strong>
														<span>Wenn zu wenig relevante Besucher auf der Seite ankommen.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="focus_area" value="performance_cwv" required>
													<div class="review-option-copy">
														<strong data-review-label>Performance / Core Web Vitals</strong>
														<span>Wenn Ladezeit, mobile Nutzung oder technische Stabilität spürbar bremsen.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="focus_area" value="tracking_data_quality" required>
													<div class="review-option-copy">
														<strong data-review-label>Tracking / Datenqualität</strong>
														<span>Wenn die Datenlage für saubere Entscheidungen nicht verlässlich genug ist.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="focus_area" value="not_sure_yet" required>
													<div class="review-option-copy">
														<strong data-review-label>Ich bin mir noch nicht sicher</strong>
														<span>Wenn zuerst priorisiert werden soll, wo die stärkste Bremse überhaupt sitzt.</span>
													</div>
												</label>
											</div>
										</fieldset>

										<fieldset class="review-choice-block">
											<legend>Woran würden Sie eine bessere Seite merken?</legend>
											<p class="review-choice-help">Das hilft, den ersten Hebel wirtschaftlich sauber zu sortieren.</p>
											<div class="review-option-group">
												<label class="review-option">
													<input type="radio" name="primary_goal" value="more_qualified_inquiries" required>
													<div class="review-option-copy">
														<strong data-review-label>mehr qualifizierte Anfragen</strong>
														<span>Die Seite soll relevantere Kontakte und bessere Erstgespräche auslösen.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="primary_goal" value="clearer_positioning" required>
													<div class="review-option-copy">
														<strong data-review-label>klarere Positionierung</strong>
														<span>Das Angebot soll schneller verstanden und sauberer eingeordnet werden.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="primary_goal" value="better_user_guidance_conversion" required>
													<div class="review-option-copy">
														<strong data-review-label>bessere Nutzerführung / Conversion</strong>
														<span>Der Weg vom ersten Eindruck bis zur Anfrage soll klarer und leichter werden.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="primary_goal" value="better_google_visibility" required>
													<div class="review-option-copy">
														<strong data-review-label>bessere Sichtbarkeit bei Google</strong>
														<span>Die Seite soll organisch relevanter gefunden und angeklickt werden.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="primary_goal" value="better_technical_quality" required>
													<div class="review-option-copy">
														<strong data-review-label>bessere technische Qualität</strong>
														<span>Performance, Stabilität und Seitenerlebnis sollen belastbarer werden.</span>
													</div>
												</label>
												<label class="review-option">
													<input type="radio" name="primary_goal" value="clearer_decision_data" required>
													<div class="review-option-copy">
														<strong data-review-label>klarere Datenbasis für Entscheidungen</strong>
														<span>Tracking und Messpunkte sollen verlässlicher für Priorisierungen werden.</span>
													</div>
												</label>
											</div>
										</fieldset>
									</div>
								</div>

								<div class="review-step" data-step="2">
									<span class="review-step-kicker">Schritt 3 von 4</span>
									<h4>Welcher Kontext darf nicht fehlen?</h4>
									<p class="review-step-copy">Ein ehrlicher kurzer Absatz reicht. Wenn es etwas gibt, das ich nicht übersehen soll, ergänzen Sie es darunter.</p>
									<div class="review-field">
										<label for="review-current-challenge">Kurzbeschreibung der aktuellen Lage</label>
										<textarea id="review-current-challenge" name="current_challenge" rows="5" placeholder="Zum Beispiel: Wir haben ordentlichen Traffic, aber die Seite löst zu wenig qualifizierte Anfragen aus. Oder: Die Seite wirkt sauber, trägt die Positionierung aber nicht klar genug." required></textarea>
									</div>
									<div class="review-field">
										<label for="review-context">Nicht übersehen (optional)</label>
										<textarea id="review-context" name="extra_context" rows="3" placeholder="Zum Beispiel: neues Angebot, Zielgruppe hat sich verändert, Relaunch steht an, Paid Traffic läuft bereits."></textarea>
									</div>
								</div>

								<div class="review-step" data-step="3">
									<span class="review-step-kicker">Schritt 4 von 4</span>
									<h4>Wohin soll die Rückmeldung gehen?</h4>
									<p class="review-step-copy">Hierhin gehen Bestätigung und die persönliche Ersteinschätzung.</p>
									<div class="review-field-grid">
										<div class="review-field">
											<label for="review-name">Name</label>
											<input id="review-name" name="name" type="text" required autocomplete="name">
										</div>
										<div class="review-field">
											<label for="review-email">Geschäftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
										<div class="review-field">
											<label for="review-company">Unternehmen (optional)</label>
											<input id="review-company" name="company" type="text" placeholder="Firmenname" autocomplete="organization">
										</div>
										<div class="review-field">
											<label for="review-linkedin">LinkedIn (optional)</label>
											<input id="review-linkedin" name="linkedin" type="url" placeholder="https://linkedin.com/in/..." autocomplete="url">
										</div>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
									<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Kostenlosen Growth Audit anfragen</button>
								</div>

								<p class="audit-form-meta">Kostenloser Einstieg. Schriftliche Rückmeldung zuerst. Kein Tool-Score.</p>
							</form>

								<div id="review-request-success" class="review-success" hidden>
									<div class="review-success-pill">Anfrage eingegangen</div>
									<h3>Die Seite ist jetzt im Audit.</h3>
									<p id="review-success-message" class="review-success-copy">
										Ich prüfe die angegebene Seite manuell und sende Ihnen innerhalb von 48 Stunden eine kompakte Ersteinschätzung.
									</p>
									<div id="review-success-url" class="review-success-url"></div>
									<div class="review-success-meta">
										<span>Bestätigung per E-Mail</span>
										<span>persönliche Rückmeldung in 48h</span>
										<span>kein Pflicht-Call</span>
									</div>
									<div class="review-success-grid">
										<div class="review-success-card">
											<strong>3 stärkste Bremsen</strong>
											<span>Wo Ihre Seite aktuell am meisten Anfragewirkung verliert.</span>
										</div>
										<div class="review-success-card">
											<strong>wichtigste Priorität</strong>
											<span>Was zuerst geschärft werden sollte und warum genau dort.</span>
										</div>
										<div class="review-success-card">
											<strong>klarer nächster Schritt</strong>
											<span>Was direkt sinnvoll ist und was bewusst später kommen kann.</span>
										</div>
									</div>
							</div>
						</div>

						<aside class="review-form-aside">
							<div class="review-aside-card review-aside-card-brief">
								<span class="review-aside-kicker">Ihre Anfrage in Kurzform</span>
								<h4>So liest sich der Intake gerade</h4>
								<dl class="review-brief-list">
									<div class="review-brief-row">
										<dt>Seite</dt>
										<dd data-review-summary="page_url">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Prüffokus</dt>
										<dd data-review-summary="focus_area">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Ziel</dt>
										<dd data-review-summary="primary_goal">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Kontext</dt>
										<dd data-review-summary="current_challenge">Noch offen</dd>
									</div>
								</dl>
							</div>
							<div class="review-aside-card">
								<span class="review-aside-kicker">Im Audit enthalten</span>
								<ul class="review-aside-list">
									<li>die 3 stärksten Anfragebremsen</li>
									<li>die wirtschaftlich wichtigste Priorität</li>
									<li>ein klarer nächster Schritt</li>
								</ul>
							</div>
							<div class="review-aside-card">
								<span class="review-aside-kicker">Ablauf</span>
								<ul class="review-aside-list">
									<li>Anfrage absenden</li>
									<li>manuelle Prüfung plus KI-unterstützte Einordnung</li>
									<li>schriftliche Rückmeldung innerhalb von 48 Stunden</li>
								</ul>
							</div>
						</aside>
					</div>
				</div>
			</section>

			<section id="quality" class="review-quality-section audit-section nx-reveal" aria-labelledby="review-quality-headline">
				<div class="review-quality-panel">
					<div class="review-section-head review-section-head--left">
						<span class="review-section-kicker">Warum dieser Audit anders ist</span>
						<h2 id="review-quality-headline">Weniger Audit-Ballast. Mehr brauchbare Einordnung.</h2>
						<p>
							Der Wert liegt nicht in einer langen Liste, sondern in einer frühen Priorisierung,
							die für Ihre Seite, Ihre Anfrageführung und Ihr Ziel wirklich nutzbar ist.
						</p>
					</div>
					<div class="review-quality-grid">
						<article class="review-quality-card">
							<strong>Kein Tool-Score</strong>
							<span>Kein Prozentwert, der präzise klingt, aber keine Reihenfolge für echte Entscheidungen liefert.</span>
						</article>
						<article class="review-quality-card">
							<strong>Manuell gelesen</strong>
							<span>Die Seite wird als Angebots- und Anfragefläche gelesen, nicht nur als technische Oberfläche.</span>
						</article>
						<article class="review-quality-card">
							<strong>KI-unterstützt</strong>
							<span>Hilft Muster und Prioritäten schneller sichtbar zu machen, ersetzt aber nicht die persönliche Einordnung.</span>
						</article>
						<article class="review-quality-card">
							<strong>Bewusst eng gefasst</strong>
							<span>Eine konkrete Seite statt Audit-Masse. Genau deshalb bleibt die erste Rückmeldung klar und belastbar.</span>
						</article>
					</div>
				</div>
			</section>

			<section id="faq" class="audit-faq-section audit-section nx-reveal">
				<h2 class="audit-faq-headline">Häufige Fragen</h2>
				<details>
					<summary>Was genau bekomme ich innerhalb von 48 Stunden?</summary>
					<div class="faq-ans">Eine manuell geprüfte, KI-unterstützte Ersteinschätzung mit den 3 stärksten Bremsen, der wichtigsten Priorität und einem klaren nächsten Schritt.</div>
				</details>
				<details>
					<summary>Für welche Seiten ist der Audit gedacht?</summary>
					<div class="faq-ans">Vor allem für Startseiten und kaufnahe Angebotsseiten in WordPress, die bereits Anfragen tragen sollen oder genau daran gerade scheitern.</div>
				</details>
				<details>
					<summary>Prüfen Sie eine ganze Website?</summary>
					<div class="faq-ans">Nein. Der Einstieg ist bewusst auf eine konkrete Seite begrenzt, damit die erste Rückmeldung präzise bleibt. Wenn dabei größere strukturelle Themen sichtbar werden, wird das klar benannt.</div>
				</details>
				<details>
					<summary>Wie ausführlich muss das Formular sein?</summary>
					<div class="faq-ans">Kurz und ehrlich reicht. Eine konkrete URL, die wichtigste Reibung und ein knapper Kontext verbessern die Diagnosequalität bereits deutlich.</div>
				</details>
				<details>
					<summary>Muss ich danach einen Call buchen?</summary>
					<div class="faq-ans">Nein. Die Rückmeldung kommt zuerst schriftlich. Wenn danach ein Gespräch sinnvoll ist, ergibt sich das aus der Lage und nicht aus einer Pflicht im Funnel.</div>
				</details>
				<details>
					<summary>Was passiert, wenn die Bewertung schlecht ausfällt?</summary>
					<div class="faq-ans">Dann benenne ich genau das. Das Versprechen ist kein positives Urteil, sondern eine ehrliche, brauchbare Bewertung Ihrer Seite und ein sinnvoller nächster Schritt.</div>
				</details>
				<details>
					<summary>Ist der Einstieg wirklich kostenlos?</summary>
					<div class="faq-ans">Ja. Der Growth Audit ist der kostenlose Einstieg in die Diagnose. Er bleibt bewusst eng gefasst, damit die Rückmeldung schnell und brauchbar bleibt, auch wenn das Urteil klar gegen direkte Umsetzung ausfällt.</div>
				</details>
			</section>

			<section class="final-cta audit-section nx-reveal" aria-labelledby="audit-final-cta-headline">
				<h2 id="audit-final-cta-headline">Wenn Sie eine konkrete Seite sauber priorisieren wollen, ist das der passende Einstieg.</h2>
				<p class="final-cta-sub">Eine URL reicht. Die Rückmeldung kommt schriftlich, manuell geprüft und innerhalb von 48 Stunden.</p>
				<div class="final-cta-actions">
					<a class="cta-btn" href="#form" data-track-action="cta_final_growth_audit" data-track-category="lead_gen">Growth Audit anfragen</a>
					<a class="audit-text-link" href="<?php echo esc_url( $cases_url ); ?>">Öffentliche Einblicke ansehen</a>
				</div>
			</section>
		</main>
	</div>
</div>
