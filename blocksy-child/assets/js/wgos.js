/**
 * WGOS Page – Tracking Events + Sticky Nav Scroll-Spy
 * Privacy-by-Design: Nur dataLayer-Pushes, keine externen Libs.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // =============================================
        // 1. SCROLL-SPY für Inpage-Nav
        // =============================================
        if (window.NexusCore && document.querySelector('.wgos-inpage-nav')) {
            NexusCore.initScrollSpy('.wgos-inpage-nav', 'section[id]', 200);
        }

        // =============================================
        // 2. SCROLL DEPTH TRACKING (50% / 90%)
        // =============================================
        var scrolled50 = false;
        var scrolled90 = false;

        window.addEventListener('scroll', function () {
            var docH = document.documentElement.scrollHeight - window.innerHeight;
            if (docH <= 0) return;
            var pct = (window.scrollY / docH) * 100;

            if (!scrolled50 && pct >= 50) {
                scrolled50 = true;
                pushEvent('scroll_depth_50');
            }
            if (!scrolled90 && pct >= 90) {
                scrolled90 = true;
                pushEvent('scroll_depth_90');
            }
        }, { passive: true });

        // =============================================
        // 3. CTA CLICK TRACKING
        // =============================================
        document.querySelectorAll('[data-track="cta_click_audit"]').forEach(function (el) {
            el.addEventListener('click', function () {
                pushEvent('cta_click_audit');
            });
        });

        document.querySelectorAll('[data-track="cta_click_calendar"]').forEach(function (el) {
            el.addEventListener('click', function () {
                pushEvent('cta_click_calendar');
            });
        });

        // =============================================
        // 4. FAQ EXPAND TRACKING
        // =============================================
        document.querySelectorAll('.wgos-faq details').forEach(function (item) {
            item.addEventListener('toggle', function () {
                if (this.open) {
                    var label = this.querySelector('summary');
                    pushEvent('faq_expand', {
                        faq_label: label ? label.textContent.trim() : ''
                    });
                }
            });
        });

        // =============================================
        // 5. SECTION VISIBILITY TRACKING
        // =============================================
        var visTargets = {
            'module': 'module_view',
            'credits': 'credits_table_view',
            'pakete': 'package_view'
        };

        var visObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var id = entry.target.getAttribute('id');
                if (visTargets[id]) {
                    pushEvent(visTargets[id]);
                    visObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.25 });

        Object.keys(visTargets).forEach(function (id) {
            var el = document.getElementById(id);
            if (el) visObserver.observe(el);
        });

        // =============================================
        // 6. MODULE VISIBILITY TRACKING (each module)
        // =============================================
        document.querySelectorAll('.wgos-module[id^="modul-"]').forEach(function (mod) {
            var modObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        pushEvent('module_view', {
                            module_id: entry.target.id
                        });
                        modObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            modObserver.observe(mod);
        });

    });

    // =============================================
    // HELPER: Push to dataLayer
    // =============================================
    function pushEvent(name, params) {
        window.dataLayer = window.dataLayer || [];
        var obj = { event: name };
        if (params) {
            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    obj[key] = params[key];
                }
            }
        }
        window.dataLayer.push(obj);
    }

})();
