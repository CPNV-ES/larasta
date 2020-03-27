<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytype extends Model
{
    //
    public function activities(){
        return $this->hasMany("App\Internship", "activitytypes_id");
    }
    public static function getDynamicId(){
        //if not exists, creates then returns id, else just returns id
        return false;
    }
}
