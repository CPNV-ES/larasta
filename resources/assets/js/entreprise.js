/**
 * Created by antonio.giordano on 15.01.2018.
 */

$(document).ready(function(){
    $("#maps").hover(function(){
        $(this).css('cursor','pointer')
    });
    $("#remark").click(function () {
        newRemark();
    });
});

function edit() {
    $("#view").addClass("hidden");
    $("#edit").addClass("hidden");
    $("#save").removeClass("hidden");
    $("#field").removeClass("hidden");
}

function cancel() {
    $("#view").removeClass("hidden");
    $("#edit").removeClass("hidden");
    $("#save").addClass("hidden");
    $("#field").addClass("hidden");
}

function save() {
    $("#view").removeClass("hidden");
    $("#edit").removeClass("hidden");
    $("#save").addClass("hidden");
    $("#field").addClass("hidden");
}

function remove(id) {
    var r = confirm("Voulez-vous vraiment supprimer cette entreprise ?")
    if (r == true) {
        window.location.href = "/entreprise/" + id + "/remove"
    }
}

function newRemark() {
    $('#remarkBtn').addClass("hidden");
    $('#newRemark').removeClass("hidden");
}

function remarkAdd() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/entreprise/addRemarks',
        type: 'post',
        data: { 'remark': $("#remarksText").val(), 'id': $("#id").val()
        },
        success:function() {
            $('.remarksTable').find("tbody:last").append("<tr><td>"+$("#date").val()+"</td><td>"+$('#initials').val()+"</td><td>"+ $("#remarksText").val() +"</td></tr>");
        }
    })
};

