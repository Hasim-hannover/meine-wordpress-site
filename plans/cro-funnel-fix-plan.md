# Implementierungsplan: Audit-Funnel CRO-Fixes

**Priorität:** KRITISCH
**Betroffene Dateien:** 3

---

## Fix 1: Audit-Ergebnis-CTA generalisieren

**Datei:** `blocksy-child/inc/cja-shortcode.php` (Zeilen 132-141)

### Was ändern

**Vorher:**
```php
<p>Der Audit war die Einordnung. Der nächste Schritt ist das qualifizierte Formular für Solar- und Wärmepumpen-Anbieter, damit aus Diagnose ein konkretes Projekt wird.</p>
<div class="cja-cta-actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="cja-cta-button" ...>Anfrage stellen</a>
    <a href="#form" class="cja-cta-link" ...>Audit erneut starten</a>
</div>
```

**Nachher:**
```php
<p>Der Audit war die Einordnung. Der nächste Schritt ist ein kurzes Formular — Sie erhalten eine persönliche Einschätzung per E-Mail, ohne Pitch.</p>
<div class="cja-cta-actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="cja-cta-button" ...>Einordnung anfordern</a>
</div>
```

### Konkrete Änderungen
1. CTA-Text generalisieren (Solar/Wärmepumpen-Erwähnung entfernen)
2. Button-Text von "Anfrage stellen" → "Einordnung anfordern"
3. Sekundären CTA "Audit erneut starten" entfernen (konkurriert mit primärem CTA)

---

## Fix 2: Solar-Seite → "Audit starten"-CTAs entfernen

**Datei:** `blocksy-child/page-solar-waermepumpen-leadgenerierung.php`

### Stelle 1: Hero (Zeile 227-230)

**Vorher:**
```php
<div class="energy-hero__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
    <a href="<?php echo esc_url( $audit_url ); ?>" class="energy-text-link" ...>Audit starten</a>
</div>
```

**Nachher:**
```php
<div class="energy-hero__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
</div>
```

### Stelle 2: Proof-Sektion (Zeile 244-247)

**Vorher:**
```php
<div class="energy-proof__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
    <a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--ghost" ...>Audit starten</a>
</div>
```

**Nachher:**
```php
<div class="energy-proof__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
</div>
```

### Stelle 3: Footer-CTA (Zeile 587-590)

**Vorher:**
```php
<div class="energy-cta-box__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
    <a href="<?php echo esc_url( $audit_url ); ?>" class="nx-btn nx-btn--ghost" ...>Audit starten</a>
</div>
```

**Nachher:**
```php
<div class="energy-cta-box__actions">
    <a href="<?php echo esc_url( $request_url ); ?>" class="nx-btn nx-btn--primary" ...><?php echo esc_html( $request_cta ); ?></a>
</div>
```

---

## Fix 3 (Optional): Audit-Header CTA anpassen

**Datei:** `blocksy-child/template-parts/site-header.php` (Zeile 63)

**Problem:** Der Audit-Header zeigt "Anfrage stellen" → Solar-Formular, bevor der User den Audit gemacht hat.

**Option A (einfach):** Link-Text zu "Ergebnisse ansehen" ändern — weniger drängend
**Option B (besser):** Link erst nach Audit-Ergebnis anzeigen (erfordert JS-State)

**Empfehlung:** Option A für jetzt — Text ändern, Logik später optimieren.

---

## Zusammenfassung der Änderungen

| Datei | Änderung | Auswirkung |
|-------|----------|------------|
| `cja-shortcode.php` | CTA-Text generalisieren, Button-Text ändern, sekundären CTA entfernen | Kein Messaging-Bruch für Nicht-Solar-Besucher |
| `page-solar-waermepumpen-leadgenerierung.php` | 3x "Audit starten"-Links entfernen | Keine Endlosschleife, unidirektionaler Funnel |
| `site-header.php` (optional) | Audit-Header CTA-Text anpassen | Weniger Druck vor Audit-Ergebnis |

---

## Testing nach Implementierung

1. **Audit-Flow testen:**
   - `/growth-audit/` → URL eingeben → Ergebnis → CTA-Text prüfen
   - CTA-Klick → Solar-Seite → Nur EIN primärer CTA sichtbar

2. **Solar-Seite direkt testen:**
   - `/solar-waermepumpen-leadgenerierung/` → Kein "Audit starten"-Link in Hero/Proof/Footer

3. **Header testen:**
   - Audit-Seite → Header-CTA-Text prüfen
   - Andere Seiten → Menü-Button "Audit starten" funktioniert

---

*Ende des Implementierungsplans*
