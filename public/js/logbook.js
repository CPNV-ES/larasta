var TIME_SLIDE_TRANSITION_LENGTH = 300;

var activities = {};
var weeks = {};
var displayedWeekId = false;
var currentDay = false;
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
    newWeekId = week.id;

    if (week.id == displayedWeekId) {
        console.log("week already displayed");
        return;
    }

    if (!weeks[week.id]) {
        var weekContainer = weeksContainer.addElement("div", "weekContainer");
        weeks[week.id] = {
            id: week.id,
            container: weekContainer,
            week,
            days: {}
        };
        //init week
        for (var indDay = 0; indDay < 5; indDay++) {
            var dayStamp = week.first.getTime() + indDay * (1000 * 60 * 60 * 24);
            var date = new Date(dayStamp);
            var adapter = buildDayAdapter(weekContainer, date);
            weeks[week.id].days[date.toISOString()] = {
                date,
                adapter,
                activities: []
            };
        }

        loadActivities(week.id);
    }

    var newWeekObj = weeks[week.id];
    var oldWeekObj = weeks[displayedWeekId];
    //set id
    displayedWeekId = week.id;
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
        var displayedWeekStartStamp = weeks[displayedWeekId].week.first.getTime();
        var newWeek = (new Date(displayedWeekStartStamp + stampWeekDiff)).getWeek();
        changeWeek(newWeek);
        return;
    }
}
function resetTime() {
    if (currentDisplayMode == "weeks") {
        currentDay = new Date().getAbsoluteDate();
        changeWeek(currentDay.getWeek());
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

    newActivities.forEach(function(activity){
        //objectify date
        activity.date = new Date(activity.entryDate);
        var dateId = activity.date.getAbsoluteDate().toISOString();
        //store
        if(activities[activity.id]){
            console.warn("activity already displayed. This case is not treated yet.");
        }
        activities[activity.id] = {
            object: activity,
            adapters:[]
        }
        weeks[weekId].days[dateId].activities.push(activity.id);
        //display
        displayActivity(activity);
    })
}

async function displayActivity(activity){
    var activityDay = activity.date.getAbsoluteDate();
    var weekId = activityDay.getWeek().id;
    var dateId = activityDay.toISOString();

    //week
    if(!weeks[weekId]){
        console.warn("the week for this activity doesn't yet exists");
        return;
    }
    if(!weeks[weekId].days[dateId]){
        console.warn("can't build activity for this day");
        return;
    }

    //current day
    if(currentDay.toISOString() == dateId){
        console.log("is current day");
        var todayActivityAdapter = buildActivityAdapter(todayActivitiesContainer, activity);
    }
    var dayAdapter = weeks[weekId].days[dateId].adapter.container;
    var weekActivityAdapter = buildActivityAdapter(dayAdapter, activity);
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
    var element = parent.addElement("div", "activityContainer");
    var header = element.addElement("div", "activityHeader");
    var time = header.addElement("p", "activityTime");
    var type = header.addElement("p", "activityType");
    var description = element.addElement("div", "activityDescription");
    var moreBtn = element.addElement("button", "activityMoreBtn");
    
    //data
    updateData(activity);

    //events
    moreBtn.addEventListener("click", function(){
        openActivity(activity.id);
    });

    function updateData(activity){
        time.textContent = getPrettyTime(activity.duration);
        type.textContent = activity.activitytype.typeActivityDescription;
        description.innerText = activity.activityDescription;
    }

    //store adapter
    var adapterObject = {
        updateData,
        element
    }
    activities[activity.id].adapters.push(adapterObject);

    return adapterObject;
}

function updateDisplayedActivityData(activity){
    if(!activities[activity.id]){
        console.warn("activity not displayed yet");
        return;
    }
    activities[activity.id].adapters.forEach(function(adapter){
        adapter.updateData(activity);
    });
}
function displayDayData(day){

}

function openCreateActivity(date){
    console.log("open create activity window", date);
}
function openActivity(id){
    console.log("open edit activity window", id);
}

function getPrettyTime(timeInHours){
    if(!timeInHours){
        return "0m";
    }
    var remain = timeInHours%1;
    var hours = timeInHours - remain;
    var minutes = Math.round(remain * 60);
    return (hours?hours + "h":"") + (minutes?minutes + "m":"");
}