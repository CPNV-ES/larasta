<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Flock extends Model
{
    public $timestamps = false;   
    /**
     * Relation with the students
     * Return students by alphababetical order of initials
     */
    public function students ()
    {
        return $this->hasMany('App\Person', 'flock_id')
            ->orderBy('initials');
    }

    /**
     * Relation to get the class teacher
     */
    public function classMaster ()
    {
        return $this->belongsTo('App\Person', 'classMaster_id');
    }

    private static function getYearsOfFlocksOnInternship()
    {
        $today = Carbon::now();

        //interships of the flock of the previous year 
        $augustPreviousYear = new Carbon('first day of august');
        $augustPreviousYear->subYear(1);
        $january = new Carbon('last day of january');

        $year = Carbon::now()->subYear(1)->year;

        if ( $today->between($augustPreviousYear, $january) )
            $year = Carbon::now()->year;
            
        return substr($year,-2);
    }

    public static function getFlocksOnInternships()
    {
        return self::where('startYear', self::getYearsOfFlocksOnInternship())->get();
    }    
}
