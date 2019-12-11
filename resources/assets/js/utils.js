// my global js (if any)

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection
//adds and include an element into another
Element.prototype.addElement = function(type, className = ""){
    var newElement = document.createElement(type); //create
    this.appendChild(newElement); //append to parent
    newElement.setAttribute('class', className); //set class name
    return newElement;
};