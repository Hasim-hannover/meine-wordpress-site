<?php
/**
 * Shortcodes für die Startseite.
 * STRATEGIE-UPDATE: 100% WordPress & Growth Fokus.
 * Keine Shopify-Dienstleistung mehr testen.
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// 1. Hero Section
function hu_hero_section_shortcode() {
    ob_start();
    ?>
    <div class="cs-page">

    <nav class="smart-nav" aria-label="Seitennavigation">
        <ul>
            <li><a href="#hero" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
            <li><a href="#owned" title="Prinzip"><div class="nav-dot"></div><span class="nav-text">Owned</span></a></li>
            <li><a href="#audit" title="Analyse"><div class="nav-dot"></div><span class="nav-text">Diagnose</span></a></li>
            <li><a href="#wgos" title="System"><div class="nav-dot"></div><span class="nav-text">System</span></a></li>
            <li><a href="#erfolge" title="Ergebnisse"><div class="nav-dot"></div><span class="nav-text">Erfolge</span></a></li>
            <li><a href="#blog" title="Wissen"><div class="nav-dot"></div><span class="nav-text">Insights</span></a></li>
            <li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
        </ul>
    </nav>

    <section class="wp-hero" id="hero" role="banner">
        <div class="wp-container">
            <span class="wp-badge">Privacy-first Growth: Owned Leads statt Ad-Miete</span>
            <h1 class="wp-hero-title">
                B2B-Leads ohne<br><span>Tracking-Lärm &amp; Blackbox.</span>
            </h1>
            <p class="wp-hero-subtitle">
                Ich baue aus Ihrer WordPress-Instanz ein Owned-Leads-System: ultraschnelle UX, technische SEO, Content-Assets und
                privacy-first Messbarkeit. Ads sind optional&nbsp;– als Verstärker, nicht als Dauer-Miete.
            </p>
            <div class="wp-trust-stack">
                Stack: Advanced WordPress · Technical SEO · Privacy-by-Design Tracking (Server-Side + Consent Mode v2) · CRO · n8n Automation
            </div>

            <div class="audit-card-premium" id="audit">
                <div style="text-align:center; margin-bottom:2rem;">
                    <span style="background:rgba(255,176,32,0.15); color:#FFB020; padding:6px 12px; border-radius:20px; font-size:0.8rem; font-weight:700;">
                        Free Journey Audit
                    </span>
                </div>
                <h3 style="text-align:center;">Deep-Dive Tech &amp; Owned-Leads Audit</h3>
                <p style="text-align:center; color:#aaa; margin-bottom:1.5rem;">
                    Wir finden die echten Bremsen&nbsp;– und bauen eine Roadmap, die nicht vom Werbebudget abhängt.
                </p>
                <ul class="premium-list">
                    <li><span class="check-icon">✓</span> <div><strong>Performance:</strong> Core Web Vitals &amp; UX-Reibung (Conversion-Hebel)</div></li>
                    <li><span class="check-icon">✓</span> <div><strong>Privacy-Messbarkeit:</strong> Saubere Events &amp; Datenintegrität ohne Misstrauen</div></li>
                    <li><span class="check-icon">✓</span> <div><strong>Owned Roadmap:</strong> 90-Tage-Plan für Rankings, Pages &amp; Lead-Qualität</div></li>
                </ul>
                <div class="price-box text-center">
                    Expertise-Session (30 Min) · Invest: <strong>0&nbsp;€</strong> <span style="font-size:0.8em; opacity:0.7">(statt 450&nbsp;€)</span>
                </div>
                <div class="wp-btn-wrapper">
                    <a href="/customer-journey-audit/" class="wp-btn wp-btn-primary full-width" data-track-action="cta_hero_audit" data-track-category="lead_gen">Free Journey Audit starten (0&nbsp;€)</a>
                </div>
            </div>

            <div class="vertical-metrics" role="group" aria-label="Erfolgsmetriken">
                <div class="wp-metric">
                    <span class="wp-metric-value" data-value="98">98</span>
                    <span class="wp-metric-label">Mobile Performance</span>
                </div>
                <div class="wp-metric">
                    <span class="wp-metric-value" data-value="-83">-83%</span>
                    <span class="wp-metric-label">CPL (Kosten/Lead)</span>
                </div>
                <div class="wp-metric">
                    <span class="wp-metric-value text-gold">&lt;&nbsp;0.8s</span>
                    <span class="wp-metric-label">Load Time (LCP)</span>
                </div>
                <div class="wp-metric">
                    <span class="wp-metric-value" data-value="100">100%</span>
                    <span class="wp-metric-label">Data Ownership</span>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_hero', 'hu_hero_section_shortcode' );

// 2. Partner Section (BEREINIGT: Kein Shopify mehr)
function hu_partner_section_shortcode() {
    ob_start();
    ?>
    <section id="partner" class="architect-section" aria-labelledby="architect-heading">
        <div class="container">
            <div class="architect-grid">
                <div class="hero-card">
                    <img src="https://hasimuener.de/wp-content/uploads/2025/08/Shopify-WordPress-Growth-Architect-400-x-400-px.webp" alt="Hasim Üner – WordPress Experte Hannover" loading="lazy" width="400" height="400">
                </div>
                <div class="architect-content">
                    <span class="badge">Ihr Strategischer Partner</span>
                    <h2 id="architect-heading">Ich bin Hasim Üner – Ihr WordPress Specialist.</h2>
                    <p class="lead">Ich verbinde tiefes technisches Verständnis mit strategischem Marketing. Mein Ansatz ist nicht "Stunden abarbeiten", sondern <strong>Ergebnisse liefern</strong>. Von der sauberen <a href="https://hasimuener.de/ga4-tracking-setup/" style="color:var(--gold); text-decoration: underline;">Daten-Infrastruktur</a> bis zur <a href="https://hasimuener.de/core-web-vitals-optimierung/" style="color:var(--gold); text-decoration: underline;">Performance-Optimierung</a> erhalten Sie fertige Module, die Ihr Business voranbringen.</p>
                    <a href="/uber-mich/" class="btn btn-ghost">Meine Arbeitsweise kennenlernen</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_partner', 'hu_partner_section_shortcode' );

// 2b. Owned vs Ad-Miete Section
function hu_owned_section_shortcode() {
    ob_start();
    ?>
    <section id="owned" class="wp-section" style="border-top: 1px solid rgba(255,255,255,0.05);" aria-labelledby="owned-heading">
        <div class="container">
            <div class="section-title text-center">
                <span class="badge">Das Prinzip</span>
                <h2 id="owned-heading">Owned Leads statt Ad-System auf Miete.</h2>
                <p>In anspruchsvollen Märkten gewinnt nicht der Lauteste, sondern der Vertrauenswürdigste&nbsp;— eine Pipeline, die mit der Zeit günstiger wird.</p>
            </div>

            <div class="wp-cards" style="margin-top:2.5rem;">

                <div class="wp-success-card" style="border-top:3px solid rgba(255,255,255,0.1);">
                    <h3 class="wp-success-title">Modell A: Ad-Miete</h3>
                    <p class="wp-success-subtitle">Paid-Only, Dauer-Druck</p>
                    <ul class="premium-list">
                        <li><span class="check-icon" style="color:#888;">→</span> <div>Schneller Push&nbsp;— solange Budget läuft</div></li>
                        <li><span class="check-icon" style="color:#888;">→</span> <div>Steigende Medienkosten, sinkende Margen</div></li>
                        <li><span class="check-icon" style="color:#888;">→</span> <div>Abhängigkeit von Plattform-Regeln &amp; Tracking-Restriktionen</div></li>
                    </ul>
                </div>

                <div class="wp-success-card" style="border-top:3px solid var(--gold);">
                    <h3 class="wp-success-title" style="color:var(--gold);">Modell B: Owned Leads</h3>
                    <p class="wp-success-subtitle">Privacy-first · SEO · Content · Vertrauen</p>
                    <ul class="premium-list">
                        <li><span class="check-icon">✓</span> <div>Assets bauen: Rankings, Pages, Proof, Lead-Flows</div></li>
                        <li><span class="check-icon">✓</span> <div>Messen, was nötig ist&nbsp;— sauber, DSGVO-konform</div></li>
                        <li><span class="check-icon">✓</span> <div>Ads optional als Verstärker, wenn das Fundament steht</div></li>
                    </ul>
                </div>

            </div>

            <div class="text-center" style="margin-top:2rem;">
                <a href="/customer-journey-audit/" class="wp-btn wp-btn-secondary" data-track-action="cta_owned_audit" data-track-category="lead_gen">Audit starten: Welche Hebel sind bei Ihnen drin?</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_owned', 'hu_owned_section_shortcode' );

// 2c. WGOS Block (Homepage Teaser)
function hu_wgos_block_shortcode() {
    ob_start();
    ?>
    <section class="wp-section" id="wgos" aria-labelledby="wgos-heading">
        <div class="wp-container">
            <div class="wp-section-title text-center">
                <span class="wp-badge">Das System</span>
                <h2 id="wgos-heading" class="wp-section-h2">WordPress Growth Operating System (WGOS)</h2>
                <p class="wp-section-p">
                    Weg von "Kampagnen-Gambling", hin zu Assets: Wir investieren monatlich in Dinge, die bleiben&nbsp;–
                    Geschwindigkeit, Datenintegrität, Seiten, Content und Lead-Qualität.
                </p>
            </div>
            <div class="wp-process">
                <div class="wp-step">
                    <div class="wp-step-num">1</div>
                    <h3>Speed &amp; Conversion</h3>
                    <p>Core Web Vitals, UX-Reibung, technische Hygiene. Ziel: weniger Absprünge, mehr Anfragen&nbsp;– messbar.</p>
                </div>
                <div class="wp-step">
                    <div class="wp-step-num">2</div>
                    <h3>Privacy-First Measurement</h3>
                    <p>Server-Side Tracking, Consent Mode v2, Event-Blueprint. Saubere Daten ohne Vertrauen zu zerstören.</p>
                </div>
                <div class="wp-step highlight-step">
                    <div class="wp-step-num highlight-num">3</div>
                    <h3 class="text-gold">Owned Lead Flywheel (Retainer)</h3>
                    <p>
                        Pillar Pages, Content-Cluster, interne Verlinkung, Proof-Assets &amp; Nurture.
                        <strong>Beispiel:</strong> Neue High-Conversion Landingpage fix 20 Punkte&nbsp;– planbar, ohne Nachverhandlung.
                    </p>
                </div>
            </div>
            <div class="text-center" style="margin-top:2.5rem;">
                <a href="/customer-journey-audit/" class="wp-btn wp-btn-secondary" data-track-action="cta_wgos_audit" data-track-category="lead_gen">Erst Diagnose, dann System</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_wgos_block', 'hu_wgos_block_shortcode' );

// 3. Erfolge Section (NEUTRALISIERT: E-Commerce statt Shopify Plus)
function hu_erfolge_section_shortcode() {
    ob_start();
    ?>
     <section id="erfolge" aria-labelledby="cases-heading" style="background:var(--glass-bg); border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border);">
        <div class="container">
            <div class="section-title">
                <span class="badge">Track Record</span>
                <h2 id="cases-heading">Ergebnisse statt Versprechen.</h2>
                <p>Echte Zahlen aus Projekten, bei denen Strategie und Technik perfekt ineinandergreifen.</p>
            </div>
            
            <article class="success-card">
                <h3>E3 New Energy — Lead-Maschine</h3>
                <p class="muted">B2B Leadgen · High-Performance WordPress · 12 Monate</p>
                <div class="metrics">
                    <div class="metric"><div style="color:var(--success);font-weight:800;font-size:1.4rem;">1.750+</div><div class="muted">Qualifizierte Leads</div></div>
                    <div class="metric"><div style="color:var(--success)">-83%</div><div class="muted">CPL Reduktion</div></div>
                    <div class="metric"><div style="color:var(--gold);font-weight:800;font-size:1.4rem;">Top 3</div><div class="muted">SEO Rankings</div></div>
                    <div class="metric"><div style="color:var(--success)">100%</div><div class="muted">DSGVO Tracking</div></div>
                </div>
            </article>

            <article class="success-card">
                <h3>DOMDAR — E-Commerce Scaling</h3>
                <p class="muted">Performance Relaunch · CRO & UX Strategy · 6 Monate</p>
                <div class="metrics">
                    <div class="metric"><div style="color:var(--success)">+270%</div><div class="muted">Conversion Rate</div></div>
                    <div class="metric"><div style="color:var(--gold)">+445%</div><div class="muted">Warenkorb-Wert</div></div>
                    <div class="metric"><div style="color:var(--success)">-62%</div><div class="muted">Abbrüche</div></div>
                    <div class="metric"><div style="color:var(--success)">0.4s</div><div class="muted">Ladezeit</div></div>
                </div>
            </article>

            <div style="text-align:center; margin-top: 2rem; display:flex; flex-wrap:wrap; gap:1rem; justify-content:center;">
                <a href="/customer-journey-audit/" class="btn btn-primary" data-track-action="cta_erfolge_audit" data-track-category="lead_gen">Free Journey Audit starten (0&nbsp;€)</a>
                <a href="/case-studies/" class="btn btn-ghost">Case Studies ansehen</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_erfolge', 'hu_erfolge_section_shortcode' );

// 4. Prozess Section (Bleibt fast gleich, passt super)
function hu_prozess_section_shortcode() {
    ob_start();
    ?>
    <section id="prozess" aria-labelledby="process-heading">
        <div class="container">
            <div class="section-title">
                <span class="badge">Retainer & Module</span>
                <h2 id="process-heading">So arbeiten wir zusammen</h2>
                <p>Kein unübersichtliches Stundenschreiben. Wir definieren Ziele und ich setze diese in klaren Sprints und Modulen um.</p>
            </div>
            <div class="process">
                <article class="step"><div class="num">1</div><h3>Free Journey Audit</h3><p class="muted">Wir analysieren Ihre WordPress-Präsenz auf Tracking, Performance, Conversion und SEO. Sie erhalten eine priorisierte Roadmap&nbsp;— kostenlos, in 48h. <a href="/customer-journey-audit/" style="color:var(--gold); font-weight:700;">Audit starten →</a></p></article>
                <article class="step"><div class="num">2</div><h3>Modulare Umsetzung</h3><p class="muted">Ob Performance-Boost, Tracking-Setup oder Design-Refresh: Ich setze die definierten Pakete technisch sauber um.</p></article>
                <article class="step"><div class="num">3</div><h3>Review & Deployment</h3><p class="muted">Jedes Modul wird getestet und abgenommen, bevor es live geht. Volle Transparenz über GitHub und Staging-Umgebungen.</p></article>
                <article class="step"><div class="num">4</div><h3>Growth Retainer</h3><p class="muted">Nach dem Launch optimieren wir weiter. Im monatlichen Retainer überwache ich Core Web Vitals, Rankings und Conversions.</p></article>
            </div>
            <div style="text-align:center; margin-top: 2rem;">
                <a href="/wordpress-growth-operating-system/" class="btn btn-ghost">WGOS verstehen</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_prozess', 'hu_prozess_section_shortcode' );

// 5. FAQ Section
function hu_faq_section_shortcode() {
    ob_start();
    ?>
    <section id="faq" aria-labelledby="faq-heading" style="background:var(--glass-bg); border-top:1px solid var(--glass-border); padding:5rem 0;">
        <div class="nx-container">
            <div style="text-align:center; margin-bottom:3rem;">
                <span class="nx-badge nx-badge--gold">FAQ</span>
                <h2 id="faq-heading" style="font-size:clamp(1.8rem,3vw,2.4rem); margin:1rem 0 0.5rem; color:#fff;">Häufige Fragen</h2>
                <p style="color:var(--nx-text-muted);">Klarheit vor dem ersten Schritt.</p>
            </div>
            <div class="nx-faq">
                <details class="nx-faq__item">
                    <summary>Was bedeutet "Privacy-first Tracking" konkret?</summary>
                    <div class="nx-faq__content">Minimal notwendige Events statt Daten-Sammelwut: Consent Mode v2 sauber implementiert, Server-Side GTM wo sinnvoll, vollständig dokumentiert. Ziel: belastbare KPIs ohne Vertrauensverlust bei Ihren Nutzern.</div>
                </details>
                <details class="nx-faq__item">
                    <summary>Brauchen wir dann überhaupt noch Ads?</summary>
                    <div class="nx-faq__content">Das ist Ihre Entscheidung. Wenn das Owned-Fundament steht (Seiten, Proof, Messbarkeit), können Ads sehr effizient skalieren. Kein Dauereinsatz als Pflicht&nbsp;— Ads sind ein Verstärker, nicht das Betriebssystem.</div>
                </details>
                <details class="nx-faq__item">
                    <summary>Was unterscheidet Credits von Stundensätzen?</summary>
                    <div class="nx-faq__content">Planungssicherheit. Stunden können ausufern. Credits sind fix: Sie wissen vorher genau, was eine Landingpage oder ein Tracking-Setup kostet. Das Risiko für Mehraufwand liegt bei mir.</div>
                </details>
                <details class="nx-faq__item">
                    <summary>Warum ist der Audit der erste Schritt?</summary>
                    <div class="nx-faq__content">Weil Guesswork teuer ist. Im Free Journey Audit identifizieren wir, ob Ihre Bremsen in Speed, Code, UX, SEO oder Tracking liegen&nbsp;— bevor Zeit oder Budget investiert wird. 48h, kostenlos, kein Pitch.</div>
                </details>
                <details class="nx-faq__item">
                    <summary>Für wen ist das nichts?</summary>
                    <div class="nx-faq__content">Für Hobby-Projekte, reine Visitenkarten ohne Lead-Absicht oder Unternehmen, die Baukasten-Preise erwarten. Das System ist für B2B-Unternehmen ab ~500.000&nbsp;€ Jahresumsatz, die planbar skalieren wollen.</div>
                </details>
            </div>
        </div>
    </section>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
                "@type": "Question",
                "name": "Was bedeutet \"Privacy-first Tracking\" konkret?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Minimal notwendige Events statt Daten-Sammelwut: Consent Mode v2 sauber implementiert, Server-Side GTM wo sinnvoll, vollständig dokumentiert. Ziel: belastbare KPIs ohne Vertrauensverlust."
                }
            },
            {
                "@type": "Question",
                "name": "Brauchen wir dann überhaupt noch Ads?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Das ist Ihre Entscheidung. Wenn das Owned-Fundament steht, können Ads sehr effizient skalieren. Ads sind ein Verstärker, nicht das Betriebssystem."
                }
            },
            {
                "@type": "Question",
                "name": "Was unterscheidet Credits von Stundensätzen?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Planungssicherheit. Credits sind fix: Sie wissen vorher genau, was eine Landingpage oder ein Tracking-Setup kostet. Das Risiko für Mehraufwand liegt beim Anbieter."
                }
            },
            {
                "@type": "Question",
                "name": "Warum ist der Audit der erste Schritt?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Im Free Journey Audit identifizieren wir, ob die Bremsen in Speed, Code, UX, SEO oder Tracking liegen — bevor Zeit oder Budget investiert wird. 48h, kostenlos, kein Pitch."
                }
            },
            {
                "@type": "Question",
                "name": "Für wen ist das nichts?",
                "acceptedAnswer": {
                    "@type": "Answer",
                    "text": "Für Hobby-Projekte, reine Visitenkarten ohne Lead-Absicht oder Unternehmen, die Baukasten-Preise erwarten. Das System ist für B2B-Unternehmen ab ~500.000 € Jahresumsatz."
                }
            }
        ]
    }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_faq', 'hu_faq_section_shortcode' );


// 6. Blog Section (CLEAN CODE: Valide Links statt Onclick-Events)
function hu_blog_section_shortcode() {
    ob_start();
    ?>
    <section id="blog" class="wp-section" style="border-top: 1px solid rgba(255,255,255,0.05);">
        <div class="wp-container">
            <div class="wp-section-title text-center" style="margin-bottom: 4rem;">
                <span class="wp-badge">Knowledge Base</span>
                <h2 style="font-size: 2.5rem; margin-bottom: 1rem; color: #fff;">Strategie & Technik</h2>
                <p class="wp-hero-subtitle">Hebel für messbares B2B-Wachstum durch Engineering und Psychologie.</p>
            </div>
            
            <div class="wp-cards">
                <?php
                $args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'ignore_sticky_posts' => true
                );
                $blog_query = new WP_Query($args);

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        $categories = get_the_category();
                        $cat_name = !empty($categories) ? $categories[0]->name : 'Insights';
                        ?>
                        <article class="wp-success-card" style="position: relative; display: flex; flex-direction: column;">
                            <a href="<?php the_permalink(); ?>" class="card-link-wrapper" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%;">
                                
                                <?php if ($thumb_url) : ?>
                                    <div class="card-image-wrapper" style="border-radius:12px; overflow:hidden; margin-bottom:1.5rem; border:1px solid var(--border);">
                                        <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%; height:200px; object-fit:cover; transition: transform 0.4s ease;" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-content" style="flex-grow: 1; display: flex; flex-direction: column;">
                                    <span class="wp-metric-label" style="display:block; margin-bottom:0.5rem; text-transform:uppercase; font-size:0.75rem; color:var(--gold); font-weight:700;">
                                        <?php echo esc_html($cat_name); ?>
                                    </span>
                                    
                                    <h3 class="wp-success-title" style="min-height: 3.5rem; line-height:1.3; font-size: 1.4rem; color: #fff; margin: 0 0 1rem 0;"><?php the_title(); ?></h3>
                                    
                                    <p style="color:var(--text-dim); font-size:0.95rem; line-height:1.6; margin: 0 0 1.5rem 0;">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </p>
                                    
                                    <span class="text-gold" style="font-weight:700; font-size:0.9rem; margin-top:auto; display: inline-block;">Analyse lesen →</span>
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
            
            <div style="text-align:center; margin-top: 4rem;">
                <a href="/blog/" class="wp-btn wp-btn-secondary">Zum Experten-Blog</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_blog', 'hu_blog_section_shortcode' );

// 7. CTA Section
function hu_cta_section_shortcode() {
    ob_start();
    ?>
    <section id="cta" aria-labelledby="cta-heading" style="padding:5rem 0;">
        <div class="nx-container">
            <div class="nx-cta-box">
                <span class="nx-badge nx-badge--gold" style="display:inline-block; margin-bottom:1.5rem;">Nächster Schritt</span>
                <h2 id="cta-heading" style="font-size:clamp(1.8rem,3vw,2.4rem); margin-bottom:1rem; color:#fff;">Welche Hebel liegen bei Ihnen brach?</h2>
                <p>Im Free Journey Audit analysieren wir Ihre WordPress-Präsenz auf die größten Wachstumspotenziale&nbsp;— kostenlos, in 48h, ohne Pitch.</p>

                <!-- Proof -->
                <div role="group" aria-label="Beispiel-Ergebnisse" style="display:flex; flex-wrap:wrap; justify-content:center; gap:0.75rem 1.5rem; margin-bottom:2rem;">
                    <span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ 1.750+ qualifizierte Leads</span>
                    <span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ CPL &minus;83&nbsp;%</span>
                    <span style="font-size:0.85rem; color:var(--nx-text-muted);">✓ E3 New Energy</span>
                </div>

                <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:1rem;">
                    <a class="nx-btn nx-btn--primary" href="/customer-journey-audit/" data-track-action="cta_footer_audit" data-track-category="lead_gen">Free Journey Audit starten (0&nbsp;€)</a>
                    <a class="nx-btn nx-btn--ghost" href="/case-studies/" data-track-action="cta_footer_cases" data-track-category="lead_gen">Case Studies ansehen</a>
                </div>

                <p style="font-size:0.8rem; color:var(--nx-text-muted); margin-top:1.5rem; margin-bottom:0;">
                    Ergebnisse hängen von der Ausgangslage ab.
                    <a href="/wordpress-growth-operating-system/" style="color:var(--nx-gold); text-decoration:underline; font-weight:600;">WGOS verstehen →</a>
                </p>
            </div>
        </div>
    </section>

    </div><!-- /.cs-page -->
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_cta', 'hu_cta_section_shortcode' );