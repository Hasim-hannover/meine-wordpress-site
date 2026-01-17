document.addEventListener('DOMContentLoaded', () => {
    const content = document.getElementById('article-content');
    const tocList = document.getElementById('toc-list');
    
    if (!content || !tocList) return;

    // Alle H2 Überschriften im Content suchen
    const headings = content.querySelectorAll('h2');

    if (headings.length === 0) {
        document.getElementById('toc-container').style.display = 'none';
        return;
    }

    headings.forEach((h2, index) => {
        // ID für den Anker vergeben, falls keine da ist
        const id = `nexus-anchor-${index}`;
        h2.id = id;

        // Listen-Element für das TOC erstellen
        const li = document.createElement('li');
        li.style.marginBottom = '10px';
        li.innerHTML = `<a href="#${id}" style="text-decoration:none; color:var(--text-dim); font-size:0.9rem;">${h2.innerText}</a>`;
        tocList.appendChild(li);
    });

    // Scroll-Effekt für den Fortschrittsbalken
    window.addEventListener('scroll', () => {
        const scroll = window.scrollY;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        const progress = (scroll / height) * 100;
        const bar = document.getElementById('progress-bar');
        if (bar) bar.style.width = `${progress}%`;
    });
});