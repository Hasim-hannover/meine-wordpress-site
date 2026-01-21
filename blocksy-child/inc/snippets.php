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
