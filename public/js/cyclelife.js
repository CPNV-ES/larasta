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
/***/ (function(module, exports) {


document.addEventListener("DOMContentLoaded", function () {
    lockTable.addEventListener("click", function (event) {
        if (lockTable.className == "lock") {
            lockTable.src = "/images/open-padlock-silhouette_32x32.png";
            unlockTableAccess();
        } else if (lockTable.className == "unlock") {
            lockTable.src = "/images/padlock_32x32.png";
            lockTableAccess();
        }
        lockTable.classList.toggle("lock");
        lockTable.classList.toggle("unlock");
    });
    Submit.addEventListener("click", getDataAndSendToController);
});

function lockTableAccess() {
    document.getElementsByName("cell").forEach(function (elem) {
        elem.removeEventListener("click", toggleSelected);
    });
    document.getElementsByName("title").forEach(function (elem) {
        elem.disabled = true;
    });
    enableButton();
}

function unlockTableAccess() {
    document.getElementsByName("cell").forEach(function (elem) {
        elem.addEventListener("click", toggleSelected);
    });
    document.getElementsByName("title").forEach(function (elem) {
        elem.disabled = false;
    });
    enableButton();
}

function toggleSelected(event) {
    event.target.classList.toggle("selected");
}

function enableButton() {
    document.getElementsByTagName("button").forEach(function (elem) {
        elem.classList.toggle("d-none");
    });
}

function getDataAndSendToController() {
    dataArrayCell = [];
    //collect cell data and create json array
    document.getElementsByClassName("selected").forEach(function (elem) {
        lifeCicleCell = { from: elem.dataset.from, to: elem.dataset.to };
        dataArrayCell.push(lifeCicleCell);
    });
    //collect title data and create json array
    dataArrayTitle = [];
    document.getElementsByName("title").forEach(function (elem) {
        lifeCicleTitle = { value: elem.value, id: elem.dataset.title };
        dataArrayTitle.push(lifeCicleTitle);
    });
    $.ajax({
        url: '/api/editLifecycleCell',
        type: 'POST',
        data: JSON.stringify(dataArrayCell),
        error: function error(jqXHR, textStatus, errorThrown) {
            alert("L'enregistrement des du changement des cellules n'a pas pu être éffectué");
        }
    });
    $.ajax({
        url: '/api/editLifecycleTitle',
        type: 'POST',
        data: JSON.stringify(dataArrayTitle),
        success: function success() {
            pastLifecicle = document.getElementsByClassName("titleTable");
            pastLifecicle.forEach(function (elem, key) {
                elem.innerHTML = dataArrayTitle[key].value;
            });
        },
        error: function error(jqXHR, textStatus, errorThrown) {
            alert("L'enregistrement des du changement des titres n'a pas pu être éffectué");
        }
    });
}

/***/ })

/******/ });