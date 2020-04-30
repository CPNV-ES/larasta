document.addEventListener("DOMContentLoaded", function() {
    //-------------------------------------------------
    //  add remarks dynamically 
    //-------------------------------------------------
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
            var inputRemark = td.addElement("input", {
                type:"text", 
                name:`remark_${elem.name}`, 
                placeholder: "Pourquoi?"
            });
        });
    });
    
    //-------------------------------------------------
    //  show update visit button when 
    //-------------------------------------------------
    visitsForm.querySelectorAll('tr').forEach( elem => {
        elem.addEventListener('change', async  event => {
            //get required data
            var csrf = document.querySelector('meta[name="csrf-token"]').content;
            var route = elem.querySelector('[name="route"]').value
            var visitId = elem.querySelector('[name="id"]').value
            var number = elem.querySelector('[name="number"]').value
            var day = elem.querySelector('[name="day"]').value
            var hour = elem.querySelector('[name="hour"]').value
            var mailstate = elem.querySelector('[name="mailstate"]').checked
            var confirmed = elem.querySelector('[name="confirmed"]').checked
            var grade = elem.querySelector('[name="grade"]').value
            var visitsstates = elem.querySelector('[name="visitsstates_id"]').value

            //no call server when data is empty
            if(!number || !day || !hour || !grade)
                return

            try
            {
                //send to route the information in json format
                var result = await fetch(route,{
                    headers: {                        
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN' : csrf
                    },
                    credentials: "same-origin",
                    method: "PUT",
                    body: JSON.stringify({
                        id: visitId,
                        number: number,
                        day: day,
                        hour: hour,
                        mailstate: mailstate,
                        confirmed: confirmed,
                        grade: grade,
                        visitsstates_id: visitsstates
                    })
                });
                if(!result.ok)
                {
                    throw "Incomplete data !";
                }
            }
            catch (error)
            {
                displayElem(visitsForm.parentElement.querySelector('.error'), 100000, "Une erreur inconnue est survenue, veuillez raffraîchir la page...");
            }
        });
    });
});

function displayElem(elem, time, message)
{    
    //show the element                
    elem.classList.remove("none");
    //disable the element
    setTimeout(function () {                    
        elem.classList.add("none");
    }, time);

    if (message)
        elem.textContent = message;
}