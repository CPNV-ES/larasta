"use strict";

document.addEventListener("DOMContentLoaded", function() {
    /*
     * Responsibles events
     */
    //all elements with responsible class and on click we add d-none class
    document.getElementsByClassName("responsible").forEach(function(responsible){
        responsible.addEventListener("click",function (event) {
            cancelButtom(responsible,"showDeletedResponsibles", "d-none","Personne(s) supprimée(s)","d-none");
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
            cancelButtom(enterpriseElem,"showDeletedEnterprises", "d-none","entrepise(s) supprimée(s)","enterprise.d-none");
        });
    });
    //all elements with showDeletedEnterprises class
    document.getElementsByClassName("showDeletedEnterprises").forEach(function(showDeletedEnterprises){
        // on click, we show all hidden people on enterprise
        showDeletedEnterprises.addEventListener("click",function(){HiddenItems(showDeletedEnterprises,".enterprise.d-none", "d-none")});
    });

    //remove d-none of element and count the number of hidden to message
    function cancelButtom(element, elemClass,classToAddOrRemove,message,classElemToCount) {
        element.classList.add(classToAddOrRemove);

        var parentElem = element.parentElement;
        var showDelElem = parentElem.querySelector(`.${elemClass}`);

        //remove d-none at the parent and show the number of people hidden
        showDelElem.classList.remove(classToAddOrRemove);
        var nbElemHidden=parentElem.querySelectorAll(`.${classElemToCount}`).length;
        showDelElem.innerText = `(${nbElemHidden}  ${message})`;
    }
    //Hidde elements with specific class
    //element = what's element have your class
    //elemClass = class of your element
    //elemToRemoveOrAdd = element to remove and add on element var
    function HiddenItems(element, elemClass, elemToRemoveOrAdd)
    {
        var parentElem = element.parentElement;
        var childElems = parentElem.querySelectorAll(elemClass);
        childElems.forEach(function (childElem){
            //remove d-none on all elements
            childElem.classList.remove(elemToRemoveOrAdd);
        });
        element.classList.add(elemToRemoveOrAdd);
    }

});