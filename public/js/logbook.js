document.addEventListener("DOMContentLoaded", boot);
function boot(ev){
    //get internship data
    var apiParams = {
        
    }
    //get week
    var currentDate = new Date();
    var currentWeek = {
        start: new Date()
    }
    Utils.callApi(`/api/internships/${internshipId}/logbook/activities`).then(function(){
        
    });
}