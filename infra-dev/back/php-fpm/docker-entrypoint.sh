#!/bin/sh
set -e

# Vérifier si le fichier .env existe
if [ -f .env ]; then
    # Utiliser le fichier .env pour générer les variables d'environnement
    php /usr/local/bin/composer dump-env dev
else
    echo "Le fichier .env est introuvable. Assurez-vous qu'il existe."
    exit 1
fi

# Ensuite démarrer PHP-FPM ou toute commande passée
exec "$@"