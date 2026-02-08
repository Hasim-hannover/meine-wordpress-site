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
    <header class="nx-hero nx-hero--compact" style="border-bottom: 1px solid var(--nx-border);">
        <div class="nx-container">
            <span class="nx-badge nx-badge--gold">Kategorie-Analyse</span>
            <h1 class="nx-hero__title">Fokus: <span><?php echo esc_html($cat_name); ?></span></h1>
            
            <?php if ($cat_description) : ?>
                <p class="nx-hero__subtitle">
                    <?php echo wp_strip_all_tags($cat_description); ?>
                </p>
            <?php endif; ?>
        </div>
    </header>

    <section class="nx-section">
        <div class="nx-container">
            <div class="nx-grid nx-grid-auto">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                ?>
                    <article class="nx-card" onclick="window.location='<?php the_permalink(); ?>';" style="cursor:pointer;">
                        <?php if ($thumb) : ?>
                            <div style="border-radius:var(--nx-radius-md); overflow:hidden; margin-bottom:var(--nx-space-lg); border:1px solid var(--nx-border);">
                                <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" style="width:100%; height:220px; object-fit:cover; display:block;">
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-content">
                            <span class="nx-metric__label" style="display:block; margin-bottom:var(--nx-space-sm);"><?php echo get_the_date(); ?></span>
                            <h3 class="nx-card__title"><?php the_title(); ?></h3>
                            <p class="nx-card__text" style="margin: var(--nx-space-md) 0;">
                                <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                            </p>
                            <span class="text-gold" style="font-weight:700; font-size:0.9rem;">Analyse lesen →</span>
                        </div>
                    </article>
                <?php endwhile; else : ?>
                    <p class="text-center text-muted" style="width:100%;">In dieser Kategorie werden aktuell neue Analysen vorbereitet.</p>
                <?php endif; ?>
            </div>

            <div style="margin-top: var(--nx-space-3xl); text-align: center;">
                <?php the_posts_pagination(['prev_text' => '← Zurück', 'next_text' => 'Vorwärts →']); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>