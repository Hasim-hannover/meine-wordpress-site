# Live Status

Stand: 2026-03-09.

Basis dieses Status:

- Repo-Inhalt
- bestehende Deploy-Workflows
- vorhandene Template- und Funnel-Logik

Nicht verifiziert:

- exakte Live-Konfiguration in WordPress-Admin
- exakte n8n-, GTM-, GA4-, Consent- und CRM-Setups

## Live

- `blocksy-child/` ist der deploybare Website-Code.
- Push auf `main` deployt das Theme per SSH-Rsync ueber `.github/workflows/deploy.yml`.
- Zentrale Theme-Module fuer Assets, SEO-Meta, Schema, Shortcodes, Portal und Snippets sind versioniert.
- Service-Seiten, Blog, Kategorie-Hubs, Footer-CTA und Trust-Bausteine sind im Repo.
- Der `Growth Audit` ist als Primaer-CTA systemweit verankert.
- Die aktive `Growth Audit`-Landingpage ist als versionierter Template-Shell im Repo hinterlegt.
- Der aktive Audit-Pfad nutzt ein natives Multi-Step-Formular, WordPress-REST und ein internes Audit-CRM.
- Das Client Portal existiert technisch inklusive Login- und Upload-Logik.

## In Arbeit

- Das Repo wird gerade von einem Theme-Repo zu einem Website Operating System erweitert.
- `page-wgos.php` ist fachlich zentral, aber technisch noch zu stark hardcodiert.
- Teile der Homepage- und Navigationslogik haengen noch an manuellen WordPress-Admin-Schritten.
- `audit-live.js` und die n8n-V3-Strecke liegen als versionierter Instant-Results-Layer im Repo, sind aber nicht der aktive Landing-Flow.
- CRM-, Mail- und Follow-up-Logik fuer den Audit sind jetzt im Theme sichtbar, aber SMTP/externes Routing bleiben noch offen.
- Das Client Portal arbeitet aktuell mit Mock-Daten und ist noch kein voll dokumentiertes Produktivsystem.

## Geplant

- weitere n8n-Workflow-Exporte unter `automations/n8n/workflows/`
- weitere menschlich lesbare Workflow-Doku und Flow-Maps unter `automations/n8n/docs/` und `automations/n8n/flow-maps/`
- sauberer Prompt- und Agenten-Layer fuer wiederverwendbare Arbeitskontexte
- weitere Systemdoku fuer Tracking, CRM-Routing, Offer-Logik und CTA-Inventar
- optionaler Ausbau des Growth Audit von persoenlichem Intake zu Instant-Results-Flow
- Ausbau des Decision Logs fuer strukturelle Repo- und Systementscheidungen

## Deprecated

- Legacy-Slugs `/audit/`, `/customer-journey-audit/` und `/360-audit/` werden auf `/growth-audit/` umgeleitet.
- Der `Growth Audit` ist der aktuelle Primaer-Einstieg. Ein eigenstaendiger 360-Audit als Erstkontakt ist nicht mehr die fuehrende Funnel-Logik.
- Ein WordPress-Editor-Shell als Source of Truth fuer den Audit ist nicht mehr Zielbild.
- Lose Root-Ablage fuer Playbooks, Referenz-Snippets und Content-Drafts ist nicht mehr Zielstruktur.
