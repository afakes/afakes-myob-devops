class domHelper {

    /**
     * Remove all child elements from the given
     * @param {HTMLElement} from
     */
    static removeAllChildren(from = null ) {
        let element = domHelper.discoverElement(from);
        if (element == null) {return;}
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    static setContent(on = null, content = null) {
        if (content == null) {return;}
        let element = domHelper.discoverElement(on);
        if (element == null) {return;}
        element.innerHTML = content;
    }

    /**
     * Append content as a child of the given element
     * @param {HTMLElement|string} to
     * @param {string} content
     */
    static append(to = null, content = null) {
        if (content == null) {return;}
        let element = domHelper.discoverElement(to);
        if (element == null) {return;}
        element.appendChild(document.createRange().createContextualFragment(content));
    }

    /**
     * @param {string|HTMLElement} selector
     * @return {HTMLElement}
     */
    static discoverElement(selector = null) {
        if (selector == null) {return null;}
        if (selector instanceof HTMLElement) { return selector;}
        let result =  document.querySelector(selector);
        return (result instanceof HTMLElement) ? result : null;
    }

    /**
     * @param element
     * @param displayType
     */
    static toggleDisplay(element = null, displayType = 'block') {
        element = domHelper.discoverElement(element);
        if (element == null) {return;}

        if (element.style.display == 'none') {
            domHelper.show(element, displayType);
        } else {
            domHelper.hide(element);
        }
    }

    /**
     * @param {HTMLElement} element
     * @param {string} displayType as a value for  xxxx.style.display
     */
    static show(element = null, displayType = 'block') {
        element = domHelper.discoverElement(element);
        if (element == null) {return;}
        element.style.display = displayType;
    }

    /**
     * @param element
     */
    static hide(element = null) {
        element = domHelper.discoverElement(element);
        if (element === null) {return;}
        element.style.display = 'none';
    }


    static addClick(to = null, method = null) {
        let element = domHelper.discoverElement(to);
        if (element === null) {return;}
        element.addEventListener("click",  event => { method(event); } );
    }

    static addDoubleClick(to = null, method = null) {
        let element = domHelper.discoverElement(to);
        if (element === null) {return;}
        element.addEventListener("dblclick",  event => { method(event); } );
    }


}
