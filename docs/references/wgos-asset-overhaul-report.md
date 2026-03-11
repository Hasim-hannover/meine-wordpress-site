# WGOS Asset Overhaul Report

- Stand: 2026-03-11
- Basis: Repo-Implementierung, Discovery-Doku, Live-REST-Inventur
- Wichtige Abweichung in der Aufgabenbeschreibung: Die gelistete Matrix umfasst 35 Assets, nicht 32. Umgesetzt wurde die tabellarisch aufgeführte Matrix.

## 1. Was umgesetzt wurde

- Versionierte WGOS-Asset-Registry im Theme eingeführt
- Auto-Sync für `wgos_asset`-Posts eingebaut
- Single-Template auf die 8-Abschnitte-Struktur umgestellt
- ACF-/Meta-Schema für WGOS-Assets ergänzt
- Explorer- und Hub-Logik auf die Registry umgestellt
- SEO-Titel und Descriptions für alle WGOS-Assets versioniert
- `Service`-Schema für WGOS-Assets ergänzt
- Legacy-Slug-Redirect für `server-side-tracking-sgtm-matomo` auf `server-side-tracking` eingebaut
- Discovery-Doku und Entscheidungsdoku ergänzt

## 2. Bestehende Assets überarbeitet

Diese Assets bleiben im Zielzustand `publish` und werden durch den Theme-Sync mit neuer Struktur, neuer Copy, SEO-Meta, Related Links und Schema aktualisiert:

1. `CWV Speed Audit`
2. `CWV Optimierung`
3. `Server-Tuning`
4. `Security Hardening`
5. `Tracking Audit`
6. `GA4 Event Blueprint`
7. `Consent Mode v2`
8. `Server-Side Tracking (sGTM & Matomo)`
9. `Technical SEO Audit`
10. `Pillar Page`

Kurzbeschreibung der inhaltlichen Änderung:

- Alle zehn Assets wurden von pathoslastigem Fließtext auf die feste WGOS-Asset-Struktur umgestellt.
- Jedes Asset hat jetzt klares Kurzprofil, konkrete Deliverables, individuellen Systemkontext, Priorisierungssituationen, CTA-Block und verwandte Bausteine.
- Alle zehn Assets bekommen versionierte SEO-Meta und `Service`-Schema.

## 3. Neue Assets angelegt

Diese Assets sind in der Registry definiert und werden durch den Theme-Sync als `publish` angelegt:

1. `Growth Audit`
2. `Positionierungs-Check`
3. `Seitenrollen-Mapping`
4. `Wettbewerbs-Analyse (Digital)`
5. `Roadmap & Priorisierung`
6. `Plugin Audit & Bereinigung`
7. `WordPress Update-Management`
8. `KPI-Dashboard Setup`
9. `UTM-Framework & Attribution`
10. `Keyword-Strategie & Content-Map`
11. `Content Hub Aufbau`
12. `On-Page SEO Optimierung`
13. `Interne Verlinkung & Seitenarchitektur`
14. `Schema Markup & Strukturierte Daten`
15. `Local SEO Setup`
16. `Landing Page (Neu)`
17. `Landing Page Optimierung`
18. `CTA & Formular-Optimierung`
19. `Angebotsseiten-Architektur`
20. `Social Proof & Trust-Elemente`
21. `Lead-Magnet Konzeption`
22. `Monthly Performance Review`
23. `Quarterly Roadmap Update`
24. `Reporting Dashboard`
25. `Conversion-Hypothesen & Testing`

## 4. Live-Status

- Zielstatus laut Registry: `35 publish`, `0 draft`
- Die eigentliche Post-Erstellung oder -Aktualisierung passiert erst nach Deployment durch den Theme-Sync
- Solange der neue Theme-Code nicht auf WordPress läuft, sind neue oder aktualisierte Asset-Posts noch nicht in der Datenbank sichtbar
- Die dedizierte Seite `wgos-systemlandkarte` wird jetzt ebenfalls automatisch angelegt und mit dem Hub-Template verknüpft

## 5. ACF-Felder gefunden und genutzt

### Vorhanden vor der Überarbeitung

- `seo_title`
- `seo_description`
- `og_image`
- `seo_noindex`

### Neu für WGOS-Assets versioniert

- `asset_module`
- `asset_phase`
- `asset_credits`
- `asset_keyword`
- `asset_schema_type`
- `asset_goal`
- `asset_result`
- `asset_prerequisite`
- `asset_short`
- `asset_intro`
- `asset_deliverable`
- `asset_bullets`
- `asset_related_slugs`

## 6. SEO-Meta-Logik

- Primärer Mechanismus: `blocksy-child/inc/seo-meta.php`
- `seo_title` und `seo_description` werden für `wgos_asset` als Theme-Fallback genutzt
- Zusätzlich wurde ein generischer Rank-Math-Bridge-Filter eingebaut, damit die gespeicherten Werte auch bei aktivem Plugin nicht verloren gehen
- Alle WGOS-Assets bekommen versionierte SEO-Titel und Descriptions aus der Registry

## 7. Schema-Markup-Status pro Asset

Alle 35 WGOS-Assets sind im Zielzustand auf `Service` gesetzt.

| Asset | Zielstatus | Schema |
| --- | --- | --- |
| Growth Audit | publish | Service |
| Positionierungs-Check | publish | Service |
| Seitenrollen-Mapping | publish | Service |
| Wettbewerbs-Analyse (Digital) | publish | Service |
| Roadmap & Priorisierung | publish | Service |
| CWV Speed Audit | publish | Service |
| CWV Optimierung | publish | Service |
| Server-Tuning | publish | Service |
| Security Hardening | publish | Service |
| Plugin Audit & Bereinigung | publish | Service |
| WordPress Update-Management | publish | Service |
| Tracking Audit | publish | Service |
| GA4 Event Blueprint | publish | Service |
| Consent Mode v2 | publish | Service |
| Server-Side Tracking (sGTM & Matomo) | publish | Service |
| KPI-Dashboard Setup | publish | Service |
| UTM-Framework & Attribution | publish | Service |
| Technical SEO Audit | publish | Service |
| Keyword-Strategie & Content-Map | publish | Service |
| Pillar Page | publish | Service |
| Content Hub Aufbau | publish | Service |
| On-Page SEO Optimierung | publish | Service |
| Interne Verlinkung & Seitenarchitektur | publish | Service |
| Schema Markup & Strukturierte Daten | publish | Service |
| Local SEO Setup | publish | Service |
| Landing Page (Neu) | publish | Service |
| Landing Page Optimierung | publish | Service |
| CTA & Formular-Optimierung | publish | Service |
| Angebotsseiten-Architektur | publish | Service |
| Social Proof & Trust-Elemente | publish | Service |
| Lead-Magnet Konzeption | publish | Service |
| Monthly Performance Review | publish | Service |
| Quarterly Roadmap Update | publish | Service |
| Reporting Dashboard | publish | Service |
| Conversion-Hypothesen & Testing | publish | Service |

## 8. Offene Punkte

- Deployment wurde in dieser Umgebung nicht ausgefuehrt
- Es gibt lokal kein `wp-cli`; die Live-Synchronisation haengt deshalb am neuen Theme-Sync nach Deployment
- Die Live-Systemlandkarte zeigt die neue Vollmatrix erst, wenn der Theme-Code deployed und der Sync gelaufen ist
- `SYSTEM_MAP.md` spiegelt die neue 35er-Matrix noch nicht wider und sollte im Review mitgeprueft werden
- Die WGOS-Hauptseite nutzt weiterhin nur Beispiel-Assets in der Credit-Tabelle; die Tabelle wurde nur auf den korrekten Server-Side-Tracking-Namen gezogen
