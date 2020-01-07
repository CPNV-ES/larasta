//global js

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection

//adds and include an element into another
Element.prototype.addElement = function(type, className = ""){
    var newElement = document.createElement(type);
    this.appendChild(newElement);
    newElement.setAttribute('class', className);
    return newElement;
};
//get Monday to sunday day number (monday is 0)
Date.prototype.getMoSuDay = function(){
    var currentDay = this.getDay();
    if(currentDay === 0){
        return 6;
    }
    return currentDay - 1;
};
Date.prototype.getMoSuWeek = function(){
    var currentStamp = this.getTime();
    var currentDayIndex = this.getMoSuDay();
    console.warn("not functionnal");
};

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