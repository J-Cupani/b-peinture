# Docker
start-build:
	docker-compose up --build

start-build-d:
	docker-compose up --build -d

start-d:
	docker-compose up -d

start:
	docker-compose up

stop:
	docker-compose stop

# Accéder au conteneur PHP
php:
	docker exec -it php sh

# Accéder au conteneur MySQL (ou MariaDB)
db:
	docker exec -it mariadb sh

# Accéder au conteneur Nginx
nginx:
	docker exec -it nginx sh

# Accéder au conteneur Nuxt
nuxt:
	docker exec -it nuxt sh

# Exécuter Composer install dans le conteneur PHP
composer-install:
	docker exec -it php composer install

# Exécuter Composer update dans le conteneur PHP
composer-update:
	docker exec -it php composer update

# Exécuter yarn install dans le conteneur Nuxt
yarn-install:
	docker exec -it nuxt npm install

yarn-build:
	docker exec -it nuxt yarn build

# Nettoyer le cache de Symfony dans le conteneur PHP
clear-cache:
	docker exec -it php php bin/console cache:clear --env=prod

# Migrer la base de données avec Symfony (Doctrine)
migrate-db:
	docker exec -it php php bin/console doctrine:migrations:migrate --no-interaction

# Créer la base de données avec Symfony
create-db:
	docker exec -it php php bin/console doctrine:database:create --if-not-exists