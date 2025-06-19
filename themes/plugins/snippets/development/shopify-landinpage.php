/*
  Template Name: Shopify Agentur Hannover – Champions‑League Landingpage (Static Content)
  Description: Vollständige One‑File‑Landingpage inkl. CSS & JS – fertig befüllt mit optimierten SEO‑/Conversion‑Texten.
  Author: Hasim
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<style>
:root{--primary-900:#0a0a0a;--primary-700:#27272a;--primary-200:#d4d4d8;--primary-50:#fafafa;--accent-600:#7ba938;--accent-500:#96bf48;--accent-400:#a6d055;--glass-bg:rgba(39,39,42,.25);--glass-border:rgba(82,82,91,.15);--glass-blur:blur(12px);--radius-lg:16px;--radius-full:9999px;--font:'Open Sans',sans-serif;--tr:250ms ease-out}
*{margin:0;padding:0;box-sizing:border-box}
body{background:var(--primary-900);color:var(--primary-50);font-family:var(--font);line-height:1.6;-webkit-font-smoothing:antialiased}
h1,h2,h3,h4{font-family:var(--font);font-weight:700;color:var(--primary-50)}
.section{padding:4rem 0}
.container{max-width:1280px;margin:0 auto;padding:0 1rem}
.section-title{text-align:center;font-size:clamp(2rem,5vw,3rem);margin-bottom:3rem}
.card-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:2rem}
.card{background:var(--glass-bg);border:1px solid var(--glass-border);border-radius:var(--radius-lg);padding:2rem;backdrop-filter:var(--glass-blur);transition:transform var(--tr)}
.card:hover{transform:translateY(-4px)}
/* HERO */
.hero{display:flex;align-items:center;min-height:100vh;padding:6rem 0}
.hero-grid{display:grid;gap:3rem}
@media(min-width:768px){.hero-grid{grid-template-columns:1fr 1fr;align-items:center}}
.hero-badge{display:inline-block;background:var(--accent-500);color:var(--primary-900);font-weight:600;padding:.35rem .9rem;border-radius:var(--radius-full);font-size:.875rem;margin-bottom:1rem}
.hero-title{font-size:clamp(2.5rem,6vw,4rem);background:linear-gradient(135deg,var(--primary-50)0%,var(--accent-400)100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:1rem}
.hero-lead{font-size:1.125rem;color:var(--primary-200);margin-bottom:1.2rem;max-width:500px}
.btn{display:inline-block;background:var(--accent-500);color:var(--primary-900);font-weight:600;padding:.75rem 1.5rem;border-radius:var(--radius-full);text-decoration:none;transition:background var(--tr)}
.btn:hover{background:var(--accent-400)}
.hero-image img{width:100%;border-radius:var(--radius-lg);box-shadow:0 8px 24px rgba(0,0,0,.4)}
/* PROCESS */
.process-line{position:absolute;left:calc(50% - 1px);top:0;width:2px;height:100%;background:var(--glass-border)}
.step{display:grid;gap:1.5rem;align-items:center;margin-bottom:2rem}
@media(min-width:768px){.step{grid-template-columns:1fr auto 1fr}}
.step-num{width:3rem;height:3rem;background:linear-gradient(135deg,var(--accent-500)0%,var(--accent-600)100%);color:var(--primary-900);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.125rem;margin:0 auto}
/* FAQ */
.faq-item{border-bottom:1px solid var(--glass-border);margin-bottom:1rem}
.faq-q{width:100%;text-align:left;background:none;border:none;color:var(--primary-50);font-weight:600;font-size:1.125rem;padding:1rem 0;display:flex;justify-content:space-between;align-items:center;cursor:pointer}
.faq-a{max-height:0;overflow:hidden;transition:max-height var(--tr);color:var(--primary-200);padding-right:1rem}
.faq-item.open .faq-a{max-height:300px;padding-bottom:1rem}
/* CTA */
.cta{background:linear-gradient(135deg,var(--primary-700)0%,var(--primary-900)100%);border-radius:var(--radius-lg);padding:4rem 2rem;text-align:center}
.cta-title{font-size:clamp(2rem,5vw,2.5rem);margin-bottom:1rem}
</style>

<a href="#main-content" class="skip-link" style="position:absolute;top:-40px;left:6px;background:var(--accent-500);color:var(--primary-900);padding:8px;border-radius:6px;font-weight:600;transition:top .15s">Zum Hauptinhalt springen</a>
<div class="shopify-hannover">

<!-- HERO -->
<section class="hero" aria-labelledby="hero-title">
 <div class="container hero-grid">
  <div>
   <span class="hero-badge">Lokale Shopify‑Experten</span>
   <h1 id="hero-title" class="hero-title">Shopify Agentur Hannover: Wir bauen Shops, die verkaufen</h1>
   <p class="hero-lead">Strategie • Entwicklung • Marketing – alles aus einer Hand.</p>
   <p class="hero-lead">Wir kombinieren sauberes Liquid‑Coding mit daten‑getriebener Conversion‑Optimierung – damit dein Shop nicht nur schön aussieht, sondern profitabel performt.</p>
   <a class="btn" href="#kontakt">Kostenlose Erstberatung sichern</a>
  </div>
  <div class="hero-image">
   <img src="https://source.unsplash.com/800x600?ecommerce,shopify" alt="Illustration Shopify Agentur Hannover" loading="eager" decoding="async" />
  </div>
 </div>
</section>

<!-- WHY SECTION -->
<section id="warum" class="section" aria-labelledby="why-title">
 <div class="container">
  <h2 id="why-title" class="section-title">Warum wir?</h2>
  <div class="card-grid">
   <div class="card"><h4>Shopify First. Keine Kompromisse.</h4><p>Spezialisiert auf Shopify – volle Tiefen­expertise statt Bauchladen.</p></div>
   <div class="card"><h4>Lokaler Partner, kurze Wege.</h4><p>Persönliche Betreuung aus Hannover, schnelle Abstimmung, kein Ticket‑Ping‑Pong.</p></div>
   <div class="card"><h4>Marketing‑Power inklusive.</h4><p>SEO, Tracking & Ads schon im Setup gedacht – messbare Ergebnisse ab Tag 1.</p></div>
   <div class="card"><h4>Performance by Code.</h4><p>Eigene Themes, Ladezeiten &lt; 1 s – Google & Kunden lieben Speed.</p></div>
  </div>
 </div>
</section>

<!-- SERVICES SECTION -->
<section id="leistungen" class="section" aria-labelledby="services-title">
 <div class="container">
  <h2 id="services-title" class="section-title">Unsere Leistungen</h2>
  <div class="card-grid">
   <div class="card"><h4>Shopify‑Strategie</h4><p>Budget & Zeit wirken exakt dort, wo sie Umsatz bringen.</p></div>
   <div class="card"><h4>Individuelles Theme‑Development</h4><p>Maß­geschneiderte Liquid‑Themes statt Baukasten‑Limitierung.</p></div>
   <div class="card"><h4>Shopify SEO</h4><p>Struktur, Content & Pagespeed für Top‑Rankings.</p></div>
   <div class="card"><h4>Conversion‑Optimierung</h4><p>A/B‑Tests & UX‑Tweaks für steigende CR.</p></div>
   <div class="card"><h4>DSGVO‑konformes Tracking</h4><p>Server‑Side‑Tagging & Consent Mode – verlässliche Daten.</p></div>
   <div class="card"><h4>Shop‑Migration</h4><p>Sicherer Umzug von WooCommerce, Shopware & Co. inkl. Redirect‑Plan.</p></div>
  </div>
 </div>
</section>

<!-- PROCESS SECTION -->
<section id="prozess" class="section" aria-labelledby="process-title" style="position:relative;">
 <div class="container">
  <span class="process-line" aria-hidden="true"></span>
  <h2 id="process-title" class="section-title">Unser 4‑Schritte‑Prozess</h2>
  <div class="step"><div class="step-num">1</div><div><h4>Kennenlernen & Ziele</h4><p>30‑min Kick‑off‑Call: KPIs, Zielgruppe & Shop‑Scope definieren.</p></div></div>
  <div class="step"><div class="step-num">2</div><div><h4>Konzept & Design</h4><p>Wireframes + UI mit Fokus auf UX, Conversion & CI.</p></div></div>
  <div class="step"><div class="step-num">3</div><div><h4>Entwicklung & Go‑Live</h4><p>Agiles Liquid‑Coding, QA‑Tests, SEO‑Checks – release‑fertig.</p></div></div>
  <div class="step"><div class="step-num">4</div><div><h4>Wachstum & Support</h4><p>Laufende CRO, Ads‑Optimierung & Feature‑Roll‑outs.</p></div></div>
 </div>
</section>

<!-- FAQ SECTION -->
<section id="faq" class="section" aria-labelledby="faq-title">
 <div class="container">
  <h2 id="faq-title" class="section-title">Häufige Fragen</h2>
  <div class="faq-item"><button class="faq-q" aria-expanded="false"><span>Was kostet eine Shopify‑Agentur in Hannover?</span><span>+</span></button><div class="faq-a"><p>Projekte starten ab 3 900 € – abhängig von Funktions‑ und Design‑Umfang.</p></div></div>
  <div class="faq-item"><button class="faq-q" aria-expanded="false"><span>Wie lange dauert die Entwicklung?</span><span>+</span></button><div class="faq-a"><p>Zwischen 3–8 Wochen, je nach Komplexität und Feedback‑Loops.</p></div></div>
  <div class="faq-item"><button class="faq-q" aria-expanded="false"><span>Könnt ihr bestehende Shops optimieren?</span><span>+</span></button><div class="faq-a"><p>Ja – Redesign, Speed‑Boost, SEO‑Fixes und Conversion‑Tests übernehmen wir gern.</p></div></div>
  <div class="faq-item"><button class="faq-q" aria-expanded="false"><span>Arbeitet ihr auch remote?</span><span>+</span></button><div class="faq-a"><p>Klar – Kick‑off gern vor Ort in Hannover, danach digital & transparent.</p></div></div>
  <div class="faq-item"><button class="faq-q" aria-expanded="false"><span>Gibt es Förderprogramme?</span><span>+</span></button><div class="faq-a"><p>Wir prüfen gemeinsam Digitalbonus Niedersachsen & andere Förder­möglichkeiten.</p></div></div>
 </div>
</section>

<!-- CTA SECTION -->
<section id="kontakt" class="section" aria-labelledby="cta-title">
 <div class="container">
  <div class="cta">
   <h2 id="cta-title" class="cta-title">Lass uns deinen Shopify‑Champion bauen</h2>
   <p class="hero-lead" style="max-width:600px;margin-left:auto;margin-right:auto;">Buche jetzt dein kostenfreies Strategie‑Gespräch – wir zeigen dir live, wo dein Umsatz‑Potenzial steckt.</p>
   <a class="btn" href="/kontakt">Termin vereinbaren</a>
  </div>
 </div>
</section>

</div>

<script>
(function(){const items=document.querySelectorAll('.faq-item');items.forEach(it=>{const btn=it.querySelector('.faq-q');btn.addEventListener('click',()=>{const open=it.classList.toggle('open');btn.setAttribute('aria-expanded',open);items.forEach(o=>{if(o!==it)o.classList.remove('open');});});});})();
</script>