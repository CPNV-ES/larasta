
Status = [...document.getElementsByClassName("selected")];

lockTable.addEventListener("click",function(event){
    if(lockTable.className == "lock" ){
        lockTable.src = "/images/open-padlock-silhouette_32x32.png";
        unlock();
        
    }else if(lockTable.className == "unlock"){
        lockTable.src = "/images/padlock_32x32.png";
        lock();
    }
    lockTable.classList.toggle("lock");
    lockTable.classList.toggle("unlock");
})

function lock(){
    document.getElementsByName("cell").forEach(function(elem){
        elem.removeEventListener("click",toggleSelected);
    })
}

function unlock(){
    document.getElementsByName("cell").forEach(function(elem){
        elem.addEventListener("click",toggleSelected);
    })
}

function toggleSelected(event){
    event.target.classList.toggle("selected");
    save();
}

Submit.addEventListener("click",get);

function save(){
    DifferentStatus = document.getElementsByClassName("selected");
    console.log(DifferentStatus);
    console.log(Status);
    for(var i=0;i<DifferentStatus.length;i++){
        if(DifferentStatus[i] != Status[i]){
            Submit.classList.remove("d-none");
            break;
        }
        Submit.classList.add("d-none");
    }
}

function get(){
    DataArray = {};
    document.getElementsByClassName("selected").forEach(function(elem){
        Lifecicle = {from : elem.getAttribute("data-from"), to : elem.getAttribute("data-to")};
        DataArray.push(Lifecicle);
    });
    $.ajax({
        url:'/api/editlifecycle',
        type: 'POST',
        dataType:'json',
        contentType: 'json',
        data: JSON.stringify(DataArray),
        contentType: 'application/json; charset=utf-8',
    });
}

