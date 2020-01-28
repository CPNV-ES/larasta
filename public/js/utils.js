//global js

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection

//adds and include an element into another
Element.prototype.addElement = function(type, className = "") {
    var newElement = document.createElement(type);
    this.appendChild(newElement);
    newElement.setAttribute('class', className);
    return newElement;
};
//remove matching childs
Element.prototype.removeChilds = function(elemQuerySelector = false) {
    if (elemQuerySelector) {
        var elemsToRemove = [...this.querySelectorAll(elemQuerySelector)]
    } else {
        var elemsToRemove = [...this.childNodes];
    }
    elemsToRemove.forEach((elem) => {
        elem.remove();
    });
};
String.prototype.capitalise = function() {
        return this[0].toUpperCase() + this.slice(1);
    }
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
    var lastDayStamp = currentStamp + (6 - currentDayIndex) * dayLengthStamp;
    var lastWorkStamp = lastDayStamp - (2 * dayLengthStamp);
    //TODO: add week number to return

    return {
        first: (new Date(firstDayStamp)).getAbsoluteDay(),
        last: (new Date(lastDayStamp)).getAbsoluteDay(),
        lastWork: (new Date(lastWorkStamp)).getAbsoluteDay()
    }
};
Date.prototype.getRightMonth = function() {
    return String("00" + (this.getMonth() + 1)).slice(-2);
}
Date.prototype.getAbsoluteDay = function() {
    var stamp = this.getTime();
    stamp -= (this.getHours() * 60 * 60 * 1000);
    stamp -= (this.getMinutes() * 60 * 1000);
    stamp -= (this.getSeconds() * 1000);
    stamp -= this.getMilliseconds();
    return new Date(stamp);
}

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
Utils.callApi = async function(path, {method = "GET", query = false, body = false, rawCallData = false} = {}){
    var headers = new Headers();
    headers.append("content-Type", "application/x-www-form-urlencoded")
    
    var fetchParams = {
        method: method,
        headers: headers
    }

    //body
    if(body){
        if(typeof body === 'object'){ //encoded body
            fetchParams.body = Utils.queryEncode(body);
        } else { //raw body
            fetchParams.body = body;
        }
    }

    //query
    var queryText = "";
    if(query){
        queryText = "?";
        if(typeof query === 'object'){ //encoded query
            queryText += Utils.queryEncode(query);
        } else { //raw query
            queryText = query;
        }
    }

    var result = await fetch(path + queryText, fetchParams);
    if(rawCallData){
        return result;
    }

    try{
        var jsonResponse = await result.json();
    } catch(e){
        console.warn("couldn't decode json");
        return false;
    }
    return jsonResponse;
}
Utils.queryEncode = function(queryData){
	var encodedStr = ""
	for(var key in queryData){
		encodedStr += encodeURIComponent(key);
        encodedStr += "=";
        if(typeof queryData[key] == "string" || typeof queryData[key] == "number"){
            encodedStr += encodeURIComponent((queryData[key])); //is value
        } else {
            encodedStr += encodeURIComponent(JSON.stringify(queryData[key])); //is json struct
        }
		encodedStr += "&"
	}
	return encodedStr.slice(0, -1);
}
Utils.addLoader = function(parent, className){
    var loader = parent.addElement("div", className);
    loader.classList.add("loader");
    loader.style.opacity = 0;
    requestAnimationFrame(()=>{
        loader.style.opacity = 1;
    });
    async function remove(){
        await async_requestAnimationFrame();
        loader.style.opacity = 0;
        await async_setTimeout(300);
        await async_requestAnimationFrame();
        loader.remove();
    }
    return {
        elem: loader,
        remove
    }
}

//EXEC ON ALL PAGES:
document.addEventListener("DOMContentLoaded", ()=>{
    //filters toggler (if elem on page)
    if(window.filtersBoxButton && window.expandedfilters){
        var icon = filtersBoxButton.querySelector("i");
        filtersBoxButton.addEventListener("click", function(ev){
            expandedfilters.classList.toggle("d-none");
            //toggle arrow
            icon.classList.toggle("down");
            icon.classList.toggle("up");
        });
    }
});