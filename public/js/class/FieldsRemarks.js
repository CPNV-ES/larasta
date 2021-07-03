"use strict";
//Add remarks to fields input/select/textarea in a table
class FieldsRemarks {

    constructor(className) {
        this.className = className;
    }

    addRemarks() {
        var elements = document.querySelectorAll(`.${this.className}`);
        elements.forEach(function (element) {
            var valueProperty = (element.type == "checkbox") ? "checked" : "value";
            var existingRemark = false;
            var initialValue = element[valueProperty];
            element.addEventListener("change", function (ev) {
                if ((element[valueProperty] == initialValue) && existingRemark) { //no modif
                    existingRemark.remove();
                    existingRemark = false;
                    return;
                }
                if (existingRemark) { //already displayed
                    return;
                }
                if (element[valueProperty] != initialValue) {
                    existingRemark = element.parentElement.parentNode.addElement("td");
                    var inputRemark = existingRemark.addElement("input", {
                        type: "text",
                        name: `remark_${element.name}`,
                        placeholder: "Pourquoi?"
                    });
                }
            });
        })
    }
    addCustomRemark({ input, onDiff, onSame, eventType = "change", valueProperty = "value" }) {
        var initialValue = input[valueProperty];
        var diff = false;
        input.addEventListener(eventType, onChange);
        function onChange(evt) {
            if (initialValue == input[valueProperty] && diff) {
                onSame(evt);
                diff = false;
            } else if (input[valueProperty] != initialValue && !diff) {
                onDiff(evt);
                diff = true;
            }
        }
        return {onChange};
    }
}