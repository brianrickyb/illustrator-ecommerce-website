#!/bin/sh
set -e

php artisan config:clear
php artisan storage:link || true

if [ -z "$APP_KEY" ]; then
  php artisan key:generate --force
fi

if [ -n "$DB_HOST" ]; then
  php artisan migrate --force
fi
# One-time only: run `php artisan db:seed --force` manually after the first deploy
# to populate demo admin/user accounts and sample products.

php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
