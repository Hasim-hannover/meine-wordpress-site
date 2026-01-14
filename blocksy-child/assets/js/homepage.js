document.addEventListener("DOMContentLoaded", function() {
    
    // --- 0. ZOMBIE KILLER (Sicherheit) ---
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();

    // --- 1. Sticky Navigation & Scroll Spy ---
    const nav = document.getElementById('wpTocNav');
    const hero = document.getElementById('hero');
    const tocLinks = document.querySelectorAll('.wp-toc-link');
    
    // Sektionen finden
    const sectionIds = Array.from(tocLinks).map(link => {
        const href = link.getAttribute('href');
        return href.startsWith('#') ? href.substring(1) : null;
    }).filter(id => id); 

    const sections = sectionIds.map(id => document.getElementById(id)).filter(sec => sec);

    if (nav && hero) {
        // A. Sichtbarkeit (Menü einblenden nach Hero)
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

        // B. Active State Highlighting (Welcher Punkt leuchtet?)
        const highlightObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    tocLinks.forEach(link => link.classList.remove('active'));
                    const activeLink = document.querySelector(`.wp-toc-link[href="#${entry.target.id}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                    }
                }
            });
        }, { 
            root: null, 
            rootMargin: "-20% 0px -60% 0px", 
            threshold: 0 
        });

        sections.forEach(section => {
            highlightObserver.observe(section);
        });
    }

    // --- 2. FAQ Accordion (Exklusiv: Eins auf, andere zu) ---
    const details = document.querySelectorAll("details.wp-faq-item");

    details.forEach((targetDetail) => {
        targetDetail.addEventListener("click", () => {
            // Schließe alle anderen Details-Elemente
            details.forEach((detail) => {
                if (detail !== targetDetail) {
                    detail.removeAttribute("open");
                }
            });
        });
    });

    // --- 3. KPI Animation (Zuverlässiger Start) ---
    const metrics = document.querySelectorAll('.wp-metric-value');

    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            // Easing (Schnell starten, sanft bremsen)
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * (end - start) + start);
            
            // Check auf Vorzeichen im HTML (optional, hier einfach Zahl)
            obj.innerText = currentVal;
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.innerText = end; // Endwert sicherstellen
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
                    // Animation starten
                    animateValue(target, 0, targetValue, 2000);
                    observer.unobserve(target); // Beobachtung stoppen
                }
            }
        });
    }, { threshold: 0.1 }); // Feuert, sobald 10% sichtbar sind

    metrics.forEach(metric => {
        if(metric.getAttribute('data-target')) {
            metric.innerText = "0"; // Startwert auf 0 setzen
            metricsObserver.observe(metric);
        }
    });
});