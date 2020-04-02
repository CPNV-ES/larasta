//Updated version of these methods can be found at https://github.com/nicolas-maitre/utils_js

//global js
HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection

//adds and include an element into another
Element.prototype.addElement = function(type = "div", attributes = {}) {
    var elem = document.createElement(type);
    this.appendChild(elem);
    for (var indAttr in attributes) {
        elem.setAttribute(indAttr, attributes[indAttr]);
    }
    //special attributes (setters/other)
    if (attributes._text) elem.textContent = attributes._text;
    if (attributes._html) elem.innerHTML = attributes._html;
    return elem;
};
Element.prototype.addElemBefore = function(ref) {
    ref.parentNode.insertBefore(this, ref);
};

Element.prototype.addElemAfter = function(ref) {
    ref.parentNode.insertBefore(this, ref.nextSibling);
};
//remove matching childs
Element.prototype.removeChilds = function(elemQuerySelector = false) {
    if (elemQuerySelector) {
        var elemsToRemove = [...this.querySelectorAll(elemQuerySelector)];
    } else {
        var elemsToRemove = [...this.childNodes];
    }
    elemsToRemove.forEach(elem => {
        elem.remove();
    });
};
Object.keyByValue = function(object, value) {
    //stolen from https://stackoverflow.com/a/28191966
    return Object.keys(object).find(key => object[key] === value);
};
String.prototype.capitalise = function() {
    return this[0].toUpperCase() + this.slice(1);
};
//get Monday to sunday day number (monday is 0)
Date.prototype.getMoSuDay = function() {
    var currentDay = this.getDay();
    if (currentDay === 0) {
        return 6;
    }
    return currentDay - 1;
};
//get first and last day of the week, starting on monday
Date.prototype.getWeek = function() {
    var currentStamp = this.getTime();
    var currentDayIndex = this.getMoSuDay();

    var dayLengthStamp = 24 * 60 * 60 * 1000;
    var firstDayStamp = currentStamp - currentDayIndex * dayLengthStamp;
    var lastDayStamp = currentStamp + (7 - currentDayIndex) * dayLengthStamp;
    var lastWorkStamp = lastDayStamp - 2 * dayLengthStamp;

    var firstDayDate = new Date(firstDayStamp).getAbsoluteDate();
    //TODO: add week number to return
    return {
        id: firstDayDate.toISOString(),
        first: firstDayDate,
        last: new Date(lastDayStamp).getAbsoluteDate(),
        lastWork: new Date(lastWorkStamp).getAbsoluteDate()
    };
};
Date.prototype.getRightMonth = function() {
    return String("00" + (this.getMonth() + 1)).slice(-2);
};
Date.prototype.getRightDate = function() {
    return String("00" + this.getDate()).slice(-2);
};
//get day timestamp without hours, seconds, etc
Date.prototype.getAbsoluteDate = function() {
    var stamp = this.getTime();
    stamp -= this.getHours() * 60 * 60 * 1000;
    stamp -= this.getMinutes() * 60 * 1000;
    stamp -= this.getSeconds() * 1000;
    stamp -= this.getMilliseconds();
    return new Date(stamp);
};
Date.prototype.toSimpleISOString = function() {
    return `${this.getFullYear()}-${this.getRightMonth()}-${this.getRightDate()}`;
};

var Cookies = {};
Cookies.get = function(key = false) {
    var cookiesStr = document.cookie;
    var cookiesArray = cookiesStr.split(";");
    var cookies = {};
    cookiesArray.forEach(cookie => {
        var cookieComponents = cookie.split("=");
        if (cookieComponents.length != 2) {
            return;
        }
        var cookey = decodeURIComponent(cookieComponents[0].trim());
        var value = decodeURIComponent(cookieComponents[1]);
        cookies[cookey] = value;
    });
    if (key) {
        return cookies[key];
    }
    return cookies;
};
Cookies.set = function(
    key,
    value,
    expiration = 1000 * 60 * 60 * 24 * 365 /*1 year*/,
    path = "/"
) {
    var expirationDate = new Date(Date.now() + expiration);
    var cookieStr = `${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
    cookieStr += `; expires=${expirationDate.toUTCString()}`;
    cookieStr += `; path=${path}`;
    document.cookie = cookieStr;
};
Cookies.delete = function(key) {
    Cookies.set(key, "deleted", -1);
};

function async_requestAnimationFrame() {
    return new Promise(function(res, rej) {
        requestAnimationFrame(res);
    });
}

function async_setTimeout(time) {
    return new Promise(function(res, rej) {
        setTimeout(res, time);
    });
}

var Utils = {};
Utils.callApi = async function(
    path,
    { method = "GET", query = false, body = false, rawCallData = false } = {}
) {
    var headers = new Headers();
    headers.append("content-Type", "application/x-www-form-urlencoded");

    var fetchParams = {
        method: method,
        headers: headers
    };

    //body
    if (body) {
        if (typeof body === "object") {
            //encoded body
            fetchParams.body = Utils.queryEncode(body);
        } else {
            //raw body
            fetchParams.body = body;
        }
    }

    //query
    var queryText = "";
    if (query) {
        queryText = "?";
        if (typeof query === "object") {
            //encoded query
            queryText += Utils.queryEncode(query);
        } else {
            //raw query
            queryText = query;
        }
    }

    var result = await fetch(path + queryText, fetchParams);
    if (rawCallData) {
        return result;
    }

    try {
        var jsonResponse = await result.json();
    } catch (e) {
        console.warn("couldn't decode json");
        return false;
    }
    return jsonResponse;
};
Utils.queryEncode = function(queryData) {
    var encodedStr = "";
    for (var key in queryData) {
        encodedStr += encodeURIComponent(key);
        encodedStr += "=";
        if (
            typeof queryData[key] == "string" ||
            typeof queryData[key] == "number"
        ) {
            encodedStr += encodeURIComponent(queryData[key]); //is value
        } else {
            encodedStr += encodeURIComponent(JSON.stringify(queryData[key])); //is json struct
        }
        encodedStr += "&";
    }
    return encodedStr.slice(0, -1);
};
Utils.addLoader = function(parent, className) {
    var loader = parent.addElement("div", { class: className });
    loader.classList.add("loader");
    loader.style.opacity = 0;
    requestAnimationFrame(() => {
        loader.style.opacity = 1;
    });
    async function remove() {
        await async_requestAnimationFrame();
        loader.style.opacity = 0;
        await async_setTimeout(300);
        await async_requestAnimationFrame();
        loader.remove();
    }
    return {
        elem: loader,
        remove
    };
};
Utils.infoBox = function(message, time = 5000) {
    var infoBox = document.body.addElement("div", {
        class: "infoMessageBox",
        _text: message
    });
    requestAnimationFrame(async function() {
        infoBox.style.opacity = 1;
        if (time != Infinity) {
            await async_setTimeout(time);
            remove();
        }
    });
    async function remove() {
        await async_requestAnimationFrame();
        infoBox.style.opacity = 0;
        await async_setTimeout(0.5 * 1000);
        infoBox.remove();
    }
    return { elem: infoBox, remove };
};
Utils.countWords = function(str) {
    return str.split(" ").filter(function(n) {
        return n != "";
    }).length;
};
//parses a text with a provided regex, returns texts and matches in arrays.
Utils.parseTextWithRegex = function(text, regex) {
    var matches = [];
    var textArray = [text];
    while (true) {
        //get url
        var matchRes = regex.exec(text);
        if (!matchRes) {
            //no (more) urls
            break;
        }
        var match = matchRes[0];
        //split on url
        var splitted = textArray[textArray.length - 1].split(match);
        //merge second part of splitted text, including urls.
        var splitAfter = splitted.slice(1, splitted.length);
        var nextString = splitAfter[0];
        for (var indSplit = 1; indSplit < splitAfter.length; indSplit++) {
            nextString += match;
            nextString += splitAfter[indSplit];
        }
        //push text and url to the respective arrays
        textArray[textArray.length - 1] = splitted[0];
        textArray.push(nextString);
        matches.push(match);
    }
    return {
        text: text,
        texts: textArray,
        matches: matches
    };
};
Utils.appendLinkifiedText = function(container, text) {
    const URL_REGEX = /(\b(((https?|ftp|file):\/\/)|www.)[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi; // found on stackoverflow https://stackoverflow.com/a/8943487/11548808
    const SECURE_SCHEME = "https://";
    const UNSECURE_SCHEME = "http://";
    const DEFAULT_SCHEME = UNSECURE_SCHEME;
    //text data
    var parsedText = Utils.parseTextWithRegex(text, URL_REGEX);

    for (var indText = 0; indText < parsedText.texts.length; indText++) {
        var textNode = document.createTextNode(parsedText.texts[indText]);
        container.appendChild(textNode);
        if (typeof parsedText.matches[indText] !== "undefined") {
            var linkText = parsedText.matches[indText];
            if (
                linkText.substring(0, SECURE_SCHEME.length) != SECURE_SCHEME &&
                linkText.substring(0, UNSECURE_SCHEME.length) != UNSECURE_SCHEME
            ) {
                //test http str
                linkText = DEFAULT_SCHEME + linkText;
            }
            var linkElem = container.addElement("a", {
                href: linkText,
                target: "_blank",
                rel: "noopener noreferrer", //prevent resources conflict + leaks
                _text: parsedText.matches[indText]
            });
        }
    }
};

//EXEC ON ALL PAGES:
document.addEventListener("DOMContentLoaded", () => {
    //left menu
    if (Cookies.get("sidemenu_state") == "open") {
        document.body.classList.add("sidemenu-open");
    } else {
        document.body.classList.remove("sidemenu-open");
    }
    sidemenuToggler.addEventListener("click", toggleSideMenu);
    document.body.addEventListener("click", evt => {
        if (evt.target == sidemenuToggler || sidemenu.contains(evt.target)) {
            return;
        }
        toggleSideMenu("close");
    });

    //filters toggler (if elem on page)
    if (window.filtersBoxButton && window.expandedfilters) {
        var icon = filtersBoxButton.querySelector("i");
        filtersBoxButton.addEventListener("click", function(ev) {
            expandedfilters.classList.toggle("d-none");
            //toggle arrow
            icon.classList.toggle("down");
            icon.classList.toggle("up");
        });
    }
});

function toggleSideMenu(action = "toggle") {
    if (
        document.body.classList.contains("sidemenu-open") ||
        action == "close"
    ) {
        document.body.classList.remove("sidemenu-open");
        Cookies.set("sidemenu_state", "closed");
    } else {
        document.body.classList.add("sidemenu-open");
        Cookies.set("sidemenu_state", "open");
    }
}
