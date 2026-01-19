<?php
/**
 * Blocksy Child - Nexus Ultimate Edition
 * STATUS: CLEAN & SAFE. Bereinigt & Präzise.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// --- 1. EXTERNE DATEIEN LADEN ---
$inc_dir = get_stylesheet_directory() . '/inc/';

// Nur Dateien laden, die es wirklich gibt
$files_to_load = ['shortcodes.php', 'org-schema.php'];

foreach ( $files_to_load as $file ) {
    if ( file_exists( $inc_dir . $file ) ) {
        require_once $inc_dir . $file;
    }
}

// --- 2. STYLES & SCRIPTS (Performance-Optimiert) ---
add_action( 'wp_enqueue_scripts', function () {
    
    // Parent Theme Styles
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri(), [], '9.4.1' );

    // A) Startseite, Archiv & Home
    if ( is_front_page() || is_home() || is_archive() ) {
        wp_enqueue_style( 'nexus-home-css', get_stylesheet_directory_uri() . '/assets/css/homepage.css', [], time() );
        wp_enqueue_script( 'nexus-home-js', get_stylesheet_directory_uri() . '/assets/js/homepage.js', [], time(), true );
    }

    // B) Blog-Archive Skripte
    if ( is_home() ) {
         wp_enqueue_script( 'nexus-archive-js', get_stylesheet_directory_uri() . '/assets/js/blog-archive.js', [], '6.0.0', true );
    }

    // C) NUR Einzelbeitrag (Blog Post) - Nexus Layout
    // Hier nutzen wir is_singular('post') für absolute Präzision
    if ( is_singular('post') ) {
        // Falls du eine separate CSS Datei für Single Posts hast:
        if ( file_exists( get_stylesheet_directory() . '/assets/css/single.css' ) ) {
            wp_enqueue_style( 'nexus-single-css', get_stylesheet_directory_uri() . '/assets/css/single.css', [], time() );
        }
        
        // CSS-Fix NUR für Blog-Beiträge
        $custom_css = "
            .single-post .entry-header .entry-title,
            .single-post .ct-page-title {
                display: none !important;
            }
        ";
        wp_add_inline_style( 'blocksy-child-style', $custom_css );
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

// --- 5. JS-INJEKTION (TOC / Inhaltsverzeichnis) ---
add_action('wp_footer', function() {
    
    // ⚠️ DER GATEKEEPER:
    // is_singular('post') = Nur auf echten Blog-Artikeln.
    // !is_singular('post') = Wenn KEIN Blog-Artikel, dann sofort raus hier.
    // Damit wird der Code auf "normalen" Seiten (Impressum, Startseite) NICHT geladen.
    if ( ! is_singular( 'post' ) ) {
        return; 
    }

    ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Inhaltsverzeichnis generieren
        const tocList = document.getElementById('toc-list');
        // Wir suchen nur innerhalb von article-content nach Headlines, um Sidebars etc. nicht zu erwischen
        const headings = document.querySelectorAll('#article-content h2, #article-content h3');
        
        if (tocList && headings.length > 0) {
            headings.forEach((heading, index) => {
                // ID vergeben, falls keine da ist
                if (!heading.id) {
                    heading.id = 'toc-' + index;
                }
                
                // Link erstellen
                const li = document.createElement('li');
                const link = document.createElement('a');
                link.href = '#' + heading.id;
                link.textContent = heading.textContent;
                
                // Einrücken für H3
                if (heading.tagName === 'H3') {
                    li.style.marginLeft = '15px';
                    li.style.fontSize = '0.9em';
                }
                
                li.appendChild(link);
                tocList.appendChild(li);
            });
        }
    });
    </script>
    <?php
});
?>