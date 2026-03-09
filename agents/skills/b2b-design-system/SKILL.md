---
name: b2b-design-system
description: >
  Premium UX/UI design system and CRO framework for B2B WordPress websites.
  Creates world-class, conversion-optimized interfaces inspired by Linear, Vercel, Stripe, and Raycast.
  Use this skill whenever the user asks to design, build, redesign, or optimize any web page, landing page,
  component, section, hero, layout, or UI element for a B2B context. Also trigger when the user mentions
  "design system", "UI components", "conversion optimization", "CRO", "above the fold", "hero section",
  "trust signals", "dark mode", "light mode", "modern design", "premium look", "SaaS design",
  or requests anything related to visual quality, layout, spacing, typography, color, or motion
  on a WordPress or web project. Trigger even for partial requests like "make this look better"
  or "the design isn't good enough". This skill supersedes generic frontend-design for any B2B context.
---

# B2B Premium Design System & CRO Framework

This skill produces world-class B2B web interfaces that convert. Every design decision serves two masters: aesthetic excellence and measurable conversion. No compromise on either.

## Project Brand Override

For this project, use the logo copper instead of the generic red accent:

- Primary brand accent: `#b46a3c`
- HSL reference: `23 50% 47%`

If the references below mention a red accent, treat that as this copper tone for this repo.

## Before You Code: Mandatory Pre-Flight

1. **Read this SKILL.md completely** before writing any CSS, HTML, or component code.
2. **Read the relevant reference file** based on what you're building:
   - Building/styling components → Read `references/components.md`
   - Working on layout, spacing, color, typography → Read `references/design-tokens.md`
   - Adding animations or interactions → Read `references/motion.md`
3. **Identify the conversion goal** of the page/section before choosing any visual pattern.
4. **Check the mode** — Dark Mode is default. Light Mode must meet the same quality bar.

---

## Design Philosophy

### The North Star: "Engineered Elegance"

The aesthetic is precision-meets-warmth. Not cold minimalism. Not loud maximalism. Think:
- **Linear**: Clean density, functional beauty, every pixel intentional
- **Vercel**: Typographic confidence, dramatic negative space, bold hierarchy
- **Stripe**: Layered depth, soft gradients, premium texture
- **Raycast**: Refined dark UI, crisp contrast, micro-interactions that reward attention

**Core Principle**: Design should feel like it was built by engineers who care deeply about craft — not by designers who forgot about function.

### Anti-Patterns (Hard Bans)

Never produce these. They signal amateur or AI-generated work:

- ❌ Purple-gradient-on-white (the #1 AI slop pattern)
- ❌ ANY bright/saturated colors besides the red accent (no blue, green, purple, orange surfaces)
- ❌ Cold blue-gray backgrounds (hue 220+) — always use warm neutrals (hue 25–35)
- ❌ Pure white (#fff) or pure black (#000) backgrounds — always warm-tinted
- ❌ Inter/Roboto/Arial as primary typeface
- ❌ Evenly-distributed pastel color palettes
- ❌ Card grids with identical border-radius and shadows
- ❌ Generic stock-photo hero sections
- ❌ Centered text blocks wider than 680px
- ❌ Blue CTA buttons — CTAs are RED, always
- ❌ "Trusted by" logo bars with no visual treatment
- ❌ Testimonial carousels with quotation mark icons
- ❌ Gradient text on light backgrounds (unreadable)
- ❌ Drop shadows without warm-tint (cold gray shadows look wrong on this palette)
- ❌ More than 2 font families
- ❌ Inconsistent border-radius values across components
- ❌ Mixing rounded and sharp corners on the same page
- ❌ Red used for decoration or large areas (< 5% of screen surface only)

---

## Design System Foundation

### Typography Scale

Use a **modular scale** (ratio 1.25 — Major Third) for mathematical harmony:

```
--font-size-xs:    0.75rem    /* 12px — captions, labels */
--font-size-sm:    0.875rem   /* 14px — secondary text, metadata */
--font-size-base:  1rem       /* 16px — body text */
--font-size-md:    1.125rem   /* 18px — lead text, intro */
--font-size-lg:    1.25rem    /* 20px — H4, card titles */
--font-size-xl:    1.5rem     /* 24px — H3 */
--font-size-2xl:   2rem       /* 32px — H2 */
--font-size-3xl:   2.5rem     /* 40px — H1 on mobile */
--font-size-4xl:   3.25rem    /* 52px — H1 on desktop */
--font-size-5xl:   4rem       /* 64px — Hero display */
```

**Font Pairing Strategy** (choose ONE pairing per project):

| Style          | Display Font              | Body Font                | Vibe                     |
|----------------|---------------------------|--------------------------|--------------------------|
| Technical      | JetBrains Mono            | Satoshi / Plus Jakarta   | Developer, precise       |
| Editorial      | Instrument Serif          | Satoshi                  | Authoritative, warm      |
| Modern Clean   | Plus Jakarta Sans (700+)  | Plus Jakarta Sans (400)  | SaaS, contemporary       |
| Bold Statement | Clash Display             | General Sans             | Confident, distinctive   |
| Refined        | Sora                      | DM Sans                  | Premium, approachable    |
| German B2B     | Bricolage Grotesque       | Figtree                  | Serious, modern          |

**Never use**: Inter, Roboto, Open Sans, Lato, Montserrat, Poppins, Arial, system-ui as primary.

### Spacing System

Use an **8px base grid** with named tokens:

```
--space-1:   0.25rem   /*  4px */
--space-2:   0.5rem    /*  8px */
--space-3:   0.75rem   /* 12px */
--space-4:   1rem      /* 16px */
--space-5:   1.25rem   /* 20px */
--space-6:   1.5rem    /* 24px */
--space-8:   2rem      /* 32px */
--space-10:  2.5rem    /* 40px */
--space-12:  3rem      /* 48px */
--space-16:  4rem      /* 64px */
--space-20:  5rem      /* 80px */
--space-24:  6rem      /* 96px */
--space-32:  8rem      /* 128px */
```

**Section padding**: `--space-20` to `--space-32` vertical. More space = more premium.
**Component gaps**: `--space-4` to `--space-8`.
**Inline spacing**: `--space-2` to `--space-4`.

### Color Architecture

For detailed color tokens, see `references/design-tokens.md`. Core principles:

**Palette Identity: "Monochrom-Warm mit Rot-Akzent"**

The palette uses THREE neutral axes plus ONE chromatic accent:
- **Black** (hue 30, low saturation): Warm blacks, never cold blue-black. Foundation.
- **Silver** (hue 30, minimal saturation): Cool-warm metallic grays. Structure, secondary text, dividers.
- **Brown** (hue 25–30, medium saturation): Warm mid-tones for depth, hover states, surface warmth.
- **Red** (hue 4, high saturation): The ONLY color. CTAs, active states, links, emphasis. Used sparingly.

The feel: Polished concrete, brushed steel, dark leather, a single red thread.

**Dark Mode (Default)**:
- Background layers: Warm near-black → subtle brown-tinged elevation
- `--bg-base: hsl(30 6% 5%)` — deep warm black
- `--bg-surface: hsl(30 5% 8%)` — cards with warmth
- `--bg-elevated: hsl(30 4% 11%)` — hover, active
- Text: Warm white `hsl(30 4% 90%)` primary, silver `hsl(30 3% 58%)` secondary
- Accent: Red `hsl(4 75% 50%)` — confident, not aggressive
- Borders: Warm grays, not blue-tinted

**Light Mode**:
- NOT cold white. Warm off-white with stone/cream undertone.
- Background: `hsl(35 12% 96%)` base (like aged paper), `hsl(35 10% 93%)` surface
- Text: Warm near-black `hsl(30 10% 12%)` — never pure #000
- Accent red is DARKER in light mode `hsl(4 72% 42%)` for proper contrast
- Shadows are warm-tinted (hue 30), not cold blue-gray
- Brown tones become more prominent: tags, labels, warm surface accents

**Red Accent Usage Rules (STRICT)**:
- ✅ Primary CTA buttons
- ✅ Links and interactive text
- ✅ Active/selected states
- ✅ Important numbers or KPIs
- ✅ Focus rings
- ❌ NOT for large backgrounds
- ❌ NOT for decorative elements
- ❌ NOT for borders (except accent-border on featured items)
- ❌ NOT for icons unless they indicate action
- Ratio: Red should occupy < 5% of any screen's surface area.

### Border Radius System

**One radius rule per project**. Mixing is the #1 amateur signal:

```
--radius-sm:   4px    /* Inputs, small elements */
--radius-md:   8px    /* Cards, containers */
--radius-lg:   12px   /* Large cards, sections */
--radius-xl:   16px   /* Feature panels */
--radius-full: 9999px /* Pills, badges, avatars */
```

Pick a personality:
- **Sharp**: sm=2px, md=4px, lg=6px → Technical, precise (Linear-style)
- **Soft**: sm=6px, md=10px, lg=16px → Friendly, approachable (Stripe-style)
- **Round**: sm=8px, md=12px, lg=20px → Modern, playful (Raycast-style)

### Shadow & Elevation

```css
/* Dark Mode: Shadows are near-invisible. Use border + bg-lightness for elevation. */
--shadow-sm: 0 1px 2px hsla(30,6%,0%,0.3);
--shadow-md: 0 4px 12px hsla(30,6%,0%,0.4);
--shadow-lg: 0 8px 30px hsla(30,6%,0%,0.5);

/* Light Mode: Shadows are the PRIMARY elevation mechanism. Warm-tinted. */
--shadow-sm: 0 1px 3px hsla(30,10%,10%,0.05), 0 1px 2px hsla(30,10%,10%,0.04);
--shadow-md: 0 4px 6px hsla(30,10%,10%,0.05), 0 2px 4px hsla(30,10%,10%,0.04);
--shadow-lg: 0 10px 25px hsla(30,10%,10%,0.07), 0 4px 10px hsla(30,10%,10%,0.04);
--shadow-xl: 0 20px 50px hsla(30,10%,10%,0.09), 0 8px 20px hsla(30,10%,10%,0.04);
```

---

## CRO Architecture (Conversion-First Design)

Every section of a B2B page has a conversion job. Design serves that job.

### The Conversion Hierarchy

```
1. HERO — Capture attention, state value, initiate action (5–8 sec window)
2. PROOF — Remove doubt (logos, stats, case study teaser)
3. MECHANISM — Show how it works (3-step process, system overview)
4. OFFER — Define what they get (packages, tiers, audit)
5. OBJECTION — Handle resistance (FAQ, "not for you" section)
6. FINAL CTA — Last chance with urgency/clarity
```

### CRO Rules (Non-Negotiable)

1. **One primary CTA per page**. Repeat it, don't compete with it.
2. **CTA contrast ratio**: Must be the highest-contrast element on screen. Minimum 7:1 against background.
3. **Above-fold must contain**: Headline, sub-headline, primary CTA, one trust signal.
4. **Social proof within 1 scroll**: Logos, numbers, or a testimonial must appear before the user scrolls twice.
5. **Form fields**: Maximum 3 fields for first contact. Name, email, company. Everything else is friction.
6. **Message match**: If the visitor came from an ad or blog post, the H1 must mirror the source promise.
7. **Directional cues**: Use visual flow (arrows, eye-gaze, layout alignment) to guide toward CTA.
8. **Negative space around CTA**: Minimum 48px padding around any CTA button. Crowded CTAs don't convert.
9. **Mobile CTA**: Fixed bottom bar or sticky CTA after scroll past hero on mobile.
10. **Loading**: Page must be interactive in <2.5s. Every 100ms delay costs ~1% conversion.

### Component Patterns

For detailed component specifications (Hero, Proof Bar, Feature Grid, Pricing, FAQ, etc.), see `references/components.md`.

---

## Motion & Interaction Design

For detailed motion specs, see `references/motion.md`. Core principles:

### Motion Philosophy: "Purposeful Restraint"

- Every animation must have a **functional purpose**: reveal hierarchy, confirm action, guide attention.
- No animation for decoration alone.
- Total animation budget per page load: **< 2 seconds** cumulative.
- Respect `prefers-reduced-motion` — always provide fallback.

### Essential Motion Patterns

1. **Staggered reveal on scroll**: Sections fade-in + translate-y with 80ms delay between children.
2. **Hero entrance**: H1 first (0ms), sub-headline (120ms), CTA (240ms), secondary elements (360ms).
3. **Hover states**: Scale 1.02 + shadow elevation on cards. Color shift on links. Never scale text.
4. **Number counters**: Animate from 0 to target on scroll-into-view. Duration: 1.2–1.8s, ease-out.
5. **CTA pulse**: Subtle box-shadow pulse (not scale) on primary CTA after 5s idle. Once only.

### CSS Implementation (WordPress-Compatible)

All motion must work via CSS + Intersection Observer (vanilla JS). No React, no GSAP, no heavy libraries. WordPress sites must stay under 50KB JS for animations.

```css
/* Base reveal class */
.reveal {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.reveal.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* Stagger children */
.reveal-stagger > .reveal:nth-child(1) { transition-delay: 0ms; }
.reveal-stagger > .reveal:nth-child(2) { transition-delay: 80ms; }
.reveal-stagger > .reveal:nth-child(3) { transition-delay: 160ms; }
.reveal-stagger > .reveal:nth-child(4) { transition-delay: 240ms; }
.reveal-stagger > .reveal:nth-child(5) { transition-delay: 320ms; }

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
  .reveal { transition-duration: 0.01ms !important; transition-delay: 0ms !important; }
}
```

```js
/* Intersection Observer — vanilla, < 1KB */
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
```

---

## WordPress / Blocksy Implementation Notes

### Theme Architecture

- **Base theme**: Blocksy (free or Pro) — lightest performant theme with full customizer control.
- **Custom CSS**: Inject via Customizer → Additional CSS or child theme. Never inline.
- **Custom JS**: Enqueue via `wp_enqueue_script` with `defer`. Never inline `<script>` tags.
- **Page builders**: Avoid Elementor/Divi. Use Gutenberg blocks + custom CSS. If client requires builder: Bricks Builder only.

### Performance Budgets

| Metric              | Target        | Hard Limit    |
|---------------------|---------------|---------------|
| LCP                 | < 1.5s        | < 2.5s        |
| INP                 | < 100ms       | < 200ms       |
| CLS                 | < 0.05        | < 0.1         |
| Total Page Weight   | < 800KB       | < 1.5MB       |
| JS Bundle           | < 100KB       | < 200KB       |
| CSS Bundle          | < 50KB        | < 80KB        |
| HTTP Requests       | < 25          | < 40          |
| Web Fonts           | 2 weights max | 3 weights max |

### Font Loading Strategy

```css
/* Preload critical font weights only */
<link rel="preload" href="/fonts/display-700.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/fonts/body-400.woff2" as="font" type="font/woff2" crossorigin>

/* Font-display: swap for performance, optional for display fonts */
@font-face {
  font-family: 'Display';
  src: url('/fonts/display-700.woff2') format('woff2');
  font-weight: 700;
  font-display: swap;
}
```

### Dark/Light Mode Implementation

```css
/* System preference detection + manual toggle */
:root { /* Light mode tokens */ }

@media (prefers-color-scheme: dark) {
  :root:not([data-theme="light"]) { /* Dark mode tokens */ }
}
[data-theme="dark"] { /* Dark mode tokens — forced */ }
[data-theme="light"] { /* Light mode tokens — forced */ }
```

```js
/* Toggle with localStorage persistence — set dark as default */
const html = document.documentElement;
const saved = localStorage.getItem('theme');
if (!saved) {
  html.setAttribute('data-theme', 'dark'); // DEFAULT: Dark
} else {
  html.setAttribute('data-theme', saved);
}
```

---

## Design Benchmarks

These are the reference-quality B2B sites to study and match:

| Site               | What to Study                                      |
|--------------------|----------------------------------------------------|
| linear.app         | Information density, dark UI, keyboard-first feel   |
| vercel.com         | Typography scale, negative space, hero patterns     |
| stripe.com         | Layered depth, gradient mastery, documentation UX   |
| raycast.com        | Dark mode polish, micro-interactions, component lib |
| resend.com         | Minimalism done right, monospace accents, stark     |
| cal.com            | Open-source aesthetic, clean forms, scheduling UX   |
| dub.co             | Link management → clean dashboard, social proof     |
| planetscale.com    | Database product → developer trust, speed signals   |

Study these for patterns. Never copy layouts wholesale. Adapt principles to the B2B-DACH context.

---

## Quality Checklist (Run Before Delivery)

Before presenting any design/code to the user, verify:

- [ ] **Typography**: Max 2 font families. Scale follows modular ratio. Line-height 1.4–1.6 for body.
- [ ] **Color**: One accent color. Consistent HSL system. WCAG AA contrast on all text.
- [ ] **Spacing**: All values from the 8px grid. Generous section padding (min 80px).
- [ ] **Border-radius**: Consistent system. One personality, no mixing.
- [ ] **Shadows**: Light mode uses layered shadows. Dark mode uses border+bg elevation.
- [ ] **CTA**: Highest contrast element. 48px+ padding around it. Visible above fold.
- [ ] **Mobile**: Responsive. CTA accessible without scrolling on mobile.
- [ ] **Performance**: No unnecessary JS. CSS-first animations. Web fonts ≤ 2 weights.
- [ ] **Motion**: prefers-reduced-motion respected. Total animation < 2s.
- [ ] **No anti-patterns**: Zero items from the Hard Bans list.
- [ ] **Dark/Light**: Both modes tested. Light mode is not just inverted dark.

---

## How to Use This Skill

When building a page or component:

1. Read this file fully.
2. Read the relevant reference file(s) from `references/`.
3. Define the conversion goal.
4. Select design tokens (font pair, accent color, radius style).
5. Build mobile-first, dark-mode-first.
6. Run the quality checklist.
7. Present to user with rationale for key design decisions.

When reviewing/auditing an existing design:

1. Screenshot or fetch the current state.
2. Score against the quality checklist (each item: pass/fail/partial).
3. Identify the top 3 highest-impact fixes.
4. Propose changes with before/after reasoning.
5. Prioritize by: conversion impact > visual quality > nice-to-have.
