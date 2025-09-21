document.addEventListener('DOMContentLoaded', () => {
  const state = {
    isTocArmed: false,
    tocHideTimer: null,
  };

  const UI = {
    tocContainer: document.getElementById('toc-container'),
    tocList: document.getElementById('toc-list'),
    // Wir suchen nach allen <section> Elementen, die eine ID haben und direkte Kinder von <main> sind.
    sections: document.querySelectorAll('main > section[id]'),
  };

  /**
   * Baut das Inhaltsverzeichnis (TOC) dynamisch auf.
   * DIESE FUNKTION IST JETZT INTELLIGENTER.
   */
  function initTOC() {
    if (!UI.tocList || UI.sections.length === 0) {
      console.log('TOC-Liste oder Sektionen nicht gefunden. TOC wird nicht initialisiert.');
      return;
    }

    const frag = document.createDocumentFragment();

    UI.sections.forEach(section => {
      const id = section.id;
      // NEUE LOGIK: Finde die erste <h2>-Überschrift in der Sektion.
      const titleElement = section.querySelector('h2');

      // Nur fortfahren, wenn eine ID und eine Überschrift gefunden wurden.
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

      // Finde die oberste Sektion, die gerade im sichtbaren Bereich ist.
      for (const entry of entries) {
        if (entry.isIntersecting) {
          activeId = entry.target.id;
          break;
        }
      }
      
      // Wenn beim schnellen Scrollen keine Sektion "intersecting" ist,
      // nimm die letzte, die oben aus dem Bild verschwunden ist.
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
      
      // Das TOC "scharfschalten", wenn die zweite Sektion erreicht wird.
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

