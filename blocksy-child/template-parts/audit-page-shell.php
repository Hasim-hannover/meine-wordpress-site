<?php
/**
 * Versioned growth audit landing page shell.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
$wgos_url  = nexus_get_page_url(
	[ 'wordpress-growth-operating-system', 'wgos' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$about_url = nexus_get_page_url( [ 'uber-mich' ], home_url( '/uber-mich/' ) );
?>

<div class="audit-wrapper" id="audit-main-wrapper">
	<nav class="smart-nav" aria-label="Seiten-Navigation">
		<ul>
			<li><a href="#start" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
			<li><a href="#result" title="Ergebnis"><div class="nav-dot"></div><span class="nav-text">Ergebnis</span></a></li>
			<li><a href="#quality" title="Qualität"><div class="nav-dot"></div><span class="nav-text">Qualität</span></a></li>
			<li><a href="#form" title="Formular"><div class="nav-dot"></div><span class="nav-text">Formular</span></a></li>
			<li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
		</ul>
	</nav>

	<div class="audit-container">
		<main class="audit-content">
			<section id="start" class="audit-hero-centered audit-section nx-reveal review-hero-shell">
				<div class="review-hero-layout">
					<div class="review-hero-main">
						<div class="review-hero-kicker">Growth Audit</div>
						<h1>
							Klarheit für die Seite,<br>
							<span class="text-highlight">die Anfragen tragen soll.</span>
						</h1>
						<p class="hero-sub-short">
							Keine automatisierte Standardauswertung, kein Tool-Score, kein Pflicht-Call.
							Sie erhalten eine manuell geprüfte, KI-unterstützte Ersteinschätzung dazu, wo Ihre Seite Reibung erzeugt
							und was wirtschaftlich zuerst geschärft werden sollte.
						</p>
						<p class="review-hero-note">Für Startseiten und kaufnahe Angebotsseiten mit WordPress.</p>

						<div class="audit-hero-proof" aria-label="Trust-Leiste">
							<span>0 € Einstieg</span>
							<span>persönliche Prüfung</span>
							<span>Rückmeldung in 48h</span>
						</div>

						<div class="audit-hero-actions">
							<a class="audit-submit-btn audit-hero-cta-btn" href="#form" data-track-action="cta_hero_growth_audit" data-track-category="lead_gen">Growth Audit starten</a>
						</div>
					</div>

					<aside class="review-offer-panel" aria-label="Diagnose-Rahmen">
						<span class="review-offer-kicker">Diagnose-Rahmen</span>
						<h2>Eng gefasst, damit die erste Einordnung belastbar bleibt.</h2>
						<p class="review-offer-copy">
							Der Growth Audit ist kein vollautomatischer Funnel. Er sammelt nur den Kontext,
							der für eine saubere erste Priorisierung wirklich nötig ist.
						</p>

						<div class="review-offer-list">
							<div class="review-offer-item">
								<strong>1 konkrete Seite</strong>
								<span>Am besten eine Startseite oder eine kaufnahe Angebotsseite.</span>
							</div>
							<div class="review-offer-item">
								<strong>Persönlich geprüft</strong>
								<span>Jede Anfrage wird manuell gelesen und im Kontext eingeordnet.</span>
							</div>
							<div class="review-offer-item">
								<strong>KI-unterstützt ergänzt</strong>
								<span>Muster, Schwachstellen und Potenziale werden schneller sichtbar.</span>
							</div>
						</div>

						<div class="review-offer-timeline">
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Intake</span>
								<strong>ca. 90 Sekunden mit Fokus auf Diagnosequalität</strong>
							</div>
							<div class="review-offer-timeline-item">
								<span class="review-offer-timeline-label">Rückmeldung</span>
								<strong>Persönliche Ersteinschätzung innerhalb von 48h</strong>
							</div>
						</div>
					</aside>
				</div>
			</section>

			<section id="result" class="review-value-section audit-section nx-reveal" aria-labelledby="review-value-headline">
				<div class="review-section-head">
					<span class="review-section-kicker">Ergebnis</span>
					<h2 id="review-value-headline">Kein PDF-Ballast. Eine klare erste Priorisierung.</h2>
					<p>Der Audit ist bewusst eng gefasst, damit das Ergebnis schnell lesbar und direkt nutzbar bleibt.</p>
				</div>
				<div class="review-value-grid" aria-label="Audit-Inhalte">
					<article class="review-value-card">
						<strong>die 3 stärksten Anfragebremsen</strong>
						<span>Wo Ihre Seite aktuell am meisten Reibung erzeugt.</span>
					</article>
					<article class="review-value-card">
						<strong>die wichtigste Priorität</strong>
						<span>Was wirtschaftlich zuerst geschärft werden sollte.</span>
					</article>
					<article class="review-value-card">
						<strong>ein sinnvoller nächster Schritt</strong>
						<span>Was direkt umsetzbar ist und was bewusst warten kann.</span>
					</article>
				</div>
			</section>

			<section id="quality" class="review-quality-section audit-section nx-reveal" aria-labelledby="review-quality-headline">
				<div class="review-quality-panel">
					<div class="review-section-head review-section-head--left">
						<span class="review-section-kicker">Qualität</span>
						<h2 id="review-quality-headline">Kein Massen-Audit</h2>
						<p>
							Jede Anfrage wird manuell geprüft und durch KI-gestützte Analyse ergänzt, um Muster,
							Schwachstellen und Potenziale schneller sichtbar zu machen.
						</p>
						<p>Sie erhalten keine generische Checkliste, sondern eine fundierte erste Einordnung Ihrer Seite.</p>
					</div>
					<div class="review-quality-grid">
						<article class="review-quality-card">
							<strong>Manuelle Prüfung</strong>
							<span>Ihre Seite wird nicht nur technisch, sondern auch entlang von Botschaft, Reibung und Anfrageführung gelesen.</span>
						</article>
						<article class="review-quality-card">
							<strong>KI-gestützte Analyse</strong>
							<span>Hilft, Muster und Prioritäten schneller sichtbar zu machen, ersetzt aber nicht die persönliche Einordnung.</span>
						</article>
						<article class="review-quality-card">
							<strong>Präziser Intake</strong>
							<span>Eine konkrete Seite, ein ehrlicher Kontext und ein Hauptziel sorgen für bessere Antworten und schnellere Prüfung.</span>
						</article>
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
									<h3>In unter zwei Minuten im System.</h3>
									<p>Eine Seite. Ein Ziel. Ein Kontext. Mehr braucht ein guter Diagnose-Einstieg nicht.</p>
								</div>
								<div class="review-form-eta" aria-label="Formular-Microcopy">
									<span>ca. 90 Sekunden</span>
									<span>kein Pflicht-Call</span>
									<span>persönliche Rückmeldung in 48h</span>
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
										<li>Fokus</li>
										<li>Kontext</li>
										<li>Ziel</li>
										<li>Kontakt</li>
									</ol>
								</div>

								<div class="review-step is-active" data-step="0">
									<span class="review-step-kicker">Schritt 1 von 5</span>
									<h4>Welche Seite soll ich prüfen?</h4>
									<p class="review-step-copy">Am besten eine Startseite oder eine kaufnahe Angebotsseite.</p>
									<div class="review-field-grid">
										<div class="review-field review-field-full">
											<label for="review-page-url">Seiten-URL</label>
											<input id="review-page-url" name="page_url" type="url" placeholder="https://www.beispiel.de" required autocomplete="url">
										</div>
										<div class="review-field">
											<label for="review-company">Unternehmen (optional)</label>
											<input id="review-company" name="company" type="text" placeholder="Firmenname" autocomplete="organization">
										</div>
									</div>
								</div>

								<div class="review-step" data-step="1" data-review-radio-message="Bitte den Bereich mit dem größten Klärungsbedarf auswählen.">
									<span class="review-step-kicker">Schritt 2 von 5</span>
									<h4>Wobei wünschen Sie eine Einschätzung?</h4>
									<p class="review-step-copy">Wählen Sie den Bereich, bei dem Sie aktuell den größten Klärungsbedarf sehen.</p>
									<div class="review-option-group" role="radiogroup" aria-labelledby="review-focus-heading">
										<span id="review-focus-heading" class="screen-reader-text">Bereich mit Klärungsbedarf</span>
										<label class="review-option">
											<input type="radio" name="focus_area" value="seo_visibility" required>
											<div class="review-option-copy">
												<strong data-review-label>SEO / Sichtbarkeit</strong>
												<span>Wenn die Seite zu wenig qualifizierte Besucher anzieht.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="focus_area" value="performance_cwv" required>
											<div class="review-option-copy">
												<strong data-review-label>Performance / Core Web Vitals</strong>
												<span>Wenn Ladezeit, mobile Nutzung oder technische Stabilität bremsen.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="focus_area" value="conversion_inquiry_flow" required>
											<div class="review-option-copy">
												<strong data-review-label>Conversion / Anfrageführung</strong>
												<span>Wenn Besuch nicht sauber zur Anfrage oder Kontaktaufnahme führt.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="focus_area" value="tracking_data_quality" required>
											<div class="review-option-copy">
												<strong data-review-label>Tracking / Datenqualität</strong>
												<span>Wenn Entscheidungen auf unsauberer oder lückenhafter Messung beruhen.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="focus_area" value="positioning_page_message" required>
											<div class="review-option-copy">
												<strong data-review-label>Positionierung / Seitenbotschaft</strong>
												<span>Wenn nicht klar wird, warum genau diese Seite die richtige Anfrage erzeugen soll.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="focus_area" value="not_sure_yet" required>
											<div class="review-option-copy">
												<strong data-review-label>Ich bin mir noch nicht sicher</strong>
												<span>Wenn zuerst sauber priorisiert werden soll, wo die größte Reibung liegt.</span>
											</div>
										</label>
									</div>
								</div>

								<div class="review-step" data-step="2">
									<span class="review-step-kicker">Schritt 3 von 5</span>
									<h4>Was ist aktuell die größte Herausforderung?</h4>
									<p class="review-step-copy">Ein kurzer, ehrlicher Satz reicht. Je klarer der Kontext, desto besser die Einordnung.</p>
									<div class="review-field">
										<label for="review-current-challenge">Ihre Einschätzung</label>
										<textarea id="review-current-challenge" name="current_challenge" rows="5" placeholder="„Wir haben Traffic, aber zu wenig qualifizierte Anfragen.&#10;oder&#10;Die Seite wirkt ordentlich, trägt aber die Positionierung nicht klar genug.“" required></textarea>
									</div>
								</div>

								<div class="review-step" data-step="3" data-review-radio-message="Bitte das wichtigste Ziel für diese Seite auswählen.">
									<span class="review-step-kicker">Schritt 4 von 5</span>
									<h4>Was soll die Seite konkret besser leisten?</h4>
									<p class="review-step-copy">Wählen Sie das Ziel, das für Sie aktuell am wichtigsten ist.</p>
									<div class="review-option-group" role="radiogroup" aria-labelledby="review-goal-heading">
										<span id="review-goal-heading" class="screen-reader-text">Wichtigstes Ziel</span>
										<label class="review-option">
											<input type="radio" name="primary_goal" value="more_qualified_inquiries" required>
											<div class="review-option-copy">
												<strong data-review-label>mehr qualifizierte Anfragen</strong>
												<span>Die Seite soll relevantere Kontakte und bessere Gespräche auslösen.</span>
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
											<input type="radio" name="primary_goal" value="better_google_visibility" required>
											<div class="review-option-copy">
												<strong data-review-label>bessere Sichtbarkeit bei Google</strong>
												<span>Die Seite soll organisch häufiger und relevanter gefunden werden.</span>
											</div>
										</label>
										<label class="review-option">
											<input type="radio" name="primary_goal" value="better_user_guidance_conversion" required>
											<div class="review-option-copy">
												<strong data-review-label>bessere Nutzerführung / Conversion</strong>
												<span>Der Weg vom ersten Eindruck bis zur Anfrage soll klarer werden.</span>
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
								</div>

								<div class="review-step" data-step="4">
									<span class="review-step-kicker">Schritt 5 von 5</span>
									<h4>Wohin soll die Rückmeldung gehen?</h4>
									<p class="review-step-copy">Hierhin gehen Bestätigung und persönliche Rückmeldung.</p>
									<div class="review-field-grid">
										<div class="review-field">
											<label for="review-name">Name</label>
											<input id="review-name" name="name" type="text" required autocomplete="name">
										</div>
										<div class="review-field">
											<label for="review-email">Geschäftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
										<div class="review-field review-field-full">
											<label for="review-linkedin">LinkedIn (optional)</label>
											<input id="review-linkedin" name="linkedin" type="url" placeholder="https://linkedin.com/in/..." autocomplete="url">
										</div>
										<div class="review-field review-field-full">
											<label for="review-context">Was darf ich im Audit auf keinen Fall übersehen? (optional)</label>
											<textarea id="review-context" name="extra_context" rows="4"></textarea>
										</div>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
									<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Growth Audit anfragen</button>
								</div>

								<p class="audit-form-meta">Kostenloser Einstieg. Persönliche Prüfung. Kein Tool-Score.</p>
							</form>

							<div id="review-request-success" class="review-success" hidden>
								<div class="review-success-pill">Anfrage eingegangen</div>
								<h3>Der Growth Audit ist jetzt im System.</h3>
								<p id="review-success-message" class="review-success-copy">
									Ich prüfe Ihre Seite manuell und ergänze die Einschätzung durch KI-gestützte Analyse,
									um die wichtigsten Hebel schneller sichtbar zu machen.
								</p>
								<div id="review-success-url" class="review-success-url"></div>
								<div class="review-success-meta">
									<span>Bestätigung per E-Mail</span>
									<span>persönliche Rückmeldung in 48h</span>
								</div>
								<div class="review-success-grid">
									<div class="review-success-card">
										<strong>die 3 stärksten Bremsen</strong>
										<span>Wo Ihre Seite aktuell am meisten Anfragewirkung verliert.</span>
									</div>
									<div class="review-success-card">
										<strong>die wichtigste Priorität</strong>
										<span>Was zuerst geschärft werden sollte und warum genau dort.</span>
									</div>
									<div class="review-success-card">
										<strong>ein klarer nächster Schritt</strong>
										<span>Was direkt sinnvoll ist, ohne in Aktionismus oder Audit-Ballast zu kippen.</span>
									</div>
								</div>
							</div>
						</div>

						<aside class="review-form-aside">
							<div class="review-aside-card review-aside-card-brief">
								<span class="review-aside-kicker">Diagnose-Überblick</span>
								<h4>So liest sich Ihre Anfrage gerade</h4>
								<dl class="review-brief-list">
									<div class="review-brief-row">
										<dt>Seite</dt>
										<dd data-review-summary="page_url">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Bereich</dt>
										<dd data-review-summary="focus_area">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Herausforderung</dt>
										<dd data-review-summary="current_challenge">Noch offen</dd>
									</div>
									<div class="review-brief-row">
										<dt>Ziel</dt>
										<dd data-review-summary="primary_goal">Noch offen</dd>
									</div>
								</dl>
							</div>
							<div class="review-aside-card">
								<span class="review-aside-kicker">Hilft für bessere Diagnose</span>
								<ul class="review-aside-list">
									<li>eine konkrete Seite statt einer ganzen Website</li>
									<li>ein ehrlicher Engpass statt einer allgemeinen Wunschliste</li>
									<li>das wichtigste Ziel zuerst</li>
								</ul>
							</div>
							<div class="review-aside-card">
								<span class="review-aside-kicker">Im Audit enthalten</span>
								<ul class="review-aside-list">
									<li>die 3 stärksten Anfragebremsen</li>
									<li>die wichtigste Priorität</li>
									<li>ein sinnvoller nächster Schritt</li>
								</ul>
							</div>
							<div class="review-aside-card review-aside-card-muted">
								<span class="review-aside-kicker">Bewusst eng gefasst</span>
								<p>Der Audit soll Klarheit erzeugen, nicht Dokumente. Genau deshalb fragt das Formular nur ab, was die erste Einordnung wirklich verbessert.</p>
							</div>
						</aside>
					</div>

					<div class="trust-strip">
						<div class="trust-item">
							<div class="trust-ic">01</div>
							<div><strong>Klarer Intake.</strong> Eine Seite statt zehn unsortierter Baustellen.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">02</div>
							<div><strong>Persönlich geprüft.</strong> Manuell gelesen und KI-unterstützt ergänzt.</div>
						</div>
						<div class="trust-item">
							<div class="trust-ic">03</div>
							<div><strong>Rückmeldung in 48h.</strong> Schnell genug für echte Priorisierung.</div>
						</div>
					</div>
				</div>
			</section>

			<section id="preview" class="report-preview-section audit-section nx-reveal">
				<div class="preview-text">
					<span class="preview-kicker">Beispiel</span>
					<h2>So liest sich eine erste Rückmeldung.</h2>
					<p class="preview-desc">
						Kompakt genug für schnelle Entscheidungen. Konkret genug, um Botschaft, Reibung und Anfrageführung gezielt zu schärfen.
					</p>
					<div class="preview-deliverables" aria-label="Beispielhafte Audit-Bausteine">
						<div class="preview-deliverable">
							<strong>3 stärkste Bremsen</strong>
							<span>Wo die Seite aktuell Vertrauen, Klarheit oder Handlung verliert.</span>
						</div>
						<div class="preview-deliverable">
							<strong>1 klare Priorität</strong>
							<span>Was zuerst Wirkung bringt und was bewusst warten kann.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Kurze Begründung</strong>
							<span>Warum genau dieser Hebel wirtschaftlich zuerst zählt.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Nächster Schritt</strong>
							<span>Kleine Korrektur oder tieferer Blueprint, wenn es struktureller wird.</span>
						</div>
					</div>
				</div>
				<div class="preview-visual">
					<div class="review-output-card">
						<span class="review-output-kicker">Redigiertes Beispiel</span>
						<div class="review-output-row">
							<strong>Stärkste Anfragebremse</strong>
							<span>Der erste Screen erklärt nicht klar genug, für wen die Seite ist und warum genau jetzt eine Anfrage sinnvoll wäre.</span>
						</div>
						<div class="review-output-row">
							<strong>Warum das bremst</strong>
							<span>Besucher verstehen das Angebot nur grob. Dadurch verliert die Seite Relevanz, bevor Proof oder nächste Schritte überhaupt greifen können.</span>
						</div>
						<div class="review-output-row">
							<strong>Wirtschaftlich zuerst schärfen</strong>
							<span>Hero, Subline und CTA priorisieren, bevor weitere Detailoptimierungen oder ein größerer Seitenumbau angegangen werden.</span>
						</div>
						<div class="review-output-note">Wenn danach weitere Brüche sichtbar bleiben, ist der nächste sinnvolle Schritt ein tieferer Growth Blueprint.</div>
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
					<summary>Ist der Growth Audit kostenlos?</summary>
					<div class="faq-ans">Ja. Der Einstieg ist kostenlos und bewusst eng gefasst, damit die Rückmeldung schnell lesbar und direkt nutzbar bleibt.</div>
				</details>
				<details>
					<summary>Muss ich danach einen Call buchen?</summary>
					<div class="faq-ans">Nein. Die Rückmeldung kommt ohne Pflicht-Call. Wenn danach Gesprächsbedarf entsteht, ist das ein separater nächster Schritt.</div>
				</details>
				<details>
					<summary>Welche Seiten passen am besten?</summary>
					<div class="faq-ans">Vor allem Startseiten und kaufnahe Angebotsseiten in WordPress, die bereits Anfragen tragen sollen.</div>
				</details>
				<details>
					<summary>Wie präzise muss das Formular ausgefüllt sein?</summary>
					<div class="faq-ans">Kurz reicht. Eine konkrete Seite, ein ehrlicher Engpass und das wichtigste Ziel verbessern die Diagnosequalität bereits deutlich.</div>
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
