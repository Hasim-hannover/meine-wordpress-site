| Datei | Zeile | Aenderung | Grund |
|---|---|---|---|
| `blocksy-child/inc/header.php` | 98 | Case-Studies-Page-ID auf `case-studies-e-commerce` priorisiert | Header-Fallback soll auf die echte Overview statt auf `/case-studies/` zeigen |
| `blocksy-child/inc/header.php` | 113 | Header-Fallback-URL auf `/case-studies-e-commerce/` umgestellt | 143 interne Links liefen auf die falsche Case-Studies-URL |
| `blocksy-child/inc/menu-setup.php` | 82 | Menue-Setup priorisiert `case-studies-e-commerce` | Zukuenftige Menue-Rebuilds sollen den kanonischen Slug verwenden |
| `blocksy-child/inc/menu-setup.php` | 88 | Fallback-Menue-URL auf `/case-studies-e-commerce/` umgestellt | Alte Default-URL verwies auf die falsche Case-Seite |
| `blocksy-child/inc/shortcodes.php` | 30 | Homepage-Cases-URL auf `case-studies-e-commerce` umgestellt | Homepage-CTAs sollen auf die Case-Overview statt auf den Redirect zeigen |
| `blocksy-child/inc/shortcodes.php` | 33 | E3-Deep-Link auf `/e3-new-energy/` korrigiert | Proof-Link fiel auf alte oder falsche Case-Pfade zurueck |
| `blocksy-child/page-case-e3.php` | 15 | `cases_url` auf `case-studies-e-commerce` umgestellt | Rueckweg aus der Case Study soll kanonisch sein |
| `blocksy-child/page-loesungen.php` | 17 | `cases_url` auf `case-studies-e-commerce` umgestellt | Angebotsuebersicht soll die aktive Case-Overview nutzen |
| `blocksy-child/page-wordpress-agentur.php` | 15 | `cases_url` auf `case-studies-e-commerce` umgestellt | Service-Seite soll nicht auf den alten Case-Slug verlinken |
| `blocksy-child/template-about.php` | 15 | `cases_url` auf `case-studies-e-commerce` umgestellt | About-Seite braucht den kanonischen Proof-Pfad |
| `blocksy-child/template-parts/audit-page-shell.php` | 12 | `cases_url` auf `case-studies-e-commerce` umgestellt | Audit-LP soll auf die echte Case-Overview verlinken |
| `blocksy-child/page-wgos.php` | 16-21 | Kanonische URL-Variablen fuer Cases und Service-Links eingefuehrt | WGOS hatte harte Slugs und einen 404-Link im Modulbereich |
| `blocksy-child/page-wgos.php` | 145 | `/core-web-vitals-optimierung/` durch kanonische Core-Web-Vitals-URL ersetzt | Live-Check lieferte fuer den alten Pfad 404 |
| `blocksy-child/page-wgos.php` | 161 | Anchor-Text `Mehr erfahren` -> `WordPress Wartung ansehen` | Beschreibender Anchor statt generischer Linktext |
| `blocksy-child/page-wgos.php` | 177 | Anchor-Text `Mehr erfahren` -> `GA4 & Tracking Setup ansehen` | Beschreibender Anchor statt generischer Linktext |
| `blocksy-child/page-wgos.php` | 193 | Anchor-Text `Mehr erfahren` -> `WordPress SEO ansehen` | Beschreibender Anchor statt generischer Linktext |
| `blocksy-child/page-wgos.php` | 224 | Anchor-Text `Mehr erfahren` -> `CRO-Service ansehen` | Beschreibender Anchor statt generischer Linktext |
| `blocksy-child/template-parts/blog-header.php` | 22 | Blog-Header-Cases-URL auf `case-studies-e-commerce` umgestellt | Blog-/Default-Seiten zeigten im Zusatzheader auf den falschen Case-Pfad |
| `blocksy-child/template-parts/blog-header.php` | 90 | Active-State auf `case-studies-e-commerce` erweitert | Aktiver Zustand soll mit der echten Overview funktionieren |
| `blocksy-child/template-parts/site-footer.php` | 28 | Footer-Cases-URL auf `case-studies-e-commerce` umgestellt | Sitewide-Footer verlinkte auf die alte Case-URL |
| `blocksy-child/template-parts/site-footer.php` | 39 | Footer-Kontakt auf `kontaktiere-mich` priorisiert | Sitewide-Footer nutzte einen Redirect statt der kanonischen Kontakt-URL |
| `blocksy-child/assets/html/wgos-social-proof.html` | 78 | Statischer Proof-Link auf `/case-studies-e-commerce/` umgestellt | Das WGOS-HTML-Asset verlinkte fest auf den alten Case-Slug |
