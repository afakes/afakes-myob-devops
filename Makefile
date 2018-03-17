
help:
	@echo "usage:"
	@echo "   make configure"
	@echo "   make clean"
	@echo "   make test"
	@echo "   make push"

clean:
	@rm -f phpunit 2>/dev/null

get-phpuinit:
	@echo "Download PHPUnit"
	@curl -o phpunit -L "https://phar.phpunit.de/phpunit-7.phar" 2> /dev/null
	@chmod +x phpunit
	@echo "Verify PHPUnit"
	@./phpunit --version

configure: get-phpuinit

test:
	echo "Test the endpoints"



push:
	echo "push to master"
	@git push origin master


.PHONY: help
