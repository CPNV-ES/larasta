"use strict";

document.addEventListener("DOMContentLoaded", function() {

    document.querySelectorAll(".responsible").forEach((responsible) => {
        if(responsible.getAttribute("email") == "[]"){
            responsible.innerHTML += " (pas d'email)";
        }
    });

    /*
     * Responsibles events
     */
    //all elements with responsible class and on click we add d-none class
    document.getElementsByClassName("responsible").forEach(function(responsible){
        responsible.addEventListener("click",function (event) {
            showCancelButtom(responsible,"showDeletedResponsibles", "d-none","Personne(s) supprimée(s)","d-none");
        });
    });
    //all elements with showDeletedResponsibles class
    document.getElementsByClassName("showDeletedResponsibles").forEach(function(showDeletedResponsibles){
        // on click, we show all hidden people on enterprise
        showDeletedResponsibles.addEventListener("click",function(){HiddenItems(showDeletedResponsibles,".d-none", "d-none")});
    });
    /*
     * enterprises events
     */
    //all elements with enterprise class
    document.querySelectorAll(".enterprise>.delete").forEach(function(enterprise){
        //add d-none class on click each enterprise
        enterprise.addEventListener("click",function (event) {
            var enterpriseElem = enterprise.parentElement;
            showCancelButtom(enterpriseElem,"showDeletedEnterprises", "d-none","entrepise(s) supprimée(s)","enterprise.d-none");
        });
    });
    //all elements with showDeletedEnterprises class
    var showDeletedEnterprises = document.querySelector(".showDeletedEnterprises");
    // on click, we show all hidden people on enterprise
    showDeletedEnterprises.addEventListener("click",function(){
        // re-show all responsible of hidden enterprises
        showDeletedEnterprises.parentElement.querySelectorAll('.showDeletedResponsibles').forEach(function(showDeletedResponsibles){
            showDeletedResponsibles.click();
        });

        HiddenItems(showDeletedEnterprises,".enterprise.d-none", "d-none");
    });
    showDeletedEnterprises.click();

    //remove d-none of element and count the number of hidden to message
    function showCancelButtom(element, elemClass, classToAddOrRemove, message, classElemToCount) {
        element.classList.add(classToAddOrRemove);

        var parentElem = element.parentElement;
        var showDelElem = parentElem.parentElement.querySelector(`.${elemClass}`);

        //remove d-none at the parent and show the number of people hidden
        showDelElem.classList.remove(classToAddOrRemove);
        var nbElemHidden=parentElem.querySelectorAll(`.${classElemToCount}`).length;
        showDelElem.innerText = `(${nbElemHidden}  ${message})`;
    }
    //Hide elements with specific class
    //element = what's element have your class
    //elemClass = class of your element
    //classToRemoveOrAdd = element to remove and add on element var
    function HiddenItems(element, elemClass, classToRemoveOrAdd)
    {
        var parentElem = element.parentElement;
        var childElems = parentElem.querySelectorAll(elemClass);
        childElems.forEach(function (childElem){
            //remove d-none on all elements
            childElem.classList.remove(classToRemoveOrAdd);
        });
        element.classList.add(classToRemoveOrAdd);
    }
    document.querySelector(".cmdMail").addEventListener("click",() => {
       var responsibles = document.querySelectorAll(".responsible:not(.d-none)");
        var emails = [];

        responsibles.forEach((responsible) => {
            emails=[...emails,...JSON.parse(responsible.getAttribute("email"))];
        });
        //show email application
        sendMail(emails);
    });
});
function sendMail(to) {
    if (Array.isArray(to)) {
        to = to.join(";");
    }
    //compatible with chrome and firefox
    var link = document.createElement("a");
    link.href = `mailto:${to}`;
    link.click();
};