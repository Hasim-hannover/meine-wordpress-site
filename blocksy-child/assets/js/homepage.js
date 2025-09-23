/**
 * JavaScript für die Startseite:
 * 1. FAQ-Akkordeon (eine Frage öffnet, andere schließen)
 * 2. Sticky Table of Contents
 * 3. Aktiven Link im TOC hervorheben
 */
document.addEventListener('DOMContentLoaded', function () {

    // ======================================================
    // DEINE BESTEHENDE FAQ-FUNKTION (bleibt erhalten)
    // ======================================================
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const frage = item.querySelector('.faq-frage');
        frage.addEventListener('click', () => {
            // Schließe alle anderen offenen Antworten
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                    const otherAntwort = otherItem.querySelector('.faq-antwort');
                    otherAntwort.style.maxHeight = null;
                }
            });

            // Öffne oder schließe die angeklickte Antwort
            item.classList.toggle('active');
            const antwort = item.querySelector('.faq-antwort');
            if (item.classList.contains('active')) {
                antwort.style.maxHeight = antwort.scrollHeight + 'px';
            } else {
                antwort.style.maxHeight = null;
            }
        });
    });

    // ======================================================
    // NEUE FUNKTION: Sticky Table of Contents
    // ======================================================
    const tocNav = document.getElementById('toc-nav');
    if (tocNav) {
        const sections = document.querySelectorAll('section[id]');
        const tocLinks = tocNav.querySelectorAll('a');

        // Macht das TOC sichtbar, sobald man scrollt
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                tocNav.classList.add('visible');
            } else {
                tocNav.classList.remove('visible');
            }
        }, { passive: true });

        // Hebt den aktuellen Abschnitt im TOC hervor
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    tocLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${entry.target.id}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, { rootMargin: '-50% 0px -50% 0px' });

        sections.forEach(section => {
            observer.observe(section);
        });
    }
});