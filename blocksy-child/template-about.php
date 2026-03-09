<?php
/**
 * Template Name: Nexus Über Mich
 *
 * About-Seite – hardcoded Content (CRO-optimiert, Growth Audit als Primary CTA).
 * Design: Nexus Design System (Gold/Dark) via about-page.css.
 * SEO-Meta: inc/seo-meta.php (ACF: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();

$audit_url = nexus_get_audit_url();
$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
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
        <li><a href="#about-hero"><span class="nav-dot"></span><span class="nav-text">Haltung</span></a></li>
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

            <span class="method-badge">Über mich</span>

            <h1 class="story-headline">
                Ich baue keine Websites.
                <span class="highlight">Ich baue Systeme für planbare B2B-Anfragen.</span>
            </h1>

            <p class="story-paragraph">
                Die meisten Websites sehen gut aus, arbeiten aber nicht als Vertriebssystem.
                Genau dort setze ich an: mit einer klaren Struktur aus Positionierung,
                Messbarkeit und Conversion-Architektur.
            </p>
            <p class="story-paragraph no-animate">
            Nicht mehr Reichweite ist zuerst das Problem,
                sondern fehlende Systemlogik. Wenn Fundament, Aufbau und Skalierung sauber
                zusammenspielen, werden Anfragen planbar&nbsp;— ohne Dauerdruck durch Ads.
            </p>

            <!-- 3 Bullets -->
            <ul class="about-hero-bullets">
                <li>System vor Einzeltaktik</li>
                <li>Klarer Prozess statt Aktionismus</li>
                <li>Ownership statt Agentur-Abhängigkeit</li>
            </ul>

            <!-- CTA Block -->
            <div class="about-hero-ctas">
                <a href="<?php echo esc_url( $audit_url ); ?>"
                   class="btn btn-primary"
                   data-track-action="cta_about_hero_audit"
                   data-track-category="lead_gen">
                    Growth Audit starten
                </a>
                <a href="<?php echo esc_url( $cases_url ); ?>" class="btn btn-ghost">
                    Case Studies ansehen
                </a>
            </div>

            <!-- Proof Snippet -->
            <div class="about-proof-snippet">
                <span class="about-proof-label">Nachweis:</span>
                <span class="about-proof-kpi">Dokumentierte Case Studies statt Behauptungen</span>
                <span class="about-proof-sep">·</span>
                <span class="about-proof-kpi">u. a. E3 New Energy</span>
                <span class="about-proof-note"><a href="<?php echo esc_url( $cases_url ); ?>" class="about-inline-link">Ergebnisse ansehen →</a></span>
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
        <h2>Drei Prinzipien, die jede Entscheidung steuern.</h2>
    </div>

    <div class="values-narrative">

        <div class="value-story-card">
            <h3 class="value-story-title">Klarheit vor Output</h3>
            <p class="value-story-text">
                Ich starte nicht mit Tools, Plugins oder Seitenvorlagen&nbsp;— sondern mit
                Angebotsklarheit und Customer-Journey-Logik.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Jede Zusammenarbeit beginnt mit der
                Positionierung, dann mit Prioritäten, erst danach mit Umsetzung.
            </p>
        </div>

        <div class="value-story-card">
            <h3 class="value-story-title">System vor Kanal</h3>
            <p class="value-story-text">
                SEO, Tracking, CRO und gegebenenfalls Ads dürfen nicht nebeneinander laufen.
                Sie müssen als ein System arbeiten.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Wir priorisieren immer die Abhängigkeiten zuerst,
                bevor der nächste Kanal oder die nächste Maßnahme dazukommt.
            </p>
        </div>

        <div class="value-story-card">
            <h3 class="value-story-title">Ownership statt Lock-in</h3>
            <p class="value-story-text">
                Code, Content, Tracking-Setups und Zugänge gehören Ihnen.
                Nicht der Agentur, nicht einem proprietären Tool.
            </p>
            <p class="value-story-text about-principle-example">
                So zeigt sich das im Projekt: Kein Lock-in, kein proprietäres System,
                kein künstlicher Wechseldruck. Sie bleiben jederzeit handlungsfähig.
            </p>
        </div>

    </div>
</section>

<!-- ========================================
     SECTION 3: SO ARBEITE ICH (3 Phasen)
     ======================================== -->
<section id="about-methode" class="method-section">
    <div class="method-header">
        <span class="method-badge">Mein Ansatz</span>
        <h2>Fundament. Aufbau. Skalierung.</h2>
        <p class="method-subtitle">
            Kein Big-Bang-Relaunch. Erst Stabilität und Messbarkeit, dann Sichtbarkeit
            und Conversion, danach optional Skalierung.
        </p>
    </div>

    <div class="growth-visual">

        <div class="growth-step" data-step="01">
            <h3 class="step-title">Fundament</h3>
            <ul class="about-phase-list">
                <li>Technische Stabilität, Security und Performance als Grundlage</li>
                <li>Saubere Messbarkeit über alle relevanten Touchpoints</li>
                <li>Klare Prioritäten statt ungeordneter To-do-Listen</li>
            </ul>
        </div>

        <div class="growth-step" data-step="02">
            <h3 class="step-title">Aufbau</h3>
            <ul class="about-phase-list">
                <li>SEO-Architektur: Themencluster, Seitenstruktur, interne Verlinkung</li>
                <li>Conversion-Architektur: Seiten, CTAs, Formulare, Angebotslogik</li>
                <li>Content mit klarem Zweck: Sichtbarkeit, Vertrauen, Anfrage</li>
            </ul>
        </div>

        <div class="growth-step" data-step="03">
            <h3 class="step-title">Skalierung</h3>
            <ul class="about-phase-list">
                <li>Paid Ads als Verstärker, nicht als Basis</li>
                <li>Automation für Übergabe, Nurture und Reporting</li>
                <li><a href="/wordpress-growth-operating-system/" class="about-inline-link">WGOS</a> als Betriebssystem: klare Credits, volle Ownership</li>
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
        <h2>Kein Agentur-Sprech. Praxis aus echter Verantwortung.</h2>
    </div>

    <div class="journey-intro">
        <p>
            Ich komme aus Vertrieb, Medien und eigenem Unternehmerrisiko.
            Deshalb arbeite ich nicht in hübschen Einzelmaßnahmen, sondern in
            Systemen, die geschäftlich tragen müssen.
        </p>
    </div>

    <div class="milestone-grid">

        <div class="milestone">
            <span class="milestone-year">Herkunft</span>
            <div class="milestone-content">
                <h3 class="milestone-title">Praxis vor Theorie</h3>
                <p class="milestone-story">
                    Vertrieb schärft den Blick für Zielgruppen und Einwände.
                    Eigene unternehmerische Projekte schärfen den Blick für Kosten,
                    Risiko und Priorisierung. Diese Perspektive prägt jedes Projekt.
                <p class="story-paragraph">
                    Die meisten Websites sehen gut aus, arbeiten aber nicht als Vertriebssystem.<br>
                    Genau dort setze ich an: mit klarer Positionierung, sauberer Messbarkeit und einer Struktur, die Vertrauen aufbaut und Anfragen wahrscheinlicher macht.
                </p>
                <p class="story-paragraph">
                    Nicht mehr Reichweite ist zuerst das Problem, sondern fehlende Systemlogik.<br>
                    Wenn Fundament, Aufbau und Skalierung sauber zusammenspielen, wird aus einer Website kein hübscher Kanal, sondern ein geschäftlich relevantes System.
                </p>

                <div class="about-hero-ctas">
                    <a href="<?php echo esc_url( $audit_url ); ?>"
                       class="btn btn-primary"
                       data-track-action="cta_about_hero_audit"
                       data-track-category="lead_gen">
                        Growth Audit starten
                    </a>
                    <span class="about-hero-link">
                        <a href="<?php echo esc_url( $cases_url ); ?>" class="about-inline-link">Ergebnisse &amp; Case Studies ansehen →</a>
                    </span>
                </div>

                <div class="about-proof-snippet" style="margin-top:1.5rem; font-size:1rem; color:#888;">
                    Nachweis: dokumentierte Projekte mit klarer Ausgangslage, Maßnahmen und Wirkung.
                </div>
                <p>Ein Unternehmen sollte digital nicht abhängiger werden, sondern freier. Die eigene Website, die eigenen Inhalte, die eigenen Daten und die eigene Struktur sollten ein Vermögenswert sein — nicht eine Blackbox, die nur mit externer Hilfe irgendwie am Laufen bleibt.</p>
                <p>Darum baue ich nicht einfach Seiten.<br>Ich baue digitale Grundlagen, die tragen.</p>

                <h2>Für wen ich arbeite</h2>
                <p>Ich arbeite am liebsten mit Unternehmen, die verstanden haben, dass ihre Website mehr sein muss als ein schöner Auftritt.</p>
                <p>Mit Entscheidern, die nicht nach Oberflächenkosmetik suchen, sondern nach Klarheit.<br>Mit Unternehmen, die digital nicht nur vorhanden sein, sondern wirksam werden wollen.<br>Mit Menschen, die Substanz höher bewerten als Lärm.</p>
                <p>Denn am Ende geht es nicht darum, ob eine Website modern aussieht.<br>Es geht darum, ob sie geschäftlich etwas leistet.</p>
                <p>Ob sie Vertrauen aufbaut.<br>Ob sie Orientierung gibt.<br>Ob sie Relevanz erzeugt.<br>Ob sie die richtigen Menschen in Bewegung bringt.</p>

                <h2>Kurz gesagt</h2>
                <p>Ich helfe Unternehmen dabei, aus ihrer Website mehr zu machen als eine digitale Visitenkarte.</p>
                <p>Ich entwickle Systeme, die klar kommunizieren, Vertrauen aufbauen, Nutzer sinnvoll führen und aus Sichtbarkeit Schritt für Schritt qualifizierte Nachfrage machen.</p>
                <p>Nicht lauter.<br>Nicht beliebiger.<br>Nicht dekorativer.</p>
                <p>Sondern klarer, tragfähiger und wirksamer.</p>
                <p>Denn eine Website sollte heute nicht einfach nur da sein.<br>Sie sollte etwas leisten.</p>
                <li>B2B-Unternehmen mit klarem Leistungsversprechen</li>
                <li>Teams, die strukturiert statt reaktiv wachsen wollen</li>
                <li>Unternehmen, die Abhängigkeiten reduzieren möchten</li>
            </ul>
        </div>

        <div class="about-filter-col about-filter-col--no">
            <h3 class="about-filter-label">Passt nicht</h3>
            <ul class="about-filter-list">
                <li>Sie suchen nur schnelle Einzelmaßnahmen ohne System</li>
                <li>Sie möchten Entscheidungen weiterhin aus dem Bauch treffen</li>
                <li>Sie erwarten Wachstum ohne klare Positionierung</li>
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
                Das <a href="/wordpress-growth-operating-system/" class="about-inline-link">WGOS</a>
                läuft über ein monatliches Credit-Budget&nbsp;— kein Stundensatz, kein
                unplanbarer Projektvertrag. Der Einstieg ist kostenlos über den
                <a href="<?php echo esc_url( $audit_url ); ?>">Growth Audit</a>.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Wie läuft die Zusammenarbeit ab?</summary>
            <div class="wp-faq-content">
                Wir starten mit dem Growth Audit. Danach erhalten Sie eine priorisierte
                Roadmap mit klaren Empfehlungen. Auf dieser Basis entscheiden Sie,
                ob wir gemeinsam ins System einsteigen.
            </div>
        </details>

        <details class="wp-faq-item">
            <summary>Wie lange bis zu ersten Ergebnissen?</summary>
            <div class="wp-faq-content">
                Technische Verbesserungen und saubere Messbarkeit wirken meist zuerst.
                Sichtbarkeit und organische Anfragen folgen zeitversetzt.
                Die genaue Geschwindigkeit hängt von Ausgangslage, Wettbewerb und Umsetzungstempo ab.
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
            Im <a href="<?php echo esc_url( $audit_url ); ?>" class="about-inline-link">Growth Audit</a>
            analysieren wir Ihre WordPress-Präsenz auf die größten
            Systemhebel&nbsp;— klar, priorisiert und ohne Pitch.
        </p>
        <p class="cta-story">
            Sie bekommen ein klares Bild: Was bremst Sie aktuell, was bringt am meisten
            Wirkung und in welcher Reihenfolge sollten Sie vorgehen.
        </p>

        <!-- Proof -->
        <div class="about-cta-proof">
            <span class="about-proof-kpi">Klarer Fokus</span>
            <span class="about-proof-sep">·</span>
            <span class="about-proof-kpi">Priorisierte Roadmap</span>
            <span class="about-proof-sep">·</span>
            <span class="about-proof-kpi">Messbare Umsetzung</span>
            <span class="about-proof-sep">·</span>
            <span class="about-proof-kpi">Volle Ownership</span>
        </div>

        <div class="btn-group">
            <a href="<?php echo esc_url( $audit_url ); ?>"
               class="btn btn-primary"
               data-track-action="cta_about_final_audit"
               data-track-category="lead_gen">
                Growth Audit starten
            </a>
            <a href="<?php echo esc_url( $cases_url ); ?>" class="btn btn-ghost">
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
