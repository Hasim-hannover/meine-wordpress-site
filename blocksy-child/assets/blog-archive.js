document.addEventListener('DOMContentLoaded', () => {
    const articleContent = document.getElementById('article-content');
    if (!articleContent) return;

    const tocList = document.getElementById('toc-list');
    const progressBar = document.getElementById('progress-bar');
    const headings = articleContent.querySelectorAll('h2');
    const readingTimeEl = document.getElementById('reading-time');

    // 1) Lesezeit berechnen (Outcome-First: Zeitersparnis kommunizieren)
    const words = articleContent.innerText.trim().split(/\s+/).length;
    const time = Math.max(1, Math.ceil(words / 225));
    if (readingTimeEl) readingTimeEl.innerText = `ca. ${time} Min. Lesezeit`;

    // 2) Inhaltsverzeichnis (TOC) generieren
    if (headings.length > 0) {
        headings.forEach((heading, index) => {
            const id = `nexus-section-${index}`;
            heading.id = id;
            const li = document.createElement('li');
            li.innerHTML = `<a href="#${id}">${heading.textContent}</a>`;
            tocList.appendChild(li);
        });
    }

    // 3) Scroll-Logik: Fortschritt & Aktiver TOC-Link
    window.addEventListener('scroll', () => {
        const scroll = window.scrollY;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        const progress = (scroll / height) * 100;
        if (progressBar) progressBar.style.width = `${progress}%`;

        let activeId = '';
        headings.forEach(heading => {
            if (scroll >= heading.offsetTop - 150) activeId = heading.id;
        });
        document.querySelectorAll('.toc-nexus a').forEach(a => {
            a.classList.toggle('active', a.getAttribute('href') === `#${activeId}`);
        });
    }, { passive: true });

    // 4) Social Share (LinkedIn, X) & Copy Link
    const shareUrl = encodeURIComponent(window.location.href);
    const shareTitle = encodeURIComponent(document.title);

    const twitterBtn = document.getElementById('twitter-share');
    if (twitterBtn) twitterBtn.href = `https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}`;

    const linkedinBtn = document.getElementById('linkedin-share');
    if (linkedinBtn) linkedinBtn.href = `https://www.linkedin.com/sharing/share-offsite/?url=${shareUrl}`;

    const copyBtn = document.getElementById('copy-link-btn');
    if (copyBtn) {
        copyBtn.addEventListener('click', () => {
            navigator.clipboard.writeText(window.location.href);
            const text = document.getElementById('copy-link-text');
            text.innerText = 'Link kopiert!';
            setTimeout(() => text.innerText = 'Link kopieren', 2000);
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('article-content');
    if (!content) return;

    const tocList = document.getElementById('toc-list');
    const progressBar = document.getElementById('progress-bar');
    const headings = content.querySelectorAll('h2');

    // 1. Inhaltsverzeichnis dynamisch generieren
    headings.forEach((h2, index) => {
        const id = `nexus-h2-${index}`;
        h2.id = id;
        const li = document.createElement('li');
        li.innerHTML = `<a href="#${id}">${h2.innerText}</a>`;
        tocList.appendChild(li);
    });

    // 2. Lesefortschritt & TOC Highlighting
    window.addEventListener('scroll', () => {
        const scroll = window.scrollY;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        if (progressBar) progressBar.style.width = `${(scroll / height) * 100}%`;

        headings.forEach(h2 => {
            if (scroll >= h2.offsetTop - 150) {
                document.querySelectorAll('.toc-nexus a').forEach(a => a.classList.remove('active'));
                const activeLink = document.querySelector(`.toc-nexus a[href="#${h2.id}"]`);
                if (activeLink) activeLink.classList.add('active');
            }
        });
    }, { passive: true });
});