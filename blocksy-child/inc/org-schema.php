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
        'alternateName' => 'Hasim Üner - WordPress Growth Architect',
        'url'      => home_url(),
        'description' => 'WordPress Growth Architect für B2B-Unternehmen: Positionierung, technische SEO, privacy-first Measurement und Conversion-Logik als Nachfrage-System.',
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
            'name'        => 'WordPress Growth Architect Hannover',
            'description' => 'WordPress-Systeme für B2B-Unternehmen in Hannover: Angebotsseiten, technische SEO, privacy-first Measurement, Conversion-Logik und kontrollierte Weiterentwicklung als Nachfrage-System.',
            'serviceType' => 'WordPress Growth Architecture',
            'serviceOutput' => 'Steuerbares WordPress-System mit Angebotsseiten, Datenebene, KPI-Klarheit und Ownership statt Lock-in'
        ],

        'customer-journey-audit' => [
            'name'        => 'Growth Audit',
            'description' => 'Persönlicher Growth Audit für B2B-Unternehmen mit WordPress: drei priorisierte Anfragebremsen, eine klare Priorität und der nächste sinnvolle Schritt.',
            'serviceType' => 'Growth Audit',
            'serviceOutput' => 'Persönliche Einschätzung der größten Anfragebremsen auf einer Startseite oder kaufnahen Angebotsseite',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Growth Audit',
                    'price'         => 0,
                    'priceCurrency' => 'EUR',
                    'isAccessibleForFree' => true,
                    'description'   => 'Kostenloser Ersteinstieg für B2B-WordPress-Seiten mit unklarer Lead-Performance'
                ]
            ]
        ],

        'growth-audit' => [
            'name'        => 'Growth Audit',
            'description' => 'Persönlicher Growth Audit für B2B-Unternehmen mit WordPress: drei priorisierte Anfragebremsen, eine klare Priorität und der nächste sinnvolle Schritt.',
            'serviceType' => 'Growth Audit',
            'serviceOutput' => 'Persönliche Einschätzung der größten Anfragebremsen auf einer Startseite oder kaufnahen Angebotsseite',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Growth Audit',
                    'price'         => 0,
                    'priceCurrency' => 'EUR',
                    'isAccessibleForFree' => true,
                    'description'   => 'Kostenloser Ersteinstieg für B2B-WordPress-Seiten mit unklarer Lead-Performance'
                ]
            ]
        ],

        'audit' => [
            'name'        => 'Growth Audit',
            'description' => 'Persönlicher Growth Audit für B2B-Unternehmen mit WordPress: drei priorisierte Anfragebremsen, eine klare Priorität und der nächste sinnvolle Schritt.',
            'serviceType' => 'Growth Audit',
            'serviceOutput' => 'Persönliche Einschätzung der größten Anfragebremsen auf einer Startseite oder kaufnahen Angebotsseite'
        ],

        '360-deep-dive' => [
            'name'        => 'Vertiefte Folgeanalyse nach dem Growth Audit',
            'description' => 'Persönliche Folgeanalyse nach dem Audit mit priorisierter Entscheidungsvorlage für Positionierung, IA, Measurement und Conversion.',
            'serviceType' => 'Folgeanalyse nach dem Growth Audit',
            'serviceOutput' => 'Priorisierte Entscheidungsvorlage für die nächsten sinnvollen Struktur- und Umsetzungsentscheidungen'
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

        'wordpress-seo-hannover' => [
            'name'        => 'WordPress SEO Hannover',
            'description' => 'WGOS-Cluster für WordPress SEO in Hannover: technische Basis, Themenarchitektur und conversion-nahe Sichtbarkeit für B2B-Websites.',
            'serviceType' => 'WordPress SEO',
            'serviceOutput' => 'Priorisierte SEO-Bausteine aus Technical SEO, Keyword-Strategie, Pillar Pages und interner Verlinkung'
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

        'core-web-vitals' => [
            'name'        => 'Speed & Core Web Vitals Optimierung',
            'description' => 'Performance-Optimierung mit Fokus auf Ladezeit, INP/LCP und Nutzererlebnis.',
            'serviceType' => 'Performance Optimierung',
            'serviceOutput' => 'Gruene Core Web Vitals und schnellere Ladezeiten'
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

        'performance-marketing' => [
            'name'        => 'Performance Marketing für B2B-WordPress-Websites',
            'description' => 'WGOS-Aktivierungslayer für bezahlte Nachfrage: erst Tracking, Technik und Zielseite, dann skalierbare Kampagnen.',
            'serviceType' => 'Performance Marketing',
            'serviceOutput' => 'Kampagnenfähige Zielseiten und belastbare Tracking-Signale für effiziente Paid-Aktivierung'
        ],

        'wordpress-growth-operating-system' => [
            'name'        => 'WordPress Growth Operating System (WGOS)',
            'description' => 'Strukturiertes Nachfrage-System für Unternehmen: Strategie, Fundament, Messbarkeit, Sichtbarkeit und Conversion in einer klaren WordPress-Logik.',
            'serviceType' => 'Growth Operating System',
            'serviceOutput' => 'Strukturiertes Nachfrage-System auf WordPress-Basis mit klarer Reihenfolge, voller Ownership und planbarer Weiterentwicklung.',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Fundament',
                    'price'         => 1500,
                    'priceCurrency' => 'EUR',
                    'description'   => '30 Credits/Monat. Fundament, Messbarkeit und technische Stabilität ordnen.'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Systemaufbau',
                    'price'         => 2800,
                    'priceCurrency' => 'EUR',
                    'description'   => '60 Credits/Monat. Sichtbarkeit und Conversion auf saubere Basis setzen.'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Weiterentwicklung',
                    'price'         => 4500,
                    'priceCurrency' => 'EUR',
                    'description'   => '100+ Credits/Monat. Das System kontrolliert ausbauen und weiter nachschärfen.'
                ]
            ]
        ],

        'wgos' => [
            'name'        => 'WordPress Growth Operating System (WGOS)',
            'description' => 'Strukturiertes Nachfrage-System für Unternehmen: WordPress als verbindende Architektur für Strategie, Fundament, Messbarkeit, Sichtbarkeit und Conversion.',
            'serviceType' => 'Growth Operating System',
            'serviceOutput' => 'Strukturiertes Nachfrage-System mit klarer Priorisierung, messbarer Entwicklung und voller Kontrolle'
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

        if (is_singular('wgos_asset') && function_exists('nexus_get_wgos_asset_definition')) {
            $asset = nexus_get_wgos_asset_definition(get_post($post_id));
            $schema_type = $asset['schema_type'] ?? 'Service';

            if ($asset && $schema_type !== 'none') {
                $description = '';

                if (!empty($asset['result'])) {
                    $description = (string) $asset['result'];
                } elseif (!empty($asset['excerpt'])) {
                    $description = (string) $asset['excerpt'];
                }

                $service = [
                    '@context'      => 'https://schema.org',
                    '@type'         => $schema_type,
                    '@id'           => trailingslashit(get_permalink($post_id)) . '#service',
                    'name'          => (string) $asset['title'],
                    'description'   => $description,
                    'url'           => get_permalink($post_id),
                    'provider'      => ['@id' => home_url('/#organization')],
                    'serviceType'   => 'WGOS Asset',
                    'serviceOutput' => (string) ($asset['result'] ?? ''),
                    'areaServed'    => ['@type' => 'AdministrativeArea', 'name' => 'DACH'],
                    'isPartOf'      => ['@id' => home_url('/wordpress-growth-operating-system/#service')],
                ];

                $schemas[] = $service;
            }
        }

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

        if ( is_singular( 'post' ) && $post_id ) {
            $author_id         = (int) get_post_field( 'post_author', $post_id );
            $author_name       = $author_id ? get_the_author_meta( 'display_name', $author_id ) : 'Hasim Üner';
            $author_profile    = home_url( '/uber-mich/' );
            $post_permalink    = get_permalink( $post_id );
            $post_description  = get_the_excerpt( $post_id );
            $post_description  = $post_description ? wp_strip_all_tags( $post_description ) : wp_strip_all_tags( get_the_title( $post_id ) );
            $post_image        = get_the_post_thumbnail_url( $post_id, 'full' );
            $published_date    = get_post_time( DATE_W3C, true, $post_id );
            $modified_date     = get_post_modified_time( DATE_W3C, true, $post_id );

            $blog_posting = [
                '@context'         => 'https://schema.org',
                '@type'            => 'BlogPosting',
                '@id'              => trailingslashit( $post_permalink ) . '#blogposting',
                'mainEntityOfPage' => $post_permalink,
                'headline'         => get_the_title( $post_id ),
                'description'      => $post_description,
                'datePublished'    => $published_date,
                'dateModified'     => $modified_date,
                'inLanguage'       => 'de',
                'author'           => [
                    '@type'  => 'Person',
                    'name'   => $author_name,
                    'url'    => $author_profile,
                    'sameAs' => [
                        'https://www.linkedin.com/in/hasim-%C3%BCner/',
                    ],
                ],
                'publisher'        => ['@id' => home_url('/#organization')],
                'isPartOf'         => [
                    '@type' => 'Blog',
                    '@id'   => home_url('/blog/#blog'),
                    'url'   => home_url('/blog/'),
                    'name'  => 'Insights',
                ],
            ];

            if ( $post_image ) {
                $blog_posting['image'] = [
                    '@type' => 'ImageObject',
                    'url'   => $post_image,
                ];
            }

            $schemas[] = $blog_posting;
        }

        // Ergebnisse hub: CollectionPage schema
        if ($slug === 'case-studies' || $slug === 'case-studies-e-commerce' || $slug === 'ergebnisse') {
            $collection = [
                '@context' => 'https://schema.org',
                '@type'    => 'CollectionPage',
                '@id'      => home_url('/' . $slug . '/#collection'),
                'url'      => home_url('/' . $slug . '/'),
                'name'     => 'Ergebnisse',
                'headline' => 'Ergebnisse, Case Studies und Whitelabel-Proof von Hasim Üner',
                'description' => 'Öffentliche Case Studies, anonymisierte Whitelabel-Arbeit und laufende Retainer als gemeinsamer Proof-Layer für WordPress-Systemarbeit.',
                'inLanguage' => 'de',
                'isPartOf' => ['@id' => home_url('/#website')],
                'about' => ['@id' => home_url('/#organization')],
                'hasPart' => array_values(array_filter([
                    [
                        '@type' => 'Article',
                        'name'  => 'E3 New Energy',
                        'url'   => home_url('/e3-new-energy/')
                    ],
                    nexus_get_page_id([ 'case-study-domdar', 'domdar' ]) ? [
                        '@type' => 'Article',
                        'name'  => 'DOMDAR',
                        'url'   => nexus_get_page_url([ 'case-study-domdar', 'domdar' ], home_url('/case-study-domdar/'))
                    ] : null,
                    nexus_get_whitelabel_page_id() ? [
                        '@type' => 'WebPage',
                        'name'  => 'Whitelabel & Retainer',
                        'url'   => nexus_get_whitelabel_page_url()
                    ] : null,
                ])),
            ];

            $schemas[] = $collection;
        }

        if ($slug === 'whitelabel-retainer' || $slug === 'whitelabel-retainer-proof' || $slug === 'whitelabel') {
            $whitelabelPage = [
                '@context' => 'https://schema.org',
                '@type'    => 'AboutPage',
                '@id'      => home_url('/' . $slug . '/#about'),
                'url'      => home_url('/' . $slug . '/'),
                'name'     => 'Whitelabel & Retainer',
                'headline' => 'Whitelabel-Arbeit und laufende Retainer von Hasim Üner',
                'description' => 'Anonymisierte Einblicke in Whitelabel-Projekte, laufende Retainer und typische Eingriffstiefen für WordPress, SEO, Tracking und CRO.',
                'inLanguage' => 'de',
                'about'    => ['@id' => home_url('/#organization')],
                'mainEntity' => [
                    '@type' => 'Person',
                    'name'  => 'Hasim Üner',
                    'url'   => home_url('/uber-mich/')
                ],
                'image' => 'https://hasimuener.de/wp-content/uploads/2026/01/Hasim-Uener-Prtraeit_Startseite.webp',
            ];

            $schemas[] = $whitelabelPage;
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

            // Einige Templates rendern ihr FAQPage JSON-LD bewusst direkt im Template.
            if (in_array($slug, ['wordpress-agentur-hannover', 'wgos', 'wordpress-growth-operating-system'], true)) {
                $maybe_has_faq = false;
            }

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
                    // Auf der Startseite kein Seiten-Slug in der ID verwenden
                    $faq_base = is_front_page() ? home_url('/') : home_url('/' . ($slug ?: '') . '/');
                    $faq_schema = [
                        '@context'    => 'https://schema.org',
                        '@type'       => 'FAQPage',
                        '@id'         => $faq_base . '#faq',
                        'url'         => $faq_base,
                        'inLanguage'  => 'de',
                        'publisher'   => ['@id' => home_url('/#organization')],
                        'mainEntity'  => $faq_entities,
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
