$(document).ready(function () {
    // Make pseudo-links out of table rows. Add class 'clickable-row' to your row and put target URL in 'data-href' attribute
    $(".clickable-row").click(function() {
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

    //filters toggler (author: nicolas maitre)
    if(window.filtersBoxButton && window.expandedfilters){
        filtersBoxButton.addEventListener("click", function(ev){
            expandedfilters.classList.toggle("d-none");
            //toggle arrow
            filtersBoxButton.getElementsByTagName("i")[0].classList.toggle("down");
            filtersBoxButton.getElementsByTagName("i")[0].classList.toggle("up");
        });
    }
});