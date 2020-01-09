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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

lockTable.addEventListener("click", function (event) {
    if (lockTable.className == "lock") {
        lockTable.src = "/images/open-padlock-silhouette_32x32.png";
        unlock();
    } else if (lockTable.className == "unlock") {
        lockTable.src = "/images/padlock_32x32.png";
        lock();
    }
    lockTable.classList.toggle("lock");
    lockTable.classList.toggle("unlock");
});

function lock() {
    document.getElementsByName("cell").forEach(function (elem) {
        elem.removeEventListener("click", toggleSelected);
    });
    document.getElementsByName("title").forEach(function (elem) {
        elem.disabled = true;
    });
    save();
}

function unlock() {
    document.getElementsByName("cell").forEach(function (elem) {
        elem.addEventListener("click", toggleSelected);
    });
    document.getElementsByName("title").forEach(function (elem) {
        elem.disabled = false;
    });
    save();
}

function toggleSelected(event) {
    event.target.classList.toggle("selected");
}

Submit.addEventListener("click", get);

function save() {
    Submit.classList.toggle("d-none");
}

function get() {
    var _$$ajax2;

    DataArrayCell = [];
    document.getElementsByClassName("selected").forEach(function (elem) {
        Lifecicle = { from: elem.getAttribute("data-from"), to: elem.getAttribute("data-to") };
        DataArrayCell.push(Lifecicle);
    });
    DataArrayTitle = [];
    document.getElementsByName("title").forEach(function (elem) {
        Lifecicle = { value: elem.value, id: elem.getAttribute("title-id") };
        DataArrayTitle.push(Lifecicle);
    });
    $.ajax(_defineProperty({
        url: '/api/editLifecycleCell',
        type: 'POST',
        dataType: 'json',
        contentType: 'json',
        data: JSON.stringify(DataArrayCell)
    }, "contentType", 'application/json; charset=utf-8'));
    $.ajax((_$$ajax2 = {
        url: '/api/editLifecycleTitle',
        type: 'POST',
        dataType: 'json',
        contentType: 'json',
        data: JSON.stringify(DataArrayTitle)
    }, _defineProperty(_$$ajax2, "contentType", 'application/json; charset=utf-8'), _defineProperty(_$$ajax2, "success", function success(d) {}), _$$ajax2));
}

/***/ })

/******/ });