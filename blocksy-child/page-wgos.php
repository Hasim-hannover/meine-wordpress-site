<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System – Vollständige Landingpage
 *
 * ⚠️ LAYER VIOLATION NOTICE: Diese Seite enthält hardcoded Content (647 Zeilen).
 * Langfristiges Ziel: Content in den Editor migrieren, nur Struktur im Template.
 * SEO-Meta: zentral in inc/seo-meta.php (ACF-Felder: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();

$audit_url = nexus_get_audit_url();
$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
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
        <div class="wgos-hero-featured-image" style="margin-bottom:2rem;">
            <img src="https://hasimuener.de/wp-content/uploads/2026/03/wgos-featured.png" alt="WGOS Beitragsbild" style="max-width:420px; width:100%; border-radius:1.2rem; box-shadow:0 4px 24px rgba(0,0,0,0.08);">
        </div>
        <span class="wgos-kicker">Das System</span>

        <h1 class="wgos-hero__title">WGOS: WordPress als planbares Anfragesystem für B2B</h1>

        <p class="wgos-hero__subtitle">WGOS ist die laufende Zusammenarbeit für Unternehmen, die aus ihrer WordPress-Website mehr qualifizierte Anfragen machen wollen – mit sauberer Technik, klarer Messbarkeit, besseren Seiten und einer sinnvollen Reihenfolge statt Aktionismus.</p>
        <ul class="wgos-hero__bullets">
            <li>Erst Fundament, dann Sichtbarkeit</li>
            <li>Klare Prioritäten statt Stundenchaos</li>
            <li>Alles bleibt in Ihrem Besitz</li>
        </ul>

        <div class="wgos-hero__actions">
            <a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Audit starten</a>
            <a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Case Studies ansehen</a>
        </div>

        <!-- Trust Stack -->
        <div class="wgos-trust-stack">
            <div class="wgos-trust-item">
                <!-- WGOS FIX 3: Serverseitiger Fallback-Wert gegen sichtbare "0" vor JS-Hydration -->
                <span class="wgos-trust-value nx-counter" data-value="98" data-fallback="98">98</span>
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
                <!-- WGOS FIX 3: Serverseitiger Fallback-Wert gegen sichtbare "0" vor JS-Hydration -->
                <span class="wgos-trust-value nx-counter" data-value="100" data-suffix="%" data-fallback="100%">100%</span>
                <span class="wgos-trust-label">Data Ownership</span>
            </div>
        </div>

        <p class="wgos-hero__risk-note">Ergebnisse hängen von der Ausgangslage ab&nbsp;— im Audit sehen Sie die größten Hebel.</p>

    </div>
</section>

<!-- ========================================
     SECTION 2: PRINZIP
     ======================================== -->
<section id="prinzip" class="wgos-section wgos-section--gray nx-reveal">
    <div class="wgos-container">
        <div class="wgos-principle-shell">
            <span class="wgos-principle-kicker">System statt Stundenmodell</span>
            <h2 class="wgos-h2">Kein Stundenmodell. Kein Maßnahmen-Chaos. Sondern ein System.</h2>

            <p>WGOS bündelt die Bausteine, die für nachhaltige Nachfrage wirklich zusammenarbeiten müssen: Technik, Messbarkeit, Sichtbarkeit, Conversion und saubere Weiterentwicklung. Statt lose Einzelmaßnahmen umzusetzen, arbeiten wir entlang klarer Prioritäten – damit Ihre Website Schritt für Schritt zu einem verlässlichen Anfragesystem wird.</p>

            <div class="wgos-principle-bottom">
                <p class="wgos-bold-statement wgos-bold-statement--principle">Ads sind nicht verboten – aber sie werden zum optionalen Turbo, wenn das Fundament steht. Nicht zum Dauertropf.</p>
                <p class="wgos-inline-cta wgos-inline-cta--principle">
                    <a href="<?php echo esc_url( $audit_url ); ?>" data-track="cta_click_audit">Wie stark ist Ihr Fundament? Mit dem Audit starten</a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     WGOS FIX: SOCIAL PROOF STRIP (serverseitig)
     Position: nach Prinzip, vor dem Asset Explorer
     ======================================== -->
<section class="wgos-section wgos-section--white nx-reveal">
    <div class="wgos-container">
        <?php
        // WGOS FIX: Proof-Block zentral aus assets/html laden, damit Content konsistent bleibt.
        $wgos_social_proof_path = get_stylesheet_directory() . '/assets/html/wgos-social-proof.html';
        if ( file_exists( $wgos_social_proof_path ) ) {
            echo file_get_contents( $wgos_social_proof_path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        ?>
    </div>
</section>

<!-- ========================================
     SECTION 3: ASSET EXPLORER
     ======================================== -->
<section id="module" class="wgos-section">
    <div class="wgos-container">
        <h2 class="wgos-h2">Die Assets im System</h2>
        <p class="wgos-section-intro">Fahren Sie über ein Asset oder fokussieren Sie es per Tastatur, um den Nutzen zu sehen. Mit Klick oder Tap öffnet sich die Detailansicht mit Credits, Lieferumfang und dem nächsten sinnvollen Schritt.</p>
        <?php // TODO: Alte Leistungsseiten wie /wordpress-seo-hannover, /ga4-tracking-setup und /core-web-vitals per 301 auf passende /wgos/#asset-* Anker umleiten. ?>
        <div id="wgos-asset-explorer-root" class="wgos-asset-explorer-root" aria-live="polite"></div>
        <noscript>
            <p class="wgos-asset-explorer__noscript">Bitte aktivieren Sie JavaScript, um den WGOS Asset Explorer zu nutzen. Die Credits- und Paketbereiche weiter unten bleiben weiterhin verfügbar.</p>
        </noscript>
    </div>
</section>

<!-- ========================================
     SECTION 4: CREDITS-SYSTEM
     ======================================== -->
<section id="credits" class="wgos-section wgos-section--white">
    <div class="wgos-container">
        <h2 class="wgos-h2">Warum feste Leistungspunkte statt Stunden?</h2>

        <div class="wgos-prose" style="max-width:760px;">
            <p>Sie kaufen bei WGOS keine unklare Zeit, sondern klar priorisierte Ergebnisse. Leistungspunkte schaffen Transparenz, weil Aufwand und Nutzen besser planbar werden. So entsteht keine Diskussion über Minuten, sondern Klarheit darüber, welche Bausteine als Nächstes den größten Hebel haben.</p>
            <p>Das Modell ist besonders sinnvoll für Unternehmen, die nicht jeden Monat bei null anfangen wollen, sondern ihre Website systematisch weiterentwickeln möchten.</p>
            <p><strong>Baustein-Katalog in 3 Abschnitten:</strong> Fundament, Aufbau und Expansion. So priorisieren wir zuerst die Basis und dann Wachstum.</p>
        </div>

        <div class="wgos-credit-phases">
            <div class="wgos-credit-phase">
                <div class="wgos-credit-phase__head">
                    <h3 class="wgos-credit-phase__title">1. Fundament</h3>
                    <p class="wgos-credit-phase__desc">Stabilität, Speed und Messbarkeit zuerst. Das ist die Basis für jedes weitere Asset.</p>
                </div>
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
                            <tr class="wgos-table-category">
                                <td colspan="3">Performance &amp; Infrastruktur</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'CWV Speed Audit' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Analyse + Maßnahmenplan Core Web Vitals</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'CWV Optimierung' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Umsetzung: LCP, CLS, INP, Asset-Pipeline</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Server-Tuning' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Caching, CDN, PHP-Tuning, DB-Optimierung</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Security Hardening' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>WordPress-Härtung, Headers, Backup-Setup</td>
                                <td>10</td>
                            </tr>
                            <tr class="wgos-table-category">
                                <td colspan="3">Measurement &amp; Tracking</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'sGTM Setup' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Server-Side GTM Container + Event-Routing</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Consent Mode v2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>CMP Integration + Consent Signals an Google</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'GA4 Event Blueprint' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Custom Events, Conversions, Dashboards</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Tracking Audit' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Ist-Analyse Datenqualität + Gap-Report</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="wgos-credit-phase">
                <div class="wgos-credit-phase__head">
                    <h3 class="wgos-credit-phase__title">2. Aufbau</h3>
                    <p class="wgos-credit-phase__desc">Sichtbarkeit und Conversion ausbauen, damit aus Traffic verlässlich Leads werden.</p>
                </div>
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
                            <tr class="wgos-table-category">
                                <td colspan="3">SEO &amp; Owned Content</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Technical SEO Audit' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Crawl, Indexierung, Schema, Site-Architektur</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Pillar Page' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Langform-Seite (2.000+ Wörter, SEO-optimiert)</td>
                                <td>25</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Cluster-Artikel' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Blog/Supportcontent (800–1.200 Wörter)</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Case Study / Proof' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Kunden-Ergebnis mit KPIs, Vorher/Nachher</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Interne Link-Architektur' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Mapping + Umsetzung interner Verlinkung</td>
                                <td>8</td>
                            </tr>
                            <tr class="wgos-table-category">
                                <td colspan="3">Conversion &amp; Offer Engineering</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Landing Page (Neu)' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>High-Conversion LP: Copy, Design, Build</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'CRO Audit + Fixes' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Friction-Analyse, CTA-Optimierung, A/B</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Lead-Formular Engineering' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Multi-Step, Validation, Lead-Routing</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Offer/Pricing Page' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Angebotsstruktur, Pakete, Social Proof</td>
                                <td>15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="wgos-credit-phase">
                <div class="wgos-credit-phase__head">
                    <h3 class="wgos-credit-phase__title">3. Skalierung <span class="wgos-tag--optional">Optional</span></h3>
                    <p class="wgos-credit-phase__desc">Paid und Automation als Verstärker, sobald Fundament und Aufbau stehen.</p>
                </div>
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
                            <tr class="wgos-table-category">
                                <td colspan="3">Activation Layer &amp; Automation</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Google Ads Setup' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Kampagnenstruktur, Keywords, Anzeigen</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Paid Social Setup' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Kampagnenarchitektur, Creatives, Audiences</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Ads Management (monatlich)' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Optimierung, Reporting, Budget-Steuerung</td>
                                <td>10/Monat</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'n8n Automation Flow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Lead-Routing, Notifications, CRM-Sync</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><?php echo nexus_render_wgos_asset_label( 'Reporting Dashboard' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                <td>Automated KPI-Dashboard (Looker/Sheets)</td>
                                <td>10</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 5: PAKETE & INVESTITION
     ======================================== -->
<section id="pakete" class="wgos-section wgos-section--gray">
    <div class="wgos-container">
    <h2 class="wgos-h2">Die passende Zusammenarbeit – je nach Ausgangslage</h2>
    <p class="wgos-section-intro">Nicht jedes Unternehmen braucht sofort denselben Umfang. Entscheidend ist, wie stabil das Fundament bereits ist und wie schnell Sie vorankommen wollen.</p>

        <div class="wgos-pricing-grid">
            <!-- Paket 1: Fundament -->
            <div class="wgos-pricing-card nx-reveal">
                <div class="wgos-pricing-card__head">
                    <h3>Fundament</h3>
                    <p class="wgos-pricing-card__tagline">Fundament sichern</p>
                </div>
                <div class="wgos-pricing-card__price">ab 1.500&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">30 Leistungspunkte / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 3 Monate</li>
                    <li>1× Strategiecall / Monat</li>
                    <li>Fundament (Bereiche 1–3: Technik, Sicherheit, Tracking)</li>
                    <li>Reporting: Monatlich</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Für Unternehmen, die ihre Website technisch sauber betreiben, messbar machen und schrittweise verbessern wollen.</p>
                <a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit">Mit dem Audit starten</a>
            </div>

            <!-- Paket 2: Aufbau (FEATURED) -->
            <div class="wgos-pricing-card wgos-pricing-card--featured nx-reveal">
                <span class="wgos-pricing-badge">Empfohlen</span>
                <div class="wgos-pricing-card__head">
                    <h3>Aufbau</h3>
                    <p class="wgos-pricing-card__tagline">Seiten und Conversion ausbauen</p>
                </div>
                <div class="wgos-pricing-card__price">ab 2.800&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">60 Leistungspunkte / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 6 Monate</li>
                    <li>2× Strategiecalls / Monat</li>
                    <li>Fundament + Aufbau (Bereiche 1–6)</li>
                    <li>Reporting: alle zwei Wochen</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Für Unternehmen, die Sichtbarkeit, Conversion und Angebotslogik systematisch ausbauen wollen.</p>
                <a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Audit starten</a>
            </div>

            <!-- Paket 3: Expansion -->
            <div class="wgos-pricing-card nx-reveal">
                <div class="wgos-pricing-card__head">
                    <h3>Expansion</h3>
                    <p class="wgos-pricing-card__tagline">Reichweite und Prozesse ausbauen</p>
                </div>
                <div class="wgos-pricing-card__price">ab 4.500&nbsp;€<small>/Monat</small></div>
                <div class="wgos-pricing-card__credits">100+ Leistungspunkte / Monat</div>
                <ul class="wgos-pricing-card__features">
                    <li>Laufzeit: 12 Monate</li>
                    <li>Wöchentliche Strategiecalls</li>
                    <li>Fundament + Aufbau + Expansion (Bereiche 1–7)</li>
                    <li>Reporting: wöchentlich + Dashboard</li>
                </ul>
                <p class="wgos-pricing-card__ideal">Für Unternehmen, die ein belastbares Fundament haben und Inhalte, Nachfrage und Prozesse deutlich stärker entwickeln wollen.</p>
                <a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--outline" data-track="cta_click_audit">Mit dem Audit starten</a>
            </div>
        </div>

        <!-- Beispiel-Monat -->
        <div class="wgos-example-month nx-reveal">
            <h3>Beispiel-Monat: Growth Partner (60 Credits)</h3>
            <div class="wgos-table-wrap">
                <table class="wgos-credits-table wgos-credits-table--compact">
                    <thead>
                        <tr><th>Asset</th><th>Credits</th><th>Bereich</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>1× Pillar Page (SEO-optimiert, 2.000+ Wörter)</td><td>25</td><td>Aufbau</td></tr>
                        <tr><td>1× Landing Page (Neu)</td><td>20</td><td>Aufbau</td></tr>
                        <tr><td>1× GA4 Event Blueprint</td><td>12</td><td>Fundament</td></tr>
                        <tr><td>1× Tracking Audit</td><td>8</td><td>Fundament</td></tr>
                        <tr class="wgos-table-total"><td><strong>Gesamt</strong></td><td><strong>60</strong></td><td>—</td></tr>
                    </tbody>
                </table>
            </div>
            <p class="wgos-example-month__result">Ergebnis dieses Monats: 1 neues Ranking-Asset, 1 konvertierende Seite, saubere Datenbasis und klare Conversion-Messung. Alles bleibt. Alles arbeitet weiter.</p>
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
    <h2 class="wgos-h2">FAQ – Häufige Fragen zum WGOS</h2>

        <div class="wgos-faq">
            <details class="nx-faq__item">
                <summary>Was genau ist das WGOS?</summary>
                <div class="nx-faq__content">Ein monatlicher Retainer, bei dem wir Ihr WordPress in ein eigenes Anfragesystem verwandeln. Statt einzelner Projekte investieren wir kontinuierlich in digitale Assets: Performance, Messbarkeit, SEO-Content und Conversion-Optimierung. Sie zahlen nicht für Stunden, sondern für Output.</div>
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
                <div class="nx-faq__content">Alles bleibt bei Ihnen: Code, Content, Tracking-Setup, Accounts, Zugänge. Kein Lock-in, keine Exit-Gebühren. Die Assets, die wir gebaut haben, arbeiten weiter&nbsp;— genau das ist der Unterschied zwischen gemieteter und eigener Nachfrage.</div>
            </details>
        </div>
    </div>
</section>

<!-- ========================================
     SECTION 8: ABSCHLUSS-CTA
     ======================================== -->
<section class="wgos-section wgos-section--white wgos-final-cta nx-reveal">
    <div class="wgos-container" style="text-align:center;">
        <h2 class="wgos-h2">Erst Klarheit. Dann die richtige Reihenfolge.</h2>
        <p class="wgos-prose" style="max-width:680px;margin:0 auto 2rem;">Wenn Sie Ihre WordPress-Website nicht länger mit Einzelmaßnahmen überladen wollen, sondern daraus ein verlässliches Anfragesystem machen möchten, ist der nächste Schritt ein gemeinsamer Blick auf Fundament, Engpässe und Prioritäten.</p>

        <div class="wgos-hero__actions">
            <a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track="cta_click_audit">Mit dem Audit starten</a>
        </div>
        <div class="wgos-final__links">
            <a href="<?php echo esc_url( $cases_url ); ?>" class="wgos-link--arrow">Case Studies ansehen</a>
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
        "text": "Ein monatlicher Retainer, bei dem wir Ihr WordPress in ein eigenes Anfragesystem verwandeln. Statt einzelner Projekte investieren wir kontinuierlich in digitale Assets: Performance, Messbarkeit, SEO-Content und Conversion-Optimierung. Sie zahlen nicht für Stunden, sondern für Output."
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
        "text": "Alles bleibt bei Ihnen: Code, Content, Tracking-Setup, Accounts, Zugänge. Kein Lock-in, keine Exit-Gebühren. Die Assets, die wir gebaut haben, arbeiten weiter — genau das ist der Unterschied zwischen gemieteter und eigener Nachfrage."
      }
    }
  ]
}
</script>

<?php get_footer(); ?>
