/**
 * AUDIT PAGE JS
 * Seitenspezifische Logik für die Customer Journey Audit Landing Page.
 * NexusCore übernimmt: ScrollSpy, FAQ-Accordion, SmoothScroll, Reveal.
 * Dieses Skript ergänzt: Smart-Nav Sichtbarkeit, FAQ-Schema (SEO).
 */
(function () {
  'use strict';

  function initAuditPage() {
    initSmartNavVisibility();
    initAuditScrollSpy();
    injectFaqSchema();
  }

  /**
   * Smart-Nav erst nach Scroll einblenden (weniger Ablenkung above the fold)
   */
  function initSmartNavVisibility() {
    var smartNav = document.querySelector('.audit-wrapper .smart-nav');
    if (!smartNav) return;

    var showAfter = 520;

    function toggle() {
      if (window.scrollY > showAfter) {
        smartNav.classList.add('is-visible');
      } else {
        smartNav.classList.remove('is-visible');
      }
    }

    toggle();
    window.addEventListener('scroll', toggle, { passive: true });
  }

  /**
   * Audit-spezifischer ScrollSpy (NexusCore.initScrollSpy mit angepasstem Selektor)
   */
  function initAuditScrollSpy() {
    if (window.NexusCore && typeof NexusCore.initScrollSpy === 'function') {
      NexusCore.initScrollSpy('.audit-wrapper .smart-nav', '.audit-section[id]', 200);
    }
  }

  /**
   * FAQ Schema (JSON-LD) dynamisch injizieren — SEO-Boost für Rich Results
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

  // Init on DOMContentLoaded or immediately if already loaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAuditPage);
  } else {
    initAuditPage();
  }
})();
