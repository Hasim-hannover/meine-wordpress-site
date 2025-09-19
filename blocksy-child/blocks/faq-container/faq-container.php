<?php
/**
 * Block: FAQ Container
 * ACF-Felder werden hier ausgelesen und an das Template weitergegeben.
 */

// Rufe das Repeater-Feld 'faq_items' ab
$faq_items = get_field('faq_items');

// Überprüfe, ob das Feld existiert und nicht leer ist
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
            // Schleife durch die FAQ-Einträge
            foreach ($faq_items as $item) :
                // Lade das Template für das einzelne FAQ-Item
                // Die ACF-Daten ($item) werden an das Template übergeben
                get_template_part('blocks/faq-item/faq-item', null, ['item' => $item]);
            endforeach;
            ?>
        </div>
    </div>
</section>

<?php endif; ?>