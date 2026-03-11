# 0004 WGOS Cluster Pages And Results Canonical

- Datum: 2026-03-12

## Entscheidung

Wichtige Legacy-Service-Seiten werden nicht mehr dem WordPress-Editor oder manueller Template-Zuordnung ueberlassen.

Stattdessen gilt jetzt:

- zentrale Cluster-/Pillar-Definitionen liegen versioniert in `blocksy-child/inc/wgos-cluster-pages.php`
- die Seiten `/wordpress-seo-hannover/`, `/core-web-vitals/`, `/conversion-rate-optimization/`, `/ga4-tracking-setup/` und `/performance-marketing/` werden theme-seitig auf versionierte Templates geroutet
- der Ergebnisse-Hub ist repo-seitig kanonisch `/ergebnisse/`
- alte Proof- und Audit-Slugs bleiben nur noch als 301-Aliase bestehen
- Single Posts koennen passende WGOS-Assets automatisch als Anschlussblock ausgeben

## Begruendung

- Vorhandene Audits im Repo zeigen klare Drift zwischen Editor-Seiten, Default-Templates und der eigentlichen WGOS-Architektur.
- Besonders kritisch waren alte Ergebnisse-Links, 404-Pfade wie `/wordpress-tech-audit/` und uneinheitliche CTA-Ziele.
- Ohne `wp-cli` und direkten Live-Admin-Zugriff muss die belastbare Logik aus dem Theme kommen, nicht aus impliziten Admin-Konfigurationen.

## Konsequenzen

- Wichtige Clusterseiten sind wieder versioniert review- und deploybar.
- Navigation und Redirects laufen auf weniger historische Alias-Pfade.
- Der Proof-Layer zeigt repo-seitig auf `/ergebnisse/`, nicht mehr auf alte Case-Slugs.
- Weitere editorgetriebene Seiten bleiben moegliche Drift-Zonen und muessen separat geprueft oder spaeter ebenfalls versioniert werden.
