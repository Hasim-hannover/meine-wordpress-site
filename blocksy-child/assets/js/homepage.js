document.addEventListener("DOMContentLoaded", function () {
    initHomepageNav();
    initMobileStickyCta();
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

function initMobileStickyCta() {
    const stickyCta = document.querySelector("[data-home-mobile-cta]");
    const hero = document.getElementById("hero");
    const audit = document.getElementById("audit");
    const finalCta = document.getElementById("cta");

    if (!stickyCta) {
        return;
    }

    const stickyLink = stickyCta.querySelector("a");
    const mobileQuery = window.matchMedia("(max-width: 767px)");
    let heroPassed = false;
    let finalCtaVisible = false;

    function setStickyState(isVisible) {
        stickyCta.classList.toggle("is-visible", isVisible);
        stickyCta.setAttribute("aria-hidden", isVisible ? "false" : "true");

        if (!stickyLink) {
            return;
        }

        if (isVisible) {
            stickyLink.removeAttribute("tabindex");
        } else {
            stickyLink.setAttribute("tabindex", "-1");
        }
    }

    function updateStickyState() {
        setStickyState(mobileQuery.matches && heroPassed && !finalCtaVisible);
    }

    setStickyState(false);

    if (typeof IntersectionObserver === "undefined") {
        function syncStickyState() {
            if (audit) {
                const trigger = audit.offsetTop + (audit.offsetHeight * 0.2);
                heroPassed = window.scrollY > trigger;
            } else if (hero) {
                const trigger = hero.offsetTop + (hero.offsetHeight * 0.6);
                heroPassed = window.scrollY > trigger;
            }

            if (finalCta) {
                const rect = finalCta.getBoundingClientRect();
                finalCtaVisible = rect.top < (window.innerHeight * 0.82) && rect.bottom > (window.innerHeight * 0.18);
            }

            updateStickyState();
        }

        syncStickyState();
        window.addEventListener("scroll", syncStickyState, { passive: true });
        window.addEventListener("resize", syncStickyState);
    } else if (audit || hero) {
        const revealAnchor = audit || hero;

        const heroObserver = new IntersectionObserver(function (entries) {
            heroPassed = !(entries[0] && entries[0].isIntersecting);
            updateStickyState();
        }, {
            threshold: audit ? 0.18 : 0.22
        });

        heroObserver.observe(revealAnchor);

        if (finalCta) {
            const finalCtaObserver = new IntersectionObserver(function (entries) {
                finalCtaVisible = !!(entries[0] && entries[0].isIntersecting);
                updateStickyState();
            }, {
                threshold: 0.25
            });

            finalCtaObserver.observe(finalCta);
        }
    }

    if (typeof mobileQuery.addEventListener === "function") {
        mobileQuery.addEventListener("change", updateStickyState);
    } else if (typeof mobileQuery.addListener === "function") {
        mobileQuery.addListener(updateStickyState);
    }

    window.addEventListener("resize", updateStickyState);
    updateStickyState();
}
