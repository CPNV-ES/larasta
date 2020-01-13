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
    document.getElementsByName("title").forEach(function(elem){
        elem.disabled = true;
    })
    save();
}

function unlock(){
    document.getElementsByName("cell").forEach(function(elem){
        elem.addEventListener("click",toggleSelected);
    })
    document.getElementsByName("title").forEach(function(elem){
        elem.disabled = false;
    })
    save();
}

function toggleSelected(event){
    event.target.classList.toggle("selected"); 
}

Submit.addEventListener("click",get);

function save(){
    Submit.classList.toggle("d-none");
}

function get(){
    DataArrayCell = [];
    document.getElementsByClassName("selected").forEach(function(elem){
        Lifecicle = {from : elem.getAttribute("data-from"), to : elem.getAttribute("data-to")};
        DataArrayCell.push(Lifecicle);
    });
    DataArrayTitle = [];
    document.getElementsByName("title").forEach(function(elem){
        Lifecicle = {value : elem.value, id : elem.getAttribute("title-id")};
        DataArrayTitle.push(Lifecicle);
    });
    $.ajax({
        url:'/api/editLifecycleCell',
        type: 'POST',
        dataType:'json',
        contentType: 'json',
        data: JSON.stringify(DataArrayCell),
        contentType: 'application/json; charset=utf-8',
    });
    $.ajax({
        url:'/api/editLifecycleTitle',
        type: 'POST',
        dataType:'json',
        contentType: 'json',
        data: JSON.stringify(DataArrayTitle),
        contentType: 'application/json; charset=utf-8',
        success: function(){
            PastLifecicle = document.getElementsByClassName("titleTable");
            PastLifecicle.forEach(function(elem, key){
                elem.innerHTML =  DataArrayTitle[key].value;
            });
        }
    });
    

}

