document.addEventListener("DOMContentLoaded", function() {
    
    // --- ZOMBIE KILLER ---
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();

    // --- 1. Sticky Navigation & Scroll Spy ---
    const nav = document.getElementById('wpTocNav');
    const hero = document.getElementById('hero');
    // Alle Links im Inhaltsverzeichnis holen
    const tocLinks = document.querySelectorAll('.wp-toc-link');
    
    // Array der Sektions-IDs, die wir beobachten wollen (basierend auf den Links)
    const sectionIds = Array.from(tocLinks).map(link => link.getAttribute('href').substring(1));
    const sections = sectionIds.map(id => document.getElementById(id)).filter(sec => sec); // Nur existierende Sektionen

    if (nav && hero) {
        // A. Sichtbarkeit des Menüs (erst nach Hero)
        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    nav.classList.add('is-visible');
                } else {
                    nav.classList.remove('is-visible');
                }
            });
        }, { rootMargin: "-100px 0px 0px 0px" });

        heroObserver.observe(hero);

        // B. Active State Highlighting (Scroll Spy)
        const highlightObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Alle Active-Klassen entfernen
                    tocLinks.forEach(link => link.classList.remove('active'));
                    
                    // Den passenden Link finden und Active setzen
                    const activeLink = document.querySelector(`.wp-toc-link[href="#${entry.target.id}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            });
        }, { 
            root: null, 
            rootMargin: "-40% 0px -40% 0px", // Aktiviert Sektion, wenn sie in der Mitte des Screens ist
            threshold: 0 
        });

        sections.forEach(section => {
            highlightObserver.observe(section);
        });
    }

    // --- 2. KPI Zahlen Animation ---
    const metrics = document.querySelectorAll('.wp-metric-value');

    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * (end - start) + start);
            obj.innerHTML = currentVal;
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.innerHTML = end;
            }
        };
        window.requestAnimationFrame(step);
    };

    const metricsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const targetValue = parseInt(target.getAttribute('data-target'));
                if (!isNaN(targetValue)) {
                    animateValue(target, 0, targetValue, 2000);
                    observer.unobserve(target);
                }
            }
        });
    }, { threshold: 0.1 }); 

    metrics.forEach(metric => {
        if(metric.getAttribute('data-target')) {
            metric.innerText = "0"; 
            metricsObserver.observe(metric);
        }
    });
});