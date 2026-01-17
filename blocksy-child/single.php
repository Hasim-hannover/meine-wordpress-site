<?php
get_header();

// 1. Logik: Ist es eine Analyse? 
// (Nur wenn Kategorie passt. Falls ALLE Posts das Design haben sollen, schreibe: $is_analysis = true;)
$is_analysis = has_category(array('wordpress-engineering', 'daten-integritat', 'verkaufspsychologie'));
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php if ($is_analysis) : ?>
        <div id="progress-bar" style="position:fixed; top:0; left:0; height:3px; background:var(--gold, #d4af37); z-index:9999; width:0; transition:width .15s linear;"></div>

        <article id="post-<?php the_ID(); ?>" <?php post_class('nexus-analysis-article'); ?>>
            <div class="wp-container" style="padding-top:4rem; padding-bottom:4rem;">
                
                <header class="hero-nexus" style="margin-bottom:4rem;">
                    <span class="wp-badge">✦ Strategie-Analyse</span>
                    <h1 class="wp-hero-title" style="text-align:left; margin-top:1rem; font-size:clamp(2rem, 5vw, 3.5rem); color:#fff;"><?php the_title(); ?></h1>
                    <div style="color:var(--text-dim, #888); margin-top:1.5rem; font-size:0.9rem;">
                        Von <strong>Hasim Üner</strong> • <?php echo get_the_date(); ?>
                    </div>
                </header>

                <div class="layout-nexus" style="display:grid; grid-template-columns: 1fr; gap:4rem;">
                    <div id="article-content" class="prose-nexus" style="max-width:80ch; font-size:1.15rem; line-height:1.8; color:#e0e0e0;">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </article>

    <?php else : ?>
        <div class="ct-container-fluid ct-container-boxed" style="padding: 4rem 1rem;">
            <h1 class="page-title" style="text-align:center; margin-bottom:2rem;"><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>