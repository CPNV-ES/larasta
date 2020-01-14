/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ 20:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(21);


/***/ }),

/***/ 21:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


document.addEventListener("DOMContentLoaded", function () {
    /*
     * Responsibles events
     */
    //all elements with responsible class and on click we add d-none class
    document.getElementsByClassName("responsible").forEach(function (responsible) {
        responsible.addEventListener("click", function (event) {
            showCancelButtom(responsible, "showDeletedResponsibles", "d-none", "Personne(s) supprimée(s)", "d-none");
        });
    });
    //all elements with showDeletedResponsibles class
    document.getElementsByClassName("showDeletedResponsibles").forEach(function (showDeletedResponsibles) {
        // on click, we show all hidden people on enterprise
        showDeletedResponsibles.addEventListener("click", function () {
            HiddenItems(showDeletedResponsibles, ".d-none", "d-none");
        });
    });
    /*
     * enterprises events
     */
    //all elements with enterprise class
    document.querySelectorAll(".enterprise>.delete").forEach(function (enterprise) {
        //add d-none class on click each enterprise
        enterprise.addEventListener("click", function (event) {
            var enterpriseElem = enterprise.parentElement;
            showCancelButtom(enterpriseElem, "showDeletedEnterprises", "d-none", "entrepise(s) supprimée(s)", "enterprise.d-none");
        });
    });
    //all elements with showDeletedEnterprises class
    var showDeletedEnterprises = document.querySelector(".showDeletedEnterprises");
    // on click, we show all hidden people on enterprise
    showDeletedEnterprises.addEventListener("click", function () {
        // re-show all responsible of hidden enterprises
        showDeletedEnterprises.parentElement.querySelectorAll('.showDeletedResponsibles').forEach(function (showDeletedResponsibles) {
            showDeletedResponsibles.click();
        });

        HiddenItems(showDeletedEnterprises, ".enterprise.d-none", "d-none");
    });

    //remove d-none of element and count the number of hidden to message
    function showCancelButtom(element, elemClass, classToAddOrRemove, message, classElemToCount) {
        element.classList.add(classToAddOrRemove);

        var parentElem = element.parentElement;
        var showDelElem = parentElem.parentElement.querySelector("." + elemClass);

        //remove d-none at the parent and show the number of people hidden
        showDelElem.classList.remove(classToAddOrRemove);
        var nbElemHidden = parentElem.querySelectorAll("." + classElemToCount).length;
        showDelElem.innerText = "(" + nbElemHidden + "  " + message + ")";
    }
    //Hide elements with specific class
    //element = what's element have your class
    //elemClass = class of your element
    //classToRemoveOrAdd = element to remove and add on element var
    function HiddenItems(element, elemClass, classToRemoveOrAdd) {
        var parentElem = element.parentElement;
        var childElems = parentElem.querySelectorAll(elemClass);
        childElems.forEach(function (childElem) {
            //remove d-none on all elements
            childElem.classList.remove(classToRemoveOrAdd);
        });
        element.classList.add(classToRemoveOrAdd);
    }
    document.querySelector(".cmdMail").addEventListener("click", function () {
        var mailto = "mailto:";
        var responsibles = document.querySelectorAll(".responsible");

        responsibles.forEach(function (responsible) {
            console.log(responsible);
        });
    });
});

/***/ })

/******/ });