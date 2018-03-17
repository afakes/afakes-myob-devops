
help:
	@echo "usage:"
	@echo "   make configure"
	@echo "   make clean"
	@echo "   make test"
	@echo "   make deploy"

clean:
	@rm phpunit-7.phar

configure:
	@wget -O phpunit https://phar.phpunit.de/phpunit-7.phar
	@chmod +x phpunit
	@./phpunit --version

test:
	echo "Test the endpoints"

deploy:
	echo "deploy the endpoints"


.PHONY: help
