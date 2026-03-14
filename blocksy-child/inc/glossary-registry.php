<?php
/**
 * Glossary registry, sync and rendering helpers.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the current glossary sync version.
 *
 * @return string
 */
function nexus_get_glossary_registry_version() {
	return '2026-03-14-glossary-v2';
}

/**
 * Load the glossary registry from the versioned data file.
 *
 * @return array<string, array<string, mixed>>
 */
function nexus_get_glossary_registry() {
	static $registry = null;

	if ( null !== $registry ) {
		return $registry;
	}

	$definitions = require __DIR__ . '/glossary-registry-data.php';
	$areas       = nexus_get_glossary_area_catalog();
	$registry    = [];

	foreach ( (array) $definitions as $slug => $definition ) {
		if ( ! is_array( $definition ) ) {
			continue;
		}

		$term_slug    = sanitize_title( $definition['slug'] ?? $slug );
		$core_area    = isset( $definition['core_area'] ) ? (string) $definition['core_area'] : 'Strategie';
		$index_policy = isset( $definition['index_policy'] ) ? sanitize_key( (string) $definition['index_policy'] ) : 'index';

		if ( ! isset( $areas[ $core_area ] ) ) {
			$core_area = 'Strategie';
		}

		if ( ! in_array( $index_policy, [ 'index', 'noindex', 'alias' ], true ) ) {
			$index_policy = 'index';
		}

		$definition['slug']               = $term_slug;
		$definition['title']              = isset( $definition['title'] ) ? (string) $definition['title'] : ucfirst( str_replace( '-', ' ', $term_slug ) );
		$definition['status']             = 'publish' === ( $definition['status'] ?? '' ) ? 'publish' : 'draft';
		$definition['core_area']          = $core_area;
		$definition['index_policy']       = $index_policy;
		$definition['excerpt']            = isset( $definition['excerpt'] ) ? (string) $definition['excerpt'] : '';
		$definition['short_definition']   = isset( $definition['short_definition'] ) ? (string) $definition['short_definition'] : $definition['excerpt'];
		$definition['why_it_matters']     = isset( $definition['why_it_matters'] ) ? (string) $definition['why_it_matters'] : '';
		$definition['measurement']        = isset( $definition['measurement'] ) ? (string) $definition['measurement'] : '';
		$definition['primary_url_key']    = isset( $definition['primary_url_key'] ) ? sanitize_key( (string) $definition['primary_url_key'] ) : '';
		$definition['primary_url_label']  = isset( $definition['primary_url_label'] ) ? (string) $definition['primary_url_label'] : '';
		$definition['primary_url_reason'] = isset( $definition['primary_url_reason'] ) ? (string) $definition['primary_url_reason'] : '';
		$definition['seo_title']          = hu_normalize_brand_text( isset( $definition['seo_title'] ) ? (string) $definition['seo_title'] : $definition['title'] . ' | Haşim Üner' );
		$definition['seo_description']    = isset( $definition['seo_description'] ) ? (string) $definition['seo_description'] : $definition['excerpt'];
		$definition['legacy_slugs']       = array_values(
			array_filter(
				array_map(
					'sanitize_title',
					(array) ( $definition['legacy_slugs'] ?? [] )
				)
			)
		);
		$definition['mistakes']           = array_values(
			array_filter(
				array_map(
					'strval',
					(array) ( $definition['mistakes'] ?? [] )
				)
			)
		);
		$definition['wgos_context']       = array_values(
			array_filter(
				array_map(
					'strval',
					(array) ( $definition['wgos_context'] ?? [] )
				)
			)
		);
		$definition['related_terms']      = array_values(
			array_filter(
				array_map(
					'sanitize_title',
					(array) ( $definition['related_terms'] ?? [] )
				)
			)
		);
		$definition['benchmarks']         = array_values(
			array_filter(
				(array) ( $definition['benchmarks'] ?? [] ),
				static function ( $item ) {
					return is_array( $item ) && ! empty( $item['label'] ) && ! empty( $item['value'] );
				}
			)
		);

		$definition['related_primary_urls'] = array_values(
			array_filter(
				array_map(
					static function ( $item ) {
						if ( ! is_array( $item ) || empty( $item['key'] ) ) {
							return null;
						}

						return [
							'key'      => sanitize_key( (string) $item['key'] ),
							'label'    => isset( $item['label'] ) ? (string) $item['label'] : '',
							'reason'   => isset( $item['reason'] ) ? (string) $item['reason'] : '',
							'fallback' => isset( $item['fallback'] ) ? (string) $item['fallback'] : '',
						];
					},
					(array) ( $definition['related_primary_urls'] ?? [] )
				)
			)
		);

		$definition['related_assets'] = array_values(
			array_filter(
				array_map(
					static function ( $key, $reason ) {
						if ( ! is_string( $key ) || '' === trim( $key ) ) {
							return null;
						}

						return [
							'slug'   => sanitize_title( $key ),
							'reason' => is_string( $reason ) ? trim( $reason ) : '',
						];
					},
					array_keys( (array) ( $definition['related_assets'] ?? [] ) ),
					array_values( (array) ( $definition['related_assets'] ?? [] ) )
				)
			)
		);

		$registry[ $term_slug ] = $definition;
	}

	return $registry;
}

/**
 * Build a lookup table for glossary registry slugs, legacy slugs and titles.
 *
 * @return array<string, array<string, mixed>>
 */
function nexus_get_glossary_registry_lookup() {
	static $lookup = null;

	if ( null !== $lookup ) {
		return $lookup;
	}

	$lookup = [];

	foreach ( nexus_get_glossary_registry() as $term ) {
		$candidates = array_merge(
			[
				$term['slug'],
				$term['title'],
			],
			(array) $term['legacy_slugs']
		);

		foreach ( $candidates as $candidate ) {
			$key = nexus_get_glossary_lookup_key( $candidate );

			if ( '' !== $key ) {
				$lookup[ $key ] = $term;
			}
		}
	}

	return $lookup;
}

/**
 * Resolve a glossary term definition from slug, title or post object.
 *
 * @param string|WP_Post $value Term identifier.
 * @return array<string, mixed>|null
 */
function nexus_get_glossary_definition( $value ) {
	if ( $value instanceof WP_Post ) {
		$value = $value->post_name ? $value->post_name : $value->post_title;
	}

	$key = nexus_get_glossary_lookup_key( $value );

	if ( '' === $key ) {
		return null;
	}

	$lookup = nexus_get_glossary_registry_lookup();

	return $lookup[ $key ] ?? null;
}

/**
 * Build a lookup table for glossary posts across all non-trash states.
 *
 * @return array<string, WP_Post>
 */
function nexus_get_glossary_post_lookup() {
	if ( isset( $GLOBALS['nexus_glossary_post_lookup'] ) && is_array( $GLOBALS['nexus_glossary_post_lookup'] ) ) {
		return $GLOBALS['nexus_glossary_post_lookup'];
	}

	$lookup = [];
	$posts  = get_posts(
		[
			'post_type'              => 'glossary_term',
			'post_status'            => [ 'publish', 'draft', 'pending', 'future', 'private' ],
			'posts_per_page'         => -1,
			'orderby'                => 'menu_order title',
			'order'                  => 'ASC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		]
	);

	foreach ( $posts as $post ) {
		$slug_key = nexus_get_glossary_lookup_key( $post->post_name );

		if ( '' !== $slug_key ) {
			$lookup[ $slug_key ] = $post;
		}
	}

	$GLOBALS['nexus_glossary_post_lookup'] = $lookup;

	return $lookup;
}

/**
 * Resolve the stored post that belongs to a registry term.
 *
 * @param array<string, mixed>|string|WP_Post $term Term definition or identifier.
 * @return WP_Post|null
 */
function nexus_get_glossary_registry_post( $term ) {
	$definition = is_array( $term ) ? $term : nexus_get_glossary_definition( $term );

	if ( empty( $definition['slug'] ) ) {
		return null;
	}

	$lookup     = nexus_get_glossary_post_lookup();
	$candidates = array_merge(
		[ $definition['slug'] ],
		(array) ( $definition['legacy_slugs'] ?? [] )
	);

	foreach ( $candidates as $candidate ) {
		$key = nexus_get_glossary_lookup_key( $candidate );

		if ( '' !== $key && isset( $lookup[ $key ] ) ) {
			return $lookup[ $key ];
		}
	}

	return null;
}

/**
 * Resolve the primary URL for one glossary term.
 *
 * @param array<string, mixed>|string|WP_Post $term Term definition or identifier.
 * @return string
 */
function nexus_get_glossary_primary_url( $term ) {
	$definition = is_array( $term ) ? $term : nexus_get_glossary_definition( $term );

	if ( ! is_array( $definition ) || empty( $definition['primary_url_key'] ) ) {
		return '';
	}

	return nexus_get_primary_public_url( (string) $definition['primary_url_key'] );
}

/**
 * Resolve the published detail URL for one glossary term.
 *
 * @param array<string, mixed>|string|WP_Post $term Term definition or identifier.
 * @return string
 */
function nexus_get_glossary_term_detail_url( $term ) {
	$definition = is_array( $term ) ? $term : nexus_get_glossary_definition( $term );

	if ( ! is_array( $definition ) ) {
		return '';
	}

	if ( 'alias' === (string) $definition['index_policy'] ) {
		return nexus_get_glossary_primary_url( $definition );
	}

	$post = nexus_get_glossary_registry_post( $definition );

	if ( $post instanceof WP_Post && 'publish' === $post->post_status ) {
		return get_permalink( $post );
	}

	return '';
}

/**
 * Resolve related primary URL cards for one glossary term.
 *
 * @param array<string, mixed> $term Term definition.
 * @return array<int, array<string, string>>
 */
function nexus_get_glossary_related_primary_items( $term ) {
	$items = [];

	foreach ( (array) $term['related_primary_urls'] as $item ) {
		$key = isset( $item['key'] ) ? sanitize_key( (string) $item['key'] ) : '';

		if ( '' === $key ) {
			continue;
		}

		$url = nexus_get_primary_public_url( $key, (string) ( $item['fallback'] ?? '' ) );

		if ( '' === $url ) {
			continue;
		}

		$items[] = [
			'label'  => '' !== (string) $item['label'] ? (string) $item['label'] : ucwords( str_replace( '_', ' ', $key ) ),
			'url'    => $url,
			'reason' => isset( $item['reason'] ) ? (string) $item['reason'] : '',
		];
	}

	return $items;
}

/**
 * Resolve related WGOS asset cards for one glossary term.
 *
 * @param array<string, mixed> $term Term definition.
 * @return array<int, array<string, string>>
 */
function nexus_get_glossary_related_asset_items( $term ) {
	$items = [];

	foreach ( (array) $term['related_assets'] as $asset ) {
		if ( ! is_array( $asset ) || empty( $asset['slug'] ) ) {
			continue;
		}

		$definition = function_exists( 'nexus_get_wgos_asset_definition' ) ? nexus_get_wgos_asset_definition( (string) $asset['slug'] ) : null;
		$url        = function_exists( 'nexus_get_wgos_asset_detail_url' ) ? nexus_get_wgos_asset_detail_url( (string) $asset['slug'] ) : '';

		if ( '' === $url && function_exists( 'nexus_get_wgos_asset_anchor_url' ) ) {
			$url = nexus_get_wgos_asset_anchor_url( (string) $asset['slug'] );
		}

		if ( '' === $url ) {
			continue;
		}

		$items[] = [
			'label'  => is_array( $definition ) && ! empty( $definition['title'] ) ? (string) $definition['title'] : ucwords( str_replace( '-', ' ', (string) $asset['slug'] ) ),
			'url'    => $url,
			'reason' => isset( $asset['reason'] ) ? (string) $asset['reason'] : '',
		];
	}

	return $items;
}

/**
 * Resolve related glossary term cards for one glossary term.
 *
 * @param array<string, mixed> $term Term definition.
 * @return array<int, array<string, string>>
 */
function nexus_get_glossary_related_term_items( $term ) {
	$items = [];

	foreach ( (array) $term['related_terms'] as $slug ) {
		$definition = nexus_get_glossary_definition( $slug );

		if ( ! is_array( $definition ) || 'publish' !== (string) ( $definition['status'] ?? '' ) ) {
			continue;
		}

		$destination = nexus_get_glossary_term_destination( $definition );

		$items[] = [
			'label'  => (string) $definition['title'],
			'url'    => (string) $destination['url'],
			'reason' => (string) $definition['excerpt'],
		];
	}

	return $items;
}

/**
 * Build the rendered HTML for one glossary term.
 *
 * @param array<string, mixed> $term Term definition.
 * @return string
 */
function nexus_get_glossary_term_content_html( $term ) {
	$hub_url          = nexus_get_glossary_hub_url();
	$audit_url        = nexus_get_primary_public_url( 'audit', home_url( '/growth-audit/' ) );
	$primary_url      = nexus_get_glossary_primary_url( $term );
	$primary_items    = nexus_get_glossary_related_primary_items( $term );
	$asset_items      = nexus_get_glossary_related_asset_items( $term );
	$related_terms    = nexus_get_glossary_related_term_items( $term );
	$area_catalog     = nexus_get_glossary_area_catalog();
	$policy_catalog   = nexus_get_glossary_policy_catalog();
	$core_area        = isset( $term['core_area'] ) ? (string) $term['core_area'] : 'Strategie';
	$policy           = isset( $term['index_policy'] ) ? (string) $term['index_policy'] : 'index';
	$area             = $area_catalog[ $core_area ] ?? reset( $area_catalog );
	$policy_data      = $policy_catalog[ $policy ] ?? $policy_catalog['index'];

	ob_start();
	?>
	<section class="wgos-section wgos-section--white glossary-detail-intro">
		<div class="wgos-container">
			<div class="glossary-detail-grid">
				<article class="glossary-card">
					<span class="glossary-card__kicker">Kurzdefinition</span>
					<p class="glossary-card__lead"><?php echo esc_html( (string) $term['short_definition'] ); ?></p>
					<?php if ( '' !== trim( (string) $term['why_it_matters'] ) ) : ?>
						<p><?php echo esc_html( (string) $term['why_it_matters'] ); ?></p>
					<?php endif; ?>
				</article>

				<aside class="glossary-card glossary-card--accent" style="--glossary-accent: <?php echo esc_attr( (string) $area['accent'] ); ?>;">
					<span class="glossary-card__kicker">Einordnung</span>
					<dl class="glossary-facts">
						<div>
							<dt>Kernbereich</dt>
							<dd><?php echo esc_html( $core_area ); ?></dd>
						</div>
						<div>
							<dt>Index-Policy</dt>
							<dd><?php echo esc_html( (string) $policy_data['label'] ); ?></dd>
						</div>
						<?php if ( '' !== $primary_url ) : ?>
							<div>
								<dt>Primary URL</dt>
								<dd><a href="<?php echo esc_url( $primary_url ); ?>"><?php echo esc_html( (string) $term['primary_url_label'] ); ?></a></dd>
							</div>
						<?php endif; ?>
					</dl>
					<?php if ( '' !== trim( (string) $term['primary_url_reason'] ) ) : ?>
						<p class="glossary-card__micro"><?php echo esc_html( (string) $term['primary_url_reason'] ); ?></p>
					<?php endif; ?>
				</aside>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $term['benchmarks'] ) || '' !== trim( (string) $term['measurement'] ) ) : ?>
		<section class="wgos-section wgos-section--gray">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Messung und Bewertung</span>
					<h2 class="wgos-h2">Woran Sie den Begriff praktisch erkennen.</h2>
					<?php if ( '' !== trim( (string) $term['measurement'] ) ) : ?>
						<p class="wgos-section-intro"><?php echo esc_html( (string) $term['measurement'] ); ?></p>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $term['benchmarks'] ) ) : ?>
					<div class="glossary-benchmark-grid">
						<?php foreach ( (array) $term['benchmarks'] as $benchmark ) : ?>
							<article class="glossary-benchmark-card">
								<span class="glossary-benchmark-card__label"><?php echo esc_html( (string) $benchmark['label'] ); ?></span>
								<strong><?php echo esc_html( (string) $benchmark['value'] ); ?></strong>
								<?php if ( ! empty( $benchmark['note'] ) ) : ?>
									<p><?php echo esc_html( (string) $benchmark['note'] ); ?></p>
								<?php endif; ?>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $term['mistakes'] ) ) : ?>
		<section class="wgos-section wgos-section--white">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Typische Fehler</span>
					<h2 class="wgos-h2">Wo Begriffsverstaendnis und Umsetzung oft auseinanderlaufen.</h2>
				</div>
				<ul class="glossary-checklist">
					<?php foreach ( (array) $term['mistakes'] as $mistake ) : ?>
						<li><?php echo esc_html( (string) $mistake ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<section class="wgos-section wgos-section--gray">
		<div class="wgos-container">
			<div class="wgos-section-head">
				<span class="wgos-principle-kicker">Im WGOS-Kontext</span>
				<h2 class="wgos-h2">Der Begriff ist nur dann sinnvoll, wenn er auf die richtige Primary URL zurueckfuehrt.</h2>
			</div>

			<div class="glossary-context-grid">
				<div class="glossary-card">
					<?php foreach ( (array) $term['wgos_context'] as $paragraph ) : ?>
						<p><?php echo esc_html( (string) $paragraph ); ?></p>
					<?php endforeach; ?>
				</div>

				<div class="glossary-card">
					<span class="glossary-card__kicker">Naechste sinnvolle Seiten</span>
					<div class="glossary-link-stack">
						<?php foreach ( $primary_items as $item ) : ?>
							<a class="glossary-link-card" href="<?php echo esc_url( $item['url'] ); ?>">
								<strong><?php echo esc_html( $item['label'] ); ?></strong>
								<?php if ( '' !== trim( $item['reason'] ) ) : ?>
									<span><?php echo esc_html( $item['reason'] ); ?></span>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>

						<?php foreach ( $asset_items as $item ) : ?>
							<a class="glossary-link-card glossary-link-card--asset" href="<?php echo esc_url( $item['url'] ); ?>">
								<strong><?php echo esc_html( $item['label'] ); ?></strong>
								<?php if ( '' !== trim( $item['reason'] ) ) : ?>
									<span><?php echo esc_html( $item['reason'] ); ?></span>
								<?php endif; ?>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $related_terms ) ) : ?>
		<section class="wgos-section wgos-section--white">
			<div class="wgos-container">
				<div class="wgos-section-head">
					<span class="wgos-principle-kicker">Verwandte Begriffe</span>
					<h2 class="wgos-h2">Weitere Eintraege, die direkt anschliessen.</h2>
				</div>
				<div class="glossary-related-grid">
					<?php foreach ( $related_terms as $item ) : ?>
						<a class="glossary-related-card" href="<?php echo esc_url( $item['url'] ); ?>">
							<strong><?php echo esc_html( $item['label'] ); ?></strong>
							<span><?php echo esc_html( $item['reason'] ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="wgos-section wgos-section--white wgos-final-cta">
		<div class="wgos-container">
			<div class="wgos-final-cta__inner">
				<span class="wgos-principle-kicker">Naechster Schritt</span>
				<h2 class="wgos-h2">Begriff verstanden. Jetzt die richtige Prioritaet fuer Ihre Website setzen.</h2>
				<p class="wgos-prose">Wenn klar ist, was der Begriff bedeutet, bleibt die eigentliche Frage offen: Ist das Thema fuer Ihre Website gerade wirklich der Engpass oder nur ein Symptom? Der Growth Audit bringt die Reihenfolge zurueck.</p>
				<div class="wgos-hero__actions">
					<a href="<?php echo esc_url( $hub_url ); ?>" class="wgos-btn wgos-btn--outline">Zurueck zum Glossar</a>
					<a href="<?php echo esc_url( $audit_url ); ?>" class="wgos-btn wgos-btn--primary" data-track-action="cta_glossary_term_audit" data-track-category="lead_gen">Growth Audit starten</a>
				</div>
			</div>
		</div>
	</section>
	<?php

	return trim( (string) ob_get_clean() );
}

/**
 * Check whether a registry term should get its own synced post.
 *
 * @param array<string, mixed> $term Term definition.
 * @return bool
 */
function nexus_glossary_term_requires_post( $term ) {
	return 'alias' !== (string) ( $term['index_policy'] ?? 'index' );
}

/**
 * Sync glossary registry definitions into glossary_term posts.
 *
 * @return array<string, mixed>
 */
function nexus_sync_glossary_term_posts() {
	$results      = [
		'created' => 0,
		'updated' => 0,
		'skipped' => 0,
		'errors'  => [],
	];
	$menu_order   = 0;
	$active_slugs = [];

	foreach ( nexus_get_glossary_registry() as $term ) {
		if ( ! nexus_glossary_term_requires_post( $term ) ) {
			continue;
		}

		++$menu_order;
		$active_slugs[] = (string) $term['slug'];
		$existing       = nexus_get_glossary_registry_post( $term );
		$postarr        = [
			'post_type'    => 'glossary_term',
			'post_status'  => (string) $term['status'],
			'post_title'   => (string) $term['title'],
			'post_name'    => (string) $term['slug'],
			'post_excerpt' => (string) $term['excerpt'],
			'post_content' => nexus_get_glossary_term_content_html( $term ),
			'menu_order'   => $menu_order,
		];

		if ( $existing instanceof WP_Post ) {
			$postarr['ID'] = (int) $existing->ID;
			$post_id       = wp_update_post( wp_slash( $postarr ), true );
			$action        = 'updated';
		} else {
			$post_id = wp_insert_post( wp_slash( $postarr ), true );
			$action  = 'created';
		}

		if ( is_wp_error( $post_id ) ) {
			$results['errors'][] = $post_id->get_error_message();
			continue;
		}

		$post_id = (int) $post_id;

		update_post_meta( $post_id, 'seo_title', (string) $term['seo_title'] );
		update_post_meta( $post_id, 'seo_description', (string) $term['seo_description'] );
		update_post_meta( $post_id, '_nexus_glossary_managed', '1' );
		update_post_meta( $post_id, '_nexus_glossary_registry_version', nexus_get_glossary_registry_version() );
		update_post_meta( $post_id, '_nexus_glossary_index_policy', (string) $term['index_policy'] );
		update_post_meta( $post_id, '_nexus_glossary_core_area', (string) $term['core_area'] );

		if ( 'noindex' === (string) $term['index_policy'] ) {
			update_post_meta( $post_id, 'rank_math_robots', [ 'noindex' ] );
		} else {
			delete_post_meta( $post_id, 'rank_math_robots' );
		}

		++$results[ $action ];
	}

	$managed_posts = get_posts(
		[
			'post_type'              => 'glossary_term',
			'post_status'            => [ 'publish', 'draft', 'pending', 'future', 'private' ],
			'posts_per_page'         => -1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'meta_key'               => '_nexus_glossary_managed',
			'meta_value'             => '1',
		]
	);

	foreach ( $managed_posts as $managed_post_id ) {
		$managed_post_id = (int) $managed_post_id;
		$managed_slug    = (string) get_post_field( 'post_name', $managed_post_id );

		if ( in_array( $managed_slug, $active_slugs, true ) ) {
			continue;
		}

		wp_update_post(
			[
				'ID'          => $managed_post_id,
				'post_status' => 'draft',
			]
		);
	}

	unset( $GLOBALS['nexus_glossary_post_lookup'], $GLOBALS['nexus_glossary_term_lookup_map'] );

	return $results;
}

/**
 * Sync glossary posts once per registry version.
 *
 * @return void
 */
function nexus_maybe_sync_glossary_term_posts() {
	if ( ! apply_filters( 'nexus_glossary_sync_enabled', true ) ) {
		return;
	}

	if ( wp_installing() || wp_doing_ajax() || wp_doing_cron() ) {
		return;
	}

	$version = nexus_get_glossary_registry_version();

	if ( $version === get_option( 'nexus_glossary_sync_version', '' ) ) {
		return;
	}

	if ( get_transient( 'nexus_glossary_sync_lock' ) ) {
		return;
	}

	set_transient( 'nexus_glossary_sync_lock', '1', 5 * MINUTE_IN_SECONDS );

	$results = nexus_sync_glossary_term_posts();

	delete_transient( 'nexus_glossary_sync_lock' );

	if ( empty( $results['errors'] ) ) {
		update_option( 'nexus_glossary_sync_version', $version, false );
		delete_option( 'nexus_glossary_sync_errors' );
		return;
	}

	update_option( 'nexus_glossary_sync_errors', wp_json_encode( $results['errors'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ), false );
}
add_action( 'init', 'nexus_maybe_sync_glossary_term_posts', 31 );
