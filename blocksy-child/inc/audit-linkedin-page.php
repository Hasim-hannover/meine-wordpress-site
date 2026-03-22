<?php
/**
 * LinkedIn Audit Landing Page: virtual route, detection and noindex.
 *
 * Mirrors the /kontakt/ virtual-route pattern so that /audit-linkedin/
 * works without a physical WordPress page in the database.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the canonical featured image URL for the LinkedIn audit landing page.
 *
 * @return string
 */
function nexus_get_audit_linkedin_featured_image_source_url() {
	return content_url( '/uploads/2026/03/audit-linkedin-featured-1200x675-1.png' );
}

/**
 * Resolve the current featured image URL for the LinkedIn audit landing page.
 *
 * Prefer the real page thumbnail when it exists, otherwise fall back to the
 * canonical campaign image URL.
 *
 * @return string
 */
function nexus_get_audit_linkedin_featured_image_url() {
	$page_id = nexus_get_page_id( [ 'audit-linkedin' ] );

	if ( $page_id ) {
		$thumbnail_url = get_the_post_thumbnail_url( (int) $page_id, 'full' );

		if ( $thumbnail_url ) {
			return $thumbnail_url;
		}
	}

	return nexus_get_audit_linkedin_featured_image_source_url();
}

/* ──────────────────────────────────────────────────────────────────
 * 1. PATH HELPERS
 * ────────────────────────────────────────────────────────────────── */

/**
 * Return the canonical request path for the LinkedIn audit landing page.
 *
 * @return string
 */
function nexus_get_audit_linkedin_request_path() {
	return trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/audit-linkedin/' ), PHP_URL_PATH ), '/' ) );
}

/**
 * Check whether the current request targets the LinkedIn audit path.
 *
 * @return bool
 */
function nexus_is_audit_linkedin_request_path() {
	return nexus_get_current_request_path() === nexus_get_audit_linkedin_request_path();
}

/**
 * Determine whether the current request is the LinkedIn audit landing page.
 *
 * @return bool
 */
function nexus_is_audit_linkedin_page() {
	if ( nexus_is_audit_linkedin_request_path() ) {
		return true;
	}

	return is_page( 'audit-linkedin' )
		|| is_page_template( 'page-audit-linkedin.php' );
}

/**
 * Resolve the public URL for the LinkedIn audit landing page.
 *
 * @return string
 */
function nexus_get_audit_linkedin_url() {
	$page_id = nexus_get_page_id( [ 'audit-linkedin' ] );

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	return home_url( '/audit-linkedin/' );
}

/**
 * Ensure the canonical /audit-linkedin/ page exists as a published page.
 *
 * The route can still render virtually, but a real page keeps native helpers,
 * editor access and featured-image handling aligned with the rest of WordPress.
 *
 * @return void
 */
function nexus_maybe_ensure_audit_linkedin_page() {
	if ( wp_installing() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}

	$page_id = nexus_get_page_id( [ 'audit-linkedin' ] );

	if ( ! $page_id ) {
		$page_id = wp_insert_post(
			wp_slash(
				[
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_title'   => 'Audit LinkedIn',
					'post_name'    => 'audit-linkedin',
					'post_content' => '',
					'post_excerpt' => 'Noindex-Kampagnenseite für den LinkedIn-Traffic des Website Audits.',
				]
			),
			true
		);

		if ( is_wp_error( $page_id ) ) {
			return;
		}
	}

	$page_id = (int) $page_id;

	update_post_meta( $page_id, '_wp_page_template', 'page-audit-linkedin.php' );

	$attachment_id = attachment_url_to_postid( nexus_get_audit_linkedin_featured_image_source_url() );

	if ( $attachment_id > 0 && (int) get_post_meta( $page_id, '_thumbnail_id', true ) !== (int) $attachment_id ) {
		update_post_meta( $page_id, '_thumbnail_id', (int) $attachment_id );
	}
}
add_action( 'init', 'nexus_maybe_ensure_audit_linkedin_page', 29 );

/* ──────────────────────────────────────────────────────────────────
 * 2. VIRTUAL ROUTE (pre_handle_404 → template_include)
 * ────────────────────────────────────────────────────────────────── */

/**
 * Prevent canonical redirects for the virtual /audit-linkedin/ route.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function nexus_disable_canonical_redirect_for_audit_linkedin( $redirect_url ) {
	if ( nexus_is_audit_linkedin_request_path() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'nexus_disable_canonical_redirect_for_audit_linkedin' );

/**
 * Turn the audit-linkedin request into a virtual page when no real page exists.
 *
 * @param bool     $preempt  Existing preempt flag.
 * @param WP_Query $wp_query Current query.
 * @return bool
 */
function nexus_preempt_audit_linkedin_404( $preempt, $wp_query ) {
	if ( is_admin() || wp_doing_ajax() || ! ( $wp_query instanceof WP_Query ) ) {
		return $preempt;
	}

	if ( ! nexus_is_audit_linkedin_request_path() ) {
		return $preempt;
	}

	$wp_query->is_404            = false;
	$wp_query->is_page           = true;
	$wp_query->is_singular       = true;
	$wp_query->is_home           = false;
	$wp_query->is_archive        = false;
	$wp_query->is_posts_page     = false;
	$wp_query->queried_object    = null;
	$wp_query->queried_object_id = 0;
	$wp_query->query_vars['pagename'] = 'audit-linkedin';
	unset( $wp_query->query['error'], $wp_query->query_vars['error'] );

	status_header( 200 );

	return true;
}
add_filter( 'pre_handle_404', 'nexus_preempt_audit_linkedin_404', 10, 2 );

/**
 * Use the native audit-linkedin template for the virtual route.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_use_virtual_audit_linkedin_template( $template ) {
	if ( ! nexus_is_audit_linkedin_request_path() || is_page( 'audit-linkedin' ) ) {
		return $template;
	}

	$virtual_template = get_stylesheet_directory() . '/page-audit-linkedin.php';

	if ( file_exists( $virtual_template ) ) {
		return $virtual_template;
	}

	return $template;
}
add_filter( 'template_include', 'nexus_use_virtual_audit_linkedin_template', 99 );

/**
 * Clean body classes for the audit-linkedin standalone landing page.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function nexus_add_virtual_audit_linkedin_body_class( $classes ) {
	if ( ! nexus_is_audit_linkedin_page() ) {
		return $classes;
	}

	// Remove classes from Blocksy / global header that don't apply.
	$classes = array_diff(
		$classes,
		[ 'error404', 'nx-custom-header-active', 'nx-blog-header-active' ]
	);

	$classes[] = 'page';
	$classes[] = 'page-audit-linkedin';
	$classes[] = 'page-template-page-audit-linkedin';
	$classes[] = 'ali-standalone';

	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'nexus_add_virtual_audit_linkedin_body_class', 20 );

/* ──────────────────────────────────────────────────────────────────
 * 3. SITEMAP — Exclude campaign page
 * ────────────────────────────────────────────────────────────────── */

/**
 * Exclude the audit-linkedin virtual page from the WordPress sitemap.
 *
 * @param array  $args      Query arguments.
 * @param string $post_type Post type.
 * @return array
 */
function nexus_exclude_audit_linkedin_from_sitemap( $args, $post_type ) {
	if ( 'page' !== $post_type ) {
		return $args;
	}

	$page_id = nexus_get_page_id( [ 'audit-linkedin' ] );

	if ( $page_id ) {
		$existing = isset( $args['post__not_in'] ) ? (array) $args['post__not_in'] : [];
		$existing[] = $page_id;
		$args['post__not_in'] = $existing;
	}

	return $args;
}
add_filter( 'wp_sitemaps_posts_query_args', 'nexus_exclude_audit_linkedin_from_sitemap', 10, 2 );

/* ──────────────────────────────────────────────────────────────────
 * 4. ASSET ISOLATION — Dequeue global assets not needed on this LP
 * ────────────────────────────────────────────────────────────────── */

/**
 * Remove global CSS/JS that a standalone landing page doesn't need.
 *
 * @return void
 */
function nexus_audit_linkedin_dequeue_globals() {
	if ( ! nexus_is_audit_linkedin_page() ) {
		return;
	}

	wp_dequeue_style( 'nexus-site-header-css' );
	wp_dequeue_style( 'nexus-related-content-css' );
	wp_dequeue_style( 'nexus-footer-cta-css' );
	wp_dequeue_script( 'nexus-site-header-js' );
}
add_action( 'wp_enqueue_scripts', 'nexus_audit_linkedin_dequeue_globals', 999 );
