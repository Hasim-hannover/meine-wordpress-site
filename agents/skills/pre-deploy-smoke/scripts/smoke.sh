#!/usr/bin/env bash

set -euo pipefail

THEME="blocksy-child"
FAIL=0

# --- Helpers ---
header() { printf '\n=== %s ===\n' "$1"; }
pass()   { printf '  ✓ %s\n' "$1"; }
fail()   { printf '  ✗ %s\n' "$1"; FAIL=1; }

# --- 1. PHP Lint on changed files ---
header "PHP Lint"

changed_php="$(git diff --name-only HEAD -- '*.php' 2>/dev/null || true)"
staged_php="$(git diff --cached --name-only -- '*.php' 2>/dev/null || true)"
untracked_php="$(git ls-files --others --exclude-standard -- '*.php' 2>/dev/null || true)"
all_php="$(printf '%s\n%s\n%s' "$changed_php" "$staged_php" "$untracked_php" | sort -u | grep -v '^$' || true)"

if [[ -z "$all_php" ]]; then
  pass "No changed PHP files"
else
  lint_ok=true
  while IFS= read -r f; do
    [[ -f "$f" ]] || continue
    if ! php -l "$f" 2>&1 | grep -q "No syntax errors"; then
      fail "$f"
      php -l "$f" 2>&1 | grep -v "^$"
      lint_ok=false
    fi
  done <<< "$all_php"
  $lint_ok && pass "All PHP files pass lint"
fi

# --- 2. Hardcoded domain check ---
header "Hardcoded URLs"

hardcoded="$(grep -rn 'https\?://hasimuener\.de' "$THEME/" --include='*.php' 2>/dev/null || true)"
if [[ -n "$hardcoded" ]]; then
  fail "Hardcoded domain found (use home_url() instead):"
  echo "$hardcoded"
else
  pass "No hardcoded domain URLs"
fi

# --- 3. Raw echo check ---
header "Escaping Hygiene"

raw_echo="$(grep -rn 'echo \$' "$THEME/" --include='*.php' 2>/dev/null | grep -v 'esc_' | grep -v '// raw-ok' || true)"
if [[ -n "$raw_echo" ]]; then
  fail "Unescaped echo found (use esc_html/esc_attr/esc_url):"
  echo "$raw_echo" | head -20
else
  pass "No unescaped echo statements"
fi

# --- 4. Asset existence ---
header "Asset References"

if [[ -f "$THEME/inc/enqueue.php" ]]; then
  # Extract filenames from hu_enqueue_css/hu_enqueue_js and direct string concats
  css_files="$(grep -oP "hu_enqueue_css\(\s*'[^']+'\s*,\s*'([^']+)'" "$THEME/inc/enqueue.php" | grep -oP "'[^']+'" | tail -1 | tr -d "'" || true)"
  js_files="$(grep -oP "hu_enqueue_js\(\s*'[^']+'\s*,\s*'([^']+)'" "$THEME/inc/enqueue.php" | grep -oP "'[^']+'" | tail -1 | tr -d "'" || true)"
  direct_css="$(grep -oP "\\\$css_uri\s*\.\s*'([^']+)'" "$THEME/inc/enqueue.php" | grep -oP "'[^']+'" | tr -d "'" || true)"
  direct_js="$(grep -oP "\\\$js_uri\s*\.\s*'([^']+)'" "$THEME/inc/enqueue.php" | grep -oP "'[^']+'" | tr -d "'" || true)"

  all_assets="$(printf '%s\n%s\n%s\n%s' "$css_files" "$js_files" "$direct_css" "$direct_js" | sort -u | grep -v '^$' || true)"
  asset_ok=true
  while IFS= read -r asset; do
    [[ -z "$asset" ]] && continue
    # Determine directory based on extension
    if [[ "$asset" == *.css ]]; then
      full="$THEME/assets/css/$asset"
    elif [[ "$asset" == *.js ]]; then
      full="$THEME/assets/js/$asset"
    else
      continue
    fi
    if [[ ! -f "$full" ]]; then
      fail "Missing asset: $full"
      asset_ok=false
    fi
  done <<< "$all_assets"
  $asset_ok && pass "All enqueued assets exist"
else
  pass "No enqueue.php found (skipped)"
fi

# --- 5. Unclosed PHP tags ---
header "Template Integrity"

unclosed_ok=true
for tpl in "$THEME"/template-parts/*.php "$THEME"/front-page.php "$THEME"/home.php "$THEME"/single.php "$THEME"/archive.php; do
  [[ -f "$tpl" ]] || continue
  open="$(grep -c '<?php' "$tpl" 2>/dev/null || echo 0)"
  close="$(grep -c '?>' "$tpl" 2>/dev/null || echo 0)"
  # Files that end in PHP mode legitimately have open > close by 1
  if (( open - close > 1 )); then
    fail "Possible unclosed PHP tag in $tpl (open=$open close=$close)"
    unclosed_ok=false
  fi
done
$unclosed_ok && pass "Template PHP tags balanced"

# --- Verdict ---
header "VERDICT"
if (( FAIL )); then
  echo "  ⛔ FIX BEFORE PUSH"
  exit 1
else
  echo "  ✅ SAFE TO PUSH"
  exit 0
fi
