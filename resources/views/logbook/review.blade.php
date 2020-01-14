@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endsection

@section('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "normal", "internshipId" => $internship->id])
@endsection

@section('content')
    <div class="reviewerContainer">
        @foreach($activitiesByWeeks as $weekStart => $week)
        <!--week-->
            <p class="reviewWeekSeparator">From {{$week["dateObj"]->toDateString()}} to {{$week["dateObj"]->endOfWeek()->toDateString()}}</p>
            @foreach ($week as $key => $day)
                @php 
                    if($key == "dateObj"){
                        continue;
                    } 
                    //$dayObject = new Carbone //ta maman
                @endphp
                <!--day-->
                <div class="reviewDay">
                    <p class="reviewDayTitle">Day: {{$key}}</p>
                    @foreach ($day as $activity)
                        <!--activity-->
                        <div class="reviewActivity">
                            {{gettype($activity->dateObj)}}
                            {{"a"/*$activity->dateObj->locale("fr")->dayName*/}}
                            {{$activity->activityDescription}}
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endforeach
    </div>
@endsection