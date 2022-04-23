#!/bin/sh
set -e

echo "Deploying application ..."

npm ci
npm run production

# Enter maintenance mode
(php artisan down --message 'The app is being (quickly!) updated. Please try again in a minute.') || true
    # Update codebase
    git fetch origin main
    git reset --hard origin/main

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
    echo "" | sudo -S service php8.0-fpm reload
# Exit maintenance mode
php artisan up

php artisan enlightn --ci --report

echo "Application deployed!"
