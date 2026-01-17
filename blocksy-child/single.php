<?php
/**
 * NEXUS ULTIMATE SINGLE POST TEMPLATE
 * Fokus: Performance, Typografie, Lesbarkeit.
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
                        // Erste Kategorie holen
                        $category = get_the_category(); 
                        if ( $category ) {
                            echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a>';
                        }
                        ?>
                    </span>
                    <span class="nexus-date"><?php echo get_the_date('d. M Y'); ?></span>
                </div>

                <h1 class="nexus-title"><?php the_title(); ?></h1>

                <div class="nexus-author-row">
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
                    <div class="nexus-author-info">
                        <span class="by">Written by</span>
                        <span class="name"><?php the_author(); ?></span>
                        <span class="role">Growth Architect</span>
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