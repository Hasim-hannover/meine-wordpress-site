<?php
/**
 * Die Template-Datei für die Startseite.
 */

// Schritt 1: Lade den Header. Dies löst unseren Code in functions.php aus.
get_header(); 
?>

<main id="main" class="site-main" role="main">
    
    <!-- DEIN STARTSEITEN-INHALT KOMMT HIER REIN -->
    <div class="container">
        <h1>Willkommen auf der Startseite</h1>
        <p>Dieser Inhalt kommt aus der front-page.php.</p>
        <p>Der Header oben und der Footer unten werden jetzt korrekt geladen.</p>
    </div>
    <!-- ENDE DEINES STARTSEITEN-INHALTS -->

</main>

<?php
// Schritt 2: Lade den Footer.
get_footer(); 

