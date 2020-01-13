@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endsection

@section ('page_specific_js')
    <script src="/js/logbook.js"></script>
    
    <!--vars passed at page load-->
    <script>
        var internshipId = {{$internship->id}};
    </script>
@endsection

@section('sidemenu')
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
            <button id="logbookDisplayModeBtn">Review Mode</button><br/>
            <button id="logbookCustomizeBtn">Customize</button>
        </div>
    </div>
@endsection

@section ('content')

@endsection