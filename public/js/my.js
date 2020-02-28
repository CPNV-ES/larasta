<<<<<<< HEAD
// my global js (if any)
var Utils={};

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection
//adds and include an element into another
Element.prototype.addElement = function(type, className = ""){
=======
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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
<<<<<<< HEAD
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
__webpack_require__(2);
__webpack_require__(3);
__webpack_require__(4);
__webpack_require__(5);
__webpack_require__(6);
__webpack_require__(7);
__webpack_require__(8);
__webpack_require__(9);
__webpack_require__(10);
__webpack_require__(11);
__webpack_require__(12);
module.exports = __webpack_require__(13);
=======
/******/ ({
>>>>>>> feature/logbook_web_client

/***/ "./resources/assets/js/my.js":
/*!***********************************!*\
  !*** ./resources/assets/js/my.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// my global js (if any)
HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection
//adds and include an element into another

Element.prototype.addElement = function (type) {
  var className = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
  var newElement = document.createElement(type); //create

  this.appendChild(newElement); //append to parent

<<<<<<< HEAD
>>>>>>> 0263f2e007edba320a45237935a5fd2b7d344c3e
    var newElement = document.createElement(type); //create
    this.appendChild(newElement); //append to parent
    newElement.setAttribute('class', className); //set class name
    return newElement;
};

<<<<<<< HEAD

document.addEventListener("DOMContentLoaded", ()=>{
    //filters toggler (author: nicolas maitre)
    if(window.filtersBoxButton && window.expandedfilters){
        var icon = filtersBoxButton.querySelector("i");
        filtersBoxButton.addEventListener("click", function(ev){
=======
document.addEventListener("DOMContentLoaded", function () {
    //filters toggler (author: nicolas maitre)
    if (window.filtersBoxButton && window.expandedfilters) {
        var icon = filtersBoxButton.querySelector("i");
        filtersBoxButton.addEventListener("click", function (ev) {
>>>>>>> 0263f2e007edba320a45237935a5fd2b7d344c3e
            expandedfilters.classList.toggle("d-none");
            //toggle arrow
            icon.classList.toggle("down");
            icon.classList.toggle("up");
        });
    }
});
<<<<<<< HEAD
/**
 * Create a Tag "a" with a mailto and execute it
 * @param to array or string with emails
 */
Utils.sendMail = function(to) {
    if (Array.isArray(to)) {
        to = to.join(";");
    }
    //compatible with chrome and firefox
    var link = document.createElement("a");
    link.href = `mailto:${to}`;
    link.click();
};
=======
=======
  newElement.setAttribute('class', className); //set class name

  return newElement;
};

document.addEventListener("DOMContentLoaded", function () {
  //filters toggler (author: nicolas maitre)
  if (window.filtersBoxButton && window.expandedfilters) {
    var icon = filtersBoxButton.querySelector("i");
    filtersBoxButton.addEventListener("click", function (ev) {
      expandedfilters.classList.toggle("d-none"); //toggle arrow

      icon.classList.toggle("down");
      icon.classList.toggle("up");
    });
  }
});
>>>>>>> feature/logbook_web_client

/***/ }),

/***/ "./resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/documents.scss":
/*!**********************************************!*\
  !*** ./resources/assets/sass/documents.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/editGrid.scss":
/*!*********************************************!*\
  !*** ./resources/assets/sass/editGrid.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/evalGrid.scss":
/*!*********************************************!*\
  !*** ./resources/assets/sass/evalGrid.scss ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/internships.scss":
/*!************************************************!*\
  !*** ./resources/assets/sass/internships.scss ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/mpmenu.scss":
/*!*******************************************!*\
  !*** ./resources/assets/sass/mpmenu.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/people.scss":
/*!*******************************************!*\
  !*** ./resources/assets/sass/people.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/synchro.scss":
/*!********************************************!*\
  !*** ./resources/assets/sass/synchro.scss ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/travelTime.scss":
/*!***********************************************!*\
  !*** ./resources/assets/sass/travelTime.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/visits.scss":
/*!*******************************************!*\
  !*** ./resources/assets/sass/visits.scss ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/assets/sass/wishesMatrix.scss":
/*!*************************************************!*\
  !*** ./resources/assets/sass/wishesMatrix.scss ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/***/ 0:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/assets/js/my.js ./resources/assets/sass/app.scss ./resources/assets/sass/documents.scss ./resources/assets/sass/editGrid.scss ./resources/assets/sass/evalGrid.scss ./resources/assets/sass/people.scss ./resources/assets/sass/synchro.scss ./resources/assets/sass/travelTime.scss ./resources/assets/sass/visits.scss ./resources/assets/sass/wishesMatrix.scss ./resources/assets/sass/mpmenu.scss ./resources/assets/sass/internships.scss ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!(function webpackMissingModule() { var e = new Error("Cannot find module 'C:\\git\\larasta\\resources\\assets\\js\\my.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\app.scss */"./resources/assets/sass/app.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\documents.scss */"./resources/assets/sass/documents.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\editGrid.scss */"./resources/assets/sass/editGrid.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\evalGrid.scss */"./resources/assets/sass/evalGrid.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\people.scss */"./resources/assets/sass/people.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\synchro.scss */"./resources/assets/sass/synchro.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\travelTime.scss */"./resources/assets/sass/travelTime.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\visits.scss */"./resources/assets/sass/visits.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\wishesMatrix.scss */"./resources/assets/sass/wishesMatrix.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\mpmenu.scss */"./resources/assets/sass/mpmenu.scss");
module.exports = __webpack_require__(/*! C:\git\larasta\resources\assets\sass\internships.scss */"./resources/assets/sass/internships.scss");


/***/ }),

/***/ 0:
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/assets/js/my.js ./resources/assets/sass/app.scss ./resources/assets/sass/documents.scss ./resources/assets/sass/editGrid.scss ./resources/assets/sass/evalGrid.scss ./resources/assets/sass/people.scss ./resources/assets/sass/synchro.scss ./resources/assets/sass/travelTime.scss ./resources/assets/sass/visits.scss ./resources/assets/sass/wishesMatrix.scss ./resources/assets/sass/mpmenu.scss ./resources/assets/sass/internships.scss ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\git\larasta\resources\assets\js\my.js */"./resources/assets/js/my.js");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\app.scss */"./resources/assets/sass/app.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\documents.scss */"./resources/assets/sass/documents.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\editGrid.scss */"./resources/assets/sass/editGrid.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\evalGrid.scss */"./resources/assets/sass/evalGrid.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\people.scss */"./resources/assets/sass/people.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\synchro.scss */"./resources/assets/sass/synchro.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\travelTime.scss */"./resources/assets/sass/travelTime.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\visits.scss */"./resources/assets/sass/visits.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\wishesMatrix.scss */"./resources/assets/sass/wishesMatrix.scss");
__webpack_require__(/*! C:\git\larasta\resources\assets\sass\mpmenu.scss */"./resources/assets/sass/mpmenu.scss");
module.exports = __webpack_require__(/*! C:\git\larasta\resources\assets\sass\internships.scss */"./resources/assets/sass/internships.scss");


/***/ }),
/* 13 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })

<<<<<<< HEAD
/******/ });

/******/ ]);
>>>>>>> 0263f2e007edba320a45237935a5fd2b7d344c3e
=======
/******/ });
>>>>>>> feature/logbook_web_client
