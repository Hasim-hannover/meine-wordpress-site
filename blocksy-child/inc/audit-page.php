<?php
/**
 * Audit page rendering helpers.
 *
 * Keeps the audit landing page functional even if the WordPress editor content
 * is empty, broken or the page temporarily uses the default page template.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render the versioned review shell from the theme.
 *
 * @return string
 */
function nexus_get_audit_shell_markup() {
	ob_start();
	get_template_part( 'template-parts/audit-page-shell' );

	return (string) ob_get_clean();
}

/**
 * Ensure the review landing page always outputs the versioned theme shell.
 *
 * The editor content is intentionally bypassed so the live funnel stays coupled
 * to versioned theme code instead of fragile HTML snippets in the page editor.
 *
 * @param string $content Rendered page content.
 * @return string
 */
add_filter(
	'the_content',
	function ( $content ) {
		if ( is_admin() || ! nexus_is_audit_page() || ! is_singular( 'page' ) || ! in_the_loop() || ! is_main_query() ) {
			return $content;
		}

		return nexus_get_audit_shell_markup();
	},
	20
);
