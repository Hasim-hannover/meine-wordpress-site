<?php
/**
 * Versioned audit landing page shell.
 *
 * Used as fallback when the editor content is missing or broken.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cases_url = nexus_get_page_url( [ 'case-studies' ], home_url( '/case-studies/' ) );
$wgos_url  = nexus_get_page_url(
	[ 'wordpress-growth-operating-system', 'wgos' ],
	home_url( '/wordpress-growth-operating-system/' )
);
$about_url = nexus_get_page_url( [ 'uber-mich' ], home_url( '/uber-mich/' ) );
?>
<style>
  #audit-results {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.45s ease, transform 0.45s ease;
  }

  .audit-kpi-strip {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    max-width: 780px;
    margin: 1.5rem auto 0;
  }

  .audit-kpi {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    padding: 14px 16px;
    text-align: left;
  }

  .audit-kpi strong {
    display: block;
    color: #fff;
    font-size: 1rem;
    line-height: 1.2;
    margin-bottom: 0.2rem;
  }

  .audit-kpi span {
    display: block;
    color: #a1a1aa;
    font-size: 0.78rem;
    line-height: 1.45;
  }

  .audit-inline-note {
    margin: 0 0 1rem;
    padding: 0.75rem 0.95rem;
    border-radius: 12px;
    border: 1px solid rgba(255, 176, 32, 0.18);
    background: rgba(255, 176, 32, 0.06);
    color: #f3f4f6;
    font-size: 0.84rem;
    line-height: 1.55;
  }

  #audit-form-error {
    display: none;
    margin: 0.85rem 0 0;
    padding: 0.8rem 0.95rem;
    border-radius: 12px;
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #fecaca;
    font-size: 0.84rem;
    line-height: 1.5;
  }

  .audit-form-meta {
    text-align: center;
    font-size: 0.74rem;
    color: #71717a;
    margin: 0.85rem 0 0;
  }

  .audit-link-cluster {
    text-align: center;
    padding: 2rem 0 1rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1.25rem;
    justify-content: center;
  }

  .audit-link-cluster a {
    color: var(--gold);
    font-weight: 700;
    font-size: 0.9rem;
  }

  .view-mode-results .smart-nav,
  .view-mode-results #start,
  .view-mode-results #form-wrap,
  .view-mode-results .audit-social-proof,
  .view-mode-results .tech-stack-bar,
  .view-mode-results #journey,
  .view-mode-results #preview,
  .view-mode-results #vorteile,
  .view-mode-results #faq,
  .view-mode-results .audit-link-cluster {
    display: none !important;
  }

  .view-mode-results #audit-results {
    display: block;
    opacity: 1;
    transform: translateY(0);
    padding-top: 16px;
    min-height: 80vh;
  }

  @media (max-width: 767px) {
    .audit-kpi-strip {
      grid-template-columns: 1fr;
      gap: 10px;
    }
  }
</style>

<div class="audit-wrapper" id="audit-main-wrapper">

  <nav class="smart-nav" aria-label="Seiten-Navigation">
    <ul>
      <li><a href="#start" title="Start"><div class="nav-dot"></div><span class="nav-text">Start</span></a></li>
      <li><a href="#form" title="Audit"><div class="nav-dot"></div><span class="nav-text">Audit starten</span></a></li>
      <li><a href="#journey" title="Ablauf"><div class="nav-dot"></div><span class="nav-text">Ablauf</span></a></li>
      <li><a href="#preview" title="Auswertung"><div class="nav-dot"></div><span class="nav-text">Auswertung</span></a></li>
      <li><a href="#vorteile" title="Vorteile"><div class="nav-dot"></div><span class="nav-text">Vorteile</span></a></li>
      <li><a href="#faq" title="FAQ"><div class="nav-dot"></div><span class="nav-text">FAQ</span></a></li>
    </ul>
  </nav>

  <div class="audit-container">
    <main class="audit-content">

      <div id="start" class="audit-hero-centered audit-section nx-reveal">
        <div class="hero-pill">Kostenlos - 60 Sekunden - Live-Ergebnis</div>
        <h1>
          Ihre Kunden suchen bei Google.<br>
          <span class="text-highlight">Werden Sie gefunden?</span>
        </h1>
        <p class="hero-sub-short">
          Wir simulieren die Reise Ihres naechsten Kunden und zeigen,
          <strong>wo Sichtbarkeit, Vertrauen oder der naechste Schritt wegbrechen</strong>.
        </p>

        <div class="audit-kpi-strip" aria-label="Audit-Ueberblick">
          <div class="audit-kpi">
            <strong>1 URL</strong>
            <span>Kein Konto. Kein Setup. Keine Registrierung.</span>
          </div>
          <div class="audit-kpi">
            <strong>4 Prueffelder</strong>
            <span>Google, Performance, Vertrauen und Conversion.</span>
          </div>
          <div class="audit-kpi">
            <strong>Ergebnis direkt hier</strong>
            <span>Danach direkter Beratungs-CTA statt Report-Versand.</span>
          </div>
        </div>
      </div>

      <div id="form-wrap">
        <div id="form" class="black-box black-box--centered audit-section nx-reveal">
          <div class="box-head">
            <h3>Audit starten</h3>
            <p>Website eingeben. Das Ergebnis erscheint direkt auf dieser Seite.</p>
          </div>

          <div id="audit-form-inner">
            <form id="audit-live-form" novalidate>
              <div class="audit-inline-note">
                Wir pruefen kaufrelevante Sichtbarkeit, Mobile Performance, Vertrauenssignale und die Reibung vor der Anfrage.
              </div>

              <div class="audit-field">
                <label for="audit-url">Website-URL</label>
                <input type="url" id="audit-url" name="url" placeholder="https://ihre-website.de" required autocomplete="url">
              </div>

              <div id="audit-form-error" aria-live="polite"></div>

              <button type="submit" class="audit-submit-btn">Audit jetzt starten</button>

              <p style="text-align:center; margin:0.85rem 0 0.3rem;">
                <a href="#preview" style="color:var(--gold); font-size:0.88rem; font-weight:700;">Beispiel-Auswertung ansehen ↓</a>
              </p>
              <p class="audit-form-meta">
                Oeffentliche Daten, konservative Potenzial-Spanne, keine Registrierung.
              </p>
            </form>
          </div>

          <div id="audit-loader" aria-live="polite">
            <div class="loader-icon" id="loader-icon">🔍</div>
            <div class="loader-text" id="loader-text">Analyse wird gestartet ...</div>
            <div class="loader-sub" id="loader-sub">Bitte warten - dauert ca. 30-60 Sekunden</div>
            <div class="loader-progress-track">
              <div class="loader-progress-fill" id="loader-progress"></div>
            </div>
          </div>

          <div class="trust-strip">
            <div class="trust-item">
              <div class="trust-ic">✓</div>
              <div><strong>Nur URL noetig.</strong> Kein Konto, kein Call-Zwang.</div>
            </div>
            <div class="trust-item">
              <div class="trust-ic">🔒</div>
              <div>Analyse auf Basis oeffentlicher Daten und externer APIs.</div>
            </div>
          </div>
        </div>

        <div class="audit-social-proof nx-reveal">
          <div class="revenue-counter">
            <span class="label">Typisches B2B-Potenzial:</span>
            <span class="amount">3.000-12.000 EUR/Monat</span>
          </div>

          <div class="mini-preview" aria-label="Beispielauszug aus der Auswertung">
            <div class="mp-title">Beispielauszug</div>
            <div class="mp-row">
              <span>Kaufnahe Keywords</span>
              <span class="mp-val">2 von 6 sichtbar</span>
            </div>
            <div class="mp-row">
              <span>Mobile Eindruck</span>
              <span class="mp-val">58 / 100</span>
            </div>
            <div class="mp-row">
              <span>Groesste Bremse</span>
              <span class="mp-val">zu wenig Proof</span>
            </div>
          </div>
        </div>
      </div>

      <div id="audit-results" class="audit-section" aria-live="polite"></div>

      <div class="tech-stack-bar nx-reveal" aria-label="Tech Stack">
        <div class="tech-label">Was wir unter der Haube nutzen</div>
        <div class="tech-item">🔍 Google SERP <small>kaufnahe Sichtbarkeit</small></div>
        <div class="tech-item">⚡ Lighthouse <small>Mobile Speed &amp; CWV</small></div>
        <div class="tech-item">🔄 n8n <small>Automatisierung &amp; Auswertung</small></div>
      </div>

      <section id="journey" class="journey-preview audit-section nx-reveal">
        <h2 class="journey-headline">Was wird geprueft?</h2>
        <p class="journey-subline">
          Wir durchlaufen die vier Stellen, an denen sich entscheidet, ob aus Sichtbarkeit echte Anfragen werden.
        </p>
        <div class="journey-steps-preview">
          <div class="journey-step-preview">
            <div class="step-marker">🔍</div>
            <div class="step-content">
              <h4>Google &amp; Markt</h4>
              <p>Wir pruefen, ob Ihre Website fuer kaufnahe Suchanfragen ueberhaupt sichtbar ist.</p>
              <span class="step-result gap">Oft: Wettbewerber vor Ihnen</span>
            </div>
          </div>
          <div class="journey-step-preview">
            <div class="step-marker">⚡</div>
            <div class="step-content">
              <h4>Erster Eindruck</h4>
              <p>Performance und mobile Reibung entscheiden, ob Besucher bleiben oder sofort abspringen.</p>
              <span class="step-result found">Messbar in Score und Ladezeit</span>
            </div>
          </div>
          <div class="journey-step-preview">
            <div class="step-marker">🤝</div>
            <div class="step-content">
              <h4>Vertrauen</h4>
              <p>Cases, Testimonials und Basis-Signale zeigen, ob Ihre Seite glaubwuerdig genug wirkt.</p>
              <span class="step-result gap">Oft: zu wenig Beweis</span>
            </div>
          </div>
          <div class="journey-step-preview">
            <div class="step-marker">🎯</div>
            <div class="step-content">
              <h4>Naechster Schritt</h4>
              <p>Wir pruefen, ob Interesse in einen klaren Kontakt- oder Beratungsweg gefuehrt wird.</p>
              <span class="step-result gap">Oft: zu viel Reibung</span>
            </div>
          </div>
        </div>
      </section>

      <section id="preview" class="report-preview-section audit-section nx-reveal">
        <div class="preview-text">
          <span class="preview-kicker">Ihre Auswertung</span>
          <h2>Kein Vanity-Score.<br>Sondern Prioritaet.</h2>
          <p class="preview-desc">
            Sie sehen die <strong>groessten Bremsen im Anfrageweg</strong>, eine konservative Potenzial-Spanne und den sinnvollen naechsten Hebel.
          </p>
          <ul>
            <li><strong>Marktrealitaet:</strong> Wo suchen Ihre Kunden und wer steht dort vor Ihnen?</li>
            <li><strong>Performance:</strong> Wie stark bremst der erste mobile Eindruck?</li>
            <li><strong>Proof:</strong> Reicht die Seite fuer Vertrauen und Abschluss?</li>
            <li><strong>Naechster Schritt:</strong> Wie sauber fuehrt die Seite in Kontakt oder Beratung?</li>
          </ul>
        </div>
        <div class="preview-visual">
          <div class="preview-img-placeholder">
            <img src="https://hasimuener.de/wp-content/uploads/2026/02/Bildschirmfoto-2026-02-09-um-22.38.07.png" alt="Vorschau der Audit-Auswertung" loading="lazy" width="400" height="533">
          </div>
        </div>
      </section>

      <section id="vorteile" class="audit-usp-section audit-section nx-reveal">
        <h2 class="audit-usp-headline">Warum dieses Audit?</h2>
        <div class="usp-grid">
          <div class="usp-card">
            <span class="usp-icon">🔍</span>
            <div class="usp-title">Echte Suchrealitaet</div>
            <div class="usp-text">Keine reine Checkliste, sondern sichtbare Nachfrage mit Kaufbezug.</div>
          </div>
          <div class="usp-card">
            <span class="usp-icon">💰</span>
            <div class="usp-title">Potenzial statt Scheinpraezision</div>
            <div class="usp-text">Keine falsche Punktlandung, sondern eine belastbare Potenzial-Spanne.</div>
          </div>
          <div class="usp-card">
            <span class="usp-icon">🧭</span>
            <div class="usp-title">Priorisierung statt Info-Flut</div>
            <div class="usp-text">Die Auswertung zeigt nicht alles, sondern zuerst den groessten Hebel.</div>
          </div>
        </div>
      </section>

      <section id="faq" class="audit-faq-section audit-section nx-reveal">
        <h2 class="audit-faq-headline">Haeufige Fragen</h2>
        <details>
          <summary>Wie belastbar ist die Potenzial-Spanne?</summary>
          <div class="faq-ans">Sie ist bewusst konservativ und dient als Orientierung. Mit echten GSC- und CRM-Daten wird sie schaerfer.</div>
        </details>
        <details>
          <summary>Warum braucht das Audit keine E-Mail?</summary>
          <div class="faq-ans">Weil die erste Ueberzeugung direkt auf der Seite passieren soll. Kontakt kommt erst nach der sichtbaren Diagnose.</div>
        </details>
        <details>
          <summary>Ist das nur fuer WordPress?</summary>
          <div class="faq-ans">Nein. Die Analyse ist plattformunabhaengig. WordPress ist nur haeufig der Kontext.</div>
        </details>
      </section>

      <div class="audit-link-cluster">
        <a href="<?php echo esc_url( $cases_url ); ?>">Case Studies -&gt;</a>
        <a href="<?php echo esc_url( $wgos_url ); ?>">WGOS als System -&gt;</a>
        <a href="<?php echo esc_url( $about_url ); ?>">Mehr ueber den Ansatz -&gt;</a>
      </div>
    </main>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var resultsContainer = document.getElementById('audit-results');
  var wrapper = document.getElementById('audit-main-wrapper');
  if (!resultsContainer || !wrapper) return;

  function activateResultsMode() {
    if (!resultsContainer.innerHTML.trim()) return;
    wrapper.classList.add('view-mode-results');
    window.requestAnimationFrame(function () {
      window.scrollTo({ top: Math.max(wrapper.offsetTop - 40, 0), behavior: 'smooth' });
    });
  }

  var observer = new MutationObserver(function () {
    if (resultsContainer.innerHTML.trim()) {
      activateResultsMode();
      observer.disconnect();
    }
  });

  observer.observe(resultsContainer, { childList: true, subtree: true });
});
</script>
