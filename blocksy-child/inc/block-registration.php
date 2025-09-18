// FAQ Accordion Block
acf_register_block_type([
    'name'            => 'faq-accordion',
    'title'           => __('FAQ Akkordeon'),
    'description'     => __('Ein Block für aufklappbare Fragen und Antworten.'),
    'render_template' => 'blocks/faq-accordion/faq-accordion.php',
    'category'        => 'layout',
    'icon'            => 'editor-help',
    'keywords'        => ['faq', 'accordion', 'fragen'],
    'enqueue_style'   => get_stylesheet_directory_uri() . '/blocks/faq-accordion/faq-accordion.css',
    'enqueue_script'  => get_stylesheet_directory_uri() . '/blocks/faq-accordion/faq-accordion.js',
    'mode'            => 'preview', // Sorgt dafür, dass die Felder direkt im Block angezeigt werden
    'supports'        => [
        'mode' => false, // Verhindert, dass der User zwischen den Modi wechseln kann
    ],
]);