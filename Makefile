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

tests:
	echo "Test code and endpoints"
	./phpunit --testdox

push:
	@echo "push to master"
	@git push origin master

deploy-handler-upload-key-config:
	@echo "deploy handler: key config"
	@echo "#GITHUB-DEPLOY" > deploy-ssh-config.txt
	@echo "Host github.com" >> deploy-ssh-config.txt
	@echo "  User git" >> deploy-ssh-config.txt
	@echo "  Hostname github.com" >> deploy-ssh-config.txt
	@echo "  IdentityFile $(DEPLOY_HANDLER_FOLDER)/deploy.rsa" >>deploy-ssh-config.txt

# we should NEVER load the keys inside the WWW folder, but just for ease at the moment
deploy-handler-upload-key: deploy-handler-upload-key-config
	@echo "deploy handler: upload keys"
	@scp keys/deploy $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy.rsa
	@echo "deploy handler: upload ssh config"
	@scp deploy-ssh-config.txt $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy-ssh-config.txt
	@echo "deploy handler: configure deploy ssh"
	@ssh $(DEPLOY_USER_HOST) "cat $(DEPLOY_HANDLER_FOLDER)/deploy-ssh-config.txt >> ~/.ssh/config "

deploy-handler-upload-code:
	@echo "deploy handler: upload code"
	@scp deploy_handler/deploy.php  $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy.php

deploy-handler-logs:
	@echo "deploy handler: view log"
	@ssh $(DEPLOY_USER_HOST) "cat $(DEPLOY_HANDLER_FOLDER)/deploy.log"

deploy-handler-clean:
	@echo "deploy handler: clean"
	@ssh $(DEPLOY_USER_HOST) "rm $(DEPLOY_HANDLER_FOLDER)/*; touch $(DEPLOY_HANDLER_FOLDER)/deploy.log; chmod o+w $(DEPLOY_HANDLER_FOLDER)/deploy.log"

deploy-handler-all: deploy-handler-clean deploy-handler-upload-key deploy-handler-upload-code

.PHONY: help

