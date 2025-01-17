# Commande pour déployer le front
.PHONY: deploy-nuxt
deploy-nuxt:
	@echo "Déploiement du front Nuxt..."
	@$(MAKE) -f./infra-caprover/front deploy

# Commande pour déployer le backend
.PHONY: deploy-back
deploy-php:
	@echo "Déploiement du backend Symfony..."
	$(MAKE) -C ./infra-caprover/back deploy