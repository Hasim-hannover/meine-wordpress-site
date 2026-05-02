<?php
/**
 * Canonical WGOS Foundation and add-on pricing.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HU_FOUNDATION_PRICE_STANDARD', 14900 );
define( 'HU_FOUNDATION_PRICE_FOUNDING', 9900 );
define( 'HU_FOUNDATION_DURATION_WEEKS_MIN', 8 );
define( 'HU_FOUNDATION_DURATION_WEEKS_MAX', 10 );
define( 'HU_PERFORMANCE_RETAINER_PRICE', 1500 );
define( 'HU_PERFORMANCE_FOUNDING_RETAINER', 1000 );
define( 'HU_PERFORMANCE_FOUNDING_MTHS', 6 );
define( 'HU_PERFORMANCE_MIN_DURATION_MTHS', 6 );
define( 'HU_PREMIUM_LAYER_SETUP', 1500 );
define( 'HU_PREMIUM_LAYER_RETAINER', 700 );
define( 'HU_FOUNDING_DISCOUNT_PERCENT', 33 );
define( 'HU_VALUE_ANCHOR_MARKET_MIN', 34000 );
define( 'HU_VALUE_ANCHOR_MARKET_MAX', 77000 );

/**
 * Return the canonical pricing model.
 *
 * @return array<string, int|string>
 */
function hu_pricing_canon() {
	return [
		'foundation_price_standard'       => HU_FOUNDATION_PRICE_STANDARD,
		'foundation_price_founding'       => HU_FOUNDATION_PRICE_FOUNDING,
		'foundation_duration_weeks_min'   => HU_FOUNDATION_DURATION_WEEKS_MIN,
		'foundation_duration_weeks_max'   => HU_FOUNDATION_DURATION_WEEKS_MAX,
		'performance_retainer_price'      => HU_PERFORMANCE_RETAINER_PRICE,
		'performance_founding_retainer'   => HU_PERFORMANCE_FOUNDING_RETAINER,
		'performance_founding_months'     => HU_PERFORMANCE_FOUNDING_MTHS,
		'performance_min_duration_months' => HU_PERFORMANCE_MIN_DURATION_MTHS,
		'premium_layer_setup'             => HU_PREMIUM_LAYER_SETUP,
		'premium_layer_retainer'          => HU_PREMIUM_LAYER_RETAINER,
		'founding_discount_percent'       => HU_FOUNDING_DISCOUNT_PERCENT,
		'value_anchor_market_min'         => HU_VALUE_ANCHOR_MARKET_MIN,
		'value_anchor_market_max'         => HU_VALUE_ANCHOR_MARKET_MAX,
		'guarantee_scope'                 => 'Funktionsfähiges Anfrage-System, kein Anfrage-Volumen.',
	];
}
