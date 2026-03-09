# System Map

Stand: 2026-03-09. Diese Karte basiert auf dem Repo-Inhalt, nicht auf einer Live-Verifikation externer Systeme.

## Hauptsysteme

| System | Zweck | Repo-Orte | Externe Abhaengigkeiten | Status |
| --- | --- | --- | --- | --- |
| Website | deploybarer WordPress-Theme-Code | `blocksy-child/`, `.github/workflows/deploy.yml` | WordPress, Blocksy Parent Theme, ACF, Rank Math | live |
| Audit-Funnel | Diagnose-Einstieg, Audit-Intake, Blueprint-Qualifizierung | `blocksy-child/page-audit.php`, `blocksy-child/template-parts/audit-page-shell.php`, `blocksy-child/assets/js/review-funnel.js`, `blocksy-child/inc/review-crm.php`, `blocksy-child/page-360-deep-dive.php`, `docs/systems/audit-funnel.md` | WordPress REST, wp_mail, Cal.com, optional n8n | live |
| Tracking | Tracking-ready Markup, CTA-Events, SEO-/Schema-Layer | `blocksy-child/inc/helpers.php`, `blocksy-child/inc/seo-meta.php`, `blocksy-child/inc/org-schema.php`, Templates mit `data-track-*` | GTM, sGTM, GA4, Consent Mode v2, Meta CAPI | teils im Repo, teils extern |
| CTA- und Leadflow | CTA-Hierarchie vom ersten Besuch bis zur Qualifizierung | `blocksy-child/inc/shortcodes.php`, `blocksy-child/template-parts/footer-cta.php`, `blocksy-child/template-parts/trust-section.php`, Service-Templates | WordPress-Editor, Audit-Funnel, Cal.com, CRM | live |
| Content- und SEO-System | Blog, Pillar-Hubs, Cornerstone-Content, interne Verlinkung | `blocksy-child/category.php`, `blocksy-child/single.php`, `blocksy-child/page-seo-cornerstone.php`, `content/blog-drafts/` | WordPress-Editor, Rank Math | live plus Ausbau |
| Client Portal | Kunden-Cockpit mit Login, Upload und Roadmap-Slots | `blocksy-child/template-portal.php`, `blocksy-child/inc/client-portal.php`, `blocksy-child/inc/snippets.php` | WordPress-User-System, Media Library | live, aber aktuell mit Mock-Daten |
| n8n-Automationen | Workflow-Logik fuer Analyse, Routing, Reporting, Nurture | kuenftig `automations/n8n/` | n8n Cloud, CRM, Mail, evtl. Sheets | geplant als versionierter Layer |
| Agenten- und Prompt-System | Kontext, Guardrails, wiederverwendbare Briefings | `AGENT_CONTEXT.md`, `agents/`, `prompts/`, `SKILL.md` | keine direkte Laufzeitabhaengigkeit | in Aufbau |

## Website

Die Website ist aktuell der stabilste Teil des Repos. `blocksy-child/` ist der deploybare Kern und wird bei Push auf `main` per SSH-Rsync nach WordPress ausgeliefert.

Wichtige Merkmale:

- `functions.php` laedt die Module aus `inc/` zentral.
- `inc/enqueue.php` ist der Asset-Hub fuer CSS und JS pro Seitentyp.
- Ein Teil der Seiten ist editor-getrieben und nutzt `the_content()`.
- Ein anderer Teil ist hart codiert und traegt Business-Logik direkt im Template.

Kritische Dateien:

- `blocksy-child/functions.php`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/inc/seo-meta.php`
- `blocksy-child/inc/org-schema.php`
- `blocksy-child/page-wgos.php`

## n8n-Automationen

Im Repo liegen aktuell noch keine exportierten n8n-Workflows. Die Rolle von n8n ist aber bereits sichtbar:

- versionierter Instant-Results-Layer fuer den Growth Audit
- kuenftiges Lead-Routing und Nurture
- Reporting- oder CRM-Bridges, die in Texten und Angebotslogik bereits angedeutet werden

Aktuell dokumentierter Workflow:

- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`
- Doku: `automations/n8n/docs/audit-funnel__customer-journey-audit__refactor.md`
- Flow-Map: `automations/n8n/flow-maps/audit-funnel__customer-journey-audit__refactor.md`

Bekannte technische Touchpoints:

- `blocksy-child/assets/js/audit-live.js`
- Webhooks `audit` und `audit-status`

Fachliche Regel:

- n8n-JSONs gelten nie als selbsterklaerend.
- Jeder Workflow braucht zusaetzlich Doku, Flow-Map, Status und Risiko-Abschnitt.
- Der aktuelle Audit-Workflow ist fachlich wertvoll, aber architektonisch refactor-beduerftig.

## Audit-Funnel

Der Audit-Funnel ist der Primaer-CTA des Systems.

Aktuelle Logik:

1. Besucher kommen ueber Homepage, WGOS, Service-Seiten, Blog oder Kategorie-Hubs.
2. Primaerer CTA fuehrt in den `Growth Audit`.
3. Die aktive Landingpage sammelt Seite plus Kontext ueber ein natives Multi-Step-Formular.
4. WordPress speichert die Anfrage direkt im internen Audit-CRM und versendet Benachrichtigungen ueber `wp_mail`.
5. Danach folgt der `Growth Blueprint` als zweiter Qualifizierungsschritt.
6. Alternative direkte Eskalation: `Cal.com`-Call.
7. `audit-live.js` bleibt als vorbereiteter Instant-Results-Layer im Repo, ist aber nicht der aktive Default-Flow.

## Tracking

Das Repo ist tracking-ready, aber nicht tracking-vollstaendig.

Im Repo vorhanden:

- `data-track-*` Attribute auf CTAs und Content-Bausteinen
- noindex- und SEO-Meta-Logik
- Schema-Ausgabe fuer Organisation, Services und Profile

Ausserhalb des Repos:

- GTM / sGTM Container
- Consent Management
- GA4 Property und Event-Routing
- Meta CAPI
- CRM-Felder und Attribution

Systemische Grenze:

- Repo = Markup, Hooks, Dokumentation.
- Externe Plattformen = operative Konfiguration.

## CTA- und Leadflow

Die CTA-Hierarchie ist klar und sollte nicht verwischt werden.

- Primaerer CTA: `Growth Audit`
- Sekundaerer CTA: `WGOS verstehen`, `Case Studies ansehen`
- Tertiaerer CTA: `Growth Blueprint`
- Eskalations-CTA: `Cal.com`-Strategiecall
- Utility-CTA: Kunden-Portal fuer Bestandskunden

Wichtige Repopunkte:

- `blocksy-child/template-parts/footer-cta.php`
- `blocksy-child/template-parts/trust-section.php`
- `blocksy-child/inc/shortcodes.php`
- Service- und Hub-Templates mit Audit-CTA

## Content- und SEO-System

Das Content-System ist auf Pillar- und Cluster-Logik aufgebaut.

Bausteine:

- `category.php`: Pillar-Hub mit Featured Entry Point
- `single.php`: Artikel mit TOC, Related Content und Footer-CTA
- `page-seo-cornerstone.php`: Cornerstone-Template mit starkem Entscheider-Fokus
- `content/blog-drafts/`: Rohfassungen ausserhalb von WordPress

Risiko:

- Content liegt teils im Repo, teils im WordPress-Editor.
- Ohne saubere Statuspflege kann die Source of Truth unscharf werden.

## Systemabhaengigkeiten

- Website -> CTA-Layer -> Growth Audit -> Growth Blueprint -> CRM / Sales
- Website -> Tracking-Layer -> GTM / GA4 / Consent -> Reporting / Optimierung
- Blog / SEO -> interne Verlinkung -> Service-Seiten / Audit -> Leadflow
- WordPress-Editor -> Theme-Struktur -> Live-Seiten
- GitHub Actions -> `blocksy-child/` -> Live-Theme

## Kritische Abhaengigkeiten

- WordPress Block-Editor fuer editorgetriebene Seiten ausserhalb des Audit-Shells
- ACF fuer SEO- und Content-Fallbacks
- Rank Math fuer SEO-Meta und Sitemaps
- Fluent Forms fuer den Deep-Dive
- n8n Cloud fuer den optionalen Instant-Results-Audit
- Cal.com fuer direkte Gespraechsbuchung
- SSH-Deploy auf Basis von `blocksy-child/`

## Groesste Risiken

- `page-wgos.php` ist fachlich wichtig, aber technisch ein Layer-Verstoss durch stark hardcodierten Content.
- `audit-live.js` haengt an harten Webhook-URLs und an einem impliziten n8n-Payload-Contract, solange der Instant-Results-Flow nicht voll aktiviert ist.
- Tracking-, Consent- und CRM-Logik sind operativ relevant, aber noch nicht als Repo-System dokumentiert.
- Manuelle WordPress-Admin-Schritte existieren noch als Betriebswissen und muessen weiter systematisiert werden.
