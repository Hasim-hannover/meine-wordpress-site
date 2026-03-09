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

## Color Architecture

Dark mode is the default and should use near-black graphite, not pure black:

```css
--bg-base: hsl(220 14% 6%);
--bg-surface: hsl(220 14% 9%);
--bg-elevated: hsl(220 14% 12%);
--bg-overlay: hsl(220 14% 15%);
--text-primary: hsl(0 0% 93%);
--text-secondary: hsl(0 0% 63%);
--border-subtle: hsl(220 14% 16%);
--border-strong: hsl(220 14% 22%);
```

Light mode needs separate tuning:

```css
--bg-base: hsl(0 0% 99%);
--bg-surface: hsl(220 14% 97%);
--text-primary: hsl(220 14% 10%);
--text-secondary: hsl(220 10% 40%);
--border-subtle: hsl(220 10% 88%);
```

Use one accent family only:

- `Electric`: `hsl(145 70% 55%)` dark, `hsl(145 75% 35%)` light
- `Signal`: `hsl(200 95% 55%)` dark, `hsl(200 100% 40%)` light
- `Ember`: `hsl(25 95% 60%)` dark, `hsl(25 100% 45%)` light
- `Violet`: allowed only when the rest of the system is very disciplined
- `Neutral`: stark black/white confidence

Do not spread accent color across decorative noise. Reserve it for CTA, links, active states, and a small amount of emphasis.

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

Dark mode:

```css
--shadow-sm: 0 1px 2px hsla(0, 0%, 0%, 0.3);
--shadow-md: 0 4px 12px hsla(0, 0%, 0%, 0.4);
--shadow-lg: 0 8px 30px hsla(0, 0%, 0%, 0.5);
```

Use border plus background-lightness as the main elevation mechanism. Shadows should stay understated.

Light mode:

```css
--shadow-sm: 0 1px 3px hsla(220,14%,10%,0.04), 0 1px 2px hsla(220,14%,10%,0.06);
--shadow-md: 0 4px 6px hsla(220,14%,10%,0.04), 0 2px 4px hsla(220,14%,10%,0.06);
--shadow-lg: 0 10px 25px hsla(220,14%,10%,0.06), 0 4px 10px hsla(220,14%,10%,0.04);
--shadow-xl: 0 20px 50px hsla(220,14%,10%,0.08), 0 8px 20px hsla(220,14%,10%,0.04);
```

## Practical Repo Guidance

- Prefer token edits in `blocksy-child/assets/css/design-system.css`
- Keep page exceptions in the page stylesheet instead of hardcoding new one-off values everywhere
- Web fonts should usually stay at two weights max

## Accessibility Check

- Body text must hit WCAG AA contrast
- CTA should be the highest-contrast actionable element
- Avoid gradient text on light backgrounds
- Do not hide structure behind ultra-soft borders
