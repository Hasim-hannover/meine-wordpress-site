<?php
/**
 * Template Name: WGOS System
 * Description: WordPress Growth Operating System – Lädt CSS und zeigt Gutenberg-Inhalt an
 */

get_header(); 
?>

<div class="wgos-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
