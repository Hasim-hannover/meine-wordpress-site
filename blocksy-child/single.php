<?php
/**
 * NEXUS ULTIMATE SINGLE POST TEMPLATE
 * Update: Lesezeit & Social Sharing integriert.
 */

get_header(); 
?>

<main id="main" class="site-main nexus-single-container">

    <?php while ( have_posts() ) : the_post(); ?>

        <header class="nexus-article-hero">
            <div class="nexus-hero-inner">
                
                <div class="nexus-meta-top">
                    <span class="nexus-breadcrumb">
                        <a href="<?php echo home_url('/blog'); ?>">Insights</a> &rarr; 
                        <?php 
                        $category = get_the_category(); 
                        if ( $category ) {
                            echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a>';
                        }
                        ?>
                    </span>
                    <span class="separator">|</span>
                    <span class="nexus-date"><?php echo get_the_date('d. M Y'); ?></span>
                    <span class="separator">|</span>
                    <span class="nexus-reading-time">⏱ <?php echo nexus_get_reading_time(); ?> Min. Lesezeit</span>
                </div>

                <h1 class="nexus-title"><?php the_title(); ?></h1>

                <div class="nexus-hero-footer">
                    <div class="nexus-author-row">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                        <div class="nexus-author-info">
                            <span class="by">Written by</span>
                            <span class="name"><?php the_author(); ?></span>
                        </div>
                    </div>

                    <div class="nexus-share-box">
                        <span class="share-label">Teilen:</span>
                        
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank" rel="noopener" class="nexus-share-btn linkedin" title="Auf LinkedIn teilen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                        </a>

                        <a href="https://wa.me/?text=<?php echo urlencode(get_the_title() . ' - ' . get_the_permalink()); ?>" target="_blank" rel="noopener" class="nexus-share-btn whatsapp" title="Per WhatsApp senden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </a>

                        <button onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>');alert('Link in Zwischenablage kopiert!');" class="nexus-share-btn copy" title="Link kopieren">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        </button>
                    </div>
                </div>

            </div>
        </header>

        <article class="nexus-article-content">
            <?php the_content(); ?>
        </article>

        <div class="nexus-post-footer-cta">
            <h3>Genug Theorie?</h3>
            <p>Lass uns prüfen, ob deine Website technisch bereit für mehr Leads ist.</p>
            <a href="/audit" class="nexus-btn">Kostenloses Audit buchen</a>
        </div>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>