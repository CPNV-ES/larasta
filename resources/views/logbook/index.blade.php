@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endsection

@section ('page_specific_js')
    <script src="/js/logbook.js"></script>
    
    <!--vars passed at page load-->
    <script>
        var internshipId = {{$internship->id}};
        var activityTypes = {!! $activityTypes !!};
        var COMPLIANCE_CONDITIONS = {!! $complianceConditions !!}
        var COMPLIANCE_LEVELS = COMPLIANCE_CONDITIONS.levels;
        //var routes = {} //couldn't manage to use dynamic routes without added dev
    </script>
@endsection

@section('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "review", "internshipId" => $internship->id])
@endsection

@section ('content')
    <h1>Stage de {{$student->full_name}}</h1>
    <h2>{{$internship->company->companyName}}</h2>
    <div class="logbookContainer">
        <div class="todaySection">
            <h2 class="todayTitle">Aujourd'hui</h2>
            <p id="todayDuration" class="colorInactive">Inactif</p>
            <div id="todayActivitiesContainer">
                <button id="todayNewActivityBtn" title="Créer une activité (Alt+N)">+</button>
            </div>
        </div>
        <div class="calendarSection">
            <div class="calendarHeader">
                <button id="todayTimeBtn">Aujourd'hui</button>
                <button id="lastTimeBtn">&lt;</button>
                <p id="currentDatesDisplay">...</p>
                <button id="nextTimeBtn">&gt;</button>
                <button id="calendarModeBtn">
                </button>
                <!--temporary way. will use a js calendar widget later -->
                <div id="seekCalendar" class="none">
                <!--<div>
                        <button id="seekCalendarLastWeek">&lt;</button>
                        <p id="seekCalendarWeekDisplay>Semaines</p>
                        <button id="seekCalendarNextWeek">&gt;</button>
                    </div> -->
                    <div>
                        <button id="seekCalendarLastMonth">&lt;</button>
                        <p id="seekCalendarMonthDisplay">Mois</p>
                        <button id="seekCalendarNextMonth">&gt;</button>
                    </div>
                    <div>
                        <button id="seekCalendarLastYear">&lt;</button>
                        <p id="seekCalendarYearDisplay">Années</p>
                        <button id="seekCalendarNextYear">&gt;</button>
                    </div>
                    <input id="seekDateInput" type="date"/>
                </div>
            </div>
            <div class="calendarBody">
                <div id="monthsContainer" class="hidden"></div>
                <div id="weeksContainer" class="current"></div>
            </div>
        </div>
    </div>    
@endsection
@section('windows')
    <div id="activityWindow" class="none windowBackground darken">
        <form id="activityWindowContainer" class="windowContainer" action="javascript:onActivitySave()">
            <div class="activityWindowHeader">
                <p id="activityWindowTimeDisplay" class="viewMode">...</p>
                <p id="activityWindowActivityTypeDisplay" class="viewMode">...</p>
                <div class="activityWindowTimeEdit editMode">
                    <input id="activityWindowHoursInput" value="0" type="number" min="0" step="1" required/>
                    <p>h</p>
                    <input id="activityWindowMinutesInput" value="0" type="number" min="0" max="59" step="1" required/>
                    <p>m</p>
                </div>
                <select id="activityWindowActivityTypeInput" class="editMode" required></select>
                <button id="activityWindowDeleteBtn" type="button"></button>
            </div>
            <p id="activityWindowDescription" class="viewMode">...</p>
            <textarea required maxlength="2000" placeholder="Description" id="activityWindowDescriptionInput" class="editMode"></textarea>
            <div class="activityWindowButtons">
                <button id="activityWindowCancel" type="button">Annuler</button>
                <button class="activityWindowSubmit editMode" type="submit">Enregistrer</button>
                <button id="activityWindowEditBtn" class="viewMode" type="button">Modifier</button>
            </div>
        </form>
    </div>
@endsection