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

    public function getYearsOfFlocksOnInternship()
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

                 
        $previousYear = Carbon::now()->subYear(1)->year ;
        $actualYear = Carbon::now()->year ;
        
        $flocksInInternship = array( $actualYear );

        if ( $today->between($augustPreviousYear, $january) )
            $flocksInInternship = array($previousYear);
        else 
            array_push( $flocksInInternship, $previousYear );

        return $flocksInInternship;
    }

    public function getFlockHasToGoOnInternships()
    {
        $flocksInInternship = $this->getYearsOfFlocksOnInternship();
        if(count($flocksInInternship)>1)
            $listOfFlocks = self::where('startYear',substr($flocksInInternship[0],2,4))->orwhere('startYear',substr($flocksInInternship[1],2,4))->get();
        else
            $listOfFlocks = self::where('startYear',substr($flocksInInternship[0],2,4))->get();
            dd($listOfFlocks);
            
        return $flocksInInternship;
    }
}
