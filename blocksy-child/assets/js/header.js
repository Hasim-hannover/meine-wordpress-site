(function() {
    const burgerBtn = document.getElementById('hu-burger-btn');
    const navMenu = document.getElementById('hu-nav');
    const ctaBtn = document.querySelector('.hu-cta');

    if (!burgerBtn || !navMenu) return;

    burgerBtn.addEventListener('click', function() {
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        this.setAttribute('aria-label', isExpanded ? 'Menü öffnen' : 'Menü schließen');
        navMenu.classList.toggle('is-open');
        if (ctaBtn) ctaBtn.classList.toggle('is-open');
    });
})();