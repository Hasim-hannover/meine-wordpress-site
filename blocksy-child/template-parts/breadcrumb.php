<?php
/**
 * Template Part: Breadcrumb Navigation
 *
 * Sichtbar auf allen Unterseiten (nicht Homepage).
 * Generiert BreadcrumbList Schema.org Markup automatisch.
 *
 * Usage: get_template_part( 'template-parts/breadcrumb' );
 *
 * [SEO] template-parts/breadcrumb: BreadcrumbList Schema + sichtbare Navigation
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Keine Breadcrumbs auf der Startseite
if ( is_front_page() ) {
	return;
}

$breadcrumbs = [];
$position    = 1;

// Startseite immer als erster Eintrag
$breadcrumbs[] = [
	'name' => __( 'Start', 'blocksy-child' ),
	'url'  => home_url( '/' ),
];

if ( is_singular( 'post' ) ) {

	// Blog-Übersicht
	$blog_page_id = get_option( 'page_for_posts' );
	if ( $blog_page_id ) {
		$breadcrumbs[] = [
			'name' => get_the_title( $blog_page_id ),
			'url'  => get_permalink( $blog_page_id ),
		];
	} else {
		$breadcrumbs[] = [
			'name' => __( 'Blog', 'blocksy-child' ),
			'url'  => home_url( '/blog/' ),
		];
	}

	// Kategorie
	$categories = get_the_category();
	if ( $categories ) {
		$primary = $categories[0];
		$breadcrumbs[] = [
			'name' => $primary->name,
			'url'  => get_category_link( $primary->term_id ),
		];
	}

	// Aktueller Beitrag (kein Link)
	$breadcrumbs[] = [
		'name' => get_the_title(),
		'url'  => '',
	];

} elseif ( is_page() && ! is_front_page() ) {

	// Parent Pages
	$post_id = get_queried_object_id();
	$ancestors = array_reverse( get_post_ancestors( $post_id ) );
	foreach ( $ancestors as $ancestor_id ) {
		$breadcrumbs[] = [
			'name' => get_the_title( $ancestor_id ),
			'url'  => get_permalink( $ancestor_id ),
		];
	}

	// Aktuelle Seite (kein Link)
	$breadcrumbs[] = [
		'name' => get_the_title(),
		'url'  => '',
	];

} elseif ( is_category() ) {

	$breadcrumbs[] = [
		'name' => single_cat_title( '', false ),
		'url'  => '',
	];

} elseif ( is_tag() ) {

	$breadcrumbs[] = [
		'name' => single_tag_title( '', false ),
		'url'  => '',
	];

} elseif ( is_search() ) {

	$breadcrumbs[] = [
		'name' => sprintf( __( 'Suche: %s', 'blocksy-child' ), get_search_query() ),
		'url'  => '',
	];

} elseif ( is_archive() ) {

	$breadcrumbs[] = [
		'name' => get_the_archive_title(),
		'url'  => '',
	];

} elseif ( is_404() ) {

	$breadcrumbs[] = [
		'name' => __( 'Seite nicht gefunden', 'blocksy-child' ),
		'url'  => '',
	];
}

// ── Sichtbare Breadcrumbs ─────────────────────────────────────────
?>
<nav class="nexus-breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'blocksy-child' ); ?>">
	<ol class="nexus-breadcrumb__list" itemscope itemtype="https://schema.org/BreadcrumbList">
		<?php foreach ( $breadcrumbs as $index => $crumb ) :
			$pos       = $index + 1;
			$is_last   = ( $index === count( $breadcrumbs ) - 1 );
		?>
			<li class="nexus-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
				<?php if ( ! $is_last && ! empty( $crumb['url'] ) ) : ?>
					<a href="<?php echo esc_url( $crumb['url'] ); ?>" itemprop="item">
						<span itemprop="name"><?php echo esc_html( $crumb['name'] ); ?></span>
					</a>
				<?php else : ?>
					<span itemprop="name" aria-current="page"><?php echo esc_html( $crumb['name'] ); ?></span>
				<?php endif; ?>
				<meta itemprop="position" content="<?php echo esc_attr( $pos ); ?>">
			</li>
			<?php if ( ! $is_last ) : ?>
				<li class="nexus-breadcrumb__separator" aria-hidden="true">›</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ol>
</nav>
