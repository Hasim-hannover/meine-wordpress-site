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
	<div class="audit-container">
		<main class="audit-content">
			<section id="start" class="audit-hero-centered audit-section nx-reveal review-hero-shell">
				<div class="review-hero-layout review-hero-layout--flow">
					<div class="review-hero-main">
						<div class="review-hero-kicker">Growth Audit für B2B-WordPress-Seiten</div>
						<h1>In vier kurzen Schritten zur brauchbaren Ersteinschätzung Ihrer Seite.</h1>
						<p class="hero-sub-short">
							Der Flow sammelt nur die Angaben, die für eine erste manuelle Priorisierung wirklich nötig sind:
							eine konkrete Seite, den wichtigsten Fokus, das gewünschte Ergebnis und einen leichten Kontaktabschluss.
						</p>

						<div class="audit-hero-proof" aria-label="Trust-Chips">
							<span>0 € Einstieg</span>
							<span>manuell geprüft</span>
							<span>Rückmeldung in 48h</span>
						</div>

						<div class="audit-hero-actions">
							<a class="audit-submit-btn audit-hero-cta-btn" href="#form" data-track-action="cta_hero_growth_audit" data-track-category="lead_gen">Diagnose-Flow starten</a>
							<a class="audit-text-link audit-text-link--hero" href="<?php echo esc_url( $cases_url ); ?>">Öffentliche Einblicke</a>
						</div>
						<p class="review-hero-microcopy">Eine konkrete URL reicht. Die Rückmeldung kommt zuerst schriftlich. Kein Pflicht-Call.</p>

						<div class="review-flow-strip" aria-label="Ablauf in drei Punkten">
							<article class="review-flow-step">
								<span class="review-flow-step-index">1</span>
								<div class="review-flow-step-copy">
									<strong>Seite eingrenzen</strong>
									<span>Eine URL statt Website-Komplettaufnahme.</span>
								</div>
							</article>
							<article class="review-flow-step">
								<span class="review-flow-step-index">2</span>
								<div class="review-flow-step-copy">
									<strong>Fokus priorisieren</strong>
									<span>Erst das größte Problem, dann das gewünschte Ergebnis.</span>
								</div>
							</article>
							<article class="review-flow-step">
								<span class="review-flow-step-index">3</span>
								<div class="review-flow-step-copy">
									<strong>Persönliche Rückmeldung</strong>
									<span>Innerhalb von 48 Stunden mit klarer nächster Priorität.</span>
								</div>
							</article>
						</div>
					</div>

					<aside class="review-offer-panel review-offer-panel--hero" aria-label="Leistungsumfang">
						<span class="review-offer-kicker">Manuelle Ersteinschätzung</span>
						<h2>Kein generischer Lead-Magnet. Eine erste Priorisierung, die direkt nutzbar ist.</h2>
						<p class="review-offer-copy">
							Keine automatisierte Pseudo-Analyse, kein Tool-Score, kein unnötiger Audit-Ballast.
							Der Einstieg bleibt bewusst eng, damit die Rückmeldung präzise und schnell bleibt.
						</p>

						<div class="review-offer-list">
							<div class="review-offer-item">
								<strong>3 stärkste Bremsen</strong>
								<span>Wo Klarheit, Vertrauen oder Anfrageführung gerade zuerst wegbrechen.</span>
							</div>
							<div class="review-offer-item">
								<strong>1 wirtschaftliche Priorität</strong>
								<span>Welcher Hebel jetzt am meisten zählt und was bewusst warten kann.</span>
							</div>
							<div class="review-offer-item">
								<strong>1 sinnvoller nächster Schritt</strong>
								<span>Kleine Korrektur oder saubere Übergabe in einen vertieften Folgeprozess.</span>
							</div>
						</div>

						<div class="review-offer-timeline">
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Prüfobjekt</span>
								<strong>1 Startseite oder kaufnahe Angebotsseite</strong>
							</div>
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Format</span>
								<strong>Schriftliche Rückmeldung statt erzwungenem Erstgespräch</strong>
							</div>
						</div>
					</aside>
				</div>
			</section>

			<section id="form" class="audit-section nx-reveal">
				<div class="black-box black-box--centered review-box review-box--flow">
					<div class="review-form-layout">
						<div class="review-form-main">
							<div class="box-head review-form-frame-head">
								<div>
									<span class="review-form-kicker">Growth Audit anfragen</span>
									<h3>Ein fokussierter Diagnose-Flow statt eines schweren Formularblocks.</h3>
									<p>Erst die Seite, dann Fokus und Ziel. Kontakt und zusätzlicher Kontext kommen erst ganz am Ende.</p>
								</div>
								<div class="review-form-eta" aria-label="Formular-Microcopy">
									<span>ca. 1-2 Minuten</span>
									<span>schriftliche Rückmeldung</span>
									<span>kein Pflicht-Call</span>
								</div>
							</div>

							<form id="review-request-form" class="review-funnel" novalidate>
								<input type="hidden" name="company_website" value="">
								<input type="hidden" name="started_at" value="">
								<input type="hidden" name="audit_type" value="growth_audit">

								<div class="review-progress" aria-label="Fortschritt im Diagnose-Flow">
									<div class="review-progress-head">
										<div class="review-progress-copy">
											<span class="review-progress-eyebrow">Diagnose-Flow</span>
											<strong id="review-progress-current">Schritt 1 von 4: Seite</strong>
										</div>
										<span class="review-progress-meta">kurz, präzise, ohne Ballast</span>
									</div>
									<div class="review-progress-track">
										<div class="review-progress-fill" id="review-progress-fill"></div>
									</div>
									<ol class="review-progress-steps">
										<li class="is-current is-reached">
											<button type="button" data-review-step-target="0" aria-label="Zu Schritt 1: Seite">
												<span class="review-progress-step-index">1</span>
												<span class="review-progress-step-label">Seite</span>
											</button>
										</li>
										<li>
											<button type="button" data-review-step-target="1" aria-label="Zu Schritt 2: Fokus" disabled>
												<span class="review-progress-step-index">2</span>
												<span class="review-progress-step-label">Fokus</span>
											</button>
										</li>
										<li>
											<button type="button" data-review-step-target="2" aria-label="Zu Schritt 3: Ziel" disabled>
												<span class="review-progress-step-index">3</span>
												<span class="review-progress-step-label">Ziel</span>
											</button>
										</li>
										<li>
											<button type="button" data-review-step-target="3" aria-label="Zu Schritt 4: Kontakt" disabled>
												<span class="review-progress-step-index">4</span>
												<span class="review-progress-step-label">Kontakt</span>
											</button>
										</li>
									</ol>
								</div>

								<details class="review-mobile-summary">
									<summary>Ihre Angaben bisher</summary>
									<dl class="review-brief-list review-brief-list--mobile">
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
									</dl>
								</details>

								<div class="review-step is-active" data-step="0">
									<span class="review-step-kicker">Schritt 1 von 4</span>
									<h4>Welche konkrete Seite soll ich prüfen?</h4>
									<p class="review-step-copy">Am besten genau die Startseite oder Angebotsseite, die Anfragen tragen soll.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://www.beispiel.de/angebot" required autocomplete="url">
										<p class="review-field-help">Bitte nur eine konkrete Seite angeben, nicht die ganze Website.</p>
									</div>
								</div>

								<div class="review-step" data-step="1" data-review-radio-message="Bitte zuerst den Bereich mit dem größten Klärungsbedarf auswählen.">
									<span class="review-step-kicker">Schritt 2 von 4</span>
									<h4>Wo liegt gerade die größte Reibung?</h4>
									<p class="review-step-copy">Wählen Sie nur den Bereich, der für diese Seite aktuell am meisten klärt.</p>

									<fieldset class="review-choice-block">
										<legend>Prüffokus</legend>
										<p class="review-choice-help">Das priorisiert die Diagnose, statt einfach alles gleichzeitig anzuschneiden.</p>
										<div class="review-option-group">
											<label class="review-option">
												<input type="radio" name="focus_area" value="positioning_page_message" required>
												<div class="review-option-copy">
													<strong data-review-label>Positionierung / Seitenbotschaft</strong>
													<span>Wenn nicht schnell klar wird, warum diese Seite relevant ist und für wen sie gedacht ist.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="focus_area" value="conversion_inquiry_flow" required>
												<div class="review-option-copy">
													<strong data-review-label>Conversion / Anfrageführung</strong>
													<span>Wenn Besucher nicht sauber zum nächsten Schritt, Kontakt oder Anfrage geführt werden.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="focus_area" value="seo_visibility" required>
												<div class="review-option-copy">
													<strong data-review-label>SEO / Sichtbarkeit</strong>
													<span>Wenn zu wenig relevante Besucher auf der Seite ankommen oder Rankings nicht tragen.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="focus_area" value="performance_cwv" required>
												<div class="review-option-copy">
													<strong data-review-label>Performance / Core Web Vitals</strong>
													<span>Wenn Ladezeit, mobile Nutzung oder Stabilität sichtbar gegen die Anfragewirkung arbeiten.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="focus_area" value="tracking_data_quality" required>
												<div class="review-option-copy">
													<strong data-review-label>Tracking / Datenqualität</strong>
													<span>Wenn Entscheidungen auf zu unsauberer oder lückenhafter Datenbasis getroffen werden.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="focus_area" value="not_sure_yet" required>
												<div class="review-option-copy">
													<strong data-review-label>Ich bin mir noch nicht sicher</strong>
													<span>Wenn zuerst klar werden soll, wo die stärkste Bremse überhaupt sitzt.</span>
												</div>
											</label>
										</div>
									</fieldset>
								</div>

								<div class="review-step" data-step="2" data-review-radio-message="Bitte das wichtigste Ziel für diese Seite auswählen.">
									<span class="review-step-kicker">Schritt 3 von 4</span>
									<h4>Woran würden Sie eine bessere Seite zuerst merken?</h4>
									<p class="review-step-copy">So wird die Rückmeldung wirtschaftlich priorisiert und nicht nur fachlich richtig formuliert.</p>

									<fieldset class="review-choice-block">
										<legend>Wichtigstes Ziel</legend>
										<p class="review-choice-help">Ein Ziel reicht. Das schafft Klarheit in der ersten Priorisierung.</p>
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
													<span>Der Weg vom ersten Eindruck bis zur Anfrage soll leichter und klarer werden.</span>
												</div>
											</label>
											<label class="review-option">
												<input type="radio" name="primary_goal" value="better_google_visibility" required>
												<div class="review-option-copy">
													<strong data-review-label>bessere Sichtbarkeit bei Google</strong>
													<span>Die Seite soll organisch relevanter gefunden und häufiger sinnvoll angeklickt werden.</span>
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
													<span>Tracking und Messpunkte sollen belastbarer für Prioritäten und Investitionen werden.</span>
												</div>
											</label>
										</div>
									</fieldset>
								</div>

								<div class="review-step" data-step="3">
									<span class="review-step-kicker">Schritt 4 von 4</span>
									<h4>Wohin soll die Rückmeldung gehen?</h4>
									<p class="review-step-copy">Name und geschäftliche E-Mail reichen. Alles Weitere ist optional.</p>
									<div class="review-field-grid">
										<div class="review-field">
											<label for="review-name">Name</label>
											<input id="review-name" name="name" type="text" required autocomplete="name">
										</div>
										<div class="review-field">
											<label for="review-email">Geschäftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
									</div>

									<details class="review-optional-details">
										<summary>Optional: Unternehmen oder kurzen Kontext ergänzen</summary>
										<div class="review-optional-details__body">
											<div class="review-field">
												<label for="review-company">Unternehmen (optional)</label>
												<input id="review-company" name="company" type="text" placeholder="Firmenname" autocomplete="organization">
											</div>
											<div class="review-field review-field-full">
												<label for="review-current-challenge">Wichtig zu wissen (optional)</label>
												<textarea id="review-current-challenge" name="current_challenge" rows="4" placeholder="Zum Beispiel: Relaunch steht an, Paid Traffic läuft bereits oder die Seite trägt das neue Angebot noch nicht sauber."></textarea>
												<p class="review-field-help">Wenn Sie nichts ergänzen, prüfe ich die Seite anhand Ihrer URL, Ihres Fokus und Ihres Ziels.</p>
											</div>
										</div>
									</details>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
									<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter zu Fokus</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Growth Audit anfragen</button>
								</div>

								<p class="audit-form-meta">Kein Tool-Score. Kein automatisiertes Bullshit-Ergebnis. Eine manuell geprüfte Ersteinschätzung.</p>
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
								<div class="review-success-actions">
									<a class="cta-btn" href="<?php echo esc_url( $cases_url ); ?>">Öffentliche Einblicke ansehen</a>
									<a class="audit-text-link" href="<?php echo esc_url( $e3_url ); ?>">B2B-Kontext ansehen</a>
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
										<dt>Kurzkontext</dt>
										<dd data-review-summary="current_challenge">Nicht ergänzt</dd>
									</div>
								</dl>
							</div>
							<div class="review-aside-card review-aside-card-process">
								<span class="review-aside-kicker">Nach dem Absenden</span>
								<ol class="review-aside-steps">
									<li>Die Anfrage landet direkt im Audit-CRM.</li>
									<li>Die Seite wird manuell gelesen und KI-gestützt eingeordnet.</li>
									<li>Sie erhalten innerhalb von 48 Stunden eine klare erste Priorisierung.</li>
								</ol>
								<p>Keine generische Checkliste. Keine Pflichtbuchung. Nur ein sinnvoller Einstieg in die Diagnose.</p>
							</div>
						</aside>
					</div>
				</div>
			</section>

			<section id="proof" class="report-preview-section audit-section nx-reveal" aria-labelledby="preview-headline">
				<div class="preview-text">
					<span class="preview-kicker">Beispiel einer Rückmeldung</span>
					<h2 id="preview-headline">So konkret fällt die Ersteinschätzung später aus.</h2>
					<p class="preview-desc">
						Redigiert und anonymisiert. Ziel ist nicht Vollständigkeit, sondern eine frühe Priorisierung,
						die schon vor dem Absenden zeigt, wie konkret die Rückmeldung nachher wirklich ist.
					</p>
					<div class="preview-deliverables" aria-label="Merkmale der Rückmeldung">
						<div class="preview-deliverable">
							<strong>klare Problembenennung</strong>
							<span>Die stärkste Bremse wird direkt benannt, nicht in Audit-Sprache versteckt.</span>
						</div>
						<div class="preview-deliverable">
							<strong>saubere Begründung</strong>
							<span>Warum genau diese Stelle Relevanz, Vertrauen oder Anfragebereitschaft bremst.</span>
						</div>
						<div class="preview-deliverable">
							<strong>wirtschaftliche Priorität</strong>
							<span>Was zuerst geändert werden sollte, bevor weitere Arbeit Zeit und Budget bindet.</span>
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

			<section id="quality" class="review-proof-section audit-section nx-reveal" aria-labelledby="review-proof-headline">
				<div class="review-proof-bar review-proof-bar--compact">
					<div class="review-proof-intro">
						<span class="review-section-kicker">Warum der Einstieg so gebaut ist</span>
						<h2 id="review-proof-headline">Mehr Diagnose-Flow. Weniger Landingpage-Geräusch.</h2>
						<p>
							Die Seite sammelt bewusst nur das, was eine erste brauchbare Einordnung wirklich verbessert.
							Der Rest folgt erst nach der persönlichen Rückmeldung, nicht schon davor im Formular.
						</p>
					</div>
					<div class="review-proof-grid" aria-label="Vertrauenssignale">
						<article class="review-proof-pill">
							<strong>Persönlich geprüft</strong>
							<span>keine automatisierte Standardauswertung</span>
						</article>
						<article class="review-proof-pill">
							<strong>Kein Tool-Score</strong>
							<span>klare Priorität statt pseudo-präziser Prozentwerte</span>
						</article>
						<article class="review-proof-pill">
							<strong>Kein Pflicht-Call</strong>
							<span>die Rückmeldung kommt zuerst schriftlich</span>
						</article>
						<article class="review-proof-pill">
							<strong>Öffentlicher B2B-Kontext</strong>
							<span><a class="review-inline-link" href="<?php echo esc_url( $e3_url ); ?>">E3 New Energy ansehen</a></span>
						</article>
						<article class="review-proof-pill">
							<strong>Weitere Einblicke</strong>
							<span><a class="review-inline-link" href="<?php echo esc_url( $cases_url ); ?>">Öffentliche Ergebnisse ansehen</a></span>
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
					<summary>Wie ausführlich muss der Flow ausgefüllt werden?</summary>
					<div class="faq-ans">Eine konkrete URL, Fokus, Ziel und eine geschäftliche E-Mail reichen. Zusätzlicher Kontext ist hilfreich, aber nicht Pflicht.</div>
				</details>
				<details>
					<summary>Muss ich danach einen Call buchen?</summary>
					<div class="faq-ans">Nein. Die Rückmeldung kommt zuerst schriftlich. Wenn danach ein Gespräch sinnvoll ist, ergibt sich das aus der Lage und nicht aus einer Pflicht im Funnel.</div>
				</details>
				<details>
					<summary>Ist der Einstieg wirklich kostenlos?</summary>
					<div class="faq-ans">Ja. Der Growth Audit ist der kostenlose Einstieg in die Diagnose. Er bleibt bewusst eng gefasst, damit die Rückmeldung schnell und brauchbar bleibt.</div>
				</details>
			</section>
		</main>
	</div>
</div>
