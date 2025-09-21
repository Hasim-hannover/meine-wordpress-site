<?php
/**
 * Blocksy Child Theme functions and definitions
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'CHILD_THEME_PATH', get_stylesheet_directory() );

// Lädt das Haupt-Stylesheet
add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'blocksy-child-style', get_stylesheet_uri() );
} );

// Lädt die Theme-Konfigurationsdateien
require_once CHILD_THEME_PATH . '/inc/theme-setup.php';
require_once CHILD_THEME_PATH . '/inc/shortcodes.php';

/**
 * ===================================================================
 * NEU: Skripte und Styles für einzelne Blogbeiträge laden
 * ===================================================================
 */
function hu_enqueue_single_post_assets() {
    // Nur laden, wenn es sich um einen einzelnen Beitrag handelt.
    if ( is_singular('post') ) {
        // Lade das CSS für Blogartikel
        wp_enqueue_style(
            'hu-blog-single-style',
            get_stylesheet_directory_uri() . '/assets/css/blog-single.css',
            [],
            filemtime( get_stylesheet_directory() . '/assets/css/blog-single.css' )
        );

        // Lade das JavaScript für Blogartikel
        wp_enqueue_script(
            'hu-blog-single-script',
            get_stylesheet_directory_uri() . '/assets/js/blog-single.js',
            [],
            filemtime( get_stylesheet_directory() . '/assets/js/blog-single.js' ),
            true // Lädt das Skript im Footer
        );
    }
}
add_action( 'wp_enqueue_scripts', 'hu_enqueue_single_post_assets' );


/**
 * ===================================================================
 * FINALE RANK MATH INTEGRATION (per JavaScript)
 * ===================================================================
 * Lädt das Integrations-Skript, das den Shortcode-Inhalt für die
 * Rank Math Analyse im Editor bereitstellt.
 */
add_action( 'admin_enqueue_scripts', function( $hook ) {
    // Stellt sicher, dass das Skript nur auf "post.php" (Beiträge/Seiten bearbeiten) geladen wird.
    if ( 'post.php' !== $hook ) {
        return;
    }

    // Holt die ID des aktuellen Posts
    $post_id = get_the_ID();
    // Holt die ID der als Startseite festgelegten Seite
    $front_page_id = get_option( 'page_on_front' );

    // Lädt das Skript nur, wenn die bearbeitete Seite die Startseite ist.
    if ( $post_id == $front_page_id ) {
        wp_enqueue_script(
            'rank-math-child-integration',
            get_stylesheet_directory_uri() . '/assets/js/rank-math-integration.js',
            [ 'wp-hooks', 'wp-data' ], // Wichtige Abhängigkeiten für Rank Math
            filemtime( get_stylesheet_directory() . '/assets/js/rank-math-integration.js' ),
            true
        );
    }
} );

/**
 * Leitet alle Autoren-Archivseiten auf die "Über Mich"-Seite um.
 * Das vermeidet doppelten Inhalt und verbessert die User Experience.
 */
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        wp_redirect( home_url( '/ueber-mich/' ), 301 );
        exit;
    }
} );

// Lädt die Schema.org Markup Logik.
require_once get_stylesheet_directory() . '/inc/schema.php';

/**
 * ===================================================================
 * HILFSFUNKTIONEN FÜR DEN BLOG
 * ===================================================================
 */

// Stellt eine Fallback-URL für Beitragsbilder bereit.
if ( ! function_exists('hu_fallback_thumb_url') ) {
    function hu_fallback_thumb_url() {
        return 'https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp';
    }
}

// Hängt einen "Weiterlesen"-Link an einen Text an, falls er fehlt.
if ( ! function_exists('hu_append_readmore_once') ) {
    function hu_append_readmore_once($text, $permalink) {
        $text = preg_replace('/Weiterlesen.*$/ui', '', $text);
        $text = rtrim($text, " \t\n\r\0\x0B…");
        if (stripos($text, 'Weiterlesen') !== false) {
            return $text;
        }
        return $text . '… <a href="' . esc_url($permalink) . '">Weiterlesen &rarr;</a>';
    }
}

// Bereinigt Text von unerwünschten Elementen für saubere Auszüge.
if ( ! function_exists('hu_scrub_text') ) {
    function hu_scrub_text($text) {
        $text = wp_strip_all_tags($text, true);
        $lines = preg_split('/\r\n|\r|\n/u', $text);
        $clean_lines = [];
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;
            $is_breadcrumb = ((preg_match('/\b(Home|Startseite|Blog)\b/ui', $line) && preg_match('/[›»>\|]/u', $line)) || (substr_count($line, '›') + substr_count($line, '»') + substr_count($line, '>') + substr_count($line, '|')) >= 2);
            if ($is_breadcrumb || preg_match('/^(inhalt|table of contents|verzeichnis)\b/ui', $line) || preg_match('/^\s*[✦•·\-\|]\s*\p{L}+/u', $line)) continue;
            $clean_lines[] = $line;
        }
        $text = trim(implode(' ', $clean_lines));
        $text = preg_replace('/\b(?:Home|Startseite|Blog)\b(?:\s*[›»>\|]\s*[\p{L}\d \-]+){1,}/ui', '', $text);
        $text = preg_replace('/\s*[✦•·\-\|]\s*[\p{L}\d&\/\.,]+/u', '', $text);
        $text = preg_replace('/Weiterlesen.*$/ui', '', $text);
        return trim(preg_replace('/\s{2,}/u', ' ', $text));
    }
}

// Erstellt einen sauberen Textauszug aus dem Beitragsinhalt.
if ( ! function_exists('hu_make_excerpt_raw') ) {
    function hu_make_excerpt_raw($post_id, $word_count = 30) {
        $excerpt = (string) get_post_field('post_excerpt', $post_id);
        $content = $excerpt !== '' ? $excerpt : (function_exists('excerpt_remove_blocks') ? excerpt_remove_blocks(get_post_field('post_content', $post_id)) : get_post_field('post_content', $post_id));
        $content = strip_shortcodes($content);
        $content = hu_scrub_text($content);
        $trimmed_text = wp_trim_words($content, $word_count, '…');
        return trim(preg_replace('/…+$/u', '…', $trimmed_text));
    }
}

// Gibt das Beitragsbild oder ein Fallback-Bild zurück.
if ( ! function_exists('hu_thumb_or_fallback') ) {
    function hu_thumb_or_fallback($post_id, $size) {
        $thumbnail_url = get_the_post_thumbnail_url($post_id, $size);
        return $thumbnail_url ? $thumbnail_url : hu_fallback_thumb_url();
    }
}

/**
 * ===================================================================
 * Blog Header-Anpassung: Menü per Inline-CSS entfernen (FINALE LÖSUNG)
 * ===================================================================
 * Dieser Code fügt eine CSS-Regel direkt in den <head> der Blog-Seiten ein,
 * um das Hauptmenü mit höchster Priorität zu entfernen.
 */
add_action( 'wp_head', function () {
    // Führt den Code nur auf der Blog-Übersichtsseite ODER bei einzelnen Blogbeiträgen aus.
    if ( is_home() || is_singular('post') ) {
        echo '<style id="hide-blog-menu">[data-id="menu"] { display: none !important; }</style>';
    }
}, 999 );

