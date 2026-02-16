<?php
/*
Template Name: Alle Lösungen
*/
get_header();
?>
<main class="solutions-overview">
  <section class="container">
    <h1>Unsere Lösungen</h1>
    <div class="solutions-list">
      <?php
      // Array mit den Lösungen und zugehörigen Seiten
      $solutions = [
        [
          'title' => '360° Deep Dive',
          'link' => get_permalink(get_page_by_path('360-deep-dive')),
          'desc' => 'Ganzheitliche Analyse für Ihr Business.'
        ],
        [
          'title' => 'CRO',
          'link' => get_permalink(get_page_by_path('cro')),
          'desc' => 'Conversion-Optimierung für mehr Leads & Sales.'
        ],
        [
          'title' => 'Wettbewerbsanalyse (WGOS)',
          'link' => get_permalink(get_page_by_path('wgos')),
          'desc' => 'Wettbewerbsvorteile erkennen und nutzen.'
        ],
        [
          'title' => 'Core Web Vitals',
          'link' => get_permalink(get_page_by_path('cwv')),
          'desc' => 'Performance-Optimierung für bessere Rankings.'
        ],
        [
          'title' => 'Audit',
          'link' => get_permalink(get_page_by_path('audit')),
          'desc' => 'Technische und inhaltliche Website-Analyse.'
        ],
        [
          'title' => 'GA4',
          'link' => get_permalink(get_page_by_path('ga4')),
          'desc' => 'Google Analytics 4 Implementierung & Beratung.'
        ],
        [
          'title' => 'Meta Ads',
          'link' => get_permalink(get_page_by_path('meta-ads')),
          'desc' => 'Erfolgreiche Werbekampagnen auf Meta Plattformen.'
        ],
        [
          'title' => 'SEO',
          'link' => get_permalink(get_page_by_path('seo')),
          'desc' => 'Suchmaschinenoptimierung für nachhaltigen Erfolg.'
        ],
        [
          'title' => 'Tools',
          'link' => get_permalink(get_page_by_path('tools')),
          'desc' => 'Eigene Tools für Analyse & Optimierung.'
        ],
        [
          'title' => 'Performance',
          'link' => get_permalink(get_page_by_path('performance')),
          'desc' => 'Schnelle Ladezeiten für bessere Nutzererfahrung.'
        ],
        [
          'title' => 'Case Study E3',
          'link' => get_permalink(get_page_by_path('case-e3')),
          'desc' => 'Erfolgsbeispiel aus der Praxis.'
        ],
        [
          'title' => 'WordPress Agentur',
          'link' => get_permalink(get_page_by_path('wordpress-agentur')),
          'desc' => 'Professionelle WordPress-Lösungen.'
        ],
      ];
      ?>
      <ul>
        <?php foreach ($solutions as $solution): ?>
          <li class="solution-item">
            <a href="<?php echo esc_url($solution['link']); ?>">
              <h2><?php echo esc_html($solution['title']); ?></h2>
              <p><?php echo esc_html($solution['desc']); ?></p>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
</main>
<?php
get_footer();
