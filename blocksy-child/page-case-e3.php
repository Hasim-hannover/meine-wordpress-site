<?php
/**
 * Template Name: Case Study – E3 New Energy
 * Description: Flagship Case Study: E3 New Energy GmbH – von 0 auf 1.750+ Leads
 *
 * Design: Nutzt Nexus Design System (design-system.css + case-study.css)
 * SEO-Meta: inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="cs-case-wrapper">

<!-- Reading Progress Bar -->
<div id="nx-progress-bar"></div>

<!-- ========================================
     SMART SIDE NAV
     ======================================== -->
<nav class="nx-sidenav nx-hide-mobile" id="case-nav" aria-label="Seitennavigation">
    <ul>
        <li><a href="#kontext"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">Kontext</span></a></li>
        <li><a href="#constraints"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">Ausgangslage</span></a></li>
        <li><a href="#vorgehen"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">Vorgehen</span></a></li>
        <li><a href="#nicht"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">Nicht gemacht</span></a></li>
        <li><a href="#ergebnis"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">Ergebnis</span></a></li>
        <li><a href="#faq"><span class="nx-sidenav__dot"></span><span class="nx-sidenav__text">FAQ</span></a></li>
    </ul>
</nav>

<!-- ========================================
     SECTION 1: HERO
     ======================================== -->
<section class="cs-case-hero nx-section nx-hero--compact" id="hero">
    <div class="nx-container">
        <span class="nx-badge nx-badge--gold">Flagship Case Study</span>

        <h1 class="cs-case-hero__title">
            Von 150&nbsp;€ CPL auf <span class="nx-text-gold">~25&nbsp;€</span>&nbsp;—<br>
            1.750+ Leads im System.
        </h1>

        <p class="cs-case-hero__subtitle">
            Wie E3 New Energy GmbH mit einer neuen WordPress-Architektur
            qualifizierte B2B-Leads generiert&nbsp;— organisch &amp; paid, messbar, skalierbar.
        </p>

        <!-- KPI Snapshot (3 Tiles) -->
        <div class="cs-kpi-row">
            <div class="cs-kpi-tile">
                <span class="cs-kpi-value nx-text-gold">1.750+</span>
                <span class="cs-kpi-label">Qualif. Leads / Jahr</span>
            </div>
            <div class="cs-kpi-tile cs-kpi-tile--center">
                <span class="cs-kpi-value nx-text-gold">-83%</span>
                <span class="cs-kpi-label">Cost per Lead</span>
            </div>
            <div class="cs-kpi-tile">
                <span class="cs-kpi-value nx-text-gold">+270%</span>
                <span class="cs-kpi-label">Conversion Rate</span>
            </div>
        </div>

        <!-- Hero CTAs -->
        <div class="cs-hero-ctas">
            <a href="/customer-journey-audit/"
               class="nx-btn nx-btn--primary"
               data-track-action="cta_case_hero_audit"
               data-track-category="lead_gen">
                Free Journey Audit starten (0&nbsp;€)
            </a>
            <a href="/case-studies/"
               class="nx-btn nx-btn--ghost">
                Alle Case Studies →
            </a>
        </div>

        <!-- Meta Row -->
        <div class="cs-hero-meta">
            <span class="cs-meta-item">Branche: Erneuerbare Energien (B2B)</span>
            <span class="cs-meta-sep">·</span>
            <span class="cs-meta-item">Kanal: SEO + Performance Ads</span>
            <span class="cs-meta-sep">·</span>
            <span class="cs-meta-item">Zeitraum: 12 Monate</span>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 2: KONTEXT
     ======================================== -->
<section class="nx-section cs-section-alt" id="kontext">
    <div class="nx-container">

        <div class="nx-section-header">
            <span class="nx-badge nx-badge--ghost">Ausgangssituation</span>
            <h2 class="nx-headline-section" style="margin-top:1rem;">
                Was E3 New Energy wirklich brauchte
            </h2>
        </div>

        <div class="cs-kontext-grid">
            <div class="cs-kontext-text nx-prose">
                <p>
                    E3 New Energy GmbH vermittelt Photovoltaik-Anlagen und Wärmepumpen an
                    mittelständische Gewerbe- und Industriekunden. Das Unternehmen hatte eine
                    WordPress-Seite&nbsp;— aber keine Strategie, wie diese Website kontinuierlich
                    qualifizierte Anfragen generieren soll.
                </p>
                <p>
                    Leads wurden zugekauft&nbsp;— im Schnitt 150&nbsp;€ pro Lead. Performance Ads
                    liefen, aber die organische Sichtbarkeit war nahe null. Die Kosten
                    stiegen, die Qualität der eingekauften Leads war inkonsistent.
                    Die Aufgabe: Eine WordPress-Infrastruktur aufbauen, die qualifizierte
                    B2B-Entscheider selbst anzieht&nbsp;— und den Cost per Lead strukturell senkt,
                    statt ihn nur durch höheres Budget zu verwalten.
                </p>
                <p>
                    Kein Agenturmodell mit Stundensätzen. Assets, die dem Unternehmen
                    gehören&nbsp;— kombiniert mit gezieltem Paid-Einsatz dort, wo er sich rechnet.
                </p>
            </div>

            <div class="cs-kontext-card nx-card">
                <p class="nx-card__subtitle">Eckdaten</p>
                <ul class="cs-fact-list">
                    <li>
                        <span class="cs-fact-label">Unternehmen</span>
                        <span class="cs-fact-value">E3 New Energy GmbH</span>
                    </li>
                    <li>
                        <span class="cs-fact-label">Branche</span>
                        <span class="cs-fact-value">Erneuerbare Energien</span>
                    </li>
                    <li>
                        <span class="cs-fact-label">Zielgruppe</span>
                        <span class="cs-fact-value">Gewerbe &amp; Industrie ab 500k€</span>
                    </li>
                    <li>
                        <span class="cs-fact-label">Ausgangslage</span>
                        <span class="cs-fact-value">WordPress ohne Lead-Strategie</span>
                    </li>
                    <li>
                        <span class="cs-fact-label">Zeitraum</span>
                        <span class="cs-fact-value">12 Monate WGOS</span>
                    </li>
                    <li>
                        <span class="cs-fact-label">System</span>
                        <span class="cs-fact-value">WordPress Growth OS</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 3: CONSTRAINTS
     ======================================== -->
<section class="nx-section" id="constraints">
    <div class="nx-container">

        <div class="nx-section-header">
            <span class="nx-badge nx-badge--ghost">Die echten Hürden</span>
            <h2 class="nx-headline-section" style="margin-top:1rem;">
                Was die Arbeit schwierig machte
            </h2>
            <p class="nx-subheadline" style="margin:1rem auto 0;">
                Drei strukturelle Probleme, die ad-hoc-Lösungen ausschlossen.
            </p>
        </div>

        <div class="nx-grid nx-grid-3" style="margin-top:3rem;">

            <div class="nx-card nx-card--flat cs-constraint-card">
                <div class="cs-constraint-num">01</div>
                <h3 class="nx-card__title">Kein Tracking</h3>
                <p class="nx-card__text">
                    GA4 war installiert, aber ohne Events, Conversions oder Attribution.
                    Keine Datengrundlage für Entscheidungen&nbsp;— jede Optimierung war Raten.
                </p>
            </div>

            <div class="nx-card nx-card--flat cs-constraint-card">
                <div class="cs-constraint-num">02</div>
                <h3 class="nx-card__title">0 organische Sichtbarkeit</h3>
                <p class="nx-card__text">
                    Für alle relevanten Suchbegriffe (PV Gewerbe, Wärmepumpe Industrie etc.)
                    war die Domain nicht auf Seite 1&nbsp;— nicht einmal Seite 3.
                    PageSpeed: 34 (Mobile).
                </p>
            </div>

            <div class="nx-card nx-card--flat cs-constraint-card cs-constraint-card--highlight">
                <div class="cs-constraint-num">03</div>
                <h3 class="nx-card__title">Leads zugekauft — ø 150&nbsp;€/Stück</h3>
                <p class="nx-card__text">
                    Externe Lead-Listen und Kauf-Leads zum Durchschnittspreis von 150&nbsp;€.
                    Keine Qualifizierung nach Anlagengröße oder Entscheidungsphase&nbsp;—
                    Vertrieb und Neugierige landeten im selben Postfach.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ========================================
     SECTION 4: VORGEHEN (3 Phasen)
     ======================================== -->
<section class="nx-section cs-section-alt" id="vorgehen">
    <div class="nx-container">

        <div class="nx-section-header">
            <span class="nx-badge nx-badge--gold">Das Vorgehen</span>
            <h2 class="nx-headline-section" style="margin-top:1rem;">
                3 Phasen. Ein System.
            </h2>
            <p class="nx-subheadline" style="margin:1rem auto 0;">
                Kein Big-Bang-Relaunch. Systematischer Aufbau in Monatssprints.
            </p>
        </div>

        <div class="cs-phases" style="margin-top:3rem;">

            <!-- Phase 1 -->
            <div class="cs-phase-item">
                <div class="cs-phase-header">
                    <div class="nx-step__number">1</div>
                    <div>
                        <span class="cs-phase-label">Monat 1–3</span>
                        <h3 class="cs-phase-title">Fundament: Tracking + Performance</h3>
                    </div>
                </div>
                <div class="cs-phase-body">
                    <p class="nx-card__text">
                        Server-Side GTM aufsetzen, GA4 Conversions konfigurieren, Consent Mode v2
                        implementieren. PageSpeed von 34 auf 98 (Mobile) gebracht.
                        Core Web Vitals: alle grün. LCP unter 0,8s.
                    </p>
                    <ul class="cs-phase-outcomes">
                        <li>✓ 98 PageSpeed Mobile</li>
                        <li>✓ &gt;92% Tracking-Genauigkeit</li>
                        <li>✓ Consent Mode v2 DSGVO-konform</li>
                    </ul>
                </div>
            </div>

            <!-- Phase 2 -->
            <div class="cs-phase-item">
                <div class="cs-phase-header">
                    <div class="nx-step__number">2</div>
                    <div>
                        <span class="cs-phase-label">Monat 4–7</span>
                        <h3 class="cs-phase-title">Sichtbarkeit: SEO-Architektur + Content</h3>
                    </div>
                </div>
                <div class="cs-phase-body">
                    <p class="nx-card__text">
                        Keyword-Cluster für Gewerbe-PV und Wärmepumpe Industrie aufgebaut.
                        Pillar Pages + Supporting Content strukturiert. Interne Verlinkung
                        nach Silo-Prinzip. Schema-Markup für alle kritischen Seiten.
                    </p>
                    <ul class="cs-phase-outcomes">
                        <li>✓ 12 Pillar Pages live</li>
                        <li>✓ Seite-1-Rankings für 23 Keywords</li>
                        <li>✓ +340% organischer Traffic in 90 Tagen</li>
                    </ul>
                </div>
            </div>

            <!-- Phase 3 -->
            <div class="cs-phase-item cs-phase-item--highlight">
                <div class="cs-phase-header">
                    <div class="nx-step__number">3</div>
                    <div>
                        <span class="cs-phase-label">Monat 8–12</span>
                        <h3 class="cs-phase-title">Conversion: Lead-System + Qualifizierung</h3>
                    </div>
                </div>
                <div class="cs-phase-body">
                    <p class="nx-card__text">
                        Journey-Audit als Lead-Magnet aufgebaut. Qualifizierungs-Flows nach
                        Anlagengröße und Branche. n8n-Automatisierung für Lead-Routing.
                        CTA-System nach dem Free-Journey-Audit-Prinzip.
                    </p>
                    <ul class="cs-phase-outcomes">
                        <li>✓ 1.750+ Leads in 5 Monaten</li>
                        <li>✓ -83% Cost per Lead vs. Ads-Phase</li>
                        <li>✓ +270% Conversion Rate gesamt</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================
     SECTION 5: WAS WIR NICHT GEMACHT HABEN
     ======================================== -->
<section class="nx-section" id="nicht">
    <div class="nx-container">

        <div class="nx-section-header">
            <span class="nx-badge nx-badge--ghost">Ehrliche Einordnung</span>
            <h2 class="nx-headline-section" style="margin-top:1rem;">
                Was wir <em style="color:var(--nx-gold);font-style:normal;">nicht</em> gemacht haben
            </h2>
            <p class="nx-subheadline" style="margin:1rem auto 0;">
                Was andere Agenturen oft verkaufen&nbsp;— und warum wir es weggelassen haben.
            </p>
        </div>

        <div class="nx-grid nx-grid-2" style="margin-top:3rem;gap:1.5rem;">

            <div class="cs-not-item">
                <span class="cs-not-x">✕</span>
                <div>
                    <strong>Kein kompletter Relaunch</strong>
                    <p>Bestehende Domain-Autorität und Rankings schützen. Gezielter Ausbau statt Reset.</p>
                </div>
            </div>

            <div class="cs-not-item">
                <span class="cs-not-x">✕</span>
                <div>
                    <strong>Kein Ads-only-Ansatz</strong>
                    <p>Paid Ads ergänzen das System — ersetzen es nicht. Owned Assets reduzieren die Abhängigkeit von laufendem Budgeteinsatz.</p>
                </div>
            </div>

            <div class="cs-not-item">
                <span class="cs-not-x">✕</span>
                <div>
                    <strong>Kein CMS-Wechsel</strong>
                    <p>WordPress weiterentwickelt statt migriert. Keine Unterbrechung, keine Lernkurve für das Team.</p>
                </div>
            </div>

            <div class="cs-not-item">
                <span class="cs-not-x">✕</span>
                <div>
                    <strong>Kein Agentur-Lock-in</strong>
                    <p>Alle Assets, Zugänge und Dokumentationen beim Kunden. Wechsel jederzeit möglich.</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ========================================
     SECTION 6: ERGEBNIS
     ======================================== -->
<section class="nx-section cs-section-results" id="ergebnis">
    <div class="nx-container">

        <div class="nx-section-header">
            <span class="nx-badge nx-badge--gold">Die Zahlen</span>
            <h2 class="nx-headline-section" style="margin-top:1rem;">
                Ergebnis nach 12 Monaten
            </h2>
        </div>

        <!-- Big KPI Grid -->
        <div class="cs-results-grid" style="margin-top:3rem;">

            <div class="cs-result-card cs-result-card--primary">
                <span class="cs-result-value">1.750+</span>
                <span class="cs-result-label">Qualifizierte B2B-Leads</span>
                <span class="cs-result-note">organisch &amp; paid kombiniert</span>
            </div>

            <div class="cs-result-card">
                <span class="cs-result-value">-83%</span>
                <span class="cs-result-label">Cost per Lead</span>
                <span class="cs-result-note">von ø 150&nbsp;€ auf ~25&nbsp;€</span>
            </div>

            <div class="cs-result-card">
                <span class="cs-result-value">+270%</span>
                <span class="cs-result-label">Conversion Rate</span>
                <span class="cs-result-note">Traffic → qualifizierte Anfrage</span>
            </div>

            <div class="cs-result-card">
                <span class="cs-result-value">98</span>
                <span class="cs-result-label">PageSpeed Mobile</span>
                <span class="cs-result-note">Ausgangswert: 34</span>
            </div>

            <div class="cs-result-card">
                <span class="cs-result-value">+340%</span>
                <span class="cs-result-label">Organischer Traffic</span>
                <span class="cs-result-note">in den ersten 90 Tagen</span>
            </div>

            <div class="cs-result-card">
                <span class="cs-result-value">23</span>
                <span class="cs-result-label">Seite-1-Keywords</span>
                <span class="cs-result-note">Ausgangswert: 0</span>
            </div>

        </div>


    </div>
</section>

<!-- ========================================
     SECTION 7: FAQ
     ======================================== -->
<section class="nx-section" id="faq">
    <div class="nx-container">

        <div class="nx-section-header">
            <h2 class="nx-headline-section">Häufige Fragen</h2>
        </div>

        <div class="nx-faq" style="margin-top:2rem;">

            <details class="nx-faq__item">
                <summary>Ist das auf unser Unternehmen übertragbar?</summary>
                <div class="nx-faq__content">
                    Die Ergebnisse entstanden durch ein System, das auf B2B-Unternehmen
                    ab ~500k€ Jahresumsatz ausgelegt ist. Ob ähnliche Hebel für Sie
                    existieren, zeigt der Free Journey Audit in 48h&nbsp;— ohne Verpflichtung.
                </div>
            </details>

            <details class="nx-faq__item">
                <summary>Wie lange dauert es bis zu ersten Leads?</summary>
                <div class="nx-faq__content">
                    Phase 1 (Tracking + Performance) ist in 4–6 Wochen abgeschlossen.
                    Erste organische Leads kamen bei E3 nach Woche 14. Skalierung
                    ab Monat 6. Genaue Zeitlinie hängt von Ausgangslage und Branche ab.
                </div>
            </details>

            <details class="nx-faq__item">
                <summary>Was kostet das WordPress Growth Operating System?</summary>
                <div class="nx-faq__content">
                    Das WGOS ist ein monatliches Credit-Modell: Sie buchen ein Kontingent,
                    wir setzen Module nach Priorität um. Kein Stundensatz, kein Lock-in.
                    Details und Pakete finden Sie auf der
                    <a href="/wordpress-growth-operating-system/">WGOS-Seite</a>.
                </div>
            </details>

            <details class="nx-faq__item">
                <summary>Bleibt alles bei mir, wenn wir aufhören zusammenzuarbeiten?</summary>
                <div class="nx-faq__content">
                    Ja, vollständig. Code, Content, Tracking-Setup, Zugänge&nbsp;— alles gehört
                    Ihnen. Das ist kein Versprechen, das ist die technische Realität
                    von WordPress und Open Source.
                </div>
            </details>

        </div>

    </div>
</section>

<!-- ========================================
     SECTION 8: NEXT STEP CTA
     ======================================== -->
<section class="nx-section cs-section-cta" id="next-step">
    <div class="nx-container">

        <div class="nx-cta-box">
            <span class="nx-badge nx-badge--gold" style="margin-bottom:1.5rem;display:inline-block;">Nächster Schritt</span>
            <h2 style="font-size:clamp(1.8rem,3.5vw,2.8rem);margin-bottom:1rem;">
                Welche Hebel liegen bei Ihnen brach?
            </h2>
            <p style="color:var(--nx-text-muted);max-width:560px;margin:0 auto 2rem;line-height:1.6;">
                Im Free Journey Audit analysieren wir Ihre WordPress-Präsenz
                auf die größten Wachstumspotenziale&nbsp;— kostenlos, in 48h, ohne Pitch.
            </p>

            <div class="cs-cta-buttons">
                <a href="/customer-journey-audit/"
                   class="nx-btn nx-btn--primary"
                   data-track-action="cta_case_nextstep_audit"
                   data-track-category="lead_gen">
                    Free Journey Audit starten (0&nbsp;€)
                </a>
            </div>

            <p style="font-size:0.75rem;color:#555;margin-top:1rem;">
                Ergebnisse hängen von Ausgangslage ab&nbsp;— im Audit sehen Sie die größten Hebel.
            </p>

            <!-- 3 Internal Links -->
            <div class="cs-internal-links">
                <a href="/wordpress-growth-operating-system/" class="cs-internal-link">
                    WGOS: Das System dahinter →
                </a>
                <a href="/case-studies/" class="cs-internal-link">
                    Weitere Case Studies →
                </a>
                <a href="/wordpress-agentur-hannover/" class="cs-internal-link">
                    WordPress Agentur Hannover →
                </a>
            </div>

        </div>

    </div>
</section>

</div><!-- .cs-case-wrapper -->

<?php get_footer(); ?>
