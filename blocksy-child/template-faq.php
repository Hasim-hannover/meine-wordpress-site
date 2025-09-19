<?php
/*
 * Template Name: FAQ
 * Description: Gibt alle FAQ-Einträge im Accordion-Layout aus.
 */

get_header(); ?>

<main id="main" class="site-main">
  <section class="faq">
    <h2>Häufig gestellte Fragen</h2>
    <?php
    $faq_query = new WP_Query([
      'post_type'      => 'faq',
      'posts_per_page' => -1,
      'orderby'        => 'menu_order',
      'order'          => 'ASC',
    ]);

    if ( $faq_query->have_posts() ) :
      while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
        <details class="faq-item-block">
          <summary><?php the_title(); ?></summary>
          <div class="faq-item-content">
            <?php the_content(); ?>
          </div>
        </details>
      <?php endwhile;
      wp_reset_postdata();
    else :
      echo '<p>Keine FAQs gefunden.</p>';
    endif;
    ?>
  </section>
</main>

<?php get_footer();
