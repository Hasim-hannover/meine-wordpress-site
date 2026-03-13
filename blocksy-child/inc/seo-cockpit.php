<?php
/**
 * SEO Cockpit bootstrap loader.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$nexus_seo_cockpit_modules = [
	'seo-cockpit-core.php',
	'seo-cockpit-api.php',
	'seo-cockpit-sync.php',
	'seo-cockpit-insights.php',
	'seo-cockpit-ui.php',
];

foreach ( $nexus_seo_cockpit_modules as $nexus_seo_cockpit_module ) {
	$nexus_seo_cockpit_path = __DIR__ . '/' . $nexus_seo_cockpit_module;

	if ( file_exists( $nexus_seo_cockpit_path ) ) {
		require_once $nexus_seo_cockpit_path;
	}
}

unset( $nexus_seo_cockpit_modules, $nexus_seo_cockpit_module, $nexus_seo_cockpit_path );
