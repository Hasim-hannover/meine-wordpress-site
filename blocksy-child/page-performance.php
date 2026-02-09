<?php
/**
 * Template Name: Performance Marketing
 * Description: Service Landing Page — Performance Marketing
 */

// --- SEO Meta (vor get_header) ---
add_filter('pre_get_document_title', function () {
    return 'Performance Marketing: Strategie für messbares Wachstum | Hasim Üner';
});

add_action('wp_head', function () {
    $url = esc_url(get_permalink());
    echo '<meta name="description" content="Schluss mit Marketing nach Bauchgefühl. Entdecken Sie, wie wir mit einer daten-getriebenen Performance-Marketing-Strategie jeden Werbe-Euro in messbaren Umsatz verwandeln.">';
    echo '<meta name="robots" content="index, follow">';
    echo '<link rel="canonical" href="' . $url . '">';
    echo '<meta property="og:title" content="Performance Marketing: Mehr Umsatz durch daten-getriebene Strategie | Hasim Üner">';
    echo '<meta property="og:description" content="Verwandeln Sie Ihr Marketingbudget in messbaren Umsatz. Performance Marketing vom Growth Architect in Hannover.">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="' . $url . '">';
}, 1);

get_header();
?>

<div class="pm-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
