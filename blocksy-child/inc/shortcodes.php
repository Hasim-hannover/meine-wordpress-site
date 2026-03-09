<?php
/**
 * Startseiten-Shortcodes für den fokussierten Growth-Architect-Ansatz.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve key URLs once for homepage shortcodes.
 *
 * @return array<string, string>
 */
function hu_home_urls() {
	static $urls = null;

	if ( null !== $urls ) {
		return $urls;
	}

	$blog_page_id = (int) get_option( 'page_for_posts' );

	$urls = [
		'audit'     => nexus_get_audit_url(),
		'deep_dive' => nexus_get_page_url( [ '360-deep-dive' ] ),
		'wgos'      => nexus_get_page_url( [ 'wordpress-growth-operating-system', 'wgos' ] ),
		'cases'     => nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) ),
		'about'     => nexus_get_page_url( [ 'uber-mich' ] ),
		'blog'      => $blog_page_id ? get_permalink( $blog_page_id ) : home_url( '/blog/' ),
		'e3'        => nexus_get_page_url( [ 'e3-new-energy', 'case-studies/e3-new-energy', 'case-e3' ], home_url( '/e3-new-energy/' ) ),
	];

	return $urls;
}

/**
 * Homepage hero.
 *
 * @return string
 */
function hu_hero_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<div class="cs-page" style="display:flex; flex-direction:column;">
		<nav class="smart-nav" aria-label="Seitennavigation">
			<ul>
				<li><a href="#hero" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
				<li><a href="#owned" title="Prinzip"><div class="nav-dot"></div><span class="nav-text">Prinzip</span></a></li>
				<li><a href="#angebot" title="Angebot"><div class="nav-dot"></div><span class="nav-text">Angebot</span></a></li>
				<li><a href="#erfolge" title="Ergebnisse"><div class="nav-dot"></div><span class="nav-text">Proof</span></a></li>
				<li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
			</ul>
		</nav>

		<section class="wp-hero" id="hero" role="banner">
			<div class="wp-container">
				<div class="wp-hero-grid">
					<div class="wp-hero-copy">
						<span class="wp-badge nx-reveal">WordPress Growth Architect für B2B</span>
						<h1 class="wp-hero-title nx-reveal">
							Ich mache aus Ihrer<br><span>WordPress-Website ein planbares Anfragesystem.</span>
						</h1>
						<p class="wp-hero-subtitle nx-reveal">
							Für B2B-Unternehmen, die aus WordPress mehr brauchen als einen Relaunch:
							klare Positionierung, technische SEO, privacy-first Messbarkeit und Conversion-Logik,
							damit aus Sichtbarkeit belastbare Anfragen werden.
						</p>
						<div class="wp-hero-proof nx-reveal" role="list" aria-label="Vertrauenssignale">
							<span class="wp-hero-proof-item" role="listitem">1.750+ qualifizierte Leads aus einem aufgebauten System</span>
							<span class="wp-hero-proof-item" role="listitem">98/100 Mobile Performance auf Kernseiten</span>
							<span class="wp-hero-proof-item" role="listitem">Privacy-first Measurement statt Daten-Blackbox</span>
						</div>

						<div class="wp-hero-actions nx-reveal">
							<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="wp-btn wp-btn-primary" data-track-action="cta_hero_primary_audit" data-track-category="lead_gen">Audit starten</a>
							<a href="<?php echo esc_url( $urls['cases'] ); ?>" class="wp-btn wp-btn-secondary">Case Studies ansehen</a>
						</div>
						<p class="wp-hero-supporting-link nx-reveal">Erst das Vorgehen verstehen? <a href="<?php echo esc_url( $urls['about'] ); ?>">Meine Arbeitsweise ansehen</a></p>
					</div>

					<div class="wp-hero-panel nx-reveal">
						<div class="audit-card-premium" id="audit">
							<div class="audit-card-premium__intro">
								<span class="audit-card-premium__eyebrow">Growth Audit</span>
							</div>
							<h3 class="audit-card-premium__title">Erster Schritt: Diagnose statt Pitch</h3>
							<p class="audit-card-premium__copy">
								Wir prüfen, wo Ihre WordPress-Präsenz Nachfrage verliert:
								bei Sichtbarkeit, Vertrauen, Messbarkeit oder im nächsten Conversion-Schritt.
							</p>
							<ul class="premium-list">
								<li><span class="check-icon">✓</span> <div><strong>Sichtbarkeit:</strong> Kaufnahe SEO- und Einstiegsseiten im Realitätscheck</div></li>
								<li><span class="check-icon">✓</span> <div><strong>Messbarkeit:</strong> Tracking- und Consent-Reibung erkennen, bevor Daten teuer werden</div></li>
								<li><span class="check-icon">✓</span> <div><strong>Conversion:</strong> Proof, CTA-Führung und Angebotslogik auf echte Anfragen ausrichten</div></li>
							</ul>
							<div class="price-box text-center">
								Kein Verkaufsgespräch. Klare Einschätzung. Sinnvolle nächste Entscheidung.
							</div>
							<div class="wp-btn-wrapper audit-card-premium__actions">
								<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="wp-btn wp-btn-primary full-width" data-track-action="cta_hero_audit" data-track-category="lead_gen">Audit starten</a>
							</div>
							<p class="audit-card-premium__microcopy">
								<a href="<?php echo esc_url( $urls['wgos'] ); ?>" class="micro-cta-link">Erst das System verstehen -></a>
							</p>
						</div>
					</div>
				</div>

				<div class="vertical-metrics nx-reveal" role="group" aria-label="Erfolgsmetriken">
					<div class="wp-metric">
						<span class="wp-metric-value" data-value="98">98</span>
						<span class="wp-metric-label">Mobile Performance</span>
					</div>
					<div class="wp-metric">
						<span class="wp-metric-value" data-value="-83">-83%</span>
						<span class="wp-metric-label">CPL-Reduktion</span>
					</div>
					<div class="wp-metric">
						<span class="wp-metric-value text-gold">&lt;&nbsp;0.8s</span>
						<span class="wp-metric-label">LCP auf Kernseiten</span>
					</div>
					<div class="wp-metric">
						<span class="wp-metric-value" data-value="100">100%</span>
						<span class="wp-metric-label">Ownership statt Lock-in</span>
					</div>
				</div>
			</div>
		</section>
		<div class="wp-mobile-cta-bar" data-home-mobile-cta aria-label="Schneller Audit-Einstieg">
			<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="wp-btn wp-btn-primary" data-track-action="cta_mobile_sticky_audit" data-track-category="lead_gen">Audit starten</a>
			<a href="<?php echo esc_url( $urls['cases'] ); ?>" class="wp-mobile-cta-bar__secondary">Cases</a>
		</div>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_hero', 'hu_hero_section_shortcode' );

/**
 * Homepage fit section.
 *
 * @return string
 */
function hu_partner_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="fit" class="wp-section" aria-labelledby="fit-heading">
		<div class="wp-container">
			<div class="wp-section-title text-center nx-reveal">
				<span class="wp-badge">Fokus</span>
				<h2 id="fit-heading" class="wp-section-h2">Für wen das passt</h2>
				<p class="wp-section-p">Nicht für jeden. Genau deshalb funktioniert die Seite besser für die Richtigen.</p>
			</div>

			<div class="wp-cards">
				<article class="wp-success-card nx-reveal">
					<h3 class="wp-success-title">WordPress ist Kernsystem</h3>
					<p class="wp-success-subtitle">Keine CMS-Spielwiese</p>
					<p>Ihre Website soll nicht nur gepflegt werden, sondern als Nachfrage- und Vertriebsinfrastruktur arbeiten.</p>
				</article>

				<article class="wp-success-card nx-reveal">
					<h3 class="wp-success-title">B2B mit echtem Vertriebsziel</h3>
					<p class="wp-success-subtitle">Anfragen statt Image-only</p>
					<p>Es gibt ein klares Leistungsversprechen, kaufnahe Suchintentionen und den Anspruch, aus Besuchern qualifizierte Gespräche zu machen.</p>
				</article>

				<article class="wp-success-card nx-reveal">
					<h3 class="wp-success-title">Bereitschaft für Prioritäten</h3>
					<p class="wp-success-subtitle">Kein Aktionismus</p>
					<p>Sie wollen keine zehn Einzelmaßnahmen parallel, sondern die richtige Reihenfolge aus Diagnose, Architektur und Umsetzung.</p>
				</article>
			</div>

			<div style="text-align:center; margin-top:2.5rem;">
				<a href="<?php echo esc_url( $urls['about'] ); ?>" class="wp-btn wp-btn-secondary">Meine Arbeitsweise kennenlernen</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_partner', 'hu_partner_section_shortcode' );

/**
 * Homepage principle section.
 *
 * @return string
 */
function hu_owned_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="owned" class="wp-section" style="border-top:1px solid rgba(255,255,255,0.05);" aria-labelledby="owned-heading">
		<div class="container">
			<div class="section-title text-center nx-reveal">
				<span class="badge">Das Prinzip</span>
				<h2 id="owned-heading">Eigene Anfragen statt gemieteter Nachfrage.</h2>
				<p>Die bessere Website ist nicht die schönere. Es ist die, die Nachfrage halten, messen und in den nächsten Schritt führen kann.</p>
			</div>

			<div class="wp-cards" style="margin-top:2.5rem;">
				<div class="wp-success-card modell-a nx-reveal" style="border-top:3px dashed rgba(255,255,255,0.14); opacity:0.82;">
					<h3 class="wp-success-title">Modell A: Externe Nachfrage mieten</h3>
					<p class="wp-success-subtitle">Teurer, sobald Reibung im System bleibt</p>
					<ul class="premium-list">
						<li><span class="check-icon" style="color:#888;">-></span> <div>Klicks einkaufen, während die Seite intern Anfragen verliert</div></li>
						<li><span class="check-icon" style="color:#888;">-></span> <div>Steigende Medienkosten kaschieren schwache Positionierung und schlechte Daten</div></li>
						<li><span class="check-icon" style="color:#888;">-></span> <div>Budgetstop = Sichtbarkeitstop</div></li>
					</ul>
				</div>

				<div class="wp-success-card modell-b nx-reveal" style="border-top:4px solid var(--gold);">
					<h3 class="wp-success-title" style="color:var(--gold);">Modell B: WordPress als Growth-Infrastruktur</h3>
					<p class="wp-success-subtitle">Eigene Nachfrage, messbar, priorisiert</p>
					<ul class="premium-list">
						<li><span class="check-icon">✓</span> <div>Money Pages, Proof und interne Verlinkung als bleibende Assets</div></li>
						<li><span class="check-icon">✓</span> <div>Privacy-first Measurement für Entscheidungen statt Reporting-Rauschen</div></li>
						<li><span class="check-icon">✓</span> <div>Ads nur als Booster, wenn Fundament und Conversion-Pfade stehen</div></li>
					</ul>
				</div>
			</div>

			<div class="text-center" style="margin-top:2rem;">
				<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="wp-btn wp-btn-secondary" data-track-action="cta_owned_audit" data-track-category="lead_gen">Prüfen, wo Ihre Seite heute verliert</a>
			</div>
			<a href="<?php echo esc_url( $urls['wgos'] ); ?>" class="micro-cta-link">Noch nicht sicher? Erst das System verstehen -></a>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_owned', 'hu_owned_section_shortcode' );

/**
 * Homepage offer architecture section.
 *
 * @return string
 */
function hu_wgos_block_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section class="wp-section homepage-wgos-section" id="angebot" aria-labelledby="angebot-heading">
		<div class="wp-container">
			<div class="wp-section-title text-center nx-reveal">
				<span class="wp-badge">Angebotsarchitektur</span>
				<h2 id="angebot-heading" class="wp-section-h2">Drei Stufen statt zehn Einzelleistungen.</h2>
				<p class="wp-section-p">
					Der Ablauf ist bewusst eng geführt: erst Diagnose, dann Blueprint,
					dann Umsetzung und laufende Optimierung auf WordPress-Basis.
				</p>
			</div>

			<div class="wp-process">
				<div class="wp-step nx-reveal">
					<div class="wp-step-num">1</div>
					<h3>Growth Audit</h3>
					<p>Der niedrigschwellige Einstieg. Wir machen sichtbar, wo Sichtbarkeit, Vertrauen oder Lead-Capture wegbrechen und ob sich ein tieferer Eingriff lohnt.</p>
				</div>
				<div class="wp-step highlight-step nx-reveal">
					<div class="wp-step-num highlight-num">2</div>
					<h3>360 Grad Growth Blueprint</h3>
					<p>Der Deep Dive für Unternehmen mit echtem Potenzial. Ergebnis: priorisierte Roadmap für Positionierung, IA, Measurement und Conversion-Logik.</p>
				</div>
				<div class="wp-step nx-reveal">
					<div class="wp-step-num">3</div>
					<h3>WGOS Umsetzung und Retainer</h3>
					<p>Technische Umsetzung, Content-Aufbau und fortlaufende Optimierung in einer Reihenfolge, die Kosten senkt und die Qualität von Anfragen steigert.</p>
				</div>
			</div>

			<div id="homepage-mindmap-teaser-root" class="homepage-mindmap-section" aria-label="WGOS Mindmap Teaser"></div>

			<div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem; margin-top:2.5rem;">
				<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="wp-btn wp-btn-primary" data-track-action="cta_wgos_audit" data-track-category="lead_gen">Mit dem Audit starten</a>
				<a href="<?php echo esc_url( $urls['wgos'] ); ?>" class="wp-btn wp-btn-secondary">WGOS im Detail</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_wgos_block', 'hu_wgos_block_shortcode' );

/**
 * Homepage proof section.
 *
 * @return string
 */
function hu_erfolge_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="erfolge" aria-labelledby="cases-heading" style="padding:5rem 0; background:var(--nx-bg-glass); border-top:1px solid var(--nx-border); border-bottom:1px solid var(--nx-border);">
		<div class="nx-container">
			<div class="nx-reveal" style="text-align:center; margin-bottom:3rem;">
				<span class="nx-badge nx-badge--gold">Proof</span>
				<h2 id="cases-heading" style="font-size:clamp(1.8rem,3vw,2.4rem); margin:1rem 0 0.5rem; color:#fff;">Ergebnisse statt Leistungslisten.</h2>
				<p style="color:var(--nx-text-muted);">Der Hebel liegt selten in einer einzelnen Maßnahme. Er liegt fast immer in besserer Reihenfolge.</p>
			</div>

			<div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:1.5rem; margin-bottom:3rem;">
				<article class="nx-card nx-reveal" style="border-top:3px solid var(--nx-success);">
					<p class="nx-card__subtitle">B2B Leadgen · WordPress System · 12 Monate</p>
					<h3 class="nx-card__title">E3 New Energy</h3>
					<p style="color:var(--nx-text-muted); margin:0.8rem 0 0;">Eingekaufte Leads, keine saubere Datenlage, hohe Reibung nach dem Klick. Nach Systemaufbau:</p>
					<div class="nx-metrics" style="margin-top:1.5rem; display:grid; grid-template-columns:1fr 1fr; gap:1.25rem;">
						<div class="nx-metric">
							<span class="nx-metric__value" style="color:var(--nx-success);">1.750+</span>
							<span class="nx-metric__label">Qualifizierte Leads</span>
						</div>
						<div class="nx-metric">
							<span class="nx-metric__value" style="color:var(--nx-success);">-83%</span>
							<span class="nx-metric__label">CPL</span>
						</div>
						<div class="nx-metric">
							<span class="nx-metric__value" style="color:var(--nx-gold);">12-15%</span>
							<span class="nx-metric__label">Sales-Conversion</span>
						</div>
						<div class="nx-metric">
							<span class="nx-metric__value" style="color:var(--nx-success);">34x</span>
							<span class="nx-metric__label">ROAS-Spitze</span>
						</div>
					</div>
					<a href="<?php echo esc_url( $urls['e3'] ); ?>" style="display:inline-block; margin-top:1.5rem; color:var(--nx-gold); font-size:0.85rem; font-weight:700; text-decoration:none;">Case Study lesen -></a>
				</article>

				<article class="nx-card nx-reveal" style="border-top:3px solid var(--nx-gold);">
					<p class="nx-card__subtitle">Typische Wirkungen nach der ersten Priorisierungsrunde</p>
					<h3 class="nx-card__title">Was sich zuerst verbessert</h3>
					<ul class="premium-list" style="margin-top:1rem;">
						<li><span class="check-icon">✓</span> <div>Money Pages werden klarer, schneller und argumentativ sauberer</div></li>
						<li><span class="check-icon">✓</span> <div>Tracking und Consent liefern endlich belastbare Signale</div></li>
						<li><span class="check-icon">✓</span> <div>SEO, Proof und CTA-Führung ziehen in dieselbe Richtung</div></li>
					</ul>
					<p style="color:var(--nx-text-muted); margin:0;">Keine Hype-Metriken. Erst die Bremsen lösen, dann skalieren.</p>
				</article>
			</div>

			<div class="selection-card nx-reveal" style="margin:0 auto 2.5rem;">
				<span class="selection-card-label">Passt nicht</span>
				<p style="margin:0; color:var(--nx-text-muted);">Für reine Visitenkarten, Billig-Umsetzungen oder Teams, die zehn Taktiken parallel starten wollen. Das System ist für B2B-Unternehmen, die WordPress als echten Nachfragekanal ernst nehmen.</p>
			</div>

			<div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem;">
				<a href="<?php echo esc_url( $urls['audit'] ); ?>" class="nx-btn nx-btn--primary" data-track-action="cta_erfolge_audit" data-track-category="lead_gen">Audit starten</a>
				<a href="<?php echo esc_url( $urls['cases'] ); ?>" class="nx-btn nx-btn--ghost" data-track-action="cta_erfolge_cases" data-track-category="lead_gen">Weitere Case Studies</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_erfolge', 'hu_erfolge_section_shortcode' );

/**
 * Homepage working method section.
 *
 * @return string
 */
function hu_prozess_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="prozess" aria-labelledby="process-heading">
		<div class="container">
			<div class="section-title">
				<span class="badge">Wie ich arbeite</span>
				<h2 id="process-heading">Weniger Aktionismus. Mehr Reihenfolge.</h2>
				<p>Die stärksten Hebel sitzen fast nie da, wo klassische Agentur-Scopes anfangen. Deshalb arbeite ich nach Abhängigkeiten, nicht nach Popularität.</p>
			</div>
			<div class="process">
				<article class="step"><div class="num">1</div><h3>Diagnose vor Pitch</h3><p class="muted">Erst prüfen wir, wo Sichtbarkeit, Vertrauen oder Conversion wegbrechen. Dann entscheiden wir, ob ein tieferer Eingriff wirtschaftlich Sinn ergibt.</p></article>
				<article class="step"><div class="num">2</div><h3>WordPress als Infrastruktur</h3><p class="muted">Ich denke nicht in Einzelseiten, sondern in Seitenrollen, internen Verbindungen, Measurement und dem nächsten sinnvollen Schritt für den Nutzer.</p></article>
				<article class="step"><div class="num">3</div><h3>Measurement mit Maß</h3><p class="muted">Privacy-first heißt nicht blind. Wir messen nur das, was Entscheidungen verbessert und Teams handlungsfähig macht.</p></article>
				<article class="step"><div class="num">4</div><h3>Ownership statt Lock-in</h3><p class="muted">Code, Content, Tracking-Logik und Priorisierung bleiben nachvollziehbar. Keine Blackbox, kein künstlicher Agenturbedarf.</p></article>
			</div>
			<div style="text-align:center; margin-top:2rem;">
				<a href="<?php echo esc_url( $urls['about'] ); ?>" class="btn btn-ghost">Mehr über meine Arbeitsweise</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_prozess', 'hu_prozess_section_shortcode' );

/**
 * Homepage FAQ section.
 *
 * @return string
 */
function hu_faq_section_shortcode() {
	ob_start();
	?>
	<section id="faq" class="homepage-faq-section" aria-labelledby="faq-heading" style="background:var(--glass-bg); border-top:1px solid var(--glass-border); padding:5rem 0; order:95;">
		<div class="nx-container">
			<div class="nx-reveal" style="text-align:center; margin-bottom:3rem;">
				<span class="nx-badge nx-badge--gold">FAQ</span>
				<h2 id="faq-heading" style="font-size:clamp(1.8rem,3vw,2.4rem); margin:1rem 0 0.5rem; color:#fff;">Häufige Fragen</h2>
				<p style="color:var(--nx-text-muted);">Klarheit vor dem nächsten Schritt.</p>
			</div>
			<div class="nx-faq">
				<details class="nx-faq__item nx-reveal">
					<summary>Was unterscheidet Sie von einer klassischen WordPress-Agentur?</summary>
					<div class="nx-faq__content">Ich verkaufe nicht zuerst Seiten oder Leistungslisten. Ich baue eine WordPress-Präsenz so um, dass Positionierung, Messbarkeit und Conversion als System arbeiten.</div>
				</details>
				<details class="nx-faq__item nx-reveal">
					<summary>Ist das eher SEO, Tracking oder CRO?</summary>
					<div class="nx-faq__content">Genau diese Trennung ist meist das Problem. In der Praxis greifen technische SEO, privacy-first Measurement und Conversion-Logik ineinander. Ich arbeite an der Schnittstelle.</div>
				</details>
				<details class="nx-faq__item nx-reveal">
					<summary>Brauchen wir danach noch Ads?</summary>
					<div class="nx-faq__content">Möglicherweise. Aber erst dann, wenn die Seite Nachfrage halten und sauber messen kann. Ads sind bei mir ein Verstärker, nicht das Betriebssystem.</div>
				</details>
				<details class="nx-faq__item nx-reveal">
					<summary>Wie startet die Zusammenarbeit?</summary>
					<div class="nx-faq__content">Mit dem Growth Audit. Danach ist klar, ob ein 360 Grad Blueprint sinnvoll ist oder ob kleinere strukturelle Eingriffe bereits genügen.</div>
				</details>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_faq', 'hu_faq_section_shortcode' );

/**
 * Homepage blog section.
 *
 * @return string
 */
function hu_blog_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="blog" class="wp-section homepage-blog-section" style="border-top:1px solid rgba(255,255,255,0.05); order:99;">
		<div class="wp-container">
			<div class="wp-section-title text-center" style="margin-bottom:4rem;">
				<span class="wp-badge">Insights</span>
				<h2 style="font-size:2.5rem; margin-bottom:1rem; color:#fff;">WordPress, Nachfrage, Infrastruktur</h2>
				<p class="wp-hero-subtitle">Für Teams, die verstehen wollen, warum Websites trotz Traffic keine belastbaren Anfragen erzeugen.</p>
			</div>

			<div class="wp-cards">
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
						$cat_name   = ! empty( $categories ) ? $categories[0]->name : 'Insights';
						?>
						<article class="wp-success-card" style="position:relative; display:flex; flex-direction:column;">
							<a href="<?php the_permalink(); ?>" class="card-link-wrapper" style="text-decoration:none; color:inherit; display:flex; flex-direction:column; height:100%;">
								<?php if ( $thumb_url ) : ?>
									<div class="card-image-wrapper" style="border-radius:12px; overflow:hidden; margin-bottom:1.5rem; border:1px solid var(--border);">
										<img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; height:200px; object-fit:cover; transition:transform 0.4s ease;" loading="lazy">
									</div>
								<?php endif; ?>

								<div class="card-content" style="flex-grow:1; display:flex; flex-direction:column;">
									<span class="wp-metric-label" style="display:block; margin-bottom:0.5rem; text-transform:uppercase; font-size:0.75rem; color:var(--gold); font-weight:700;">
										<?php echo esc_html( $cat_name ); ?>
									</span>
									<h3 class="wp-success-title" style="min-height:3.5rem; line-height:1.3; font-size:1.4rem; color:#fff; margin:0 0 1rem 0;"><?php the_title(); ?></h3>
									<p style="color:var(--text-dim); font-size:0.95rem; line-height:1.6; margin:0 0 1.5rem 0;">
										<?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?>
									</p>
									<span class="text-gold" style="font-weight:700; font-size:0.9rem; margin-top:auto; display:inline-block;">Analyse lesen -></span>
								</div>
							</a>
						</article>
						<?php
					endwhile;
					wp_reset_postdata();
				else :
					echo '<p style="text-align:center; width:100%; opacity:0.6;">Aktuell werden neue Analysen vorbereitet.</p>';
				endif;
				?>
			</div>

			<div style="text-align:center; margin-top:4rem;">
				<a href="<?php echo esc_url( $urls['blog'] ); ?>" class="wp-btn wp-btn-secondary">Zum Insights-Bereich</a>
			</div>
		</div>
	</section>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_blog', 'hu_blog_section_shortcode' );

/**
 * Homepage final CTA.
 *
 * @return string
 */
function hu_cta_section_shortcode() {
	$urls = hu_home_urls();

	ob_start();
	?>
	<section id="cta" aria-labelledby="cta-heading" style="padding:5rem 0; order:90;">
		<div class="nx-container">
			<div class="nx-cta-box nx-reveal">
				<span class="nx-badge nx-badge--gold" style="display:inline-block; margin-bottom:1.5rem;">Nächster Schritt</span>
				<h2 id="cta-heading" style="font-size:clamp(1.8rem,3vw,2.4rem); margin-bottom:1rem; color:#fff;">Prüfen wir, wo Ihre WordPress-Seite Anfragen verliert.</h2>
				<p>Im Growth Audit sehen Sie, wo Sichtbarkeit, Vertrauen oder Conversion wegbrechen und ob sich ein tieferer Umbau wirtschaftlich lohnt.</p>

				<div role="group" aria-label="Audit-Merkmale" style="display:flex; flex-wrap:wrap; justify-content:center; gap:0.75rem 1.5rem; margin-bottom:2rem;">
					<span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ klare Einschätzung statt Bauchgefühl</span>
					<span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ Positionierung, Measurement und Conversion gemeinsam betrachtet</span>
					<span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ sinnvoller nächster Schritt statt Leistungsverkauf</span>
				</div>

				<div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem;">
					<a class="nx-btn nx-btn--primary" href="<?php echo esc_url( $urls['audit'] ); ?>" data-track-action="cta_footer_audit" data-track-category="lead_gen">Audit starten</a>
					<a class="nx-btn nx-btn--ghost" href="<?php echo esc_url( $urls['cases'] ); ?>" data-track-action="cta_footer_cases" data-track-category="lead_gen">Case Studies ansehen</a>
				</div>

				<p style="font-size:0.8rem; color:var(--nx-text-muted); margin-top:1.5rem; margin-bottom:0;">
					Wenn Sie erst das Modell verstehen wollen:
					<a href="<?php echo esc_url( $urls['wgos'] ); ?>" style="color:var(--nx-gold); text-decoration:underline; font-weight:600;">WGOS ansehen -></a>
				</p>
			</div>
		</div>
	</section>

	</div>
	<?php

	return ob_get_clean();
}
add_shortcode( 'hu_cta', 'hu_cta_section_shortcode' );
