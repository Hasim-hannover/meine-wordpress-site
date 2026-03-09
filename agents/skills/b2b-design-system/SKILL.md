---
name: b2b-design-system
description: Premium UX/UI design system and CRO framework for B2B WordPress websites. Use when designing, building, redesigning, or optimizing a B2B page, landing page, section, hero, proof module, CTA surface, trust signal, layout, or component, or when the user asks to improve visual quality, hierarchy, spacing, typography, color, motion, dark mode, light mode, "above the fold", "conversion optimization", "CRO", "trust signals", "modern design", "premium look", "SaaS design", or says "make this look better". Prefer this skill over generic frontend-design for B2B contexts.
---

# B2B Design System

Use this skill to ship B2B interfaces that feel engineered and convert. Default to dark-mode-first, mobile-first, and a single primary CTA per page.

## Design Direction

Aim for engineered elegance: precision plus warmth, not cold minimalism and not loud ornament.

Color philosophy: warm graphite, cream vellum, and a single copper trace.

Use these benchmark instincts without copying layouts:

- `Linear` for density, clarity, and precision
- `Vercel` for typography and negative space
- `Stripe` for layered depth and premium texture
- `Raycast` for refined dark UI and interaction polish

Hard bans:

- no purple-on-white gradient SaaS sludge
- no Inter/Roboto/Arial as the primary typeface
- no generic logo bars, stock-photo heroes, or testimonial carousels
- no mixed radius systems or random shadow styles
- no centered text blocks wider than roughly `680px`

## Preflight

1. Define the conversion goal before choosing patterns.
2. Classify the page as hero, proof, mechanism, offer, objection, or final CTA.
3. Map ownership before editing.
   In this repo, design tokens usually live in `blocksy-child/assets/css/design-system.css`, page styling in `blocksy-child/assets/css/*.css`, shared homepage/service surfaces in `blocksy-child/inc/shortcodes.php`, and template structure in `blocksy-child/page-*.php` or `blocksy-child/template-parts/`.
4. Read only the references needed for the task:
   - `references/components.md` for hero, proof, offer, FAQ, and CTA patterns
   - `references/design-tokens.md` for typography, spacing, color, radius, and elevation
   - `references/motion.md` for reveal, hover, and reduced-motion behavior

## Workflow

1. Set the conversion hierarchy.
   Hero first, then proof, mechanism, offer, objection handling, and final CTA.
2. Select one coherent token set.
   Use the `Monochrom-Warm + Copper` palette, one radius personality, and at most two font families.
3. Build the first screen around one outcome.
   Above the fold must include headline, sub-headline, primary CTA, and at least one trust signal.
4. Keep proof within one scroll.
   Use numbers, client evidence, or a case teaser before the user scrolls twice.
5. Implement with the lightest possible stack.
   Prefer CSS and existing theme utilities over new JS. In this repo, reuse `NexusCore` for reveal, counters, smooth scroll, and theme behavior before adding scripts.
6. Validate both dark and light mode.
   Light mode must be tuned, not merely inverted.

## Color Architecture

The palette is `Monochrom-Warm + Copper`. It has only two axes:

- Warm neutrals carry every background, surface, border, divider, and default text value.
- Copper is the only chromatic accent and is reserved for CTA fills, links, active states, and focus treatment.

Apply these rules every time:

- Keep dark backgrounds on the `1 / 3 / 5 / 8 / 11 / 14` lightness ladder.
- Keep light backgrounds on the `88 / 90 / 93 / 96 / 98 / 99` lightness ladder.
- Keep neutral hue around `30` in dark mode and `35` in light mode, easing saturation as the surfaces get lighter.
- Treat `--accent-hsl` as the pigment anchor, `--accent` as the button or control fill, and `--accent-text` as the contrast-safe inline copper token.
- In light mode, copper fill must step darker than the brand anchor so white button labels and cream-surface contrast both hold up.
- Do not invent a third metallic, earthy, or decorative palette. All hierarchy lives inside warm neutrals plus copper.

## Shadows

Shadows are warm-tinted, never cool. Use hue `30` for all shadow pigments.

Dark mode:

- `--shadow-sm`: `0 1px 2px hsl(30 25% 2% / 0.36)`
- `--shadow-md`: `0 8px 24px hsl(30 25% 2% / 0.42)`
- `--shadow-lg`: `0 18px 48px hsl(30 25% 2% / 0.52)`
- `--shadow-xl`: `0 28px 72px hsl(30 25% 2% / 0.58)`

Use border contrast and background-lightness as the primary elevation mechanism. Shadows stay restrained.

Light mode:

- `--shadow-sm`: `0 1px 2px hsl(30 18% 24% / 0.06), 0 4px 10px hsl(30 14% 18% / 0.04)`
- `--shadow-md`: `0 10px 30px hsl(30 18% 24% / 0.10), 0 4px 12px hsl(30 14% 18% / 0.06)`
- `--shadow-lg`: `0 22px 60px hsl(30 18% 24% / 0.14), 0 10px 24px hsl(30 14% 18% / 0.08)`
- `--shadow-xl`: `0 34px 84px hsl(30 18% 24% / 0.18), 0 14px 32px hsl(30 14% 18% / 0.10)`

In light mode, shadows are the primary elevation signal and should do more work than borders.

## Anti-Patterns

- Any CTA color except Copper.
- Copper used as decorative surface fill, ambient section wash, or large background tint.
- Semantic hues promoted to the primary CTA role.
- Cool blue-grey shadows or cool neutral ramps mixed into the system.
- Multiple accent families on one page.

## Non-Negotiables

- Keep one primary CTA per page and repeat it instead of competing with it.
- Keep CTA contrast as the strongest contrast on screen.
- Keep the palette on two axes only: warm neutrals plus copper.
- Keep social proof above the second scroll.
- Keep first-contact forms at three fields or fewer unless the user explicitly needs more.
- Respect `prefers-reduced-motion`.
- Do not introduce purple-on-white gradients, generic stock-photo heroes, evenly weighted card grids, or mixed border-radius systems.

## Quality Gate

Before finishing, verify:

- max two font families
- selected token direction is `Monochrom-Warm + Copper`
- one copper accent family
- one radius personality
- same token names in dark and light mode
- copper limited to CTA fills, links, active states, and focus treatment
- generous section spacing on the 8px grid
- WCAG AA text contrast
- visible above-fold CTA and trust signal
- responsive mobile CTA access
- no unnecessary JS or animation debt

## Delivery Format

When finishing substantial work, report:

- the conversion goal
- the selected design-token direction
- the repo changes made
- manual WordPress follow-up if any
- residual risks such as editor-owned copy, missing proof assets, or untested templates

## References

- `references/components.md`
- `references/design-tokens.md`
- `references/motion.md`
