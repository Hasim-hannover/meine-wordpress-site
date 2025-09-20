<?php
/**
 * Schema.org JSON-LD Markup
 * Finale Version inkl. FAQ-Schema
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
                // Person, Organization, WebSite... (wie bisher)
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
                ],
                // NEU: FAQPage Schema für die Startseite
                [
                    "@type" => "FAQPage",
                    "@id" => "https://hasimuener.de/#faq",
                    "mainEntity" => [
                        [
                            "@type" => "Question",
                            "name" => "Wie schnell kann unser Projekt starten?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Nach unserem Erstgespräch meist innerhalb von 3–5 Werktagen. Einfache WordPress-Sites sind oft in 2–3 Wochen live, komplexere E-Commerce Projekte in 4–8 Wochen."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Was kostet eine professionelle Website?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Starter-Projekte beginnen ab 3.500€. In unserem kostenlosen Erstgespräch ermitteln wir den genauen Bedarf und erstellen ein passgenaues Angebot."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Bieten Sie auch Wartung & Support an?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Ja. Ich biete flexible Service-Pakete für regelmäßige Updates, Backups, Sicherheits-Checks und Performance-Monitoring an."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Wie wird der Erfolg des Projekts gemessen?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Anhand klar definierter KPIs, die wir gemeinsam festlegen: z. B. Conversion-Rate, ROAS, Cost-per-Lead oder organischen Traffic. Sie erhalten transparente Reportings."
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
    // ===================================================================
    // SCHEMA FÜR DIE WORDPRESS-SEITE
    // ===================================================================
    elseif ( is_page('wordpress-agentur-hannover') ) {
        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                // Hier könnten die allgemeinen Definitionen (Person, Org etc.) wiederholt werden
                // ...
                // NEU: FAQPage Schema für die WordPress-Seite
                [
                    "@type" => "FAQPage",
                    "@id" => "https://hasimuener.de/wordpress-agentur-hannover/#faq",
                    "mainEntity" => [
                        [
                            "@type" => "Question",
                            "name" => "Was unterscheidet Sie von einer typischen Webdesign-Agentur?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Ich liefere keine reinen 'Designs', sondern unternehmerische Lösungen. Mein Fokus liegt auf messbaren Ergebnissen wie Lead-Generierung und Umsatzsteigerung, nicht nur auf der Ästhetik."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Was kostet eine WordPress-Website, die wirklich Leads generiert?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Strategische WordPress-Systeme starten bei 3.500€. Der genaue Preis hängt von der Komplexität und den Zielen ab, die wir im kostenlosen Erstgespräch definieren."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "Ich habe bereits eine Website. Können Sie diese optimieren?",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "Ja, absolut. In einem Website-Audit analysiere ich die bestehende Seite auf technische und strategische Schwächen und entwickle einen klaren Plan zur Performance- und Conversion-Steigerung."
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    if ( ! empty( $schema ) ) {
        echo '<script type="application/ld+json">' . json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>';
    }
}
add_action( 'wp_footer', 'hu_output_schema_markup' );