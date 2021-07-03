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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/internshipreport.js":
/*!*************************************************!*\
  !*** ./resources/assets/js/internshipreport.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var simpleMde = null;
var selectedStatus;
$(function () {
  selectedStatus = $("#status option:selected").text(); // Edit

  $("button[name='edit']").on("click", function () {
    // Hide all edit buttons
    $("button[name='edit']").attr("hidden", true); // Hide all delete buttons

    $("button[name='delete']").attr("hidden", true); // Hide create button

    $("button[name='create']").attr("hidden", true); // Show save and cancel buttons

    $(this).parent().find("button[name='cancel']").removeAttr("hidden");
    $(this).parent().find("button[name='save']").removeAttr("hidden"); // Show the text area and the input

    $(this).parents("form").find("textarea").removeAttr("hidden");
    $(this).parents("form").find("input[type=text]").removeAttr("hidden"); // Hide the rendered input and textarea

    $(this).parents("form").find(".input-rendering").attr("hidden", true);
    $(this).parents("form").find(".description-rendering").attr("hidden", true); // Get the closest textarea and make it wysiwyg editable

    setupSimpleMde($(this).parents("form").find("textarea").get(0));
  }); // Cancel edit

  $("button[name='cancel']").on("click", function () {
    closeSimpleMde(); // Show all edit buttons

    $("button[name='edit']").removeAttr("hidden"); // Show all delete buttons

    $("button[name='delete']").removeAttr("hidden"); // Hide create button

    $("button[name='create']").removeAttr("hidden", true); // Hide the new section

    $("#newSection").attr("hidden", true); // Hide save and cancel buttons

    $(this).parent().find("button[name='cancel']").attr("hidden", true);
    $(this).parent().find("button[name='save']").attr("hidden", true);
    $(this).parents("form").find("input[type=text]").val($(this).parents("form").find("input[type=text]").attr("value")); // Set the textarea with its initial value

    $(this).parents("form").find("textarea").val($(this).parents("form").find(".raw-markdown").text()); // Hide the text area and the input

    $(this).parents("form").find("textarea").attr("hidden", true);
    $(this).parents("form").find("input[type=text]").attr("hidden", true); // Show the rendered input and textarea

    $(this).parents("form").find(".input-rendering").removeAttr("hidden");
    $(this).parents("form").find(".description-rendering").removeAttr("hidden");
  }); // Save

  $("section form").on("submit", function (event) {
    if (!$.trim($(this).find("input[type=text]").val())) {
      event.preventDefault();
      alert("Le champ titre ne peut pas être vide.");
    }
  }); // Create

  $("button[name='create']").on("click", function () {
    // Hide all edit buttons
    $("button[name='edit']").attr("hidden", true); // Hide create button

    $("button[name='create']").attr("hidden", true);
    $("#newSection").removeAttr("hidden");
    $("#newSection").find("button[name='edit']").trigger("click");
  }); // Delete

  $("button[name='delete']").on("click", function () {
    var deleteConfirmed = confirm("Etes-vous sûr de vouloir supprimer cette section?");

    if (deleteConfirmed) {
      // Change laravel input to DELETE instead of PUT
      $(this).parents("form").find("input[name='_method']").attr("value", "DELETE");
      $(this).parents("form").trigger("submit");
    }
  }); // Update report status

  $("#status").on("change", function () {
    var changeConfirmed = confirm("Etes-vous sûr de vouloir changer le status du rapport? Vos données non sauvegardées seront supprimées.");

    if (changeConfirmed) {
      $(this).parent("form").trigger("submit");
    }

    $(this).val(selectedStatus);
  }); // Render the element markdown text to html

  $(".description-rendering").each(function () {
    var text = $(this).text(),
        converter = new showdown.Converter(),
        html = converter.makeHtml(text);
    $(this).html(html);
  });
});
/**
 * Wysiwyg editable
 * @param {*} element
 */

function setupSimpleMde(element) {
  simpleMde = new SimpleMDE({
    toolbar: ["heading", "heading-2", "heading-3", "|", "bold", "italic", "quote", "|", "unordered-list", "ordered-list", "|", "table", "link", "|", "preview", "side-by-side", "fullscreen"],
    element: element
  });
} // Change Wysiwyg to textarea


function closeSimpleMde() {
  simpleMde.toTextArea();
  simpleMde = null;
}

/***/ }),

/***/ 1:
/*!*******************************************************!*\
  !*** multi ./resources/assets/js/internshipreport.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/Xavier/Documents/CPNV/Modules/2020-2021/T2/MAW1.2 (T1a)/larasta/resources/assets/js/internshipreport.js */"./resources/assets/js/internshipreport.js");


/***/ })

/******/ });