# SEO Cleanup Sprint - 2026-03-12

## Im Theme umgesetzt

- Homepage-Meta wird jetzt theme-seitig explizit erzwungen, statt auf alte Rank-Math- oder DB-Fallbacks zu vertrauen.
- Blog-Index bekommt einen festen SEO-Titel und eine feste Description, damit alte Archive-Titel aus WordPress oder Rank Math nicht mehr durchrutschen.
- Single-Post-Titles werden auf das Muster `Posttitel | Hasim Uener` mit kompaktem Längenlimit normalisiert.
- `BlogPosting`-Schema wird fuer `post` ausgegeben, inklusive `author`, `datePublished`, `dateModified`, `publisher` und `image`.
- Die Homepage verlinkt jetzt im Body kontextuell auf `/wordpress-agentur-hannover/`.
- Die relevanten Blog-Artikel-Bridges fuer `technisches-seo-performance-fundament` und `b2b-landingpage-optimieren` verlinken jetzt kontextuell auf `/wordpress-agentur-hannover/`.
- Alte Direktbuchungs-Fallbacks wurden theme-seitig auf den Audit-Pfad zurueckgefuehrt, damit ohne gesetzten Filter nicht wieder `cal.com/hasim/30min` ausgespielt wird.

## Weiter offen ausserhalb des Repos

- Google Search Console: Homepage `https://hasimuener.de/` in der URL-Pruefung aufrufen und `Indexierung beantragen`.
- Google Search Console: die Blog-Startseite ebenfalls separat neu crawlen lassen, falls dort der alte Archiv-Titel im Index haengt.
- WordPress-/Rank-Math-Admin: pruefen, ob fuer Startseite oder Beitragsseite noch alte Meta-Werte hinterlegt sind. Das Theme ueberschreibt jetzt die Ausgabe, aber der Altbestand sollte trotzdem bereinigt werden.
- Live-Check im Browser: Quelltext der Startseite und des Blogs pruefen, ob nur noch die neuen Title-/Description-Werte ausgespielt werden.

## Legacy-Migrationsliste

### Sofort pruefen

| URL | Repo-Status | Naechste Aktion |
| --- | --- | --- |
| `/wordpress-seo-hannover/` | Repo-Template aktiv erzwungen | Live pruefen, ob nicht doch Editor-/Default-Content ausgespielt wird |
| `/core-web-vitals/` | Repo-Template aktiv erzwungen | Live pruefen, ob nicht doch Editor-/Default-Content ausgespielt wird |
| `/customer-journey-audit/` | 301 auf Audit vorhanden | Alte internen Links im Editor bereinigen |
| `/wordpress-tech-audit/` | 301 auf Audit vorhanden | Alte internen Links im Editor bereinigen |
| `/case-studies/` | 301 auf `/ergebnisse/` vorhanden | Alte internen Links im Editor bereinigen |

### Editor-/Admin-Layer

- Blog-/Page-Content, der nicht im Repo liegt, weiterhin auf alte CTAs, alte Preise, Emojis und alte Booking-Links pruefen.
- Falls alte Legacy-Seiten live noch in alter Brand-Voice erscheinen, zuerst `noindex` setzen und dann auf Repo-Template oder neuen Editor-Content migrieren.
