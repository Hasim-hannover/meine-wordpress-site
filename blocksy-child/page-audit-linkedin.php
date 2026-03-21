<?php
/**
 * Template Name: LinkedIn Audit Landing
 * Description: Isolierte Conversion-Landingpage — eigene HTML-Shell, kein Blocksy-Wrapper.
 *
 * Umgeht get_header() / get_footer() komplett, damit keine globalen
 * Theme-Elemente (Nav, Offcanvas, Drawer, Blocksy-Container) gerendert werden.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Suppress global wp_body_open elements — isolated landing page.
remove_action( 'wp_body_open', 'nexus_render_theme_toggle', 15 );
remove_action( 'wp_body_open', 'nexus_render_site_header', 20 );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part( 'template-parts/audit-linkedin-shell' ); ?>

<?php wp_footer(); ?>
</body>
</html>
