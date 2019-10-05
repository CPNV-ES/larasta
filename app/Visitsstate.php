<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitsstate extends Model
{
    public $timestamps = false;

    public function visit()
    {
        return $this->hasMany('App\Visit');
    }
    //
}
