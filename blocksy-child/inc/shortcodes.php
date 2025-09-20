<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Shortcode für den Hero-Bereich
function homepage_hero_shortcode() {
    ob_start();
    ?>
    <section id="hero" class="hero-section">
        <div class="container">
            <div class="hero-content">
                <span class="badge">Web- & Wachstums-Architekt</span>
                <h1 class="hero-title">Ich entwickle digitale Strategien, die Ihr Unternehmen wachsen lassen.</h1>
                <p class="hero-subtitle">Vom technischen Fundament mit WordPress & Shopify bis zur Vermarktung – für messbare Ergebnisse und nachhaltigen Erfolg.</p>
                <div class="hero-buttons">
                    <a href="#prozess" class="btn btn-primary">So arbeite ich</a>
                    <a href="/kontakt/" class="btn btn-secondary">Jetzt anfragen</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_hero', 'homepage_hero_shortcode' );
}

// Shortcode für den Partner-Bereich
function homepage_partner_shortcode() {
    ob_start();
    ?>
    <section id="partner" class="architect-section" aria-labelledby="architect-heading">
         <div class="container">
            <div class="architect-grid">
                <div class="hero-card">
                    <img src="https://hasimuener.de/wp-content/uploads/2025/08/Shopify-WordPress-Growth-Architect-400-x-400-px.webp"
                         alt="Growth Partner Hannover – Hasim Üner (Shopify & WordPress)"
                         loading="lazy" width="400" height="400" decoding="async">
                </div>
                <div class="architect-content">
                    <span class="badge">Ihr Partner</span>
                    <h2 id="architect-heading">Ich bin Hasim Üner – Ihr Growth Architect in Hannover.</h2>
                    <p class="lead">Als Ihr strategischer Growth Architect verbinde ich die Welten von Shopify & WordPress mit datengetriebenem Marketing. Das Ziel: Eine ganzheitliche Strategie für Ihren messbaren Erfolg.</p>
                    <a href="/uber-mich/" class="btn btn-ghost">Mehr über meine Arbeitsweise</a>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('homepage_partner', 'homepage_partner_shortcode');


// Shortcode für den Erfolge-Bereich
function homepage_erfolge_shortcode() {
    ob_start();
    ?>
    <section id="erfolge" class="results-section">
        <div class="container">
            <div class="results-header">
                <span class="badge">Erfolge</span>
                <h2>Gemeinsam Ziele erreichen</h2>
                <p>Jedes Projekt ist eine Partnerschaft. Hier sind einige Beispiele, wie ich Unternehmen unterstützt habe, ihre digitalen Ziele zu übertreffen.</p>
            </div>
            </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_erfolge', 'homepage_erfolge_shortcode' );

// Shortcode für den Prozess-Bereich
function homepage_prozess_shortcode() {
    ob_start();
    ?>
    <section id="prozess" class="process-section">
        <div class="container">
            <div class="process-header">
                 <span class="badge">Mein Prozess</span>
                <h2>Von der Idee zum Erfolg in 4 Schritten</h2>
                <p>Ein strukturierter Prozess ist der Schlüssel zum Erfolg. So stelle ich sicher, dass wir Ihre Ziele effizient und effektiv erreichen.</p>
            </div>
            </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_prozess', 'homepage_prozess_shortcode' );

// Shortcode für den FAQ-Bereich
function homepage_faq_shortcode() {
    ob_start();
    ?>
    <section id="faq" class="faq-section">
        <div class="container">
            <h2>Häufig gestellte Fragen</h2>
            </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_faq', 'homepage_faq_shortcode' );

// Shortcode für den CTA-Bereich
function homepage_cta_shortcode() {
    ob_start();
    ?>
    <section id="cta" class="cta-section">
        <div class="container">
            <h2>Bereit für den nächsten Schritt?</h2>
            <p>Lassen Sie uns gemeinsam herausfinden, wie wir Ihr digitales Potenzial entfalten können. Ich freue mich auf Ihre Nachricht.</p>
            <a href="/kontakt/" class="btn btn-primary">Jetzt Kontakt aufnehmen</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_cta', 'homepage_cta_shortcode' );