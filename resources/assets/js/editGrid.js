/**
 * Created by Julien.RICHOZ on 16.01.2018.
 * Modified: 24.01.2018
 * Contact: julien.richoz@cpnv.ch

Description: Jquery/Ajax file to modify dynamically the fields in the view via the controller "EditGridController.php"
 */


// Verification of data entries in Input field
$(":input").keyup(function(){
    var value = $(this).val();
    var currentName = $(this).attr('name');

    // Check in which field we are
    // Then verify the input value
    // If OK active the "OK" button If Not disactive it.
    switch(currentName){

        case 'sectionName':
            if(value.length > 45){
                $(this).nextAll().eq(1).prop('disabled', true);
                $(this).prev().prop('hidden', false);
            }
            else{
                $(this).nextAll().eq(1).prop('disabled', false);
                $(this).prev().prop('hidden', true);
            }
            break;

        case 'criteriaName':
            if(value.length > 45){
                $(this).nextAll().eq(1).prop('disabled', true);
            }
            else{
                $(this).nextAll().eq(1).prop('disabled', false);
            }
            break;

        case 'criteriaDetails':
            if(value.length > 1000){
                $(this).nextAll().eq(1).prop('disabled', true);
            }
            else{
                $(this).nextAll().eq(1).prop('disabled', false);
            }
            break;

        // Add new Section | Max char: 45
        case 'newSectionName':
            if(value.length > 45 || value.length < 1 ){
                $('#addNewSections').prop('disabled', true);
            }
            else{
                $('#addNewSections').prop('disabled', false)
            }
            break;

        case 'maxPoints':
            if(($.isNumeric(value) && value >= 0) || value == ""){
                $(this).nextAll().eq(1).prop('disabled', false);
            }
            else{
                $(this).nextAll().eq(1).prop('disabled', true);
            }
            break;
    }
});

$(document).ready(function() {

    // Click on edit: show Button OK + input field and hide button Edit
    $('.btn-detail').click(function(){
        $(this).addClass("hidden")              // hide Edit button
        $(this).next().removeClass("hidden")    // Show OK button
        $(this).prev().show()                   // Show input field
        $(this).prevAll().eq(2).hide()          // hide span text
    });



    // Click on OK:
    // Save Data in DB, hide "OK" button + input field and show "Edit" button
    $('.btn-success').click(function(){
        var newValue = $(this).prevAll().eq(1)["0"].value   // Value entered by the user (input)
        var field =$(this).prevAll().eq(3)["0"].title       // Field for Database (sectionName, criteriaName etc.)
        var id=$(this)["0"].value;                          // ID of the element to modify in Database
        var span = $(this).prevAll().eq(3).show()           // Text to show in the view
        var nameEl = $(this).attr('name');                  // To know with which table in DB we have to work (section->evaluationSections table ; criteria or maxPoints -> criterias table

        $(this).addClass("hidden")              // hide OK button
        $(this).prev().removeClass("hidden")    // show Edit button
        $(this).prevAll().eq(3).show()          // show span text
        $(this).prevAll().eq(1).hide()          // hide input element

        var params = {
            type: "POST",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        };

        // Working with criterias table
        if(nameEl == 'criteria' || nameEl == 'maxPoints'){
            params.url = "/editGrid/editCriteria";
            params.data = {'id' : id, 'field' : field, 'newValue' : newValue};
        }

        // Working with evaluationSections table
        if(nameEl == 'section'){
            params.url = "/editGrid/editSection";
            params.data = {'id' : id, 'field' : field, 'newValue' : newValue};
        }

        $.ajax(params).then(function(data){
            if(data == "yes"){
                span.text(newValue);
                // windows.location.reload();
            }
            if(data == "no"){
                alert("error");
            }
        });
    });



    //Remove Criteria in DB + view
    $('.btn-delete').click(function(){
        var delBtn = $(this).attr('id');
        var id = delBtn.match(/_([^ ]*)/)[1];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/editGrid/removeCriteria",
            data: {'id' : id},

            success: function(data){
                if(data == "yes"){
                    $('#rowCriteria_'+id).remove();

                }
                if(data == "no"){
                    alert("Can't delete the row");
                }
            }
        })
    })



    //Remove a Section in DB + view
    $('.deleteAllSection').click(function(){
        var delBtn = $(this).attr('id');
        var id = delBtn.match(/_([^ ]*)/)[1];

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/editGrid/removeSection",
            data: {'id' : id},

            success: function(data){
                // Remove all block's section
                if(data == "yes"){
                    $('#rmBlockSection_'+id).remove();
                    $('#rmSection_'+id).remove();
                    $('#rmSpanSection_'+id).remove();
                    $(this).remove(); //remove button "Delete this Section
                }
                if(data == "no"){
                    alert("Can't delete the Section");
                }
            }
        })
    })



    //Add New Criteria
    //On click: Show input field with button Cancel
    $('.addCriteria').click(function(){
        var addBtn = $(this).attr('id');
        var id = addBtn.match(/_([^ ]*)/)[1];

        $(this).addClass("hidden");
        $('#text_'+id).show();
        $('#cancelCritOk_'+id).removeClass('hidden');
        $('#addCritOk_'+id).prop('disabled', true);
        $('#CancelCritOk_'+id).show();
    })


    //Show button "Ajouter" if value in input
    $(".textAddCriteria").keyup(function(){
        var addBtn = $(this).attr('id');
        var id = addBtn.match(/_([^ ]*)/)[1];
        var newValue = $(this).val();

        if(newValue.length >= 1){
            $('#addCritOk_'+id).removeClass('hidden');
            $('#addCritOk_'+id).prop('disabled', false);
        }
        else{
            $('#addCritOk_'+id).addClass('hidden');
        }
    });


    //Cancel Button for section "Add New Criteria"
    //On Click: hide the input and cancel the value typed inside. Show the button "Add New Criteria"
    $('.cancelCr').click(function(){
        var cancelBtn = $(this).attr('id');
        var id = cancelBtn.match(/_([^ ]*)/)[1];

        $('#text_'+id).val('');
        $('#text_'+id).hide();
        $('#addCritOk_'+id).addClass("hidden");
        $('#addCriteria_'+id).removeClass("hidden");
        $(this).addClass("hidden");



    })


    //Add New Criteria into DB
    $('.addCrDB').click(function(){
        var addBtn = $(this).attr('id');
        var id = addBtn.match(/_([^ ]*)/)[1];
        var newValue = $('#text_'+id).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "/editGrid/addCriteria",
            data: {'idSection' : id, 'newValue' : newValue},

            success: function(data){
                if(data == "yes"){
                    window.location.reload();
                    //$('#rowCriteria_'+id).remove();
                }
                if(data == "no"){
                    alert("Can't delete the Section");
                }
            }
        })
    })
})