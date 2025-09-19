<?php
/**
 * Block: FAQ Item
 * Ein einzelnes aufklappbares Frage-Antwort-Element mit verschachtelten Blöcken.
 */

$template = [
    ['core/paragraph', ['placeholder' => 'Frage hier eingeben...']],
    ['core/paragraph', ['placeholder' => 'Antwort hier eingeben...']],
];
?>

<details class="faq-item-block">
    <summary>
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
    </summary>
</details>