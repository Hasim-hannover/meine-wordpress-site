<?php
/**
 * Review CRM and intake funnel for the Startseiten-Review.
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
		'sent'      => 'Rueckmeldung gesendet',
		'won'       => 'Gespraech / Auftrag',
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
 * Return the predefined blocker options from the intake form.
 *
 * @return array<string, string>
 */
function nexus_get_review_issue_options() {
	return [
		'too_few_inquiries' => 'Zu wenig qualifizierte Anfragen',
		'weak_message'      => 'Das Seitenversprechen ist zu unscharf',
		'weak_conversion'   => 'Die Seite fuehrt nicht sauber zur Anfrage',
		'second_opinion'    => 'Ich will eine zweite strategische Meinung',
	];
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
				'name'               => 'Review-Anfragen',
				'singular_name'      => 'Review-Anfrage',
				'menu_name'          => 'Review-Anfragen',
				'name_admin_bar'     => 'Review-Anfrage',
				'add_new'            => 'Neu',
				'add_new_item'       => 'Neue Review-Anfrage',
				'edit_item'          => 'Review-Anfrage bearbeiten',
				'new_item'           => 'Neue Review-Anfrage',
				'view_item'          => 'Review-Anfrage ansehen',
				'search_items'       => 'Review-Anfragen suchen',
				'not_found'          => 'Keine Review-Anfragen gefunden.',
				'not_found_in_trash' => 'Keine Review-Anfragen im Papierkorb.',
				'all_items'          => 'Alle Review-Anfragen',
			],
			'public'              => false,
			'publicly_queryable'  => false,
			'show_ui'             => true,
			'show_in_menu'        => 'nexus-review-crm',
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
		'Review CRM',
		'Review CRM',
		'edit_pages',
		'nexus-review-crm',
		'nexus_render_review_crm_dashboard',
		'dashicons-clipboard',
		58
	);

	add_submenu_page(
		'nexus-review-crm',
		'CRM Dashboard',
		'Dashboard',
		'edit_pages',
		'nexus-review-crm',
		'nexus_render_review_crm_dashboard'
	);
}
add_action( 'admin_menu', 'nexus_register_review_crm_menu' );

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

	$is_crm_dashboard = 'toplevel_page_nexus-review-crm' === $hook;
	$is_review_screen = 'nexus_review_request' === $screen->post_type;
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
	register_rest_route(
		'nexus/v1',
		'/review-request',
		[
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'nexus_handle_review_request_submission',
			'permission_callback' => '__return_true',
		]
	);
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
				'error' => 'Die Anfrage konnte gerade nicht gespeichert werden. Bitte spaeter erneut versuchen.',
			],
			500
		);
	}

	nexus_send_review_request_admin_notification( $post_id, $validated );
	nexus_send_review_request_confirmation( $validated );

	return new WP_REST_Response(
		[
			'ok'         => true,
			'requestId'  => $post_id,
			'message'    => 'Ihre Anfrage ist eingegangen. Sie erhalten innerhalb von 48 Stunden eine persoenliche Rueckmeldung.',
			'editUrl'    => get_edit_post_link( $post_id, 'raw' ),
			'status'     => 'received',
			'statusLabel'=> 'Neu',
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
	$page_url      = isset( $payload['page_url'] ) ? trim( (string) $payload['page_url'] ) : '';
	$offer         = isset( $payload['offer'] ) ? sanitize_textarea_field( (string) $payload['offer'] ) : '';
	$audience      = isset( $payload['audience'] ) ? sanitize_textarea_field( (string) $payload['audience'] ) : '';
	$biggest_issue = isset( $payload['biggest_issue'] ) ? sanitize_key( (string) $payload['biggest_issue'] ) : '';
	$extra_context = isset( $payload['extra_context'] ) ? sanitize_textarea_field( (string) $payload['extra_context'] ) : '';
	$name          = isset( $payload['name'] ) ? sanitize_text_field( (string) $payload['name'] ) : '';
	$email         = isset( $payload['email'] ) ? sanitize_email( (string) $payload['email'] ) : '';
	$company       = isset( $payload['company'] ) ? sanitize_text_field( (string) $payload['company'] ) : '';

	if ( empty( $page_url ) ) {
		return new WP_Error( 'missing_page_url', 'Bitte die URL der Seite angeben.' );
	}

	$page_url = esc_url_raw( $page_url );
	if ( ! $page_url || ! wp_http_validate_url( $page_url ) ) {
		return new WP_Error( 'invalid_page_url', 'Bitte eine gueltige URL angeben, z. B. https://example.de.' );
	}

	$scheme = wp_parse_url( $page_url, PHP_URL_SCHEME );
	if ( ! in_array( $scheme, [ 'http', 'https' ], true ) ) {
		return new WP_Error( 'invalid_scheme', 'Nur http- oder https-URLs sind erlaubt.' );
	}

	if ( empty( $offer ) ) {
		return new WP_Error( 'missing_offer', 'Bitte kurz beschreiben, was diese Seite verkaufen oder ausloesen soll.' );
	}

	if ( empty( $audience ) ) {
		return new WP_Error( 'missing_audience', 'Bitte angeben, wen diese Seite ueberzeugen soll.' );
	}

	$issue_options = nexus_get_review_issue_options();
	if ( empty( $biggest_issue ) || ! isset( $issue_options[ $biggest_issue ] ) ) {
		return new WP_Error( 'missing_issue', 'Bitte das groesste Problem auswaehlen.' );
	}

	if ( empty( $name ) ) {
		return new WP_Error( 'missing_name', 'Bitte Ihren Namen angeben.' );
	}

	if ( empty( $email ) || ! is_email( $email ) ) {
		return new WP_Error( 'invalid_email', 'Bitte eine gueltige geschaeftliche E-Mail-Adresse angeben.' );
	}

	if ( empty( $company ) ) {
		return new WP_Error( 'missing_company', 'Bitte den Unternehmensnamen angeben.' );
	}

	return [
		'page_url'          => $page_url,
		'domain'            => (string) wp_parse_url( $page_url, PHP_URL_HOST ),
		'offer'             => $offer,
		'audience'          => $audience,
		'biggest_issue'     => $biggest_issue,
		'biggest_issue_label'=> $issue_options[ $biggest_issue ],
		'extra_context'     => $extra_context,
		'name'              => $name,
		'email'             => $email,
		'company'           => $company,
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
	update_post_meta( $post_id, '_nexus_review_page_url', $payload['page_url'] );
	update_post_meta( $post_id, '_nexus_review_domain', $payload['domain'] );
	update_post_meta( $post_id, '_nexus_review_offer', $payload['offer'] );
	update_post_meta( $post_id, '_nexus_review_audience', $payload['audience'] );
	update_post_meta( $post_id, '_nexus_review_biggest_issue', $payload['biggest_issue'] );
	update_post_meta( $post_id, '_nexus_review_biggest_issue_label', $payload['biggest_issue_label'] );
	update_post_meta( $post_id, '_nexus_review_extra_context', $payload['extra_context'] );
	update_post_meta( $post_id, '_nexus_review_name', $payload['name'] );
	update_post_meta( $post_id, '_nexus_review_email', $payload['email'] );
	update_post_meta( $post_id, '_nexus_review_company', $payload['company'] );
	update_post_meta( $post_id, '_nexus_review_source', 'startseiten_review_funnel' );

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
		return new WP_Error( 'rate_limited', 'Zu viele Anfragen in kurzer Zeit. Bitte spaeter erneut versuchen.' );
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
 * Send the internal notification email for a new request.
 *
 * @param int   $post_id Request post ID.
 * @param array $payload Validated payload.
 * @return void
 */
function nexus_send_review_request_admin_notification( $post_id, $payload ) {
	$recipient = apply_filters( 'nexus_review_notification_email', get_option( 'admin_email' ) );
	if ( ! $recipient || ! is_email( $recipient ) ) {
		return;
	}

	$subject = sprintf(
		'[Startseiten-Review] Neue Anfrage - %s',
		$payload['company']
	);

	$lines = [
		'Neue Anfrage fuer den Startseiten-Review.',
		'',
		'Unternehmen: ' . $payload['company'],
		'Name: ' . $payload['name'],
		'E-Mail: ' . $payload['email'],
		'URL: ' . $payload['page_url'],
		'Seitenziel: ' . $payload['offer'],
		'Zielgruppe: ' . $payload['audience'],
		'Groesster Blocker: ' . $payload['biggest_issue_label'],
	];

	if ( ! empty( $payload['extra_context'] ) ) {
		$lines[] = 'Zusatzkontext: ' . $payload['extra_context'];
	}

	$lines[] = '';
	$lines[] = 'Direkt in WordPress bearbeiten:';
	$lines[] = admin_url( 'post.php?post=' . $post_id . '&action=edit' );

	wp_mail( $recipient, $subject, implode( "\n", $lines ) );
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

	$calendar_url = apply_filters( 'nexus_review_calendar_url', 'https://cal.com/hasim/30min' );
	$subject      = sprintf( '[%s] Startseiten-Review erhalten', wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES ) );

	$lines = [
		'Hallo ' . $payload['name'] . ',',
		'',
		'Ihre Anfrage fuer den Startseiten-Review ist eingegangen.',
		'Ich melde mich innerhalb von 48 Stunden mit einer persoenlichen Einschaetzung zu:',
		'- den drei wichtigsten Anfragebremsen',
		'- der sinnvollsten Prioritaet',
		'- dem naechsten konkreten Schritt',
		'',
		'Gepruefte Seite: ' . $payload['page_url'],
		'',
		'Wenn es dringender ist, koennen Sie direkt hier einen Termin reservieren:',
		$calendar_url,
		'',
		'Viele Gruesse',
		'Hasim Uener',
	];

	wp_mail( $payload['email'], $subject, implode( "\n", $lines ) );
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
	$page_url      = (string) get_post_meta( $post->ID, '_nexus_review_page_url', true );
	$offer         = (string) get_post_meta( $post->ID, '_nexus_review_offer', true );
	$audience      = (string) get_post_meta( $post->ID, '_nexus_review_audience', true );
	$issue_label   = (string) get_post_meta( $post->ID, '_nexus_review_biggest_issue_label', true );
	$extra_context = (string) get_post_meta( $post->ID, '_nexus_review_extra_context', true );
	$name          = (string) get_post_meta( $post->ID, '_nexus_review_name', true );
	$email         = (string) get_post_meta( $post->ID, '_nexus_review_email', true );
	$company       = (string) get_post_meta( $post->ID, '_nexus_review_company', true );
	?>
	<div class="nexus-review-meta">
		<div class="nexus-review-meta-group">
			<strong>Unternehmen</strong>
			<p><?php echo esc_html( $company ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Kontakt</strong>
			<p><?php echo esc_html( $name ); ?><br><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Seite</strong>
			<p><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page_url ); ?></a></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Was soll die Seite verkaufen?</strong>
			<p><?php echo nl2br( esc_html( $offer ) ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Wen soll die Seite ueberzeugen?</strong>
			<p><?php echo nl2br( esc_html( $audience ) ); ?></p>
		</div>
		<div class="nexus-review-meta-group">
			<strong>Groesster Blocker</strong>
			<p><?php echo esc_html( $issue_label ); ?></p>
		</div>
		<?php if ( '' !== $extra_context ) : ?>
			<div class="nexus-review-meta-group">
				<strong>Zusatzkontext</strong>
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
		<label for="nexus-review-priority"><strong>Prioritaet</strong></label><br>
		<select id="nexus-review-priority" name="nexus_review_priority" class="widefat">
			<?php foreach ( $priority_options as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current_priority, $value ); ?>><?php echo esc_html( $label ); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<strong>Faelligkeitsziel</strong><br>
		<span><?php echo esc_html( $due_at ? wp_date( 'd.m.Y H:i', $due_at ) : 'n/a' ); ?></span>
	</p>
	<p>
		<strong>Rueckmeldung gesendet</strong><br>
		<span><?php echo esc_html( $sent_at ? wp_date( 'd.m.Y H:i', $sent_at ) : 'Noch nicht markiert' ); ?></span>
	</p>
	<p>
		<label for="nexus-review-delivery-url"><strong>Review-Link / Loom</strong></label><br>
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
		'review_status'   => 'Status',
		'review_priority' => 'Prioritaet',
		'review_page'     => 'Seite',
		'review_goal'     => 'Seitenziel',
		'review_contact'  => 'Kontakt',
		'review_due'      => 'Faellig',
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
			echo esc_html( wp_trim_words( (string) get_post_meta( $post_id, '_nexus_review_offer', true ), 12 ) );
			break;

		case 'review_contact':
			$company = (string) get_post_meta( $post_id, '_nexus_review_company', true );
			$name    = (string) get_post_meta( $post_id, '_nexus_review_name', true );
			$email   = (string) get_post_meta( $post_id, '_nexus_review_email', true );
			echo '<strong>' . esc_html( $company ) . '</strong><br>';
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
		<option value="">Alle Prioritaeten</option>
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
		'new'       => nexus_count_review_requests_by_status( 'new' ),
		'in_review' => nexus_count_review_requests_by_status( 'in_review' ),
		'sent'      => nexus_count_review_requests_by_status( 'sent' ),
		'overdue'   => nexus_count_overdue_review_requests(),
	];

	$recent_requests = get_posts(
		[
			'post_type'              => 'nexus_review_request',
			'post_status'            => 'private',
			'posts_per_page'         => 8,
			'orderby'                => 'date',
			'order'                  => 'DESC',
			'no_found_rows'          => true,
			'update_post_meta_cache' => true,
			'update_post_term_cache' => false,
		]
	);
	?>
	<div class="wrap nexus-review-dashboard">
		<h1>Review CRM</h1>
		<p class="nexus-review-dashboard-intro">Hier laufen alle persoenlichen Startseiten-Reviews zusammen. Ziel: Rueckmeldung innerhalb von 48 Stunden.</p>

		<div class="nexus-review-stats">
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request&nexus_review_status=new' ) ); ?>">
				<span class="nexus-review-stat-label">Neu</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['new'] ); ?></strong>
			</a>
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request&nexus_review_status=in_review' ) ); ?>">
				<span class="nexus-review-stat-label">In Bearbeitung</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['in_review'] ); ?></strong>
			</a>
			<a class="nexus-review-stat-card" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request&nexus_review_status=sent' ) ); ?>">
				<span class="nexus-review-stat-label">Gesendet</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['sent'] ); ?></strong>
			</a>
			<a class="nexus-review-stat-card nexus-review-stat-card-warning" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request' ) ); ?>">
				<span class="nexus-review-stat-label">Ueberfaellig</span>
				<strong class="nexus-review-stat-value"><?php echo esc_html( (string) $counts['overdue'] ); ?></strong>
			</a>
		</div>

		<div class="nexus-review-panel">
			<div class="nexus-review-panel-head">
				<h2>Letzte Anfragen</h2>
				<a class="button button-secondary" href="<?php echo esc_url( admin_url( 'edit.php?post_type=nexus_review_request' ) ); ?>">Alle Anfragen</a>
			</div>

			<?php if ( empty( $recent_requests ) ) : ?>
				<p>Noch keine Review-Anfragen vorhanden.</p>
			<?php else : ?>
				<table class="widefat fixed striped nexus-review-table">
					<thead>
						<tr>
							<th>Lead</th>
							<th>Status</th>
							<th>Seite</th>
							<th>Faellig</th>
							<th>Aktion</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $recent_requests as $request_post ) : ?>
							<?php
							$status   = (string) get_post_meta( $request_post->ID, '_nexus_review_status', true );
							$company  = (string) get_post_meta( $request_post->ID, '_nexus_review_company', true );
							$name     = (string) get_post_meta( $request_post->ID, '_nexus_review_name', true );
							$page_url = (string) get_post_meta( $request_post->ID, '_nexus_review_page_url', true );
							$due_at   = (int) get_post_meta( $request_post->ID, '_nexus_review_due_at', true );
							?>
							<tr>
								<td>
									<strong><?php echo esc_html( $company ); ?></strong><br>
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
								<td><a class="button button-small" href="<?php echo esc_url( get_edit_post_link( $request_post->ID ) ); ?>">Oeffnen</a></td>
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
		'Review CRM Snapshot',
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
	$new_count      = nexus_count_review_requests_by_status( 'new' );
	$review_count   = nexus_count_review_requests_by_status( 'in_review' );
	$overdue_count  = nexus_count_overdue_review_requests();
	$latest_request = get_posts(
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
		<p><strong>Neu:</strong> <?php echo esc_html( (string) $new_count ); ?> | <strong>In Bearbeitung:</strong> <?php echo esc_html( (string) $review_count ); ?> | <strong>Ueberfaellig:</strong> <?php echo esc_html( (string) $overdue_count ); ?></p>
		<?php if ( ! empty( $latest_request ) ) : ?>
			<?php
			$latest = $latest_request[0];
			$company = (string) get_post_meta( $latest->ID, '_nexus_review_company', true );
			$page_url = (string) get_post_meta( $latest->ID, '_nexus_review_page_url', true );
			?>
			<p><strong>Letzte Anfrage:</strong> <?php echo esc_html( $company ); ?><br><a href="<?php echo esc_url( $page_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $page_url ); ?></a></p>
		<?php endif; ?>
		<p><a class="button button-secondary" href="<?php echo esc_url( admin_url( 'admin.php?page=nexus-review-crm' ) ); ?>">Zum CRM</a></p>
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
