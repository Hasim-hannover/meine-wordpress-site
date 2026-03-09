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
                <h2>Eine Website sollte 2026 mehr sein als eine digitale Visitenkarte.</h2>
                <h2>Ich baue Systeme, die Vertrauen aufbauen, Orientierung geben und qualifizierte Anfragen erzeugen.</h2>

                <p>Viele Unternehmen haben eine Website.<br>Aber nur wenige haben eine digitale Infrastruktur, die ihrem Geschäft wirklich gerecht wird.</p>
                <p>Das ist ein entscheidender Unterschied.</p>
                <p>Denn eine Website ist längst nicht mehr nur ein Ort, an dem Informationen stehen. Sie ist oft der erste echte Berührungspunkt zwischen Unternehmen und Entscheidungsträger. Noch bevor ein Gespräch stattfindet, noch bevor ein Angebot angefragt wird, noch bevor jemand Kontakt aufnimmt, entsteht bereits ein Eindruck — und mit ihm eine Entscheidung.</p>
                <p>Wirkt dieses Unternehmen klar?<br>Versteht es, was es tut?<br>Ist hier Substanz oder nur Oberfläche?<br>Kann man diesem Auftritt vertrauen?</p>
                <p>Genau an diesem Punkt zeigt sich, was eine Website heute sein muss: nicht bloß präsent, sondern tragfähig. Nicht bloß schön, sondern wirksam. Nicht bloß online, sondern strategisch relevant.</p>
                <p>Ich entwickle Websites deshalb nicht als digitale Hülle, sondern als System.</p>
                <p>Ein System, das Positionierung schärft.<br>Ein System, das Vertrauen nicht behauptet, sondern aufbaut.<br>Ein System, das Orientierung schafft, Reibung reduziert und aus Aufmerksamkeit echte Bewegung macht.</p>

                <h2>Was eine Website heute wirklich leisten muss</h2>
                <p>Eine gute Website soll nicht einfach nur etwas zeigen.<br>Sie soll etwas klären.</p>
                <p>Sie soll nicht überfordern, sondern führen.<br>Sie soll nicht beeindrucken wollen, sondern verständlich machen, warum ein Unternehmen relevant ist.</p>
                <p>Viele Websites scheitern nicht daran, dass sie völlig schlecht sind. Sie scheitern daran, dass sie zu wenig leisten. Sie sehen ordentlich aus, sagen aber nicht präzise genug, worum es eigentlich geht. Sie erzeugen Präsenz, aber keine Richtung. Sie liefern Informationen, aber keine Klarheit. Sie bringen Besucher auf eine Seite, aber führen sie nicht zu einer Entscheidung.</p>
                <p>Dann bleibt die Website das, was viele Seiten heute noch sind: eine digitale Visitenkarte mit größerer Fläche.</p>
                <p>Ich halte das für verschenktes Potenzial.</p>
                <p>Denn im Jahr 2026 reicht es nicht mehr, sichtbar zu sein. Sichtbarkeit ohne Klarheit erzeugt nur Streuverlust. Design ohne Struktur erzeugt nur Oberfläche. Traffic ohne Vertrauen erzeugt keine Nachfrage, sondern Abbruch.</p>
                <p>Eine Website muss heute mehr können.</p>
                <p>Sie muss in kurzer Zeit verständlich machen, was ein Unternehmen tut.<br>Sie muss Komplexität ordnen, statt sie bloß abzubilden.<br>Sie muss Vertrauen aufbauen, bevor überhaupt jemand spricht.<br>Und sie muss die richtigen Menschen so führen, dass aus Interesse eine qualifizierte Anfrage werden kann.</p>

                <h2>Warum ich in Systemen denke</h2>
                <p>Digitale Probleme entstehen selten an nur einer Stelle.</p>
                <p>Oft ist nicht der Text allein das Problem. Nicht das Design. Nicht die Technik. Nicht das SEO. Nicht die Conversion. Das eigentliche Problem liegt häufig darin, dass alles nur halb zusammenarbeitet.</p>
                <p>Die Botschaft ist nicht scharf genug.<br>Die Seitenstruktur trägt nicht.<br>Das Angebot ist nicht klar genug gerahmt.<br>Vertrauen wird dem Zufall überlassen.<br>Messbarkeit fehlt oder wird falsch verstanden.<br>Und am Ende wundert man sich, warum trotz Aufwand zu wenig passiert.</p>
                <p>Genau deshalb arbeite ich nicht in isolierten Einzelmaßnahmen.<br>Ich denke in Zusammenhängen.</p>
                <p>Eine Website ist für mich kein Sammelort aus Seiten, Modulen und Tools. Sie ist ein Gefüge. Wenn ein Teil unklar ist, schwächt das oft das Ganze. Wenn die Positionierung unscharf ist, werden Texte beliebig. Wenn die Struktur nicht trägt, verlieren Inhalte ihre Kraft. Wenn die Nutzerführung schwach ist, hilft auch Reichweite nicht viel. Wenn Daten nicht sauber erhoben werden, beruhen Entscheidungen am Ende auf Vermutungen.</p>
                <p>Deshalb beginne ich nicht mit Aktionismus.<br>Ich beginne mit Logik.</p>
                <p>Was ist das Ziel der Seite?<br>Welche Rolle hat jede Unterseite?<br>Wo entsteht Vertrauen?<br>Wo entsteht Reibung?<br>Was muss ein Besucher verstehen, fühlen und tun?</p>
                <p>Erst wenn diese Fragen sauber beantwortet sind, kann eine Website anfangen, geschäftlich wirklich zu arbeiten.</p>

                <h2>Wie ich arbeite</h2>
                <p>Ich glaube an Klarheit vor Komplexität.</p>
                <p>Nicht jedes Unternehmen braucht mehr Tools, mehr Seiten, mehr Features oder mehr Content. Sehr oft braucht es zuerst etwas anderes: eine sauber gedachte Grundlage.</p>
                <p>Das Fundament muss stimmen.<br>Die Struktur muss tragen.<br>Die Kommunikation muss präzise sein.<br>Die Nutzerführung muss bewusst gebaut sein.<br>Und die Website muss messbar machen, was funktioniert und was nicht.</p>
                <p>Ich entwickle deshalb WordPress-basierte Systeme, die nicht bloß veröffentlicht werden, sondern langfristig funktionieren sollen. Systeme, die nicht auf kurzfristige Effekte angewiesen sind, sondern mit jeder Verbesserung an Stabilität gewinnen.</p>
                <p>Mich interessiert nicht die Website als dekoratives Objekt.<br>Mich interessiert ihre Leistung.</p>
                <p>Kann sie ein Angebot klar rahmen?<br>Kann sie Vertrauen beschleunigen?<br>Kann sie Menschen sinnvoll zum nächsten Schritt führen?<br>Kann sie geschäftliche Entscheidungen besser machen, weil sie saubere Signale liefert?</p>
                <p>Wenn die Antwort darauf nein ist, dann fehlt nicht nur Feinschliff. Dann fehlt Struktur.</p>

                <h2>Was meinen Ansatz prägt</h2>
                <p>Ich betrachte Websites weder rein technisch noch rein gestalterisch.</p>
                <p>Für mich liegt die eigentliche Qualität dort, wo Strategie, Sprache, Struktur, Technik und Wirkung zusammenkommen. Der Nutzer erlebt keine getrennten Disziplinen. Er erlebt einen Gesamteindruck. Er merkt innerhalb weniger Sekunden, ob etwas klar ist oder diffus, ob etwas Substanz hat oder bloß professionell aussieht.</p>
                <p>Darum verbinde ich, was oft künstlich getrennt wird.</p>
                <p>Ich denke Website, Inhalt, SEO, Nutzerführung, Vertrauen und Messbarkeit nicht als einzelne Gewerke, sondern als Teile eines Systems, das einem Unternehmen dienen muss. Nicht abstrakt, sondern konkret: in Form von besserer Orientierung, stärkerer Glaubwürdigkeit und qualifizierteren Anfragen.</p>
                <p>Ein Punkt ist mir dabei besonders wichtig: Eigenständigkeit.</p>
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
