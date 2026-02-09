/**
 * SEO LANDING PAGE JS
 * Seitenspezifische Logik für die WordPress SEO Hannover Seite.
 * NexusCore übernimmt: ScrollSpy, FAQ-Accordion, SmoothScroll, Reveal, Counter.
 * Dieses Skript ergänzt: FAQ-Schema (JSON-LD) für Rich Results.
 */
(function () {
  'use strict';

  function initSeoPage() {
    initSeoScrollSpy();
    injectFaqSchema();
  }

  /**
   * SEO-spezifischer ScrollSpy (NexusCore mit angepasstem Selektor)
   */
  function initSeoScrollSpy() {
    if (window.NexusCore && typeof NexusCore.initScrollSpy === 'function') {
      NexusCore.initScrollSpy('.cs-page-seo .smart-nav', '.cs-page-seo section[id]', 300);
    }
  }

  /**
   * FAQ Schema (JSON-LD) dynamisch injizieren — SEO-Boost für Rich Results
   */
  function injectFaqSchema() {
    var faqItems = document.querySelectorAll('.cs-page-seo .wp-faq-item');
    if (!faqItems.length) return;

    var faqEntries = [];
    faqItems.forEach(function (item) {
      var question = item.querySelector('summary');
      var answer = item.querySelector('.wp-faq-content');
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

  // Init
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSeoPage);
  } else {
    initSeoPage();
  }
})();
