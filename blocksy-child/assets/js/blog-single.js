document.addEventListener('DOMContentLoaded', () => {
    const state = {
        isTocArmed: false,
        tocHideTimer: null
    };

    const UI = {
        tocContainer: document.getElementById('toc-container'),
        tocList: document.getElementById('toc-list'),
        headings: document.querySelectorAll('#article-content h2[id]'),
        copyBtn: document.getElementById('copy-link-btn'),
        copyText: document.getElementById('copy-link-text'),
        liveRegion: document.getElementById('live-region'),
    };

    function initReadingTime() {
        const articleContent = document.getElementById('article-content');
        if (!articleContent) return;

        const wpm = 250;
        const words = articleContent.innerText.trim().split(/\s+/).length;
        const readingTime = Math.max(1, Math.ceil(words / wpm));
        const el = document.getElementById('reading-time');
        if (el) el.innerText = `ca. ${readingTime} Min. Lesezeit`;
    }

    function initTOC() {
        if (!UI.tocList || !UI.headings || UI.headings.length === 0) return;
        
        const frag = document.createDocumentFragment();
        UI.headings.forEach(h => {
            const id = h.id;
            if (!id) return;
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = `#${id}`;
            a.textContent = h.textContent.replace(/^\d+\)\s*/, '');
            li.appendChild(a);
            frag.appendChild(li);
        });
        UI.tocList.appendChild(frag);
    }

    function setupShareLinks() {
        const url = encodeURIComponent(window.location.href);
        const title = encodeURIComponent(document.title);
        const t = document.getElementById('twitter-share');
        const l = document.getElementById('linkedin-share');
        const f = document.getElementById('facebook-share');
        
        if (t) t.href = `https://twitter.com/intent/tweet?url=${url}&text=${encodeURIComponent('Lesetipp: ' + document.title)}`;
        if (l) l.href = `https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`;
        if (f) f.href = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
    }

    function setupClipboard() {
        if (!UI.copyBtn) return;
        
        UI.copyBtn.addEventListener('click', async () => {
            const original = UI.copyText.innerText;
            try {
                if (navigator.clipboard) {
                    await navigator.clipboard.writeText(window.location.href);
                } else {
                    const ta = document.createElement('textarea');
                    ta.value = window.location.href;
                    ta.style.position = 'fixed'; ta.style.left = '-9999px';
                    document.body.appendChild(ta);
                    ta.select();
                    document.execCommand('copy');
                    document.body.removeChild(ta);
                }
                
                UI.copyText.innerText = 'Link kopiert!';
                UI.copyBtn.style.color = 'var(--success)';
                if (UI.liveRegion) UI.liveRegion.textContent = 'Link kopiert!';
                
                setTimeout(() => {
                    UI.copyText.innerText = original;
                    UI.copyBtn.style.color = '';
                }, 2000);
            } catch (e) {
                console.error('Copy failed', e);
                UI.copyText.innerText = 'Fehler!';
                if (UI.liveRegion) UI.liveRegion.textContent = 'Fehler beim Kopieren.';
                setTimeout(() => UI.copyText.innerText = original, 2000);
            }
        });
    }

    function setupIntersectionObserver() {
        if (!UI.headings || UI.headings.length < 2) return;
        
        const obs = new IntersectionObserver((entries) => {
            let firstVisibleId = null;
            const tocLinks = UI.tocList.querySelectorAll('a');
            
            entries.forEach(entry => {
                const link = UI.tocList.querySelector(`a[href="#${entry.target.id}"]`);
                if (entry.isIntersecting && !firstVisibleId) {
                    firstVisibleId = entry.target.id;
                }
            });

            if (!firstVisibleId) {
                 for (let i = UI.headings.length - 1; i >= 0; i--) {
                    if (UI.headings[i].getBoundingClientRect().top < 150) {
                        firstVisibleId = UI.headings[i].id;
                        break;
                    }
                }
            }
            
            tocLinks.forEach(a => a.classList.toggle('active', a.getAttribute('href') === `#${firstVisibleId}`));
            
            const secondHeadingEntry = entries.find(e => e.target === UI.headings[1]);
            
            if (secondHeadingEntry) {
                state.isTocArmed = secondHeadingEntry.isIntersecting || secondHeadingEntry.boundingClientRect.top < window.innerHeight;
                if (!state.isTocArmed && UI.tocContainer) {
                    UI.tocContainer.classList.remove('is-visible');
                }
            }
        }, {
            rootMargin: '0px 0px -85% 0px',
            threshold: 0.1
        });

        UI.headings.forEach(h => obs.observe(h));
    }

    function setupTocVisibility() {
        if (!UI.tocContainer) return;
        
        const show = () => {
            if (!state.isTocArmed) return;
            UI.tocContainer.classList.add('is-visible');
            clearTimeout(state.tocHideTimer);
            state.tocHideTimer = setTimeout(() => UI.tocContainer.classList.remove('is-visible'), 2500);
        };
        
        window.addEventListener('mousemove', show, { passive: true });
        window.addEventListener('click', show);
    }

    function setupFaqAccordion() {
        const articleContent = document.getElementById('article-content');
        if (!articleContent) return;

        const allDetails = articleContent.querySelectorAll('details');
        if (!allDetails.length) return;

        allDetails.forEach(details => {
            details.addEventListener('toggle', () => {
                if (details.open) {
                    allDetails.forEach(otherDetails => {
                        if (otherDetails !== details && otherDetails.open) {
                            otherDetails.open = false;
                        }
                    });
                }
            });
        });
    }

    // Initialisierungs-Funktion
    function init() {
        if (document.body.classList.contains('single-post')) {
            initReadingTime();
            initTOC();
            setupShareLinks();
            setupClipboard();
            setupIntersectionObserver();
            setupTocVisibility();
            setupFaqAccordion();
        }
    }

    init();
});

