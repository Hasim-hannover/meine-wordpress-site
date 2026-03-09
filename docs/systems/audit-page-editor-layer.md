# Audit Page Layer

Stand: 2026-03-09.

Der Dateiname ist historisch. Fuer die aktive Audit-Seite ist der WordPress-Editor nicht mehr der funktionale Source-of-Truth-Layer.

## Aktueller Stand

Die aktive `Growth Audit`-Seite wird aus dem Theme gerendert:

- `blocksy-child/page-audit.php`
- `blocksy-child/inc/audit-page.php`
- `blocksy-child/template-parts/audit-page-shell.php`

`blocksy-child/inc/audit-page.php` ersetzt auf der Audit-Seite den normalen `the_content()`-Output durch den versionierten Shell aus dem Repo.

Folge:

- Editor-HTML ist fuer die aktive Audit-Seite nicht mehr der operative DOM-Layer.
- Markup-Aenderungen gehoeren fuer diese Seite in Git, nicht in den WordPress-Editor.

## Aktiver DOM-Contract

Der aktuelle Funnel haengt an diesen Elementen:

- `#audit-main-wrapper`
- `#review-request-form`
- `#review-progress-fill`
- `[data-review-next]`
- `[data-review-prev]`
- `[data-review-submit]`
- `#review-form-feedback`
- `#review-request-success`
- `#review-success-url`

Ohne diese IDs und Data-Attribute arbeitet `blocksy-child/assets/js/review-funnel.js` nicht korrekt.

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

## Beziehung zu `audit-live.js`

`blocksy-child/assets/js/audit-live.js` erwartet weiterhin den alten Instant-Results-DOM.

Das bedeutet:

- Der Code ist weiter versioniert und fachlich nutzbar.
- Er ist aber nicht direkt mit der aktiven Landingpage gekoppelt.
- Wer den Instant-Results-Flow reaktivieren will, braucht wieder einen passenden DOM-Shell.

## Risiken

- Der Dateiname der Doku suggeriert noch einen aktiven Editor-Layer, obwohl die Seite inzwischen versioniert ist.
- `review-funnel.js` und `audit-live.js` repraesentieren zwei verschiedene Funnel-Modelle.
- Wer auf der Audit-Seite wieder Editor-Markup erwartet, baut leicht gegen die aktuelle Theme-Realitaet.

## Operative Regel

Fuer die aktive `Growth Audit`-Seite gilt:

- Struktur, DOM und Copy-Shell in Git
- keine funktionale Logik im Editor
- Editor nur dann wieder als Layer einfuehren, wenn das bewusst neu entschieden und dokumentiert wird
