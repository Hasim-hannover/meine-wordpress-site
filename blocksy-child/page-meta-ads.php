<?php
/**
 * Template Name: Meta Ads Landing
 * Description:  Meta Ads (Facebook & Instagram) – Service-Seite
 */

add_action( 'wp_head', function () {
    $canonical = home_url( '/meta-ads/' );
    ?>
    <!-- SEO: Meta Ads Landing -->
    <meta name="description" content="Schluss mit verbranntem Werbebudget. Entdecken Sie, wie wir mit strategischen Meta Ads auf Facebook &amp; Instagram Ihre idealen Kunden finden und zu messbarem Wachstum f&uuml;hren.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="Meta Ads (Facebook &amp; Instagram): Pr&auml;zises Marketing | Hasim &Uuml;ner">
    <meta property="og:description" content="Profitables Wachstum durch strategische Meta Ads – von der Zielgruppenanalyse &uuml;ber Creative-Entwicklung bis zur laufenden Kampagnenoptimierung.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
    <meta property="og:image" content="https://hasimuener.de/wp-content/uploads/2025/08/Meta-Ads_Hero.webp">
    <meta property="og:locale" content="de_DE">
    <?php
}, 1 );

get_header();
?>

<div class="ma-page">
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
