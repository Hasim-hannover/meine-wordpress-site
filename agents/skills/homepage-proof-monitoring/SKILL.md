---
name: homepage-proof-monitoring
description: Monitor the homepage public-proof layer after releases. Use when homepage proof, pilot CTA routing, or related GTM/GA4 follow-up must be reviewed over time.
---

# Homepage Proof Monitoring

Use this skill for post-release measurement of the homepage proof layer and pilot-intent path.

## Run First

```bash
agents/skills/homepage-proof-monitoring/scripts/render-review.sh
```

The script prints tracked CTA hooks found in the theme plus the fixed review checklist.

## What To Check

- Compare 14 days before launch with 14 and 28 days after launch.
- Confirm repo-owned `data-track-action` hooks are still present.
- Confirm GTM maps those hooks into usable events.
- Review pilot-intent contacts separately from generic contact volume.

## Deliver

- Launch annotation task
- GTM or GA4 follow-up if hooks are not wired through
- Weekly review summary with pilot lead quality notes
