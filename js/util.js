class util {

    /**
     *
     * @param {HTMLElement} element
     * @returns {Promise<any>}
     */
    static getEndpoints(elementID) {

        return util.fetch("api/index.php").then(
            (response) => {

                if ('endpoints' in response) {

                    // todo: in production remove lts - they are slow
                    let headers = util.createTabHeader(response.endpoints);
                    domHelper.append(`#${elementID} .tabHeader`, headers);

                    let body = util.createTabBody(response.endpoints);
                    domHelper.append(`#${elementID}`, body);

                    $( `#${elementID}` ).tabs();
                }


            }
        )

    }

    /**
     * create the html for the TAB top buttons
     * @param endpoints
     * @returns {string}
     */
    static createTabHeader(endpoints) {

        let result = [];
        Object.keys(endpoints).forEach(
            name => {
                result.push(`<li><a href="#tabs-${name}">${name}</a></li>`);
            }
        );

        return result.join("\n");

    }

    /**
     * create the html for the TAB bodies
     * @param endpoints
     * @returns {string}
     */
    static createTabBody(endpoints) {

        let result = [];

        Object.keys(endpoints).forEach(
            name => {
                result.push(`
<div id="tabs-${name}">
    <h2>
        
        <a target="_help_${name}" href="https://github.com/afakes/afakes-myob-devops#-${name}" style="text-decoration: none;">
            <i title="click for help page" class="material-icons">help_outline</i>
        </a>       
        <i title="execute API"  class="material-icons" data-dest="content-${name}" data-url="${endpoints[name]}" onclick="util.getApiContent(this)" >flight_takeoff</i>
        &nbsp;::&nbsp;${name}    
    </h2>
    <li>
        <b>END-POINT:</b>&nbsp;<a target="_api_${name}" href="${endpoints[name]}">${endpoints[name]}</a>
    </li>
    <div id="content-${name}"></div>
</div>
`);
            }
        );

        return result.join("\n");
    }

    /**
     * fetch content from URL and populate dest
     * @param src
     */
    static getApiContent(src) {

        document.getElementById(src.dataset.dest).innerHTML = "...... executing .....";
        util.fetch(src.dataset.url).then(
            (content) => {
                document.getElementById(src.dataset.dest).innerHTML = `<pre>${JSON.stringify(content, null, 2)}</pre>`;
            }
        );

    }

    /**
     * Use a Proxy system to call the URL and proxy the results
     * This is my own php script and hosting service, many times I require to access API that are CROS enabled, this allows me to amke AJAX calls and have the script get the content for mer
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

