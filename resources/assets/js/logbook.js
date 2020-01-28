var TIME_SLIDE_TRANSITION_LENGTH = 300;

var activities = {};
var weeks = {};
var currentWeekId = false;
var currentDisplayMode = "weeks";

document.addEventListener("DOMContentLoaded", boot);
async function boot(ev){
    /*add events*/
    lastTimeBtn.addEventListener("click", () => {
        switchTime("last");
    });
    nextTimeBtn.addEventListener("click", () => {
        switchTime("next");
    });
    todayTimeBtn.addEventListener("click", resetTime);
    todayNewActivityBtn.addEventListener("click", function(){
        openCreateActivity(new Date());
    });
    /*start*/
    resetTime();
}

function changeWeek(week) {
    console.log("change week to ", week);
    newWeekId = week.first.toISOString();

    if (newWeekId == currentWeekId) {
        console.log("week already displayed");
        return;
    }

    if (!weeks[newWeekId]) {
        var weekContainer = weeksContainer.addElement("div", "weekContainer");
        weeks[newWeekId] = {
            id: newWeekId,
            container: weekContainer,
            week,
            days: []
        };
        //init week
        for (var indDay = 0; indDay < 5; indDay++) {
            var dayStamp = week.first.getTime() + indDay * (1000 * 60 * 60 * 24);
            var date = new Date(dayStamp);
            var adapter = buildDayAdapter(weekContainer, date);
            weeks[newWeekId].days.push({
                date,
                adapter
            });
        }

        loadActivities(newWeekId);
    }

    var newWeekObj = weeks[newWeekId];
    var oldWeekObj = weeks[currentWeekId];
    //set id
    currentWeekId = newWeekId;
    //text
    firstDateStr = week.first.getDate();
    lastDateStr = week.lastWork.toLocaleDateString("fr-FR", { day: "numeric", month: "long", year: "numeric" });
    currentDatesDisplay.textContent = `Semaine du ${firstDateStr} au ${lastDateStr}`
        //animation
    if (!oldWeekObj) {
        return;
    }
    var isNewer = (newWeekObj.week.first > oldWeekObj.week.first)
    var newElem = newWeekObj.container;
    var oldElem = oldWeekObj.container;
    var newClassName = isNewer ? "right" : "left";
    var oldClassName = isNewer ? "left" : "right";
    (async function() {
        await async_requestAnimationFrame();
        newElem.classList.remove("none");
        newElem.classList.add(newClassName);

        await async_requestAnimationFrame();
        newElem.classList.add("animating");
        oldElem.classList.add("animating");

        await async_requestAnimationFrame();
        newElem.classList.remove(newClassName);
        oldElem.classList.add(oldClassName);

        await async_setTimeout(TIME_SLIDE_TRANSITION_LENGTH);
        await async_requestAnimationFrame();
        newElem.classList.remove("animating");
        oldElem.classList.remove("animating");
        oldElem.classList.add("none");
        oldElem.classList.remove(oldClassName);
    })();
}
function switchTime(direction) {
    if (currentDisplayMode == "weeks") {
        var stampWeekDiff = (1000 * 60 * 60 * 24 * 7);
        if (direction == "last") {
            stampWeekDiff *= (-1);
        }
        var currentWeekStartStamp = weeks[currentWeekId].week.first.getTime();
        var newWeek = (new Date(currentWeekStartStamp + stampWeekDiff)).getWeek();
        changeWeek(newWeek);
        return;
    }
}
function resetTime() {
    if (currentDisplayMode == "weeks") {
        changeWeek((new Date()).getWeek());
        return;
    }
}

async function loadActivities(weekId) {
    var weekObj = weeks[weekId];
    if(!weekObj.loader){
        weekObj.loader = Utils.addLoader(weekObj.container, "weekDays");
    }

    var fromStr = weekObj.week.first.toISOString();
    var toStr = weekObj.week.last.toISOString();

    var newActivities = await Utils.callApi(`/api/internships/${internshipId}/logbook/activities`, {query:{entryDate:{from: fromStr, to: toStr}}});
    console.log("new activities", newActivities);
    weekObj.loader.remove();
    weekObj.loader = false;

    /*build*/
    newActivities.forEach((activity)=>{
        
    });
}

//ELEMENTS
function buildDayAdapter(parent, date) {
    var element = parent.addElement("div", "dayAdapter");
    var header = element.addElement("div", "dayAdapterHeader");
    var dateDisplay = header.addElement("p", "dayAdapterDateDisplay");
    var timeDisplay = header.addElement("p", "dayAdapterTimeDisplay colorInactive");
    var container = element.addElement("div", "dayAdapterActivitiesContainer");
    var addBtn = container.addElement("button", "dayAdapterNewActivityBtn");

    //data
    dateDisplay.textContent = `${date.toLocaleDateString("fr-FR", {weekday: "long"}).capitalise()} ${date.getDate()}.${date.getRightMonth()}`;
    timeDisplay.textContent = "Inactif";
    addBtn.textContent = "+";
    //evt
    addBtn.addEventListener("click", function(evt){
        openCreateActivity(date);
    });

    return { element, container, timeDisplay };
}
function buildActivityAdapter(parent, activity){
    var container = parent.addElement("div", "activityContainer");
    var description = container.addElement("div", "activityDescription");
    var moreBtn = container.addElement("button", "activityMoreBtn");

    description.textContent = activity.activityDescription;

    moreBtn.addEventListener("click", function(){
        openActivity(activity.id);
    });
}

function openCreateActivity(date){
    console.log("open create activity window", date);
}
function openActivity(id){
    console.log("open edit activity window", id);
}