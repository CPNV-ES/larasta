
document.addEventListener("DOMContentLoaded",function(){
  lockTable.addEventListener("click",function(event)
    {
        if(lockTable.className == "lock" )
        {
            lockTable.src = "/images/open-padlock-silhouette_32x32.png";
            unlockTableAccess();

        }
        else if(lockTable.className == "unlock")
        {
            lockTable.src = "/images/padlock_32x32.png";
            lockTableAccess();
        }
        lockTable.classList.toggle("lock");
        lockTable.classList.toggle("unlock");
    }
)
Submit.addEventListener("click",getDataAndSendToController);
  
});


function lockTableAccess()
{
    document.getElementsByName("cell").forEach(function(elem)
        {
        elem.removeEventListener("click",toggleSelected);
        }
    )
    document.getElementsByName("title").forEach(function(elem)
        {
        elem.disabled = true;
        }
    )
    enableButton();
}

function unlockTableAccess()
{
    document.getElementsByName("cell").forEach(function(elem)
        {
            elem.addEventListener("click",toggleSelected);
        }
    )
    document.getElementsByName("title").forEach(function(elem)
        {
            elem.disabled = false;
        }
    )
    enableButton();
}

function toggleSelected(event)
{
    event.target.classList.toggle("selected"); 
}

function enableButton()
{
    document.getElementsByTagName("button").forEach(function(elem)
        {
            elem.classList.toggle("d-none");
        }
    )
}

function getDataAndSendToController()
{
    dataArrayCell = [];
    //collect cell data and create json array
    document.getElementsByClassName("selected").forEach(function(elem)
        {
            lifeCicleCell = {from : elem.dataset.from, to : elem.dataset.to};
            dataArrayCell.push(lifeCicleCell);
        }
    );
    //collect title data and create json array
    dataArrayTitle = [];
    document.getElementsByName("title").forEach(function(elem)
        {
            lifeCicleTitle = {value : elem.value, id : elem.dataset.title};
            dataArrayTitle.push(lifeCicleTitle);
        }
    );
    $.ajax(
        {
            url:'/api/editLifecycleCell',
            type: 'POST',
            data: JSON.stringify(dataArrayCell),
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert("L'enregistrement des du changement des cellules n'a pas pu être éffectué");
            }
        }
    );
    $.ajax(
        {
            url:'/api/editLifecycleTitle',
            type: 'POST',
            data: JSON.stringify(dataArrayTitle),
            success: function()
            {
                pastLifecicle = document.getElementsByClassName("titleTable");
                pastLifecicle.forEach(function(elem, key)
                    {
                        elem.innerHTML =  dataArrayTitle[key].value;
                    }
                );
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert("L'enregistrement des du changement des titres n'a pas pu être éffectué");
            }
        }
    ); 
}

