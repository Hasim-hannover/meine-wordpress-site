/* =========================================
   Meta Ads Landing Page – Page-specific JS
   Service Schema + Offer Schema (JSON-LD)
   ========================================= */
(function () {
    'use strict';

    /* --- Service Schema --- */
    const serviceSchema = {
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'Meta Ads (Facebook & Instagram)',
        description:
            'Strategische Meta Ads auf Facebook und Instagram – von der Zielgruppenanalyse über Creative-Entwicklung bis zur laufenden Kampagnenoptimierung für messbares Wachstum.',
        provider: {
            '@type': 'ProfessionalService',
            name: 'Hasim Üner – Webdesign & Digitale Strategie',
            url: 'https://hasimuener.de',
            address: {
                '@type': 'PostalAddress',
                addressLocality: 'Hannover',
                addressRegion: 'Niedersachsen',
                addressCountry: 'DE'
            }
        },
        areaServed: {
            '@type': 'City',
            name: 'Hannover'
        },
        serviceType: 'Social Media Advertising',
        hasOfferCatalog: {
            '@type': 'OfferCatalog',
            name: 'Meta Ads Pakete',
            itemListElement: [
                {
                    '@type': 'Offer',
                    name: 'Launchpad',
                    description: 'Strategie-Workshop, Werbekonto-Setup, 2 Kern-Kampagnen, 4 Creatives, Abschluss-Reporting.',
                    price: '750',
                    priceCurrency: 'EUR',
                    priceSpecification: {
                        '@type': 'UnitPriceSpecification',
                        price: '750',
                        priceCurrency: 'EUR',
                        referenceQuantity: {
                            '@type': 'QuantitativeValue',
                            value: '1',
                            unitCode: 'C62'
                        }
                    }
                },
                {
                    '@type': 'Offer',
                    name: 'Growth Engine',
                    description: 'Laufendes Kampagnen-Management, A/B-Testing, wöchentliche Updates, monatliches Strategie-Meeting.',
                    price: '1500',
                    priceCurrency: 'EUR',
                    priceSpecification: {
                        '@type': 'UnitPriceSpecification',
                        price: '1500',
                        priceCurrency: 'EUR',
                        referenceQuantity: {
                            '@type': 'QuantitativeValue',
                            value: '1',
                            unitCode: 'MON'
                        }
                    }
                }
            ]
        }
    };

    const el = document.createElement('script');
    el.type = 'application/ld+json';
    el.textContent = JSON.stringify(serviceSchema);
    document.head.appendChild(el);
})();
