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
