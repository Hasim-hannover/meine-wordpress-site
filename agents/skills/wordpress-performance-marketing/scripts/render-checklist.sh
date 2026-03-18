#!/usr/bin/env bash

set -euo pipefail

mode="${1:-full}"

print_seo() {
  cat <<'EOF'
[SEO]
- Confirm one H1 and coherent heading order.
- Check title, description, canonical, robots, and schema ownership.
- Verify canonical internal links point to primary URLs only.
- Review Core Web Vitals risks: hero media, blocking CSS/JS, layout shifts.
EOF
}

print_cro() {
  cat <<'EOF'
[CRO]
- Confirm one primary CTA per viewport cluster.
- Verify audit-first funnel alignment and risk-reversal copy.
- Remove CTA drift, proof fragmentation, and unnecessary choice points.
- Check mobile scannability and section order.
EOF
}

print_content() {
  cat <<'EOF'
[CONTENT]
- Match the page to one intent and one offer stage.
- Replace vague agency wording with concrete business outcomes.
- Link to one service page and related proof or cluster assets.
- Keep terminology stable across hero, proof, and CTA blocks.
EOF
}

print_tracking() {
  cat <<'EOF'
[TRACKING]
- Preserve or add data-track attributes on core CTA surfaces.
- Confirm repo-owned event hooks versus external GTM/GA4 setup.
- Call out missing consent, routing, or CRM assumptions explicitly.
- Keep measurement notes separate from runtime code changes.
EOF
}

case "$mode" in
  full)
    print_seo
    print_cro
    print_content
    print_tracking
    ;;
  seo)
    print_seo
    ;;
  cro)
    print_cro
    ;;
  content)
    print_content
    ;;
  tracking)
    print_tracking
    ;;
  *)
    echo "Usage: $0 {full|seo|cro|content|tracking}" >&2
    exit 1
    ;;
esac
