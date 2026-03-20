# 0002 Public Proof Layer fuer die Homepage

Stand: 2026-03-11.

## Kontext

Die Startseite soll fuer B2B-Entscheider mehr Vertrauen aufbauen, ohne auf oeffentliche Kundenlogos oder klassische Testimonials angewiesen zu sein. Gleichzeitig gibt es bereits belastbare Signale:

- ein oeffentliches GitHub-Repo fuer die eigene Website
- die sichtbare Case Study `E3 New Energy`
- oeffentliche Social-Reichweite ueber LinkedIn
- viele weitere Projekte ohne oeffentliche Freigabe

## Entscheidung

Die Homepage bekommt einen versionierten Public-Proof-Layer an drei Stellen:

1. Nach dem Prinzip-Block zeigt ein GitHub-Modul die offene Arbeitsweise mit Repo-Link und Commit-Badge.
2. Der Proof-Bereich rahmt `E3 New Energy` als beispielhafte Wirkung eines wiederholbaren Systems und ergaenzt einen Community-Kasten mit oeffentlichen LinkedIn-Signalen.
3. Nach dem Abschluss-CTA fuehrt nur noch der audit-first Folgepfad weiter: erst Diagnose, dann eine fokussierte Folgeanalyse oder eine kontrollierte Weiterentwicklung, falls fachlich sinnvoll.

## Datenbasis

- GitHub-Commit-Basis: `701` Commits aus lokalem Repo-Stand via `git rev-list --count HEAD` am 2026-03-11.
- LinkedIn-Basis: `569` Follower und `20` oeffentliche Beitraege aus einem oeffentlich indexierten Profilstand am 2026-03-11.
- Ein belastbarer Facebook-Link samt Kennzahl ist aktuell nicht im Repo versioniert; deshalb wird kein ungesicherter Facebook-Wert angezeigt.

## Folgen

- Vertrauen wird ueber nachvollziehbare Arbeit und sichtbare Systemlogik aufgebaut, nicht ueber ausgedachte Referenzen.
- Folgearbeit entsteht nicht aus einem oeffentlichen Pilotangebot, sondern erst aus einer klaren Diagnose und einem sauberen fachlichen Fit.
- Die oeffentlichen Kennzahlen muessen bei groesseren Homepage-Iterationen manuell nachgezogen werden.
