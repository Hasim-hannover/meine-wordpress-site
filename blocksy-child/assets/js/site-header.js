(function () {
    function initSiteHeader() {
        var header = document.querySelector('[data-site-header]');

        if (!header) {
            return;
        }

        var toggle = header.querySelector('[data-site-header-toggle]');
        var panel = header.querySelector('[data-site-header-panel]');
        var desktopMedia = window.matchMedia('(min-width: 1101px)');
        var isCondensed = null;

        function syncHeaderHeight() {
            var height = Math.max(76, Math.ceil(header.getBoundingClientRect().height + 12));
            document.documentElement.style.setProperty('--nx-header-height', height + 'px');
        }

        function setPanelState(isOpen) {
            if (!toggle || !panel) {
                return;
            }

            header.classList.toggle('is-open', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            panel.hidden = !isOpen;

            window.requestAnimationFrame(syncHeaderHeight);
        }

        function closePanel() {
            setPanelState(false);
        }

        function updateFlightMode() {
            var nextCondensed = window.scrollY > 36;

            if (isCondensed === nextCondensed) {
                return;
            }

            isCondensed = nextCondensed;
            header.classList.toggle('nexus-flight-mode', nextCondensed);
            window.requestAnimationFrame(syncHeaderHeight);
        }

        if (toggle && panel) {
            toggle.addEventListener('click', function () {
                setPanelState(toggle.getAttribute('aria-expanded') !== 'true');
            });

            panel.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', closePanel);
            });

            document.addEventListener('click', function (event) {
                if (header.contains(event.target)) {
                    return;
                }

                closePanel();
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closePanel();
                }
            });

            if (typeof desktopMedia.addEventListener === 'function') {
                desktopMedia.addEventListener('change', function (event) {
                    if (event.matches) {
                        closePanel();
                    }

                    syncHeaderHeight();
                });
            } else if (typeof desktopMedia.addListener === 'function') {
                desktopMedia.addListener(function (event) {
                    if (event.matches) {
                        closePanel();
                    }

                    syncHeaderHeight();
                });
            }
        }

        updateFlightMode();
        syncHeaderHeight();

        window.addEventListener('scroll', updateFlightMode, { passive: true });
        window.addEventListener('resize', syncHeaderHeight, { passive: true });

        if (typeof window.ResizeObserver === 'function') {
            new window.ResizeObserver(syncHeaderHeight).observe(header);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSiteHeader);
    } else {
        initSiteHeader();
    }
})();
