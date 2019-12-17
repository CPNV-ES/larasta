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
    //all elements with responsible class and on click we add d-none class
    document.getElementsByClassName("responsible").forEach(function (responsible) {
        responsible.addEventListener("click", function (event) {
            responsible.classList.add("d-none");

            var responsiblesELem = responsible.parentElement;
            var showDelElem = responsiblesELem.querySelector(".showDeletedResponsibles");

            //remove d-none at the parent and show the number of people hidden
            showDelElem.classList.remove("d-none");
            var nbElemHidden = responsiblesELem.getElementsByClassName('d-none').length;
            showDelElem.innerText = "(" + nbElemHidden + " Personne(s) supprim\xE9e(s))";
        });
    });
    //all elements with showDeletedResponsibles class
    document.getElementsByClassName("showDeletedResponsibles").forEach(function (showDeletedResponsibles) {
        // on click, we show all hidden people on enterprise
        showDeletedResponsibles.addEventListener("click", function (event) {
            var responsiblesELem = showDeletedResponsibles.parentElement;
            var responsiblesElems = responsiblesELem.getElementsByClassName("d-none");
            //because js update dynamically the array
            while (responsiblesElems[0]) {
                responsiblesElems[0].classList.remove("d-none");
            }
            showDeletedResponsibles.classList.add("d-none");
        });
    });

    //all elements with enterprise class
    document.querySelectorAll(".enterprise>.delete").forEach(function (enterprise) {
        //add d-none class on click each enterprise
        enterprise.addEventListener("click", function (event) {
            var enterpriseElem = enterprise.parentElement;
            enterpriseElem.classList.add("d-none");

            var enterprisesElem = enterpriseElem.parentElement;
            var showDelElem = enterprisesElem.querySelector(".showDeletedEnterprises");

            //remove d-none at the parent and show the number of people hidden
            showDelElem.classList.remove("d-none");
            var nbElemHidden = enterprisesElem.querySelectorAll('.enterprise.d-none').length;
            showDelElem.innerText = "(" + nbElemHidden + " entrepise(s) supprim\xE9e(s))";
        });
    });
    //all elements with showDeletedEnterprises class
    document.getElementsByClassName("showDeletedEnterprises").forEach(function (showDeletedEnterprises) {
        // on click, we show all hidden people on enterprise
        showDeletedEnterprises.addEventListener("click", function (event) {
            var enterprisesElem = showDeletedEnterprises.parentElement;
            var enterprisesElems = enterprisesElem.querySelectorAll(".enterprise.d-none");
            enterprisesElems.forEach(function (elem) {
                elem.classList.remove("d-none");
            });
            showDeletedEnterprises.classList.add("d-none");
        });
    });
});

/***/ })

/******/ });