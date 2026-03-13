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

    const NexusCore = {

        /**
         * 1. SCROLL-SPY NAVIGATION
         * Funktioniert mit .smart-nav, .nx-sidenav oder beliebigem Selektor.
         * Sucht sections mit [id] und markiert passende Links als .active.
         */
        initScrollSpy: function (navSelector, sectionSelector, offset) {
            const navLinks = document.querySelectorAll(navSelector + ' a');
            const sections = document.querySelectorAll(sectionSelector);

            if (!navLinks.length || !sections.length) return;

            offset = offset || 300;

            function update() {
                let current = '';
                sections.forEach(function (section) {
                    if (window.scrollY >= section.offsetTop - offset) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(function (link) {
                    link.classList.remove('active');
                    var href = link.getAttribute('href');
                    if (current && href && href.indexOf('#' + current) !== -1) {
                        link.classList.add('active');
                    }
                });
            }

            update();
            window.addEventListener('scroll', update, { passive: true });
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
            if (!bar) {
                bar = document.createElement('div');
                bar.id = 'nx-progress-bar';
                document.body.prepend(bar);
            }

            function updateProgress() {
                var scrollTop = window.scrollY;
                var docHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (docHeight <= 0) return;
                var percent = Math.min((scrollTop / docHeight) * 100, 100);
                bar.style.width = percent + '%';
            }

            window.addEventListener('scroll', updateProgress, { passive: true });
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

            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                elements.forEach(function (el) {
                    el.classList.add('nx-visible');
                    el.classList.add('is-visible');
                });
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('nx-visible');
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -60px 0px'
            });

            elements.forEach(function (el) { observer.observe(el); });
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

            function queuePulse() {
                if (hasPulsed) return;
                window.clearTimeout(pulseTimer);
                pulseTimer = window.setTimeout(function () {
                    cta.classList.add('btn-primary--pulse');
                    hasPulsed = true;
                }, 5000);
            }

            ['scroll', 'click', 'mousemove', 'touchstart'].forEach(function (eventName) {
                document.addEventListener(eventName, queuePulse, { passive: true });
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
            function updateTocActive() {
                var current = '';
                headings.forEach(function (h) {
                    if (window.scrollY >= h.offsetTop - 150) {
                        current = h.id;
                    }
                });
                tocLinks.forEach(function (a) {
                    a.classList.toggle('active', a.getAttribute('href') === '#' + current);
                });
            }
            window.addEventListener('scroll', updateTocActive, { passive: true });
            updateTocActive();
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
            if (!header) return;

            function update() {
                if (window.scrollY > 50) {
                    header.classList.add('nexus-flight-mode');
                } else {
                    header.classList.remove('nexus-flight-mode');
                }
            }

            update();
            window.addEventListener('scroll', update, { passive: true });
        },


        /**
         * 11. THEME TOGGLE MOUNT
         * Verschiebt den Toggle in den sichtbaren Header fuer konsistente Platzierung.
         */
        mountThemeToggle: function () {
            var toggles = Array.prototype.slice.call(document.querySelectorAll('.nx-theme-toggle[data-nx-theme-toggle]'));
            var mountSelectors = [
                '.nexus-blog-header__theme-toggle-slot',
                '.nexus-blog-header__actions',
                '.nexus-blog-header__shell',
                '.nexus-blog-header',
                '.nx-site-header__theme-toggle-slot',
                '.nx-site-header__actions',
                '.nx-site-header__shell',
                '.nx-site-header',
                '.ct-header [data-device="desktop"] .ct-container',
                '.ct-header .ct-middle-row .ct-container',
                '.ct-header .ct-container',
                '.ct-header'
            ];
            var selectorsWithoutMenuCheck = {
                '.nexus-blog-header__theme-toggle-slot': true,
                '.nexus-blog-header__actions': true,
                '.nexus-blog-header__shell': true,
                '.nexus-blog-header': true,
                '.nx-site-header__theme-toggle-slot': true,
                '.nx-site-header__actions': true,
                '.nx-site-header__shell': true,
                '.nx-site-header': true,
                '.ct-header': true
            };

            if (!toggles.length) return;

            function isVisible(node) {
                if (!node) return false;

                var style = window.getComputedStyle(node);
                var rect = node.getBoundingClientRect();

                return style.display !== 'none' &&
                    style.visibility !== 'hidden' &&
                    rect.width > 0 &&
                    rect.height > 0;
            }

            function isHeaderToggle(node) {
                return isVisible(node) &&
                    (!!node.closest('.ct-header') || !!node.closest('.nx-site-header') || !!node.closest('.nexus-blog-header')) &&
                    !node.closest('.ct-panel') &&
                    !node.closest('[aria-hidden="true"]');
            }

            function resolvePrimaryToggle() {
                for (var i = 0; i < toggles.length; i += 1) {
                    if (isHeaderToggle(toggles[i])) {
                        return toggles[i];
                    }
                }

                for (var j = 0; j < toggles.length; j += 1) {
                    if (toggles[j].getAttribute('data-nx-theme-toggle-source') !== 'fallback') {
                        return toggles[j];
                    }
                }

                return toggles[0];
            }

            var toggle = resolvePrimaryToggle();

            toggles.forEach(function (candidate) {
                if (candidate !== toggle) {
                    candidate.remove();
                }
            });

            function resolveMountTarget() {
                for (var i = 0; i < mountSelectors.length; i += 1) {
                    var nodes = document.querySelectorAll(mountSelectors[i]);

                    for (var j = 0; j < nodes.length; j += 1) {
                        var node = nodes[j];

                        if (!isVisible(node)) {
                            continue;
                        }

                        if (node.closest('.ct-panel') || node.closest('[aria-hidden="true"]')) {
                            continue;
                        }

                        if (!node.querySelector('.ct-menu, .header-navigation, [data-id="menu"], .nx-site-header__menu') && !selectorsWithoutMenuCheck[mountSelectors[i]]) {
                            continue;
                        }

                        return node;
                    }
                }

                return null;
            }

            function applyMount() {
                var mountTarget = resolveMountTarget();

                toggle.classList.remove('nx-theme-toggle--mounted');

                if (!mountTarget) {
                    return;
                }

                mountTarget.classList.add('nx-theme-toggle-host');

                if (toggle.parentElement !== mountTarget) {
                    mountTarget.appendChild(toggle);
                }

                toggle.classList.add('nx-theme-toggle--mounted');
            }

            applyMount();
            window.setTimeout(applyMount, 250);
            window.setTimeout(applyMount, 1200);
            window.addEventListener('resize', applyMount, { passive: true });
        },


        /**
         * 12. THEME TOGGLE
         * Wechselt Dark/Light ohne Browser-Storage und synchronisiert alle Toggle-Buttons.
         */
        initThemeToggle: function () {
            var root = document.documentElement;
            var buttons = document.querySelectorAll('[data-nx-theme-toggle] [data-theme-value]');

            function resolveTheme() {
                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                    return 'light';
                }

                return 'dark';
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

            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    applyTheme(button.getAttribute('data-theme-value'), true);
                });
            });

            applyTheme(resolveTheme(), false);
        },


        /**
         * INIT: Wird auf DOMContentLoaded automatisch aufgerufen.
         * Prüft welche Elemente auf der Seite existieren und initialisiert nur relevante Module.
         */
        init: function () {
            // Smart Nav (Homepage & About)
            if (document.querySelector('.smart-nav')) {
                this.initScrollSpy('.smart-nav', 'section[id], .audit-section[id]');
            }
            if (document.querySelector('.nx-sidenav')) {
                this.initScrollSpy('.nx-sidenav', 'section[id]');
            }

            // Theme Toggle
            this.mountThemeToggle();
            this.initThemeToggle();

            // Header Flight Mode
            this.initHeaderFlight();

            // FAQ Accordion (global)
            this.initFaqAccordion();

            // KPI Counter Animation
            this.initCounters();

            // Smooth Scroll
            this.initSmoothScroll();

            // Reveal Animations
            this.initReveal();

            // Hero CTA pulse
            this.initCtaPulse();

            // Progress Bar auf Single Posts und seitenweiten Case-Study-Templates
            if (document.querySelector('.nexus-single-container, .single-post, #nx-progress-bar')) {
                this.initProgressBar();
            }

            // TOC auf Single Posts
            if (document.querySelector('#article-content') && document.querySelector('#toc-list')) {
                this.initToc('#article-content', '#toc-list');
                this.cleanupDuplicateToc();
            }
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
