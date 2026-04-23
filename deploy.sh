#!/bin/bash
set -e

echo "🚀 Déploiement ServicePublic BF..."

# 1. Pull du code
git pull origin main

# 2. Dépendances PHP (sans dev)
composer install --no-dev --optimize-autoloader

# 3. Migrations
php artisan migrate --force

# 4. Cache applicatif
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 5. Storage link
php artisan storage:link 2>/dev/null || true

# 6. Redémarrer les workers de queue
php artisan queue:restart 2>/dev/null || true

# 7. Redémarrer PHP-FPM (ajustez la version si nécessaire)
if command -v systemctl &> /dev/null; then
    sudo systemctl reload php8.2-fpm 2>/dev/null || echo "⚠️  PHP-FPM reload skipped (not found or no permission)"
fi

echo "✅ Déploiement terminé !"
