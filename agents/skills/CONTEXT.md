# Skills Context

Scope: `agents/skills/`

## Skill Contract

- One skill per directory
- Required file: `SKILL.md`
- Optional helpers: `scripts/`, `references/`, `agents/`
- No single-file root skills

## Rules

- Keep `SKILL.md` short: when to use, what to run, what to deliver.
- Push repeated checklist generation, diff detection, or scaffolding into `scripts/`.
- Prefer scripts that consume repo state over long prose instructions.
- If a skill replaces a playbook, update references and delete the old playbook.

## Current High-Value Skills

- `pillar-cornerstone-writer`
- `wordpress-performance-marketing`
- `homepage-proof-monitoring`
- `registry-release-qa`
- `navigation-migration`
- `seo-live-qa`
- `seo-cockpit-hardening`
