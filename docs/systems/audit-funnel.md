# Audit Funnel

Stand: 2026-04-03.

Diese Doku beschreibt den aktuell aktiven Funnel rund um den `Growth Audit`.

Wichtig:

- Der aktive Funnel fuer `/growth-audit/` ist jetzt ein Instant-Results-Flow.
- Die Route rendert den Shortcode `cja_audit` und sendet erst nach explizitem Nutzerklick eine URL an n8n.
- Der fruehere 48h-Intake und `audit-live.js` liegen weiter im Repo, sind aber nicht mehr der aktive Default der Hauptroute.

## Zweck des Funnels

Der `Growth Audit` ist der wichtigste Diagnose-Einstieg des Systems.

Sein Job:

- Reibung fuer Erstkontakt senken
- die groessten Bremsen sofort sichtbar machen
- Botschaft, Proof, CTA und Anfragefuehrung priorisieren
- einen klaren naechsten Schritt nach `/kontakt/` oder Call vorbereiten

Der Funnel verkauft nicht sofort. Er schafft Klarheit und Priorisierung.

## Aktiver Flow

1. Besucher landet auf `/growth-audit/`.
2. `blocksy-child/page-audit.php` rendert die Route ueber `blocksy-child/inc/audit-page.php`, das aktiv den Shortcode `cja_audit` ausgibt.
3. Das Frontend zeigt ein einzelnes URL-Feld, einen kurzen Loading-State und danach ein Ergebnis-Dashboard.
4. `blocksy-child/assets/js/cja-audit.js` bereinigt die URL, validiert sie clientseitig und sendet `POST https://n8n.hasimuener.de/webhook/cja-analyze` mit JSON-Body `{ "url": "<bereinigte-url>" }`.
5. n8n liefert ein JSON mit `overall_score`, Modul-Scores, Detail-Items, Revenue-Summary und `quickWins`.
6. Das Frontend rendert die Analyse sofort auf der Seite und zeigt als naechsten Schritt einen CTA nach `/kontakt/`.
7. Nachgelagerte persoenliche Qualifizierung laeuft nur noch ueber Kontakt-/Call-Pfade, nicht mehr ueber einen Pflicht-CRM-Intake auf der Hauptroute.

## Nutzerseitige Inputs

Pflichtfeld:

- `url`

## Nutzerseitige Outputs

- Ergebnis-Dashboard direkt auf der Seite
- priorisierte Quick Wins
- CTA nach `/kontakt/`

## Systemseitige Outputs

- n8n-Response fuer das Dashboard
- kein Pflicht-CRM-Eintrag auf der Hauptroute

## Repo-Touchpoints

- `blocksy-child/page-audit.php`
- `blocksy-child/inc/audit-page.php`
- `blocksy-child/inc/cja-shortcode.php`
- `blocksy-child/assets/js/cja-audit.js`
- `blocksy-child/assets/css/cja-audit.css`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/inc/seo-meta.php`
- `blocksy-child/inc/org-schema.php`

## Externe Abhaengigkeiten

- n8n Webhook `https://n8n.hasimuener.de/webhook/cja-analyze`
- WordPress fuer Route, Shortcode und CTA-Ziel
- Cal.com nur fuer nachgelagerte Gespraechswege

## Nicht aktiver Repo-Layer

Im Repo liegt weiterhin ein aelterer oder alternativer Audit-Layer:

- `blocksy-child/assets/js/audit-live.js`
- `blocksy-child/assets/css/audit-results.css`
- `blocksy-child/template-parts/audit-page-shell.php`
- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`

Dieser Layer ist fachlich weiter relevant, aber derzeit nicht die aktive Landingpage-Logik der Hauptroute.

## Risiken

- Der aktive n8n-Payload-Contract ist noch nicht als vollstaendig versionierter Workflow-Export plus Flow-Map im Repo beschrieben.
- Der Legacy-48h-Intake und der aktive Instant-Results-Layer leben parallel im Repo und muessen bewusst getrennt bleiben.
- CRM- und Follow-up-Logik fuer den alten Intake bleibt im Theme vorhanden, obwohl sie auf der Hauptroute nicht mehr aktiv ist.

## Naechste sinnvolle Schritte

1. Den aktiven n8n-Workflow `cja-analyze` als Export, Doku und Flow-Map versionieren.
2. Das Response-Schema der Analyse explizit dokumentieren, damit Frontend und n8n nicht still auseinanderlaufen.
3. Entscheiden, ob der Legacy-48h-Intake fuer andere Einstiege erhalten bleibt oder repo-seitig bereinigt werden soll.
