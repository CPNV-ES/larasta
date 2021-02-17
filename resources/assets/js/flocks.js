$(document).ready(function () {
    $(".flock-head-row").click(function() {
        $(this).next().toggleClass('folded');
        $(this).children().first().toggleClass('folded');
    });
})