document.addEventListener('DOMContentLoaded', () => {
  // Zustand der Seite speichern (z.B. ob das TOC "scharfgeschaltet" ist)
  const state = {
    isTocArmed: false,
    tocHideTimer: null,
  };

  // Alle wichtigen Elemente der Benutzeroberfläche (UI) an einem Ort sammeln
  const UI = {
    mainContent: document.querySelector('main'), // Hauptinhaltsbereich der Startseite
    tocContainer: document.getElementById('toc-container'),
    tocList: document.getElementById('toc-list'),
    // Alle section-Elemente im main-Bereich, die eine ID haben, sind unsere TOC-Ziele
    headings: document.querySelectorAll('main section[id]'), 
  };

  /**
   * Erstellt das Inhaltsverzeichnis (TOC) dynamisch aus den gefundenen Sections.
   */
  function initTOC() {
    // Nur ausführen, wenn die TOC-Liste und mindestens eine Section vorhanden sind
    if (!UI.tocList || UI.headings.length === 0) {
      console.log('TOC-Liste oder Sections nicht gefunden. TOC wird nicht initialisiert.');
      return;
    }
    
    // Leeres Dokumenten-Fragment erstellen, um Performance zu verbessern
    const frag = document.createDocumentFragment();

    UI.headings.forEach(section => {
      const id = section.id;
      const title = section.getAttribute('aria-label'); // Den Titel aus aria-label holen

      if (!id || !title) return; // Überspringen, wenn ID oder Titel fehlen

      const li = document.createElement('li');
      const a = document.createElement('a');
      a.href = `#${id}`;
      a.textContent = title;
      li.appendChild(a);
      frag.appendChild(li);
    });

    UI.tocList.appendChild(frag); // Das gefüllte Fragment zur Liste hinzufügen
  }

  /**
   * Richtet den IntersectionObserver ein, um zu beobachten, welche Section gerade sichtbar ist.
   */
  function setupIntersectionObserver() {
    if (UI.headings.length < 1 || !UI.tocContainer) return;

    const observer = new IntersectionObserver((entries) => {
      // Finde die erste sichtbare Section von oben
      const firstVisibleEntry = entries.find(entry => entry.isIntersecting);
      
      let activeId = null;
      if (firstVisibleEntry) {
        activeId = firstVisibleEntry.target.id;
      }

      // Aktiviere den passenden Link im TOC
      UI.tocList.querySelectorAll('a').forEach(a => {
        a.classList.toggle('active', a.getAttribute('href') === `#${activeId}`);
      });
      
      // Das TOC "scharfschalten", wenn die zweite Section erreicht wird
      const secondSection = UI.headings[1]; 
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
      rootMargin: '0px 0px -75% 0px', // Eine Section ist "aktiv", wenn sie im oberen 25% des Viewports ist
      threshold: 0 
    });

    UI.headings.forEach(h => observer.observe(h));
  }

   /**
   * Steuert die Sichtbarkeit des TOC. Es wird kurz angezeigt, wenn die Maus bewegt wird.
   */
  function setupTocVisibility() {
    if (!UI.tocContainer) return;
    
    const show = () => {
      // Nur anzeigen, wenn das TOC "scharfgeschaltet" ist (man weit genug gescrollt hat)
      if (!state.isTocArmed) return;
      
      UI.tocContainer.classList.add('is-visible');
      clearTimeout(state.tocHideTimer); // Alten Timer löschen
      // Das TOC nach 2.5 Sekunden Inaktivität wieder ausblenden
      state.tocHideTimer = setTimeout(() => UI.tocContainer.classList.remove('is-visible'), 2500);
    };
    
    // Auf Mausbewegung und Klicks hören, um das TOC zu zeigen
    window.addEventListener('mousemove', show, { passive: true });
    window.addEventListener('click', show);
  }

  /**
   * Hauptfunktion, die alle Initialisierungen startet.
   */
  function init() {
    initTOC();
    setupIntersectionObserver();
    setupTocVisibility();
  }

  init(); // Start!
});
