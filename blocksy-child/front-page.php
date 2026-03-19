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

$public_proof_display = [
	'github_commits'     => ! empty( $proof['github_commits'] ) ? 'über ' . number_format_i18n( (int) $proof['github_commits'] ) : 'über 1.500',
	'linkedin_followers' => number_format_i18n( (int) ( $proof['linkedin_followers'] ?? 600 ) ),
	'linkedin_posts'     => number_format_i18n( (int) ( $proof['linkedin_posts'] ?? 20 ) ),
];

$audit_url   = $urls['audit'] ?? home_url( '/growth-audit/' );
$wgos_url    = $urls['wgos'] ?? home_url( '/wordpress-growth-operating-system/' );
$cases_url   = $urls['cases'] ?? home_url( '/ergebnisse/' );
$agentur_url = $urls['agentur'] ?? home_url( '/wordpress-agentur-hannover/' );
$blog_url    = $urls['blog'] ?? home_url( '/blog/' );
$about_url   = $urls['about'] ?? home_url( '/uber-mich/' );
$e3_url      = $urls['e3'] ?? home_url( '/e3-new-energy/' );
$github_url  = $urls['github_repo'] ?? '';
$linkedin_url = $urls['linkedin'] ?? '';

$proof_strip_items = [
	[
		'value' => '1.750+',
		'label' => 'qualifizierte Leads',
	],
	[
		'value' => '12 %',
		'label' => 'Sales-Conversion',
	],
	[
		'value' => '34x',
		'label' => 'ROAS-Spitze',
	],
];

$audit_checks = [
	[
		'title' => 'Positionierung & Klarheit',
		'text'  => 'Ist in den ersten Sekunden klar, für wen Ihr Angebot gedacht ist, welches Problem Sie lösen und warum man gerade Ihnen vertrauen sollte?',
	],
	[
		'title' => 'Nutzerführung & Conversion',
		'text'  => 'Führt die Seite logisch zum nächsten Schritt — oder verliert sie Aufmerksamkeit durch Reibung, Unklarheit oder zu viele konkurrierende Signale?',
	],
	[
		'title' => 'Vertrauen & Proof',
		'text'  => 'Sind Ergebnisse, Referenzen, Argumente und Angebotslogik stark genug, um aus Interesse echte Anfragebereitschaft zu machen?',
	],
	[
		'title' => 'Tracking & Messbarkeit',
		'text'  => 'Sehen Sie überhaupt, wo Anfragen entstehen, wo Nutzer abspringen und welche Maßnahmen wirklich Wirkung haben?',
	],
];

$system_layers = [
	[
		'label'  => 'Ebene 1',
		'title'  => 'Relevanter Anfragepfad',
		'text'   => 'Hero, Money Pages, Proof und der nächste Schritt greifen ineinander statt nebeneinander zu laufen.',
		'items'  => [
			'klare Positionierung',
			'sichtbarer Proof',
			'CTA ohne Konkurrenz',
		],
		'result' => 'Besucher verstehen schneller, warum Sie relevant sind und was sie als Nächstes tun sollen.',
	],
	[
		'label'  => 'Ebene 2',
		'title'  => 'Messbarkeit mit Entscheidungssignalen',
		'text'   => 'Consent, Tracking und Lead-Signale zeigen, wo Qualität entsteht und wo Nachfrage verloren geht.',
		'items'  => [
			'privacy-first Tracking',
			'Leadqualität statt Vanity-Metriken',
			'klare Prioritäten',
		],
		'result' => 'Sie sehen nicht nur Aktivität, sondern was kaufnah wirkt.',
	],
	[
		'label'  => 'Ebene 3',
		'title'  => 'Kontrollierte Umsetzung',
		'text'   => 'Änderungen werden priorisiert, versioniert und in sinnvoller Reihenfolge umgesetzt statt als Taktik-Sammlung.',
		'items'  => [
			'wartbare Codebasis',
			'kontrollierte Deployments',
			'Ownership statt Lock-in',
		],
		'result' => 'WordPress bleibt verlässlich, erweiterbar und kaufmännisch nachvollziehbar.',
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
	[
		'question' => 'Was passiert nach dem Growth Audit?',
		'answer'   => 'Sie bekommen eine klare Einschätzung, wo Ihre Website Nachfrage verliert und welche Hebel Priorität haben. Danach entscheiden Sie, ob und wie es weitergeht. Kein automatischer Folgevertrag.',
	],
	[
		'question' => 'Arbeiten Sie auch mit bestehenden WordPress-Websites?',
		'answer'   => 'Ja. In den meisten Fällen ist kein Relaunch nötig. Häufig reichen gezielte Eingriffe an Angebotsseiten, Tracking, Proof oder technischer Reibung, bevor größer gedacht werden muss.',
	],
];

get_header();
?>

<main id="main" class="site-main" data-track-section="homepage">
	<div class="cs-page homepage-template">
		<nav class="smart-nav" aria-label="Seitennavigation">
			<ul>
				<li><a href="#hero" title="Start"><span class="nav-dot"></span><span class="nav-text">Start</span></a></li>
				<li><a href="#audit" title="Growth Audit"><span class="nav-dot"></span><span class="nav-text">Audit</span></a></li>
				<li><a href="#proof" title="Track Record"><span class="nav-dot"></span><span class="nav-text">Proof</span></a></li>
				<li><a href="#system" title="WGOS"><span class="nav-dot"></span><span class="nav-text">WGOS</span></a></li>
				<li><a href="#faq" title="FAQ"><span class="nav-dot"></span><span class="nav-text">FAQ</span></a></li>
			</ul>
		</nav>

		<section id="hero" class="wp-hero wp-home-hero">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-hero__grid">
					<div class="wp-hero-copy wp-home-hero__copy">
						<span class="wp-badge nx-reveal">WordPress Growth Architect für B2B</span>
						<h1 class="wp-hero-title nx-reveal">Ich mache aus Ihrer WordPress-Website ein planbares Anfragesystem für B2B.</h1>
						<p class="wp-hero-subtitle wp-home-hero__subtitle nx-reveal">
							Für Unternehmen, die nicht noch mehr Website-Fläche brauchen, sondern klare Positionierung, belastbare Messbarkeit und einen nächsten Schritt, der aus Besuchern qualifizierte Anfragen macht.
						</p>

						<div class="wp-home-hero__actions nx-reveal">
							<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-btn wp-btn-primary wp-home-hero__primary" data-track-action="cta_home_hero_audit" data-track-category="lead_gen">Growth Audit starten</a>
							<a href="<?php echo esc_url( $cases_url ); ?>" class="wp-home-text-link wp-home-text-link--quiet" data-track-action="cta_home_hero_results" data-track-category="trust">Ergebnisse ansehen</a>
						</div>
						<p class="nx-cta-microcopy nx-reveal">0 € · Rückmeldung in 48h · kein Pflicht‑Call</p>
					</div>
				</div>
			</div>
		</section>

		<div class="wp-mobile-cta-bar" data-home-mobile-cta aria-label="Schneller Audit-Einstieg">
			<a href="<?php echo esc_url( $audit_url ); ?>" class="wp-btn wp-btn-primary" data-track-action="cta_mobile_sticky_audit" data-track-category="lead_gen">Growth Audit starten</a>
		</div>

		<section class="homepage-proof-strip" aria-label="Schnelle Vertrauenssignale">
			<div class="wp-container wp-home-shell">
				<div class="homepage-proof-strip__list" role="list" aria-label="Proof Kennzahlen">
					<?php foreach ( $proof_strip_items as $item ) : ?>
						<div class="homepage-proof-strip__item nx-reveal" role="listitem">
							<strong><?php echo esc_html( $item['value'] ); ?></strong>
							<span><?php echo esc_html( $item['label'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<section id="audit" class="wp-section homepage-audit-section" data-track-section="homepage_audit">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-section-title nx-reveal">
					<span class="wp-badge">Growth Audit</span>
					<h2 class="wp-section-h2">Was wir im Growth Audit konkret prüfen</h2>
					<p class="wp-section-p homepage-audit-section__intro">Viele Websites haben nicht ein großes Problem, sondern mehrere kleine Brüche im Zusammenspiel: Positionierung, Nutzerführung, Vertrauen, Tracking oder der nächste sinnvolle Schritt. Genau dort setzen wir an.</p>
				</div>

				<div class="homepage-audit-section__grid" role="list" aria-label="Prüfbereiche im Growth Audit">
					<?php foreach ( $audit_checks as $card ) : ?>
						<article class="wp-success-card homepage-audit-section__card nx-reveal" role="listitem">
							<h3 class="wp-success-title"><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="homepage-audit-section__footer nx-reveal">
					<p class="homepage-audit-section__note">Sie bekommen keine generische Checkliste, sondern eine priorisierte Einordnung: Was bremst aktuell, was hat den größten Hebel und was sollte als Nächstes passieren.</p>
					<a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--primary homepage-audit-section__cta" data-track-action="cta_home_audit_block_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<p class="homepage-audit-section__microcopy">0 € · Rückmeldung in 48h · kein Pflicht‑Call</p>
				</div>
			</div>
		</section>

		<section id="proof" class="wp-section homepage-track-record" data-track-section="homepage_proof">
			<div class="wp-container wp-home-shell">
				<div class="wp-section-title wp-home-section-title text-center nx-reveal">
					<span class="wp-badge">Proof</span>
					<h2 class="wp-section-h2">Outcome-Proof zuerst. Alles andere kommt danach.</h2>
					<p class="wp-section-p">Der stärkste Vertrauenshebel ist ein nachvollziehbares Ergebnis. Deshalb steht E3 vorne. Erfahrung und Transparenz bleiben sichtbar, aber sekundär.</p>
				</div>

				<div class="homepage-track-record__grid">
					<article class="wp-success-card homepage-track-record__card homepage-track-record__card--primary nx-reveal">
						<p class="wp-success-subtitle">Outcome Proof</p>
						<h3 class="wp-success-title">E3 New Energy</h3>
						<p class="homepage-track-record__lead">Aus 150 EUR CPL ohne messbare Leadqualität wurde nach Neuordnung von Positionierung, Tracking und Conversion-Pfad ein deutlich robusterer Anfragepfad.</p>
						<div class="homepage-track-record__metrics" role="list" aria-label="E3 Kennzahlen">
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">-83&nbsp;%</span>
								<span class="homepage-track-record__metric-label">Kosten pro Lead</span>
							</div>
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">1.750+</span>
								<span class="homepage-track-record__metric-label">qualifizierte Leads</span>
							</div>
							<div class="homepage-track-record__metric" role="listitem">
								<span class="homepage-track-record__metric-value">12&nbsp;%</span>
								<span class="homepage-track-record__metric-label">Sales-Conversion</span>
							</div>
						</div>
						<p class="homepage-track-record__lead">Die offene Case Study zeigt nicht nur Zahlen, sondern die Reihenfolge dahinter: erst Fundament, dann Aktivierung.</p>
						<div class="homepage-track-record__actions">
							<a href="<?php echo esc_url( $e3_url ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_home_proof_e3" data-track-category="trust">E3 Case Study lesen</a>
							<p class="homepage-track-record__microcopy">Offene Case Study statt Sales-Behauptung.</p>
						</div>
					</article>

					<div class="homepage-track-record__stack">
						<article class="wp-success-card homepage-track-record__card nx-reveal">
							<p class="wp-success-subtitle">Experience Proof</p>
							<h3 class="wp-success-title">8+ Jahre B2B-, Performance- und Whitelabel-Praxis</h3>
							<p class="homepage-track-record__lead">Nicht aus Theorie, sondern aus Projekten mit Sichtbarkeits-, Tracking- und Anfrageproblemen.</p>
							<ul class="premium-list homepage-track-record__list">
								<li><span class="check-icon">✓</span><div>öffentliche und nicht öffentliche Projekte mit denselben systemischen Hebeln</div></li>
								<li><span class="check-icon">✓</span><div>WordPress, SEO, Tracking und CRO nicht getrennt, sondern als Verbund gedacht</div></li>
								<li><span class="check-icon">✓</span><div>kaufnahe Priorisierung vor Taktik-Sammlung</div></li>
							</ul>
							<a href="<?php echo esc_url( $about_url ); ?>" class="wp-home-text-link" data-track-action="cta_home_proof_about" data-track-category="navigation">Arbeitsweise ansehen</a>
						</article>

						<article class="wp-success-card homepage-track-record__card homepage-track-record__card--quiet nx-reveal">
							<p class="wp-success-subtitle">Öffentliche Nachvollziehbarkeit</p>
							<h3 class="wp-success-title">Transparent, ohne Outcome-Proof zu ersetzen</h3>
							<p class="homepage-track-record__lead">GitHub, LinkedIn und offene Dokumentation sind nützlich, stehen hier aber bewusst hinter echtem Ergebnis-Proof.</p>
							<div class="homepage-track-record__public-proof" role="list" aria-label="Öffentliche Proof-Signale">
								<div class="homepage-track-record__public-item" role="listitem">
									<strong><?php echo esc_html( $public_proof_display['github_commits'] ); ?></strong>
									<span>Commits im öffentlichen Repo</span>
								</div>
								<div class="homepage-track-record__public-item" role="listitem">
									<strong><?php echo esc_html( $public_proof_display['linkedin_followers'] ); ?></strong>
									<span>LinkedIn-Follower</span>
								</div>
								<div class="homepage-track-record__public-item" role="listitem">
									<strong><?php echo esc_html( $public_proof_display['linkedin_posts'] ); ?></strong>
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
					<span class="wp-badge">Warum Seiten verlieren</span>
					<h2 class="wp-section-h2">Das Problem ist selten fehlender Traffic. Meist fehlt der saubere Weg zur qualifizierten Anfrage.</h2>
					<p class="wp-section-p">Wenn Positionierung, Proof, CTA und Measurement nicht zusammenspielen, bleibt Nachfrage teuer und unklar.</p>
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
					<span class="wp-badge">WGOS Kurzfassung</span>
					<h2 class="wp-section-h2">WGOS ordnet WordPress auf der Homepage in drei kaufnahe Ebenen.</h2>
					<p class="wp-section-p">Für die Startseite reicht die Kurzlogik: Anfragepfad, Messbarkeit und kontrollierte Umsetzung müssen zusammenspielen.</p>
				</div>

				<div class="homepage-system-blueprint__steps">
					<article class="wp-step nx-reveal">
						<div class="wp-step-num">1</div>
						<h3>Audit</h3>
						<p>Wir machen sichtbar, wo Positionierung, Proof, Datensignale oder Anfrageführung gerade bremsen.</p>
					</article>
					<article class="wp-step highlight-step nx-reveal">
						<div class="wp-step-num highlight-num">2</div>
						<h3>Priorisierung</h3>
						<p>Erst danach wird klar, welche Seiten, Datenlücken und Conversion-Bremsen zuerst zählen.</p>
					</article>
					<article class="wp-step nx-reveal">
						<div class="wp-step-num">3</div>
						<h3>Umsetzung</h3>
						<p>Dann folgen die passenden Bausteine in kontrollierter Reihenfolge statt als Taktik-Sammlung.</p>
					</article>
				</div>

				<div class="homepage-system-blueprint__layout">
					<div class="homepage-system-blueprint__visual">
						<ol class="homepage-system-flow" aria-label="WGOS Ebenen">
							<?php foreach ( $system_layers as $index => $layer ) : ?>
								<li class="homepage-system-card nx-reveal">
									<div class="homepage-system-card__header">
										<span class="homepage-system-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
										<span class="homepage-system-card__eyebrow"><?php echo esc_html( $layer['label'] ); ?></span>
									</div>
									<h3><?php echo esc_html( $layer['title'] ); ?></h3>
									<p class="homepage-system-card__text"><?php echo esc_html( $layer['text'] ); ?></p>
									<ul class="homepage-system-card__items" aria-label="<?php echo esc_attr( $layer['title'] . ' Inhalte' ); ?>">
										<?php foreach ( $layer['items'] as $item ) : ?>
											<li><?php echo esc_html( $item ); ?></li>
										<?php endforeach; ?>
									</ul>
									<p class="homepage-system-card__result"><?php echo esc_html( $layer['result'] ); ?></p>
								</li>
							<?php endforeach; ?>
						</ol>
					</div>

					<aside class="homepage-system-blueprint__aside nx-reveal" aria-labelledby="homepage-system-aside-title">
						<span class="homepage-system-blueprint__eyebrow">Für die Tiefe</span>
						<h3 id="homepage-system-aside-title">Die volle Systemlogik braucht auf der Startseite keinen langen Exkurs.</h3>
						<p>Wenn Sie verstehen wollen, wie daraus ein dauerhaftes Operating System wird, ist WGOS die Detailseite.</p>
						<ul class="homepage-system-benefits" aria-label="WGOS Nutzen">
							<li>klare Reihenfolge statt Relaunch-Vermutungen</li>
							<li>weniger Reibung zwischen Besuch, Signal und Anfrage</li>
							<li>bessere Steuerbarkeit für Marketing, Vertrieb und Geschäftsführung</li>
						</ul>
						<p class="homepage-system-blueprint__aside-link">Mehr Kontext? <a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_home_system_wgos" data-track-category="navigation">WGOS im Detail ansehen</a></p>
					</aside>
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

		<section id="cta" class="wp-section homepage-conversion-cta" data-track-section="homepage_cta">
			<div class="wp-container wp-home-shell">
				<div class="nx-cta-box nx-reveal homepage-conversion-cta__box">
					<span class="nx-badge nx-badge--gold">Nächster Schritt</span>
					<h2>Prüfen wir zuerst, wo Ihre WordPress-Seite heute qualifizierte Nachfrage verliert.</h2>
					<p>Im Growth Audit wird sichtbar, ob Positionierung, Proof, CTA-Führung, Measurement oder technische Reibung zuerst gelöst werden sollten. Danach entscheiden Sie in Ruhe, ob und wie es weitergeht.</p>
					<a class="nx-btn nx-btn--primary homepage-conversion-cta__button" href="<?php echo esc_url( $audit_url ); ?>" data-track-action="cta_home_final_audit" data-track-category="lead_gen">Growth Audit starten</a>
					<p class="homepage-conversion-cta__microcopy">0 € · Rückmeldung in 48h · kein Pflicht‑Call</p>
					<p class="homepage-conversion-cta__support">Noch nicht bereit für den Einstieg? <a href="<?php echo esc_url( $wgos_url ); ?>" data-track-action="cta_home_final_wgos" data-track-category="navigation">Erst WGOS im Detail ansehen</a></p>
				</div>
			</div>
		</section>

		<section id="knowledge" class="wp-section homepage-blog-section homepage-blog-section--quiet" data-track-section="homepage_knowledge">
			<div class="wp-container wp-home-shell">
				<div class="wp-home-section-title text-center nx-reveal">
					<span class="nx-badge nx-badge--ghost">Knowledge Base</span>
					<h2 class="wp-section-h2">Wenn Sie zuerst die Denkweise prüfen wollen: hier sind die Analysen.</h2>
					<p class="wp-section-p">Die Artikel sind bewusst der längere Nebenpfad. Der direkte Einstieg bleibt das Growth Audit.</p>
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
