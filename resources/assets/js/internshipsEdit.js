document.addEventListener("DOMContentLoaded", function() {
    //get the first table in form
    var table = document.querySelector("form table");

    //get all inputs, selects in our table
    var inputs = [...table.getElementsByTagName("input"), ...table.getElementsByTagName("select")];

    //when we change value on inputs we add input remark
    inputs.forEach(function(elem){
        var alreadyRemark = false;
        elem.addEventListener("change", function(ev){
            if(alreadyRemark){
                return;
            }
            alreadyRemark = true;
            var td = elem.parentElement.parentNode.addElement("td");
            var inputRemark = td.addElement("input");
            inputRemark.type="text";
            inputRemark.name = `remark_${elem.name}`;
            inputRemark.placeholder = "Pourquoi?";
        });
    });
});