# Audit Funnel - Instant Results V3 Target

## Status

- Einstufung: `target`
- Zweck: Soll-Architektur fuer den naechsten Audit-Refactor
- Wichtig: kein Live-Import, sondern versionierte Zielstruktur

## Was sich gegenueber V2 aendert

- Audit startet weiter mit `URL-only`
- `email_capture` fliegt komplett raus
- PDF- oder HTML-Report-Versand fliegt komplett raus
- Fluent Forms fliegt aus dem post-result Schritt raus
- Ergebnis-CTA wechselt von `Report sichern / Deep-Dive` auf `Beratung anfragen`
- Potenzial wird als Spanne statt als scheinexakte Einzelzahl kommuniziert

## Ziel

Das Audit soll sofort auf der Seite ueberzeugen.

Die Seite muss nach dem Polling in wenigen Sekunden klar beantworten:

- wo die groesste Nachfrage-Reibung sitzt
- wie stark das Problem ungefaehr wiegt
- welche 3 Hebel zuerst relevant sind
- warum jetzt eine Beratung Sinn ergibt

## Endpunkte

- `POST /webhook/audit`
- `GET /webhook/audit-status?jobId=...`
- `POST /webhook/audit-consultation`

## Analyse-Logik

1. Start
   - URL validieren
   - SSRF blocken
   - Rate Limit
   - `jobId` erzeugen
   - `processing` sofort speichern und ans Frontend antworten

2. Datenerhebung
   - Raw HTML
   - lesbarer Snapshot
   - PageSpeed mobil
   - Sitemap

3. Auswertung
   - SEO- und Basis-Tracking-Signale
   - Performance- und CWV-Signale
   - Trust- und Conversion-Signale
   - kommerzielle Keywords
   - SERP-Sichtbarkeit

4. Verdichtung
   - Top-3-Bremsen priorisieren
   - Potenzial-Spanne berechnen
   - Detail-Sektionen fuer das Frontend vorbereiten
   - kurze strategische Einordnung erzeugen

5. Ergebnis
   - Payload nach `audit-frontend-payload.v3.contract.json`
   - `done` unter `jobId` speichern

## Warum das schlanker ist

- ein kompletter Nebenast verschwindet: `email_capture`
- kein doppelter Delivery-Path fuer Report-HTML und SMTP
- keine zweite Logik fuer `processing` im Mail-Branch
- kein Formular-Plugin mehr im Ergebnis-CTA
- weniger kognitive Last im Frontend

## Warum das hochwertiger ist

- Diagnose zuerst, Methodik spaeter
- Top-3-Hebel statt Volltext-Report
- Potenzial als Range statt falscher Genauigkeit
- Beratung als logische Fortsetzung des Problems, nicht als Sprung in einen zweiten Funnel

## Neue Payload-Rollen

- `verdict`: die unmittelbare Diagnose
- `highlights`: 3 schnelle Signal-Karten
- `findings`: priorisierte Hauptbremsen
- `opportunity`: Monats- und Jahres-Spanne
- `details.sections`: Belege aus der Analyse
- `cta`: Beratungs-CTA statt Report-Delivery

## Rest-Risiken

- `workflow static data` bleibt fuer Produktivbetrieb nur MVP-tauglich
- PageSpeed und Google CSE bleiben extern und koennen schwanken
- die Potenzial-Spanne bleibt eine Heuristik, keine Forecast-Engine
- der neue Consultation-Webhook braucht noch Live-Implementierung in n8n

## Repo-Touchpoints

- `blocksy-child/assets/js/audit-live.js`
- `blocksy-child/assets/css/audit-results.css`
- `docs/references/audit-page-editor-snippet-v3.html`
- `automations/n8n/data-models/audit-frontend-payload.v3.contract.json`
- `automations/n8n/workflows/audit-funnel__instant-results__target.json`
