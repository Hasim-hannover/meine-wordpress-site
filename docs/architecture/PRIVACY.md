# Privacy

Stand: 2026-05-02

## Readiness-Diagnose

Die Readiness-Diagnose ist ein eigener Verarbeitungsvorgang. Sie dient der bezahlten Vorprüfung, ob ein Solar-, Wärmepumpen- oder SHK-Betrieb für die nächste Diagnose- oder Umsetzungsstufe geeignet ist.

## Verarbeitete Daten

Der Default-Pfad verarbeitet nur grobe Betriebs- und Selbstauskunftsdaten:

- Branche
- Mitarbeiter-Range
- Land und PLZ-Region
- Website-URL, falls vorhanden
- Angebotsfokus
- Werbebudget-Range
- Selbstauskunft zu Tracking, CRM, Consent Mode, serverseitigem Tracking und Meta CAPI
- Selbstauskunft zu Lead-Volumen, Lead-Qualität und Engpass
- Session-basierte Attribution aus `NexusCore.getLeadAttributionPayload()`
- UTM-Parameter, Referrer und Click-IDs, falls vorhanden

## Nicht verarbeitete Daten im Default-Pfad

- kein Klarname
- keine Telefonnummer
- keine E-Mail-Adresse
- keine personenbezogenen Endkundendaten
- keine Admin-Zugänge zu GA4, GTM, Ads, CRM oder Pixeln
- keine Cookies beim normalen Seitenaufruf

## Consent-Logik

Der Submit-Schritt braucht eine sichtbare Zustimmung direkt im Readiness-Formular. Es gibt keinen globalen Banner als Ersatz für diese Zustimmung.

Der Payload speichert:

- `consent.privacy_processing_accepted`
- `consent.timestamp`
- `consent.text_version`
- `consent.text_hash`
- `consent.marketing`
- `consent.analytics`

Marketing und Analytics bleiben im Default-Pfad `false`, solange keine eigene Zustimmung vorliegt.

## Optionale E-Mail-Zustellung

Eine E-Mail-Adresse ist nur erlaubt, wenn der Geschäftsführer den Befund per E-Mail wünscht. Dann wird das optionale `delivery`-Objekt gesendet.

`delivery` braucht einen eigenen Consent mit:

- `delivery.consent.email_delivery_accepted`
- `delivery.consent.timestamp`
- `delivery.consent.text_version`
- `delivery.consent.text_hash`

Telefonnummern und Klarnamen bleiben auch in diesem Pfad ausgeschlossen.

## n8n-Retention

Readiness-Intakes dürfen in n8n maximal 30 Tage gespeichert werden. Danach werden sie gelöscht oder so anonymisiert, dass kein Rückschluss auf den konkreten Betrieb möglich ist.

Der aktive n8n-Branch darf nicht mehr Daten speichern, als im Contract `automations/n8n/data-models/readiness-diagnosis-payload.v1.contract.json` erlaubt sind.

## Auftragsverarbeitung

n8n ist für diesen Prozess Workflow-Engine und technischer Empfänger des Payloads. Brevo, CRM oder weitere Systeme dürfen erst angebunden werden, wenn der konkrete Zustellweg dokumentiert ist.

Kein neuer Drittland-Default wird durch die Readiness-Diagnose eingeführt.
