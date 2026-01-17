<?php
/**
 * NEXUS ELITE Edition: Single Post Template
 */
get_header();
?>

<div id="progress-bar" role="progressbar" aria-label="Lesefortschritt" style="position:fixed; top:0; left:0; height:3px; background:var(--gold); z-index:9999; width:0; transition:width .15s linear; box-shadow:0 0 12px rgba(255,176,32,.45);"></div>

<main id="main" class="wp-container" style="padding-top:2rem; padding-bottom:4rem;">
    <?php while (have_posts()) : the_post(); 
        $categories = get_the_category();
        $cat_name = !empty($categories) ? $categories[0]->name : 'Strategie';
    ?>
        <nav aria-label="Breadcrumb" class="mb-6" style="color:var(--text-dim); font-size:.9rem; margin-bottom:1.5rem;">
            <a href="/" style="color:inherit; text-decoration:none;">Home</a> › 
            <a href="/blog/" style="color:inherit; text-decoration:none;">Blog</a> › 
            <span style="color:var(--white);"><?php the_title(); ?></span>
        </nav>

        <header class="hero-nexus" style="position:relative; border-radius:16px; overflow:hidden; border:1px solid var(--border);">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" class="hero-media-nexus" style="width:100%; aspect-ratio:16/9; object-fit:cover; display:block;" />
            <?php endif; ?>
            <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(10,10,10,.9), transparent);"></div>
            <div style="position:absolute; bottom:0; left:0; padding:3rem; width:100%;">
                <span class="wp-badge">✦ <?php echo esc_html($cat_name); ?></span>
                <h1 class="wp-hero-title" style="margin:.9rem 0 0; text-align:left; font-size:clamp(1.8rem, 4vw, 3rem);"><?php the_title(); ?></h1>
                <div style="color:var(--text-dim); font-size:.9rem; margin-top:1rem;">
                    Von <strong><?php the_author(); ?></strong> • <?php echo get_the_date(); ?> • <span id="reading-time">Berechne Lesezeit...</span>
                </div>
            </div>
        </header>

        <div class="layout-nexus" style="display:grid; grid-template-columns:1fr; gap:3rem; margin-top:3rem;">
            <article class="prose-nexus" id="article-content" style="max-width:75ch; font-size:1.1rem; line-height:1.75; color:var(--text-dim);">
                <?php the_content(); ?>

                <div class="share-box-nexus" style="margin-top:5rem; padding-top:2rem; border-top:1px solid var(--border); text-align:center;">
                    <span class="wp-badge">Analyse teilen</span>
                    <div style="display:flex; justify-content:center; gap:1.5rem; margin:1.5rem 0 3rem;">
                        <a id="linkedin-share" href="#" target="_blank" class="text-gold" style="font-weight:700; text-decoration:none;">LinkedIn</a>
                        <a id="twitter-share" href="#" target="_blank" class="text-gold" style="font-weight:700; text-decoration:none;">X / Twitter</a>
                        <button id="copy-link-btn" style="background:none; border:none; color:var(--gold); font-weight:700; cursor:pointer;"><span id="copy-link-text">Link kopieren</span></button>
                    </div>

                    <div class="cta-box-nexus" style="background:rgba(255, 176, 32, 0.05); border:1px solid var(--gold); padding:2.5rem; border-radius:16px;">
                        <h3>🚀 Nächster diplomatischer Schritt</h3>
                        <p>Lassen Sie uns prüfen, wie viel Potenzial Ihr aktuelles Tracking-Setup auf der Straße liegen lässt. Wir bauen Ihren sicheren Kurierdienst auf.</p>
                        <a href="/#kontakt" class="wp-btn wp-btn-primary" style="display:inline-block; margin-top:1rem;">Kostenlose Erstanalyse anfordern</a>
                    </div>
                </div>
            </article>

            <aside id="toc-container" style="position:sticky; top:100px; height:fit-content; background:var(--dark-glass); padding:2rem; border-radius:16px; border:1px solid var(--border);">
                <nav class="toc-nexus">
                    <h4 style="color:var(--gold); text-transform:uppercase; font-size:.8rem; letter-spacing:1px; margin-bottom:1.5rem; border-bottom:1px solid var(--border); padding-bottom:.5rem;">Inhaltsverzeichnis</h4>
                    <ul id="toc-list" style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:1rem;"></ul>
                </nav>
            </aside>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>