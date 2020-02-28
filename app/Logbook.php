<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Logbook extends Model
{
    const MIN_WORDS_PER_HOUR = 5;
    const MIN_HOURS_PER_DAY = 4;
    //new!
    const MIN_ACTIVITIES_PER_DAY = 2;
    const COMPLIANCE_LEVELS = [
        0 => "ok",
        10 => "not_enough_words",
        20 => "not_enough_hours",
        30 => "not_enough_activities",
    ];

    /**
     * Eloquent will automatically convert this column of the model in Carbon dates
     */
    protected $dates = ['entryDate'];

    public $timestamps = false;
    
    public function activitytype(){
        return $this->belongsTo('App\Activitytype', 'activitytypes_id');
    }

    //build data from http request
    public static function fromRequest($internshipId, Request $request){
        $instance = new self();

        //test fields existence
        if(!isset($internshipId, $request->activitytypes_id, $request->entryDate, $request->duration, $request->activityDescription)){
            abort(400);
            return;
        }

        //set values
        $instance->internships_id = $internshipId;
        $instance->activitytypes_id = $request->activitytypes_id;
        $instance->entryDate = $request->entryDate;
        $instance->duration = $request->duration;
        $instance->activityDescription = $request->activityDescription;

        return $instance;
    }

    public function applyData($data){
        //only updates the provided data
        if(isset($data->activitytypes_id))
            $this->activitytypes_id = $data->activitytypes_id;
        if(isset($data->entryDate))
            $this->entryDate = $data->entryDate;
        if(isset($data->duration))
            $this->duration = $data->duration;
        if(isset($data->activityDescription))
            $this->activityDescription = $data->activityDescription;

        return $this;
    }
}
