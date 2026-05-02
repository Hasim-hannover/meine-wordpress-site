# Flow Map - Audit Funnel - Instant Results Live Import

## Trigger

- `POST /webhook/audit`
- `GET /webhook/audit-status?jobId=...`
- `POST /webhook/audit-consultation`

## Audit-Start

1. Webhook nimmt URL-only Request an.
2. URL wird validiert.
3. Job wird als `processing` gespeichert.
4. Frontend bekommt `jobId` und pollt den Status.
5. Ergebnis wird nach V3-Zielbild für die Seite gebaut.

## Consultation-Branch

1. Webhook nimmt normale Beratungsanfrage nach Audit-Ergebnis an.
2. n8n validiert Kontaktfelder.
3. Anfrage wird über den vorhandenen Zustellweg weitergegeben.
4. Frontend bekommt eine Annahme- oder Fehlermeldung.

## Readiness-Diagnose-Branch

1. Derselbe Webhook nimmt Readiness-Payloads an.
2. IF-Node prüft `meta.intake_variant == "readiness_diagnosis"`.
3. JSON wird gegen `readiness-diagnosis-payload.v1.contract.json` validiert.
4. Payload wird als Diagnose-Intake gespeichert oder an den internen Zustellweg gegeben.
5. n8n löscht oder anonymisiert den Intake spätestens nach 30 Tagen.

## Privacy-Regeln

- Default-Pfad enthält keinen Klarnamen, keine Telefonnummer und keine E-Mail.
- E-Mail ist nur im optionalen `delivery`-Objekt erlaubt.
- `delivery` braucht eigenen Consent mit Zeitstempel, Textversion und Text-Hash.
- `unknown` ist bei Tracking- und CRM-Selbstauskünften gültig und wird später im Befund rot bewertet.

## Rollback

- Readiness-IF-Branch in n8n auf inactive setzen.
- `HU_FEATURE_READINESS_SUBMIT=false` im Theme belassen.
- Contract bleibt versioniert, wird aber nicht vom Frontend gesendet.
