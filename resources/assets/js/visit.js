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

    $('#editMode').click(function(){
        $('.edit').css("display", "");
        $('.show').css("display", "none");
        $('input').prop('disabled', false);
        $('select').prop('disabled', false);
        $('#addRemark').prop('hidden', false);

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