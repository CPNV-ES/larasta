//------------------------------------------------------------
// Nicolas Henry
// SI-T1a
// reconstages.js
//------------------------------------------------------------

$(document).ready(function(){
    $("#check").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });


    $('input').on('click',function () {
        if ($('td').is(':checked')) {
            $('#reconduire').css('display', 'inline-block');
        } else {
            $('#reconduire').css('display', 'none');
        }
    });

    $('input').on('click',function () {
        if ($('.checkList').is(':checked')) {
            $('#reconduire').css('display', 'inline-block');
        } 
        else {
            $('#reconduire').css('display', 'none');
        }
    });

    $('.checkBox').on('click',function () {
        if ($('#check').is(':checked')) {
            $('#reconduire').css('display', 'inline-block');
        } 
        else {
            $('#reconduire').css('display', 'none');
        }
    });

 });