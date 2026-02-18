<?php
/**
 * NEXUS SEO Meta & Indexierungssteuerung
 *
 * Wenn Rank Math aktiv ist: Nur OG-Bild-Override (ACF) + noindex-Toggle.
 * Rank Math übernimmt: Title, Description, OG Tags, Twitter Card, Canonical.
 *
 * Ohne Rank Math: vollständige Eigenimplementierung als Fallback.
 *
 * [SEO] inc/seo-meta: OG-Bild Override, Indexierungs-Logik
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_head', 'hu_seo_meta_tags', 1 );

add_filter( 'rank_math/frontend/title', 'hu_rank_math_cornerstone_title' );
add_filter( 'rank_math/frontend/description', 'hu_rank_math_cornerstone_description' );

/**
 * Check whether current query is the SEO cornerstone article.
 *
 * @return bool
 */
function hu_is_seo_cornerstone_article() {
	if ( ! is_singular() ) {
		return false;
	}

	$post_id = get_queried_object_id();
	if ( ! $post_id ) {
		return false;
	}

	$slug = get_post_field( 'post_name', $post_id );
	return 'technisches-seo-performance-fundament' === $slug;
}

/**
 * Override Rank Math title for cornerstone article.
 *
 * @param string $title Existing title.
 * @return string
 */
function hu_rank_math_cornerstone_title( $title ) {
	if ( hu_is_seo_cornerstone_article() ) {
		return 'Technisches SEO + Performance Marketing: Fundament fehlt';
	}

	return $title;
}

/**
 * Override Rank Math description for cornerstone article.
 *
 * @param string $description Existing description.
 * @return string
 */
function hu_rank_math_cornerstone_description( $description ) {
	if ( hu_is_seo_cornerstone_article() ) {
		return 'Performance Marketing ohne technisches SEO-Fundament verbrennt Budget. So wirken Technik, CRO und Tracking zusammen - inklusive Entscheider-Checkliste.';
	}

	return $description;
}

/**
 * Output SEO meta tags.
 *
 * Wenn Rank Math aktiv: Nur OG-Bild-Override (ACF) ausgeben — alles andere
 * übernimmt Rank Math. Ohne Rank Math: vollständiger Fallback.
 *
 * @return void
 */
function hu_seo_meta_tags() {

	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	$rank_math_active = defined( 'RANK_MATH_VERSION' );

	// ── Rank Math aktiv: nur ACF OG-Bild-Override ausgeben ────────
	if ( $rank_math_active ) {
		if ( is_singular() && function_exists( 'get_field' ) ) {
			$og_image = get_field( 'og_image', get_queried_object_id() );
			if ( $og_image ) {
				$url = is_array( $og_image ) ? ( $og_image['url'] ?? '' ) : $og_image;
				if ( $url ) {
					printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $url ) );
					echo '<meta property="og:image:width" content="1200">' . "\n";
					echo '<meta property="og:image:height" content="630">' . "\n";
					printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $url ) );
				}
			}
		}
		return; // Rank Math kümmert sich um den Rest
	}

	// ── Fallback: kein SEO-Plugin aktiv ───────────────────────────
	$meta = hu_get_seo_meta();

	if ( empty( $meta ) ) {
		return;
	}

	// Meta Description
	if ( ! empty( $meta['description'] ) ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	}

	// Canonical URL
	if ( ! empty( $meta['canonical'] ) ) {
		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( $meta['canonical'] ) );
	}

	// Robots
	if ( ! empty( $meta['robots'] ) ) {
		printf( '<meta name="robots" content="%s">' . "\n", esc_attr( $meta['robots'] ) );
	}

	// Open Graph
	if ( ! empty( $meta['og_title'] ) ) {
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $meta['og_title'] ) );
	}
	if ( ! empty( $meta['description'] ) ) {
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	}
	if ( ! empty( $meta['canonical'] ) ) {
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $meta['canonical'] ) );
	}
	if ( ! empty( $meta['og_image'] ) ) {
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $meta['og_image'] ) );
		echo '<meta property="og:image:width" content="1200">' . "\n";
		echo '<meta property="og:image:height" content="630">' . "\n";
	}
	printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( $meta['og_type'] ) );
	echo '<meta property="og:locale" content="de_DE">' . "\n";
	printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );

	// Twitter Card
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	if ( ! empty( $meta['og_title'] ) ) {
		printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $meta['og_title'] ) );
	}
	if ( ! empty( $meta['description'] ) ) {
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
	}
	if ( ! empty( $meta['og_image'] ) ) {
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $meta['og_image'] ) );
	}
}

/**
 * Build SEO meta data array for the current page.
 *
 * Priority: ACF fields → Post/Page data → Auto-generated fallbacks.
 *
 * @return array{description: string, canonical: string, robots: string, og_title: string, og_image: string, og_type: string}
 */
function hu_get_seo_meta() {

	$meta = [
		'description' => '',
		'canonical'   => '',
		'robots'      => 'index, follow',
		'og_title'    => '',
		'og_image'    => '',
		'og_type'     => 'website',
	];

	// ── Utility-Seiten → noindex ──────────────────────────────────
	$noindex_templates = [
		'template-portal.php',
	];

	$noindex_slugs = [
		'danke',
		'thank-you',
		'portal',
		'login',
		'kunden-login',
	];

	if ( is_singular() ) {
		$post_id  = get_queried_object_id();
		$template = get_page_template_slug( $post_id );
		$slug     = get_post_field( 'post_name', $post_id );

		// noindex check: Template/Slug-basiert oder ACF-Feld
		$acf_noindex = function_exists( 'get_field' ) ? get_field( 'seo_noindex', $post_id ) : false;
		if ( in_array( $template, $noindex_templates, true ) || in_array( $slug, $noindex_slugs, true ) || $acf_noindex ) {
			$meta['robots'] = 'noindex, nofollow';
		}

		// ACF fields first (if ACF Pro is active)
		if ( function_exists( 'get_field' ) ) {
			$meta['description'] = get_field( 'seo_description', $post_id ) ?: '';
			$meta['og_title']    = get_field( 'seo_title', $post_id ) ?: '';
			$og_image_arr        = get_field( 'og_image', $post_id );
			if ( is_array( $og_image_arr ) && ! empty( $og_image_arr['url'] ) ) {
				$meta['og_image'] = $og_image_arr['url'];
			} elseif ( is_string( $og_image_arr ) && $og_image_arr ) {
				$meta['og_image'] = $og_image_arr;
			}
		}

		// Fallbacks: auto-generate from post data
		if ( empty( $meta['og_title'] ) ) {
			$meta['og_title'] = get_the_title( $post_id ) . ' · ' . get_bloginfo( 'name' );
		}

		if ( 'technisches-seo-performance-fundament' === $slug ) {
			$meta['og_title'] = 'Technisches SEO + Performance Marketing: Fundament fehlt';
			$meta['description'] = 'Performance Marketing ohne technisches SEO-Fundament verbrennt Budget. So wirken Technik, CRO und Tracking zusammen - inklusive Entscheider-Checkliste.';
		}

		if ( empty( $meta['description'] ) ) {
			$excerpt = get_the_excerpt( $post_id );
			if ( $excerpt ) {
				$meta['description'] = wp_trim_words( wp_strip_all_tags( $excerpt ), 25, '…' );
			}
		}

		if ( empty( $meta['og_image'] ) ) {
			$thumb = get_the_post_thumbnail_url( $post_id, 'large' );
			if ( $thumb ) {
				$meta['og_image'] = $thumb;
			}
		}

		// Canonical
		$meta['canonical'] = get_permalink( $post_id );

		// OG type
		if ( is_singular( 'post' ) ) {
			$meta['og_type'] = 'article';
		}

	} elseif ( is_front_page() ) {

		$meta['og_title']    = get_bloginfo( 'name' ) . ' · ' . get_bloginfo( 'description' );
		$meta['description'] = get_bloginfo( 'description' );
		$meta['canonical']   = home_url( '/' );

	} elseif ( is_home() ) {

		$meta['og_title']    = __( 'Blog', 'blocksy-child' ) . ' · ' . get_bloginfo( 'name' );
		$meta['description'] = __( 'Strategische Impulse für WordPress, SEO, Tracking und Conversion-Optimierung.', 'blocksy-child' );
		$meta['canonical']   = get_permalink( get_option( 'page_for_posts' ) );

	} elseif ( is_category() || is_tag() || is_tax() ) {

		$term = get_queried_object();
		if ( $term ) {
			$meta['og_title'] = single_term_title( '', false ) . ' · ' . get_bloginfo( 'name' );
			if ( $term->description ) {
				$meta['description'] = wp_trim_words( wp_strip_all_tags( $term->description ), 25, '…' );
			}
			$meta['canonical'] = get_term_link( $term );
		}

	} elseif ( is_search() ) {

		$meta['robots']   = 'noindex, follow';
		$meta['og_title'] = sprintf(
			/* translators: %s: search query */
			__( 'Suche: %s', 'blocksy-child' ),
			get_search_query()
		) . ' · ' . get_bloginfo( 'name' );

	} elseif ( is_404() ) {

		$meta['robots']   = 'noindex, follow';
		$meta['og_title'] = __( 'Seite nicht gefunden (404)', 'blocksy-child' ) . ' · ' . get_bloginfo( 'name' );
	}

	return $meta;
}

/**
 * Remove Blocksy's default canonical if we manage it ourselves.
 */
add_action( 'template_redirect', function () {
	if ( ! defined( 'WPSEO_VERSION' ) && ! defined( 'RANK_MATH_VERSION' ) && ! defined( 'SEOPRESS_VERSION' ) ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
} );
