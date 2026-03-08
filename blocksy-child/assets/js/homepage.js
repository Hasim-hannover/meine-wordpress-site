document.addEventListener("DOMContentLoaded", function() {
    function initHomepageNav() {
        const smartNav = document.querySelector('.cs-page .smart-nav');
        if (!smartNav) return;

        const showAfter = 520;

        function toggleNav() {
            smartNav.classList.toggle('is-visible', window.scrollY > showAfter);
        }

        toggleNav();
        window.addEventListener('scroll', toggleNav, { passive: true });
    }

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

    initHomepageNav();

    // Scroll-Spy, FAQ, KPI Counter → jetzt zentral in nexus-core.js
});
