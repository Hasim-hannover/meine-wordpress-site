document.addEventListener('DOMContentLoaded', () => {
    // 1. Suche den Inhaltsbereich und die TOC-Liste
    const article = document.getElementById('article-content');
    const tocList = document.getElementById('toc-list');
    
    // Wenn eins von beiden fehlt, brechen wir ab
    if (!article || !tocList) {
        console.log("Nexus-Error: article-content oder toc-list nicht gefunden.");
        return;
    }

    // 2. Suche alle H2 Überschriften
    const headings = article.querySelectorAll('h2');
    
    if (headings.length === 0) {
        document.getElementById('toc-container').style.display = 'none';
        return;
    }

    // 3. Generiere die Punkte
    headings.forEach((h2, index) => {
        const id = `section-${index}`;
        h2.id = id; // Setzt den Anker für den Klick

        const li = document.createElement('li');
        li.style.marginBottom = "12px";
        li.innerHTML = `<a href="#${id}" style="color:var(--text-dim); text-decoration:none; font-size:0.95rem; transition:0.2s;">${h2.innerText}</a>`;
        tocList.appendChild(li);
    });

    console.log(`${headings.length} Punkte im TOC generiert.`);
});