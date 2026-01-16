<?php
/**
 * Template Name: Agentur Service (Hannover)
 * Description: SEO-Optimierte Landingpage für 'WordPress Agentur Hannover'
 */

get_header(); 
?>

<!-- CSS laden: Version via Zeitstempel verhindert Caching-Probleme -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/agentur.css?v=<?php echo time(); ?>">

<div class="wp-agentur-page">
    
    <!-- Navigation -->
    <nav class="wp-toc-nav" id="wpTocNav" aria-label="Seiten-Navigation">
      <h4>Inhalt</h4>
      <ul>
        <li><a href="#hero" class="wp-toc-link">Start</a></li>
        <li><a href="#problem" class="wp-toc-link">Diagnose</a></li>
        <li><a href="#partner" class="wp-toc-link">Ihr Experte</a></li>
        <li><a href="#system" class="wp-toc-link">System</a></li>
        <li><a href="#erfolg" class="wp-toc-link">Ergebnisse</a></li>
        <li><a href="#faq" class="wp-toc-link">FAQ</a></li>
        <li><a href="#start" class="wp-toc-link">Kontakt</a></li>
      </ul>
    </nav>

    <!-- Hero Section -->
    <section class="wp-section" id="hero">
      <div class="wp-container">
        <div class="wp-hero">
          <div>
            <span class="wp-hero-kicker">Performance Engineering aus Hannover</span>
            <h1 class="wp-hero-title">WordPress Agentur Hannover: <br><span>Wir bauen Ihren Vertriebsmotor.</span></h1>
            <p class="wp-hero-subtitle">
                Schluss mit Websites, die nur Geld kosten. Als Ihr technischer Partner in der Region Hannover verwandle ich Ihre Unternehmensseite in einen messbaren Umsatz-Kanal – datengetrieben, schnell und ohne "Agentur-Bla-Bla".
            </p>
            <div class="wp-btn-wrapper">
                <a class="wp-btn wp-btn-primary" href="https://cal.com/hasim/30min" target="_blank" rel="noopener noreferrer">
                  Kostenlose Analyse anfordern
                </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Problem Section -->
    <section class="wp-section" id="problem">
      <div class="wp-container">
        <div class="wp-section-title">
          <span class="wp-badge">Status Quo</span>
          <h2 class="wp-section-h2">Warum lokale Unternehmen digital scheitern</h2>
          <p class="wp-section-p">Viele Firmen in Hannover und Niedersachsen haben schöne Websites, aber keine Anfragen. Das Problem liegt selten am Design, sondern an der Architektur.</p>
        </div>
        <div class="wp-cards">
          <div class="wp-card">
            <svg class="wp-card-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.72"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.72-1.72"></path></svg>
            <h3>Symptom 1: Unsichtbar in Hannover</h3>
            <p>Ihre Konkurrenz rankt vor Ihnen. Ohne technisches SEO und Core Web Vitals Optimierung verlieren Sie den Kampf um die lokale Sichtbarkeit bei Google.</p>
          </div>
          <div class="wp-card">
            <svg class="wp-card-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
            <h3>Symptom 2: Daten-Blindflug</h3>
            <p>Sie investieren in Ads, wissen aber nicht, was funktioniert. Ohne sauberes Server-Tracking verbrennen Sie Budget.</p>
          </div>
          <div class="wp-card">
            <svg class="wp-card-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
            <h3>Die Lösung: Revenue Engineering</h3>
            <p>Ich programmiere keine "Seiten", ich implementiere Vertriebssysteme. Maßgeschneidert für den deutschen Mittelstand.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Partner Section -->
    <section class="wp-section" id="partner">
      <div class="wp-container">
        <div class="wp-section-title">
          <span class="wp-badge">Greifbar statt Anonym</span>
          <h2 class="wp-section-h2">Hasim Üner: Ihr Experte vor Ort</h2>
        </div>
        <div class="wp-partner-grid">
          <div class="wp-partner-image-wrapper">
            <!-- Platzhalterbild: Hier später dein echtes Foto prüfen -->
            <img src="https://hasimuener.de/wp-content/uploads/2025/09/Wordpress_Bild_Hero.webp" alt="Hasim Üner - WordPress Agentur Hannover" loading="lazy" width="400" height="400">
          </div>
          <div class="wp-partner-content">
            <h3>Persönlich. Direkt. Verbindlich.</h3>
            <p><strong>Warum eine Agentur aus Hannover?</strong></p>
            <p>Weil digitale Projekte Vertrauenssache sind. Mit mir haben Sie keinen anonymen Support-Chat, sondern einen strategischen Partner, dem Sie in die Augen schauen können.</p>
            <p>Ich kombiniere 15 Jahre Vertriebserfahrung mit High-End WordPress-Entwicklung. Mein Anspruch: Ihre Investition muss sich für Sie lohnen – messbar in neuen Leads, nicht nur in "schönem Design".</p>
          </div>
        </div>
      </div>
    </section>

    <!-- System Section -->
    <section class="wp-section" id="system">
      <div class="wp-container">
        <div class="wp-section-title">
          <span class="wp-badge">Die Methodik</span>
          <h2 class="wp-section-h2">Das 3-Phasen Growth Protocol</h2>
          <p class="wp-section-p">Kein Zufall, sondern ein replizierbarer Prozess für B2B-Wachstum.</p>
        </div>
        <div class="wp-process">
          <div class="wp-step">
            <div class="wp-step-num">1</div>
            <h3>Das Fundament (Tech-Audit)</h3>
            <p>Wir reparieren, was kaputt ist. Ladezeiten unter 1s, saubere Code-Basis, Sicherheits-Härtung. Ohne stabile Basis keine Skalierung.</p>
          </div>
          <div class="wp-step">
            <div class="wp-step-num">2</div>
            <h3>Die Intelligenz (Data Layer)</h3>
            <p>Implementierung von Server-Side GTM und CRM-Anbindung. Wir machen sichtbar, woher Ihre wertvollsten Kunden kommen.</p>
          </div>
          <div class="wp-step highlight-step">
            <div class="wp-step-num highlight-num">3</div>
            <h3 class="text-gold">Die Evolution (Retainer)</h3>
            <p>Kontinuierliche Conversion-Optimierung (CRO) über mein transparentes Punkte-System. Wir testen, messen und verbessern monatlich.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Success Section -->
    <section class="wp-section" id="erfolg">
      <div class="wp-container">
        <div class="wp-section-title">
          <span class="wp-badge">Proof of Concept</span>
          <h2 class="wp-section-h2">Case Study: E3 New Energy</h2>
        </div>
        <div class="wp-success-card">
          <div class="wp-success-header">
            <div>
              <h3 class="wp-success-title">Skalierung eines B2B-Solar-Anbieters</h3>
              <p class="wp-success-subtitle">Branche: Erneuerbare Energien · Fokus: Lead-Qualität</p>
            </div>
            <div><span class="wp-badge" style="background:rgba(16, 185, 129, 0.1); color:#10b981; border:1px solid rgba(16, 185, 129, 0.2);">Verifiziert</span></div>
          </div>
          <p class="wp-success-text">
            <strong>Die Ausgangslage:</strong> Teure Google Ads Klicks (120€/Lead), hohe Streuverluste, instabile WordPress-Seite.<br>
            <strong>Die Maßnahme:</strong> Komplettes Re-Platforming, Landingpage-High-Speed-Setup, Server-Tracking.
          </p>
          <div class="wp-metrics">
            <div class="wp-metric">
                <span class="wp-metric-value">1.750+</span>
                <span class="wp-metric-label">B2B Leads generiert</span>
            </div>
            <div class="wp-metric">
                <span class="wp-metric-value text-gold">-79%</span>
                <span class="wp-metric-label">Kosten pro Anfrage (CPL)</span>
            </div>
            <div class="wp-metric">
                <span class="wp-metric-value">34x</span>
                <span class="wp-metric-label">ROAS (Return on Ad Spend)</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="wp-section" id="faq">
      <div class="wp-container">
        <div class="wp-section-title">
          <h2 class="wp-section-h2">Häufige Fragen (FAQ)</h2>
        </div>
        <div class="wp-faq">
          <details class="wp-faq-item" open>
            <summary>Arbeiten wir mit Festpreisen oder Stunden?</summary>
            <div class="wp-faq-content"><p>Für Projekte: Festpreise basierend auf Scope. Für die laufende Betreuung: Mein transparentes Punkte-System. Sie kaufen Ergebnisse (z.B. "Landingpage = 20 Punkte"), keine Zeit. Das gibt Ihnen 100% Planungssicherheit.</p></div>
          </details>
          <details class="wp-faq-item">
            <summary>Sind persönliche Termine in Hannover möglich?</summary>
            <div class="wp-faq-content"><p>Ja, absolut. Für Strategie-Workshops oder den Kick-Off komme ich gerne zu Ihnen ins Unternehmen (Region Hannover) oder wir treffen uns zentral. Persönlicher Kontakt schafft bessere Ergebnisse.</p></div>
          </details>
          <details class="wp-faq-item">
            <summary>Warum sind Sie teurer als mein Neffe?</summary>
            <div class="wp-faq-content"><p>Weil Ihr Neffe Websites baut, ich baue Umsatz-Systeme. Wenn eine 5.000€ Investition Ihnen 50.000€ Umsatz bringt, ist sie nicht teuer, sondern profitabel.</p></div>
          </details>
          <details class="wp-faq-item">
            <summary>Übernehmen Sie auch bestehende "Chaos-Projekte"?</summary>
            <div class="wp-faq-content"><p>Ja, aber nur nach einem Audit. Ich muss erst prüfen, ob das Fundament zu retten ist oder ob ein Neubau wirtschaftlicher ist. Ehrlichkeit steht hier an erster Stelle.</p></div>
          </details>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="wp-section" id="start">
      <div class="wp-container text-center">
        <div class="wp-section-title">
          <span class="wp-badge">Nächster Schritt</span>
          <h2 class="wp-section-h2">Genug Theorie. Lassen Sie uns Ihren <br>Status Quo prüfen.</h2>
          <p class="wp-section-p">Kein Sales-Pitch. Eine technische Analyse Ihrer Potenziale. 30 Minuten.</p>
        </div>
        
        <div style="margin-top: 2rem;">
          <a class="wp-btn wp-btn-primary" href="https://cal.com/hasim/30min" target="_blank" rel="noopener noreferrer">
             Kostenloses Audit buchen
          </a>
          <p class="cta-subtext" style="margin-top:1rem;">Ideal für B2B-Unternehmen in Hannover & Umgebung.</p>
        </div>
      </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // FAQ Interaktion
      document.querySelectorAll('.wp-faq-item summary').forEach(s => {
        s.addEventListener('click', e => {
          const p = s.parentElement;
          if (p.hasAttribute('open')) { e.preventDefault(); p.removeAttribute('open'); }
          else { document.querySelectorAll('.wp-faq-item[open]').forEach(o => o.removeAttribute('open')); }
        });
      });

      // Sticky Navigation Logic
      const nav = document.getElementById('wpTocNav');
      if (nav && window.innerWidth > 1024) {
        const hero = document.getElementById('hero');
        if(hero) {
            window.addEventListener('scroll', () => {
                // Nav anzeigen, wenn 50% der Hero-Section vorbei sind
                if(window.scrollY > hero.offsetHeight / 2) nav.classList.remove('wp-hidden');
                else nav.classList.add('wp-hidden');
            });
        }
      }
    });
</script>

<?php get_footer(); ?>