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
                    if (window.innerWidth > 1024) container.style.gridTemplateColumns = 'repeat(3, 1fr)';
                    else if (window.innerWidth > 768) container.style.gridTemplateColumns = 'repeat(2, 1fr)';
                    else container.style.gridTemplateColumns = '1fr';
                };
                updateGrid();
                window.addEventListener('resize', updateGrid);
                articles.forEach(art => {
                    art.style.boxSizing = 'border-box';
                    art.style.width = '100%';
                    art.classList.add('nexus-card-forced');
                });
            }
        }
    }
    setTimeout(forceBlogGrid, 100);

    // ==========================================
    // 3. SMART STICKY NAV (LASER SCHRANKE - V2)
    // ==========================================
    const navLinks = document.querySelectorAll('.smart-nav a');
    const sections = document.querySelectorAll('section[id], div[id="audit"]'); // Deine Ziele

    // Optionen für den "Laser": 
    // rootMargin: '-50% 0px -50% 0px' bedeutet: Es feuert GENAU in der Mitte des Bildschirms.
    const observerOptions = {
        root: null,
        rootMargin: '-45% 0px -55% 0px', 
        threshold: 0
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // 1. Welche ID ist gerade in der Mitte?
                const activeId = entry.target.getAttribute('id');
                // console.log("Sektion aktiv:", activeId); // Zum Testen

                // 2. Alle Links ausschalten
                navLinks.forEach(link => link.classList.remove('active'));

                // 3. Den passenden Link suchen und anschalten
                // Wir nutzen .includes(), das ist toleranter als ein exakter Vergleich
                const activeLink = document.querySelector(`.smart-nav a[href*="#${activeId}"]`);
                
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });
    }, observerOptions);

    // Observer starten
    sections.forEach(section => {
        observer.observe(section);
    });
    // ==========================================
    // 4. FAQ ACCORDION
    // ==========================================
    const details = document.querySelectorAll("details.wp-faq-item, details");
    details.forEach((target) => {
        target.addEventListener("click", () => {
            details.forEach((d) => { if (d !== target) d.removeAttribute("open"); });
        });
    });

    // ==========================================
    // 5. KPI ANIMATION (Mit Minus-Support)
    // ==========================================
    const metrics = document.querySelectorAll('.wp-metric-value');
    
    const animateValue = (obj, start, end, duration, prefix = "", suffix = "") => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * (end - start) + start);
            obj.innerText = prefix + currentVal + suffix;

            if (progress < 1) window.requestAnimationFrame(step);
            else obj.innerText = prefix + end + suffix;
        };
        window.requestAnimationFrame(step);
    };

    const metricsObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const t = entry.target;
                let rawVal = t.getAttribute('data-value');
                if (!rawVal) rawVal = t.innerText;

                if (isNaN(parseInt(rawVal))) {
                    t.innerText = rawVal;
                    obs.unobserve(t);
                    return;
                }

                let val = parseInt(rawVal);
                let prefix = t.getAttribute('data-prefix') || ""; 
                let suffix = t.getAttribute('data-suffix') || "";
                
                if (rawVal.includes('+') && !prefix) prefix = "+";

                animateValue(t, 0, val, 2000, prefix, suffix);
                obs.unobserve(t);
            }
        });
    }, { threshold: 0.1 });

    metrics.forEach(m => { metricsObserver.observe(m); });
});