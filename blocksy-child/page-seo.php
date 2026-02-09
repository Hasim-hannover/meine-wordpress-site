<?php
/**
 * Template Name: SEO Landing (Hannover)
 * Description: WordPress SEO Hannover — Service Landing Page
 */

// --- SEO Meta (vor get_header) ---
add_filter('pre_get_document_title', function () {
    return 'WordPress SEO Hannover · Technical SEO & Growth · Hasim Üner';
});

add_action('wp_head', function () {
    echo '<meta name="description" content="WordPress SEO Hannover: Technical SEO, Core Web Vitals, Local SEO & Content-Strategie. Sichtbarkeit, die verkauft. Kostenloser SEO-Audit verfügbar.">';
    echo '<meta name="robots" content="index, follow">';
    echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">';
}, 1);

get_header();
?>

<!-- Inhalt aus dem Gutenberg-Editor (Custom HTML Block) -->
<div class="seo-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
