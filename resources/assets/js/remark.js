$(document).ready(function(){
   $('#cmdedit').click(function(){
       $('#remedit').removeClass('hidden');
       $('#remdisplay').addClass('hidden');
       $('#cmdedit').addClass('hidden');
   });

    $("#addNewRemark").click(function(){
        $("#newRemarkForm").toggle();
        $("#addRemark").hide();
    });
});