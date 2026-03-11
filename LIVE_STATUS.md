# Live Status

Stand: 2026-03-11.

Basis dieses Status:

- Repo-Inhalt
- bestehende Deploy-Workflows
- vorhandene Template- und Funnel-Logik

Nicht verifiziert:

- exakte Live-Konfiguration in WordPress-Admin
- exakte n8n-, GTM-, GA4-, Consent- und CRM-Setups

## Live

- `blocksy-child/` ist der deploybare Website-Code.
- Push auf `main` und `hotfix/*` deployt das Theme per SSH-Rsync ueber `.github/workflows/deploy.yml`; zusaetzlich ist ein manueller Start per GitHub Actions moeglich.
- Zentrale Theme-Module fuer Assets, SEO-Meta, Schema, Shortcodes, Portal und Snippets sind versioniert.
- Die Homepage nutzt jetzt einen versionierten Public-Proof-Layer aus GitHub-Transparenz, ausgebautem E3-Proof und einem Pilotprojekt-CTA mit direktem Kontaktpfad.
- Service-Seiten, Blog, Kategorie-Hubs, Footer-CTA und Trust-Bausteine sind im Repo.
- Der `Growth Audit` ist als Primaer-CTA systemweit verankert.
- Die aktive `Growth Audit`-Landingpage ist als versionierter Template-Shell im Repo hinterlegt.
- `page-wgos.php` ist als kompaktere WGOS-Sales-Page versioniert: Hero mit Audit-CTA, System-Diagramm, frueher platzierte Pakete, modulare Cards und reduzierte FAQ.
- Der aktive Audit-Pfad nutzt ein natives Multi-Step-Formular, WordPress-REST und ein internes Audit-CRM.
- Die Kontaktseite kann Pilotprojekt-Anfragen jetzt ueber `?focus=pilot` vorqualifiziert aufnehmen.
- Das Client Portal existiert technisch inklusive Login- und Upload-Logik.

## In Arbeit

- Das Repo wird gerade von einem Theme-Repo zu einem Website Operating System erweitert.
- `page-wgos.php` bleibt template-driven; eine spaetere Auslagerung des Content-Layers in Editor oder ACF ist weiter offen.
- WGOS Asset-Detailseiten laufen jetzt über den hierarchischen CPT `wgos_asset` mit ACF-Meta und Single-Template; die redaktionelle Befüllung der Spokes passiert weiter im WordPress-Admin.
- WGOS-Assets sind jetzt zusätzlich als versionierte Registry im Theme definiert: 35 Assets, alle auf `publish`.
- Die neue WGOS-Asset-Struktur rendert 8 feste Abschnitte, versionierte SEO-Meta, Related-Links und `Service`-Schema aus derselben Registry.
- Die WGOS Systemlandkarte wird jetzt bei Bedarf automatisch als Seite angelegt und listet alle Assets zusätzlich in einer festen, gruppierten Hub-Ansicht.
- Die eigentliche Post-Erstellung und Aktualisierung für WGOS-Assets hängt aktuell noch am neuen Theme-Sync und damit am nächsten Deployment auf die Live-Umgebung.
- Teile der Homepage- und Navigationslogik haengen noch an manuellen WordPress-Admin-Schritten.
- Die Community-Signale auf der Homepage sind derzeit ueber GitHub und ein oeffentliches LinkedIn-Profil versioniert; ein kanonischer Facebook-Link inklusive belastbarer Kennzahl ist im Repo noch nicht hinterlegt.
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
- Der `Growth Audit` ist der aktuelle und oeffentliche Primaer-Einstieg. Vertiefte Folgeanalysen sind kein eigenstaendiger Erstkontakt mehr, sondern ergeben sich erst nach Audit und persoenlichem Kontakt.
- Ein WordPress-Editor-Shell als Source of Truth fuer den Audit ist nicht mehr Zielbild.
- Lose Root-Ablage fuer Playbooks, Referenz-Snippets und Content-Drafts ist nicht mehr Zielstruktur.
