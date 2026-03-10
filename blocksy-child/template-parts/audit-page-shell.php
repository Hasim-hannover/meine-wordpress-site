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
$call_url  = apply_filters( 'nexus_audit_calendar_url', apply_filters( 'nexus_review_calendar_url', 'https://cal.com/hasim/30min' ) );
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
				<section id="start" class="audit-hero-centered audit-section nx-reveal review-hero-shell">
					<div class="review-hero-layout">
						<div class="review-hero-main">
								<div class="audit-hero-featured-image" style="margin-bottom:2rem;">
									<img src="https://hasimuener.de/wp-content/uploads/2026/03/growth-audit-featured-1.png" alt="Growth Audit Beitragsbild" style="max-width:420px; width:100%; border-radius:1.2rem; box-shadow:0 4px 24px rgba(0,0,0,0.08);">
								</div>
							<div class="hero-pill">Growth Audit · kostenlos · persönlich · 48h</div>
							<div class="review-hero-kicker">Für B2B-Unternehmen mit WordPress und kaufnahen Seiten</div>
							<h1>
								Klarheit für die Seite,<br>
								<span class="text-highlight">die Anfragen tragen soll.</span>
							</h1>
							<p class="hero-sub-short">
								Kein Punktesalat, kein Redesign-Geschwätz, kein Call-Zwang.
								Sie erfahren, wo Botschaft, Proof oder nächster Schritt Nachfrage verlieren
								und was wirtschaftlich zuerst geschärft werden sollte.
							</p>

							<div class="audit-hero-actions">
								<?php $cta_url = apply_filters( 'nexus_audit_calendar_url', 'https://cal.com/hasim/30min' ); ?>
								<a class="audit-submit-btn audit-hero-cta-btn" href="<?php echo esc_url( $cta_url ); ?>" data-track-action="cta_hero_growth_audit" data-track-category="lead_gen">Growth Audit starten</a>
								<a class="audit-ghost-btn" href="#preview">Beispiel ansehen</a>
								<div class="audit-hero-microtext" style="margin-top:0.8rem; font-size:0.95rem; color:#666;">
									⏱️ 30-minütiges Gespräch – klare Einschätzung, kein Verkaufsdruck.
								</div>
							</div>

							<div class="audit-hero-proof" aria-label="Schnelle Orientierung">
								<span>Antwort in 48h</span>
								<span>1 Seite statt Komplett-Audit</span>
								<span>Persönliche Priorisierung</span>
							</div>

							<div class="review-kpi-strip" aria-label="Growth-Audit-Überblick">
								<div class="review-kpi">
									<strong>0 EUR Einstieg</strong>
									<span>Audit ohne Pflicht-Call oder Tool-Score.</span>
								</div>
								<div class="review-kpi">
									<strong>1 Seite, 1 Ziel</strong>
									<span>Startseite oder kaufnahe Angebotsseite mit echtem Anfragefokus.</span>
								</div>
								<div class="review-kpi">
									<strong>3 Outputs</strong>
									<span>Bremsen, Priorität, nächster sinnvoller Schritt.</span>
								</div>
							</div>
						</div>

						<aside class="review-offer-panel" aria-label="Offer Snapshot">
							<span class="review-offer-kicker">Was Sie danach wirklich in der Hand haben</span>
							<h2>Eine klare Entscheidung statt eines dicken Audit-Dokuments.</h2>
							<p class="review-offer-copy">
								Der Audit ist bewusst eng gefasst, damit das Ergebnis schnell lesbar und direkt
								nutzbar bleibt.
							</p>

							<div class="review-offer-list">
								<div class="review-offer-item">
									<strong>Wo die Seite gerade Reibung erzeugt</strong>
									<span>Hero, Proof, CTA oder Nachfrageführung.</span>
								</div>
								<div class="review-offer-item">
									<strong>Was zuerst Wirkung bringt</strong>
									<span>Eine Priorität statt zehn lose Empfehlungen.</span>
								</div>
								<div class="review-offer-item">
									<strong>Wie tief der nächste Schritt sein sollte</strong>
									<span>Kleine Korrektur, Blueprint oder Umsetzung.</span>
								</div>
							</div>

							<div class="review-offer-timeline">
								<div class="review-offer-timeline-item">
									<span class="review-offer-timeline-label">Heute</span>
									<strong>Sie schicken Seite und Kontext</strong>
								</div>
								<div class="review-offer-timeline-item">
									<span class="review-offer-timeline-label">In 48h</span>
									<strong>Sie erhalten die persönliche Priorisierung</strong>
								</div>
							</div>

							<a class="review-inline-link" href="<?php echo esc_url( $cases_url ); ?>">Case Study ansehen -&gt;</a>
						</aside>
					</div>
				</section>

				<section class="review-proof-band audit-section nx-reveal" aria-labelledby="review-proof-headline">
					<div class="review-proof-head">
						<span class="review-proof-kicker">Proof aus dokumentierten Projekten</span>
						<h2 id="review-proof-headline">Die Substanz kommt aus echter Nachfragewirkung.</h2>
						<p class="review-proof-copy">
							Nicht aus Audit-Behauptungen, sondern aus dokumentierter Conversion-, Performance- und Demand-Gen-Arbeit.
						</p>
					</div>
					<div class="review-proof-grid" aria-label="Ausgewählte Kennzahlen">
						<div class="review-proof-card">
							<strong>1.750+ Leads</strong>
							<span>Dokumentierte Nachfragewirkung statt Traffic ohne Folge.</span>
						</div>
						<div class="review-proof-card">
							<strong>-83 % CPL</strong>
							<span>Weniger Reibung schlägt nicht selten mehr Budget.</span>
						</div>
						<div class="review-proof-card">
							<strong>12-15 % Sales-Conversion</strong>
							<span>Anfragen zählen erst, wenn daraus echte Gespräche werden.</span>
						</div>
						<div class="review-proof-card">
							<strong>98 Mobile Performance</strong>
							<span>Mobile Eindruck und Ladezeit werden nicht dem Zufall überlassen.</span>
						</div>
					</div>
					<p class="review-proof-note">
						Beispielhafte Kennzahlen aus dokumentierten Projekten auf dieser Seite.
						<a class="review-inline-link" href="<?php echo esc_url( $cases_url ); ?>">Case Study ansehen -&gt;</a>
					</p>
				</section>

				<section class="review-fit-section audit-section nx-reveal" aria-labelledby="review-fit-headline">
					<div class="review-fit-grid">
						<article class="review-fit-card">
							<span class="review-fit-kicker">Passt gut</span>
							<h2 id="review-fit-headline">Wenn diese Seite bereits Wirkung haben soll</h2>
							<div class="review-fit-pills" aria-label="Passende Situationen">
								<span class="review-fit-pill">B2B + WordPress</span>
								<span class="review-fit-pill">klare Anfrageabsicht</span>
								<span class="review-fit-pill">Traffic oder Kampagnen laufen schon</span>
								<span class="review-fit-pill">Team will erst priorisieren</span>
							</div>
							<p class="review-fit-note">Ideal für Startseiten und kaufnahe Angebotsseiten, die nicht länger nur okay aussehen, sondern sauber verkaufen sollen.</p>
						</article>
						<article class="review-fit-card review-fit-card-muted">
							<span class="review-fit-kicker">Bewusst nicht</span>
							<h2>Nicht für Gratis-Relaunches ohne Fokus</h2>
							<div class="review-fit-pills" aria-label="Unpassende Situationen">
								<span class="review-fit-pill review-fit-pill-muted">Hobby-Projekte</span>
								<span class="review-fit-pill review-fit-pill-muted">reine Visitenkarten-Seiten</span>
								<span class="review-fit-pill review-fit-pill-muted">unklares Angebot</span>
								<span class="review-fit-pill review-fit-pill-muted">Komplett-Relaunch im Gratis-Mantel</span>
							</div>
							<p class="review-fit-note">Der Audit ist absichtlich präzise. Sonst wird er zu allgemein und damit zu schwach.</p>
						</article>
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
									<div class="review-form-eta" aria-label="Audit-Rahmen">
										<span>ca. 90 Sek.</span>
										<span>Kein Call-Zwang</span>
										<span>Antwort in 48h</span>
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
										<li>Ziel</li>
										<li>Zielgruppe</li>
										<li>Problem</li>
										<li>Kontakt</li>
									</ol>
								</div>

								<div class="review-step is-active" data-step="0">
									<span class="review-step-kicker">Schritt 1 von 5</span>
									<h4>Welche Seite soll ich prüfen?</h4>
									<p class="review-step-copy">Startseite oder kaufnahe Angebotsseite.</p>
									<div class="review-field">
										<label for="review-page-url">Seiten-URL</label>
										<input id="review-page-url" name="page_url" type="url" placeholder="https://ihre-seite.de" required autocomplete="url">
									</div>
								</div>

								<div class="review-step" data-step="1">
									<span class="review-step-kicker">Schritt 2 von 5</span>
										<h4>Was soll diese Seite konkret auslösen?</h4>
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
									<h4>Wo vermuten Sie gerade den größten Hebelverlust?</h4>
									<p class="review-step-copy">Wählen Sie den wahrscheinlichsten Hebel. Das hilft bei der Einordnung.</p>
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
											<input type="radio" name="biggest_issue" value="weak_proof" required>
											<span>Proof und Vertrauen greifen zu spät</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="weak_conversion" required>
												<span>Die Seite führt nicht sauber zur Anfrage</span>
										</label>
										<label class="review-option">
											<input type="radio" name="biggest_issue" value="second_opinion" required>
											<span>Ich brauche eine zweite strategische Einordnung</span>
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
											<label for="review-company">Unternehmen</label>
											<input id="review-company" name="company" type="text" required autocomplete="organization">
										</div>
										<div class="review-field review-field-full">
											<label for="review-email">Geschäftliche E-Mail</label>
											<input id="review-email" name="email" type="email" required autocomplete="email">
										</div>
										<div class="review-field review-field-full">
											<label for="review-context">Optional: Was darf ich im Audit auf keinen Fall übersehen?</label>
											<textarea id="review-context" name="extra_context" rows="4" placeholder="Zum Beispiel: Die Seite geht nächste Woche in eine Kampagne oder ist bereits zentral für Sales."></textarea>
										</div>
									</div>
								</div>

								<div id="review-form-feedback" class="review-form-feedback" aria-live="polite"></div>

								<div class="review-actions">
										<button type="button" class="review-prev-btn" data-review-prev hidden>Zurück</button>
									<button type="button" class="audit-submit-btn" data-review-next>Weiter</button>
									<button type="submit" class="audit-submit-btn" data-review-submit hidden>Growth Audit anfordern</button>
								</div>

								<p class="audit-form-meta">
									0 € Einstieg. Kein Pflicht-Call. Persönliche Priorisierung statt Tool-Score.
								</p>
							</form>

							<div id="review-request-success" class="review-success" hidden>
								<div class="review-success-pill">Anfrage eingegangen</div>
								<h3>Der Growth Audit ist jetzt im System.</h3>
								<p id="review-success-message" class="review-success-copy">
									Sie erhalten innerhalb von 48 Stunden eine persönliche Rückmeldung zu Ihrer Seite.
								</p>
								<div id="review-success-url" class="review-success-url"></div>
								<div class="review-success-meta">
									<span>Die Bestätigung geht jetzt per E-Mail raus.</span>
									<span>Wenn es zeitkritisch ist, können Sie direkt einen Termin ziehen.</span>
								</div>
								<div class="review-success-timeline" aria-label="Nächste Schritte">
									<div class="review-success-timeline-item">
										<strong>1. Eingang bestätigt</strong>
										<span>Ihre Seite und Ihr Kontext sind sauber im System.</span>
									</div>
									<div class="review-success-timeline-item">
										<strong>2. Priorisierung in 48h</strong>
										<span>Sie erhalten keine Checkliste, sondern eine Reihenfolge.</span>
									</div>
									<div class="review-success-timeline-item">
										<strong>3. Nächster Schritt wird klar</strong>
										<span>Korrektur, Blueprint oder Umsetzung im passenden Umfang.</span>
									</div>
								</div>
								<div class="review-success-grid">
									<div class="review-success-card">
										<strong>3 stärkste Anfragebremsen</strong>
										<span>Keine Vollanalyse, sondern die Punkte mit der größten Hebelwirkung.</span>
									</div>
									<div class="review-success-card">
										<strong>1 klare Priorität</strong>
										<span>Was zuerst Wirkung bringt und was bewusst warten kann.</span>
									</div>
									<div class="review-success-card">
										<strong>Nächster sinnvoller Schritt</strong>
										<span>Kleine Korrektur, Blueprint oder Umsetzung im passenden Umfang.</span>
									</div>
								</div>
								<div class="review-success-actions">
									<a class="audit-submit-btn review-success-link" href="<?php echo esc_url( $call_url ); ?>" target="_blank" rel="noopener">Wenn es dringend ist: Direkt Strategie-Termin buchen</a>
								</div>
							</div>
						</div>

							<aside class="review-form-aside">
								<div class="review-aside-card review-aside-card-brief">
									<span class="review-aside-kicker">Live-Briefing</span>
									<h4>So liest sich Ihre Anfrage gerade</h4>
									<dl class="review-brief-list">
										<div class="review-brief-row">
											<dt>Seite</dt>
											<dd data-review-summary="page_url">Noch offen</dd>
										</div>
										<div class="review-brief-row">
											<dt>Ziel</dt>
											<dd data-review-summary="offer">Noch offen</dd>
										</div>
										<div class="review-brief-row">
											<dt>Zielgruppe</dt>
											<dd data-review-summary="audience">Noch offen</dd>
										</div>
										<div class="review-brief-row">
											<dt>Hebel</dt>
											<dd data-review-summary="biggest_issue">Noch offen</dd>
										</div>
									</dl>
								</div>
								<div class="review-aside-card">
									<span class="review-aside-kicker">Im Growth Audit enthalten</span>
									<h4>Kurz. Klar. Nutzbar.</h4>
									<ul class="review-aside-list">
										<li>Die 3 stärksten Anfragebremsen</li>
										<li>Die wichtigste Priorität</li>
										<li>Ein sinnvoller nächster Schritt</li>
									</ul>
								</div>
								<div class="review-aside-card review-aside-card-muted">
									<span class="review-aside-kicker">Warum das funktioniert</span>
									<p>Der Audit bleibt eng. Sonst entsteht mehr Dokumentation als Entscheidungsklarheit.</p>
								</div>
								<div class="review-aside-card review-aside-card-muted">
									<span class="review-aside-kicker">Wenn mehr zusammenhängt</span>
									<p>Wenn Positionierung, Proof, Tracking und Conversion gemeinsam bremsen, ist der nächste Schritt ein tieferer Blueprint statt Stückwerk.</p>
								</div>
							</aside>
						</div>

						<div class="trust-strip">
							<div class="trust-item">
								<div class="trust-ic">01</div>
								<div><strong>0 € Einstieg.</strong> Kostenloser Audit ohne Pflicht-Call.</div>
							</div>
							<div class="trust-item">
								<div class="trust-ic">02</div>
								<div><strong>Persönlich in 48h.</strong> Keine Bot-Ausgabe von der Stange.</div>
							</div>
							<div class="trust-item">
								<div class="trust-ic">03</div>
								<div><strong>Klare Priorität.</strong> Erst der stärkste Hebel.</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="journey" class="journey-preview audit-section nx-reveal">
				<h2 class="journey-headline">So läuft der Growth Audit ab</h2>
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
					<span class="preview-kicker">So sieht das Ergebnis aus</span>
					<h2>Keine Textwand.<br>Eine klare Entscheidungsgrundlage.</h2>
					<p class="preview-desc">
						Kompakt genug für schnelle Entscheidungen. Konkret genug, um Hero, Proof und nächsten Schritt gezielt zu schärfen.
					</p>
					<div class="preview-deliverables" aria-label="Audit-Inhalte">
						<div class="preview-deliverable">
							<strong>3 stärkste Bremsen</strong>
							<span>Wo die Seite gerade Vertrauen oder Anfragen verliert.</span>
						</div>
						<div class="preview-deliverable">
							<strong>1 Priorität</strong>
							<span>Was zuerst Wirkung bringt und was warten kann.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Begründung</strong>
							<span>Warum genau dieser Hebel wirtschaftlich relevant ist.</span>
						</div>
						<div class="preview-deliverable">
							<strong>Nächster Schritt</strong>
							<span>Kleine Korrektur oder tieferer Growth Blueprint.</span>
						</div>
					</div>
				</div>
				<div class="preview-visual">
					<div class="review-output-card">
						<span class="review-output-kicker">Redigiertes Beispiel</span>
						<div class="review-output-row">
							<strong>Stärkste Anfragebremse</strong>
							<span>Der erste Screen erklärt nicht klar, für wen die Seite ist und warum jetzt gehandelt werden sollte.</span>
						</div>
						<div class="review-output-row">
							<strong>Warum das bremst</strong>
							<span>Traffic versteht das Angebot nur grob. Dadurch verliert die Seite Relevanz, bevor Proof überhaupt wirken kann.</span>
						</div>
						<div class="review-output-row">
							<strong>Zuerst anpassen</strong>
							<span>Hero, Subline und CTA vor dem restlichen Seitenumbau schärfen. Danach Proof konsequent höher ziehen.</span>
						</div>
						<div class="review-output-note">Wenn danach weiter strukturelle Brüche sichtbar bleiben, ist der nächste Schritt ein tieferer Growth Blueprint.</div>
					</div>
				</div>
			</section>

			<section class="review-ladder-section audit-section nx-reveal" aria-labelledby="review-ladder-headline">
				<div class="review-ladder-head">
					<span class="preview-kicker">Danach</span>
					<h2 id="review-ladder-headline">Was nach dem Growth Audit passiert</h2>
					<p class="review-ladder-copy">
						Der Audit ist kein Selbstzweck. Er entscheidet, ob eine kleine Korrektur reicht oder ob ein tieferer Blueprint wirtschaftlich sinnvoll ist.
					</p>
				</div>
				<div class="review-ladder-grid">
					<article class="review-ladder-card">
						<div class="review-ladder-step">01</div>
						<h3>Kleine Korrektur reicht</h3>
						<p>Dann sage ich es direkt. Sie gehen mit klarer Priorität und einer kurzen To-do-Liste zurück ins Team.</p>
					</article>
					<article class="review-ladder-card">
						<div class="review-ladder-step">02</div>
						<h3>Growth Blueprint sinnvoll</h3>
						<p>Wenn Positionierung, Struktur, Tracking oder Conversion zusammen bremsen, ist der nächste Schritt ein tieferer Blueprint statt isolierter To-dos.</p>
					</article>
					<article class="review-ladder-card">
						<div class="review-ladder-step">03</div>
						<h3>Umsetzung im System</h3>
						<p>Wenn Richtung und Priorität klar sind, kann daraus die Umsetzung im WordPress-System folgen.</p>
					</article>
				</div>
			</section>

			<section id="faq" class="audit-faq-section audit-section nx-reveal">
				<h2 class="audit-faq-headline">Häufige Fragen</h2>
				<details>
					<summary>Was genau bekomme ich innerhalb von 48 Stunden?</summary>
					<div class="faq-ans">Drei wichtigste Bremsen, eine klare Priorität und ein sinnvoller nächster Schritt.</div>
				</details>
				<details>
					<summary>Ist der Growth Audit kostenlos?</summary>
					<div class="faq-ans">Ja. Der Einstieg ist bewusst kostenlos und ohne Pflicht-Call. Wenn ein tieferer Blueprint sinnvoll ist, sage ich das erst nach dem Audit.</div>
				</details>
				<details>
					<summary>Ist das nur für Startseiten gedacht?</summary>
					<div class="faq-ans">Am besten für Startseiten und kaufnahe Angebotsseiten.</div>
				</details>
				<details>
					<summary>Für wen ist das nicht gedacht?</summary>
					<div class="faq-ans">Nicht für Hobby-Projekte, reine Visitenkarten-Seiten oder Briefings, die eigentlich schon einen kompletten Relaunch meinen.</div>
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
