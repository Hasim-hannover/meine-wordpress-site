# WGOS Asset Discovery

- Stand: 2026-03-11
- Basis: Repo-Code, öffentliche WordPress-REST-API, Live-HTTP-Checks
- Einschränkung: In dieser lokalen Umgebung ist `wp-cli` nicht installiert. Discovery für `wgos_asset` musste daher über Theme-Code und die öffentliche REST-API erfolgen.

## 1. Gefundene ACF-Felder

Die Datei `blocksy-child/inc/acf.php` registriert aktuell nur eine allgemeine SEO-Feldgruppe für `page`, `post` und `wgos_asset`.

| Name | Typ | Key | Gilt für | Beobachtung |
| --- | --- | --- | --- | --- |
| `seo_title` | Text | `field_seo_title` | `page`, `post`, `wgos_asset` | Optionaler Title-Override |
| `seo_description` | Textarea | `field_seo_description` | `page`, `post`, `wgos_asset` | Optionaler Description-Override |
| `og_image` | Image | `field_og_image` | `page`, `post`, `wgos_asset` | OG-Image-Override |
| `seo_noindex` | True/False | `field_seo_noindex` | `page`, `post`, `wgos_asset` | noindex Toggle |

Nicht gefunden:

- Keine eigene ACF-Feldgruppe für WGOS-Asset-Struktur
- Keine ACF-Felder für Kernbereich, Credits, Ziel, Ergebnis, Voraussetzung
- Keine ACF-Felder für Deliverables, Systemkontext, Priorisierung oder verwandte Assets

## 2. SEO-Meta-Mechanismus

Die aktuelle SEO-Ausgabe läuft über `blocksy-child/inc/seo-meta.php`.

Wichtige Punkte:

- `add_action( 'wp_head', 'hu_seo_meta_tags', 1 )`
- `add_filter( 'pre_get_document_title', 'hu_pre_get_document_title_override' )`
- `add_filter( 'document_title_parts', 'hu_document_title_overrides' )`
- `hu_get_stored_seo_value()` liest zuerst ACF (`seo_title`, `seo_description`), danach gespeicherte Rank-Math-Meta als Fallback.
- `hu_get_seo_meta()` baut bei fehlendem SEO-Plugin Description, Canonical, Robots und OG-Felder selbst.

Live-Beobachtung per HTML-Head auf Asset-Seiten:

- `Technical SEO Audit`: Title = `Technical SEO Audit - Hasim Üner`, Description = automatisch gekürzte Excerpt/Fallback-Description
- `CWV Speed Audit`: Title = `CWV Speed Audit - Hasim Üner`, Description = automatisch gekürzte Excerpt/Fallback-Description

Schlussfolgerung:

- Für `wgos_asset` existiert bereits ein pluginloser SEO-Fallback im Theme.
- Die aktuellen Asset-Posts nutzen ihn nicht sauber, weil `seo_title` und `seo_description` offensichtlich nicht systematisch gepflegt werden.
- Die Kommentare in `inc/seo-meta.php` und `SYSTEM_MAP.md` erwähnen noch Rank Math, die Live-WGOS-Assets laufen aber faktisch auf Theme-Fallbacks plus generischen Postdaten.

## 3. Template-Struktur für `wgos_asset`

### CPT und Routing

Definiert in `blocksy-child/inc/wgos-assets.php`.

- Post Type: `wgos_asset`
- Rewrite-Slug: `wgos-assets`
- `hierarchical = true`
- `show_in_rest = true`
- `supports = title, editor, excerpt, thumbnail, page-attributes, revisions, custom-fields`

### Single-Template

Datei: `blocksy-child/single-wgos_asset.php`

Aktueller Aufbau:

1. Hero mit:
   - Link auf WGOS Hub
   - optionalen Ahnen-Links
   - `H1`
   - Excerpt als Subtitle
   - Buttons `Zur Asset-Landkarte` und `Growth Audit starten`
2. Eine generische Content-Sektion:
   - H2 `Problem, Diagnose und Lösung`
   - `the_content()`
3. Ein generischer Systemkontext-Block:
   - identisch für alle Assets
4. Ein generischer Footer-CTA

Gap zur Zielstruktur:

- Die geforderte 8-Abschnitte-Struktur ist nicht vorhanden.
- Der Systemkontext ist aktuell generisch statt asset-spezifisch.
- Kurzprofil, klare Deliverables, Priorisierungsfälle und verwandte Assets fehlen.
- CTA-Logik ist nur teilweise vorhanden.

## 4. Hub- und Explorer-Logik

### Asset-Hub

Datei: `blocksy-child/page-wgos-assets.php`

- Nutzt `nexus_get_wgos_asset_explorer_payload()`
- Systemlandkarte ist bereits dynamisch
- CTA-Struktur der Seite ist sauber, aber die Payload basiert nur auf publizierten `wgos_asset`-Posts

### Explorer-Payload

Datei: `blocksy-child/inc/wgos-assets.php`

Aktuelles Verhalten:

- Lädt nur `post_status = publish`
- Nutzt lose Meta-Kandidaten wie `asset_phase`, `asset_module`, `asset_credits`, `asset_deliverable`, `asset_short`, `asset_intro`, `asset_bullets`
- Fällt bei fehlenden Daten auf Excerpt und `post_content` zurück

Schlussfolgerung:

- Die Payload ist für Migrationen vorbereitet, aber das zugrundeliegende strukturierte Datenmodell fehlt noch.
- Neu Draft-Assets würden im aktuellen Explorer gar nicht erscheinen.

## 5. Asset-Inventur

### Publizierte `wgos_asset`-Posts laut öffentlicher REST-API

| ID | Titel | Slug | Status | HTTP | Content-Status |
| --- | --- | --- | --- | --- | --- |
| 14842 | CWV Speed Audit | `cwv-speed-audit` | publish | 200 | alter pathoslastiger Text |
| 14844 | CWV Optimierung | `cwv-optimierung` | publish | 200 | alter pathoslastiger Text |
| 14846 | Server-Tuning | `server-tuning` | publish | 200 | alter pathoslastiger Text |
| 14850 | Security Hardening | `security-hardening` | publish | 200 | alter pathoslastiger Text |
| 14852 | Server-Side Tracking (sGTM & Matomo) | `server-side-tracking-sgtm-matomo` | publish | 200 | leerer Excerpt/Content über REST |
| 14858 | Consent Mode v2 | `consent-mode-v2` | publish | 200 | alter pathoslastiger Text |
| 14860 | GA4 Event Blueprint | `ga4-event-blueprint` | publish | 200 | alter pathoslastiger Text |
| 14863 | Tracking Audit | `tracking-audit` | publish | 200 | alter pathoslastiger Text |
| 14866 | Technical SEO Audit | `technical-seo-audit` | publish | 200 | alter pathoslastiger Text |
| 14868 | Pillar Page | `pillar-page` | publish | 200 | alter pathoslastiger Text |

### Auffällige Abweichungen

- Der Live-Slug für Server-Side Tracking ist aktuell `server-side-tracking-sgtm-matomo`, nicht `server-side-tracking`.
- Alle 10 bestehenden Asset-Seiten sind erreichbar.
- Die Content-Qualität bestätigt die Nutzerbeschreibung: stark aufgeblasener Stil, wenig konkrete Deliverables, kein sauberes 8-Abschnitte-Template.

## 6. Matrix-Prüfung

Die Aufgabenbeschreibung nennt `32 Assets (10 überarbeiten, 22 neu)`.

Die tabellarisch aufgeführte Matrix enthält jedoch:

- 10 bestehende Assets
- 25 neue Assets
- Summe: 35 Assets

Für die Umsetzung wird deshalb die tabellarisch aufgeführte Matrix als Source of Truth behandelt. Die Summenzeile ist rechnerisch inkonsistent.

## 7. Technische Konsequenzen für die Umsetzung

1. Ein versioniertes WGOS-Asset-Registry-Modell wird im Theme benötigt.
2. Es braucht ein sauberes ACF-/Meta-Schema für Asset-spezifische Daten.
3. Das Single-Template muss auf die 8-Abschnitte-Struktur umgestellt werden.
4. Explorer und interne Verlinkung müssen mit publizierten und noch nicht publizierten Asset-Definitionen umgehen können.
5. Wegen fehlendem `wp-cli` in der lokalen Umgebung braucht die Repo-Lösung einen Theme-seitigen Sync-Mechanismus für Post-Erstellung und Post-Updates.
