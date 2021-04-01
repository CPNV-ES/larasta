@php 
    use Carbon\Carbon; 
    Carbon::setUtf8(true);
    setlocale(LC_TIME, 'French');
@endphp

@extends ('layout')

@push('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endpush

@push ('page_specific_js')
    <script src="/js/logbookFeedback.js"></script>
@endpush

@push('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "normal", "internshipId" => $internship->id])
@endpush

@section('content')
<h1>Stage de {{$student->fullName ?? "Non attribué"}}</h1>
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
            <div class="reviewWeekSeparator">
                <div class="row">
                    <div class="col-9">
                        <h3>Semaine du {{$weekStartDateStr}} au {{$weekEndDateStr}}</h3>
                    </div>
                    <div class="col-3 text-right pr-5">
                        <button class="btn-success">Sauvegarder</button>
                    </div>
                </div>
            </div>
            
            <div class="reviewWeek">
                <!--days-->
                @foreach ($week->reverse() as $dayKey => $day)
                    <div class="reviewDay">
                    <p class="reviewDayTitle">{{ucfirst($day[0]->entryDate->formatLocalized("%A"))}}</p>
                        <input type="checkbox" name=""/>
                        <div class="reviewDayActivitiesContainer">
                            <!--activities-->
                            @foreach ($day as $activityKey => $activity)
                                <div class="reviewActivity">
                                    <div class="reviewActivityInfos">
                                        <p class="reviewActivityDuration">{{\App\Services\DurationHelper::getPrettyTime($activity->duration)}}</p>
                                        <p class="reviewActivityType">{{$activity->activityType->typeActivityDescription}}</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="reviewActivityDescription">{{$activity->activityDescription}}</p>   
                                        </div>
                                        <div class="col-12">
                                            <h5 style="color: green; font-style: italic;">Exemple d'un feedback fait par le responsable</h5>   
                                        </div>
                                        <div class="col-12">
                                            <button class="btn-success">Feedback</button>
                                            <input type="text" name="{{$activity->id}}" value="" onkeyup="getFeedbacks(this)"/>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection