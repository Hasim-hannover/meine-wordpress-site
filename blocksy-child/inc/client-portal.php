<?php
/**
 * NEXUS Client Portal
 * Shortcode: [hu_performance_cockpit]
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function hu_render_performance_cockpit() {
    if ( ! is_user_logged_in() ) {
        return hu_render_custom_login_form();
    }

    // Mock data (later dynamic).
    $client_data = [
        'name' => wp_get_current_user()->display_name,
        'retainer' => [ 'total' => 40, 'used'  => 15, 'label' => 'Growth Retainer L', 'focus' => 'Conversion Checkout' ],
        'kpis' => [
            [ 'label' => 'Leads (30d)', 'value' => '42', 'trend' => '+12%' ],
            [ 'label' => 'Core Web Vitals', 'value' => '98', 'trend' => 'Stabil' ],
        ],
        'roadmap' => [
            [ 'status' => 'done', 'task' => 'GTM Setup', 'impact' => 'Data Integrity' ],
            [ 'status' => 'active', 'task' => 'Checkout CRO', 'impact' => '-15% Abbruch' ],
        ],
    ];
    $percent = ( $client_data['retainer']['used'] / $client_data['retainer']['total'] ) * 100;

    ob_start();
    ?>
    <div class="nexus-dashboard">
        <header class="nd-header">
            <div class="nd-welcome">
                <span class="nd-badge">Insight Hub</span>
                <h2>Moin, <?php echo esc_html( $client_data['name'] ); ?></h2>
            </div>
            <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="btn btn-ghost btn-sm">Logout</a>
        </header>

        <div class="nd-grid">
            <div class="nd-card span-2">
                <h3>Ressourcen</h3>
                <div class="nd-progress-wrap">
                    <div class="nd-progress-bar" style="width:<?php echo esc_attr( $percent ); ?>%"></div>
                </div>
                <div class="nd-stats">
                    <span><?php echo esc_html( $client_data['retainer']['used'] ); ?> / <?php echo esc_html( $client_data['retainer']['total'] ); ?> Pkt</span>
                </div>
            </div>
            <?php foreach ( $client_data['kpis'] as $k ) : ?>
            <div class="nd-card kpi-card">
                <span class="muted"><?php echo esc_html( $k['label'] ); ?></span>
                <strong class="kpi-val"><?php echo esc_html( $k['value'] ); ?></strong>
            </div>
            <?php endforeach; ?>
            <div class="nd-card span-full">
                <h3>Roadmap</h3>
                <?php foreach ( $client_data['roadmap'] as $r ) : ?>
                <div class="nd-item status-<?php echo esc_attr( $r['status'] ); ?>">
                    <span class="dot"></span>
                    <span><?php echo esc_html( $r['task'] ); ?></span>
                    <small class="muted"><?php echo esc_html( $r['impact'] ); ?></small>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'hu_performance_cockpit', 'hu_render_performance_cockpit' );

function hu_render_custom_login_form() {
    ob_start();
    wp_login_form( [ 'redirect' => get_permalink() ] );
    return ob_get_clean();
}
