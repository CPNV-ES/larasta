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
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/synchro.js":
/*!****************************************!*\
  !*** ./resources/assets/js/synchro.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Title : synchro.js
 * Author : Steven Avelino
 * Creation Date : 16 January 2018
 * Modification Date : 23 January 2018
 * Version : 1.0
 * JS file for the synchro view
 */

/**
 * JQuery function to show the loading message before submitting the form
 */
$(".formModify").submit(function () {
  $(".messageLoading").show();
  return true;
});
/**
 * JQuery function to check or uncheck all checkboxes of the new people table
 */

var statusAdd = 0;
$(".selectAdd").click(function (event) {
  /// Needed to add this line to prevent the page to reload when this even was called
  event.preventDefault();

  if (statusAdd == 0) {
    $("input[name='addCheck[]']").each(function () {
      $(this).prop('checked', false);
    });
    $(".selectAdd").html("Check All");
    statusAdd = 1;
  } else {
    $("input[name='addCheck[]']").each(function () {
      $(this).prop('checked', true);
    });
    $(".selectAdd").html("Uncheck All");
    statusAdd = 0;
  }
});
/**
 * JQuery function to check or uncheck all checkboxes of the obsoloete people table
 */

var statusDelete = 0;
$(".selectDelete").click(function (event) {
  /// Needed to add this line to prevent the page to reload when this even was called
  event.preventDefault();

  if (statusDelete == 0) {
    $("input[name='deleteCheck[]']").each(function () {
      $(this).prop('checked', false);
    });
    $(".selectDelete").html("Check All");
    statusDelete = 1;
  } else {
    $("input[name='deleteCheck[]']").each(function () {
      $(this).prop('checked', true);
    });
    $(".selectDelete").html("Uncheck All");
    statusDelete = 0;
  }
});

/***/ }),

/***/ 15:
/*!**********************************************!*\
  !*** multi ./resources/assets/js/synchro.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/Xavier/Documents/CPNV/Modules/2020-2021/T2/MAW1.2 (T1a)/larasta/resources/assets/js/synchro.js */"./resources/assets/js/synchro.js");


/***/ })

/******/ });