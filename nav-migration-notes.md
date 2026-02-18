# Navigation Migration – hasimuener.de

## Manuelle Schritte in WordPress-Admin (nach Code-Deploy)

1. Dashboard → Design → Menüs
2. Neues Menü erstellen: "Hauptmenü Slim"
3. Diese Seiten hinzufügen:
   - WordPress Growth Operating System (/wordpress-growth-operating-system/)
   - Case Studies (/case-studies/)
   - Blog (/blog/)
   - Über mich (/uber-mich/)
   - Customer Journey Audit (/customer-journey-audit/) → Klasse "nav-cta-button" vergeben
   - Alle Punkte auf derselben Ebene lassen (keine Untermenüs/Dropdowns)
4. Menü-Position: "Hauptmenü Slim (Positioniert)" auswählen → Speichern
5. Altes Menü NICHT löschen – nur deaktivieren (Backup)

## Was mit den alten Service-Seiten passiert
- Seiten bleiben bestehen (SEO + interne Verlinkung)
- Sie fliegen nur aus dem Hauptmenü raus
- Intern verlinken via WGOS-Seite und Blog-Posts

## Kunden-Cockpit Link (empfohlene Platzierung)
- Nicht im primären Slim-Menü platzieren (fokussiert auf Neukunden-Narrativ).
- Stattdessen als Utility-Link nutzen: Header-HTML-Element mit Shortcode `[nexus_header_btn]`.
- Zusätzlich im Footer unter "Unternehmen" als Link "Kunden-Cockpit" auf `/portal/`.
- Wenn CTA bereits im Menü ist, separaten Header-Button für denselben CTA entfernen (keine Doppelung).

## Homepage-Optimierung – Manuelle Schritte in WP-Admin

### HERO-SEKTION
[ ] Hero Subline ändern zu:
    ALT: "Ich baue aus Ihrer WordPress-Instanz ein Owned-Leads-System..."
    NEU: Subline KÜRZEN auf max. 1 Satz:
    "Ich baue Ihre WordPress-Instanz zum Owned-Leads-System um –
     ohne Ad-Abhängigkeit, mit messbarem Ergebnis."
    
[ ] Stack-Text-Block ("Advanced WordPress · Technical SEO...") 
    → CSS-Klasse "hero-stack-text" zuweisen ODER direkt löschen
    
[ ] Primärer Hero CTA bleibt: "Free Journey Audit" 
    → /customer-journey-audit/ ✓ (bereits korrekt)

### WGOS-SEKTION auf Homepage
[ ] Nach der bestehenden WGOS-Text-Sektion (Speed/Measurement/Flywheel):
    Neuen Block hinzufügen: Custom HTML
    → homepage-mindmap-teaser.jsx als kompiliertes Script einbinden
    → Alternativ: Kurztext-Version mit 3 Spalten als Zwischenlösung

### REIHENFOLGE DER SEKTIONEN (Drag & Drop im Editor)
Ziel-Reihenfolge von oben nach unten:
  1. Hero
  2. Schmerz-Sektion (Modell A vs B) ← bereits vorhanden
  3. WGOS-System-Sektion + Mindmap-Teaser
  4. Track Record / Cases ← WICHTIG: 1-Satz-Kontext ergänzen
  5. "Für wen ist das nichts?" ← aus FAQ rausziehen, eigene Sektion
  6. Audit-CTA Sektion
  7. FAQ (nur 3 Fragen behalten)
  8. Blog ← ans Ende

### TRACK RECORD – Kontext ergänzen
Pro Case 1 Satz VOR den Zahlen:
E3 New Energy:
"E3 startete mit 150€ CPL über Google Ads ohne messbare 
 Leadqualität. Nach WGOS-Aufbau:"
→ dann die Zahlen

DOMDAR:
"DOMDAR hatte 46€ Warenkorb-Schnitt und 4,2s Ladezeit. 
 Nach Performance Relaunch:"
→ dann die Zahlen

### "FÜR WEN IST DAS NICHTS?" – eigene Sektion
Text: (aus FAQ kopieren und als eigene Sektion platzieren)
"Für Hobby-Projekte, reine Visitenkarten ohne Lead-Absicht 
 oder Unternehmen die Baukasten-Preise erwarten. 
 Das System ist für B2B-Unternehmen ab ~500.000€ Jahresumsatz, 
 die planbar skalieren wollen."

Styling: Dark-Card mit Rahmen, leicht abgesetzt – 
signalisiert Selektivität = erhöht Vertrauen bei Zielgruppe
