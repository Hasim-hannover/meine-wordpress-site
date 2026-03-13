<?php
/**
 * NEXUS Helper Functions
 *
 * Wiederverwendbare Utility-Funktionen für das gesamte Theme.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Calculate estimated reading time for a post.
 *
 * @param  int|null $post_id  Post ID (defaults to current post).
 * @param  int      $wpm      Words per minute.
 * @return int      Reading time in minutes (minimum 1).
 */
function nexus_get_reading_time( $post_id = null, $wpm = 200 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content    = get_post_field( 'post_content', $post_id );
	$word_count = str_word_count( wp_strip_all_tags( $content ) );
	$minutes    = max( 1, (int) ceil( $word_count / $wpm ) );

	return $minutes;
}

/**
 * Get an ACF field with a safe fallback.
 *
 * Wraps get_field() so templates never break if ACF is inactive.
 *
 * @param  string     $field_name  ACF field name.
 * @param  mixed      $default     Default value if field is empty.
 * @param  int|false  $post_id     Post ID or false for current post.
 * @return mixed
 */
function nexus_get_field( $field_name, $default = '', $post_id = false ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}

	$value = get_field( $field_name, $post_id );
	return ( $value !== null && $value !== '' && $value !== false ) ? $value : $default;
}

/**
 * Render a tracking-ready CTA button.
 *
 * Outputs an <a> element with proper data-track-* attributes
 * for GTM Server-Side event capture.
 *
 * @param array $args {
 *     @type string $url       Link URL.
 *     @type string $text      Button text.
 *     @type string $action    Tracking action name (e.g. 'cta_audit_hero').
 *     @type string $category  Tracking category (default: 'lead_gen').
 *     @type string $class     CSS classes (default: 'btn btn-primary').
 *     @type bool   $new_tab   Open in new tab (default: false).
 * }
 * @return string HTML.
 */
function nexus_cta_button( $args = [] ) {
	$defaults = [
		'url'      => '#',
		'text'     => __( 'Jetzt starten', 'blocksy-child' ),
		'action'   => 'cta_generic',
		'category' => 'lead_gen',
		'class'    => 'btn btn-primary',
		'new_tab'  => false,
	];

	$args   = wp_parse_args( $args, $defaults );
	$target = $args['new_tab'] ? ' target="_blank" rel="noopener noreferrer"' : '';

	return sprintf(
		'<a href="%s" class="%s" data-track-action="%s" data-track-category="%s"%s>%s</a>',
		esc_url( $args['url'] ),
		esc_attr( $args['class'] ),
		esc_attr( $args['action'] ),
		esc_attr( $args['category'] ),
		$target,
		esc_html( $args['text'] )
	);
}

/**
 * Truncate a string to a maximum length at word boundaries.
 *
 * @param  string $text    Input text.
 * @param  int    $length  Maximum character length.
 * @param  string $suffix  Suffix to append when truncated.
 * @return string
 */
function nexus_truncate( $text, $length = 155, $suffix = '…' ) {
	$text = wp_strip_all_tags( $text );

	if ( mb_strlen( $text ) <= $length ) {
		return $text;
	}

	$truncated = mb_substr( $text, 0, $length );
	$last_space = mb_strrpos( $truncated, ' ' );

	if ( $last_space !== false ) {
		$truncated = mb_substr( $truncated, 0, $last_space );
	}

	return $truncated . $suffix;
}

/**
 * Get theme asset URL (shortcut for frequent use).
 *
 * @param  string $path Relative path within /assets/.
 * @return string Full URL.
 */
function nexus_asset_url( $path ) {
	return get_stylesheet_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Get theme asset absolute path.
 *
 * @param  string $path Relative path within /assets/.
 * @return string Absolute file path.
 */
function nexus_asset_path( $path ) {
	return get_stylesheet_directory() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Resolve a page ID from one or more possible slugs.
 *
 * @param string|array $paths Candidate page paths, ordered by preference.
 * @return int
 */
function nexus_get_page_id( $paths ) {
	$paths = (array) $paths;

	foreach ( $paths as $path ) {
		$page = get_page_by_path( trim( (string) $path, '/' ) );
		if ( $page instanceof WP_Post ) {
			return (int) $page->ID;
		}
	}

	return 0;
}

/**
 * Resolve a page ID by assigned page template.
 *
 * Cached per request so repeated CTA helpers stay cheap.
 *
 * @param string $template Page template filename.
 * @return int
 */
function nexus_get_page_id_by_template( $template ) {
	static $cache = [];

	$template = (string) $template;

	if ( isset( $cache[ $template ] ) ) {
		return $cache[ $template ];
	}

	$page_ids = get_posts(
		[
			'post_type'              => 'page',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'orderby'                => 'menu_order title',
			'order'                  => 'ASC',
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'meta_key'               => '_wp_page_template',
			'meta_value'             => $template,
		]
	);

	$cache[ $template ] = ! empty( $page_ids ) ? (int) $page_ids[0] : 0;

	return $cache[ $template ];
}

/**
 * Resolve a permalink from one or more possible slugs with a sane fallback.
 *
 * @param string|array $paths    Candidate page paths, ordered by preference.
 * @param string       $fallback Optional fallback URL.
 * @return string
 */
function nexus_get_page_url( $paths, $fallback = '' ) {
	$paths   = (array) $paths;
	$page_id = nexus_get_page_id( $paths );

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	if ( $fallback ) {
		return $fallback;
	}

	if ( ! empty( $paths ) ) {
		return home_url( '/' . trim( (string) $paths[0], '/' ) . '/' );
	}

	return home_url( '/' );
}

/**
 * Resolve the primary audit page ID while supporting legacy slugs.
 *
 * @return int
 */
function nexus_get_audit_page_id() {
	$template_page_id = nexus_get_page_id_by_template( 'page-audit.php' );

	if ( $template_page_id ) {
		return $template_page_id;
	}

	return nexus_get_page_id( [ 'growth-audit', 'audit', 'customer-journey-audit', '360-audit' ] );
}

/**
 * Resolve the primary audit page URL while supporting legacy slugs.
 *
 * Keep the legacy slug as fallback until a permalink migration is done in WordPress.
 *
 * @return string
 */
function nexus_get_audit_url() {
	$page_id = nexus_get_audit_page_id();

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	return home_url( '/growth-audit/' );
}

/**
 * Determine whether the current request is the audit landing page.
 *
 * @return bool
 */
function nexus_is_audit_page() {
	$audit_page_id = nexus_get_audit_page_id();

	if ( $audit_page_id && is_page( $audit_page_id ) ) {
		return true;
	}

	return is_page_template( 'page-audit.php' )
		|| is_page( 'growth-audit' )
		|| is_page( 'audit' )
		|| is_page( 'customer-journey-audit' );
}

/**
 * Resolve the primary results hub page ID.
 *
 * @return int
 */
function nexus_get_results_page_id() {
	$canonical_page_id = nexus_get_page_id( [ 'ergebnisse' ] );

	if ( $canonical_page_id ) {
		return $canonical_page_id;
	}

	$template_page_id = nexus_get_page_id_by_template( 'page-case-studies-e-commerce.php' );

	if ( $template_page_id ) {
		return $template_page_id;
	}

	return nexus_get_page_id( [ 'case-studies-e-commerce', 'case-studies' ] );
}

/**
 * Resolve the primary results hub URL.
 *
 * @return string
 */
function nexus_get_results_url() {
	$page_id = nexus_get_results_page_id();

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	return home_url( '/ergebnisse/' );
}

/**
 * Resolve the whitelabel proof page ID.
 *
 * @return int
 */
function nexus_get_whitelabel_page_id() {
	$template_page_id = nexus_get_page_id_by_template( 'page-whitelabel-retainer.php' );

	if ( $template_page_id ) {
		return $template_page_id;
	}

	return nexus_get_page_id( [ 'whitelabel-retainer', 'whitelabel-retainer-proof', 'whitelabel' ] );
}

/**
 * Resolve the whitelabel proof page URL.
 *
 * @return string
 */
function nexus_get_whitelabel_page_url() {
	$page_id = nexus_get_whitelabel_page_id();

	if ( $page_id ) {
		return get_permalink( $page_id );
	}

	return home_url( '/whitelabel-retainer/' );
}

/**
 * Determine whether the current request is inside the public results area.
 *
 * @return bool
 */
function nexus_is_results_context() {
	$results_page_id = nexus_get_results_page_id();

	if ( $results_page_id && is_page( $results_page_id ) ) {
		return true;
	}

	return is_page( 'case-studies-e-commerce' )
		|| is_page( 'case-studies' )
		|| is_page( 'ergebnisse' )
		|| is_page( 'e3-new-energy' )
		|| is_page( 'case-study-domdar' )
		|| is_page( 'domdar' )
		|| is_page( 'whitelabel-retainer' )
		|| is_page( 'whitelabel-retainer-proof' )
		|| is_page( 'whitelabel' )
		|| is_page_template( 'page-case-e3.php' )
		|| is_page_template( 'page-case-study-domdar.php' )
		|| is_page_template( 'page-case-studies-e-commerce.php' )
		|| is_page_template( 'page-whitelabel-retainer.php' );
}

/**
 * Return the current request path with leading and trailing slash.
 *
 * @return string
 */
function nexus_get_current_request_path() {
	$request_uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '/';
	$request_path = wp_parse_url( $request_uri, PHP_URL_PATH );

	return trailingslashit( '/' . ltrim( (string) $request_path, '/' ) );
}

/**
 * Map deprecated service and tool slugs to their canonical WGOS or hub targets.
 *
 * @return array<string, string>
 */
function nexus_get_legacy_offer_redirect_map() {
	return [
		'/ga4-tracking-setup/'         => nexus_get_wgos_asset_anchor_url( 'tracking-audit' ),
		'/performance-marketing/'      => nexus_get_wgos_url(),
		'/meta-ads/'                   => nexus_get_wgos_url(),
		'/roi-rechner/'                => nexus_get_page_url( [ 'kostenlose-tools', 'tools' ], home_url( '/kostenlose-tools/' ) ),
	];
}

add_action( 'template_redirect', 'nexus_redirect_legacy_offer_paths', 2 );
/**
 * Redirect deprecated service and tool slugs to their canonical WGOS destinations.
 *
 * @return void
 */
function nexus_redirect_legacy_offer_paths() {
	if ( is_admin() || wp_doing_ajax() || is_feed() ) {
		return;
	}

	$current_path = nexus_get_current_request_path();
	$redirect_map = nexus_get_legacy_offer_redirect_map();

	if ( empty( $redirect_map[ $current_path ] ) ) {
		return;
	}

	$target_url  = $redirect_map[ $current_path ];
	$target_path = trailingslashit( '/' . ltrim( (string) wp_parse_url( $target_url, PHP_URL_PATH ), '/' ) );

	if ( $target_path === $current_path ) {
		return;
	}

	wp_safe_redirect( $target_url, 301 );
	exit;
}

/**
 * Resolve the primary contact page ID while supporting the legacy slug.
 *
 * @return int
 */
function nexus_get_contact_page_id() {
	$template_page_id = nexus_get_page_id_by_template( 'page-kontakt.php' );

	if ( $template_page_id ) {
		return $template_page_id;
	}

	return nexus_get_page_id( [ 'kontakt', 'kontaktiere-mich' ] );
}

/**
 * Resolve the primary contact URL while enforcing the new /kontakt/ path.
 *
 * @return string
 */
function nexus_get_contact_url() {
	$page_id = nexus_get_contact_page_id();

	if ( $page_id ) {
		$permalink = get_permalink( $page_id );
		$path      = trailingslashit( '/' . ltrim( (string) wp_parse_url( $permalink, PHP_URL_PATH ), '/' ) );

		if ( '/kontaktiere-mich/' !== $path ) {
			return $permalink;
		}
	}

	return home_url( '/kontakt/' );
}

/**
 * Determine whether the current request is the public contact page.
 *
 * @return bool
 */
function nexus_is_contact_page() {
	$contact_page_id = nexus_get_contact_page_id();
	$contact_path    = trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/kontakt/' ), PHP_URL_PATH ), '/' ) );

	if ( $contact_page_id && is_page( $contact_page_id ) ) {
		return true;
	}

	return $contact_path === nexus_get_current_request_path()
		|| is_page_template( 'page-kontakt.php' )
		|| is_page( 'kontakt' )
		|| is_page( 'kontaktiere-mich' );
}

add_action( 'template_redirect', 'nexus_redirect_legacy_results_path', 1 );
/**
 * Redirect legacy proof overview paths to the canonical results hub.
 *
 * @return void
 */
function nexus_redirect_legacy_results_path() {
	if ( is_admin() || wp_doing_ajax() || is_feed() ) {
		return;
	}

	$current_path = nexus_get_current_request_path();
	$legacy_paths = [
		'/case-studies/',
		'/case-studies-e-commerce/',
	];

	if ( ! in_array( $current_path, $legacy_paths, true ) ) {
		return;
	}

	$target_url = nexus_get_results_url();
	$target_path = trailingslashit( '/' . ltrim( (string) wp_parse_url( $target_url, PHP_URL_PATH ), '/' ) );

	if ( $target_path === $current_path ) {
		return;
	}

	wp_safe_redirect( $target_url, 301 );
	exit;
}

add_filter( 'template_include', 'nexus_force_results_route_templates', 98 );
/**
 * Force route-specific proof templates even if WordPress pages use another template in admin.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_force_results_route_templates( $template ) {
	if ( is_admin() || ! is_page() ) {
		return $template;
	}

	$route_templates = [
		'case-studies-e-commerce'   => get_stylesheet_directory() . '/page-case-studies-e-commerce.php',
		'ergebnisse'                => get_stylesheet_directory() . '/page-case-studies-e-commerce.php',
		'whitelabel-retainer'       => get_stylesheet_directory() . '/page-whitelabel-retainer.php',
		'whitelabel-retainer-proof' => get_stylesheet_directory() . '/page-whitelabel-retainer.php',
		'whitelabel'                => get_stylesheet_directory() . '/page-whitelabel-retainer.php',
	];

	foreach ( $route_templates as $slug => $forced_template ) {
		if ( ! is_page( $slug ) ) {
			continue;
		}

		if ( file_exists( $forced_template ) ) {
			return $forced_template;
		}
	}

	return $template;
}
