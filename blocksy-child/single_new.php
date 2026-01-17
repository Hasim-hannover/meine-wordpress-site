<?php
/**
 * Champions‑League Single Template
 *
 * Dieses Template liefert ein einheitliches, hochwertiges Layout für alle
 * Beiträge. Es blendet den Seitentitel visuell aus (bleibt für SEO
 * vorhanden) und zeigt stattdessen ein elegantes Hero mit Kategorien,
 * optionalem Tagline (über ACF‑Feld ``hero_tagline``) sowie Metadaten.
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        /**
         * Scroll‑Progressbar: Zeigt den Lesefortschritt oben auf der Seite an.
         * Kann über CSS/JS im Child‑Theme gesteuert werden.
         */
        ?>
        <div id="progress-bar" style="position:fixed; top:0; left:0; height:3px; background:var(--gold, #d4af37); z-index:9999; width:0; transition:width .15s linear;"></div>

        <article id="post-<?php the_ID(); ?>" <?php post_class( 'nexus-single-article' ); ?> style="padding-top:4rem; padding-bottom:4rem;">

            <?php
            // Kategorie(n) ermitteln – erste Kategorie als Badge ausgeben
            $categories = get_the_category();
            $primary_cat = ! empty( $categories ) ? $categories[0]->name : '';
            ?>

            <header class="hero-single" style="margin-bottom:3rem; text-align:left;">
                <?php if ( $primary_cat ) : ?>
                    <span class="wp-badge" style="background:var(--gold); color:#000;"><?php echo esc_html( $primary_cat ); ?></span>
                <?php endif; ?>

                <!-- Der echte Seitentitel bleibt für SEO erhalten, ist aber visuell versteckt -->
                <h1 class="wp-hero-title sr-only" style="position:absolute; width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; clip:rect(0,0,0,0); border:0;">
                    <?php the_title(); ?>
                </h1>

                <!-- Optionaler Tagline aus einem benutzerdefinierten Feld (z. B. ACF) -->
                <?php if ( function_exists( 'get_field' ) && get_field( 'hero_tagline' ) ) : ?>
                    <h2 class="hero-tagline" style="font-size:clamp(2rem, 5vw, 3rem); font-weight:700; color:#fff; margin-top:1rem;">
                        <?php echo esc_html( get_field( 'hero_tagline' ) ); ?>
                    </h2>
                <?php endif; ?>

                <!-- Meta‑Informationen: Autor und Datum -->
                <div class="post-meta" style="color:var(--text-dim, #888); margin-top:1rem; font-size:0.9rem;">
                    Von <strong><?php the_author(); ?></strong> • <?php echo get_the_date(); ?>
                </div>
            </header>

            <div class="layout-single" style="display:grid; grid-template-columns:1fr; gap:3rem; max-width:80ch;">
                <div id="article-content" class="prose-single" style="font-size:1.15rem; line-height:1.8; color:#e0e0e0;">
                    <?php the_content(); ?>
                </div>

                <!-- Optionaler Call to Action Bereich am Ende des Beitrags -->
                <div class="cta-single" style="margin-top:4rem; text-align:center;">
                    <a href="/kontakt/" class="btn btn-primary" style="padding:1rem 2rem; background:var(--gold); color:#000; font-weight:700; border-radius:6px; text-decoration:none;">
                        Projekt anfragen
                    </a>
                </div>
            </div>

        </article>

        <?php
    endwhile;
endif;

get_footer();
