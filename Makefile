##
## Utilitaires
## ==================================================
##

install: ## Installe la base du projet (composer et yarn)
install: vendor

git-pre-push:  ## Execute les commandes nécessaires avant un push sur GIT
git-pre-push:
	make security
	make php_cs
	make twig_cs

.PHONY: install git-pre-push

##
## Gestion des dépendances du projet
## ==================================================
##

composer.lock: composer.json
	composer update --lock --no-scripts --no-interaction

vendor: ## Installe les vendors
vendor: composer.json
	composer install

##
## Gestion de la qualité
## ==================================================
##
security: ## Vérifie la sécurité des dépendances (https://security.sensiolabs.org/)
security: vendor
	./vendor/bin/security-checker security:check

php_cs: ## Applique les règles PHP CS Fixer au projet
php_cs: vendor
	./vendor/bin/php-cs-fixer fix --verbose

php_cs_dry_run: ## Lance un contrôle sur le respect des règles du projet
php_cs_dry_run: vendor
	./vendor/bin/php-cs-fixer fix --verbose --dry-run

twig_cs: ## Lance les contrôles qualité sur les templates TWIG
twig_cs: vendor
	./vendor/bin/twigcs lint src/Resources/views

.PHONY: security php_cs php_cs_dry_run twig_cs


.DEFAULT_GOAL := help
help:
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
.PHONY: help
