<?php
/**
 * Das Template für die Blog-Startseite (Beitragsübersicht).
 *
 * @package Blocksy Child
 */

get_header();

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
            <span class="hu-eyebrow">Hasim Üner – Impulse</span>
            <h1>Impulse</h1>
            <p class="hu-hero__subline">
                Kurze, präzise Gedanken zu Performance, SEO, Tracking & E-Commerce-Architektur.
                Kein News-Rauschen – nur Hebel, die Wachstum bringen.
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