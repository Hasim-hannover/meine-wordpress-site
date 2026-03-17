/**
 * AUDIT PAGE JS
 * Seitenspezifische Logik fuer die Growth-Audit-Landingpage.
 * NexusCore uebernimmt: SmoothScroll, Reveal und globale Interaktionen.
 * Dieses Skript ergänzt nur das FAQ-Schema.
 */
(function () {
  'use strict';

  function initAuditPage() {
    captureAdsParams();
    injectFaqSchema();
  }

  /**
   * URL-Parameter (utm_source, keyword) im sessionStorage sichern
   * und in versteckte Formularfelder schreiben. Keine Cookies.
   */
  function captureAdsParams() {
    var urlParams = new URLSearchParams(window.location.search);
    var utmSource = urlParams.get('utm_source');
    var utmKeyword = urlParams.get('keyword');

    if (utmSource) {
      sessionStorage.setItem('ads_source', utmSource);
    }
    if (utmKeyword) {
      sessionStorage.setItem('ads_keyword', utmKeyword);
    }

    var adsSourceField = document.getElementById('ads_source');
    var adsKeywordField = document.getElementById('ads_keyword');

    if (adsSourceField) {
      adsSourceField.value = sessionStorage.getItem('ads_source') || '';
    }
    if (adsKeywordField) {
      adsKeywordField.value = sessionStorage.getItem('ads_keyword') || '';
    }
  }

  /**
   * FAQ-Schema (JSON-LD) dynamisch injizieren.
   */
  function injectFaqSchema() {
    var faqSection = document.querySelector('.audit-faq-section');
    if (!faqSection) return;

    var details = faqSection.querySelectorAll('details');
    if (!details.length) return;

    var faqEntries = [];
    details.forEach(function (detail) {
      var question = detail.querySelector('summary');
      var answer = detail.querySelector('.faq-ans');
      if (question && answer) {
        faqEntries.push({
          '@type': 'Question',
          name: question.textContent.trim(),
          acceptedAnswer: {
            '@type': 'Answer',
            text: answer.textContent.trim()
          }
        });
      }
    });

    if (!faqEntries.length) return;

    var schema = {
      '@context': 'https://schema.org',
      '@type': 'FAQPage',
      mainEntity: faqEntries
    };

    var script = document.createElement('script');
    script.type = 'application/ld+json';
    script.textContent = JSON.stringify(schema);
    document.head.appendChild(script);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAuditPage);
  } else {
    initAuditPage();
  }
})();
