document.addEventListener('DOMContentLoaded', function() {

  // ======================================================
  // TEIL 1: Dein bestehender Code für die Animationen
  // ======================================================

  // Zahlen-Animation
  const statsObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        el.classList.add('animating');
        const target = parseInt(el.dataset.target, 10);
        const duration = 2000;
        let startTime = null;
        function animationStep(timestamp) {
          if (!startTime) startTime = timestamp;
          const progress = timestamp - startTime;
          const currentNum = Math.min(Math.floor(progress / duration * target), target);
          el.textContent = currentNum.toLocaleString('de-DE');
          if (progress < duration) {
            window.requestAnimationFrame(animationStep);
          } else {
            el.textContent = target.toLocaleString('de-DE');
            el.classList.remove('animating');
          }
        }
        window.requestAnimationFrame(animationStep);
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.8 });
  document.querySelectorAll('.hero-stats .num').forEach(num => statsObserver.observe(num));

  // Sticky TOC
  const tocNav = document.getElementById('toc-nav');
  const heroSection = document.getElementById('start');
  const sections = document.querySelectorAll('main section[id]');
  const tocLinks = document.querySelectorAll('#toc-nav a');

  if (tocNav && heroSection && sections.length) {
    let idleTimeout;
    let isTocVisible = false;

    const resetTocIdleTimer = () => {
      if (!isTocVisible) return;
      tocNav.classList.add('visible');
      clearTimeout(idleTimeout);
      idleTimeout = setTimeout(() => {
        tocNav.classList.remove('visible');
      }, 3000);
    }

    const heroObserver = new IntersectionObserver(entries => {
      const [entry] = entries;
      const pastHero = !entry.isIntersecting;
      if (pastHero && !isTocVisible) {
        isTocVisible = true;
        resetTocIdleTimer();
        window.addEventListener('mousemove', resetTocIdleTimer, { passive: true });
        window.addEventListener('scroll', resetTocIdleTimer, { passive: true });
      } else if (!pastHero && isTocVisible) {
        isTocVisible = false;
        tocNav.classList.remove('visible');
        clearTimeout(idleTimeout);
        window.removeEventListener('mousemove', resetTocIdleTimer);
        window.removeEventListener('scroll', resetTocIdleTimer);
      }
    }, { rootMargin: "0px 0px -250px 0px", threshold: 0 });
    heroObserver.observe(heroSection);

    const sectionObserver = new IntersectionObserver(entries => {
      let activeSectionId = null;
      entries.forEach(entry => { if (entry.isIntersecting) activeSectionId = entry.target.id; });
      if (!activeSectionId) {
        for (let i = sections.length - 1; i >= 0; i--) {
          const section = sections[i];
          const rect = section.getBoundingClientRect();
          if (rect.top < window.innerHeight / 2) { activeSectionId = section.id; break; }
        }
      }
      tocLinks.forEach(link => {
        const linkId = link.getAttribute('href').substring(1);
        link.classList.toggle('active', linkId === activeSectionId);
      });
    }, { rootMargin: '-40% 0px -60% 0px', threshold: 0 });
    sections.forEach(section => sectionObserver.observe(section));
  }

  // ======================================================
  // TEIL 2: Der neue Code für die FAQ-Funktion
  // ======================================================
  const allFaqItems = document.querySelectorAll('.faq details');

  allFaqItems.forEach(faqItem => {
      faqItem.addEventListener('toggle', (event) => {
          if (faqItem.open) {
              allFaqItems.forEach(otherItem => {
                  if (otherItem !== faqItem) {
                      otherItem.open = false;
                  }
              });
          }
      });
  });

});