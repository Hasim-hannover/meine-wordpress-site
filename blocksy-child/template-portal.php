<?php
/**
 * Template Name: Nexus Portal
 * Description: Client Portal / Performance Cockpit
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="nexus-portal">
        <div class="nexus-portal-container">
            <?php echo do_shortcode( '[hu_performance_cockpit]' ); ?>
        </div>
    </div>
</main>

<?php
get_footer();
