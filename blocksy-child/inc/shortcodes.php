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

// 1. Hero Section (POSITIONIERUNG: WordPress Specialist)
function hu_hero_section_shortcode() {
    ob_start();
    ?>
    <nav id="toc-nav" aria-label="Inhaltsverzeichnis">
        <h4>Inhalt</h4>
        <ul>
            <li><a href="#start">Start</a></li>
            <li><a href="#partner">Über mich</a></li>
            <li><a href="#erfolge">Ergebnisse</a></li>
            <li><a href="#prozess">Prozess</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#cta">Kontakt</a></li>
        </ul>
    </nav>

    <header class="hero-section" role="banner" id="start">
        <div class="container">
            <div class="section-title">
                <span class="badge">Hasim Üner – WordPress & Growth Partner</span>
                <h1>High-End WordPress.<br>Messbares Wachstum.</h1>
                <p class="sub">Schluss mit "Zeit gegen Geld". Ich biete Ihnen modulare Lösungen für technische Exzellenz und datengetriebenen Erfolg. Skalierbar, sicher und transparent.</p>
            </div>
            
            <div class="switch-grid" aria-label="Meine Kompetenzfelder">
                
                <div class="switch-card">
                     <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    <h2>Technische Exzellenz</h2>
                    <p>Individuelle WordPress-Entwicklung ohne Bloatware. Fokus auf Core Web Vitals, Sicherheit und eine Architektur, die mit Ihrem Business wächst.</p>
                    <a href="/wordpress-agentur-hannover/" class="btn btn-primary">WordPress Module ansehen</a>
                </div>

                <div class="switch-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                    <h2>Daten & Strategie</h2>
                    <p>Wachstum ist kein Zufall. Mit Server-Side Tracking (GA4), Conversion-Optimierung und SEO-Automatisierung machen wir Ihren Erfolg planbar.</p>
                    <a href="/growth-blueprint/" class="btn btn-ghost">Growth Strategie</a>
                </div>
            </div>

            <div class="hero-stats" role="group" aria-label="Erfolgsstatistiken">
                <div class="stat"><div class="num" data-target="98">0</div><div class="label">Google PageSpeed</div></div>
                <div class="stat"><div class="num" data-target="2500">0</div><div class="label">Leads generiert</div></div>
                <div class="stat"><div class="num" data-target="100">0</div><div class="label">% Datenhoheit</div></div>
                <div class="stat"><div class="num" data-target="45">0</div><div class="label">Module deployed</div></div>
            </div>
        </div>
    </header>
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
                <p class="muted">B2C Leadgen · High-Performance WordPress · 8 Monate</p>
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

            <div style="text-align:center; margin-top: 2rem;">
                <a href="/case-studies/" class="btn btn-ghost">Alle Case Studies ansehen</a>
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
                <article class="step"><div class="num">1</div><h3>Audit & Roadmap</h3><p class="muted">Wir analysieren den Ist-Zustand Ihrer WordPress-Installation und Ihrer Daten. Sie erhalten einen klaren Maßnahmen-Plan.</p></article>
                <article class="step"><div class="num">2</div><h3>Modulare Umsetzung</h3><p class="muted">Ob Performance-Boost, Tracking-Setup oder Design-Refresh: Ich setze die definierten Pakete technisch sauber um.</p></article>
                <article class="step"><div class="num">3</div><h3>Review & Deployment</h3><p class="muted">Jedes Modul wird getestet und abgenommen, bevor es live geht. Volle Transparenz über GitHub und Staging-Umgebungen.</p></article>
                <article class="step"><div class="num">4</div><h3>Growth Retainer</h3><p class="muted">Nach dem Launch optimieren wir weiter. Im monatlichen Retainer überwache ich Core Web Vitals, Rankings und Conversions.</p></article>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_prozess', 'hu_prozess_section_shortcode' );

// 5. FAQ Section (Angepasst auf WordPress Only)
function hu_faq_section_shortcode() {
    ob_start();
    ?>
    <section id="faq" aria-labelledby="faq-heading">
        <div class="container">
            <div class="section-title">
                <span class="badge">FAQ</span>
                <h2 id="faq-heading">Häufige Fragen</h2>
                <p>Klarheit vor dem Start.</p>
            </div>
            <div class="faq">
                <details><summary>Übernehmen Sie auch bestehende Seiten?</summary><div class="faq-content">Ja. Mein Spezialgebiet ist es, bestehende WordPress-Seiten zu auditieren, zu reparieren und auf High-Performance-Niveau zu bringen.</div></details>
                <details><summary>Was bedeutet "Arbeit in Modulen"?</summary><div class="faq-content">Statt "Ich brauche 5 Stunden", verkaufe ich Ihnen das Ergebnis "Performance-Optimierung" oder "Tracking-Setup" zum Festpreis. Das gibt Ihnen Planungssicherheit.</div></details>
                <details><summary>Machen Sie auch Design?</summary><div class="faq-content">Ich fokussiere mich auf technische Umsetzung und CRO-Design. Für komplexes Branding arbeite ich mit spezialisierten Designern aus meinem Netzwerk zusammen.</div></details>
                <details><summary>Wie schnell sind Ergebnisse sichtbar?</summary><div class="faq-content">Technische Optimierungen (Speed) greifen sofort. SEO- und Conversion-Maßnahmen zeigen in der Regel nach 4–8 Wochen messbare Wirkung in den Daten.</div></details>
            </div>
        </div>
    </section>
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
    <section id="cta" aria-labelledby="cta-heading" style="background:var(--glass-bg); border-top: 1px solid var(--glass-border);">
        <div class="container">
            <div class="section-title">
                <span class="badge">Nächster Schritt</span>
                <h2 id="cta-heading">Lassen Sie uns Ihr Potenzial heben.</h2>
                <p>Sie suchen einen Partner, der WordPress technisch und strategisch meistert? Dann lassen Sie uns sprechen.</p>
            </div>
            <div style="text-align:center; display:flex; flex-wrap:wrap; justify-content:center; gap: 1rem;">
                <a class="btn btn-primary" href="https://hasimuener.de/kontakt/">🚀 Projekt anfragen</a>
                <a class="btn btn-ghost" href="https://cal.com/hasim/30min">📞 Kennenlerngespräch buchen</a>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_cta', 'hu_cta_section_shortcode' );