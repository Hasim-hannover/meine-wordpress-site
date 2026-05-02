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

## Readiness-Diagnose Branch

Der bestehende Consultation-Webhook wird für Readiness nicht ersetzt. Er bekommt einen zusätzlichen IF-Branch:

- Bedingung: `meta.intake_variant == "readiness_diagnosis"`
- Contract: `automations/n8n/data-models/readiness-diagnosis-payload.v1.contract.json`
- Zielstatus: `mvp`
- Default-Pfad: kein Klarname, keine Telefonnummer, keine E-Mail, keine personenbezogenen Endkunden-Daten
- E-Mail-Zustellung nur über das optionale `delivery`-Objekt mit separatem Consent
- Speicherung in n8n maximal 30 Tage, danach löschen oder anonymisieren

Der bestehende Beratungs-Branch bleibt unverändert und verarbeitet weiterhin normale Consultation-Requests nach dem Audit-Ergebnis.

## Hinweis

Die Frontend-Seite in WordPress erwartet fuer die Beratungsanfrage den Endpoint:

- `https://n8n.hasimuener.de/webhook/audit-consultation`

Falls du in n8n andere Produktions-URLs bekommst, muss dieselbe URL auch in WordPress unter `NexusAuditConfig.webhookConsultation` gesetzt sein.
