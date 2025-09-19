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
                $question = $item['faq_question'] ?? '';
                $answer = $item['faq_answer'] ?? '';

                if (empty($question) || empty($answer)) {
                    continue;
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
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php else : ?>
    <p>Keine FAQs gefunden. Bitte fügen Sie welche im Editor hinzu.</p>
<?php endif; ?>