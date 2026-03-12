# Internal Link Fixes - 2026-03-12

Empfohlene Commit Message:
`fix(links): interne Verlinkung bereinigt - 5 Fixes, 3 Vorschlaege`

## Geaenderte Dateien
- `blocksy-child/404.php`
- `blocksy-child/page-case-e3.php`

## Durchgefuehrte Auto-Fixes
- `blocksy-child/404.php`: WGOS-Link von rohem Pfad auf `nexus_get_wgos_url()` normalisiert.
- `blocksy-child/404.php`: SEO-Link von rohem Pfad auf `nexus_get_page_url(['wordpress-seo-hannover','seo'])` normalisiert.
- `blocksy-child/404.php`: Blog-Link auf `page_for_posts`-Permalink mit `/blog/`-Fallback umgestellt.
- `blocksy-child/page-case-e3.php`: FAQ-Link zur WGOS-Seite auf `nexus_get_wgos_url()` normalisiert.
- `blocksy-child/page-case-e3.php`: WGOS-Link im Next-step-Block auf `nexus_get_wgos_url()` normalisiert.

## Nicht automatisierte Faelle
- `blocksy-child/page-seo-cornerstone.php`: harte Service-Links bleiben vorerst unveraendert, weil `feat/wgos-asset-content-overhaul` dieselben Bereiche bearbeitet.
- `blocksy-child/category.php`: harte CTA-Slugs bleiben vorerst unveraendert, weil `hotfix/primary-ctas-header-hero` dieselbe Datei aendert und Legacy-Risiko besteht.
- `blocksy-child/template-about.php`: strategische Zweitverlinkung zu Ergebnisse/WGOS nur vorgeschlagen, nicht automatisch eingebaut.

## Risiken / manuelle Follow-ups
- Kein Live-HTTP-Check im Repo. Redirect- und Statuspruefung fuer kritische Legacy-Slugs bleibt offen.
- Vor dem Merge von `feat/wgos-asset-content-overhaul` und `hotfix/primary-ctas-header-hero` die Linkpfade erneut diffen; beide Branches koennen Legacy-Ziele wieder staerken.
- Wenn `page-seo-cornerstone.php` spaeter angefasst wird, harte Service-Links helper-basiert normalisieren statt rohe Slugs weiterzufuehren.
