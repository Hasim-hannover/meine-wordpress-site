<?php
/**
 * Template Part: Comparison Table (Vorher/Nachher)
 *
 * Responsive Vorher/Nachher-Grid für Proof-Assets.
 * Daten via set_query_var() oder ACF-Repeater.
 *
 * Usage mit Variablen:
 *   set_query_var( 'comparison_title', 'Ergebnisse nach 90 Tagen' );
 *   set_query_var( 'comparison_items', [
 *       [ 'metric' => 'LCP',     'before' => '4.2s',  'after' => '0.8s'  ],
 *       [ 'metric' => 'Leads/Mo', 'before' => '12',    'after' => '47'    ],
 *   ] );
 *   get_template_part( 'template-parts/comparison-table' );
 *
 * [CRO] template-parts/comparison-table: Responsive Vorher/Nachher Grid
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title = get_query_var( 'comparison_title', '' );
$items = get_query_var( 'comparison_items', [] );

// Fallback: ACF Repeater
if ( empty( $items ) && function_exists( 'get_field' ) ) {
	$title = get_field( 'comparison_title' ) ?: $title;
	$acf_items = get_field( 'comparison_items' );
	if ( is_array( $acf_items ) ) {
		$items = $acf_items;
	}
}

if ( empty( $items ) ) {
	return;
}
?>

<div class="comparison-table" data-track-section="comparison_table">
	<?php if ( $title ) : ?>
		<h3 class="comparison-table__title"><?php echo esc_html( $title ); ?></h3>
	<?php endif; ?>

	<div class="comparison-table__grid" role="table" aria-label="<?php esc_attr_e( 'Vorher/Nachher Vergleich', 'blocksy-child' ); ?>">
		<div class="comparison-table__header" role="row">
			<div class="comparison-table__cell" role="columnheader"><?php esc_html_e( 'Metrik', 'blocksy-child' ); ?></div>
			<div class="comparison-table__cell comparison-table__cell--before" role="columnheader"><?php esc_html_e( 'Vorher', 'blocksy-child' ); ?></div>
			<div class="comparison-table__cell comparison-table__cell--after" role="columnheader"><?php esc_html_e( 'Nachher', 'blocksy-child' ); ?></div>
		</div>

		<?php foreach ( $items as $item ) :
			$metric = isset( $item['metric'] ) ? $item['metric'] : '';
			$before = isset( $item['before'] ) ? $item['before'] : '';
			$after  = isset( $item['after'] ) ? $item['after'] : '';
		?>
			<div class="comparison-table__row" role="row">
				<div class="comparison-table__cell comparison-table__cell--metric" role="cell">
					<?php echo esc_html( $metric ); ?>
				</div>
				<div class="comparison-table__cell comparison-table__cell--before" role="cell">
					<?php echo esc_html( $before ); ?>
				</div>
				<div class="comparison-table__cell comparison-table__cell--after" role="cell">
					<?php echo esc_html( $after ); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
