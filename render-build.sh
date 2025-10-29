#!/usr/bin/env bash
# Script para preparar el entorno de Laravel en Render

set -e

echo "🚀 Instalando dependencias del sistema..."
apt-get update && apt-get install -y libpq-dev

echo "📦 Instalando extensiones PHP necesarias..."
docker-php-ext-install pdo pdo_pgsql

echo "🎶 Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

echo "⚙️ Optimizando la aplicación..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completado correctamente."