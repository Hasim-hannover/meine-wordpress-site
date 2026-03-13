<?php
/**
 * SEO Cockpit: Search Console dashboard with optional Koko Analytics bridge.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the admin slug for the SEO cockpit.
 *
 * @return string
 */
function nexus_get_seo_cockpit_menu_slug() {
	return 'nexus-seo-cockpit';
}

/**
 * Return the settings option name for the SEO cockpit.
 *
 * @return string
 */
function nexus_get_seo_cockpit_option_name() {
	return 'nexus_seo_cockpit_settings';
}

/**
 * Return the token storage option name for the SEO cockpit.
 *
 * @return string
 */
function nexus_get_seo_cockpit_token_option_name() {
	return 'nexus_seo_cockpit_tokens';
}

/**
 * Return the runtime option name for sync diagnostics.
 *
 * @return string
 */
function nexus_get_seo_cockpit_runtime_option_name() {
	return 'nexus_seo_cockpit_runtime';
}

/**
 * Return the Search Console OAuth scope used by the cockpit.
 *
 * @return string
 */
function nexus_get_seo_cockpit_scope() {
	return 'https://www.googleapis.com/auth/webmasters.readonly';
}

/**
 * Return the Search Console REST API base URL.
 *
 * @return string
 */
function nexus_get_seo_cockpit_api_base_url() {
	return 'https://www.googleapis.com/webmasters/v3';
}

/**
 * Return the Search Console OAuth redirect URI.
 *
 * @return string
 */
function nexus_get_seo_cockpit_redirect_uri() {
	if ( defined( 'NEXUS_GSC_REDIRECT_URI' ) && NEXUS_GSC_REDIRECT_URI ) {
		return esc_url_raw( (string) NEXUS_GSC_REDIRECT_URI );
	}

	return admin_url( 'admin-post.php?action=nexus_seo_cockpit_oauth_callback' );
}

/**
 * Return persisted cockpit settings.
 *
 * @return array<string, string>
 */
function nexus_get_seo_cockpit_settings() {
	$settings = get_option( nexus_get_seo_cockpit_option_name(), [] );

	if ( ! is_array( $settings ) ) {
		$settings = [];
	}

	return wp_parse_args(
		$settings,
		[
			'client_id'      => '',
			'client_secret'  => '',
			'property'       => '',
			'refresh_window' => '12',
		]
	);
}

/**
 * Return one cockpit setting with optional constant override.
 *
 * @param string $key     Setting key.
 * @param string $default Default value.
 * @return string
 */
function nexus_get_seo_cockpit_setting( $key, $default = '' ) {
	$key      = sanitize_key( (string) $key );
	$settings = nexus_get_seo_cockpit_settings();
	$map      = [
		'client_id'     => 'NEXUS_GSC_CLIENT_ID',
		'client_secret' => 'NEXUS_GSC_CLIENT_SECRET',
		'property'      => 'NEXUS_GSC_PROPERTY',
	];

	if ( isset( $map[ $key ] ) && defined( $map[ $key ] ) && constant( $map[ $key ] ) ) {
		return (string) constant( $map[ $key ] );
	}

	return isset( $settings[ $key ] ) ? (string) $settings[ $key ] : (string) $default;
}

/**
 * Return the effective Search Console config.
 *
 * @return array<string, string>
 */
function nexus_get_seo_cockpit_search_console_config() {
	return [
		'client_id'     => trim( nexus_get_seo_cockpit_setting( 'client_id' ) ),
		'client_secret' => trim( nexus_get_seo_cockpit_setting( 'client_secret' ) ),
		'property'      => trim( nexus_get_seo_cockpit_setting( 'property' ) ),
		'redirect_uri'  => nexus_get_seo_cockpit_redirect_uri(),
		'scope'         => nexus_get_seo_cockpit_scope(),
	];
}

/**
 * Determine whether the cockpit has usable Search Console credentials.
 *
 * @return bool
 */
function nexus_has_seo_cockpit_search_console_credentials() {
	$config = nexus_get_seo_cockpit_search_console_config();

	return '' !== $config['client_id'] && '' !== $config['client_secret'] && '' !== $config['redirect_uri'];
}

/**
 * Return the stored token payload.
 *
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_tokens() {
	$tokens = get_option( nexus_get_seo_cockpit_token_option_name(), [] );

	return is_array( $tokens ) ? $tokens : [];
}

/**
 * Return the stored runtime payload.
 *
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_runtime() {
	$runtime = get_option( nexus_get_seo_cockpit_runtime_option_name(), [] );

	return is_array( $runtime ) ? $runtime : [];
}

/**
 * Persist the Search Console token payload.
 *
 * @param array<string, mixed> $tokens Token payload.
 * @return void
 */
function nexus_update_seo_cockpit_tokens( $tokens ) {
	update_option( nexus_get_seo_cockpit_token_option_name(), $tokens, false );
}

/**
 * Persist runtime sync diagnostics.
 *
 * @param array<string, mixed> $runtime Runtime payload.
 * @return void
 */
function nexus_update_seo_cockpit_runtime( $runtime ) {
	update_option( nexus_get_seo_cockpit_runtime_option_name(), $runtime, false );
}

/**
 * Register the SEO cockpit admin menu.
 *
 * @return void
 */
function nexus_register_seo_cockpit_menu() {
	add_menu_page(
		'SEO Cockpit',
		'SEO Cockpit',
		'manage_options',
		nexus_get_seo_cockpit_menu_slug(),
		'nexus_render_seo_cockpit_dashboard',
		'dashicons-chart-area',
		59
	);

	add_submenu_page(
		nexus_get_seo_cockpit_menu_slug(),
		'SEO Cockpit',
		'Uebersicht',
		'manage_options',
		nexus_get_seo_cockpit_menu_slug(),
		'nexus_render_seo_cockpit_dashboard'
	);

	add_submenu_page(
		nexus_get_seo_cockpit_menu_slug(),
		'SEO Cockpit Einstellungen',
		'Einstellungen',
		'manage_options',
		'nexus-seo-cockpit-settings',
		'nexus_render_seo_cockpit_settings_page'
	);
}
add_action( 'admin_menu', 'nexus_register_seo_cockpit_menu' );

/**
 * Register the cockpit settings group.
 *
 * @return void
 */
function nexus_register_seo_cockpit_settings() {
	register_setting(
		'nexus_seo_cockpit_settings',
		nexus_get_seo_cockpit_option_name(),
		[
			'type'              => 'array',
			'sanitize_callback' => 'nexus_sanitize_seo_cockpit_settings',
			'default'           => [],
		]
	);
}
add_action( 'admin_init', 'nexus_register_seo_cockpit_settings' );

/**
 * Sanitize the cockpit settings payload.
 *
 * @param mixed $settings Raw settings payload.
 * @return array<string, string>
 */
function nexus_sanitize_seo_cockpit_settings( $settings ) {
	$settings = is_array( $settings ) ? $settings : [];

	return [
		'client_id'      => sanitize_text_field( (string) ( $settings['client_id'] ?? '' ) ),
		'client_secret'  => sanitize_text_field( (string) ( $settings['client_secret'] ?? '' ) ),
		'property'       => sanitize_text_field( (string) ( $settings['property'] ?? '' ) ),
		'refresh_window' => (string) max( 1, min( 24, absint( $settings['refresh_window'] ?? 12 ) ) ),
	];
}

/**
 * Enqueue admin styles for the SEO cockpit.
 *
 * @param string $hook Current admin hook.
 * @return void
 */
function nexus_enqueue_seo_cockpit_admin_assets( $hook ) {
	$is_seo_screen      = false !== strpos( (string) $hook, nexus_get_seo_cockpit_menu_slug() );
	$is_dashboard_index = 'index.php' === (string) $hook;

	if ( ! $is_seo_screen && ! $is_dashboard_index ) {
		return;
	}

	$path = get_stylesheet_directory() . '/assets/css/seo-cockpit-admin.css';
	if ( file_exists( $path ) ) {
		wp_enqueue_style(
			'nexus-seo-cockpit-admin',
			get_stylesheet_directory_uri() . '/assets/css/seo-cockpit-admin.css',
			[],
			filemtime( $path )
		);
	}
}
add_action( 'admin_enqueue_scripts', 'nexus_enqueue_seo_cockpit_admin_assets' );

/**
 * Ensure the automatic SEO cockpit refresh event is scheduled.
 *
 * @return void
 */
function nexus_schedule_seo_cockpit_refresh_event() {
	if ( wp_installing() ) {
		return;
	}

	if ( wp_next_scheduled( 'nexus_seo_cockpit_refresh_snapshot' ) ) {
		return;
	}

	wp_schedule_event( time() + ( 5 * MINUTE_IN_SECONDS ), 'twicedaily', 'nexus_seo_cockpit_refresh_snapshot' );
}
add_action( 'init', 'nexus_schedule_seo_cockpit_refresh_event', 20 );

/**
 * Return a URL for cockpit actions.
 *
 * @param string $action Action key.
 * @param array  $args   Optional query args.
 * @return string
 */
function nexus_get_seo_cockpit_admin_action_url( $action, $args = [] ) {
	$args = array_merge(
		[
			'action' => $action,
		],
		(array) $args
	);

	return add_query_arg( $args, admin_url( 'admin-post.php' ) );
}

/**
 * Return the dashboard URL with optional arguments.
 *
 * @param array $args Optional query args.
 * @return string
 */
function nexus_get_seo_cockpit_dashboard_url( $args = [] ) {
	$url = admin_url( 'admin.php?page=' . nexus_get_seo_cockpit_menu_slug() );

	if ( ! empty( $args ) ) {
		$url = add_query_arg( $args, $url );
	}

	return $url;
}

/**
 * Build a state token for the Google OAuth handshake.
 *
 * @return string
 */
function nexus_create_seo_cockpit_oauth_state() {
	$state = wp_generate_password( 32, false, false );

	set_transient(
		'nexus_seo_cockpit_oauth_' . $state,
		[
			'user_id' => get_current_user_id(),
			'created' => time(),
		],
		15 * MINUTE_IN_SECONDS
	);

	return $state;
}

/**
 * Return the persisted state payload for an OAuth state token.
 *
 * @param string $state OAuth state token.
 * @return array<string, mixed>
 */
function nexus_get_seo_cockpit_oauth_state( $state ) {
	$payload = get_transient( 'nexus_seo_cockpit_oauth_' . $state );

	return is_array( $payload ) ? $payload : [];
}

/**
 * Delete a persisted OAuth state token.
 *
 * @param string $state OAuth state token.
 * @return void
 */
function nexus_delete_seo_cockpit_oauth_state( $state ) {
	delete_transient( 'nexus_seo_cockpit_oauth_' . $state );
}

/**
 * Redirect to the Google consent page.
 *
 * @return void
 */
function nexus_handle_seo_cockpit_connect_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Nicht erlaubt.' );
	}

	check_admin_referer( 'nexus_seo_cockpit_connect' );

	if ( ! nexus_has_seo_cockpit_search_console_credentials() ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'missing_credentials' ] ) );
		exit;
	}

	$config = nexus_get_seo_cockpit_search_console_config();
	$state  = nexus_create_seo_cockpit_oauth_state();
	$params = [
		'client_id'              => $config['client_id'],
		'redirect_uri'           => $config['redirect_uri'],
		'response_type'          => 'code',
		'scope'                  => $config['scope'],
		'access_type'            => 'offline',
		'include_granted_scopes' => 'true',
		'prompt'                 => 'consent',
		'state'                  => $state,
	];

	wp_safe_redirect( 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query( $params, '', '&', PHP_QUERY_RFC3986 ) );
	exit;
}
add_action( 'admin_post_nexus_seo_cockpit_connect', 'nexus_handle_seo_cockpit_connect_action' );

/**
 * Handle the Google OAuth callback for the cockpit.
 *
 * @return void
 */
function nexus_handle_seo_cockpit_oauth_callback() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Nicht erlaubt.' );
	}

	$state   = isset( $_GET['state'] ) ? sanitize_text_field( (string) wp_unslash( $_GET['state'] ) ) : '';
	$code    = isset( $_GET['code'] ) ? sanitize_text_field( (string) wp_unslash( $_GET['code'] ) ) : '';
	$error   = isset( $_GET['error'] ) ? sanitize_text_field( (string) wp_unslash( $_GET['error'] ) ) : '';
	$payload = '' !== $state ? nexus_get_seo_cockpit_oauth_state( $state ) : [];

	if ( '' === $state || empty( $payload ) || (int) ( $payload['user_id'] ?? 0 ) !== get_current_user_id() ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_state_invalid' ] ) );
		exit;
	}

	nexus_delete_seo_cockpit_oauth_state( $state );

	if ( '' !== $error ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_denied' ] ) );
		exit;
	}

	if ( '' === $code ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_missing_code' ] ) );
		exit;
	}

	$config   = nexus_get_seo_cockpit_search_console_config();
	$response = wp_remote_post(
		'https://oauth2.googleapis.com/token',
		[
			'timeout' => 20,
			'body'    => [
				'code'          => $code,
				'client_id'     => $config['client_id'],
				'client_secret' => $config['client_secret'],
				'redirect_uri'  => $config['redirect_uri'],
				'grant_type'    => 'authorization_code',
			],
		]
	);

	if ( is_wp_error( $response ) ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_exchange_failed' ] ) );
		exit;
	}

	$status  = (int) wp_remote_retrieve_response_code( $response );
	$decoded = json_decode( wp_remote_retrieve_body( $response ), true );
	$decoded = is_array( $decoded ) ? $decoded : [];

	if ( $status < 200 || $status >= 300 || empty( $decoded['access_token'] ) ) {
		wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_exchange_failed' ] ) );
		exit;
	}

	$current_tokens = nexus_get_seo_cockpit_tokens();
	$tokens         = [
		'access_token'  => sanitize_text_field( (string) $decoded['access_token'] ),
		'refresh_token' => sanitize_text_field( (string) ( $decoded['refresh_token'] ?? ( $current_tokens['refresh_token'] ?? '' ) ) ),
		'expires_at'    => current_time( 'timestamp' ) + max( 60, absint( $decoded['expires_in'] ?? 3600 ) ),
		'token_type'    => sanitize_text_field( (string) ( $decoded['token_type'] ?? 'Bearer' ) ),
		'scope'         => sanitize_text_field( (string) ( $decoded['scope'] ?? nexus_get_seo_cockpit_scope() ) ),
		'updated_at'    => current_time( 'timestamp' ),
	];

	nexus_update_seo_cockpit_tokens( $tokens );
	nexus_delete_seo_cockpit_snapshot_cache();

	wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_connected' ] ) );
	exit;
}
add_action( 'admin_post_nexus_seo_cockpit_oauth_callback', 'nexus_handle_seo_cockpit_oauth_callback' );

/**
 * Delete the current Search Console token payload.
 *
 * @return void
 */
function nexus_handle_seo_cockpit_disconnect_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Nicht erlaubt.' );
	}

	check_admin_referer( 'nexus_seo_cockpit_disconnect' );

	delete_option( nexus_get_seo_cockpit_token_option_name() );
	delete_option( nexus_get_seo_cockpit_runtime_option_name() );
	nexus_delete_seo_cockpit_snapshot_cache();

	wp_safe_redirect( nexus_get_seo_cockpit_dashboard_url( [ 'nexus_seo_notice' => 'oauth_disconnected' ] ) );
	exit;
}
add_action( 'admin_post_nexus_seo_cockpit_disconnect', 'nexus_handle_seo_cockpit_disconnect_action' );

/**
 * Force-refresh the Search Console cache.
 *
 * @return void
 */
function nexus_handle_seo_cockpit_refresh_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Nicht erlaubt.' );
	}

	check_admin_referer( 'nexus_seo_cockpit_refresh' );

	nexus_delete_seo_cockpit_snapshot_cache();
	$result = nexus_run_seo_cockpit_sync( 'manual' );

	wp_safe_redirect(
		nexus_get_seo_cockpit_dashboard_url(
			[
				'nexus_seo_notice' => is_wp_error( $result ) ? 'refresh_failed' : 'refresh_success',
			]
		)
	);
	exit;
}
add_action( 'admin_post_nexus_seo_cockpit_refresh', 'nexus_handle_seo_cockpit_refresh_action' );

/**
 * Refresh the Search Console access token when needed.
 *
 * @return array<string, mixed>|WP_Error
 */
function nexus_refresh_seo_cockpit_access_token() {
	$config = nexus_get_seo_cockpit_search_console_config();
	$tokens = nexus_get_seo_cockpit_tokens();

	if ( '' === (string) ( $tokens['refresh_token'] ?? '' ) ) {
		return new WP_Error( 'nexus_seo_missing_refresh_token', 'Es ist kein Refresh-Token fuer Search Console gespeichert.' );
	}

	$response = wp_remote_post(
		'https://oauth2.googleapis.com/token',
		[
			'timeout' => 20,
			'body'    => [
				'client_id'     => $config['client_id'],
				'client_secret' => $config['client_secret'],
				'refresh_token' => $tokens['refresh_token'],
				'grant_type'    => 'refresh_token',
			],
		]
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$status  = (int) wp_remote_retrieve_response_code( $response );
	$decoded = json_decode( wp_remote_retrieve_body( $response ), true );
	$decoded = is_array( $decoded ) ? $decoded : [];

	if ( $status < 200 || $status >= 300 || empty( $decoded['access_token'] ) ) {
		return new WP_Error( 'nexus_seo_refresh_failed', 'Das Refresh-Token konnte nicht erneuert werden.' );
	}

	$tokens['access_token'] = sanitize_text_field( (string) $decoded['access_token'] );
	$tokens['expires_at']   = current_time( 'timestamp' ) + max( 60, absint( $decoded['expires_in'] ?? 3600 ) );
	$tokens['updated_at']   = current_time( 'timestamp' );

	nexus_update_seo_cockpit_tokens( $tokens );

	return $tokens;
}

/**
 * Return a valid Search Console access token.
 *
 * @return string|WP_Error
 */
function nexus_get_seo_cockpit_access_token() {
	$tokens = nexus_get_seo_cockpit_tokens();

	if ( '' === (string) ( $tokens['access_token'] ?? '' ) ) {
		return new WP_Error( 'nexus_seo_missing_access_token', 'Die Search Console ist noch nicht verbunden.' );
	}

	$expires_at = absint( $tokens['expires_at'] ?? 0 );
	if ( $expires_at > current_time( 'timestamp' ) + 90 ) {
		return (string) $tokens['access_token'];
	}

	$refreshed = nexus_refresh_seo_cockpit_access_token();
	if ( is_wp_error( $refreshed ) ) {
		return $refreshed;
	}

	return (string) $refreshed['access_token'];
}

/**
 * Perform one Search Console API request.
 *
 * @param string $method      HTTP method.
 * @param string $path        API path.
 * @param array  $body        Optional JSON body.
 * @param bool   $allow_retry Whether a single token-refresh retry is allowed.
 * @return array<string, mixed>|WP_Error
 */
function nexus_seo_cockpit_search_console_request( $method, $path, $body = [], $allow_retry = true ) {
	$access_token = nexus_get_seo_cockpit_access_token();
	if ( is_wp_error( $access_token ) ) {
		return $access_token;
	}

	$args = [
		'method'  => strtoupper( $method ),
		'timeout' => 25,
		'headers' => [
			'Authorization' => 'Bearer ' . $access_token,
			'Accept'        => 'application/json',
		],
	];

	if ( ! empty( $body ) ) {
		$args['headers']['Content-Type'] = 'application/json; charset=utf-8';
		$args['body']                    = wp_json_encode( $body );
	}

	$response = wp_remote_request( nexus_get_seo_cockpit_api_base_url() . $path, $args );

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$status  = (int) wp_remote_retrieve_response_code( $response );
	$decoded = json_decode( wp_remote_retrieve_body( $response ), true );
	$decoded = is_array( $decoded ) ? $decoded : [];

	if ( 401 === $status && $allow_retry ) {
		$refreshed = nexus_refresh_seo_cockpit_access_token();
		if ( ! is_wp_error( $refreshed ) ) {
			return nexus_seo_cockpit_search_console_request( $method, $path, $body, false );
		}
	}

	if ( $status < 200 || $status >= 300 ) {
		$message = isset( $decoded['error']['message'] ) ? (string) $decoded['error']['message'] : 'Search Console Anfrage fehlgeschlagen.';
		return new WP_Error( 'nexus_seo_api_error', $message, [ 'status' => $status, 'response' => $decoded ] );
	}

	return $decoded;
}

/**
 * Return cached Search Console sites.
 *
 * @param bool $force Force refresh.
 * @return array<int, array<string, mixed>>|WP_Error
 */
function nexus_get_seo_cockpit_sites( $force = false ) {
	$cache_key = 'nexus_seo_cockpit_sites';
	$cached    = get_transient( $cache_key );

	if ( ! $force && is_array( $cached ) ) {
		return $cached;
	}

	$response = nexus_seo_cockpit_search_console_request( 'GET', '/sites' );
	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$sites = isset( $response['siteEntry'] ) && is_array( $response['siteEntry'] ) ? array_values( $response['siteEntry'] ) : [];
	set_transient( $cache_key, $sites, HOUR_IN_SECONDS );

	return $sites;
}

/**
 * Return the active property configured for the cockpit.
 *
 * @return string
 */
function nexus_get_seo_cockpit_property() {
	return trim( nexus_get_seo_cockpit_setting( 'property' ) );
}

/**
 * Return date ranges for current and previous comparison windows.
 *
 * @return array<string, string>
 */
function nexus_get_seo_cockpit_date_ranges() {
	$window_days   = 28;
	$lag_days      = 3;
	$end_ts        = current_time( 'timestamp' ) - ( $lag_days * DAY_IN_SECONDS );
	$current_end   = wp_date( 'Y-m-d', $end_ts );
	$current_start = wp_date( 'Y-m-d', $end_ts - ( ( $window_days - 1 ) * DAY_IN_SECONDS ) );
	$previous_end  = wp_date( 'Y-m-d', $end_ts - ( $window_days * DAY_IN_SECONDS ) );
	$previous_start = wp_date( 'Y-m-d', $end_ts - ( ( ( $window_days * 2 ) - 1 ) * DAY_IN_SECONDS ) );

	return [
		'current_start'  => $current_start,
		'current_end'    => $current_end,
		'previous_start' => $previous_start,
		'previous_end'   => $previous_end,
	];
}

/**
 * Query one Search Console overview block.
 *
 * @param string $property Site property.
 * @param string $start    Start date.
 * @param string $end      End date.
 * @return array<string, float>|WP_Error
 */
function nexus_get_seo_cockpit_overview_metrics( $property, $start, $end ) {
	$response = nexus_seo_cockpit_search_console_request(
		'POST',
		'/sites/' . rawurlencode( $property ) . '/searchAnalytics/query',
		[
			'startDate'  => $start,
			'endDate'    => $end,
			'searchType' => 'web',
			'rowLimit'   => 1,
		]
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$row = ! empty( $response['rows'][0] ) && is_array( $response['rows'][0] ) ? $response['rows'][0] : [];

	return [
		'clicks'      => (float) ( $row['clicks'] ?? 0 ),
		'impressions' => (float) ( $row['impressions'] ?? 0 ),
		'ctr'         => (float) ( $row['ctr'] ?? 0 ),
		'position'    => (float) ( $row['position'] ?? 0 ),
	];
}

/**
 * Query one Search Console dimension report.
 *
 * @param string $property  Site property.
 * @param string $start     Start date.
 * @param string $end       End date.
 * @param string $dimension Report dimension.
 * @param int    $limit     Max row count.
 * @return array<int, array<string, mixed>>|WP_Error
 */
function nexus_get_seo_cockpit_dimension_rows( $property, $start, $end, $dimension, $limit = 10 ) {
	$response = nexus_seo_cockpit_search_console_request(
		'POST',
		'/sites/' . rawurlencode( $property ) . '/searchAnalytics/query',
		[
			'startDate'  => $start,
			'endDate'    => $end,
			'searchType' => 'web',
			'dimensions' => [ sanitize_key( $dimension ) ],
			'rowLimit'   => max( 1, absint( $limit ) ),
		]
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	return isset( $response['rows'] ) && is_array( $response['rows'] ) ? array_values( $response['rows'] ) : [];
}

/**
 * Return the transient cache key for the SEO snapshot.
 *
 * @return string
 */
function nexus_get_seo_cockpit_snapshot_cache_key() {
	$property = nexus_get_seo_cockpit_property();

	return 'nexus_seo_snapshot_' . md5( $property ?: 'default' );
}

/**
 * Delete the cached cockpit snapshot.
 *
 * @return void
 */
function nexus_delete_seo_cockpit_snapshot_cache() {
	delete_transient( nexus_get_seo_cockpit_snapshot_cache_key() );
	delete_transient( 'nexus_seo_cockpit_sites' );
}

/**
 * Persist the last sync result for dashboard and diagnostics.
 *
 * @param string                 $source Sync source.
 * @param array<string, mixed>|WP_Error $result Sync result.
 * @return void
 */
function nexus_record_seo_cockpit_sync_result( $source, $result ) {
	$runtime = nexus_get_seo_cockpit_runtime();
	$runtime = is_array( $runtime ) ? $runtime : [];
	$source  = sanitize_key( (string) $source );

	$runtime['last_sync_source'] = $source ?: 'manual';
	$runtime['last_sync_at']     = current_time( 'timestamp' );

	if ( is_wp_error( $result ) ) {
		$runtime['last_sync_status']  = 'error';
		$runtime['last_sync_message'] = $result->get_error_message();
	} else {
		$runtime['last_sync_status']  = 'success';
		$runtime['last_sync_message'] = 'Snapshot erfolgreich aktualisiert.';
	}

	nexus_update_seo_cockpit_runtime( $runtime );
}

/**
 * Refresh the cached SEO cockpit snapshot and persist its runtime status.
 *
 * @param string $source Sync source label.
 * @return array<string, mixed>|WP_Error
 */
function nexus_run_seo_cockpit_sync( $source = 'manual' ) {
	nexus_delete_seo_cockpit_snapshot_cache();
	$result = nexus_get_seo_cockpit_snapshot( true );

	nexus_record_seo_cockpit_sync_result( $source, $result );

	return $result;
}

/**
 * Refresh the SEO cockpit snapshot from WP-Cron.
 *
 * @return void
 */
function nexus_handle_seo_cockpit_cron_refresh() {
	$config = nexus_get_seo_cockpit_search_console_config();
	$tokens = nexus_get_seo_cockpit_tokens();

	if ( '' === $config['property'] || '' === $config['client_id'] || '' === $config['client_secret'] || '' === (string) ( $tokens['access_token'] ?? '' ) ) {
		return;
	}

	nexus_run_seo_cockpit_sync( 'cron' );
}
add_action( 'nexus_seo_cockpit_refresh_snapshot', 'nexus_handle_seo_cockpit_cron_refresh' );

/**
 * Build or load the cached SEO cockpit snapshot.
 *
 * @param bool $force Force refresh.
 * @return array<string, mixed>|WP_Error
 */
function nexus_get_seo_cockpit_snapshot( $force = false ) {
	$property = nexus_get_seo_cockpit_property();

	if ( '' === $property ) {
		return new WP_Error( 'nexus_seo_missing_property', 'Es ist noch keine Search-Console-Property hinterlegt.' );
	}

	$cache_key      = nexus_get_seo_cockpit_snapshot_cache_key();
	$cached_snapshot = get_transient( $cache_key );
	if ( ! $force && is_array( $cached_snapshot ) ) {
		return $cached_snapshot;
	}

	$ranges = nexus_get_seo_cockpit_date_ranges();

	$current_overview = nexus_get_seo_cockpit_overview_metrics( $property, $ranges['current_start'], $ranges['current_end'] );
	if ( is_wp_error( $current_overview ) ) {
		return $current_overview;
	}

	$previous_overview = nexus_get_seo_cockpit_overview_metrics( $property, $ranges['previous_start'], $ranges['previous_end'] );
	if ( is_wp_error( $previous_overview ) ) {
		return $previous_overview;
	}

	$top_pages = nexus_get_seo_cockpit_dimension_rows( $property, $ranges['current_start'], $ranges['current_end'], 'page', 10 );
	if ( is_wp_error( $top_pages ) ) {
		return $top_pages;
	}

	$top_queries = nexus_get_seo_cockpit_dimension_rows( $property, $ranges['current_start'], $ranges['current_end'], 'query', 10 );
	if ( is_wp_error( $top_queries ) ) {
		return $top_queries;
	}

	$top_devices = nexus_get_seo_cockpit_dimension_rows( $property, $ranges['current_start'], $ranges['current_end'], 'device', 5 );
	if ( is_wp_error( $top_devices ) ) {
		return $top_devices;
	}

	$snapshot = [
		'generated_at' => current_time( 'timestamp' ),
		'property'     => $property,
		'ranges'       => $ranges,
		'overview'     => [
			'current'  => $current_overview,
			'previous' => $previous_overview,
		],
		'top_pages'    => $top_pages,
		'top_queries'  => $top_queries,
		'top_devices'  => $top_devices,
	];

	$settings      = nexus_get_seo_cockpit_settings();
	$refresh_hours = max( 1, min( 24, absint( $settings['refresh_window'] ?? 12 ) ) );
	set_transient( $cache_key, $snapshot, $refresh_hours * HOUR_IN_SECONDS );
	nexus_record_seo_cockpit_sync_result( 'cache_build', $snapshot );

	return $snapshot;
}

/**
 * Return a simple Koko Analytics status payload.
 *
 * @return array<string, mixed>
 */
function nexus_get_koko_analytics_status() {
	if ( ! function_exists( 'is_plugin_active' ) && file_exists( ABSPATH . 'wp-admin/includes/plugin.php' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$plugin_file = 'koko-analytics/koko-analytics.php';
	$is_active   = function_exists( 'is_plugin_active' ) ? is_plugin_active( $plugin_file ) : false;
	$is_present  = defined( 'WP_PLUGIN_DIR' ) ? file_exists( WP_PLUGIN_DIR . '/' . $plugin_file ) : false;

	return [
		'plugin_file' => $plugin_file,
		'installed'   => $is_present,
		'active'      => $is_active,
		'label'       => $is_active ? 'Aktiv und bereit fuer die naechste Ausbaustufe' : ( $is_present ? 'Installiert, aber nicht aktiv' : 'Noch nicht installiert' ),
	];
}

/**
 * Register a compact WordPress dashboard widget for the SEO cockpit.
 *
 * @return void
 */
function nexus_register_seo_cockpit_dashboard_widget() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	wp_add_dashboard_widget(
		'nexus_seo_cockpit_dashboard_widget',
		'SEO Cockpit Snapshot',
		'nexus_render_seo_cockpit_dashboard_widget'
	);
}
add_action( 'wp_dashboard_setup', 'nexus_register_seo_cockpit_dashboard_widget' );

/**
 * Render the compact SEO cockpit widget on the default dashboard.
 *
 * @return void
 */
function nexus_render_seo_cockpit_dashboard_widget() {
	$runtime      = nexus_get_seo_cockpit_runtime();
	$config       = nexus_get_seo_cockpit_search_console_config();
	$koko         = nexus_get_koko_analytics_status();
	$tokens       = nexus_get_seo_cockpit_tokens();
	$is_connected = '' !== (string) ( $tokens['access_token'] ?? '' );
	$snapshot     = nexus_get_seo_cockpit_snapshot();
	?>
	<div class="nexus-seo-widget">
		<p class="nexus-seo-widget__status">
			<strong>Search Console:</strong>
			<?php echo esc_html( $is_connected ? 'verbunden' : 'nicht verbunden' ); ?>
			<span class="nexus-seo-widget__divider">|</span>
			<strong>Koko:</strong>
			<?php echo esc_html( $koko['active'] ? 'aktiv' : 'noch nicht aktiv' ); ?>
		</p>

		<?php if ( ! empty( $runtime['last_sync_at'] ) ) : ?>
			<p class="nexus-seo-widget__hint">
				Letzte Synchronisierung: <?php echo esc_html( wp_date( 'd.m.Y H:i', (int) $runtime['last_sync_at'] ) ); ?>
				(<?php echo esc_html( (string) ( $runtime['last_sync_source'] ?? 'manuell' ) ); ?>)
			</p>
		<?php endif; ?>

		<?php if ( is_wp_error( $snapshot ) ) : ?>
			<p class="nexus-seo-widget__hint"><?php echo esc_html( $snapshot->get_error_message() ); ?></p>
			<?php if ( '' === $config['property'] ) : ?>
				<p><a class="button button-secondary" href="<?php echo esc_url( admin_url( 'admin.php?page=nexus-seo-cockpit-settings' ) ); ?>">Property hinterlegen</a></p>
			<?php else : ?>
				<p><a class="button button-secondary" href="<?php echo esc_url( nexus_get_seo_cockpit_dashboard_url() ); ?>">Zum SEO Cockpit</a></p>
			<?php endif; ?>
		<?php else : ?>
			<?php $current = $snapshot['overview']['current']; ?>
			<div class="nexus-seo-widget__metrics">
				<div class="nexus-seo-widget__metric">
					<span>Klicks</span>
					<strong><?php echo esc_html( nexus_format_seo_cockpit_metric( 'clicks', $current['clicks'] ) ); ?></strong>
				</div>
				<div class="nexus-seo-widget__metric">
					<span>Impr.</span>
					<strong><?php echo esc_html( nexus_format_seo_cockpit_metric( 'impressions', $current['impressions'] ) ); ?></strong>
				</div>
				<div class="nexus-seo-widget__metric">
					<span>CTR</span>
					<strong><?php echo esc_html( nexus_format_seo_cockpit_metric( 'ctr', $current['ctr'] ) ); ?></strong>
				</div>
				<div class="nexus-seo-widget__metric">
					<span>Pos.</span>
					<strong><?php echo esc_html( nexus_format_seo_cockpit_metric( 'position', $current['position'] ) ); ?></strong>
				</div>
			</div>

			<?php if ( ! empty( $snapshot['top_pages'][0] ) ) : ?>
				<p class="nexus-seo-widget__hint">
					<strong>Top Page:</strong>
					<code><?php echo esc_html( nexus_get_seo_cockpit_row_label( $snapshot['top_pages'][0] ) ); ?></code>
				</p>
			<?php endif; ?>

			<?php if ( ! empty( $snapshot['top_queries'][0] ) ) : ?>
				<p class="nexus-seo-widget__hint">
					<strong>Top Query:</strong>
					<?php echo esc_html( nexus_get_seo_cockpit_row_label( $snapshot['top_queries'][0] ) ); ?>
				</p>
			<?php endif; ?>

			<p><a class="button button-secondary" href="<?php echo esc_url( nexus_get_seo_cockpit_dashboard_url() ); ?>">Zum SEO Cockpit</a></p>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Format a metric value for output.
 *
 * @param string       $key   Metric key.
 * @param float|int    $value Metric value.
 * @return string
 */
function nexus_format_seo_cockpit_metric( $key, $value ) {
	$value = (float) $value;

	if ( 'ctr' === $key ) {
		return number_format_i18n( $value * 100, 1 ) . '%';
	}

	if ( 'position' === $key ) {
		return number_format_i18n( $value, 1 );
	}

	return number_format_i18n( $value );
}

/**
 * Format one metric delta value.
 *
 * @param string    $key      Metric key.
 * @param float|int $current  Current value.
 * @param float|int $previous Previous value.
 * @return array<string, string>
 */
function nexus_get_seo_cockpit_metric_delta( $key, $current, $previous ) {
	$current  = (float) $current;
	$previous = (float) $previous;

	if ( 0.0 === $previous ) {
		return [
			'label' => 0.0 === $current ? '0%' : 'neu',
			'class' => 'neutral',
		];
	}

	if ( 'position' === $key ) {
		$delta = $previous - $current;
	} else {
		$delta = ( ( $current - $previous ) / $previous ) * 100;
	}

	$class = $delta > 0 ? 'positive' : ( $delta < 0 ? 'negative' : 'neutral' );

	return [
		'label' => ( $delta > 0 ? '+' : '' ) . number_format_i18n( $delta, 1 ) . ( 'position' === $key ? ' Punkte' : '%' ),
		'class' => $class,
	];
}

/**
 * Render one status notice on the dashboard page.
 *
 * @return void
 */
function nexus_render_seo_cockpit_notice() {
	$notice = isset( $_GET['nexus_seo_notice'] ) ? sanitize_key( (string) wp_unslash( $_GET['nexus_seo_notice'] ) ) : '';

	if ( '' === $notice ) {
		return;
	}

	$messages = [
		'missing_credentials'  => [ 'error', 'Bitte zuerst Client-ID und Client-Secret fuer Search Console hinterlegen.' ],
		'oauth_connected'      => [ 'success', 'Die Search Console wurde erfolgreich verbunden.' ],
		'oauth_disconnected'   => [ 'success', 'Die Search-Console-Verbindung wurde entfernt.' ],
		'oauth_denied'         => [ 'error', 'Die Google-Freigabe wurde abgebrochen.' ],
		'oauth_state_invalid'  => [ 'error', 'Der OAuth-Status war ungueltig oder abgelaufen. Bitte erneut verbinden.' ],
		'oauth_missing_code'   => [ 'error', 'Google hat keinen Authorization Code geliefert.' ],
		'oauth_exchange_failed'=> [ 'error', 'Der Google-Code konnte nicht in ein Token getauscht werden.' ],
		'refresh_success'      => [ 'success', 'Das SEO-Cockpit wurde frisch synchronisiert.' ],
		'refresh_failed'       => [ 'error', 'Die Synchronisierung ist fehlgeschlagen. Bitte Verbindung und Property pruefen.' ],
	];

	if ( empty( $messages[ $notice ] ) ) {
		return;
	}

	$message = $messages[ $notice ];
	printf(
		'<div class="notice notice-%1$s is-dismissible"><p>%2$s</p></div>',
		esc_attr( $message[0] ),
		esc_html( $message[1] )
	);
}

/**
 * Render one table row cell value from a Search Console row.
 *
 * @param array<string, mixed> $row Search Console row.
 * @return string
 */
function nexus_get_seo_cockpit_row_label( $row ) {
	return isset( $row['keys'][0] ) ? (string) $row['keys'][0] : '';
}

/**
 * Render the SEO cockpit dashboard page.
 *
 * @return void
 */
function nexus_render_seo_cockpit_dashboard() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$config      = nexus_get_seo_cockpit_search_console_config();
	$tokens      = nexus_get_seo_cockpit_tokens();
	$runtime     = nexus_get_seo_cockpit_runtime();
	$koko        = nexus_get_koko_analytics_status();
	$snapshot    = nexus_get_seo_cockpit_snapshot();
	$site_list   = nexus_get_seo_cockpit_sites();
	$is_connected = '' !== (string) ( $tokens['access_token'] ?? '' );
	?>
	<div class="wrap nexus-seo-cockpit">
		<h1>SEO Cockpit</h1>
		<?php nexus_render_seo_cockpit_notice(); ?>

		<div class="nexus-seo-cockpit__grid nexus-seo-cockpit__grid--top">
			<section class="nexus-seo-cockpit__panel">
				<div class="nexus-seo-cockpit__panel-head">
					<h2>Search Console</h2>
					<div class="nexus-seo-cockpit__actions">
						<?php if ( $is_connected ) : ?>
							<form method="post" action="<?php echo esc_url( nexus_get_seo_cockpit_admin_action_url( 'nexus_seo_cockpit_refresh' ) ); ?>">
								<?php wp_nonce_field( 'nexus_seo_cockpit_refresh' ); ?>
								<button type="submit" class="button button-primary">Jetzt synchronisieren</button>
							</form>
							<form method="post" action="<?php echo esc_url( nexus_get_seo_cockpit_admin_action_url( 'nexus_seo_cockpit_disconnect' ) ); ?>">
								<?php wp_nonce_field( 'nexus_seo_cockpit_disconnect' ); ?>
								<button type="submit" class="button button-secondary">Verbindung trennen</button>
							</form>
						<?php else : ?>
							<form method="post" action="<?php echo esc_url( nexus_get_seo_cockpit_admin_action_url( 'nexus_seo_cockpit_connect' ) ); ?>">
								<?php wp_nonce_field( 'nexus_seo_cockpit_connect' ); ?>
								<button type="submit" class="button button-primary" <?php disabled( ! nexus_has_seo_cockpit_search_console_credentials() ); ?>>Mit Google verbinden</button>
							</form>
						<?php endif; ?>
					</div>
				</div>
				<ul class="nexus-seo-cockpit__meta-list">
					<li><strong>Status:</strong> <?php echo esc_html( $is_connected ? 'Verbunden' : 'Noch nicht verbunden' ); ?></li>
					<li><strong>Property:</strong> <?php echo esc_html( $config['property'] ?: 'Noch nicht gesetzt' ); ?></li>
					<li><strong>Redirect URI:</strong> <code><?php echo esc_html( $config['redirect_uri'] ); ?></code></li>
					<li><strong>Token aktualisiert:</strong> <?php echo esc_html( ! empty( $tokens['updated_at'] ) ? wp_date( 'd.m.Y H:i', (int) $tokens['updated_at'] ) : 'n/a' ); ?></li>
					<li><strong>Letzte Synchronisierung:</strong> <?php echo esc_html( ! empty( $runtime['last_sync_at'] ) ? wp_date( 'd.m.Y H:i', (int) $runtime['last_sync_at'] ) : 'n/a' ); ?></li>
				</ul>

				<?php if ( ! empty( $runtime['last_sync_status'] ) && ! empty( $runtime['last_sync_message'] ) ) : ?>
					<p class="nexus-seo-cockpit__status <?php echo esc_attr( 'success' === $runtime['last_sync_status'] ? 'is-positive' : 'is-neutral' ); ?>">
						<?php echo esc_html( (string) $runtime['last_sync_message'] ); ?>
					</p>
				<?php endif; ?>

				<?php if ( is_wp_error( $site_list ) ) : ?>
					<p class="nexus-seo-cockpit__hint">Die Search-Console-Siteliste ist noch nicht verfuegbar: <?php echo esc_html( $site_list->get_error_message() ); ?></p>
				<?php elseif ( ! empty( $site_list ) ) : ?>
					<div class="nexus-seo-cockpit__chips">
						<?php foreach ( array_slice( $site_list, 0, 8 ) as $site_entry ) : ?>
							<span class="nexus-seo-cockpit__chip"><?php echo esc_html( (string) ( $site_entry['siteUrl'] ?? '' ) ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</section>

			<section class="nexus-seo-cockpit__panel">
				<div class="nexus-seo-cockpit__panel-head">
					<h2>Koko Analytics</h2>
				</div>
				<p class="nexus-seo-cockpit__status <?php echo esc_attr( $koko['active'] ? 'is-positive' : 'is-neutral' ); ?>">
					<?php echo esc_html( $koko['label'] ); ?>
				</p>
				<p class="nexus-seo-cockpit__hint">
					Heute ist nur die Erkennung vorbereitet. Sobald Koko installiert ist, koennen wir den lokalen Traffic-Layer gegen Search-Console-Seiten legen.
				</p>
			</section>
		</div>

		<?php if ( is_wp_error( $snapshot ) ) : ?>
			<section class="nexus-seo-cockpit__panel">
				<h2>Noch kein SEO-Snapshot</h2>
				<p><?php echo esc_html( $snapshot->get_error_message() ); ?></p>
				<p>Lege zuerst die Search-Console-Property in den Einstellungen fest und verbinde danach Google.</p>
			</section>
		<?php else : ?>
			<?php
			$current  = $snapshot['overview']['current'];
			$previous = $snapshot['overview']['previous'];
			$metrics  = [
				'clicks'      => 'Klicks',
				'impressions' => 'Impressionen',
				'ctr'         => 'CTR',
				'position'    => 'Ø Position',
			];
			?>
			<section class="nexus-seo-cockpit__panel">
				<div class="nexus-seo-cockpit__panel-head">
					<h2>SEO-Lage</h2>
					<p class="nexus-seo-cockpit__hint">
						<?php
						echo esc_html(
							sprintf(
								'Vergleich %s bis %s gegen %s bis %s. Stand: %s',
								$snapshot['ranges']['current_start'],
								$snapshot['ranges']['current_end'],
								$snapshot['ranges']['previous_start'],
								$snapshot['ranges']['previous_end'],
								wp_date( 'd.m.Y H:i', (int) $snapshot['generated_at'] )
							)
						);
						?>
					</p>
				</div>

				<div class="nexus-seo-cockpit__metrics">
					<?php foreach ( $metrics as $key => $label ) : ?>
						<?php $delta = nexus_get_seo_cockpit_metric_delta( $key, $current[ $key ], $previous[ $key ] ); ?>
						<article class="nexus-seo-cockpit__metric-card">
							<span class="nexus-seo-cockpit__metric-label"><?php echo esc_html( $label ); ?></span>
							<strong class="nexus-seo-cockpit__metric-value"><?php echo esc_html( nexus_format_seo_cockpit_metric( $key, $current[ $key ] ) ); ?></strong>
							<span class="nexus-seo-cockpit__metric-delta is-<?php echo esc_attr( $delta['class'] ); ?>"><?php echo esc_html( $delta['label'] ); ?></span>
						</article>
					<?php endforeach; ?>
				</div>
			</section>

			<div class="nexus-seo-cockpit__grid nexus-seo-cockpit__grid--reports">
				<section class="nexus-seo-cockpit__panel">
					<div class="nexus-seo-cockpit__panel-head">
						<h2>Top Pages</h2>
					</div>
					<table class="widefat striped nexus-seo-cockpit__table">
						<thead>
							<tr>
								<th>URL</th>
								<th>Klicks</th>
								<th>Impressionen</th>
								<th>CTR</th>
								<th>Position</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $snapshot['top_pages'] as $row ) : ?>
								<tr>
									<td><code><?php echo esc_html( nexus_get_seo_cockpit_row_label( $row ) ); ?></code></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['clicks'] ?? 0 ) ) ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['impressions'] ?? 0 ) ) ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( ( $row['ctr'] ?? 0 ) * 100 ), 1 ) . '%' ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['position'] ?? 0 ), 1 ) ); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</section>

				<section class="nexus-seo-cockpit__panel">
					<div class="nexus-seo-cockpit__panel-head">
						<h2>Top Queries</h2>
					</div>
					<table class="widefat striped nexus-seo-cockpit__table">
						<thead>
							<tr>
								<th>Query</th>
								<th>Klicks</th>
								<th>Impressionen</th>
								<th>CTR</th>
								<th>Position</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $snapshot['top_queries'] as $row ) : ?>
								<tr>
									<td><?php echo esc_html( nexus_get_seo_cockpit_row_label( $row ) ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['clicks'] ?? 0 ) ) ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['impressions'] ?? 0 ) ) ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( ( $row['ctr'] ?? 0 ) * 100 ), 1 ) . '%' ); ?></td>
									<td><?php echo esc_html( number_format_i18n( (float) ( $row['position'] ?? 0 ), 1 ) ); ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</section>
			</div>

			<section class="nexus-seo-cockpit__panel">
				<div class="nexus-seo-cockpit__panel-head">
					<h2>Geraete</h2>
				</div>
				<div class="nexus-seo-cockpit__chips">
					<?php foreach ( $snapshot['top_devices'] as $row ) : ?>
						<span class="nexus-seo-cockpit__chip">
							<?php
							echo esc_html(
								sprintf(
									'%s: %s Klicks',
									strtoupper( nexus_get_seo_cockpit_row_label( $row ) ),
									number_format_i18n( (float) ( $row['clicks'] ?? 0 ) )
								)
							);
							?>
						</span>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Render the cockpit settings page.
 *
 * @return void
 */
function nexus_render_seo_cockpit_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$settings = nexus_get_seo_cockpit_settings();
	$config   = nexus_get_seo_cockpit_search_console_config();
	$source   = [
		'client_id'     => defined( 'NEXUS_GSC_CLIENT_ID' ) && NEXUS_GSC_CLIENT_ID ? 'Konstante' : 'Option',
		'client_secret' => defined( 'NEXUS_GSC_CLIENT_SECRET' ) && NEXUS_GSC_CLIENT_SECRET ? 'Konstante' : 'Option',
		'property'      => defined( 'NEXUS_GSC_PROPERTY' ) && NEXUS_GSC_PROPERTY ? 'Konstante' : 'Option',
	];
	?>
	<div class="wrap nexus-seo-cockpit">
		<h1>SEO Cockpit Einstellungen</h1>
		<form method="post" action="options.php" class="nexus-seo-cockpit__settings-form">
			<?php settings_fields( 'nexus_seo_cockpit_settings' ); ?>

			<section class="nexus-seo-cockpit__panel">
				<h2>Google Search Console</h2>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<th scope="row"><label for="nexus-seo-property">Property</label></th>
							<td>
								<input id="nexus-seo-property" name="<?php echo esc_attr( nexus_get_seo_cockpit_option_name() ); ?>[property]" type="text" class="regular-text" value="<?php echo esc_attr( $settings['property'] ); ?>" placeholder="sc-domain:hasimuener.de oder https://hasimuener.de/" <?php disabled( 'Konstante' === $source['property'] ); ?>>
								<p class="description">Aktive Quelle: <?php echo esc_html( $source['property'] ); ?>. Diese Property wird fuer das Dashboard abgefragt.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="nexus-seo-client-id">Client ID</label></th>
							<td>
								<input id="nexus-seo-client-id" name="<?php echo esc_attr( nexus_get_seo_cockpit_option_name() ); ?>[client_id]" type="text" class="regular-text" value="<?php echo esc_attr( $settings['client_id'] ); ?>" <?php disabled( 'Konstante' === $source['client_id'] ); ?>>
								<p class="description">Aktive Quelle: <?php echo esc_html( $source['client_id'] ); ?>. Empfehlung fuer live: als Konstante ausserhalb des Repos setzen.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="nexus-seo-client-secret">Client Secret</label></th>
							<td>
								<input id="nexus-seo-client-secret" name="<?php echo esc_attr( nexus_get_seo_cockpit_option_name() ); ?>[client_secret]" type="password" class="regular-text" value="<?php echo esc_attr( $settings['client_secret'] ); ?>" <?php disabled( 'Konstante' === $source['client_secret'] ); ?>>
								<p class="description">Aktive Quelle: <?php echo esc_html( $source['client_secret'] ); ?>.</p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="nexus-seo-refresh-window">Cache in Stunden</label></th>
							<td>
								<input id="nexus-seo-refresh-window" name="<?php echo esc_attr( nexus_get_seo_cockpit_option_name() ); ?>[refresh_window]" type="number" min="1" max="24" class="small-text" value="<?php echo esc_attr( $settings['refresh_window'] ); ?>">
								<p class="description">Search Console ist nicht echtzeitnah. Ein leichter Cache haelt das Dashboard schnell und stabil.</p>
							</td>
						</tr>
						<tr>
							<th scope="row">Redirect URI</th>
							<td>
								<code><?php echo esc_html( $config['redirect_uri'] ); ?></code>
								<p class="description">Diese URI muss im Google OAuth Client als autorisierte Redirect URI eingetragen sein.</p>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button( 'Einstellungen speichern' ); ?>
			</section>
		</form>
	</div>
	<?php
}
