# n8n

Dieser Bereich ist fuer versionierte n8n-Workflows und ihre menschlich lesbare Doku reserviert.

Aktueller Stand:

- Im Repo liegen noch keine exportierten Workflows.
- Sichtbar ist bisher nur die Frontend-Anbindung aus dem Audit-Funnel.

Bekannte Touchpoints:

- `blocksy-child/assets/js/audit-live.js`
- Webhooks `audit` und `audit-status`

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
- Statusaenderungen muessen auch in `LIVE_STATUS.md` und bei Bedarf in `SYSTEM_MAP.md` auftauchen.

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
