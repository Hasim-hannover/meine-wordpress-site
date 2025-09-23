/**
 * JavaScript für die Startseite:
 * 1. FAQ-Akkordeon
 * 2. Sticky Table of Contents
 * 3. NEU: Zähl-Animation für Erfolgszahlen
 */
document.addEventListener('DOMContentLoaded', function () {

    // ======================================================
    // FUNKTION 1: FAQ-Akkordeon (bleibt erhalten)
    // ======================================================
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const frage = item.querySelector('.faq-frage');
        if (frage) {
            frage.addEventListener('click', () => {
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                        const otherAntwort = otherItem.querySelector('.faq-antwort');
                        if (otherAntwort) otherAntwort.style.maxHeight = null;
                    }
                });
                item.classList.toggle('active');
                const antwort = item.querySelector('.faq-antwort');
                if (item.classList.contains('active') && antwort) {
                    antwort.style.maxHeight = antwort.scrollHeight + 'px';
                } else if (antwort) {
                    antwort.style.maxHeight = null;
                }
            });
        }
    });

    // ======================================================
    // FUNKTION 2: Sticky Table of Contents (bleibt erhalten)
    // ======================================================
    const tocNav = document.getElementById('toc-nav');
    if (tocNav) {
        const sections = document.querySelectorAll('section[id]');
        const tocLinks = tocNav.querySelectorAll('a');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 200) {
                tocNav.classList.add('visible');
            } else {
                tocNav.classList.remove('visible');
            }
        }, { passive: true });
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
        sections.forEach(section => observer.observe(section));
    }

    // ======================================================
    // NEUE FUNKTION 3: Zähl-Animation
    // ======================================================
    const statsContainer = document.querySelector('.hero-stats');
    if (statsContainer) {
        const animateNumbers = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const numberElements = entry.target.querySelectorAll('.num[data-ziel]');
                    numberElements.forEach(el => {
                        const ziel = parseFloat(el.getAttribute('data-ziel'));
                        let start = 0;
                        const dauer = 2000; // 2 Sekunden für die Animation
                        const schritte = 100;
                        const intervall = dauer / schritte;
                        const schrittweite = ziel / schritte;

                        let aktuellerSchritt = 0;
                        const timer = setInterval(() => {
                            aktuellerSchritt++;
                            start += schrittweite;
                            if (aktuellerSchritt >= schritte) {
                                el.textContent = ziel.toLocaleString('de-DE'); // Formatiert die Endzahl
                                clearInterval(timer);
                            } else {
                                el.textContent = Math.round(start).toLocaleString('de-DE');
                            }
                        }, intervall);
                    });
                    observer.unobserve(entry.target); // Animation nur einmal ausführen
                }
            });
        };

        const statObserver = new IntersectionObserver(animateNumbers, {
            threshold: 0.5 // Startet, wenn 50% des Bereichs sichtbar sind
        });

        statObserver.observe(statsContainer);
    }
});