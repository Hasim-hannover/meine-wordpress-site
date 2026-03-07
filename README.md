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
2. `SYSTEM_MAP.md`
3. `LIVE_STATUS.md`
4. `AGENT_CONTEXT.md`
5. die passende Detaildoku unter `docs/systems/`

## Repo-Logik

| Ebene | Zweck | Hauptorte |
| --- | --- | --- |
| Betrieb | Status, Entscheidungen, Playbooks, Betriebswissen | `LIVE_STATUS.md`, `docs/playbooks/`, `docs/decisions/` |
| Technik | deploybarer Website-Code und technische Systemlogik | `blocksy-child/`, `.github/workflows/` |
| Wissen | Positionierung, Funnel-Kontext, Content, Agenten- und Prompt-Wissen | `SYSTEM_MAP.md`, `AGENT_CONTEXT.md`, `content/`, `agents/`, `prompts/` |
| Automation | versionierbare Workflow-Exporte und Flow-Doku | `automations/n8n/` |

## Struktur

```text
.
├── README.md
├── SYSTEM_MAP.md
├── AGENT_CONTEXT.md
├── LIVE_STATUS.md
├── SKILL.md
├── blocksy-child/
├── automations/
│   └── n8n/
├── agents/
│   └── skills/
├── content/
│   └── blog-drafts/
├── docs/
│   ├── decisions/
│   ├── playbooks/
│   ├── references/
│   └── systems/
├── prompts/
└── .github/workflows/
```

## Was wo liegt

- `blocksy-child/`: Live-Theme fuer WordPress, inklusive Templates, Assets, Schema, CTA-Bausteinen und Website-Logik.
- `automations/n8n/`: Zielort fuer exportierte n8n-Workflows, Flow-Maps und menschlich lesbare Workflow-Doku.
- `docs/systems/`: fachliche und technische Systemdokumentation.
- `docs/playbooks/`: manuelle Betriebsablaeufe fuer WordPress-Admin, Migrationen und Rollouts.
- `docs/references/`: lose HTML-, Snippet- oder Referenz-Artefakte, die nicht direkt Live-Code sind.
- `content/`: vorbereitete Inhalte, die noch nicht sauber in WordPress oder in die finale Systemstruktur ueberfuehrt wurden.
- `agents/`: Agenten-spezifische Artefakte wie Skills, Operating Notes und kuenftige Agenten-Assets.
- `prompts/`: wiederverwendbare Prompt-Bausteine, Briefings und Task-Patterns.

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
