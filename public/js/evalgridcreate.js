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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/evalgridcreate.js":
/*!***********************************************!*\
  !*** ./resources/assets/js/evalgridcreate.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var sectionIdCounter = 0; // Creates and inserts to the DOM a new table containing the headers
// and necessary inputs for an editable section

function createNewSection() {
  var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
  var hasGrade = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var name = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "Nouvelle Section";
  var criteriasHeaders = getSectionColumns(type, hasGrade);
  var sectionId = sectionIdCounter++;
  var table = document.createElement("table");
  table.setAttribute("data-section-type", type);
  table.setAttribute("data-section-has-grade", hasGrade ? '1' : '0');
  table.setAttribute('data-section-clientside-id', sectionId);
  table.setAttribute("class", "larastable w-100 mb-3 evalgrid-edit");
  var typeInput = document.createElement("input");
  typeInput.setAttribute("name", "section[".concat(sectionId, "][sectionType]"));
  typeInput.setAttribute("hidden", "true");
  typeInput.setAttribute("type", "text");
  typeInput.setAttribute("value", type);
  table.appendChild(typeInput);
  var hasGradeInput = document.createElement("input");
  hasGradeInput.setAttribute("name", "section[".concat(sectionId, "][hasGrade]"));
  hasGradeInput.setAttribute("hidden", "true");
  hasGradeInput.setAttribute("type", "text");
  hasGradeInput.setAttribute("value", hasGrade ? '1' : '0');
  table.appendChild(hasGradeInput);
  var titleRow = document.createElement("tr");
  var titleHeader = document.createElement("th");
  var titleInput = document.createElement("input");
  titleHeader.setAttribute("class", "text-success");
  titleHeader.setAttribute("colspan", "100%");
  titleInput.value = name;
  titleInput.setAttribute("name", "section[".concat(sectionId, "][sectionName]"));
  titleInput.setAttribute("class", "form-control title-input");
  titleInput.setAttribute("required", "true");
  titleHeader.appendChild(titleInput);
  var deleteBtn = document.createElement("button");
  deleteBtn.setAttribute("type", "button");
  deleteBtn.setAttribute("class", "btn-delete");
  deleteBtn.addEventListener("click", function () {
    if (confirm("Supprimer la section ?")) table.remove();
  });
  deleteBtn.innerText = "X";
  titleHeader.appendChild(deleteBtn);
  titleRow.appendChild(titleHeader);
  table.append(titleRow);
  var criteriasHeadersRow = document.createElement("tr");

  for (var i = 0; i < criteriasHeaders.length; i++) {
    var h = document.createElement("th");
    var classes = "text-center";
    classes += !criteriasHeaders[i].editable ? " small-col" : "";
    h.setAttribute("class", classes);
    h.innerText = criteriasHeaders[i].label;
    criteriasHeadersRow.appendChild(h);
  }

  criteriasHeadersRow.appendChild(document.createElement("th")); // Col for the delete button

  table.appendChild(criteriasHeadersRow);
  var btnNewCriteriaRow = document.createElement("tr");
  var btnNewCriteriaCell = document.createElement("td");
  btnNewCriteriaCell.setAttribute("style", "text-align: center;");
  btnNewCriteriaCell.setAttribute("colspan", "100%");
  var btnNewCriteria = document.createElement("button");
  btnNewCriteria.innerHTML = "+ Nouveau critère";
  btnNewCriteria.setAttribute("type", "button");
  btnNewCriteria.setAttribute("class", "btn-info btn-new-criteria");
  btnNewCriteria.addEventListener("click", function () {
    return insertCriteriaRowToSectionTable(table, getNewCriteriaRow(table));
  });
  btnNewCriteriaCell.appendChild(btnNewCriteria);
  btnNewCriteriaRow.appendChild(btnNewCriteriaCell);
  table.appendChild(btnNewCriteriaRow);
  document.getElementById("sections-container").appendChild(table);
  return table;
}

function insertCriteriaRowToSectionTable(sectionTable, criteriaRow) {
  criteriaRow.classList.add("criteria-row");
  sectionTable.insertBefore(criteriaRow, sectionTable.getElementsByClassName("btn-new-criteria")[0].parentNode.parentNode);
} // Returns a <tr> containing different <td> with their inputs


function getNewCriteriaRow(sectionTable) {
  var _sectionTable$getAttr;

  var criterias = getSectionColumns(sectionTable.getAttribute("data-section-type"), sectionTable.getAttribute("data-section-has-grade") === "1");
  var sectionId = sectionTable.getAttribute("data-section-clientside-id");
  var criteriaId = parseInt((_sectionTable$getAttr = sectionTable.getAttribute("data-section-clientside-criteria-id")) !== null && _sectionTable$getAttr !== void 0 ? _sectionTable$getAttr : 0) + 1;
  sectionTable.setAttribute("data-section-clientside-criteria-id", criteriaId);
  var criteriaRow = document.createElement("tr");
  criterias.forEach(function (criteria, index) {
    var td = document.createElement("td");

    if (criteria.editable) {
      switch (criteria.type) {
        case "text":
          var textarea = document.createElement("textarea");
          textarea.setAttribute("required", "true");
          textarea.setAttribute("name", "section[".concat(sectionId, "][criteria][").concat(criteriaId, "][").concat(criteria.name, "]"));
          td.appendChild(textarea);
          break;

        case "number":
          var input = document.createElement("input");
          input.setAttribute("type", "number");
          input.setAttribute("required", "true");
          input.setAttribute("name", "section[".concat(sectionId, "][criteria][").concat(criteriaId, "][").concat(criteria.name, "]"));
          td.appendChild(input);
          td.setAttribute("class", "numberinput-col");
          break;
      }
    }

    criteriaRow.appendChild(td);
  }); // Delete button

  var td = document.createElement("td");
  td.setAttribute("class", "small-col");
  var deleteBtn = document.createElement("button");
  deleteBtn.setAttribute("type", "button");
  deleteBtn.setAttribute("class", "btn-delete");
  deleteBtn.addEventListener("click", function () {
    if (confirm("Supprimer le critère ?")) criteriaRow.remove();
  });
  deleteBtn.innerText = "X";
  td.appendChild(deleteBtn);
  criteriaRow.appendChild(td);
  return criteriaRow;
} // Returns a collection of objects containing info about the different columns for the section type


function getSectionColumns(type, hasGrade) {
  var criterias = [{
    label: "Critères",
    editable: true,
    type: "text",
    name: "criteriaName"
  }];

  if (type == 1) {
    criterias.push({
      label: "Observations attendues",
      editable: true,
      type: "text",
      name: "criteriaDetails"
    });
  } else if (type == 2) {
    criterias.push({
      label: "Tâches",
      editable: false,
      type: undefined,
      name: ""
    });
  }

  if (hasGrade) {
    criterias.push({
      label: "Points Max",
      editable: true,
      type: "number",
      name: "maxPoints"
    });
  }

  criterias.push({
    label: "Remarques resp. de stage",
    editable: false,
    type: undefined,
    name: ""
  });
  criterias.push({
    label: "Remarques du stagiaire",
    editable: false,
    type: undefined,
    name: ""
  });
  return criterias;
}

function insertCriteriaData(criteriaRow, criteriaData) {
  var sectionType = criteriaRow.parentNode.getAttribute('data-section-type');
  var sectionIsGraded = criteriaRow.parentNode.getAttribute('data-section-has-grade') == "1";
  criteriaRow.querySelector('td:nth-child(1) > textarea').textContent = criteriaData.criteriaName;

  if (sectionType == 1) {
    criteriaRow.querySelector('td:nth-child(2) > textarea').textContent = criteriaData.criteriaDetails;
  } else if (sectionType == 2) {// type 2 has "Tâches", but it is filled during the evaluation
  }

  if (sectionIsGraded) {
    var maxPointsCol = sectionType == 3 ? 2 : 3;
    criteriaRow.querySelector("td:nth-child(".concat(maxPointsCol, ") > input")).value = criteriaData.maxPoints;
  }
}

$(document).ready(function () {
  $("#newSectionModalSaveBtn").click(function () {
    var newSectionModal = $("#newSectionModal");
    var nameInput = newSectionModal.find("#new-section-name");
    var typeInput = newSectionModal.find("#new-section-type");
    var isGradedInput = newSectionModal.find("#new-section-is-graded");

    if (nameInput.val().length === 0) {
      return;
    }

    createNewSection(typeInput.val(), isGradedInput.is(':checked'), nameInput.val()); // Reset form values

    nameInput.val("");
    typeInput.val(1);
    isGradedInput.prop("checked", false);
    newSectionModal.modal('hide');
  });
  $("form").submit(function () {
    // Check that we have at least 1 section and that there are no sections with no criteria
    return $("#sections-container").length > 0 && $("#sections-container table:not(:has(.criteria-row))").length == 0;
  });
  var nameInput = document.getElementById("name");
  nameInput.addEventListener("input", function (event) {
    if (usedTemplatesNames.includes(nameInput.value)) {
      nameInput.setCustomValidity("Ce nom de template est déjà utilisé, merci d'en choisir un autre");
    } else {
      nameInput.setCustomValidity("");
    }
  });

  for (var _i = 0, _Object$entries = Object.entries(currentTemplate.evaluatuationSection); _i < _Object$entries.length; _i++) {
    var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
        sectionId = _Object$entries$_i[0],
        section = _Object$entries$_i[1];

    var sectionTable = createNewSection(section.sectionType, section["hasGrade"] == 1, section.sectionName);

    for (var _i2 = 0, _Object$entries2 = Object.entries(section.criteria); _i2 < _Object$entries2.length; _i2++) {
      var _Object$entries2$_i = _slicedToArray(_Object$entries2[_i2], 2),
          _ = _Object$entries2$_i[0],
          criteria = _Object$entries2$_i[1];

      var criteriaRow = getNewCriteriaRow(sectionTable);
      insertCriteriaRowToSectionTable(sectionTable, criteriaRow);
      insertCriteriaData(criteriaRow, criteria);
    }
  }
});

/***/ }),

/***/ 11:
/*!*****************************************************!*\
  !*** multi ./resources/assets/js/evalgridcreate.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/Xavier/Documents/CPNV/Modules/2020-2021/T2/MAW1.2 (T1a)/larasta/resources/assets/js/evalgridcreate.js */"./resources/assets/js/evalgridcreate.js");


/***/ })

/******/ });