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
        $activities = Logbook::where("internships_id", $internshipId)->with('activitytype')->get();
        return $activities;
    }
    public function getActivity($activityId){
        $activity = Logbook::where("id", $activityId)->with('activitytype')->first();
        return $activity;
    }
    public function addActivity(Request $request, $internshipId){
        dd($internshipId, $request);
        return false;
    }
    public function updateActivity(Request $request, $activityId){
        echo "sdagdashd";
        dd($activityId, $request);
        return false;
    }
}
