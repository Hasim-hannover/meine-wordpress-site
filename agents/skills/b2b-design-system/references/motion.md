# Motion

Use this file when adding or refining animations, reveal logic, hover states, or interaction feedback.

## Principles

- Motion must clarify hierarchy, confirm state, or guide attention.
- Keep total page-load motion restrained.
- Respect `prefers-reduced-motion` everywhere.

## Preferred Patterns

### Reveal

Use translate-and-fade reveal for section intros and cards:

- duration around `0.6s`
- easing close to `cubic-bezier(0.16, 1, 0.3, 1)`
- stagger children by `80ms`

In this repo, prefer `.nx-reveal` plus `NexusCore.initReveal()` over new observer code.

### Hero Entrance

Recommended sequence:

1. kicker or eyebrow
2. headline
3. supporting paragraph
4. primary CTA
5. secondary proof surface

### Hover

- cards: subtle lift and border/surface change
- links: color shift or underline treatment
- buttons: shadow or background change, not dramatic scaling

### Counters

Animate numbers only when they enter the viewport and only if the number is meaningful. Reuse the existing counter utility when possible.

## Reduced Motion

When motion is reduced:

- remove delays
- remove translate effects
- keep state changes immediate

Example CSS pattern:

```css
.nx-reveal {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1),
              transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.nx-reveal.nx-visible {
  opacity: 1;
  transform: translateY(0);
}

@media (prefers-reduced-motion: reduce) {
  .nx-reveal {
    opacity: 1;
    transform: none;
    transition: none;
  }
}
```
