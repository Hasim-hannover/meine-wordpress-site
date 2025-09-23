<?php
/**
 * Das Template für die Blog-Startseite (Beitragsübersicht) - KOMBINIERTE VERSION
 */

get_header();

// ===================================================================
// HELPER-FUNKTIONEN AUS DEM SNIPPET (werden hier benötigt)
// ===================================================================
if (!function_exists('hu_fallback_thumb_url')) {
    function hu_fallback_thumb_url() { return 'https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp'; }
    function hu_append_readmore_once($t, $p) { $t = preg_replace('/Weiterlesen.*$/ui', '', $t); $t = rtrim($t, " \t\n\r\0\x0B…"); if (stripos($t, 'Weiterlesen') !== false) return $t; return $t . '… <a href="' . esc_url($p) . '">Weiterlesen &rarr;</a>'; }
    function hu_scrub_text($x) { $x = wp_strip_all_tags($x, true); $lines = preg_split('/\r\n|\r|\n/u', $x); $c = []; foreach ($lines as $l) { $l = trim($l); if ($l === '') continue; $bc = ((preg_match('/\b(Home|Startseite|Blog)\b/ui', $l) && preg_match('/[›»>\|]/u', $l)) || (substr_count($l, '›') + substr_count($l, '»') + substr_count($l, '>') + substr_count($l, '|')) >= 2); if ($bc || preg_match('/^(inhalt|table of contents|verzeichnis)\b/ui', $l) || preg_match('/^\s*[✦•·\-\|]\s*\p{L}+/u', $l)) continue; $c[] = $l; } $x = trim(implode(' ', $c)); $x = preg_replace('/\b(?:Home|Startseite|Blog)\b(?:\s*[›»>\|]\s*[\p{L}\d \-]+){1,}/ui', '', $x); $x = preg_replace('/\s*[✦•·\-\|]\s*[\p{L}\d&\/\.,]+/u', '', $x); $x = preg_replace('/Weiterlesen.*$/ui', '', $x); return trim(preg_replace('/\s{2,}/u', ' ', $x)); }
    function hu_make_excerpt_raw($id, $w = 30) { $e = (string)get_post_field('post_excerpt', $id); $b = $e !== '' ? $e : (function_exists('excerpt_remove_blocks') ? excerpt_remove_blocks(get_post_field('post_content', $id)) : get_post_field('post_content', $id)); $b = strip_shortcodes($b); $b = hu_scrub_text($b); $t = wp_trim_words($b, $w, '…'); return trim(preg_replace('/…+$/u', '…', $t)); }
    function hu_thumb_or_fallback($id, $s) { $u = get_the_post_thumbnail_url($id, $s); return $u ? $u : hu_fallback_thumb_url(); }
}

// Holen der Beitragsdaten
$featured_q = new WP_Query(['post_type' => 'post', 'posts_per_page' => 1, 'ignore_sticky_posts' => 1]);
$featured_id = 0;
if ($featured_q->have_posts()) {
    $featured_q->the_post();
    $featured_id = get_the_ID();
    $featured_q->rewind_posts();
}
$grid_q = new WP_Query(['post_type' => 'post', 'posts_per_page' => -1, 'post__not_in' => [$featured_id], 'ignore_sticky_posts' => 1]);
$categories = get_categories(['hide_empty' => true, 'exclude' => 1]);
?>

<main id="main" class="site-main">

    <div class="hu-hero" role="banner" aria-label="Impulse – Blogübersicht" style="background-image:url('https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp')">
        <div class="hu-hero__inner">
            <span class="hu-eyebrow">Impulse</span>
            <h1>Digitale Klarheit</h1>
            <p class="hu-hero__subline">
                Jenseits des Hypes: Analysen zu den digitalen Hebeln, die wirklich Wert schaffen. Für eine Technik, die dem Menschen dient – und dem Geschäftserfolg.
            </p>
            <a class="hu-hero__cta" href="#impulse-list" aria-label="Zu den neuesten Beiträgen springen">Neueste Beiträge</a>
        </div>
    </div>

    <div id="impulse-list"></div>

    <div class="hu-blog-wrapper container">
        <?php if ($featured_q->have_posts()) : ?>
            <section class="hu-featured-post-wrapper">
                <h2 class="label">Neuester Gedanke</h2>
                <?php while ($featured_q->have_posts()) : $featured_q->the_post();
                    $pid = get_the_ID();
                    $thumb = hu_thumb_or_fallback($pid, 'large');
                    $excerpt = hu_append_readmore_once(hu_make_excerpt_raw($pid, 30), get_permalink($pid));
                ?>
                    <div class="hu-featured-post">
                        <a href="<?php the_permalink(); ?>"><img class="hu-featured-image" src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>"></a>
                        <div class="hu-featured-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo $excerpt; ?></p>
                            <div class="meta"><?php echo esc_html(get_the_date()); ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </section>
        <?php endif; wp_reset_postdata(); ?>

        <?php if ($grid_q->have_posts()) : ?>
            <section class="hu-grid-wrapper">
                <h2 class="label">Weitere Impulse</h2>
                <nav class="hu-filter-nav" aria-label="Blog-Kategorien">
                    <button class="hu-filter-btn active" data-filter="all">Alle</button>
                    <?php foreach ($categories as $cat) : ?>
                        <button class="hu-filter-btn" data-filter="<?php echo esc_attr($cat->slug); ?>"><?php echo esc_html($cat->name); ?></button>
                    <?php endforeach; ?>
                </nav>
                <div class="blog-grid">
                    <?php while ($grid_q->have_posts()) : $grid_q->the_post();
                        $pid = get_the_ID();
                        $thumb = hu_thumb_or_fallback($pid, 'medium_large');
                        $excerpt = hu_append_readmore_once(hu_make_excerpt_raw($pid, 18), get_permalink($pid));
                        $slugs = wp_list_pluck(get_the_category($pid), 'slug');
                    ?>
                        <div class="post-card" data-categories="<?php echo esc_attr(wp_json_encode($slugs)); ?>">
                            <a href="<?php the_permalink(); ?>"><img class="card-media" src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>"></a>
                            <div class="card-body">
                                <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p class="card-excerpt"><?php echo $excerpt; ?></p>
                                <div class="card-meta"><?php echo esc_html(get_the_date()); ?></div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif; wp_reset_postdata(); ?>
    </div>

</main>

<?php get_footer(); ?>