<?php
// Definiere deine Menüpunkte hier als Array
$menu_items = [
    'Lösungen' => [
        'url' => '#',
        'submenu' => [
            'Shopify Entwicklung' => '/shopify-agentur-hannover/',
            'WordPress Betreuung' => '/wordpress-agentur-hannover/',
            'SEO & Performance'   => '/seo-agentur-hannover/'
        ]
    ],
    'Über Mich' => [
        'url' => '/ueber-mich/'
    ],
    'Blog' => [
        'url' => '/blog/'
    ]
];
?>

<header id="hu-header" class="hu-header" role="banner">
    <div class="hu-header__inner">
        <a class="hu-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?> Startseite">
            <?php
            if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else {
                echo '<strong class="hu-logo__text">' . esc_html(get_bloginfo('name')) . '</strong>';
            }
            ?>
        </a>

        <nav id="hu-nav" class="hu-nav" role="navigation" aria-label="Hauptmenü">
            <ul class="hu-menu">
                <?php foreach ($menu_items as $label => $item) : ?>
                    <li class="menu-item <?php if (!empty($item['submenu'])) echo 'menu-item-has-children'; ?>">
                        <a href="<?php echo esc_url(home_url($item['url'])); ?>"><?php echo esc_html($label); ?></a>
                        <?php if (!empty($item['submenu'])) : ?>
                            <ul class="sub-menu">
                                <?php foreach ($item['submenu'] as $sub_label => $sub_url) : ?>
                                    <li class="menu-item">
                                        <a href="<?php echo esc_url(home_url($sub_url)); ?>"><?php echo esc_html($sub_label); ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <a class="hu-cta" href="<?php echo esc_url(home_url('/kontakt/')); ?>">Growth Blueprint</a>

        <button id="hu-burger-btn" class="hu-burger" aria-controls="hu-nav" aria-expanded="false" aria-label="Menü öffnen">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>