# Website Operating System

Dieses Repo ist die versionierbare Source of Truth fuer die Website von Hasim Uener, die dazugehoerige Funnel-Logik, die kuenftige n8n-Automation, Agentenkontexte, Content-Assets und operative Systemdokumentation.

Es soll nicht nur Code ablegen, sondern sichtbar machen:

- was live ist
- was in Arbeit ist
- was geplant oder deprecated ist
- welche Systeme zusammenhaengen
- welche Stellen kritisch sind
- welche Regeln fuer Menschen und Agenten gelten

## Schnellstart

Menschen lesen diese Reihenfolge:

1. `README.md`
2. `docs/architecture/SYSTEM_MAP.md`
3. `docs/architecture/LIVE_STATUS.md`

Agenten lesen diese Reihenfolge:

1. `AGENTS.md`
2. das passende lokale `CONTEXT.md`
3. nur danach die notwendige System- oder Detaildoku

## Repo-Logik

| Ebene | Zweck | Hauptorte |
| --- | --- | --- |
| Betrieb | Status, Entscheidungen und Betriebswissen | `docs/architecture/LIVE_STATUS.md`, `docs/decisions/` |
| Technik | deploybarer Website-Code und technische Systemlogik | `blocksy-child/`, `.github/workflows/` |
| Wissen | Positionierung, Funnel-Kontext, Content, Agenten- und Skill-Wissen | `AGENTS.md`, `content/`, `agents/`, `prompts/` als Legacy-Briefing-Ablage |
| Automation | versionierbare Workflow-Exporte und Flow-Doku | `automations/n8n/` |

## Struktur

```text
.
├── README.md
├── AGENTS.md
├── .claudeignore
├── .ai/
├── blocksy-child/
│   ├── CONTEXT.md
│   └── docs/
│       ├── architecture/
│       ├── implementation/
│       └── ux/
├── automations/
│   └── n8n/
│       └── CONTEXT.md
├── agents/
│   └── skills/
│       └── CONTEXT.md
├── content/
│   ├── CONTEXT.md
│   └── blog-drafts/
├── docs/
│   ├── CONTEXT.md
│   ├── architecture/
│   ├── decisions/
│   ├── references/
│   ├── seo/
│   ├── systems/
│   └── ux/
├── prompts/
└── .github/workflows/
```

## Was wo liegt

- `blocksy-child/`: Live-Theme fuer WordPress, inklusive Templates, Assets, Schema, CTA-Bausteinen und Website-Logik.
- `blocksy-child/docs/`: runtime-nahe Theme-Doku fuer Seitentypen, UX-Regeln und Implementierungsnotizen ohne Aenderung am Frontend-Code.
- `automations/n8n/`: Zielort fuer exportierte n8n-Workflows, Flow-Maps und menschlich lesbare Workflow-Doku.
- `docs/architecture/`: strategische Architekturdateien wie Systemkarte, Live-Status und Dokumentationsinventuren.
- `docs/seo/`: SEO-Architektur, Content-Trennung und thematische Regeln fuer das Wachstumssystem.
- `docs/ux/`: repo-weite UX- und Hierarchieregeln fuer wiedererkennbare Premium-Fuehrung.
- `docs/systems/`: fachliche und technische Systemdokumentation.
- `docs/playbooks/`: derzeit leer; neue wiederholbare Betriebsablaeufe werden als Skills unter `agents/skills/` modelliert.
- `docs/references/`: lose HTML-, Snippet- oder Referenz-Artefakte, die nicht direkt Live-Code sind.
- `content/`: vorbereitete Inhalte, die noch nicht sauber in WordPress oder in die finale Systemstruktur ueberfuehrt wurden.
- `agents/`: Agenten-spezifische Artefakte wie Skills und eine kompakte Rollenmatrix.
- `prompts/`: Legacy-Ablage fuer einmalige Briefings; neue wiederverwendbare Ablaufe werden als Skills modelliert.

## Repository Structure

- `/docs` enthaelt strategisches Wissen, das repo-weit gilt: Architektur, SEO-Regeln, UX-Leitplanken und Betriebskontext.
- `/blocksy-child/docs` enthaelt runtime-nahe Theme-Dokumentation: Seitentypen, Formularlogik und konkrete Implementierungsleitplanken fuer das Child Theme.
- UX-Specs sind absichtlich geteilt: generelle Regeln liegen unter `/docs/ux`, theme-spezifische Runtime-Regeln unter `/blocksy-child/docs/ux`.
- Architecture-Docs definieren Funnel-Rollen, Seitentypen und Systemgrenzen, damit Service-, Pillar-, Proof- und Glossar-Seiten sauber getrennt bleiben.
- `/prompts` ist nur noch eine Legacy-Ablage fuer seltene Briefings; neue Arbeitslogik gehoert in `/agents/skills`.

## Aktueller Fokus

- Repo von einem reinen Theme-Repo zu einem Operating System erweitern.
- Audit-Funnel technisch und fachlich dokumentieren.
- externe Abhaengigkeiten sichtbar machen, vor allem n8n, Tracking und WordPress-Editor.
- unversionierte Wissensinseln in dokumentierte Bereiche ueberfuehren.

## Wichtige Realitaeten

- `blocksy-child/` wird ueber getrennte GitHub-Workflows fuer CI und SSH-Rsync-Deploy ausgeliefert; Host, Port und Zielpfad sind repo-seitig ueber GitHub-Variables/Secrets abstrahierbar.
- Ein Teil des Live-Contents liegt im WordPress-Editor und ist nicht im Repo versioniert.
- Externe Systeme wie n8n, GTM, GA4, Consent, CRM und Cal.com sind aktuell nur teilweise im Repo dokumentiert.
- `AGENTS.md` ist die einzige Root-Datei fuer globalen Agentenkontext.
- Wiederverwendbare Arbeitsablaeufe liegen als Skills unter `agents/skills/<skill>/`.
