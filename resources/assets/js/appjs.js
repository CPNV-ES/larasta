$(document).ready(function () {
    // Make pseudo-links out of table rows. Add class 'fake-link' to your row and put target URL in 'data-href' attribute
    $(".fake-link").click(function() {
        window.location = $(this).data("href");
    });

    // For messages that must disappear
    $(".willvanish").fadeTo(2000, 500).slideUp(500, function(){
        $(".willvanish").slideUp(500);
    });

    // When a checkbox with 'autosubmit' class is clicked, the form it is in is submitted
    $(".autosubmit").click(function(){
        form = $(this).parents('form:first');
        document.forms[form.attr('name')].submit();
    });

    // Accordion collapsing when clicked
    $(".accordion-head-row").click(function() {
        $(this).next().toggleClass('folded');
        $(this).children().first().toggleClass('folded');
    });
});