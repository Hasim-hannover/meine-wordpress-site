<?php
/**
 * Audit page rendering helpers.
 *
 * The page template renders the versioned shell directly. The content filter
 * below remains as a fallback in case the audit page temporarily falls back to
 * a default page flow that still calls the_content().
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the active audit experience from the theme.
 *
 * @return string
 */
function nexus_get_audit_shell_markup() {
	if ( shortcode_exists( 'cja_audit' ) ) {
		return do_shortcode( '[cja_audit]' );
	}

	ob_start();
	get_template_part( 'template-parts/audit-page-shell' );

	return (string) ob_get_clean();
}

/**
 * Replace audit page content with the active audit experience as a fallback.
 *
 * This keeps the live funnel coupled to versioned theme code even if the page
 * is rendered through a regular `the_content()` path.
 *
 * @param string $content Rendered page content.
 * @return string
 */
function nexus_replace_audit_page_content_with_shell( $content ) {
	if ( is_admin() || ! nexus_is_audit_page() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}

	return nexus_get_audit_shell_markup();
}

add_filter( 'the_content', 'nexus_replace_audit_page_content_with_shell', 20 );

/**
 * Output minimal audit-page CSS directly in <head>.
 *
 * The active audit route uses a shortcode-driven shell, but we still keep a
 * light fallback that hides duplicated page titles on non-template paths.
 */
function nexus_audit_head_styles() {
	if ( ! nexus_is_audit_page() ) {
		return;
	}
	?>
	<style id="nexus-audit-breakout">
		body.page-growth-audit .entry-header,
		body.page-growth-audit .ct-page-title {
			display: none !important;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'nexus_audit_head_styles', 999 );

/**
 * Force WordPress/Blocksy to use our custom page-audit.php template.
 *
 * Blocksy (as a hybrid block theme) may ignore the _wp_page_template meta
 * and fall back to its own page rendering, which wraps content inside
 * .entry-content / .ct-container with restrictive widths and padding.
 * This filter at priority 99 overrides that behaviour so the audit page
 * always uses our full-width, standalone template.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_force_audit_page_template( $template ) {
	if ( ! nexus_is_audit_page() || ! is_singular( 'page' ) ) {
		return $template;
	}

	$custom = get_stylesheet_directory() . '/page-audit.php';

	if ( file_exists( $custom ) ) {
		return $custom;
	}

	return $template;
}

add_filter( 'template_include', 'nexus_force_audit_page_template', 99 );
