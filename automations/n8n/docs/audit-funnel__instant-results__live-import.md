# Audit Funnel - Instant Results Live Import

Import-Datei:

- `automations/n8n/workflows/audit-funnel__instant-results__live-import.json`

## Enthaltene Endpunkte

- `POST /webhook/audit`
- `GET /webhook/audit-status?jobId=...`
- `POST /webhook/audit-consultation`

## Vor dem Aktivieren in n8n setzen

Credentials:

- `OPENAI_AUDIT`
- `BREVO_SMTP`

Umgebungsvariablen oder n8n-Variablen:

- `GOOGLE_PAGESPEED_API_KEY`
- `GOOGLE_CSE_KEY`
- `GOOGLE_CSE_CX`
- `AUDIT_LEADS_TO_EMAIL`

## Verhalten

- Audit startet nur mit URL
- Ergebnis erscheint direkt auf der Seite
- kein Audit-Email-Capture
- kein PDF-/HTML-Report-Versand
- nach dem Ergebnis: native Beratungsanfrage oder direkter Call via Cal.com

## Hinweis

Die Frontend-Seite in WordPress erwartet fuer die Beratungsanfrage den Endpoint:

- `https://hasim.app.n8n.cloud/webhook/audit-consultation`

Falls du in n8n andere Produktions-URLs bekommst, muss dieselbe URL auch in WordPress unter `NexusAuditConfig.webhookConsultation` gesetzt sein.
