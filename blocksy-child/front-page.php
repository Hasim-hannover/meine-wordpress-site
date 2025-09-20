<?php
/**
 * The template for displaying the front page.
 * Diese Version lädt den reinen HTML-Inhalt aus dem WordPress-Editor.
 *
 * @package Blocksy Child
 */

get_header();
?>

<main id="main" class="site-main">
    <?php
    // Start the Loop, um den Inhalt der als Startseite festgelegten Seite zu laden.
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile; // End the loop.
    ?>
</main>

<?php
get_footer();