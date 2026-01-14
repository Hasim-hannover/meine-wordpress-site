document.addEventListener("DOMContentLoaded", function() {
    
    // 1. ZOMBIE KILLER (Sicherheit)
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();

    // 2. FORCE BLOG GRID (Die Brechstange für deine Karten)
    function forceBlogGrid() {
        // Wir suchen alle Artikel im Inhaltsbereich
        const articles = document.querySelectorAll('.cs-page article, .cs-page .post, .cs-page .type-post');
        
        if (articles.length > 0) {
            // Nimm das Elternelement des ersten Artikels (das ist der Container)
            const container = articles[0].parentElement;
            
            if (container) {
                // Erzwinge Grid-Layout direkt am Element
                container.style.display = 'grid';
                container.style.gap = '2rem';
                container.style.listStyle = 'none';
                container.style.padding = '0';
                
                // Responsive Logik für den Container
                const updateGrid = () => {
                    if (window.innerWidth > 1024) {
                        container.style.gridTemplateColumns = 'repeat(3, 1fr)'; // Desktop: 3 Spalten
                    } else if (window.innerWidth > 768) {
                        container.style.gridTemplateColumns = 'repeat(2, 1fr)'; // Tablet: 2 Spalten
                    } else {
                        container.style.gridTemplateColumns = '1fr'; // Mobile: 1 Spalte
                    }
                };
                
                // Initial und bei Resize ausführen
                updateGrid();
                window.addEventListener('resize', updateGrid);
                
                // Styling für die Karten selbst erzwingen
                articles.forEach(art => {
                    art.style.boxSizing = 'border-box';
                    art.style.width = '100%';
                    art.style.maxWidth = '100%';
                    art.classList.add('nexus-card-forced'); // Klasse für CSS-Styling (Hover etc.)
                });
                
                console.log('Nexus: Blog Grid wurde erzwungen.');
            }
        }
    }
    // Kurz warten, damit Shortcodes geladen sind, dann feuern
    setTimeout(forceBlogGrid, 100);


    // 3. STICKY NAVIGATION & SCROLL SPY
    const nav = document.getElementById('wpTocNav');
    const hero = document.getElementById('hero');
    const tocLinks = document.querySelectorAll('.wp-toc-link');
    
    if (nav && hero) {
        // Sichtbarkeit
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

        // Active State (Leuchten)
        const sectionIds = Array.from(tocLinks).map(link => link.getAttribute('href').substring(1));
        const sections = sectionIds.map(id => document.getElementById(id)).filter(s => s);

        const highlightObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    tocLinks.forEach(link => link.classList.remove('active'));
                    const activeLink = document.querySelector(`.wp-toc-link[href="#${entry.target.id}"]`);
                    if (activeLink) activeLink.classList.add('active');
                }
            });
        }, { root: null, rootMargin: "-30% 0px -50% 0px", threshold: 0 });

        sections.forEach(sec => highlightObserver.observe(sec));
    }

    // 4. FAQ ACCORDION
    const details = document.querySelectorAll("details.wp-faq-item");
    details.forEach((target) => {
        target.addEventListener("click", () => {
            details.forEach((d) => { if (d !== target) d.removeAttribute("open"); });
        });
    });

    // 5. KPI ANIMATION
    const metrics = document.querySelectorAll('.wp-metric-value');
    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            obj.innerText = Math.floor(ease * (end - start) + start);
            if (progress < 1) window.requestAnimationFrame(step);
            else obj.innerText = end;
        };
        window.requestAnimationFrame(step);
    };

    const metricsObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const t = entry.target;
                const v = parseInt(t.getAttribute('data-target'));
                if (!isNaN(v)) {
                    animateValue(t, 0, v, 2000);
                    obs.unobserve(t);
                }
            }
        });
    }, { threshold: 0.1 });

    metrics.forEach(m => {
        if(m.getAttribute('data-target')) { m.innerText = "0"; metricsObserver.observe(m); }
    });
});