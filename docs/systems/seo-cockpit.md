# SEO Cockpit

Stand: 2026-03-13.

Diese Doku beschreibt den repo-seitigen Startpunkt fuer ein internes SEO-Dashboard im WordPress-Admin.

## Ziel

Das Cockpit soll keine neue externe Plattform einfuehren.

Stattdessen:

- WordPress bleibt die operative Schicht
- Google Search Console liefert die externe SEO-Sicht
- Koko Analytics soll spaeter die lokale Traffic-Sicht liefern
- das Repo enthaelt die Logik, das Caching und die Admin-Oberflaeche

## Aktueller Scope

Repo-seitig vorhanden:

- Top-Level-Admin-Menue `SEO Cockpit`
- kompaktes Snapshot-Widget im Standard-WordPress-Dashboard
- Settings-Seite fuer
  - Search-Console-Property
  - Google Client ID
  - Google Client Secret
  - Cache-Fenster
- OAuth-Flow gegen Google mit Redirect auf `admin-post.php`
- Token-Speicherung und Token-Refresh
- gecachte Dashboard-Abfragen fuer
  - Klicks
  - Impressionen
  - CTR
  - durchschnittliche Position
  - Top Pages
  - Top Queries
  - Device-Split
- automatischer Snapshot-Refresh per WP-Cron (`twicedaily`)
- optionale Erkennung des Plugins `koko-analytics/koko-analytics.php`

## Nicht im Repo verifiziert

- echte Google-OAuth-Credentials
- echte Search-Console-Property-Verbindung
- echtes Refresh-Token
- installierte Koko-Analytics-Instanz

## Architektur

Code-Orte:

- `blocksy-child/inc/seo-cockpit.php`
- `blocksy-child/assets/css/seo-cockpit-admin.css`

Wichtige technische Entscheidungen:

- kein schweres SEO-Dashboard-Plugin
- keine externe Datenbank oder SaaS fuer die Dashboard-Logik
- API-Zugriff direkt per `wp_remote_*`
- leichter Cache ueber WordPress-Transients
- letzter Sync-Status in WordPress-Optionen fuer Admin-Sichtbarkeit
- Koko nur optional und spaeter als zweiter Datenlayer

## Geplante Phase 2

- echte Koko-Daten pro Landingpage
- Korrelation von Search-Console-Performance und lokalen Seitenaufrufen
- Sicht auf Gewinner/Verlierer nach URL
- URL-Inspection oder Indexing-nahe Erweiterungen nur, wenn der operative Nutzen klar ist
