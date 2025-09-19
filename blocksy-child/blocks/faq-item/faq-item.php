<?php
/**
 * Block: FAQ Item
 * Stellt ein einzelnes aufklappbares Frage-Antwort-Element dar.
 */
$item = $args['item'] ?? [];
$question = $item['faq_question'] ?? '';
$answer = $item['faq_answer'] ?? '';

if (empty($question) || empty($answer)) {
    return;
}
?>

<details class="faq-item-block">
    <summary>
        <h3 class="faq-question"><?php echo esc_html($question); ?></h3>
        <span class="faq-toggle-icon">+</span>
    </summary>
    <div class="faq-item-content">
        <?php echo apply_filters('the_content', $answer); ?>
    </div>
</details>