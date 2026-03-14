# n8n

Dieser Bereich ist fuer versionierte n8n-Workflows und ihre menschlich lesbare Doku reserviert.

Aktueller Stand:

- Der `Customer Journey Audit` liegt als bereinigter V2-Workflow im Repo.
- Der Workflow ist dokumentiert und mit Flow-Map sowie Frontend-Contract ergaenzt.
- Fuer den naechsten Refactor liegt zusaetzlich ein V3-Zielbild fuer `Instant Results` im Repo.

Bekannte Touchpoints:

- `blocksy-child/assets/js/audit-live.js`
- Webhooks `audit` und `audit-status`
- `automations/n8n/workflows/audit-funnel__customer-journey-audit__refactor.json`
- `automations/n8n/docs/audit-funnel__customer-journey-audit__refactor.md`
- `automations/n8n/flow-maps/audit-funnel__customer-journey-audit__refactor.md`
- `automations/n8n/data-models/audit-frontend-payload.contract.json`
- `automations/n8n/workflows/audit-funnel__instant-results__target.json`
- `automations/n8n/docs/audit-funnel__instant-results__target.md`
- `automations/n8n/flow-maps/audit-funnel__instant-results__target.md`
- `automations/n8n/data-models/audit-frontend-payload.v3.contract.json`

## Zielstruktur

```text
automations/n8n/
├── README.md
├── data-models/
├── workflows/
├── docs/
└── flow-maps/
```

## Regeln

- Jeder Workflow braucht einen JSON-Export unter `workflows/`.
- Jeder Workflow braucht zusaetzlich eine Doku unter `docs/`.
- Jeder kritische Workflow braucht eine Flow-Map unter `flow-maps/`.
- Jeder stabile Frontend- oder System-Contract gehoert unter `data-models/`.
- Statusaenderungen muessen auch in `docs/architecture/LIVE_STATUS.md` und bei Bedarf in `docs/architecture/SYSTEM_MAP.md` auftauchen.

## Dokumentationspflicht pro Workflow

- Zweck
- Trigger
- Hauptschritte
- Business-Logik
- Datenlogik
- Delivery-Logik
- Abhaengigkeiten
- Risiken
- Verbesserungsvorschlaege
- Einstufung: live-tauglich, MVP-tauglich, refactor-beduerftig oder deprecated-reif
