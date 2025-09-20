<?php
/**
 * Schema.org JSON-LD Markup
 *
 * @package Blocksy Child
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Gibt das passende Schema.org Markup für die aktuelle Seite aus.
 */
function hu_output_schema_markup() {
    // Nur auf den Einzelseiten ausführen, nicht im Archiv etc.
    if ( ! is_singular() ) {
        return;
    }

    $schema = [];

    // ===================================================================
    // SCHEMA FÜR DIE STARTSEITE
    // ===================================================================
    if ( is_front_page() ) {
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "Person",
                    "@id" => "https://hasimuener.de/#person",
                    "name" => "Hasim Üner",
                    "url" => "https://hasimuener.de/ueber-mich/",
                    "image" => "https://hasimuener.de/wp-content/uploads/2025/08/Shopify-WordPress-Growth-Architect-400-x-400-px.webp",
                    "jobTitle" => "Growth Partner & Web Architect",
                    "worksFor" => [ "@id" => "https://hasimuener.de/#organization" ],
                    "sameAs" => [ "https://www.linkedin.com/in/hasim-uener/" ]
                ],
                [
                    "@type" => ["Organization", "LocalBusiness"],
                    "@id" => "https://hasimuener.de/#organization",
                    "name" => "Hasim Üner - Growth Partner Hannover",
                    "url" => "https://hasimuener.de/",
                    "logo" => "https://hasimuener.de/wp-content/uploads/2025/08/Logo-hasim-uener-1.webp",
                    "founder" => [ "@id" => "https://hasimuener.de/#person" ],
                    "address" => [
                        "@type" => "PostalAddress",
                        "streetAddress" => "Warschauer Str. 5",
                        "addressLocality" => "Pattensen",
                        "postalCode" => "30982",
                        "addressCountry" => "DE"
                    ],
                    "email" => "hallo@hasimuener.de",
                    "telephone" => "+4917681407134"
                ],
                [
                    "@type" => "WebSite",
                    "@id" => "https://hasimuener.de/#website",
                    "url" => "https://hasimuener.de/",
                    "name" => "Hasim Üner",
                    "publisher" => [ "@id" => "https://hasimuener.de/#organization" ],
                    "inLanguage" => "de-DE",
                    "hasPart" => [
                        [ "@id" => "https://hasimuener.de/ueber-mich/#webpage" ],
                        [ "@id" => "https://hasimuener.de/shopify-agentur-hannover/#webpage" ],
                        [ "@id" => "https://hasimuener.de/wordpress-agentur-hannover/#webpage" ],
                    ]
                ],
                [
                    "@type" => "WebPage",
                    "@id" => "https://hasimuener.de/#webpage",
                    "url" => "https://hasimuener.de/",
                    "name" => "Shopify & WordPress Growth Architect | Hasim Üner Hannover",
                    "isPartOf" => [ "@id" => "https://hasimuener.de/#website" ]
                ]
            ]
        ];
    }
    
    // Fügen Sie hier weitere `elseif ( is_page('slug') ) { ... }` Blöcke für andere Seiten ein.

    if ( ! empty( $schema ) ) {
        echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
    }
}
add_action( 'wp_footer', 'hu_output_schema_markup' );