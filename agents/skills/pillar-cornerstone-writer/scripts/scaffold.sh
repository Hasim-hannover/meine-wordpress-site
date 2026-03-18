#!/usr/bin/env bash

set -euo pipefail

topic="${1:-Pillar Topic}"
slug_input="${2:-$topic}"

slug="$(
  printf '%s' "$slug_input" \
    | tr '[:upper:]' '[:lower:]' \
    | sed 's/[^a-z0-9]/-/g' \
    | sed 's/-\{2,\}/-/g; s/^-//; s/-$//'
)"

cat <<EOF
SEO title:
Meta description:
URL slug: /${slug}/

# ${topic}

## Why This Matters

## The Strategic Mechanism

## Common Failure Patterns

## A Practical Framework

## Visual Concept

## Next Step

## Suggested Internal Links

- Anchor text ->
- Anchor text ->
- Anchor text ->

## Optional Image Brief

- Alt text:
- Title:
- Caption:
EOF
