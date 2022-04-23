#!/bin/sh
set -e

echo "Deploying application ..."

# Enter maintenance mode
(php artisan down) || true
    # Install dependencies based on lock file
    composer install --no-interaction --prefer-dist --optimize-autoloader

    # Note: If you're using queue workers, this is the place to restart them.
    # ...

    php artisan clear-compiled
    composer dumpautoload -o
    # Clear cache
    php artisan optimize
    # Migrate database
    php artisan migrate --force


    # Reload PHP to update opcache
    echo "" | service php8.0-fpm reload
# Exit maintenance mode
php artisan up

yarn install
yarn run production

# php artisan enlightn --ci --report

echo "Application deployed!"
