<?php
/**
 * Block: FAQ Container
 * Dieser Block dient als Container für die FAQ-Einträge.
 * Er liest die ACF-Felder aus und gibt sie an das Item-Template weiter.
 */
$faq_items = get_field('faq_items');

if ($faq_items) : ?>

<section id="faq" aria-labelledby="faq-heading">
    <div class="container">
        <div class="section-title">
            <span class="badge">FAQ</span>
            <h2 id="faq-heading">Häufig gestellte Fragen</h2>
            <p>Antworten auf die wichtigsten Fragen rund um unsere Zusammenarbeit.</p>
        </div>
        <div class="faq">
            <?php
            foreach ($faq_items as $item) :
                get_template_part('blocks/faq-item/faq-item', null, ['item' => $item]);
            endforeach;
            ?>
        </div>
    </div>
</section>

<?php else : ?>
    <p>Keine FAQs gefunden. Bitte fügen Sie welche im Editor hinzu.</p>
<?php endif; ?>