/**
 * NEXUS CORE JS v1.0
 * Zentrale Utilities für alle Seiten
 * 
 * Module:
 * 1. Scroll-Spy Navigation
 * 2. FAQ Accordion
 * 3. KPI Counter Animation
 * 4. Reading Progress Bar
 * 5. Smooth Scroll
 * 6. Intersection Observer Reveal
 */

(function () {
    'use strict';

    function runWhenIdle(callback, timeout) {
        if (typeof callback !== 'function') {
            return 0;
        }

        if (typeof window.requestIdleCallback === 'function') {
            return window.requestIdleCallback(callback, { timeout: timeout || 1200 });
        }

        return window.setTimeout(callback, timeout || 1200);
    }

    function runAfterNextPaint(callback) {
        if (typeof callback !== 'function') {
            return;
        }

        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(callback);
        });
    }

    const NexusCore = {

        /**
         * 1. SCROLL-SPY NAVIGATION
         * Funktioniert mit .smart-nav, .nx-sidenav oder beliebigem Selektor.
         * Sucht sections mit [id] und markiert passende Links als .active.
         */
        initScrollSpy: function (navSelector, sectionSelector, offset) {
            const navLinks = Array.prototype.slice.call(document.querySelectorAll(navSelector + ' a'));
            const sections = Array.prototype.slice.call(document.querySelectorAll(sectionSelector)).filter(function (section) {
                return !!section.getAttribute('id');
            });
            var sectionPositions = [];
            var activeId = '';
            var isQueued = false;
            var measurementTimer = 0;
            var observer = null;
            var observedState = {};
            var sectionIndexes = {};

            if (!navLinks.length || !sections.length) return;

            offset = offset || 300;

            sections.forEach(function (section, index) {
                sectionIndexes[section.getAttribute('id')] = index;
            });

            function setActive(current) {
                if (current === activeId) {
                    return;
                }

                activeId = current;
                navLinks.forEach(function (link) {
                    var href = link.getAttribute('href');
                    link.classList.toggle('active', !!current && !!href && href.indexOf('#' + current) !== -1);
                });
            }

            function resolveObservedActiveId() {
                var candidates = Object.keys(observedState).map(function (id) {
                    return observedState[id];
                });

                if (!candidates.length) {
                    return '';
                }

                candidates.sort(function (left, right) {
                    var leftPassed = left.top <= offset;
                    var rightPassed = right.top <= offset;

                    if (leftPassed && rightPassed) {
                        return right.index - left.index;
                    }

                    if (leftPassed !== rightPassed) {
                        return leftPassed ? -1 : 1;
                    }

                    return left.top - right.top;
                });

                return candidates[0].id;
            }

            function createObserver() {
                if (typeof window.IntersectionObserver !== 'function') {
                    return false;
                }

                observedState = {};
                observer = new window.IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        var id = entry.target.getAttribute('id');

                        if (!id) {
                            return;
                        }

                        if (entry.isIntersecting) {
                            observedState[id] = {
                                id: id,
                                index: sectionIndexes[id] || 0,
                                top: entry.boundingClientRect.top
                            };
                            return;
                        }

                        delete observedState[id];
                    });

                    setActive(resolveObservedActiveId());
                }, {
                    rootMargin: '-' + Math.max(80, offset - 80) + 'px 0px -55% 0px',
                    threshold: [0, 0.1, 0.35, 0.6]
                });

                sections.forEach(function (section) {
                    observer.observe(section);
                });

                return true;
            }

            function syncMeasurements() {
                measurementTimer = 0;
                sectionPositions = sections.map(function (section) {
                    var rect = section.getBoundingClientRect();

                    return {
                        id: section.getAttribute('id'),
                        top: rect.top + window.scrollY
                    };
                }).filter(function (entry) {
                    return !!entry.id;
                });

                update();
            }

            function update() {
                isQueued = false;

                let current = '';
                var scrollPosition = window.scrollY + offset;

                sectionPositions.forEach(function (section) {
                    if (scrollPosition >= section.top) {
                        current = section.id;
                    }
                });

                setActive(current);
            }

            function queueUpdate() {
                if (isQueued) {
                    return;
                }

                isQueued = true;
                window.requestAnimationFrame(update);
            }

            function queueMeasurementSync(delay) {
                if (measurementTimer) {
                    window.clearTimeout(measurementTimer);
                }

                measurementTimer = window.setTimeout(syncMeasurements, typeof delay === 'number' ? delay : 180);
            }

            if (createObserver()) {
                window.addEventListener('resize', function () {
                    if (observer) {
                        observer.disconnect();
                    }

                    createObserver();
                }, { passive: true });

                window.addEventListener('load', function () {
                    setActive(resolveObservedActiveId());
                }, { once: true });

                return;
            }

            queueMeasurementSync(220);
            window.addEventListener('scroll', queueUpdate, { passive: true });
            window.addEventListener('resize', function () {
                queueMeasurementSync(160);
            }, { passive: true });
            window.addEventListener('load', function () {
                queueMeasurementSync(0);
            }, { once: true });
        },


        /**
         * 2. FAQ ACCORDION
         * Schließt andere <details> wenn eins geöffnet wird.
         * Scope optional (z.B. '.my-faq' um nur dort zu wirken).
         */
        initFaqAccordion: function (scope) {
            var container = scope ? document.querySelector(scope) : document;
            if (!container) return;

            var items = container.querySelectorAll('details');
            if (!items.length) return;

            items.forEach(function (item) {
                item.addEventListener('click', function () {
                    items.forEach(function (other) {
                        if (other !== item) other.removeAttribute('open');
                    });
                });
            });
        },


        /**
         * 3. KPI COUNTER ANIMATION
         * Animiert numerische Werte von 0 bis zum Endwert.
         * Verwendet IntersectionObserver für Performance.
         * 
         * HTML: <span class="nx-counter" data-value="97" data-suffix="%">0</span>
         * Falls kein data-value, wird innerText als Wert genommen.
         */
        initCounters: function (selector) {
            selector = selector || '.nx-counter, .wp-metric-value, .counter';
            var elements = document.querySelectorAll(selector);
            if (!elements.length) return;

            function animateValue(el, end, duration, prefix, suffix, decimals) {
                var startTime = null;

                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    el.textContent = prefix + end.toFixed(decimals) + suffix;
                    return;
                }

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    var ease = 1 - Math.pow(1 - progress, 4);
                    var current = end * ease;
                    el.textContent = prefix + current.toFixed(decimals) + suffix;
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.textContent = prefix + end.toFixed(decimals) + suffix;
                    }
                }
                window.requestAnimationFrame(step);
            }

            function getCounterConfig(el) {
                var explicitTarget = el.getAttribute('data-target');
                var explicitValue = el.getAttribute('data-value');
                var rawText = (el.textContent || '').trim();
                var source = explicitTarget || explicitValue || rawText;
                var normalized = source.replace(',', '.').replace(/[^0-9.+-]/g, '');
                var target = parseFloat(normalized);

                if (Number.isNaN(target)) {
                    return null;
                }

                var prefix = el.getAttribute('data-prefix') || '';
                var suffix = el.getAttribute('data-suffix') || '';
                var decimals = 0;

                if (normalized.indexOf('.') !== -1) {
                    decimals = normalized.split('.')[1].length;
                }

                if (!prefix && rawText.charAt(0) === '+') {
                    prefix = '+';
                }

                return {
                    target: target,
                    prefix: prefix,
                    suffix: suffix,
                    decimals: decimals
                };
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;

                    var el = entry.target;
                    var config = getCounterConfig(el);
                    if (!config) {
                        observer.unobserve(el);
                        return;
                    }

                    animateValue(el, config.target, 1500, config.prefix, config.suffix, config.decimals);
                    observer.unobserve(el);
                });
            }, { threshold: 0.5 });

            elements.forEach(function (el) { observer.observe(el); });
        },


        /**
         * 4. READING PROGRESS BAR
         * Zeigt Lesefortschritt als Balken oben am Fenster.
         * Erstellt das Element automatisch, falls es nicht existiert.
         */
        initProgressBar: function () {
            var bar = document.getElementById('nx-progress-bar');
            var isQueued = false;

            if (!bar) {
                bar = document.createElement('div');
                bar.id = 'nx-progress-bar';
                document.body.prepend(bar);
            }

            function updateProgress() {
                isQueued = false;

                var scrollTop = window.scrollY;
                var docHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (docHeight <= 0) {
                    bar.style.width = '0%';
                    return;
                }

                var percent = Math.min((scrollTop / docHeight) * 100, 100);
                bar.style.width = percent + '%';
            }

            function queueUpdateProgress() {
                if (isQueued) {
                    return;
                }

                isQueued = true;
                window.requestAnimationFrame(updateProgress);
            }

            window.addEventListener('scroll', queueUpdateProgress, { passive: true });
            window.addEventListener('resize', queueUpdateProgress, { passive: true });
            updateProgress();
        },


        /**
         * 5. SMOOTH SCROLL
         * Für alle Anker-Links auf der Seite.
         * Respektiert Header-Höhe.
         */
        initSmoothScroll: function (headerOffset) {
            headerOffset = headerOffset || 100;

            document.addEventListener('click', function (e) {
                var link = e.target.closest('a[href^="#"]');
                if (!link) return;

                var targetId = link.getAttribute('href');
                if (!targetId || targetId === '#') return;

                var target = document.querySelector(targetId);
                if (!target) return;

                e.preventDefault();
                var top = target.getBoundingClientRect().top + window.scrollY - headerOffset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            });
        },


        /**
         * 6. INTERSECTION OBSERVER REVEAL
         * Fügt .nx-visible hinzu wenn Elemente in den Viewport kommen.
         * CSS: .nx-reveal { opacity:0; transform:translateY(20px); transition:... }
         *      .nx-reveal.nx-visible { opacity:1; transform:translateY(0); }
         */
        initReveal: function (selector) {
            selector = selector || '.nx-reveal, .reveal, .reveal-stagger';
            var elements = document.querySelectorAll(selector);
            if (!elements.length) return;

            function markVisible(el) {
                el.classList.add('nx-visible');
                el.classList.add('is-visible');
            }

            function isAboveFold(el) {
                var rect = el.getBoundingClientRect();
                return rect.bottom > 0 && rect.top < (window.innerHeight * 0.92);
            }

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                elements.forEach(function (el) {
                    markVisible(el);
                });
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        markVisible(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -60px 0px'
            });

            elements.forEach(function (el) {
                if (isAboveFold(el)) {
                    markVisible(el);
                    return;
                }

                observer.observe(el);
            });
        },


        /**
         * 7. CTA ATTENTION PULSE
         * Einmaliger Impuls fuer die primaere Hero-CTA nach 5s Idle-Zeit.
         */
        initCtaPulse: function () {
            var cta = document.querySelector('.hero .btn-primary, .hero .nx-btn--primary, .hero .wp-btn-primary, .nx-hero .nx-btn--primary, .wp-hero .wp-btn-primary');
            if (!cta || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            var hasPulsed = false;
            var pulseTimer = null;
            var interactionTargets = [
                { node: window, eventName: 'scroll', options: { passive: true } },
                { node: document, eventName: 'pointerdown', options: { passive: true } },
                { node: document, eventName: 'keydown', options: false }
            ];

            function cleanup() {
                interactionTargets.forEach(function (binding) {
                    binding.node.removeEventListener(binding.eventName, queuePulse, binding.options);
                });
            }

            function queuePulse() {
                if (hasPulsed) return;
                window.clearTimeout(pulseTimer);
                pulseTimer = window.setTimeout(function () {
                    cta.classList.add('btn-primary--pulse');
                    hasPulsed = true;
                    cleanup();
                }, 5000);
            }

            interactionTargets.forEach(function (binding) {
                binding.node.addEventListener(binding.eventName, queuePulse, binding.options);
            });

            queuePulse();
        },


        /**
         * 8. TOC (Table of Contents) GENERATOR
         * Scannt einen Container nach h2/h3 und befüllt eine TOC-Liste.
         */
        initToc: function (contentSelector, tocListSelector) {
            var content = document.querySelector(contentSelector);
            var tocList = document.querySelector(tocListSelector);
            var headingPositions = [];
            var activeId = '';
            var isQueued = false;

            if (!content || !tocList) return;

            var headings = content.querySelectorAll('h2, h3');
            if (!headings.length) {
                if (!tocList.children.length) {
                    var li = document.createElement('li');
                    li.textContent = 'Inhaltsverzeichnis wird geladen...';
                    tocList.appendChild(li);
                }
                return;
            }

            tocList.innerHTML = '';
            headings.forEach(function (heading, index) {
                if (!heading.id) {
                    heading.id = 'section-' + index;
                }

                var li = document.createElement('li');
                var link = document.createElement('a');
                link.href = '#' + heading.id;
                link.textContent = heading.textContent;
                link.className = 'toc-link';

                if (heading.tagName === 'H3') {
                    li.style.marginLeft = '15px';
                    li.style.fontSize = '0.9em';
                }

                li.appendChild(link);
                tocList.appendChild(li);
            });

            // Scroll-Spy für TOC Links
            var tocLinks = tocList.querySelectorAll('a');
            function syncMeasurements() {
                headingPositions = Array.prototype.map.call(headings, function (heading) {
                    return {
                        id: heading.id,
                        top: heading.offsetTop
                    };
                });

                updateTocActive();
            }

            function updateTocActive() {
                isQueued = false;

                var current = '';
                var scrollPosition = window.scrollY + 150;

                headingPositions.forEach(function (heading) {
                    if (scrollPosition >= heading.top) {
                        current = heading.id;
                    }
                });

                if (current === activeId) {
                    return;
                }

                activeId = current;
                tocLinks.forEach(function (a) {
                    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
                });
            }

            function queueTocActive() {
                if (isQueued) {
                    return;
                }

                isQueued = true;
                window.requestAnimationFrame(updateTocActive);
            }

            syncMeasurements();
            window.addEventListener('scroll', queueTocActive, { passive: true });
            window.addEventListener('resize', syncMeasurements, { passive: true });
            window.addEventListener('load', syncMeasurements, { once: true });
        },


        /**
         * 9. TOC DUPLICATE CLEANUP
         * Entfernt doppelte oder inline-injizierte TOCs im Artikelbereich.
         */
        cleanupDuplicateToc: function () {
            var sidebarTocs = document.querySelectorAll('.nexus-sidebar .sticky-toc');
            if (sidebarTocs.length > 1) {
                sidebarTocs.forEach(function (toc, index) {
                    if (index > 0) toc.remove();
                });
            }

            var inlineTocSelectors = [
                '.nexus-article-content .wp-block-table-of-contents',
                '.nexus-article-content .ez-toc-container',
                '.nexus-article-content .rank-math-toc-block',
                '.nexus-article-content .aioseo-table-of-contents',
                '.nexus-article-content .luckywp-table-of-contents',
                '.nexus-article-content .lwptoc'
            ];

            inlineTocSelectors.forEach(function (selector) {
                document.querySelectorAll(selector).forEach(function (node) {
                    node.remove();
                });
            });
        },


        /**
         * 10. HEADER FLIGHT MODE
         * Kompakter Header mit Glaseffekt beim Scrollen.
         * Fügt .nexus-flight-mode ab 50px Scroll hinzu.
         */
        initHeaderFlight: function () {
            var header = document.querySelector('.ct-header');
            var isQueued = false;

            if (document.querySelector('[data-site-header]')) return;
            if (!header) return;

            function update() {
                isQueued = false;

                if (window.scrollY > 50) {
                    header.classList.add('nexus-flight-mode');
                } else {
                    header.classList.remove('nexus-flight-mode');
                }
            }

            function queueUpdate() {
                if (isQueued) {
                    return;
                }

                isQueued = true;
                window.requestAnimationFrame(update);
            }

            update();
            window.addEventListener('scroll', queueUpdate, { passive: true });
        },


        /**
         * 11. THEME TOGGLE CLEANUP
         * Behaelt nur den globalen Desktop-Toggle und entfernt Header-Instanzen.
         */
        mountThemeToggle: function () {
            var toggles = Array.prototype.slice.call(document.querySelectorAll('.nx-theme-toggle[data-nx-theme-toggle]'));
            var toggle = null;

            if (!toggles.length) return;

            for (var i = 0; i < toggles.length; i += 1) {
                if (toggles[i].getAttribute('data-nx-theme-toggle-source') === 'fallback') {
                    toggle = toggles[i];
                    break;
                }
            }

            if (!toggle) {
                toggle = toggles[0];
            }

            toggles.forEach(function (candidate) {
                if (candidate !== toggle) {
                    candidate.remove();
                }
            });

            if (toggle.parentElement && toggle.parentElement.classList.contains('nx-theme-toggle-host')) {
                toggle.parentElement.classList.remove('nx-theme-toggle-host');
            }

            toggle.classList.remove('nx-theme-toggle--mounted');
        },


        /**
         * 12. THEME TOGGLE
         * Wechselt Dark/Light ohne Browser-Storage und synchronisiert alle Toggle-Buttons.
         */
        initThemeToggle: function () {
            var root = document.documentElement;
            var buttons = document.querySelectorAll('[data-nx-theme-toggle] [data-theme-value]');
            var systemLightMedia = window.matchMedia ? window.matchMedia('(prefers-color-scheme: light)') : null;
            var desktopThemeMedia = window.matchMedia ? window.matchMedia('(min-width: 1181px)') : null;
            var hasManualDesktopTheme = false;
            var manualDesktopTheme = null;

            function isDesktopThemeEnabled() {
                if (desktopThemeMedia) {
                    return desktopThemeMedia.matches;
                }

                if (typeof window.innerWidth === 'number') {
                    return window.innerWidth >= 1181;
                }

                return true;
            }

            function resolveSystemTheme() {
                if (systemLightMedia && systemLightMedia.matches) {
                    return 'light';
                }

                return 'dark';
            }

            function resolveTheme() {
                if (!isDesktopThemeEnabled()) {
                    return 'dark';
                }

                if (manualDesktopTheme) {
                    return manualDesktopTheme;
                }

                return resolveSystemTheme();
            }

            function syncButtons(theme) {
                buttons.forEach(function (button) {
                    var isActive = button.getAttribute('data-theme-value') === theme;
                    button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
                    button.classList.toggle('is-active', isActive);
                });
            }

            function applyTheme(theme, withTransition) {
                if (withTransition) {
                    root.classList.add('theme-transitioning');
                }

                root.setAttribute('data-nx-theme', theme);
                root.setAttribute('data-theme', theme);
                root.style.colorScheme = theme;
                syncButtons(theme);

                if (withTransition) {
                    window.setTimeout(function () {
                        root.classList.remove('theme-transitioning');
                    }, 350);
                }
            }

            function applyResolvedTheme(withTransition) {
                applyTheme(resolveTheme(), withTransition);
            }

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    manualDesktopTheme = button.getAttribute('data-theme-value');
                    hasManualDesktopTheme = true;
                    applyResolvedTheme(true);
                });
            });

            if (systemLightMedia) {
                var handleSystemThemeChange = function () {
                    if (!hasManualDesktopTheme && isDesktopThemeEnabled()) {
                        applyResolvedTheme(false);
                    }
                };

                if (typeof systemLightMedia.addEventListener === 'function') {
                    systemLightMedia.addEventListener('change', handleSystemThemeChange);
                } else if (typeof systemLightMedia.addListener === 'function') {
                    systemLightMedia.addListener(handleSystemThemeChange);
                }
            }

            if (desktopThemeMedia) {
                var handleViewportThemeChange = function () {
                    applyResolvedTheme(false);
                };

                if (typeof desktopThemeMedia.addEventListener === 'function') {
                    desktopThemeMedia.addEventListener('change', handleViewportThemeChange);
                } else if (typeof desktopThemeMedia.addListener === 'function') {
                    desktopThemeMedia.addListener(handleViewportThemeChange);
                }
            } else {
                window.addEventListener('resize', function () {
                    applyResolvedTheme(false);
                }, { passive: true });
            }

            applyResolvedTheme(false);
        },


        /**
         * INIT: Wird auf DOMContentLoaded automatisch aufgerufen.
         * Prüft welche Elemente auf der Seite existieren und initialisiert nur relevante Module.
         */
        init: function () {
            var self = this;

            // Smart Nav (Homepage & About)
            if (document.querySelector('.smart-nav')) {
                runWhenIdle(function () {
                    self.initScrollSpy('.smart-nav', 'section[id], .audit-section[id]');
                }, 900);
            }
            if (document.querySelector('.nx-sidenav')) {
                runWhenIdle(function () {
                    self.initScrollSpy('.nx-sidenav', 'section[id]');
                }, 900);
            }

            runAfterNextPaint(function () {
                self.initThemeToggle();
            });

            runWhenIdle(function () {
                self.mountThemeToggle();
            }, 1000);

            // Header Flight Mode
            this.initHeaderFlight();

            // Smooth Scroll
            this.initSmoothScroll();

            runAfterNextPaint(function () {
                self.initFaqAccordion();
                self.initCounters();
                self.initReveal();
            });

            runWhenIdle(function () {
                self.initCtaPulse();
            }, 1400);

            runWhenIdle(function () {
                if (document.querySelector('.nexus-single-container, .single-post, #nx-progress-bar')) {
                    self.initProgressBar();
                }

                if (document.querySelector('#article-content') && document.querySelector('#toc-list')) {
                    self.initToc('#article-content', '#toc-list');
                    self.cleanupDuplicateToc();
                }
            }, 1600);
        }
    };

    // Auto-Init
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () { NexusCore.init(); });
    } else {
        NexusCore.init();
    }

    // Global verfügbar machen für manuelle Initialisierung
    window.NexusCore = NexusCore;

})();
