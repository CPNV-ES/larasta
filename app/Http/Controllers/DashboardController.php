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
                $internships = $this->getMyInternships(Auth::user()->id);
                $visits = $this->getMyVisits(Auth::user()->id);
                return view('dashboard/dashboard')->with(['internships' => $internships, 'visits' => $visits]);
                
            }
            //User is a student
            elseif(Auth::user()->role = 0){
                return view('dashboard/dashboard')->compact($this->getMyInternships(Auth::user()->id));
            }
                
            else{
                
                return redirect()->route('internships.index');
            }
        }else{
            return view('dashboard/dashboard');
        }
    }

    public function getMyInternships($id){
        //Get Responsible's internships 
        if(Auth::user()->role == 1){
            $internships = Internship::all()->where('responsible_id', $id);

        //Get Student's internships
        }elseif (Auth::user()->role == 0){
            $internships = Internship::all()->where('intern_id', $id);
        }

        return $internships;
    }

    public function getMyVisits($id){

        if(Auth::user()->role == 1){
            //Eloquent query gets all the visits from teacher ID that are not in the state 'Bouclée'
            $visits = Visit::whereHas('internship.student.flock',function($query) use ($id){
                $query->where('responsible_id',$id)->where('visitsstates_id','!=', '4'); 
            })->get();

        }elseif(Auth::user()->role == 0){

        }
        
        return $visits;
    }

}