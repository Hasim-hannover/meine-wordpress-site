<?php
/**
 * Blog notification subscriptions, DOI flow and article mail delivery.
 *
 * @package Blocksy_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the canonical request path for blog notification management.
 *
 * @return string
 */
function nexus_get_blog_notify_request_path() {
	return trailingslashit( '/' . ltrim( (string) wp_parse_url( home_url( '/neue-artikel-per-email/' ), PHP_URL_PATH ), '/' ) );
}

/**
 * Return the public URL for the blog notification route.
 *
 * @param array $args Optional query arguments.
 * @return string
 */
function nexus_get_blog_notify_url( $args = [] ) {
	$url = home_url( nexus_get_blog_notify_request_path() );

	if ( ! empty( $args ) ) {
		$url = add_query_arg( $args, $url );
	}

	return $url;
}

/**
 * Determine whether the current request targets the blog notification route.
 *
 * @return bool
 */
function nexus_is_blog_notify_request_path() {
	return nexus_get_current_request_path() === nexus_get_blog_notify_request_path();
}

/**
 * Determine whether the current page is the blog notification surface.
 *
 * @return bool
 */
function nexus_is_blog_notify_page() {
	return nexus_is_blog_notify_request_path() || is_page( 'neue-artikel-per-email' );
}

/**
 * Return the posts overview URL with a safe fallback.
 *
 * @return string
 */
function nexus_get_blog_posts_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );

	if ( $posts_page_id ) {
		return get_permalink( $posts_page_id );
	}

	$archive_url = get_post_type_archive_link( 'post' );

	if ( $archive_url ) {
		return $archive_url;
	}

	return home_url( '/blog/' );
}

/**
 * Prevent canonical redirects from interfering with the virtual blog notify route.
 *
 * @param string|false $redirect_url Redirect target.
 * @return string|false
 */
function nexus_disable_canonical_redirect_for_blog_notify( $redirect_url ) {
	if ( nexus_is_blog_notify_request_path() ) {
		return false;
	}

	return $redirect_url;
}
add_filter( 'redirect_canonical', 'nexus_disable_canonical_redirect_for_blog_notify' );

/**
 * Convert the notify request path into a virtual page when needed.
 *
 * @param bool     $preempt  Existing preempt flag.
 * @param WP_Query $wp_query Current query.
 * @return bool
 */
function nexus_preempt_blog_notify_404( $preempt, $wp_query ) {
	if ( is_admin() || wp_doing_ajax() || ! ( $wp_query instanceof WP_Query ) ) {
		return $preempt;
	}

	if ( ! $wp_query->is_404() || ! nexus_is_blog_notify_request_path() ) {
		return $preempt;
	}

	$wp_query->is_404                = false;
	$wp_query->is_page               = true;
	$wp_query->is_singular           = true;
	$wp_query->is_home               = false;
	$wp_query->is_archive            = false;
	$wp_query->is_posts_page         = false;
	$wp_query->queried_object        = null;
	$wp_query->queried_object_id     = 0;
	$wp_query->query_vars['pagename'] = 'neue-artikel-per-email';
	unset( $wp_query->query['error'], $wp_query->query_vars['error'] );

	status_header( 200 );

	return true;
}
add_filter( 'pre_handle_404', 'nexus_preempt_blog_notify_404', 10, 2 );

/**
 * Use the dedicated template for the virtual blog notify page.
 *
 * @param string $template Resolved template path.
 * @return string
 */
function nexus_use_virtual_blog_notify_template( $template ) {
	if ( ! nexus_is_blog_notify_request_path() || is_page( 'neue-artikel-per-email' ) ) {
		return $template;
	}

	$virtual_template = get_stylesheet_directory() . '/page-blog-notify.php';

	if ( file_exists( $virtual_template ) ) {
		return $virtual_template;
	}

	return $template;
}
add_filter( 'template_include', 'nexus_use_virtual_blog_notify_template', 99 );

/**
 * Remove 404 body classes for the virtual blog notify route.
 *
 * @param array<int, string> $classes Body classes.
 * @return array<int, string>
 */
function nexus_add_virtual_blog_notify_body_class( $classes ) {
	if ( ! nexus_is_blog_notify_request_path() || is_page( 'neue-artikel-per-email' ) ) {
		return $classes;
	}

	$classes   = array_diff( $classes, [ 'error404' ] );
	$classes[] = 'page';
	$classes[] = 'page-blog-notify';

	return array_values( array_unique( $classes ) );
}
add_filter( 'body_class', 'nexus_add_virtual_blog_notify_body_class', 20 );

/**
 * Return the copy model for the blog notification component.
 *
 * @return array<string, string>
 */
function nexus_get_blog_notify_copy() {
	return [
		'headline'        => 'Neue Artikel per E-Mail',
		'body'            => 'Ich schicke nur dann eine kurze Mail, wenn ein neuer Beitrag zu WordPress, SEO, Tracking oder digitalem Wachstum online ist. Kein Newsletter-Rauschen. Keine Sales-Mails.',
		'placeholder'     => 'Ihre E-Mail-Adresse',
		'button'          => 'Neue Artikel erhalten',
		'hint'            => 'Sie erhalten nur Benachrichtigungen zu neuen Artikeln. Keine unnoetigen Werbemails. Abmeldung jederzeit moeglich.',
		'success'         => 'Fast geschafft. Bitte bestaetigen Sie Ihre Anmeldung ueber die E-Mail in Ihrem Postfach.',
		'error'           => 'Das hat gerade nicht funktioniert. Bitte pruefen Sie Ihre E-Mail-Adresse oder versuchen Sie es gleich noch einmal.',
		'already'         => 'Diese E-Mail-Adresse ist bereits eingetragen oder wartet noch auf Bestaetigung.',
		'unsubscribe'     => 'Sie wurden erfolgreich von den Blog-Benachrichtigungen abgemeldet.',
		'confirm_success' => 'Ihre Anmeldung ist bestaetigt. Kuenftige neue Artikel erhalten Sie ab jetzt per E-Mail.',
		'invalid'         => 'Der Link ist nicht mehr gueltig oder wurde bereits verwendet.',
	];
}

/**
 * Return the page-state copy for the management route.
 *
 * @param string $state Requested page state.
 * @return array<string, string>
 */
function nexus_get_blog_notify_state_copy( $state ) {
	$copy = nexus_get_blog_notify_copy();
	$map  = [
		'default' => [
			'eyebrow'  => 'Blog-Benachrichtigungen',
			'title'    => $copy['headline'],
			'body'     => $copy['body'],
			'variant'  => 'default',
			'showForm' => true,
		],
		'confirmed' => [
			'eyebrow'  => 'Bestaetigt',
			'title'    => $copy['headline'],
			'body'     => $copy['confirm_success'],
			'variant'  => 'success',
			'showForm' => false,
		],
		'unsubscribed' => [
			'eyebrow'  => 'Abmeldung',
			'title'    => $copy['headline'],
			'body'     => $copy['unsubscribe'],
			'variant'  => 'success',
			'showForm' => true,
		],
		'invalid' => [
			'eyebrow'  => 'Link ungueltig',
			'title'    => $copy['headline'],
			'body'     => $copy['invalid'],
			'variant'  => 'error',
			'showForm' => true,
		],
	];

	return $map[ $state ] ?? $map['default'];
}

/**
 * Return the current state for the public blog notification route.
 *
 * @return string
 */
function nexus_get_blog_notify_page_state() {
	$state = isset( $_GET['state'] ) ? sanitize_key( (string) wp_unslash( $_GET['state'] ) ) : 'default';

	if ( ! in_array( $state, [ 'default', 'confirmed', 'unsubscribed', 'invalid' ], true ) ) {
		return 'default';
	}

	return $state;
}

/**
 * Handle confirmation and unsubscribe actions on the public route.
 *
 * @return void
 */
function nexus_handle_blog_notify_actions() {
	if ( is_admin() || wp_doing_ajax() || ! nexus_is_blog_notify_request_path() ) {
		return;
	}

	$action = isset( $_GET['action'] ) ? sanitize_key( (string) wp_unslash( $_GET['action'] ) ) : '';
	$token  = isset( $_GET['token'] ) ? sanitize_text_field( (string) wp_unslash( $_GET['token'] ) ) : '';

	if ( '' === $action || '' === $token ) {
		return;
	}

	$state = 'invalid';

	if ( 'confirm' === $action ) {
		$state = nexus_confirm_blog_subscription( $token ) ? 'confirmed' : 'invalid';
	} elseif ( 'unsubscribe' === $action ) {
		$state = nexus_unsubscribe_blog_subscription( $token ) ? 'unsubscribed' : 'invalid';
	}

	wp_safe_redirect( nexus_get_blog_notify_url( [ 'state' => $state ] ), 303 );
	exit;
}
add_action( 'template_redirect', 'nexus_handle_blog_notify_actions', 6 );

/**
 * Register the public REST route for blog subscriptions.
 *
 * @return void
 */
function nexus_register_blog_notify_rest_routes() {
	register_rest_route(
		'nexus/v1',
		'/blog-subscribe',
		[
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'nexus_handle_blog_subscribe_submission',
			'permission_callback' => '__return_true',
		]
	);
}
add_action( 'rest_api_init', 'nexus_register_blog_notify_rest_routes' );

/**
 * Handle public blog subscription requests.
 *
 * @param WP_REST_Request $request REST request.
 * @return WP_REST_Response
 */
function nexus_handle_blog_subscribe_submission( WP_REST_Request $request ) {
	$payload = $request->get_json_params();
	if ( ! is_array( $payload ) || empty( $payload ) ) {
		$payload = $request->get_body_params();
	}

	$honeypot = isset( $payload['website'] ) ? trim( (string) $payload['website'] ) : '';
	if ( '' !== $honeypot ) {
		return new WP_REST_Response(
			[
				'ok'      => true,
				'message' => nexus_get_blog_notify_copy()['success'],
			],
			200
		);
	}

	$rate_limit_error = nexus_validate_blog_subscribe_rate_limit();
	if ( is_wp_error( $rate_limit_error ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $rate_limit_error->get_error_message(),
			],
			429
		);
	}

	$validated = nexus_validate_blog_subscribe_payload( $payload, $request );
	if ( is_wp_error( $validated ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $validated->get_error_message(),
			],
			400
		);
	}

	$result = nexus_subscribe_blog_notify_contact( $validated );
	if ( is_wp_error( $result ) ) {
		return new WP_REST_Response(
			[
				'ok'    => false,
				'error' => $result->get_error_message(),
			],
			500
		);
	}

	return new WP_REST_Response(
		[
			'ok'        => true,
			'state'     => $result['state'],
			'message'   => $result['message'],
			'contactId' => $result['contact_id'],
		],
		200
	);
}

/**
 * Validate the public blog subscription payload.
 *
 * @param array           $payload Raw payload.
 * @param WP_REST_Request $request REST request.
 * @return array|WP_Error
 */
function nexus_validate_blog_subscribe_payload( $payload, WP_REST_Request $request ) {
	$email = isset( $payload['email'] ) ? nexus_normalize_contact_email( $payload['email'] ) : '';
	$nonce = $request->get_header( 'X-Nexus-Nonce' );

	if ( '' === $nonce && isset( $payload['nonce'] ) ) {
		$nonce = sanitize_text_field( (string) $payload['nonce'] );
	}

	if ( ! wp_verify_nonce( (string) $nonce, 'nexus_blog_notify_subscribe' ) ) {
		return new WP_Error( 'invalid_nonce', nexus_get_blog_notify_copy()['error'] );
	}

	if ( '' === $email || ! is_email( $email ) ) {
		return new WP_Error( 'invalid_email', nexus_get_blog_notify_copy()['error'] );
	}

	return [
		'email'           => $email,
		'context_post_id' => isset( $payload['contextPostId'] ) ? absint( $payload['contextPostId'] ) : 0,
	];
}

/**
 * Rate-limit blog subscriptions per IP and hour.
 *
 * @return true|WP_Error
 */
function nexus_validate_blog_subscribe_rate_limit() {
	$ip_address = function_exists( 'nexus_get_review_request_ip' ) ? nexus_get_review_request_ip() : '';
	if ( '' === $ip_address ) {
		return true;
	}

	$key   = 'nexus_blog_notify_rl_' . md5( $ip_address . gmdate( 'YmdH' ) );
	$count = (int) get_transient( $key );

	if ( $count >= 6 ) {
		return new WP_Error( 'rate_limited', nexus_get_blog_notify_copy()['error'] );
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	return true;
}

/**
 * Subscribe a contact to blog notifications with DOI semantics.
 *
 * @param array $validated Validated subscription payload.
 * @return array|WP_Error
 */
function nexus_subscribe_blog_notify_contact( $validated ) {
	$email         = $validated['email'];
	$contact_id    = function_exists( 'nexus_find_contact_by_email' ) ? nexus_find_contact_by_email( $email ) : 0;
	$existing      = $contact_id ? get_post_meta( $contact_id, '_nexus_contact_blog_status', true ) : '';
	$existing_blog = $contact_id ? (string) get_post_meta( $contact_id, '_nexus_contact_consent_blog_email', true ) : '';
	$copy          = nexus_get_blog_notify_copy();
	$state         = 'success';

	if ( $contact_id && 'active' === $existing && 'confirmed' === $existing_blog ) {
		return [
			'state'      => 'already',
			'message'    => $copy['already'],
			'contact_id' => $contact_id,
		];
	}

	$unsubscribe_token = $contact_id ? (string) get_post_meta( $contact_id, '_nexus_contact_unsubscribe_token', true ) : '';
	if ( '' === $unsubscribe_token ) {
		$unsubscribe_token = nexus_generate_contact_token();
	}

	$confirm_token = nexus_generate_contact_token();
	$title         = $email;

	$contact_id = nexus_upsert_crm_contact(
		[
			'email'         => $email,
			'title'         => $title,
			'source'        => 'blog_subscriber',
			'latest_source' => 'blog_subscriber',
			'status'        => $contact_id ? '' : 'pending',
			'segments'      => [ 'blog_notify' ],
			'meta'          => [
				'_nexus_contact_blog_status'               => 'pending',
				'_nexus_contact_consent_blog_email'        => 'pending',
				'_nexus_contact_blog_confirm_token'        => $confirm_token,
				'_nexus_contact_blog_confirm_requested_at' => current_time( 'timestamp' ),
				'_nexus_contact_unsubscribe_token'         => $unsubscribe_token,
				'_nexus_contact_blog_source_post_id'       => (int) $validated['context_post_id'],
			],
		]
	);

	if ( is_wp_error( $contact_id ) ) {
		return $contact_id;
	}

	nexus_sync_contact_primary_status_for_blog( $contact_id, 'pending' );

	$mail_sent = nexus_send_blog_notify_double_opt_in_email( $contact_id );
	if ( is_wp_error( $mail_sent ) || ! $mail_sent ) {
		return new WP_Error( 'blog_notify_mail_failed', $copy['error'] );
	}

	if ( $contact_id && 'pending' === $existing ) {
		$state = 'already';
	}

	return [
		'state'      => $state,
		'message'    => 'already' === $state ? $copy['already'] : $copy['success'],
		'contact_id' => $contact_id,
	];
}

/**
 * Sync the primary CRM status only when the record is effectively blog-managed.
 *
 * @param int    $contact_id Contact post ID.
 * @param string $blog_status Blog lifecycle status.
 * @return void
 */
function nexus_sync_contact_primary_status_for_blog( $contact_id, $blog_status ) {
	$current_status = (string) get_post_meta( $contact_id, '_nexus_contact_status', true );

	if ( in_array( $current_status, [ '', 'pending', 'active', 'unsubscribed' ], true ) ) {
		update_post_meta( $contact_id, '_nexus_contact_status', $blog_status );
	}
}

/**
 * Wrap blog notification emails in the shared branded shell.
 *
 * @param array $args Mail shell arguments.
 * @return string
 */
function nexus_get_blog_notify_email_shell( $args = [] ) {
	if ( function_exists( 'nexus_get_audit_email_shell' ) ) {
		return nexus_get_audit_email_shell( $args );
	}

	if ( function_exists( 'nexus_get_contact_email_shell' ) ) {
		return nexus_get_contact_email_shell( $args );
	}

	return (string) ( $args['content'] ?? '' );
}

/**
 * Send blog notification mail via the shared mail transport.
 *
 * @param string $recipient Recipient email.
 * @param string $subject   Subject line.
 * @param string $html      HTML body.
 * @param array  $headers   Optional headers.
 * @return bool
 */
function nexus_send_blog_notify_html_mail( $recipient, $subject, $html, $headers = [] ) {
	$headers   = (array) $headers;
	$headers[] = 'Content-Type: text/html; charset=UTF-8';

	return (bool) wp_mail( $recipient, $subject, $html, $headers );
}

/**
 * Send the DOI confirmation mail.
 *
 * @param int $contact_id CRM contact ID.
 * @return bool|WP_Error
 */
function nexus_send_blog_notify_double_opt_in_email( $contact_id ) {
	$email             = (string) get_post_meta( $contact_id, '_nexus_contact_email', true );
	$confirm_token     = (string) get_post_meta( $contact_id, '_nexus_contact_blog_confirm_token', true );
	$unsubscribe_token = (string) get_post_meta( $contact_id, '_nexus_contact_unsubscribe_token', true );

	if ( '' === $email || '' === $confirm_token || '' === $unsubscribe_token ) {
		return new WP_Error( 'missing_tokens', nexus_get_blog_notify_copy()['error'] );
	}

	$subject         = sprintf( '[%s] Bitte Anmeldung bestaetigen', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );
	$confirm_url     = nexus_get_blog_notify_url( [ 'action' => 'confirm', 'token' => $confirm_token ] );
	$unsubscribe_url = nexus_get_blog_notify_url( [ 'action' => 'unsubscribe', 'token' => $unsubscribe_token ] );
	$content         = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:14px; line-height:1.8; color:#c5ced7;">
						Bitte bestaetigen Sie Ihre Anmeldung mit einem Klick. Danach erhalten Sie nur dann eine kurze E-Mail, wenn ein neuer Fachartikel online geht.
					</div>
				</td>
			</tr>
		</table>
		<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px 0;">
			<tr>
				<td style="padding:0 12px 0 0;">
					<a href="%1$s" style="display:inline-block; padding:14px 18px; border-radius:14px; background:#b46a3c; color:#fff8f3; text-decoration:none; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:700;">Anmeldung bestaetigen</a>
				</td>
			</tr>
		</table>
		<p style="margin:0; font-family:Helvetica, Arial, sans-serif; font-size:13px; line-height:1.8; color:#c5ced7;">
			Wenn Sie das nicht moechten, koennen Sie die Anfrage direkt ignorieren oder hier abbrechen:
			<a href="%2$s" style="color:#d3a98c; text-decoration:none;">Abmelden</a>
		</p>',
		esc_url( $confirm_url ),
		esc_url( $unsubscribe_url )
	);

	$html = nexus_get_blog_notify_email_shell(
		[
			'preheader' => 'Bitte bestaetigen Sie Ihre Anmeldung fuer neue Artikel per E-Mail.',
			'eyebrow'   => 'Neue Artikel per E-Mail',
			'headline'  => 'Fast geschafft',
			'intro'     => 'Ein Klick fehlt noch, damit die Anmeldung sauber bestaetigt ist.',
			'content'   => $content,
			'footer'    => 'Sie erhalten ausschliesslich kurze Hinweise auf neue Artikel. Keine Sales-Mails.',
		]
	);

	return nexus_send_blog_notify_html_mail( $email, $subject, $html );
}

/**
 * Find a CRM contact by token meta.
 *
 * @param string $meta_key Meta key to search.
 * @param string $token    Token value.
 * @return int
 */
function nexus_find_contact_by_token( $meta_key, $token ) {
	$post_ids = get_posts(
		[
			'post_type'              => 'nexus_contact',
			'post_status'            => 'private',
			'posts_per_page'         => 1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'meta_query'             => [
				[
					'key'   => $meta_key,
					'value' => $token,
				],
			],
		]
	);

	return ! empty( $post_ids ) ? (int) $post_ids[0] : 0;
}

/**
 * Confirm a pending blog subscription by token.
 *
 * @param string $token Confirmation token.
 * @return bool
 */
function nexus_confirm_blog_subscription( $token ) {
	$contact_id = nexus_find_contact_by_token( '_nexus_contact_blog_confirm_token', $token );

	if ( ! $contact_id ) {
		return false;
	}

	nexus_set_contact_segments( $contact_id, array_merge( nexus_get_contact_segments( $contact_id ), [ 'blog_notify' ] ) );
	update_post_meta( $contact_id, '_nexus_contact_blog_status', 'active' );
	update_post_meta( $contact_id, '_nexus_contact_consent_blog_email', 'confirmed' );
	update_post_meta( $contact_id, '_nexus_contact_double_opt_in_confirmed_at', current_time( 'timestamp' ) );
	update_post_meta( $contact_id, '_nexus_contact_updated_at', current_time( 'timestamp' ) );
	delete_post_meta( $contact_id, '_nexus_contact_blog_confirm_token' );
	nexus_sync_contact_primary_status_for_blog( $contact_id, 'active' );

	return true;
}

/**
 * Unsubscribe a blog contact by token.
 *
 * @param string $token Unsubscribe token.
 * @return bool
 */
function nexus_unsubscribe_blog_subscription( $token ) {
	$contact_id = nexus_find_contact_by_token( '_nexus_contact_unsubscribe_token', $token );

	if ( ! $contact_id ) {
		return false;
	}

	nexus_set_contact_segments( $contact_id, array_merge( nexus_get_contact_segments( $contact_id ), [ 'blog_notify' ] ) );
	update_post_meta( $contact_id, '_nexus_contact_blog_status', 'unsubscribed' );
	update_post_meta( $contact_id, '_nexus_contact_consent_blog_email', 'revoked' );
	update_post_meta( $contact_id, '_nexus_contact_unsubscribed_at', current_time( 'timestamp' ) );
	update_post_meta( $contact_id, '_nexus_contact_updated_at', current_time( 'timestamp' ) );
	nexus_sync_contact_primary_status_for_blog( $contact_id, 'unsubscribed' );

	return true;
}

/**
 * Return supported statuses for per-post blog notification sends.
 *
 * @return array<string, string>
 */
function nexus_get_blog_notification_status_labels() {
	return [
		'not_queued'           => 'Nicht geplant',
		'queued'               => 'In Queue',
		'processing'           => 'Wird versendet',
		'sent'                 => 'Gesendet',
		'sent_with_errors'     => 'Gesendet mit Fehlern',
		'skipped_no_recipients' => 'Keine aktiven Abonnenten',
	];
}

/**
 * Register the blog notification meta box on posts.
 *
 * @return void
 */
function nexus_register_blog_notification_meta_box() {
	add_meta_box(
		'nexus-blog-notify',
		'Neue Artikel per E-Mail',
		'nexus_render_blog_notification_meta_box',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes_post', 'nexus_register_blog_notification_meta_box' );

/**
 * Render the blog notification meta box.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function nexus_render_blog_notification_meta_box( $post ) {
	$status_labels   = nexus_get_blog_notification_status_labels();
	$current_status  = (string) get_post_meta( $post->ID, '_nexus_blog_notify_status', true );
	$recipient_count = (int) get_post_meta( $post->ID, '_nexus_blog_notify_recipient_count', true );
	$success_count   = (int) get_post_meta( $post->ID, '_nexus_blog_notify_success_count', true );
	$failure_count   = (int) get_post_meta( $post->ID, '_nexus_blog_notify_failure_count', true );
	$sent_at         = (int) get_post_meta( $post->ID, '_nexus_blog_notify_sent_at', true );
	$last_error      = (string) get_post_meta( $post->ID, '_nexus_blog_notify_last_error', true );

	if ( 'publish' !== $post->post_status ) {
		echo '<p>Die Benachrichtigung kann erst fuer veroeffentlichte Artikel ausgelost werden.</p>';
		return;
	}

	$current_status = $current_status ?: 'not_queued';
	?>
	<p><strong>Status:</strong> <?php echo esc_html( $status_labels[ $current_status ] ?? $current_status ); ?></p>
	<?php if ( $recipient_count ) : ?>
		<p><strong>Empfaenger:</strong> <?php echo esc_html( (string) $recipient_count ); ?></p>
	<?php endif; ?>
	<?php if ( $success_count || $failure_count ) : ?>
		<p><strong>Versendet:</strong> <?php echo esc_html( (string) $success_count ); ?> erfolgreich<?php if ( $failure_count ) : ?>, <?php echo esc_html( (string) $failure_count ); ?> mit Fehlern<?php endif; ?></p>
	<?php endif; ?>
	<?php if ( $sent_at ) : ?>
		<p><strong>Abgeschlossen:</strong> <?php echo esc_html( wp_date( 'd.m.Y H:i', $sent_at ) ); ?></p>
	<?php endif; ?>
	<?php if ( '' !== $last_error ) : ?>
		<p><strong>Letzter Fehler:</strong><br><?php echo esc_html( $last_error ); ?></p>
	<?php endif; ?>

	<?php if ( in_array( $current_status, [ 'sent', 'sent_with_errors' ], true ) ) : ?>
		<p>Version 1 blockiert absichtliche Doppelsendungen pro Artikel. Fuer einen erneuten Versand koennte spaeter ein expliziter Resend-Flow ergaenzt werden.</p>
	<?php else : ?>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'nexus_queue_blog_notification_' . $post->ID, 'nexus_blog_notify_nonce' ); ?>
			<input type="hidden" name="action" value="nexus_queue_blog_notification">
			<input type="hidden" name="post_id" value="<?php echo esc_attr( (string) $post->ID ); ?>">
			<button type="submit" class="button button-primary button-large">Benachrichtigung jetzt senden</button>
		</form>
		<p style="margin-top:10px;">Der Versand wird manuell pro Artikel angestossen und dann in kleinen Batches an bestaetigte Blog-Abonnenten verarbeitet.</p>
	<?php endif; ?>
	<?php
}

/**
 * Handle the manual admin action to queue a post notification.
 *
 * @return void
 */
function nexus_handle_queue_blog_notification_action() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( 'Keine Berechtigung.' );
	}

	$post_id = isset( $_POST['post_id'] ) ? absint( wp_unslash( $_POST['post_id'] ) ) : 0;

	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) ) {
		wp_die( 'Keine Berechtigung.' );
	}

	if ( empty( $_POST['nexus_blog_notify_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexus_blog_notify_nonce'] ) ), 'nexus_queue_blog_notification_' . $post_id ) ) {
		wp_die( 'Ungueltige Anfrage.' );
	}

	$result = nexus_queue_blog_notification( $post_id, get_current_user_id() );
	$notice = is_wp_error( $result ) ? 'error' : ( ! empty( $result['queued'] ) ? 'queued' : 'skipped' );

	wp_safe_redirect(
		add_query_arg(
			[
				'nexus_blog_notify_notice' => $notice,
			],
			get_edit_post_link( $post_id, 'url' )
		)
	);
	exit;
}
add_action( 'admin_post_nexus_queue_blog_notification', 'nexus_handle_queue_blog_notification_action' );

/**
 * Show admin notices for manual blog notification actions.
 *
 * @return void
 */
function nexus_render_blog_notify_admin_notice() {
	if ( ! is_admin() ) {
		return;
	}

	$notice = isset( $_GET['nexus_blog_notify_notice'] ) ? sanitize_key( (string) wp_unslash( $_GET['nexus_blog_notify_notice'] ) ) : '';
	if ( '' === $notice ) {
		return;
	}

	$messages = [
		'queued'  => [ 'class' => 'notice notice-success is-dismissible', 'text' => 'Die Artikel-Benachrichtigung wurde in die Queue gelegt und der erste Batch wurde bereits verarbeitet.' ],
		'skipped' => [ 'class' => 'notice notice-warning is-dismissible', 'text' => 'Es gibt aktuell keine aktiven Blog-Abonnenten fuer diesen Versand.' ],
		'error'   => [ 'class' => 'notice notice-error is-dismissible', 'text' => 'Die Benachrichtigung konnte gerade nicht gestartet werden.' ],
	];

	if ( empty( $messages[ $notice ] ) ) {
		return;
	}
	?>
	<div class="<?php echo esc_attr( $messages[ $notice ]['class'] ); ?>">
		<p><?php echo esc_html( $messages[ $notice ]['text'] ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'nexus_render_blog_notify_admin_notice' );

/**
 * Queue an article notification for active blog subscribers.
 *
 * @param int $post_id Post ID.
 * @param int $user_id User ID who initiated the queue.
 * @return array|WP_Error
 */
function nexus_queue_blog_notification( $post_id, $user_id = 0 ) {
	$post = get_post( $post_id );

	if ( ! $post instanceof WP_Post || 'post' !== $post->post_type || 'publish' !== $post->post_status ) {
		return new WP_Error( 'invalid_post', 'Der Artikel ist nicht veroeffentlicht.' );
	}

	$current_status = (string) get_post_meta( $post_id, '_nexus_blog_notify_status', true );

	if ( in_array( $current_status, [ 'queued', 'processing', 'sent', 'sent_with_errors' ], true ) ) {
		return new WP_Error( 'already_processed', 'Fuer diesen Artikel wurde bereits eine Benachrichtigung angestossen.' );
	}

	$recipient_ids = nexus_get_active_blog_subscriber_ids();

	if ( empty( $recipient_ids ) ) {
		update_post_meta( $post_id, '_nexus_blog_notify_status', 'skipped_no_recipients' );
		update_post_meta( $post_id, '_nexus_blog_notify_recipient_count', 0 );
		update_post_meta( $post_id, '_nexus_blog_notify_processed_count', 0 );
		update_post_meta( $post_id, '_nexus_blog_notify_success_count', 0 );
		update_post_meta( $post_id, '_nexus_blog_notify_failure_count', 0 );
		update_post_meta( $post_id, '_nexus_blog_notify_last_error', '' );

		return [
			'queued' => false,
			'count'  => 0,
		];
	}

	wp_clear_scheduled_hook( 'nexus_process_blog_notification_event', [ $post_id ] );

	update_post_meta( $post_id, '_nexus_blog_notify_status', 'queued' );
	update_post_meta( $post_id, '_nexus_blog_notify_requested_at', current_time( 'timestamp' ) );
	update_post_meta( $post_id, '_nexus_blog_notify_requested_by', (int) $user_id );
	update_post_meta( $post_id, '_nexus_blog_notify_recipient_ids', array_values( array_map( 'intval', $recipient_ids ) ) );
	update_post_meta( $post_id, '_nexus_blog_notify_recipient_count', count( $recipient_ids ) );
	update_post_meta( $post_id, '_nexus_blog_notify_processed_count', 0 );
	update_post_meta( $post_id, '_nexus_blog_notify_success_count', 0 );
	update_post_meta( $post_id, '_nexus_blog_notify_failure_count', 0 );
	update_post_meta( $post_id, '_nexus_blog_notify_last_error', '' );
	delete_post_meta( $post_id, '_nexus_blog_notify_sent_at' );

	nexus_process_blog_notification_queue( $post_id );

	return [
		'queued' => true,
		'count'  => count( $recipient_ids ),
	];
}

/**
 * Return the active, DOI-confirmed blog subscriber IDs.
 *
 * @return array<int, int>
 */
function nexus_get_active_blog_subscriber_ids() {
	$query = new WP_Query(
		[
			'post_type'      => 'nexus_contact',
			'post_status'    => 'private',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => [
				'relation' => 'AND',
				[
					'key'   => '_nexus_contact_segment_blog_notify',
					'value' => 1,
				],
				[
					'key'   => '_nexus_contact_blog_status',
					'value' => 'active',
				],
				[
					'key'   => '_nexus_contact_consent_blog_email',
					'value' => 'confirmed',
				],
			],
		]
	);

	return array_map( 'intval', $query->posts );
}

/**
 * Return the batch size for queued article notifications.
 *
 * @return int
 */
function nexus_get_blog_notification_batch_size() {
	return (int) apply_filters( 'nexus_blog_notification_batch_size', 25 );
}

/**
 * Process one batch of a queued article notification.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function nexus_process_blog_notification_queue( $post_id ) {
	$recipient_ids = get_post_meta( $post_id, '_nexus_blog_notify_recipient_ids', true );
	$recipient_ids = is_array( $recipient_ids ) ? array_values( array_map( 'intval', $recipient_ids ) ) : [];

	if ( empty( $recipient_ids ) ) {
		update_post_meta( $post_id, '_nexus_blog_notify_status', 'skipped_no_recipients' );
		return;
	}

	$processed_count = (int) get_post_meta( $post_id, '_nexus_blog_notify_processed_count', true );
	$success_count   = (int) get_post_meta( $post_id, '_nexus_blog_notify_success_count', true );
	$failure_count   = (int) get_post_meta( $post_id, '_nexus_blog_notify_failure_count', true );
	$batch_size      = max( 1, nexus_get_blog_notification_batch_size() );
	$batch_ids       = array_slice( $recipient_ids, $processed_count, $batch_size );

	if ( empty( $batch_ids ) ) {
		update_post_meta( $post_id, '_nexus_blog_notify_status', $failure_count > 0 ? 'sent_with_errors' : 'sent' );
		update_post_meta( $post_id, '_nexus_blog_notify_sent_at', current_time( 'timestamp' ) );
		return;
	}

	update_post_meta( $post_id, '_nexus_blog_notify_status', 'processing' );

	foreach ( $batch_ids as $contact_id ) {
		$sent = nexus_send_blog_post_notification_email( $contact_id, $post_id );

		if ( is_wp_error( $sent ) || ! $sent ) {
			$failure_count++;
			update_post_meta( $post_id, '_nexus_blog_notify_last_error', is_wp_error( $sent ) ? $sent->get_error_message() : 'Unbekannter Versandfehler.' );
		} else {
			$success_count++;
		}

		$processed_count++;
	}

	update_post_meta( $post_id, '_nexus_blog_notify_processed_count', $processed_count );
	update_post_meta( $post_id, '_nexus_blog_notify_success_count', $success_count );
	update_post_meta( $post_id, '_nexus_blog_notify_failure_count', $failure_count );

	if ( $processed_count < count( $recipient_ids ) ) {
		update_post_meta( $post_id, '_nexus_blog_notify_status', 'queued' );
		wp_clear_scheduled_hook( 'nexus_process_blog_notification_event', [ $post_id ] );
		wp_schedule_single_event( time() + 30, 'nexus_process_blog_notification_event', [ $post_id ] );
		return;
	}

	update_post_meta( $post_id, '_nexus_blog_notify_status', $failure_count > 0 ? 'sent_with_errors' : 'sent' );
	update_post_meta( $post_id, '_nexus_blog_notify_sent_at', current_time( 'timestamp' ) );
}
add_action( 'nexus_process_blog_notification_event', 'nexus_process_blog_notification_queue' );

/**
 * Send a published post notification to one active subscriber.
 *
 * @param int $contact_id Contact ID.
 * @param int $post_id    Post ID.
 * @return bool|WP_Error
 */
function nexus_send_blog_post_notification_email( $contact_id, $post_id ) {
	$email             = (string) get_post_meta( $contact_id, '_nexus_contact_email', true );
	$unsubscribe_token = (string) get_post_meta( $contact_id, '_nexus_contact_unsubscribe_token', true );
	$post              = get_post( $post_id );

	if ( '' === $email || ! $post instanceof WP_Post ) {
		return new WP_Error( 'invalid_payload', 'Empfaenger oder Artikel ungueltig.' );
	}

	if ( '' === $unsubscribe_token ) {
		$unsubscribe_token = nexus_generate_contact_token();
		update_post_meta( $contact_id, '_nexus_contact_unsubscribe_token', $unsubscribe_token );
	}

	$post_url         = get_permalink( $post_id );
	$unsubscribe_url  = nexus_get_blog_notify_url( [ 'action' => 'unsubscribe', 'token' => $unsubscribe_token ] );
	$post_title       = get_the_title( $post_id );
	$post_excerpt     = trim( (string) $post->post_excerpt );
	$post_description = '' !== $post_excerpt ? $post_excerpt : wp_trim_words( wp_strip_all_tags( $post->post_content ), 34 );
	$subject          = sprintf( '[%s] Neuer Artikel: %s', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ), $post_title );
	$content          = sprintf(
		'<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 20px 0; border-collapse:separate; border-spacing:0 10px;">
			<tr>
				<td style="padding:16px; border:1px solid rgba(255,255,255,0.08); border-radius:18px; background:rgba(255,255,255,0.03); font-family:Helvetica, Arial, sans-serif;">
					<div style="font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:#9ea8b2; margin-bottom:8px;">Neu online</div>
					<div style="font-size:22px; line-height:1.35; color:#f7f3ee; font-weight:700; margin-bottom:10px;">%1$s</div>
					<div style="font-size:14px; line-height:1.8; color:#c5ced7;">%2$s</div>
				</td>
			</tr>
		</table>
		<table role="presentation" width="100%%" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 18px 0;">
			<tr>
				<td>
					<a href="%3$s" style="display:inline-block; padding:14px 18px; border-radius:14px; background:#b46a3c; color:#fff8f3; text-decoration:none; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:700;">Artikel lesen</a>
				</td>
			</tr>
		</table>
		<p style="margin:0; font-family:Helvetica, Arial, sans-serif; font-size:13px; line-height:1.8; color:#c5ced7;">
			Wenn Sie diese Hinweise nicht mehr erhalten moechten, koennen Sie sich hier direkt abmelden:
			<a href="%4$s" style="color:#d3a98c; text-decoration:none;">Abmelden</a>
		</p>',
		esc_html( $post_title ),
		esc_html( $post_description ),
		esc_url( $post_url ),
		esc_url( $unsubscribe_url )
	);

	$html = nexus_get_blog_notify_email_shell(
		[
			'preheader' => $post_description,
			'eyebrow'   => 'Neue Artikel per E-Mail',
			'headline'  => $post_title,
			'intro'     => 'Ein neuer Beitrag ist online. Kurz, ohne Sales-Rauschen, nur der direkte Link zum Artikel.',
			'content'   => $content,
			'footer'    => 'Sie erhalten diese Mail, weil Sie neue Artikel per E-Mail bestaetigt haben.',
		]
	);

	return nexus_send_blog_notify_html_mail( $email, $subject, $html );
}
