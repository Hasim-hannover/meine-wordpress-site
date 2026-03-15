<?php
/**
 * Front Page Template
 *
 * Versioned homepage structure with a fixed premium conversion flow.
 * SEO-Meta bleibt zentral in inc/seo-meta.php.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$urls  = function_exists( 'hu_home_urls' ) ? hu_home_urls() : [];
$proof = function_exists( 'hu_home_public_proof_data' ) ? hu_home_public_proof_data() : [];

$audit_url   = $urls['audit'] ?? home_url( '/growth-audit/' );
$wgos_url    = $urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' );
$cases_url   = $urls['cases'] ?? home_url( '/ergebnisse/' );
$agentur_url = $urls['agentur'] ?? home_url( '/wordpress-agentur-hannover/' );
$blog_url    = $urls['blog'] ?? home_url( '/blog/' );
$about_url   = $urls['about'] ?? home_url( '/uber-mich/' );
$e3_url      = $urls['e3'] ?? home_url( '/e3-new-energy/' );
$github_url  = $urls['github_repo'] ?? '';
$linkedin_url = $urls['linkedin'] ?? '';

$hero_metrics = [
	[
		'value'   => '3.000+',
		'label'   => 'qualifizierte Leads',
		'context' => 'in 18 Monaten aus einem aufgebauten System',
	],
	[
		'value'   => '-83%',
		'label'   => 'Kosten pro Lead',
		'context' => 'nach Neuordnung von Positionierung, Daten und Conversion-Pfad',
	],
	[
		'value'   => '<0.8s',
		'label'   => 'LCP auf Kernseiten',
		'context' => 'wenn Angebotsseiten technisch und argumentativ zusammenpassen',
	],
];

$system_layers = [
	[
		'label'  => 'Ebene 1',
		'title'  => 'Öffentliche Website',
		'text'   => 'Startseite, Angebotsseiten, Proof und interne Wege bilden die sichtbare Vertriebsoberfläche.',
		'items'  => [
			'klare Positionierung',
			'Money Pages',
			'Proof-Seiten',
			'nächster Schritt sichtbar',
		],
		'result' => 'Besucher verstehen schneller, warum Sie relevant sind und was sie als Nächstes tun sollen.',
	],
	[
		'label'  => 'Ebene 2',
		'title'  => 'Mess- und Datenebene',
		'text'   => 'Consent, Events, Conversion-Signale und Performance-Daten liefern belastbare Entscheidungsgrundlagen.',
		'items'  => [
			'privacy-first Tracking',
			'Conversion-Signale',
			'Consent sauber abgestimmt',
			'SEO- und Performance-Daten',
		],
		'result' => 'Sie sehen nicht nur Traffic, sondern wo Reibung, Nachfrage und Qualität tatsächlich entstehen.',
	],
	[
		'label'  => 'Ebene 3',
		'title'  => 'Kundencockpit',
		'text'   => 'Leads, Engpässe und Prioritäten werden in eine lesbare Steueransicht übersetzt.',
		'items'  => [
			'Lead-Qualität',
			'Engpässe',
			'Prioritäten',
			'nächste 30 bis 90 Tage',
		],
		'result' => 'Weniger Dashboard-Theater, mehr Orientierung für Marketing, Vertrieb und Geschäftsführung.',
	],
	[
		'label'  => 'Ebene 4',
		'title'  => 'Kontrollierte Weiterentwicklung',
		'text'   => 'Saubere Codebasis, Versionierung und ein schlanker Stack halten WordPress wartbar und erweiterbar.',
		'items'  => [
			'GitHub und Versionierung',
			'kontrollierte Deployments',
			'Ownership statt Lock-in',
			'wartbare Umgebung',
		],
		'result' => 'Änderungen bleiben nachvollziehbar und die Plattform wird nicht mit jedem Eingriff fragiler.',
	],
];

$faq_items = [
	[
		'question' => 'Was unterscheidet Sie von einer klassischen WordPress-Agentur?',
		'answer'   => 'Ich verkaufe nicht zuerst Seiten oder Leistungslisten. Ich ordne WordPress als Business-Plattform für Sichtbarkeit, Anfrageführung, Messbarkeit und kontrollierte Weiterentwicklung.',
	],
	[
		'question' => 'Brauchen wir danach überhaupt noch Ads?',
		'answer'   => 'Möglicherweise. Aber erst dann, wenn Positionierung, Proof, Datensignale und Conversion-Pfade stehen. Ads sind bei mir ein Verstärker, nicht das Betriebssystem.',
	],
	[
		'question' => 'Was bedeutet privacy-first Measurement konkret?',
		'answer'   => 'Consent, Tracking und Conversion-Signale werden so aufgebaut, dass Entscheidungen belastbar werden, ohne WordPress in eine Daten-Blackbox zu verwandeln.',
	],
];

get_header();
?>

<main id="main" class="site-main" data-track-section="homepage">
	<div class="cs-page homepage-template">
		<nav class="smart-nav" aria-label="Seitennavigation">
			<ul>
				<li><a href="#hero" title="Start"><span class="nav-dot"></span><span class="nav-text">Start</span></a></li>
				<li><a href="#proof" title="Track Record"><span class="nav-dot"></span><span class="nav-text">Proof</span></a></li>
				<li><a href="#problem" title="Problem-Frame"><span class="nav-dot"></span><span class="nav-text">Problem</span></a></li>
				<li><a href="#system" title="WGOS"><span class="nav-dot"></span><span class="nav-text">WGOS</span></a></li>
				<li><a href="#case" title="Case"><span class="nav-dot"></span><span class="nav-text">Case</span></a></li>
				<li><a href="#faq" title="FAQ"><span class="nav-dot"></span><span class="nav-text">FAQ</span></a></li>
			</ul>
		</nav>

		<section id="hero" class="wp-hero wp-home-hero" role="banner">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-hero__grid">
					<div class="wp-hero-copy wp-home-hero__copy">
						<span class="wp-badge nx-reveal">WordPress Growth Architect für B2B</span>
						<h1 class="wp-hero-title nx-reveal">
							Ich mache aus Ihrer<br><span>WordPress-Website ein planbares Anfragesystem.</span>
						</h1>
						<p class="wp-hero-subtitle wp-home-hero__subtitle nx-reveal">
							Für B2B-Unternehmen, die aus WordPress klare Positionierung, belastbare Messbarkeit und planbare Anfrageführung machen wollen.
						</p>

						<div class="wp-home-hero__actions nx-reveal">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-btn wp-btn-primary wp-home-hero__primary" data-track-action="cta_home_hero_audit" data-track-category="lead_gen">Audit starten</a>
							<a href="<?php echo esc_url( $cases_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_hero_cases" data-track-category="trust">Ergebnisse ansehen</a>
						</div>
						<p class="nx-cta-microcopy nx-reveal">0 € · Rückmeldung in 48h · kein Pflicht‑Call</p>

						<p class="wp-home-hero__support nx-reveal">
							Lokaler Einstieg für Hannover:
							<a href="<?php echo esc_url( $agentur_url ); ?>" data-track-action="cta_home_hero_agentur" data-track-category="navigation">WordPress für B2B in Hannover</a>
						</p>
					</div>

					<aside class="wp-home-hero-card nx-reveal" aria-labelledby="home-hero-card-title">
						<span class="wp-home-hero-card__eyebrow">Diagnose vor Umsetzung</span>
						<h2 id="home-hero-card-title" class="wp-home-hero-card__title">Der erste Schritt ist nicht mehr Output. Sondern mehr Klarheit.</h2>
						<p class="wp-home-hero-card__text">
							Im Growth Audit prüfen wir, wo WordPress heute Nachfrage verliert: bei Positionierung, Datensignalen oder im nächsten Conversion-Schritt.
						</p>
						<ul class="wp-home-hero-card__list" aria-label="Audit-Schwerpunkte">
							<li>Kaufnahe Seiten und Argumentationslogik</li>
							<li>Tracking, Consent und echte Entscheidungssignale</li>
							<li>Proof, CTA-Führung und der nächste sinnvolle Schritt</li>
						</ul>
						<p class="wp-home-hero-card__note">Kein Pitch. Keine Maßnahmensammlung. Erst Diagnose, dann Priorisierung.</p>
					</aside>
				</div>

				<div class="wp-home-kpi-row nx-reveal" role="list" aria-label="Track-Record im Hero">
					<?php foreach ( $hero_metrics as $metric ) : ?>
						<article class="wp-home-kpi-card" role="listitem">
							<span class="wp-home-kpi-card__value"><?php echo esc_html( $metric['value'] ); ?></span>
							<span class="wp-home-kpi-card__label"><?php echo esc_html( $metric['label'] ); ?></span>
							<span class="wp-home-kpi-card__context"><?php echo esc_html( $metric['context'] ); ?></span>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<div class="wp-mobile-cta-bar" data-home-mobile-cta aria-label="Schneller Audit-Einstieg">
			<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-btn wp-btn-primary" data-track-action="cta_mobile_sticky_audit" data-track-category="lead_gen">Audit starten</a>
		</div>

		<section id="proof" class="wp-section homepage-track-record" data-track-section="homepage_proof">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Track Record</span>
					<h2 class="wp-section-h2">Proof soll Risiko senken. Nicht die Seite lauter machen.</h2>
					<p class="wp-section-p">Deshalb kommt er früh, konkret und in klarer Reihenfolge: sichtbare Wirkung, Erfahrung und öffentliche Nachvollziehbarkeit.</p>
				</div>

				<div class="homepage-track-record__grid">
					<article class="wp-success-card homepage-track-record__card nx-reveal">
						<p class="wp-success-subtitle">Öffentlicher Case Proof</p>
						<h3 class="wp-success-title">E3 New Energy</h3>
						<p class="homepage-track-record__lead">E3 startete mit 150 EUR CPL ohne messbare Leadqualität. Nach Neuordnung von Positionierung, Tracking und Conversion-Pfad:</p>
						<div class="homepage-track-record__metrics" role="list" aria-label="E3 Kennzahlen">
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">1.750+</span>
								<span class="homepage-track-record__metric-label">qualifizierte Leads</span>
							</div>
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">12&nbsp;%</span>
								<span class="homepage-track-record__metric-label">Sales-Conversion</span>
							</div>
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">34x</span>
								<span class="homepage-track-record__metric-label">ROAS-Spitze</span>
							</div>
						</div>
						<a href="<?php echo esc_url( $e3_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_proof_e3" data-track-category="trust">Case Study lesen</a>
					</article>

					<article class="wp-success-card homepage-track-record__card nx-reveal">
						<p class="wp-success-subtitle">Experience Proof</p>
						<h3 class="wp-success-title">B2B-, Performance- und Whitelabel-Praxis</h3>
						<p class="homepage-track-record__lead">Nicht aus Theorie, sondern aus echten Projekten mit Sichtbarkeits-, Daten- und Anfrageproblemen.</p>
						<ul class="premium-list homepage-track-record__list">
							<li><span class="check-icon">✓</span><div>8+ Jahre Praxis in B2B, Performance und Conversion</div></li>
							<li><span class="check-icon">✓</span><div>öffentliche und nicht öffentliche Projekte mit denselben systemischen Hebeln</div></li>
							<li><span class="check-icon">✓</span><div>WordPress, SEO, Tracking und CRO nicht getrennt, sondern als Verbund gedacht</div></li>
						</ul>
						<a href="<?php echo esc_url( $about_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_proof_about" data-track-category="navigation">Arbeitsweise ansehen</a>
					</article>

					<article class="wp-success-card homepage-track-record__card nx-reveal">
						<p class="wp-success-subtitle">Öffentliche Nachvollziehbarkeit</p>
						<h3 class="wp-success-title">Transparent statt Blackbox</h3>
						<p class="homepage-track-record__lead">Eigene Systeme, Entscheidungen und Weiterentwicklung sind öffentlich nachvollziehbar, nicht nur im Sales-Call erzählt.</p>
						<div class="homepage-track-record__public-proof" role="list" aria-label="Öffentliche Proof-Signale">
							<div class="homepage-track-record__public-item" role="listitem">
								<strong><?php echo esc_html( number_format_i18n( $proof['github_commits'] ?? 701 ) ); ?></strong>
								<span>Commits im öffentlichen Repo</span>
							</div>
							<div class="homepage-track-record__public-item" role="listitem">
								<strong><?php echo esc_html( number_format_i18n( $proof['linkedin_followers'] ?? 569 ) ); ?></strong>
								<span>LinkedIn-Follower</span>
							</div>
							<div class="homepage-track-record__public-item" role="listitem">
								<strong><?php echo esc_html( number_format_i18n( $proof['linkedin_posts'] ?? 20 ) ); ?></strong>
								<span>öffentliche Fachbeiträge</span>
							</div>
						</div>
						<div class="homepage-track-record__public-links">
							<?php if ( $github_url ) : ?>
								<a href="<?php echo esc_url( $github_url ); ?>" class="wp-home-text-link" target="_blank" rel="noopener noreferrer" data-track-action="cta_home_proof_github" data-track-category="trust">GitHub ansehen</a>
							<?php endif; ?>
							<?php if ( $linkedin_url ) : ?>
								<a href="<?php echo esc_url( $linkedin_url ); ?>" class="wp-home-text-link" target="_blank" rel="noopener noreferrer" data-track-action="cta_home_proof_linkedin" data-track-category="trust">LinkedIn ansehen</a>
							<?php endif; ?>
						</div>
					</article>
				</div>

				<div class="homepage-track-record__cta nx-reveal">
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_home_proof_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<p class="homepage-track-record__cta-note">Mehr Proof im Detail? <a href="<?php echo esc_url( $cases_url ); ?>" data-track-action="cta_home_proof_results" data-track-category="trust">Alle Ergebnisse ansehen</a></p>
				</div>
			</div>
		</section>

		<section id="problem" class="wp-section homepage-problem-frame" data-track-section="homepage_problem">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Problem-Frame</span>
					<h2 class="wp-section-h2">Viele WordPress-Seiten erzeugen Traffic. Aber kein steuerbares Nachfrage-System.</h2>
					<p class="wp-section-p">Der Engpass ist selten nur Design. Meist fehlt die Verbindung zwischen Positionierung, Datensignalen, Proof und dem nächsten sinnvollen Schritt.</p>
				</div>

				<div class="homepage-problem-frame__grid">
					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--muted nx-reveal">
						<p class="wp-success-subtitle">Modell A</p>
						<h3 class="wp-success-title">Nachfrage mieten, während die Seite intern verliert</h3>
						<ul class="premium-list">
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Klicks werden teurer, während Proof, CTA und Seitenlogik nicht tragen</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Tracking liefert Reports, aber keine sauberen Entscheidungssignale</div></li>
							<li><span class="check-icon homepage-problem-frame__arrow">→</span><div>Budgetstop bedeutet Nachfrage-Stopp</div></li>
						</ul>
					</article>

					<article class="wp-success-card homepage-problem-frame__card homepage-problem-frame__card--accent nx-reveal">
						<p class="wp-success-subtitle">Modell B</p>
						<h3 class="wp-success-title">WordPress als Growth-Infrastruktur</h3>
						<ul class="premium-list">
							<li><span class="check-icon">✓</span><div>Money Pages, Proof und interne Wege werden zu bleibenden Assets</div></li>
							<li><span class="check-icon">✓</span><div>privacy-first Measurement schafft Klarheit statt Reporting-Rauschen</div></li>
							<li><span class="check-icon">✓</span><div>Ads werden erst dann skaliert, wenn Fundament und Conversion-Pfade stehen</div></li>
						</ul>
					</article>
				</div>

				<p class="homepage-problem-frame__link nx-reveal">Noch nicht sicher? <a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_home_problem_wgos" data-track-category="navigation">Erst das System verstehen</a></p>
			</div>
		</section>

		<section id="system" class="wp-section homepage-system-blueprint" data-track-section="homepage_wgos">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">WGOS System</span>
					<h2 class="wp-section-h2">WGOS bringt die richtigen Ebenen in die richtige Reihenfolge.</h2>
					<p class="wp-section-p">Nicht noch ein Leistungsmenü, sondern eine Systemlogik für Nachfrage, Datenklarheit und kontrollierte Weiterentwicklung auf WordPress-Basis.</p>
				</div>

				<div class="homepage-system-blueprint__steps">
					<article class="wp-step nx-reveal">
						<div class="wp-step-num">1</div>
						<h3>Audit</h3>
						<p>Wir machen sichtbar, wo Sichtbarkeit, Datensignale oder Anfrageführung gerade bremsen.</p>
					</article>
					<article class="wp-step highlight-step nx-reveal">
						<div class="wp-step-num highlight-num">2</div>
						<h3>Priorisierung</h3>
						<p>Erst danach wird klar, welche Seiten, Datenlücken und Conversion-Bremsen zuerst zählen.</p>
					</article>
					<article class="wp-step nx-reveal">
						<div class="wp-step-num">3</div>
						<h3>Umsetzung</h3>
						<p>Dann folgen die passenden WGOS-Bausteine in kontrollierter Reihenfolge statt als Taktik-Sammlung.</p>
					</article>
				</div>

				<div class="homepage-system-blueprint__layout">
					<div class="homepage-system-blueprint__visual">
						<ol class="homepage-system-flow" aria-label="WGOS Ebenen">
							<?php foreach ( $system_layers as $index => $layer ) : ?>
								<li class="homepage-system-card nx-reveal">
									<div class="homepage-system-card__rail" aria-hidden="true">
										<span class="homepage-system-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
										<?php if ( $index < count( $system_layers ) - 1 ) : ?>
											<span class="homepage-system-card__line"></span>
										<?php endif; ?>
									</div>
									<div class="homepage-system-card__body">
										<div class="homepage-system-card__header">
											<span class="homepage-system-card__eyebrow"><?php echo esc_html( $layer['label'] ); ?></span>
											<h3><?php echo esc_html( $layer['title'] ); ?></h3>
										</div>
										<p class="homepage-system-card__text"><?php echo esc_html( $layer['text'] ); ?></p>
										<ul class="homepage-system-card__items" aria-label="<?php echo esc_attr( $layer['title'] . ' Inhalte' ); ?>">
											<?php foreach ( $layer['items'] as $item ) : ?>
												<li><?php echo esc_html( $item ); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
									<p class="homepage-system-card__result"><?php echo esc_html( $layer['result'] ); ?></p>
								</li>
							<?php endforeach; ?>
						</ol>

						<div id="homepage-mindmap-teaser-root" class="homepage-mindmap-section nx-reveal" aria-label="WGOS Mindmap Teaser"></div>
					</div>

					<aside class="homepage-system-blueprint__aside nx-reveal" aria-labelledby="homepage-system-aside-title">
						<span class="homepage-system-blueprint__eyebrow">Warum das kaufnah relevant ist</span>
						<h3 id="homepage-system-aside-title">Klarer sehen, welche Seiten tragen und welche nur Fläche belegen.</h3>
						<p>Wenn Website, Datenebene, Kundencockpit und Weiterentwicklung zusammenspielen, entsteht kein Relaunch-Theater, sondern ein nutzbares Nachfrage-System.</p>
						<ul class="homepage-system-benefits" aria-label="WGOS Nutzen">
							<li>weniger Reibung zwischen erstem Besuch und qualifizierter Anfrage</li>
							<li>klare Prioritäten für die nächsten 30 bis 90 Tage</li>
							<li>Ownership statt Blackbox-Setup</li>
							<li>bessere Gesprächsgrundlage für Marketing, Vertrieb und Geschäftsführung</li>
						</ul>
						<p class="homepage-system-blueprint__aside-link">Mehr Kontext? <a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_home_system_wgos" data-track-category="navigation">WGOS im Detail ansehen</a></p>
					</aside>
				</div>
			</div>
		</section>

		<section id="case" class="wp-section homepage-case-teaser" data-track-section="homepage_case_teaser">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Case Teaser</span>
					<h2 class="wp-section-h2">Wenn die Reihenfolge stimmt, verändert sich nicht nur die Seite. Sondern der ganze Anfragepfad.</h2>
					<p class="wp-section-p">E3 New Energy ist der sichtbare Ausschnitt einer wiederholbaren Systemlogik: erst Fundament, dann Aktivierung.</p>
				</div>

				<div class="homepage-case-teaser__grid">
					<article class="homepage-case-teaser__card nx-reveal">
						<span class="homepage-case-teaser__eyebrow">Ausgangslage</span>
						<h3>Teure Leads, schwache Daten, hohe Reibung</h3>
						<p>150 EUR CPL, keine messbare Leadqualität und keine robuste Conversion-Führung nach dem Klick.</p>
					</article>
					<article class="homepage-case-teaser__card nx-reveal">
						<span class="homepage-case-teaser__eyebrow">Maßnahme</span>
						<h3>Erst Fundament, dann Skalierung</h3>
						<p>Positionierung, Tracking, Seitenstruktur, Speed und Conversion-Pfade wurden vor weiterer Aktivierung neu geordnet.</p>
					</article>
					<article class="homepage-case-teaser__card homepage-case-teaser__card--result nx-reveal">
						<span class="homepage-case-teaser__eyebrow">Ergebnis</span>
						<h3>Mehr Wirkung aus denselben Kanälen</h3>
						<div class="homepage-case-teaser__result-metrics" role="list" aria-label="Ergebnis Kennzahlen">
							<div role="listitem">
								<strong>-83%</strong>
								<span>CPL</span>
							</div>
							<div role="listitem">
								<strong>1.750+</strong>
								<span>Leads im System</span>
							</div>
							<div role="listitem">
								<strong>12%</strong>
								<span>Sales-Conversion</span>
							</div>
						</div>
					</article>
					<article class="homepage-case-teaser__card homepage-case-teaser__card--cta nx-reveal">
						<span class="homepage-case-teaser__eyebrow">CTA</span>
						<h3>Die Logik im Detail ansehen</h3>
						<p>Der offene Case zeigt nicht nur Zahlen, sondern auch die Reihenfolge dahinter.</p>
						<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_home_case_e3" data-track-category="trust">Case Study lesen</a>
					</article>
				</div>
			</div>
		</section>

		<section id="cta" class="wp-section homepage-conversion-cta" data-track-section="homepage_cta">
			<div class="wp-container wp-home-shell">
				<div class="nx-cta-box nx-reveal homepage-conversion-cta__box">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Prüfen wir, wo Ihre WordPress-Seite heute Nachfrage verliert.</h2>
					<p>Der Growth Audit zeigt, ob zuerst Positionierung, Datensignale, Proof, technische Reibung oder Conversion-Führung angegangen werden sollten.</p>
					<a class="nx-btn nx-btn--primary homepage-conversion-cta__button" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_home_final_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<p class="homepage-conversion-cta__support">Erst die Logik dahinter sehen? <a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_home_final_wgos" data-track-category="navigation">WGOS verstehen</a></p>
				</div>
			</div>
		</section>

		<section id="faq" class="homepage-faq-section homepage-faq-section--home" aria-labelledby="faq-heading">
			<div class="nx-container wp-home-shell">
				<div class="wp-home-section-title text-center nx-reveal">
					<span class="nx-badge nx-badge--gold">FAQ</span>
					<h2 id="faq-heading" class="wp-section-h2">Häufige Fragen</h2>
					<p class="wp-section-p">Klarheit vor dem nächsten Schritt.</p>
				</div>
				<div class="nx-faq">
					<?php foreach ( $faq_items as $index => $item ) : ?>
						<details class="nx-faq__item nx-reveal"<?php echo 0 === $index ? ' open' : ''; ?>>
							<summary><?php echo esc_html( $item['question'] ); ?></summary>
							<div class="nx-faq__content"><?php echo esc_html( $item['answer'] ); ?></div>
						</details>
					<?php endforeach; ?>
				</div>
				<p class="homepage-faq-section__link nx-reveal">Weitere Fragen beantwortet <a href="<?php echo esc_url( trailingslashit( $wgos_url ) . '#faq' ); ?>" data-track-action="cta_home_faq_wgos" data-track-category="navigation">im WGOS FAQ</a></p>
			</div>
		</section>

		<section id="knowledge" class="wp-section homepage-blog-section homepage-blog-section--quiet" data-track-section="homepage_knowledge">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-section-title text-center nx-reveal">
					<span class="nx-badge nx-badge--ghost">Knowledge Base</span>
					<h2 class="wp-section-h2">Analysen für Teams, die den Mechanismus hinter Sichtbarkeit und Conversion verstehen wollen.</h2>
					<p class="wp-section-p">Bewusst ruhiger platziert: als Wissenslayer für spätere Vertiefung, nicht als Konkurrenz zum primären Audit-Funnel.</p>
				</div>

				<div class="homepage-blog-grid">
					<?php
					$blog_query = new WP_Query(
						[
							'post_type'           => 'post',
							'posts_per_page'      => 3,
							'post_status'         => 'publish',
							'ignore_sticky_posts' => true,
						]
					);

					if ( $blog_query->have_posts() ) :
						while ( $blog_query->have_posts() ) :
							$blog_query->the_post();
							$thumb_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
							$categories = get_the_category();
							$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Knowledge Base';
							?>
							<article class="homepage-blog-card nx-reveal">
								<a href="<?php the_permalink(); ?>" class="homepage-blog-card__link">
									<?php if ( $thumb_url ) : ?>
										<div class="homepage-blog-card__media">
											<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
										</div>
									<?php endif; ?>
									<div class="homepage-blog-card__body">
										<span class="homepage-blog-card__eyebrow"><?php echo esc_html( $cat_name ); ?></span>
										<h3><?php the_title(); ?></h3>
										<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
										<span class="homepage-blog-card__cta">Analyse lesen</span>
									</div>
								</a>
							</article>
							<?php
						endwhile;
						wp_reset_postdata();
					else :
						?>
						<p class="homepage-blog-section__empty">Aktuell werden neue Analysen vorbereitet.</p>
						<?php
					endif;
					?>
				</div>

				<p class="homepage-blog-section__link nx-reveal"><a href="<?php echo esc_url( $blog_url ); ?>" data-track-action="cta_home_blog_archive" data-track-category="navigation">Zum vollständigen Knowledge Base Archiv</a></p>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
