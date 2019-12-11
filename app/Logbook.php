<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    public function activitytype(){
        return $this->belongsTo('App\Activitytype', 'activitytypes_id');
    }
}
