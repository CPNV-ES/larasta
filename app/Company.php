<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    /**
     * Relation with the internships model
     */
    public function internships()
    {
        return $this->hasMany('App\Internship');
    }
}
