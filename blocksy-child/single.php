<?php
/**
 * NEXUS ELITE: Single Template mit SEO-Fokus & TOC
 */
get_header();
?>

<div id="progress-bar" role="progressbar" aria-label="Lesefortschritt"></div>

<main id="main" class="wp-container" style="padding-top:2rem; padding-bottom:4rem;">
    <?php while (have_posts()) : the_post(); 
        $categories = get_the_category();
        $cat_name = !empty($categories) ? $categories[0]->name : 'Strategie';
    ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BlogPosting",
          "headline": "<?php the_title(); ?>",
          "author": {"@type": "Person", "name": "Hasim Üner"},
          "datePublished": "<?php echo get_the_date('c'); ?>",
          "image": "<?php the_post_thumbnail_url(); ?>"
        }
        </script>

        <header class="hero-nexus">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('full'); ?>" class="hero-media-nexus" alt="<?php the_title(); ?>" />
            <?php endif; ?>
            <div class="hero-overlay-nexus"></div>
            <div class="hero-content-nexus">
                <span class="wp-badge">✦ <?php echo esc_html($cat_name); ?></span>
                <h1 class="wp-hero-title"><?php the_title(); ?></h1>
                <div class="meta-nexus">
                    Von <strong>Hasim Üner</strong> • <?php echo get_the_date(); ?> • <span id="reading-time">Berechne...</span>
                </div>
            </div>
        </header>

        <div class="layout-nexus">
            <article class="prose-nexus" id="article-content">
                <?php the_content(); ?>
                
                <div class="share-box-nexus">
                    <span class="wp-badge">Analyse teilen</span>
                    <div class="share-links-nexus">
                        <a id="linkedin-share" href="#" target="_blank">LinkedIn</a>
                        <a id="twitter-share" href="#" target="_blank">X / Twitter</a>
                        <button id="copy-link-btn"><span id="copy-link-text">Link kopieren</span></button>
                    </div>

                    <div class="cta-box-nexus">
                        <h3>🚀 Nächster diplomatischer Schritt</h3>
                        <p>Validieren Sie Ihre Datenhoheit in einem kostenlosen Tech-Audit (30 Min). Kein Pitch, nur Fakten.</p>
                        <a href="/#audit" class="wp-btn wp-btn-primary">Audit buchen (0€)</a>
                    </div>
                </div>
            </article>

            <aside id="toc-container" class="toc-card-nexus">
                <nav class="toc-nexus">
                    <h4>Inhaltsverzeichnis</h4>
                    <ul id="toc-list"></ul>
                </nav>
            </aside>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>