/* =========================================
   GA4 & Tracking Setup – Page-specific JS
   Service Schema + FAQ Schema (JSON-LD)
   ========================================= */
(function () {
    'use strict';

    /* --- Service Schema --- */
    const serviceSchema = {
        '@context': 'https://schema.org',
        '@type': 'Service',
        name: 'GA4 & Tracking Setup',
        description:
            'Professionelles Google Analytics 4 Setup, serverseitiges Tracking und DSGVO-konforme Implementierung für verlässliche Daten und messbares Wachstum.',
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
        serviceType: 'Web Analytics & Tracking'
    };

    const sEl = document.createElement('script');
    sEl.type = 'application/ld+json';
    sEl.textContent = JSON.stringify(serviceSchema);
    document.head.appendChild(sEl);

    /* --- FAQ Schema --- */
    const faqData = document.querySelectorAll('.ga4-page .ga4-faq-wrap details');
    if (faqData.length) {
        const entries = [];
        faqData.forEach(function (detail) {
            const q = detail.querySelector('summary');
            const a = detail.querySelector('.ga4-faq-answer');
            if (q && a) {
                entries.push({
                    '@type': 'Question',
                    name: q.textContent.replace(/\+$/, '').trim(),
                    acceptedAnswer: {
                        '@type': 'Answer',
                        text: a.textContent.trim()
                    }
                });
            }
        });

        if (entries.length) {
            const faqSchema = {
                '@context': 'https://schema.org',
                '@type': 'FAQPage',
                mainEntity: entries
            };
            const fEl = document.createElement('script');
            fEl.type = 'application/ld+json';
            fEl.textContent = JSON.stringify(faqSchema);
            document.head.appendChild(fEl);
        }
    }
})();
