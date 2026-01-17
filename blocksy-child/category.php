<?php
/**
 * NEXUS Edition: Das Template für Kategorie-Archivseiten
 */
get_header();

// Aktuelle Kategorie-Daten abrufen
$current_category = get_queried_object();
$cat_name = $current_category->name;
$cat_description = category_description();
?>

<main id="main" class="site-main">
    <header class="wp-hero" style="min-height: 45vh; background: var(--dark); border-bottom: 1px solid var(--border);">
        <div class="wp-container">
            <span class="wp-badge">Kategorie-Analyse</span>
            <h1 class="wp-hero-title">Fokus: <span><?php echo esc_html($cat_name); ?></span></h1>
            
            <?php if ($cat_description) : ?>
                <div class="wp-hero-subtitle" style="margin-top: 1.5rem; color: var(--text-dim); line-height: 1.8;">
                    <?php echo $cat_description; ?>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <section class="wp-section">
        <div class="wp-container">
            <div class="wp-cards">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                ?>
                    <article class="wp-success-card" onclick="window.location='<?php the_permalink(); ?>';" style="cursor:pointer; display:flex; flex-direction:column;">
                        <?php if ($thumb) : ?>
                            <div style="border-radius:12px; overflow:hidden; margin-bottom:1.5rem; border:1px solid var(--border);">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" style="width:100%; height:220px; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <span class="wp-metric-label" style="display:block; margin-bottom:0.5rem;"><?php echo get_the_date(); ?></span>
                            <h3 class="wp-success-title"><?php the_title(); ?></h3>
                            <p style="color:var(--text-dim); font-size:0.95rem; margin: 1rem 0;">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <span class="text-gold" style="font-weight:700; font-size:0.9rem;">Analyse lesen →</span>
                        </div>
                    </article>
                <?php endwhile; else : ?>
                    <p style="text-align:center; width:100%; opacity:0.6;">In dieser Kategorie werden aktuell neue Analysen vorbereitet.</p>
                <?php endif; ?>
            </div>

            <div class="wp-pagination" style="margin-top: 4rem; text-align: center;">
                <?php the_posts_pagination(['prev_text' => '← Zurück', 'next_text' => 'Vorwärts →']); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>