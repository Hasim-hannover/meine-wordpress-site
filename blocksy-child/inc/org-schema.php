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
        'wordpress-wartung-betreuung' => [
            'name'        => 'WordPress Wartung & Betreuung',
            'description' => 'Kontinuierliche Pflege, Sicherheits‑Updates und Performance‑Monitoring für Ihre WordPress‑Site.',
            'serviceType' => 'Wartung & Support',
            'serviceOutput' => 'Sichere, stabile Website mit Top‑Performance'
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
            'serviceOutput' => 'Grüne Core Web Vitals und schnellere Ladezeiten'
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
            $schemas[] = $service;
        }

        // For the "Über mich" page, generate Person and AboutPage schemas
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

            $aboutPage = [
                '@context' => 'https://schema.org',
                '@type'    => 'AboutPage',
                '@id'      => home_url('/uber-mich/#about'),
                'url'      => home_url('/uber-mich/'),
                'name'     => 'Über mich – Hasim Üner',
                'mainEntity' => ['@id' => home_url('/uber-mich/#person')],
                'inLanguage' => 'de',
                'about'    => ['@id' => home_url('/#organization')]
            ];

            $schemas[] = $person;
            $schemas[] = $aboutPage;
            // Add founder relationship to the organization object
            $schemas[0]['founder'] = ['@id' => home_url('/uber-mich/#person')];
        }
    }

    // Output each schema as JSON‑LD
    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}

add_action('wp_head', 'hu_output_schema', 10);
