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
     * Eloquent will automatically convert this column of the model in Carbon dates
     */
    protected $dates = ['beginDate', 'endDate'];

    /**
     * Relation with the visit model
     */
    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Relation to retrieve the companies
     */
    public function companies()
    {
        return $this->belongsTo('App\Company', 'companies_id');
    }

    /**
     * Relation to retrieve the student
     */
    public function student()
    {
        return $this->belongsTo('App\Persons', 'intern_id');
    }

    /**
     * Relation to retrieve the internship master
     */
    public function responsible()
    {
        return $this->belongsTo('App\Persons', 'responsible_id');
    }

    /**
     * Relation to retrieve the internship admin
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
        return $this->belongsTo('App\Contractstate');
    }
}
