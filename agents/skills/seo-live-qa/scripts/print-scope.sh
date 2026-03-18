#!/usr/bin/env bash

set -euo pipefail

mode="${1:-all}"

print_reindex() {
  cat <<'EOF'
[REINDEX]
- /shopify-wartungsvertrag/
- /wordpress-wartung-hannover/
- /wordpress-agentur-hannover/
- /wordpress-seo-hannover/
- /ga4-tracking-setup/
- /performance-marketing/
EOF
}

print_redirects() {
  cat <<'EOF'
[REDIRECTS]
- /audit/ -> /growth-audit/
- /customer-journey-audit/ -> /growth-audit/
- /360-audit/ -> /growth-audit/
- /wordpress-tech-audit/ -> /growth-audit/
- /case-studies/ -> /ergebnisse/
- /case-studies-e-commerce/ -> /ergebnisse/
- /meta-ads/ -> canonical target
- /wordpress-agentur/ -> canonical target
- /roi-rechner/ -> canonical target
EOF
}

print_mapping() {
  cat <<'EOF'
[PRIMARY URL MAP]
- wordpress agentur hannover -> /wordpress-agentur-hannover/
- wordpress seo hannover -> /wordpress-seo-hannover/
- wordpress wartung hannover -> /wordpress-wartung-hannover/
- ga4 tracking setup / server-side tracking / consent mode -> /ga4-tracking-setup/
- core web vitals optimierung / pagespeed optimierung -> /core-web-vitals/
EOF
}

print_live_qa() {
  cat <<'EOF'
[LIVE QA]
- Check title, description, canonical, og:url on every primary URL.
- Check live DOM for duplicate H1s and duplicate schema output.
- Check homepage, footer, related content, and hubs for legacy internal links.
- Confirm the active sitemap source is consistent with the canonical map.
EOF
}

case "$mode" in
  all)
    print_reindex
    print_redirects
    print_mapping
    print_live_qa
    ;;
  reindex)
    print_reindex
    ;;
  redirects)
    print_redirects
    ;;
  mapping)
    print_mapping
    ;;
  live-qa)
    print_live_qa
    ;;
  *)
    echo "Usage: $0 {all|reindex|redirects|mapping|live-qa}" >&2
    exit 1
    ;;
esac
