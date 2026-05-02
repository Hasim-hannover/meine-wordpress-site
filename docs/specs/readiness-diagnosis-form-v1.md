# Readiness-Diagnose Form v1

Status: draft
Owner: Repo / Funnel
Route: `/readiness-diagnose/`

## Ziel

Die Readiness-Diagnose ist der bezahlte 14-Tage-Einstieg vor Tiefendiagnose und Foundation. Das Formular sammelt nur Daten, die für einen schriftlichen Ampel-Befund nötig sind.

## Nicht-Ziele

- Kein Admin-Zugang zu GA4, GTM, Ads, CRM oder Pixeln.
- Keine personenbezogenen Endkunden-Daten.
- Keine Telefonnummer im Default-Pfad.
- Keine E-Mail, außer der Geschäftsführer wünscht den Befund per E-Mail und bestätigt den separaten Consent-Schritt.
- Kein Payment-Flow in v1.
- Kein n8n-Submit in PR 4.

## Acht Formularschritte

| Schritt | Zweck | Pflichtdaten | Branching |
|---|---|---|---|
| 1 Betrieb | ICP-Fit prüfen | Branche, Angebotsart | Nicht Solar/Wärmepumpe → gelbes oder rotes Fit-Signal |
| 2 Region | Marktreichweite einschätzen | PLZ-Region, DACH-Land | Außerhalb DACH → Nicht-Empfehlung möglich |
| 3 Größe | Umsetzungsfähigkeit prüfen | MA-Range | Unter Zielkorridor → Warnsignal |
| 4 Werbebudget | Skalierungsfähigkeit prüfen | Budget-Range | Unter 5.000 EUR/Monat → rotes Signal für Founding Cohort |
| 5 Website | Anfragepfad einschätzen | URL, CMS-Selbstauskunft | Keine URL → Befund nur eingeschränkt |
| 6 Tracking | Messlage prüfen | Pixel, GTM, Consent, CAPI als Ja/Nein/Weiß ich nicht | Weiß ich nicht → rot |
| 7 CRM | Lead-Verarbeitung prüfen | CRM vorhanden, Reaktionszeit, Verantwortlicher | Kein CRM → rotes Prozesssignal |
| 8 Befund | Abschluss und Consent | Befund-Zustellung optional per E-Mail | E-Mail nur mit separatem Consent |

## Datenmodell

Default-Pfad:

- `client.industry`
- `client.employee_range`
- `client.plz_region`
- `inputs.website_url`
- `inputs.ad_budget_range`
- `inputs.tracking.pixel_present_self_reported`
- `inputs.tracking.gtm_present_self_reported`
- `inputs.tracking.consent_mode_self_reported`
- `inputs.tracking.meta_capi_self_reported`
- `inputs.crm.crm_present_self_reported`
- `inputs.crm.response_time_self_reported`

Optionaler Zustellungspfad:

- `delivery.email`
- `delivery.consent.timestamp`
- `delivery.consent.text_hash`

## Scoring-Regeln

- `Weiß ich nicht` ist gültig und wird nicht blockiert.
- `Weiß ich nicht` in Tracking- oder CRM-Fragen wird im Befund rot bewertet.
- Budget unter 5.000 EUR/Monat blockiert die Founding-Cohort-Empfehlung, aber nicht zwingend die Readiness-Diagnose.
- Fehlende Website-URL erzeugt eine eingeschränkte Befundtiefe.

## Tracking-Hooks

| Stage | Event |
|---|---|
| View | `readiness_diagnosis_view` |
| Step complete | `readiness_step_{n}_completed` |
| Stub submit | `readiness_submit_disabled` |

## Folge-PR

Der Payload-Contract liegt unter `automations/n8n/data-models/readiness-diagnosis-payload.v1.contract.json`.

Submit bleibt deaktiviert, bis Formularlogik, Consent-UI und n8n-IF-Branch gegen diesen Contract umgesetzt und geprüft sind.
