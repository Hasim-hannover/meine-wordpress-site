# Audit Funnel

Stand: 2026-03-07. Diese Doku beschreibt den aktuell im Repo sichtbaren Funnel. Die exakte n8n-Implementierung liegt noch nicht versioniert vor.

## Zweck des Audit-Funnels

Der Audit-Funnel ist der wichtigste Einstieg in das System.

Sein Job:

- Reibung fuer Erstkontakt senken
- eine schnelle, glaubwuerdige Diagnose liefern
- Problemverstaendnis vor Sales-Gespraech erzeugen
- qualifizierte Interessenten in den `360° Deep-Dive` ueberfuehren

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

- fast alle starken CTAs fuehren auf `/customer-journey-audit/`

## Flow-Schritte

1. Besucher landet auf dem `Customer Journey Audit`.
2. Das Formular fragt mindestens eine URL ab.
3. `blocksy-child/assets/js/audit-live.js` sendet die URL an den n8n-Webhook `audit`.
4. Das Frontend pollt `audit-status` bis Ergebnis oder Timeout.
5. Nach erfolgreicher Rueckgabe rendert das Frontend:
   - Domain- und Meta-Header
   - Score Cards
   - Journey Steps
   - Revenue Gap
   - strategische Einordnung
6. Optional kann der Nutzer den Report per E-Mail anfordern.
7. Danach erscheint die Bridge zum `360° Deep-Dive`.
8. Der Deep-Dive sammelt weitere Qualifizierungsdaten ueber Fluent Forms.
9. Alternativ kann direkt ein Strategiecall ueber Cal.com gebucht werden.

## Inputs

Pflicht-Input:

- Website-URL

Optionale Inputs im Funnel:

- E-Mail fuer den Report
- Deep-Dive-Antworten im zweiten Schritt

Implizite Inputs aus dem Backend-Contract:

- `jobId` fuer Status-Polling
- Ergebnis-Payload aus n8n

## Erwartete Output-Struktur aus n8n

Aus `audit-live.js` laesst sich dieser Payload-Contract ableiten:

| Feld | Bedeutung |
| --- | --- |
| `meta.domain` | analysierte Domain |
| `meta.branche` | erkannte oder gesetzte Branche |
| `meta.standort` | erkannter oder gesetzter Standort |
| `performance.mobileScore` | Lighthouse- oder Performance-Score mobil |
| `serpResults[]` | Keyword-Sichtbarkeit und Wettbewerbsfundstellen |
| `journeySteps[]` | Journey-Abschnitte mit Status, Details und Summary |
| `revenue.totalLostTraffic` | geschaetzter verlorener Traffic |
| `revenue.conversionRate` | angenommene Conversion Rate |
| `revenue.kundenwert` | angenommener Kundenwert |
| `revenue.lostRevenueMonth` | geschaetzter Monatsverlust |
| `revenue.lostRevenueYear` | geschaetzter Jahresverlust |
| `story` | strategische Einordnung in Textform |

## Outputs

Nutzerseitige Outputs:

- sichtbare Audit-Auswertung auf der Landingpage
- E-Mail-Versand des Reports
- CTA in den `360° Deep-Dive`
- optionaler Direkt-Call ueber Cal.com

Systemseitige Outputs:

- `jobId` wird in den Deep-Dive uebergeben
- Qualifizierungsdaten koennen spaeter an CRM oder Follow-up-Logik gehen

## CTA-Bridge

Die CTA-Bridge ist bewusst gestuft.

Logik:

- Stufe 1: Erst Diagnose zeigen
- Stufe 2: dann auf die Grenzen der Schnell-Analyse hinweisen
- Stufe 3: Deep-Dive als persoenliche Ursachenanalyse anbieten
- Stufe 4: Direkt-Call nur als Alternative, nicht als erzwungener Standard

Das ist fachlich richtig, weil:

- der Report Interesse und Vertrauen erzeugt
- der Deep-Dive echte Qualifizierung bringt
- ein Call ohne Kontext zu frueh waere

## Repo-Touchpoints

- `blocksy-child/page-audit.php`
- `blocksy-child/assets/js/audit-live.js`
- `blocksy-child/assets/css/audit.css`
- `blocksy-child/assets/css/audit-results.css`
- `blocksy-child/page-360-deep-dive.php`

## Abhaengigkeiten

- n8n Cloud Webhooks
- Fluent Forms fuer den Deep-Dive
- Cal.com fuer direkte Termine
- WordPress-Editor fuer den eigentlichen Audit-Page-Content

## Risiken

- Die kritische Backend-Logik liegt aktuell nicht versioniert im Repo.
- Die Webhook-URLs sind hart in `audit-live.js` hinterlegt.
- Es gibt keinen im Repo dokumentierten Fallback fuer n8n-Ausfall ausser Timeout und Fehlermeldung.
- Der Ergebnis-Contract ist nur implizit durch Frontend-Code beschrieben, nicht als Datenmodell fixiert.
- CRM-, Mail- und Follow-up-Logik sind im Repo nicht nachvollziehbar.
- Revenue-Gap-Berechnung arbeitet mit Annahmen, die transparent dokumentiert werden muessen.
- Der Funnel haengt an mehreren externen Systemen, deren Live-Status hier nicht geprueft werden kann.

## Aktuelle Einstufung

- Frontend-Strecke: live-tauglich
- Gesamtsystem als Repo-Source-of-Truth: refactor-beduerftig

Begruendung:

- Der sichtbare Funnel ist klar und conversion-logisch sauber.
- Ohne versionierte n8n-Workflows fehlt aber ein kritischer Teil des technischen Systems im Repo.

## Verbesserungslogik

- n8n-Workflows exportieren und unter `automations/n8n/workflows/` versionieren.
- Fuer jeden Workflow eine Doku mit Trigger, Business-Logik, Datenlogik, Delivery-Logik und Risiken anlegen.
- Webhook-URLs konfigurierbar machen statt hart im Frontend zu halten.
- Einen dokumentierten Payload-Contract als Datenmodell einfuehren.
- Fail-States definieren: n8n down, leere Ergebnisse, Teilfehler, langsame Analyse, doppelter Submit.
- CRM- und Follow-up-Uebergabe dokumentieren.
- Status- und Conversion-Events im Tracking-Layer sauber abbilden.
