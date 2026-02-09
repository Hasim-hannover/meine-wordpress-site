/* =========================================
   CRO Landing Page – Page-specific JS
   Conversion Rate Optimization
   ========================================= */
(function () {
    'use strict';

    /* --- Service Schema (JSON-LD) --- */
    const schema = {
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'Conversion Rate Optimization (CRO)',
        description:
            'Daten-getriebene Conversion Rate Optimization – wir analysieren Nutzerverhalten und optimieren Ihre Website systematisch für mehr Leads, Anfragen und Umsatz.',
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
        serviceType: 'Conversion Rate Optimization'
    };

    const el = document.createElement('script');
    el.type = 'application/ld+json';
    el.textContent = JSON.stringify(schema);
    document.head.appendChild(el);
})();
