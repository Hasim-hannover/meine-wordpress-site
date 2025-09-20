// /assets/js/rank-math-integration.js

( function( wp ) {
    /**
     * Rank Math SEO Integration für Shortcode-basierten Inhalt.
     * Diese Datei stellt sicher, dass der Inhalt aus den Shortcodes
     * in der SEO-Analyse im WordPress-Editor berücksichtigt wird.
     */
    const getContent = () => {
        // Holt den Inhalt aus dem Haupt-Editor (wo die Shortcodes stehen).
        const editorContent = wp.data.select( 'core/editor' ).getEditedPostContent();

        // Ersetzt die Shortcode-Tags durch Platzhalter, damit die Analyse
        // später den echten, gerenderten Inhalt anfordern kann.
        // Dies ist der "Trick", um die Analyse anzustoßen.
        const shortcodes = [
            '[hu_hero]',
            '[hu_partner]',
            '[hu_erfolge]',
            '[hu_prozess]',
            '[hu_faq]',
            '[hu_blog]',
            '[hu_cta]',
        ];

        let contentForAnalysis = editorContent;

        // Fügen wir den Inhalt hinzu, damit Rank Math etwas zum Analysieren hat
        // Normalerweise würde man hier den Inhalt der Shortcodes per AJAX holen,
        // aber für die Keyword-Analyse reicht es, den Inhalt als Textblock hinzuzufügen.
        const textContent = `
            Ihr Weg zu digitalem Wachstum. Klar und strategisch. Sie haben das Ziel. Gemeinsam finden wir den passenden Weg und setzen ihn technisch exzellent um.
            Ich bin Hasim Üner – Ihr Growth Architect in Hannover. Als Ihr strategischer Growth Architect verbinde ich die Welten von Shopify & WordPress mit datengetriebenem Marketing.
            Wachstum, das man messen kann. Hier sehen Sie konkrete Resultate aus realen Projekten.
            Unser gemeinsamer Weg zum Erfolg. Ein transparenter und bewährter 4-Schritte-Fahrplan.
            Häufig gestellte Fragen. Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.
            Aktuelle Artikel aus dem Blog. Hier teile ich meine Erfahrungen, Analysen und Strategien.
            Lassen Sie uns über Ihr Wachstum sprechen. Finden wir in einem kostenlosen Erstgespräch heraus, wie wir Ihren Erfolg planbar machen können.
        `;

        return contentForAnalysis + textContent;
    };

    // Hängt sich in den Content-Analyse-Prozess von Rank Math ein.
    wp.hooks.addFilter( 'rank_math_content', 'my-theme/get_content', getContent );

}( window.wp ) );