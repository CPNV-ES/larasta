<div class="larastable">
    <div class="logbookTips">
        <div class="logbookTip">
            <div class="logbookTipColor bgNotEnoughWords"></div>
            <p class="wordCountTipText">Nombre de mots insuffisant</p>
        </div>
        <div class="logbookTip">
            <div class="logbookTipColor bgNotEnoughHours"></div>
            <p class="wordCountTipText">Nombre d'heures insuffisantes</p>
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
        <button id="logbookCustomizeBtn">Customize</button>
    </div>
</div>