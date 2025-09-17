<?php
/**
 * Die Template-Datei für die Startseite.
 */

// Lade den Header (wichtig für <head>, <body> und Menüs)
get_header();
?>

<nav id="toc-nav" aria-label="Seiten-Navigation">
  <h4>Navigation</h4>
  <ul>
    <li><a href="#partner">Ihr Partner</a></li>
    <li><a href="#erfolge">Ergebnisse</a></li>
    <li><a href="#prozess">Prozess</a></li>
    <li><a href="#faq">FAQ</a></li>
    <li><a href="#blog">Blog</a></li>
    <li><a href="#cta">Kontakt</a></li>
  </ul>
</nav>

<header class="hero-section" role="banner" id="start">
  <div class="container">
    <div class="section-title">
      <span class="badge">Hasim Üner – Ihr Growth Partner</span>
      <h1>Der Test wa Efolgreich jetzt waaairklich.</h1>
      <p class="sub">Sie haben das Ziel. Gemeinsam finden wir den passenden Weg und setzen ihn technisch exzellent um.</p>
    </div>
    <div class="switch-grid" aria-label="Wählen Sie Ihren strategischen Pfad">
      <div class="switch-card">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" x2="21" y1="6" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        <h2>E-Commerce & Shopify</h2>
        <p>Für Online-Shops, die nicht nur gut aussehen, sondern vor allem verkaufen und durch Daten profitabel wachsen sollen.</p>
        <a href="/shopify-agentur-hannover/" class="btn btn-primary">Lösungen für Shopify</a>
      </div>
      <div class="switch-card">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
        <h2>Website & WordPress</h2>
        <p>Für Dienstleister & B2B-Unternehmen, deren Website als überzeugende Lead-Quelle arbeiten und die Marke optimal repräsentieren soll.</p>
        <a href="/wordpress-agentur-hannover/" class="btn btn-ghost">Lösungen für WordPress</a>
      </div>
    </div>
    <div class="hero-stats" role="group" aria-label="Erfolgsstatistiken">
      <div class="stat"><div class="num" data-target="34">0</div><div class="label">Max ROAS</div></div>
      <div class="stat"><div class="num" data-target="2500">0</div><div class="label">Leads</div></div>
      <div class="stat"><div class="num" data-target="83">0</div><div class="label">% CPL ↓</div></div>
      <div class="stat"><div class="num" data-target="500">0</div><div class="label">SEO ↑ (%)</div></div>
    </div>
  </div>
</header>

<main id="main-content" role="main">
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

  <section id="erfolge" aria-labelledby="cases-heading" style="background:var(--glass-bg); border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border);">
    <div class="container">
      <div class="section-title">
        <span class="badge">Ergebnisse</span>
        <h2 id="cases-heading">Wachstum, das man messen kann.</h2>
        <p>Hier sehen Sie konkrete Resultate aus realen Projekten. Sie zeigen, wie eine integrierte Strategie den entscheidenden Unterschied macht.</p>
      </div>
      <article class="success-card">
        <div style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;align-items:center">
          <div>
            <h3>E3 New Energy — B2C Leadgenerierung</h3>
            <p class="muted">Erneuerbare Energien · Tech-Marketing-Integration · 8 Monate</p>
          </div>
          <span class="badge">Erneuerbare Energie</span>
        </div>
        <div class="metrics">
          <div class="metric"><div style="color:var(--success);font-weight:800;font-size:1.4rem;">1.750+</div><div class="muted">Qualifizierte Leads</div></div>
          <div class="metric"><div style="color:var(--success)">120€ → 25€</div><div class="muted">CPL-Reduktion (-83%)</div></div>
          <div class="metric"><div style="color:var(--gold);font-weight:800;font-size:1.4rem;">28–34×</div><div class="muted">Konstanter ROAS</div></div>
          <div class="metric"><div style="color:var(--success)">+500%</div><div class="muted">Organischer Traffic</div></div>
        </div>
      </article>
      <article class="success-card">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
          <div>
            <h3>DOMDAR — E-Commerce Transformation</h3>
            <p class="muted">Sustainable E-Commerce · Shopify Plus · UX/CRO · 6 Monate</p>
          </div>
          <span class="badge">E-Commerce</span>
        </div>
        <div class="metrics">
          <div class="metric"><div style="color:var(--success)">+270%</div><div class="muted">Conversion Rate</div></div>
          <div class="metric"><div style="color:var(--gold)">22€ → 120€</div><div class="muted">Ø Bestellwert</div></div>
          <div class="metric"><div style="color:var(--success)">70€ → 26€</div><div class="muted">Kundenakquisekosten</div></div>
          <div class="metric"><div style="color:var(--success)">-62%</div><div class="muted">Warenkorbabbrüche</div></div>
        </div>
      </article>
      <div style="text-align:center; margin-top: 2rem;">
        <a href="/case-studies/" class="btn btn-ghost">Weitere Fallstudien ansehen</a>
      </div>
    </div>
  </section>

  <section id="prozess" aria-labelledby="process-heading">
    <div class="container">
      <div class="section-title">
        <span class="badge">Der Prozess</span>
        <h2 id="process-heading">Unser gemeinsamer Weg zum Erfolg</h2>
        <p>Ein transparenter und bewährter 4-Schritte-Fahrplan — von der ersten Analyse bis zur nachhaltigen Skalierung.</p>
      </div>
      <div class="process">
        <article class="step"><div class="num">1</div><h3>Analyse & Strategie</h3><p class="muted">Wir starten mit einem Deep-Dive: Aktueller Status, Ziele, Quick-Wins. Daraus entsteht eine klare, umsetzbare Roadmap.</p></article>
        <article class="step"><div class="num">2</div><h3>Konzeption & Design</h3><p class="muted">Auf Basis der Strategie entwickeln wir ein conversion-orientiertes Design und eine technische Architektur, die auf Ihre Ziele einzahlt.</p></article>
        <article class="step"><div class="num">3</div><h3>Entwicklung & Umsetzung</h3><p class="muted">Die Umsetzung erfolgt in agilen Sprints. Sie erhalten regelmäßig Updates und können den Fortschritt live mitverfolgen.</p></article>
        <article class="step"><div class="num">4</div><h3>Optimierung & Skalierung</h3><p class="muted">Nach dem Launch beginnt die wichtigste Phase: Wir messen, testen und optimieren kontinuierlich, um Ihr Wachstum zu maximieren.</p></article>
      </div>
    </div>
  </section>

  <section id="faq" aria-labelledby="faq-heading">
    <div class="container">
      <div class="section-title">
        <span class="badge">FAQ</span>
        <h2 id="faq-heading">Häufig gestellte Fragen</h2>
        <p>Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.</p>
      </div>
      <div class="faq">
        <details><summary>Wie schnell kann unser Projekt starten?</summary><div class="faq-content">Nach unserem Erstgespräch meist innerhalb von 3–5 Werktagen. Einfache WordPress-Sites sind oft in 2–3 Wochen live, komplexere E-Commerce Projekte in 4–8 Wochen.</div></details>
        <details><summary>Was kostet eine professionelle Website?</summary><div class="faq-content">Starter-Projekte beginnen ab 3.500€. In unserem kostenlosen Erstgespräch ermitteln wir den genauen Bedarf und erstellen ein passgenaues Angebot.</div></details>
        <details><summary>Bieten Sie auch Wartung & Support an?</summary><div class="faq-content">Ja. Ich biete flexible Service-Pakete für regelmäßige Updates, Backups, Sicherheits-Checks und Performance-Monitoring an.</div></details>
        <details><summary>Wie wird der Erfolg des Projekts gemessen?</summary><div class="faq-content">Anhand klar definierter KPIs, die wir gemeinsam festlegen: z. B. Conversion-Rate, ROAS, Cost-per-Lead oder organischen Traffic. Sie erhalten transparente Reportings.</div></details>
      </div>
    </div>
  </section>

  <section id="blog" aria-labelledby="blog-heading">
    <div class="container">
      <div class="section-title">
        <span class="badge">Wissen & Einblicke</span>
        <h2 id="blog-heading">Aktuelle Artikel aus dem Blog</h2>
        <p>Hier teile ich meine Erfahrungen, Analysen und Strategien rund um E-Commerce, WordPress und digitales Wachstum.</p>
      </div>
      <div class="blog-grid">
        <article class="blog-card">
          <a href="#" class="blog-card-img" aria-hidden="true" tabindex="-1">
            <img src="https://placehold.co/600x400/0a0a0a/ffb020?text=Design+%26+CRO" alt="Beitragsbild zum Artikel Design ist mehr als Ästhetik">
          </a>
          <div class="blog-card-content">
            <span class="blog-card-cat">E-Commerce-Architektur</span>
            <h3><a href="https://hasimuener.de/design-ist-mehr-als-aesthetik/" class="blog-card-title">Design ist mehr als Ästhetik</a></h3>
            <p class="muted">Gutes Design ist mehr als Optik. Es ist ein direkter Hebel für eine höhere Conversion Rate und besseren ROAS.</p>
            <a href="https://hasimuener.de/design-ist-mehr-als-aesthetik/" class="read-more">Artikel lesen →</a>
          </div>
        </article>
        <article class="blog-card">
          <a href="#" class="blog-card-img" aria-hidden="true" tabindex="-1">
            <img src="https://placehold.co/600x400/0a0a0a/0ea5e9?text=Data+%26+GTM" alt="Beitragsbild zum Artikel Datenhoheit mit server-side-gtm">
          </a>
          <div class="blog-card-content">
            <span class="blog-card-cat">Impulse</span>
            <h3><a href="#" class="blog-card-title">Datenhoheit mit server-side-gtm – Ihr digitales Außenministerium</a></h3>
            <p class="muted">Erobern Sie Ihre Datenhoheit zurück und machen Sie sich unabhängig von Drittanbieter-Pixeln.</p>
            <a href="https://hasimuener.de/datenhoheit-mit-server-side-gtm/" class="read-more">Artikel lesen →</a>
          </div>
        </article>
        <article class="blog-card">
          <a href="#" class="blog-card-img" aria-hidden="true" tabindex="-1">
            <img src="https://placehold.co/600x400/0a0a0a/10b981?text=Performance" alt="Beitragsbild zum Artikel Performance ist Profit">
          </a>
          <div class="blog-card-content">
            <span class="blog-card-cat">Impulse</span>
            <h3><a href="#" class="blog-card-title">Performance ist Profit: Warum Core Web Vitals Wachstum, SEO und ROAS treiben</a></h3>
            <p class="muted">Jede Millisekunde Ladezeit entscheidet über Profit. So treiben die Core Web Vitals Ihr gesamtes Wachstum.</p>
            <a href="https://hasimuener.de/core-web-vitals-wachstum-seo-und-roas/" class="read-more">Artikel lesen →</a>
          </div>
        </article>
      </div>
      <div style="text-align:center; margin-top: 3rem;">
        <a href="https://hasimuener.de/aktuelle-blogbeitrage/" class="btn btn-ghost">Zum Blog</a>
      </div>
    </div>
  </section>

  <section id="cta" aria-labelledby="cta-heading" style="background:var(--glass-bg); border-top: 1px solid var(--glass-border);">
    <div class="container">
      <div class="section-title">
        <span class="badge">Bereit für den nächsten Schritt?</span>
        <h2 id="cta-heading">Lassen Sie uns über Ihr Wachstum sprechen.</h2>
        <p>Sie haben das Ziel, ich bringe die Strategie und die technische Expertise mit. Finden wir in einem kostenlosen Erstgespräch heraus, wie wir Ihren Erfolg planbar machen können.</p>
      </div>
      <div style="text-align:center; display:flex; flex-wrap:wrap; justify-content:center; gap: 1rem;">
        <a class="btn btn-primary" href="https://hasimuener.de/growth-blueprint/">🚀 Kostenloses Growth Blueprint anfordern</a>
        <a class="btn btn-ghost" href="https://cal.com/hasim/30min">📞 Direkt Gespräch vereinbaren</a>
      </div>
    </div>
  </section>
</main>

<?php
// Lade den Footer (wichtig für </body>, </html> und Skripte, die im Footer geladen werden)
get_footer();