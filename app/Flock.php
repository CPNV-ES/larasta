<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flock extends Model
{
    public $timestamps = false;   
    /**
     * Relation with the students
     */
    public function students ()
    {
        return $this->hasMany('App\Person', 'flock_id');
    }

    /**
     * Relation to get the class teacher
     */
    public function classMaster ()
    {
        return $this->belongsTo('App\Person', 'classMaster_id');
    }
}
