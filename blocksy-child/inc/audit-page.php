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
 * Check whether a content blob already contains the audit shell markup.
 *
 * @param string $content Raw post content.
 * @return bool
 */
function nexus_content_has_audit_shell( $content ) {
	$content = (string) $content;

	return false !== strpos( $content, 'id="audit-main-wrapper"' )
		|| false !== strpos( $content, "id='audit-main-wrapper'" )
		|| false !== strpos( $content, 'id="audit-live-form"' )
		|| false !== strpos( $content, "id='audit-live-form'" )
		|| false !== strpos( $content, 'class="audit-wrapper"' )
		|| false !== strpos( $content, "class='audit-wrapper'" );
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
 * Ensure the audit page always outputs a working shell.
 *
 * If the editor content already contains a valid audit DOM wrapper, we keep it.
 * Otherwise we replace the body with the versioned theme shell.
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

		if ( nexus_content_has_audit_shell( $content ) ) {
			return $content;
		}

		return nexus_get_audit_shell_markup();
	},
	20
);
