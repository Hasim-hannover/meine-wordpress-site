document.addEventListener("DOMContentLoaded", function() {
    
    // --- 0. ZOMBIE KILLER (Sicherheitshalber drin lassen) ---
    const zombieCode = document.getElementById('nexus-home-critical');
    if (zombieCode) {
        zombieCode.remove();
    }

    // --- 1. Sticky Navigation Observer ---
    const nav = document.getElementById('wpTocNav');
    const hero = document.getElementById('hero');

    if (nav && hero) {
        // Wir prüfen, ob wir auf Mobile sind, um unnötige Logik zu sparen
        const observerOptions = {
            root: null,
            threshold: 0, 
            rootMargin: "-100px 0px 0px 0px" 
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    nav.classList.add('is-visible');
                } else {
                    nav.classList.remove('is-visible');
                }
            });
        }, observerOptions);

        observer.observe(hero);
    }

    // --- 2. KPI Animation (0 -> Zielwert) ---
    const metrics = document.querySelectorAll('.wp-metric-value');

    // Funktion für die Animation
    const runAnimation = (obj, endValue) => {
        let startTimestamp = null;
        const duration = 2000; // 2 Sekunden Dauer
        
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            
            // Easing (Bremst am Ende ab)
            const ease = 1 - Math.pow(1 - progress, 3);
            
            const currentVal = Math.floor(ease * endValue);
            
            // Checken ob ein "+" oder "%" im HTML war und es anhängen (optional)
            // Hier machen wir es simpel: Nur die Zahl.
            obj.innerHTML = currentVal;
            
            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                obj.innerHTML = endValue; // Sicherstellen, dass der Endwert exakt stimmt
            }
        };
        window.requestAnimationFrame(step);
    };

    const metricsObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                // Wert aus data-target lesen
                const targetValue = parseInt(target.getAttribute('data-target'));
                
                if (!isNaN(targetValue)) {
                    runAnimation(target, targetValue);
                    observer.unobserve(target); // Nur einmal animieren
                }
            }
        });
    }, { threshold: 0.1 }); // Feuert, sobald 10% sichtbar sind

    // Initialisierung
    metrics.forEach(metric => {
        const val = metric.getAttribute('data-target');
        if(val) {
            // Sofort auf 0 setzen, damit man den Sprung sieht
            metric.innerText = "0"; 
            metricsObserver.observe(metric);
        }
    });
});