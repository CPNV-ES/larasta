
HTMLCollection.prototype.forEach = Array.prototype.forEach;
document.getElementsByName("cell").forEach(function(elem){
    elem.addEventListener("click",function(event){
        elem.classList.toggle("selected");
    })
})
