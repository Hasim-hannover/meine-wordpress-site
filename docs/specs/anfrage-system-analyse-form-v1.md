# Anfrage-System-Analyse Form v1

Status: draft
Owner: Repo / Funnel
Route: `/anfrage-system-analyse/`
Legacy: `/readiness-diagnose/` leitet per 301 weiter

## Ziel

Die Anfrage-System-Analyse ist der 14-Tage-Fitcheck für passende Founding-Partner. Sie soll nicht als kostenloser Massen-Leadmagnet wirken, sondern als qualifizierender Einstieg mit Marktbild, Anfragepfad-Prüfung, Leadkosten-Korridor und klarer Empfehlung für oder gegen eine Umsetzung.

## Nicht-Ziele

- Kein Admin-Zugang zu GA4, GTM, Ads, CRM oder Pixeln.
- Keine personenbezogenen Endkundendaten.
- Keine Telefonnummer im Default-Pfad.
- Keine E-Mail, außer der Geschäftsführer wünscht den Befund per E-Mail und bestätigt den separaten Consent-Schritt.
- Kein Payment-Flow in v1.
- Kein n8n-Submit, solange `HU_FEATURE_READINESS_SUBMIT=false` ist.
- Keine öffentliche Tiefendiagnose als eigener Funnel-Schritt.

## Acht Formularschritte

| Schritt | Zweck | Pflichtdaten | Branching |
|---|---|---|---|
| 1 Betrieb | ICP-Fit prüfen | Branche, Angebotsart | Nicht Solar, SHK oder Wärmepumpe → gelbes oder rotes Fit-Signal |
| 2 Region | Marktreichweite einschätzen | PLZ-Region, DACH-Land | Außerhalb DACH → Nicht-Empfehlung möglich |
| 3 Angebot | wirtschaftliche Relevanz prüfen | Hauptleistung, durchschnittlicher Auftragswert | niedriger Auftragswert → rotes Wirtschaftlichkeitssignal |
| 4 Werbebudget | Skalierungsfähigkeit prüfen | Budget-Range | Unter 5.000 EUR/Monat → rotes Signal für Founding Cohort |
| 5 Website | Anfragepfad einschätzen | URL, CMS-Selbstauskunft | Keine URL → Befund nur eingeschränkt |
| 6 Tracking | Messlage prüfen | Pixel, GTM, Consent, CAPI als Ja/Nein/Weiß ich nicht | Weiß ich nicht → rot |
| 7 Anfrageprozess | Vertriebsfähigkeit prüfen | Reaktionszeit, Verantwortlicher, CRM-Selbstauskunft | kein Prozess → rotes Prozesssignal |
| 8 Marktbild | Leadkosten-Korridor einordnen | Zielregion, Hauptkanal, Wettbewerbseindruck | nur als Korridor, nie als Garantie |

## Datenmodell

Default-Pfad:

- `client.industry`
- `client.employee_range`
- `client.plz_region`
- `inputs.offer_focus`
- `inputs.average_order_value_range`
- `inputs.website_url`
- `inputs.ad_budget_range`
- `inputs.tracking.pixel_present_self_reported`
- `inputs.tracking.gtm_present_self_reported`
- `inputs.tracking.consent_mode_self_reported`
- `inputs.tracking.meta_capi_self_reported`
- `inputs.crm.crm_present_self_reported`
- `inputs.crm.response_time_self_reported`
- `inputs.market.target_region`
- `inputs.market.expected_channel_mix`

Optionaler Zustellungspfad:

- `delivery.email`
- `delivery.consent.timestamp`
- `delivery.consent.text_hash`

## Scoring-Regeln

- `Weiß ich nicht` ist gültig und wird nicht blockiert.
- `Weiß ich nicht` in Tracking- oder CRM-Fragen wird im Befund rot bewertet.
- Budget unter 5.000 EUR/Monat blockiert die Founding-Cohort-Empfehlung, aber nicht zwingend die Analyse.
- Leadkosten werden als marktbasierter Zielkorridor formuliert, nicht als Garantie.
- Fehlende Website-URL erzeugt eine eingeschränkte Befundtiefe.

## Tracking-Hooks

| Stage | Event |
|---|---|
| View | `request_analysis_view` |
| Step complete | `request_analysis_step_{n}_completed` |
| Stub submit | `request_analysis_submit_disabled` |

## Folge-PR

Der bestehende Payload-Contract `automations/n8n/data-models/readiness-diagnosis-payload.v1.contract.json` bleibt bis zur nächsten Contract-Version intern stabil.

Submit bleibt deaktiviert, bis Formularlogik, Consent-UI und n8n-IF-Branch gegen die neue Analyse-Semantik geprüft sind.
