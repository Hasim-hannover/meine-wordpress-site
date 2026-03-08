# Audit Funnel

Stand: 2026-03-07. Diese Doku beschreibt den aktuell im Repo sichtbaren Funnel inklusive des jetzt versionierten Audit-Workflows.

Update:

- Der aktuelle n8n-Workflow liegt jetzt als bereinigter V2-Export im Repo.
- Siehe `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`.
- Die Betriebsdoku liegt unter `automations/n8n/docs/audit-funnel__customer-journey-audit__refactor.md`.
- Der aktuelle WordPress-Editor-Layer ist jetzt separat dokumentiert.
- Siehe `docs/systems/audit-page-editor-layer.md`.

## Zweck des Audit-Funnels

Der Audit-Funnel ist der wichtigste Einstieg in das System.

Sein Job:

- Reibung fuer Erstkontakt senken
- eine schnelle, glaubwuerdige Diagnose liefern
- Problemverstaendnis vor Sales-Gespraech erzeugen
- qualifizierte Interessenten in eine Beratung ueberfuehren

Der Funnel verkauft nicht sofort. Er beweist Kompetenz, macht Luecken sichtbar und baut die Bruecke zum naechsten qualifizierten Schritt.

## Einstieg

Wichtige Einstiegspunkte in den Funnel:

- Homepage
- WGOS-Seite
- Service-Landings
- Blog-Artikel
- Kategorie-Hubs
- About-Seite
- 404-Seite

Primaerer Zielpfad:

- fast alle starken CTAs fuehren auf `/growth-audit/`

## Flow-Schritte

1. Besucher landet auf dem `Growth Audit`.
2. Das Formular fragt mindestens eine URL ab.
3. `blocksy-child/assets/js/audit-live.js` sendet die URL an den n8n-Webhook `audit`.
4. Das Frontend pollt `audit-status` bis Ergebnis oder Timeout.
5. Nach erfolgreicher Rueckgabe rendert das Frontend:
   - Domain- und Meta-Header
   - Kurzdiagnose
   - Top-3-Bremsen
   - Potenzial-Spanne
   - Detail-Sektionen
   - strategische Einordnung
6. Danach erscheint direkt ein nativer CTA fuer eine Beratung.
7. Die Beratungsanfrage geht ueber einen eigenen Webhook raus.
8. Alternativ kann direkt ein Strategiecall ueber Cal.com gebucht werden.

## Inputs

Pflicht-Input:

- Website-URL

Implizite Inputs aus dem Backend-Contract:

- `jobId` fuer Status-Polling
- Ergebnis-Payload aus n8n

## Erwartete Output-Struktur aus n8n

Das V3-Zielbild im Repo nutzt diesen Payload-Contract:

| Feld | Bedeutung |
| --- | --- |
| `meta.domain` | analysierte Domain |
| `meta.branche` | erkannte oder gesetzte Branche |
| `meta.standort` | erkannter oder gesetzter Standort |
| `verdict` | unmittelbare Diagnose mit Headline und Subline |
| `highlights[]` | drei schnelle Signal-Karten |
| `findings[]` | priorisierte Hauptbremsen mit Belegen |
| `opportunity.rangeMonth` | Potenzial-Spanne pro Monat |
| `opportunity.rangeYear` | Potenzial-Spanne pro Jahr |
| `details.sections[]` | Belege aus Markt, Technik, Vertrauen und Conversion |
| `story` | strategische Einordnung in Textform |
| `cta` | Beratungs-CTA mit Primary/Secondary-Option |

## Outputs

Nutzerseitige Outputs:

- sichtbare Audit-Auswertung auf der Landingpage
- CTA in die Beratung
- optionaler Direkt-Call ueber Cal.com

Systemseitige Outputs:

- `jobId` kann in die Beratungsanfrage uebergeben werden
- Beratungsdaten koennen spaeter an CRM oder Follow-up-Logik gehen

## CTA-Bridge

Die CTA-Bridge ist bewusst gestuft, aber schlanker als zuvor.

Logik:

- Stufe 1: Erst Diagnose zeigen
- Stufe 2: dann auf die Grenzen der Schnell-Analyse hinweisen
- Stufe 3: Beratung als persoenliche Priorisierung anbieten
- Stufe 4: Direkt-Call nur als Alternative, nicht als erzwungener Standard

Das ist fachlich richtig, weil:

- die Diagnose Interesse und Vertrauen erzeugt
- die Beratung echte Qualifizierung bringt
- ein Call ohne Kontext zu frueh waere

## Repo-Touchpoints

- `blocksy-child/page-audit.php`
- `blocksy-child/assets/js/audit-live.js`
- `blocksy-child/assets/css/audit.css`
- `blocksy-child/assets/css/audit-results.css`
- `automations/n8n/workflows/audit-funnel__instant-results__target.json`
- `automations/n8n/data-models/audit-frontend-payload.v3.contract.json`
- `docs/systems/audit-page-editor-layer.md`
- `docs/references/audit-page-editor-snippet-v3.html`

## Abhaengigkeiten

- n8n Cloud Webhooks
- nativer Beratungs-CTA im Frontend
- Brevo SMTP oder CRM-Weiterleitung fuer Beratungsanfragen
- Cal.com fuer direkte Termine
- WordPress-Editor fuer den eigentlichen Audit-Page-Content

## Risiken

- Die kritische Backend-Logik ist jetzt versioniert, aber noch nicht sauber in Analyse-, Delivery- und Fehlerpfade getrennt.
- Der V2-Workflow im Repo behebt den bisherigen Contract-Bruch zwischen URL-only-Start und n8n-Validierung, ist aber erst nach Import in die Live-n8n-Instanz wirksam.
- Die Webhook-URLs sind trotz Localize-Config weiterhin externe Abhaengigkeiten.
- Es gibt keinen im Repo dokumentierten Fallback fuer n8n-Ausfall ausser Timeout und Fehlermeldung.
- Der Live-Workflow ist noch nicht auf den V3-Contract umgestellt.
- Der funktionale Audit-Seitenrahmen lebt teilweise im WordPress-Editor und liegt damit ausserhalb des eigentlichen Deploy-Pfads.
- CRM-, Mail- und Follow-up-Logik sind im Repo nicht nachvollziehbar.
- Revenue-Gap-Berechnung arbeitet mit Annahmen, die transparent dokumentiert werden muessen.
- Der Funnel haengt an mehreren externen Systemen, deren Live-Status hier nicht geprueft werden kann.

## Aktuelle Einstufung

- Frontend-Strecke: live-tauglich
- Gesamtsystem als Repo-Source-of-Truth: refactor-beduerftig

Begruendung:

- Der sichtbare Funnel ist klar und conversion-logisch sauber.
- Der Workflow ist jetzt versioniert, aber noch nicht konsistent genug fuer ein sauberes Operating System.

## Verbesserungslogik

- weitere n8n-Workflows exportieren und unter `automations/n8n/workflows/` versionieren.
- Fuer jeden Workflow eine Doku mit Trigger, Business-Logik, Datenlogik, Delivery-Logik und Risiken anlegen.
- Webhook-URLs ueber Theme-Konfiguration und nicht nur ueber Defaults steuern.
- Den V3-Payload-Contract zum Live-Standard machen.
- Fail-States definieren: n8n down, leere Ergebnisse, Teilfehler, langsame Analyse, doppelter Submit.
- CRM- und Follow-up-Uebergabe dokumentieren.
- Status- und Conversion-Events im Tracking-Layer sauber abbilden.
