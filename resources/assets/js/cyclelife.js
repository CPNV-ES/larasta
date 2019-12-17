
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
}


