<?php
/**
 * Shortcodes für die Startseite.
 * Finale, vollständige und korrigierte Version.
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function homepage_hero_shortcode() {
    ob_start();
    ?>
    <section class="hu-hero-section">
        <div class="hu-hero-content">
            <h1 class="hu-hero-title">Ich entwickle digitale Strategien, die wirken.</h1>
            <p class="hu-hero-subtitle">Als Web-Entwickler und Stratege verbinde ich Technologie mit Marketing-Zielen – für messbaren Erfolg und nachhaltiges Wachstum.</p>
            <a href="#prozess" class="hu-hero-button">So arbeite ich</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_hero_shortcode', 'homepage_hero_shortcode' );

function homepage_partner_shortcode() {
    ob_start();
    ?>
    <section class="hu-partner-section">
        <h2 class="hu-partner-title">Technologien & Partner, denen ich vertraue</h2>
        <div class="hu-partner-logos">
            <img src="/wp-content/uploads/2024/03/woocommerce-logo.svg" alt="WooCommerce Logo" class="hu-partner-logo">
            <img src="/wp-content/uploads/2024/03/elementor-logo.svg" alt="Elementor Logo" class="hu-partner-logo">
            <img src="/wp-content/uploads/2024/03/google-analytics-logo.svg" alt="Google Analytics Logo" class="hu-partner-logo">
            <img src="/wp-content/uploads/2024/03/google-tag-manager-logo.svg" alt="Google Tag Manager Logo" class="hu-partner-logo">
            <img src="/wp-content/uploads/2024/03/meta-logo.svg" alt="Meta Logo" class="hu-partner-logo">
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_partner_shortcode', 'homepage_partner_shortcode' );

function homepage_about_shortcode() {
    ob_start();
    ?>
    <section class="hu-about-section" id="about">
        <div class="hu-about-image-wrapper">
            <img src="/wp-content/uploads/2024/03/hasim-uener-profilbild.jpeg" alt="Profilbild von Hasim Uener" class="hu-about-image">
        </div>
        <div class="hu-about-content">
            <h2 class="hu-about-title">Ganzheitlich. Strukturiert. Messbar.</h2>
            <p>Mein Name ist Hasim Üner. Ich bin dein technischer Partner, der die Brücke zwischen anspruchsvoller Webentwicklung und datengetriebenen Marketingstrategien schlägt. Mit über 10 Jahren Erfahrung im digitalen Raum sorge ich dafür, dass deine Online-Präsenz nicht nur gut aussieht, sondern vor allem eines tut: Ergebnisse liefern.</p>
            <p>Ob komplexe E-Commerce-Lösungen mit WordPress/WooCommerce, die Optimierung deiner Conversion-Rate oder die Implementierung eines präzisen Trackings – ich übersetze deine unternehmerischen Ziele in sauberen Code und nachhaltige digitale Prozesse.</p>
            <a href="/ueber-mich" class="hu-about-button">Mehr über mich</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_about_shortcode', 'homepage_about_shortcode' );

function homepage_services_shortcode() {
    ob_start();
    ?>
    <section class="hu-services-section" id="services">
        <h2 class="hu-section-title">Meine Kernkompetenzen</h2>
        <div class="hu-services-grid">
            <div class="hu-service-card">
                <h3 class="hu-service-title">Webentwicklung & E-Commerce</h3>
                <p class="hu-service-description">Konzeption und Umsetzung von responsiven Websites und Online-Shops mit Fokus auf Performance, Sicherheit und Skalierbarkeit. Spezialisiert auf WordPress und WooCommerce.</p>
            </div>
            <div class="hu-service-card">
                <h3 class="hu-service-title">Performance Marketing</h3>
                <p class="hu-service-description">Entwicklung und Management von datengetriebenen Kampagnen (Google Ads, Meta Ads), um qualifizierten Traffic zu generieren und deine Marketingziele effizient zu erreichen.</p>
            </div>
            <div class="hu-service-card">
                <h3 class="hu-service-title">Tracking & Analytics</h3>
                <p class="hu-service-description">Implementierung von serverseitigem Tracking und präzisen Analytics-Setups (GA4, GTM), um belastbare Daten als Grundlage für strategische Entscheidungen zu schaffen.</p>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_services_shortcode', 'homepage_services_shortcode' );

function homepage_cta_shortcode() {
    ob_start();
    ?>
    <section class="hu-cta-section" id="kontakt">
        <h2 class="hu-cta-title">Bereit für den nächsten Schritt?</h2>
        <p class="hu-cta-subtitle">Lass uns in einem kostenlosen Erstgespräch herausfinden, wie wir dein digitales Potenzial entfalten können.</p>
        <a href="/kontakt" class="hu-cta-button">Gespräch vereinbaren</a>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_cta_shortcode', 'homepage_cta_shortcode' );

function homepage_faq_shortcode() {
    ob_start();
    ?>
    <section class="hu-faq-section" id="faq">
        <h2 class="hu-section-title">Häufig gestellte Fragen</h2>
        <div class="hu-faq-accordion">
             <details>
                <summary>Welche Shopsysteme empfiehlst du für den E-Commerce-Einstieg?</summary>
                <p>Für Einsteiger und kleine bis mittlere Unternehmen sind Shopify und WordPress mit WooCommerce hervorragende Optionen. Shopify glänzt durch seine Einfachheit und den schnellen Start. WooCommerce bietet maximale Flexibilität und Anpassbarkeit, erfordert aber etwas mehr technisches Know-how.</p>
            </details>
            <details>
                <summary>Was sind die wichtigsten Faktoren für eine gute Conversion-Rate?</summary>
                <p>Eine gute Conversion-Rate hängt von vielen Faktoren ab: einer klaren und überzeugenden User-Experience (UX), schnellen Ladezeiten, vertrauensbildenden Elementen (Siegel, Bewertungen), einem einfachen Checkout-Prozess und qualitativ hochwertigen Produktbildern und -beschreibungen.</p>
            </details>
            <details>
                <summary>Wie wichtig ist SEO für einen Online-Shop wirklich?</summary>
                <p>SEO ist fundamental. Es ist der nachhaltigste Weg, qualifizierten Traffic zu generieren, also Besucher, die aktiv nach deinen Produkten suchen. Während bezahlte Anzeigen sofortige Ergebnisse liefern können, baut SEO langfristiges Vertrauen und Sichtbarkeit auf, was die Kundenakquisekosten erheblich senkt.</p>
            </details>
            <details>
                <summary>Bietest du auch langfristige Betreuung und Wartung an?</summary>
                <p>Ja, absolut. Der digitale Markt verändert sich ständig. Ich biete Service-Pakete für regelmäßige technische Wartung, Sicherheitsupdates und kontinuierliche Optimierung (z.B. A/B-Testing, Performance-Monitoring), um sicherzustellen, dass dein Projekt langfristig erfolgreich bleibt.</p>
            </details>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'homepage_faq_shortcode', 'homepage_faq_shortcode' );