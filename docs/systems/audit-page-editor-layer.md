# Audit Page Editor Layer

Stand: 2026-03-07.

Diese Datei dokumentiert den WordPress-Editor-Layer der Seite `Customer Journey Audit`.

Der eigentliche Audit-Funnel besteht aktuell aus zwei Ebenen:

- versionierter Theme- und JS-Layer im Repo
- manuell gepflegter Content- und DOM-Layer im WordPress-Editor

Referenz-Snapshot:

- `docs/references/audit-page-editor-snippet.html`

Empfohlene Editor-V2:

- `docs/references/audit-page-editor-snippet-v2.html`

## Rolle des Editor-Layers

Der Editor-Layer liefert nicht nur Content, sondern einen funktionalen DOM-Rahmen fuer die Audit-Logik.

Er stellt bereit:

- Hero und Einstiegsnarrativ
- Formular-Shell
- Loader-Platzhalter
- Ergebnis-Container
- Vertrauens- und Preview-Sektionen
- versteckten Deep-Dive-Form-Container
- einen kleinen View-Mode-Fallback per `MutationObserver`

## DOM-Contract mit `audit-live.js`

Der folgende DOM ist fuer die Laufzeit relevant:

- `#audit-main-wrapper`
- `#audit-live-form`
- `#audit-url`
- `#audit-form-inner`
- `#audit-form-error`
- `#audit-loader`
- `#loader-icon`
- `#loader-text`
- `#loader-sub`
- `#loader-progress`
- `#audit-results`
- `#deepdive-fluent-form`

Ohne diese IDs kann `blocksy-child/assets/js/audit-live.js` nicht korrekt arbeiten.

## Sichtbare Systemlogik

- Hero verspricht Live-Ergebnis in 60 Sekunden.
- Primaeres Formular fragt aktuell nur die URL ab.
- Ein E-Mail-Feld ist im DOM vorhanden, aber versteckt.
- Nach Ergebniseinspielung wird `view-mode-results` auf den Wrapper gesetzt.
- `#start`, `#form-wrap` und `.audit-social-proof` werden im Results-Mode ausgeblendet.
- Das Deep-Dive-Formular wird aus dem versteckten Container in den Ergebnisbereich verschoben.

## Wichtige Befunde

### 1. Der Editor-Code bestaetigt den Contract-Bruch im Audit-System

Das Formular im Editor fragt initial nur die URL ab.

Parallel dazu verlangt der aktuelle n8n-Workflow beim Start bereits eine E-Mail.

Folge:

- Das Problem liegt nicht im Editor-Markup allein, sondern im Zusammenspiel aus Editor, `audit-live.js` und n8n.

### 2. Verstecktes E-Mail-Feld ist aktuell faktisch tot

Im Editor existiert:

- `#email-field-wrap`
- `#audit-email`

Aber:

- das Feld ist dauerhaft versteckt
- `audit-live.js` liest es beim Erstsubmit nicht aus
- es gibt keine sichtbare Logik, die es spaeter einblendet

Folge:

- Es erzeugt Scheinkomplexitaet ohne echte Funktion.

### 3. Das Formular-Markup wirkt strukturell fehlerhaft

Im gelieferten Snippet steht nach dem versteckten E-Mail-Feld ein zusaetzliches schliessendes `</div>`.

Folge:

- Der Browser wird das Markup wahrscheinlich still korrigieren.
- Der reale DOM kann aber von der beabsichtigten Struktur abweichen.
- Das ist ein unnoetiger Unsicherheitsfaktor fuer spaetere Aenderungen.

### 4. Results-Mode blendet nur Teile der Einstiegsseite aus

Im Results-Mode werden aktuell ausgeblendet:

- Hero
- Formularbereich
- Social Proof unter dem Formular

Sichtbar bleiben:

- Tech-Stack-Bar
- Journey-Preview
- Report-Preview
- Vorteile
- FAQ
- Footer-Links

Folge:

- Das kann nach erfolgreicher Analyse die Fokuslogik verwischen.
- Der Ergebnisbereich ist nicht die einzige dominante Flaeche.

### 5. Navigation bleibt auf versteckte Anker ausgerichtet

Die Smart-Navigation verlinkt weiterhin auf:

- `#start`
- `#form`

Diese Bereiche sind im Results-Mode ausgeblendet.

Folge:

- Die Navigation wird nach erfolgreicher Analyse teilweise inkonsistent.

### 6. Der Observer bleibt ein fragiler Fallback

`audit-live.js` setzt `view-mode-results` inzwischen direkt beim Rendern der Ergebnisse.

Im Editor existiert zusaetzlich weiter ein `MutationObserver` mit der Bedingung:

- `resultsContainer.innerHTML.trim() !== ""`

Folge:

- Der Hauptpfad ist jetzt robuster, weil der JS-Layer den Status aktiv setzt.
- Der Observer bleibt dennoch ein indirekter DOM-Fallback und damit potenziell stoeranfaellig.

## Risiken

- Editor-Layer ist funktional wichtig, aber ausserhalb des deploybaren Theme-Codes gepflegt.
- DOM-Contract ist nicht im WordPress-Admin abgesichert.
- Markup-Aenderungen im Editor koennen `audit-live.js` still brechen.
- Ergebnis-Modus und Inhalts-Modus sind nicht sauber als zwei klar getrennte Ansichten modelliert.

## Empfohlene Richtung

1. Den DOM-Contract in der Doku als verbindlich behandeln.
2. Das tote E-Mail-Feld entfernen oder in eine echte, dokumentierte Progressive-Disclosure-Logik ueberfuehren.
3. Das fehlerhafte Markup im Formular bereinigen.
4. Den Editor-Observer nur noch als Fallback behandeln und langfristig entfernen.
5. Entscheiden, ob die unteren Info-Sektionen nach Ergebniseinspielung sichtbar bleiben sollen.
6. Langfristig den Editor-Shell-Code in einen versionierten Template- oder Block-Pattern-Layer ueberfuehren.

## Status der V2-Empfehlung

- Die empfohlene Editor-V2 ist im Repo vorbereitet.
- Sie verbessert Fokus, DOM-Sauberkeit und Results-Mode.
- Sie behebt nicht den JSON-Response-Fehler aus n8n. Dieser liegt weiterhin im Webhook- oder Polling-Pfad, nicht im Editor-Markup.
