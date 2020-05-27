<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Carbon\Carbon;

class Internship extends Model implements HasMedia
{
    use InteractsWithMedia;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'intern_id',
        "beginDate",
        "endDate",
        "internshipDescription",
        "admin_id",
        "responsible_id",
        "contractstate_id",
        "grossSalary",
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

    static function fromId($internshipId)
    {
        return self::where("id", $internshipId)
        ->with("company")
        ->first();
    }
    
    public static function getDatesOfNextInternship()
    {
        $today = Carbon::now();
        //interships of the flock of the previous year 
        $augustPreviousYear = new Carbon('first day of august');
        $augustPreviousYear->subYear(1);
        $january = new Carbon('last day of january');

        //interships of flocks of the current and previous year 
        $february = new Carbon('first day of february');
        $july = new Carbon('last day of july');

        //interships of the flock of the current year 
        $august = new Carbon('first day of august');
        $januaryNextYear = new Carbon('last day of january');
        $januaryNextYear->addYear(1);

        //interships of flocks of the current and previous year 
        $februaryNextYear = new Carbon('first day of february');
        $februaryNextYear->addYear(1);
        $julyNextYear = new Carbon('last day of july');
        $julyNextYear->addYear(1);

        if ( $today->between($augustPreviousYear, $january) )
        {
            $nextInternship = array($february->toDateString(), $july->toDateString());
        }
        else if ( $today->between($february, $july) )
        {
            $nextInternship = array($august->toDateString(), $januaryNextYear->toDateString());
        }
        else if ( $today->between($august, $januaryNextYear) )
        {
            $nextInternship = array($februaryNextYear->toDateString(), $julyNextYear->toDateString());
        }

        return $nextInternship;
    }
}
