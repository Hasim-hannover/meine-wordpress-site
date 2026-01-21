<?php
/**
 * NEXUS SMART NAV BUTTON
 * Shortcode: [nexus_header_btn]
 * Zeigt "Login" oder "Cockpit" je nach Status.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_shortcode( 'nexus_header_btn', function() {
    $portal_page = get_page_by_path( 'portal' );
    $link = $portal_page ? get_permalink( $portal_page ) : home_url( '/portal' );
    $is_preview = is_customize_preview();

    if ( is_user_logged_in() && ! $is_preview ) {
        return '<a href="' . esc_url( $link ) . '" class="nexus-nav-btn active">Zum Cockpit <span class="indicator">●</span></a>';
    }

    return '<a href="' . esc_url( $link ) . '" class="nexus-nav-btn">Kunden-Login 🔒</a>';
} );

/**
 * Redirect default wp-login.php view to the portal page.
 */
add_action( 'login_init', function() {
    $action = isset( $_REQUEST['action'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : 'login';
    $bypass_actions = [ 'logout', 'lostpassword', 'retrievepassword', 'resetpass', 'rp' ];

    if ( in_array( $action, $bypass_actions, true ) ) {
        return;
    }

    $portal_page = get_page_by_path( 'portal' );
    if ( ! $portal_page ) {
        return;
    }

    wp_safe_redirect( get_permalink( $portal_page ) );
    exit;
} );

/* =========================================
   NEXUS SECURITY: HIDE ADMIN FOR CLIENTS
   ========================================= */

// 1. Admin-Leiste (schwarzer Balken) fuer Kunden ausblenden
add_action( 'after_setup_theme', function() {
    if ( ! current_user_can( 'manage_options' ) ) {
        show_admin_bar( false );
    }
} );

// 2. Zugriff auf /wp-admin blockieren
add_action( 'admin_init', function() {
    if ( is_user_logged_in() && ! current_user_can( 'manage_options' ) && ! wp_doing_ajax() ) {
        wp_safe_redirect( home_url( '/portal' ) );
        exit;
    }
} );

// 3. Login-Redirect korrigieren (Falls WP-Login genutzt wird)
add_filter( 'login_redirect', function( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( ! in_array( 'administrator', $user->roles, true ) ) {
            return home_url( '/portal' );
        }
    }
    return $redirect_to;
}, 10, 3 );
