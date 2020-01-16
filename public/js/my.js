// my global js (if any)
var Utils={};

HTMLCollection.prototype.forEach = Array.prototype.forEach; //add foreach method on HTMLCollection
//adds and include an element into another
Element.prototype.addElement = function(type, className = ""){
    var newElement = document.createElement(type); //create
    this.appendChild(newElement); //append to parent
    newElement.setAttribute('class', className); //set class name
    return newElement;
};
/**
 * Create a Tag "a" with a mailto and execute it
 * @param to array or string with emails
 */
Utils.sendMail = function(to) {
    if (Array.isArray(to)) {
        to = to.join(";");
    }
    //compatible with chrome and firefox
    var link = document.createElement("a");
    link.href = `mailto:${to}`;
    link.click();
};