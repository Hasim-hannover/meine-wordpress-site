<?php
/** Block: FAQ Container */
$allowed_blocks = ['acf/faq-item'];
$template = [['acf/faq-item']];
?>
<div class="faq-container-block">
    <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
</div>