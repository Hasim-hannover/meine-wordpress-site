# Audit Funnel - Customer Journey Audit V2

## Workflow-Name

Empfohlene Benennung in n8n:

- `Audit Funnel - Customer Journey Audit Runner V2`

Repo-Datei:

- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`

## Zweck

Dieser Workflow ist der technische Kern des `Customer Journey Audit`.

Er nimmt eine Website-URL entgegen, analysiert Sichtbarkeit, Technik, Trust- und Lead-Signale, speichert das Ergebnis fuer das Frontend und verschickt den Report optional per E-Mail.

## Was V2 konkret loest

- Der Erststart funktioniert jetzt mit `URL-only`, also passend zu `audit-live.js`.
- `email_capture` startet keinen zweiten Audit mehr.
- `processing` wird direkt gespeichert und sauber ueber `audit-status` ausgelesen.
- `Sitemap Final` wird jetzt auch wirklich in der Analyse verwendet.
- Cleanup fuer `job_*` und `rl:*` ist korrigiert.

## Trigger

- `POST /webhook/audit`
- `GET /webhook/audit-status?jobId=...`

`POST /webhook/audit` hat in V2 zwei Modi:

- `start`
  - Standardfall
  - erwartet mindestens `url`
- `email_capture`
  - spaeterer Report-Versand
  - erwartet `jobId`, `email`

## Import-Hinweise

Vor dem Aktivieren in n8n setzen:

- OpenAI-Credential mit Name `OPENAI_AUDIT`
- SMTP-Credential mit Name `SMTP_BREVO_AUDIT`
- Variable oder Env `GOOGLE_PAGESPEED_API_KEY`
- Variable oder Env `GOOGLE_CSE_KEY`
- optional `GOOGLE_CSE_CX`

Wichtig:

- Der Workflow ist als bereinigter Repo-Export gespeichert.
- Credential-Namen sind Platzhalter fuer n8n.
- Keine Roh-Exports mit echten Keys oder Pin-Daten committen.

## Flow-Logik

### 1. Intake

- `Webhook`
- `URL Validator`
- `IF Valid Request`
- `IF Email Capture?`

Der Validator erkennt jetzt selbst, ob es sich um einen normalen Audit-Start oder um einen spaeteren E-Mail-Request handelt.

### 2. Start-Branch

- `Respond OK`
- `Store Processing`
- `Jina Reader`
- `Raw HTML Fetch`
- `PageSpeed API`
- `Check PageSpeed`
- `IF PageSpeed Retry?`
- `Wait 12s`
- `PageSpeed API Retry`
- `PageSpeed Final`
- `Sitemap Fetch`
- `Sitemap Fetch Fallback`
- `Sitemap Final`
- `Analyze Site`
- `Keyword Generator`
- `Extract Keywords`
- `SERP Check`
- `Build Journey`
- `Write Story`
- `Build Frontend Data`
- `Store Results`

Danach optional:

- `IF Auto Email Requested`
- `Prepare Auto Email Request`
- `Build Email HTML`
- `Send email`

## 3. E-Mail-Capture-Branch

- `Load Stored Audit For Email`
- `IF Stored Audit Ready?`
- `Build Email HTML`
- `Send email`
- `IF Email Response Needed?`
- `Respond Email Capture OK`

Wenn das Audit noch nicht fertig ist, antwortet der Workflow mit `processing` statt still einen zweiten Lauf zu starten.

## 4. Status-Branch

- `Webhook Status`
- `Lookup Results`
- `Respond Status`

## Inputs

### Start

- `url`
- optional `email`

### Email-Capture

- `jobId`
- `email`
- optional `url`
- `step: 'email_capture'`

## Persistenz

Speicherort:

- `workflow static data`

Job-Struktur:

- `status`
- `message`
- `request`
- `data`
- `storedAt`
- `updatedAt`
- `finishedAt`
- `expiresAt`

TTL:

- 2 Stunden

## Outputs

### Frontend

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

### E-Mail

- HTML-Body
- HTML-Anhang als speicherbare Report-Datei

## Abhaengigkeiten

- n8n Cloud
- OpenAI
- Google PageSpeed API
- Google Custom Search API
- Jina Reader
- SMTP / Brevo
- WordPress-Frontend in `blocksy-child/assets/js/audit-live.js`

## Rest-Risiken

### 1. Fehlerpfade nach `Respond OK` sind noch nicht voll robust

Wenn spaete Nodes hart abbrechen, bleibt ein Job im Zweifel auf `processing`.

### 2. `workflow static data` ist fuer Produktivbetrieb nur bedingt stabil

Fuer MVP okay. Fuer saubere Nachvollziehbarkeit, Queueing und Ausfallsicherheit spaeter besser in externe Persistenz verschieben.

### 3. Revenue-Gap bleibt heuristisch

Die Zahl ist weiter eine konservative Storytelling-Schaetzung, keine belastbare Forecast-Logik.

### 4. Report ist HTML, kein echtes PDF

Der Anhang ist absichtlich importfreundlich und leichtgewichtig, aber technisch kein PDF.

## Priorisierte Naechstschritte

1. Diesen V2-Workflow in n8n importieren und Credentials/Vars setzen.
2. Testen:
   - Start mit nur URL
   - Polling bis `done`
   - `email_capture` mit vorhandener `jobId`
3. Danach `audit-live.js` auf den separaten Report-Pfad vorbereiten, damit `step: 'email_capture'` spaeter komplett aus dem Start-Webhook raus kann.
