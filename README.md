
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
 - git clone git@github.com:afakes/afakes-myob-devops.git 
 - make clean configure
 - make test
 - validate deployment hook - GitHUB
 - make deploy


## 2.1 Clone 
_Clone the GitHUB repository_
```bash
git clone git@github.com:afakes/afakes-myob-devops.git
```

## 2.2 Configure 
validate we have the required prerequisite software to execute from this location

```bash
make configure
```

## 2.3 Test 
execute local tests, and pre-eflight remote tests

```bash
make test
```

## 2.4 Github Webhook  
This code base will make use of the GitHUB webhook system to allow delivery of software to the end host.

 * Open browser
 * Navigate to: ```https://github.com/afakes/afakes-myob-devops/settings/hooks```
 * 


## 2.5 Deploy 


Say what the step will be

```
Give the example
```

And repeat

```
until finished
```



git clone git@github.com:afakes/afakes-myob-devops.git


End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```




# Deployment
Add additional notes about how to deploy this on a live system

## From command-line
note: this has been preformed successfully from the MacOS command-line 


## From GitHUB deployment Hooks



# Endpoints

## hello
http://localhost/development/afakes-myob-devops/api/hello.php

**command**

```curl "http://localhost/development/afakes-myob-devops/api/hello.php"```

**result**

```{"statusCode":200,"endpoint":"http:\/\/localhost\/development\/afakes-myob-devops\/api\/hello.php","message":"Hello World"}```


## health
http://localhost/development/afakes-myob-devops/api/health.php

**command**

```curl "http://localhost/development/afakes-myob-devops/api/health.php"```

**result**

```{"statusCode":200,"endpoint":"http:\/\/localhost\/development\/afakes-myob-devops\/api\/hello.php","message":"Hello World"}```



## metadata
http://localhost/development/afakes-myob-devops/api/hello.php

**command**

```curl "http://localhost/development/afakes-myob-devops/api/hello.php"```

**result**

```{"statusCode":200,"endpoint":"http:\/\/localhost\/development\/afakes-myob-devops\/api\/hello.php","message":"Hello World"}```




## health
http://localhost/development/afakes-myob-devops/api/hello.php

## Metadata
http://localhost/development/afakes-myob-devops/api/hello.php


# Appendices  

## Appendix A - Source requirements
 - https://github.com/MYOB-Technology/ops-technical-test/blob/master/README.md

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

