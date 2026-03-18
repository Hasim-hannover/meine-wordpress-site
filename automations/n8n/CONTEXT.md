# n8n Context

Scope: `automations/n8n/`

## Contract

Every workflow name is a triplet:

```text
<domain>__<flow>__<state>
```

Required companions:

- `workflows/<name>.json`
- `docs/<name>.md`
- `flow-maps/<name>.md`
- `data-models/<contract>.json` when a stable payload exists

## Rules

- JSON exports are not documentation.
- If a webhook, payload, or field contract changes, update the companion docs and the consuming theme code.
- Keep status language explicit: `live`, `mvp`, `refactor-needed`, or `deprecated`.
- Do not add undocumented external credentials or live URLs to docs.

## Touchpoints

- Theme consumers usually live in `blocksy-child/assets/js/` and `blocksy-child/inc/`.
- Audit-related changes often affect `audit-live.js`, `review-crm.php`, and mail/CRM paths.
