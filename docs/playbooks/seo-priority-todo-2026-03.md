# SEO Priority Todo - March 2026

## Ziel

Diese Liste priorisiert die naechsten SEO-Arbeiten nach:

1. Impact auf Sichtbarkeit und Klicks
2. Geschwindigkeit der Umsetzung
3. Risiko, falsche Signale weiterlaufen zu lassen

Der Fokus liegt bewusst auf:

- Seiten mit bereits vorhandenen Impressionen
- Seiten mit Snippet-/Indexierungsfehlern
- Legacy-URLs und Kannibalisierung

Nicht zuerst bearbeiten:

- sehr kleine Long-Tail-Queries
- Content-Ausbau ohne vorherige Bereinigung
- tiefe Rewrites auf Seiten mit unklarer Suchintention

## Gesamtstatus

### Technisch erledigt

- `/shopify-wartungsvertrag/` liefert `410 Gone`
- `/wordpress-wartung-hannover/` lebt als eigene WGOS-Clusterseite weiter
- Snippet-Basis fuer `/kontakt/`, `/wordpress-growth-operating-system/` und `/kostenlose-tools/` ist im Theme nachgeschaerft
- `/kontaktiere-mich/` geht per `301` auf `/kontakt/`
- `/ga4-tracking-setup/` und `/performance-marketing/` laufen nicht mehr ueber die Legacy-Redirect-Map
- `/wordpress-agentur-hannover/` ist als Fuehrungsseite fuer `wordpress agentur hannover` im Snippet/Schema/Hook staerker ausgerichtet
- `/wordpress-seo-hannover/` ist klarer auf technischen SEO-Intent statt auf breiten Agentur-Intent zugespitzt

### Teilweise erledigt

- Legacy-URLs sind technisch bereinigt, aber Search-Console-Nachlauf fehlt noch
- Kannibalisierung ist technisch besser vorbereitet, aber noch nicht final durch Search-Console-Signale bestaetigt
- Draft-/noindex-Themen sind im Theme weitgehend bereinigt, aber Live-Validierung und Recrawl stehen noch aus

### Noch offen

- Search-Console-Requests fuer die wichtigsten Ziel-URLs
- Live-Pruefung, ob Google die neuen Snippets, Redirects und Cluster-Seiten bereits uebernimmt
- weitere interne Linkverstaerkung fuer die Fuehrungsseiten, wenn Search Console noch Kannibalisierung zeigt

## Abgleich mit deep-research-report.md

Die externe Research-MD ist als Priorisierungshilfe nuetzlich, wird hier aber an den echten Repo-Stand angepasst. Nicht jede Empfehlung passt 1:1 auf die aktuell aktiven Slugs, Templates und Schema-Hooks.

| Thema aus Research | Repo-Stand | Arbeitsentscheidung |
|---|---|---|
| Wartungs-Cluster ueber `/wordpress-wartung/` bzw. `/wordpress-wartung-aus-hannover/` konsolidieren | Im Child-Theme existiert aktuell die aktive Cluster-Route `/wordpress-wartung-hannover/` samt Meta- und Schema-Definition | Fuer dieses Repo gilt `/wordpress-wartung-hannover/` als Primaer-URL fuer Wartung, Betrieb und Sicherheit in Hannover; keine neue Parallel-URL ohne klaren Intent-Split |
| WebSite/SiteName-Schema auf der Homepage ergaenzen | `inc/org-schema.php` gibt aktuell kein `WebSite` aus; `functions.php` vermeidet zusaetzliches Homepage-JSON-LD wegen moeglicher Rank-Math-Duplikate | Nur nach Live-Head-Pruefung erweitern; wenn Plugin oder Live-Head `WebSite`/`SiteName` bereits sauber liefern, im Theme nichts doppeln |
| Blocksy Page Title serverseitig abschalten | Doppelte H1 sind dokumentiert, aber der Audit nennt auch Template-Drift auf Live-Seiten; im Repo wird bisher nur bei Posts und Cornerstones per CSS versteckt | Erst Template-Zuordnung und Live-DOM pruefen, dann gezielt serverseitig unterdruecken statt blind global zu patchen |
| Neue Landing `/woocommerce-agentur-hannover/` | Keyword-Chance ist plausibel, aber Agentur-, SEO- und Wartungsseite sind noch nicht final per Search Console konsolidiert | Als P2-Kandidat behalten; erst nach Primaer-URL-Mapping, Recrawl und interner Linkbereinigung bauen |
| Sitemap- und Canonical-Konsistenz auditieren | Theme steuert Canonicals bereits selbst fuer Cluster-Routen; parallel koennen WordPress-Core-Sitemaps und Plugin-Ausgaben aktiv sein | Bleibt echte P1-Verifikation vor weiterem Cluster-Ausbau |

Was aus der Research-MD direkt uebernommen wird:

- Query-zu-URL-Mapping verbindlich machen statt weitere Seiten parallel auf denselben Intent zu ziehen
- interne Money-Links von Startseite, Category-Hubs, Blog-Bridges und Related Content auf die Primaer-URLs konzentrieren
- Schema-, Canonical- und H1-Checks als Live-Verifikation behandeln, nicht nur als Theme-Annahme

## P0 - Sofort

### 1. `/shopify-wartungsvertrag/` sauber aus dem Index nehmen

Stand:

- Erledigt im Theme: die URL liefert jetzt gezielt **410 Gone** statt weiter als unklare Alt-URL zu leben.
- Offen bleibt nur noch der Search-Console-Recrawl bzw. optional das Entfernen-Tool zur Beschleunigung.

Empfohlene Loesung:

- Falls es **keine echte Nachfolgeseite** fuer diese Leistung gibt:
  - URL auf **410 Gone** setzen
  - aus Sitemap entfernen
  - interne Links entfernen
  - Search-Console-Entfernung nur als Beschleuniger nutzen, nicht als Hauptloesung
- Falls es **eine fachlich saubere Ersatzseite** gibt:
  - 301 auf die beste Ersatzseite
  - nur dann, wenn Suchintention und Angebot wirklich passen

Warum nicht nur Search Console:

- Das Search-Console-Removal-Tool ist nur temporaer.
- Dauerhaft verschwindet die URL nur ueber 410, 404 + Deindexierung oder 301.

Konkrete Schritte:

1. Im WP-Admin pruefen, ob die Seite als Page/Post noch existiert.
2. Wenn ja:
   - in den Papierkorb oder dauerhaft loeschen
   - sicherstellen, dass sie nicht mehr in Menues, Widgets oder internen Links vorkommt
3. Wenn nein oder wenn sie aus Alt-Routing kommt:
   - technischen 410-Fallback im Theme setzen
4. Danach in Search Console:
   - URL-Pruefung
   - optional Entfernen-Tool
5. Danach pruefen:
   - `curl -I https://hasimuener.de/shopify-wartungsvertrag/`
   - Ziel sollte **410** oder ein fachlich sauberer **301** sein

Praeferenz:

- **410 ist hier wahrscheinlich die bessere Loesung als 301**, solange es keine echte Shopify-Wartungsseite mehr gibt.

### 2. `/wordpress-wartung-hannover/` entscheiden

Stand:

- Entscheidung getroffen: die URL bleibt **drin** und wird nicht entfernt.
- Sie wird aus dem Legacy-Redirect auf das Security-Hardening-Asset herausgezogen.
- Die Route wird als eigene WGOS-Clusterseite für Betrieb, Updates, Sicherheit und technische Stabilität weitergefuehrt.
- Alte Wartungsvertrag-/Preissignale werden dabei nicht fortgeschrieben.
- Offen bleibt nur noch der Search-Console-Recrawl und die Live-Beobachtung, ob Google die neue Einordnung sauber uebernimmt.

Entschiedene Richtung:

- URL behalten
- unter WGOS neu rahmen
- Snippet auf Betrieb, Updates, Sicherheit und Stabilitaet ausrichten
- CTA auf Audit/WGOS statt auf alte Wartungsvertrag-Logik
- Query-Signal nicht wegwerfen, sondern in den Fundament-Layer uebernehmen

### 3. Snippet-Quick-Wins auf bereits gut rankenden Seiten

Stand:

- Erledigt im Theme fuer:
  - `/kontaktiere-mich/` bzw. `/kontakt/`
  - `/wordpress-growth-operating-system/`
  - `/kostenlose-tools/`
- Die Default-Metas sind jetzt belastbarer und konsistenter als vorher.

Diese Seiten haben schon Sichtbarkeit oder gute Positionen. Hier bringen kleine Eingriffe oft sofort mehr CTR:

- `/kontaktiere-mich/`
- `/wordpress-growth-operating-system/`
- `/kostenlose-tools/`
- `/shopify-wartungsvertrag/` nur falls die URL doch behalten wird

Pro Seite:

- SEO-Title gegen Suchintention schaerfen
- Description ergaenzen oder verdichten
- klarer Nutzen + Proof + naechster Schritt
- keine generischen Claim-Phrasen

### 4. Legacy-URLs final bereinigen

Stand:

- Technische Redirects fuer Legacy-Routen sind bereits aktiv.
- Die Legacy-Kontakt-URL `/kontaktiere-mich/` wurde auf einen dauerhaften 301 zur kanonischen `/kontakt/`-Route umgestellt.
- Im Child-Theme wurden aktuell keine direkten Frontend-Hrefs auf `/alle-loesungen-im-detail/` gefunden.
- `case-studies` lebt vor allem noch als historisches Signal und Redirect-Thema, nicht mehr als klarer aktiver Navigationspfad im Theme.
- Offen bleibt hier primär Search Console, nicht mehr das Theme-Routing.

Betroffen:

- `/case-studies/`
- `/alle-loesungen-im-detail/`

Status:

- beide URLs tauchen noch in Search Console auf
- Redirects sind bereits im Theme vorhanden

Jetzt noch noetig:

- interne Links auf Ziel-URLs umstellen
- nur noch Ziel-URLs in der Sitemap haben
- Ziel-URLs in Search Console neu anstossen

## P1 - Diese Woche

### 5. Kannibalisierung fuer lokale Kernqueries aufloesen

Stand:

- Die Fuehrungsseite `/wordpress-agentur-hannover/` wurde im Snippet und im Schema auf das Keyword `WordPress Agentur Hannover` geschaerft.
- Der Hero der Seite ist jetzt ebenfalls klarer auf dieselbe Suchintention ausgerichtet.
- Die grundlegende technische Richtung ist damit gesetzt; offen bleiben Search-Console-Beobachtung und ggf. weitere interne Linkverstaerkung.

Betroffen:

- `wordpress agentur hannover`
- `woocommerce agentur hannover`
- `wordpress hannover`

Vorgehen:

1. Pro Query eine Primaer-URL festlegen
2. Title/Description der Primaer-URL auf diese Query schaerfen
3. interne Links mit passendem Anchor auf die Primaer-URL lenken
4. konkurrierende Seiten nicht weiter auf dieselbe Suchintention optimieren

Primaere Vermutung:

- fuer `wordpress agentur hannover` sollte `/wordpress-agentur-hannover/` die Fuehrungsseite sein

### 6. `/wordpress-seo-hannover/` nicht blind umschreiben

Stand:

- Die Seite wurde technisch und im Snippet klarer auf **technisches SEO für WordPress** zugespitzt.
- Meta, Schema und Hero-/Systemlogik unterscheiden jetzt stärker zwischen:
  - technischer SEO-Seite
  - breiterer Agentur-Seite `/wordpress-agentur-hannover/`
- Zusaetzlich gibt es jetzt auf der SEO-Seite eine klare Bruecke zur Agentur-Seite fuer den breiteren Intent.
- Erster Schärfungsdurchlauf ist damit erledigt; offen bleibt nur noch die Beobachtung, ob die Kannibalisierung in Search Console sinkt.

Status:

- viele Impressionen
- schwache Position
- relevanter Cluster-Kandidat

Vorgehen:

- erst Query-Mix und interne Linkstruktur pruefen
- dann Snippet, Intro, Haupt-H1, Suchintention und interne Cluster-Links schaerfen
- keine grosse Rewrite-Runde, bevor Primaerseiten sauber definiert sind

### 7. Draft-/noindex-Seiten mit Rest-Sichtbarkeit aufraeumen

Stand:

- `/ga4-tracking-setup/` und `/performance-marketing/` laufen nicht mehr ueber die Legacy-Redirect-Map, sondern koennen als echte WGOS-Cluster-Routen arbeiten.
- Das SEO-Cockpit liest Legacy-Redirects wie `/roi-rechner/` jetzt sinnvoller als Redirect statt als irrefuehrende Draft-/noindex-Seite.
- Fuer `/roi-rechner/` bleibt die Redirect-Strategie zur Tools-Uebersicht bewusst bestehen.
- Offen bleibt hier vor allem der Search-Console-Recrawl fuer `/ga4-tracking-setup/` und `/performance-marketing/`.

Betroffen:

- `/ga4-tracking-setup/`
- `/performance-marketing/`
- `/roi-rechner/`

Fuer jede URL Entscheidung:

- soll ranken -> publish + index + sauberer Snippet-Status
- soll nicht ranken -> noindex lassen, intern entkoppeln, nicht verlinken, nicht in Sitemap

## P2 - Danach

### 8. Themencluster weiter ausbauen

Erst nach Bereinigung der Fehlersignale:

- WordPress Agentur Hannover
- Technisches SEO / WordPress SEO
- Wartung / Betrieb / Security

### 9. Koko und Search Console spaeter tiefer verzahnen

Der Cockpit-Unterbau ist vorhanden, aber kein akuter SEO-Hebel gegenueber den obigen Punkten.

## Intelligente Umsetzungslogik

Die effizienteste Reihenfolge ist:

1. **Aus dem Index nehmen oder sauber weiterleiten, was fachlich nicht mehr lebt**
2. **sichtbare Seiten mit Snippet-Schwachstellen korrigieren**
3. **lokale Kernqueries auf eine Fuehrungsseite konzentrieren**
4. **erst danach Content- und Cluster-Ausbau**

Damit vermeidest du drei typische Fehler:

- Traffic in tote oder falsche URLs weiterlaufen zu lassen
- Snippet-Arbeit auf Seiten ohne klares Ziel zu verschwenden
- mehrere Seiten gleichzeitig fuer dieselbe Query gegeneinander arbeiten zu lassen

## Konkrete naechste Admin-Tasks

### Jetzt sinnvoll

- Search Console Requests fuer Ziel-URLs anstossen:
  - `/shopify-wartungsvertrag/`
  - `/wordpress-wartung-hannover/`
  - `/wordpress-agentur-hannover/`
  - `/wordpress-seo-hannover/`
  - `/ga4-tracking-setup/`
  - `/performance-marketing/`
- Live pruefen, ob die neuen Title/Descriptions und Redirects ungecacht korrekt ausgegeben werden
- In Search Console beobachten, ob `wordpress agentur hannover` und `wordpress seo hannover` klarer auf getrennte Zielseiten laufen

### Danach

- Primaer-URL-Mapping in Snippets, interne Links und CTA-Bridges ueberfuehren
- interne Links auf `/wordpress-agentur-hannover/` weiter staerken
- alte URLs und nicht gewollte Draft-Signale konsequent aufraeumen

## Verbindliches Primaer-URL-Mapping

Bis neue Search-Console-Daten etwas anderes belegen, gilt fuer Snippets, interne Links, CTA-Bridges und Related Content diese Zuordnung:

| Query / Intent | Primaer-URL | Support-URLs | Nicht gegeneinander optimieren |
|---|---|---|---|
| `wordpress agentur hannover` | `/wordpress-agentur-hannover/` | `/`, `/uber-mich/`, passende Blogposts, `/growth-audit/` | `/wordpress-seo-hannover/` nicht auf breiten Agentur-Intent ziehen |
| `wordpress seo hannover`, `wordpress suchmaschinenoptimierung hannover` | `/wordpress-seo-hannover/` | `/category/seo/`, `/technisches-seo-performance-fundament/`, `/core-web-vitals/` | `/wordpress-agentur-hannover/` nicht auf denselben SEO-Intent zuspitzen |
| `wordpress wartung hannover`, `wordpress wartungsvertrag hannover` | `/wordpress-wartung-hannover/` | `/wordpress-growth-operating-system/`, wartungsnahe WGOS-Assets, passende Insights | keine zweite Wartungs-LP mit fast identischem Hannover-Intent aufbauen |
| `ga4 tracking setup`, `server-side tracking`, `consent mode` | `/ga4-tracking-setup/` | Tracking-Posts, `/category/tracking/`, `/growth-audit/` | Tracking-Intent nicht ueber `/performance-marketing/` oder Agentur-Seiten abfangen |
| `core web vitals optimierung`, `pagespeed optimierung` | `/core-web-vitals/` | `/website-performance-analyse/`, passende Performance-Posts, `/growth-audit/` | Tool-Intent und Service-Intent nicht auf dieselbe Meta/H1 pressen |
| `woocommerce agentur hannover` | vorerst kein eigener Primaer-Launch | vorlaeufig `/wordpress-agentur-hannover/` als naechstes bestes Ziel | neue LP nicht vor der Bereinigung der Kern-Cluster live ziehen |

## Technische Verifikation aus der Research-MD

Diese Punkte sind nicht "noch ein Audit", sondern die konkrete QA-Liste vor weiteren neuen Seiten:

1. Live-Head der Primaer-URLs pruefen: genau ein Canonical, korrekte `og:url`, kein konkurrierendes Plugin-Meta.
2. Live-Schema auf `/`, `/wordpress-agentur-hannover/`, `/wordpress-seo-hannover/` und `/wordpress-wartung-hannover/` abgleichen: `LocalBusiness`, `Service` und optional `WebSite` nicht doppelt ausgeben.
3. Doppelte H1 nicht nur im Theme suchen, sondern zuerst die aktiven Live-Templates und Editor-Heroes pruefen.
4. Sitemap-Quelle festhalten: WordPress Core, Rank Math oder andere Plugin-Sitemaps duerfen nicht parallel widerspruechliche Ziel-URLs tragen.
5. Interne Links in Startseite, Category-Hubs, Related Content und Footer gegen das Primaer-Mapping pruefen.

## Repo-Hinweise

Bereits vorhandene technische Redirect-Stelle:

- `blocksy-child/inc/snippets.php`

Bereits relevante Cluster-/SEO-Stellen:

- `blocksy-child/inc/seo-meta.php`
- `blocksy-child/inc/org-schema.php`
- `blocksy-child/inc/enqueue.php`
- `blocksy-child/inc/wgos-cluster-pages.php`
- `blocksy-child/inc/helpers.php`

Falls `/shopify-wartungsvertrag/` technisch im Theme abgefangen werden soll, ist `inc/snippets.php` der wahrscheinlich beste Einstiegspunkt.
