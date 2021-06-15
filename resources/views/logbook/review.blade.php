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
    <script src="/js/logbookFeedbacksAndAcknowledges.js"></script>
@endpush

@push('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "normal", "internshipId" => $internship->id])
@endpush

@section('content')

@if(Auth::user()->id == $internship->student->flock->classMaster_id)
    {{ Form::open(array('url' => '/internships/'.$internship->id.'/logbook/review')) }}
@endif
<h1>Stage de {{$student->fullName ?? "Non attribué"}}</h1>
<h2>{{$internship->company->companyName}}</h2>
    <div class="reviewerContainer">

        @if(Auth::user()->id == $internship->student->flock->classMaster_id)
            <div class="col-12 text-center pt-2">
                <button id="save" class="btn btn-warning" type="submit" hidden>Quittancer et sauvegarder les retours</button>
            </div>
        @endif
        
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
                </div>
            </div>
            
            <div class="reviewWeek">
                <!--days-->
                @foreach ($week->reverse() as $dayKey => $day)
                    <div class="reviewDay">
                        <p class="reviewDayTitle pr-5">{{ucfirst($day[0]->entryDate->formatLocalized("%A"))}}</p>
                        
                           
                            @if($day[0]->acknowledged)
                                @if(Auth::user()->id == $internship->student->flock->classMaster_id)   
                                    {{Form::hidden('ack-'.$day[0]->entryDate, '0')}}
                                    {{Form::checkbox('ack-'.$day[0]->entryDate, true, 'checked' ,['class' => 'form-check-input', 'onclick' => "showSaveBtn()"])}}
                                @else
                                    <label class="form-check-label" for="flexCheckDefault">Lu</label>
                                @endif
                            @else
                                @if(Auth::user()->id == $internship->student->flock->classMaster_id)   
                                    {{Form::checkbox('ack-'.$day[0]->entryDate, true, '' ,['onclick' => "showSaveBtn()"])}}
                                @else
                                    <label class="form-check-label" for="flexCheckDefault">Non lu</label>
                                @endif
                            @endif
                       

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
                                        @if(!empty($activity->feedback))
                                            <div class="col-12">
                                                <h5 style="color: green; font-style: italic;">{{$activity->feedback}}</h5>   
                                            </div>

                                            @if(Auth::user()->id == $internship->student->flock->classMaster_id)
                                                <div class="col-12">
                                                    <i class="fas fa-edit"></i>
                                                    <button type="button" class="btn-success" style="min-width: 10px !important; height: 22px; border: none;" id="btnFdbk{{$activity->id}}" onclick="showFeedbackFields({{$activity->id}})"><img src="/images/edit.png" width="12px" height="12px"></button>
                                                    {{Form::textarea('fdbk-'.$activity->id, "$activity->feedback", ['id' => $activity->id, 'hidden', 'style' => 'width: 500px; height: 60px;'])}}
                                                </div>
                                            @endif
                                        @else
                                            @if(Auth::user()->id == $internship->student->flock->classMaster_id)
                                            <div class="col-12">
                                                <button type="button" class="btn-success" style="min-width: 10px !important;  height: 20px; border: none;" id="btnFdbk{{$activity->id}}" onclick="showFeedbackFields({{$activity->id}})"><img src="/images/add.png" width="12px" height="12px"></button>
                                                {{Form::textarea('fdbk-'.$activity->id, "", ['id' => $activity->id, 'hidden', 'style' => 'width: 500px; height: 60px;'])}}
                                            </div>
                                            @endif
                                        @endIf

                                    </div>                          
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    
{{ Form::close() }}
@endsection