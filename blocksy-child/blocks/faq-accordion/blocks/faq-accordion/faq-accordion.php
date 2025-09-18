<?php
/**
 * Block Template: FAQ Accordion
 * Finale & robusteste Version
 */

// Block-spezifische Klassen und IDs generieren
$block_id = 'faq-' . $block['id'];
$class_name = 'faq-accordion-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}

// **DIE ENTSCHEIDENDE ÄNDERUNG**: Die Feld-Daten explizit für diesen Block laden
$faq_items = get_field('faq_items');

?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if ( $faq_items ) : ?>
        <div class="faq">
            <?php foreach ( $faq_items as $item ) :
                $question = $item['question'];
                $answer = $item['answer'];
            ?>
                <details>
                    <summary><?php echo esc_html($question); ?></summary>
                    <div class="faq-content">
                        <?php echo wp_kses_post($answer); ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p style="color: #ff8a00; padding: 2rem; text-align: center;">
            [Vorschau: FAQ Block] – Bitte fügen Sie im Editor (rechte Seitenleiste) Fragen und Antworten hinzu.
        </p>
    <?php endif; ?>
</div>