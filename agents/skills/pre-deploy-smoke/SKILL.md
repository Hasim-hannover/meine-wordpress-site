---
name: pre-deploy-smoke
description: Pre-push smoke tests for the Blocksy child theme. Use before any git push to catch PHP errors, broken links, and missing assets before they hit production.
---

# Pre-Deploy Smoke

Use this skill before pushing to catch errors that would crash the live site.

## Run First

```bash
agents/skills/pre-deploy-smoke/scripts/smoke.sh
```

The script checks all changed PHP files, scans for common breakage patterns, and prints a PASS/FAIL summary.

## What It Checks

1. **PHP lint** — `php -l` on every changed `.php` file
2. **home_url() hygiene** — no hardcoded domain URLs in templates
3. **Escaping** — changed files use `esc_html`, `esc_attr`, `esc_url` (warns on raw `echo $`)
4. **Asset references** — CSS/JS files referenced in `enqueue.php` exist on disk
5. **Template integrity** — no unclosed PHP tags in template files

## Deliver

- PASS/FAIL per check category
- File paths and line numbers for every failure
- Clear "safe to push" or "fix before push" verdict
