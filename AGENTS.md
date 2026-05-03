# AGENTS.md

Global contract for agents working in this repository. Keep this file short. Load deeper `CONTEXT.md` files only for the area you touch.

## Load Order

1. Read `AGENTS.md`.
2. Then load exactly one matching local context:
   - `blocksy-child/CONTEXT.md`
   - `blocksy-child/inc/CONTEXT.md`
   - `blocksy-child/template-parts/CONTEXT.md`
   - `automations/n8n/CONTEXT.md`
   - `docs/CONTEXT.md`
   - `content/CONTEXT.md`
   - `agents/skills/CONTEXT.md`

## Stack

- WordPress child theme in `blocksy-child/`
- PHP templates and modules, CSS, vanilla JS, self-hosted fonts
- ACF-backed metadata and WordPress REST integrations
- GitHub Actions SSH-Rsync deploy via `.github/workflows/deploy.yml`
- n8n workflow exports and companion docs in `automations/n8n/`
- Durable system docs in `docs/`
- Draft content in `content/blog-drafts/`
- No Node build, package manager, or formal test suite is checked in

## CLI Defaults

- `git status --short`
- `rg --files`
- `rg -n "pattern" path/`
- `php -l blocksy-child/path/to/file.php`
- `find blocksy-child -name '*.php' -print0 | xargs -0 -n1 php -l`
- `sh scripts/check-german-copy.sh`
- `git diff --stat`
- `git diff --word-diff`

## Repository Boundaries

- Deployable runtime code lives in `blocksy-child/`. Do not move or rename that root without an explicit request.
- WordPress editor owns much of the live copy and media. The repo owns templates, schema, CSS, JS, helpers, registries, and technical contracts.
- External systems are real dependencies, not implied code: GTM, sGTM, GA4, Consent, Brevo, Cal.com, and n8n Cloud.
- Temporary plans, fix diaries, and session traces do not belong in the repo root. Put ephemeral artifacts under `.ai/memory/`.

## Product Defaults

- Primary CTA for cold B2B traffic: `/anfrage-system-analyse/`
- Warm-intent intake: `/anfrage/`
- Secondary paths: `/energie-fahrplan-demo/`, `/ergebnisse/`, `/wordpress-agentur-hannover/`, `/blog/`
- Analyse vor Umsetzungs-Pitch
- Clarity before feature count
- Do not reintroduce broad agency wording if it weakens the diagnosis-first funnel

## Funnel Ladder

1. EnergieFahrplan-Demo (`/energie-fahrplan-demo/`): showroom asset, not a lead.
2. Anfrage-System-Analyse (`/anfrage-system-analyse/`): evidenzbasierter Fit- und Marktcheck für passende Founding-Partner. Canon: `blocksy-child/inc/canon/diagnose-canon.php`.
3. Anfrage-System-Umsetzung: Bau des Systems, wenn Analyse und Fit grün oder gelb sind.
4. Optional Performance und optional Premium-Layer.

Demo- und Analyse-Interaktionen springen nicht direkt in einen generischen Verkauf. Sie qualifizieren den Founding-Partner-Fit oder disqualifizieren den Fall ausdrücklich.

## Messaging Canon

- Pricing, diagnosis, Founding Cohort, and value-anchor copy live in `blocksy-child/inc/canon/`.
- Customer-facing forbidden terms live in `blocksy-child/inc/canon/messaging-canon.php`.
- Use `Founding Cohort 2026`, `Founding-Partner`, and `Founding-Konditionen` for the 2026 offer frame.

## Required Patterns

Internal URLs:

```php
$analysis_url = home_url('/anfrage-system-analyse/');
echo esc_url($analysis_url);
```

Escaping:

```php
echo esc_html($label);
echo esc_attr($id);
echo esc_url($url);
```

n8n triplet:

```text
automations/n8n/workflows/<name>.json
automations/n8n/docs/<name>.md
automations/n8n/flow-maps/<name>.md
```

Tracking hooks:

```html
data-track-action=""
data-track-category=""
data-track-section=""
```

## Do Not

- Do not change `.github/workflows/deploy.yml` unless the task explicitly requires deploy behavior changes.
- Do not add new root markdown except durable repo infrastructure such as `AGENTS.md`.
- Do not create new timestamped fix logs, session plans, or workaround notes in `docs/`.
- Do not duplicate SEO/meta/schema logic across templates, modules, and editor content.
- Do not treat n8n JSON as self-explanatory; pair it with docs and a flow map.
- Do not version editor-owned copy as if it were the live source of truth.
- Do not write new repetitive agent playbooks in `docs/playbooks/`; create or update a skill in `agents/skills/`.

## Area Routing

- Theme-wide work: `blocksy-child/CONTEXT.md`
- PHP modules and registries: `blocksy-child/inc/CONTEXT.md`
- Shared sections and CTA surfaces: `blocksy-child/template-parts/CONTEXT.md`
- Workflow exports and contracts: `automations/n8n/CONTEXT.md`
- Durable architecture or system docs: `docs/CONTEXT.md`
- Draft content: `content/CONTEXT.md`
- Skill maintenance: `agents/skills/CONTEXT.md`

## Update Triggers

- Runtime behavior, route status, or deploy scope changes: update `docs/architecture/LIVE_STATUS.md`.
- Cross-system contracts or dependencies change: update `docs/architecture/SYSTEM_MAP.md`.
- New repetitive workflow appears: add or update `agents/skills/<skill>/SKILL.md` plus `scripts/`.
