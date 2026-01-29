.PHONY: all fix stan test

all: fix stan test

fix:
	@echo "CSFIX"
	@vendor/bin/php-cs-fixer fix --verbose

stan:
	@echo "PHPSTAN"
	@vendor/bin/phpstan analyse src run.php --level=9

test:
	@echo "PHPUNIT"
	@vendor/bin/phpunit