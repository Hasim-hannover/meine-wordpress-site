// /assets/js/rank-math-integration.js

( function( wp ) {
    /**
     * Rank Math SEO Integration für Shortcode-basierten Inhalt.
     * FINALE VERSION mit vollständigem Textinhalt für eine korrekte Analyse.
     */
    const getContent = () => {
        // Holt den Inhalt aus dem Haupt-Editor (wo die Shortcodes stehen).
        const editorContent = wp.data.select( 'core/editor' ).getEditedPostContent();

        // Dies ist der vollständige, reine Textinhalt deiner Startseite.
        // Rank Math wird diesen Text für die Analyse verwenden.
        const fullTextContent = `
            Ihr Weg zu digitalem Wachstum. Klar und strategisch.
            Sie haben das Ziel. Gemeinsam finden wir den passenden Weg und setzen ihn technisch exzellent um.
            E-Commerce & Shopify. Für Online-Shops, die nicht nur gut aussehen, sondern vor allem verkaufen und durch Daten profitabel wachsen sollen.
            Website & WordPress. Für Dienstleister & B2B-Unternehmen, deren Website als überzeugende Lead-Quelle arbeiten und die Marke optimal repräsentieren soll.
            Max ROAS 34. Leads 2500. % CPL ↓ 83. SEO ↑ (%) 500.
            Ich bin Hasim Üner – Ihr Growth Architect in Hannover.
            Als Ihr strategischer Growth Architect verbinde ich die Welten von Shopify & WordPress mit datengetriebenem Marketing – von sauberem GA4-Tracking bis zur Core Web Vitals Optimierung. Das Ziel: Eine ganzheitliche Strategie für Ihren messbaren Erfolg.
            Wachstum, das man messen kann. Hier sehen Sie konkrete Resultate aus realen Projekten. Sie zeigen, wie eine integrierte Strategie den entscheidenden Unterschied macht.
            E3 New Energy — B2C Leadgenerierung. Erneuerbare Energien · Tech-Marketing-Integration · 8 Monate. Qualifizierte Leads 1.750+. CPL-Reduktion (-83%) 120€ → 25€. Konstanter ROAS 28–34×. Organischer Traffic +500%.
            DOMDAR — E-Commerce Transformation. Sustainable E-Commerce · Shopify Plus · UX/CRO · 6 Monate. Conversion Rate +270%. Ø Bestellwert 22€ → 120€. Kundenakquisekosten 70€ → 26€. Warenkorbabbrüche -62%.
            Unser gemeinsamer Weg zum Erfolg. Ein transparenter und bewährter 4-Schritte-Fahrplan — von der ersten Analyse bis zur nachhaltigen Skalierung.
            Analyse & Strategie. Wir starten mit einem Deep-Dive: Aktueller Status, Ziele, Quick-Wins. Daraus entsteht eine klare, umsetzbare Roadmap.
            Konzeption & Design. Auf Basis der Strategie entwickeln wir ein conversion-orientiertes Design und eine technische Architektur, die auf Ihre Ziele einzahlt.
            Entwicklung & Umsetzung. Die Umsetzung erfolgt in agilen Sprints. Sie erhalten regelmäßig Updates und können den Fortschritt live mitverfolgen.
            Optimierung & Skalierung. Nach dem Launch beginnt die wichtigste Phase: Wir messen, testen und optimieren kontinuierlich, um Ihr Wachstum zu maximieren.
            Häufig gestellte Fragen. Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.
            Wie schnell kann unser Projekt starten? Nach unserem Erstgespräch meist innerhalb von 3–5 Werktagen. Einfache WordPress-Sites sind oft in 2–3 Wochen live, komplexere E-Commerce Projekte in 4–8 Wochen.
            Was kostet eine professionelle Website? Starter-Projekte beginnen ab 3.500€. In unserem kostenlosen Erstgespräch ermitteln wir den genauen Bedarf und erstellen ein passgenaues Angebot.
            Bieten Sie auch Wartung & Support an? Ja. Ich biete flexible Service-Pakete für regelmäßige Updates, Backups, Sicherheits-Checks und Performance-Monitoring an.
            Wie wird der Erfolg des Projekts gemessen? Anhand klar definierter KPIs, die wir gemeinsam festlegen: z. B. Conversion-Rate, ROAS, Cost-per-Lead oder organischen Traffic. Sie erhalten transparente Reportings.
            Aktuelle Artikel aus dem Blog. Hier teile ich meine Erfahrungen, Analysen und Strategien rund um E-Commerce, WordPress und digitales Wachstum.
            Design ist mehr als Ästhetik. Gutes Design ist mehr als Optik. Es ist ein direkter Hebel für eine höhere Conversion Rate und besseren ROAS.
            Datenhoheit mit server-side-gtm. Erobern Sie Ihre Datenhoheit zurück und machen Sie sich unabhängig von Drittanbieter-Pixeln.
            Performance ist Profit. Jede Millisekunde Ladezeit entscheidet über Profit. So treiben die Core Web Vitals Ihr gesamtes Wachstum.
            Lassen Sie uns über Ihr Wachstum sprechen. Sie haben das Ziel, ich bringe die Strategie und die technische Expertise mit. Finden wir in einem kostenlosen Erstgespräch heraus, wie wir Ihren Erfolg planbar machen können.
        `;

        // Wir geben den Editor-Inhalt (die Shortcodes) plus den vollen Textinhalt zurück.
        return editorContent + fullTextContent;
    };

    // Hängt sich in den Content-Analyse-Prozess von Rank Math ein.
    wp.hooks.addFilter( 'rank_math_content', 'my-theme/get_content', getContent );

}( window.wp ) );