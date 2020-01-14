<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactinfos extends Model
{
    public $timestamps = false;

    /**
     * Relation to the contactinfos of the contacttypes
     */
    public function contacttypes()
    {
        return $this->hasMany('App\contacttypes');
    }
}
