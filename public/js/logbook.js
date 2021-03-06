/*this script requires the utils.js script*/
var TIME_SLIDE_TRANSITION_LENGTH = 300;
var COMPLIANCE_LEVELS_CLASSES = {
    inactive: "colorInactive",
    ok: "logbookOk",
    not_enough_words: "notEnoughWords",
    not_enough_activities: "notEnoughActivities",
    not_enough_hours: "notEnoughHours"
};
var COMPLIANCE_LEVELS_COMMENT = {
    ok: "Ok",
    not_enough_words: "Pas assez de mots.",
    not_enough_activities: "Pas assez d'activités.",
    not_enough_hours: "Pas assez d'heures."
};

var activities = {};
var weeks = {};
var displayedWeekId = false;
var currentDay = false;
var displayedActivity = false;
var newActivityDate = false;

document.addEventListener("DOMContentLoaded", boot);
async function boot(ev) {
    /*add events*/
    todayNewActivityBtn.addEventListener("click", function () {
        openCreateActivity(new Date());
    });
    activityWindow.addEventListener("click", hideActivityWindow);
    activityWindowContainer.addEventListener("click", evt => {
        evt.stopPropagation();
    });
    activityWindowCancel.addEventListener("click", hideActivityWindow);
    activityWindowEditBtn.addEventListener("click", evt => {
        openEditActivity(displayedActivity);
    });
    activityWindowDeleteBtn.addEventListener("click", evt => {
        deleteActivity(displayedActivity.id);
    });
    //body evts
    document.body.addEventListener("click", evt => {
        hideSeekCalendar(evt);
    });
    document.body.addEventListener("keydown", evt => {
        if (evt.key == "Escape") {
            hideActivityWindow(evt);
            hideSeekCalendar(evt);
        }
        if (evt.key == "n" && evt.altKey) { //alt + n
            evt.preventDefault();
            openCreateActivity(new Date());
        }
    });
    //seek events
    lastTimeBtn.addEventListener("click", evt => { switchTime("last", "week"); });
    nextTimeBtn.addEventListener("click", evt => { switchTime("next", "week"); });
    todayTimeBtn.addEventListener("click", resetTime);
    //seek calendar evts
    calendarModeBtn.addEventListener("click", toggleSeekCalendar);
    seekCalendar.addEventListener("click", evt => { evt.stopPropagation(); });
    //seekCalendarLastWeek.addEventListener("click", evt => { switchTime("last", "week"); });
    //seekCalendarNextWeek.addEventListener("click", evt => { switchTime("next", "week"); });
    seekCalendarLastMonth.addEventListener("click", evt => { switchTime("last", "month"); });
    seekCalendarNextMonth.addEventListener("click", evt => { switchTime("next", "month"); });
    seekCalendarLastYear.addEventListener("click", evt => { switchTime("last", "year"); });
    seekCalendarNextYear.addEventListener("click", evt => { switchTime("next", "year"); });
    seekDateInput.addEventListener("input", onSeekValue);
    //parameters
    chkShowWeekends.addEventListener("input", evt => { setWeekendVisibility(chkShowWeekends.checked) });
    //history
    window.addEventListener("popstate", onPopState);
    //window categories
    activityTypes.forEach(activityType => {
        optionElem = activityWindowActivityTypeInput.addElement("option", {
            _text: activityType.typeActivityDescription,
            value: activityType.id
        });
    });
    /*start*/
    resetTime();
    /*load activity if reference. Search for ?activity=id*/
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("activity")) {
        var activityId = urlParams.get("activity");
        console.log("boot load activity ", activityId);
        loadAndDisplayActivity(activityId, true);
    }
}
function onPopState(evt) {
    console.log("pop state", evt);
    if (!evt.state) {
        window.location = evt.target.location;
        return;
    }
    if (evt.state.activityId) {
        loadAndDisplayActivity(evt.state.activityId, true);
    } else {
        hideActivityWindow({}, true);
    }
}
async function loadAndDisplayActivity(activityId, preventHistory = false) {
    if (activities[activityId]) {
        var rawActivity = activities[activityId].object;
    } else {
        var loader = Utils.addLoader(document.body);
        var rawActivity = await Utils.callApi(ROUTES.getActivity(activityId));
        loader.remove();
    }
    if (!rawActivity) {
        console.warn("undefined activity");
        Utils.infoBox("Couldn't load activity :(");
        return;
    }
    var activity = objectifyActivity(rawActivity);
    openViewActivity(activity, preventHistory);
}
function onSeekValue(evt) {
    console.log("on seek value", evt.isTrusted);
    if (!evt.isTrusted) {
        console.warn("ignoring passed date , non trusted evt");
        return;
    }
    var value = evt.target.value;
    if (!value) {
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
        var weekContainer = weeksContainer.addElement("div", {
            class: "weekContainer"
        });
        weeks[week.id] = {
            id: week.id,
            container: weekContainer,
            week,
            days: {}
        };
        //init week
        for (var indDay = 0; indDay < 7; indDay++) {
            var dayStamp = week.first.getTime() + indDay * (1000 * 60 * 60 * 24);
            var date = new Date(dayStamp);
            var adapter = buildDayAdapter(weekContainer, date);
            weeks[week.id].days[date.toSimpleISOString()] = {
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
    lastDateStr = week.lastWork.toLocaleDateString("fr-FR", {
        day: "numeric",
        month: "long",
        year: "numeric"
    });
    currentDatesDisplay.textContent = `Semaine du ${firstDateStr} au ${lastDateStr}`;
    seekCalendarMonthDisplay.textContent = week.first.toLocaleDateString("fr-FR", { month: "long" }).capitalise();
    seekCalendarYearDisplay.textContent = week.first.getFullYear();
    //animation
    if (!oldWeekObj) {
        return;
    }
    var isNewer = newWeekObj.week.first > oldWeekObj.week.first;
    var newElem = newWeekObj.container;
    var oldElem = oldWeekObj.container;
    if (!animation) {
        //instant transition
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
function switchTime(direction, unit = "week") {
    const DAY_LENGTH = 1000 * 60 * 60 * 24
    switch (unit) {
        case "year":
            var stampWeekDiff = DAY_LENGTH * 365;
            break;
        case "month":
            var stampWeekDiff = DAY_LENGTH * 7 * 4;
            break;
        default: case "week":
            var stampWeekDiff = DAY_LENGTH * 7;
    }
    if (direction == "last") {
        stampWeekDiff *= -1;
    }
    var displayedWeekStartStamp = weeks[
        displayedWeekId
    ].week.first.getTime();
    var newWeek = new Date(
        displayedWeekStartStamp + stampWeekDiff
    ).getWeek();
    changeWeek(newWeek);
    return;
}
function resetTime() {
    currentDay = new Date().getAbsoluteDate();
    changeWeek(currentDay.getWeek());
    return;
}

async function loadActivities(weekId) {
    var weekObj = weeks[weekId];
    if (!weekObj.loader) {
        weekObj.loader = Utils.addLoader(weekObj.container, "dark");
    }

    var fromStr = weekObj.week.first.toISOString();
    var toStr = weekObj.week.last.toISOString();

    var newActivities = await Utils.callApi(
        ROUTES.getActivities(),
        { query: { entryDate: { from: fromStr, to: toStr } } }
    );

    console.log("new activities", newActivities);
    weekObj.loader.remove();
    weekObj.loader = false;

    if (!newActivities) {
        console.warn("couln't load activities");
        Utils.infoBox("Couldn't load activities");

        //retry message + delete week to allow reload
        weekObj.container.removeChilds();
        var textElem = weekObj.container.addElement("h1", {
            _text: "Couldn't load activities for this week :("
        });
        var retryBtn = weekObj.container.addElement("button", {
            _text: "Retry"
        });
        retryBtn.addEventListener("click", evt => {
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

function onNewActivity(rawActivity, weekId = false) {
    var activity = objectifyActivity(rawActivity);
    var dateId = activity.date.getAbsoluteDate().toSimpleISOString();
    //weekid
    if (!weekId) {
        weekId = activity.date
            .getWeek()
            .first.getAbsoluteDate()
            .toSimpleISOString();
    }
    //store
    if (activities[activity.id]) {
        console.warn(
            "activity already displayed. This case is not treated yet."
        );
    }
    activities[activity.id] = {
        object: activity,
        adapters: []
    };
    weeks[weekId].days[dateId].activities.push(activity.id);
    //display
    displayActivity(activity);
}
function objectifyActivity(rawActivity) {
    var activity = Object.assign(rawActivity);
    //objectify date
    activity.date = new Date(activity.entryDate);
    //activity type
    if (!activity.activitytype) {
        activity.activitytype = activityTypes.find(activityType => activityType.id == activity.activitytypes_id);
    }
    //duration
    activity.duration = parseFloat(activity.duration);

    return activity;
}

async function displayActivity(activity) {
    var activityDay = activity.date.getAbsoluteDate();
    var weekId = activityDay.getWeek().id;
    var dateId = activityDay.toSimpleISOString();

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
    if (currentDay.toSimpleISOString() == dateId) {
        var todayActivityAdapter = buildActivityAdapter(
            todayActivitiesContainer,
            activity
        );
        todayActivityAdapter.element.addElemAfter(todayNewActivityBtn); //move to start
    }
    var dayAdapter = weeks[weekId].days[dateId].adapter.container;
    var weekActivityAdapter = buildActivityAdapter(dayAdapter, activity);
    refreshDayData(activityDay);
}

//ELEMENTS
function buildDayAdapter(parent, date) {
    var element = parent.addElement("div", { class: "dayAdapter" });
    var header = element.addElement("div", { class: "dayAdapterHeader" });
    var dateDisplay = header.addElement("p", {
        class: "dayAdapterDateDisplay"
    });
    var timeDisplay = header.addElement("p", {
        class: "dayAdapterTimeDisplay colorInactive"
    });
    var container = element.addElement("div", {
        class: "dayAdapterActivitiesContainer"
    });
    var addBtn = container.addElement("button", {
        class: "dayAdapterNewActivityBtn",
        _text: "+"
    });

    //data
    element.classList.add(date.toLocaleDateString("en", { weekday: "long" }).toLowerCase());
    dateDisplay.textContent = `${date
        .toLocaleDateString("fr-FR", { weekday: "long" })
        .capitalise()} ${date.getDate()}.${date.getRightMonth()}`;
    timeDisplay.textContent = "Inactif";
    if(date > currentDay){
        addBtn.disabled = true;
    }
    //evt
    addBtn.addEventListener("click", function (evt) {
        openCreateActivity(date);
    });

    function updateData({ duration }) {
        timeDisplay.textContent = getPrettyTime(duration);
    }
    function updateCompliance(level) {
        applyComplianceColor(timeDisplay, level);
    }

    return { element, container, timeDisplay, updateCompliance, updateData };
}
function buildActivityAdapter(parent, activity) {
    var element = parent.addElement("div", { class: "activityContainer" });
    var header = element.addElement("div", { class: "activityHeader" });
    var time = header.addElement("p", { class: "activityTime colorInactive" });
    var type = header.addElement("p", { class: "activityType" });
    var description = element.addElement("div", {
        class: "activityDescription"
    });
    var moreBtn = element.addElement("button", {
        class: "activityMoreBtn",
        _text: "▼"
    });

    //data
    updateData(activity);

    //events
    moreBtn.addEventListener("click", function (evt) {
        openViewActivity(activity);
    });
    element.addEventListener("dblclick", function (evt) {
        openViewActivity(activity);
    });

    function updateData(activity) {
        time.textContent = getPrettyTime(activity.duration);
        type.textContent = activity.activitytype.typeActivityDescription;
        type.title = activity.activitytype.typeActivityDescription;
        description.removeChilds();
        Utils.appendLinkifiedText(description, activity.activityDescription);
    }
    function updateCompliance(level) {
        applyComplianceColor(time, level);
    }

    //store adapter
    var adapterObject = {
        updateData,
        updateCompliance,
        element
    };
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

    //day
    refreshDayData(newActivity.date);
}
function refreshDayData(dayDate) {
    var weekId = dayDate.getWeek().id;
    if (!weeks[weekId]) {
        //could cause a problem with the current day zone in the future
        console.warn("this week is not displayed", weekId);
        return;
    }
    var weekObject = weeks[weekId];
    var dayId = dayDate.toSimpleISOString();
    if (!weekObject.days[dayId]) {
        console.warn("this day is not loaded somehow", dayId);
        return;
    }
    var dayObject = weekObject.days[dayId];

    //calculate conditions compliance
    var complianceIndex = 0;
    var dayDuration = 0;
    var forceActivityCountOK = false;
    dayObject.activities.forEach(activityId => {
        if (!activities[activityId]) {
            console.warn("activity not found", activityId);
            return;
        }
        var activity = activities[activityId];
        //activity condition compliance
        var activityComplianceIndex = 0;
        var duration = activity.object.duration;
        (() => {
            //no validation
            if (!activity.object.activitytype.RequireDetails) {
                forceActivityCountOK = true;
                return;
            }
            //words per hour
            var description = activity.object.activityDescription;
            var wordCountPerHour = Utils.countWords(description) / duration;
            if (wordCountPerHour < COMPLIANCE_CONDITIONS.min_words_per_hour) {
                activityComplianceIndex = Object.keyByValue(COMPLIANCE_LEVELS, "not_enough_words");
                return;
            }
        })();

        //activity compliance
        activity.adapters.forEach(function (activityAdapter) {
            activityAdapter.updateCompliance(COMPLIANCE_LEVELS[activityComplianceIndex]);
        });

        //day compliance
        if (activityComplianceIndex > complianceIndex) {
            complianceIndex = activityComplianceIndex;
        }

        //duration
        dayDuration += duration;
    });
    //day compliance conditions
    (() => {
        //activities count
        if (!forceActivityCountOK && dayObject.activities.length < COMPLIANCE_CONDITIONS.min_activities_per_day) {
            let index = Object.keyByValue(COMPLIANCE_LEVELS, "not_enough_activities");
            complianceIndex = (index > complianceIndex) ? index : complianceIndex;
        }
        //hours per day
        if (dayDuration < COMPLIANCE_CONDITIONS.min_hours_per_day) {
            let index = Object.keyByValue(COMPLIANCE_LEVELS, "not_enough_hours");
            complianceIndex = (index > complianceIndex) ? index : complianceIndex;
        }
    })();

    //display
    var complianceLevel = COMPLIANCE_LEVELS[complianceIndex];
    //day in week
    dayObject.adapter.updateCompliance(complianceLevel);
    dayObject.adapter.updateData({ duration: dayDuration });
    //today
    if (dayId == new Date().getAbsoluteDate().toSimpleISOString()) {
        applyComplianceColor(todayDuration, complianceLevel);
        todayDuration.textContent = `${getPrettyTime(dayDuration)} - ${COMPLIANCE_LEVELS_COMMENT[complianceLevel]}`;
    }
}
function applyComplianceColor(element, level) {
    element.classList.remove("colorInactive");
    element.classList.remove("colorLogbookOk");
    element.classList.remove("colorNotEnoughWords");
    element.classList.remove("colorNotEnoughHours");
    element.classList.remove("colorNotEnoughActivities");
    Object.values(COMPLIANCE_LEVELS_CLASSES).forEach(oldLevelName=>{
        element.classList.remove(`color${oldLevelName.capitalise()}`);
    });
    element.classList.add(`color${COMPLIANCE_LEVELS_CLASSES[level].capitalise()}`);

    element.title = COMPLIANCE_LEVELS_COMMENT[level];
}

function openCreateActivity(date) {
    if(!hasAccessToEdit){
        console.warn("insufficient access rights.");
        Utils.infoBox("You can't do that...");
        return;
    }
    console.log("open create activity window", date);
    //clear data
    activityWindowContainer.reset();
    //display
    newActivityDate = date;
    displayedActivity = false;
    displayActivityWindow("create");
    activityWindowHoursInput.focus();
}
function openEditActivity(activity) {
    if(!hasAccessToEdit){
        console.warn("insufficient access rights.");
        Utils.infoBox("You can't do that...");
        return;
    }
    console.log("open edit activity window", activity);
    if (!activity) {
        console.warn("activity not editable");
        return;
    }

    //set data
    var { hours, minutes } = getHoursMinutes(activity.duration);
    activityWindowHoursInput.value = hours;
    activityWindowMinutesInput.value = minutes;
    activityWindowActivityTypeInput.value = activity.activitytypes_id;
    activityWindowDescriptionInput.value = activity.activityDescription;

    //display
    displayedActivity = activity;
    displayActivityWindow("edit");
    activityWindowHoursInput.focus();
}
function openViewActivity(activity, preventHistory = false) {
    console.log("open view activity window", activity);
    //history
    if (!preventHistory) {
        history.pushState({ activityId: activity.id }, `Activité "${activity.activitytype.typeActivityDescription}"`, `?activity=${activity.id}`);
    } else {
        history.replaceState({ activityId: activity.id }, `Activité "${activity.activitytype.typeActivityDescription}"`, `?activity=${activity.id}`);
    }
    //display data
    activityWindowTimeDisplay.textContent = getPrettyTime(activity.duration);
    activityWindowActivityTypeDisplay.textContent =
        activity.activitytype.typeActivityDescription;
    //description
    activityWindowDescription.removeChilds();
    Utils.appendLinkifiedText(
        activityWindowDescription,
        activity.activityDescription
    );
    //buttons
    /* if(activities[activity.id]){
        activityWindowEditBtn.disabled = false;
    }else{
        activityWindowEditBtn.disabled = true;
    } */
    //display
    displayedActivity = activity;
    displayActivityWindow("view");
    activityWindowEditBtn.focus();
}

function displayActivityWindow(mode = "view") {
    //mode: edit/view
    var displayMode = mode == "edit" || mode == "create" ? "edit" : "view";
    var oppositeMode = displayMode == "edit" ? "view" : "edit";
    //classes conditions
    activityWindow
        .getElementsByClassName(`${oppositeMode}Mode`)
        .forEach(elem => {
            elem.classList.add("none");
        });
    activityWindow
        .getElementsByClassName(`${displayMode}Mode`)
        .forEach(elem => {
            elem.classList.remove("none");
        });
    //special cases
    if (mode == "create") {
        activityWindowDeleteBtn.classList.add("none");
    } else {
        activityWindowDeleteBtn.classList.remove("none");
    }
    //display
    activityWindow.classList.remove("none");
}
function hideActivityWindow(evt, preventHistory = false) {
    activityWindow.classList.add("none");
    //history
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("activity")) {
        if (preventHistory) {
            history.replaceState({ activityId: false }, "Logbook", "?");
        } else {
            history.pushState({ activityId: false }, "Logbook", "?");
        }
    }
}

function toggleSeekCalendar(evt) {
    if (seekCalendar.classList.contains("none")) {
        displaySeekCalendar(evt);
        return
    }
    hideSeekCalendar(evt);
}
function displaySeekCalendar(evt) {
    evt.stopPropagation();
    seekCalendar.classList.remove("none");
    seekDateInput.focus();
}
function hideSeekCalendar(evt) {
    seekCalendar.classList.add("none");
    if (evt.type == "keydown")
        calendarModeBtn.focus();
}
function setWeekendVisibility(isVisible) {
    //change style
    if (isVisible) {
        calendarSection.classList.add("withWeekend")
    } else {
        calendarSection.classList.remove("withWeekend")
    }
    //set cookie
    Cookies.set("logbookShowWeekend", isVisible ? "yes" : "no");
}

async function onActivitySave() {
    console.log("saving", displayedActivity);
    //get data
    var hours = parseInt(activityWindowHoursInput.value);
    var minutes = parseInt(activityWindowMinutesInput.value);
    var duration = hours + minutes / 60;

    var activitytypes_id = activityWindowActivityTypeInput.value;
    var activitytype = [...activityTypes].find(object => {
        return object.id == activitytypes_id;
    });
    var activityDescription = activityWindowDescriptionInput.value;
    var activityData = { duration, activityDescription, activitytypes_id, feedback: "fdbk", acknowledged: 0 };
    console.log({ activityData });

    var loader = Utils.addLoader(activityWindow, "dark");

    //save data
    if (displayedActivity) {
        //edit

        //Replace data feedback by the actual feedback
        if(!displayedActivity.feedback){
            activityData.feedback = "";
        }else{
            activityData.feedback = displayedActivity.feedback;
        }
        
        //api call
        let result = await Utils.callApi(
            ROUTES.putActivity(displayedActivity.id),
            { method: "PUT", body: activityData }
        );
        loader.remove();
        if (!result) {
            console.warn("couldn't update activity");
            Utils.infoBox("Couldn't update the activity");
            return;
        }
        var activity = displayedActivity;
        if (activities[activity.id]) {
            //update display
            var activity = activities[displayedActivity.id].object;
            activity.activitytype = activitytype;
            Object.assign(activity, activityData);
            updateActivityData(activity);
        }
    } else {
        //new
        if (!newActivityDate) {
            console.warn("activity date not set");
            return;
        }
        activityData.entryDate = newActivityDate.toSimpleISOString();

        let result = await Utils.callApi(
            ROUTES.postActivity(),
            { method: "POST", body: activityData }
        );
        loader.remove();
        if (!result) {
            console.warn("couldn't create activity");
            Utils.infoBox("Couldn't create the activity");
            return;
        }

        var rawActivity = result;
        onNewActivity(rawActivity);

        var activity = activities[rawActivity.id].object;
    }

    //display window
    openViewActivity(activity);
}
async function deleteActivity(activityId) {
    if (!confirm("Êtes vous surs de vouloir supprimer cette activité?")) {
        console.log("user aborted deletion");
        return;
    }
    var loader = Utils.addLoader(activityWindow, "dark");
    let result = await Utils.callApi(
        ROUTES.deleteActivity(activityId),
        { method: "DELETE" }
    );
    loader.remove();

    if (result.state != "success") {
        Utils.infoBox("Couldn't remove activity :(");
        console.warn("couldn't remove activity", result);
        return;
    }
    if (!activities[activityId]) {
        console.warn("activity not loaded, skipping dependancy removal", activityId);
    } else {
        var activityRef = activities[activityId];

        //remove adapters
        activityRef.adapters.forEach(adapter => {
            adapter.element.remove();
        });
        //remove activities
        var activityDate = activityRef.object.date;
        var activitiesList =
            weeks[activityDate.getWeek().first.toSimpleISOString()].days[
                activityDate.getAbsoluteDate().toSimpleISOString()
            ].activities;
        activitiesList.splice(activitiesList.indexOf(activityId), 1);
        delete activities[activityId];
        //update day
        refreshDayData(activityDate);
    }
    console.log("success :)");
    Utils.infoBox("Activity removed!")
    hideActivityWindow();
}

function getHoursMinutes(timeInHours) {
    //returns object containing hours and minutes separated from time in hours
    var remain = timeInHours % 1;
    var hours = timeInHours - remain;
    var minutes = Math.round(remain * 60);
    return { hours, minutes };
}
function getPrettyTime(timeInHours) {
    if (!timeInHours) {
        return "0m";
    }
    var { hours, minutes } = getHoursMinutes(timeInHours);
    return (hours ? hours + "h" : "") + (minutes ? minutes + "m" : "");
}
