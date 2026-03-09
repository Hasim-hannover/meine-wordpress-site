# Design Tokens

Use this file when the task is mainly visual: typography, spacing, color, surfaces, borders, or elevation.

## Typography Scale

Use a modular scale around `1.25`:

```css
--font-size-xs: 0.75rem;
--font-size-sm: 0.875rem;
--font-size-base: 1rem;
--font-size-md: 1.125rem;
--font-size-lg: 1.25rem;
--font-size-xl: 1.5rem;
--font-size-2xl: 2rem;
--font-size-3xl: 2.5rem;
--font-size-4xl: 3.25rem;
--font-size-5xl: 4rem;
```

Use these pairings when new font assets are justified:

- Technical: `JetBrains Mono` + `Satoshi` or `Plus Jakarta Sans`
- Editorial: `Instrument Serif` + `Satoshi`
- Modern clean: `Plus Jakarta Sans`
- Bold statement: `Clash Display` + `General Sans`
- Refined: `Sora` + `DM Sans`
- German B2B: `Bricolage Grotesque` + `Figtree`

Never choose `Inter`, `Roboto`, `Open Sans`, `Lato`, `Montserrat`, `Poppins`, `Arial`, or `system-ui` as the primary family.

If the repo already self-hosts a non-banned pair and performance matters more than a font migration, preserve the existing assets and improve hierarchy first.

## Spacing System

Stay on an 8px grid:

```css
--space-1: 0.25rem;
--space-2: 0.5rem;
--space-3: 0.75rem;
--space-4: 1rem;
--space-5: 1.25rem;
--space-6: 1.5rem;
--space-8: 2rem;
--space-10: 2.5rem;
--space-12: 3rem;
--space-16: 4rem;
--space-20: 5rem;
--space-24: 6rem;
--space-32: 8rem;
```

Rules:

- Section padding: `80px` to `128px`
- Component gaps: `16px` to `32px`
- Inline spacing: `8px` to `16px`
- More space usually reads more premium if the hierarchy stays tight

## Color Philosophy

Monochrom-Warm + Copper: warm graphite, cream vellum, and a single copper trace.

## Color Architecture

The system has only two axes:

- Warm neutrals on hue `30` to `35`, with saturation stepping down as lightness rises.
- Copper on hue `22`, reserved for CTA fills, links, active states, and focus treatment.

Dark-mode backgrounds follow a measured progression of `1 / 3 / 5 / 8 / 11 / 14` lightness. Light-mode backgrounds follow `88 / 90 / 93 / 96 / 98 / 99` lightness. Keep the token names identical in both modes and do not introduce a third metallic or earthy track.

### Dark Mode Tokens

```css
:root,
[data-theme="dark"] {
  /* Backgrounds */
  --bg-inset: hsl(30 6% 1%); /* Deepest wells, media frames, and app gutters. */
  --bg-base: hsl(30 6% 3%); /* Primary page background and full-bleed canvas. */
  --bg-subtle: hsl(30 5% 5%); /* Slightly lifted bands behind grouped content. */
  --bg-surface: hsl(30 4% 8%); /* Default card, section, and input surface. */
  --bg-elevated: hsl(30 3% 11%); /* Hovered cards, drawers, and layered panels. */
  --bg-overlay: hsl(30 2% 14%); /* Modal backplates and strong overlay surfaces. */

  /* Text */
  --text-primary: hsl(30 3% 94%); /* Main copy and headings on dark surfaces. */
  --text-secondary: hsl(30 2% 56%); /* Supporting copy, labels, and metadata. */
  --text-tertiary: hsl(30 2% 43%); /* Quiet captions, separators, and disabled text. */
  --text-inverse: hsl(0 0% 100%); /* Highest-contrast label for copper-filled controls. */

  /* Borders */
  --border-subtle: hsl(30 5% 16%); /* Hairlines between adjacent dark surfaces. */
  --border-default: hsl(30 5% 22%); /* Standard card, field, and divider stroke. */
  --border-emphasis: hsl(30 5% 30%); /* Strong outline for selected or sticky UI. */
  --border-accent: hsl(30 6% 38%); /* Premium neutral outline when accent-adjacent UI needs lift without extra chroma. */

  /* Accent */
  --accent-hsl: 22 70% 48%; /* Brand copper anchor for derived UI steps. */
  --accent: hsl(22 67% 44%); /* Primary copper fill for CTA buttons and active controls. */
  --accent-hover: hsl(22 69% 40%); /* Pressed and hover copper fill with stronger label contrast. */
  --accent-muted: hsl(22 38% 26%); /* Low-energy copper for restrained badges and data markers. */
  --accent-subtle: hsl(22 67% 44% / 0.14); /* Transparent copper wash for selected states, never full panels. */
  --accent-text: hsl(22 70% 47%); /* Brighter inline copper for links and small text on near-black surfaces. */

  /* Interactive */
  --hover-overlay: hsl(30 10% 96% / 0.06); /* Neutral lift layered over cards and buttons on hover. */
  --active-overlay: hsl(30 10% 96% / 0.1); /* Stronger neutral press state for dense UI. */
  --focus-ring: hsl(22 67% 44% / 0.38); /* Copper halo reserved for keyboard focus visibility. */

  /* Semantic */
  --success: hsl(148 36% 42%); /* Restrained confirmation hue that stays secondary to copper. */
  --warning: hsl(46 74% 55%); /* Amber caution hue, separated from copper on the hue axis. */
  --error: hsl(6 58% 55%); /* Muted critical hue with clear distance from copper. */
  --info: hsl(212 28% 58%); /* Steel-blue informational cue for neutral system messaging. */

  /* Gradients */
  --gradient-surface: linear-gradient(180deg, hsl(30 5% 10%) 0%, hsl(30 4% 7%) 100%); /* Neutral surface depth for panels and strips. */
  --gradient-glow: radial-gradient(circle at top, hsl(30 6% 18% / 0.32) 0%, hsl(30 4% 8% / 0) 70%); /* Warm ambient glow without extra chroma. */
  --gradient-hero: linear-gradient(135deg, hsl(30 6% 4%) 0%, hsl(30 4% 8%) 50%, hsl(30 3% 12%) 100%); /* Large-format hero backdrop with stacked neutral depth. */
  --gradient-warm: linear-gradient(180deg, hsl(35 8% 13%) 0%, hsl(30 5% 6%) 100%); /* Warm atmospheric wash for premium sections. */
}
```

### Light Mode Tokens

```css
[data-theme="light"] {
  /* Backgrounds */
  --bg-inset: hsl(35 14% 88%); /* Recessed wells, app chrome, and muted table bands. */
  --bg-base: hsl(35 12% 90%); /* Main cream canvas for light-mode pages. */
  --bg-subtle: hsl(35 10% 93%); /* Quiet section split and low-pressure striping. */
  --bg-surface: hsl(35 8% 96%); /* Standard cards, forms, and content panels. */
  --bg-elevated: hsl(35 6% 98%); /* Raised panels that rely on shadow for lift. */
  --bg-overlay: hsl(35 4% 99%); /* Modal sheets and overlay surfaces on light mode. */

  /* Text */
  --text-primary: hsl(30 10% 10%); /* Main copy and headings on cream surfaces. */
  --text-secondary: hsl(30 8% 36%); /* Supporting copy, body metadata, and helper text. */
  --text-tertiary: hsl(30 6% 46%); /* Quiet labels, dividers, and low-priority text. */
  --text-inverse: hsl(0 0% 100%); /* White label used on copper-filled controls. */

  /* Borders */
  --border-subtle: hsl(35 8% 82%); /* Hairline separation on the light canvas. */
  --border-default: hsl(35 8% 74%); /* Standard card, field, and divider stroke. */
  --border-emphasis: hsl(35 8% 64%); /* Strong neutral outline for selected surfaces. */
  --border-accent: hsl(35 10% 54%); /* Warm neutral outline for premium emphasis without chroma bleed. */

  /* Accent */
  --accent-hsl: 22 70% 48%; /* Brand copper anchor for derived UI steps. */
  --accent: hsl(22 70% 40%); /* Darker copper fill required for cream-background CTA contrast. */
  --accent-hover: hsl(22 72% 36%); /* Hover and pressed copper fill for stronger button hierarchy. */
  --accent-muted: hsl(22 42% 74%); /* Soft copper tint for restrained badges and indicators. */
  --accent-subtle: hsl(22 70% 40% / 0.12); /* Transparent copper wash for selected states and chips. */
  --accent-text: hsl(22 75% 36%); /* Inline copper for links and small text on cream backgrounds. */

  /* Interactive */
  --hover-overlay: hsl(30 10% 10% / 0.04); /* Neutral hover wash layered over light surfaces. */
  --active-overlay: hsl(30 10% 10% / 0.08); /* Stronger neutral press state. */
  --focus-ring: hsl(22 75% 36% / 0.28); /* Copper focus halo tuned for the light canvas. */

  /* Semantic */
  --success: hsl(148 42% 34%); /* Restrained confirmation hue that stays secondary to copper. */
  --warning: hsl(46 78% 41%); /* Amber caution hue with clear separation from copper. */
  --error: hsl(6 64% 42%); /* Muted critical hue with enough distance from copper. */
  --info: hsl(212 32% 42%); /* Steel-blue informational cue for neutral system messaging. */

  /* Gradients */
  --gradient-surface: linear-gradient(180deg, hsl(35 10% 97%) 0%, hsl(35 8% 94%) 100%); /* Soft neutral surface depth for panels and strips. */
  --gradient-glow: radial-gradient(circle at top, hsl(35 18% 99% / 0.92) 0%, hsl(35 8% 96% / 0) 72%); /* Warm ambient glow without introducing chroma. */
  --gradient-hero: linear-gradient(135deg, hsl(35 14% 92%) 0%, hsl(35 8% 97%) 55%, hsl(35 6% 99%) 100%); /* Large-format hero backdrop with layered cream depth. */
  --gradient-warm: linear-gradient(180deg, hsl(35 18% 95%) 0%, hsl(30 12% 90%) 100%); /* Warm neutral wash for premium section breaks. */
}
```

## Contrast Validation

Dark mode note: with `--bg-base` held at `3%` lightness and copper constrained to a mid-value accent, no single copper swatch can exceed `4.5:1` against both `--bg-base` and pure white at the same time because the page-base-to-white ceiling is `20.06:1`. The chosen dark `--accent` is the closest balanced midpoint for fill use; use `--accent-text` for inline copper on dark surfaces.

### Dark Mode Ratios

| Combination | Ratio | Target | Result |
| --- | ---: | ---: | --- |
| `--text-primary` on `--bg-base` | `17.57:1` | `14:1` | Pass |
| `--text-primary` on `--bg-surface` | `16.06:1` | `12:1` | Pass |
| `--text-secondary` on `--bg-base` | `6.21:1` | `6:1` | Pass |
| `--text-secondary` on `--bg-surface` | `5.68:1` | `5:1` | Pass |
| `--text-tertiary` on `--bg-base` | `3.93:1` | `3.5:1` | Pass |
| `--accent` on `--bg-base` | `4.48:1` | `4.5:1` | Closest feasible midpoint |
| `--accent` on `--bg-surface` | `4.09:1` | `3.5:1` | Pass |
| `--text-inverse` on `--accent` | `4.48:1` | `4.5:1` | Closest feasible midpoint |
| `--accent-text` on `--bg-base` | `5.08:1` | `4.5:1` | Pass |
| `--accent-text` on `--bg-surface` | `4.64:1` | `4.5:1` | Pass |

### Light Mode Ratios

| Combination | Ratio | Target | Result |
| --- | ---: | ---: | --- |
| `--text-primary` on `--bg-base` | `14.00:1` | `14:1` | Pass |
| `--text-primary` on `--bg-surface` | `15.98:1` | `12:1` | Pass |
| `--text-secondary` on `--bg-base` | `5.30:1` | `5:1` | Pass |
| `--text-tertiary` on `--bg-base` | `3.63:1` | `3.5:1` | Pass |
| `--accent` on `--bg-base` | `4.17:1` | `3.5:1` | Pass |
| `--accent` on `--bg-surface` | `4.77:1` | `3.5:1` | Pass |
| `--accent-text` on `--bg-base` | `4.84:1` | `4.5:1` | Pass |
| `--accent-text` on `--bg-surface` | `5.53:1` | `4.5:1` | Pass |
| `--text-inverse` on `--accent` | `5.20:1` | `4.5:1` | Pass |

## Radius System

Use one radius system per page or project:

```css
--radius-sm: 4px;
--radius-md: 8px;
--radius-lg: 12px;
--radius-xl: 16px;
--radius-full: 9999px;
```

Choose one personality:

- Sharp: `2 / 4 / 6`
- Soft: `6 / 10 / 16`
- Round: `8 / 12 / 20`

Mixing sharp and soft component families is an amateur tell.

## Shadows and Elevation

Dark mode still relies on border plus background-lightness first. Shadows stay understated and warm-tinted with hue `30`.

```css
:root,
[data-theme="dark"] {
  --shadow-sm: 0 1px 2px hsl(30 25% 2% / 0.36); /* Tight shadow for menus, pills, and sticky edges. */
  --shadow-md: 0 8px 24px hsl(30 25% 2% / 0.42); /* Standard shadow for drawers and raised cards. */
  --shadow-lg: 0 18px 48px hsl(30 25% 2% / 0.52); /* Deep shadow for modals and large overlays. */
  --shadow-xl: 0 28px 72px hsl(30 25% 2% / 0.58); /* Maximum shadow for hero modals and full-screen takeovers. */
}
```

Light mode uses shadows as the primary elevation signal. Keep them warm, layered, and never blue-grey.

```css
[data-theme="light"] {
  --shadow-sm: 0 1px 2px hsl(30 18% 24% / 0.06), 0 4px 10px hsl(30 14% 18% / 0.04); /* Baseline lift for cards and inputs. */
  --shadow-md: 0 10px 30px hsl(30 18% 24% / 0.1), 0 4px 12px hsl(30 14% 18% / 0.06); /* Default panel elevation on the cream canvas. */
  --shadow-lg: 0 22px 60px hsl(30 18% 24% / 0.14), 0 10px 24px hsl(30 14% 18% / 0.08); /* High-lift panels, flyouts, and proof blocks. */
  --shadow-xl: 0 34px 84px hsl(30 18% 24% / 0.18), 0 14px 32px hsl(30 14% 18% / 0.1); /* Largest premium surfaces such as hero cards and modals. */
}
```

## Practical Repo Guidance

- Prefer token edits in `blocksy-child/assets/css/design-system.css`
- Keep page exceptions in the page stylesheet instead of hardcoding new one-off values everywhere
- Web fonts should usually stay at two weights max

## Accessibility Check

- Body text must hit WCAG AA contrast
- CTA should be the highest-contrast actionable element
- Use `--accent-text`, not `--accent`, for small copper links on light surfaces
- Avoid gradient text on light backgrounds
- Do not hide structure behind ultra-soft borders
