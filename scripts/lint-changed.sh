#!/usr/bin/env bash
set -euo pipefail

mode="${1:-branch}"

if [[ "${mode}" == "staged" ]]; then
    diff_command=(git diff --cached --name-only --diff-filter=ACMR -- '*.php')
else
    diff_command=(git diff --name-only --diff-filter=ACMR origin/main...HEAD -- '*.php')
fi

changed_php_files=()
while IFS= read -r changed_file; do
    if [[ -n "${changed_file}" ]]; then
        changed_php_files+=("${changed_file}")
    fi
done < <("${diff_command[@]}")

if [[ ${#changed_php_files[@]} -eq 0 ]]; then
    echo "No changed PHP files found for Pint check."
    exit 0
fi

php vendor/bin/pint --test "${changed_php_files[@]}"
