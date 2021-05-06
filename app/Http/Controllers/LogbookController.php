<?php

namespace App\Http\Controllers;

use App\Internship;
use App\Logbook;
use App\Person;
use Illuminate\Http\Request;
use \Illuminate\Database\Eloquent\Builder;
use App\Activitytype;
use Carbon\Carbon;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index($internshipId)
    {
        $internship = Internship::findOrFail($internshipId);
        $student = Person::find($internship->intern_id);
        if($internship->externalLogbook){
            $logbookFileUrl = false;
            $media = $internship->getMedia('externalLogbook')->first();
            if($media){
                $logbookFileUrl = $media->getUrl();
            }
            return view('logbook/external')->with(compact("internship", "student", "logbookFileUrl"));
        }
        $activityTypes = Activitytype::orderBy("typeActivityDescription", "ASC")->get();
        $complianceConditions = json_encode([
            "min_words_per_hour" => Logbook::MIN_WORDS_PER_HOUR,
            "min_hours_per_day" => Logbook::MIN_HOURS_PER_DAY,
            "min_activities_per_day" => Logbook::MIN_ACTIVITIES_PER_DAY,
            "levels" => Logbook::COMPLIANCE_LEVELS
        ]);
        return view('logbook/index')->with(compact("internship", "student", "activityTypes", "complianceConditions"));
        //⛔🌈
    }
    public function reviewMode($internshipId)
    {
        $internship = Internship::find($internshipId);
        $activities = $this->getActivities(new Request(), $internshipId);
        $student = Person::find($internship->intern_id);

        $activitiesByDays = $activities->groupBy(function($activity){
            return $activity->entryDate->toDateString();
        });
        $activitiesByWeeks = $activitiesByDays->groupBy(function($day){
            $weekStart = $day->first()->entryDate->copy()->startOfWeek();
            return $weekStart->toDateString();
        });

        return view('logbook/review')->with(compact("activitiesByWeeks", "internship", "student"));
    }

    //api
    public function getActivities(Request $request, $internshipId)
    {
        $activitiesRequest = Logbook::where("internships_id", $internshipId)
            ->with('activitytype')
            ->orderBy("entryDate", "desc");

        $this->patchRequestWithGetParams($activitiesRequest, $request);

        $activities = $activitiesRequest->get();
        return $activities;
    }
    public function getActivity($activityId)
    {
        $activity = Logbook::where("id", $activityId)->with('activitytype')->first();
        return $activity;
    }
    public function addActivity(Request $request, $internshipId)
    {
        //create and save new activity
        $newActivity = Logbook::fromRequest($internshipId, $request);
        $newActivity->save();
        return $newActivity;
    }
    public function updateActivity($activityId)
    {
        //parses PUT body content into $dataArray
        parse_str(file_get_contents('php://input'), $dataArray);
        $dataRequest = (object) $dataArray;

        //update activity
        $activity = self::getActivity($activityId);
        if (!$activity) {
            return ["state" => "error", "error" => "invalid id"];
        }
        $activity->applyData($dataRequest);
        $activity->save();

        return $activity;
    }
    public function deleteActivity($activityId)
    {
        $activity = self::getActivity($activityId);
        
        if (!$activity) {
            return ["state" => "error", "error" => "invalid id"];
        }
        $activity->delete();
        return ["state" => "success", "id" => $activityId];
    }

    // save the feedbacks and acknowlegements done on the review mode of the journal
    public function saveFeedbacksAndAcknowledgements(Request $request, $internshipId){
        $internship = Internship::find($internshipId);
        
        if (Auth::user()->id == $internship->responsible->id){
            $feedbacks = [];
            $acknowledgements = [];
            $data = $request->all();
            
            //filter feedbacks and acknowledgement
            foreach($data as $key=>$value){
                if(preg_match('/fdbk-/', $key)){
                    $feedbacks[preg_replace('/fdbk-/', '', $key)] = $value;
                }elseif(preg_match('/ack-/', $key)){
                    $acknowledgements[preg_replace('/ack-/', '', $key)] = $value;
                }
            }

            //save feedbacks
            foreach($feedbacks as $key=>$value){
                $logbook = Logbook::find($key);
                $logbook->feedback = $value;
                $logbook->save();
            }  
            
            //save acknowledgements
            foreach($acknowledgements as $key=>$value){
                Logbook::where('entryDate', $key)
                ->update(['acknowledged' => $value]);
            } 
                
            return redirect()->route('logbook.saveFeedbacksAndAcknowledgements', $request->internshipId);
        
        }else{
            return redirect('/')->with('status', "You don't have the permission to access this function.");
        }
    
    }

    //util
    private function patchRequestWithGetParams(Builder $eloqRequest, Request $routeRequest)
    {
        foreach ($routeRequest->request->keys() as $key) {
            $value = $routeRequest->request->get($key);
            $params = json_decode($value);
            if ($params == null) { //use value
                $eloqRequest->where($key, "=", $value);
            }
            //use range
            if (isset($params->from)) {
                $eloqRequest->where($key, ">=", $params->from);
            }
            if (isset($params->to)) {
                $eloqRequest->where($key, "<=", $params->to);
            }
        }
    }
}
