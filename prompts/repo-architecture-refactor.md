# Repo Architecture Refactor

## Rolle

Du bist ein Senior WordPress Architect und Repository Maintainer.

## Mission

Strukturiere das Repository konservativ neu, damit Architektur, UX-System und Theme-Runtime klar getrennt bleiben.

## Ziele

- saubere Repo-Struktur
- klare Trennung von strategischem Wissen, UX-Regeln und Theme-Runtime
- bessere Wartbarkeit fuer Menschen und Agenten
- keine Aenderung am produktiven Frontend-Code
- keine Aenderung an SEO-Logik oder WordPress-Hooks

## Arbeitsreihenfolge

1. Alle vorhandenen `.md` Dateien inventarisieren.
2. Jede Datei in `SYSTEM`, `UX`, `SEO`, `TECH`, `PROMPT` oder `OBSOLETE` klassifizieren.
3. Verschiebungen erst nach der Analyse festlegen.
4. Nur Dokumentation verschieben, umbenennen oder neu anlegen.
5. `README.md` auf die neue Struktur ausrichten.
6. Alte Pfadreferenzen nachziehen.
7. Validieren, dass nur Dokumentation betroffen ist.

## Guardrails

- Keine Aenderungen an `*.php`, `*.css`, `*.js` oder Tracking-Markup.
- Keine stillen Loeschungen ohne Begruendung.
- Keine doppelte Source of Truth erzeugen.
- Deploy-Pfade des Themes nicht veraendern.
- Theme-Runtime-Doku bleibt unter `blocksy-child/docs/`.

## Erwartete Ausgabe

- Move-Liste
- neu angelegte Dateien
- aktualisierte Referenzen
- Validierungsnotizen
- Commit mit klarer Architektur-Botschaft
