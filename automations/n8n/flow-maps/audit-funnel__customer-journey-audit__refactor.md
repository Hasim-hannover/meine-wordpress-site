# Flow Map - Audit Funnel - Customer Journey Audit

## Trigger

- `POST /webhook/audit`
- `GET /webhook/audit-status`

## Ablauf

1. Intake
   - Webhook nimmt Request an
   - Validator erkennt `start` oder `email_capture`
   - Start prueft URL, SSRF und Rate Limit
   - `email_capture` prueft `jobId` und E-Mail
   - nur im Start-Mode wird eine neue `jobId` erzeugt

2. Sofortantwort
   - nur im Start-Mode bekommt das Frontend frueh `processing` plus `jobId`
   - parallel wird sofort ein `processing`-Status gespeichert

3. Analyse-Beschaffung
   - Jina Reader fuer sauberen Seitentext
   - Raw HTML Fetch fuer direkte HTML-Signale
   - Google PageSpeed mit Retry
   - Sitemap Index plus Fallback

4. Analyse-Interpretation
   - technische und inhaltliche Signale extrahieren
   - kommerzielle Keywords mit GPT erzeugen
   - SERP-Positionen via Google CSE pruefen
   - Journey-Schritte und Revenue Gap bauen
   - strategische Story mit GPT schreiben

5. Delivery
   - Frontend-Payload bauen
   - Ergebnis in static data speichern
   - optionaler Auto-Mail-Versand nur wenn Start-Request bereits eine E-Mail mitgibt

6. Report-Versand nach Ergebnis
   - `email_capture` liest das gespeicherte Audit per `jobId`
   - wenn `done`: E-Mail-HTML generieren und Report per SMTP senden
   - wenn `processing`: sauberen Status zurueckgeben statt Audit neu zu starten

7. Statusabfrage
   - zweiter Webhook liest `jobId`
   - gibt `processing`, `done` oder `error` zurueck

## Readiness-Kompatibilität

Falls dieser Workflow den bestehenden `audit-consultation`-Pfad übernimmt, wird Readiness über `meta.intake_variant == "readiness_diagnosis"` geroutet.

Der Payload muss gegen `automations/n8n/data-models/readiness-diagnosis-payload.v1.contract.json` validiert werden. Ohne `delivery` darf der Branch keinen Klarnamen, keine Telefonnummer und keine E-Mail erwarten.

## Fail States

- Request ungueltig
- PageSpeed liefert Fehler
- Analyse bricht nach `Respond OK` hart ab und Job bleibt auf `processing`
- OpenAI liefert unbrauchbares JSON
- Google CSE antwortet leer oder fehlerhaft
- SMTP faellt aus

## Aktuelle Sollbruchstellen

- Frontend nutzt fuer `email_capture` noch denselben Start-Webhook statt eines eigenen Report-Endpunkts
- Polling kennt jetzt `processing`, aber spaete harte Fehler koennen weiterhin unsauber enden
- Ergebnis-Storage basiert auf workflow static data statt auf einer stabilen Job-Queue oder Datenbank
