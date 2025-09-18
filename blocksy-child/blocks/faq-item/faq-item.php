<?php
/** Block: FAQ Item */
$template = [
    ['core/heading', ['level' => 3, 'placeholder' => 'Frage hier eingeben...']],
    ['core/paragraph', ['placeholder' => 'Antwort hier eingeben...']],
];
?>
<details class="faq-item-block">
    <summary>
        </summary>
    <div class="faq-item-content">
        <InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
    </div>
</details>