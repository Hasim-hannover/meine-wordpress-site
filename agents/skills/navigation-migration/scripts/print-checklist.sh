#!/usr/bin/env bash

set -euo pipefail

cat <<'EOF'
Main menu target:
- /wordpress-growth-operating-system/
- /ergebnisse/
- /blog/
- /uber-mich/
- /growth-audit/ [class=nav-cta-button]

Homepage editor target order:
1. Hero
2. Schmerz-Sektion
3. WGOS-System-Sektion
4. Track Record / Cases
5. Selektionskarte
6. Audit-CTA
7. FAQ
8. Blog

Post-deploy QA:
- Check header menu on desktop and mobile.
- Remove duplicated audit buttons or legacy booking links.
- Re-check homepage, WGOS, and Growth Audit uncached.
- Verify footer and utility links still follow the CTA hierarchy.
EOF
