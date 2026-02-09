<?php
/**
 * Template Name: Customer Journey Audit
 * Description: Landing Page — Customer Journey Audit (Formular + Report)
 */

// --- SEO Meta (vor get_header, damit wp_head die Hooks hat) ---
add_filter('pre_get_document_title', function () {
    return 'Customer Journey Audit · Kostenlos · Hasim Üner';
});

add_action('wp_head', function () {
    echo '<meta name="description" content="Kostenloser Customer Journey Audit: Wir simulieren die Reise Ihres nächsten Kunden — von der Google-Suche bis zur Kontaktaufnahme. Sehen Sie, wo Interessenten abspringen und was es kostet.">';
    echo '<meta name="robots" content="index, follow">';
    echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '">';
}, 1);

get_header();
?>

<!-- Inhalt aus dem Gutenberg-Editor (Custom HTML Block) -->
<div class="audit-page-wrapper">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</div>

<?php get_footer(); ?>
