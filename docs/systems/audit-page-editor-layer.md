# Audit Page Layer

Stand: 2026-04-03.

Der Dateiname ist historisch. Fuer die aktive Audit-Seite ist der WordPress-Editor nicht mehr der funktionale Source-of-Truth-Layer.

## Aktueller Stand

Die aktive `Growth Audit`-Seite wird aus dem Theme gerendert:

- `blocksy-child/page-audit.php`
- `blocksy-child/inc/audit-page.php`
- `blocksy-child/inc/cja-shortcode.php`

`blocksy-child/page-audit.php` rendert die Route aus dem Repo.
`blocksy-child/inc/audit-page.php` gibt aktiv den Shortcode `cja_audit` aus und bleibt zusaetzlich Fallback fuer content-basierte Renderpfade.

Folge:

- Editor-HTML ist fuer die aktive Audit-Seite nicht mehr der operative DOM-Layer.
- Markup-Aenderungen gehoeren fuer diese Seite in Git, nicht in den WordPress-Editor.

## Aktiver DOM-Contract

Der aktuelle Funnel haengt an diesen Elementen:

- `#cja-app`
- `#cja-url-input`
- `#cja-submit`
- `#cja-loading`
- `#cja-results`
- `#cja-score-header`
- `#cja-modules`
- `#cja-revenue`

Ohne diese IDs arbeitet `blocksy-child/assets/js/cja-audit.js` nicht korrekt.

## Historische Referenzen

Die folgenden Dateien bleiben als Referenz fuer den frueheren oder moeglichen Instant-Results-Layer erhalten:

- `docs/references/audit-page-editor-snippet.html`
- `docs/references/audit-page-editor-snippet-v2.html`
- `docs/references/audit-page-editor-snippet-v3.html`

Diese Snippets dokumentieren den alten Editor-basierten Audit-Aufbau mit:

- `#audit-live-form`
- `#audit-loader`
- `#audit-results`
- `view-mode-results`

Das ist aktuell kein aktiver Default-Flow.

## Beziehung zu Legacy-Layern

`blocksy-child/assets/js/audit-live.js` und `blocksy-child/template-parts/audit-page-shell.php` erwarten weiterhin einen aelteren Audit-DOM.

Das bedeutet:

- Der Code ist weiter versioniert und fachlich nutzbar.
- Er ist aber nicht direkt mit der aktiven Landingpage gekoppelt.
- Wer einen aelteren Funnel reaktivieren will, braucht wieder einen passenden DOM-Shell.

## Risiken

- Der Dateiname der Doku suggeriert noch einen aktiven Editor-Layer, obwohl die Seite inzwischen versioniert ist.
- Der aktive CJA-Flow und die Legacy-Audit-Layer repraesentieren verschiedene Funnel-Modelle.
- Wer auf der Audit-Seite wieder Editor-Markup erwartet, baut leicht gegen die aktuelle Theme-Realitaet.

## Operative Regel

Fuer die aktive `Growth Audit`-Seite gilt:

- Struktur, DOM und Copy-Shell in Git
- keine funktionale Logik im Editor
- Editor nur dann wieder als Layer einfuehren, wenn das bewusst neu entschieden und dokumentiert wird
