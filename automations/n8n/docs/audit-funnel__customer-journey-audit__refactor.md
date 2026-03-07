# Audit Funnel - Customer Journey Audit

## Workflow-Name

Empfohlene Benennung:

- `Audit Funnel - Customer Journey Audit Runner`

Repo-Datei:

- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`

## Rolle im Gesamtsystem

Dieser Workflow ist der technische Kern des primaeren Lead-Einstiegs.

Seine Rolle:

- URL entgegennehmen
- erste Missbrauchs- und SSRF-Pruefung durchfuehren
- Website technisch und inhaltlich anreichern
- kommerzielle Keywords und SERP-Sichtbarkeit ableiten
- eine Journey-Auswertung fuer das Frontend bauen
- das Ergebnis fuer Polling speichern
- optional einen Report per E-Mail versenden

Damit verbindet er drei Systemschichten:

- Trigger und Intake
- Analyse- und Bewertungslogik
- Delivery fuer Frontend und E-Mail

## Trigger

- `POST /webhook/audit`
- `GET /webhook/audit-status?jobId=...`

## Hauptschritte

1. `Webhook`
   - nimmt den Audit-Request an
2. `URL Validator`
   - validiert URL und E-Mail
   - normalisiert die URL
   - vergibt `jobId`
   - fuehrt SSRF- und einfache Abuse-Pruefung durch
3. `Respond OK`
   - liefert frueh eine Polling-Antwort an das Frontend
4. Datenbeschaffung
   - `Jina Reader`
   - `Raw HTML Fetch`
   - `PageSpeed API`
   - `PageSpeed API Retry`
   - `Sitemap Fetch`
   - `Sitemap Fetch Fallback`
5. Website-Analyse
   - `Analyze Site`
   - `Keyword Generator`
   - `Extract Keywords`
   - `SERP Check`
   - `Build Journey`
   - `Write Story`
6. Delivery
   - `Build Frontend Data`
   - `Store Results`
   - `Build Email HTML`
   - `Send email`
7. Statusabfrage
   - `Webhook Status`
   - `Lookup Results`
   - `Respond Status`

## Business-Logik

- Der Workflow verkauft nicht direkt, sondern produziert Diagnose.
- Die Website wird entlang von vier Journey-Schritten bewertet:
  - Sichtbarkeit
  - Seitenerlebnis
  - Vertrauen
  - naechster Schritt / Lead Capture
- Aus Keyword- und Sichtbarkeitsluecken wird ein Revenue Gap geschaetzt.
- GPT schreibt eine kurze strategische Einordnung mit Handlungsdruck.
- Das Frontend fuehrt danach in den `360° Deep-Dive`.

## Datenlogik

### Inputs

- URL
- E-Mail
- technische Metadaten aus Webhook und Headern

### Enrichment

- Jina Reader Text
- Raw HTML
- Google PageSpeed
- Sitemap
- Google Custom Search
- OpenAI fuer Keywords
- OpenAI fuer Story

### Persistenz

- Ergebnisse werden in `workflow static data` unter `job_<id>` abgelegt
- TTL aktuell: 2 Stunden

### Frontend-Output

Der Workflow baut einen Frontend-Payload mit:

- `meta`
- `scores`
- `performance`
- `journeySteps`
- `serpResults`
- `revenue`
- `story`
- `cta`

Siehe auch:

- `automations/n8n/data-models/audit-frontend-payload.contract.json`

## Delivery-Logik

Es gibt aktuell zwei Delivery-Wege:

- Polling fuer das Audit-Frontend
- E-Mail-Versand eines HTML-Reports mit HTML-Anhang

Wichtig:

- Die E-Mail-Strecke ist kein eigener Workflow, sondern haengt direkt hinter der Analyse.
- Analyse und Report-Versand sind dadurch zu eng gekoppelt.

## Abhaengigkeiten

- n8n Cloud
- OpenAI
- Google PageSpeed API
- Google Custom Search API
- Jina Reader
- SMTP / Brevo
- WordPress-Frontend in `blocksy-child/assets/js/audit-live.js`

## Kritische Risiken

### 1. Frontend-Contract ist aktuell gebrochen

Das Frontend sendet beim Erstaufruf nur die URL:

- `blocksy-child/assets/js/audit-live.js`

Der Workflow verlangt aber bereits im `URL Validator` zwingend eine E-Mail.

Folge:

- Der aktuelle Frontend-Submit ist mit diesem Workflow nicht kompatibel.

### 2. E-Mail-Capture startet denselben Audit erneut

Das Frontend sendet beim optionalen Report-Capture:

- `email`
- `jobId`
- `url`
- `step: 'email_capture'`

Der Workflow brancht darauf nicht. Er erzeugt stattdessen eine neue `jobId` und startet den kompletten Audit erneut.

Folgen:

- unnötige API-Kosten
- unnoetige Laufzeit
- irrefuehrende UX, weil das Frontend sofort Erfolg meldet
- keine saubere Trennung zwischen Analyse und Report-Versand

### 3. Kein sauberer Fehlerzustand fuer Polling

Der Workflow speichert nur `done`, aber keinen expliziten `error`-Status fuer Analysefehler.

Folge:

- bei Fehlern bleibt das Frontend bis zum Timeout in `processing`
- Fehler werden fuer Nutzer und Betrieb unsauber sichtbar

### 4. Sitemap-Fallback wird fachlich gebaut, aber analytisch nicht konsistent genutzt

`Sitemap Final` waehlte die bessere Sitemap-Quelle. `Analyze Site` liest aber weiter direkt `Sitemap Fetch`.

Folge:

- erfolgreicher Fallback kann fuer die eigentliche Analyse unberuecksichtigt bleiben

### 5. Secrets und Betriebswerte waren im Roh-Export nicht sauber getrennt

Im gelieferten Live-Export steckten mindestens:

- harter Google PageSpeed API Key
- konkrete n8n-Credential-IDs
- Pin-Daten

Die Repo-Version wurde deshalb bereinigt.

### 6. Report-Output ist HTML, nicht PDF

Der Workflow spricht intern mehrfach von PDF, erzeugt aber einen HTML-Anhang.

Folge:

- Erwartungsbruch, wenn intern oder extern von einem PDF-Report ausgegangen wird

### 7. CTA-Ziele sind inkonsistent

- Frontend-CTA zeigt auf `#deep-dive-section` innerhalb der Audit-Seite
- E-Mail-CTA zeigt auf `/360-deep-dive/#deep-dive-section`
- der PDF-HTML-Block verweist textlich auf `/customer-journey-audit/#deep-dive-section`

Folge:

- uneinheitliche Funnel-Fuehrung
- vermeidbare Reibung im Deep-Dive-Uebergang

### 8. Cleanup fuer Rate-Limit-Keys ist logisch fehlerhaft

`Store Results` bereinigt nur Keys mit Prefix `job_`. Die Bereinigung fuer `rl:`-Keys liegt in einem Branch, der so nie erreicht wird.

Folge:

- Rate-Limit-Schluessel wachsen unkontrolliert an

## CRO- und Analyse-Risiken

- Revenue-Gap basiert auf fixer Conversion Rate von 2 Prozent und KI-geschaetztem Kundenwert.
- SERP-Verlustlogik ist grob und nicht kanal- oder intent-spezifisch.
- Trust- und Lead-Capture-Signale arbeiten stark heuristisch auf HTML- und Textmustern.
- Der Workflow ist gut fuer Diagnose-Storytelling, aber nicht belastbar genug fuer harte Business-Entscheidungen ohne Kontext.

## Einstufung

- Operativer Zustand: offenbar im Einsatz
- Architekturzustand: `refactor-beduerftig`

Begruendung:

- Der Workflow enthaelt sinnvolle Schutz- und Analysebausteine.
- Gleichzeitig gibt es mehrere harte Integrationsbrueche zwischen Frontend, Polling und E-Mail-Strecke.
- Als Source of Truth ist er jetzt dokumentiert.
- Als belastbares Produktivsystem sollte er in Analyse und Delivery getrennt werden.

## Verbesserungsvorschlaege

1. Intake auf zwei klare Pfade trennen:
   - `start_audit`
   - `send_report`
2. E-Mail im Initial-Submit optional machen, nicht Pflicht.
3. `email_capture` als separaten leichten Workflow oder separaten Branch behandeln.
4. Bei Start des Audits sofort `processing` in static data schreiben.
5. Bei Fehlern aktiv `error` oder `partial` speichern.
6. `Sitemap Final` wirklich als Datenquelle in `Analyze Site` verwenden.
7. Secrets nur ueber n8n-Credentials, Vars oder Env-Variablen.
8. Report-Strecke von Analyse-Strecke entkoppeln.
9. CTA-Ziel fuer Deep-Dive auf genau einen Pfad standardisieren.
10. Frontend-Contract als Datenmodell versionieren und gegen das Theme pruefen.
