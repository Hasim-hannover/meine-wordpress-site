<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Output organization and service schemas dynamically.
 * This file centralizes all structured data logic. Include it once in your child theme.
 */
function hu_output_schema()
{
    // Organization / LocalBusiness schema
    $org = [
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness',
        '@id'      => home_url('/#organization'),
        'name'     => 'Hasim Üner – Growth Architect',
        'alternateName' => 'Hasim Üner Webentwicklung & CRO',
        'url'      => home_url(),
        'description' => 'Spezialist für High-Performance WordPress-Systeme, Tracking (GA4) und Conversion-Optimierung in Hannover & Pattensen.',
        'telephone'   => '+49 176 81407134',
        'email'       => 'info@hasimuener.de',
        'logo'        => 'https://hasimuener.de/wp-content/uploads/2025/08/cropped-Logo-hasim-uener-1.webp',
        'image'       => 'https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp',
        'address'     => [
            '@type' => 'PostalAddress',
            'streetAddress'   => 'Warschauer Straße',
            'addressLocality' => 'Pattensen',
            'addressRegion'   => 'Niedersachsen',
            'postalCode'      => '30982',
            'addressCountry'  => 'DE'
        ],
        'geo' => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '52.264',
            'longitude' => '9.761'
        ],
        'openingHoursSpecification' => [
            [
                '@type'    => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'opens'     => '08:30',
                'closes'    => '16:00'
            ]
        ],
        'sameAs' => [
            'https://www.linkedin.com/in/hasim-%C3%BCner/',
            'https://github.com/Hasim-hannover/'
        ]
    ];

    $schemas = [$org];

    // Service definitions (slug => data)
    $service_definitions = [
        'wordpress-agentur-hannover' => [
            'name'        => 'WordPress Agentur Hannover',
            'description' => 'Individuelle WordPress-Entwicklung ohne Bloatware mit Fokus auf Core Web Vitals, Sicherheit und Skalierbarkeit.',
            'serviceType' => 'WordPress Agentur',
            'serviceOutput' => 'Modulare WordPress-Lösungen mit technischer Exzellenz'
        ],

        'wordpress-wartung-hannover' => [
            'name'        => 'WordPress Wartung & Betreuung',
            'description' => 'Der Schutzschild für Ihren digitalen Umsatz: Regelmässige Updates, präventive Abwehr, Performance-Monitoring und Express-Hilfe.',
            'serviceType' => 'Wartungsvertrag & Support',
            'serviceOutput' => 'Maximale Performance, gehärtete Sicherheit und schnelle Notfall-Unterstützung',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Basis – kleine Infoseiten & Blogs',
                    'price'         => 49,
                    'priceCurrency' => 'EUR',
                    'description'   => 'Wöchentliche Updates, monatliches Cloud-Backup, Basis Uptime-Monitoring und Support per E-Mail (48h)'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Performance-Wächter – Firmen & Dienstleister',
                    'price'         => 79,
                    'priceCurrency' => 'EUR',
                    'description'   => 'Tägliche Sicherheits-Backups, proaktiver Malware-Scan, monatlicher Performance-Report, Wiederherstellung inkl. (Hack-Schutz) und Support per Mail (24h)'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'VIP & E-Commerce – Shops & kritische Seiten',
                    'price'         => 139,
                    'priceCurrency' => 'EUR',
                    'description'   => 'Echtzeit-Backups, WooCommerce Datenbank-Optimierung, Telefon & WhatsApp Support, bevorzugte Behandlung bei Ausfall und 1h Content-Pflege'
                ]
            ]
        ],

        'wordpress-seo' => [
            'name'        => 'WordPress SEO',
            'description' => 'SEO-Optimierung für WordPress-Websites – von technischer SEO bis Content-Strategie.',
            'serviceType' => 'SEO-Dienstleistung',
            'serviceOutput' => 'Verbesserte Rankings & Conversion Rates'
        ],

        'core-web-vitals-optimierung' => [
            'name'        => 'Speed & Core Web Vitals Optimierung',
            'description' => 'Performance-Optimierung mit Fokus auf Ladezeit, INP/LCP und Nutzererlebnis.',
            'serviceType' => 'Performance Optimierung',
            'serviceOutput' => 'Grüne Core Web Vitals und schnellere Ladezeiten',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Performance Architektur Paket',
                    'price'         => 649,
                    'priceCurrency' => 'EUR',
                    'description'   => 'Umfassendes Audit & Strategieplan, tiefgreifende technische Optimierung, Caching & CDN-Setup, Live-Performance-Dashboard und 3 Monate Support'
                ]
            ]
        ],

        'tracking-data' => [
            'name'        => 'GA4 & Server-Side Tracking',
            'description' => 'Implementation von GA4, Server-Side GTM und DSGVO-konformem Tracking.',
            'serviceType' => 'Tracking & Analytics',
            'serviceOutput' => 'Saubere Daten & Conversion-Insights'
        ],

        'conversion-optimierung' => [
            'name'        => 'Conversion Optimierung',
            'description' => 'Optimierung der UX und CRO-Frameworks für maximale Lead-Konversionen.',
            'serviceType' => 'Conversion Rate Optimization',
            'serviceOutput' => 'Höhere Conversion Rates und Umsatz'
        ],

        'wordpress-tech-audit' => [
            'name'        => 'WordPress Tech-Audit',
            'description' => 'KI-gestütztes Tech-Audit, das in 5 Minuten die nackten Zahlen zu Technik, PageSpeed und Tracking-Lücken liefert.',
            'serviceType' => 'Technisches Audit & Analyse',
            'serviceOutput' => 'Objektives Protokoll mit Core Web Vitals, Data-Integrity und Conversion-Insights',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Kostenloses Tech-Audit',
                    'price'         => 0,
                    'priceCurrency' => 'EUR',
                    'isAccessibleForFree' => true,
                    'description'   => 'Kostenlose 5-Minuten-Analyse, die Technik, Speed und Tracking-Lücken aufdeckt'
                ]
            ]
        ],

        'performance-marketing' => [
            'name'        => 'Performance Marketing',
            'description' => 'Datengetriebenes Performance Marketing: Jeder investierte Euro bringt einen messbaren Ertrag – weg von Zufall, hin zu System.',
            'serviceType' => 'Performance Marketing & Ads',
            'serviceOutput' => 'Messbares Wachstum durch orchestrierte Ads, Daten-Analyse und Conversion-Optimierung'
        ],

        'conversion-rate-optimization' => [
            'name'        => 'Conversion Rate Optimization',
            'description' => 'Vom Chaos zur Klarheit: Wir analysieren Nutzerverhalten und bauen den direktesten Weg zum messbaren Ergebnis.',
            'serviceType' => 'Conversion Rate Optimization',
            'serviceOutput' => 'Steigerung von Leads, Sales und ROAS durch datenbasierte Tests und Optimierungen'
        ],

        'ga4-tracking-setup' => [
            'name'        => 'GA4 & Tracking Setup',
            'description' => 'Vom Daten-Nebel zur Klarheit: DSGVO-konformes GA4 und Server-Side Tracking.',
            'serviceType' => 'Tracking & Analytics',
            'serviceOutput' => 'Lückenloses Tracking-Fundament mit GA4/GTM, Consent-Management und individuellen Dashboards'
        ],

        'wordpress-growth-operating-system' => [
            'name'        => 'WordPress Growth Operating System (WGOS)',
            'description' => 'Monatlicher Retainer für B2B-Unternehmen: Performance, Privacy-first Tracking, SEO, CRO & Automation als Owned-Leads-System.',
            'serviceType' => 'Growth Operating System',
            'serviceOutput' => 'Owned-Leads-System: Assets statt Kampagnen. Performance, Daten, Rankings, Content, Conversion.',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Maintenance',
                    'price'         => 1500,
                    'priceCurrency' => 'EUR',
                    'description'   => '30 Credits/Monat. Fundament sichern: Performance, Security, Tracking.'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Growth Partner',
                    'price'         => 2800,
                    'priceCurrency' => 'EUR',
                    'description'   => '60 Credits/Monat. Owned Full Stack: SEO + CRO + Content.'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Dominance',
                    'price'         => 4500,
                    'priceCurrency' => 'EUR',
                    'description'   => '100+ Credits/Monat. Full Stack inkl. Paid Booster & Automation.'
                ]
            ]
        ],
    ];

    /**
     * WICHTIGER FIX:
     * Viele deiner “Seiten” sind Posts (Insights). Daher NICHT nur is_page(),
     * sondern is_singular() (Pages + Posts + CPTs).
     */
    if (is_singular() && !is_attachment()) {

        $post_id = get_queried_object_id();
        $slug = $post_id ? get_post_field('post_name', $post_id) : '';

        // Service schema, falls slug matcht
        if ($slug && array_key_exists($slug, $service_definitions)) {
            $def = $service_definitions[$slug];

            $service = [
                '@context'   => 'https://schema.org',
                '@type'      => 'Service',
                '@id'        => home_url('/' . $slug . '/#service'),
                'name'       => $def['name'],
                'description'=> $def['description'],
                'provider'   => ['@id' => home_url('/#organization')],
                'serviceType'=> $def['serviceType'],
                'serviceOutput' => $def['serviceOutput'],
                'areaServed' => ['@type' => 'AdministrativeArea', 'name' => 'DACH'],
            ];

            if (isset($def['offers'])) {
                $service['offers'] = $def['offers'];
            }

            $schemas[] = $service;
        }

        // Über mich: Person + ProfilePage
        if ($slug === 'uber-mich') {
            $person = [
                '@context' => 'https://schema.org',
                '@type'    => 'Person',
                '@id'      => home_url('/uber-mich/#person'),
                'name'     => 'Hasim Üner',
                'jobTitle' => 'Growth Architect & Medienwissenschaftler',
                'url'      => home_url('/uber-mich/'),
                'image'    => 'https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp',
                'worksFor' => ['@id' => home_url('/#organization')],
                'sameAs'   => [
                    'https://www.linkedin.com/in/hasim-%C3%BCner/',
                    'https://github.com/Hasim-hannover/'
                ],
                'description' => 'Growth Architect & Medienwissenschaftler, spezialisiert auf High-Performance WordPress-Systeme, Tracking und Conversion-Optimierung.'
            ];

            $profilePage = [
                '@context' => 'https://schema.org',
                '@type'    => 'ProfilePage',
                '@id'      => home_url('/uber-mich/#profile'),
                'url'      => home_url('/uber-mich/'),
                'name'     => 'Über mich – Hasim Üner',
                'mainEntity' => ['@id' => home_url('/uber-mich/#person')],
                'inLanguage' => 'de',
                'about'    => ['@id' => home_url('/uber-mich/#person')]
            ];

            $schemas[] = $person;
            $schemas[] = $profilePage;
            $schemas[0]['founder'] = ['@id' => home_url('/uber-mich/#person')];
        }

        // Case study pages: Article schema
        if ($slug === 'case-studies' || $slug === 'case-studies-e-commerce') {
            if ($slug === 'case-studies') {
                $headline = 'Vom Kostenfaktor zur Profit-Maschine mit 34× ROAS';
                $description = 'Eine zweiphasige Growth-Strategie revolutionierte die Lead-Generierung, senkte Kosten um 83 % und optimierte zwei Conversion-Raten.';
                $datePublished = '2025-08-08';
            } else {
                $headline = 'Nachhaltigkeit skaliert nicht mit Ideologie, sondern mit System';
                $description = 'Vom 46 € Warenkorb zur 120 € Profit-Maschine in neun Monaten: Transformiert durch psychologisches Pricing und Prozess-Optimierung.';
                $datePublished = '2026-01-06';
            }

            $article = [
                '@context' => 'https://schema.org',
                '@type'    => 'Article',
                '@id'      => home_url('/' . $slug . '/#article'),
                'headline' => $headline,
                'description' => $description,
                'url'      => home_url('/' . $slug . '/'),
                'inLanguage' => 'de',
                'author'   => [
                    '@type' => 'Person',
                    'name'  => 'Hasim Üner',
                    'url'   => home_url('/uber-mich/')
                ],
                'publisher' => ['@id' => home_url('/#organization')],
                'datePublished' => $datePublished,
                'image' => $org['logo']
            ];

            $schemas[] = $article;
        }

        // Kostenlose Tools: CollectionPage
        if ($slug === 'kostenlose-tools') {
            $toolsPage = [
                '@context' => 'https://schema.org',
                '@type'    => 'CollectionPage',
                '@id'      => home_url('/kostenlose-tools/#collection'),
                'url'      => home_url('/kostenlose-tools/'),
                'name'     => 'Kostenlose Tools für dein Wachstum',
                'description' => 'Kostenlose Tools zur Berechnung deiner Kampagnenrentabilität, Solarpotenziale und Website-Performance.',
                'hasPart'  => [
                    [
                        '@type' => 'SoftwareApplication',
                        'name'  => 'ROI-Rechner',
                        'description' => 'Berechnet die Rentabilität und den Break-even-Point deiner Marketing-Kampagnen',
                        'url' => home_url('/kostenlose-tools/roi-rechner/')
                    ],
                    [
                        '@type' => 'SoftwareApplication',
                        'name'  => 'Solarrechner',
                        'description' => 'Analysiert das Potenzial und die Wirtschaftlichkeit einer Photovoltaikanlage',
                        'url' => home_url('/kostenlose-tools/solar-rechner/')
                    ],
                    [
                        '@type' => 'SoftwareApplication',
                        'name'  => 'Website Performance Analyse',
                        'description' => 'Analysiert Ladezeiten und identifiziert Engpässe, um die User Experience zu verbessern',
                        'url' => home_url('/kostenlose-tools/website-performance-analyse/')
                    ]
                ],
                'inLanguage' => 'de',
                'publisher'  => ['@id' => home_url('/#organization')]
            ];

            $schemas[] = $toolsPage;
        }

        /**
         * FAQ SCHEMA (NEU, robust):
         * - erkennt <details><summary>…</summary>…</details>
         * - erkennt button.faq-trigger + div.faq-content (deine häufigste Struktur)
         * - dedupliziert Fragen
         */
        global $post;
        if (isset($post)) {

            $raw = (string) $post->post_content;

            // Performance: nur wenn es nach FAQ aussieht
            $maybe_has_faq =
                (stripos($raw, 'faq-trigger') !== false) ||
                (stripos($raw, 'faq-content') !== false) ||
                (stripos($raw, '<details') !== false) ||
                (stripos($raw, 'hu_faq') !== false) ||
                (stripos($raw, 'faq-item') !== false);

            if ($maybe_has_faq) {

                // do_shortcode statt apply_filters('the_content') um Rank Math
                // nicht als Nebeneffekt ein zweites FAQPage-Schema ausgeben zu lassen.
                $content = do_shortcode($raw);

                $faq_entities = [];
                $dedupe = [];

                // Helper: add QA safely
                $add_qa = function ($q, $a) use (&$faq_entities, &$dedupe) {
                    $q = trim((string)$q);
                    $a = trim((string)$a);

                    // Entferne häufiges " + " am Ende (kommt durch <span>+</span> im Button)
                    $q = preg_replace('/\s*\+\s*$/u', '', $q);

                    if ($q === '' || $a === '') {
                        return;
                    }

                    $key = mb_strtolower(preg_replace('/\s+/u', ' ', $q));
                    if (isset($dedupe[$key])) {
                        return;
                    }
                    $dedupe[$key] = true;

                    $faq_entities[] = [
                        '@type' => 'Question',
                        'name'  => $q,
                        'acceptedAnswer' => [
                            '@type' => 'Answer',
                            'text'  => $a,
                        ],
                    ];
                };

                // 1) DETAILS/SUMMARY Muster (flexibler)
                if (preg_match_all('/<details[^>]*>.*?<summary[^>]*>(.*?)<\/summary>(.*?)<\/details>/is', $content, $m1, PREG_SET_ORDER)) {
                    foreach ($m1 as $match) {
                        $q = wp_strip_all_tags($match[1]);

                        // Answer: alles innerhalb details nach summary, HTML raus
                        $a = wp_strip_all_tags($match[2]);

                        $add_qa($q, $a);
                    }
                }

                // 2) BUTTON + FAQ-CONTENT Muster (dein Wartung-Layout)
                if (preg_match_all('/<button[^>]*class="[^"]*\bfaq-trigger\b[^"]*"[^>]*>(.*?)<\/button>\s*<div[^>]*class="[^"]*\bfaq-content\b[^"]*"[^>]*>(.*?)<\/div>/is', $content, $m2, PREG_SET_ORDER)) {
                    foreach ($m2 as $match) {
                        $q = wp_strip_all_tags($match[1]);
                        $a = wp_strip_all_tags($match[2]);

                        $add_qa($q, $a);
                    }
                }

                // Output FAQPage schema if found
                if (!empty($faq_entities)) {
                    $faq_schema = [
                        '@context'   => 'https://schema.org',
                        '@type'      => 'FAQPage',
                        '@id'        => home_url('/' . ($slug ?: '') . '/#faq'),
                        'mainEntity' => $faq_entities,
                    ];
                    $schemas[] = $faq_schema;
                }
            }
        }
    }

    // Output each schema as JSON-LD
    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}

add_action('wp_head', 'hu_output_schema', 10);
