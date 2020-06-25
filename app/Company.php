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
        return $this->hasMany('App\Internship', 'companies_id');
    }

    public function person()
    {
        return $this->hasMany('App\Person', 'company_id');
    }

    /**
     * @description A contract belong to company
     * @return the contract of company
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract',"contracts_id");
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

    public function getCompanyByLastInternships()
    {
        return $this->has('internship')->get()->sortByDesc(function ($company){
            return $company->internship->max('endDate');
        });
    }
}