
function showFeedbackFields(name) {
    document.getElementById('save').removeAttribute("hidden");
    document.getElementById('btnFdbk'+name).setAttribute("hidden", "hidden");
    document.getElementById(name).removeAttribute("hidden");
}

function showSaveBtn(){
    document.getElementById('save').removeAttribute("hidden");
}