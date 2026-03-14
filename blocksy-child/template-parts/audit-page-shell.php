<?php
/**
 * Versioned growth audit landing page shell.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_url    = nexus_get_results_url();
$e3_url       = nexus_get_page_url( [ 'e3-new-energy' ], home_url( '/e3-new-energy/' ) );
$privacy_url  = nexus_get_page_url( [ 'datenschutz' ], home_url( '/datenschutz/' ) );
$calendar_url = function_exists( 'nexus_get_audit_calendar_url' ) ? nexus_get_audit_calendar_url() : home_url( '/growth-audit/' );
?>

<div class="audit-wrapper" id="audit-main-wrapper">
	<div class="audit-container">
		<main class="audit-content">
			<section id="start" class="audit-hero-centered audit-section nx-reveal review-hero-shell">
				<div class="review-hero-layout review-hero-layout--flow">
					<div class="review-hero-main">
						<div class="review-hero-kicker">Growth Audit für B2B-WordPress-Seiten</div>
						<h1>Ihre Website verliert täglich Leads, die schon da sind.</h1>
						<p class="hero-sub-short">
							Der Growth Audit zeigt die drei Bremsen, die qualifizierte Anfragen kosten,
							und priorisiert den nächsten wirtschaftlichen Schritt.
						</p>

						<div class="audit-hero-actions">
							<a class="audit-submit-btn audit-hero-cta-btn audit-hero-cta-btn--dominant" href="#form" data-track-action="cta_hero_growth_audit" data-track-category="lead_gen">Growth Audit starten</a>
							<a class="audit-text-link audit-text-link--hero" href="<?php echo esc_url( $e3_url ); ?>">Öffentliche Case Study ansehen</a>
						</div>
						<p class="review-hero-microcopy">Kostenlos, kein Pitch, schriftliche Rückmeldung in 48 Stunden.</p>

						<div class="review-kpi-proof" aria-label="Audit im Überblick">
							<article class="review-kpi-card">
								<strong>1 konkrete URL</strong>
								<span>reicht für den Einstieg in die Diagnose.</span>
							</article>
							<article class="review-kpi-card">
								<strong>3 priorisierte Bremsen</strong>
								<span>statt einer langen Liste ohne Reihenfolge.</span>
							</article>
							<article class="review-kpi-card">
								<strong>48h Rückmeldung</strong>
								<span>schriftlich, klar und direkt nutzbar.</span>
							</article>
						</div>
					</div>

					<aside class="review-offer-panel review-offer-panel--hero review-offer-panel--problem" aria-label="Problem-Mirror">
						<span class="review-offer-kicker">Was gerade Geld kostet</span>
						<h2>Die meisten Lead-Verluste passieren vor dem eigentlichen Kontakt.</h2>
						<p class="review-offer-copy">
							Nicht weil niemand auf die Seite kommt, sondern weil Relevanz, Vertrauen
							und nächster Schritt nicht schnell genug ineinandergreifen.
						</p>

						<div class="review-offer-list">
							<div class="review-offer-item">
								<strong>Gute Besucher springen innerlich ab</strong>
								<span>Der erste Screen macht nicht schnell genug klar, warum genau diese Anfrage sinnvoll ist.</span>
							</div>
							<div class="review-offer-item">
								<strong>Die falschen Leads kosten Zeit</strong>
								<span>Unsaubere Führung filtert qualifizierte Kontakte zu wenig und Neugier zu spät.</span>
							</div>
							<div class="review-offer-item">
								<strong>Optimierungen passieren in der falschen Reihenfolge</strong>
								<span>Es wird an Details gearbeitet, während die eigentliche wirtschaftliche Bremse stehen bleibt.</span>
							</div>
						</div>

						<div class="review-offer-timeline">
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Typischer Schaden</span>
								<strong>Mehr Klickkosten, mehr Streuverlust, weniger brauchbare Erstgespräche.</strong>
							</div>
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Audit-Outcome</span>
								<strong>Sie sehen zuerst, welche Bremse wirtschaftlich wirklich Priorität hat.</strong>
							</div>
						</div>
					</aside>
				</div>
			</section>

			<section id="lead-loss" class="audit-section nx-reveal review-problem-section" aria-labelledby="lead-loss-headline">
				<div class="review-problem-shell">
					<div class="review-section-head review-section-head--left">
						<span class="review-section-kicker">Warum Websites täglich Leads verlieren</span>
						<h2 id="lead-loss-headline">Nicht durch einen großen Fehler, sondern durch kleine Brüche in Serie.</h2>
						<p>
							Wenn Botschaft, Proof und nächste Handlung nicht sauber zusammenspielen,
							wirkt selbst guter Traffic teurer und der Vertrieb bekommt mehr Reibung als Klarheit.
						</p>
					</div>

					<div class="review-problem-grid" aria-label="Typische Lead-Lecks">
						<article class="review-problem-card">
							<span class="review-problem-index">01</span>
							<h3>Relevanz wird zu spät verstanden</h3>
							<p>Besucher müssen sich die Kernbotschaft selbst zusammensuchen, statt sie sofort zu erkennen.</p>
						</article>
						<article class="review-problem-card">
							<span class="review-problem-index">02</span>
							<h3>Proof kommt nicht am Entscheidungsmoment an</h3>
							<p>Vertrauen ist irgendwo auf der Seite vorhanden, aber nicht dort, wo Zweifel entstehen.</p>
						</article>
						<article class="review-problem-card">
							<span class="review-problem-index">03</span>
							<h3>Der CTA filtert nicht sauber</h3>
							<p>Gute Leads bekommen zu wenig Sicherheit, schwache Leads zu wenig Friktion und der Funnel wird ineffizient.</p>
						</article>
					</div>

					<div class="review-problem-impact">
						<strong>Die Folge:</strong>
						<span>Sie zahlen mit Reichweite, Vertriebskapazität und verpasster Nachfrage für Probleme, die von außen oft nur wie „zu wenig Leads“ aussehen.</span>
					</div>
				</div>
			</section>

			<section id="system" class="review-proof-section audit-section nx-reveal" aria-labelledby="review-system-headline">
				<div class="review-proof-bar review-proof-bar--system">
					<div class="review-proof-intro">
						<span class="review-section-kicker">Wie der Audit das sichtbar macht</span>
						<h2 id="review-system-headline">Erst Problem isolieren. Dann Priorität setzen.</h2>
						<p>
							Der Einstieg bleibt bewusst eng: eine Seite, ein Schwerpunkt, ein gewünschtes Ergebnis.
							So entsteht keine generische Audit-Sammlung, sondern eine klare erste Reihenfolge.
						</p>

						<div class="review-system-summary" aria-label="Audit-Zusammenfassung">
							<div class="review-system-summary-item">
								<strong>3 stärkste Bremsen</strong>
								<span>klar benannt statt in Audit-Sprache versteckt</span>
							</div>
							<div class="review-system-summary-item">
								<strong>1 wirtschaftliche Priorität</strong>
								<span>damit Zeit und Budget nicht an Symptomen hängen bleiben</span>
							</div>
							<div class="review-system-summary-item">
								<strong>1 sinnvoller nächster Schritt</strong>
								<span>kleine Korrektur oder klarer Übergang in Folgearbeit</span>
							</div>
						</div>
					</div>

					<div class="review-flow-strip review-flow-strip--system" aria-label="Ablauf in drei Punkten">
						<article class="review-flow-step">
							<span class="review-flow-step-index">1</span>
							<div class="review-flow-step-copy">
								<strong>Seite eingrenzen</strong>
								<span>Nur die URL, auf der heute Leads hängen bleiben oder unsauber ankommen.</span>
							</div>
						</article>
						<article class="review-flow-step">
							<span class="review-flow-step-index">2</span>
							<div class="review-flow-step-copy">
								<strong>Engpass priorisieren</strong>
								<span>Wo gerade Relevanz, Vertrauen, Anfrageführung oder Datenqualität zuerst brechen.</span>
							</div>
						</article>
						<article class="review-flow-step">
							<span class="review-flow-step-index">3</span>
							<div class="review-flow-step-copy">
								<strong>Schriftliche Rückmeldung</strong>
								<span>Innerhalb von 48 Stunden mit klarer Priorität statt erzwungenem Erstgespräch.</span>
							</div>
						</article>
					</div>
				</div>
			</section>

			<section id="proof" class="audit-section nx-reveal review-caseproof-section" aria-labelledby="caseproof-headline">
				<div class="review-caseproof-shell">
					<div class="review-caseproof-head">
						<span class="preview-kicker">Proof statt Behauptung</span>
						<h2 id="caseproof-headline">Wenn die richtige Bremse zuerst angegangen wird, ändert sich die ganze Lead-Ökonomie.</h2>
						<p>
							Öffentlicher B2B-Case von E3 New Energy: vom externen Lead-Einkauf
							zu einer eigenen Pipeline mit klarerer Vorqualifizierung.
						</p>
					</div>

					<div class="review-caseproof-layout">
						<article class="review-caseproof-card">
							<div class="review-caseproof-card-head">
								<div>
									<span class="review-caseproof-kicker">Case Study: E3 New Energy</span>
									<h3>Vorher Zukauf. Nachher eigene Pipeline.</h3>
								</div>
								<span class="review-caseproof-tag">12 Monate Systemaufbau</span>
							</div>

							<div class="review-caseproof-compare" aria-label="Vorher und Nachher">
								<div class="review-caseproof-state">
									<span class="review-caseproof-state-label">Vorher</span>
									<strong>Lead-Einkauf und unsaubere Vorqualifizierung</strong>
									<ul class="review-caseproof-points">
										<li>ø 150 € pro Lead</li>
										<li>zu hohe Abhängigkeit von Drittanbietern</li>
										<li>Streuung im Vertrieb statt klarer Übergabe</li>
									</ul>
								</div>
								<div class="review-caseproof-divider" aria-hidden="true">→</div>
								<div class="review-caseproof-state review-caseproof-state--after">
									<span class="review-caseproof-state-label">Nachher</span>
									<strong>Eigene Nachfragebasis mit saubererem Sales-Übergang</strong>
									<ul class="review-caseproof-points">
										<li>1.750+ Leads im System</li>
										<li>-83 % Cost per Lead</li>
										<li>12 % Sales-Conversion</li>
									</ul>
								</div>
							</div>

							<div class="review-caseproof-foot">
								<p>
									Der Hebel war nicht „mehr Marketing“, sondern saubere Reihenfolge:
									Tracking, Angebotslogik, Funnel-Führung und Vorqualifizierung griffen erstmals als System zusammen.
								</p>
								<a class="audit-text-link" href="<?php echo esc_url( $e3_url ); ?>">Case Study im Detail lesen</a>
							</div>
						</article>

						<aside class="review-caseproof-aside">
							<div class="review-caseproof-kpis" aria-label="Ergebnis-KPIs">
								<article class="review-caseproof-kpi">
									<strong>1.750+</strong>
									<span>qualifizierte Leads im System statt externer Zukauf-Logik</span>
								</article>
								<article class="review-caseproof-kpi">
									<strong>-83 % CPL</strong>
									<span>weniger Streuverlust durch bessere Vorqualifizierung und sauberere Funnel-Führung</span>
								</article>
								<article class="review-caseproof-kpi">
									<strong>12 % Sales-Conversion</strong>
									<span>mehr Wert pro Lead, weil Angebot, Proof und Übergabe besser zusammenarbeiteten</span>
								</article>
							</div>

							<div class="review-output-card review-output-card--compact">
								<span class="review-output-kicker">Was Sie im Audit bekommen</span>
								<div class="review-output-row">
									<strong>Stärkste Bremse</strong>
									<span>Welche Stelle heute die meiste Nachfrage- oder Lead-Qualität kostet.</span>
								</div>
								<div class="review-output-row">
									<strong>Wirtschaftlich erste Priorität</strong>
									<span>Was zuerst geändert werden sollte, bevor weitere Maßnahmen Budget binden.</span>
								</div>
								<div class="review-output-row">
									<strong>Nächster sinnvoller Schritt</strong>
									<span>Konkrete nächste Aktion statt unverbindlicher Audit-Punkteliste.</span>
								</div>
							</div>

							<a class="audit-submit-btn review-caseproof-cta" href="#form" data-track-action="cta_caseproof_growth_audit" data-track-category="lead_gen">Mit derselben Logik prüfen</a>
							<p class="review-caseproof-microcopy">Kostenlos, kein Pitch. Erst die Diagnose, dann erst ein möglicher nächster Schritt.</p>
							<a class="audit-text-link" href="<?php echo esc_url( $cases_url ); ?>">Weitere Ergebnisse ansehen</a>
						</aside>
					</div>
				</div>
			</section>

			<section id="form" class="audit-section nx-reveal review-form-section">
				<div class="black-box black-box--centered review-box review-box--flow">
					<div class="review-form-topbar">
						<div class="box-head review-form-frame-head">
							<div>
								<span class="review-form-kicker">Growth Audit anfragen</span>
								<h3>In ca. 30 bis 45 Sekunden steht Ihre Seite im Audit.</h3>
								<p>Sie nennen nur die Seite, den stärksten Engpass und das gewünschte Ergebnis. Danach kommt die schriftliche Rückmeldung statt eines Sales-Calls.</p>
							</div>
							<div class="review-form-eta" aria-label="Formular-Microcopy">
								<span>ca. 30-45 Sekunden</span>
								<span>schriftlich in 48h</span>
								<span>kostenlos, kein Pitch</span>
							</div>
						</div>

						<div class="review-form-expectation-grid" aria-label="Was Sie nach dem Absenden erwartet">
							<article class="review-form-expectation-card">
								<strong>Nur das Nötigste</strong>
								<span>URL, Engpass, Ziel und Kontakt. Kein unnötiger Fragebogen vor der Diagnose.</span>
							</article>
							<article class="review-form-expectation-card">
								<strong>Manuelle Prüfung</strong>
								<span>Keine automatisierte Punktesammlung, sondern eine priorisierte Einordnung Ihrer Seite.</span>
							</article>
							<article class="review-form-expectation-card">
								<strong>DSGVO-konform</strong>
								<span>Nur Rückmeldungen zu dieser Anfrage. Kein Spam, kein Newsletter-Opt-in, keine Weitergabe.</span>
							</article>
						</div>
					</div>

					<div class="review-form-layout">
						<div class="review-form-main">
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
										<span class="review-progress-meta">kompakt, ohne Pitch, ohne Ballast</span>
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
											<button type="button" data-review-step-target="1" aria-label="Zu Schritt 2: Engpass" disabled>
												<span class="review-progress-step-index">2</span>
												<span class="review-progress-step-label">Engpass</span>
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
									<p class="review-step-copy">Am besten genau die Startseite oder Angebotsseite, auf der heute qualifizierte Leads hängen bleiben.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://www.beispiel.de/angebot" required autocomplete="url">
										<p class="review-field-help">Bitte nur eine konkrete Seite angeben, nicht die ganze Website.</p>
									</div>
								</div>

								<div class="review-step" data-step="1" data-review-radio-message="Bitte zuerst den Bereich mit dem größten Klärungsbedarf auswählen.">
									<span class="review-step-kicker">Schritt 2 von 4</span>
									<h4>Wo verlieren Sie heute am ehesten qualifizierte Leads?</h4>
									<p class="review-step-copy">Wählen Sie den Bereich, der auf dieser Seite zuerst wirtschaftlich geklärt werden muss.</p>

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
									<p class="review-step-copy">So wird die Rückmeldung wirtschaftlich priorisiert und nicht nur fachlich korrekt formuliert.</p>

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
									<p class="review-step-copy">Name und geschäftliche E-Mail reichen. Sie erhalten nur Rückmeldungen zu dieser Anfrage, keinen Spam.</p>
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

									<div class="review-consent-card">
										<label class="review-consent">
											<input id="review-consent-privacy" name="consent_privacy" type="checkbox" value="accepted" required data-review-required-message="Bitte bestätigen Sie den Datenschutzhinweis, damit ich Ihre Anfrage bearbeiten darf.">
											<span>
												Ich stimme zu, dass meine Angaben zur Bearbeitung des Growth Audits verarbeitet werden.
												Details stehen in der <a href="<?php echo esc_url( $privacy_url ); ?>">Datenschutzerklärung</a>.
												Sie erhalten nur auditbezogene Rückmeldungen, keinen Spam.
											</span>
										</label>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
									<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter zu Engpass</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Growth Audit anfragen</button>
								</div>

								<p class="audit-form-meta">Nur Rückmeldungen zu dieser Anfrage. DSGVO-konform, kein Spam, keine generische Tool-Auswertung.</p>

								<p class="audit-form-escape">
									Lieber direkt sprechen?
									<a href="<?php echo esc_url( $calendar_url ); ?>" target="_blank" rel="noopener noreferrer" data-track-action="cta_audit_form_escape_call" data-track-category="lead_gen">Termin buchen &rarr;</a>
								</p>
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
								<span class="review-aside-kicker">Ihre Anfrage in Klartext</span>
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
									<li>Ich prüfe die Seite manuell und verdichte die stärksten Bremsen.</li>
									<li>Sie erhalten innerhalb von 48 Stunden eine klare erste Priorisierung.</li>
								</ol>
								<p>Keine generische Checkliste. Kein Pflicht-Call. Nur ein sinnvoller erster Schritt in die Diagnose.</p>
							</div>
						</aside>
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
					<summary>Was passiert mit meinen Daten?</summary>
					<div class="faq-ans">Die Angaben werden nur zur Bearbeitung Ihrer Audit-Anfrage genutzt. Kein Newsletter-Opt-in, kein Spam, keine Weitergabe. Details stehen in der Datenschutzerklärung.</div>
				</details>
				<details>
					<summary>Ist der Einstieg wirklich kostenlos?</summary>
					<div class="faq-ans">Ja. Der Growth Audit ist der kostenlose Einstieg in die Diagnose. Er bleibt bewusst eng gefasst, damit die Rückmeldung schnell und brauchbar bleibt.</div>
				</details>
			</section>
		</main>
	</div>
</div>
