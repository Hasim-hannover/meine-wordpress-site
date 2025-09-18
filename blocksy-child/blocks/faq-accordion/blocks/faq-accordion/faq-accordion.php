<?php
/**
 * Block Template: FAQ Accordion
 */

// Block-spezifische Klassen und IDs generieren
$block_id = 'faq-' . $block['id'];
$class_name = 'faq-accordion-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if (have_rows('faq_items')) : ?>
        <div class="faq">
            <?php while (have_rows('faq_items')) : the_row();
                $question = get_sub_field('question');
                $answer = get_sub_field('answer');
            ?>
                <details>
                    <summary><?php echo esc_html($question); ?></summary>
                    <div class="faq-content">
                        <?php echo wp_kses_post($answer); ?>
                    </div>
                </details>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>Bitte fügen Sie im Editor Fragen und Antworten hinzu.</p>
    <?php endif; ?>
</div>