# Navigation Migration - hasimuener.de

Stand: 2026-03-14.

Diese Datei enthaelt nur noch offene manuelle Restarbeiten ausserhalb des Repos.
Bereits versionierte oder abgeschlossene Code-Migrationen wurden entfernt.

## 1. Navigation im WordPress-Admin

1. Dashboard -> Design -> Menues.
2. Pruefen, ob das aktive Hauptmenue der schlanken Zielstruktur folgt:
   - WordPress Growth Operating System (`/wordpress-growth-operating-system/`)
   - Ergebnisse (`/ergebnisse/`)
   - Blog (`/blog/`)
   - Ueber mich (`/uber-mich/`)
   - Growth Audit (`/growth-audit/`) mit Klasse `nav-cta-button`
3. Alle Punkte auf derselben Ebene lassen; keine Dropdowns.
4. Falls noch ein altes Menue aktiv ist, nur deaktivieren, nicht loeschen, bis die Live-QA sauber ist.
5. Wenn der Audit-CTA bereits im Menue sitzt, keinen zweiten identischen Header-Button daneben stehen lassen.

## 2. Homepage: offene Editor-Aufgaben

### Hero

- Subline auf einen klaren Satz kuerzen:
  `Ich baue Ihre WordPress-Instanz zu einem eigenen Anfragesystem um - ohne Ad-Abhaengigkeit, mit messbarem Ergebnis.`
- Falls der Stack-Text-Block noch existiert, entweder die CSS-Klasse `hero-stack-text` vergeben oder den Block entfernen.
- Falls ein sekundaerer Hero-CTA noch existiert, die Klasse `hero-cta-secondary` vergeben.

### Reihenfolge und Proof

- Reihenfolge im Editor gegen dieses Zielbild pruefen:
  1. Hero
  2. Schmerz-Sektion
  3. WGOS-System-Sektion
  4. Track Record / Cases
  5. Selektionskarte "Fuer wen ist das nichts?"
  6. Audit-CTA
  7. FAQ
  8. Blog
- Vor die Zahlen bei `E3 New Energy` und `DOMDAR` jeweils einen kurzen Kontextsatz setzen.
- Nach dem Track-Record eine eigene Selektionskarte ergaenzen:
  `Fuer Hobby-Projekte, reine Visitenkarten ohne Lead-Absicht oder Unternehmen die Baukasten-Preise erwarten. Das System ist fuer B2B-Unternehmen ab ~500.000 EUR Jahresumsatz, die planbar skalieren wollen.`
- FAQ auf diese drei Fragen reduzieren:
  1. `Was unterscheidet Credits von Stundensaetzen?`
  2. `Brauchen wir dann ueberhaupt noch Ads?`
  3. `Was bedeutet Privacy-first Tracking konkret?`
- Unter dem FAQ einen Textlink auf `/wordpress-growth-operating-system/#faq` setzen.
- Nach der Schmerz-Sektion einen kleinen Textlink auf `/wordpress-growth-operating-system/` setzen:
  `Noch nicht sicher? Erst das System verstehen ->`

### Accessibility

- Im Hero-Kennzahlen-Block `sr-only`-Spans fuer die Werte pruefen oder nachtragen:
  - `98 Mobile Performance Score`
  - `-83% Reduktion Kosten pro Lead`
  - `< 0.8s Ladezeit LCP`
  - `100% Data Ownership`
- In der Medienbibliothek die Alt-Texte der Blog-Vorschaubilder auf beschreibende Texte umstellen.

## 3. WGOS und Systemseiten

- Fuer `/wordpress-growth-operating-system/` und `/wgos-systemlandkarte/` gibt es repo-seitig keine offenen Editor-Migrationsschritte mehr.
- Nach jedem Deploy nur noch live gegenpruefen, ob kein alter Editor-Content oder Cache die versionierten Templates ueberlagert.

## 4. Post-Deploy-QA

- Header-Menue auf Desktop und Mobile pruefen.
- Sicherstellen, dass keine alten Buchungs-, Case-Study- oder Audit-Links aus Editor-Content wieder auftauchen.
- Homepage, WGOS und Growth Audit einmal ungecacht gegenklicken.
- Im WordPress-Admin kontrollieren, ob Menues, Utility-Links und Footer-Links noch der aktuellen CTA-Hierarchie folgen.
