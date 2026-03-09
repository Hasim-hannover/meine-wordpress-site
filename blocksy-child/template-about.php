<?php
/**
 * Template Name: Nexus Über Mich
 *
 * About-Seite – hardcoded Content (CRO-optimiert, Growth Audit als Primary CTA).
 * Design: Nexus Design System (Gold/Dark) via about-page.css.
 * SEO-Meta: inc/seo-meta.php (ACF: seo_title, seo_description, og_image)
 *
 * @package Blocksy_Child
 */

get_header();

$audit_url = nexus_get_audit_url();
$cases_url = nexus_get_page_url( [ 'case-studies-e-commerce', 'case-studies' ], home_url( '/case-studies-e-commerce/' ) );
?>

<div class="nexus-about" data-track-section="about_page">

<div class="nexus-container">
    <section id="about-hero" class="hero-story">
        <div class="hero-content">
            <div class="story-opener">
                <h1 class="story-headline">Über mich</h1>
                <h2>Eine Website sollte 2026 mehr sein als eine digitale Visitenkarte.</h2>
                <p>Ich entwickle Websites nicht als dekorative Oberfläche, sondern als geschäftlich relevantes System.<br>Ein System, das Orientierung schafft, Vertrauen aufbaut und dazu beiträgt, dass aus Aufmerksamkeit qualifizierte Anfragen werden.</p>
                <p>Viele Unternehmen sind online präsent. Aber ihre Website leistet zu wenig. Sie sieht ordentlich aus, sagt aber nicht präzise genug, worum es geht, wofür das Unternehmen steht und warum man gerade hier anfragen sollte.</p>
                <div class="about-hero-ctas">
                    <a href="<?php echo esc_url( $audit_url ); ?>"
                       class="btn btn-primary"
                       data-track-action="cta_about_hero_audit"
                       data-track-category="lead_gen">
                        Growth Audit starten
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="about-why" class="about-section">
        <h2>Warum viele Websites zu wenig leisten</h2>
        <p>Die meisten Websites scheitern nicht daran, dass sie komplett schlecht sind. Sie scheitern daran, dass sie zu wenig leisten.</p>
        <p>Sie sind da, aber sie führen nicht.<br>Sie informieren, aber sie ordnen nicht.<br>Sie wirken professionell, aber erzeugen zu wenig Klarheit.</p>
        <p>Gerade im B2B-Bereich ist das entscheidend. Noch bevor ein Gespräch stattfindet, entsteht bereits ein Urteil: Wirkt das Unternehmen klar? Ist die Leistung verständlich? Hat dieser Auftritt Substanz? Kann man ihm vertrauen?</p>
        <p>Eine Website beantwortet diese Fragen, lange bevor jemand Kontakt aufnimmt. Genau deshalb ist sie nicht nur Kommunikationsfläche, sondern Teil der geschäftlichen Wirklichkeit.</p>
    </section>

    <section id="about-system" class="about-section">
        <h2>Warum ich in Systemen denke</h2>
        <p>Ich betrachte Websites nicht isoliert. Für mich sind sie Teil eines größeren Zusammenhangs.</p>
        <p>Wenn die Positionierung unscharf ist, werden Texte beliebig.<br>Wenn die Struktur nicht trägt, verlieren Inhalte an Kraft.<br>Wenn Nutzer nicht klar geführt werden, hilft auch Reichweite wenig.<br>Wenn Daten fehlen oder falsch gelesen werden, entstehen schlechte Entscheidungen.</p>
        <p>Deshalb beginne ich nicht mit Aktionismus, sondern mit Logik.</p>
        <p>Was soll die Website leisten?<br>Welche Rolle hat jede Seite?<br>Wo entsteht Klarheit?<br>Wo entsteht Reibung?<br>Was muss ein Besucher verstehen, damit aus Interesse eine Anfrage werden kann?</p>
        <p>Mich interessiert nicht die Website als Objekt. Mich interessiert, ob sie geschäftlich etwas trägt.</p>
    </section>

    <section id="about-how" class="about-section">
        <h2>Wie ich arbeite</h2>
        <p>Ich glaube an Klarheit vor Komplexität.</p>
        <p>Nicht jedes Unternehmen braucht mehr Tools, mehr Seiten oder mehr Features. Oft braucht es zuerst eine sauber gedachte Grundlage: eine klare Positionierung, eine tragfähige Struktur, verständliche Kommunikation und eine Nutzerführung, die nicht dem Zufall überlassen wird.</p>
        <p>Ich arbeite deshalb nicht auf der Ebene einzelner Schönheitskorrekturen. Ich versuche, die Logik hinter einer Website so zu schärfen, dass sie verständlicher, belastbarer und nützlicher wird.</p>
        <p>Das Ziel ist nicht mehr Oberfläche.<br>Das Ziel ist mehr Substanz.</p>
    </section>

    <section id="about-forwhom" class="about-section">
        <h2>Für wen ich arbeite</h2>
        <p>Ich arbeite am liebsten mit Unternehmen, die mehr wollen als einen ansehnlichen Online-Auftritt.</p>
        <p>Mit Entscheidern, die verstanden haben, dass ihre Website nicht nur präsent sein, sondern geschäftlich etwas leisten muss.<br>Mit Unternehmen, die Klarheit höher bewerten als Lautstärke.<br>Mit Menschen, die keine digitale Fassade suchen, sondern eine tragfähige Grundlage.</p>
    </section>

    <section id="about-finalcta" class="about-section">
        <h2>Schluss</h2>
        <p>Ich helfe Unternehmen dabei, aus ihrer Website mehr zu machen als eine digitale Visitenkarte.</p>
        <p>Nicht lauter.<br>Nicht dekorativer.<br>Sondern klarer, tragfähiger und relevanter.</p>
        <p>Denn eine Website sollte heute nicht einfach nur da sein.<br>Sie sollte etwas leisten.</p>
        <div class="about-hero-ctas">
            <a href="<?php echo esc_url( $audit_url ); ?>"
               class="btn btn-primary"
               data-track-action="cta_about_final_audit"
               data-track-category="lead_gen">
                Growth Audit starten
            </a>
        </div>
    </section>
</div><!-- .nexus-container -->
</div><!-- .nexus-about -->

<?php get_footer(); ?>
