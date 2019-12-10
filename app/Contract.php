<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $timestamps = false;

    /**
     * @description A contract has many companies
     * @return All companies with our contract
     */
    public function companies()
    {
        return $this->hasMany("App\Company","contracts_id");
    }

}
