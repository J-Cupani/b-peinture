# Variables
TEMP_DIR := /tmp/caprover-deploy-front
TAR_FILE := $(TEMP_DIR)/deploy.tar

DOCKERFILE := ./Dockerfile
CAPTAIN_DEFINITION := ./captain-definition

FRONT_DIR := ../../front
OUTPUT_DIR := $(FRONT_DIR)/.output

APP_NAME := c4dev-nuxt
CAPROVER_SERVER := https://captain.c4dev.site

# Commandes par défaut
.PHONY: deploy
deploy: build prepare-output prepare-tar deploy-caprover cleanup

# Étape 1 : Construire le projet Nuxt
.PHONY: build
build:
	@echo "Construction du projet Nuxt..."
	@if [ ! -d "$(FRONT_DIR)" ]; then \
		echo "Erreur : Le dossier $(FRONT_DIR) est introuvable."; \
		exit 1; \
	fi
	cd $(FRONT_DIR) && npm install && npm run build

# Étape 2 : Ajouter Dockerfile et captain-definition à .output
.PHONY: prepare-output
prepare-output:
	@echo "Ajout du Dockerfile et du captain-definition dans $(OUTPUT_DIR)..."
	@if [ ! -d "$(OUTPUT_DIR)" ]; then \
		echo "Erreur : Le dossier $(OUTPUT_DIR) est introuvable. Assurez-vous que la construction du projet a été effectuée."; \
		exit 1; \
	fi
	cp $(DOCKERFILE) $(OUTPUT_DIR)/
	cp $(CAPTAIN_DEFINITION) $(OUTPUT_DIR)/

# Étape 3 : Préparer le dossier temporaire et créer l'archive tar
.PHONY: prepare-tar
prepare-tar:
	@echo "Création du dossier temporaire $(TEMP_DIR)..."
	mkdir -p $(TEMP_DIR)
	@echo "Copie des fichiers nécessaires depuis $(OUTPUT_DIR) vers $(TEMP_DIR)..."
	cp -R $(OUTPUT_DIR)/* $(TEMP_DIR)/
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

# Commande pour tout nettoyer manuellement si nécessaire
.PHONY: clean
clean:
	rm -rf $(TEMP_DIR) $(TAR_FILE)
	@echo "Dossier temporaire et archive supprimés."