<div class="larastable">
    <div class="logbookTips">
        <div class="logbookTip">
            <div class="logbookTipColor bgNotEnoughActivities">{{\App\Logbook::MIN_ACTIVITIES_PER_DAY}} activités</div>
            <p class="wordCountTipText">Pas assez d'activités</p>
        </div>
        <div class="logbookTip">
            <div class="logbookTipColor bgNotEnoughHours">{{\App\Logbook::MIN_HOURS_PER_DAY}} heures</div>
            <p class="wordCountTipText">Nombre d'heures insuffisantes</p>
        </div>
        <div class="logbookTip">
            <div class="logbookTipColor bgNotEnoughWords">{{\App\Logbook::MIN_WORDS_PER_HOUR}} mots/h</div>
            <p class="wordCountTipText">Nombre de mots insuffisant</p>
        </div>
        <div class="logbookTip">
            <div class="logbookTipColor bgLogbookOk"></div>
            <p class="wordCountTipText">Ok</p>
        </div>
    </div>
    <div class="logbookActions">
        @if(isset($internshipId) && isset($modeBtnAction))
            @if($modeBtnAction == "review")
                <a href="{{route('logbookReview', ['internshipId' => $internshipId])}}"><button id="logbookDisplayModeBtn">Review Mode</button></a>
            @else
                <a href="{{route('logbookIndex', ['internshipId' => $internshipId])}}"><button id="logbookDisplayModeBtn">Normal Mode</button></a>
            @endif
        @endif
        <br/>
        <!--<button id="logbookCustomizeBtn">Customize</button>-->
    </div>
</div>