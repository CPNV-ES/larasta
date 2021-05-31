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
            //User is a Teacher
            if (Auth::user()->role >= 1){
                $teachersInternships = $this->getMyInternships(Auth::user()->id);
                $teachersVisits = $this->getMyVisits(Auth::user()->id);
                return view('dashboard/dashboard')->with(['internships' => $teachersInternships, 'visits' => $teachersVisits]);
                
            }
            //User is a student
            elseif(Auth::user()->role == '0'){
                $studentInternships = $this->getMyInternships(Auth::user()->id);
                return view('dashboard/dashboard')->with(['internships' => $studentInternships]);
            }else{
                
                return redirect()->route('internships.index');
            }              
        }else{
            return view('dashboard/dashboard');
        }
    }

    public function getMyInternships($id){
        //Get Class Master's internships 
        if(Auth::user()->role == 1){
            $result = Internship::whereHas('student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id); 
            })->orderBy('beginDate', 'DESC')->get();

        //Get Student's internships
        }elseif (Auth::user()->role == 0){
            $result = Internship::where('intern_id', $id)->with('visits')->get();
        }
    
        return $result;
    }

    public function getMyVisits($id){
        //Teacher
        if(Auth::user()->role == 1){
            //Eloquent query gets all the visits from teacher ID that are not in the state 'Bouclée'
            $result = Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('classMaster_id',$id)->where('visitsstates_id','!=', '4');
            })->orderBy('moment', 'DESC')->get();
        }
        
        return $result;
    }

}