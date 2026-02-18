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
            selector = selector || '.nx-counter, .wp-metric-value';
            var elements = document.querySelectorAll(selector);
            if (!elements.length) return;

            function animateValue(el, start, end, duration, prefix, suffix) {
                var startTime = null;
                function step(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = Math.min((timestamp - startTime) / duration, 1);
                    // Ease-out cubic
                    var ease = 1 - Math.pow(1 - progress, 3);
                    var current = Math.floor(ease * (end - start) + start);
                    el.textContent = prefix + current + suffix;
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    } else {
                        el.textContent = prefix + end + suffix;
                    }
                }
                window.requestAnimationFrame(step);
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;

                    var el = entry.target;
                    var raw = el.getAttribute('data-value') || el.textContent.trim();

                    // Nicht-numerische Werte: sofort anzeigen
                    if (isNaN(parseInt(raw, 10))) {
                        observer.unobserve(el);
                        return;
                    }

                    var val = parseInt(raw, 10);
                    var prefix = el.getAttribute('data-prefix') || '';
                    var suffix = el.getAttribute('data-suffix') || '';

                    // Auto-detect "+" Prefix
                    if (raw.indexOf('+') !== -1 && !prefix) prefix = '+';

                    animateValue(el, 0, val, 2000, prefix, suffix);
                    observer.unobserve(el);
                });
            }, { threshold: 0.1 });

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
            selector = selector || '.nx-reveal';
            var elements = document.querySelectorAll(selector);
            if (!elements.length) return;

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('nx-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            elements.forEach(function (el) { observer.observe(el); });
        },


        /**
         * 7. TOC (Table of Contents) GENERATOR
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
         * 8. TOC DUPLICATE CLEANUP
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
                '.nexus-article-content .lwptoc',
                '.nexus-article-content [id^="ez-toc"]',
                '.nexus-article-content [class*="ez-toc"]'
            ];

            inlineTocSelectors.forEach(function (selector) {
                document.querySelectorAll(selector).forEach(function (node) {
                    node.remove();
                });
            });

            // Heuristik: TOC-ähnliche Boxen im Content mit vielen Anchor-Links entfernen.
            var content = document.querySelector('.nexus-article-content, #article-content');
            if (!content) return;

            var candidates = content.querySelectorAll('nav, aside, section, div');
            candidates.forEach(function (node) {
                if (node.closest('.nexus-sidebar')) return;

                var text = (node.textContent || '').trim().toLowerCase().slice(0, 220);
                var anchorCount = node.querySelectorAll('a[href^="#"]').length;
                if (anchorCount < 3) return;

                var isTocLikeText =
                    text.indexOf('inhaltsverzeichnis') !== -1 ||
                    text.indexOf('table of contents') !== -1 ||
                    text.indexOf('inhalt') === 0;

                var classHint = Array.from(node.classList || []).join(' ').toLowerCase();
                var idHint = (node.id || '').toLowerCase();
                var isTocLikeClass =
                    classHint.indexOf('toc') !== -1 ||
                    classHint.indexOf('table-of-contents') !== -1 ||
                    idHint.indexOf('toc') !== -1;

                if (isTocLikeText || isTocLikeClass) {
                    node.remove();
                }
            });
        },


        /**
         * 9. TOC CLEANUP WATCHER
         * Falls Plugins TOC-Boxen verzögert injizieren, werden sie nachträglich entfernt.
         */
        watchTocDuplicates: function () {
            var self = this;
            var content = document.querySelector('.nexus-article-content, #article-content');
            if (!content) return;

            self.cleanupDuplicateToc();
            setTimeout(function () { self.cleanupDuplicateToc(); }, 500);
            setTimeout(function () { self.cleanupDuplicateToc(); }, 1400);
            setTimeout(function () { self.cleanupDuplicateToc(); }, 2800);

            if (window.MutationObserver) {
                var observer = new MutationObserver(function () {
                    self.cleanupDuplicateToc();
                });

                observer.observe(content, { childList: true, subtree: true });

                setTimeout(function () {
                    observer.disconnect();
                }, 6000);
            }
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

            // Progress Bar nur auf Single Posts
            if (document.querySelector('.nexus-single-container, .single-post')) {
                this.initProgressBar();
            }

            // TOC auf Single Posts
            if (document.querySelector('#article-content') && document.querySelector('#toc-list')) {
                this.initToc('#article-content', '#toc-list');
                this.watchTocDuplicates();
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
