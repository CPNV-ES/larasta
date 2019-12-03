// Internships.js: for main internships page
// Author: X. Carrel
// Date: Dec 2018

$(document).ready(function () {
    // Manage filter box collapse/expand
    $('#collapsedfilters').click(function () {
        $(this).addClass('hidden')
        $('#expandedfilters').removeClass('hidden')
    })
    $('#collapsefilters').click(function () { // when we click on the title (not anywhere in the form)
        $('#expandedfilters').addClass('hidden')
        $('#collapsedfilters').removeClass('hidden')
    })
})