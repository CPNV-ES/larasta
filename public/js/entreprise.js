/**
 * Created by antonio.giordano on 15.01.2018.
 */

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

$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});

