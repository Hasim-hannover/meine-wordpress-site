# SEO Cockpit

Stand: 2026-03-20.

Diese Doku beschreibt den repo-seitigen Startpunkt fuer ein internes SEO-Dashboard im WordPress-Admin.

## Ziel

Das Cockpit soll keine neue externe Plattform einfuehren.

Stattdessen:

- WordPress bleibt die operative Schicht
- Google Search Console liefert die externe SEO-Sicht
- Koko Analytics liefert optional die lokale Traffic-Sicht
- das interne Audit-CRM liefert jetzt zusaetzlich Lead- und Attributionssignale
- das Repo enthaelt die Logik, das Caching und die Admin-Oberflaeche

## Aktueller Scope

Repo-seitig vorhanden:

- Top-Level-Admin-Menue `SEO Cockpit`
- kompaktes Snapshot-Widget im Standard-WordPress-Dashboard
- priorisierte Queue im Admin, die SEO-Signale jetzt gegen Business-Wert, Funnel-Naehe und Confidence gewichtet
- Lead-Layer aus `nexus_review_request` mit Audit-Leads, Status, Source-Mix und intern attribuierten Seiten
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
- heuristische Insight-Typen fuer
  - Quick Wins
  - CTR-Chancen
  - Decay
  - Snippet-Schwächen
  - Kannibalisierung
  - Money-Page-Unterperformance
  - Orphan-/Bridge-/Indexierungs-Signale
- browserseitige Lead-Attribution fuer neue Audit-Leads ueber
  - Formular-Landingpage
  - ersten internen Einstieg der Session
  - vorherige interne Seite
  - Referrer-URL
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
- Koko nur optional als zweiter Traffic-Layer
- Audit-CRM als dritter Datenlayer fuer Lead-Kontext und Priorisierung

## Naechster Ausbau

- CTA-Klickpfade jenseits des Audit-Intakes serverseitig oder ueber einen belastbaren Event-Layer versionieren
- staerkerer Koko-Layer jenseits der aktuellen Top-Page-Zuordnung
- Ownership-/Notiz-/Status-Layer fuer operative SEO-Arbeit direkt im Admin
- URL-Inspection oder Indexing-nahe Erweiterungen nur, wenn der operative Nutzen klar ist
