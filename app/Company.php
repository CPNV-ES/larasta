<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    /**
     * Relation to the internship of the student
     */
    public function internships()
    {
        return $this->hasMany('App\Internship');
    }
}
