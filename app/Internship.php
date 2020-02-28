<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Internship extends Model implements HasMedia
{
    use HasMediaTrait;
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
     * Relation with the Visit model
     */
    public function visit()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Relation with the Companies model
     */
    public function company()
    {
        return $this->belongsTo('App\Company', 'companies_id');
    }

    /**
     * Relation with the Person model : student
     */
    public function student()
    {
        return $this->belongsTo('App\Person', 'intern_id');
    }

    /**
     * Relation with the Person model : internship master
     */
    public function responsible()
    {
        return $this->belongsTo('App\Person', 'responsible_id');
    }

    /**
     * Relation with the Person model : internship admin
     */
    public function admin()
    {
        return $this->belongsTo('App\Person', 'admin_id');
    }

    /**
     * Relation with the Contractstates model
     */
    public function contractstate()
    {
        return $this->belongsTo('App\Contractstate');
    }
}
