<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public $timestamps = false;

    /**
     * Eloquent will automaticaly convert this colums of the model in Carbon dates
     */
    protected $dates = ['moment'];

    /**
     * Relation with the Evaluation model
     */
    public function evaluation()
    {
        return $this->hasMany('App\Evaluation');
    }

    /**
     * Relation with the internships model
     */
    public function internship()
    {
        return $this->belongsTo('App\Internship', 'internships_id');
    }

    /**
     * Relation with the visitsstate model
     */
    public function visitsstate()
    {
        return $this->HasMany('App\Visitsstate');
    }
}
