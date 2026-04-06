---
name: growth-audit-optimizer
description: Optimize the active /growth-audit/ page for CRO, positioning, trust, and next-step conversion without drifting into legacy 48h intake logic.
---

# Growth Audit Optimizer

Use this skill when the task is to analyze or improve the active `/growth-audit/` experience in the WordPress repo.

Run first:

```bash
sh agents/skills/growth-audit-optimizer/scripts/print-scope.sh
```

## Focus

- Treat the active route as an instant-results flow, not the legacy 48h intake.
- Use `60 Sekunden` as the timing baseline.
- Keep the positioning centered on `WordPress`, `B2B`, `Leads`, `Conversion`, `Tracking`, `SEO`, and `Nachfrage-Systeme`.
- Remove stale Shopify references if they still appear in the audit context.
- Frame the page as a strategic diagnosis entry point, not as a gimmicky free tool.

## Default Workflow

1. Identify the active render path before changing copy.
2. Search audit-relevant strings across template, helper, JS, CSS, and SEO layers.
3. Remove stale `30 Sekunden`, `48h`, manual-feedback, CRM-intake, or Shopify carryover from the active flow.
4. Sharpen hero, trust, expectation-setting, and result-to-next-step CTA logic.
5. Align active metadata and shared audit CTA copy when they still point at outdated framing.

## Copy Direction

See `docs/standards/BRAND_AND_COPY.md` for full tone, preferred terms, and anti-patterns.
Additional audit-specific rule: avoid old 48h/manual-review language in the active flow.

## Deliver

- Repo-side implementation in the active files
- Short note with changed files, removed copy debt, hero/trust/CTA upgrades, and any remaining legacy risks
