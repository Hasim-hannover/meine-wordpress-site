<?php
/**
 * Contact page route, lean form handling and email notifications.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the canonical request path for the public contact page.
 *
 * @return string
 */
function nexus_get_contact_request_path() {
	return trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/kontakt/' ), PHP_URL_PATH ), '/' ) );
}

/**
 * Return legacy contact paths that should redirect to /kontakt/.
 *
 * @return array<int, string>
 */
function nexus_get_contact_legacy_paths() {
	return [
		trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/kontaktiere-mich/' ), PHP_URL_PATH ), '/' ) ),
	];
}

/**
 * Check whether the current request targets the canonical contact path.
 *
 * @return bool
 */
function nexus_is_contact_request_path() {
	return nexus_get_current_request_path() === nexus_get_contact_request_path();
}

/**
 * Redirect the previous contact slug to the canonical /kontakt/ URL.
 *
 * Use a temporary redirect while editor and menu references are still being cleaned up.
 *
 * @return void
 */
function nexus_redirect_legacy_contact_path() {
	if ( is_admin() || wp_doing_ajax() ) {
		return;
	}

	$request_path = nexus_get_current_request_path();

	if ( ! in_array( $request_path, nexus_get_contact_legacy_paths(), true ) ) {
		return;
	}

	nocache_headers();
	wp_safe_redirect( nexus_get_contact_url(), 302 );
	exit;
}
add_action( 'template_redirect', 'nexus_redirect_legacy_contact_path', 6 );

/**
 * Prevent canonical redirects from fighting the virtual /kontakt/ route.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function nexus_disable_canonical_redirect_for_contact( $redirect_url ) {
	if ( nexus_is_contact_request_path() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'nexus_disable_canonical_redirect_for_contact' );

/**
 * Turn the contact request into a virtual page when no real page owns /kontakt/.
 *
 * @param bool     $preempt  Existing preempt flag.
 * @param WP_Query $wp_query Current query.
 * @return bool
 */
function nexus_preempt_contact_404( $preempt, $wp_query ) {
	if ( is_admin() || wp_doing_ajax() || ! ( $wp_query instanceof WP_Query ) ) {
		return $preempt;
	}

	if ( ! $wp_query->is_404() || ! nexus_is_contact_request_path() ) {
		return $preempt;
	}

	$wp_query->is_404       = false;
	$wp_query->is_page      = true;
	$wp_query->is_singular  = true;
	$wp_query->is_home      = false;
	$wp_query->is_archive   = false;
	$wp_query->is_posts_page = false;
	$wp_query->queried_object = null;
	$wp_query->queried_object_id = 0;
	$wp_query->query_vars['pagename'] = 'kontakt';
	unset( $wp_query->query['error'], $wp_query->query_vars['error'] );

	status_header( 200 );

	return true;
}
add_filter( 'pre_handle_404', 'nexus_preempt_contact_404', 10, 2 );

/**
 * Use the native contact template for the virtual /kontakt/ route.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_use_virtual_contact_template( $template ) {
	if ( ! nexus_is_contact_request_path() || is_page( 'kontakt' ) ) {
		return $template;
	}

	$virtual_template = get_stylesheet_directory() . '/page-kontakt.php';

	if ( file_exists( $virtual_template ) ) {
		return $virtual_template;
	}

	return $template;
}
add_filter( 'template_include', 'nexus_use_virtual_contact_template', 99 );

/**
 * Remove 404 body classes for the virtual contact route.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function nexus_add_virtual_contact_body_class( $classes ) {
	if ( ! nexus_is_contact_request_path() || is_page( 'kontakt' ) ) {
		return $classes;
	}

	$classes   = array_diff( $classes, [ 'error404' ] );
	$classes[] = 'page';
	$classes[] = 'page-kontakt';
	$classes[] = 'page-template-default';

	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'nexus_add_virtual_contact_body_class', 20 );

/**
 * Return the available contact focus options.
 *
 * @return array<string, string>
 */
function nexus_get_contact_focus_options() {
	return [
		'seo'         => 'SEO',
		'performance' => 'Website Performance',
		'tracking'    => 'Tracking & Analytics',
		'conversion'  => 'Conversion Optimierung',
		'growth'      => 'Growth Strategie',
		'other'       => 'Sonstiges',
	];
}

/**
 * Return the available budget options for contact requests.
 *
 * @return array<string, string>
 */
function nexus_get_contact_budget_options() {
	return [
		'under_2000'      => 'unter 2.000€',
		'2000_5000'       => '2.000 – 5.000€',
		'5000_10000'      => '5.000 – 10.000€',
		'10000_plus'      => '10.000€+',
	];
}

/**
 * Resolve the internal recipient for contact requests.
 *
 * @return string
 */
function nexus_get_contact_notification_email() {
	$default = function_exists( 'nexus_get_audit_notification_email' )
		? nexus_get_audit_notification_email()
		: (string) get_option( 'admin_email' );

	return (string) apply_filters( 'nexus_contact_notification_email', $default );
}

/**
 * Register the public REST route for the lean contact form.
 *
 * @return void
 */
function nexus_register_contact_rest_routes() {
	register_rest_route(
		'nexus/v1',
		'/contact-request',
		[
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'nexus_handle_contact_request_submission',
			'permission_callback' => '__return_true',
		]
	);
}
add_action( 'rest_api_init', 'nexus_register_contact_rest_routes' );

/**
 * Handle public contact form submissions.
 *
 * @param WP_REST_Request $request REST request.
 * @return WP_REST_Response
 */
function nexus_handle_contact_request_submission( WP_REST_Request $request ) {
	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) || empty( $payload ) ) {
		$payload = $request->get_body_params();
	}

	$honeypot = isset( $payload['company_website'] ) ? trim( (string) $payload['company_website'] ) : '';
	if ( '' !== $honeypot ) {
		return new WP_REST_Response(
			[
				'ok'      => true,
				'message' => 'Nachricht eingegangen.',
			],
			200
		);
	}

	$rate_limit_error = nexus_validate_contact_request_rate_limit();
	if ( is_wp_error( $rate_limit_error ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $rate_limit_error->get_error_message(),
			],
			429
		);
	}

	$validated = nexus_validate_contact_request_payload( $payload );
	if ( is_wp_error( $validated ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $validated->get_error_message(),
			],
			400
		);
	}

	nexus_send_contact_request_admin_notification( $validated );
	nexus_send_contact_request_confirmation( $validated );

	return new WP_REST_Response(
		[
			'ok'      => true,
			'message' => 'Danke. Ihre Projektanfrage ist eingegangen. Sie erhalten innerhalb von 24 Stunden eine Rückmeldung.',
		],
		201
	);
}

/**
 * Validate and sanitize the public contact form payload.
 *
 * @param array $payload Raw payload.
 * @return array|WP_Error
 */
function nexus_validate_contact_request_payload( $payload ) {
	$focus_options     = nexus_get_contact_focus_options();
	$budget_options    = nexus_get_contact_budget_options();
	$name              = isset( $payload['name'] ) ? sanitize_text_field( (string) $payload['name'] ) : '';
	$email             = isset( $payload['email'] ) ? sanitize_email( (string) $payload['email'] ) : '';
	$website_url_raw   = isset( $payload['website_url'] ) ? trim( (string) $payload['website_url'] ) : '';
	$focus             = isset( $payload['focus'] ) ? sanitize_key( (string) $payload['focus'] ) : '';
	$message           = isset( $payload['message'] ) ? sanitize_textarea_field( (string) $payload['message'] ) : '';
	$budget            = isset( $payload['budget'] ) ? sanitize_key( (string) $payload['budget'] ) : '';
	$consent           = ! empty( $payload['consent'] );
	$website_url       = '';

	if ( '' === $name ) {
		return new WP_Error( 'missing_name', 'Bitte Ihren Namen angeben.' );
	}

	if ( '' === $email || ! is_email( $email ) ) {
		return new WP_Error( 'invalid_email', 'Bitte eine gültige E-Mail-Adresse angeben.' );
	}

	if ( '' !== $website_url_raw ) {
		if ( ! preg_match( '#^https?://#i', $website_url_raw ) ) {
			$website_url_raw = 'https://' . ltrim( $website_url_raw, '/' );
		}

		$website_url = esc_url_raw( $website_url_raw );

		if ( '' === $website_url || ! wp_http_validate_url( $website_url ) ) {
			return new WP_Error( 'invalid_website', 'Bitte eine gültige Website-URL angeben.' );
		}
	}

	if ( ! isset( $focus_options[ $focus ] ) ) {
		return new WP_Error( 'missing_focus', 'Bitte auswählen, wobei Sie Unterstützung benötigen.' );
	}

	if ( '' === trim( $message ) || mb_strlen( trim( $message ) ) < 24 ) {
		return new WP_Error( 'message_too_short', 'Bitte Ihr Ziel oder Projekt kurz beschreiben.' );
	}

	if ( '' !== $budget && ! isset( $budget_options[ $budget ] ) ) {
		return new WP_Error( 'invalid_budget', 'Bitte ein gültiges Budget auswählen.' );
	}

	if ( ! $consent ) {
		return new WP_Error( 'missing_consent', 'Bitte der Verarbeitung Ihrer Nachricht zustimmen.' );
	}

	return [
		'name'         => $name,
		'email'        => $email,
		'website_url'  => $website_url,
		'focus'        => $focus,
		'focus_label'  => $focus_options[ $focus ],
		'message'      => $message,
		'budget'       => $budget,
		'budget_label' => '' !== $budget ? $budget_options[ $budget ] : '',
	];
}

/**
 * Rate-limit public contact form submissions per IP and hour.
 *
 * @return true|WP_Error
 */
function nexus_validate_contact_request_rate_limit() {
	$ip_address = function_exists( 'nexus_get_review_request_ip' ) ? nexus_get_review_request_ip() : '';
	if ( '' === $ip_address ) {
		return true;
	}

	$key   = 'nexus_contact_rl_' . md5( $ip_address . gmdate( 'YmdH' ) );
	$count = (int) get_transient( $key );

	if ( $count >= 8 ) {
		return new WP_Error( 'rate_limited', 'Zu viele Nachrichten in kurzer Zeit. Bitte später erneut versuchen.' );
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	return true;
}

/**
 * Send an HTML mail with the shared branded shell when available.
 *
 * @param string $recipient Recipient email.
 * @param string $subject   Email subject.
 * @param string $html      Email HTML body.
 * @param array  $headers   Optional headers.
 * @return void
 */
function nexus_send_contact_html_mail( $recipient, $subject, $html, $headers = [] ) {
	if ( function_exists( 'nexus_send_audit_html_mail' ) ) {
		nexus_send_audit_html_mail( $recipient, $subject, $html, $headers );
		return;
	}

	$headers   = (array) $headers;
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	wp_mail( $recipient, $subject, $html, $headers );
}

/**
 * Wrap a contact email in the shared branded shell when available.
 *
 * @param array $args Mail shell arguments.
 * @return string
 */
function nexus_get_contact_email_shell( $args = [] ) {
	if ( function_exists( 'nexus_get_audit_email_shell' ) ) {
		return nexus_get_audit_email_shell( $args );
	}

	return (string) ( $args['content'] ?? '' );
}

/**
 * Send the internal contact notification.
 *
 * @param array $payload Validated payload.
 * @return void
 */
function nexus_send_contact_request_admin_notification( $payload ) {
	$recipient = nexus_get_contact_notification_email();
	if ( ! $recipient || ! is_email( $recipient ) ) {
		return;
	}

	$subject = sprintf(
		'[%s] Neue Projektanfrage - %s',
		wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ),
		$payload['name']
	);
	$headers = [];

	if ( ! empty( $payload['email'] ) && is_email( $payload['email'] ) ) {
		$headers[] = 'Reply-To: ' . $payload['email'];
	}

	$meta_rows = '';
	if ( '' !== $payload['website_url'] ) {
		$meta_rows .= sprintf(
			'<br><strong style="color:#f7f3ee;">Website:</strong> <a href="%1$s" style="color:#f7f3ee;">%2$s</a>',
			esc_url( $payload['website_url'] ),
			esc_html( $payload['website_url'] )
		);
	}

	if ( '' !== $payload['budget_label'] ) {
		$meta_rows .= sprintf(
			'<br><strong style="color:#f7f3ee;">Budget:</strong> %s',
			esc_html( $payload['budget_label'] )
		);
	}

	$content = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 18px 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Projektanfrage</div>
					<div style="font-size:14px; line-height:1.75; color:#c5ced7;">
						<strong style="color:#f7f3ee;">Name:</strong> %1$s<br>
						<strong style="color:#f7f3ee;">E-Mail:</strong> %2$s<br>
						<strong style="color:#f7f3ee;">Unterstützung:</strong> %3$s%4$s
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding:16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Projektbeschreibung</div>
					<div style="font-size:14px; line-height:1.85; color:#c5ced7;">%5$s</div>
				</td>
			</tr>
		</table>',
		esc_html( $payload['name'] ),
		esc_html( $payload['email'] ),
		esc_html( $payload['focus_label'] ),
		$meta_rows,
		nl2br( esc_html( $payload['message'] ) )
	);

	$html = nexus_get_contact_email_shell(
		[
			'preheader' => 'Neue Projektanfrage von ' . $payload['name'],
			'eyebrow'   => 'Projektanfrage',
			'headline'  => 'Neue Projektanfrage',
			'intro'     => 'Eine neue qualifizierte Projektanfrage ist über die Kontaktseite eingegangen.',
			'content'   => $content,
			'footer'    => 'Sie können direkt auf diese E-Mail antworten. Reply-To zeigt bereits auf die anfragende Person.',
		]
	);

	nexus_send_contact_html_mail( $recipient, $subject, $html, $headers );
}

/**
 * Send a short confirmation email to the requester.
 *
 * @param array $payload Validated payload.
 * @return void
 */
function nexus_send_contact_request_confirmation( $payload ) {
	if ( empty( $payload['email'] ) || ! is_email( $payload['email'] ) ) {
		return;
	}

	$reply_to = nexus_get_contact_notification_email();
	$subject  = sprintf( '[%s] Projektanfrage eingegangen', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$meta_rows = sprintf(
		'<strong style="color:#f7f3ee;">Bereich:</strong> %s',
		esc_html( $payload['focus_label'] )
	);

	if ( '' !== $payload['website_url'] ) {
		$meta_rows .= sprintf(
			'<br><strong style="color:#f7f3ee;">Website:</strong> <a href="%1$s" style="color:#f7f3ee;">%2$s</a>',
			esc_url( $payload['website_url'] ),
			esc_html( $payload['website_url'] )
		);
	}

	if ( '' !== $payload['budget_label'] ) {
		$meta_rows .= sprintf(
			'<br><strong style="color:#f7f3ee;">Budget:</strong> %s',
			esc_html( $payload['budget_label'] )
		);
	}

	$content = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 18px 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Was jetzt passiert</div>
					<div style="font-size:14px; line-height:1.8; color:#c5ced7;">
						<strong style="color:#f7f3ee;">1.</strong> Ihre Nachricht ist sauber eingegangen.<br>
						<strong style="color:#f7f3ee;">2.</strong> Sie erhalten innerhalb von 24 Stunden eine persönliche Rückmeldung.<br>
						<strong style="color:#f7f3ee;">3.</strong> Wenn es passt, vereinbaren wir ein kurzes Strategiegespräch.
					</div>
				</td>
			</tr>
			<tr>
				<td style="padding:14px 16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Ihre Angaben</div>
					<div style="font-size:14px; line-height:1.8; color:#c5ced7;">
						%1$s<br>
						<strong style="color:#f7f3ee;">Projektbeschreibung:</strong> %2$s
					</div>
				</td>
			</tr>
		</table>',
		$meta_rows,
		esc_html( wp_trim_words( $payload['message'], 18, '…' ) )
	);

	$html = nexus_get_contact_email_shell(
		[
			'preheader' => 'Ihre Projektanfrage ist eingegangen.',
			'eyebrow'   => 'Projektanfrage',
			'headline'  => 'Ihre Projektanfrage ist eingegangen.',
			'intro'     => 'Danke, ' . $payload['name'] . '. Ich prüfe Ihre Angaben persönlich und melde mich zeitnah zurück.',
			'content'   => $content,
			'footer'    => 'Viele Grüße, Hasim Üner',
		]
	);

	$headers = [];
	if ( $reply_to && is_email( $reply_to ) ) {
		$headers[] = 'Reply-To: ' . $reply_to;
	}

	nexus_send_contact_html_mail( $payload['email'], $subject, $html, $headers );
}
