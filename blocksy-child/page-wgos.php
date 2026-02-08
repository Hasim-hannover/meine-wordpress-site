<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System – Vollständige Landingpage
 */

// --- SEO Meta + Fonts (vor get_header, damit wp_head die Hooks hat) ---
add_filter('pre_get_document_title', function () {
    return 'WordPress Growth OS (WGOS) · Owned Leads System · Hasim Üner';
});

add_action('wp_head', function () {
    echo '<meta name="description" content="Das WGOS verwandelt Ihre WordPress-Website in ein Owned-Leads-System: Performance, Privacy-first Tracking, SEO, CRO &amp; Automation. Assets statt Kampagnen.">';
}, 1);

get_header();
?>

<div class="wgos-wrapper">

<!-- ========================================
     SMART NAV (links, vertikal, wie Homepage)
     ======================================== -->
<nav class="wgos-smart-nav" id="wgos-nav">
    <ul>
        <li><a href="#prinzip"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">Prinzip</span></a></li>
        <li><a href="#module"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">Module</span></a></li>
        <li><a href="#credits"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">Credits</span></a></li>
        <li><a href="#pakete"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">Pakete</span></a></li>
        <li><a href="#garantie"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">Garantie</span></a></li>
        <li><a href="#faq"><span class="wgos-nav-dot"></span><span class="wgos-nav-text">FAQ</span></a></li>
    </ul>
</nav>

<!-- ========================================
     SECTION 1: HERO
     ======================================== -->
<section class="wgos-hero">
    <div class="wgos-container wgos-hero__inner">
        <span class="wgos-kicker">Das System</span>

        <h1 class="wgos-hero__title">WordPress Growth Operating System (WGOS): Assets bauen statt Kampagnen verbrennen.</h1>

        <p class="wgos-hero__subtitle">Ihr B2B-Wachstum hängt nicht vom Werbebudget ab&nbsp;— sondern von der Qualität Ihrer digitalen Infrastruktur. Das WGOS investiert monatlich in Assets, die bleiben: Geschwindigkeit, saubere Daten, Rankings, Content und Lead-Qualität. Ads sind optional&nbsp;— als Verstärker, wenn das Fundament steht.</p>

        <div class="wgos-hero__actions">
            <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Ownership-Check starten (0&nbsp;€)</a>
            <a href="/case-studies/" class="wgos-link--arrow">Case Studies ansehen →</a>
        </div>

        <!-- Trust Stack -->
        <div class="wgos-trust-stack">
            <div class="wgos-trust-item">
                <span class="wgos-trust-value nx-counter" data-value="98">0</span>
                <span class="wgos-trust-label">Mobile Performance</span>
            </div>
            <div class="wgos-trust-item">
                <span class="wgos-trust-value" data-value="-83" data-suffix="%">-83%</span>
                <span class="wgos-trust-label">CPL (Kosten/Lead)</span>
            </div>
            <div class="wgos-trust-item">
                <span class="wgos-trust-value">&lt;&nbsp;0.8s</span>
                <span class="wgos-trust-label">Load Time (LCP)</span>
            </div>
            <div class="wgos-trust-item">
                <span class="wgos-trust-value" data-value="100" data-suffix="%">0</span>
                <span class="wgos-trust-label">Data Ownership</span>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 2: PRINZIP
     ======================================== -->
<section id="prinzip" class="wgos-section wgos-section--gray nx-reveal">
    <div class="wgos-container">
        <h2 class="wgos-h2">Assets statt Kampagnen&nbsp;— Das Prinzip</h2>

        <div class="wgos-prose">
            <p>Die meisten Unternehmen mieten Sichtbarkeit. Jeden Monat: Ads-Budget rein, Leads raus. Budget stoppen&nbsp;— Leads stoppen. Das ist kein System, das ist Abhängigkeit.</p>
            <p>Das WGOS dreht die Logik um: Statt Kampagnen zu verbrennen, investieren wir monatlich in digitale Assets, die Ihnen gehören und über Zeit wertvoller werden:</p>
        </div>

        <ul class="wgos-checklist">
            <li><strong>Seiten, die ranken</strong> (und morgen noch da sind)</li>
            <li><strong>Geschwindigkeit, die konvertiert</strong> (nicht nur gut aussieht)</li>
            <li><strong>Daten, die Ihnen gehören</strong> (statt Plattformen)</li>
            <li><strong>Content, der Vertrauen aufbaut</strong> (statt Tracking-Misstrauen)</li>
            <li><strong>Prozesse, die skalieren</strong> (ohne linearen Aufwandszuwachs)</li>
        </ul>

        <p class="wgos-bold-statement">Ads sind nicht verboten&nbsp;— aber sie werden zum optionalen Turbo, wenn das Fundament steht. Nicht zum Dauertropf.</p>

        <p class="wgos-inline-cta">
            <a href="/wordpress-tech-audit/" data-track="cta_click_audit">→ Wie stark ist Ihr Fundament? Kostenloser Ownership-Check</a>
        </p>
    </div>
</section>

<!-- ========================================
     SECTION 3: DIE 7 MODULE
     ======================================== -->
<section id="module" class="wgos-section">
    <div class="wgos-container">
        <h2 class="wgos-h2">Die 7 Module des WGOS</h2>
        <p class="wgos-section-intro">Jedes Modul ist ein Baustein Ihres Owned-Leads-Systems. Die Reihenfolge ist kein Zufall: Wir starten mit dem technischen Fundament und arbeiten uns zur Sichtbarkeit und Skalierung vor.</p>
    </div>

    <!-- Modul 01 -->
    <div class="wgos-module wgos-module--white nx-reveal" id="modul-01">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">01</div>
                <div class="wgos-module__content">
                    <h3>Performance Core</h3>
                    <p class="wgos-module__subline"><em>Schnelle Websites konvertieren besser. Punkt.</em></p>
                    <p>Core Web Vitals (LCP&nbsp;&lt;&nbsp;2.5s, CLS&nbsp;&lt;&nbsp;0.1), Server-Tuning, Asset-Optimierung, Critical CSS, Lazy Loading, CDN-Setup. Ergebnis: weniger Absprünge, bessere Rankings, höhere Conversion.</p>
                    <div class="wgos-module__proof">Core Web Vitals von 45 → 98 (Mobile) in 14 Tagen</div>
                    <a href="/core-web-vitals-optimierung/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 02 -->
    <div class="wgos-module wgos-module--gray nx-reveal" id="modul-02">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">02</div>
                <div class="wgos-module__content">
                    <h3>Security &amp; Reliability</h3>
                    <p class="wgos-module__subline"><em>Vertrauen beginnt beim Schutz Ihrer Daten und Systeme.</em></p>
                    <p>WordPress-Härtung, automatisierte Backups, Uptime-Monitoring, Update-Management, Malware-Scan, Disaster Recovery. Kein Sicherheitsrisiko, das Kunden abschreckt oder Google abstraft.</p>
                    <div class="wgos-module__proof">0 Ausfallstunden in 12 Monaten bei betreuten Projekten</div>
                    <a href="/wordpress-wartung-hannover/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 03 -->
    <div class="wgos-module wgos-module--white nx-reveal" id="modul-03">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">03</div>
                <div class="wgos-module__content">
                    <h3>Privacy-first Measurement Layer</h3>
                    <p class="wgos-module__subline"><em>Messen, was nötig ist&nbsp;— nicht mehr.</em></p>
                    <p>Server-Side Tracking (sGTM), Consent Mode v2, Event-Blueprint, GA4-Setup ohne Cookie-Banner-Chaos. Saubere Datenintegrität + DSGVO-Konformität. Keine Sammelwut, sondern belastbare KPIs.</p>
                    <div class="wgos-module__proof">Tracking-Genauigkeit von ~55% auf &gt;92% (nach sGTM-Rollout)</div>
                    <a href="/ga4-tracking-setup/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 04 -->
    <div class="wgos-module wgos-module--gray nx-reveal" id="modul-04">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">04</div>
                <div class="wgos-module__content">
                    <h3>Technical SEO &amp; Informationsarchitektur</h3>
                    <p class="wgos-module__subline"><em>Die Struktur bestimmt, ob Google Sie versteht&nbsp;— und Besucher finden, was sie suchen.</em></p>
                    <p>Crawl-Optimierung, Sitemap-Strategie, Schema Markup (JSON-LD), interne Verlinkung, URL-Architektur, Pillar/Cluster-Planung. Das Fundament, auf dem Content-Sichtbarkeit steht.</p>
                    <div class="wgos-module__proof">Indexierte Seiten +340% nach IA-Restrukturierung</div>
                    <a href="/wordpress-seo-hannover/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 05 -->
    <div class="wgos-module wgos-module--white nx-reveal" id="modul-05">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">05</div>
                <div class="wgos-module__content">
                    <h3>Owned Content Engine</h3>
                    <p class="wgos-module__subline"><em>Content, der rankt, nurturt und konvertiert&nbsp;— ohne Ablaufdatum.</em></p>
                    <p>Pillar Pages, Content-Cluster, Proof-Assets (Case Studies), Lead-Magneten, Nurture-Sequenzen. Jedes Stück Content ist ein Asset mit klarem Zweck: Sichtbarkeit, Vertrauen oder Conversion.</p>
                    <div class="wgos-module__proof">Organischer Traffic +180% in 6 Monaten (B2B SaaS Kunde)</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 06 -->
    <div class="wgos-module wgos-module--gray nx-reveal" id="modul-06">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">06</div>
                <div class="wgos-module__content">
                    <h3>Conversion &amp; Offer Engineering</h3>
                    <p class="wgos-module__subline"><em>Traffic ohne Conversion ist Vanity. Wir optimieren den Moment der Entscheidung.</em></p>
                    <p>Landing Page Architektur, CTA-Hierarchie, Above-the-Fold-Optimierung, A/B-Testing, Lead-Formulare, Offer-Framing, Friction-Analyse. Ziel: aus Besuchern qualifizierte Anfragen machen.</p>
                    <div class="wgos-module__proof">Conversion Rate von 1.2% → 4.7% (B2B Dienstleister)</div>
                    <a href="/conversion-rate-optimization/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modul 07 -->
    <div class="wgos-module wgos-module--white nx-reveal" id="modul-07">
        <div class="wgos-container">
            <div class="wgos-module__grid">
                <div class="wgos-module__num">07</div>
                <div class="wgos-module__content">
                    <h3>Paid Booster &amp; Automation <span class="wgos-tag--optional">Optional</span></h3>
                    <p class="wgos-module__subline"><em>Ads als Verstärker, nicht als Betriebssystem. Automation für Skalierung ohne Mehraufwand.</em></p>
                    <p>Google Ads, Meta Ads&nbsp;— aber nur auf Basis sauberer Daten und konvertierender Pages. Plus: n8n-Automation für Lead-Routing, Reporting, Nurture-Flows. Dieser Block ist optional und wird erst aktiviert, wenn Modul 1–6 stehen.</p>
                    <div class="wgos-module__proof">ROAS 6.2x bei 40% weniger Ad-Spend (nach Fundament-Optimierung)</div>
                    <a href="/performance-marketing/" class="wgos-link--arrow">Mehr erfahren →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline CTA nach Modul 7 -->
    <div class="wgos-module wgos-module--cta">
        <div class="wgos-container" style="text-align:center;">
            <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Erst Diagnose, dann System. Ownership-Check starten (0&nbsp;€)</a>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 4: CREDITS-SYSTEM
     ======================================== -->
<section id="credits" class="wgos-section wgos-section--white">
    <div class="wgos-container">
        <h2 class="wgos-h2">So funktioniert das Credits-System</h2>

        <div class="wgos-prose" style="max-width:760px;">
            <p>Keine Stundensätze. Keine Nachverhandlungen. Jedes Asset hat einen festen Punktwert&nbsp;— Sie wissen vorher, was es kostet. Das Risiko für Mehraufwand liegt bei mir.</p>
            <p>Ihr monatliches Paket enthält ein festes Credit-Budget. Sie entscheiden zusammen mit mir, in welche Assets investiert wird. Keine versteckten Kosten, volle Transparenz.</p>
        </div>

        <!-- Credits Tabelle -->
        <div class="wgos-table-wrap">
            <table class="wgos-credits-table">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Was Sie bekommen</th>
                        <th>Credits</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Kategorie: Performance & Infrastruktur -->
                    <tr class="wgos-table-category">
                        <td colspan="3">Performance &amp; Infrastruktur</td>
                    </tr>
                    <tr>
                        <td>CWV Speed Audit</td>
                        <td>Analyse + Maßnahmenplan Core Web Vitals</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>CWV Optimierung</td>
                        <td>Umsetzung: LCP, CLS, INP, Asset-Pipeline</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Server-Tuning</td>
                        <td>Caching, CDN, PHP-Tuning, DB-Optimierung</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Security Hardening</td>
                        <td>WordPress-Härtung, Headers, Backup-Setup</td>
                        <td>10</td>
                    </tr>

                    <!-- Kategorie: Measurement & Tracking -->
                    <tr class="wgos-table-category">
                        <td colspan="3">Measurement &amp; Tracking</td>
                    </tr>
                    <tr>
                        <td>sGTM Setup</td>
                        <td>Server-Side GTM Container + Event-Routing</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Consent Mode v2</td>
                        <td>CMP Integration + Consent Signals an Google</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>GA4 Event Blueprint</td>
                        <td>Custom Events, Conversions, Dashboards</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Tracking Audit</td>
                        <td>Ist-Analyse Datenqualität + Gap-Report</td>
                        <td>8</td>
                    </tr>

                    <!-- Kategorie: SEO & Owned Content -->
                    <tr class="wgos-table-category">
                        <td colspan="3">SEO &amp; Owned Content</td>
                    </tr>
                    <tr>
                        <td>Technical SEO Audit</td>
                        <td>Crawl, Indexierung, Schema, Site-Architektur</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Pillar Page</td>
                        <td>Langform-Seite (2.000+ Wörter, SEO-optimiert)</td>
                        <td>25</td>
                    </tr>
                    <tr>
                        <td>Cluster-Artikel</td>
                        <td>Blog/Supportcontent (800–1.200 Wörter)</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Case Study / Proof</td>
                        <td>Kunden-Ergebnis mit KPIs, Vorher/Nachher</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Interne Link-Architektur</td>
                        <td>Mapping + Umsetzung interner Verlinkung</td>
                        <td>8</td>
                    </tr>

                    <!-- Kategorie: Conversion & Offer Engineering -->
                    <tr class="wgos-table-category">
                        <td colspan="3">Conversion &amp; Offer Engineering</td>
                    </tr>
                    <tr>
                        <td>Landing Page (Neu)</td>
                        <td>High-Conversion LP: Copy, Design, Build</td>
                        <td>20</td>
                    </tr>
                    <tr>
                        <td>CRO Audit + Fixes</td>
                        <td>Friction-Analyse, CTA-Optimierung, A/B</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Lead-Formular Engineering</td>
                        <td>Multi-Step, Validation, Lead-Routing</td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Offer/Pricing Page</td>
                        <td>Angebotsstruktur, Pakete, Social Proof</td>
                        <td>15</td>
                    </tr>

                    <!-- Kategorie: Paid Booster & Automation -->
                    <tr class="wgos-table-category">
                        <td colspan="3">Paid Booster &amp; Automation <span class="wgos-tag--optional">Optional</span></td>
                    </tr>
                    <tr>
                        <td>Google Ads Setup</td>
                        <td>Kampagnenstruktur, Keywords, Anzeigen</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Meta Ads Setup</td>
                        <td>Kampagnenarchitektur, Creatives, Audiences</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>Ads Management (mtl.)</td>
                        <td>Optimierung, Reporting, Budget-Steuerung</td>
                        <td>10/Mo</td>
                    </tr>
                    <tr>
                        <td>n8n Automation Flow</td>
                        <td>Lead-Routing, Notifications, CRM-Sync</td>
                        <td>12</td>
                    </tr>
                    <tr>
                        <td>Reporting Dashboard</td>
                        <td>Automated KPI-Dashboard (Looker/Sheets)</td>
                        <td>10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: PAKETE & INVESTITION
     ======================================== -->
<section id="pakete" class="wgos-section wgos-section--gray">
    <div class="wgos-container">
        <h2 class="wgos-h2">Pakete &amp; Investition</h2>
        <p class="wgos-section-intro">Drei Stufen&nbsp;— je nach Wachstumsziel und Umsetzungstempo. Jedes Paket ist ein Retainer mit festem Credit-Budget pro Monat.</p>

        <div class="wgos-pricing-grid">
            <!-- Paket 1: Maintenance -->
            <div class="wgos-pricing-card nx-reveal">
                <div class="wgos-pricing-card__head">
                    <h3>Maintenance</h3>
                    <p class="wgos-pricing-card__tagline">Fundament sichern</p>
                </div>
                <div class="wgos-pricing-card__price">ab 1.500&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">30 Credits / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 3 Monate</li>
                    <li>1× Strategiecall / Monat</li>
                    <li>Module 1–3 (Performance, Security, Tracking)</li>
                    <li>Reporting: Monatlich</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Ideal für bestehende Sites, die technisch sauber laufen müssen. Wartung + punktuelle Optimierung.</p>
                <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit">Ownership-Check starten</a>
            </div>

            <!-- Paket 2: Growth Partner (FEATURED) -->
            <div class="wgos-pricing-card wgos-pricing-card--featured nx-reveal">
                <span class="wgos-pricing-badge">Empfohlen</span>
                <div class="wgos-pricing-card__head">
                    <h3>Growth Partner</h3>
                    <p class="wgos-pricing-card__tagline">Assets aufbauen</p>
                </div>
                <div class="wgos-pricing-card__price">ab 2.800&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">60 Credits / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 6 Monate</li>
                    <li>2× Strategiecalls / Monat</li>
                    <li>Module 1–6 (Owned Full Stack)</li>
                    <li>Reporting: Bi-Weekly</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Ideal für B2B-Unternehmen, die ein Owned-Leads-System aufbauen wollen. SEO + CRO + Content.</p>
                <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Ownership-Check starten</a>
            </div>

            <!-- Paket 3: Dominance -->
            <div class="wgos-pricing-card nx-reveal">
                <div class="wgos-pricing-card__head">
                    <h3>Dominance</h3>
                    <p class="wgos-pricing-card__tagline">Markt dominieren</p>
                </div>
                <div class="wgos-pricing-card__price">ab 4.500&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">100+ Credits / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 12 Monate</li>
                    <li>Wöchentliche Strategiecalls</li>
                    <li>Module 1–7 (inkl. Paid Booster)</li>
                    <li>Reporting: Weekly + Dashboard</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Ideal für Marktführer-Anspruch. Full Stack + Paid Booster + Automation. Maximaler Output.</p>
                <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit">Ownership-Check starten</a>
            </div>
        </div>

        <!-- Beispiel-Monat -->
        <div class="wgos-example-month nx-reveal">
            <h3>Beispiel-Monat: Growth Partner (60 Credits)</h3>
            <div class="wgos-table-wrap">
                <table class="wgos-credits-table wgos-credits-table--compact">
                    <thead>
                        <tr><th>Asset</th><th>Credits</th><th>Modul</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1× Pillar Page (SEO-optimiert, 2.500 Wörter)</td><td>25</td><td>05</td></tr>
                        <tr><td>1× Landing Page Redesign (CRO)</td><td>20</td><td>06</td></tr>
                        <tr><td>Internal Link Architecture Update</td><td>8</td><td>04</td></tr>
                        <tr><td>GA4 Custom Event Setup (2 neue Conversions)</td><td>7</td><td>03</td></tr>
                        <tr class="wgos-table-total"><td><strong>Gesamt</strong></td><td><strong>60</strong></td><td>—</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="wgos-example-month__result">Ergebnis dieses Monats: 1 neues Ranking-Asset, 1 konvertierende Seite, bessere Datenbasis, stärkere Linkarchitektur. Alles bleibt. Alles arbeitet weiter.</p>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 6: GARANTIE & ERWARTUNGSMANAGEMENT
     ======================================== -->
<section id="garantie" class="wgos-section wgos-section--white nx-reveal">
    <div class="wgos-container">
        <h2 class="wgos-h2">Garantie &amp; Erwartungsmanagement</h2>

        <div class="wgos-prose" style="max-width:760px;">
            <p>Keine unrealistischen Umsatzversprechen. Keine „Wir garantieren Seite 1"-Sprüche. Was ich garantiere, sind Dinge, die ich kontrollieren kann:</p>
        </div>

        <ul class="wgos-checklist wgos-checklist--guarantee">
            <li><strong>Speed-Garantie:</strong> Core Web Vitals im grünen Bereich innerhalb von 30 Tagen&nbsp;— oder Credits zurück.</li>
            <li><strong>Datenqualitäts-Garantie:</strong> Tracking-Genauigkeit &gt;90% nach sGTM-Setup&nbsp;— dokumentiert und überprüfbar.</li>
            <li><strong>Conversion-Reibung:</strong> Mindestens 3 dokumentierte Conversion-Hebel pro CRO-Audit&nbsp;— mit Umsetzungsplan.</li>
            <li><strong>Transparenz:</strong> Monatlicher Report mit Credit-Verbrauch, Output-Übersicht und KPI-Entwicklung.</li>
            <li><strong>Kein Lock-in:</strong> Alle Assets (Code, Content, Tracking, Accounts) gehören Ihnen. Immer.</li>
        </ul>

        <p class="wgos-expectation"><em>Erwartung: SEO-Ergebnisse brauchen 3–6 Monate. Performance und Tracking wirken sofort. CRO zeigt erste Hebel nach dem ersten Audit. Wir arbeiten mit einer 90-Tage-Roadmap und messen monatlich.</em></p>
    </div>
</section>

<!-- ========================================
     SECTION 7: FAQ
     ======================================== -->
<section id="faq" class="wgos-section wgos-section--gray">
    <div class="wgos-container">
        <h2 class="wgos-h2">FAQ&nbsp;— Häufige Fragen zum WGOS</h2>

        <div class="wgos-faq">
            <details class="nx-faq__item">
                <summary>Was genau ist das WGOS?</summary>
                <div class="nx-faq__content">Ein monatlicher Retainer, bei dem wir Ihr WordPress in ein Owned-Leads-System verwandeln. Statt einzelner Projekte investieren wir kontinuierlich in digitale Assets: Performance, Messbarkeit, SEO-Content und Conversion-Optimierung. Sie zahlen nicht für Stunden, sondern für Output.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Wie unterscheidet sich das von einer klassischen Agentur?</summary>
                <div class="nx-faq__content">Klassische Agenturen verkaufen Kampagnen oder Stunden. Das WGOS baut Assets, die Ihnen gehören und über Zeit wertvoller werden. Ihre Investition akkumuliert sich&nbsp;— statt jeden Monat bei Null zu starten.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Warum Credits statt Stunden?</summary>
                <div class="nx-faq__content">Stunden schaffen Fehlanreize: Je länger etwas dauert, desto teurer wird es für Sie. Credits sind fixe Werte pro Asset. Eine Landing Page kostet 20 Credits&nbsp;— egal ob ich 8 oder 12 Stunden brauche. Das Risiko für Mehraufwand liegt bei mir.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Brauche ich Ads, um Ergebnisse zu sehen?</summary>
                <div class="nx-faq__content">Nein. Modul 1–6 funktionieren vollständig ohne Werbebudget. Ads (Modul 7) sind ein optionaler Booster&nbsp;— sinnvoll, wenn das Fundament steht und Sie schneller skalieren wollen. Aber kein Muss.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Was bedeutet Privacy-first konkret?</summary>
                <div class="nx-faq__content">Minimal notwendige Events statt Daten-Sammelwut. Server-Side Tracking für bessere Datenqualität. Consent Mode v2 für saubere Signals. Dokumentierte DSGVO-Konformität. Ergebnis: belastbare KPIs ohne das Vertrauen Ihrer Besucher zu zerstören.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Wie schnell sehe ich Ergebnisse?</summary>
                <div class="nx-faq__content">Performance und Tracking wirken sofort (Tage bis wenige Wochen). SEO-Rankings brauchen typischerweise 3–6 Monate. CRO zeigt erste Hebel nach dem ersten Audit. Wir arbeiten mit einer 90-Tage-Roadmap und messen monatlich.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Kann ich Module einzeln buchen?</summary>
                <div class="nx-faq__content">Einzelne Module sind als Projekt möglich (z.B. nur CWV-Optimierung oder nur sGTM-Setup). Für das volle Flywheel-Potenzial empfehle ich den Retainer&nbsp;— weil die Module sich gegenseitig verstärken.</div>
            </details>

            <details class="nx-faq__item">
                <summary>Was passiert, wenn ich kündige?</summary>
                <div class="nx-faq__content">Alles bleibt bei Ihnen: Code, Content, Tracking-Setup, Accounts, Zugänge. Kein Lock-in, keine Exit-Gebühren. Die Assets, die wir gebaut haben, arbeiten weiter&nbsp;— das ist der Punkt von Owned.</div>
            </details>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 8: ABSCHLUSS-CTA
     ======================================== -->
<section class="wgos-section wgos-section--white wgos-final-cta nx-reveal">
    <div class="wgos-container" style="text-align:center;">
        <h2 class="wgos-h2">Bereit für ein System, das über Zeit günstiger wird?</h2>
        <p class="wgos-prose" style="max-width:680px;margin:0 auto 2rem;">Der erste Schritt ist ein kostenloser Ownership-Check: Wir analysieren Ihre Website auf Performance, Datenintegrität und Conversion-Potenzial&nbsp;— und zeigen Ihnen, wo die größten Hebel liegen.</p>

        <div class="wgos-hero__actions">
            <a href="/wordpress-tech-audit/" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Kostenlosen Ownership-Check starten →</a>
            <a href="https://cal.com/hasim/30min" class="wgos-link--arrow" target="_blank" rel="noopener" data-track="cta_click_calendar">Direkt Termin buchen →</a>
        </div>
    </div>
</section>

</div><!-- /.wgos-wrapper -->

<!-- ========================================
     FAQPage Schema JSON-LD
     ======================================== -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Was genau ist das WGOS?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ein monatlicher Retainer, bei dem wir Ihr WordPress in ein Owned-Leads-System verwandeln. Statt einzelner Projekte investieren wir kontinuierlich in digitale Assets: Performance, Messbarkeit, SEO-Content und Conversion-Optimierung. Sie zahlen nicht für Stunden, sondern für Output."
      }
    },
    {
      "@type": "Question",
      "name": "Wie unterscheidet sich das von einer klassischen Agentur?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Klassische Agenturen verkaufen Kampagnen oder Stunden. Das WGOS baut Assets, die Ihnen gehören und über Zeit wertvoller werden. Ihre Investition akkumuliert sich — statt jeden Monat bei Null zu starten."
      }
    },
    {
      "@type": "Question",
      "name": "Warum Credits statt Stunden?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Stunden schaffen Fehlanreize: Je länger etwas dauert, desto teurer wird es für Sie. Credits sind fixe Werte pro Asset. Eine Landing Page kostet 20 Credits — egal ob ich 8 oder 12 Stunden brauche. Das Risiko für Mehraufwand liegt bei mir."
      }
    },
    {
      "@type": "Question",
      "name": "Brauche ich Ads, um Ergebnisse zu sehen?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Nein. Modul 1–6 funktionieren vollständig ohne Werbebudget. Ads (Modul 7) sind ein optionaler Booster — sinnvoll, wenn das Fundament steht und Sie schneller skalieren wollen. Aber kein Muss."
      }
    },
    {
      "@type": "Question",
      "name": "Was bedeutet Privacy-first konkret?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Minimal notwendige Events statt Daten-Sammelwut. Server-Side Tracking für bessere Datenqualität. Consent Mode v2 für saubere Signals. Dokumentierte DSGVO-Konformität. Ergebnis: belastbare KPIs ohne das Vertrauen Ihrer Besucher zu zerstören."
      }
    },
    {
      "@type": "Question",
      "name": "Wie schnell sehe ich Ergebnisse?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Performance und Tracking wirken sofort (Tage bis wenige Wochen). SEO-Rankings brauchen typischerweise 3–6 Monate. CRO zeigt erste Hebel nach dem ersten Audit. Wir arbeiten mit einer 90-Tage-Roadmap und messen monatlich."
      }
    },
    {
      "@type": "Question",
      "name": "Kann ich Module einzeln buchen?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Einzelne Module sind als Projekt möglich (z.B. nur CWV-Optimierung oder nur sGTM-Setup). Für das volle Flywheel-Potenzial empfehle ich den Retainer — weil die Module sich gegenseitig verstärken."
      }
    },
    {
      "@type": "Question",
      "name": "Was passiert, wenn ich kündige?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Alles bleibt bei Ihnen: Code, Content, Tracking-Setup, Accounts, Zugänge. Kein Lock-in, keine Exit-Gebühren. Die Assets, die wir gebaut haben, arbeiten weiter — das ist der Punkt von Owned."
      }
    }
  ]
}
</script>

<?php get_footer(); ?>
