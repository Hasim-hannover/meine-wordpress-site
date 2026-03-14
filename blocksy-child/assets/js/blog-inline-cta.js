/**
 * Blog Inline CTA
 *
 * Reveals an inline audit CTA after the user has scrolled 40% through the article.
 */
(function () {
  'use strict';

  function init() {
    var article = document.getElementById('article-content');
    var cta = document.getElementById('nexus-inline-cta');
    if (!article || !cta) return;

    function check() {
      var rect = article.getBoundingClientRect();
      var pct = -rect.top / article.offsetHeight;
      if (pct >= 0.4) {
        cta.hidden = false;
        cta.removeAttribute('aria-hidden');
        requestAnimationFrame(function () {
          cta.classList.add('is-visible');
        });
        window.removeEventListener('scroll', check);
      }
    }

    window.addEventListener('scroll', check, { passive: true });
    check();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
