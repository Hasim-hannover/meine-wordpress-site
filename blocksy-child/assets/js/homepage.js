// Wir warten, bis die GESAMTE Seite geladen ist, inklusive aller Bilder und Inhalte.
window.addEventListener('load', () => {
  const state = {
    isTocArmed: false,
    tocHideTimer: null,
  };

  const UI = {
    tocContainer: document.getElementById('toc-container'),
    tocList: document.getElementById('toc-list'),
    // Wir verwenden einen allgemeineren Selektor, der auch verschachtelte Sektionen findet.
    sections: document.querySelectorAll('main section[id]'),
  };

  // DEBUG: Gib in der Browser-Konsole aus, wie viele Sektionen gefunden wurden.
  console.log(`TOC Initialisierung: ${UI.sections.length} Sektionen gefunden.`);


  /**
   * Baut das Inhaltsverzeichnis (TOC) dynamisch auf.
   */
  function initTOC() {
    if (!UI.tocList || UI.sections.length === 0) {
      if(UI.tocContainer) {
        UI.tocContainer.style.display = 'none'; // Verstecke das TOC komplett, wenn es nichts anzuzeigen gibt.
      }
      return;
    }

    const frag = document.createDocumentFragment();

    UI.sections.forEach(section => {
      const id = section.id;
      const titleElement = section.querySelector('h2');

      if (!id || !titleElement) {
        return;
      }
      
      const title = titleElement.textContent.trim();

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
   * Richtet den IntersectionObserver ein, um die Sichtbarkeit der Sektionen zu verfolgen.
   */
  function setupIntersectionObserver() {
    if (UI.sections.length < 1 || !UI.tocContainer) return;

    const observer = new IntersectionObserver((entries) => {
      let activeId = null;

      for (const entry of entries) {
        if (entry.isIntersecting) {
          activeId = entry.target.id;
          break;
        }
      }
      
      if (!activeId) {
        for (let i = UI.sections.length - 1; i >= 0; i--) {
          if (UI.sections[i].getBoundingClientRect().top < 150) {
            activeId = UI.sections[i].id;
            break;
          }
        }
      }

      UI.tocList.querySelectorAll('a').forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === `#${activeId}`);
      });
      
      const secondSection = UI.sections[1];
      if (secondSection) {
        const secondSectionEntry = entries.find(e => e.target === secondSection);
        if (secondSectionEntry) {
           state.isTocArmed = secondSectionEntry.isIntersecting || secondSectionEntry.boundingClientRect.top < window.innerHeight;
            if (!state.isTocArmed) {
                UI.tocContainer.classList.remove('is-visible');
            }
        }
      }

    }, { 
      rootMargin: '0px 0px -70% 0px', 
      threshold: 0 
    });

    UI.sections.forEach(section => observer.observe(section));
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

