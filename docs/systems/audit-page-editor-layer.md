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

Empfohlene Editor-V3:

- `docs/references/audit-page-editor-snippet-v3.html`

## Rolle des Editor-Layers

Der Editor-Layer liefert nicht nur Content, sondern einen funktionalen DOM-Rahmen fuer die Audit-Logik.

Er stellt bereit:

- Hero und Einstiegsnarrativ
- Formular-Shell
- Loader-Platzhalter
- Ergebnis-Container
- Vertrauens- und Preview-Sektionen
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

Ohne diese IDs kann `blocksy-child/assets/js/audit-live.js` nicht korrekt arbeiten.

## Sichtbare Systemlogik

- Hero verspricht Live-Ergebnis in 60 Sekunden.
- Primaeres Formular fragt aktuell nur die URL ab.
- Nach Ergebniseinspielung wird `view-mode-results` auf den Wrapper gesetzt.
- `#start`, `#form-wrap` und `.audit-social-proof` werden im Results-Mode ausgeblendet.
- Der Beratungs-CTA wird direkt im Ergebnisbereich gerendert.

## Wichtige Befunde

### 1. Der Editor-Layer sollte nur den Start und die Verkaufsumgebung liefern

Das Formular im Editor fragt initial nur die URL ab.

Folge:

- Der Editor sollte nicht versuchen, Post-Result-Logik ueber versteckte Felder oder Plugin-Container mitzutragen.
- Alles nach dem Polling sollte aus `audit-live.js` kommen.

### 2. Das Ergebnis braucht einen klaren Beratungs-CTA
Wenn der Editor-Layer spaeter wieder auf E-Mail oder Plugin-Formulare umschwenkt, bricht die neue V3-Logik.

Folge:

- Der Editor sollte fuer den Audit nur URL-Start, Loader, Ergebnis-Container und statische Verkaufssektionen liefern.
- Alles Post-Result-spezifische sollte aus `audit-live.js` kommen.

### 3. Das Formular-Markup bleibt ein sensibler DOM-Contract

Die JS-Logik haengt weiter an einigen festen IDs.

Folge:

- Markup-Aenderungen im Editor koennen `audit-live.js` weiter still brechen.

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
2. Den Editor nur fuer URL-Start, Loader und statische Vertrauenssektionen nutzen.
3. Den Editor-Observer nur noch als Fallback behandeln und langfristig entfernen.
4. Entscheiden, ob die unteren Info-Sektionen nach Ergebniseinspielung sichtbar bleiben sollen.
5. Langfristig den Editor-Shell-Code in einen versionierten Template- oder Block-Pattern-Layer ueberfuehren.

## Status der V2-Empfehlung

- Die empfohlene Editor-V2 ist im Repo vorbereitet.
- Sie verbessert Fokus, DOM-Sauberkeit und Results-Mode.
- Sie behebt nicht den JSON-Response-Fehler aus n8n. Dieser liegt weiterhin im Webhook- oder Polling-Pfad, nicht im Editor-Markup.

## Status der V3-Empfehlung

- Die empfohlene Editor-V3 liegt ebenfalls im Repo.
- Sie ist auf `Instant Results` und einen nativen Beratungs-CTA ohne Fluent Forms ausgerichtet.
- Sie setzt voraus, dass das Frontend `audit-live.js` und der n8n-Workflow auf den V3-Contract umgestellt werden.
