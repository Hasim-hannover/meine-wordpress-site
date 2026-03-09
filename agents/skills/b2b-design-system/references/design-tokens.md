# Design Tokens

Use these tokens when the task is mainly visual: typography, spacing, color, surfaces, borders, or elevation.

## Typography

Use a modular scale close to 1.25:

- `12px` caption and labels
- `14px` secondary text
- `16px` body
- `18px` intro copy
- `20px` card titles and small headings
- `24px` `H3`
- `32px` `H2`
- `40px` mobile `H1`
- `52px` desktop `H1`
- `64px` display hero only when the layout can support it

Preferred pairings:

- Technical: `JetBrains Mono` + `Plus Jakarta Sans`
- Editorial: `Instrument Serif` + `Satoshi`
- Modern clean: `Plus Jakarta Sans`
- Bold statement: `Clash Display` + `General Sans`
- Refined: `Sora` + `DM Sans`
- German B2B: `Bricolage Grotesque` + `Figtree`

If the repo already self-hosts a non-banned font stack and introducing new font assets is out of scope, preserve the existing assets and improve hierarchy first.

## Spacing

Stay on an 8px grid:

- `4, 8, 12, 16, 20, 24, 32, 40, 48, 64, 80, 96, 128`

Rules:

- Section padding: `80px` to `128px`
- Component gaps: `16px` to `32px`
- Inline spacing: `8px` to `16px`
- Keep more negative space around primary CTAs than around secondary actions

## Color Architecture

Dark mode is the default:

- `--bg-base`: near-black graphite, not pure black
- `--bg-surface`: slightly lighter for cards and panels
- `--bg-elevated`: hover and active states
- `--text-primary`: near-white
- `--text-secondary`: muted but still readable
- `--border-subtle`: low-contrast stroke for structure

Light mode needs its own tuning:

- use warmer off-whites or cool paper tones
- increase border contrast
- use layered shadows instead of dark-mode border logic
- slightly increase accent saturation to keep energy

Use one accent family only. Good default personalities:

- `Signal` for trust and clarity
- `Ember` for warmth and action
- `Electric` for growth and energy
- `Neutral` for stark minimalism

## Radius

Pick one radius personality for the page or project:

- Sharp: `2 / 4 / 6`
- Soft: `6 / 10 / 16`
- Round: `8 / 12 / 20`

Do not mix sharp inputs with round cards on the same surface family.

## Elevation

Dark mode:

- create depth mainly with background lightness and subtle borders
- keep shadows quiet

Light mode:

- use layered shadows as the main elevation system
- keep borders visible enough to prevent components from floating away

## Accessibility Check

- Body text must hit WCAG AA contrast
- CTA should be the highest-contrast actionable element
- Avoid gradient text on light backgrounds
- Do not hide structure behind low-contrast borders
