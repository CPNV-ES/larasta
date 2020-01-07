//global js

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection

//adds and include an element into another
Element.prototype.addElement = function(type, className = ""){
    var newElement = document.createElement(type); //create
    this.appendChild(newElement); //append to parent
    newElement.setAttribute('class', className); //set class name
    return newElement;
};

var Utils = {};

Utils.callApi = async function(path, {method = "GET", query = false, body = false, rawCallData = false}){
    var headers = new Headers();
    headers.append("content-Type", "application/x-www-form-urlencoded")
    var fetchParams = {
        method: "method",
        headers: headers
    }
    var result = await fetch("/api" + path, fetchParams);
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