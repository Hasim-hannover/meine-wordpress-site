# Internal Link Audit - 2026-03-12

Repo-only audit. Kein Live-HTTP-Check moeglich. Alle Statusaussagen wurden aus Theme-Code, Helpern, Redirect-Logik und vorhandenen Templates abgeleitet.

## 1. Repo-Struktur-Befund
- Repo-Typ: kein vollstaendiges WordPress-Root, sondern Child-Theme-/Site-Repo mit `blocksy-child/`, Assets, Automations und Doku.
- Relevante Ordner: `blocksy-child/`, `blocksy-child/inc/`, `blocksy-child/template-parts/`, `blocksy-child/assets/js/`, `blocksy-child/assets/html/`, `docs/`.
- Wichtigste Linkquellen: `inc/header.php`, `template-parts/site-header.php`, `template-parts/site-footer.php`, `template-parts/blog-header.php`, `template-parts/footer-cta.php`, `404.php`, `category.php`, `page-case-e3.php`, `page-seo-cornerstone.php`.
- Globale Komponenten: Custom Header, Blog Header, Footer, Footer-CTA, Breadcrumb, 404-Recovery, Menue-Rebuild.
- Besondere dynamische Linkquellen: `inc/helpers.php` (`nexus_get_*` Resolver), `inc/menu-setup.php`, `inc/wgos-assets.php`, `inc/wgos-asset-registry.php`, `inc/wgos-asset-registry-data.php`, `inc/acf.php` (`related_pages`), `inc/shortcodes.php`, `inc/snippets.php`, `assets/html/wgos-social-proof.html`.
- Seitentyp/Architektur: klassisches PHP-Theme mit starker Helper-/Registry-Logik und einigen asset-/JS-gestuetzten Modulen. Kein Block-Theme.
- WGOS/Asset-Ebene: vorhanden und relevant. Die Asset-Explorer-Links laufen ueber Registry-/Link-Key-Resolver, nicht ueber lose Hardcodes.

## 2. Audit Summary
- Gepruefte Dateien: 47 Dateien mit interner Linklogik identifiziert; die globalen und priorisierten Quellen manuell geprueft.
- Gefundene interne Links: 121 Repo-Linkreferenzen inventarisiert (113 resolver-/helperbasiert, 8 harte `href="/..."`-Pfade).
- Kaputte/vermutlich kaputte Links: 0 sichere Hard-Error-Hardcodes im aktuellen Theme-Code nachweisbar. Ohne Live-Check wurden keine 200/404-Behauptungen gemacht.
- Redirect-Links: 0 aktive Theme-Hardcodes auf die bekannten kritischen Legacy-Slugs `/case-studies/`, `/customer-journey-audit/`, `/wordpress-tech-audit/`, `/kontakt/`, `/kontaktiere-mich/`.
- Auto-Fixes: 5.
- Vorschlaege: 3.
- Status unbekannt - manuell pruefen: 4.
- Unterverlinkte Kernseiten: `/kontakt/` in Recovery-/Header-Kontexten, `/ergebnisse/` im About-Kontext.
Bekannte kritische Faelle:
- `/case-studies-e-commerce/` wird im aktuellen Main nicht mehr aktiv als globaler Standard-Link ausgespielt; globale Komponenten priorisieren `nexus_get_results_url()`.
- `/customer-journey-audit/` erscheint nur noch in Legacy-Erkennung, Redirect-/Normalizer-Logik und Schema-Kontexten.
- `/wordpress-tech-audit/` erscheint nur noch in Redirect-/Snippet-/Schema-Kontexten, nicht als aktive Theme-CTA.

## 3. Auto-Fixes

| Datei | Komponente | alter Link | neuer Link | Grund | Confidence | global/lokal |
| --- | --- | --- | --- | --- | --- | --- |
| `blocksy-child/404.php` | 404 recovery | `/wordpress-growth-operating-system/` | resolverbasiert ueber `nexus_get_wgos_url()` | globalen Recovery-Link auf kanonischen WGOS-Resolver gestellt | 0.98 | global |
| `blocksy-child/404.php` | 404 recovery | `/wordpress-seo-hannover/` | resolverbasiert ueber `nexus_get_page_url(['wordpress-seo-hannover','seo'])` | harte Service-URL auf Seitenslug-Resolver normalisiert | 0.95 | global |
| `blocksy-child/404.php` | 404 recovery | `/blog/` | `get_permalink(page_for_posts)` mit `/blog/`-Fallback | vermeidet falschen Blog-Link bei abweichendem Posts-Page-Slug | 0.97 | global |
| `blocksy-child/page-case-e3.php` | FAQ / WGOS | `/wordpress-growth-operating-system/` | resolverbasiert ueber `nexus_get_wgos_url()` | lokaler WGOS-Hardcode auf denselben Resolver wie globale Module gestellt | 0.96 | lokal |
| `blocksy-child/page-case-e3.php` | Next-step internal links | `/wordpress-growth-operating-system/` | resolverbasiert ueber `nexus_get_wgos_url()` | CTA-Link in der Case Study kanonisiert | 0.96 | lokal |

## 4. Vorschlaege
- `blocksy-child/page-seo-cornerstone.php`: Die harten Links auf `/wordpress-seo-hannover/`, `/core-web-vitals/` und `/conversion-rate-optimization/` in Body und Schluss-CTA sollten auf Helper-Resolver umgestellt werden. Confidence 0.82. Kein Auto-Fix, weil `feat/wgos-asset-content-overhaul` dieselben Bereiche bearbeitet und Live-Permalinks nicht verifiziert wurden.
- `blocksy-child/category.php`: Das `pillar_map` nutzt fuer Strategie-, SEO- und Performance-CTAs rohe Slugs statt Helper. Confidence 0.80. Kein Auto-Fix, weil `hotfix/primary-ctas-header-hero` dieselbe Datei bearbeitet und dort bereits Legacy-Risiko sichtbar ist.
- `blocksy-child/template-about.php`: Die About-Seite fuehrt aktuell nur in den Audit. Eine zweite, proof- oder systemnahe Verlinkung auf `nexus_get_results_url()` oder WGOS waere sinnvoll. Confidence 0.76. Kein Auto-Fix, weil das eine IA-/Copy-Entscheidung ist, nicht nur URL-Normalisierung.

## 5. Strategische Chancen
- Quelle: `blocksy-child/template-about.php`
  Empfohlenes Ziel: `/ergebnisse/`
  Linktyp: sekundaere CTA oder Proof-Link im Hero/Finale
  Nutzen: About wird nicht zur Audit-only Sackgasse und staerkt die Proof-Ebene.
- Quelle: `blocksy-child/template-about.php`
  Empfohlenes Ziel: WGOS-Systemseite
  Linktyp: kontextueller Textlink oder sekundaire CTA
  Nutzen: verbindet Personenvertrauen mit Systemlogik statt nur mit Lead-Capture.
- Quelle: `blocksy-child/404.php`
  Empfohlenes Ziel: `/kontakt/`
  Linktyp: Recovery-Link
  Nutzen: gibt High-intent Nutzern nach Fehlklick einen direkten Hand-off statt nur Content-Rueckweg.
- Quelle: `blocksy-child/category.php`
  Empfohlenes Ziel: `tracking-audit`-Asset statt Legacy-Service-Slug
  Linktyp: Pillar-CTA
  Nutzen: staerkt WGOS-/Asset-Architektur und verhindert das erneute Pushen alter Service-Slugs.

## 6. Konflikte / ausgelassene Aenderungen
- Datei: `blocksy-child/page-seo-cornerstone.php`
  Grund: `feat/wgos-asset-content-overhaul` aendert denselben Content-Bereich. Der Branch-Diff ersetzt Helper-basiertes Tracking bereits wieder durch den Legacy-Pfad `/ga4-tracking-setup/`. Deshalb nur Vorschlag, kein Auto-Fix.
- Datei: `blocksy-child/category.php`
  Grund: `hotfix/primary-ctas-header-hero` aendert dasselbe CTA-Mapping und fuehrt dort bereits wieder `/ga4-tracking-setup/` ein. Deshalb nur Vorschlag, kein Auto-Fix.
- Datei: `blocksy-child/page-case-e3.php`
  Grund: Datei wird ebenfalls von `hotfix/primary-ctas-header-hero` angefasst. Hier wurden nur zwei nicht ueberlappende WGOS-Linkzeilen minimal angepasst.
- Datei: `blocksy-child/inc/header.php`, `blocksy-child/template-parts/site-footer.php`, `blocksy-child/inc/menu-setup.php`
  Grund: von anderen Branches beruehrt, aktuell im Main aber bereits kanonisch ueber Helper/Resolver; deshalb bewusst nicht angefasst.

## 7. Offene Pruefposten
- Live-Pruefung notwendig: finales Verhalten von `/ergebnisse/`, `/case-studies-e-commerce/` und `/case-studies/` auf der echten Site.
- Live-Pruefung notwendig: bestaetigen, dass `/customer-journey-audit/` und `/wordpress-tech-audit/` ausserhalb des Repos weiterhin sauber auf `/growth-audit/` normalisieren.
- Manuell validieren: ob die Live-Permalinks fuer SEO-, CWV- und CRO-Seiten exakt den im Repo hartcodierten Slugs entsprechen, bevor `page-seo-cornerstone.php` helper-basiert umgestellt wird.
- Merge-Risiko beobachten: `feat/wgos-asset-content-overhaul` und `hotfix/primary-ctas-header-hero` koennen Legacy-Pfade wieder einfuehren, obwohl der Main-Zweig aktuell sauberer ist.
