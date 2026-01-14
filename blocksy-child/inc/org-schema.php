<?php
/**
 * NEXUS ORGANIZATION SCHEMA (JSON-LD)
 * Standort: Warschauer Straße, Pattensen
 * Version: FINAL VALIDATED
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_head', function() {
    // Nur auf Startseite & Kontaktseite feuern
    if ( ! is_front_page() && ! is_page('kontakt') ) {
        return;
    }

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'ProfessionalService',
        '@id'           => home_url( '/#organization' ),
        'name'          => 'Hasim Üner | WordPress & Performance Marketing',
        'url'           => home_url(),
        
        // --- DEINE DATEN (GEPRÜFT) ---
        'telephone'     => '+49 176 81407134', 
        'email'         => 'info@hasimuener.de', 
        'image'         => 'https://hasimuener.de/wp-content/uploads/2024/10/Profilbild_Hasim-Uener.webp',
        'logo'          => 'https://hasimuener.de/wp-content/uploads/2025/08/cropped-Logo-hasim-uener-1.webp',
        // -----------------------------

        'description'   => 'Spezialist für High-Performance WordPress-Systeme, Tracking (GA4) und Conversion-Optimierung in Hannover & Pattensen.',
        
        'address'       => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Warschauer Straße',
            'addressLocality' => 'Pattensen',
            'postalCode'      => '30982',
            'addressCountry'  => 'DE',
            'addressRegion'   => 'Niedersachsen'
        ],
        
        'geo'           => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '52.264', 
            'longitude' => '9.761'
        ],
        
        'priceRange'    => '€€€',
        
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '18:00'
            ]
        ],
        
        'sameAs'        => [
            'https://www.linkedin.com/in/hasim-uener/',
            'https://github.com/hasimuener'
        ]
    ];

    echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
}, 10 );