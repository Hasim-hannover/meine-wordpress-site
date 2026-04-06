---
name: seo-agent
description: >
  SEO dispatcher that routes to the right sub-skill based on the task.
  Use this skill for any SEO-related work instead of picking a sub-skill manually.
context: light
preload: none
---

# SEO Agent

Dispatcher for all SEO work. Analyzes the task, selects the right sub-skill, and executes.

## When to Use

Any time the task involves SEO: technical audits, internal linking, meta/schema, rankings, Search Console, content strategy, or cockpit work.

## Run First

```bash
sh agents/skills/seo-agent/scripts/route.sh
```

## Routing Table

| Signal in Task | Route to Skill | Context to Load |
|---|---|---|
| Live SEO check, reindex, redirects, canonicals, Search Console | `seo-live-qa` | `seo-live-qa/SKILL.md` |
| SEO Cockpit, render helpers, Koko, internal link graph module | `seo-cockpit-hardening` | `seo-cockpit-hardening/SKILL.md` + `docs/systems/seo-cockpit.md` |
| Orphan pages, link equity, cross-links, anchor text | `internal-linking-audit` | `internal-linking-audit/SKILL.md` |
| Full performance-marketing audit (SEO + CRO + tracking) | `wordpress-performance-marketing` | `wordpress-performance-marketing/SKILL.md` |
| Cornerstone content, pillar articles, SEO packaging | `pillar-cornerstone-writer` | `pillar-cornerstone-writer/SKILL.md` |
| Page speed, Core Web Vitals, LCP/CLS/INP | `page-speed-audit` | `page-speed-audit/SKILL.md` |

## Decision Rules

1. Match the task against the **Signal** column above.
2. If multiple signals match, prefer the more specific skill over the broader one.
3. Load only the routed skill's `SKILL.md` — do not preload all SEO skills.
4. For brand/copy direction, reference `docs/standards/BRAND_AND_COPY.md` instead of inlining rules.
5. If no signal matches, default to `seo-live-qa`.

## Deliver

- Name the routed skill in your first response line
- Follow the routed skill's delivery format exactly
- Separate repo fixes from editor/admin/Search Console tasks
