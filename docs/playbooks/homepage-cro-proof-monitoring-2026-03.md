# Homepage CRO Proof Monitoring

Stand: 2026-03-11.

## Ziel

Pruefen, ob der neue Public-Proof-Layer auf der Homepage mehr qualifizierte Erstkontakte erzeugt und ob das Pilotprojekt als eigener Einstieg angenommen wird.

## Launch

- Release-Fenster: 2026-03-11
- Betroffene Module:
  - GitHub-Proof nach dem Prinzip-Block
  - ausgebauter Proof-Block rund um `E3 New Energy`
  - Pilotprojekt-Angebot nach dem Abschluss-CTA
  - Kontaktpfad mit `?focus=pilot`

## Wichtige Signale

- `cta_github_repo`
- `cta_proof_linkedin`
- `cta_proof_instagram`
- `cta_pilot_contact`
- `cta_erfolge_audit`
- `cta_footer_audit`
- Kontaktanfragen mit Fokus `pilot`

## Vorgehen in GA4 / GTM

1. Release am 2026-03-11 als Annotation oder internem Change-Log markieren.
2. Fuer Homepage-Traffic den Zeitraum 14 Tage vor Launch mit 14 und 28 Tagen nach Launch vergleichen.
3. Pruefen, ob die `data-track-action`-Werte aus dem Theme im GTM bereits als Events in die `dataLayer` oder als Click-Parameter uebernommen werden.
4. Falls nein, einen Click-Trigger auf `[data-track-action]` nachziehen und die vier neuen Actions fuer die Homepage freischalten.

## Woechentlicher Review

1. Homepage-Sessions und Engagement-Rate pruefen.
2. Klicks auf GitHub-, LinkedIn- und Pilot-CTA auswerten.
3. Anzahl der Kontaktanfragen mit Fokus `pilot` im CRM bzw. Postfach gegenpruefen.
4. Anteil der Pilot-Interessenten bewerten: ernsthafte Money-Page-Probleme, Budget-Fit, Umsetzungsfaehigkeit.
5. Notieren, ob der Proof-Block in Calls oder Mails aktiv erwaehnt wird.

## Review-Log

| Woche | Homepage Sessions | GitHub Klicks | Pilot Klicks | Pilot Anfragen | Audit Anfragen | Notizen |
| --- | --- | --- | --- | --- | --- | --- |
| KW 11 |  |  |  |  |  |  |
| KW 12 |  |  |  |  |  |  |
| KW 13 |  |  |  |  |  |  |
| KW 14 |  |  |  |  |  |  |
