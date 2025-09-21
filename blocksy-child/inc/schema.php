<?php
// /inc/schema.php
if (!function_exists('hu_get_schema')) {
    function hu_get_schema() {
        // Minimal robustes, seitenweites Schema (erweitere bei Bedarf)
        $site_url = get_home_url();
        return [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "Organization",
                    "@id"   => $site_url . "/#organization",
                    "name"  => "Hasim Üner – Growth Architect",
                    "url"   => $site_url . "/",
                    "logo"  => $site_url . "/wp-content/uploads/2025/08/Logo-hasim-uener-1.webp"
                ],
                [
                    "@type"      => "WebSite",
                    "@id"        => $site_url . "/#website",
                    "url"        => $site_url . "/",
                    "name"       => "Hasim Üner",
                    "publisher"  => [ "@id" => $site_url . "/#organization" ],
                    "inLanguage" => get_bloginfo('language') ?: "de-DE"
                ],
                [
                    "@type"     => "WebPage",
                    "@id"       => esc_url( home_url( add_query_arg( [] ) ) ) . "#webpage",
                    "url"       => esc_url( home_url( add_query_arg( [] ) ) ),
                    "isPartOf"  => [ "@id" => $site_url . "/#website" ],
                    "name"      => wp_get_document_title()
                ]
            ]
        ];
    }
}
