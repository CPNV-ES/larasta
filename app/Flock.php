<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Flock extends Model
{
    public $timestamps = false;   
    /**
     * Relation with the students
     * Return students by alphababetical order of initials
     */
    public function students ()
    {
        return $this->hasMany('App\Person', 'flock_id')
            ->orderBy('initials');
    }

    /**
     * Relation to get the class teacher
     */
    public function classMaster ()
    {
        return $this->belongsTo('App\Person', 'classMaster_id');
    }
}
