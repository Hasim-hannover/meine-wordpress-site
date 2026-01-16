document.addEventListener("DOMContentLoaded", function() {
    
    // 1. ZOMBIE KILLER
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) zombieCode.remove();

    // 2. FORCE BLOG GRID
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

    // 3. SMART STICKY NAV (Der Fix)
    const navLinks = document.querySelectorAll('.smart-nav a');
    const sections = document.querySelectorAll('section[id], div[id="audit"]'); // Findet auch die Audit-Karte

    function updateNav() {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            // Wenn wir 250px vor der Section sind, aktivieren wir sie
            if (window.scrollY >= (sectionTop - 250)) {
                current = section.getAttribute("id");
            }
        });
        
        navLinks.forEach((a) => {
            a.classList.remove("active");
            if (a.getAttribute("href").includes(current)) {
                a.classList.add("active");
            }
        });
    }
    if (navLinks.length > 0) {
        window.addEventListener("scroll", updateNav);
        updateNav(); // Initialer Check
    }

    // 4. FAQ
    const details = document.querySelectorAll("details.wp-faq-item, details");
    details.forEach((target) => {
        target.addEventListener("click", () => {
            details.forEach((d) => { if (d !== target) d.removeAttribute("open"); });
        });
    });

    // 5. KPI ANIMATION (Der Fix für -83%)
    const metrics = document.querySelectorAll('.wp-metric-value');
    
    const animateValue = (obj, start, end, duration, prefix = "", suffix = "") => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * (end - start) + start);
            
            // Hier bauen wir den String zusammen: "- 83 %"
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
                
                // Wir holen die Rohdaten aus den Attributen (falls gesetzt)
                // Beispiel HTML: <span data-value="-83" data-suffix="%">
                let rawVal = t.getAttribute('data-value');
                
                // Falls kein Attribut da ist, nimm den Textinhalt (Fallback)
                if (!rawVal) rawVal = t.innerText;

                // Prüfen ob es Text ist (z.B. "High") -> Keine Animation
                if (isNaN(parseInt(rawVal))) {
                    t.innerText = rawVal;
                    obs.unobserve(t);
                    return;
                }

                // Zahl extrahieren und Vorzeichen merken
                let val = parseInt(rawVal);
                let prefix = t.getAttribute('data-prefix') || ""; 
                let suffix = t.getAttribute('data-suffix') || "";

                // Automatisches Erkennen von Minus im Wert
                if (val < 0) {
                     // Wenn die Zahl negativ ist (z.B. -83), ist das Minus schon in 'val' enthalten
                     // Wir müssen es nicht extra als Prefix setzen, JS macht das bei negativen Zahlen automatisch.
                } else if (rawVal.includes('+')) {
                    prefix = "+"; // Pluszeichen erzwingen wenn im Text
                }
                
                // Start Animation (immer von 0 auf Zielwert)
                animateValue(t, 0, val, 2000, prefix, suffix);
                obs.unobserve(t);
            }
        });
    }, { threshold: 0.1 });

    metrics.forEach(m => {
        metricsObserver.observe(m);
    });
});