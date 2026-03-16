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
 * Render the versioned audit shell from the theme.
 *
 * @return string
 */
function nexus_get_audit_shell_markup() {
	ob_start();
	get_template_part( 'template-parts/audit-page-shell' );

	return (string) ob_get_clean();
}

/**
 * Replace audit page content with the versioned theme shell as a fallback.
 *
 * This keeps the live funnel coupled to versioned theme code instead of fragile
 * HTML snippets in the page editor when the page is rendered via the_content().
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
 * Output critical audit-page CSS directly in <head>.
 *
 * This is the most reliable CSS delivery method because it does not depend
 * on any wp_enqueue_style handle and cannot be stripped by caching plugins.
 * It ensures the audit shell breaks out of Blocksy's container constraints
 * even when page-audit.php template is not loaded.
 */
function nexus_audit_head_styles() {
	if ( ! nexus_is_audit_page() ) {
		return;
	}
	?>
	<style id="nexus-audit-breakout">
		/* Break .audit-wrapper out of Blocksy entry-content container */
		.audit-wrapper {
			width: 100vw !important;
			max-width: 100vw !important;
			margin-left: calc(-50vw + 50%) !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			box-sizing: border-box !important;
		}
		/* Remove constraints from Blocksy parent containers */
		.entry-content:has(.audit-wrapper),
		.ct-container:has(.audit-wrapper) {
			max-width: none !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			overflow: visible !important;
		}
		/* Fallback without :has() — target by body slug class */
		body.page-growth-audit .entry-content,
		body.page-growth-audit .ct-container,
		body.page-growth-audit .site-main,
		body.page-growth-audit .content-area {
			max-width: none !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			margin-left: 0 !important;
			margin-right: 0 !important;
			width: 100% !important;
			overflow: visible !important;
		}
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
