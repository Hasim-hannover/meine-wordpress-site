#!/usr/bin/env bash

set -euo pipefail

root_dir="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
source_dir="$root_dir/blocksy-child"
output_dir="${1:-$root_dir/.build/blocksy-child}"

case "$output_dir" in
  /*) ;;
  *) output_dir="$root_dir/$output_dir" ;;
esac

if [ ! -d "$source_dir" ]; then
  echo "Source theme directory not found: $source_dir" >&2
  exit 1
fi

if [ "$output_dir" = "$root_dir" ] || [ "$output_dir" = "$source_dir" ]; then
  echo "Refusing to build into an unsafe output directory: $output_dir" >&2
  exit 1
fi

lightningcss_bin="$root_dir/node_modules/.bin/lightningcss"
terser_bin="$root_dir/node_modules/.bin/terser"

if [ ! -x "$lightningcss_bin" ] || [ ! -x "$terser_bin" ]; then
  echo "Build tooling is missing. Run npm ci first." >&2
  exit 1
fi

mkdir -p "$output_dir"
rsync -a --delete \
  --exclude '.DS_Store' \
  --exclude 'node_modules' \
  --exclude '.env' \
  --exclude '.env.*' \
  "$source_dir/" "$output_dir/"

style_file="$output_dir/style.css"
react_funnels=(
  "energie-fahrplan"
  "readiness"
)

minify_css_file() {
  local file="$1"

  "$lightningcss_bin" --minify "$file" -o "$file"
}

minify_js_file() {
  local file="$1"

  "$terser_bin" "$file" --compress --mangle -o "$file"
}

build_react_funnel() {
  local funnel_name="$1"
  local funnel_dir="$output_dir/$funnel_name"

  if [ ! -f "$funnel_dir/package.json" ]; then
    return
  fi

  if [ ! -f "$funnel_dir/package-lock.json" ]; then
    echo "Missing package-lock.json for React funnel: $funnel_name" >&2
    exit 1
  fi

  echo "Building React funnel: $funnel_name"
  npm --prefix "$funnel_dir" ci --include=dev --ignore-scripts --no-audit --no-fund
  npm --prefix "$funnel_dir" run build
  rm -rf "$funnel_dir/node_modules"
}

for funnel in "${react_funnels[@]}"; do
  build_react_funnel "$funnel"
done

if [ -f "$style_file" ]; then
  style_header="$(awk 'NR == 1 && /^\/\*/ { in_header = 1 } in_header { print; if ($0 ~ /\*\//) exit }' "$style_file")"
  style_header_end_line="$(awk 'NR == 1 && /^\/\*/ { in_header = 1 } in_header && /\*\// { print NR; exit }' "$style_file")"

  if [ -z "$style_header" ] || [ -z "$style_header_end_line" ]; then
    echo "Expected a WordPress theme header at the top of $style_file" >&2
    exit 1
  fi

  style_body_input="$(mktemp)"
  style_body_output="$(mktemp)"
  tail -n +"$((style_header_end_line + 1))" "$style_file" > "$style_body_input"
  "$lightningcss_bin" --minify "$style_body_input" -o "$style_body_output"

  {
    printf '%s\n\n' "$style_header"
    cat "$style_body_output"
  } > "$style_file"

  rm -f "$style_body_input" "$style_body_output"
fi

find "$output_dir" -type f -name '*.css' ! -name '*.min.css' ! -path "$style_file" -print0 | while IFS= read -r -d '' file; do
  minify_css_file "$file"
done

find "$output_dir" -type f -name '*.js' ! -name '*.min.js' -print0 | while IFS= read -r -d '' file; do
  minify_js_file "$file"
done

grep -q '^Theme Name: Blocksy Child$' "$style_file"

echo "Built deployment package at $output_dir"
