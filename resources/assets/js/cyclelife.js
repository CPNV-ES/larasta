
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
    enableSaveButton();
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
    enableSaveButton();
}

function toggleSelected(event)
{
    event.target.classList.toggle("selected"); 
}



function enableSaveButton()
{
    Submit.classList.toggle("d-none");
}

function getDataAndSendToController()
{
    dataArrayCell = [];
    document.getElementsByClassName("selected").forEach(function(elem)
        {
            lifeCicleCell = {from : elem.getAttribute("data-from"), to : elem.getAttribute("data-to")};
            dataArrayCell.push(lifeCicleCell);
        }
    );
    dataArrayTitle = [];
    document.getElementsByName("title").forEach(function(elem)
        {
            lifeCicleTitle = {value : elem.value, id : elem.getAttribute("title-id")};
            dataArrayTitle.push(lifeCicleTitle);
        }
    );
    $.ajax(
        {
            url:'/api/editLifecycleCell',
            type: 'POST',
            dataType:'json',
            contentType: 'json',
            data: JSON.stringify(dataArrayCell),
            contentType: 'application/json; charset=utf-8',
        }
    );
    $.ajax(
        {
            url:'/api/editLifecycleTitle',
            type: 'POST',
            dataType:'json',
            contentType: 'json',
            data: JSON.stringify(dataArrayTitle),
            contentType: 'application/json; charset=utf-8',
            success: function()
            {
                pastLifecicle = document.getElementsByClassName("titleTable");
                pastLifecicle.forEach(function(elem, key)
                    {
                    elem.innerHTML =  dataArrayTitle[key].value;
                    }
                );
            }
        }
    );
    

}

