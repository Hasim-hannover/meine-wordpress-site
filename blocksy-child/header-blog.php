<?php
/**
 * Header für die Blogartikel.
 * Enthält den head-Bereich und den Anfang des body-Elements.
 *
 * @package Blocksy Child
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php
    // SEO-Tags und JSON-LD-Schema werden idealerweise von einem SEO-Plugin (z.B. Rank Math) verwaltet.
    // Die originalen Meta-Tags und das Schema wurden als Referenz entfernt,
    // da dies in WordPress dynamisch gehandhabt werden sollte.
    ?>
    <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/fonts/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <?php wp_head(); // Wichtiger WordPress-Hook für Plugins und Stylesheets ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="progress-bar" role="progressbar" aria-label="Lesefortschritt"></div>
    <div class="sr-only" aria-live="polite" id="live-region"></div>

