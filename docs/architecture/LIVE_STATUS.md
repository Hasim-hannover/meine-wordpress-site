# Live Status

Stand: 2026-03-20.

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
- Die versionierte Homepage priorisiert jetzt im oberen Funnel einen kompakteren Hero, einen direkten Outcome-Proof-Strip, einen scanbaren Audit-/Diagnose-Block, einen klaren Fit-Block, einen verdichteten E3-Proof mit Case-First-CTA und einen ruhigeren finalen Audit-CTA mit klaren Erwartungspunkten vor dem Knowledge-Base-Nebenpfad; mobile Scroll-CTAs fuer Audit-Einstiege sind auf den repo-seitig gesteuerten Flächen entfernt, weil der Header den Einstieg bereits abdeckt.
- Service-Seiten, Tools-Hub, Blog, Kategorie-Hubs, Footer-CTA und Trust-Bausteine sind im Repo.
- Der `Growth Audit` ist als Primaer-CTA systemweit verankert.
- Repo-seitig gibt es jetzt einen zentralen oeffentlichen Proof- und Vokabular-Layer: `1.750+ qualifizierte Leads`, `12 % Sales-Conversion` und `-83 % CPL` sind das konservative Standard-Proof-Set; `WGOS = WordPress Growth Operating System` bleibt als erklaertes Framework hinter dem oeffentlichen Hauptbegriff `WordPress als Nachfrage-System fuer B2B`.
- Der versionierte Ergebnisse-Hub priorisiert jetzt eine klarere Hero-Einordnung, schnellere Proof-Selbstselektion, E3 als primaeren B2B-Einstieg, DOMDAR als Commerce-Ergaenzung, einen konkreteren Whitelabel-Vertrauensbeleg und eine segmentierte Audit-/WGOS-Abschluss-CTA.
- Die aktive `Growth Audit`-Landingpage ist als versionierter Template-Shell im Repo hinterlegt.
- Repo-seitig liegt jetzt zusaetzlich eine B2B-Branchen-Landingpage fuer Solar-, Waermepumpen- und Speicher-Anbieter kanonisch unter `/solar-waermepumpen-leadgenerierung/`; der Intake nutzt denselben Audit-/CRM-Stack mit eigener Branchen-Variante.
- `page-wgos.php` ist als kompaktere WGOS-Sales-Page versioniert: Hero mit Audit-CTA, System-Diagramm, frueher platzierte Pakete, modulare Cards und reduzierte FAQ.
- Die wichtigsten Legacy-Clusterseiten fuer SEO, Core Web Vitals, CRO, GA4 und Performance Marketing sind jetzt als versionierte WGOS-Clusterseiten im Theme hinterlegt.
- Repo-seitige Primary-Links auf diese Clusterseiten zeigen jetzt direkt auf ihre kanonischen Routen und fallen nicht mehr auf kuerzere Legacy-Slugs wie `/seo/` zurueck.
- Ergebnisse laufen repo-seitig kanonisch ueber `/ergebnisse/`; alte Proof-Slugs bleiben nur als Legacy-Redirects bestehen.
- Der aktive Audit-Pfad nutzt ein natives Multi-Step-Formular, WordPress-REST und ein internes Audit-CRM.
- Direkte Gespraechs-CTAs fuer Audit-, Kontakt- und WGOS-Kontexte nutzen theme-seitig zentral `https://cal.com/hasim-uener/30min?overlayCalendar=true`; die Whitelabel-Seite nutzt fuer Partner- und Agentur-Fit jetzt zusaetzlich `https://cal.com/hasim-uener/whitelabel-fit-gesprach?overlayCalendar=true`.
- Diese Gespraechs-CTAs oeffnen bei verfuegbarem JavaScript ein eingebettetes Cal.com-Popup im Seitenkontext; der direkte Kalender-Link bleibt pro Event-Typ als robuster Fallback erhalten.
- Die Kontaktseite fuehrt oeffentlich jetzt ueber sechs saubere Anfragearten: `Erstdiagnose / Growth Audit`, `Fokussierte Folgeanalyse`, `Umsetzung / Optimierung`, `Laufende Weiterentwicklung`, `Allgemeine Anfrage` und `Bestehender Kunde`; die Frontend-Ausgabe von `/kontakt/` ist repo-seitig am nativen Theme-Template verankert.
- Das Client Portal existiert technisch inklusive Login- und Upload-Logik.
- Repo-seitig existiert jetzt ein gemeinsames `Nexus CRM` fuer Audit-Anfragen, Projektanfragen und Blog-Abos; die Blog-Benachrichtigungen inkl. DOI, Abmeldung und manuell anstossbarem Artikelversand liegen im Theme.
- Repo-seitig existiert jetzt ein `SEO Cockpit` im WordPress-Admin: Search-Console-OAuth, Cache-Layer, Kernmetriken, Dashboard-Widget, Cron-Snapshot und optionale Koko-Erkennung sind im Theme vorbereitet.
- Die KI-Crawler-Oberflaeche fuer `/llms.txt` folgt jetzt repo- und theme-seitig demselben kompakten Format mit verdichteter Audit-Zusammenfassung und kanonischen Hauptpfaden.
- Nicht-kritische Theme-Skripte werden zentral ueber `inc/enqueue.php` mit `defer` ausgeliefert; `nexus-core-js` und `nexus-site-header-js` bleiben fuer unmittelbare Boot- und Header-Interaktionen ausgenommen.
- Zusaetzliche INP-Haertung: `nexus-core.js` verschiebt nicht-kritische Observer/TOC/Progress-Initialisierung auf `requestAnimationFrame` bzw. Idle-Zeit, der Header verarbeitet Scroll- und Pointer-Bewegungen nur noch RAF-gebuendelt und das Cal.com-Enhancement bindet Preload-Listener direkt an passende Buchungslinks statt global am gesamten Dokument.

## In Arbeit

- Das Repo wird gerade von einem Theme-Repo zu einem Website Operating System erweitert.
- `page-wgos.php` bleibt template-driven; eine spaetere Auslagerung des Content-Layers in Editor oder ACF ist weiter offen.
- WGOS Asset-Detailseiten laufen jetzt ueber den hierarchischen CPT `wgos_asset` mit ACF-Meta und Single-Template; die redaktionelle Befuellung der Spokes passiert weiter im WordPress-Admin.
- WGOS-Assets sind jetzt zusaetzlich als versionierte Registry im Theme definiert: 39 Assets (35 auf `publish`, 4 neue KI-Assets auf `draft`).
- Die neue WGOS-Asset-Struktur rendert 8 feste Abschnitte, versionierte SEO-Meta, Related-Links und `Service`-Schema aus derselben Registry.
- Die WGOS Systemlandkarte wird jetzt bei Bedarf automatisch als Seite angelegt und listet alle Assets zusaetzlich in einer festen, gruppierten Hub-Ansicht.
- Die eigentliche Post-Erstellung und Aktualisierung fuer WGOS-Assets haengt aktuell noch am neuen Theme-Sync und damit am naechsten Deployment auf die Live-Umgebung.
- Teile der Homepage- und Navigationslogik haengen noch an manuellen WordPress-Admin-Schritten oder editorgetriebenen Default-Seiten ausserhalb der route-forced Clusterpages.
- Editorgetriebene Seitentitel, Excerpts, Karten und `the_content()`-Bereiche koennen weiter alte Proof-, Tonalitaets- oder Du/Sie-Brueche enthalten und muessen im WordPress-Admin separat verifiziert werden.
- Blog-Artikel koennen jetzt theme-seitig passende WGOS-Assets als Anschlussblock ausgeben; weitere Post-Mappings bleiben ausbaubar.
- Die Community-Signale auf der Homepage sind derzeit ueber GitHub und ein oeffentliches LinkedIn-Profil versioniert; ein kanonischer Facebook-Link inklusive belastbarer Kennzahl ist im Repo noch nicht hinterlegt.
- `audit-live.js` und die n8n-V3-Strecke liegen als versionierter Instant-Results-Layer im Repo, sind aber nicht der aktive Landing-Flow.
- CRM-, Mail- und Follow-up-Logik fuer den Audit sind jetzt im Theme sichtbar; `wp_mail`-basierte Transaktionsmails koennen repo-seitig zentral ueber die Brevo API geroutet werden, sobald die Live-Credentials ausserhalb des Repos gesetzt sind.
- Die neue Energie-Landingpage bringt einen branch-faehigen Multi-Step-Intake mit serverseitigem Fallback; der kanonische Slug wird theme-seitig jetzt bei Bedarf als WordPress-Seite angelegt und der alte Pfad `/website-fuer-solar-und-waermepumpen-anbieter/` per Redirect auf `/solar-waermepumpen-leadgenerierung/` gefuehrt.
- Das neue Blog-Notify-System ist repo-seitig implementiert, aber End-to-End auf der Live-Instanz noch nicht verifiziert.
- Das neue SEO-Cockpit ist repo-seitig implementiert, aber ohne echte Google-OAuth-Credentials und ohne installiertes Koko-Plugin noch nicht end-to-end verifiziert.
- Das Client Portal arbeitet aktuell mit Mock-Daten und ist noch kein voll dokumentiertes Produktivsystem.
- KI-Erweiterung: 4 neue WGOS-Assets (KI-Assistent/Chatbot 30 Cr, KI-Lead-Qualifizierung 20 Cr, RAG-Wissenssuche 25 Cr, LLM-Workflow-Automatisierung 20 Cr) liegen als `draft` in der Registry. Dachseite `/ki-integration-wordpress/` als versioniertes Page-Template (`page-ki-integration.php`) mit Service- und FAQPage-Schema im Repo. Interne Verlinkung von WGOS, Systemlandkarte und Ueber-mich-Seite eingebaut. WordPress-Admin-Schritte (Seite anlegen, Template zuweisen, Assets auf `publish` setzen) stehen noch aus.

## Geplant

- weitere n8n-Workflow-Exporte unter `automations/n8n/workflows/`
- weitere menschlich lesbare Workflow-Doku und Flow-Maps unter `automations/n8n/docs/` und `automations/n8n/flow-maps/`
- sauberer Prompt- und Agenten-Layer fuer wiederverwendbare Arbeitskontexte
- weitere Systemdoku fuer Tracking, CRM-Routing, Offer-Logik und CTA-Inventar
- Ausbau des SEO Cockpits um echte Koko-Daten, Page-Level-Korrelationen und spaetere URL-Inspection-Sichten
- optionaler Ausbau des Growth Audit von persoenlichem Intake zu Instant-Results-Flow
- Ausbau des Decision Logs fuer strukturelle Repo- und Systementscheidungen

## Deprecated

- Legacy-Slugs `/audit/`, `/customer-journey-audit/`, `/360-audit/` und `/wordpress-tech-audit/` werden auf `/growth-audit/` umgeleitet.
- Legacy-Slugs `/case-studies/` und `/case-studies-e-commerce/` werden auf `/ergebnisse/` umgeleitet.
- Legacy-Slugs `/meta-ads/`, `/seo/`, `/wordpress-agentur/` und `/roi-rechner/` werden auf ihre kanonischen Zielseiten umgeleitet.
- Der Legacy-Pfad `/alle-loesungen-im-detail/` wird auf die aktuelle Loesungs-Uebersicht umgeleitet.
- Die Clusterseiten `/ga4-tracking-setup/`, `/performance-marketing/` und `/wordpress-wartung-hannover/` bleiben aktive versionierte Routen und sind keine Legacy-Redirect-Ziele mehr.
- Im WordPress-Admin erscheint fuer Admins ein Legacy-Cleanup-Hinweis; der Ein-Klick-Flow setzt gefundene Altseiten auf `draft` und entfernt passende Menue-Eintraege.
- Der `Growth Audit` ist der aktuelle und oeffentliche Primaer-Einstieg. Vertiefte Folgeanalysen sind kein eigenstaendiger Erstkontakt mehr, sondern ergeben sich erst nach Audit und persoenlichem Kontakt.
- Oeffentliche Kontakt- und CTA-Texte mit `Pilotprojekt`, `Proof-of-Value`, `3.000+ Leads`, `34x ROAS` ohne Kontext oder `Retainer` als kaufnaher Standardbegriff sind nicht mehr Zielbild.
- Ein WordPress-Editor-Shell als Source of Truth fuer den Audit ist nicht mehr Zielbild.
- Lose Root-Ablage fuer Playbooks, Referenz-Snippets und Content-Drafts ist nicht mehr Zielstruktur.
