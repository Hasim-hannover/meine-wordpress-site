<?php
/*
Template Name: Alle Lösungen
*/
get_header();
?>
<main class="solutions-overview">
  <section class="container">
    <h1>Unsere Lösungen für Ihren digitalen Erfolg</h1>
    <p style="text-align:center;max-width:700px;margin:0 auto 36px auto;font-size:1.18rem;color:#475569;">
      Wählen Sie die passende Lösung für Ihr Ziel: Mehr Sichtbarkeit, mehr Leads, mehr Umsatz. Jede Lösung ist auf die Bedürfnisse moderner Unternehmen zugeschnitten und basiert auf erprobten Strategien aus der Praxis.
    </p>
    <div class="solutions-list">
      <?php
      $solutions = [
        [
          'title' => '360° Deep Dive',
          'link' => get_permalink(get_page_by_path('360-deep-dive')),
          'desc' => 'Ganzheitliche Analyse: Wir decken alle Potenziale und Schwachstellen Ihrer Website auf. Ideal für Unternehmen, die wissen wollen, wo sie wirklich stehen.'
        ],
        [
          'title' => 'Conversion-Optimierung (CRO)',
          'link' => get_permalink(get_page_by_path('cro')),
          'desc' => 'Mehr Anfragen, mehr Umsatz: Wir optimieren Ihre Website gezielt für maximale Conversion. Psychologische Trigger inklusive.'
        ],
        [
          'title' => 'Wettbewerbsanalyse (WGOS)',
          'link' => get_permalink(get_page_by_path('wgos')),
          'desc' => 'Erkennen Sie Ihre echten Wettbewerber und nutzen Sie deren Schwächen für Ihren Vorsprung.'
        ],
        [
          'title' => 'Core Web Vitals',
          'link' => get_permalink(get_page_by_path('cwv')),
          'desc' => 'Schnell, stabil, nutzerfreundlich: Wir machen Ihre Website fit für Google und Ihre Besucher.'
        ],
        [
          'title' => 'Audit',
          'link' => get_permalink(get_page_by_path('audit')),
          'desc' => 'Technische und inhaltliche Analyse: Wir finden die Bremsen, die Ihr Wachstum verhindern.'
        ],
        [
          'title' => 'GA4 & Tracking',
          'link' => get_permalink(get_page_by_path('ga4')),
          'desc' => 'Datenbasiert entscheiden: Wir richten Google Analytics 4 und Tracking DSGVO-konform ein.'
        ],
        [
          'title' => 'Meta Ads',
          'link' => get_permalink(get_page_by_path('meta-ads')),
          'desc' => 'Mehr Reichweite, gezielte Leads: Wir schalten und optimieren Ihre Meta-Kampagnen.'
        ],
        [
          'title' => 'SEO',
          'link' => get_permalink(get_page_by_path('seo')),
          'desc' => 'Nachhaltige Sichtbarkeit: Wir bringen Sie bei Google nach vorn – mit Strategie, Content und Technik.'
        ],
        [
          'title' => 'Eigene Tools',
          'link' => get_permalink(get_page_by_path('tools')),
          'desc' => 'Exklusive Analyse- und Optimierungstools für Ihren Vorsprung.'
        ],
        [
          'title' => 'Performance',
          'link' => get_permalink(get_page_by_path('performance')),
          'desc' => 'Blitzschnelle Ladezeiten: Für bessere Rankings und mehr Abschlüsse.'
        ],
        [
          'title' => 'Case Study E3',
          'link' => get_permalink(get_page_by_path('case-e3')),
          'desc' => 'Erfolgsbeispiel: So haben wir E3 New Energy zum Wachstum verholfen.'
        ],
        [
          'title' => 'WordPress Agentur',
          'link' => get_permalink(get_page_by_path('wordpress-agentur')),
          'desc' => 'Maßgeschneiderte WordPress-Lösungen für Ihr Business.'
        ],
      ];
      ?>
      <ul>
        <?php foreach ($solutions as $solution): ?>
          <li class="solution-item">
            <a href="<?php echo esc_url($solution['link']); ?>">
              <h2><?php echo esc_html($solution['title']); ?></h2>
              <p><?php echo esc_html($solution['desc']); ?></p>
              <span class="cta-btn">Mehr erfahren</span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div style="text-align:center;margin-top:48px;">
      <a href="/kontakt" class="cta-btn" style="font-size:1.15rem;padding:16px 38px;">Jetzt unverbindlich beraten lassen</a>
      <p style="margin-top:12px;color:#64748b;font-size:1rem;">Gemeinsam finden wir die beste Lösung für Ihr Ziel!</p>
    </div>
  </section>
</main>
<?php
get_footer();
