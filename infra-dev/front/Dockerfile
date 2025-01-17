# Utiliser l'image node basée sur Alpine
FROM node:lts-alpine

## Installer les dépendances nécessaires pour musl
RUN apk add --no-cache libc6-compat bash

# Définir l'environnement de développement
ENV NODE_ENV=development

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html/nuxt

# Copier les fichiers package.json et yarn.lock uniquement
COPY front/package.json front/package-lock.json ./

# Copier le reste des fichiers du projet
COPY front/ ./

# Installer les dépendances
RUN npm install --legacy-peer-deps --verbose

# Exécuter les scripts postinstall
RUN npm run postinstall

ENV HOST 0.0.0.0
EXPOSE 3000

# Démarrer Nuxt.js en mode développement
CMD ["npm", "run", "dev"]