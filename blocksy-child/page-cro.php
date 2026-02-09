<?php
/**
 * Template Name: CRO Landing
 * Description:  Conversion Rate Optimization – Service-Seite
 */

add_action( 'wp_head', function () {
    $canonical = home_url( '/conversion-rate-optimization/' );
    ?>
    <!-- SEO: CRO Landing -->
    <meta name="description" content="Ihre Website hat Besucher, aber zu wenige Kunden? Entdecken Sie, wie wir durch daten-getriebene Conversion Rate Optimization aus Klicks echte Ergebnisse machen.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="Conversion Rate Optimization: Vom Klick zum Kunden | Hasim Üner">
    <meta property="og:description" content="Wir analysieren Nutzerverhalten und bauen den direktesten Weg von der Information zum messbaren Ergebnis – sei es ein Kauf, eine Anfrage oder ein Lead.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
    <meta property="og:image" content="https://hasimuener.de/wp-content/uploads/2025/08/CRO-herobild.webp">
    <meta property="og:locale" content="de_DE">
    <?php
}, 1 );

get_header();
?>

<div class="cro-page">
    <?php the_content(); ?>
</div>

<?php get_footer(); ?>
