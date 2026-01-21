<?php
/**
 * Template Name: Nexus Portal
 * Description: Client Portal / Performance Cockpit
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="nexus-portal">
        <?php echo do_shortcode( '[hu_performance_cockpit]' ); ?>
    </div>
</main>

<?php
get_footer();
