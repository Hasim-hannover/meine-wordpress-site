# SEO Cockpit V2

## Architektur

Das Cockpit ist aus der bisherigen Monolith-Datei in klar getrennte Layer aufgeteilt:

- `blocksy-child/inc/seo-cockpit.php`
  Bootstrap-Loader fuer das Cockpit.
- `blocksy-child/inc/seo-cockpit-core.php`
  Capabilities, Settings, Menues, Konfiguration, URL- und Cache-Helfer.
- `blocksy-child/inc/seo-cockpit-api.php`
  OAuth, Tokens, Google-Requests, Search-Console-Reports, Sitemaps und URL-Inspection.
- `blocksy-child/inc/seo-cockpit-sync.php`
  Snapshot-Aufbau, Historical Layer, Cache-Versionierung, Sync, Cron und Locking.
- `blocksy-child/inc/seo-cockpit-insights.php`
  Insight-Regeln, WordPress-Kontext, URL-Zuordnung und Drilldown-Datenmodell.
- `blocksy-child/inc/seo-cockpit-ui.php`
  Admin-Rendering fuer Uebersicht, Drilldown, Widget und Einstellungen.

Zusaetzlich wurde in `blocksy-child/inc/seo-meta.php` ein wiederverwendbarer Helper fuer den effektiven SEO-Kontext pro Post ergaenzt:

- `hu_get_singular_post_seo_context()`

Dadurch greift das Cockpit bei Title/Description/Canonical/noindex nicht auf eine parallele Logik zurueck, sondern auf denselben Entscheidungsrahmen wie das Frontend.

## Datenfluss

### 1. Verbindung / OAuth

- Einstellungen werden in `nexus_seo_cockpit_settings` gespeichert.
- OAuth-Token werden in `nexus_seo_cockpit_tokens` gehalten.
- Die Verbindung wird ueber einen Google Web-OAuth-Flow aufgebaut.

### 2. Snapshot

Der Uebersichts-Snapshot kombiniert drei Ebenen:

- Search Console:
  - Overview-Metriken
  - Tagesverlauf
  - Top Pages
  - Top Queries
  - Top Devices
  - Query/Page-Kombinationen
  - Sitemaps
- WordPress:
  - Post ID
  - Post Type
  - Status
  - Template / Seitentyp
  - Word Count
  - SEO-Kontext
  - Edit- und Frontend-Links
- Entscheidungslogik:
  - Quick Wins
  - CTR-Opportunities
  - Decay
  - Low Signal
  - Possible Cannibalization
  - Snippet Weakness

### 3. Drilldown

Die URL-Detailansicht baut auf einem eigenen Detailmodell auf:

- aggregierte Kernmetriken fuer die URL
- Trend nach Datum
- Top Queries der URL
- Geraeteverteilung
- WordPress-Kontext
- gefilterte Insights fuer diese URL
- vorbereitete, manuelle URL-Inspection

## Cache- und Sync-Logik

### Snapshot- und Detail-Caches

Die Cockpit-Caches verwenden eine zentrale Cache-Version:

- `nexus_seo_cockpit_cache_version`

Statt einzelne Transients schwerfaellig aufzuraeumen, invalidiert das Cockpit beim Refresh die Version und erzeugt neue Keys. Das betrifft:

- Snapshots
- Sites
- Sitemaps
- Detailansichten
- URL-Inspection-Caches

### Refresh-Fenster

`refresh_window` steuert jetzt zwei Dinge konsistent:

- Snapshot-Cache-TTL
- Cron-Intervall

Wird das Fenster geaendert, wird das Event neu geplant.

### Runtime

Die Runtime-Option `nexus_seo_cockpit_runtime` fuehrt unter anderem:

- `last_sync_at`
- `next_sync_at`
- `cache_expires_at`
- `last_sync_status`
- `last_sync_source`
- `last_error_code`
- `last_error_message`

### Locking

Parallele Syncs werden ueber einen Transient-Lock verhindert:

- `nexus_seo_cockpit_sync_lock`

Dadurch kollidieren manuelle und Cron-Syncs nicht mehr so leicht.

## Insight-Regeln

Die Insights sind bewusst heuristisch und regelbasiert, nicht "smart" behauptet:

- `QUICK_WIN`
  Position zwischen ca. 8 und 20 bei soliden Impressionen.
- `CTR_OPPORTUNITY`
  Hohe Impressionen, aber schwache CTR trotz brauchbarer Position.
- `DECAY`
  Signifikanter Rueckgang gegenueber dem Vergleichsfenster.
- `LOW_SIGNAL`
  Sichtbarkeit vorhanden, aber noch zu weit von echten Rankings entfernt.
- `POSSIBLE_CANNIBALIZATION`
  Mehrere URLs sammeln fuer dieselbe Query nennenswerte Impressionen.
- `SNIPPET_WEAKNESS`
  Impressionen vorhanden, aber Title/Description fehlen oder wirken formal schwach.

Jede Insight enthaelt:

- `type`
- `severity`
- `label`
- `reason`
- `url`
- `query`
- `metrics`
- `recommended_action`

## Offene Punkte

- Interne Linkzaehlung ist aktuell nur vorbereitet und noch kein echter Crawler-/Graph-Layer.
- URL-Inspection ist bewusst manuell im Drilldown, nicht massenhaft automatisiert.
- Sitemap-Mitgliedschaft pro URL ist derzeit ein WordPress-internes Signal, keine Search-Console-URL-Membership.
- Koko Analytics ist weiterhin nur ein Nebenlayer und noch nicht tief mit URL-Signalen verschmolzen.

## Grenzen / Risiken

- Search Console bleibt zeitverzoegert; das Cockpit kann keine Echtzeit garantieren.
- Query/Page-Kombinationsdaten sind auf sinnvolle Row-Limits begrenzt und bilden nicht die komplette Long Tail ab.
- URL-Zuordnung basiert fuer Search-Console-URLs auf `url_to_postid()` plus Sonderfaellen fuer Startseite und Blog.
- Inspection und Search-Console-APIs bleiben quota- und permission-abhaengig.
