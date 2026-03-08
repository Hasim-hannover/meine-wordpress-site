---
name: wordpress-growth-architecture
description: Analyze and refactor hasimuener.de as a hybrid WordPress growth system. Use when tasks touch positioning, offer architecture, homepage/service-page structure, navigation, CRO, or the repo-vs-editor split inside the Blocksy child theme.
---

# WordPress Growth Architecture

Use this skill for strategic and implementation work on `hasimuener.de` when the website must behave like business infrastructure, not like a broad agency brochure.

This project uses a hybrid setup:
- structure, templates, helpers, CSS, JS, and schema live in the repo
- much of the homepage and service-page copy can live in the WordPress editor

The skill exists to keep those layers clean while pushing the brand toward one clear role: `WordPress Growth Architect fuer B2B`.

## Use This Skill When

- The user wants to sharpen positioning, reduce generalist signals, or simplify offers.
- The task touches `blocksy-child/front-page.php`, `page-*.php`, `template-about.php`, `template-parts/`, `inc/`, or `assets/css` and `assets/js`.
- You need to decide whether a change belongs in Git or must be done manually in the WordPress editor.
- The design should be upgraded without becoming visually heavy.
- The site should guide users into a diagnosis-first funnel instead of a service catalog.

## Strategic Defaults

- Optimize for `WordPress Growth Architect`, not for `Agentur`, `Leistungen`, or equal-weight services.
- Keep the business outcome explicit: planable B2B inquiries from owned assets.
- Treat SEO, tracking, privacy/consent, CRO, and WordPress implementation as one connected system.
- Prefer the offer ladder `Audit -> Blueprint -> Implementation/Retainer`.
- Demote or remove broad side topics unless the user explicitly wants them foregrounded.

## Non-Negotiables

- Respect the hybrid model. Do not solve editor-copy problems only in templates if the content is editor-owned.
- Separate changes into `Copy`, `Structure`, `Template`, `Refactor`, and `Manual WP`.
- Remove or demote generic agency wording such as `Leistungen`, `WordPress Specialist`, `Webdesign`, or broad performance-marketing framing when it weakens the core role.
- Keep navigation tight. The site should lead toward diagnosis, proof, and system understanding.
- Design should feel premium, calm, and lighter in weight. Avoid black-box heaviness, excessive glass, or noisy card stacks.

## Workflow

### 1. Map the Active Layer

Inspect the files that usually drive the business-facing experience first:

- `blocksy-child/front-page.php`
- `blocksy-child/inc/shortcodes.php`
- `blocksy-child/inc/menu-setup.php`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/inc/org-schema.php`
- `blocksy-child/template-parts/footer-cta.php`
- `blocksy-child/template-parts/trust-section.php`
- `blocksy-child/page-wordpress-agentur.php`
- `blocksy-child/page-wgos.php`
- relevant `assets/css/*.css` and `assets/js/*.js`

For each relevant page, classify it as:
- `Editor-driven wrapper`
- `Hardcoded template`
- `Shared partial`

That classification determines whether the final answer must include manual WordPress tasks.

### 2. Diagnose Before Editing

Look for:

- generalist or agency framing
- too many primary paths in navigation
- duplicate or contradictory offers
- CTA drift across pages
- schema/slug drift
- copy that sells tactics before diagnosis
- visual density that makes the site feel heavy

Always identify which issues are:
- repo fixes
- editor-copy fixes
- operational fixes in WordPress admin

### 3. Refactor in This Order

1. Navigation and entry points
2. Homepage positioning and offer architecture
3. Core conversion pages and CTA partials
4. Schema, helper links, and technical consistency
5. Visual refinement
6. Only then broader cleanup or modularization

Do not start with cosmetic polish if the information architecture is still wrong.

### 4. Apply the Design Direction

When changing visuals:

- keep strong contrast but move away from pure black heaviness
- use softer graphite surfaces, restrained gold accents, more breathing room
- reduce card noise and excessive borders
- favor one clear focal point above the fold
- make buttons and CTA surfaces feel deliberate, not loud

### 5. Close With Operational Clarity

Every substantial answer should end with:

- what changed in the repo
- what the user must still do manually in WordPress
- which pages likely still depend on editor content
- what should be verified next

## Output Checklist

Before finishing, confirm:

- the site still reads as one coherent position, not as a service catalog
- the 3-stage offer ladder is visible where it matters
- the primary CTA remains diagnosis-first
- repo changes and manual WP changes are clearly separated
- there is no new copy that reintroduces broad agency language

## Reference

Use [hybrid-change-map.md](references/hybrid-change-map.md) when you need a fast reminder of what belongs in Git and what usually needs manual WordPress work.
