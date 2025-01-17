# Utiliser l'image officielle Nginx basée sur Alpine
FROM nginx:alpine

LABEL maintainer="C4DEV <contact@c4dev.fr>"

# Copier les fichiers de configuration Nginx
COPY nginx.conf /etc/nginx/nginx.conf
COPY config.conf /etc/nginx/conf.d/

# Exposer les ports HTTP et HTTPS
EXPOSE 80
EXPOSE 443

# Commande pour démarrer Nginx en mode de premier plan
CMD ["nginx", "-g", "daemon off;"]