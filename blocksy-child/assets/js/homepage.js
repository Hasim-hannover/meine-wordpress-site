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

    // 3. SMART STICKY NAV (Korrigiert für neue HTML-Struktur)
    const navLinks = document.querySelectorAll('.smart-nav a');
    const sections = document.querySelectorAll('section[id], div[id="audit"]');

    function updateNav() {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            // Wenn wir 300px vor der Section sind
            if (window.scrollY >= (sectionTop - 300)) {
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
    if(navLinks.length > 0) {
        window.addEventListener("scroll", updateNav);
        updateNav();
    }

    // 4. FAQ
    const details = document.querySelectorAll("details.wp-faq-item, details");
    details.forEach((target) => {
        target.addEventListener("click", () => {
            details.forEach((d) => { if (d !== target) d.removeAttribute("open"); });
        });
    });

    // 5. KPI ANIMATION (Korrigiert für -83%)
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