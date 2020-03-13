/**
 * Created by antonio.giordano on 10.01.2018.
 */

function addE() {
    $("#input").removeClass("hidden");
}

$(document).ready(function(){
    $("#Ctype").on("change", function(){
        $("#ctype").submit();
    });

    $("#addCompany").hover(function(){
        $(this).css('cursor','pointer')
    })

    $("#addCompany").click(function () {
        addE();
    })
});