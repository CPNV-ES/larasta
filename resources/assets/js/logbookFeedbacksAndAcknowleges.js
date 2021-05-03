
function showFeedbackFields(name) {
    document.getElementById('btnFdbk'+name).setAttribute("hidden", "hidden");
    document.getElementById(name).removeAttribute("hidden");
}