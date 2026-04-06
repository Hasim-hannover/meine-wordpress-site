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

## Quick Reference

See `SKILLS_MATRIX.md` for the full routing table with cost, triggers, and model hints.

## Shared Standards

All skills reference `docs/standards/BRAND_AND_COPY.md` for positioning, tone, and copy direction.
Do not duplicate brand rules in individual `SKILL.md` files.

## SEO Routing

Use `seo-agent` as the entry point for any SEO task. It dispatches to the correct sub-skill.

## Current Skills

- `seo-agent` (dispatcher)
- `seo-live-qa`
- `seo-cockpit-hardening`
- `internal-linking-audit`
- `pillar-cornerstone-writer`
- `wordpress-performance-marketing`
- `homepage-proof-monitoring`
- `registry-release-qa`
- `navigation-migration`
- `pre-deploy-smoke`
- `landing-page-builder`
- `page-speed-audit`
- `b2b-design-system`
- `growth-audit-optimizer`
- `wordpress-growth-architecture`
- `wordpress-cro-content-design-audit`
