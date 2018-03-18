class util {

    static getEndpoints() {

        return util.fetch("api/index.php").then(
            (response) => {

                if ('endpoints' in response) {

                    console.log('response.endpoints = ', response.endpoints, "\n");

                    let headers = util.createTabHeader(response.endpoints);

                    console.log('headers = ', headers, "\n");

                    let body = util.createTabBody(response.endpoints);

                    console.log('body = ', body, "\n");

                }


            }
        )

    }

    static createTabHeader(endpoints) {

        let result = [];
        Object.keys(endpoints).forEach(
            name => {
                result.push(`<li><a href="#tabs-${name}">${name}</a></li>`);
            }
        );

        return result.join("\n");

    }

    static createTabBody(endpoints) {

        let result = [];

        Object.keys(endpoints).forEach(
            name => {
                result.push(`
<div id="tabs-${name}">
    <h2>${name}</h2>
    <li><b>END-POINT:</b>&nbsp;${endpoints[name]}</li>
</div>
`);
            }
        );


        return result.join("\n");
    }


    /**
     * Use a Proxy system to call the URL and proxy the results
     * todo: update http://52.33.224.11/jsonProxy/ to an API Gateway and Lambda
     * @param {string} destinationURL
     * @param {string} type [ json | text | xml]
     * @returns {Promise<any>}
     */
    static fetchP(destinationURL, type = 'json') {
        let proxyURL = `http://52.33.224.11/jsonProxy/?url=${encodeURIComponent(destinationURL)}`;
        return (new baseClass()).fetch(proxyURL, type);
    }

    /**
     * @param {string} url
     * @param {string} type [json | text ] - https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/responseType
     * @param {{}} headers
     * @return {Promise<any>}
     */
    static fetch(url, type = 'json', headers = {}) {

        return new Promise(
            (resolve, reject) => {
                let xhr = new XMLHttpRequest();

                console.log('url = ', url, "\n");

                xhr.open('GET', url);
                xhr.responseType = type;

                if (headers != null) {
                    Object.keys(headers).forEach(
                        (headerKey) => {
                            xhr.setRequestHeader(headerKey, headers[headerKey]);
                        }
                    );
                }

                xhr.onload = event => {
                    resolve(('response' in xhr) ? xhr.response : null);
                    return;
                };
                xhr.onerror = error => {
                    console.log('error = ', error, "\n");
                    resolve(null);
                    return;
                };
                xhr.send();
            });

    }
}

