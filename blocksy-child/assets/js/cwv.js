/**
 * CORE WEB VITALS PAGE JS
 * Seitenspezifische Logik für die CWV Landing Page.
 * NexusCore übernimmt: SmoothScroll, Reveal.
 * Dieses Skript ergänzt: Service-Schema (JSON-LD) für Rich Results.
 */
(function () {
  'use strict';

  function initCwvPage() {
    injectServiceSchema();
  }

  /**
   * Service Schema (JSON-LD) — SEO für Service-Seiten
   */
  function injectServiceSchema() {
    var schema = {
      '@context': 'https://schema.org',
      '@type': 'Service',
      name: 'Core Web Vitals Optimierung',
      description: 'Professionelle Core Web Vitals Optimierung: LCP, INP & CLS Optimierung für WordPress & Shopify. Messbare Umsatzsteigerung durch PageSpeed.',
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
      serviceType: 'Core Web Vitals Optimierung',
      offers: {
        '@type': 'Offer',
        price: '649',
        priceCurrency: 'EUR',
        priceSpecification: {
          '@type': 'UnitPriceSpecification',
          price: '649',
          priceCurrency: 'EUR',
          unitText: 'einmalig'
        }
      }
    };

    var script = document.createElement('script');
    script.type = 'application/ld+json';
    script.textContent = JSON.stringify(schema);
    document.head.appendChild(script);
  }

  // Init
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initCwvPage);
  } else {
    initCwvPage();
  }
})();
