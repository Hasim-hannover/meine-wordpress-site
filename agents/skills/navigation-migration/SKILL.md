---
name: navigation-migration
description: Execute or review the remaining manual WordPress navigation and homepage migration tasks. Use when the repo changed header routing, CTA hierarchy, or homepage structure but WordPress admin follow-up is still required.
---

# Navigation Migration

Use this skill for post-deploy WordPress admin work, not for template refactors alone.

## Run First

```bash
agents/skills/navigation-migration/scripts/print-checklist.sh
```

## Manual Targets

- Main menu must stay flat and audit-first.
- Homepage editor order must match the current proof and CTA hierarchy.
- Legacy menu or footer links must not reintroduce old audit, case, or booking paths.

## Deliver

- What is already versioned in Git
- What still needs manual WordPress admin work
- What should be re-checked on desktop and mobile after deploy
