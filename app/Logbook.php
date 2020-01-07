<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Logbook extends Model
{
    public $timestamps = false;
    public function activitytype(){
        return $this->belongsTo('App\Activitytype', 'activitytypes_id');
    }

    //build data from http request
    public static function fromRequest($internshipId, Request $request){
        $instance = new self();

        //test fields existence
        if(!isset($internshipId, $request->activityType, $request->entryDate, $request->duration, $request->description)){
            abort(400);
        }

        //set values
        $instance->internships_id = $internshipId;
        $instance->activitytypes_id = $request->activityType;
        $instance->entryDate = $request->entryDate;
        $instance->duration = $request->duration;
        $instance->activityDescription = $request->description;

        return $instance;
    }

    public function applyData($data){
        //only updates the provided data
        if(isset($data->activityType))
            $this->activitytypes_id = $data->activityType;
        if(isset($data->entryDate))
            $this->entryDate = $data->entryDate;
        if(isset($data->duration))
            $this->duration = $data->duration;
        if(isset($data->description))
            $this->activityDescription = $data->description;

        return $this;
    }
}
