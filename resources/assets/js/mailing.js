"use strict";

document.addEventListener("DOMContentLoaded", function() {
    //all elements with responsible class and on click we add d-none class
    document.getElementsByClassName("responsible").forEach(function(responsible){
        responsible.addEventListener("click",function (event) {
            responsible.classList.add("d-none");

            var responsiblesELem = responsible.parentElement;
            var showDelElem = responsiblesELem.querySelector(".showDeletedResponsibles");

            //remove d-none at the parent and show the number of people hidden
            showDelElem.classList.remove("d-none");
            var nbElemHidden=responsiblesELem.getElementsByClassName('d-none').length;
            showDelElem.innerText = `(${nbElemHidden} Personne(s) supprimée(s))`;
        });
    });
    //all elements with showDeletedResponsibles class
    document.getElementsByClassName("showDeletedResponsibles").forEach(function(showDeletedResponsibles){
        // on click, we show all hidden people on enterprise
        showDeletedResponsibles.addEventListener("click", function (event) {
            var responsiblesELem = showDeletedResponsibles.parentElement;
            var responsiblesElems = responsiblesELem.querySelectorAll(".d-none");
            //remove d-none on all elements
            responsiblesElems.forEach(function (elem) {
                elem.classList.remove("d-none");
            });
            showDeletedResponsibles.classList.add("d-none");
        });
    });

    //all elements with enterprise class
    document.querySelectorAll(".enterprise>.delete").forEach(function(enterprise){
        //add d-none class on click each enterprise
        enterprise.addEventListener("click",function (event) {
            var enterpriseElem = enterprise.parentElement;
            enterpriseElem.classList.add("d-none");

            var enterprisesElem = enterpriseElem.parentElement;
            var showDelElem = enterprisesElem.querySelector(".showDeletedEnterprises");

            //remove d-none at the parent and show the number of people hidden
            showDelElem.classList.remove("d-none");
            var nbElemHidden=enterprisesElem.querySelectorAll('.enterprise.d-none').length;
            showDelElem.innerText = `(${nbElemHidden} entrepise(s) supprimée(s))`;
        });
    });
    //all elements with showDeletedEnterprises class
    document.getElementsByClassName("showDeletedEnterprises").forEach(function(showDeletedEnterprises){
        // on click, we show all hidden people on enterprise
        showDeletedEnterprises.addEventListener("click", function (event) {
            var enterprisesElem = showDeletedEnterprises.parentElement;
            var enterprisesElems = enterprisesElem.querySelectorAll(".enterprise.d-none");
            enterprisesElems.forEach(function (elem){
                elem.classList.remove("d-none");
            });
            showDeletedEnterprises.classList.add("d-none");
        });
    });
});