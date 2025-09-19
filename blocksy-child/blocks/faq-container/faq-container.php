<?php
/**
 * Block: FAQ Container
 * Dieser Block ist ein Container für die FAQ-Items.
 */

$allowed_blocks = ['acf/faq-item'];
?>

<section id="faq" aria-labelledby="faq-heading">
    <div class="container">
        <div class="section-title">
            <span class="badge">FAQ</span>
            <h2 id="faq-heading">Häufig gestellte Fragen</h2>
            <p>Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.</p>
        </div>
        <div class="faq">
            <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" />
        </div>
    </div>
</section>