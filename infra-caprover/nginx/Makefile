# Variables
TEMP_DIR := /tmp/caprover-deploy-nginx
TAR_FILE := $(TEMP_DIR)/deploy.tar
DOCKERFILE := ./Dockerfile
NGINX_CONF := ./default.conf
CAPTAIN_DEFINITION := ./captain-definition

APP_NAME := b-peinture-nginx
CAPROVER_SERVER := https://captain.c4dev.site

.PHONY: deploy
deploy: validate-path prepare-output prepare-tar deploy-caprover cleanup

.PHONY: validate-path
validate-path:
	@if [ ! -f "$(DOCKERFILE)" ]; then \
		echo "Erreur : Le Dockerfile est introuvable."; \
		exit 1; \
	fi
	@if [ ! -f "$(NGINX_CONF)" ]; then \
		echo "Erreur : La configuration Nginx est introuvable."; \
		exit 1; \
	fi
	@if [ ! -f "$(CAPTAIN_DEFINITION)" ]; then \
		echo "Erreur : Le fichier captain-definition est introuvable."; \
		exit 1; \
	fi

.PHONY: prepare-output
prepare-output:
	@echo "Préparation des fichiers..."
	mkdir -p $(TEMP_DIR)
	cp $(DOCKERFILE) $(TEMP_DIR)/
	cp $(NGINX_CONF) $(TEMP_DIR)/
	cp $(CAPTAIN_DEFINITION) $(TEMP_DIR)/
	@ls -la $(TEMP_DIR)

.PHONY: prepare-tar
prepare-tar:
	tar -cvf $(TAR_FILE) -C $(TEMP_DIR) .

.PHONY: deploy-caprover
deploy-caprover:
	caprover deploy --appName $(APP_NAME) --tarFile $(TAR_FILE) --caproverUrl $(CAPROVER_SERVER)

.PHONY: cleanup
cleanup:
	rm -rf $(TEMP_DIR)