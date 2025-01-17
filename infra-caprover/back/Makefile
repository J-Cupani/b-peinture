# Variables
TEMP_DIR := /tmp/caprover-deploy-back
TAR_FILE := $(TEMP_DIR)/deploy.tar

DOCKERFILE := ./Dockerfile
CAPTAIN_DEFINITION := ./captain-definition
SYMFONY_INI := ./symfony.ini
SYMFONY_POOL := ./symfony.pool.conf
DOCKER_ENTREPOINT := ./docker-entrypoint.sh
BACK_DIR := ../../back
ENV := ./.env
APP_OUTPUT := $(TEMP_DIR)

APP_NAME := c4dev-php
CAPROVER_SERVER := https://captain.c4dev.site

# Commande par défaut
.PHONY: deploy
deploy: debug validate-path prepare-output prepare-tar deploy-caprover cleanup

# Étape 0 : Déboguer et vérifier les chemins
.PHONY: debug
debug:
	@echo "Vérification des chemins..."
	@echo "Contenu de $(BACK_DIR):"
	@ls -la $(BACK_DIR)
	@echo "Fichiers de configuration :"
	@ls -la $(DOCKERFILE) $(CAPTAIN_DEFINITION) $(SYMFONY_INI) $(SYMFONY_POOL)

# Étape 1 : Valider que le dossier backend existe
.PHONY: validate-path
validate-path:
	@if [ ! -d "$(BACK_DIR)" ]; then \
		echo "Erreur : Le dossier $(BACK_DIR) est introuvable."; \
		exit 1; \
	fi

# Étape 2 : Préparer le dossier temporaire avec les fichiers nécessaires
.PHONY: prepare-output
prepare-output:
	@echo "Préparation des fichiers pour le backend Symfony..."
	mkdir -p $(TEMP_DIR)
	cp -R $(BACK_DIR)/bin $(TEMP_DIR)/
	cp -R $(BACK_DIR)/config $(TEMP_DIR)/
	cp -R $(BACK_DIR)/migrations $(TEMP_DIR)/
	cp -R $(BACK_DIR)/src $(TEMP_DIR)/
	cp -R $(BACK_DIR)/templates $(TEMP_DIR)/
	@mkdir -p $(TEMP_DIR)/public
	@mkdir -p $(TEMP_DIR)/public/media
	@mkdir -p $(TEMP_DIR)/public/uploads
	@cp $(BACK_DIR)/public/index.php $(TEMP_DIR)/public/
	@cp $(BACK_DIR)/public/.htaccess $(TEMP_DIR)/public/
	cp $(BACK_DIR)/composer.json $(TEMP_DIR)/
	cp $(BACK_DIR)/composer.lock $(TEMP_DIR)/
	cp $(BACK_DIR)/symfony.lock $(TEMP_DIR)/
	mkdir -p $(TEMP_DIR)/var
	cp ./docker-entrypoint.sh $(TEMP_DIR)/
	cp $(DOCKERFILE) $(TEMP_DIR)/
	cp $(CAPTAIN_DEFINITION) $(TEMP_DIR)/
	cp $(SYMFONY_INI) $(TEMP_DIR)/
	cp $(SYMFONY_POOL) $(TEMP_DIR)/
	cp $(ENV) $(TEMP_DIR)/
	@ls -la $(TEMP_DIR)

	@echo "Copie terminée !"

# Étape 3 : Créer une archive tar
.PHONY: prepare-tar
prepare-tar:
	@echo "Création de l'archive $(TAR_FILE)..."
	tar -cvf $(TAR_FILE) -C $(TEMP_DIR) .

# Étape 4 : Déployer avec CapRover
.PHONY: deploy-caprover
deploy-caprover:
	@echo "Déploiement sur CapRover pour l'application $(APP_NAME)..."
	@if ! command -v caprover &> /dev/null; then \
		echo "Erreur : La commande 'caprover' est introuvable. Installez-la avant de continuer."; \
		exit 1; \
	fi
	caprover deploy \
		--appName $(APP_NAME) \
		--tarFile $(TAR_FILE) \
		--caproverUrl $(CAPROVER_SERVER)

# Étape 5 : Nettoyer le dossier temporaire
.PHONY: cleanup
cleanup:
	@echo "Nettoyage du dossier temporaire $(TEMP_DIR)..."
	rm -rf $(TEMP_DIR)
	@echo "Nettoyage terminé."

# Nettoyer manuellement si nécessaire
.PHONY: clean
clean:
	rm -rf $(TEMP_DIR) $(TAR_FILE)
	@echo "Dossier temporaire et archive supprimés."