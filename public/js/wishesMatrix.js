//------------------------------------------------------------
// Benjamin Delacombaz
// version 0.6
// WishesMatrixController
// Created 18.12.2017
// Last edit 23.01.2017 by Benjamin Delacombaz
//------------------------------------------------------------

$(document).ready(function(){
    var lockTable = true;
    $('#lockTable').click(function(){
        // Test
        var col = $(this).parent().children().index($(this)) + 1;

        if(lockTable)
        {
            $(this).attr('src',"/images/open-padlock-silhouette_32x32.png");
            lockTable = false;
            $('tr td:nth-child(' + col + ')').each( function(){
                $('.clickableCase').removeClass('locked');
                ;       
            });
        }
        else
        {
            $(this).attr('src',"/images/padlock_32x32.png");
            lockTable = true;
            $('tr td:nth-child(' + col + ')').each( function(){
                $('.clickableCase').addClass('locked');
                ;       
            });
        }
    });

    $('.clickableCase').click(function(){
        // Test if table is locked
        if(!$(this).hasClass('locked'))
        {
            // Test if the current user is not a teacher
            if(!$(this).hasClass('teacher'))
            {
                var items=[];
                var col = $(this).parent().children().index($(this)) + 1;
                // Test if student has access to edit the col
                if($('.access').index() + 1 == col)
                {
                    $('tr td:nth-child(' + col + ')').each( function(){
                        //add item to array
                        items.push( $(this).text().replace(/\s/g, '') );       
                    });
                    
                    if($(this).text().replace(/\s/g, '') != "")
                    {
                        recalculateRank(col, $(this).text().replace(/\s/g, ''));
                        $(this).text("");
                    }else
                    {
                        // Else if for limit 3 choices
                        if(jQuery.inArray("1",items) == -1)
                        {
                            $(this).text(1)
                        }else if(jQuery.inArray("2",items) == -1)
                        {
                            $(this).text(2)
                        }else if(jQuery.inArray("3",items) == -1)
                        {
                            $(this).text(3)
                        }else
                        {
                            // View The toast message
                            $('.alert-info').text("Vous ne pouvez que 3 souhaits.");
                            $('.alert-info').removeClass('hidden');
                            cleanMessage();
                        }
                    }
                }
                else
                {
                    // View The toast message
                    $('.alert-info').text("Vous n'avez pas le droit de modifier les souhaits d'un autre élève.");
                    $('.alert-info').removeClass('hidden');
                    cleanMessage();
                }
            }
            else
            {
                // Teacher function
                // Test if had already a postulation
                if($(this).hasClass('postulationRequest'))
                {
                    $(this).removeClass('postulationRequest');
                    $(this).addClass('postulationDone');
                }
                else if($(this).hasClass('postulationDone'))
                {
                    $(this).removeClass('postulationDone');
                }
                else
                {
                    $(this).addClass('postulationRequest');
                }
            }
        }
        else
        {
            // View The toast message
            $('.alert-info').text("Le tableau est bloquer en édition.");
            $('.alert-info').removeClass('hidden');
            cleanMessage();
        }
    });

    // Recalculate rank
    function recalculateRank(col, nbRemove)
    {
        // Do that for each row in col
        $('tr td:nth-child(' + col + ')').each( function(){
            //add item to array
            if($(this).text().replace(/\s/g, '') != "")
            {
                switch(nbRemove)
                {
                    case "1":
                    // Change 2 to 1 and 3 to 2
                        if($(this).text().replace(/\s/g, '') == "2")
                        {
                            $(this).text("1");
                        }
                        if($(this).text().replace(/\s/g, '') == "3")
                        {
                            $(this).text("2"); 
                        }
                        break;
                    case "2":
                        // Change 3 to 2
                        if($(this).text().replace(/\s/g, '') == "3")
                        {
                            $(this).text("2"); 
                        }
                        break;
                    default:
                        // Do nothing
                }
            }     
         });
    }
    // Event when change on date picker
    $('#dateEndChoices').change(function(){
        var dateNow = new Date();
        var dateWritted = new Date($('#dateEndChoices').val());
        if(dateWritted <= dateNow)
        {
            // View The toast message
            $('.alert-info').text("La date se trouve dans le passé.");
            $('.alert-info').removeClass('hidden');
            cleanMessage();
        }
    });

    // TODO debug, perseError of data
    // Event when click on save button
    $('#save').click(function(){
        // Construct object to send
        var data = {
            date: $('#dateEndChoices').val(),
            displayYear: $('#flockYear').val()
        };
        console.log(data);
        $.ajax({
            url: '/wishesMatrix',
            method: 'post',
            data: data,
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function(code_html, statut){ // code_html contient le HTML renvoyé
                alert('La modification a été effectuée avec succès')
            },
            error : function(result, statut, error){
                console.log(result)
                console.log(statut)
                console.log(error)
            }
        });
    });

    // Clean message box
    function cleanMessage()
    {
        $(".alert-info").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-info").slideUp(500);
        });
    }
 });