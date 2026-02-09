/**
 * PERFORMANCE MARKETING PAGE JS
 * NexusCore übernimmt: SmoothScroll, Reveal.
 * Dieses Skript ergänzt: Service-Schema (JSON-LD).
 */
(function () {
  'use strict';

  function initPerformancePage() {
    injectServiceSchema();
  }

  /**
   * Service Schema (JSON-LD) — SEO für Service-Seiten
   */
  function injectServiceSchema() {
    var schema = {
      '@context': 'https://schema.org',
      '@type': 'Service',
      name: 'Performance Marketing',
      description: 'Daten-getriebenes Performance Marketing: Google Ads, Meta Ads & CRO. Jeder Werbe-Euro wird in messbaren Umsatz verwandelt.',
      provider: {
        '@type': 'Person',
        name: 'Hasim Üner',
        url: 'https://hasimuener.de',
        jobTitle: 'Growth Architect',
        address: {
          '@type': 'PostalAddress',
          addressLocality: 'Hannover',
          addressCountry: 'DE'
        }
      },
      areaServed: {
        '@type': 'City',
        name: 'Hannover'
      },
      serviceType: 'Performance Marketing'
    };

    var script = document.createElement('script');
    script.type = 'application/ld+json';
    script.textContent = JSON.stringify(schema);
    document.head.appendChild(script);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPerformancePage);
  } else {
    initPerformancePage();
  }
})();
