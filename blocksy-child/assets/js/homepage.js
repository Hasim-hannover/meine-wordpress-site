/**
 * TOC-Skript für die Startseite, basierend auf der finalen Analyse.
 * Führt die Initialisierung sofort aus, anstatt auf das 'load'-Event zu warten.
 */

function initHomepageTOC() {
    // UI-Elemente und Zustand initialisieren
    const UI = {
        mainContent: document.querySelector('main'),
        tocContainer: document.getElementById('toc-container'),
        tocList: document.getElementById('toc-list'),
    };

    // Prüfen, ob die notwendigen Elemente vorhanden sind.
    if (!UI.mainContent || !UI.tocContainer || !UI.tocList) {
        console.log('TOC init abgebrochen: Wichtige HTML-Elemente fehlen.');
        if (UI.tocContainer) UI.tocContainer.style.display = 'none';
        return;
    }

    // Finde alle h2-Überschriften im main-Bereich, die eine ID haben.
    const headings = Array.from(UI.mainContent.querySelectorAll('h2[id]'));

    // Wenn weniger als 2 Überschriften gefunden werden, macht ein TOC keinen Sinn.
    if (headings.length < 2) {
        console.log('TOC init abgebrochen: Weniger als 2 relevante Überschriften gefunden.');
        UI.tocContainer.style.display = 'none';
        return;
    }

    /**
     * Baut das Inhaltsverzeichnis (TOC) aus den gefundenen Überschriften.
     */
    function buildTOC() {
        const fragment = document.createDocumentFragment();
        headings.forEach(h => {
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = `#${h.id}`;
            // Bereinige den Text von eventuellen inneren HTML-Tags (z.B. <br>)
            a.textContent = h.textContent.trim();
            li.appendChild(a);
            fragment.appendChild(li);
        });
        UI.tocList.appendChild(fragment);
    }

    /**
     * Initialisiert den IntersectionObserver, um die aktive Überschrift zu verfolgen.
     */
    function setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            let firstVisibleId = null;

            // Finde die erste sichtbare Überschrift von oben.
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    firstVisibleId = entry.target.id;
                    break;
                }
            }

            // Fallback: Wenn keine Überschrift im Threshold sichtbar ist,
            // nimm die letzte, die über dem Viewport liegt.
            if (!firstVisibleId) {
                for (let i = headings.length - 1; i >= 0; i--) {
                    if (headings[i].getBoundingClientRect().top < 150) {
                        firstVisibleId = headings[i].id;
                        break;
                    }
                }
            }

            // Aktualisiere die 'active' Klasse im TOC.
            UI.tocList.querySelectorAll('a').forEach(a => {
                a.classList.toggle('active', a.getAttribute('href') === `#${firstVisibleId}`);
            });
            
            // Logik zum Einblenden des TOC-Containers
            const firstHeadingEntry = entries.find(e => e.target === headings[0]);
            if (firstHeadingEntry) {
                 const isTocVisible = firstHeadingEntry.boundingClientRect.top < window.innerHeight / 2;
                 UI.tocContainer.classList.toggle('is-visible', isTocVisible);
            }

        }, {
            rootMargin: '0px 0px -80% 0px', // Beobachtet einen schmalen Streifen am oberen Rand des Viewports
            threshold: 0
        });

        headings.forEach(h => observer.observe(h));
    }
    
    // Führe die Hauptfunktionen aus
    buildTOC();
    setupIntersectionObserver();
    console.log(`TOC erfolgreich initialisiert mit ${headings.length} Überschriften.`);
}

// =============================================================================
// SOFORTIGER AUFRUF
// Die Funktion wird direkt ausgeführt, da das Skript im Footer geladen wird
// und das DOM zu diesem Zeitpunkt bereit ist.
// =============================================================================
initHomepageTOC();

