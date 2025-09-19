<?php
/**
 * Block: FAQ Container
 * Erlaubt das Hinzufügen von FAQ-Item-Blöcken.
 */

$allowed_blocks = ['acf/faq-item'];
$template = [['acf/faq-item']];
?>

<section id="faq" aria-labelledby="faq-heading">
    <div class="container">
        <div class="section-title">
            <span class="badge">FAQ</span>
            <h2 id="faq-heading">Häufig gestellte Fragen</h2>
            <p>Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.</p>
        </div>
        <div class="faq">
            <InnerBlocks allowedBlocks="<?php echo esc_attr(wp_json_encode($allowed_blocks)); ?>" template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
        </div>
    </div>
</section>