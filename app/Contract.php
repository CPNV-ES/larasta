<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $timestamps = false;

    public function companies()
    {
        return $this->hasMany("App/Companies","contracts_id");
    }

}
