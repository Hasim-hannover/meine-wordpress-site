document.addEventListener('DOMContentLoaded', () => {
    // Kurze Verzögerung für Gutenberg-Inhalte
    setTimeout(() => {
        const article = document.getElementById('article-content');
        const tocList = document.getElementById('toc-list');
        const tocContainer = document.getElementById('toc-container');
        
        if (!article || !tocList) return;

        // Suche nach H2-Überschriften
        const headings = article.querySelectorAll('h2');
        console.log("Nexus-TOC: Gefundene H2-Überschriften:", headings.length);

        if (headings.length === 0) {
            if (tocContainer) tocContainer.style.display = 'none';
            return;
        }

        // TOC befüllen
        tocList.innerHTML = ''; 
        headings.forEach((h2, index) => {
            const id = `section-${index}`;
            h2.id = id;

            const li = document.createElement('li');
            li.style.marginBottom = "12px";
            li.innerHTML = `<a href="#${id}" style="color:var(--text-dim); text-decoration:none; font-size:0.95rem; display:block; transition:0.3s;">${h2.innerText}</a>`;
            
            // Hover Effekt
            const link = li.querySelector('a');
            link.onmouseover = () => link.style.color = 'var(--gold)';
            link.onmouseout = () => link.style.color = 'var(--text-dim)';
            
            tocList.appendChild(li);
        });
    }, 100); // 100ms warten für Stabilität
});