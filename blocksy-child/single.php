<?php
get_header();

// 1. Logik: Ist es eine Analyse oder ein Standard-Beitrag?
$is_analysis = has_category(array('wordpress-engineering', 'daten-integritat', 'verkaufspsychologie')) || is_singular('post');
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php if ($is_analysis) : ?>
        <div id="progress-bar" style="position:fixed; top:0; left:0; height:3px; background:var(--gold); z-index:9999; width:0; transition:width .15s linear;"></div>

        <article id="post-<?php the_ID(); ?>" <?php post_class('nexus-analysis-article'); ?>>
            <div class="wp-container" style="padding-top:4rem; padding-bottom:4rem;">
                
                <header class="hero-nexus" style="margin-bottom:4rem;">
                    <span class="wp-badge">✦ Strategie-Analyse</span>
                    <h1 class="wp-hero-title" style="text-align:left; margin-top:1rem; font-size:clamp(2rem, 5vw, 3.5rem);"><?php the_title(); ?></h1>
                    <div style="color:var(--text-dim); margin-top:1.5rem; font-size:0.9rem;">
                        Von <strong>Hasim Üner</strong> • <?php echo get_the_date(); ?> • <span id="reading-time">Wird berechnet...</span>
                    </div>
                </header>

                <div class="layout-nexus" style="display:grid; grid-template-columns: 1fr; gap:4rem;">
                    
                    <div id="article-content" class="prose-nexus" style="max-width:80ch; font-size:1.15rem; line-height:1.8;">
                        <?php the_content(); ?>
                    </div>

                    <aside id="toc-container" class="toc-sidebar">
                        <div class="toc-card-nexus" style="position:sticky; top:120px; background:rgba(20,20,20,0.5); backdrop-filter:blur(10px); padding:2rem; border-radius:15px; border:1px solid var(--border);">
                            <h4 style="color:var(--gold); text-transform:uppercase; font-size:0.8rem; letter-spacing:1px; margin-bottom:1.5rem; border-bottom:1px solid var(--border); padding-bottom:0.5rem;">Inhaltsverzeichnis</h4>
                            <ul id="toc-list" style="list-style:none; padding:0; margin:0;">
                                </ul>
                        </div>
                    </aside>

                </div>
            </div>
        </article>

    <?php else : ?>
        <div class="wp-container" style="padding:4rem 1rem;">
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>