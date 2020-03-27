/**
 * Title : synchro.js
 * Author : Steven Avelino
 * Creation Date : 16 January 2018
 * Modification Date : 23 January 2018
 * Version : 1.0
 * JS file for the synchro view
 */

/**
 * JQuery function to show the loading message before submitting the form
 */

$(".formModify").submit(function(){
    $(".messageLoading").show();
    return true;
})

/**
 * JQuery function to check or uncheck all checkboxes of the new people table
 */

 let statusAdd = 0;

$(".selectAdd").click(function(event){
    /// Needed to add this line to prevent the page to reload when this even was called
    event.preventDefault();
    if (statusAdd == 0)
    {
        $("input[name='addCheck[]']").each(function(){
            $(this).prop('checked', false);
        })
        $(".selectAdd").html("Check All");
        statusAdd = 1;
    }
    else
    {
        $("input[name='addCheck[]']").each(function(){
            $(this).prop('checked', true);
        })
        $(".selectAdd").html("Uncheck All");
        statusAdd = 0;
    }
})

/**
 * JQuery function to check or uncheck all checkboxes of the obsoloete people table
 */

 let statusDelete = 0;

$(".selectDelete").click(function(event){
    /// Needed to add this line to prevent the page to reload when this even was called
    event.preventDefault();
    if (statusDelete == 0)
    {
        $("input[name='deleteCheck[]']").each(function(){
            $(this).prop('checked', false);
        })
        $(".selectDelete").html("Check All");
        statusDelete = 1;
    }
    else
    {
        $("input[name='deleteCheck[]']").each(function(){
            $(this).prop('checked', true);
        })
        $(".selectDelete").html("Uncheck All");
        statusDelete = 0;
    }
})