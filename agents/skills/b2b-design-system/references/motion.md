# Motion

Use this file when adding or refining animations, reveal logic, hover states, or interaction feedback.

## Motion Philosophy

Use purposeful restraint:

- every animation must clarify hierarchy, confirm action, or guide attention
- no decorative motion for its own sake
- keep cumulative page-load motion under roughly `2s`
- respect `prefers-reduced-motion` everywhere

## Essential Patterns

### Reveal

Use translate-and-fade reveal for section intros and cards:

- duration around `0.6s`
- easing around `cubic-bezier(0.16, 1, 0.3, 1)`
- stagger children by `80ms`

In this repo, prefer `.nx-reveal` plus `NexusCore.initReveal()` over new observer code.

### Hero Entrance

Recommended order:

1. eyebrow or kicker
2. headline
3. supporting paragraph
4. CTA
5. nearby proof or panel

### Hover

- cards: slight lift plus surface or border change
- links: color shift or underline treatment
- buttons: background or shadow change, not aggressive scale
- never scale text itself

### Counters

Animate numbers only when they are meaningful and visible. Use the existing counter utility where possible.

### CTA Pulse

If used at all, make it a one-time box-shadow pulse after a short idle period. Do not pulse indefinitely.

## WordPress-Compatible Implementation

Keep motion CSS-first and vanilla:

- no GSAP for basic reveal work
- no React-only patterns
- avoid heavy libraries for simple scroll effects
- keep animation JS comfortably below `50KB`

Base pattern:

```css
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

.reveal-stagger > .reveal:nth-child(1) { transition-delay: 0ms; }
.reveal-stagger > .reveal:nth-child(2) { transition-delay: 80ms; }
.reveal-stagger > .reveal:nth-child(3) { transition-delay: 160ms; }
.reveal-stagger > .reveal:nth-child(4) { transition-delay: 240ms; }
.reveal-stagger > .reveal:nth-child(5) { transition-delay: 320ms; }
```

```js
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('is-visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
```

## Reduced Motion

When motion is reduced:

- remove delays
- remove translate effects
- keep state changes immediate

Example:

```css
@media (prefers-reduced-motion: reduce) {
  .reveal {
    transition-duration: 0.01ms !important;
    transition-delay: 0ms !important;
    transform: none;
    opacity: 1;
  }
}
```

## Performance Reminder

- page should stay interactive in under roughly `2.5s`
- do not add JS that blocks first interaction for cosmetic motion
