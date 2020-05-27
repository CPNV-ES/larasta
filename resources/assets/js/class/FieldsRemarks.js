"use strict";

//Add remarks to fields input/select/textarea in a table
class FieldsRemarks{

    constructor(className){
        this.className = className;
    }
    
    addRemarks(){
        var elements = document.querySelectorAll(`.${this.className}`);
        elements.forEach(function(element){
            var existingRemark = false;
            var initialValue = element.value;
            element.addEventListener("change", function(ev){
                if((element.value == initialValue) && existingRemark){ //no modif
                    existingRemark.remove();
                    existingRemark = false;
                    return;
                }
                if(existingRemark){ //already displayed
                    return;
                }
                if(element.value != initialValue){
                    existingRemark = element.parentElement.parentNode.addElement("td");
                    var inputRemark = existingRemark.addElement("input", {
                        type:"text", 
                        name:`remark_${element.name}`, 
                        placeholder: "Pourquoi?"
                    });
                }
            });
        })
    }
}