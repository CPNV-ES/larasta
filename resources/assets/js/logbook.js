var TIME_SLIDE_TRANSITION_LENGTH = 300;

var activities = {};
var weeks = {};
var displayedWeekId = false;
var currentDay = false;
var currentDisplayMode = "weeks";
var displayedActivityId = false;
var newActivityDate = false;

document.addEventListener("DOMContentLoaded", boot);
async function boot(ev) {
    /*add events*/
    lastTimeBtn.addEventListener("click", () => {
        switchTime("last");
    });
    nextTimeBtn.addEventListener("click", () => {
        switchTime("next");
    });
    todayTimeBtn.addEventListener("click", resetTime);
    seekDateInput.addEventListener("input", onSeekValue);

    todayNewActivityBtn.addEventListener("click", function () {
        openCreateActivity(new Date());
        openCreateActivity(new Date());
    });
    activityWindow.addEventListener("click", hideActivityWindow);
    activityWindowContainer.addEventListener("click", (evt) => {
        evt.stopPropagation();
    });
    activityWindowCancel.addEventListener("click", hideActivityWindow);
    activityWindowEditBtn.addEventListener("click", (evt) => {
        openEditActivity(displayedActivityId);
    });
    activityWindowDeleteBtn.addEventListener("click", (evt) => {
        deleteActivity(displayedActivityId);
    })
    //window categories
    activityTypes.forEach((activityType) => {
        optionElem = activityWindowActivityTypeInput.addElement("option");
        optionElem.textContent = activityType.typeActivityDescription;
        optionElem.value = activityType.id;
    });
    /*start*/
    resetTime();
}
function onSeekValue(evt){
    console.log("on seek value", evt.isTrusted);
    if(!evt.isTrusted){
        console.warn("ignoring passed date , non trusted evt");
        return;
    }
    var value = evt.target.value
    if(!value){
        console.warn("empty date passed");
        return;
    }
    changeWeek(new Date(value).getWeek());
}
function changeWeek(week, { force = false, animation = true } = {}) {
    console.log("change week to ", week);
    newWeekId = week.id;

    if (week.id == displayedWeekId && !force) {
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
    //selector
    seekDateInput.value = week.first.toSimpleISOString();
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
    if (!animation) { //instant transition
        oldElem.classList.add("none");
        newElem.classList.remove("none");
        return;
    }
    var newClassName = isNewer ? "right" : "left";
    var oldClassName = isNewer ? "left" : "right";
    (async function () {
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
    if (!weekObj.loader) {
        weekObj.loader = Utils.addLoader(weekObj.container, "dark");
    }

    var fromStr = weekObj.week.first.toISOString();
    var toStr = weekObj.week.last.toISOString();

    var newActivities = await Utils.callApi(`/api/internships/${internshipId}/logbook/activities`, { query: { entryDate: { from: fromStr, to: toStr } } });

    console.log("new activities", newActivities);
    weekObj.loader.remove();
    weekObj.loader = false;

    if (!newActivities) {
        console.warn("couln't load activities");
        Utils.infoBox("Couldn't load activities");

        //retry message + delete week to allow reload
        weekObj.container.removeChilds();
        var textElem = weekObj.container.addElement("h1");
        textElem.textContent = "Couldn't load activities for this week :(";
        var retryBtn = weekObj.container.addElement("button");
        retryBtn.textContent = "Retry";
        retryBtn.addEventListener("click", (evt) => {
            weekObj.container.remove();
            delete weeks[weekId];
            changeWeek(weekObj.week, { force: true, animation: false });
        });
        return;
    }

    newActivities.forEach(function (activity) {
        onNewActivity(activity, weekId);
    });
}

function onNewActivity(activity, weekId = false) {
    //objectify date
    activity.date = new Date(activity.entryDate);
    var dateId = activity.date.getAbsoluteDate().toISOString();
    //activity type
    if(!activity.activitytype){
        activity.activitytype = activityTypes[activity.activitytypes_id];
    }
    //weekid
    if (!weekId) {
        weekId = activity.date.getWeek().first.getAbsoluteDate().toISOString();
    }
    //store
    if (activities[activity.id]) {
        console.warn("activity already displayed. This case is not treated yet.");
    }
    activities[activity.id] = {
        object: activity,
        adapters: []
    }
    weeks[weekId].days[dateId].activities.push(activity.id);
    //display
    displayActivity(activity);
}

async function displayActivity(activity) {
    var activityDay = activity.date.getAbsoluteDate();
    var weekId = activityDay.getWeek().id;
    var dateId = activityDay.toISOString();

    //week
    if (!weeks[weekId]) {
        console.warn("the week for this activity doesn't yet exists");
        return;
    }
    if (!weeks[weekId].days[dateId]) {
        console.warn("can't build activity for this day");
        return;
    }

    //current day
    if (currentDay.toISOString() == dateId) {
        console.log("is current day");
        var todayActivityAdapter = buildActivityAdapter(todayActivitiesContainer, activity);
        todayActivityAdapter.element.addElemAfter(todayNewActivityBtn); //move to start
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
    dateDisplay.textContent = `${date.toLocaleDateString("fr-FR", { weekday: "long" }).capitalise()} ${date.getDate()}.${date.getRightMonth()}`;
    timeDisplay.textContent = "Inactif";
    addBtn.textContent = "+";
    //evt
    addBtn.addEventListener("click", function (evt) {
        openCreateActivity(date);
    });

    return { element, container, timeDisplay };
}
function buildActivityAdapter(parent, activity) {
    var element = parent.addElement("div", "activityContainer");
    var header = element.addElement("div", "activityHeader");
    var time = header.addElement("p", "activityTime");
    var type = header.addElement("p", "activityType");
    var description = element.addElement("div", "activityDescription");
    var moreBtn = element.addElement("button", "activityMoreBtn");

    //data
    updateData(activity);
    moreBtn.textContent = "▼";

    //events
    moreBtn.addEventListener("click", function (evt) {
        openViewActivity(activity.id);
    });
    element.addEventListener("dblclick", function (evt) {
        openViewActivity(activity.id);
    });

    function updateData(activity) {
        time.textContent = getPrettyTime(activity.duration);
        type.textContent = activity.activitytype.typeActivityDescription;
        description.removeChilds();
        Utils.appendLinkifiedText(description, activity.activityDescription);
    }

    //store adapter
    var adapterObject = {
        updateData,
        element
    }
    activities[activity.id].adapters.push(adapterObject);

    return adapterObject;
}

function updateActivityData(newActivity) {
    if (!activities[newActivity.id]) {
        console.warn("activity not displayed yet");
        return;
    }
    activities[newActivity.id].object = newActivity;
    activities[newActivity.id].adapters.forEach(function (adapter) {
        adapter.updateData(newActivity);
    });
}
function displayDayData(day) {

}

function openCreateActivity(date) {
    console.log("open create activity window", date);
    //clear data
    activityWindowContainer.reset();
    //display
    newActivityDate = date;
    displayedActivityId = false;
    displayActivityWindow("create");
}
function openEditActivity(activityId) {
    console.log("open edit activity window", activityId);
    if (!activityId) {
        console.warn("activity not editable");
        return;
    }
    if (!activities[activityId]) {
        console.warn("activity not loaded yet");
        return;
    }
    var activity = activities[activityId].object;

    //set data
    var {hours, minutes} = getHoursMinutes(activity.duration);
    activityWindowHoursInput.value = hours;
    activityWindowMinutesInput.value = minutes;
    activityWindowActivityTypeInput.value = activity.activitytypes_id;
    activityWindowDescriptionInput.value = activity.activityDescription;

    //display
    displayedActivityId = activityId;
    displayActivityWindow("edit");
}
function openViewActivity(activityId) {
    console.log("open view activity window", activityId);
    //display data
    var activity = activities[activityId].object;
    console.log(activity);
    activityWindowTimeDisplay.textContent = getPrettyTime(activity.duration);
    activityWindowActivityTypeDisplay.textContent = activity.activitytype.typeActivityDescription;
    //description
    activityWindowDescription.removeChilds();
    Utils.appendLinkifiedText(activityWindowDescription, activity.activityDescription);
    //display
    displayedActivityId = activityId;
    displayActivityWindow("view");
}

function displayActivityWindow(mode = "view") {//mode: edit/view
    var displayMode = (mode == "edit" || mode == "create") ? "edit" : "view";
    var oppositeMode = (displayMode == "edit") ? "view" : "edit";
    //classes conditions
    activityWindow.getElementsByClassName(`${oppositeMode}Mode`).forEach((elem) => {
        elem.classList.add("none");
    });
    activityWindow.getElementsByClassName(`${displayMode}Mode`).forEach((elem) => {
        elem.classList.remove("none");
    });
    //special cases
    if(mode == "create"){
        activityWindowDeleteBtn.classList.add("none");
    }else{
        activityWindowDeleteBtn.classList.remove("none");
    }
    //display
    activityWindow.classList.remove("none");
}
function hideActivityWindow() {
    activityWindow.classList.add("none");
}

async function onActivitySave() {
    console.log("saving", displayedActivityId);
    //get data
    var hours = activityWindowHoursInput.value;
    var minutes = activityWindowMinutesInput.value;
    var duration = parseInt(hours) + minutes/60;
    var activitytypes_id = activityWindowActivityTypeInput.value;
    var activitytype = [...activityTypes].find((object)=>{
        return object.id == activitytypes_id;
    })
    var activityDescription = activityWindowDescriptionInput.value;
    var activityData = {duration, activityDescription, activitytypes_id};

    var loader = Utils.addLoader(activityWindow, "dark");

    //save data
    if (displayedActivityId) {//edit
        //api call
        let result = await Utils.callApi(`/api/internships/logbook/activities/${displayedActivityId}`, {method: "PUT", body: activityData});
        loader.remove();
        if(!result){
            console.warn("couldn't update activity");
            Utils.infoBox("Couldn't update the activity");
            return;
        }
        //update
        var activity = activities[displayedActivityId].object;
        activity.activitytype = activitytype;
        Object.assign(activity, activityData);

        updateActivityData(activity);
    } else {//new
        if(!newActivityDate){
            console.warn("activity date not set");
            return;
        }
        activityData.entryDate = newActivityDate.toSimpleISOString();

        let result = await Utils.callApi(`/api/internships/${internshipId}/logbook/activities/`, {method: "POST", body: activityData});
        loader.remove();
        if(!result){
            console.warn("couldn't create activity");
            Utils.infoBox("Couldn't create the activity");
            return;
        }

        var rawActivity = result;
        onNewActivity(rawActivity);

        var activity = activities[rawActivity.id].object;
    }

    //display window
    openViewActivity(activity.id);
}
async function deleteActivity(activityId){
    if(!activities[activityId]){
        console.warn("invalid activity", activityId);
    }
    if(!confirm("Êtes vous surs de vouloir supprimer cette activité?")){
        console.log("user aborted deletion");
        return;
    }
    var activityRef = activities[activityId];

    var loader = Utils.addLoader(activityWindow, "dark");
    let result = await Utils.callApi(`/api/internships/logbook/activities/${activityId}`, {method: "DELETE"});
    loader.remove();
    if(result.state != "success"){
        Utils.infoBox("Couldn't remove activity :(");
        console.warn("couldn't remove activity", result);
        return;
    }
    //remove adapters
    activityRef.adapters.forEach((adapter) => {
        adapter.element.remove();
    });
    //remove activities
    var activityDate = activityRef.object.date;
    var activitiesList =  weeks[activityDate.getWeek().first.toISOString()].days[activityDate.getAbsoluteDate().toISOString()].activities;
    activitiesList.splice(activitiesList.indexOf(activityId), 1 );
    delete activities[activityId];
    console.log("success :)");
    hideActivityWindow();
}

function getHoursMinutes(timeInHours) { //returns object containing hours and minutes separated from time in hours
    var remain = timeInHours % 1;
    var hours = timeInHours - remain;
    var minutes = Math.round(remain * 60);
    return {hours, minutes};
}
function getPrettyTime(timeInHours) {
    if (!timeInHours) {
        return "0m";
    }
    var {hours, minutes} = getHoursMinutes(timeInHours);
    return (hours ? hours + "h" : "") + (minutes ? minutes + "m" : "");
}