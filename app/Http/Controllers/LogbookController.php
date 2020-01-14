<?php

namespace App\Http\Controllers;

use App\Internship;
use Illuminate\Http\Request;
use App\Logbook;
use App\Activitytype;
use Carbon\Carbon;

class LogbookController extends Controller
{
    public function index($internshipId){
        $internship = Internship::fromId($internshipId);
        return view('logbook/index')->with(["internship" => $internship]);
        //⛔🌈
    }
    public function reviewMode($internshipId){
        $internship = Internship::fromId($internshipId);
        $activities = $this->getActivities(new Request(), $internshipId);
        //separate by week and date
        $activitiesByWeeks = [];
        foreach($activities as $activity){
            $activityDate = new Carbon($activity->entryDate);
            $dayStr = $activityDate->toDateString();
            $weekStart = $activityDate->startOfWeek();
            $weekStartStr = $weekStart->toDateString(); //warning! this mutes the var because Carbon is nonsense
            if(!isset($activitiesByWeeks[$weekStartStr])){
                $activitiesByWeeks[$weekStartStr] = ["dateObj" => $weekStart];
            }
            if(!isset($activitiesByWeeks[$weekStartStr][$dayStr])){
                $activitiesByWeeks[$weekStartStr][$dayStr] = [];
            }
            array_push($activitiesByWeeks[$weekStartStr][$dayStr], $activity);
        }
        //dd($activitiesByWeeks);

        return view('logbook/review')->with(["activitiesByWeeks" => $activitiesByWeeks, "internship" => $internship]);
    }

    //api
    public function getActivities(Request $request, $internshipId){
        $activitiesRequest = Logbook::where("internships_id", $internshipId)
            ->with('activitytype')
            ->orderBy("entryDate", "desc");

        $this->patchRequestWithGetParams($activitiesRequest, $request);

        $activities = $activitiesRequest->get();
        return $activities;
    }
    public function getActivity($activityId){
        $activity = Logbook::where("id", $activityId)->with('activitytype')->first();
        return $activity;
    }
    public function addActivity(Request $request, $internshipId){
        //create and save new activity
        $newActivity = Logbook::fromRequest($internshipId, $request);
        $newActivity->save();
        return $newActivity;
    }
    public function updateActivity($activityId){
        //parses PUT body content into $dataArray
        parse_str(file_get_contents('php://input'), $dataArray);
        $dataRequest = (object)$dataArray;

        //update activity
        $activity = self::getActivity($activityId);
        if(!$activity){
            abort(400, "invalid id");
            return;
        }
        $activity->applyData($dataRequest);
        $activity->save();

        return $activity;
    }
    public function deleteActivity($activityId){
        $activity = self::getActivity($activityId);
        if(!$activity){
            return ["state" => "error", "error" => "activity is undefined"];
        }
        $activity->delete();
        return ["state" => "success", "id" => $activityId];
    }

    //util
    private function patchRequestWithGetParams(\Illuminate\Database\Eloquent\Builder $eloqRequest, Request $routeRequest){
        foreach($routeRequest->request->keys() as $key){
            $value = $routeRequest->request->get($key);
            $params = json_decode($value);
            if($params == null){//use value
                $eloqRequest->where($key, "=", $value);
            }
            //use range
            if(isset($params->from)){
                $eloqRequest->where($key, ">=", $params->from);
            }
            if(isset($params->to)){
                $eloqRequest->where($key, "<=", $params->to);
            }
        }
    }
}
