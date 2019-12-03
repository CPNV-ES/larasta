<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'id',
        'intern_id'
    ];


    /**
     * Eloquent will automaticaly convert this colums of the model in Carbon dates
     */
    protected $dates = ['beginDate', 'endDate'];

    /**
     * Relation with the vilit model
     */
    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * @description An internships belongs to a company
     * @return data of internship
     */
    public function company()
    {
        return $this->belongsTo('App\Company', 'companies_id');
    }

    /**
     * Relation to retrive the student
     */
    public function student()
    {
        return $this->belongsTo('App\Persons', 'intern_id');
    }

    /**
     * Relation to retrive the internship master
     */
    public function responsible()
    {
        return $this->belongsTo('App\Persons', 'responsible_id');
    }

    /**
     * Relation to retrive the internship admin
     */
    public function admin()
    {
        return $this->belongsTo('App\Persons', 'admin_id');
    }

    /**
     * Relation with the contractstates model
     */
    public function contractstate()
    {
        return $this->belongsTo('App\Contractstates', 'contractstate_id');
    }
}
