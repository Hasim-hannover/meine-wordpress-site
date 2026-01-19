<?php
/**
 * NEXUS ULTIMATE SINGLE POST TEMPLATE
 * LEVEL: CHAMPIONS LEAGUE
 * Features: Dynamisches Hero-Bild, Insta-Button, Dual-Share, Sie-Form.
 */

get_header(); 
?>

<main id="main" class="site-main nexus-single-container">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
        // 1. CHAMPIONS LEAGUE HERO LOGIK
        $hero_bg = get_the_post_thumbnail_url(get_the_ID(), 'full');
        // Fallback, falls kein Bild da ist (schwarzer Verlauf)
        $bg_style = $hero_bg ? 'background-image: url(' . esc_url($hero_bg) . ');' : 'background: linear-gradient(to bottom, #1a1a1a, #0a0a0a);';
        ?>

        <header class="nexus-article-hero has-bg" style="<?php echo $bg_style; ?>">
            
            <div class="nexus-hero-overlay"></div>

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
                    <span class="nexus-reading-time">⏱ <?php echo function_exists('nexus_get_reading_time') ? nexus_get_reading_time() : '3'; ?> Min. Lesezeit</span>
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

                    <?php if ( function_exists( 'nexus_render_share_buttons' ) ) { nexus_render_share_buttons(); } ?>
                </div>

            </div>
        </header>

        <article class="nexus-article-content" id="article-content">
            <?php the_content(); ?>
        </article>

        <div class="nexus-bottom-share">
            <h3>Diesen Artikel teilen</h3>
            <?php if ( function_exists( 'nexus_render_share_buttons' ) ) { nexus_render_share_buttons(); } ?>
        </div>

        <div class="nexus-post-footer-cta">
            <h3>Genug der Theorie?</h3>
            <p>Lassen Sie uns gemeinsam prüfen, ob Ihre Website technisch bereit für mehr Leads ist.</p>
            <a href="/audit" class="nexus-btn">Kostenloses Audit buchen</a>
        </div>

    <?php endwhile; ?>

</main>

<?php 
get_footer(); 
?>