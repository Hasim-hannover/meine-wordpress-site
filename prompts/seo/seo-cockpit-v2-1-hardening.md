# SEO Cockpit V2.1 Hardening Prompt

## Zweck

Baue das bestehende SEO Cockpit V2 im Blocksy-Child-Theme zu einer haerteren, belastbareren V2.1 aus.
Der Fokus liegt nicht auf neuen Showcases, sondern auf Robustheit, Lesbarkeit, Skalierung und besserer Datenverschmelzung.

## Projektkontext

- Repo: `meine-wordpress-site`
- Relevanter Einstieg: `blocksy-child/inc/seo-cockpit.php`
- Bestehende Module:
  - `blocksy-child/inc/seo-cockpit-core.php`
  - `blocksy-child/inc/seo-cockpit-api.php`
  - `blocksy-child/inc/seo-cockpit-sync.php`
  - `blocksy-child/inc/seo-cockpit-insights.php`
  - `blocksy-child/inc/seo-cockpit-ui.php`
- Relevanter SEO-Layer:
  - `blocksy-child/inc/seo-meta.php`
- Bestehende Dokumentation:
  - `docs/seo-cockpit-v2.md`

## Ausgangslage

V2 ist bereits produktiv nutzbar mit:

- Search Console OAuth
- Snapshot- und Detail-Caches
- Historical Layer fuer 7 / 28 / 90 Tage
- Insights / Priorisierung
- WordPress-Kontext pro URL
- URL-Drilldown
- Sitemaps / vorbereiteter Inspection-Layer
- Koko-Status als Basis

Die naechste Stufe soll V2 nicht neu erfinden, sondern haerten.

## Zielbild fuer V2.1

V2.1 soll vor allem diese Schwaechen adressieren:

1. Rendering- und Formatierungslogik ist an einigen Stellen noch zu breit.
2. Interne Linksignale sind nur vorbereitet, aber noch nicht echt messbar.
3. Koko Analytics ist noch zu lose an Search Console und WordPress gekoppelt.
4. Row-Limits sind fuer groessere Sites noch zu knapp.
5. Es fehlen gezielte Runtime-Sicherungen fuer OAuth, Cron und Drilldown-Pfade.

## Harte Anforderungen

1. Bestehende V2-Funktionen duerfen nicht kaputtgehen.
2. Search Console OAuth, Snapshot, Cron und Detailansicht muessen weiter laufen.
3. Keine unkontrollierte Verbreiterung der Datei `seo-cockpit-ui.php`.
4. Alle neuen Regeln und Datenpfade muessen defensiv mit `WP_Error`, `is_array()`, `isset()` und klaren Defaults arbeiten.
5. Keine kosmetische Ueberarbeitung ohne technischen Mehrwert.
6. Keine externen JS-Frameworks.
7. WordPress Coding Standards und konsequentes Escaping/Sanitizing beibehalten.

## Fokus 1: Code-Formatting und Lesbarkeit

Ziel:
Die Cockpit-Dateien sollen leichter wartbar und scanbar werden, ohne die Architektur wieder aufzublaehen.

Aufgaben:

- Pruefe `seo-cockpit-ui.php` auf zu lange Render-Bloecke und extrahiere wiederkehrende Teilbereiche in kleine Render-Helper.
- Reduziere offensichtliche Duplikate bei Tabellen, KPI-Karten, Statusfeldern und Trend-Renderern.
- Vereinheitliche Benennung und Docblocks dort, wo inkonsistente Muster sichtbar sind.
- Halte Kommentare knapp und nur dort, wo sie echte Denklogik erklaeren.
- Formatiere Arrays, Render-Bloecke und laengere Bedingungen so, dass spaetere Aenderungen risikoarm bleiben.

Wichtig:
- Kein grossflaechiges Umbenennen ohne Nutzen.
- Keine "Reformat everything"-Aktion ohne funktionalen Grund.

## Fokus 2: Echte interne Linkzaehlung

Ziel:
Das Cockpit soll interne Verlinkung nicht nur als Platzhalter fuehren, sondern als echtes Signal fuer URL-Kontext und Priorisierung.

Baue einen internen Link-Layer, der mindestens Folgendes liefert:

- eingehende interne Links pro URL
- ausgehende interne Links pro URL
- Anzahl verlinkender interner Dokumente
- optional: wichtigste Linkquellen fuer eine URL

Anforderungen:

- Analysiere nur sinnvolle, indexierbare Inhalte:
  - `post`
  - `page`
  - relevante eigene CPTs, sofern sie oeffentlich sind
- Ignoriere offensichtliche Stoerquellen:
  - Admin-Links
  - Attachments
  - `mailto:`
  - `tel:`
  - Query-Parameter-Dubletten
  - Hash-Fragmente
- Normalisiere interne URLs ueber denselben URL-Normalizer wie das Cockpit.
- Cache den Linkgraphen sauber.
- Integriere das Ergebnis in:
  - `page_contexts`
  - URL-Detailansicht
  - Insight-Logik, wenn es sinnvoll ist

Wichtig:
- Kein vollwertiger Crawler ueber das gesamte Web.
- WordPress-internes Linkgraph-Signal reicht.
- Wenn Menues oder globale Footer/Navs spaeter gesondert behandelt werden sollen, markiere das klar als offenen Punkt.

## Fokus 3: Bessere Koko-Verschmelzung

Ziel:
Koko soll nicht nur Plugin-Status liefern, sondern als zweiter Performance-Layer neben Search Console nutzbar werden.

Erwarte mindestens:

- Koko-Metriken im Uebersichts-Snapshot
- Koko-Kontext in der URL-Detailansicht
- Koko-Signale fuer Top Pages / Problemseiten, wo sinnvoll
- klare Trennung zwischen:
  - Search Console = Google Organic
  - Koko = Onsite-Nutzung / Traffic-Kontext

Baue sinnvoll zusammen:

- Besucher
- Pageviews
- Verlauf fuer den gewaehlten Zeitraum, wenn verfuegbar
- Top-Seiten aus Koko
- Vergleich aktueller Zeitraum vs. vorheriger Zeitraum

Wichtig:
- Keine falschen Gleichsetzungen wie "Koko Pageviews = SEO-Erfolg".
- Wenn Koko fuer eine URL keine eindeutige Zuordnung erlaubt, das offen anzeigen statt raten.
- Defensive Fallbacks:
  - Plugin installiert, aber nicht aktiv
  - Plugin aktiv, aber Datenroute fehlt
  - Plugin aktiv, aber keine Daten fuer Zeitraum

## Fokus 4: Groessere Row-Limits oder Paging

Ziel:
Das Cockpit soll auf groesseren Sites nicht zu frueh an kuenstlichen Limits scheitern.

Baue ein sauberes Paging- bzw. Limit-Konzept fuer Search Console:

- nutze `startRow` / `rowLimit` dort, wo sinnvoll
- kapsle Paging in einen eigenen Helper statt ad hoc in mehreren Stellen
- fuehre klare Sicherheitsgrenzen ein, damit das Cockpit nicht unkontrolliert viele API-Requests ausloest
- definiere unterschiedliche Caps fuer:
  - Top Pages
  - Top Queries
  - Query/Page-Kombinationen
  - URL-Drilldown

Wichtig:
- Kein "einfach alles auf 1000 setzen".
- Lieber nachvollziehbare Caps plus Paging.
- API-Quota und Laufzeit muessen kontrollierbar bleiben.

## Fokus 5: Defensive Runtime-Tests

Ziel:
Das Cockpit soll haeufige Live-Ausfaelle schneller erkennbar machen.

Baue leichte Runtime-Selbsttests oder Diagnosechecks fuer mindestens:

1. OAuth
   - Property vorhanden
   - Client-Konfiguration plausibel
   - Access Token vorhanden oder erneuerbar
   - vernuenftige Fehlermeldung, wenn Verbindung formal besteht, aber nicht nutzbar ist

2. Cron / Sync
   - Event geplant ja/nein
   - naechster Lauf sichtbar
   - Lock haengt ja/nein
   - Runtime-Felder plausibel

3. URL-Drilldown
   - URL-Normalisierung stabil
   - Detail-Cache erzeugbar
   - WP-Kontext ladbar
   - Fehlerfall sauber sichtbar statt Whitebox

Form:

- kleine Diagnose-Sektion im Admin reicht
- oder ein interner Self-Check-Helper mit kompakter UI-Ausgabe
- keine schwere Test-UI mit Overhead

Wichtig:
- Das sind Runtime-Sicherungen, keine vollwertige PHPUnit-Suite.
- Wenn du zusaetzlich kleine interne Assert-/Check-Helper bauen willst, ist das willkommen.

## Empfohlene Reihenfolge

1. Lesbarkeit / Render-Helfer haerten
2. internes Linkmodell bauen
3. Koko sinnvoll integrieren
4. Paging / Caps refactoren
5. Runtime-Diagnostik ergaenzen
6. Cleanup / Doku aktualisieren

## Technische Leitplanken

- Nutze bestehende Core-, Sync-, API- und UI-Layer weiter.
- Fuehre neue Logik nicht willkuerlich im UI-Layer ein.
- Wenn ein neuer Layer sinnvoll ist, z. B.:
  - `blocksy-child/inc/seo-cockpit-links.php`
  - `blocksy-child/inc/seo-cockpit-diagnostics.php`
  dann ist das okay.
- Wiederverwendung vor Duplikation.
- Bestehende SEO-Kontext-Helfer aus `seo-meta.php` nutzen, nicht nachbauen.

## Gewuenschte Deliverables

1. Code im Repo
2. strukturierte Erweiterung der bestehenden Cockpit-Architektur
3. aktualisierte Dokumentation in Markdown mit:
   - Architektur-Ergaenzungen
   - Koko-Datenfluss
   - Linkgraph-Logik
   - Paging-/Limit-Strategie
   - Runtime-Checks
4. kurze Liste offener Restpunkte

## Akzeptanzkriterien

Die Aufgabe gilt erst als fertig, wenn:

- das Cockpit weiterhin im WP-Admin laeuft
- Search Console weiter funktioniert
- Koko nicht mehr nur Status ist, sondern echte Kontextdaten liefert
- interne Links pro URL sichtbar sind
- groessere Datenmengen nicht mehr nur an harten Mini-Limits haengen
- mindestens eine kompakte Runtime-Diagnostik sichtbar ist
- der Code lesbarer und wartbarer ist als vor V2.1

## No-Go-Regeln

- keine visuelle Demo ohne technische Substanz
- keine pseudo-intelligenten Aussagen ohne nachvollziehbare Regel
- kein ungebremstes Hochdrehen aller Row-Limits
- keine fragile Koko-Kopplung ohne Fallback
- keine stillen Fehlerpfade ohne sichtbare Diagnose

## Ausgabeformat fuer den Agent

Am Ende liefern:

- was genau geaendert wurde
- welche Architekturentscheidungen getroffen wurden
- wie interne Links jetzt gemessen werden
- wie Koko jetzt eingebunden ist
- wie Paging/Caps geloest wurden
- welche Runtime-Checks vorhanden sind
- welche Risiken oder offenen Grenzen bleiben
