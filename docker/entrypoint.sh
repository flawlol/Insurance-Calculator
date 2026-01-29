#!/bin/bash
set -e

if [ ! -d "vendor" ]; then
    echo "No vendor. Cpmposer install..."
    composer install --no-interaction --optimize-autoloader
else
    echo "Vendor exists. Skipping composer install."
fi

# if .php-cs-fixer.dist.php not exists copy from php-cs-fixer.php
if [ ! -f ".php-cs-fixer.dist.php" ]; then
    echo ".php-cs-fixer.dist.php not found. Copying from php-cs-fixer.php..."
    cp php-cs-fixer.php .php-cs-fixer.dist.php
else
    echo ".php-cs-fixer.dist.php exists. Skipping copy."
fi

exec "$@"