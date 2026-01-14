document.addEventListener("DOMContentLoaded", function() {
    
    // --- 0. ZOMBIE KILLER ---
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();

    // --- 1. Sticky Navigation & Scroll Spy (Active State) ---
    const nav = document.getElementById('wpTocNav');
    const hero = document.getElementById('hero');
    const tocLinks = document.querySelectorAll('.wp-toc-link');
    
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

        // B. Active State Highlighting
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
            rootMargin: "-30% 0px -50% 0px", // Trigger-Bereich optimiert
            threshold: 0 
        });

        sections.forEach(section => {
            highlightObserver.observe(section);
        });
    }

    // --- 2. FAQ Accordion (Auto-Close) ---
    const details = document.querySelectorAll("details.wp-faq-item");

    details.forEach((targetDetail) => {
        targetDetail.addEventListener("click", () => {
            details.forEach((detail) => {
                if (detail !== targetDetail) {
                    detail.removeAttribute("open");
                }
            });
        });
    });

    // --- 3. KPI Animation (Zuverlässiger) ---
    const metrics = document.querySelectorAll('.wp-metric-value');

    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * (end - start) + start);
            obj.innerText = currentVal;
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.innerText = end; 
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