<?php
/**
 * NEXUS Edition: Das Template für die Blog-Startseite
 */
get_header();
?>

<main id="main" class="site-main">
    <section class="wp-hero" style="min-height: 50vh; background: linear-gradient(rgba(5,5,5,0.8), rgba(5,5,5,0.8)), url('https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp') center/cover;">
        <div class="wp-container">
            <span class="wp-badge">Strategische Impulse</span>
            <h1 class="wp-hero-title">Expertise, die <span>Wachstum</span> steuert.</h1>
            <p class="wp-hero-subtitle">Kein Rauschen. Nur Analysen zu den digitalen Hebeln, die im B2B-Markt den Unterschied zwischen Stagnation und Marktführerschaft machen.</p>
        </div>
    </section>

    <div class="wp-container wp-section">
        <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 4rem; flex-wrap: wrap;">
            <span class="wp-badge" style="background: var(--gold); color: #000; cursor: pointer;">Alle Beiträge</span>
            <?php 
            $categories = get_categories(['hide_empty' => true]);
            foreach($categories as $cat) {
                echo '<a href="'.get_category_link($cat->term_id).'" class="wp-badge" style="text-decoration:none; opacity:0.6;">'.$cat->name.'</a>';
            }
            ?>
        </div>

        <div class="wp-cards">
            <?php if (have_posts()) : while (have_posts()) : the_post(); 
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://hasimuener.de/wp-content/uploads/2025/09/Impulse_Hasim_uener_Blog.webp';
            ?>
                <article class="wp-success-card" onclick="window.location='<?php the_permalink(); ?>';" style="cursor:pointer; display:flex; flex-direction:column;">
                    <div style="border-radius:12px; overflow:hidden; margin-bottom:1.5rem; border:1px solid var(--border);">
                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title(); ?>" style="width:100%; height:250px; object-fit:cover;">
                    </div>
                    <div class="card-content">
                        <span class="wp-metric-label" style="display:block; margin-bottom:0.5rem;"><?php echo get_the_date(); ?></span>
                        <h3 class="wp-success-title"><?php the_title(); ?></h3>
                        <p style="color:var(--text-dim); font-size:0.95rem; margin: 1rem 0;">
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