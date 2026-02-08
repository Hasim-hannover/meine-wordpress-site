<?php
/**
 * Template Name: Agentur Service (Hannover)
 * Description: Lädt CSS und zeigt Gutenberg-Inhalt an
 */

get_header(); 
?>

<!-- Inhalt aus dem Gutenberg-Editor -->
<div class="wp-agentur-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>