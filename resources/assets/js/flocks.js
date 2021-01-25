$(document).ready(function () {
    $(".flock-head-row").click(function() {
        $(this).next().toggleClass('folded');
    });
})