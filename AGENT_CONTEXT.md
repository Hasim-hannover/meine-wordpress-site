# Agent Context

## Positionierung

Hasim Uener arbeitet als Growth Architect mit Fokus auf:

- WordPress
- technische SEO
- Performance
- Tracking, GTM, Consent, Server-Side Tracking
- CRO
- Lead-Funnels
- Audit- und Deep-Dive-Angebote
- strategische Positionierung

Die Grundlogik ist nicht "mehr Output", sondern "weniger Reibung, bessere Signale, planbare Leads".

## Zielgruppe

Primaer angesprochen werden:

- Geschaeftsfuehrer
- Founder
- Marketing Leads
- Growth-Verantwortliche
- vertriebsnahe Entscheider in B2B-Unternehmen

Typisches Idealprofil:

- WordPress als Kernsystem oder wichtiger Web-Kanal
- echtes Lead-Ziel statt reiner Image-Seite
- Bedarf an sauberer Datenlage, schnelleren Seiten und klarerer Funnel-Logik
- meist kein Interesse an Billig-Umsetzung oder rein kosmetischen Projekten

## Hauptangebote

- `Growth Audit` als niederschwelliger Diagnose-Einstieg
- `Growth Blueprint` als qualifizierter zweiter Schritt
- `WGOS` als Retainer- und Systemangebot
- Service-Landings fuer SEO, Core Web Vitals, GA4/Tracking, CRO, Performance Marketing, WordPress Agentur
- Case Studies und Cornerstone-Content als Vertrauens- und Proof-Layer

## Funnel-Logik

1. Aufmerksamkeit ueber SEO, Content, Service-Seiten, WGOS und Cases.
2. Primaer-CTA fast immer in den `Growth Audit`.
3. Der Audit sammelt Seite plus Kontext ein und liefert persoenliche Priorisierung statt Sales-Druck.
4. `Growth Blueprint` qualifiziert weiter und macht Ursachen sichtbar.
5. Erst danach folgen Call, Angebot oder Retainer.

Wichtige Regel:

- Diagnose vor Pitch.
- Systemverstaendnis vor Angebot.
- Qualitaet vor Lead-Volumen.

## Prioritaeten

- Conversion vor Kosmetik
- Klarheit vor Hype
- Diagnose vor Skalierung
- Eigene Anfragen vor Ad-Abhaengigkeit
- Privacy-first Measurement vor Daten-Sammelwut
- wartbare Systeme vor schnellen Hacks

## Qualitaetsstandards

- Repo und Doku muessen erklaeren, was live, geplant oder deprecated ist.
- Business-Logik darf nicht still in zufaelligen Templates oder Scripts verschwinden.
- CTA-Pfade muessen bewusst und hierarchisch bleiben.
- SEO-, Schema- und Tracking-Logik duerfen nicht doppelt oder widerspruechlich implementiert werden.
- WordPress-Editor-Inhalte muessen als externe Content-Layer klar markiert sein.
- Externe Systeme brauchen immer menschlich lesbare Doku zusaetzlich zum Code oder JSON.

## No-Go-Bereiche

- Paid- oder Design-Arbeit ohne sauberes Fundament aus Tracking, Performance und CTA-Logik
- neue versteckte Logik in Templates ohne Doku-Update
- unklare Mischformen aus Live-Content im Editor und stiller Repo-Annahme
- doppeltes SEO- oder Schema-Markup
- Automationen ohne Versionierung und Betriebsdoku
- "schnelle" Aenderungen, die den Primaer-CTA verwaessern

## Kritische Dateien und Systeme

| Datei oder System | Warum kritisch |
| --- | --- |
| `blocksy-child/functions.php` | zentraler Loader fuer technische Theme-Module |
| `blocksy-child/inc/enqueue.php` | bestimmt, welche Assets auf welchen Seitentypen laufen |
| `blocksy-child/inc/seo-meta.php` | steuert Meta-, Canonical- und noindex-Logik |
| `blocksy-child/inc/org-schema.php` | zentrale strukturierte Daten fuer Organisation und Services |
| `blocksy-child/inc/shortcodes.php` | traegt grosse Teile der Homepage- und CTA-Logik |
| `blocksy-child/assets/js/review-funnel.js` | technischer Kern des aktiven Growth-Audit-Formularpfads |
| `blocksy-child/inc/review-crm.php` | nativer Audit-Intake und Audit-Layer innerhalb des gemeinsamen CRM |
| `blocksy-child/inc/crm.php` | gemeinsames CRM-Modell fuer Projektanfragen, Blog-Abos und Kontaktstatus |
| `blocksy-child/inc/blog-notify.php` | DOI-, Abmelde- und Versandlogik fuer neue Artikel per E-Mail |
| `blocksy-child/assets/js/audit-live.js` | versionierter Instant-Results-Layer, aktuell nicht am aktiven Audit-Shell gebunden |
| `blocksy-child/page-wgos.php` | fachlich zentrales Offer-Template; Sales-Page-Struktur versioniert, Content-Layer weiter template-driven |
| `blocksy-child/page-seo-cornerstone.php` | strategischer Longform-Content mit direkter Funnel-Rolle |
| `.github/workflows/deploy.yml` | deployt nur `blocksy-child/` live |
| WordPress-Editor | enthaelt Live-Content, der nicht automatisch im Repo liegt |

## Arbeitsmodus fuer Agenten

- Vor jeder Aenderung zuerst Root-Doku lesen.
- Bei Eingriffen in ein Live-System immer `LIVE_STATUS.md` und die passende Systemdoku mitdenken.
- n8n, GTM, CRM und Consent nie als implizit annehmen. Fehlende Information knapp markieren.
- Keine neue operative Logik ohne Benennung von Abhaengigkeiten, Risiken und Fail-States.
- Wenn sich Status, CTA-Hierarchie oder Angebotslogik aendern, ist die Doku Teil der Aenderung.
