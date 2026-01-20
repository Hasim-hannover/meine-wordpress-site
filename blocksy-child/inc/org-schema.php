<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Output organization and service schemas dynamically.
 * This file centralizes all structured data logic. Include it once in your child theme.
 */
function hu_output_schema() {
    // Organization / LocalBusiness schema
    $org = [
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness',
        '@id'      => home_url('/#organization'),
        'name'     => 'Hasim Üner – Growth Architect',
        'alternateName' => 'Hasim Üner Webentwicklung & CRO',
        'url'      => home_url(),
        'description' => 'Spezialist für High‑Performance WordPress‑Systeme, Tracking (GA4) und Conversion‑Optimierung in Hannover & Pattensen.',
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
                'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday'],
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

    // Map specific pages to their service schema definitions
    // Extend this array with slug => schema pairs as needed
    $service_definitions = [
        'wordpress-agentur-hannover' => [
            'name'        => 'WordPress Agentur Hannover',
            'description' => 'Individuelle WordPress‑Entwicklung ohne Bloatware mit Fokus auf Core Web Vitals, Sicherheit und Skalierbarkeit.',
            'serviceType' => 'WordPress Agentur',
            'serviceOutput' => 'Modulare WordPress‑Lösungen mit technischer Exzellenz'
        ],
        // WordPress Wartung & Betreuung: use correct slug "wordpress-wartung-hannover"
        'wordpress-wartung-hannover' => [
            'name'        => 'WordPress Wartung & Betreuung',
            // Tagline emphasises protection of digital revenue and emergency help【309226683931710†L70-L78】.
            'description' => 'Der Schutzschild für Ihren digitalen Umsatz: Regelmässige Updates, präventive Abwehr, Performance‑Monitoring und Express‑Hilfe【309226683931710†L70-L78】.',
            'serviceType' => 'Wartungsvertrag & Support',
            'serviceOutput' => 'Maximale Performance, gehärtete Sicherheit und schnelle Notfall‑Unterstützung',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Basis – kleine Infoseiten & Blogs',
                    'price'         => '49',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Wöchentliche Updates, monatliches Cloud‑Backup, Basis Uptime‑Monitoring und Support per E‑Mail (48h)【588342120472337†L113-L118】'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Performance‑Wächter – Firmen & Dienstleister',
                    'price'         => '79',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Tägliche Sicherheits‑Backups, proaktiver Malware‑Scan, monatlicher Performance‑Report, Wiederherstellung inkl. (Hack‑Schutz) und Support per Mail (24h)【588342120472337†L128-L135】'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'VIP & E‑Commerce – Shops & kritische Seiten',
                    'price'         => '139',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Echtzeit‑Backups, WooCommerce Datenbank‑Optimierung, Telefon & WhatsApp Support, bevorzugte Behandlung bei Ausfall und 1h Content‑Pflege【588342120472337†L142-L149】'
                ]
            ]
        ],
        'wordpress-seo' => [
            'name'        => 'WordPress SEO',
            'description' => 'SEO‑Optimierung für WordPress‑Websites – von technischer SEO bis Content‑Strategie.',
            'serviceType' => 'SEO‑Dienstleistung',
            'serviceOutput' => 'Verbesserte Rankings & Conversion Rates'
        ],
        'core-web-vitals-optimierung' => [
            'name'        => 'Speed & Core Web Vitals Optimierung',
            'description' => 'Performance‑Optimierung mit Fokus auf Ladezeit, INP/LCP und Nutzererlebnis.',
            'serviceType' => 'Performance Optimierung',
            'serviceOutput' => 'Grüne Core Web Vitals und schnellere Ladezeiten',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Performance Architektur Paket',
                    'price'         => '649',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Umfassendes Audit & Strategieplan, tiefgreifende technische Optimierung, Caching & CDN‑Setup, Live‑Performance‑Dashboard und 3 Monate Support【103301788764763†L175-L180】'
                ]
            ]
        ],
        'tracking-data' => [
            'name'        => 'GA4 & Server‑Side Tracking',
            'description' => 'Implementation von GA4, Server‑Side GTM und DSGVO‑konformem Tracking.',
            'serviceType' => 'Tracking & Analytics',
            'serviceOutput' => 'Saubere Daten & Conversion‑Insights'
        ],
        'conversion-optimierung' => [
            'name'        => 'Conversion Optimierung',
            'description' => 'Optimierung der UX und CRO‑Frameworks für maximale Lead‑Konversionen.',
            'serviceType' => 'Conversion Rate Optimization',
            'serviceOutput' => 'Höhere Conversion Rates und Umsatz'
        ],
        // Tech Audit: AI‑gestütztes Performance‑Protokoll für B2B WordPress
        'wordpress-tech-audit' => [
            'name'        => 'WordPress Tech‑Audit',
            // Provides an AI audit delivering numbers on tech, speed and tracking gaps in five minutes【743685003484771†L70-L75】.
            'description' => 'KI‑gestütztes Tech‑Audit, das in 5 Minuten die nackten Zahlen zu Technik, PageSpeed und Tracking‑Lücken liefert【743685003484771†L70-L75】.',
            'serviceType' => 'Technisches Audit & Analyse',
            'serviceOutput' => 'Objektives Protokoll mit Core Web Vitals, Data‑Integrity und Conversion‑Insights【743685003484771†L105-L116】',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Kostenloses Tech‑Audit',
                    'price'         => '0',
                    'priceCurrency' => 'EUR',
                    'isAccessibleForFree' => true,
                    'description'   => 'Kostenlose 5‑Minuten‑Analyse, die die nackten Zahlen zu Technik, Speed und Tracking aufdeckt【743685003484771†L70-L75】'
                ]
            ]
        ],
        // Performance Marketing: Systematisches Marketing für messbaren ROI
        'performance-marketing' => [
            'name'        => 'Performance Marketing',
            // Emphasises data‑driven architecture delivering measurable return for every euro invested【755669623013005†L66-L70】.
            'description' => 'Datengetriebenes Performance Marketing: Jeder investierte Euro bringt einen messbaren Ertrag – weg von Zufall, hin zu System【755669623013005†L66-L70】.',
            'serviceType' => 'Performance Marketing & Ads',
            'serviceOutput' => 'Messbares Wachstum durch orchestrierte Ads, Daten‑Analyse und Conversion‑Optimierung'
        ],
        // Conversion Rate Optimization (English slug)
        'conversion-rate-optimization' => [
            'name'        => 'Conversion Rate Optimization',
            // From chaos to clarity: building direct paths from visit to conversion【583847575741155†L69-L73】.
            'description' => 'Vom Chaos zur Klarheit: Wir analysieren Nutzerverhalten und bauen den direktesten Weg zum messbaren Ergebnis【583847575741155†L69-L73】.',
            'serviceType' => 'Conversion Rate Optimization',
            'serviceOutput' => 'Steigerung von Leads, Sales und ROAS durch datenbasierte Tests und Optimierungen【583847575741155†L119-L145】'
        ],
        // GA4 & Tracking Setup
        'ga4-tracking-setup' => [
            'name'        => 'GA4 & Tracking Setup',
            // Provides a tracking foundation turning data noise into clarity【306576807650241†L66-L70】.
            'description' => 'Vom Daten‑Nebel zur Klarheit: DSGVO‑konformes GA4 und Server‑Side Tracking, das Ihnen die Wahrheit über Ihr Business verrät【306576807650241†L66-L70】.',
            'serviceType' => 'Tracking & Analytics',
            'serviceOutput' => 'Lückenloses Tracking‑Fundament mit GA4/GTM, Consent‑Management und individuellen Dashboards【306576807650241†L95-L119】'
        ],
        // WordPress Growth Operating System (WGOS)
        'wordpress-growth-operating-system' => [
            'name'        => 'WordPress Growth Operating System',
            // Growth as a system, not chance: combines tech, ads and strategy in a monthly retainer【728862304409385†L69-L74】.
            'description' => 'Wachstum als System: Das WGOS vereint High‑Performance Tech, Tracking, CRO, SEO und Ads in einem transparenten Retainer【728862304409385†L69-L74】【728862304409385†L79-L128】.',
            'serviceType' => 'Growth Operating System',
            'serviceOutput' => 'Modulares 7‑Module‑Framework mit Credits für kontinuierliche Entwicklung, Ads und Reporting【728862304409385†L79-L128】【728862304409385†L132-L174】',
            'offers'      => [
                [
                    '@type'         => 'Offer',
                    'name'          => 'Maintenance & Sicherheit',
                    'price'         => '490',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Tägliche Updates & Backups, Security‑Monitoring, Uptime‑Check und keine Entwicklungs‑Credits【937433392367584†L170-L180】'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Growth Partner',
                    'price'         => '1850',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Alles aus Maintenance plus 50 Credits pro Monat zur freien Verfügung für Ads, Features oder SEO, inklusive Priority Support und Strategie‑Report【937433392367584†L187-L200】'
                ],
                [
                    '@type'         => 'Offer',
                    'name'          => 'Dominance',
                    'price'         => '3200',
                    'priceCurrency' => 'EUR',
                    'description'   => 'Alles aus Maintenance plus 100 Credits, wöchentliche Fixes und direkter Slack‑Zugang【937433392367584†L203-L217】'
                ]
            ]
        ],
        // Add more services here as needed
    ];

    // Check current page slug and append corresponding service schema
    if (is_page()) {
        $slug = basename( get_permalink() );
        // Generate Service schema for known service pages
        if (array_key_exists($slug, $service_definitions)) {
            $def = $service_definitions[$slug];
            $service = [
                '@context'   => 'https://schema.org',
                '@type'      => 'Service',
                '@id'        => home_url( '/' . $slug . '/#service' ),
                'name'       => $def['name'],
                'description'=> $def['description'],
                'provider'   => ['@id' => home_url('/#organization')],
                'serviceType'=> $def['serviceType'],
                'serviceOutput' => $def['serviceOutput'],
                'areaServed' => ['@type' => 'AdministrativeArea', 'name' => 'DACH'],
                // Optionally add offers, brand, image etc.
            ];
            // Append offers if defined for this service
            if ( isset($def['offers']) ) {
                $service['offers'] = $def['offers'];
            }
            $schemas[] = $service;
        }

        // For the "Über mich" page, generate Person and ProfilePage schemas
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
                'description' => 'Growth Architect & Medienwissenschaftler, spezialisiert auf High‑Performance WordPress‑Systeme, Tracking und Conversion‑Optimierung.'
            ];

            // Replace AboutPage schema with ProfilePage to enable rich result eligibility.
            $profilePage = [
                '@context' => 'https://schema.org',
                '@type'    => 'ProfilePage',
                '@id'      => home_url('/uber-mich/#profile'),
                // URL of the profile page
                'url'      => home_url('/uber-mich/'),
                'name'     => 'Über mich – Hasim Üner',
                'mainEntity' => ['@id' => home_url('/uber-mich/#person')],
                'inLanguage' => 'de',
                // The page is about the person, not the organization, per ProfilePage guidelines
                'about'    => ['@id' => home_url('/uber-mich/#person')]
            ];

            $schemas[] = $person;
            $schemas[] = $profilePage;
            // Add founder relationship to the organization object
            $schemas[0]['founder'] = ['@id' => home_url('/uber-mich/#person')];
        }

        // Case study pages: output Article schema with headline and description
        if ($slug === 'case-studies' || $slug === 'case-studies-e-commerce') {
            // Choose details based on the slug
            if ($slug === 'case-studies') {
                $headline = 'Vom Kostenfaktor zur Profit‑Maschine mit 34× ROAS';
                $description = 'Eine zweiphasige Growth‑Strategie revolutionierte die Lead‑Generierung, senkte Kosten um 83 % und optimierte zwei Conversion‑Raten【296424233364953†L67-L71】.';
                $datePublished = '2025-08-08'; // approximate date from insights header
            } else {
                $headline = 'Nachhaltigkeit skaliert nicht mit Ideologie, sondern mit System';
                $description = 'Vom 46 € Warenkorb zur 120 € Profit‑Maschine in neun Monaten: Ein Nischen‑Shop wurde durch psychologisches Pricing und Prozess‑Optimierung transformiert【753813627795344†L75-L79】.';
                $datePublished = '2026-01-06'; // approximate date from insights header
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
                // Use Organization logo as image
                'image' => $org['logo']
            ];
            $schemas[] = $article;
        }

        // Kostenlose Tools page: output a CollectionPage listing available tools
        if ($slug === 'kostenlose-tools') {
            $toolsPage = [
                '@context' => 'https://schema.org',
                '@type'    => 'CollectionPage',
                '@id'      => home_url('/kostenlose-tools/#collection'),
                'url'      => home_url('/kostenlose-tools/'),
                'name'     => 'Kostenlose Tools für dein Wachstum',
                'description' => 'Kostenlose Tools zur Berechnung deiner Kampagnenrentabilität, Solarpotenziale und Website‑Performance【344650427800265†L64-L73】.',
                'hasPart'  => [
                    [
                        '@type' => 'SoftwareApplication',
                        'name'  => 'ROI‑Rechner',
                        'description' => 'Berechnet die Rentabilität und den Break‑even‑Point deiner Marketing‑Kampagnen',
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
    }

    // Output each schema as JSON‑LD
    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}

add_action('wp_head', 'hu_output_schema', 10);
