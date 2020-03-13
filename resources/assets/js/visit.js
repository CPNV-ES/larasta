$(document).ready(function(){
    $('#bmail').click(function(){

        var email = $("input[name='email']").val();
        var visit = $("input[name='visit']").val();
        var firstname = $("input[name='firstn']").val();
        var lastname = $("input[name='lastn']").val();

        var mailto_link = 'mailto:' + email + '?subject=Stagiaire '+lastname+', '+firstname+'&body=Bonjour,%0D%0DDescription';

        var url = '/visits/'+visit+'/mail';

        location.href = mailto_link;
        window.setTimeout(function(){ location.href = url },  1000);
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
        $('#checkm').val(this.checked ? 1 : 0);
    });
});