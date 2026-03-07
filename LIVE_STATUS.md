# Live Status

Stand: 2026-03-07.

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
- Der `Customer Journey Audit` ist als Primaer-CTA systemweit verankert.
- Das Frontend fuer den Audit mit n8n-Polling liegt im Repo und ist produktionsnah integriert.
- Der aktuelle WordPress-Editor-Shell-Code der Audit-Seite ist jetzt als Referenz dokumentiert, wird aber weiterhin manuell im Editor gepflegt.
- Das Client Portal existiert technisch inklusive Login- und Upload-Logik.

## In Arbeit

- Das Repo wird gerade von einem Theme-Repo zu einem Website Operating System erweitert.
- `page-wgos.php` ist fachlich zentral, aber technisch noch zu stark hardcodiert.
- Teile der Homepage- und Navigationslogik haengen noch an manuellen WordPress-Admin-Schritten.
- Der Audit-Funnel ist jetzt als versionierter n8n-Bestand im Repo dokumentiert, aber architektonisch noch nicht sauber getrennt.
- Das Zusammenspiel aus WordPress-Editor-Content und Repo-Doku ist noch nicht vollstaendig systematisiert.
- Das Client Portal arbeitet aktuell mit Mock-Daten und ist noch kein voll dokumentiertes Produktivsystem.

## Geplant

- weitere n8n-Workflow-Exporte unter `automations/n8n/workflows/`
- weitere menschlich lesbare Workflow-Doku und Flow-Maps unter `automations/n8n/docs/` und `automations/n8n/flow-maps/`
- sauberer Prompt- und Agenten-Layer fuer wiederverwendbare Arbeitskontexte
- weitere Systemdoku fuer Tracking, CRM-Routing, Offer-Logik und CTA-Inventar
- Ausbau des Decision Logs fuer strukturelle Repo- und Systementscheidungen

## Deprecated

- Legacy-Slugs `/360-audit/` und `/growth-audit/` werden auf `/customer-journey-audit/` umgeleitet.
- Der `Customer Journey Audit` ist der aktuelle Primaer-Einstieg. Ein eigenstaendiger 360-Audit als Erstkontakt ist nicht mehr die fuehrende Funnel-Logik.
- Lose Root-Ablage fuer Playbooks, Referenz-Snippets und Content-Drafts ist nicht mehr Zielstruktur.
