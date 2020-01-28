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

class LogbookController extends Controller
{
    public function index($internshipId)
    {
        $internship = Internship::fromId($internshipId);
        if(!$internship){
            abort(404, "internship not found");
        }
        $student = Person::fromId($internship->intern_id);
        return view('logbook/index')->with(compact("internship", "student"));
        //⛔🌈
    }
    public function reviewMode($internshipId)
    {
        $internship = Internship::fromId($internshipId);
        $activities = $this->getActivities(new Request(), $internshipId);
        $student = Person::fromId($internship->intern_id);

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
    private function getDayPatchedWithConditionsCompliance($day)
    {
        $activitiesCount = 0;
        $hoursCount = 0;
        $notEnoughWordsPerHour = false;
        foreach ($day as $activityKey => $activity) {
            $activitiesCount++;
            $hoursCount+=$activity->duration;
            //activity compliance
            if ($activity->duration != 0) {
                $wordsPerHour = str_word_count($activity->activityDescription) / $activity->duration;
                if ($wordsPerHour < Logbook::MIN_WORDS_PER_HOUR) {
                    $notEnoughWordsPerHour = true;
                    $day[$activityKey]["extra"]["conditionsCompliance"] = [
                        "level" => 10,
                        "message" => Logbook::COMPLIANCE_LEVELS[10]
                    ];
                }
            }
            //day compliance
            $complianceLevel = 0;
            if($notEnoughWordsPerHour){
                $complianceLevel = 10;
            }
            if($activitiesCount < Logbook::MIN_ACTIVITIES_PER_DAY){
                $complianceLevel = 20;
            }
            if($hoursCount < Logbook::MIN_HOURS_PER_DAY){
                $complianceLevel = 30;
            }
        }
    }
}
