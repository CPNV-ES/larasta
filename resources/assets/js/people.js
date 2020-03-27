// Functions for people page

$(document).ready(function(){
    $('.popupfield').addClass('hidden');
    $('#btn-add-section').click(function() {
        $('#btn-add-section').addClass('hidden');
        $('.popupfield').removeClass('hidden');
    });
    $('#newcontact').change(function(){
        validateAdd();
    });
    $("input[name='contacttype']").click(function(){
        validateAdd();
    });
    // automatically change company when a choice is made
    $('#dpdCompany').change(function(){
        $('#frmCompany').submit();
    });
});

function validateAdd()
{
    // Make sure the submit button is available only with at least plausible info, i.e: something in value field and one radio button checked
    if ($('#newcontact').val().length > 0 && $("input[name='contacttype']:checked").length > 0)
        $('#cmdAdd').removeClass('hidden');
    else
        $('#cmdAdd').addClass('hidden');
}
