<?php
/**
 * Das Template zur Anzeige von Autoren-Archivseiten.
 * Version 4.1: Alles in einer Datei (PHP, CSS, HTML).
 * Gekapselt und sicher.
 */

// Lädt den Header deiner Webseite (Menü, Logo etc.)
get_header(); 
?>

<main id="main" class="site-main">

    <style>
        /* Blendet den Standard-Inhalt der Autorenseite komplett aus */
        .ct-container > section > .hero-section,
        .ct-container > section > .entries {
            display: none !important;
        }
        
        .author-profile-container {
            --ap-bg: #0D0D0D; 
            --ap-card-bg: #1A1A1A;
            --ap-border: rgba(255, 255, 255, 0.08);
            --ap-text: #FAFAFA;
            --ap-text-muted: #A1A1AA;
            --ap-accent: #FF8A00;
            --ap-radius: 16px;
            --ap-transition: all 0.25s ease-in-out;
            
            max-width: 960px;
            margin: 0 auto;
            padding: 3.5rem 1.5rem;
        }
        .ap-hero {
            display: grid; grid-template-columns: auto 1fr; gap: 2.5rem; align-items: center; text-align: left;
            padding-bottom: 3rem; margin-bottom: 3rem; border-bottom: 1px solid var(--ap-border);
        }
        .ap-hero__img {
            width: 170px; height: 170px; border-radius: 50%; object-fit: cover;
            box-shadow: 0 0 0 5px var(--ap-border);
        }
        .ap-hero__title {
            font-size: clamp(2.5rem, 6vw, 3.2rem); margin: 0; line-height: 1.1; font-weight: 800;
        }
        .ap-hero__tagline {
            font-size: 1.25rem; color: var(--ap-text-muted); margin-top: 1rem; max-width: 65ch; line-height: 1.6;
        }
        .ap-content { display: grid; grid-template-columns: 2fr 1fr; gap: 3.5rem; }
        .ap-mission h2, .ap-skills h3, .ap-featured-posts h2 {
            font-size: 1.8rem; margin-top: 0; padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--ap-border); margin-bottom: 1.8rem;
        }
        .ap-mission p { color: var(--ap-text-muted); line-height: 1.8; font-size: 1.1rem; margin-bottom: 1.6em; }
        .ap-skills { background-color: transparent; padding: 0; border: none; }
        .ap-skills ul { margin: 0; padding: 0; list-style: none; }
        .ap-skills li { 
            margin-bottom: 1rem; color: var(--ap-text-muted); font-size: 1rem;
            padding-left: 1.8rem; position: relative;
        }
        .ap-skills li::before { content: '→'; position: absolute; left: 0; color: var(--ap-accent); font-weight: bold; }
        .ap-featured-posts { padding-top: 3.5rem; margin-top: 3.5rem; border-top: 1px solid var(--ap-border); }
        .ap-featured-posts h2 { text-align: left; }
        .ap-post-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.8rem; }
        .ap-post-card {
            background-color: var(--ap-card-bg); border-radius: var(--ap-radius); text-decoration: none;
            display: flex; flex-direction: column; overflow: hidden; border: 1px solid var(--ap-card-bg);
            transition: var(--ap-transition);
        }
        .ap-post-card:hover { transform: translateY(-5px); border-color: var(--ap-accent); box-shadow: 0 8px 20px rgba(0,0,0,0.2); }
        .ap-post-card__image { width: 100%; height: 180px; object-fit: cover; }
        .ap-post-card__content { padding: 1.5rem; flex-grow: 1; }
        .ap-post-card__title { color: var(--ap-text); font-size: 1.1rem; margin: 0; line-height: 1.4; }
        
        @media (max-width: 920px) { .ap-content { grid-template-columns: 1fr; } .ap-skills { margin-top: 3rem; } }
        @media (max-width: 600px) {
            .author-profile-container { padding: 2.5rem 1rem; }
            .ap-hero { grid-template-columns: 1fr; text-align: center; }
            .ap-hero__img { margin: 0 auto; width: 140px; height: 140px;}
            .ap-post-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="author-profile-container">
        <section class="ap-hero">
            <img src="https://hasimuener.de/wp-content/uploads/2025/09/Hasim-Uener-Profil-Autorenseite.webp" alt="Porträt von Hasim Üner" class="ap-hero__img">
            <div>
                <h1 class="ap-hero__title">Über den Autor</h1>
                <p class="ap-hero__tagline">Einblicke eines Entwicklers und Medienwissenschaftlers, für den die Klarheit eines Begriffs der Anfang jedes erfolgreichen Prozesses ist.</p>
            </div>
        </section>
        <section class="ap-content">
            <div class="ap-mission">
                <h2>Die Philosophie hinter diesem Blog</h2>
                <p><strong>"Das Menschliche erklären"</strong> – das ist der Kern. Technologie ist ein Werkzeug, aber sie wirkt erst, wenn wir verstehen, wie sie unser Denken, Fühlen und Handeln beeinflusst. Dieser Blog ist mein Versuch, die Brücke zwischen dem Code und dem Kontext, zwischen Daten und Deutung zu schlagen.</p>
                <p>Es mag abgehoben klingen, aber ich bin überzeugt: **Der Schlüssel für gute Prozesse liegt im richtigen Verständnis der Begriffe.** Ein "Lead" ist nicht nur eine Zahl, sondern ein Mensch mit einer Erwartung. "Performance" ist nicht nur Ladezeit, sondern gefühlte Geschwindigkeit. Indem wir unsere Sprache schärfen, schärfen wir unsere Strategie.</p>
            </div>
            <aside class="ap-skills">
                <h3>Themenschwerpunkte</h3>
                <ul>
                    <li>Web-Architektur & Performance</li>
                    <li>Daten, Tracking & CRO</li>
                    <li>Wachstumsstrategien (SEO/Ads)</li>
                    <li>Digitale Haltung & Ethik</li>
                </ul>
            </aside>
        </section>
        <section class="ap-featured-posts">
            <h2>Aktuelle Analysen & Impulse</h2>
            <div class="ap-post-grid">
                <a href="https://hasimuener.de/design-ist-mehr-als-aesthetik/" class="ap-post-card">
                    <img class="ap-post-card__image" src="https://hasimuener.de/wp-content/uploads/2025/09/Design2-768x768.webp" alt="Design ist mehr als Ästhetik">
                    <div class="ap-post-card__content">
                        <h3 class="ap-post-card__title">Design ist mehr als Ästhetik – Warum Gestaltung Erwartungen, Bedeutung und Verhalten formt</h3>
                    </div>
                </a>
                <a href="https://hasimuener.de/ihr-digitales-aussenministerium-datenhoheit-mit-server-side-gtm/" class="ap-post-card">
                    <img class="ap-post-card__image" src="https://hasimuener.de/wp-content/uploads/2025/09/Ihr-digitales-Aussenministerium-So-sichern-Sie-Datenhoheit-und-Tracking-Praezision-mit-Server-Side-GTM-in-Deutschland_Hero-768x768.webp" alt="Datenhoheit mit Server-Side GTM">
                    <div class="ap-post-card__content">
                        <h3 class="ap-post-card__title">Ihr digitales Außenministerium: Datenhoheit mit Server-Side GTM</h3>
                    </div>
                </a>
                <a href="https://hasimuener.de/core-web-vitals-wachstum-seo-und-roas/" class="ap-post-card">
                    <img class="ap-post-card__image" src="https://hasimuener.de/wp-content/uploads/2025/09/core-web-vitals_hero-768x768.webp" alt="Performance ist Profit">
                    <div class="ap-post-card__content">
                        <h3 class="ap-post-card__title">Performance ist Profit: Warum Core Web Vitals Wachstum, SEO und ROAS treiben</h3>
                    </div>
                </a>
                 <a href="https://hasimuener.de/warum-ihr-digitales-oekosystem-eine-seele-braucht/" class="ap-post-card">
                    <img class="ap-post-card__image" src="https://hasimuener.de/wp-content/uploads/2025/09/Hasim_Uener_Nachdenklich-768x768.webp" alt="Jenseits der Metriken">
                    <div class="ap-post-card__content">
                        <h3 class="ap-post-card__title">Jenseits der Metriken: Warum Ihr digitales Ökosystem eine Seele braucht</h3>
                    </div>
                </a>
            </div>
        </section>
    </div>

</main><?php
// Lädt den Footer deiner Webseite
get_footer();
?>