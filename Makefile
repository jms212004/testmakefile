.PHONY: help phpstan test coverage phpcs allcheck

.DEFAULT_GOAL := help

PHP_VERSION = $(shell php -v | grep -oP '(?<=PHP ).*(?=\s+)' | cut -d'.' -f1-2)

help:	## Show this help (default).
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

test: ## Execute phpunit
	vendor/bin/phpunit tests/

phpcpd: ## Execute phpcpd Copy/Paste Detector (CPD) for PHP code
	vendor/bin/phpcpd src tests

phpstan: ## Execute phpstan on  src and tests directorys
	vendor/bin/phpstan analyse src tests

phpcs: ## Execute PhpCS with PSR12 standard on src directory
	clear
	vendor/bin/phpcs --standard=PSR12 src tests

compatibility: ## Execute PhpCS compatibility php version 8.2
	vendor/bin/phpcs -p src --ignore=vendor/* --standard=PHPCompatibility --runtime-set testVersion $(PHP_VERSION) --extensions=php

fixpsr12: ## Fix style for PSR12 standard on src directory
	vendor/bin/phpcbf --standard=PSR12 src tests

allcheck: phpcpd phpcs phpstan test compatibility ## Perform all check: phpcpd, phpcs, phpstan and test
