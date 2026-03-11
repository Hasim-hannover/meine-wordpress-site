# 0003 WGOS Asset Registry

- Datum: 2026-03-11

## Entscheidung

WGOS-Assets werden nicht mehr nur als lose Editor-Inhalte behandelt.

Stattdessen gilt ab jetzt:

- Eine versionierte Registry im Theme ist die Source of Truth für alle WGOS-Assets.
- Das `wgos_asset`-Single-Template folgt einer festen 8-Abschnitte-Struktur.
- Das Theme synchronisiert die Registry automatisch in echte `wgos_asset`-Posts.
- Bestehende Assets bleiben `publish`.
- Neu definierte Assets werden als `draft` angelegt.
- Die Systemlandkarte liest ihre Daten aus derselben Registry.
- WGOS-Assets geben eigenes `Service`-Schema aus.

## Begründung

- Die bisherigen Asset-Texte waren sprachlich und strukturell nicht belastbar.
- Die lokale Arbeitsumgebung hat kein `wp-cli`.
- Ein Teil des Live-Contents liegt im Editor und war bisher nicht versioniert.
- SEO, CRO, interne Verlinkung und Systemkontext müssen für alle Assets konsistent aus derselben Logik kommen.

## Konsequenzen

- Die tabellarische Matrix aus dem Prompt wird als Source of Truth behandelt.
- Sie enthält 35 Assets, nicht 32.
- Das Theme erzeugt und aktualisiert Asset-Posts nach einem Registry-Versionsstand.
- Der alte Slug `server-side-tracking-sgtm-matomo` wird auf `server-side-tracking` umgestellt und per Theme-Redirect abgesichert.
- Ohne Deployment ist die Repo-Implementierung vollständig, aber noch nicht live ausgeführt.
