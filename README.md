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

Menschen und Agenten steigen immer in dieser Reihenfolge ein:

1. `README.md`
2. `docs/architecture/SYSTEM_MAP.md`
3. `docs/architecture/LIVE_STATUS.md`
4. `AGENT_CONTEXT.md`
5. die passende Detaildoku unter `docs/systems/`, `docs/seo/` oder `blocksy-child/docs/`

## Repo-Logik

| Ebene | Zweck | Hauptorte |
| --- | --- | --- |
| Betrieb | Status, Entscheidungen, Playbooks, Betriebswissen | `docs/architecture/LIVE_STATUS.md`, `docs/playbooks/`, `docs/decisions/` |
| Technik | deploybarer Website-Code und technische Systemlogik | `blocksy-child/`, `.github/workflows/` |
| Wissen | Positionierung, Funnel-Kontext, Content, Agenten- und Prompt-Wissen | `docs/architecture/SYSTEM_MAP.md`, `AGENT_CONTEXT.md`, `content/`, `agents/`, `prompts/` |
| Automation | versionierbare Workflow-Exporte und Flow-Doku | `automations/n8n/` |

## Struktur

```text
.
├── README.md
├── AGENT_CONTEXT.md
├── SKILL.md
├── blocksy-child/
│   └── docs/
│       ├── architecture/
│       ├── implementation/
│       └── ux/
├── automations/
│   └── n8n/
├── agents/
│   └── skills/
├── content/
│   └── blog-drafts/
├── docs/
│   ├── architecture/
│   ├── decisions/
│   ├── playbooks/
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
- `docs/playbooks/`: manuelle Betriebsablaeufe fuer WordPress-Admin, Migrationen und Rollouts.
- `docs/references/`: lose HTML-, Snippet- oder Referenz-Artefakte, die nicht direkt Live-Code sind.
- `content/`: vorbereitete Inhalte, die noch nicht sauber in WordPress oder in die finale Systemstruktur ueberfuehrt wurden.
- `agents/`: Agenten-spezifische Artefakte wie Skills, Operating Notes und kuenftige Agenten-Assets.
- `prompts/`: wiederverwendbare Prompt-Bausteine, Briefings und Task-Patterns.

## Repository Structure

- `/docs` enthaelt strategisches Wissen, das repo-weit gilt: Architektur, SEO-Regeln, UX-Leitplanken und Betriebskontext.
- `/blocksy-child/docs` enthaelt runtime-nahe Theme-Dokumentation: Seitentypen, Formularlogik und konkrete Implementierungsleitplanken fuer das Child Theme.
- UX-Specs sind absichtlich geteilt: generelle Regeln liegen unter `/docs/ux`, theme-spezifische Runtime-Regeln unter `/blocksy-child/docs/ux`.
- Architecture-Docs definieren Funnel-Rollen, Seitentypen und Systemgrenzen, damit Service-, Pillar-, Proof- und Glossar-Seiten sauber getrennt bleiben.
- `/prompts` sammelt wiederverwendbare Agenten-Briefings; sie steuern Arbeitsweise, sind aber nicht die Source of Truth fuer Live-Code oder SEO-Logik.

## Aktueller Fokus

- Repo von einem reinen Theme-Repo zu einem Operating System erweitern.
- Audit-Funnel technisch und fachlich dokumentieren.
- externe Abhaengigkeiten sichtbar machen, vor allem n8n, Tracking und WordPress-Editor.
- unversionierte Wissensinseln in dokumentierte Bereiche ueberfuehren.

## Wichtige Realitaeten

- `blocksy-child/` wird ueber GitHub Actions per SSH-Rsync deployt. Der Deploy-Pfad bleibt deshalb vorerst unveraendert.
- Ein Teil des Live-Contents liegt im WordPress-Editor und ist nicht im Repo versioniert.
- Externe Systeme wie n8n, GTM, GA4, Consent, CRM und Cal.com sind aktuell nur teilweise im Repo dokumentiert.
- `SKILL.md` bleibt vorerst im Repo-Root, solange sein technischer Consumer nicht sauber migriert ist.
