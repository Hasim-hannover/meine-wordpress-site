document.addEventListener("DOMContentLoaded", function () {
    initHomepageNav();
});

function initHomepageNav() {
    const smartNav = document.querySelector(".homepage-template .smart-nav");
    const hero = document.getElementById("hero");
    const navHideDelay = 900;
    let hideNavTimeoutId = null;

    if (!smartNav || !hero) {
        return;
    }

    function clearHideTimer() {
        if (hideNavTimeoutId) {
            window.clearTimeout(hideNavTimeoutId);
            hideNavTimeoutId = null;
        }
    }

    function setNavEligible(isEligible) {
        smartNav.classList.toggle("is-visible", isEligible);

        if (!isEligible) {
            clearHideTimer();
            smartNav.classList.remove("is-scrolling");
        }
    }

    function showNavWhileScrolling() {
        if (!smartNav.classList.contains("is-visible")) {
            return;
        }

        smartNav.classList.add("is-scrolling");
        clearHideTimer();

        hideNavTimeoutId = window.setTimeout(function () {
            smartNav.classList.remove("is-scrolling");
            hideNavTimeoutId = null;
        }, navHideDelay);
    }

    if (typeof IntersectionObserver === "undefined") {
        function syncNavPosition() {
            const trigger = hero.offsetTop + (hero.offsetHeight * 0.65);
            setNavEligible(window.scrollY > trigger);
        }

        function handleScroll() {
            syncNavPosition();
            showNavWhileScrolling();
        }

        syncNavPosition();
        window.addEventListener("scroll", handleScroll, { passive: true });
        window.addEventListener("resize", syncNavPosition);
        return;
    }

    const navObserver = new IntersectionObserver(function (entries) {
        const heroIsVisible = entries[0] && entries[0].isIntersecting;
        setNavEligible(!heroIsVisible);
    }, {
        threshold: 0.18
    });

    navObserver.observe(hero);
    window.addEventListener("scroll", showNavWhileScrolling, { passive: true });
}
