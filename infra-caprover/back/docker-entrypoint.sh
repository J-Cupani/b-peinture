#!/bin/sh

echo "Entrée dans le fichier docker-entrypoint.sh"

set -e

# Charger les variables depuis le fichier .env si elles ne sont pas déjà définies
if [ -f /var/www/symfony/.env ]; then
    export $(grep -v '^#' /var/www/symfony/.env | xargs)
fi

echo "Exécution de composer install..."

# Vérifiez si Composer est disponible
if command -v composer >/dev/null 2>&1; then
    composer install --no-dev --optimize-autoloader --no-interaction
else
    echo "Composer introuvable, vérifiez son installation." >&2
    exit 1
fi

# Ajuster les permissions pour Symfony
echo "Ajustement des permissions pour Symfony..."
chown -R www-data:www-data /var/www/symfony
chmod -R 755 /var/www/symfony

# Permissions spécifiques pour les répertoires de cache et logs
chmod -R 775 /var/www/symfony/var/cache /var/www/symfony/var/log
chown -R www-data:www-data /var/www/symfony/var/cache /var/www/symfony/var/log

# Permissions spécifiques pour les répertoires public/media et public/uploads
if [ -d /var/www/symfony/public/media ]; then
    echo "Ajustement des permissions pour public/media..."
    chmod -R 775 /var/www/symfony/public/media
    chown -R www-data:www-data /var/www/symfony/public/media
fi

if [ -d /var/www/symfony/public/uploads ]; then
    echo "Ajustement des permissions pour public/uploads..."
    chmod -R 775 /var/www/symfony/public/uploads
    chown -R www-data:www-data /var/www/symfony/public/uploads
fi

# Lancer PHP-FPM
echo "Démarrage de PHP-FPM..."
exec "$(command -v php-fpm)"