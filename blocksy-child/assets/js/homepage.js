document.addEventListener('DOMContentLoaded', function() {
      
    // FAQ Accordion Logic
    const details = document.querySelectorAll("details");
    details.forEach((targetDetail) => {
      targetDetail.addEventListener("click", () => {
        details.forEach((detail) => {
          if (detail !== targetDetail) {
            detail.removeAttribute("open");
          }
        });
      });
    });

    // Sticky TOC Logic (Only shows after Hero)
    const tocNav = document.getElementById('wpTocNav');
    const heroSection = document.getElementById('hero');
    
    // Check if elements exist and if we are on desktop
    if (tocNav && heroSection && window.innerWidth > 1024) {
      
      const observerOptions = {
        root: null,
        threshold: 0,
        // Trigger when the bottom of hero passes the top of viewport
        rootMargin: "-100px 0px 0px 0px" 
      };

      const heroObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          // If Hero is NOT intersecting (scrolled past), show TOC
          if (!entry.isIntersecting && entry.boundingClientRect.top < 0) {
            tocNav.classList.add('is-visible');
          } else {
            tocNav.classList.remove('is-visible');
          }
        });
      }, observerOptions);

      heroObserver.observe(heroSection);

      // Highlight active section in TOC
      const sections = document.querySelectorAll('section[id]');
      const tocLinks = document.querySelectorAll('.wp-toc-link');

      const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const id = entry.target.getAttribute('id');
            tocLinks.forEach(link => {
              link.classList.remove('wp-active');
              if (link.getAttribute('href') === '#' + id) {
                link.classList.add('wp-active');
              }
            });
          }
        });
      }, { rootMargin: "-50% 0px -50% 0px" });

      sections.forEach(section => {
        sectionObserver.observe(section);
      });
    }

    // Smooth Scroll for TOC links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });

    // NEXUS ADDITION: Number Counter Animation
    const stats = document.querySelectorAll('.wp-metric-value');
    
    if (stats.length > 0) {
        const statsObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.getAttribute('data-target'));
                    
                    if (!target) return; // Skip if no data-target

                    let count = 0;
                    const duration = 2000; // 2 seconds
                    const increment = target / (duration / 16); // 60fps
                    
                    const updateCount = () => {
                        count += increment;
                        if (count < target) {
                            // Format number based on context (if needed) or just Int
                            el.innerText = Math.ceil(count) + (el.innerText.includes('%') ? '%' : '') + (el.innerText.includes('+') ? '+' : ''); 
                            
                            // Simple Int for now, preserve suffixes manually if needed
                            let display = Math.ceil(count);
                            // Add back suffix from original HTML if it had one like "+" or "%" in the target? 
                            // Simplified: Just count to number.
                            el.innerText = display;
                            requestAnimationFrame(updateCount);
                        } else {
                            el.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        stats.forEach(stat => {
            statsObserver.observe(stat);
        });
    }

  });