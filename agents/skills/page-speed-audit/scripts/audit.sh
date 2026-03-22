#!/usr/bin/env bash

set -euo pipefail

url="${1:-https://hasimuener.de/}"
strategy="${2:-mobile}"

header() { printf '\n=== %s ===\n' "$1"; }

header "PageSpeed Insights — $strategy"
echo "URL: $url"
echo

# Use PSI API (no key needed for basic usage)
api_url="https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=$(python3 -c "import urllib.parse; print(urllib.parse.quote('$url', safe=''))")&strategy=$strategy"

response="$(curl -s "$api_url" 2>/dev/null || echo '{}')"

# Check if we got a valid response
if ! printf '%s' "$response" | python3 -c "import sys,json; json.load(sys.stdin)" 2>/dev/null; then
  echo "Error: Could not reach PageSpeed Insights API."
  echo "Fallback: Run a manual Lighthouse audit or use Chrome DevTools."
  exit 1
fi

# Extract scores and metrics using python3 (available in Codespaces)
python3 - "$response" <<'PYEOF'
import json, sys

data = json.loads(sys.argv[1]) if len(sys.argv) > 1 else json.load(sys.stdin)

lhr = data.get("lighthouseResult", {})
cats = lhr.get("categories", {})
audits = lhr.get("audits", {})

# Overall score
perf = cats.get("performance", {}).get("score")
if perf is not None:
    print(f"Performance Score: {int(perf * 100)}/100")
else:
    print("Performance Score: N/A")

print()

# Core Web Vitals
metrics = {
    "LCP": "largest-contentful-paint",
    "CLS": "cumulative-layout-shift",
    "INP": "interaction-to-next-paint",
    "FCP": "first-contentful-paint",
    "TBT": "total-blocking-time",
    "Speed Index": "speed-index",
}

print("=== Core Web Vitals ===")
for label, key in metrics.items():
    audit = audits.get(key, {})
    val = audit.get("displayValue", "N/A")
    score = audit.get("score")
    icon = "✓" if score and score >= 0.9 else "△" if score and score >= 0.5 else "✗"
    print(f"  {icon} {label}: {val}")

print()

# Opportunities
print("=== Opportunities ===")
opps = [
    "render-blocking-resources",
    "unused-css-rules",
    "unused-javascript",
    "offscreen-images",
    "uses-optimized-images",
    "uses-responsive-images",
    "uses-text-compression",
    "efficient-animated-content",
    "unminified-css",
    "unminified-javascript",
]

found = False
for key in opps:
    audit = audits.get(key, {})
    savings = audit.get("details", {}).get("overallSavingsMs")
    if savings and savings > 0:
        found = True
        print(f"  - {audit.get('title', key)}: ~{int(savings)}ms potential savings")

if not found:
    print("  No major opportunities detected.")

print()
print("=== Next Steps ===")
print("  1. Fix items marked ✗ first (biggest impact)")
print("  2. Then △ items")
print("  3. Run this script again after fixes to verify")
PYEOF
