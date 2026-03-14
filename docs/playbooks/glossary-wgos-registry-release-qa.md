# Glossary/WGOS Registry Release QA Playbook

## Zweck
Reproduzierbarer Ablauf fuer Deploys mit Registry-Aenderungen (`glossary-registry-data.php`, `wgos-asset-registry-data.php`) inklusive klarer PASS/FAIL-Entscheidung.

## Scope
- Glossar-Routing und Related Terms
- WGOS-Asset-Routing (Detailseite vs. Fallback)
- Link-Stabilitaet nach Registry-Sync

## Fester Ablauf
1. Registry-Aenderung erkennen
   - Pruefen, ob `blocksy-child/inc/glossary-registry-data.php` und/oder `blocksy-child/inc/wgos-asset-registry-data.php` geaendert wurden.
   - Wenn nein: diesen Playbook-Ablauf nicht starten.
2. Deploy
   - Commit/Tag deployen.
   - Sicherstellen, dass die neue Theme-Version aktiv ist.
3. Cache Purge
   - Vollstaendigen Purge in allen Schichten ausfuehren:
   - Page Cache/CDN
   - Objekt-Cache (falls aktiv)
   - Browser-Hard-Reload fuer QA
4. Sync Trigger
   - Nach Deploy mindestens einen Frontend-Request ausfuehren (z. B. `/glossar/utm-parameter/`), damit `init`-basierter Sync laeuft.
   - Danach Glossar-Detailseite neu laden.
5. Observability pruefen (muss aus gespeicherten Sync-Daten kommen)
   - Auf einer Glossar-Detailseite im HTML pruefen:
   - `data-nexus-glossary-registry` auf `.glossary-wrapper`
   - `data-nexus-glossary-synced-at` auf `.glossary-wrapper`
   - optional `meta[name=\"nexus-glossary-registry-version\"]`
   - optional Response-Header:
   - `X-Nexus-Glossary-Registry-Version`
   - `X-Nexus-Glossary-Post-Synced-At`
   - `X-Nexus-Glossary-Sync-Last-Run`
6. Routing-Assertions ausfuehren
   - Als eingeloggter Admin aufrufen:
   - `/?nexus_glossary_routing_assert=1`
   - Ergebnis muss JSON mit `pass: true` sein.
   - Bei `pass: false` alle `failures` ins QA-Protokoll uebernehmen.
7. Smoke-Test der Pflichtseiten
   - `/glossar/utm-parameter/`
   - `/glossar/owned-leads/`
   - `/wordpress-growth-operating-system/`
   - `/wgos-systemlandkarte/`
   - `/core-web-vitals/` (Cluster/WGOS-Bezug)
   - `/ga4-tracking-setup/` (Cluster/WGOS-Bezug)

## Smoke-Test Kriterien (pro URL)
1. Related Terms zeigen korrekte Ziele gemaess Registry-Policy (index/noindex/alias).
2. Kein falscher Redirect auf WGOS-Pillar, wenn fuer den Begriff eine eigene Glossar-Detailseite existiert.
3. Asset-Links gehen auf Asset-Detailseite oder auf sauberen Landkarten-Fallback mit `#asset-...`.
4. Keine offensichtliche Link-Drift (neue/falsche Zielseiten gegenueber Registry-Logik).

## QA-Protokoll (auszufuellen)
- Datum (UTC):
- Deploy-Commit:
- Geaenderte Registry-Datei(en):
- Cache Purge durchgefuehrt: `JA/NEIN`
- Sync Trigger durchgefuehrt: `JA/NEIN`
- Observability-Werte:
- `data-nexus-glossary-registry`:
- `data-nexus-glossary-synced-at`:
- `X-Nexus-Glossary-Registry-Version`:
- Assertions Endpoint `pass`:
- Fehlerliste (falls vorhanden):
- Smoke-Test Resultate je URL:
- Finale Entscheidung: `PASS` oder `FAIL`

## Abschlusskriterium
- `PASS` nur wenn:
  - Observability-Daten vorhanden und plausibel
  - Assertions `pass: true`
  - Alle Smoke-Test-Kriterien fuer alle Pflichtseiten bestanden
- Sonst immer `FAIL`
