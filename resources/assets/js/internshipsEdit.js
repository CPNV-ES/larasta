document.addEventListener("DOMContentLoaded", function() {
    //-------------------------------------------------
    //  add remarks dynamically 
    //-------------------------------------------------
    //init tinymce for Description textarea
    var fieldsRemarks = new FieldsRemarks('remark')
    fieldsRemarks.addRemarks();
    
    tinymce.init({
        selector: '#txtDescription',
        inline: true,
        max_width: 500,
        skin: 'oxide-dark',
        init_instance_callback: function (editor) {
            editor.on('focusout', function(){
                description.value = tinymce.activeEditor.getContent()
                var event = new Event('change');
                description.dispatchEvent(event);
            });
        }
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