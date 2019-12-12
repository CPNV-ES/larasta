
HTMLCollection.prototype.forEach = Array.prototype.forEach;
document.getElementsByName("modifycycle").forEach(function(elem){
    elem.addEventListener("click",function(event){
        var list =elem.parentNode.previousElementSibling.firstElementChild;
        console.log(list);
            if(list.disabled == true){
                list.disabled = false;
                elem.textContent = "Enregistrer";
            }else{
                list.disabled = true;
                elem.textContent = "Modifier";
            }
    })
})
document.getElementsByName("suppresscycle").forEach(function(elem){
    elem.addEventListener("click",function(event){
        elem.parentNode.parentNode.remove();
    })
})
