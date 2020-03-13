$(document).ready(function(){
   $('#btnTest').click(function(){
       $.ajax({
           url: '/remarks/ajax/add',
           type: 'post',
           data: {
               type:1,
               on:1,
               text:"Posted with Ajax for test with \n newline \n 'simple quotes', \"double quotes\" and <script>alert('injection attemp');</script>"
           },
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           dataType: 'json',
           success: function (data) {
               console.info(data);
           },
           fail: function() {
               alert( "error" );
           }

   });
   });
});