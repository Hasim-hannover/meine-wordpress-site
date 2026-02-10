<?php
/**
 * NEXUS PILLAR HUB: Kategorie-Archiv als Content-Hub
 * Features: Hero mit Intro, Featured Post, Grid, Service-CTA, Pillar-Sidebar
 * 
 * @package Blocksy Child – Nexus Edition
 */
get_header();

// --- Kategorie-Daten ---
$current_category = get_queried_object();
$cat_slug         = $current_category->slug;
$cat_name         = $current_category->name;
$cat_description  = category_description();
$cat_count        = $current_category->count;

// --- Service-Mapping: Kategorie → passende Service-Seite + CTA ---
$pillar_map = [
    'strategie' => [
        'icon'        => '🧭',
        'badge'       => 'Strategie & Growth',
        'subtitle'    => 'Assets bauen statt Kampagnen verbrennen. Frameworks, Systeme und Denkmodelle für nachhaltiges B2B-Wachstum.',
        'cta_label'   => 'WGOS kennenlernen',
        'cta_url'     => '/wordpress-growth-operating-system/',
        'cta_text'    => 'Das WordPress Growth Operating System (WGOS) ist der Rahmen, in dem Strategie operativ wird.',
    ],
    'seo' => [
        'icon'        => '🔍',
        'badge'       => 'SEO & Sichtbarkeit',
        'subtitle'    => 'Technical SEO, Local SEO und Content-Strategie — damit Ihre Website gefunden wird, wenn es zählt.',
        'cta_label'   => 'SEO-Audit starten',
        'cta_url'     => '/wordpress-seo-hannover/',
        'cta_text'    => 'Analyse Ihrer aktuellen Sichtbarkeit: Rankings, Indexierung, technische Fehler — kostenlos.',
    ],
    'tracking' => [
        'icon'        => '📊',
        'badge'       => 'Tracking & Analytics',
        'subtitle'    => 'GA4, Server-Side Tagging, Consent Management — Privacy-first Daten, die Entscheidungen ermöglichen.',
        'cta_label'   => 'GA4-Setup anfragen',
        'cta_url'     => '/ga4-tracking-setup/',
        'cta_text'    => 'Sauberes Tracking ist die Basis für jede datengetriebene Entscheidung.',
    ],
    'cro' => [
        'icon'        => '🎯',
        'badge'       => 'Conversion (CRO) & UX',
        'subtitle'    => 'A/B-Tests, UX-Optimierung, Customer Journey — mehr Leads aus dem gleichen Traffic.',
        'cta_label'   => 'Customer Journey Audit',
        'cta_url'     => '/customer-journey-audit/',
        'cta_text'    => 'Wir simulieren die Reise Ihres nächsten Kunden — und zeigen, wo er abspringt.',
    ],
    'wordpress-performance' => [
        'icon'        => '⚡',
        'badge'       => 'WordPress Performance',
        'subtitle'    => 'Core Web Vitals, Caching, Hosting, Theme-/Plugin-Optimierung — Geschwindigkeit als Wettbewerbsvorteil.',
        'cta_label'   => 'Performance-Check starten',
        'cta_url'     => '/core-web-vitals/',
        'cta_text'    => 'Ihre Core Web Vitals entscheiden über Rankings und Conversions.',
    ],
];

// Fallback für nicht-gemappte Kategorien
$pillar = $pillar_map[$cat_slug] ?? [
    'icon'        => '📄',
    'badge'       => $cat_name,
    'subtitle'    => wp_strip_all_tags($cat_description) ?: 'Analysen und Insights zu ' . esc_html($cat_name) . '.',
    'cta_label'   => 'Kostenloser Audit',
    'cta_url'     => '/customer-journey-audit/',
    'cta_text'    => 'Finden Sie heraus, wo Ihre Website Potenzial liegen lässt.',
];

// --- Featured Post: Sticky oder neuester ---
$featured_args = [
    'category__in'   => [$current_category->term_id],
    'posts_per_page' => 1,
    'post__in'       => get_option('sticky_posts'),
];
$featured_query = new WP_Query($featured_args);

// Fallback: Wenn kein Sticky Post → neuester Post
if (!$featured_query->have_posts()) {
    $featured_args = [
        'category__in'   => [$current_category->term_id],
        'posts_per_page' => 1,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];
    $featured_query = new WP_Query($featured_args);
}

// IDs der Featured Posts sammeln (um sie im Grid nicht zu doppeln)
$exclude_ids = [];
if ($featured_query->have_posts()) {
    foreach ($featured_query->posts as $fp) {
        $exclude_ids[] = $fp->ID;
    }
}
?>

<main id="main" class="site-main pillar-hub">

    <!-- ══════════════════════════════════════
         SECTION 1: PILLAR HERO
         ══════════════════════════════════════ -->
    <header class="pillar-hero">
        <div class="nx-container">
            <span class="nx-badge nx-badge--gold"><?php echo esc_html($pillar['icon'] . ' ' . $pillar['badge']); ?></span>
            
            <h1 class="pillar-hero__title"><?php echo esc_html($cat_name); ?></h1>
            
            <p class="pillar-hero__subtitle">
                <?php echo esc_html($pillar['subtitle']); ?>
            </p>

            <div class="pillar-hero__meta">
                <span class="pillar-meta-item">
                    <strong><?php echo (int) $cat_count; ?></strong> <?php echo $cat_count === 1 ? 'Beitrag' : 'Beiträge'; ?>
                </span>
                <span class="pillar-meta-divider">·</span>
                <span class="pillar-meta-item">Pillar Content Hub</span>
            </div>
        </div>
    </header>

    <!-- ══════════════════════════════════════
         SECTION 2: FEATURED POST ("Start here")
         ══════════════════════════════════════ -->
    <?php if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post();
        $feat_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
    ?>
    <section class="pillar-featured">
        <div class="nx-container">
            <div class="pillar-featured__label">
                <span class="nx-badge nx-badge--gold">Hier starten</span>
            </div>
            
            <a href="<?php the_permalink(); ?>" class="pillar-featured__card">
                <?php if ($feat_thumb) : ?>
                    <div class="pillar-featured__image">
                        <img src="<?php echo esc_url($feat_thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                    </div>
                <?php endif; ?>
                
                <div class="pillar-featured__content">
                    <span class="pillar-featured__date"><?php echo get_the_date(); ?> · <?php echo function_exists('nexus_get_reading_time') ? nexus_get_reading_time() . ' Min.' : ''; ?></span>
                    <h2 class="pillar-featured__title"><?php the_title(); ?></h2>
                    <p class="pillar-featured__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                    <span class="pillar-featured__cta">Analyse lesen →</span>
                </div>
            </a>
        </div>
    </section>
    <?php endwhile; endif; wp_reset_postdata(); ?>

    <!-- ══════════════════════════════════════
         SECTION 3: ALLE BEITRÄGE (Grid + Sidebar)
         ══════════════════════════════════════ -->
    <section class="pillar-content nx-section">
        <div class="nx-container">
            <div class="pillar-layout">
                
                <!-- MAIN: Post Grid -->
                <div class="pillar-main">
                    <h2 class="pillar-section-title">Alle Beiträge</h2>
                    
                    <div class="pillar-grid">
                        <?php 
                        // Eigenen Query für verbleibende Posts
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $grid_args = [
                            'category__in'   => [$current_category->term_id],
                            'posts_per_page' => 9,
                            'paged'          => $paged,
                            'post__not_in'   => $exclude_ids,
                        ];
                        $grid_query = new WP_Query($grid_args);
                        
                        if ($grid_query->have_posts()) : while ($grid_query->have_posts()) : $grid_query->the_post();
                            $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                        ?>
                            <article class="pillar-card" onclick="window.location='<?php the_permalink(); ?>';">
                                <?php if ($thumb) : ?>
                                    <div class="pillar-card__image">
                                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                                
                                <div class="pillar-card__body">
                                    <span class="pillar-card__date"><?php echo get_the_date(); ?></span>
                                    <h3 class="pillar-card__title"><?php the_title(); ?></h3>
                                    <p class="pillar-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                                    <span class="pillar-card__link">Analyse lesen →</span>
                                </div>
                            </article>
                        <?php endwhile; else : ?>
                            <p class="pillar-empty">In diesem Pillar werden aktuell neue Analysen vorbereitet.</p>
                        <?php endif; ?>
                    </div>

                    <?php if ($grid_query->max_num_pages > 1) : ?>
                        <div class="pillar-pagination">
                            <?php 
                            echo paginate_links([
                                'total'     => $grid_query->max_num_pages,
                                'current'   => $paged,
                                'prev_text' => '← Zurück',
                                'next_text' => 'Weiter →',
                            ]); 
                            ?>
                        </div>
                    <?php endif; wp_reset_postdata(); ?>
                </div>

                <!-- SIDEBAR: Pillar-Navigation + CTA -->
                <aside class="pillar-sidebar">
                    
                    <!-- Service CTA -->
                    <div class="pillar-sidebar__cta">
                        <span class="pillar-sidebar__cta-icon"><?php echo $pillar['icon']; ?></span>
                        <h3 class="pillar-sidebar__cta-title"><?php echo esc_html($pillar['cta_label']); ?></h3>
                        <p class="pillar-sidebar__cta-text"><?php echo esc_html($pillar['cta_text']); ?></p>
                        <a href="<?php echo esc_url($pillar['cta_url']); ?>" class="nx-btn nx-btn--primary nx-btn--full nx-btn--sm">
                            <?php echo esc_html($pillar['cta_label']); ?> →
                        </a>
                    </div>

                    <!-- Andere Pillars -->
                    <div class="pillar-sidebar__nav">
                        <h4 class="pillar-sidebar__nav-title">Weitere Pillars</h4>
                        <ul class="pillar-sidebar__nav-list">
                            <?php 
                            foreach ($pillar_map as $slug => $data) :
                                if ($slug === $cat_slug) continue;
                                $term = get_term_by('slug', $slug, 'category');
                                if (!$term) continue;
                            ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($term)); ?>" class="pillar-sidebar__nav-link">
                                        <span class="pillar-sidebar__nav-icon"><?php echo $data['icon']; ?></span>
                                        <span class="pillar-sidebar__nav-name"><?php echo esc_html($data['badge']); ?></span>
                                        <span class="pillar-sidebar__nav-count"><?php echo (int) $term->count; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Newsletter / Audit CTA -->
                    <div class="pillar-sidebar__audit">
                        <h4>Wo verbrennt Ihre Website Geld?</h4>
                        <p>Mein 360° Audit prüft Tech, SEO & Content im Zusammenspiel.</p>
                        <a href="/customer-journey-audit/" class="nx-btn nx-btn--ghost nx-btn--full nx-btn--sm">
                            Kostenlosen Audit starten →
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>