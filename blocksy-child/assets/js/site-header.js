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
        var isVisible = null;
        var isPointerInside = false;
        var isFocusInside = false;
        var isNearTopEdge = false;
        var hideTimer = 0;
        var revealAfter = 120;
        var desktopHideDelay = 260;
        var topEdgeThreshold = 40;
        var headerHeightRaf = 0;
        var scrollRaf = 0;
        var pointerMoveRaf = 0;
        var pendingPointerY = 0;
        var pointerMoveEvent = window.PointerEvent ? 'pointermove' : 'mousemove';

        function syncHeaderHeight() {
            var height = Math.max(76, Math.ceil(header.getBoundingClientRect().height + 12));
            document.documentElement.style.setProperty('--nx-header-height', height + 'px');
        }

        function queueHeaderHeightSync() {
            if (headerHeightRaf) {
                return;
            }

            headerHeightRaf = window.requestAnimationFrame(function () {
                headerHeightRaf = 0;
                syncHeaderHeight();
            });
        }

        function clearHideTimer() {
            if (!hideTimer) {
                return;
            }

            window.clearTimeout(hideTimer);
            hideTimer = 0;
        }

        function setHeaderVisibility(nextVisible) {
            if (isVisible === nextVisible) {
                return;
            }

            isVisible = nextVisible;
            header.classList.toggle('is-visible', nextVisible);
        }

        function shouldPinHeader() {
            return isPointerInside || isFocusInside || isNearTopEdge || header.classList.contains('is-open');
        }

        function scheduleHide() {
            clearHideTimer();

            if (!desktopMedia.matches || shouldPinHeader() || window.scrollY <= revealAfter) {
                return;
            }

            hideTimer = window.setTimeout(function () {
                if (!shouldPinHeader() && window.scrollY > revealAfter) {
                    setHeaderVisibility(false);
                }
            }, desktopHideDelay);
        }

        function updateVisibility(forceVisible) {
            clearHideTimer();

            if (forceVisible || shouldPinHeader()) {
                setHeaderVisibility(true);
                return;
            }

            if (window.scrollY <= revealAfter) {
                setHeaderVisibility(true);
                return;
            }

            if (desktopMedia.matches) {
                scheduleHide();
                return;
            }

            setHeaderVisibility(true);
        }

        function setPanelState(isOpen) {
            if (!toggle || !panel) {
                return;
            }

            header.classList.toggle('is-open', isOpen);
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            panel.hidden = !isOpen;
            updateVisibility(isOpen);

            queueHeaderHeightSync();
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
            queueHeaderHeightSync();
        }

        function queueScrollUpdate() {
            if (scrollRaf) {
                return;
            }

            scrollRaf = window.requestAnimationFrame(function () {
                scrollRaf = 0;
                updateFlightMode();
                updateVisibility(false);
            });
        }

        function applyPointerProximity(clientY) {
            var nextNearTopEdge = desktopMedia.matches && window.scrollY > revealAfter && clientY <= topEdgeThreshold;

            if (isNearTopEdge === nextNearTopEdge) {
                return;
            }

            isNearTopEdge = nextNearTopEdge;
            updateVisibility(nextNearTopEdge);
        }

        function queuePointerProximity(clientY) {
            if (!desktopMedia.matches || window.scrollY <= revealAfter) {
                if (isNearTopEdge) {
                    isNearTopEdge = false;
                    updateVisibility(false);
                }

                return;
            }

            pendingPointerY = clientY;

            if (pointerMoveRaf) {
                return;
            }

            pointerMoveRaf = window.requestAnimationFrame(function () {
                pointerMoveRaf = 0;
                applyPointerProximity(pendingPointerY);
            });
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

                    updateVisibility(false);
                    queueHeaderHeightSync();
                });
            } else if (typeof desktopMedia.addListener === 'function') {
                desktopMedia.addListener(function (event) {
                    if (event.matches) {
                        closePanel();
                    }

                    updateVisibility(false);
                    queueHeaderHeightSync();
                });
            }
        }

        header.addEventListener('mouseenter', function () {
            isPointerInside = true;
            updateVisibility(true);
        });

        header.addEventListener('mouseleave', function () {
            isPointerInside = false;
            updateVisibility(false);
        });

        header.addEventListener('focusin', function () {
            isFocusInside = true;
            updateVisibility(true);
        });

        header.addEventListener('focusout', function () {
            window.setTimeout(function () {
                isFocusInside = header.contains(document.activeElement);
                updateVisibility(false);
            }, 0);
        });

        document.addEventListener(pointerMoveEvent, function (event) {
            queuePointerProximity(event.clientY);
        }, { passive: true });

        document.addEventListener('mouseleave', function () {
            if (!isNearTopEdge) {
                return;
            }

            isNearTopEdge = false;
            updateVisibility(false);
        });

        updateFlightMode();
        updateVisibility(false);
        syncHeaderHeight();

        window.addEventListener('scroll', queueScrollUpdate, { passive: true });
        window.addEventListener('resize', queueHeaderHeightSync, { passive: true });

        if (typeof window.ResizeObserver === 'function') {
            new window.ResizeObserver(queueHeaderHeightSync).observe(header);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSiteHeader);
    } else {
        initSiteHeader();
    }
})();
