# Blog Notify

Stand: 2026-03-13.

Diese Doku beschreibt das repo-seitige System fuer `Neue Artikel per E-Mail`.

Wichtig:

- Es ist bewusst kein klassischer Marketing-Newsletter.
- WordPress ist Source of Truth fuer Kontakte, Consent, Segmente und Status.
- Brevo bleibt reine Zustellungs- und Transportebene ueber den zentralen Mail-Layer.

## Zweck

Das System sammelt nur E-Mail-Adressen von Personen, die bei neuen Blogartikeln kurz informiert werden moechten.

Ziel:

- niedrige Reibung
- sauberes Double-Opt-in
- sofort wirksame Abmeldung
- klare CRM-Zuordnung im WordPress-Backend
- spaetere Erweiterbarkeit fuer manuelle oder automatische Artikel-Benachrichtigungen

## Aktiver Repo-Flow

1. Besucher sieht auf Blog-Home, Kategorie-/Archivseiten oder unter einzelnen Artikeln das Formular `Neue Artikel per E-Mail`.
2. `blocksy-child/assets/js/blog-notify.js` sendet `POST /wp-json/nexus/v1/blog-subscribe`.
3. `blocksy-child/inc/blog-notify.php` prueft Honeypot, Rate Limit, Nonce und E-Mail-Adresse.
4. WordPress speichert oder aktualisiert den Kontakt im CPT `nexus_contact`.
5. Der Kontakt bleibt im Segment `blog_notify`, Consent steht zuerst auf `pending`.
6. Eine DOI-Mail wird ueber `wp_mail` und den zentralen Brevo-Mail-Layer versendet.
7. Der Klick auf den Bestaetigungslink aktiviert das Abo ueber die Route `/neue-artikel-per-email/?action=confirm&token=...`.
8. Der Klick auf den Abmeldelink entzieht das Abo ueber dieselbe Route mit `action=unsubscribe`.

## Datenmodell

Primaerer Datensatz:

- CPT `nexus_contact`

Wichtige Meta-Felder fuer Blog-Abos:

- `_nexus_contact_email`
- `_nexus_contact_source=blog_subscriber` beim Erstkontakt ueber dieses System
- `_nexus_contact_latest_source`
- `_nexus_contact_segments[]` mit `blog_notify`
- `_nexus_contact_segment_blog_notify=1`
- `_nexus_contact_blog_status` mit `pending|active|unsubscribed`
- `_nexus_contact_consent_blog_email` mit `pending|confirmed|revoked`
- `_nexus_contact_blog_confirm_token`
- `_nexus_contact_blog_confirm_requested_at`
- `_nexus_contact_double_opt_in_confirmed_at`
- `_nexus_contact_unsubscribe_token`
- `_nexus_contact_unsubscribed_at`
- `_nexus_contact_created_at`
- `_nexus_contact_updated_at`

## Admin und CRM

Das bisherige Audit-CRM ist repo-seitig zu `Nexus CRM` erweitert.

Darin sichtbar:

- Audit-Anfragen als `nexus_review_request`
- CRM-Kontakte als `nexus_contact`
- gefilterte Einstiegspunkte fuer `Blog-Abos` und `Projektanfragen`

## Versandlogik fuer Artikel

Version 1 nutzt keinen vollautomatischen Publish-Blast.

Stattdessen:

- jeder Beitrag hat im Editor eine Meta-Box `Neue Artikel per E-Mail`
- der Versand wird manuell pro Artikel gestartet
- aktive Empfaenger werden als feste Snapshot-Liste gespeichert
- die Verarbeitung laeuft in kleinen Batches ueber einen einfachen Queue-/Cron-Mechanismus
- pro Artikel wird ein erneuter Versand in V1 bewusst blockiert

Warum diese Entscheidung:

- geringeres Risiko versehentlicher Sends
- saubere Kontrolle im Content-Workflow
- leichter spaeter zu automatisieren

## Repo-Touchpoints

- `blocksy-child/inc/crm.php`
- `blocksy-child/inc/blog-notify.php`
- `blocksy-child/template-parts/blog-notify.php`
- `blocksy-child/page-blog-notify.php`
- `blocksy-child/assets/js/blog-notify.js`
- `blocksy-child/assets/css/blog-notify.css`
- `blocksy-child/single.php`
- `blocksy-child/home.php`
- `blocksy-child/category.php`
- `blocksy-child/archive.php`
- `blocksy-child/inc/enqueue.php`

## Risiken

- ohne echten Live-Test bleibt offen, ob DOI und Artikelversand auf der Live-Instanz exakt wie erwartet laufen
- der Queue-Ansatz ist bewusst leichtgewichtig und fuer spaeteren Ausbau gedacht, nicht fuer sehr grosse Listen
- bei identischen E-Mail-Adressen wird ein Kontakt CRM-seitig aktualisiert statt vervielfacht

## Naechste sinnvolle Schritte

1. einen End-to-End-Test fuer DOI, Bestaetigung und Abmeldung live durchfuehren
2. einen Testversand aus der Artikel-Meta-Box mit einer kleinen Empfaengerzahl pruefen
3. fuer Phase 2 entscheiden, ob Artikel-Benachrichtigungen automatisch beim Publish oder weiter manuell ausgeloest werden sollen
