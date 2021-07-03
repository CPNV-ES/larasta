<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Internship;
use App\Person;
use App\Visit;
use App\Visitsstate;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            if (Auth::user()->role > 0){ //User is a Teacher
                $teachersInternships = $this->getMyInternships(Auth::user()->id);
                $teachersPastInternships = $this->getPastInterships(Auth::user()->id);
                $teachersVisits = $this->getClassMasterVisits(Auth::user()->id);
                return view('dashboard/dashboard')->with(['internships' => $teachersInternships, 'pastInternships' => $teachersPastInternships, 'visits' => $teachersVisits]);
            }else{ //User is a student
                $studentInternships = $this->getMyInternships(Auth::user()->id);
                return view('dashboard/dashboard')->with(['internships' => $studentInternships]);
            }
        }else{
            return view('dashboard/dashboard');
        }
    }

    //Get user Interships
    public function getMyInternships($id){
        //Get Class Master's internships
        if(Auth::user()->role > 0){
            $result = Internship::whereHas('student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id);
            })->orderBy('beginDate', 'DESC')->get();

        //Get Student's internships with the concerned visits
        }else{
            $result = Internship::where('intern_id', $id)->with('visits')->get();
        }

        return $result;
    }


    //Get Class Master's internships that are in contract state 'Effectué'
    public function getPastInterships($id){
        $result = Internship::whereHas('student.flock',function($query) use ($id){
            $query->where('classMaster_id',$id)->where('contractstate_id', '13');
        })->orderBy('beginDate', 'DESC')->get();

        return $result;
    }

    //Return the visit that concern the ClassMaster
    public function getClassMasterVisits($id){
        //Eloquent query gets all the visits from teacher ID that are not in the state 'Bouclée'
        $result = Visit::whereHas('internship.student.flock',function($query) use ($id){
            $query->where('classMaster_id',$id)->where('visitsstates_id','!=', '4');
        })->orderBy('moment', 'DESC')->get();

        return $result;
    }

}
