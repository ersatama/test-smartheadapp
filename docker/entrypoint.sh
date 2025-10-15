#!/bin/sh
set -e

echo "🚀 Starting Laravel container..."

# Ждем пока MySQL поднимется
echo "⏳ Waiting for MySQL to be ready..."
until php -r "try { new PDO('mysql:host=mysql;port=3306', 'smartuser', 'smartpass'); exit(0); } catch (Exception \$e) { exit(1); }"; do
  echo "MySQL not ready yet, retrying in 3 seconds..."
  sleep 3
done
echo "✅ MySQL is ready!"

# Копируем .env если нет
if [ ! -f .env ]; then
  echo "📄 Copying .env.example to .env"
  cp .env.example .env
fi

# Генерация ключа приложения
php artisan key:generate --force

# Миграции и сиды
php artisan migrate:fresh --seed --force

# Права
chown -R www-data:www-data storage bootstrap/cache

echo "✅ Laravel initialized successfully!"

# Запуск PHP-FPM
exec php-fpm
