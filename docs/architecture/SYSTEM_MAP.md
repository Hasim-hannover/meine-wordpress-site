# System Map

Stand: 2026-03-20. Diese Karte basiert auf dem Repo-Inhalt, nicht auf einer Live-Verifikation externer Systeme.

## Hauptsysteme

| System | Zweck | Repo-Orte | Externe Abhaengigkeiten | Status |
| --- | --- | --- | --- | --- |
| Website | deploybarer WordPress-Theme-Code | `blocksy-child/`, `.github/workflows/deploy.yml` | WordPress, Blocksy Parent Theme, ACF | live |
| Audit-Funnel | Diagnose-Einstieg, Audit-Intake und interne Folgequalifizierung | `blocksy-child/page-audit.php`, `blocksy-child/template-parts/audit-page-shell.php`, `blocksy-child/page-solar-waermepumpen-leadgenerierung.php`, `blocksy-child/page-website-fuer-solar-und-waermepumpen-anbieter.php`, `blocksy-child/assets/js/review-funnel.js`, `blocksy-child/assets/js/energy-intake.js`, `blocksy-child/assets/js/cal-embed.js`, `blocksy-child/inc/review-crm.php`, `blocksy-child/page-360-deep-dive.php`, `docs/systems/audit-funnel.md` | WordPress REST, wp_mail, Cal.com, optional n8n | live |
| Nexus CRM & Blog Notify | gemeinsames CRM fuer Audit-, Folgeanalyse-, Umsetzungs- und Bestandskunden-Anfragen plus DOI- und Artikel-Mail-Logik | `blocksy-child/inc/crm.php`, `blocksy-child/inc/blog-notify.php`, `blocksy-child/template-parts/blog-notify.php`, `blocksy-child/page-blog-notify.php`, `docs/systems/blog-notify.md` | WordPress CPT/Meta, WordPress REST, wp_mail, Brevo | repo-seitig live, End-to-End offen |
| SEO Cockpit | Search-Console-basiertes SEO-Dashboard mit optionaler Koko-Erkennung | `blocksy-child/inc/seo-cockpit.php`, `blocksy-child/assets/css/seo-cockpit-admin.css`, `docs/systems/seo-cockpit.md` | Google Search Console API, optional Koko Analytics | repo-seitig vorbereitet, OAuth und Live-Daten offen |
| Tracking | Tracking-ready Markup, CTA-Events, SEO-/Schema-Layer | `blocksy-child/inc/helpers.php`, `blocksy-child/inc/seo-meta.php`, `blocksy-child/inc/org-schema.php`, Templates mit `data-track-*` | GTM, sGTM, GA4, Consent Mode v2, Meta CAPI | teils im Repo, teils extern |
| CTA- und Leadflow | CTA-Hierarchie vom ersten Besuch bis zur Diagnose, Folgeeinordnung und Qualifizierung | `blocksy-child/inc/shortcodes.php`, `blocksy-child/template-parts/footer-cta.php`, `blocksy-child/template-parts/trust-section.php`, Service-Templates | WordPress-Editor, Audit-Funnel, Cal.com, CRM | live |
| Public Proof Layer | zentraler oeffentlicher Proof- und Vokabular-Layer fuer kaufnahe Seiten | `blocksy-child/inc/helpers.php`, `blocksy-child/inc/shortcodes.php`, `blocksy-child/front-page.php`, `blocksy-child/page-wordpress-agentur.php`, `blocksy-child/page-wgos.php`, `blocksy-child/page-kontakt.php`, `blocksy-child/inc/contact-page.php` | WordPress-Editor, oeffentliche Cases und Profile | live |
| Content- und SEO-System | Blog, Pillar-Hubs, Cornerstone-Content, interne Verlinkung | `blocksy-child/category.php`, `blocksy-child/single.php`, `blocksy-child/page-seo-cornerstone.php`, `content/blog-drafts/` | WordPress-Editor | live plus Ausbau |
| Client Portal | Kunden-Cockpit mit Login, Upload und Roadmap-Slots | `blocksy-child/template-portal.php`, `blocksy-child/inc/client-portal.php`, `blocksy-child/inc/snippets.php` | WordPress-User-System, Media Library | live, aber aktuell mit Mock-Daten |
| n8n-Automationen | Workflow-Logik fuer Analyse, Routing, Reporting, Nurture | kuenftig `automations/n8n/` | n8n Cloud, CRM, Mail, evtl. Sheets | geplant als versionierter Layer |
| Agenten- und Prompt-System | Kontext, Guardrails, Skills und minimale Legacy-Briefings | `AGENTS.md`, `agents/skills/`, `prompts/README.md` | keine direkte Laufzeitabhaengigkeit | in Aufbau |

## Website

Die Website ist aktuell der stabilste Teil des Repos. `blocksy-child/` ist der deploybare Kern und wird bei Push auf `main` per SSH-Rsync nach WordPress ausgeliefert.

Wichtige Merkmale:

- `functions.php` laedt die Module aus `inc/` zentral.
- `inc/enqueue.php` ist der Asset-Hub fuer CSS und JS pro Seitentyp.
- Ein Teil der Seiten ist editor-getrieben und nutzt `the_content()`.
- Ein anderer Teil ist hart codiert und traegt Business-Logik direkt im Template.
- `page-wgos.php` ist als template-getriebene Sales-Page fuer `WGOS = WordPress Growth Operating System` versioniert; Struktur, erklaerter Framework-Kontext und CTA-Hierarchie liegen im Repo, nicht im Editor.
- Die Homepage-Shortcodes liefern jetzt einen versionierten Public-Proof-Layer aus konservativen Leistungsmetriken, GitHub-Transparenz und audit-first Folgelogik statt Pilotangebot.

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
3. Die aktive Audit-Landingpage sammelt Seite plus Kontext ueber ein natives Multi-Step-Formular.
4. Die Branchen-Landingpage fuer Solar-/Waermepumpen-Anbieter nutzt denselben Request-Stack mit eigenem, branch-faehigem Multi-Step-Intake und serverseitigem Fallback.
5. WordPress speichert die Anfrage direkt im internen Audit-CRM und versendet Benachrichtigungen ueber `wp_mail`.
6. Danach folgt bei Bedarf ein vertiefter Folgeschritt, aber erst nach der persoenlichen Rueckmeldung und direktem Kontakt.
7. Alternative direkte Eskalation: `Cal.com`-Call ueber `https://cal.com/hasim-uener/30min?overlayCalendar=true`.
8. Direkte Gespraechs-CTAs bleiben als normale Links erhalten, werden im Frontend aber per `blocksy-child/assets/js/cal-embed.js` zu einem Modal-Embed im Seitenkontext erweitert.
9. `audit-live.js` bleibt als vorbereiteter Instant-Results-Layer im Repo, ist aber nicht der aktive Default-Flow.

## Nexus CRM und Blog Notify

Das Repo enthaelt jetzt zusaetzlich ein gemeinsames CRM-Modell fuer:

- Audit-Anfragen
- Folgeanalyse-, Umsetzungs- und Weiterentwicklungs-Anfragen
- Blog-Abos

Architektur:

- `nexus_review_request` bleibt der spezialisierte Datensatz fuer Audit-Intake
- `nexus_contact` ist der gemeinsame Kontakt-Datensatz fuer kontaktnahe Folgeanliegen und Blog-Abos
- das Admin-Menue heisst jetzt `Nexus CRM`
- Blog-Abos arbeiten mit eigenem DOI- und Abmelde-Flow ueber `/neue-artikel-per-email/`
- Artikel-Benachrichtigungen werden in V1 manuell pro Beitrag angestossen und dann in kleinen Batches versendet

## Tracking

Das Repo ist tracking-ready, aber nicht tracking-vollstaendig.

Im Repo vorhanden:

- `data-track-*` Attribute auf CTAs und Content-Bausteinen
- noindex- und SEO-Meta-Logik
- Schema-Ausgabe fuer Organisation, Services und Profile
- neue Homepage-Actions fuer Trust und Einstiegsangebote: `cta_github_repo`, `cta_proof_linkedin`

Ausserhalb des Repos:

- GTM / sGTM Container
- Consent Management
- GA4 Property und Event-Routing
- Meta CAPI
- CRM-Felder und Attribution

Systemische Grenze:

- Repo = Markup, Hooks, Dokumentation.
- Externe Plattformen = operative Konfiguration.

## SEO Cockpit

Neu im Repo:

- eigener Admin-Bereich `SEO Cockpit`
- kompaktes Snapshot-Widget im WordPress-Dashboard
- Search-Console-Anbindung per OAuth-Flow direkt im Theme
- gecachte Kernmetriken fuer Klicks, Impressionen, CTR, Position, Top Pages und Top Queries
- automatischer Snapshot-Refresh per WP-Cron
- optionale Koko-Erkennung als lokaler Traffic-Layer fuer spaetere Zusammenfuehrung

Systemische Rolle:

- Search Console liefert die externe SEO-Sicht
- Koko soll spaeter die lokale Seiten- und Traffic-Sicht liefern
- WordPress bleibt der Ort, an dem beide Perspektiven in einem operativen Cockpit zusammenlaufen

## CTA- und Leadflow

Die CTA-Hierarchie ist klar und sollte nicht verwischt werden.

- Primaerer CTA: `Growth Audit`
- Sekundaerer CTA: `WGOS verstehen`, `Case Studies ansehen`
- Folgeeinstieg nur nach Diagnose: `Fokussierte Folgeanalyse`
- Umsetzungsnahe Kontaktwege: `Umsetzung / Optimierung`, `Laufende Weiterentwicklung`
- Kein oeffentlicher 360-/Blueprint-CTA mehr im Erstkontakt
- Eskalations-CTA: `Cal.com`-Strategiecall
- Zentrale Default-URL fuer direkte Gespraechsbuchung: `https://cal.com/hasim-uener/30min?overlayCalendar=true`
- Direkte Gespraechsbuchung wird repo-seitig als progressive Enhancement umgesetzt: Modal bei aktivem JS, normaler Link als Fallback.
- Utility-CTA: Kunden-Portal fuer Bestandskunden

Wichtige Repopunkte:

- `blocksy-child/template-parts/footer-cta.php`
- `blocksy-child/template-parts/trust-section.php`
- `blocksy-child/inc/shortcodes.php`
- `blocksy-child/page-kontakt.php`
- `blocksy-child/inc/contact-page.php`
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

- Website -> CTA-Layer -> Growth Audit -> persoenliche Rueckmeldung -> Folgeprozess / CRM / Sales
- Website -> Tracking-Layer -> GTM / GA4 / Consent -> Reporting / Optimierung
- Blog / SEO -> interne Verlinkung -> Service-Seiten / Audit -> Leadflow
- WordPress-Editor -> Theme-Struktur -> Live-Seiten
- GitHub Actions -> `blocksy-child/` -> Live-Theme

## Kritische Abhaengigkeiten

- WordPress Block-Editor fuer editorgetriebene Seiten ausserhalb des Audit-Shells
- ACF fuer SEO- und Content-Fallbacks
- Theme-eigener SEO-Layer (seo-meta.php) für Title, Description, OG, Canonical und Robots
- Native WordPress-Sitemap (/wp-sitemap.xml)
- Fluent Forms fuer die vertiefte Folgeanalyse
- n8n Cloud fuer den optionalen Instant-Results-Audit
- Cal.com fuer direkte Gespraechsbuchung
- SSH-Deploy auf Basis von `blocksy-child/`

## Groesste Risiken

- `page-wgos.php` ist fachlich wichtig und inzwischen deutlich verschlankt, bleibt aber technisch template-driven statt editor- oder ACF-getrieben.
- Kaufnahe Inhalte liegen weiter teils im Repo und teils im WordPress-Editor; Titel, Excerpts, Karten und manuell kuratierte Related-Module koennen die neue Proof- und Tonalitaetslogik unterlaufen, wenn sie nicht separat gepflegt werden.
- `audit-live.js` haengt an harten Webhook-URLs und an einem impliziten n8n-Payload-Contract, solange der Instant-Results-Flow nicht voll aktiviert ist.
- Tracking-, Consent- und CRM-Logik sind operativ relevant, aber noch nicht als Repo-System dokumentiert.
- Manuelle WordPress-Admin-Schritte existieren noch als Betriebswissen und muessen weiter systematisiert werden.
