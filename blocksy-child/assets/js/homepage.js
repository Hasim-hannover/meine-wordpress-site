document.addEventListener("DOMContentLoaded", function() {
    
    // ==========================================
    // 1. ZOMBIE KILLER (Sicherheit)
    // ==========================================
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();


    // ==========================================
    // 2. FORCE BLOG GRID (Design-Brechstange)
    // ==========================================
    function forceBlogGrid() {
        const articles = document.querySelectorAll('.cs-page article, .cs-page .post, .cs-page .type-post');
        
        if (articles.length > 0) {
            const container = articles[0].parentElement;
            
            if (container) {
                container.style.display = 'grid';
                container.style.gap = '2rem';
                container.style.listStyle = 'none';
                container.style.padding = '0';
                
                const updateGrid = () => {
                    if (window.innerWidth > 1024) {
                        container.style.gridTemplateColumns = 'repeat(3, 1fr)';
                    } else if (window.innerWidth > 768) {
                        container.style.gridTemplateColumns = 'repeat(2, 1fr)';
                    } else {
                        container.style.gridTemplateColumns = '1fr';
                    }
                };
                
                updateGrid();
                window.addEventListener('resize', updateGrid);
                
                articles.forEach(art => {
                    art.style.boxSizing = 'border-box';
                    art.style.width = '100%';
                    art.style.maxWidth = '100%';
                    art.classList.add('nexus-card-forced');
                });
            }
        }
    }
    setTimeout(forceBlogGrid, 100);


    // ==========================================
    // 3. SMART STICKY NAV (NEU & KORRIGIERT)
    // ==========================================
    const navLinks = document.querySelectorAll('.smart-nav a');
    
    // Wir suchen nach Sections mit ID UND dem Audit-Div (da das keine Section ist)
    const sections = document.querySelectorAll('section[id], div[id="audit"]');

    function updateNav() {
        let current = "";
        
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            // Wenn wir 300px vor der Section sind, gilt sie als aktiv
            if (window.scrollY >= (sectionTop - 300)) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((a) => {
            a.classList.remove("active");
            // Checkt, ob der Link die aktuelle ID enthält
            if (a.getAttribute("href").includes(current)) {
                a.classList.add("active");
            }
        });
    }

    // Feuern beim Scrollen & einmal beim Laden
    if (navLinks.length > 0) {
        window.addEventListener("scroll", updateNav);
        updateNav();
    }


    // ==========================================
    // 4. FAQ ACCORDION
    // ==========================================
    const details = document.querySelectorAll("details.wp-faq-item");
    details.forEach((target) => {
        target.addEventListener("click", () => {
            details.forEach((d) => { if (d !== target) d.removeAttribute("open"); });
        });
    });


    // ==========================================
    // 5. KPI ANIMATION (Zahlen hochzählen)
    // ==========================================
    const metrics = document.querySelectorAll('.wp-metric-value');
    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            
            // Formatierung (bei 94 ohne %, bei 1750 mit +)
            let val = Math.floor(ease * (end - start) + start);
            obj.innerText = val; 

            // Hardcode-Fix für Text-Werte wie "High" oder "DE" (überspringt Animation)
            if (isNaN(end)) { obj.innerText = obj.getAttribute('data-target'); return; }

            if (progress < 1) window.requestAnimationFrame(step);
            else obj.innerText = end;
        };
        window.requestAnimationFrame(step);
    };

    const metricsObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const t = entry.target;
                // Prüfen ob es eine Zahl ist
                const targetVal = t.getAttribute('data-target');
                const v = parseInt(targetVal); // Versucht Zahl zu parsen
                
                if (!isNaN(v)) {
                    animateValue(t, 0, v, 2000);
                } else {
                    // Wenn es Text ist (z.B. "High"), einfach anzeigen
                    t.innerText = targetVal;
                }
                obs.unobserve(t);
            }
        });
    }, { threshold: 0.1 });

    metrics.forEach(m => {
        if(m.getAttribute('data-target')) { 
            // Nur Nullen setzen, wenn es eine Zahl werden soll
            if(!isNaN(parseInt(m.getAttribute('data-target')))) {
                m.innerText = "0"; 
            }
            metricsObserver.observe(m); 
        }
    });
});