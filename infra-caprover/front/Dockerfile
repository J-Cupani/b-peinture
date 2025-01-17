# Utiliser une image Node.js basée sur Alpine
FROM node:lts

# Définir l'environnement de production
ENV NODE_ENV=production

# Définir le répertoire de travail dans le conteneur
WORKDIR /app

# Copier uniquement les fichiers de l'application depuis le dossier .output
COPY . .

# Exposer le port sur lequel Nuxt.js va tourner
ENV HOST=0.0.0.0
EXPOSE 3000

# Lancer Nuxt.js en mode SSR
CMD ["node", "server/index.mjs"]