<?php
/**
 * NEXUS ELITE: Single Template - SEO & TOC Optimized
 */
get_header();
?>

<div id="progress-bar" style="position:fixed; top:0; left:0; height:3px; background:var(--gold); z-index:9999; width:0;"></div>

<main id="main" class="wp-container" style="padding-top:2rem; padding-bottom:5rem;">
    <?php while (have_posts()) : the_post(); ?>
        
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "BlogPosting",
          "headline": "<?php the_title(); ?>",
          "image": "<?php the_post_thumbnail_url(); ?>",
          "author": {"@type": "Person", "name": "Hasim Üner"},
          "datePublished": "<?php echo get_the_date('c'); ?>",
          "publisher": {"@type": "Organization", "name": "Hasim Üner - Growth Architect"}
        }
        </script>

        <header class="hero-nexus" style="margin-bottom: 3rem;">
            <span class="wp-badge">✦ Analyse</span>
            <h1 class="wp-hero-title" style="text-align:left; font-size: clamp(2rem, 5vw, 3.5rem);"><?php the_title(); ?></h1>
            <div style="color:var(--text-dim); margin-top:1rem;">
                Von <strong>Hasim Üner</strong> • <?php echo get_the_date(); ?> • <span id="reading-time">Berechne...</span>
            </div>
        </header>

        <div class="layout-nexus" style="display:grid; grid-template-columns: 1fr; gap: 4rem;">
            <article class="prose-nexus" id="article-content">
                <?php the_content(); ?>
            </article>

            <aside id="toc-container" class="toc-card-nexus" style="position:sticky; top:100px; height:fit-content;">
                <nav class="toc-nexus">
                    <h4 style="color:var(--gold); text-transform:uppercase; font-size:0.8rem; letter-spacing:1px; margin-bottom:1rem; border-bottom:1px solid var(--border); padding-bottom:0.5rem;">Inhaltsverzeichnis</h4>
                    <ul id="toc-list" style="list-style:none; padding:0;">
                        </ul>
                </nav>
            </aside>
        </div>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>