---
name: wordpress-cro-content-design-audit
description: Audit hasimuener.de pages from content design, CRO, and information-architecture perspectives. Use when the user asks for page critiques, conversion recommendations, CTA hierarchy fixes, homepage or service-page analysis, proof strategy, section ordering, or decision-maker copy improvements in the Blocksy child theme.
---

# WordPress CRO Content Design Audit

Use this skill when the task is not only visual polish. The goal is to decide whether a page explains the offer clearly, builds trust fast enough, and moves the right visitor into the next step.

## Primary Scope

- `blocksy-child/front-page.php`
- `blocksy-child/inc/shortcodes.php`
- `blocksy-child/page-*.php`
- `blocksy-child/template-parts/footer-cta.php`
- `blocksy-child/template-parts/trust-section.php`
- `blocksy-child/assets/css/*.css`
- supporting system docs such as `SYSTEM_MAP.md`

Always classify the page first:

- `Editor-driven wrapper`
- `Hardcoded template`
- `Shared partial`

That classification determines whether the recommendation belongs in Git, WordPress editor work, or both.

## Audit Lenses

Review the page in this order:

1. `Message clarity`
   Does the first screen say who the offer is for, what changes, and why this approach is different?
2. `Intent match`
   Does the page answer the likely arrival intent, or does it force the visitor through unrelated framing first?
3. `CTA hierarchy`
   Is there one clear primary action per section, with secondary actions clearly demoted?
4. `Proof density`
   Are claims supported by proof, mechanism, specificity, or trustworthy constraints?
5. `Friction and scannability`
   Is the page easy to parse in under 20 seconds on desktop and mobile?
6. `Offer architecture`
   Does the page reinforce `Audit -> Blueprint -> Implementation/Retainer` instead of fragmenting into service clutter?
7. `Visual weight`
   Does the layout help comprehension, or does glass, card stacking, and ornament add drag?

## Non-Negotiables

- Keep the primary path diagnosis-first.
- Do not reintroduce broad agency language when it weakens the role.
- Prefer one strong proof surface over multiple weak trust fragments.
- Reduce CTA drift before adding new sections.
- Separate findings into `Repo`, `Manual WP`, and `Operational` follow-up.

## Default Fix Order

1. Hero promise and first CTA
2. Proof placement and trust language
3. Section order and repeated friction
4. Offer ladder clarity
5. Only then visual polish and microcopy

## Expected Output

Present recommendations in these buckets:

- `Critical`
- `High leverage`
- `Polish`
- `Manual WordPress tasks`

When editing, name the exact files changed and call out any editor-owned sections that still require manual follow-up.
