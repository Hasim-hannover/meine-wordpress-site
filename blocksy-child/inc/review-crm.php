<?php
/**
 * Audit CRM and intake funnel for the Growth Audit.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the internal review status map.
 *
 * @return array<string, string>
 */
function nexus_get_review_status_options() {
	return [
		'new'       => 'Neu',
		'in_review' => 'In Bearbeitung',
		'sent'      => 'Rückmeldung gesendet',
		'won'       => 'Gespräch / Auftrag',
		'archived'  => 'Archiviert',
	];
}

/**
 * Return the priority map for review requests.
 *
 * @return array<string, string>
 */
function nexus_get_review_priority_options() {
	return [
		'normal' => 'Normal',
		'high'   => 'Hoch',
	];
}

/**
 * Return the selectable focus areas from the intake form.
 *
 * @return array<string, string>
 */
function nexus_get_review_focus_area_options() {
	return [
		'seo_visibility'            => 'SEO / Sichtbarkeit',
		'performance_cwv'           => 'Performance / Core Web Vitals',
		'conversion_inquiry_flow'   => 'Conversion / Anfrageführung',
		'tracking_data_quality'     => 'Tracking / Datenqualität',
		'positioning_page_message'  => 'Positionierung / Seitenbotschaft',
		'not_sure_yet'              => 'Ich bin mir noch nicht sicher',
	];
}

/**
 * Return the selectable primary goals from the intake form.
 *
 * @return array<string, string>
 */
function nexus_get_review_primary_goal_options() {
	return [
		'more_qualified_inquiries'         => 'mehr qualifizierte Anfragen',
		'clearer_positioning'              => 'klarere Positionierung',
		'better_google_visibility'         => 'bessere Sichtbarkeit bei Google',
		'better_user_guidance_conversion'  => 'bessere Nutzerführung / Conversion',
		'better_technical_quality'         => 'bessere technische Qualität',
		'clearer_decision_data'            => 'klarere Datenbasis für Entscheidungen',
	];
}

/**
 * Return the supported audit request types.
 *
 * @return array<string, string>
 */
function nexus_get_audit_request_type_options() {
	return [
		'growth_audit'     => 'Growth Audit',
		'growth_blueprint' => 'Growth Blueprint',
		'implementation'   => 'Umsetzung / Retainer',
	];
}

/**
 * Resolve the public calendar URL for audit-related flows.
 *
 * @return string
 */
function nexus_get_audit_calendar_url() {
	$default_url = function_exists( 'nexus_get_audit_url' ) ? nexus_get_audit_url() : home_url( '/growth-audit/' );

	return (string) apply_filters(
		'nexus_audit_calendar_url',
		apply_filters( 'nexus_review_calendar_url', $default_url )
	);
}

/**
 * Resolve the internal notification recipient for audit requests.
 *
 * @return string
 */
function nexus_get_audit_notification_email() {
	$default = (string) apply_filters( 'nexus_review_notification_email', get_option( 'admin_email' ) );

	return (string) apply_filters( 'nexus_audit_notification_email', $default );
}

/**
 * Return the first non-empty meta value from a list of keys.
 *
 * @param int          $post_id  Current post ID.
 * @param array|string $keys     Meta key or fallback key list.
 * @param string       $default  Default value.
 * @return string
 */
function nexus_get_review_meta_value( $post_id, $keys, $default = '' ) {
	foreach ( (array) $keys as $key ) {
		$value = (string) get_post_meta( $post_id, $key, true );
		if ( '' !== trim( $value ) ) {
			return $value;
		}
	}

	return $default;
}

/**
 * Register the internal CRM post type.
 *
 * @return void
 */
function nexus_register_review_request_post_type() {
	register_post_type(
		'nexus_review_request',
		[
			'labels' => [
				'name'               => 'Audit-Anfragen',
				'singular_name'      => 'Audit-Anfrage',
				'menu_name'          => 'Audit-Anfragen',
				'name_admin_bar'     => 'Audit-Anfrage',
				'add_new'            => 'Neu',
				'add_new_item'       => 'Neue Audit-Anfrage',
				'edit_item'          => 'Audit-Anfrage bearbeiten',
				'new_item'           => 'Neue Audit-Anfrage',
				'view_item'          => 'Audit-Anfrage ansehen',
				'search_items'       => 'Audit-Anfragen suchen',
				'not_found'          => 'Keine Audit-Anfragen gefunden.',
				'not_found_in_trash' => 'Keine Audit-Anfragen im Papierkorb.',
				'all_items'          => 'Alle Audit-Anfragen',
			],
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm',
			'show_in_admin_bar'   => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'rewrite'             => false,
			'query_var'           => false,
			'map_meta_cap'        => true,
			'menu_icon'           => 'dashicons-clipboard',
			'supports'            => [ 'title' ],
		]
	);
}
add_action( 'init', 'nexus_register_review_request_post_type' );

/**
 * Register the top-level CRM menu.
 *
 * @return void
 */
function nexus_register_review_crm_menu() {
	add_menu_page(
		'Nexus CRM',
		'Nexus CRM',
		'edit_pages',
		function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm',
		'nexus_render_review_crm_dashboard',
		'dashicons-clipboard',
		58
	);

	add_submenu_page(
		function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm',
		'Nexus CRM',
		'Übersicht',
		'edit_pages',
		function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm',
		'nexus_render_review_crm_dashboard'
	);
}
add_action( 'admin_menu', 'nexus_register_review_crm_menu' );

/**
 * Redirect the previous audit-only CRM slug to the shared CRM dashboard.
 *
 * @return void
 */
function nexus_redirect_legacy_review_crm_menu() {
	if ( ! is_admin() ) {
		return;
	}

	$page = isset( $_GET['page'] ) ? sanitize_key( (string) wp_unslash( $_GET['page'] ) ) : '';

	if ( 'nexus-review-crm' !== $page ) {
		return;
	}

	wp_safe_redirect( admin_url( 'admin.php?page=' . ( function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm' ) ) );
	exit;
}
add_action( 'admin_init', 'nexus_redirect_legacy_review_crm_menu' );

/**
 * Enqueue the admin styles for CRM screens.
 *
 * @param string $hook Current admin hook suffix.
 * @return void
 */
function nexus_enqueue_review_crm_admin_assets( $hook ) {
	$screen = get_current_screen();
	if ( ! $screen ) {
		return;
	}

	$is_crm_dashboard = 'toplevel_page_nexus-crm' === $hook || 'nexus-crm_page_edit-php' === $hook;
	$is_review_screen = in_array( $screen->post_type, [ 'nexus_review_request', 'nexus_contact' ], true );
	$is_wp_dashboard  = 'dashboard' === $screen->base;

	if ( ! $is_crm_dashboard && ! $is_review_screen && ! $is_wp_dashboard ) {
		return;
	}

	$path = get_stylesheet_directory() . '/assets/css/review-crm-admin.css';
	if ( file_exists( $path ) ) {
		wp_enqueue_style(
			'nexus-review-crm-admin',
			get_stylesheet_directory_uri() . '/assets/css/review-crm-admin.css',
			[],
			filemtime( $path )
		);
	}
}
add_action( 'admin_enqueue_scripts', 'nexus_enqueue_review_crm_admin_assets' );

/**
 * Register the public REST route for the multi-step intake form.
 *
 * @return void
 */
function nexus_register_review_crm_rest_routes() {
	$routes = [
		'/audit-request',
		'/review-request',
	];

	foreach ( $routes as $route ) {
		register_rest_route(
			'nexus/v1',
			$route,
			[
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => 'nexus_handle_review_request_submission',
				'permission_callback' => '__return_true',
			]
		);
	}
}
add_action( 'rest_api_init', 'nexus_register_review_crm_rest_routes' );

/**
 * Handle incoming review requests from the public multi-step funnel.
 *
 * @param WP_REST_Request $request REST request object.
 * @return WP_REST_Response
 */
function nexus_handle_review_request_submission( WP_REST_Request $request ) {
	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) || empty( $payload ) ) {
		$payload = $request->get_body_params();
	}

	$honeypot = isset( $payload['company_website'] ) ? trim( (string) $payload['company_website'] ) : '';
	if ( '' !== $honeypot ) {
		return new WP_REST_Response(
			[
				'ok'      => true,
				'message' => 'Anfrage gespeichert.',
			],
			200
		);
	}

	$rate_limit_error = nexus_validate_review_request_rate_limit();
	if ( is_wp_error( $rate_limit_error ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $rate_limit_error->get_error_message(),
			],
			429
		);
	}

	$validated = nexus_validate_review_request_payload( $payload );
	if ( is_wp_error( $validated ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $validated->get_error_message(),
			],
			400
		);
	}

	$post_id = nexus_create_review_request_post( $validated );
	if ( is_wp_error( $post_id ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => 'Die Anfrage konnte gerade nicht gespeichert werden. Bitte später erneut versuchen.',
			],
			500
		);
	}

	nexus_send_review_request_admin_notification( $post_id, $validated );
	nexus_send_review_request_confirmation( $validated );

	return new WP_REST_Response(
		[
			'ok'          => true,
			'requestId'   => $post_id,
			'message'     => 'Ich prüfe Ihre Seite manuell und ergänze die Einschätzung durch KI-gestützte Analyse. Sie erhalten innerhalb von 48 Stunden eine persönliche Rückmeldung.',
			'editUrl'     => get_edit_post_link( $post_id, 'raw' ),
			'status'      => 'received',
			'statusLabel' => 'Neu',
			'auditType'   => $validated['audit_type'],
		],
		201
	);
}

/**
 * Validate and sanitize the review request payload.
 *
 * @param array $payload Raw request payload.
 * @return array|WP_Error
 */
function nexus_validate_review_request_payload( $payload ) {
	$type_options      = nexus_get_audit_request_type_options();
	$focus_area_map    = nexus_get_review_focus_area_options();
	$primary_goal_map  = nexus_get_review_primary_goal_options();
	$audit_type        = isset( $payload['audit_type'] ) ? sanitize_key( (string) $payload['audit_type'] ) : 'growth_audit';
	$page_url          = isset( $payload['page_url'] ) ? trim( (string) $payload['page_url'] ) : '';
	$company           = isset( $payload['company'] ) ? sanitize_text_field( (string) $payload['company'] ) : '';
	$focus_area        = isset( $payload['focus_area'] ) ? sanitize_key( (string) $payload['focus_area'] ) : '';
	$current_challenge = isset( $payload['current_challenge'] ) ? sanitize_textarea_field( (string) $payload['current_challenge'] ) : '';
	$primary_goal      = isset( $payload['primary_goal'] ) ? sanitize_key( (string) $payload['primary_goal'] ) : '';
	$extra_context     = isset( $payload['extra_context'] ) ? sanitize_textarea_field( (string) $payload['extra_context'] ) : '';
	$name              = isset( $payload['name'] ) ? sanitize_text_field( (string) $payload['name'] ) : '';
	$email             = isset( $payload['email'] ) ? sanitize_email( (string) $payload['email'] ) : '';
	$linkedin          = isset( $payload['linkedin'] ) ? trim( (string) $payload['linkedin'] ) : '';
	$consent_privacy   = isset( $payload['consent_privacy'] ) ? sanitize_key( (string) $payload['consent_privacy'] ) : '';

	if ( empty( $page_url ) ) {
		return new WP_Error( 'missing_page_url', 'Bitte die URL der Seite angeben.' );
	}

	$page_url = esc_url_raw( $page_url );
	if ( ! $page_url || ! wp_http_validate_url( $page_url ) ) {
		return new WP_Error( 'invalid_page_url', 'Bitte eine gültige URL angeben, z. B. https://example.de.' );
	}

	$scheme = wp_parse_url( $page_url, PHP_URL_SCHEME );
	if ( ! in_array( $scheme, [ 'http', 'https' ], true ) ) {
		return new WP_Error( 'invalid_scheme', 'Nur http- oder https-URLs sind erlaubt.' );
	}

	if ( empty( $focus_area ) || ! isset( $focus_area_map[ $focus_area ] ) ) {
		return new WP_Error( 'missing_focus_area', 'Bitte den Bereich mit dem größten Klärungsbedarf auswählen.' );
	}

	if ( empty( $primary_goal ) || ! isset( $primary_goal_map[ $primary_goal ] ) ) {
		return new WP_Error( 'missing_primary_goal', 'Bitte das wichtigste Ziel für diese Seite auswählen.' );
	}

	if ( empty( $name ) ) {
		return new WP_Error( 'missing_name', 'Bitte Ihren Namen angeben.' );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		return new WP_Error( 'invalid_email', 'Bitte eine gültige geschäftliche E-Mail-Adresse angeben.' );
	}

	if ( 'accepted' !== $consent_privacy ) {
		return new WP_Error( 'missing_consent_privacy', 'Bitte bestätigen Sie den Datenschutzhinweis, damit ich Ihre Anfrage bearbeiten darf.' );
	}

	if ( '' !== $linkedin ) {
		$linkedin = esc_url_raw( $linkedin );

		if ( ! $linkedin || ! wp_http_validate_url( $linkedin ) ) {
			return new WP_Error( 'invalid_linkedin', 'Bitte eine gültige LinkedIn-URL angeben oder das Feld leer lassen.' );
		}

		$linkedin_scheme = wp_parse_url( $linkedin, PHP_URL_SCHEME );
		if ( ! in_array( $linkedin_scheme, [ 'http', 'https' ], true ) ) {
			return new WP_Error( 'invalid_linkedin_scheme', 'Bitte eine gültige LinkedIn-URL mit http oder https angeben.' );
		}
	}

	if ( empty( $audit_type ) || ! isset( $type_options[ $audit_type ] ) ) {
		$audit_type = 'growth_audit';
	}

	$ads_source  = isset( $payload['ads_source'] ) ? sanitize_text_field( (string) $payload['ads_source'] ) : '';
	$ads_keyword = isset( $payload['ads_keyword'] ) ? sanitize_text_field( (string) $payload['ads_keyword'] ) : '';

	return [
		'audit_type'        => $audit_type,
		'audit_type_label'  => $type_options[ $audit_type ],
		'page_url'          => $page_url,
		'domain'            => (string) wp_parse_url( $page_url, PHP_URL_HOST ),
		'company'           => $company,
		'focus_area'        => $focus_area,
		'focus_area_label'  => $focus_area_map[ $focus_area ],
		'current_challenge' => $current_challenge,
		'primary_goal'      => $primary_goal,
		'primary_goal_label' => $primary_goal_map[ $primary_goal ],
		'extra_context'     => $extra_context,
		'name'              => $name,
		'email'             => $email,
		'linkedin'          => $linkedin,
		'consent_privacy'   => $consent_privacy,
		'ads_source'        => $ads_source,
		'ads_keyword'       => $ads_keyword,
	];
}

/**
 * Create the CRM post entry for a new request.
 *
 * @param array $payload Validated payload.
 * @return int|WP_Error
 */
function nexus_create_review_request_post( $payload ) {
	$title_parts = array_filter(
		[
			$payload['company'],
			$payload['domain'],
		]
	);

	$post_id = wp_insert_post(
		[
			'post_type'   => 'nexus_review_request',
			'post_status' => 'private',
			'post_title'  => implode( ' - ', $title_parts ),
		],
		true
	);

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	$now = current_time( 'timestamp' );

	update_post_meta( $post_id, '_nexus_review_status', 'new' );
	update_post_meta( $post_id, '_nexus_review_priority', 'normal' );
	update_post_meta( $post_id, '_nexus_review_due_at', $now + ( 48 * HOUR_IN_SECONDS ) );
	update_post_meta( $post_id, '_nexus_review_audit_type', $payload['audit_type'] );
	update_post_meta( $post_id, '_nexus_review_audit_type_label', $payload['audit_type_label'] );
	update_post_meta( $post_id, '_nexus_review_page_url', $payload['page_url'] );
	update_post_meta( $post_id, '_nexus_review_domain', $payload['domain'] );
	update_post_meta( $post_id, '_nexus_review_focus_area', $payload['focus_area'] );
	update_post_meta( $post_id, '_nexus_review_focus_area_label', $payload['focus_area_label'] );
	update_post_meta( $post_id, '_nexus_review_current_challenge', $payload['current_challenge'] );
	update_post_meta( $post_id, '_nexus_review_primary_goal', $payload['primary_goal'] );
	update_post_meta( $post_id, '_nexus_review_primary_goal_label', $payload['primary_goal_label'] );
	update_post_meta( $post_id, '_nexus_review_extra_context', $payload['extra_context'] );
	update_post_meta( $post_id, '_nexus_review_name', $payload['name'] );
	update_post_meta( $post_id, '_nexus_review_email', $payload['email'] );
	update_post_meta( $post_id, '_nexus_review_company', $payload['company'] );
	update_post_meta( $post_id, '_nexus_review_linkedin', $payload['linkedin'] );
	update_post_meta( $post_id, '_nexus_review_consent_privacy', $payload['consent_privacy'] );
	update_post_meta( $post_id, '_nexus_review_source', 'growth_audit_funnel' );
	update_post_meta( $post_id, '_nexus_review_ads_source', sanitize_text_field( (string) ( $payload['ads_source'] ?? '' ) ) );
	update_post_meta( $post_id, '_nexus_review_ads_keyword', sanitize_text_field( (string) ( $payload['ads_keyword'] ?? '' ) ) );

	return (int) $post_id;
}

/**
 * Basic per-IP rate limit for public submissions.
 *
 * @return true|WP_Error
 */
function nexus_validate_review_request_rate_limit() {
	$ip_address = nexus_get_review_request_ip();
	if ( '' === $ip_address ) {
		return true;
	}

	$key   = 'nexus_review_rl_' . md5( $ip_address . gmdate( 'YmdH' ) );
	$count = (int) get_transient( $key );

	if ( $count >= 10 ) {
		return new WP_Error( 'rate_limited', 'Zu viele Anfragen in kurzer Zeit. Bitte später erneut versuchen.' );
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	return true;
}

/**
 * Resolve the current request IP for transient-based rate limiting.
 *
 * @return string
 */
function nexus_get_review_request_ip() {
	$candidates = [
		'HTTP_X_FORWARDED_FOR',
		'REMOTE_ADDR',
	];

	foreach ( $candidates as $candidate ) {
		if ( empty( $_SERVER[ $candidate ] ) ) {
			continue;
		}

		$value = (string) wp_unslash( $_SERVER[ $candidate ] );
		if ( 'HTTP_X_FORWARDED_FOR' === $candidate ) {
			$parts = explode( ',', $value );
			$value = trim( (string) reset( $parts ) );
		}

		$value = sanitize_text_field( $value );
		if ( '' !== $value ) {
			return $value;
		}
	}

	return '';
}

/**
 * Append Brevo mail tags to a wp_mail header array.
 *
 * @param array $headers Existing headers.
 * @param array $tags    Tag list.
 * @return array<int, string>
 */
function nexus_append_mail_tags_header( $headers, $tags ) {
	$headers = (array) $headers;
	$tags    = array_values(
		array_unique(
			array_filter(
				array_map(
					static function( $tag ) {
						return sanitize_key( (string) $tag );
					},
					(array) $tags
				)
			)
		)
	);

	if ( empty( $tags ) ) {
		return $headers;
	}

	$headers[] = 'X-Nexus-Brevo-Tags: ' . implode( ',', $tags );

	return $headers;
}

/**
 * Send an HTML transactional email via wp_mail.
 *
 * @param string $recipient Recipient email.
 * @param string $subject   Email subject.
 * @param string $html      Email HTML body.
 * @param array  $headers   Optional additional headers.
 * @return void
 */
function nexus_send_transactional_html_mail( $recipient, $subject, $html, $headers = [] ) {
	if ( ! $recipient || ! is_email( $recipient ) || '' === trim( (string) $html ) ) {
		return;
	}

	$headers   = (array) $headers;
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	wp_mail( $recipient, $subject, $html, $headers );
}

/**
 * Backward-compatible wrapper for audit mail sends.
 *
 * @param string $recipient Recipient email.
 * @param string $subject   Email subject.
 * @param string $html      Email HTML body.
 * @param array  $headers   Optional additional headers.
 * @return void
 */
function nexus_send_audit_html_mail( $recipient, $subject, $html, $headers = [] ) {
	nexus_send_transactional_html_mail( $recipient, $subject, $html, $headers );
}

/**
 * Wrap transactional emails in a consistent branded shell.
 *
 * @param array $args Email arguments.
 * @return string
 */
function nexus_get_transactional_email_shell( $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'preheader' => '',
			'eyebrow'   => wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ),
			'headline'  => '',
			'intro'     => '',
			'content'   => '',
			'footer'    => 'Antworten Sie bei Rückfragen einfach auf diese E-Mail.',
		]
	);

	ob_start();
	?>
	<!doctype html>
	<html lang="de">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo esc_html( $args['headline'] ); ?></title>
	</head>
	<body style="margin:0; padding:0; background:#f3ede6; color:#15181d;">
		<div style="display:none; max-height:0; overflow:hidden; opacity:0; mso-hide:all;">
			<?php echo esc_html( $args['preheader'] ); ?>
		</div>
		<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background:#f3ede6; padding:24px 12px;">
			<tr>
				<td align="center">
					<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:640px;">
						<tr>
							<td style="padding:0 0 12px 0; text-align:left; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:1.5; letter-spacing:0.12em; text-transform:uppercase; color:#7f756b;">
								<?php echo esc_html( $args['eyebrow'] ); ?>
							</td>
						</tr>
						<tr>
							<td style="border:1px solid #ddd2c6; border-radius:24px; background:#14191f; padding:32px 28px; box-shadow:0 18px 50px rgba(20, 25, 31, 0.14);">
								<div style="display:inline-block; margin:0 0 16px 0; padding:6px 12px; border-radius:999px; background:rgba(180,106,60,0.12); border:1px solid rgba(180,106,60,0.25); font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:1.4; letter-spacing:0.1em; text-transform:uppercase; color:#d3a98c;">
									<?php echo esc_html( $args['eyebrow'] ); ?>
								</div>
								<h1 style="margin:0 0 12px 0; font-family:Helvetica, Arial, sans-serif; font-size:30px; line-height:1.12; font-weight:800; color:#f7f3ee;">
									<?php echo esc_html( $args['headline'] ); ?>
								</h1>
								<p style="margin:0 0 24px 0; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:1.7; color:#c5ced7;">
									<?php echo esc_html( $args['intro'] ); ?>
								</p>
								<?php echo $args['content']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</td>
						</tr>
						<tr>
							<td style="padding:14px 6px 0; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:1.7; color:#7f756b; text-align:left;">
								<?php echo esc_html( $args['footer'] ); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>
	<?php

	return trim( ob_get_clean() );
}

/**
 * Backward-compatible wrapper for audit email shell rendering.
 *
 * @param array $args Email arguments.
 * @return string
 */
function nexus_get_audit_email_shell( $args = [] ) {
	return nexus_get_transactional_email_shell( $args );
}

/**
 * Send the internal notification email for a new request.
 *
 * @param int   $post_id Request post ID.
 * @param array $payload Validated payload.
 * @return void
 */
function nexus_send_review_request_admin_notification( $post_id, $payload ) {
	$recipient = nexus_get_audit_notification_email();
	if ( ! $recipient || ! is_email( $recipient ) ) {
		return;
	}

	$lead_label = $payload['company'] ? $payload['company'] : ( $payload['domain'] ? $payload['domain'] : $payload['name'] );
	$subject    = sprintf(
		'[%s] Neue Anfrage - %s',
		$payload['audit_type_label'],
		$lead_label
	);
	$edit_url = admin_url( 'post.php?post=' . $post_id . '&action=edit' );
	$page_url = $payload['page_url'];
	$headers  = [];

	if ( ! empty( $payload['email'] ) && is_email( $payload['email'] ) ) {
		$headers[] = 'Reply-To: ' . $payload['email'];
	}

	$headers = nexus_append_mail_tags_header(
		$headers,
		[
			'audit_request',
			'internal_notification',
			sanitize_key( (string) $payload['audit_type'] ),
		]
	);

	$context_line = ! empty( $payload['current_challenge'] )
		? '<strong style="color:#f7f3ee;">Kurzkontext:</strong> ' . esc_html( $payload['current_challenge'] ) . '<br>'
		: '';

	$extra_context_line = ! empty( $payload['extra_context'] )
		? '<br><strong style="color:#f7f3ee;">Nicht übersehen:</strong> ' . esc_html( $payload['extra_context'] )
		: '';

	$content = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px 0;">
			<tr>
				<td style="padding:0 0 12px 0;">
					<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:separate; border-spacing:0 10px;">
						<tr>
							<td style="width:50%%; padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
								<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:6px;">Lead</div>
								<div style="font-size:16px; line-height:1.5; color:#f7f3ee; font-weight:700;">%1$s</div>
								<div style="font-size:14px; line-height:1.6; color:#c5ced7;">%2$s<br>%3$s%4$s</div>
							</td>
							<td style="width:50%%; padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
								<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:6px;">Audit</div>
								<div style="font-size:16px; line-height:1.5; color:#f7f3ee; font-weight:700;">%5$s</div>
								<div style="font-size:14px; line-height:1.6; color:#c5ced7;">%6$s</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 18px 0; border-collapse:collapse;">
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Intake</div>
					<div style="font-size:14px; line-height:1.75; color:#c5ced7;">
						<strong style="color:#f7f3ee;">URL:</strong> %7$s<br>
						<strong style="color:#f7f3ee;">Bereich:</strong> %8$s<br>
						%9$s<strong style="color:#f7f3ee;">Wichtigstes Ziel:</strong> %10$s%11$s
					</div>
				</td>
			</tr>
		</table>
		<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0">
			<tr>
				<td style="padding:0 12px 0 0;">
					<a href="%12$s" style="display:inline-block; padding:14px 18px; border-radius:14px; background:#b46a3c; color:#fff8f3; text-decoration:none; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:700;">Im CRM öffnen</a>
				</td>
				<td>
					<a href="%13$s" style="display:inline-block; padding:14px 18px; border-radius:14px; border:1px solid rgba(255,255,255,0.12); color:#f7f3ee; text-decoration:none; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:700;">Seite ansehen</a>
				</td>
			</tr>
		</table>',
		esc_html( $lead_label ),
		esc_html( $payload['name'] ),
		esc_html( $payload['email'] ),
		! empty( $payload['linkedin'] ) ? '<br><a href="' . esc_url( $payload['linkedin'] ) . '" style="color:#d3a98c; text-decoration:none;">LinkedIn</a>' : '',
		esc_html( $payload['audit_type_label'] ),
		esc_html( 'Persönliche Rückmeldung spätestens in 48h' ),
		esc_html( $page_url ),
		esc_html( $payload['focus_area_label'] ),
		$context_line,
		esc_html( $payload['primary_goal_label'] ),
		$extra_context_line,
		esc_url( $edit_url ),
		esc_url( $page_url )
	);

	$ads_source_label  = ! empty( $payload['ads_source'] ) ? $payload['ads_source'] : 'Organisch/Direkt';
	$ads_keyword_label = ! empty( $payload['ads_keyword'] ) ? $payload['ads_keyword'] : 'Keines';

	$content .= sprintf(
		'<table role="presentation" width="100%%%%" cellspacing="0" cellpadding="0" border="0" style="margin:18px 0 0 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Tracking Info</div>
					<div style="font-size:14px; line-height:1.75; color:#c5ced7;">
						<strong style="color:#f7f3ee;">Quelle:</strong> %1$s<br>
						<strong style="color:#f7f3ee;">Keyword:</strong> %2$s
					</div>
				</td>
			</tr>
		</table>',
		esc_html( $ads_source_label ),
		esc_html( $ads_keyword_label )
	);

	$html = nexus_get_transactional_email_shell(
		[
			'preheader' => 'Neue Audit-Anfrage von ' . $lead_label,
			'eyebrow'   => $payload['audit_type_label'],
			'headline'  => 'Neue Audit-Anfrage',
			'intro'     => 'Ein neuer Lead ist eingegangen. Seite, Fokus und Ziel sind unten kompakt zusammengefasst.',
			'content'   => $content,
			'footer'    => 'Sie können direkt auf diese E-Mail antworten. Reply-To zeigt bereits auf den Lead.',
		]
	);

	nexus_send_audit_html_mail( $recipient, $subject, $html, $headers );
}

/**
 * Send a short confirmation email to the requester.
 *
 * @param array $payload Validated payload.
 * @return void
 */
function nexus_send_review_request_confirmation( $payload ) {
	if ( empty( $payload['email'] ) || ! is_email( $payload['email'] ) ) {
		return;
	}

	$reply_to = nexus_get_audit_notification_email();
	$subject  = sprintf( '[%s] %s angefragt', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $payload['audit_type_label'] );

	$context_line = ! empty( $payload['current_challenge'] )
		? '<strong style="color:#f7f3ee;">Kurzkontext:</strong> ' . esc_html( $payload['current_challenge'] ) . '<br>'
		: '';

	$extra_context_line = ! empty( $payload['extra_context'] )
		? '<br><strong style="color:#f7f3ee;">Nicht übersehen:</strong> ' . esc_html( $payload['extra_context'] )
		: '';

	$content  = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:6px;">Was jetzt passiert</div>
					<div style="font-size:14px; line-height:1.8; color:#c5ced7;">
						<strong style="color:#f7f3ee;">1.</strong> Ihre Anfrage ist sauber im System.<br>
						<strong style="color:#f7f3ee;">2.</strong> Ihre Seite wird manuell geprüft und durch KI-gestützte Analyse ergänzt.<br>
						<strong style="color:#f7f3ee;">3.</strong> Innerhalb von 48 Stunden erhalten Sie eine persönliche Rückmeldung mit Priorisierung.
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Ihre Anfrage</div>
					<div style="font-size:14px; line-height:1.75; color:#c5ced7;">
						<strong style="color:#f7f3ee;">Seite:</strong> %1$s<br>
						<strong style="color:#f7f3ee;">Bereich:</strong> %2$s<br>
						%3$s<strong style="color:#f7f3ee;">Wichtigstes Ziel:</strong> %4$s%5$s
					</div>
				</td>
			</tr>
		</table>
		<p style="margin:0; font-family:Helvetica, Arial, sans-serif; font-size:14px; line-height:1.8; color:#c5ced7;">
			Sie müssen jetzt nichts weiter vorbereiten. Wenn es eine Frist, Kampagne oder interne Deadline gibt,
			antworten Sie einfach kurz auf diese E-Mail.
		</p>',
		esc_html( $payload['page_url'] ),
		esc_html( $payload['focus_area_label'] ),
		$context_line,
		esc_html( $payload['primary_goal_label'] ),
		$extra_context_line
	);

	$html = nexus_get_audit_email_shell(
		[
			'preheader' => 'Ihre Anfrage für den ' . $payload['audit_type_label'] . ' ist eingegangen.',
			'eyebrow'   => $payload['audit_type_label'],
			'headline'  => 'Ihr ' . $payload['audit_type_label'] . ' ist im System.',
			'intro'     => 'Danke, ' . $payload['name'] . '. Sie erhalten keine generische Checkliste, sondern eine persönliche erste Priorisierung für Ihre Seite.',
			'content'   => $content,
			'footer'    => 'Viele Grüße, Haşim Üner',
		]
	);

	$headers = [];
	if ( $reply_to && is_email( $reply_to ) ) {
		$headers[] = 'Reply-To: ' . $reply_to;
	}

	$headers = nexus_append_mail_tags_header(
		$headers,
		[
			'audit_request',
			'lead_confirmation',
			sanitize_key( (string) $payload['audit_type'] ),
		]
	);

	nexus_send_audit_html_mail( $payload['email'], $subject, $html, $headers );
}

/**
 * Register the admin meta boxes for request handling.
 *
 * @return void
 */
function nexus_register_review_request_meta_boxes() {
	add_meta_box(
		'nexus-review-request-details',
		'Anfrage',
		'nexus_render_review_request_details_meta_box',
		'nexus_review_request',
		'normal',
		'high'
	);

	add_meta_box(
		'nexus-review-request-workflow',
		'CRM-Workflow',
		'nexus_render_review_request_workflow_meta_box',
		'nexus_review_request',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes_nexus_review_request', 'nexus_register_review_request_meta_boxes' );

/**
 * Render the read-only request detail box.
 *
 * @param WP_Post $post Current post object.
 * @return void
 */
function nexus_render_review_request_details_meta_box( $post ) {
	$audit_type        = (string) get_post_meta( $post->ID, '_nexus_review_audit_type_label', true );
	$page_url          = (string) get_post_meta( $post->ID, '_nexus_review_page_url', true );
	$focus_area_label  = nexus_get_review_meta_value( $post->ID, '_nexus_review_focus_area_label' );
	$current_challenge = nexus_get_review_meta_value( $post->ID, '_nexus_review_current_challenge' );
	$primary_goal_label = nexus_get_review_meta_value( $post->ID, '_nexus_review_primary_goal_label' );
	$linkedin          = nexus_get_review_meta_value( $post->ID, '_nexus_review_linkedin' );
	$extra_context     = (string) get_post_meta( $post->ID, '_nexus_review_extra_context', true );
	$name              = (string) get_post_meta( $post->ID, '_nexus_review_name', true );
	$email             = (string) get_post_meta( $post->ID, '_nexus_review_email', true );
	$company           = (string) get_post_meta( $post->ID, '_nexus_review_company', true );
	$consent_privacy   = (string) get_post_meta( $post->ID, '_nexus_review_consent_privacy', true );
	$offer             = (string) get_post_meta( $post->ID, '_nexus_review_offer', true );
	$audience          = (string) get_post_meta( $post->ID, '_nexus_review_audience', true );
	$issue_label       = (string) get_post_meta( $post->ID, '_nexus_review_biggest_issue_label', true );
	$has_new_intake    = '' !== trim( $focus_area_label . $current_challenge . $primary_goal_label . $linkedin );
	?>
	<div class="nexus-review-meta">
		<div class="nexus-review-meta-group">
			<strong>Audit-Typ</strong>
			<p><?php echo esc_html( $audit_type ?: 'Growth Audit' ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Unternehmen</strong>
			<p><?php echo esc_html( $company ?: 'Nicht angegeben' ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Kontakt</strong>
			<p><?php echo esc_html( $name ); ?><br><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Datenschutzhinweis</strong>
			<p><?php echo esc_html( 'accepted' === $consent_privacy ? 'Bestätigt' : 'Fehlt' ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Seite</strong>
			<p><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page_url ); ?></a></p>
		</div>

		<?php if ( $has_new_intake ) : ?>
			<div class="nexus-review-meta-group">
				<strong>Bereich mit Klärungsbedarf</strong>
				<p><?php echo esc_html( $focus_area_label ); ?></p>
			</div>
			<?php if ( '' !== $current_challenge ) : ?>
				<div class="nexus-review-meta-group">
					<strong>Kurzkontext</strong>
					<p><?php echo nl2br( esc_html( $current_challenge ) ); ?></p>
				</div>
			<?php endif; ?>
			<div class="nexus-review-meta-group">
				<strong>Wichtigstes Ziel</strong>
				<p><?php echo esc_html( $primary_goal_label ); ?></p>
			</div>
			<?php if ( '' !== $linkedin ) : ?>
				<div class="nexus-review-meta-group">
					<strong>LinkedIn</strong>
					<p><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $linkedin ); ?></a></p>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<div class="nexus-review-meta-group">
				<strong>Was soll die Seite verkaufen?</strong>
				<p><?php echo nl2br( esc_html( $offer ) ); ?></p>
			</div>
			<div class="nexus-review-meta-group">
				<strong>Wen soll die Seite überzeugen?</strong>
				<p><?php echo nl2br( esc_html( $audience ) ); ?></p>
			</div>
			<div class="nexus-review-meta-group">
				<strong>Größter Blocker</strong>
				<p><?php echo esc_html( $issue_label ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( '' !== $extra_context ) : ?>
			<div class="nexus-review-meta-group">
				<strong>Nicht übersehen</strong>
				<p><?php echo nl2br( esc_html( $extra_context ) ); ?></p>
			</div>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Render the editable workflow meta box.
 *
 * @param WP_Post $post Current post object.
 * @return void
 */
function nexus_render_review_request_workflow_meta_box( $post ) {
	$status_options   = nexus_get_review_status_options();
	$priority_options = nexus_get_review_priority_options();
	$current_status   = (string) get_post_meta( $post->ID, '_nexus_review_status', true );
	$current_priority = (string) get_post_meta( $post->ID, '_nexus_review_priority', true );
	$delivery_url     = (string) get_post_meta( $post->ID, '_nexus_review_delivery_url', true );
	$internal_notes   = (string) get_post_meta( $post->ID, '_nexus_review_internal_notes', true );
	$due_at           = (int) get_post_meta( $post->ID, '_nexus_review_due_at', true );
	$sent_at          = (int) get_post_meta( $post->ID, '_nexus_review_sent_at', true );

	wp_nonce_field( 'nexus_save_review_request_workflow', 'nexus_review_request_workflow_nonce' );
	?>
	<p>
		<label for="nexus-review-status"><strong>Status</strong></label><br>
		<select id="nexus-review-status" name="nexus_review_status" class="widefat">
			<?php foreach ( $status_options as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_status, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label for="nexus-review-priority"><strong>Priorität</strong></label><br>
		<select id="nexus-review-priority" name="nexus_review_priority" class="widefat">
			<?php foreach ( $priority_options as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_priority, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<strong>Fälligkeitsziel</strong><br>
		<span><?php echo esc_html( $due_at ? wp_date( 'd.m.Y H:i', $due_at ) : 'n/a' ); ?></span>
	</p>
	<p>
		<strong>Rückmeldung gesendet</strong><br>
		<span><?php echo esc_html( $sent_at ? wp_date( 'd.m.Y H:i', $sent_at ) : 'Noch nicht markiert' ); ?></span>
	</p>
	<p>
		<label for="nexus-review-delivery-url"><strong>Audit-Link / Loom</strong></label><br>
		<input id="nexus-review-delivery-url" name="nexus_review_delivery_url" type="url" class="widefat" value="<?php echo esc_attr( $delivery_url ); ?>" placeholder="https://...">
	</p>
	<p>
		<label for="nexus-review-internal-notes"><strong>Interne Notizen</strong></label><br>
		<textarea id="nexus-review-internal-notes" name="nexus_review_internal_notes" class="widefat" rows="8"><?php echo esc_textarea( $internal_notes ); ?></textarea>
	</p>
	<?php
}

/**
 * Persist the workflow fields from the CRM meta box.
 *
 * @param int $post_id Current post ID.
 * @return void
 */
function nexus_save_review_request_workflow_meta( $post_id ) {
	if ( empty( $_POST['nexus_review_request_workflow_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexus_review_request_workflow_nonce'] ) ), 'nexus_save_review_request_workflow' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$status_options   = nexus_get_review_status_options();
	$priority_options = nexus_get_review_priority_options();
	$old_status       = (string) get_post_meta( $post_id, '_nexus_review_status', true );
	$new_status       = isset( $_POST['nexus_review_status'] ) ? sanitize_key( (string) wp_unslash( $_POST['nexus_review_status'] ) ) : $old_status;
	$new_priority     = isset( $_POST['nexus_review_priority'] ) ? sanitize_key( (string) wp_unslash( $_POST['nexus_review_priority'] ) ) : 'normal';
	$delivery_url     = isset( $_POST['nexus_review_delivery_url'] ) ? esc_url_raw( (string) wp_unslash( $_POST['nexus_review_delivery_url'] ) ) : '';
	$internal_notes   = isset( $_POST['nexus_review_internal_notes'] ) ? sanitize_textarea_field( (string) wp_unslash( $_POST['nexus_review_internal_notes'] ) ) : '';

	if ( isset( $status_options[ $new_status ] ) ) {
		update_post_meta( $post_id, '_nexus_review_status', $new_status );
	}

	if ( isset( $priority_options[ $new_priority ] ) ) {
		update_post_meta( $post_id, '_nexus_review_priority', $new_priority );
	}

	update_post_meta( $post_id, '_nexus_review_delivery_url', $delivery_url );
	update_post_meta( $post_id, '_nexus_review_internal_notes', $internal_notes );

	if ( 'sent' === $new_status && 'sent' !== $old_status ) {
		update_post_meta( $post_id, '_nexus_review_sent_at', current_time( 'timestamp' ) );
	}
}
add_action( 'save_post_nexus_review_request', 'nexus_save_review_request_workflow_meta' );

/**
 * Customize the list table columns.
 *
 * @param array $columns Default columns.
 * @return array
 */
function nexus_filter_review_request_columns( $columns ) {
	$columns = [
		'cb'              => $columns['cb'],
		'title'           => 'Lead',
		'audit_type'      => 'Audit',
		'review_status'   => 'Status',
		'review_priority' => 'Priorität',
		'review_page'     => 'Seite',
		'review_goal'     => 'Audit-Fokus',
		'review_contact'  => 'Kontakt',
		'review_due'      => 'Fällig',
		'date'            => $columns['date'],
	];

	return $columns;
}
add_filter( 'manage_nexus_review_request_posts_columns', 'nexus_filter_review_request_columns' );

/**
 * Render the custom list table columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Current post ID.
 * @return void
 */
function nexus_render_review_request_columns( $column, $post_id ) {
	$status_options   = nexus_get_review_status_options();
	$priority_options = nexus_get_review_priority_options();

	switch ( $column ) {
		case 'audit_type':
			echo esc_html( (string) get_post_meta( $post_id, '_nexus_review_audit_type_label', true ) ?: 'Growth Audit' );
			break;

		case 'review_status':
			$status = (string) get_post_meta( $post_id, '_nexus_review_status', true );
			printf(
				'<span class="nexus-review-badge nexus-review-badge-%1$s">%2$s</span>',
				esc_attr( $status ),
				esc_html( $status_options[ $status ] ?? 'Unbekannt' )
			);
			break;

		case 'review_priority':
			$priority = (string) get_post_meta( $post_id, '_nexus_review_priority', true );
			printf(
				'<span class="nexus-review-badge nexus-review-badge-priority-%1$s">%2$s</span>',
				esc_attr( $priority ),
				esc_html( $priority_options[ $priority ] ?? 'Normal' )
			);
			break;

		case 'review_page':
			$page_url = (string) get_post_meta( $post_id, '_nexus_review_page_url', true );
			$domain   = (string) get_post_meta( $post_id, '_nexus_review_domain', true );
			if ( $page_url ) {
				printf(
					'<a href="%1$s" target="_blank" rel="noopener">%2$s</a><div class="nexus-review-muted">%3$s</div>',
					esc_url( $page_url ),
					esc_html( $domain ?: $page_url ),
					esc_html( $page_url )
				);
			}
			break;

		case 'review_goal':
			$focus_area_label   = nexus_get_review_meta_value( $post_id, '_nexus_review_focus_area_label' );
			$primary_goal_label = nexus_get_review_meta_value( $post_id, '_nexus_review_primary_goal_label' );

			if ( $focus_area_label || $primary_goal_label ) {
				echo esc_html( $focus_area_label ?: $primary_goal_label );
				if ( $focus_area_label && $primary_goal_label ) {
					echo '<div class="nexus-review-muted">' . esc_html( $primary_goal_label ) . '</div>';
				}
			} else {
				echo esc_html( wp_trim_words( (string) get_post_meta( $post_id, '_nexus_review_offer', true ), 12 ) );
			}
			break;

		case 'review_contact':
			$company = (string) get_post_meta( $post_id, '_nexus_review_company', true );
			$domain  = (string) get_post_meta( $post_id, '_nexus_review_domain', true );
			$name    = (string) get_post_meta( $post_id, '_nexus_review_name', true );
			$email   = (string) get_post_meta( $post_id, '_nexus_review_email', true );
			echo '<strong>' . esc_html( $company ?: $domain ) . '</strong><br>';
			echo esc_html( $name ) . '<br>';
			echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			break;

		case 'review_due':
			$due_at = (int) get_post_meta( $post_id, '_nexus_review_due_at', true );
			if ( $due_at ) {
				$is_overdue = $due_at < current_time( 'timestamp' );
				printf(
					'<span class="%1$s">%2$s</span>',
					esc_attr( $is_overdue ? 'nexus-review-overdue' : 'nexus-review-due' ),
					esc_html( wp_date( 'd.m.Y H:i', $due_at ) )
				);
			}
			break;
	}
}
add_action( 'manage_nexus_review_request_posts_custom_column', 'nexus_render_review_request_columns', 10, 2 );

/**
 * Add CRM filters above the request list table.
 *
 * @param string $post_type Current post type.
 * @return void
 */
function nexus_render_review_request_filters( $post_type ) {
	if ( 'nexus_review_request' !== $post_type ) {
		return;
	}

	$current_status   = isset( $_GET['nexus_review_status'] ) ? sanitize_key( (string) wp_unslash( $_GET['nexus_review_status'] ) ) : '';
	$current_priority = isset( $_GET['nexus_review_priority'] ) ? sanitize_key( (string) wp_unslash( $_GET['nexus_review_priority'] ) ) : '';
	?>
	<select name="nexus_review_status">
		<option value="">Alle Status</option>
		<?php foreach ( nexus_get_review_status_options() as $value => $label ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_status, $value ); ?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
	<select name="nexus_review_priority">
		<option value="">Alle Prioritäten</option>
		<?php foreach ( nexus_get_review_priority_options() as $value => $label ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_priority, $value ); ?>><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
}
add_action( 'restrict_manage_posts', 'nexus_render_review_request_filters' );

/**
 * Apply CRM filters to the request list query.
 *
 * @param WP_Query $query Query object.
 * @return void
 */
function nexus_filter_review_request_admin_query( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$post_type = $query->get( 'post_type' );
	if ( 'nexus_review_request' !== $post_type ) {
		return;
	}

	$meta_query = (array) $query->get( 'meta_query' );

	if ( ! empty( $_GET['nexus_review_status'] ) ) {
		$meta_query[] = [
			'key'   => '_nexus_review_status',
			'value' => sanitize_key( (string) wp_unslash( $_GET['nexus_review_status'] ) ),
		];
	}

	if ( ! empty( $_GET['nexus_review_priority'] ) ) {
		$meta_query[] = [
			'key'   => '_nexus_review_priority',
			'value' => sanitize_key( (string) wp_unslash( $_GET['nexus_review_priority'] ) ),
		];
	}

	if ( ! empty( $meta_query ) ) {
		$query->set( 'meta_query', $meta_query );
	}

	$query->set( 'orderby', 'date' );
	$query->set( 'order', 'DESC' );
}
add_action( 'pre_get_posts', 'nexus_filter_review_request_admin_query' );

/**
 * Render the custom CRM dashboard page.
 *
 * @return void
 */
function nexus_render_review_crm_dashboard() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		wp_die( 'Keine Berechtigung.' );
	}

	$counts = [
		'audit_new'    => nexus_count_review_requests_by_status( 'new' ),
		'projects'     => function_exists( 'nexus_count_project_requests' ) ? nexus_count_project_requests() : 0,
		'blog_active'  => function_exists( 'nexus_count_active_blog_subscribers' ) ? nexus_count_active_blog_subscribers() : 0,
		'blog_pending' => function_exists( 'nexus_count_pending_blog_subscribers' ) ? nexus_count_pending_blog_subscribers() : 0,
	];

	$recent_audits = get_posts(
		[
			'post_type'              => 'nexus_review_request',
			'post_status'            => 'private',
			'posts_per_page'         => 6,
			'orderby'                => 'date',
			'order'                  => 'DESC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
		]
	);

	$recent_projects = function_exists( 'nexus_get_recent_crm_contacts' )
		? nexus_get_recent_crm_contacts(
			[
				'posts_per_page' => 6,
				'meta_query'     => [
					[
						'key'   => '_nexus_contact_segment_project_request',
						'value' => 1,
					],
				],
			]
		)
		: [];

	$recent_blog_subscribers = function_exists( 'nexus_get_recent_crm_contacts' )
		? nexus_get_recent_crm_contacts(
			[
				'posts_per_page' => 6,
				'meta_query'     => [
					[
						'key'   => '_nexus_contact_segment_blog_notify',
						'value' => 1,
					],
				],
			]
		)
		: [];
	?>
	<div class="wrap nexus-review-dashboard">
		<h1>Nexus CRM</h1>
		<p class="nexus-review-dashboard-intro">Hier laufen Audit-Anfragen, Projektanfragen und Blog-Abos zusammen. WordPress bleibt die zentrale Daten- und Logikschicht; Brevo bleibt reine Zustellungsebene für Transaktionsmails.</p>

		<div class="nexus-review-stats">
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request&nexus_review_status=new' ) ); ?>">
				<span class="nexus-review-stat-label">Audit-Anfragen neu</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['audit_new'] ); ?></strong>
			</a>
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_contact&nexus_contact_segment=project_request' ) ); ?>">
				<span class="nexus-review-stat-label">Projektanfragen</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['projects'] ); ?></strong>
			</a>
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_contact&nexus_contact_segment=blog_notify&nexus_contact_blog_status=active' ) ); ?>">
				<span class="nexus-review-stat-label">Blog-Abos aktiv</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['blog_active'] ); ?></strong>
			</a>
			<div class="nexus-review-stat-card nexus-review-stat-card-warning">
				<span class="nexus-review-stat-label">DOI ausstehend</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['blog_pending'] ); ?></strong>
			</div>
		</div>

		<div class="nexus-review-panel">
			<div class="nexus-review-panel-head">
				<h2>Letzte Audit-Anfragen</h2>
				<a class="button button-secondary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request' ) ); ?>">Alle Audit-Anfragen</a>
			</div>

			<?php if ( empty( $recent_audits ) ) : ?>
				<p>Noch keine Audit-Anfragen vorhanden.</p>
			<?php else : ?>
				<table class="widefat fixed striped nexus-review-table">
					<thead>
						<tr>
							<th>Lead</th>
							<th>Status</th>
							<th>Seite</th>
							<th>Fällig</th>
							<th>Aktion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $recent_audits as $request_post ) : ?>
							<?php
							$status   = (string) get_post_meta( $request_post->ID, '_nexus_review_status', true );
							$company  = (string) get_post_meta( $request_post->ID, '_nexus_review_company', true );
							$domain   = (string) get_post_meta( $request_post->ID, '_nexus_review_domain', true );
							$name     = (string) get_post_meta( $request_post->ID, '_nexus_review_name', true );
							$page_url = (string) get_post_meta( $request_post->ID, '_nexus_review_page_url', true );
							$due_at   = (int) get_post_meta( $request_post->ID, '_nexus_review_due_at', true );
							?>
							<tr>
								<td>
									<strong><?php echo esc_html( $company ?: $domain ); ?></strong><br>
									<span class="nexus-review-muted"><?php echo esc_html( $name ); ?></span>
								</td>
								<td>
									<span class="nexus-review-badge nexus-review-badge-<?php echo esc_attr( $status ); ?>">
										<?php echo esc_html( nexus_get_review_status_options()[ $status ] ?? 'Unbekannt' ); ?>
									</span>
								</td>
								<td><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page_url ); ?></a></td>
								<td>
									<?php if ( $due_at ) : ?>
										<span class="<?php echo esc_attr( $due_at < current_time( 'timestamp' ) ? 'nexus-review-overdue' : 'nexus-review-due' ); ?>">
											<?php echo esc_html( wp_date( 'd.m.Y H:i', $due_at ) ); ?>
										</span>
									<?php endif; ?>
								</td>
								<td><a class="button button-small" href="<?php echo esc_url( get_edit_post_link( $request_post->ID ) ); ?>">Öffnen</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>

		<div class="nexus-review-panel">
			<div class="nexus-review-panel-head">
				<h2>Letzte Projektanfragen</h2>
				<a class="button button-secondary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_contact&nexus_contact_segment=project_request' ) ); ?>">Alle Projektanfragen</a>
			</div>

			<?php if ( empty( $recent_projects ) ) : ?>
				<p>Noch keine Projektanfragen im CRM vorhanden.</p>
			<?php else : ?>
				<table class="widefat fixed striped nexus-review-table">
					<thead>
						<tr>
							<th>Kontakt</th>
							<th>Thema</th>
							<th>Status</th>
							<th>Aktualisiert</th>
							<th>Aktion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $recent_projects as $contact_post ) : ?>
							<?php
							$name       = (string) get_post_meta( $contact_post->ID, '_nexus_contact_name', true );
							$email      = (string) get_post_meta( $contact_post->ID, '_nexus_contact_email', true );
							$focus      = (string) get_post_meta( $contact_post->ID, '_nexus_contact_focus_label', true );
							$status     = (string) get_post_meta( $contact_post->ID, '_nexus_contact_status', true );
							$updated_at = (int) get_post_meta( $contact_post->ID, '_nexus_contact_updated_at', true );
							?>
							<tr>
								<td>
									<strong><?php echo esc_html( $name ?: get_the_title( $contact_post ) ); ?></strong><br>
									<span class="nexus-review-muted"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></span>
								</td>
								<td><?php echo esc_html( $focus ?: 'Projektanfrage' ); ?></td>
								<td>
									<span class="nexus-review-badge <?php echo esc_attr( function_exists( 'nexus_get_crm_contact_status_badge_class' ) ? nexus_get_crm_contact_status_badge_class( $status ) : 'nexus-review-badge-new' ); ?>">
										<?php echo esc_html( function_exists( 'nexus_get_crm_contact_status_options' ) ? ( nexus_get_crm_contact_status_options()[ $status ] ?? 'Unbekannt' ) : $status ); ?>
									</span>
								</td>
								<td><?php echo esc_html( $updated_at ? wp_date( 'd.m.Y H:i', $updated_at ) : 'n/a' ); ?></td>
								<td><a class="button button-small" href="<?php echo esc_url( get_edit_post_link( $contact_post->ID ) ); ?>">Öffnen</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>

		<div class="nexus-review-panel">
			<div class="nexus-review-panel-head">
				<h2>Letzte Blog-Abos</h2>
				<a class="button button-secondary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_contact&nexus_contact_segment=blog_notify' ) ); ?>">Alle Blog-Abos</a>
			</div>

			<?php if ( empty( $recent_blog_subscribers ) ) : ?>
				<p>Noch keine Blog-Abos im CRM vorhanden.</p>
			<?php else : ?>
				<table class="widefat fixed striped nexus-review-table">
					<thead>
						<tr>
							<th>E-Mail</th>
							<th>Status</th>
							<th>Consent</th>
							<th>Aktualisiert</th>
							<th>Aktion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $recent_blog_subscribers as $contact_post ) : ?>
							<?php
							$email      = (string) get_post_meta( $contact_post->ID, '_nexus_contact_email', true );
							$status     = (string) get_post_meta( $contact_post->ID, '_nexus_contact_blog_status', true );
							$consent    = (string) get_post_meta( $contact_post->ID, '_nexus_contact_consent_blog_email', true );
							$updated_at = (int) get_post_meta( $contact_post->ID, '_nexus_contact_updated_at', true );
							?>
							<tr>
								<td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td>
								<td>
									<span class="nexus-review-badge <?php echo esc_attr( function_exists( 'nexus_get_crm_contact_status_badge_class' ) ? nexus_get_crm_contact_status_badge_class( $status ) : 'nexus-review-badge-new' ); ?>">
										<?php echo esc_html( function_exists( 'nexus_get_crm_contact_status_options' ) ? ( nexus_get_crm_contact_status_options()[ $status ] ?? 'Unbekannt' ) : $status ); ?>
									</span>
								</td>
								<td><?php echo esc_html( $consent ?: 'n/a' ); ?></td>
								<td><?php echo esc_html( $updated_at ? wp_date( 'd.m.Y H:i', $updated_at ) : 'n/a' ); ?></td>
								<td><a class="button button-small" href="<?php echo esc_url( get_edit_post_link( $contact_post->ID ) ); ?>">Öffnen</a></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Add a CRM snapshot widget to the default WordPress dashboard.
 *
 * @return void
 */
function nexus_register_review_crm_dashboard_widget() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	wp_add_dashboard_widget(
		'nexus_review_crm_dashboard_widget',
		'Nexus CRM Snapshot',
		'nexus_render_review_crm_dashboard_widget'
	);
}
add_action( 'wp_dashboard_setup', 'nexus_register_review_crm_dashboard_widget' );

/**
 * Render the dashboard widget markup.
 *
 * @return void
 */
function nexus_render_review_crm_dashboard_widget() {
	$new_count          = nexus_count_review_requests_by_status( 'new' );
	$project_count      = function_exists( 'nexus_count_project_requests' ) ? nexus_count_project_requests() : 0;
	$blog_pending_count = function_exists( 'nexus_count_pending_blog_subscribers' ) ? nexus_count_pending_blog_subscribers() : 0;
	$latest_request     = get_posts(
		[
			'post_type'              => 'nexus_review_request',
			'post_status'            => 'private',
			'posts_per_page'         => 1,
			'orderby'                => 'date',
			'order'                  => 'DESC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
		]
	);
	?>
	<div class="nexus-review-widget">
		<p><strong>Audit neu:</strong> <?php echo esc_html( (string) $new_count ); ?> | <strong>Projektanfragen:</strong> <?php echo esc_html( (string) $project_count ); ?> | <strong>DOI ausstehend:</strong> <?php echo esc_html( (string) $blog_pending_count ); ?></p>
		<?php if ( ! empty( $latest_request ) ) : ?>
			<?php
			$latest  = $latest_request[0];
			$company = (string) get_post_meta( $latest->ID, '_nexus_review_company', true );
			$domain  = (string) get_post_meta( $latest->ID, '_nexus_review_domain', true );
			$page_url = (string) get_post_meta( $latest->ID, '_nexus_review_page_url', true );
			?>
			<p><strong>Letzte Audit-Anfrage:</strong> <?php echo esc_html( $company ?: $domain ); ?><br><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page_url ); ?></a></p>
		<?php endif; ?>
		<p><a class="button button-secondary" href="<?php echo esc_url( admin_url( 'admin.php?page=' . ( function_exists( 'nexus_get_crm_menu_slug' ) ? nexus_get_crm_menu_slug() : 'nexus-crm' ) ) ); ?>">Zum Nexus CRM</a></p>
	</div>
	<?php
}

/**
 * Count requests by a given workflow status.
 *
 * @param string $status Status key.
 * @return int
 */
function nexus_count_review_requests_by_status( $status ) {
	$query = new WP_Query(
		[
			'post_type'      => 'nexus_review_request',
			'post_status'    => 'private',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_query'     => [
				[
					'key'   => '_nexus_review_status',
					'value' => $status,
				],
			],
		]
	);

	return (int) $query->found_posts;
}

/**
 * Count requests that have not been processed within the target window.
 *
 * @return int
 */
function nexus_count_overdue_review_requests() {
	$query = new WP_Query(
		[
			'post_type'      => 'nexus_review_request',
			'post_status'    => 'private',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'     => '_nexus_review_due_at',
					'value'   => current_time( 'timestamp' ),
					'type'    => 'NUMERIC',
					'compare' => '<',
				],
				[
					'key'     => '_nexus_review_status',
					'value'   => [ 'new', 'in_review' ],
					'compare' => 'IN',
				],
			],
		]
	);

	return (int) $query->found_posts;
}
