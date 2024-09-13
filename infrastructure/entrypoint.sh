#!/bin/sh
set -e

nginx -g 'daemon on;'
php-fpm

running_migrations=${RUNNING_MIGRATIONS:-"true"}

composer install --no-interaction --no-ansi --no-scripts --classmap-authoritative

php artisan storage:link; \
php artisan optimize; \
php artisan queue:work

if [ ${running_migrations} = "true" ]; then
    echo "Running migrations ..."
    php artisan migrate --isolated --force; \
fi
