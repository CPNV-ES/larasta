<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model
{
    public $timestamps = false;

    /**
     * Relation with the Internship model
     */
    public function internship()
    {
        return $this->belongsTo('App\Internship', 'internships_id');
    }
}
