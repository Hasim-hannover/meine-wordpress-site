<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * STATUS: CLEAN & SAFE. Bereinigt & Präzise.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';

// Nur Dateien laden, die es wirklich gibt
$files_to_load = ['shortcodes.php', 'org-schema.php', 'client-portal.php', 'admin-manager.php', 'snippets.php'];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS (Performance-Optimiert) ---
add_action( 'wp_enqueue_scripts', function () {
    $css_dir = get_stylesheet_directory() . '/assets/css/';
    $css_uri = get_stylesheet_directory_uri() . '/assets/css/';
    $js_dir  = get_stylesheet_directory() . '/assets/js/';
    $js_uri  = get_stylesheet_directory_uri() . '/assets/js/';

    // Parent Theme Styles
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.5.0' );

    // GLOBAL: Design System (Single Source of Truth - alle Seiten)
    wp_enqueue_style(
        'nexus-design-system',
        $css_uri . 'design-system.css',
        [ 'blocksy-child-style' ],
        filemtime( $css_dir . 'design-system.css' )
    );

    // GLOBAL: Core JS (Scroll-Spy, FAQ, Counter, Progress Bar)
    wp_enqueue_script(
        'nexus-core-js',
        $js_uri . 'nexus-core.js',
        [],
        filemtime( $js_dir . 'nexus-core.js' ),
        true
    );

    // A) Startseite & Blog-Home
    if ( is_front_page() || is_home() ) {
        wp_enqueue_style( 'nexus-home-css', $css_uri . 'homepage.css', [ 'nexus-design-system' ], filemtime( $css_dir . 'homepage.css' ) );
        wp_enqueue_script( 'nexus-home-js', $js_uri . 'homepage.js', [ 'nexus-core-js' ], filemtime( $js_dir . 'homepage.js' ), true );
    }

    // B) Blog-Archive Skripte
    if ( is_home() ) {
        wp_enqueue_script( 'nexus-archive-js', $js_uri . 'blog-archive.js', [ 'nexus-core-js' ], filemtime( $js_dir . 'blog-archive.js' ), true );
    }

    // C) Archiv & Kategorie Seiten
    if ( is_archive() && ! is_home() ) {
        wp_enqueue_style( 'nexus-home-css', $css_uri . 'homepage.css', [ 'nexus-design-system' ], filemtime( $css_dir . 'homepage.css' ) );
    }

    // D) NUR Einzelbeitrag (Blog Post)
    if ( is_singular( 'post' ) ) {
        if ( file_exists( $css_dir . 'single.css' ) ) {
            wp_enqueue_style( 'nexus-single-css', $css_uri . 'single.css', [ 'nexus-design-system' ], filemtime( $css_dir . 'single.css' ) );
        }

        $custom_css = "
            .single-post .entry-header .entry-title,
            .single-post .ct-page-title {
                display: none !important;
            }
        ";
        wp_add_inline_style( 'blocksy-child-style', $custom_css );
    }

    // E) Template: Nexus Über Mich
    if ( is_page_template( 'template-about.php' ) ) {
        if ( file_exists( $css_dir . 'about-page.css' ) ) {
            wp_enqueue_style( 'nexus-about-css', $css_uri . 'about-page.css', [ 'nexus-design-system' ], filemtime( $css_dir . 'about-page.css' ) );
        }
        // About-Page JS nicht mehr nötig → NexusCore.initScrollSpy übernimmt
    }

    // F) Template: Agentur Service  
    if ( is_page_template( 'page-wordpress-agentur.php' ) || is_page( 'wordpress-agentur' ) ) {
        if ( file_exists( $css_dir . 'agentur.css' ) ) {
            wp_enqueue_style( 'nexus-agentur-css', $css_uri . 'agentur.css', [ 'nexus-design-system' ], filemtime( $css_dir . 'agentur.css' ) );
        }
    }

}, 20 );

// --- 3. PERFORMANCE & FONTS ---
add_action( 'wp_head', function () {
    $font = get_stylesheet_directory_uri() . '/fonts';
    
    // Preload Satoshi
    echo '<link rel="preload" href="' . $font . '/Satoshi-Variable.woff2" as="font" type="font/woff2" crossorigin>';
    echo "<style>@font-face { font-family: 'Satoshi'; src: url('$font/Satoshi-Variable.woff2') format('woff2-variations'); font-weight: 300 900; font-display: swap; font-style: normal; }</style>";
    
    // Footer Background Fix
    echo '<style>.ft { background: #0a0a0a; }</style>';
}, 5 );

// --- 4. TITEL-LOGIK ---
add_filter('blocksy:post_types:post:has_page_title', '__return_false');

/**
 * NEXUS FEATURE: Automatische Lesezeit
 */
function nexus_get_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Annahme: 200 Wörter pro Minute
    return $reading_time;
}

// --- 5. TOC & SCROLL-SPY ---
// Wird jetzt zentral über nexus-core.js gesteuert (NexusCore.initToc)
/**
 * NEXUS GLOBAL HELPER: Share Buttons (Definition)
 * Das hier ist nur der BAUPLAN. Es zeigt noch nichts an!
 */
function nexus_render_share_buttons() {
    ?>
    <div class="nexus-share-box">
        <span class="share-label">Teilen:</span>
        
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="nexus-share-btn linkedin" title="Auf LinkedIn teilen">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
        </a>

        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_the_permalink()); ?>" target="_blank" rel="noopener" class="nexus-share-btn whatsapp" title="Per WhatsApp senden">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
        </a>

        <a href="https://instagram.com/hasimuener" target="_blank" rel="noopener" class="nexus-share-btn instagram" title="Auf Instagram besuchen">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
        </a>

        <button onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>');alert('Link in Zwischenablage kopiert!');" class="nexus-share-btn copy" title="Link kopieren">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
        </button>
    </div>
    <?php
}

?>
