# Skills Matrix

Quick-reference for choosing the right skill. Sorted by area.

## How to Read

- **Cost**: `light` (~30 lines context), `medium` (~40-70 lines), `heavy` (100+ lines)
- **Trigger**: When to reach for this skill
- **Model hint**: Suggested Claude model for token efficiency

## SEO & Content

| Skill | Cost | Trigger | Model Hint |
|-------|------|---------|------------|
| `seo-agent` | light | Any SEO task (dispatcher) | sonnet |
| `seo-live-qa` | light | Post-deploy SEO checks, reindex, redirects | sonnet |
| `seo-cockpit-hardening` | medium | Cockpit modules, render helpers, Koko | sonnet |
| `internal-linking-audit` | medium | Orphan pages, link equity, anchor text | sonnet |
| `pillar-cornerstone-writer` | light | Long-form articles, SEO packaging | sonnet |

## CRO & Design

| Skill | Cost | Trigger | Model Hint |
|-------|------|---------|------------|
| `b2b-design-system` | heavy | UI components, layout, colors, motion | sonnet |
| `wordpress-cro-content-design-audit` | medium | Page critiques, CTA hierarchy, proof strategy | sonnet |
| `growth-audit-optimizer` | medium | /growth-audit/ page improvements | sonnet |
| `landing-page-builder` | medium | New ad landing pages, campaign pages | sonnet |
| `homepage-proof-monitoring` | light | Homepage proof layer after releases | haiku |

## Architecture & Operations

| Skill | Cost | Trigger | Model Hint |
|-------|------|---------|------------|
| `wordpress-growth-architecture` | heavy | Positioning, offer architecture, repo-vs-editor | opus |
| `wordpress-performance-marketing` | light | Full audit across SEO+CRO+tracking+content | sonnet |
| `navigation-migration` | light | Header routing, WordPress admin follow-up | haiku |
| `page-speed-audit` | medium | Core Web Vitals, LCP/CLS/INP | sonnet |

## QA & Deploy

| Skill | Cost | Trigger | Model Hint |
|-------|------|---------|------------|
| `pre-deploy-smoke` | light | Before every git push | haiku |
| `registry-release-qa` | light | Glossary/WGOS registry changes | haiku |

## Shared References

| File | Purpose |
|------|---------|
| `docs/standards/BRAND_AND_COPY.md` | Positioning, tone, copy direction, anti-patterns |
| `AGENTS.md` | Global contract, stack, boundaries, required patterns |
| `blocksy-child/CONTEXT.md` | Theme-wide context |
