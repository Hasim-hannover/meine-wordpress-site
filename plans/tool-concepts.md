# Konzepte für neue Tools auf hasimuener.de

## 1. Lead-Kosten-Rechner (CPL)

### Ziel
Den Besuchern zeigen, wie viel sie für unqualifizierte Leads ausgeben und wie viel effizientere eigene Leads kosten könnten.

### Funktionalität
- Eingabefelder für:
  - Monatliche Leads aus gekauften Portalen
  - Kosten pro Lead aus gekauften Portalen
  - Monatliche eigene organische Leads
  - Kosten pro eigenem Lead (z.B. durch SEO/Content-Marketing)
- Berechnung und Vergleich der Lead-Kosten
- Visualisierung der Einsparungspotenziale

### Integration
- Platzierung als eigenständiges Tool auf der Audit-Seite
- Option zur Integration in bestehende Blog-Posts über Leadgenerierung

## 2. Traffic vs. Conversion-Simulator

### Ziel
Verdeutlichen, dass eine bessere Conversion-Rate oft wertvoller ist als mehr Traffic.

### Funktionalität
- Interaktiver Schieberegler zur Anpassung der Conversion-Rate
- Eingabefelder für:
  - Monatlicher Website-Traffic
  - Aktuelle Conversion-Rate in %
- Berechnung der resultierenden Leads/Konversionen
- Visualisierung des Einflusses einer verbesserten Conversion-Rate

### Integration
- Platzierung als eigenständiges Tool auf der Audit-Seite
- Integration in Blog-Posts über Conversion-Optimierung

## 3. Tracking- & Consent-Scanner

### Ziel
Bestehende Tracking-Setups auf Datenlücken und DSGVO-Risiken prüfen.

### Funktionalität
- Eingabefeld für Website-URL
- Prüfung auf:
  - Vorhandensein von Tracking-Tools (Google Analytics, Facebook Pixel, etc.)
  - Korrekte Implementierung von Consent-Managern
  - potenzielle DSGVO-Risiken
- Generierung eines einfachen Berichts mit Funden und Empfehlungen

### Integration
- Platzierung als eigenständiges Tool auf der Audit-Seite
- Verlinkung zum vollständigen Growth Audit

## 4. Speed-Penalty-Rechner

### Ziel
Den Besuchern zeigen, wie viel Geld sie durch langsame Ladezeiten verlieren.

### Funktionalität
- Eingabefelder für:
  - Monatlicher Website-Traffic
  - Aktuelle durchschnittliche Ladezeit in Sekunden
  - Branche (E-Commerce, B2B, Blog, etc.)
- Berechnung der:
  - Abbruchrate basierend auf Ladezeiten
  - Verlorenen Leads oder Umsatz aufgrund langsamer Ladezeiten
- Visualisierung der potenziellen Gewinne durch Performance-Optimierung

### Integration
- Platzierung als eigenständiges Tool auf der Audit-Seite
- Verlinkung zu Core Web Vitals und Performance-Angeboten

## Technische Umsetzung

### Allgemeine Struktur
- Alle Tools werden als eigenständige Module implementiert
- Gemeinsame CSS-Klasse für einheitliches Erscheinungsbild
- JavaScript-Module für jede Funktionalität
- Responsives Design für alle Bildschirmgrößen

### Datenverarbeitung
- Client-seitige Berechnungen für maximale Privatsphäre
- Keine Speicherung von Nutzerdaten
- Klare Datenschutzhinweise bei jedem Tool

### Integration in bestehende Seite
- Erstellung einer neuen Template-Page für Tools
- Einbindung der Tools über Shortcodes oder Template-Parts
- Tracking der Tool-Nutzung über data-track-Attribute