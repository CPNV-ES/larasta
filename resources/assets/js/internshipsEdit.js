document.addEventListener("DOMContentLoaded", function() {
    //get the first table in form
    var table = document.querySelector("form table");

    //get all inputs, selects in our table
    var inputs = table.querySelectorAll("input, select");

    //when we change value on inputs we add input remark
    inputs.forEach(function(elem){
        var td = false;
        var initialValue = elem.value;
        elem.addEventListener("change", function(ev){
            if(elem.value === initialValue && td){ //no modif
                td.remove();
                td = false;
                return;
            }
            if(td){ //already displayed
                return;
            }
            td = elem.parentElement.parentNode.addElement("td");
            var inputRemark = td.addElement("input");
            inputRemark.type="text";
            inputRemark.name = `remark_${elem.name}`;
            inputRemark.placeholder = "Pourquoi?";
        });
    });
});