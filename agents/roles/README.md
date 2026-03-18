# Agent Roles

Rollen sind nur noch Kurzlabels. Detaillierte Arbeitslogik lebt in `AGENTS.md`, lokalen `CONTEXT.md`-Dateien und Skills.

## Pflichtkontext

1. `AGENTS.md`
2. `docs/architecture/SYSTEM_MAP.md`
3. `docs/architecture/LIVE_STATUS.md`
4. das passende lokale `CONTEXT.md`

## Rollenmatrix

| Rolle | Wann verwenden | Primäre Orte | Bevorzugte Skills |
| --- | --- | --- | --- |
| `Audit` | Audit-Funnel, Diagnose, Deep-Dive-Bruecke | `docs/systems/audit-funnel.md`, `automations/n8n/`, `blocksy-child/assets/js/` | `wordpress-performance-marketing`, `registry-release-qa` |
| `CRO` | CTA-Hierarchie, Proof, Form-Reibung | `blocksy-child/template-parts/`, `blocksy-child/inc/shortcodes.php` | `wordpress-cro-content-design-audit`, `b2b-design-system`, `homepage-proof-monitoring` |
| `SEO` | Meta, Schema, interne Verlinkung, kaufnahe Sichtbarkeit | `blocksy-child/inc/seo-meta.php`, `blocksy-child/inc/org-schema.php`, `docs/seo/` | `seo-live-qa`, `wordpress-performance-marketing`, `seo-cockpit-hardening` |
| `Content` | Drafts, Cornerstones, CTA-Bridges | `content/`, `blocksy-child/category.php`, `blocksy-child/single.php` | `pillar-cornerstone-writer` |
| `n8n` | Workflows, Webhooks, Contracts, Delivery | `automations/n8n/` | `registry-release-qa` |
| `Tracking` | Event-Hooks, Consent, Measurement | `blocksy-child/inc/helpers.php`, Templates mit `data-track-*` | `wordpress-performance-marketing`, `homepage-proof-monitoring` |
| `Repo Architect` | Source of truth, Struktur, Statusfuehrung | `AGENTS.md`, `docs/architecture/`, `agents/skills/` | keine, zuerst Root- und lokale Kontexte laden |

## Grundregel

Rollen beschreiben Blickwinkel, nicht eigene Regelwerke. Wenn ein Workflow wiederholt auftritt, entsteht daraus ein Skill statt einer neuen Rollen-Datei.
