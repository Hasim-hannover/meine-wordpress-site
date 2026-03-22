#!/usr/bin/env bash

set -euo pipefail

THEME="blocksy-child"

header() { printf '\n=== %s ===\n' "$1"; }

# --- 1. Collect all page templates ---
header "Page Templates"

templates="$(find "$THEME" -maxdepth 1 -name 'page-*.php' -o -name 'front-page.php' -o -name 'home.php' -o -name 'template-*.php' | sort)"
echo "$templates" | while IFS= read -r t; do
  slug="$(basename "$t" .php | sed 's/^page-/\//' | sed 's/^front-page/\//' | sed 's/^template-/\//' | sed 's/$/\//')"
  printf '  %s -> %s\n' "$t" "$slug"
done

# --- 2. Extract internal links from templates ---
header "Link Matrix (template -> outbound links)"

all_links=""

for tpl in $templates "$THEME"/template-parts/*.php; do
  [[ -f "$tpl" ]] || continue
  name="$(basename "$tpl")"

  # Extract home_url() targets
  links="$(grep -oP "home_url\(\s*'([^']+)'" "$tpl" 2>/dev/null | grep -oP "'[^']+'" | tr -d "'" | sort -u || true)"

  # Extract hardcoded relative hrefs
  rel_links="$(grep -oP 'href="\/[^"]*"' "$tpl" 2>/dev/null | grep -oP '\/[^"]+' | sort -u || true)"

  combined="$(printf '%s\n%s' "$links" "$rel_links" | sort -u | grep -v '^$' || true)"

  if [[ -n "$combined" ]]; then
    echo
    echo "  $name:"
    echo "$combined" | while IFS= read -r link; do
      printf '    -> %s\n' "$link"
      all_links="$all_links $link"
    done
  fi
done

# --- 3. Find hub pages and their inbound count ---
header "Hub Page Inbound Links"

hubs=(
  "/growth-audit/"
  "/ergebnisse/"
  "/blog/"
  "/wordpress-growth-operating-system/"
  "/uber-mich/"
)

for hub in "${hubs[@]}"; do
  count="$(grep -rl "$hub" "$THEME/" --include='*.php' 2>/dev/null | wc -l)"
  count="${count//[[:space:]]/}"
  count="${count:-0}"
  if (( count < 3 )); then
    icon="✗"
  elif (( count < 5 )); then
    icon="△"
  else
    icon="✓"
  fi
  printf '  %s %s — %d templates link here\n' "$icon" "$hub" "$count"
done

# --- 4. Find orphan templates ---
header "Potential Orphan Pages"

for tpl in $templates; do
  slug="$(basename "$tpl" .php | sed 's/^page-//')"
  [[ "$slug" == "front-page" ]] && continue
  [[ "$slug" == "datenschutz" || "$slug" == "impressum" ]] && continue

  inbound="$(grep -rl "/$slug/" "$THEME/" --include='*.php' 2>/dev/null | grep -v "$(basename "$tpl")" | wc -l)"
  inbound="${inbound//[[:space:]]/}"
  inbound="${inbound:-0}"
  if (( inbound == 0 )); then
    printf '  ⚠ /%s/ — no inbound links from templates\n' "$slug"
  fi
done

header "Done"
echo "  Review the matrix above and add missing cross-links."
