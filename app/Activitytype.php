<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytype extends Model
{
    public function activities(){
        return $this->hasMany("App\Internship", "activitytypes_id");
    }
}
