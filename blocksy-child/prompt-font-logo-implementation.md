# AUFGABE: Self-Hosted Fonts + Logo-Implementierung

## Kontext
Die Website hasimuener.de darf KEINE externen Font-Requests machen. Keine Google Fonts, keine Adobe Fonts, keine CDNs. Alles wird lokal vom eigenen Server geladen. DSGVO-konform, Performance-optimal.

## Schritt 1: Font-Dateien herunterladen

Lade folgende WOFF2-Dateien herunter und speichere sie unter:
`/wp-content/themes/blocksy-child/fonts/`

### Outfit (Wortmarke & Headlines)
- `outfit-600.woff2` — SemiBold (einziges benötigtes Weight)
- Download: <https://gwfh.mranftl.com/fonts/outfit?subsets=latin,latin-ext>
- Wähle: Weight 600, Format woff2, Subset latin + latin-ext
- WICHTIG: latin-ext muss enthalten sein (für Ş und Ü)

### Figtree (Body Text)
- `figtree-400.woff2` — Regular
- `figtree-500.woff2` — Medium
- `figtree-600.woff2` — SemiBold
- `figtree-700.woff2` — Bold
- Download: <https://gwfh.mranftl.com/fonts/figtree?subsets=latin,latin-ext>

### Dateistruktur im Repo
```text
blocksy-child/
├── fonts/
│   ├── outfit-600.woff2
│   ├── figtree-400.woff2
│   ├── figtree-500.woff2
│   ├── figtree-600.woff2
│   └── figtree-700.woff2
├── fonts.css
├── style.css
└── functions.php
```

## Schritt 2: fonts.css einbinden

Die Datei `fonts.css` liegt im Repo unter `/assets/brand/fonts.css`. Kopiere sie nach `blocksy-child/fonts.css`.

In `functions.php` einbinden, vor allen anderen Styles, mit Preload.

## Schritt 3: Google Fonts komplett entfernen

Prüfe und entferne ALLE Google Fonts Referenzen.

## Schritt 4: Wortmarke implementieren

Ersetze das aktuelle Bild-Logo durch die CSS-basierte Wortmarke.

### HTML
```html
<a href="/" class="site-logo" rel="home">HAŞIM ÜNER</a>
```

### CSS
```css
.site-logo {
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 14px;
  letter-spacing: 0.22em;
  text-transform: uppercase;
  text-decoration: none;
  color: var(--text-primary);
  line-height: 1;
  white-space: nowrap;
}
```

## Schritt 5: Favicon

Nutze `favicon-copper.svg` aus `/assets/brand/` als Favicon.

## Schritt 6: Validierung

- Kein Request an `fonts.googleapis.com` oder `fonts.gstatic.com`
- Outfit rendert korrekt mit `Ş` und `Ü`
- `font-display: swap` aktiv
- Preload aktiv
- Dark Mode: Logo-Text in `#E8E5E0`
- Light Mode: Logo-Text in `#1F1C18`
