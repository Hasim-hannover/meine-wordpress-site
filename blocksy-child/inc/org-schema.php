<?php
/**
 * NEXUS ORGANIZATION SCHEMA (JSON-LD)
 * Standort: Warschauer Straße, Pattensen
 * Zweck: Google Local & Knowledge Graph Dominanz
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_head', function() {
    // Nur auf der Startseite oder Kontaktseite ausgeben (vermeidet Duplikate)
    if ( ! is_front_page() && ! is_page('kontakt') ) {
        return;
    }

    $schema = [
        '@context'      => 'https://schema.org',
        '@type'         => 'ProfessionalService', // Oder 'LocalBusiness'
        '@id'           => home_url( '/#organization' ),
        'name'          => 'Hasim Üner | WordPress & Performance Marketing',
        'url'           => home_url(),
        'logo'          => get_stylesheet_directory_uri() . '/assets/img/logo.png', // Pfad ggf. anpassen!
        'image'         => get_stylesheet_directory_uri() . '/assets/img/og-image.jpg', // Dein Profilbild/Banner
        'description'   => 'Spezialist für High-Performance WordPress-Systeme, Tracking (GA4) und Conversion-Optimierung in Hannover & Pattensen.',
        'founder'       => [
            '@type' => 'Person',
            'name'  => 'Hasim Üner'
        ],
        'address'       => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'Warschauer Straße',
            'addressLocality' => 'Pattensen',
            'postalCode'      => '30982', // PLZ für Pattensen
            'addressCountry'  => 'DE',
            'addressRegion'   => 'Niedersachsen'
        ],
        'geo'           => [
            '@type'     => 'GeoCoordinates',
            'latitude'  => '52.264', // Ca. Koordinaten Pattensen (Zentrum)
            'longitude' => '9.761'
        ],
        'contactPoint'  => [
            '@type'       => 'ContactPoint',
            'contactType' => 'customer service',
            'areaServed'  => 'DE',
            'availableLanguage' => ['German', 'English']
        ],
        'sameAs'        => [
            // Hier deine Social Media Links eintragen
            'https://www.linkedin.com/in/hasim-%C3%BCner/',
            'https://github.com/Hasim-hannover'
        ],
        'priceRange'    => '$$$'
    ];

    echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
}, 10 );