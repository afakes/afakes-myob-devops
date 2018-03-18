
DEPLOY_USER_HOST=adamfake@adamfakes.com
WEB_ROOT=/home3/adamfake/public_html/staging
DEPLOY_HANDLER_FOLDER=$(WEB_ROOT)/deploy
DEST=afakes-myob-devops
SSH_KEY=-i keys/deploy

VERSION=$(shell cat api/version.txt)

# @make help : what does this Makefile do?
help:
	@echo "usage:"
	@grep "^# @make " Makefile | tr "#" "\n" | sed 's/ @/ /g' | sed 's/:/~ ..../g' | tr "~" "\n" | sed
	@echo ""

# @make readme : view readme file
readme:
	cat README.md

# @make clean : remove old build components
clean:
	@rm -f phpunit 2>/dev/null
	@rm -f build/* 2>/dev/null

get-phpuinit:
	@echo "Download PHPUnit"
	@curl -o phpunit -L "https://phar.phpunit.de/phpunit-7.phar" 2> /dev/null
	@chmod +x phpunit
	@echo "Verify PHPUnit"
	@./phpunit --version

# @make configure : setup, download required components
configure: get-phpuinit

# @make tests : Test code and endpoints
tests:
	@echo "Test code and endpoints"
	./phpunit --testdox

# @make push : push lastest commits to master
push:
	@echo "push to master"
	@git push origin master

# @make get-version : show currewnt version
get-version:
	@cat api/version.txt

# @make [VERSION=x.y.z] bump-version : update version and commit it
bump-version:
	@echo $VERSION > api/version.txt
	git commit -am "bump version to $(VERSION)"
	git push origin master

# @make deploy-handler-upload-key-config : Deploy the RSA keys we need git deploy ment via GIT push
deploy-handler-upload-key-config:
	@echo "deploy handler: key config"
	@echo "#GITHUB-DEPLOY" > deploy-ssh-config.txt
	@echo "Host github.com" >> deploy-ssh-config.txt
	@echo "  User git" >> deploy-ssh-config.txt
	@echo "  Hostname github.com" >> deploy-ssh-config.txt
	@echo "  IdentityFile $(DEPLOY_HANDLER_FOLDER)/deploy.rsa" >>deploy-ssh-config.txt

# @make @deploy-handler-upload-key : we should NEVER load the keys inside the WWW folder, but just for ease at the moment
deploy-handler-upload-key: deploy-handler-upload-key-config
	@echo "deploy handler: upload keys"
	@scp keys/deploy $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy.rsa
	@echo "deploy handler: upload ssh config"
	@scp $(SSH_KEY) deploy-ssh-config.txt $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy-ssh-config.txt
	@echo "deploy handler: configure deploy ssh"
	@ssh $(SSH_KEY) $(DEPLOY_USER_HOST) "cat $(DEPLOY_HANDLER_FOLDER)/deploy-ssh-config.txt >> ~/.ssh/config "

# @make deploy-handler-upload-code : Upload the deployment handler code
deploy-handler-upload-code:
	@echo "deploy handler: upload code"
	@scp $(SSH_KEY) deploy_handler/deploy.php  $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/deploy.php

# @make @deploy-handler-logs : view the deployment handler logs
deploy-handler-logs:
	@echo "deploy handler: view log"
	@ssh $(SSH_KEY) $(DEPLOY_USER_HOST) "cat $(DEPLOY_HANDLER_FOLDER)/deploy.log"

# @make deploy-handler-clean : clear the deployment handler logs
deploy-handler-clean:
	@echo "deploy handler: clean"
	@ssh $(SSH_KEY) $(DEPLOY_USER_HOST) "mkdir $(DEPLOY_HANDLER_FOLDER) 2>/dev/null; rm $(DEPLOY_HANDLER_FOLDER)/*; touch $(DEPLOY_HANDLER_FOLDER)/deploy.log; chmod o+w $(DEPLOY_HANDLER_FOLDER)/deploy.log"

# @make deploy-handler : upload the deployment handler
deploy-handler: deploy-handler-all

# upload the deployment handler
deploy-handler-all: deploy-handler-clean deploy-handler-upload-key deploy-handler-upload-code

# @make package : package the code into ma zip file
package:
	@echo "zip package code"
	rm -f build/package.zip 2>/dev/null
	zip -x build/* -x *.idea*  -x *.git*  -r build/package.zip  .
	ls -las build/package.zip

# @make deploy : deploy the packaged zip file
deploy:
	scp $(SSH_KEY) build/package.zip $(DEPLOY_USER_HOST):$(DEPLOY_HANDLER_FOLDER)/package.zip
	ssh $(SSH_KEY) $(DEPLOY_USER_HOST) "unzip $(DEPLOY_HANDLER_FOLDER)/package.zip -d $(WEB_ROOT)/$(DEST)"

# @make [DEST=folder] clean-remote : remove the remote deployed API's
clean-remote:
	@echo DEST = $(DEST)
	@test $(DEST) && ssh $(SSH_KEY) $(DEPLOY_USER_HOST) "rm -r $(WEB_ROOT)/$(DEST)/* 2>/dev/null; rm -rf $(WEB_ROOT)/$(DEST)/.* 2>/dev/null; rmdir $(WEB_ROOT)/$(DEST) 2>/dev/null" || echo " DEST must be set to the folder you wish to remove"

.PHONY: help

