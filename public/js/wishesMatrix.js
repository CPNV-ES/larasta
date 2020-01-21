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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ 17:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(18);


/***/ }),

/***/ 18:
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

$(document).ready(function () {
    // save if the table is locked or not
    var lockTable = true;

    /**
     * Click functionality of the lockTable button
     * - If table is locked : unlock table
     * - If table is unlocked : unlock table
     */
    $('#lockTable').click(function () {

        var col = $(this).parent().children().index($(this)) + 1;

        if (lockTable) {
            // Change icon of button
            $(this).attr('src', "/images/open-padlock-silhouette_32x32.png");

            // Lock every case of the table
            $('tr td:nth-child(' + col + ')').each(function () {
                $('.clickableCase').removeClass('locked');
            });

            lockTable = false;
        } else {
            // Change icon of button
            $(this).attr('src', "/images/padlock_32x32.png");

            // Unlock every case of the table
            $('tr td:nth-child(' + col + ')').each(function () {
                $('.clickableCase').addClass('locked');
            });

            lockTable = true;
        }
    });

    /**
     * Click functionality of the clickable cases
     */
    $('.clickableCase').click(function () {
        // Test if table is locked
        if (!$(this).hasClass('locked')) {
            // Test if the current user is not a teacher
            if (!$(this).hasClass('teacher')) {
                var items = [];
                var col = $(this).parent().children().index($(this)) + 1;
                // Test if student has access to edit the col
                if ($('.access').index() + 1 == col) {
                    $('tr td:nth-child(' + col + ')').each(function () {
                        //add item to array
                        items.push($(this).text().replace(/\s/g, ''));
                    });

                    if ($(this).text().replace(/\s/g, '') != "") {
                        recalculateRank(col, $(this).text().replace(/\s/g, ''));
                        $(this).text("");
                    } else {
                        // Else if for limit 3 choices
                        if (jQuery.inArray("1", items) == -1) {
                            $(this).text(1);
                        } else if (jQuery.inArray("2", items) == -1) {
                            $(this).text(2);
                        } else if (jQuery.inArray("3", items) == -1) {
                            $(this).text(3);
                        } else {
                            // View The toast message
                            $('.alert-info').text("Vous ne pouvez avoir que 3 souhaits.");
                            $('.alert-info').removeClass('hidden');
                            cleanMessage();
                        }
                    }
                } else {
                    // View The toast message
                    $('.alert-info').text("Vous n'avez pas le droit de modifier les souhaits d'un autre élève.");
                    $('.alert-info').removeClass('hidden');
                    cleanMessage();
                }
            } else {
                // Teacher function
                // Test if had already a postulation
                if ($(this).hasClass('postulationRequest')) {
                    $(this).removeClass('postulationRequest');
                } else {
                    $(this).addClass('postulationRequest');
                }
            }
        } else {
            // View The toast message
            $('.alert-info').text("Le tableau est bloqué en édition.");
            $('.alert-info').removeClass('hidden');
            cleanMessage();
        }
    });

    $('#choicesForm').submit(function () {
        return prepareStudentData();
    });

    $('#postulationsForm').submit(function () {
        return prepareTeacherData();
    });

    /**
     * Recalculate the rank in a column, when a wish has been removed
     * @param col column whose ranks must be recalculated
     * @param nbRemove rank removed
     */
    function recalculateRank(col, nbRemove) {
        // Do that for each row in col
        $('tr td:nth-child(' + col + ')').each(function () {
            //add item to array
            if ($(this).text().replace(/\s/g, '') != "") {
                switch (nbRemove) {
                    case "1":
                        // Change 2 to 1 and 3 to 2
                        if ($(this).text().replace(/\s/g, '') == "2") {
                            $(this).text("1");
                        }
                        if ($(this).text().replace(/\s/g, '') == "3") {
                            $(this).text("2");
                        }
                        break;
                    case "2":
                        // Change 3 to 2
                        if ($(this).text().replace(/\s/g, '') == "3") {
                            $(this).text("2");
                        }
                        break;
                    default:
                    // Do nothing
                }
            }
        });
    }

    var Wishes = function () {
        function Wishes() {
            _classCallCheck(this, Wishes);

            this.wishes = [];
        }

        _createClass(Wishes, [{
            key: 'addWish',
            value: function addWish(wish) {
                this.wishes.push(wish);
            }
        }]);

        return Wishes;
    }();

    var Wish = function Wish(internship_id, rank) {
        _classCallCheck(this, Wish);

        this.internship_id = internship_id;
        this.rank = rank;
    };

    /**
     * Get the list of wishes of the current student user
     *
     * @returns {Wishes} container of the wishes
     */


    function getWishes() {
        var wishesContainer = new Wishes();

        $('.currentStudent').each(function () {
            var rank = $(this).text().trim();

            // we are not interested in not selected internships
            if (rank === "") {
                return;
            }

            var row = $(this).parent();
            var internship_id = row.attr('data-internship-id');

            var wish = new Wish(internship_id, rank);
            wishesContainer.addWish(wish);
        });

        return wishesContainer;
    }

    /**
     * Prepare the content of the form to be sent by the student when saving their wishes
     */
    function prepareStudentData() {
        var wishes = getWishes();

        // put the json data into the choices input
        $('#choices').text(JSON.stringify(wishes));

        return true;
    }

    var Postulations = function () {
        function Postulations() {
            _classCallCheck(this, Postulations);

            this.postulations = [];
        }

        _createClass(Postulations, [{
            key: 'addPostulation',
            value: function addPostulation(postulation) {
                this.postulations.push(postulation);
            }
        }]);

        return Postulations;
    }();

    var Postulation = function Postulation(wishId, studentId, internshipId, isValidated) {
        _classCallCheck(this, Postulation);

        this.wishId = wishId;
        this.studentId = studentId;
        this.internshipId = internshipId;
        this.isValidated = isValidated;
    };

    /**
     * Get the list of postulations validated by the teacher
     * @returns {Postulations}
     */


    function getPostulations() {
        var postulations = new Postulations();

        // foreach wish, get if postulation or not
        $('.clickableCase').each(function () {
            var wishId = $(this).attr('data-wish-id');
            var studentId = $(this).attr('data-student-id');
            var internshipId = $(this).attr('data-internship-id');
            var isValidated = $(this).hasClass('postulationRequest');

            var postulation = new Postulation(wishId, studentId, internshipId, isValidated);
            postulations.addPostulation(postulation);
        });

        return postulations;
    }

    function prepareTeacherData() {
        var postulations = getPostulations();

        // put the json data into the postulations input
        $('#postulations').text(JSON.stringify(postulations));

        return true;
    }

    /**
     * Remove the alert-info
     */
    function cleanMessage() {
        $(".alert-info").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert-info").slideUp(500);
        });
    }
});

/***/ })

/******/ });