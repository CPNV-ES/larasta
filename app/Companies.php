<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    public $timestamps = false;

    /**
     * Relation to the internship of the student
     */
    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    public function contract()
    {
        return $this->hasMany('App\Contract');
    }
}
