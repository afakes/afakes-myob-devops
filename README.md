
'MYOB - Platform Enablement Technical Test' by Adam Fakes
=========================================================

# 1. Overview

## 1.1. Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

## 1.2 Prerequisites

What things you need to install the software and how to install them

* [git](https://git-scm.com/) - distributed version control system 
* [Make](https://en.wikipedia.org/wiki/Makefile) - Makefile build system
* [PHP](http://www.php.net/) - Language
* [PHPUnit](https://phpunit.de/getting-started/phpunit-6.html) - Testing
* [Apache](https://httpd.apache.org/) - Apache HTTP Server Project 


## 1.3 Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## 1.4 Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/afakes/afakes-myob-devops/tags). 

## 1.5 Authors

* **Adam Fakes** - *Initial work* - [adam@datavi.co](mailto:adam@datavi.co), [linkedIn](https://www.linkedin.com/in/adamfakes/).  

## 1.6 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## 1.7 Acknowledgments

* [Linus Torvalds](https://en.wikipedia.org/wiki/Linus_Torvalds) 
* [Tim Berners-lee](https://en.wikipedia.org/wiki/Tim_Berners-Lee)


# 2. Installing
Here we describe how to retrieve the sources code and install any prerequisites

**Quick version**
 - ```git clone git@github.com:afakes/afakes-myob-devops.git``` 
 - ```make clean configure```
 - ```make tests```
 - ```make clean deploy-handler-all```
 - validate deployment hook at [afakes-myob-devops/settings/hook](https://github.com/afakes/afakes-myob-devops/settings/hook)  
 - ```make deploy```
 - ```make VERSION=x.y.z bump-version```


## 2.1 Clone 
_Clone the GitHUB repository_

```bash
git clone git@github.com:afakes/afakes-myob-devops.git
```

```text
Cloning into 'afakes-myob-devops'...
remote: Counting objects: 116, done.
remote: Compressing objects: 100% (78/78), done.
remote: Total 116 (delta 53), reused 90 (delta 29), pack-reused 0
Receiving objects: 100% (116/116), 574.75 KiB | 469.00 KiB/s, done.
Resolving deltas: 100% (53/53), done.
```


## 2.2 Configure 
validate we have the required prerequisite software to execute from this location

 * ```make clean configure```

```text
Download PHPUnit
Verify PHPUnit
PHPUnit 7.0.2 by Sebastian Bergmann and contributors.
```


## 2.4 Github Webhook  
This code base will make use of the GitHUB webhook system to allow delivery of software to the end host.

 * Open browser
 * Navigate to: ```https://github.com/afakes/afakes-myob-devops/settings/hooks```
 * Add Webhook
 * **Payload URL:**  'https://github.com/afakes/afakes-myob-devops/settings/hooks/24110007' 
 * CLick  () Send me everything.
 * CLick  "Add Webhook"


## 2.5 Deploy Handler 
Required, if you would like to have the code update based on commits, to the master branch. I would 
suggest a future version would accept and check that the code has come from a Pull Request (PR)


 * **first deploy**     - ```make clean deploy-handler-all```
 * **just handle code** - ```make deploy-handler-upload-code```

```text
deploy handler: clean
deploy handler: key config
deploy handler: upload keys
deploy                                                   100% 1675     7.2KB/s   00:00
deploy handler: upload ssh config
deploy-ssh-config.txt                                    100%  125     0.6KB/s   00:00
deploy handler: configure deploy ssh
deploy handler: upload code
deploy.php                                               100% 1650     7.7KB/s   00:00
```


## 2.6 Deploy
We have two deployment methods here, direct via SCP with a packaged tar.gz file, and via GitHUB. There may times 
when we want to deploy the first time directly on to the host without GitHUB.

## 2.6.1 Deploy directly
here we will package up the entire project as a .tar.gz and deliver it to the host system, there it will be unpacked

### Steps to deploy
_package, upload keys, upload code_ 

 ```
 make package
 make DEST=<folder name> deploy
 ```
   * **_folder name_** = the name of the folder inside the webroot directory 

 * ```make DEST=FOO deploy```
   * this will deploy the packaged zip to the folder <webroot>/FOO

 * **example**
 We deploy the codebase to the host, where the API's will be available at  
 ```
 make package
 make DEST=foo deploy
 ```
  
  The API's are now available at ```http://adamfakes.com/staging/foo/api```
  
  e.g. ```http://adamfakes.com/staging/foo/api/health.php```
 
 

## 2.6.2 Deploy via Commit
This relies on the  ```deploy-hanlder```, so must be deployed before pushed commits will have an affect.


### 2.6.2.1 First deploy
Make a change to the code and commit it, push that change to the repo, this will trigger a deploy, we will see that the code folder does not exist, it will be created on the first GIT CLONE

 * make change and commit. e.g. update the version number 
   ```bash
   make VERSION=x.y.z bump-version
   ``` 

_**note:** the difference between first & subsequent is seen on the server side._


## 2.6.2.2 Deploy via Commit - subsequent deploy
Make a change to the code and commit it, push that change to the repo, this will trigger a deploy, 

 * make change and commit. e.g. update the version number 
   ```
   make VERSION=x.y.z bump-version
   ``` 


# 3. Endpoints
here we detail the endpoints, what they are, and what they are used for, and the expected output.


## :: hello

 * **Endpoint-url:**
  
   * ```http://adamfakes.com/staging/afakes-myob-devops/api```
   * ```http://adamfakes.com/staging/afakes-myob-devops/api/hello.php```

 * **Command line:** ```curl "http://adamfakes.com/staging/afakes-myob-devops/api/hello.php"```

 * **Result**

```json
{
  "statusCode": 200,
  "endpoint": "http://adamfakes.com/staging/afakes-myob-devops/api/hello.php",
  "message": "Hello World"
}
```

_**note:** the result will be JSON encoded, the above has been decoded for textual clarity_


## :: health

 * **Endpoint-url:** ```http://adamfakes.com/staging/afakes-myob-devops/api/health.php```

 * **Command line:** ```curl "http://adamfakes.com/staging/afakes-myob-devops/api/health.php"```

 * **Result**

```json
{
  "statusCode": 200,
  "endpoint": "http://adamfakes.com/staging/afakes-myob-devops/api/health.php",
  "result": {
    "status": "OK",
    "checksum": "3e539dda4ae1aa09313e3ebd285efc12"
  }
}
```

_**note:** the result will be JSON encoded, the above has been decoded for textual clarity_


## :: metadata

 * **Endpoint-url:** ```http://adamfakes.com/staging/afakes-myob-devops/api/metadata.php```

 * **Command line:** ```curl "http://adamfakes.com/staging/afakes-myob-devops/api/metadata.php"```

 * **result**
```json
{
  "statusCode": 200,
  "endpoint": "http://adamfakes.com/staging/afakes-myob-devops/api/metadata.php",
  "myapplication": {
    "version": "1.5a",
    "description": "pre-interview technical test",
    "lastcommitsha": "81a52fd",
    "commitLog": [
      " 81a52fd|Adam Fakes|Sun Mar 18 12:09:53 2018 +1100|added commit log to metadata",
      ....
      " 7e5a25a|Adam Fakes|Sat Mar 17 17:49:35 2018 +1100|version updated",
      " a2375fb|Adam Fakes|Sat Mar 17 14:01:17 2018 +1100|setup api endpoints",
      " 7e16e65|Adam Fakes|Sat Mar 17 13:06:19 2018 +1100|Initial commit"
    ]
  }
}
```

_**note:** the result will be JSON encoded, the above has been decoded for textual clarity_

## 3.4 Discovery
Discover what enpoints are available


 * **Endpoint-url:** ```http://adamfakes.com/staging/afakes-myob-devops/api```

 * **Command line:** ```curl "http://adamfakes.com/staging/afakes-myob-devops/api"```

```json
{
  "statusCode": 200,
  "endpoint": "http://localhost/development/afakes-myob-devops/api/index.php",
  "authors": {
    "afakes": {
      "linkedin": "https://www.linkedin.com/in/adamfakes",
      "github": "https://github.com/afakes"
    }
  },
  "code-inspection": {
    "travis": "https://travis-ci.org/afakes/afakes-myob-devops",
    "github": "https://github.com/afakes/afakes-myob-devops"
  },
  "endpoints": [
    "http://localhost/development/afakes-myob-devops/api/app.php",
    "http://localhost/development/afakes-myob-devops/api/health.php",
    "http://localhost/development/afakes-myob-devops/api/hello.php",
    "http://localhost/development/afakes-myob-devops/api/metadata.php"
  ]
}
```



# 4. Integration tests
Test are written with PHPUnit and executed via commandline or [Travis - afakes-myob-devops](https://travis-ci.org/afakes/afakes-myob-devops) 

# 4.1. Local test

 * ```make tests```

 * **Result**

```text
PHPUnit 7.0.2 by Sebastian Bergmann and contributors.

testApp
 ✔ Version
 ✔ Last commit

testEndpointHello
 ✔ Endpoint hello content
 ✔ Endpoint hello message

testEndpointHealth
 ✔ Endpoint health content
 ✔ Endpoint health data

testEndpointMetadata
 ✔ Endpoint metadata content
 ✔ Endpoint metadata data

Time: 2.93 seconds, Memory: 8.00MB
```


# 4.2. Via Travis
You can view the output of tests at [Travis - afakes-myob-devops](https://travis-ci.org/afakes/afakes-myob-devops)

 * **Result**
  
 ![TravisOutput.png](images/TravisOutput.png "Travis build summary")




# Appendices  

## Appendix A - Source requirements

 ref: https://github.com/MYOB-Technology/ops-technical-test/blob/master/README.md

```
# Platform Enablement Technical Test

We would like you to write an application in a language of your choice
which covers a few points of interest. It will be evaluated holistically,
so take this as an opportunity to show the breadth of your skills or knowledge.

## Application Details

Your application should be a simple, small, operable web-style API or service
provider. It should implement the following:

- a simple root endpoint which responds in a simple manner; "hello world" or some such
- a health endpoint which returns an appropriate response code
- a metadata endpoint which returns basic information about your application; example:

        "myapplication": [
          {
            "version": "1.0",
            "description" : "pre-interview technical test",
            "lastcommitsha": "abc57858585"
          }
        ]


- tests or a test suite; the type of testing is up to you

## Fit and Finish

Once the application has been written, continue with the following additions:

- provide a means of packaging your application as a single deployable artifact which encapsulates its dependencies
- create a pipeline that builds your application on each commit; Travis or similar, for example
- write a clear and understandable `README` which explains your application and its deployment steps
```

## Appendix 2. how to install 'make'

 * MacOS - Make is part of the XCode development environment, you will need to download and install XCode via the App store 
 * Linux - make usually comes preconfigured for linux, you may be able to find it via the build-essentials package
```bash
 apt-get install build-essentials
```

