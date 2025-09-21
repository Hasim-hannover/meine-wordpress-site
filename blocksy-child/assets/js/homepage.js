window.addEventListener('load', () => {
  const state = {
    isTocArmed: false,
    tocHideTimer: null,
  };

  const UI = {
    tocContainer: document.getElementById('toc-container'),
    tocList: document.getElementById('toc-list'),
    // STRATEGIEWECHSEL: Wir suchen direkt nach den Überschriften mit IDs. Das ist robust.
    headings: document.querySelectorAll('main h2[id]'),
  };

  console.log(`TOC Initialisierung: ${UI.headings.length} klickbare Überschriften gefunden.`);

  /**
   * Baut das Inhaltsverzeichnis (TOC) aus den gefundenen Überschriften.
   */
  function initTOC() {
    if (!UI.tocList || UI.headings.length < 2) { // Weniger als 2 Überschriften machen kein TOC
      if (UI.tocContainer) {
        UI.tocContainer.style.display = 'none';
      }
      return;
    }

    const frag = document.createDocumentFragment();
    UI.headings.forEach(heading => {
      const id = heading.id;
      const title = heading.textContent.trim();

      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = `#${id}`;
      a.textContent = title;
      li.appendChild(a);
      frag.appendChild(li);
    });
    UI.tocList.appendChild(frag);
  }

  /**
   * IntersectionObserver, der die Überschriften beobachtet und den aktiven Link hervorhebt.
   * Das ist sehr performant, da es nicht bei jedem Pixel-Scrollen feuert.
   */
  function setupIntersectionObserver() {
    if (UI.headings.length < 2 || !UI.tocContainer) return;

    const observer = new IntersectionObserver((entries) => {
      let activeId = null;
      // Finde die oberste sichtbare Überschrift
      const firstVisible = entries.find(entry => entry.isIntersecting);
      if (firstVisible) {
        activeId = firstVisible.target.id;
      } else {
        // Fallback für schnelles Scrollen: Nimm die letzte, die oben verschwunden ist
        for (let i = UI.headings.length - 1; i >= 0; i--) {
          if (UI.headings[i].getBoundingClientRect().top < 150) {
            activeId = UI.headings[i].id;
            break;
          }
        }
      }

      UI.tocList.querySelectorAll('a').forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === `#${activeId}`);
      });
      
      // TOC "scharfschalten" und anzeigen, wenn die erste Überschrift erreicht wird
      const firstHeadingEntry = entries.find(e => e.target === UI.headings[0]);
      if (firstHeadingEntry) {
        state.isTocArmed = firstHeadingEntry.isIntersecting || firstHeadingEntry.boundingClientRect().top < window.innerHeight;
        if (!state.isTocArmed) {
          UI.tocContainer.classList.remove('is-visible');
        }
      }
    }, { 
      rootMargin: '0px 0px -80% 0px', // Löst aus, wenn eine H2 die oberen 20% des Bildschirms erreicht
      threshold: 0 
    });

    UI.headings.forEach(heading => observer.observe(heading));
  }

  /**
   * Steuert die Sichtbarkeit des TOC bei Mausbewegung.
   */
  function setupTocVisibility() {
    if (!UI.tocContainer) return;
    const show = () => {
      if (!state.isTocArmed) return;
      UI.tocContainer.classList.add('is-visible');
      clearTimeout(state.tocHideTimer);
      state.tocHideTimer = setTimeout(() => UI.tocContainer.classList.remove('is-visible'), 2500);
    };
    window.addEventListener('mousemove', show, { passive: true });
    window.addEventListener('click', show);
  }

  function init() {
    initTOC();
    setupIntersectionObserver();
    setupTocVisibility();
  }

  init();
});

