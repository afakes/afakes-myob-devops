
# Project Title
  Adam Fakes' response to 'MYOB - Platform Enablement Technical Test'


## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.


### Quick version
- 

git clone git@github.com:afakes/afakes-myob-devops.git 


### Prerequisites


What things you need to install the software and how to install them

```
GIT -  
```

### Installing
Here we describe how to retrieve the sources code and install any prerequisites



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

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/afakes/afakes-myob-devops/tags). 

## Authors

* **Adam Fakes** - *Initial work* - [adam@datavi.co](mailto:adam@datavi.co), [linkedIn](https://www.linkedin.com/in/adamfakes/).  

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc





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
