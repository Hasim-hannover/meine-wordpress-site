<?php
/**
 * Template Name: Core Web Vitals
 * Description: Service Landing Page — Core Web Vitals Optimierung
 */

// --- SEO Meta (vor get_header) ---
add_filter('pre_get_document_title', function () {
    return 'Core Web Vitals Optimierung Hannover | Mehr Umsatz durch PageSpeed | Hasim Üner';
});

add_action('wp_head', function () {
    $url = esc_url(get_permalink());
    echo '<meta name="description" content="Core Web Vitals Optimierung aus Hannover: Verwandeln Sie langsame Ladezeiten in messbare Umsatzsteigerungen. PageSpeed &amp; Performance vom Growth Architect. Kostenlose Analyse!">';
    echo '<meta name="robots" content="index, follow">';
    echo '<link rel="canonical" href="' . $url . '">';
    echo '<meta property="og:title" content="Core Web Vitals Optimierung: Mehr Umsatz durch PageSpeed | Hasim Üner">';
    echo '<meta property="og:description" content="Verwandeln Sie langsame Ladezeiten in messbare Umsatzsteigerungen. Core Web Vitals Optimierung vom Growth Architect in Hannover.">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="' . $url . '">';
}, 1);

get_header();
?>

<!-- Inhalt aus dem Gutenberg-Editor (Custom HTML Block) -->
<div class="cwv-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
