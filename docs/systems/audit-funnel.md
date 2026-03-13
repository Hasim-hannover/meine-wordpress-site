# Audit Funnel

Stand: 2026-03-11.

Diese Doku beschreibt den aktuell aktiven Funnel rund um den `Growth Audit`.

Wichtig:

- Der aktive Funnel ist kein Instant-Results-Flow.
- Die aktuelle Landingpage arbeitet als persoenlicher Audit-Intake mit Rueckmeldung in 48 Stunden.
- `audit-live.js` und die n8n-Strecke liegen weiter im Repo, sind aber aktuell nicht an den aktiven Landing-Shell gebunden.

## Zweck des Funnels

Der `Growth Audit` ist der wichtigste Diagnose-Einstieg des Systems.

Sein Job:

- Reibung fuer Erstkontakt senken
- die richtige Seite plus den richtigen Kontext einsammeln
- Botschaft, Proof, CTA und Anfragefuehrung priorisieren
- unqualifizierte Gratis-Relaunch-Anfragen filtern
- passende Leads in Rueckmeldung, Folgeprozess, Call oder Umsetzung ueberfuehren

Der Funnel verkauft nicht sofort. Er schafft Klarheit und Priorisierung.

## Aktiver Flow

1. Besucher landet auf `/growth-audit/`.
2. `blocksy-child/page-audit.php` rendert ueber `blocksy-child/inc/audit-page.php` die versionierte Shell aus `blocksy-child/template-parts/audit-page-shell.php`.
3. Das Frontend zeigt einen fokussierten nativen 4-Schritt-Flow mit:
   - konkreter Seiten-URL
   - groesstem Klaerungsbedarf
   - primaerem Ziel
   - leichtem Kontaktabschluss mit optionalem Kurzkontext
4. `blocksy-child/assets/js/review-funnel.js` validiert die Schritte und sendet die Daten an `POST /wp-json/nexus/v1/audit-request`.
5. `blocksy-child/inc/review-crm.php` prueft Honeypot, Rate Limit und Payload und speichert die Anfrage als `nexus_review_request`.
6. WordPress versendet eine interne Benachrichtigung und eine kurze Bestaetigung an den Anfragenden ueber `wp_mail`.
7. Im Backend landet der Lead im `Audit CRM` mit Status, Prioritaet, Faelligkeit und internen Notizen.
8. Danach folgt die persoenliche Rueckmeldung innerhalb von 48 Stunden.
9. Je nach Lage geht der Lead weiter in:
   - kleine Korrektur
   - vertiefte Folgeanalyse nach dem Audit
   - Umsetzung / Retainer
   - direkten Strategiecall ueber Cal.com

## Nutzerseitige Inputs

Pflichtfelder:

- `page_url`
- `focus_area`
- `primary_goal`
- `name`
- `email`

Implizite Felder:

- `audit_type=growth_audit`
- `company_website` als Honeypot
- `started_at` fuer einfaches Frontend-Timing

Optionale Felder:

- `company`
- `current_challenge`
- `linkedin`
- `extra_context`

## Nutzerseitige Outputs

- Erfolgszustand direkt auf der Seite
- Bestaetigung per E-Mail
- optionaler Direktpfad zu Cal.com

## Systemseitige Outputs

- WordPress-CPT-Eintrag `nexus_review_request`
- Metadaten zu Seite, Kontakt, Audit-Typ und Status
- interne Benachrichtigungs-Mail
- Bestaetigungs-Mail an den Lead

## Repo-Touchpoints

- `blocksy-child/page-audit.php`
- `blocksy-child/inc/audit-page.php`
- `blocksy-child/template-parts/audit-page-shell.php`
- `blocksy-child/assets/js/review-funnel.js`
- `blocksy-child/assets/js/audit.js`
- `blocksy-child/inc/review-crm.php`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/assets/css/audit.css`
- `blocksy-child/assets/css/review-funnel.css`
- `blocksy-child/inc/seo-meta.php`
- `blocksy-child/inc/org-schema.php`

## Externe Abhaengigkeiten

- WordPress REST API
- `wp_mail` / spaeter SMTP oder Mail-Bridge
- Cal.com

Optional, aber aktuell nicht aktiv im aktiven Landing-Flow:

- n8n Cloud
- `audit-live.js`
- Webhooks `audit`, `audit-status`, `audit-consultation`

## Nicht aktiver Repo-Layer

Im Repo liegt weiterhin ein vorbereiteter Instant-Results-Pfad:

- `blocksy-child/assets/js/audit-live.js`
- `blocksy-child/assets/css/audit-results.css`
- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`

Dieser Layer ist fachlich weiter relevant, aber derzeit nicht die aktive Landingpage-Logik.

## Risiken

- Mail-Versand haengt aktuell an `wp_mail`; SMTP/Brevo ist noch nicht hinterlegt.
- Der Post-Type-Slug `nexus_review_request` ist historisch und fachlich inzwischen breiter als nur `Review`.
- Der Instant-Results-Layer und der aktive 48h-Intake leben parallel im Repo und muessen bewusst getrennt bleiben.
- CRM- und Follow-up-Logik endet aktuell im WordPress-Backend; externes Routing ist noch nicht versioniert.

## Naechste sinnvolle Schritte

1. SMTP/Brevo fuer zuverlaessigen Versand anschliessen.
2. Audit-CRM um Follow-up-Felder und Delivery-Templates erweitern.
3. Entscheiden, ob `audit-live.js` spaeter den aktiven Intake ersetzt oder ein separater Angebotszweig bleibt.
