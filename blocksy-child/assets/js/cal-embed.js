/**
 * Progressive enhancement for Cal.com booking links.
 *
 * Existing anchors keep their normal href as fallback.
 * When JS is available, matching links open the Cal modal inline.
 */
(function () {
    'use strict';

    var config = window.NexusCalEmbedConfig || {};
    var loadPromise = null;
    var initialized = false;
    var preloaded = false;
    var observedRoot = null;

    function normalizePath(path) {
        var value = String(path || '').trim();

        if (!value) {
            return '';
        }

        return '/' + value.replace(/^\/+|\/+$/g, '');
    }

    function parseUrl(url) {
        try {
            return new URL(url, window.location.origin);
        } catch (error) {
            return null;
        }
    }

    function getConfiguredOrigin() {
        var configuredOrigin = String(config.calOrigin || '').trim();

        if (configuredOrigin) {
            return configuredOrigin;
        }

        var parsedBookingUrl = parseUrl(config.bookingUrl);
        return parsedBookingUrl ? parsedBookingUrl.origin : '';
    }

    function getConfiguredPath() {
        var configuredPath = normalizePath(config.calLink);

        if (configuredPath) {
            return configuredPath;
        }

        var parsedBookingUrl = parseUrl(config.bookingUrl);
        return parsedBookingUrl ? normalizePath(parsedBookingUrl.pathname) : '';
    }

    var calOrigin = getConfiguredOrigin();
    var calPath = getConfiguredPath();

    if (!calOrigin || !calPath || !config.embedScriptUrl || !config.namespace) {
        return;
    }

    function isModifiedClick(event) {
        return event.defaultPrevented
            || event.button !== 0
            || event.metaKey
            || event.ctrlKey
            || event.shiftKey
            || event.altKey;
    }

    function findAnchor(target) {
        var node = target && target.nodeType === 1 ? target : target && target.parentElement ? target.parentElement : null;

        return node && node.closest ? node.closest('a[href]') : null;
    }

    function getAnchorUrl(link) {
        if (!link) {
            return null;
        }

        return parseUrl(link.getAttribute('href'));
    }

    function isMatchingBookingLink(link) {
        var linkUrl = getAnchorUrl(link);

        if (!linkUrl) {
            return false;
        }

        return linkUrl.origin === calOrigin && normalizePath(linkUrl.pathname) === calPath;
    }

    function markBookingLink(link) {
        if (!isMatchingBookingLink(link)) {
            return false;
        }

        link.setAttribute('aria-haspopup', 'dialog');
        link.setAttribute('data-cal-link', String(config.calLink || '').trim());
        link.setAttribute('data-cal-namespace', String(config.namespace || '').trim());

        return true;
    }

    function decorateScope(scope) {
        var links;
        var index;

        if (!scope) {
            return;
        }

        if (scope.nodeType === 1 && scope.tagName === 'A') {
            markBookingLink(scope);
            return;
        }

        if (!scope.querySelectorAll) {
            return;
        }

        links = scope.querySelectorAll('a[href]');

        for (index = 0; index < links.length; index += 1) {
            markBookingLink(links[index]);
        }
    }

    function loadEmbedScript() {
        if (window.Cal && typeof window.Cal === 'function') {
            return Promise.resolve(window.Cal);
        }

        if (loadPromise) {
            return loadPromise;
        }

        loadPromise = new Promise(function (resolve, reject) {
            var script = document.createElement('script');

            script.src = String(config.embedScriptUrl);
            script.async = true;
            script.onload = function () {
                if (window.Cal && typeof window.Cal === 'function') {
                    resolve(window.Cal);
                    return;
                }

                loadPromise = null;
                reject(new Error('Cal embed API unavailable after script load.'));
            };
            script.onerror = function () {
                loadPromise = null;
                reject(new Error('Failed to load Cal embed script.'));
            };

            document.head.appendChild(script);
        });

        return loadPromise;
    }

    function resolveNamespaceApi(resolve, reject, attempt) {
        var namespaceApi = window.Cal && window.Cal.ns ? window.Cal.ns[config.namespace] : null;

        if (typeof namespaceApi === 'function') {
            resolve(namespaceApi);
            return;
        }

        if (attempt >= 8) {
            reject(new Error('Cal namespace API unavailable.'));
            return;
        }

        window.setTimeout(function () {
            resolveNamespaceApi(resolve, reject, attempt + 1);
        }, 50);
    }

    function getNamespaceApi() {
        return loadEmbedScript().then(function (Cal) {
            if (!initialized) {
                Cal('init', String(config.namespace), { origin: calOrigin });
                initialized = true;
            }

            return new Promise(function (resolve, reject) {
                resolveNamespaceApi(resolve, reject, 0);
            });
        });
    }

    function fallbackToLink(link) {
        var href = link ? link.getAttribute('href') : '';
        var target = link && link.getAttribute('target') ? String(link.getAttribute('target')).toLowerCase() : '';

        if (!href) {
            return;
        }

        if ('_blank' === target) {
            window.open(href, '_blank', 'noopener,noreferrer');
            return;
        }

        window.location.assign(href);
    }

    function preloadModal() {
        if (preloaded) {
            return;
        }

        preloaded = true;

        getNamespaceApi()
            .then(function (calApi) {
                calApi('preload', {
                    calLink: String(config.calLink),
                    calOrigin: calOrigin,
                    type: 'modal'
                });
            })
            .catch(function () {
                preloaded = false;
            });
    }

    function openModal(link) {
        getNamespaceApi()
            .then(function (calApi) {
                calApi('modal', {
                    calLink: String(config.calLink),
                    calOrigin: calOrigin
                });
            })
            .catch(function () {
                fallbackToLink(link);
            });
    }

    function handleClick(event) {
        var link = findAnchor(event.target);

        if (!link || !markBookingLink(link) || isModifiedClick(event)) {
            return;
        }

        event.preventDefault();
        openModal(link);
    }

    function handleFocusIn(event) {
        var link = findAnchor(event.target);

        if (!link || !markBookingLink(link)) {
            return;
        }

        preloadModal();
    }

    function handlePointerOver(event) {
        var link = findAnchor(event.target);

        if (!link || !markBookingLink(link)) {
            return;
        }

        preloadModal();
    }

    function handlePointerDown(event) {
        var link = findAnchor(event.target);

        if (!link || !markBookingLink(link)) {
            return;
        }

        preloadModal();
    }

    function observeDynamicLinks() {
        if (!window.MutationObserver || !document.body || observedRoot) {
            return;
        }

        observedRoot = new MutationObserver(function (mutations) {
            var mutationIndex;
            var nodeIndex;
            var mutation;
            var node;

            for (mutationIndex = 0; mutationIndex < mutations.length; mutationIndex += 1) {
                mutation = mutations[mutationIndex];

                for (nodeIndex = 0; nodeIndex < mutation.addedNodes.length; nodeIndex += 1) {
                    node = mutation.addedNodes[nodeIndex];
                    decorateScope(node);
                }
            }
        });

        observedRoot.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    function init() {
        decorateScope(document);
        observeDynamicLinks();

        document.addEventListener('click', handleClick);
        document.addEventListener('focusin', handleFocusIn);
        document.addEventListener('pointerdown', handlePointerDown, { passive: true });
        document.addEventListener('mouseover', handlePointerOver, { passive: true });
    }

    if ('loading' === document.readyState) {
        document.addEventListener('DOMContentLoaded', init, { once: true });
        return;
    }

    init();
}());
