# Flow Map - Audit Funnel - Instant Results V3 Target

## 1. Start

- `POST /webhook/audit`
- URL wird validiert
- ungueltige oder interne Hosts werden sofort abgelehnt
- `jobId` wird erzeugt
- `processing` wird gespeichert
- Frontend bekommt sofort `ok + jobId + processing`

## 2. Analyse

- HTML holen
- lesbaren Snapshot holen
- PageSpeed mobil holen
- Sitemap lesen
- Signale zu SEO, Performance, Trust, Conversion und Tracking normalisieren
- kaufnahe Keywords generieren
- SERP gegen diese Keywords pruefen

## 3. Diagnose

- Top-3-Bremsen priorisieren
- Potenzial-Spanne bilden
- Detail-Sektionen fuer das Frontend bauen
- kurze strategische Einordnung erzeugen

## 4. Ergebnis

- Payload im V3-Contract speichern
- Status fuer `jobId` auf `done` setzen

## 5. Polling

- `GET /webhook/audit-status?jobId=...`
- gibt `processing`, `done`, `expired` oder `error` zurueck

## 6. Beratung

- nach dem On-Page-Ergebnis sendet das native Frontend-Form an `POST /webhook/audit-consultation`
- n8n validiert Name + E-Mail
- Anfrage wird per Brevo SMTP oder CRM-Route zugestellt
- Frontend bekommt `accepted`

## Wegfallende Schleifen aus V2

- kein `email_capture`
- kein Report-Versand
- kein HTML-Anhang
- kein Fluent-Forms-Handover

## Neue Prioritaetslogik

- Ergebnis muss zuerst ueberzeugen
- Beratung ist erst danach der naechste Schritt
- Delivery-Logik ist kein Teil des Audit-Runners mehr
