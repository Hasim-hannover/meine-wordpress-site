<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blocksy
 */

get_header();
?>

<main id="main" class="site-main">
    <?php
    // Start the Loop.
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile; // End the loop.
    ?>
</main>

<?php
get_footer();