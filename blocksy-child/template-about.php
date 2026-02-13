<?php
/**
 * Template Name: Nexus Über Mich
 *
 * About-Seite – hardcoded Content (CRO-optimiert, Free Journey Audit als Primary CTA).
 * Design: Nexus Design System (Gold/Dark) via about-page.css.
 * SEO-Meta: inc/seo-meta.php (ACF: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();
?>

<div class="nexus-about" data-track-section="about_page">
<div class="nexus-container">

<!-- Reading Progress Bar -->
<div id="nx-progress-bar"></div>

<!-- ========================================
     SMART SIDE NAV
     ======================================== -->
<nav class="smart-nav" id="about-nav" aria-label="Seitennavigation">
    <ul>
        <li><a href="#about-hero"><span class="nav-dot"></span><span class="nav-text">Einordnung</span></a></li>
        <li><a href="#about-prinzipien"><span class="nav-dot"></span><span class="nav-text">Prinzipien</span></a></li>
        <li><a href="#about-methode"><span class="nav-dot"></span><span class="nav-text">Methode</span></a></li>
        <li><a href="#about-cred"><span class="nav-dot"></span><span class="nav-text">Warum ich</span></a></li>
        <li><a href="#about-filter"><span class="nav-dot"></span><span class="nav-text">Für wen</span></a></li>
        <li><a href="#about-faq"><span class="nav-dot"></span><span class="nav-text">FAQ</span></a></li>
        <li><a href="#about-cta"><span class="nav-dot"></span><span class="nav-text">Audit</span></a></li>
    </ul>
</nav>

<!-- ========================================
     SECTION 1: HERO
     ======================================== -->
<section id="about-hero" class="hero-story">
    <div class="hero-content">

        <div class="story-opener">

            <span class="method-badge">Growth Architect für B2B</span>

            <h1 class="story-headline">
                Qualifizierte B2B-Leads.
                <span class="highlight">Planbar. Ohne Ad-Abhängigkeit.</span>
            </h1>

            <p class="story-paragraph">
                Ich baue WordPress-Systeme, die Strategie, Tracking und Conversion-Architektur
                verbinden&nbsp;— damit B2B-Entscheider Sie finden, vertrauen und anfragen.
            </p>

            <!-- 3 Bullets -->
            <ul class="about-hero-bullets">
                <li>98 PageSpeed (Mobile) — garantiert</li>
                <li>Tracking-Genauigkeit &gt;92&nbsp;% via sGTM</li>
                <li>Owned Leads, keine Ad-Abhängigkeit</li>
            </ul>

            <!-- CTA Block -->
            <div class="about-hero-ctas">
                <a href="/customer-journey-audit/"
                   class="btn btn-primary"
                   data-track-action="cta_about_hero_audit"
                   data-track-category="lead_gen">
                    Free Journey Audit starten (0&nbsp;€)
                </a>
                <a href="/case-studies/" class="btn btn-ghost">
                    Case Studies ansehen
                </a>
            </div>

            <!-- Proof Snippet -->
            <div class="about-proof-snippet">
                <span class="about-proof-label">Beispiel E3 New Energy:</span>
                <span class="about-proof-kpi">1.750+ Leads</span>
                <span class="about-proof-sep">·</span>
                <span class="about-proof-kpi">CPL von 150&nbsp;€ → ~25&nbsp;€</span>
                <span class="about-proof-note">Ausgangslage: 0 organische Sichtbarkeit</span>
            </div>

            <!-- Location -->
            <div class="location-wrap">
                <span class="location-badge">
                    Aus Pattensen bei Hannover&nbsp;— regional verwurzelt, DACH-weit aktiv
                </span>
            </div>

        </div><!-- .story-opener -->

        <div class="hero-visual">
            <div class="hero-image-wrapper">
                <img src="https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp"
                     alt="Hasim Üner – Growth Architect für B2B-WordPress-Websites, spezialisiert auf Lead-Generierung und Conversion-Optimierung in Hannover und DACH"
                     loading="eager"
                     width="450"
                     height="560">
            </div>
        </div>

    </div><!-- .hero-content -->
</section>

<!-- ========================================
     SECTION 2: PRINZIPIEN (Wofür ich stehe)
     ======================================== -->
<section id="about-prinzipien" class="values-story">
    <div class="method-header">
        <span class="method-badge">Wofür ich stehe</span>
        <h2>Drei Prinzipien. Kein Agentur-Nebel.</h2>
    </div>

    <div class="values-narrative">

        <div class="value-story-card">
            <h3 class="value-story-title">Klarheit vor Technik</h3>
            <p class="value-story-text">
                Ein gutes System liefert keine Leads, wenn das Angebot unklar positioniert ist.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Jede Zusammenarbeit beginnt mit der
                Positionierung&nbsp;— erst dann kommt die technische Umsetzung.
            </p>
        </div>

        <div class="value-story-card">
            <h3 class="value-story-title">Daten statt Bauchgefühl</h3>
            <p class="value-story-text">
                Jede Optimierung basiert auf messbaren Signalen, nicht auf Annahmen.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Server-Side GTM und GA4 sind Standard&nbsp;—
                weil Entscheidungen ohne saubere Daten Raten sind.
            </p>
        </div>

        <div class="value-story-card">
            <h3 class="value-story-title">Ownership beim Kunden</h3>
            <p class="value-story-text">
                Code, Content, Tracking-Setup, alle Zugänge&nbsp;— alles gehört Ihnen. Keine Ausnahmen.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Kein Lock-in, kein proprietäres System,
                kein künstlicher Wechseldruck.
            </p>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 3: SO ARBEITE ICH (3 Phasen)
     ======================================== -->
<section id="about-methode" class="method-section">
    <div class="method-header">
        <span class="method-badge">So arbeite ich</span>
        <h2>Drei Phasen. Ein System.</h2>
        <p class="method-subtitle">
            Kein Big-Bang-Relaunch. Strukturierter Aufbau in priorisierten Schritten.
        </p>
    </div>

    <div class="growth-visual">

        <div class="growth-step" data-step="01">
            <h3 class="step-title">Diagnose</h3>
            <ul class="about-phase-list">
                <li>Customer Journey Audit: alle Touchpoints prüfen</li>
                <li>Tracking-Audit: GA4, Consent Mode v2, Attribution</li>
                <li>Prioritätenliste: konkrete Hebel, sortiert nach Impact</li>
            </ul>
        </div>

        <div class="growth-step" data-step="02">
            <h3 class="step-title">Fix</h3>
            <ul class="about-phase-list">
                <li>Performance: 98+ PageSpeed Mobile</li>
                <li>Conversion-Architektur: CTAs, Flows, Lead-Magnets</li>
                <li>sGTM: Tracking-Genauigkeit &gt;92&nbsp;%</li>
            </ul>
        </div>

        <div class="growth-step" data-step="03">
            <h3 class="step-title">Asset</h3>
            <ul class="about-phase-list">
                <li>SEO-Architektur: Pillar Pages, Schema, Cluster</li>
                <li>Lead-System: Qualifizierungsflows, n8n-Automation</li>
                <li><a href="/wordpress-growth-operating-system/" class="about-inline-link">WGOS</a>: monatliche Credits, kein Lock-in</li>
            </ul>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 4: CREDIBILITY (Warum ich das kann)
     ======================================== -->
<section id="about-cred" class="journey-section">
    <div class="method-header">
        <span class="method-badge">Warum ich das kann</span>
        <h2>Kein Agentur-Hintergrund. Praxis aus drei Feldern.</h2>
    </div>

    <div class="journey-intro">
        <p>
            Vertriebserfahrung (2010–2018). Medienwissenschaft (Hannover).
            Eigener E-Commerce-Shop mit echtem Risiko (2019–2023).
            Seit 2023: B2B-WordPress-Setups.
        </p>
    </div>

    <div class="milestone-grid">

        <div class="milestone">
            <span class="milestone-year">System</span>
            <div class="milestone-content">
                <h3 class="milestone-title">Dokumentierte Methodik</h3>
                <p class="milestone-story">
                    Das <a href="/wordpress-growth-operating-system/" class="about-inline-link">WGOS</a>
                    ist modular, dokumentiert und wiederholbar&nbsp;— 7 Module, strukturiert,
                    kein One-Man-Show-Flickwerk.
                </p>
            </div>
        </div>

        <div class="milestone">
            <span class="milestone-year">Ergebnis</span>
            <div class="milestone-content">
                <h3 class="milestone-title">Belegbare Zahlen</h3>
                <p class="milestone-story">
                    E3 New Energy: CPL von 150&nbsp;€ auf ~25&nbsp;€, 1.750+ Leads&nbsp;—
                    aus einem Setup mit 0 organischer Sichtbarkeit.
                    Details in den <a href="/case-studies/" class="about-inline-link">Case Studies</a>.
                </p>
            </div>
        </div>

        <div class="milestone">
            <span class="milestone-year">Messbarkeit</span>
            <div class="milestone-content">
                <h3 class="milestone-title">Verifizierbare Ergebnisse</h3>
                <p class="milestone-story">
                    Kein Projekt ohne sauberes Tracking-Setup. Ergebnisse sind nicht gefühlt&nbsp;—
                    Zugang zu GA4, sGTM-Container und n8n auf Anfrage nachvollziehbar.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 5: FILTER (Für wen passt es)
     ======================================== -->
<section id="about-filter" class="about-filter-section">
    <div class="method-header">
        <span class="method-badge">Für wen ich arbeite</span>
        <h2>Für wen es passt&nbsp;— und für wen nicht.</h2>
        <p class="method-subtitle">Spart Zeit auf beiden Seiten.</p>
    </div>

    <div class="about-filter-grid">

        <div class="about-filter-col about-filter-col--yes">
            <h3 class="about-filter-label">Passt</h3>
            <ul class="about-filter-list">
                <li>B2B-Unternehmen ab ~500.000&nbsp;€ Jahresumsatz</li>
                <li>WordPress ist Ihr CMS&nbsp;— oder Sie sind offen dafür</li>
                <li>Sie wollen planbare Anfragen statt Empfehlungs-Roulette</li>
            </ul>
        </div>

        <div class="about-filter-col about-filter-col--no">
            <h3 class="about-filter-label">Passt nicht</h3>
            <ul class="about-filter-list">
                <li>Sie suchen günstige Umsetzung ohne Strategie</li>
                <li>Sie erwarten messbare Ergebnisse in 4 Wochen</li>
                <li>Ihr Angebot ist noch nicht klar positioniert</li>
            </ul>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 6: FAQ
     ======================================== -->
<section id="about-faq" class="method-section">
    <div class="method-header">
        <span class="method-badge">FAQ</span>
        <h2>Häufige Fragen</h2>
    </div>

    <div class="about-faq-wrap">

        <details class="wp-faq-item">
            <summary>Was kostet die Zusammenarbeit?</summary>
            <div class="wp-faq-content">
                Das WGOS startet ab einem monatlichen Credit-Kontingent&nbsp;— kein Stundensatz,
                kein Projektvertrag. Der Einstieg ist kostenlos über den
                <a href="/customer-journey-audit/">Free Journey Audit</a>.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Wie läuft die Zusammenarbeit ab?</summary>
            <div class="wp-faq-content">
                Zuerst der Free Journey Audit (48h, kostenlos, kein Pitch).
                Dann eine konkrete Prioritätenliste. Danach entscheiden Sie,
                ob und wie wir weiterarbeiten.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Wie lange bis zu ersten Ergebnissen?</summary>
            <div class="wp-faq-content">
                Tracking und Performance sind in 4–6 Wochen sauber aufgesetzt.
                Erste organische Leads kamen bei E3 New Energy nach Woche&nbsp;14.
                Die genaue Zeitlinie hängt von Ausgangslage und Branche ab.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Arbeiten Sie auch mit Paid Ads?</summary>
            <div class="wp-faq-content">
                Ja&nbsp;— Paid Ads ergänzen das System dort, wo sie sich rechnen.
                Schwerpunkt liegt auf Owned Assets (SEO, CRO, Conversion-Architektur),
                weil diese langfristig günstiger sind.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Tracking und DSGVO&nbsp;— wie handhaben Sie das?</summary>
            <div class="wp-faq-content">
                Server-Side GTM, Consent Mode v2, anonymisierte IPs&nbsp;—
                alles DSGVO-konform und vollständig dokumentiert.
                Das Setup gehört Ihnen, kein Blackbox-Tracking.
            </div>
        </details>

    </div>
</section>

<!-- ========================================
     SECTION 7: FINAL CTA
     ======================================== -->
<section id="about-cta" class="cta-section">
    <div class="cta-story-box">

        <span class="method-badge" style="margin-bottom:1.5rem;display:inline-block;">Nächster Schritt</span>

        <h2 class="cta-headline">Welche Hebel liegen bei Ihnen brach?</h2>

        <p class="cta-story">
            Im <a href="/customer-journey-audit/" class="about-inline-link">Free Journey Audit</a>
            analysieren wir Ihre WordPress-Präsenz auf die größten
            Wachstumspotenziale&nbsp;— kostenlos, in 48h, ohne Pitch.
        </p>
        <p class="cta-story">
            Sie bekommen eine konkrete Prioritätenliste:
            was zuerst anpacken, was ignorieren.
        </p>

        <!-- Proof -->
        <div class="about-cta-proof">
            <span class="about-proof-kpi">1.750+ Leads</span>
            <span class="about-proof-sep">·</span>
            <span class="about-proof-kpi">CPL &minus;83&nbsp;%</span>
            <span class="about-proof-sep">·</span>
            <span class="about-proof-kpi">E3 New Energy</span>
        </div>

        <div class="btn-group">
            <a href="/customer-journey-audit/"
               class="btn btn-primary"
               data-track-action="cta_about_final_audit"
               data-track-category="lead_gen">
                Free Journey Audit starten (0&nbsp;€)
            </a>
            <a href="/case-studies/" class="btn btn-ghost">
                Case Studies ansehen
            </a>
        </div>

        <p class="about-tertiary-cta">
            Lieber sprechen?
            <a href="https://cal.com/hasim/30min" target="_blank" rel="noopener noreferrer">
                30&nbsp;Min Gespräch vereinbaren →
            </a>
        </p>

    </div>
</section>

</div><!-- .nexus-container -->
</div><!-- .nexus-about -->

<?php get_footer(); ?>
