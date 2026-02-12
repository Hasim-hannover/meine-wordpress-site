/**
 * SEO LANDING PAGE JS
 * Seitenspezifische Logik für die WordPress SEO Hannover Seite.
 * NexusCore übernimmt: ScrollSpy, FAQ-Accordion, SmoothScroll, Reveal, Counter.
 * FAQ-Schema wird serverseitig via org-schema.php ausgegeben.
 */
(function () {
  'use strict';

  function initSeoPage() {
    initSeoScrollSpy();
  }

  /**
   * SEO-spezifischer ScrollSpy (NexusCore mit angepasstem Selektor)
   */
  function initSeoScrollSpy() {
    if (window.NexusCore && typeof NexusCore.initScrollSpy === 'function') {
      NexusCore.initScrollSpy('.cs-page-seo .smart-nav', '.cs-page-seo section[id]', 300);
    }
  }

  // Init
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSeoPage);
  } else {
    initSeoPage();
  }
})();
