<?php
/**
 * Template Name: GA4 Tracking Landing
 * Description:  GA4 & Tracking Setup – Service-Seite
 */

add_action( 'wp_head', function () {
    $canonical = home_url( '/ga4-tracking-setup/' );
    ?>
    <!-- SEO: GA4 & Tracking Setup -->
    <meta name="description" content="Treffen Sie keine Entscheidungen im Blindflug. Mit einem sauberen GA4 &amp; Tracking Setup schaffen wir die verl&auml;ssliche Datengrundlage f&uuml;r messbares und profitables Wachstum.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="GA4 &amp; Tracking Setup: Vom Daten-Nebel zur Klarheit | Hasim &Uuml;ner">
    <meta property="og:description" content="Professionelles GA4 Setup, serverseitiges Tracking und DSGVO-konforme Implementierung f&uuml;r verl&auml;ssliche Daten und messbares Wachstum.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
    <meta property="og:image" content="https://hasimuener.de/wp-content/uploads/2025/08/GA4-Tracking-Setup-Hero_bild.webp">
    <meta property="og:locale" content="de_DE">
    <?php
}, 1 );

get_header();
?>

<div class="ga4-page">
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
