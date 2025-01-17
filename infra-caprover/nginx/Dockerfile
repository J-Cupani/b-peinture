# Utiliser l'image officielle Nginx comme base
FROM nginx:alpine

LABEL maintainer="C4DEV <contact@c4dev.fr>"

# Copier la configuration Nginx dans l'image
COPY default.conf /etc/nginx/conf.d/default.conf

# Créer les répertoires nécessaires
RUN mkdir -p /var/www/symfony/public/uploads && \
    chown -R nginx:nginx /var/www/symfony/public/uploads && \
    chmod -R 755 /var/www/symfony/public/uploads

# Exposer le port HTTP
EXPOSE 80

# Commande par défaut
CMD ["nginx", "-g", "daemon off;"]