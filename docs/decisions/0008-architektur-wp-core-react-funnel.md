# 0008 WordPress-Core mit React-Funnel-Layer

- Datum: 2026-05-02
- Status: proposed

## Entscheidung

WordPress bleibt das Hauptsystem. Funnel-Erlebnisse werden als React-Mikro-Apps im Theme eingebettet. Es wird kein vollständig Headless-Stack eingeführt.

`blocksy-child/energie-fahrplan/` bleibt die kanonische Schablone für React-Funnel. Die Demo-App bleibt im Mono-Repo und wird nicht in ein externes Schwesterrepo extrahiert.

## Begründung

Der Solo-Betrieb braucht eine Architektur, die schnell auslieferbar, versionierbar und wartbar bleibt. WordPress trägt Marketing-Pages, Money-Pages und Editor-Inhalte; React trägt fokussierte Funnel-Erlebnisse mit eigener Build-Struktur.

## Konsequenzen

- Marketing-Pages, Money-Pages und Blog bleiben im WordPress-Editor.
- Funnel-Erlebnisse bauen nach `/wp-content/themes/<theme>/<funnel-name>/dist/`.
- Submit- und Tracking-Schicht laufen über WordPress REST API, Server-Side GTM und n8n.
- `scripts/build-theme-dist.sh` wird multi-funnel-fähig.
- Pro Kunde kann ein Funnel aus der kanonischen Schablone abgeleitet und branchenspezifisch angepasst werden.
