<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactinfos extends Model
{
    public $timestamps = false;

    /**
     * Relation to the contactinfos of the contacttypes
     */
    public function contacttype()
    {
        return $this->belongsTo('App\Contacttypes','contacttypes_id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person','persons_id');
    }
}
