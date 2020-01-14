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
                            $(this).text(1)
                        } else if (jQuery.inArray("2", items) == -1) {
                            $(this).text(2)
                        } else if (jQuery.inArray("3", items) == -1) {
                            $(this).text(3)
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

    class Wishes {
        constructor() {
            this.wishes = [];
        }

        addWish(wish) {
            this.wishes.push(wish);
        }
    }

    class Wish {
        constructor(internship_id, rank) {
            this.internship_id = internship_id;
            this.rank = rank;
        }
    }

    /**
     * Get the list of wishes of the current student user
     *
     * @returns {Wishes} container of the wishes
     */
    function getWishes() {
        let wishesContainer = new Wishes();

        $('.currentStudent').each(function () {
            let rank = $(this).text().trim();

            // we are not interested in not selected internships
            if (rank === "") {
                return
            }

            let row = $(this).parent();
            let internship_id = row.attr('data-internship-id');

            let wish = new Wish(internship_id, rank);
            wishesContainer.addWish(wish);
        });

        return wishesContainer;
    }

    /**
     * Prepare the content of the form to be sent by the student when saving their wishes
     */
    function prepareStudentData() {
        let wishes = getWishes();

        // put the json data into the choices input
        $('#choices').text(JSON.stringify(wishes));

        return true;
    }

    class Postulations {
        constructor() {
            this.postulations = [];
        }

        addPostulation(postulation) {
            this.postulations.push(postulation);
        }
    }

    class Postulation {
        constructor(wishId, isValidated) {
            this.wishId = wishId;
            this.isValidated = isValidated;
        }
    }

    /**
     * Get the list of postulations validated by the teacher
     * @returns {{}}
     */
    function getPostulations() {
        let postulations = new Postulations();

        // TODO implementation
        // foreach wish, get if postulation or not
        $('.clickableCase').each(function () {
            let wishId = $(this).attr('data-wish-id');

            // we are not interested in cases without a wish
            if (wishId === "") {
                return;
            }

            let isValidated = $(this).hasClass('postulationRequest');

            let postulation = new Postulation(wishId, isValidated);
            postulations.addPostulation(postulation);
        });

        return postulations;
    }

    function prepareTeacherData() {
        let postulations = getPostulations();

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