# Glossary Implementation Notes

## Einordnung des Reports

Der Research-Report fuer ein Glossar auf hasimuener.de ist in der Grundrichtung belastbar:

- eigener `/glossar/`-Namespace statt Root-Slugs
- definitorischer Sub-Term-Layer statt Konkurrenz zu Cluster- und Angebotsseiten
- Alias-Mechanik fuer Head Terms mit hohem Kannibalisierungsrisiko
- zentrale SEO-/Schema-Integration im Theme statt isolierter Plugin-Logik
- Versionierung als Registry-Ansatz statt unkontrollierter Einzelseiten

Die groesste Luecke im Report war nicht die Strategie, sondern die konkrete Betriebsform fuer einen ersten sauberen Rollout.

## Was jetzt im Theme umgesetzt wurde

- `glossary_term` als eigener CPT mit Rewrite unter `/glossar/...`
- Hub-Template `page-glossar.php`
- Single-Template `single-glossary_term.php`
- versionierte Registry in `inc/glossary-registry-data.php`
- Registry-Sync fuer verwaltete Glossar-Inhalte
- zentrale Schema-Erweiterung in `inc/org-schema.php` mit `DefinedTerm` und `DefinedTermSet`
- SEO-Meta ueber die vorhandene Title-/Description-Logik via gespeicherte Meta-Werte
- Alias-Unterstuetzung fuer Head Terms ohne zweite indexierbare Detailseite

## Erster Live-Scope

Indexierbare Begriffe:

- `INP`
- `LCP`
- `CLS`
- `TTFB`
- `Canonical URL`
- `UTM-Parameter`
- `Message Match`
- `Owned Leads`

Alias-Begriffe:

- `Core Web Vitals`
- `Conversion Rate Optimization`

## Bewusste Abgrenzung

Noch nicht umgesetzt:

- A-Z-Filter oder clientseitige Suche auf dem Hub
- separate Canonical-Overrides fuer potenzielle spaetere `alias`-Detailseiten
- noindex-Begriffe im initialen Datensatz
- redaktionelle Massenmigration weiterer Begriffe aus dem Report-Backlog

Der aktuelle Stand ist absichtlich klein gehalten: erst ein belastbares System und ein sauberer Startbestand, dann Ausbau.
