# SEO Priority Todo - March 2026

Stand: 2026-03-14.

Diese Liste enthaelt nur noch offene SEO-Arbeiten ausserhalb des Repos.
Bereits erledigte Theme-Massnahmen wurden entfernt.

## P0 - Jetzt

### Search Console und Recrawl

- URL-Pruefung oder Reindex fuer diese Ziel-URLs anstossen:
  - `/shopify-wartungsvertrag/`
  - `/wordpress-wartung-hannover/`
  - `/wordpress-agentur-hannover/`
  - `/wordpress-seo-hannover/`
  - `/ga4-tracking-setup/`
  - `/performance-marketing/`
- Fuer `/shopify-wartungsvertrag/` zusaetzlich live pruefen, ob weiterhin sauber `410 Gone` ausgespielt wird.

### Live-QA ungecacht

- Title, Description, Canonical und `og:url` fuer die Primaer-URLs live pruefen.
- Redirects fuer alte Zielpfade live pruefen:
  - `/audit/`
  - `/customer-journey-audit/`
  - `/360-audit/`
  - `/wordpress-tech-audit/`
  - `/case-studies/`
  - `/case-studies-e-commerce/`
  - `/meta-ads/`
  - `/wordpress-agentur/`
  - `/roi-rechner/`
- Editor-, Footer- und Menue-Links auf alte Slugs pruefen und auf die kanonischen Zielseiten umstellen.

## P1 - Diese Woche

- In Search Console beobachten, ob sich `wordpress agentur hannover` und `wordpress seo hannover` sauberer auf getrennte Zielseiten verteilen.
- Interne Links weiter auf die Primaer-URLs konzentrieren, vor allem von Homepage, Kategorie-Hubs, Blog-Bridges und Footer.
- Fuer `/ga4-tracking-setup/` und `/performance-marketing/` live pruefen, ob wirklich die versionierten Cluster-Templates ausgespielt werden und nicht alter Editor-Content.
- Draft- und noindex-Reste ausserhalb des Themes im WordPress-Admin bereinigen, wenn Search Console weiter unerwuenschte Signale meldet.

## P2 - Danach

- Nur wenn die Kern-Cluster stabil laufen: weitere interne Linkverstaerkung und moegliche neue Clusterseiten planen.
- Keine neue `woocommerce agentur hannover`-Seite live ziehen, bevor die lokalen Kern-Intents sauber getrennt sind.

## Verbindliches Primaer-URL-Mapping

Bis neue Search-Console-Daten etwas anderes belegen, gilt fuer Snippets, interne Links, CTA-Bridges und Related Content diese Zuordnung:

| Query / Intent | Primaer-URL | Support-URLs | Nicht gegeneinander optimieren |
| --- | --- | --- | --- |
| `wordpress agentur hannover` | `/wordpress-agentur-hannover/` | `/`, `/uber-mich/`, passende Blogposts, `/growth-audit/` | `/wordpress-seo-hannover/` nicht auf breiten Agentur-Intent ziehen |
| `wordpress seo hannover`, `wordpress suchmaschinenoptimierung hannover` | `/wordpress-seo-hannover/` | `/category/seo/`, `/technisches-seo-performance-fundament/`, `/core-web-vitals/` | `/wordpress-agentur-hannover/` nicht auf denselben SEO-Intent zuspitzen |
| `wordpress wartung hannover`, `wordpress wartungsvertrag hannover` | `/wordpress-wartung-hannover/` | `/wordpress-growth-operating-system/`, wartungsnahe WGOS-Assets, passende Insights | keine zweite Wartungs-LP mit fast identischem Hannover-Intent aufbauen |
| `ga4 tracking setup`, `server-side tracking`, `consent mode` | `/ga4-tracking-setup/` | Tracking-Posts, `/category/tracking/`, `/growth-audit/` | Tracking-Intent nicht ueber `/performance-marketing/` oder Agentur-Seiten abfangen |
| `core web vitals optimierung`, `pagespeed optimierung` | `/core-web-vitals/` | `/website-performance-analyse/`, passende Performance-Posts, `/growth-audit/` | Tool-Intent und Service-Intent nicht auf dieselbe Meta/H1 pressen |
| `woocommerce agentur hannover` | vorerst kein eigener Primaer-Launch | vorlaeufig `/wordpress-agentur-hannover/` als naechstes bestes Ziel | neue LP nicht vor der Bereinigung der Kern-Cluster live ziehen |

## Technische Live-QA vor weiterem Ausbau

1. Auf den Primaer-URLs genau einen Canonical und keine konkurrierenden Plugin-Metas pruefen.
2. Live-Schema auf `/`, `/wordpress-agentur-hannover/`, `/wordpress-seo-hannover/` und `/wordpress-wartung-hannover/` gegen doppelte `Service`-, `LocalBusiness`- oder `WebSite`-Ausgaben pruefen.
3. Doppelte H1 nicht nur im Theme, sondern im echten Live-DOM mit Editor-Heroes gegenpruefen.
4. Die aktive Sitemap-Quelle festhalten und auf widerspruechliche URL-Signale pruefen.
5. Interne Links in Homepage, Kategorie-Hubs, Related Content und Footer gegen das Primaer-Mapping pruefen.

## Relevante Repo-Einstiegspunkte

- `blocksy-child/inc/snippets.php`
- `blocksy-child/inc/seo-meta.php`
- `blocksy-child/inc/org-schema.php`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/inc/wgos-cluster-pages.php`
- `blocksy-child/inc/helpers.php`
