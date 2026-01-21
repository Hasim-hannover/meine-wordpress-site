<?php
/**
 * Template Name: Nexus Über Mich
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="nexus-about">
        <div class="nexus-container">
            <?php
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
