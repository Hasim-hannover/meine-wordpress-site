#!/usr/bin/env bash

set -euo pipefail

pattern='cta_github_repo|cta_proof_linkedin|cta_pilot_contact|cta_erfolge_audit|cta_footer_audit'

echo "[TRACK HOOKS IN REPO]"
rg -n "$pattern" blocksy-child || true
echo
echo "[RELEASE WINDOW]"
echo "- Launch marker: 2026-03-11"
echo "- Compare: 14 days pre-launch vs 14 days post-launch vs 28 days post-launch"
echo
echo "[GA4 / GTM]"
echo "- Mark the release in GA4 or the internal change log."
echo "- Confirm data-track-action values are mapped into GTM events or click parameters."
echo "- If not mapped, add a click trigger on [data-track-action] and expose the homepage proof actions."
echo
echo "[WEEKLY REVIEW]"
echo "- Homepage sessions and engagement rate"
echo "- Clicks on GitHub, LinkedIn, pilot, and audit CTA hooks"
echo "- Contact requests with focus=pilot"
echo "- Lead quality notes: Money-page problem, budget fit, implementation readiness"
echo "- Whether the proof block is mentioned in calls or emails"
echo
echo "[REVIEW LOG]"
cat <<'EOF'
| Woche | Homepage Sessions | GitHub Klicks | Pilot Klicks | Pilot Anfragen | Audit Anfragen | Notizen |
| --- | --- | --- | --- | --- | --- | --- |
| KW 11 |  |  |  |  |  |  |
| KW 12 |  |  |  |  |  |  |
| KW 13 |  |  |  |  |  |  |
| KW 14 |  |  |  |  |  |  |
EOF
