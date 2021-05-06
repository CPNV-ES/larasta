let sectionIdCounter = 0;

// Creates and inserts to the DOM a new table containing the headers
// and necessary inputs for an editable section
function createNewSection(type = 1, hasGrade = false, name = "Nouvelle Section") {
    let criteriasHeaders = getSectionColumns(type, hasGrade);
    let sectionId = sectionIdCounter++;

    let table = document.createElement("table");
    table.setAttribute("data-section-type", type);
    table.setAttribute("data-section-has-grade", hasGrade ? '1' : '0');
    table.setAttribute('data-section-clientside-id', sectionId);
    table.setAttribute("class", "larastable w-100 mb-3 evalgrid-edit");

    let typeInput = document.createElement("input");
    typeInput.setAttribute("name", `section[${sectionId}][sectionType]`)
    typeInput.setAttribute("hidden", "true");
    typeInput.setAttribute("type", "text");
    typeInput.setAttribute("value", type);
    table.appendChild(typeInput);

    let hasGradeInput = document.createElement("input");
    hasGradeInput.setAttribute("name", `section[${sectionId}][hasGrade]`)
    hasGradeInput.setAttribute("hidden", "true");
    hasGradeInput.setAttribute("type", "text");
    hasGradeInput.setAttribute("value", hasGrade ? '1' : '0');
    table.appendChild(hasGradeInput);

    let titleRow = document.createElement("tr");
    let titleHeader = document.createElement("th");

    let titleInput = document.createElement("input");
    titleHeader.setAttribute("class", "text-success");
    titleHeader.setAttribute("colspan", "100%");
    titleInput.value = name;
    titleInput.setAttribute("name", `section[${sectionId}][sectionName]`);
    titleInput.setAttribute("class", "form-control title-input");
    titleInput.setAttribute("required", "true");
    titleHeader.appendChild(titleInput);

    let deleteBtn = document.createElement("button");
    deleteBtn.setAttribute("type", "button");
    deleteBtn.setAttribute("class", "btn-delete");
    deleteBtn.addEventListener(
        "click",
        () => { if(confirm("Supprimer la section ?")) table.remove() }
    );
    deleteBtn.innerText = "X";
    titleHeader.appendChild(deleteBtn);

    titleRow.appendChild(titleHeader);
    table.append(titleRow);

    let criteriasHeadersRow = document.createElement("tr");
    for(let i = 0; i< criteriasHeaders.length; i++) {
        let h = document.createElement("th");
        let classes = "text-center";
        classes += !criteriasHeaders[i].editable ? " small-col" : "";
        h.setAttribute("class", classes);
        h.innerText = criteriasHeaders[i].label;
        criteriasHeadersRow.appendChild(h);
    }
    criteriasHeadersRow.appendChild(document.createElement("th")); // Col for the delete button
    table.appendChild(criteriasHeadersRow);

    let btnNewCriteriaRow = document.createElement("tr");
    let btnNewCriteriaCell = document.createElement("td");
    btnNewCriteriaCell.setAttribute("style", "text-align: center;");
    btnNewCriteriaCell.setAttribute("colspan", "100%");

    let btnNewCriteria = document.createElement("button");
    btnNewCriteria.innerHTML = "+ Nouveau critère";
    btnNewCriteria.setAttribute("type", "button");
    btnNewCriteria.setAttribute("class", "btn-info btn-new-criteria");
    btnNewCriteria.addEventListener(
        "click",
        () => insertCriteriaRowToSectionTable(table, getNewCriteriaRow(table))
    );

    btnNewCriteriaCell.appendChild(btnNewCriteria);
    btnNewCriteriaRow.appendChild(btnNewCriteriaCell);
    table.appendChild(btnNewCriteriaRow);

    document.getElementById("sections-container").appendChild(table);

    return table;
}

function insertCriteriaRowToSectionTable(sectionTable, criteriaRow) {
    criteriaRow.classList.add("criteria-row");
    sectionTable.insertBefore(criteriaRow, sectionTable.getElementsByClassName("btn-new-criteria")[0].parentNode.parentNode);
}

// Returns a <tr> containing different <td> with their inputs
function getNewCriteriaRow(sectionTable) {
    let criterias = getSectionColumns(
        sectionTable.getAttribute("data-section-type"),
        sectionTable.getAttribute("data-section-has-grade") === "1"
    );
    let sectionId = sectionTable.getAttribute("data-section-clientside-id");
    let criteriaId = parseInt(sectionTable.getAttribute("data-section-clientside-criteria-id") ?? 0) + 1;
    sectionTable.setAttribute("data-section-clientside-criteria-id", criteriaId);
    let criteriaRow = document.createElement("tr");

    criterias.forEach(function(criteria, index) {
        let td = document.createElement("td");
        if(criteria.editable) {
            switch(criteria.type){
                case "text":
                    let textarea = document.createElement("textarea");
                    textarea.setAttribute("required", "true");
                    textarea.setAttribute("name", `section[${sectionId}][criteria][${criteriaId}][${criteria.name}]`);
                    td.appendChild(textarea);
                    break;
                case "number":
                    let input = document.createElement("input");
                    input.setAttribute("type", "number");
                    input.setAttribute("required", "true");
                    input.setAttribute("name", `section[${sectionId}][criteria][${criteriaId}][${criteria.name}]`);
                    td.appendChild(input);
                    td.setAttribute("class", "numberinput-col");
                    break;
            }
        }
        criteriaRow.appendChild(td);
    })

    // Delete button
    let td = document.createElement("td");
    td.setAttribute("class", "small-col");
    let deleteBtn = document.createElement("button");
    deleteBtn.setAttribute("type", "button");
    deleteBtn.setAttribute("class", "btn-delete");
    deleteBtn.addEventListener(
        "click",
        () => { if(confirm("Supprimer le critère ?")) criteriaRow.remove() }
    );
    deleteBtn.innerText = "X";

    td.appendChild(deleteBtn);
    criteriaRow.appendChild(td);


    return criteriaRow;
}

// Returns a collection of objects containing info about the different columns for the section type
function getSectionColumns(type, hasGrade) {
    let criterias = [{label: "Critères", editable: true, type: "text", name: "criteriaName"}];
    if(type == 1) {
        criterias.push({label: "Observations attendues", editable: true, type: "text", name: "criteriaDetails"});
    }
    else if(type == 2) {
        criterias.push({label: "Tâches", editable: false, type: undefined, name: ""});
    }
    if(hasGrade) {
        criterias.push({label: "Points Max", editable: true, type: "number", name: "maxPoints"});
    }
    criterias.push({label: "Remarques resp. de stage", editable: false, type: undefined, name: ""});
    criterias.push({label: "Remarques du stagiaire", editable: false, type: undefined, name: ""});

    return criterias;
}

function insertCriteriaData(criteriaRow, criteriaData) {
    const sectionType = criteriaRow.parentNode.getAttribute('data-section-type');
    const sectionIsGraded = criteriaRow.parentNode.getAttribute('data-section-has-grade') == "1";

    criteriaRow.querySelector('td:nth-child(1) > textarea').textContent = criteriaData.criteriaName;

    if(sectionType == 1) {
        criteriaRow.querySelector('td:nth-child(2) > textarea').textContent = criteriaData.criteriaDetails;
    }
    else if(sectionType == 2) {
        // type 2 has "Tâches", but it is filled during the evaluation
    }

    if(sectionIsGraded) {
        const maxPointsCol = sectionType == 3 ? 2 : 3;
        criteriaRow.querySelector(`td:nth-child(${maxPointsCol}) > input`).value = criteriaData.maxPoints;
    }
}

$(document).ready(function () {
    $("#newSectionModalSaveBtn").click(function() {
        let newSectionModal = $("#newSectionModal");
        let nameInput = newSectionModal.find("#new-section-name");
        let typeInput = newSectionModal.find("#new-section-type");
        let isGradedInput = newSectionModal.find("#new-section-is-graded");

        if(nameInput.val().length === 0) {
            return;
        }

        createNewSection(typeInput.val(), isGradedInput.is(':checked'), nameInput.val());

        // Reset form values
        nameInput.val("");
        typeInput.val(1);
        isGradedInput.prop("checked", false);

        newSectionModal.modal('hide')
    });

    $("form").submit(function() {
        // Check that we have at least 1 section and 1 criteria in that section
        return $("#sections-container").length > 0 && $("#sections-container .criteria-row").length > 0;
    });

    const nameInput = document.getElementById("name");
    nameInput.addEventListener("input", function(event) {
        if(usedTemplatesNames.includes(nameInput.value)){
            nameInput.setCustomValidity("Ce nom de template est déjà utilisé, merci d'en choisir un autre");
        }
        else {
            nameInput.setCustomValidity("");
        }
    });

    for (const [sectionId, section] of Object.entries(currentTemplate.evaluatuationSection)) {
        let sectionTable = createNewSection(section.sectionType, section["hasGrade"] == 1, section.sectionName);
        for(let [_, criteria] of Object.entries(section.criteria)) {
            let criteriaRow = getNewCriteriaRow(sectionTable);
            insertCriteriaRowToSectionTable(sectionTable, criteriaRow);
            insertCriteriaData(criteriaRow, criteria);
        }
    }
})