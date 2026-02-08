<?php
/**
 * NEXUS Edition: Das Template für die Blog-Startseite
 */
get_header();
?>

<main id="main" class="site-main">
    <section class="nx-hero nx-hero--compact" style="background: linear-gradient(rgba(5,5,5,0.8), rgba(5,5,5,0.8)), url('https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp') center/cover;">
        <div class="nx-container">
            <span class="nx-badge nx-badge--gold">Strategische Impulse</span>
            <h1 class="nx-hero__title">Expertise, die <span>Wachstum</span> steuert.</h1>
            <p class="nx-hero__subtitle">Kein Rauschen. Nur Analysen zu den digitalen Hebeln, die im B2B-Markt den Unterschied zwischen Stagnation und Marktführerschaft machen.</p>
        </div>
    </section>

    <div class="nx-container nx-section">
        <div class="flex gap-md flex-center flex-wrap mb-xl">
            <span class="nx-badge nx-badge--gold nx-btn--sm" style="cursor: pointer;">Alle Beiträge</span>
            <?php 
            $categories = get_categories(['hide_empty' => true]);
            foreach($categories as $cat) {
                echo '<a href="'.get_category_link($cat->term_id).'" class="nx-badge nx-badge--ghost" style="text-decoration:none;">'.$cat->name.'</a>';
            }
            ?>
        </div>

        <div class="nx-grid nx-grid-auto">
            <?php if (have_posts()) : while (have_posts()) : the_post(); 
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp';
            ?>
                <article class="nx-card" onclick="window.location='<?php the_permalink(); ?>';" style="cursor:pointer;">
                    <div style="border-radius:var(--nx-radius-md); overflow:hidden; margin-bottom:var(--nx-space-lg); border:1px solid var(--nx-border);">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" style="width:100%; height:250px; object-fit:cover; display:block;">
                    </div>
                    <div class="card-content">
                        <span class="nx-metric__label" style="display:block; margin-bottom:var(--nx-space-sm);"><?php echo get_the_date(); ?></span>
                        <h3 class="nx-card__title"><?php the_title(); ?></h3>
                        <p class="nx-card__text" style="margin: var(--nx-space-md) 0;">
                            <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                        </p>
                        <span class="text-gold" style="font-weight:700; font-size:0.9rem;">Analyse lesen →</span>
                    </div>
                </article>
            <?php endwhile; endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>