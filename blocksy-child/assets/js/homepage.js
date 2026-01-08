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

  });