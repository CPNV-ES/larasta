
class InternshipEdit {
    constructor() {
        this.eventTriggers = {};
        document.addEventListener("DOMContentLoaded", evt => this._onload(evt));
    }
    _onload(evt) {
        this.setupInternSelect();
        this.setupVisitSection();
        this.setupSimpleMDE();
        this.setupRemarks();
    }
    setupRemarks() {
        //-------------------------------------------------
        //  add remarks dynamically 
        //-------------------------------------------------
        var fieldsRemarks = new FieldsRemarks('remark')
        fieldsRemarks.addRemarks();
        
        //add intern remark
        var {onChange} = fieldsRemarks.addCustomRemark({
            input: internSelector,
            onDiff(){
                internRemark.setAttribute("name", internRemark.dataset.name);
                internRemark.classList.remove("none");
            },
            onSame(){
                internRemark.removeAttribute("name");
                internRemark.classList.add("none");
            }
        });
        this.eventTriggers.onInternChange = onChange;
    }
    setupSimpleMDE(){
        var simplemde = new SimpleMDE({
            toolbar: ["heading", "heading-2", "heading-3", "|", "bold", "italic", "quote", "|", "unordered-list", "ordered-list", "|", "table", "link", "|", "preview", "side-by-side", "fullscreen"],
            element: document.getElementById("description")
        });
        simplemde.codemirror.on('change', function () {
            description.value = simplemde.value();
            var event = new Event('change');
            description.dispatchEvent(event);
        });
    }
    setupVisitSection() {
        //-------------------------------------------------
        //  show create new visit section
        //-------------------------------------------------

        document.querySelector(".buttonNewVisit").addEventListener("click", (event) => {
            showNewVisit.classList.remove("none")
        });

        //-------------------------------------------------
        //  remove create new visit section
        //-------------------------------------------------

        document.querySelector(".darken-background").addEventListener("click", (event) => {
            showNewVisit.classList.add("none")
        });

        //-------------------------------------------------
        //  update visit on changes
        //-------------------------------------------------
        visitsForm.querySelectorAll('tr').forEach(elem => {
            elem.addEventListener('change', async event => {
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
                if (!number || !day || !hour || !grade)
                    return

                try {
                    //send to route the information in json format
                    var result = await fetch(route, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf
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
                    if (!result.ok) {
                        throw "Incomplete data !";
                    }
                }
                catch (error) {
                    this.displayElem(visitsForm.parentElement.querySelector('.error'), 100000, "Une erreur inconnue est survenue, veuillez raffraîchir la page...");
                }
            });
        });
    }
    displayElem(elem, time, message) {
        //show the element                
        elem.classList.remove("none");
        //disable the element
        setTimeout(function () {
            elem.classList.add("none");
        }, time);

        if (message)
            elem.textContent = message;
    }

    setupInternSelect() {
        internYearSelector.addEventListener("change", evt => {
            var year = internYearSelector.value;
            this.loadYearStudents(year);
            Cookies.set("lastSelectedYear", year);
        });
        //first load
        this.loadYearStudents(internYearSelector.value);
    }
    async loadYearStudents(year) {
        console.log(`load students for year 20${year}`);
        //loader
        internYearSelector.disabled = true;
        internSelector.disabled = true;
        internSelector.removeChilds();
        var loader = internSelector.addElement("option", { disabled: true, _text: "Chargement...", value: internSelector.getAttribute("value")});
        //call
        var students = await Utils.callApi(getPeopleRoute, { query: { flockYear: year } });
        internYearSelector.disabled = false;
        if (!students) {
            Utils.infoBox("Une erreur est survenue pendant le chargement des élèves");
            return;
        }
        //build
        var nonAttributedOption = internSelector.addElement("option", { value: 0, _text: "Non attribué" });
        var noStudentAvailible = true;
        students.forEach(student => {
            let currentOption = internSelector.addElement("option", { value: student.id, _text: `${student.firstname} ${student.lastname}` });

            if (student.id == selectedInternId) {
                currentOption.selected = true;
                noStudentAvailible = false;
            }
        });
        if(noStudentAvailible){
            nonAttributedOption.selected = true;
        }
        loader.remove();
        internSelector.disabled = false;
        this.eventTriggers.onInternChange();
    }
}
var internshipEdit = new InternshipEdit();