<?php
/**
 * Canonical Founding Cohort 2026 data.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HU_FOUNDING_COHORT_SLOTS_TOTAL', 3 );
define( 'HU_FOUNDING_COHORT_END_DATE', '2026-09-30' );
define( 'HU_FOUNDING_COHORT_LABEL', 'Founding Cohort 2026' );
define( 'HU_FOUNDING_SLOTS_REMAINING', 3 );

/**
 * Return the canonical Founding Cohort model.
 *
 * @return array<string, int|string>
 */
function hu_founding_canon() {
	$slots_remaining = (int) get_option( 'hu_founding_slots_remaining', HU_FOUNDING_SLOTS_REMAINING );

	if ( $slots_remaining < 0 ) {
		$slots_remaining = 0;
	}

	if ( $slots_remaining > HU_FOUNDING_COHORT_SLOTS_TOTAL ) {
		$slots_remaining = HU_FOUNDING_COHORT_SLOTS_TOTAL;
	}

	return [
		'label'           => HU_FOUNDING_COHORT_LABEL,
		'slots_total'     => HU_FOUNDING_COHORT_SLOTS_TOTAL,
		'slots_remaining' => $slots_remaining,
		'end_date'        => HU_FOUNDING_COHORT_END_DATE,
		'public_frame'    => '3 Plätze für 2026',
	];
}
