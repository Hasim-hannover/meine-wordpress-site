#!/usr/bin/env bash

set -euo pipefail

ssh_port="${1:-${SSH_PORT:-22}}"
deploy_path="${2:-${DEPLOY_PATH:-}}"

if ! [[ "$ssh_port" =~ ^[0-9]+$ ]] || [ "$ssh_port" -lt 1 ] || [ "$ssh_port" -gt 65535 ]; then
  echo "Invalid SSH_PORT value: $ssh_port" >&2
  exit 1
fi

if [ -z "$deploy_path" ]; then
  echo "DEPLOY_PATH must not be empty." >&2
  exit 1
fi

normalized_path="${deploy_path%/}"

case "$normalized_path" in
  ""|"/"|"."|"./"|"~"|"www"|"public_html"|"wp-content"|"wp-content/themes")
    echo "Refusing an overly broad DEPLOY_PATH: $deploy_path" >&2
    exit 1
    ;;
esac

if [ "$normalized_path" = "blocksy-child" ] || [ "${normalized_path##*/}" != "blocksy-child" ]; then
  echo "DEPLOY_PATH must resolve to the child theme directory and end with /blocksy-child/." >&2
  exit 1
fi

echo "Validated deploy config: SSH_PORT=$ssh_port, DEPLOY_PATH=$deploy_path"
