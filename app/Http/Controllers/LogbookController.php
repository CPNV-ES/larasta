<?php

namespace App\Http\Controllers;

use App\Internship;
use Illuminate\Http\Request;
use App\Logbook;
use App\Activitytype;

class LogbookController extends Controller
{
    public function view($iid){
        $internship = Internship::where("id", $iid)->first();
        return view('logbook/logbook')->with(["internship" => $internship]);
        //⛔🌈
    }

    public function getActivities($internshipId){
        $activities = Logbook::where("internships_id", $internshipId)
            ->with('activitytype')
            ->orderBy("entryDate", "asc")
            ->get();
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
}
