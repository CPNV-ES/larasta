@php 
    use Carbon\Carbon; 
    Carbon::setUtf8(true);
    setlocale(LC_TIME, 'French');
@endphp

@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endsection

@section('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "normal", "internshipId" => $internship->id])
@endsection

@section('content')
<h1>Stage de {{$student->full_name}}</h1>
<h2>{{$internship->company->companyName}}</h2>
    <div class="reviewerContainer">
        <!--weeks-->
        @foreach ($activitiesByWeeks as $weekDate=>$week)
            @php
                $weekDateObj = new Carbon($weekDate);
                $weekStartDate = $weekDateObj->copy()->startOfWeek();
                $weekEndDate = $weekDateObj->copy()->endOfWeek();
                $weekStartDateStr = $weekStartDate->formatLocalized('%d %B');
                $weekEndDateStr = $weekEndDate->formatLocalized('%d %B %Y');
            @endphp
            <p class="reviewWeekSeparator">Semaine du {{$weekStartDateStr}} au {{$weekEndDateStr}}</p>
            <div class="reviewWeek">
                <!--days-->
                @foreach ($week->reverse() as $dayKey => $day)
                    <div class="reviewDay">
                    <p class="reviewDayTitle">{{ucfirst($day[0]->entryDate->formatLocalized("%A"))}}</p>
                        <div class="reviewDayActivitiesContainer">
                            <!--activities-->
                            @foreach ($day as $activityKey => $activity)
                                <div class="reviewActivity">
                                    <div class="reviewActivityInfos">
                                        <p class="reviewActivityDuration">{{\App\Services\DurationHelper::getPrettyTime($activity->duration)}}</p>
                                        <p class="reviewActivityType">{{$activity->activityType->typeActivityDescription}}</p>
                                    </div>
                                    <p class="reviewActivityDescription">{{$activity->activityDescription}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection