<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;

    /**
     * @description A Location has many persons
     * @return All persons with our Location
     */
    public function persons()  //ici, idéalement utiliser un terme pour votre liaison, pour notre cas on souhaite avoir les entreprises d'où le choix de companies
    {
        return $this->hasMany("App\Persons","location_id");
    }
    /**
     * @description A Location has many companies
     * @return All companies with our Location
     */
    public function companies()  //ici, idéalement utiliser un terme pour votre liaison, pour notre cas on souhaite avoir les entreprises d'où le choix de companies
    {
        return $this->hasMany("App\Persons","location_id");
    }
}
