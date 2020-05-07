#!/usr/bin/env bash

# exit when any command fails
set -euo pipefail

# Install tools
composer install

# Clean up code style
vendor/bin/php-cs-fixer fix
