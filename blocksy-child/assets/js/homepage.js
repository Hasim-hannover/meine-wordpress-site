document.addEventListener("DOMContentLoaded", function () {
    initHomepageNav();
});

function initHomepageNav() {
    const smartNav = document.querySelector(".homepage-template .smart-nav");
    const hero = document.getElementById("hero");

    if (!smartNav || !hero) {
        return;
    }

    if (typeof IntersectionObserver === "undefined") {
        function toggleNav() {
            const trigger = hero.offsetTop + (hero.offsetHeight * 0.65);
            smartNav.classList.toggle("is-visible", window.scrollY > trigger);
        }

        toggleNav();
        window.addEventListener("scroll", toggleNav, { passive: true });
        window.addEventListener("resize", toggleNav);
        return;
    }

    const navObserver = new IntersectionObserver(function (entries) {
        const heroIsVisible = entries[0] && entries[0].isIntersecting;
        smartNav.classList.toggle("is-visible", !heroIsVisible);
    }, {
        threshold: 0.18
    });

    navObserver.observe(hero);
}
