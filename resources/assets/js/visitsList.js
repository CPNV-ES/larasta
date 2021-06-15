$(function () {
    $(".visit-details").on("click", function() {
        window.location = `/visits/${$(this).data("visitid")}/manage`;
    })
})