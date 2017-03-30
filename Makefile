.PHONY: \
	default \
	run-tests

default: run-tests

composer.lock: | composer.json
	composer update

vendor: composer.lock
	composer install
	touch "$@"

run-tests: vendor
	vendor/bin/phpunit --bootstrap vendor/autoload.php test
