#!/bin/sh

set -e

if [ ! -d "/var/www/html/vendor" ]; then
	echo "Installing PHP dependencies..."
	composer install --optimize-autoloader
fi

echo "Preparing Smarty directories..."

mkdir -p /var/www/html/storage/smarty/compile
mkdir -p /var/www/html/storage/smarty/cache
mkdir -p /var/www/html/public/assets/css

chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/storage

echo "Building css assets..."

php /var/www/html/scripts/build-assets.php

chmod +x /var/www/html/scripts/watch-scss.sh

echo "Starting scss watcher..."

/var/www/html/scripts/watch-scss.sh &

echo "Waiting for database..."

until mysql --skip-ssl -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" -e "SELECT 1" >/dev/null 2>&1; do
	echo "Waiting for MySQL..."
	sleep 2
done

echo "Database is ready."

COUNT=$(mysql -h"$DB_HOST" -u"$DB_USER" -p"$DB_PASS" "$DB_NAME" -se \
	"SELECT COUNT(*) FROM categories;" 2>/dev/null || echo 0)

if [ "$COUNT" -eq 0 ]; then
	echo "No data found —  seeding database..."
	php /var/www/html/scripts/seed-database.php
else
	echo "Database already seeded - skipping..."
fi

echo "Starting Apache..."

exec apache2-foreground
