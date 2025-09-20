
/**
 * Leitet alle Autoren-Archivseiten auf die "Über Mich"-Seite um.
 * Das vermeidet doppelten Inhalt und verbessert die User Experience.
 */
add_action( 'template_redirect', function() {
    if ( is_author() ) {
        wp_redirect( home_url( '/ueber-mich/' ), 301 );
        exit;
    }
} );

/**
 * Fügt das optimierte Schema.org JSON-LD für die Startseite in den Footer ein.
 * Dies verbessert die Ladeleistung, da das Schema nicht das Rendern blockiert.
 */
add_action( 'wp_footer', function() {
    // Führt diesen Code nur auf der Startseite aus.
    if ( ! is_front_page() ) {
        return;
    }

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
            [ "@id" => "https://hasimuener.de/growth-blueprint/#webpage" ],
            [ "@id" => "https://hasimuener.de/case-studies/#webpage" ],
            [ "@id" => "https://hasimuener.de/core-web-vitals-optimierung/#webpage" ],
            [ "@id" => "https://hasimuener.de/performance-marketing/#webpage" ],
            [ "@id" => "https://hasimuener.de/ga4-tracking-setup/#webpage" ],
            [ "@id" => "https://hasimuener.de/aktuelle-blogbeitrage/#webpage" ],
            [ "@id" => "https://hasimuener.de/kontakt/#webpage" ]
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

    echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>';
} );