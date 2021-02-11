$(document).ready(function(){
    $('#mailbutton').click(function(){
        var email = $("input[name='email']").val();
        var firstname = $("input[name='firstn']").val();
        var lastname = $("input[name='lastn']").val();

        location.href= 'mailto:' + email + '?subject=Stagiaire '+lastname+', '+firstname+'&body=Bonjour,%0D%0DDescription';
        
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