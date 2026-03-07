# Flow Map - Audit Funnel - Customer Journey Audit

## Trigger

- `POST /webhook/audit`
- `GET /webhook/audit-status`

## Ablauf

1. Intake
   - Webhook nimmt Request an
   - Validator prueft URL, E-Mail, SSRF und Rate Limit
   - `jobId` wird erzeugt

2. Sofortantwort
   - Frontend bekommt frueh `processing` plus `jobId`

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
   - E-Mail-HTML generieren
   - Report per SMTP versenden

6. Statusabfrage
   - zweiter Webhook liest `jobId`
   - gibt `processing`, `done` oder `error` zurueck

## Fail States

- Request ungueltig
- PageSpeed liefert Fehler
- Sitemap Index leer, Fallback nicht sauber genutzt
- OpenAI liefert unbrauchbares JSON
- Google CSE antwortet leer oder fehlerhaft
- SMTP faellt aus
- Analyse scheitert nach `Respond OK`, aber vor `Store Results`

## Aktuelle Sollbruchstellen

- Frontend sendet initial keine E-Mail, Workflow erwartet eine
- E-Mail-Capture brancht nicht separat
- Polling kennt keinen sauberen Zwischen- oder Fehlerstatus aus der Analyse
- Ergebnis-Storage basiert auf workflow static data statt auf einer stabilen Job-Queue oder Datenbank
