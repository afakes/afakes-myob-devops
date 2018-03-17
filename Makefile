# Adam Fakes - 1
# Comments


DEPLOY_USER_HOST=adamfake@adamfakes.com
DEPLOY_HANDLER_FOLDER=/home3/adamfake/public_html/deploy

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

deploy-handler-upload:
	scp deploy_handler/deploy.php  $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy.php

deploy-handler-logs:
	ssh $(DEPLOY_USER_HOST) "cat $(DEPLOY_HANDLER_FOLDER)/deploy.log"

deploy-handler-clean:
	ssh $(DEPLOY_USER_HOST) "rm $(DEPLOY_HANDLER_FOLDER)/*; touch $(DEPLOY_HANDLER_FOLDER)/deploy.log"

.PHONY: help

