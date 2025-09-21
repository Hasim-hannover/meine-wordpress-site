<?php
/**
 * Das Template für einzelne Blogartikel.
 * Dieses Template dient als wiederverwendbares Gerüst für alle Beiträge.
 *
 * @package Blocksy Child
 */

get_header('blog'); // Lädt header-blog.php
?>

<div class="main-container">
    <nav aria-label="Breadcrumb" class="breadcrumb">
        <?php
        // Simple breadcrumb, can be replaced with a function or plugin if needed.
        if ( function_exists('bcn_display') ) {
            bcn_display();
        } else {
            echo '<a href="' . esc_url( home_url( '/' ) ) . '">Home</a>';
            echo '<span aria-hidden="true"> › </span>';
            echo '<a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">Blog</a>';
            echo '<span aria-hidden="true"> › </span>';
            echo '<span aria-current="page">' . get_the_title() . '</span>';
        }
        ?>
    </nav>

    <!-- HERO SECTION -->
    <header class="hero" role="banner">
        <?php if ( has_post_thumbnail() ) : ?>
            <img class="hero-media"
                 src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>"
                 alt="<?php echo esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ); ?>"
                 width="1600" height="900" loading="eager" fetchpriority="high" />
        <?php endif; ?>
        <div class="hero-overlay" aria-hidden="true"></div>
        <div class="hero-content">
            <span class="eyebrow">✦ <?php the_category(' · '); ?></span>
            <h1 class="title"><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?>
                <p class="sub"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>
            <div class="meta" style="color:var(--muted-light);font-size:.9rem;">
                <span><?php echo get_the_date(); ?> • <span id="reading-time">—</span></span>
            </div>
        </div>
    </header>

    <div class="layout">
        <main>
            <article class="prose" id="article-content" itemprop="articleBody">
                <?php
                // The WordPress Loop to display the post content from the editor.
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </article>
        </main>

        <aside id="toc-container" class="card" aria-label="Inhaltsverzeichnis">
            <nav class="toc">
                <h4>Inhaltsverzeichnis</h4>
                <ul id="toc-list" style="list-style:none;padding:0;margin:0;"></ul>
            </nav>
        </aside>
    </div>
</div>

<?php
get_footer('blog'); // Lädt footer-blog.php
?>

