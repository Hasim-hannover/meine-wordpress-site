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

    $upload_notice = '';
    $upload_notice_type = 'notice';

    if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['nexus_upload_nonce'] ) ) {
        if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nexus_upload_nonce'] ) ), 'nexus_upload' ) ) {
            $upload_notice = 'Upload fehlgeschlagen: Sicherheitspruefung.';
            $upload_notice_type = 'error';
        } elseif ( ! current_user_can( 'upload_files' ) ) {
            $upload_notice = 'Upload fehlgeschlagen: Keine Berechtigung.';
            $upload_notice_type = 'error';
        } elseif ( empty( $_FILES['nexus_upload_file'] ) || ! isset( $_FILES['nexus_upload_file']['error'] ) ) {
            $upload_notice = 'Upload fehlgeschlagen: Datei fehlt.';
            $upload_notice_type = 'error';
        } else {
            $file = $_FILES['nexus_upload_file'];
            $max_size = 50 * 1024 * 1024;
            $allowed_ext = [ 'pdf', 'jpg', 'jpeg', 'png', 'mp4', 'mov', 'webm' ];
            $filetype = wp_check_filetype( $file['name'] );

            if ( $file['error'] !== UPLOAD_ERR_OK ) {
                $upload_notice = 'Upload fehlgeschlagen: Fehler beim Hochladen.';
                $upload_notice_type = 'error';
            } elseif ( $file['size'] > $max_size ) {
                $upload_notice = 'Upload fehlgeschlagen: Datei groesser als 50 MB.';
                $upload_notice_type = 'error';
            } elseif ( empty( $filetype['ext'] ) || ! in_array( strtolower( $filetype['ext'] ), $allowed_ext, true ) ) {
                $upload_notice = 'Upload fehlgeschlagen: Dateityp nicht erlaubt.';
                $upload_notice_type = 'error';
            } else {
                require_once ABSPATH . 'wp-admin/includes/file.php';
                $upload = wp_handle_upload( $file, [ 'test_form' => false ] );

                if ( isset( $upload['error'] ) ) {
                    $upload_notice = 'Upload fehlgeschlagen: ' . $upload['error'];
                    $upload_notice_type = 'error';
                } else {
                    $attachment = [
                        'guid'           => $upload['url'],
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => sanitize_file_name( pathinfo( $file['name'], PATHINFO_FILENAME ) ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                        'post_author'    => get_current_user_id(),
                    ];
                    $attach_id = wp_insert_attachment( $attachment, $upload['file'] );

                    if ( $attach_id ) {
                        require_once ABSPATH . 'wp-admin/includes/image.php';
                        $attach_data = wp_generate_attachment_metadata( $attach_id, $upload['file'] );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        $upload_notice = 'Upload erfolgreich.';
                        $upload_notice_type = 'success';
                    } else {
                        $upload_notice = 'Upload fehlgeschlagen: Anhang konnte nicht erstellt werden.';
                        $upload_notice_type = 'error';
                    }
                }
            }
        }
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
            <div class="nd-card span-full">
                <h3>Uploads</h3>
                <?php if ( $upload_notice ) : ?>
                    <div class="nd-upload-note <?php echo esc_attr( $upload_notice_type ); ?>">
                        <?php echo esc_html( $upload_notice ); ?>
                    </div>
                <?php endif; ?>
                <form class="nd-upload-form" method="post" enctype="multipart/form-data">
                    <?php wp_nonce_field( 'nexus_upload', 'nexus_upload_nonce' ); ?>
                    <input type="file" name="nexus_upload_file" accept=".pdf,.jpg,.jpeg,.png,.mp4,.mov,.webm" required>
                    <button type="submit" class="btn btn-primary">Datei hochladen</button>
                    <p class="muted">Erlaubt: PDF, JPG/PNG, MP4/MOV/WEBM. Max 50 MB.</p>
                </form>
                <?php
                $uploads = get_posts( [
                    'post_type'      => 'attachment',
                    'posts_per_page' => 10,
                    'author'         => get_current_user_id(),
                    'post_status'    => 'inherit',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
                ?>
                <?php if ( $uploads ) : ?>
                    <div class="nd-upload-list">
                        <?php foreach ( $uploads as $upload_item ) : ?>
                            <div class="nd-upload-item">
                                <a href="<?php echo esc_url( wp_get_attachment_url( $upload_item->ID ) ); ?>" target="_blank" rel="noopener">
                                    <?php echo esc_html( get_the_title( $upload_item->ID ) ); ?>
                                </a>
                                <span class="muted"><?php echo esc_html( get_the_date( '', $upload_item->ID ) ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <p class="muted">Noch keine Uploads vorhanden.</p>
                <?php endif; ?>
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

add_filter( 'upload_mimes', function( $mimes ) {
    $mimes['webm'] = 'video/webm';
    $mimes['mov'] = 'video/quicktime';
    return $mimes;
} );
