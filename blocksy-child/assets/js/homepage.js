/**
 * JavaScript für die Startseite - FINALE VERSION
 * Korrektur: Der TOC-Selektor ist jetzt unabhängig von der <main>-ID
 * und funktioniert garantiert in WordPress.
 */
document.addEventListener('DOMContentLoaded', function() {

    // --- SCRIPT FÜR NUMMERN-ANIMATION ---
    try {
        const statsObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const target = parseInt(element.dataset.target, 10);
                    if (isNaN(target) || element.classList.contains('animated')) return;
                    element.classList.add('animated');
                    let current = 0;
                    const duration = 2000;
                    const stepTime = Math.max(1, Math.floor(duration / target));
                    const timer = setInterval(() => {
                        current += 1;
                        if (current >= target) {
                            element.textContent = target.toLocaleString('de-DE');
                            clearInterval(timer);
                        } else {
                           element.textContent = current;
                        }
                    }, stepTime);
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.8 });
        document.querySelectorAll('.hero-stats .num').forEach(num => statsObserver.observe(num));
    } catch(e) { console.error("Fehler bei Zähl-Animation:", e); }

    // --- SCRIPT FÜR FAQ AKKORDEON ---
    try {
        document.querySelectorAll('.faq details').forEach(detailsEl => {
            detailsEl.addEventListener('toggle', () => {
                if (detailsEl.open) {
                    document.querySelectorAll('.faq details').forEach(other => {
                        if (other !== detailsEl) other.open = false;
                    });
                }
            });
        });
    } catch(e) { console.error("Fehler bei FAQ:", e); }

    // --- SCRIPT FÜR STICKY TOC & IDLE BEHAVIOR ---
    try {
        const tocNav = document.getElementById('toc-nav');
        const heroSection = document.getElementById('start');
        // FINALE KORREKTUR HIER: Wir suchen nach allen Sections mit einer ID, egal wo.
        const sections = document.querySelectorAll('section[id]');
        const tocLinks = document.querySelectorAll('#toc-nav a');

        if (tocNav && heroSection && sections.length > 0) {
            let idleTimeout;
            let isTocVisible = false;

            const resetTocIdleTimer = () => {
                if (!isTocVisible) return;
                tocNav.classList.remove('idle');
                clearTimeout(idleTimeout);
                idleTimeout = setTimeout(() => tocNav.classList.add('idle'), 3000);
            };
            
            const heroObserver = new IntersectionObserver(entries => {
                const [entry] = entries;
                const shouldBeVisible = !entry.isIntersecting;
                
                if (shouldBeVisible && !isTocVisible) {
                    isTocVisible = true;
                    tocNav.classList.add('visible');
                    resetTocIdleTimer();
                    window.addEventListener('mousemove', resetTocIdleTimer, { passive: true });
                    window.addEventListener('scroll', resetTocIdleTimer, { passive: true });
                } else if (!shouldBeVisible && isTocVisible) {
                    isTocVisible = false;
                    tocNav.classList.remove('visible');
                    clearTimeout(idleTimeout);
                    window.removeEventListener('mousemove', resetTocIdleTimer);
                    window.removeEventListener('scroll', resetTocIdleTimer);
                }
            }, { rootMargin: "0px 0px -250px 0px", threshold: 0 });
            
            heroObserver.observe(heroSection);

            const sectionObserver = new IntersectionObserver(entries => {
                let currentActive = '';
                entries.forEach(entry => {
                    if (entry.isIntersecting && !currentActive) {
                        currentActive = entry.target.getAttribute('id');
                    }
                });
                if (currentActive) {
                    tocLinks.forEach(link => {
                        link.classList.toggle('active', link.getAttribute('href') === `#${currentActive}`);
                    });
                }
            }, { rootMargin: '-40% 0px -55% 0px', threshold: [0.2, 0.8] });

            sections.forEach(section => sectionObserver.observe(section));
        } else {
            console.error('TOC konnte nicht initialisiert werden. Elemente fehlen (toc-nav, start, sections mit IDs).');
        }
    } catch(e) { console.error("Fehler bei TOC:", e); }
});