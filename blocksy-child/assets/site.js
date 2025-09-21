// /assets/js/site.js
(function () {
  const onReady = (fn) =>
    document.readyState === 'loading'
      ? document.addEventListener('DOMContentLoaded', fn, { once: true })
      : fn();

  function ensureHeadingIds(selector = 'main h2') {
    const hs = document.querySelectorAll(selector);
    hs.forEach(h => {
      if (!h.id) {
        h.id = h.textContent.trim().toLowerCase()
          .replace(/[^\w\- ]+/g, '')
          .replace(/\s+/g, '-')
          .substring(0, 80);
      }
    });
    return hs;
  }

  function initTOC() {
    const tocContainer = document.getElementById('toc-container');
    const tocList = document.getElementById('toc-list');
    if (!tocContainer || !tocList) return; // TOC existiert nicht → silently skip

    const headings = ensureHeadingIds('main h2');
    if (!headings || headings.length < 2) {
      tocContainer.style.display = 'none';
      return;
    }

    // Build links
    const frag = document.createDocumentFragment();
    headings.forEach(h => {
      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = `#${h.id}`;
      a.textContent = h.textContent.trim();
      li.appendChild(a);
      frag.appendChild(li);
    });
    tocList.innerHTML = '';
    tocList.appendChild(frag);

    // Active state via IntersectionObserver
    const obs = new IntersectionObserver((entries) => {
      let activeId = null;
      const firstVisible = entries.find(e => e.isIntersecting);
      if (firstVisible) activeId = firstVisible.target.id;
      if (!activeId) {
        for (let i = headings.length - 1; i >= 0; i--) {
          if (headings[i].getBoundingClientRect().top < 150) {
            activeId = headings[i].id; break;
          }
        }
      }
      tocList.querySelectorAll('a').forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === `#${activeId}`);
      });
    }, { rootMargin: '0px 0px -80% 0px', threshold: 0 });
    headings.forEach(h => obs.observe(h));

    // Auto-show on interaction
    let hideTimer = null, armed = false;
    const first = headings[0];
    if (first) {
      const armObs = new IntersectionObserver((es) => {
        const e = es[0];
        armed = e.isIntersecting || e.boundingClientRect.top < window.innerHeight;
        if (!armed) tocContainer.classList.remove('is-visible');
      }, { rootMargin: '0px 0px -80% 0px', threshold: 0 });
      armObs.observe(first);
    }
    const show = () => {
      if (!armed) return;
      tocContainer.classList.add('is-visible');
      clearTimeout(hideTimer);
      hideTimer = setTimeout(() => tocContainer.classList.remove('is-visible'), 2500);
    };
    window.addEventListener('mousemove', show, { passive: true });
    window.addEventListener('click', show, { passive: true });
  }

  // FAQ-Accordion auf JEDER Seite (falls <details> vorhanden)
  function setupFaqAccordion() {
    const root = document.getElementById('article-content') || document;
    const allDetails = root.querySelectorAll('details');
    if (!allDetails.length) return;
    allDetails.forEach(d => {
      d.addEventListener('toggle', () => {
        if (d.open) {
          allDetails.forEach(o => { if (o !== d && o.open) o.open = false; });
        }
      });
    });
  }

  onReady(() => {
    ensureHeadingIds();   // IDs für H2 überall nachziehen
    initTOC();            // TOC nur, wenn Container existiert
    setupFaqAccordion();  // FAQ überall, wenn <details> existiert
  });
})();
