<?php
/**
 * Template Name: Agentur Service (Hannover)
 * Description: Lädt CSS und zeigt Gutenberg-Inhalt an
 */

get_header(); 
?>

<!-- CSS laden: Exakt wie besprochen -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/agentur.css?v=<?php echo time(); ?>">

<!-- Hier wird der Inhalt aus dem Gutenberg-Editor ausgegeben -->
<div class="wp-agentur-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>