document.addEventListener("DOMContentLoaded", boot);
async function boot(ev){
    //get internship data
    var apiParams = {
        
    }
    //get week
    var currentDate = new Date();
    var currentWeek = currentDate.getWeek();
    var query = {
        entryDate:{
            from: currentWeek.first.toISOString(),
            to: currentWeek.last.toISOString()
        }
    };
    var result = await Utils.callApi(`/api/internships/${internshipId}/logbook/activities`, {query});
    console.log(result);
}