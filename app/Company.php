<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    /**
     * @description A company has many internships
     * @return All internships of our company
     */
    public function internship()
    {
        return $this->hasMany('App\Internship');
    }

    /**
     * @description A contract belong to company
     * @return the contract of company
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }
    /**
     * @description A Location belong to Company
     * @return the location of company
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Relation with the contractstate model
     */
    public function contractstates()
    {
        return $this->belongsToMany('App\Contractstate', 'internships',
            'companies_id', 'contractstate_id');
    }
}