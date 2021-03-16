$(document).ready(function(){
   $('#addRemarkBtn').click(function(){
       document.getElementById("newRemarkBtnRow").setAttribute("hidden", "true");
       document.getElementById("newRemarkFormRow").removeAttribute("hidden");
       document.getElementsByName("remarkBody")[0].focus();
   });
});