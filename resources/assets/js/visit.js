$(document).ready(function(){
    $('#mailbutton').click(function(){
        var student = $("input[name='studentemail']").val();
        var studentFirstName = $("input[name='studentfirstname']").val();
        var studentLastName = $("input[name='studentlastname']").val();
        var responsible = $("input[name='responsibleemail']").val();
        var admin = $("input[name='adminemail']").val();

        location.href= `mailto:${student};${responsible};${admin}?subject=Stage de ${studentFirstName} ${studentLastName}&body=Bonjour,`;
        
        $('#mailbutton').prop('hidden', true);
        $('#mailcheckbox').prop('hidden', false);
        $('#checkm').prop('checked', true);
    });

    $('#edit').click(function(){
        $('.hidea').removeClass('hidden');
        $('.hideb').addClass('hidden');
    });

    $('#cancel_a').click(function(){
        $('.hidea').addClass('hidden');
        $('.hideb').removeClass('hidden');
    });

    $('#checkm').on('change', function(){
        if(this.checked) {
            $('#checkm').val(1);
        } else {
            $('#checkm').val(0);
            $('#mailbutton').prop('hidden', false);
            $('#mailcheckbox').prop('hidden', true);
        }
    });
});