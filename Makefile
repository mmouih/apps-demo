all: validate cs review
cs:
	./vendor/bin/phpcs src
csf:
	./vendor/bin/phpcbf src
review:
	./vendor/bin/phpstan analyse src
build:
	composer install
validate:
	composer validate
sf_update:
	composer update symfony/*
generate:
	./vendor/bin/phpgen generate $(dto) $(file)  -f