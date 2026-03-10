#!/bin/sh
set -e

cd /var/www/html

# Create storage link if not exists
php artisan storage:link 2>/dev/null || true

# Cache config, routes, views for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run migrations (safe for production with --force)
php artisan migrate --force 2>/dev/null || true

# Set permissions
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "==> Application ready!"

exec "$@"
