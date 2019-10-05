<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactinfos extends Model
{
    public $timestamps = false;

    //
    /**
     * Relation to the teacher/student 
     */
    public function person()
    {
        return $this->belongTo('App\Persons','persons_id');
    }

    
}
