<?php
//------------------------------------------------------------
// Nicolas Henry
// SI-T1a
// ReconStagesController.php
//------------------------------------------------------------


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Provider\DateTime;
use App\Contractstate;
use App\Internship;
use Carbon\Carbon;
use App\Params;
use App\Person;

class ReconStagesController extends Controller
{
    // index, base route
    public function index()
    {
        $states = $this->getContract(1);
        $internships = Internship::all()->whereIn('contractstate_id', $states);

        return view('reconstages.reconstages')->with(compact("internships"));
    }

    /* Get the contract */
    public function getContract($value) {
        $contractStates = Contractstate::all();
        foreach ($contractStates as $contract) {
            if ($contract->openForRenewal === $value) {
                $states[] = $contract->id;
            }
        }
        /* Contract states by openForRenewal */
        return $states;
    }

    /* Page called by reconstages.reconmade */
    public function reconducted(Request $request) {
        $i = 0;
        $yearToSub = Carbon::createFromFormat('Y-m-d H:i:s', Params::getParamByName('internship1Start')->paramValueDate);
        $yearToSub = $yearToSub->year;
        /* 
            Prendre mois stage en cours et check avec mois start db
            comparer, si egale, changer, sinon, utiliser la date de la db
            Attention à l'année dans la db est à 2000, changer pour la date de stage.
        */

        foreach($request->internships as $value) {
            $i++;
            $chosen[] = $value;

            /* Get value of chosen one */
            $old = Internship::find($value);
            $internship1Start = Carbon::createFromFormat('Y-m-d H:i:s', Params::getParamByName('internship1Start')->paramValueDate);
            $internship1End = Carbon::createFromFormat('Y-m-d H:i:s', Params::getParamByName('internship1End')->paramValueDate);
            $internship2Start = Carbon::createFromFormat('Y-m-d H:i:s', Params::getParamByName('internship2Start')->paramValueDate);
            $internship2End = Carbon::createFromFormat('Y-m-d H:i:s', Params::getParamByName('internship2End')->paramValueDate);

            $oldMonth = Carbon::createFromFormat('Y-m-d H:i:s', $old->beginDate);
            if ($internship1Start->month == $oldMonth->month) {
                /* Change year for the end */
                $newInternshipDate1 = $internship2Start->subYear($yearToSub)->addYear(Carbon::now()->year);
                $newInternshipDate2 = $internship2End->subYear($yearToSub)->addYear(Carbon::now()->year + 1);
                $salary = Params::getParamByName('internship2Salary')->paramValueInt;
                
            } else if ($internship2Start->month == $oldMonth->month) {
                $newInternshipDate1 = $internship1Start->subYear($yearToSub)->addYear(Carbon::now()->year);
                $newInternshipDate2 = $internship1End->subYear($yearToSub)->addYear(Carbon::now()->year);
                $salary = Params::getParamByName('internship1Salary')->paramValueInt;
            } else if ($oldMonth->month > 9){
                /* Change year for the end */
                $newInternshipDate1 = $internship2Start->subYear($yearToSub)->addYear(Carbon::now()->year);
                $newInternshipDate2 = $internship2End->subYear($yearToSub)->addYear(Carbon::now()->year + 1);
                $salary = Params::getParamByName('internship2Salary')->paramValueInt;
            } else {
                $newInternshipDate1 = $internship1Start->subYear($yearToSub)->addYear(Carbon::now()->year);
                $newInternshipDate2 = $internship1End->subYear($yearToSub)->addYear(Carbon::now()->year);
                $salary = Params::getParamByName('internship1Salary')->paramValueInt;
            }
            
            /* Create new internship with old value */
            $new = new Internship();
            $new->companies_id = $old->company->id;
            $new->beginDate = $newInternshipDate1;
            $new->endDate = $newInternshipDate2;
            $new->responsible_id = $old->responsible->id;
            $new->admin_id = $old->admin->id;
            $new->intern_id = $old->student->id;
            $new->contractstate_id = 2;
            $new->previous_id = $value;
            $new->internshipDescription = $old->internshipDescription;
            $new->grossSalary = $salary;
            $new->contractGenerated = "0000-01-01 00:00:00";
            $new->save();
        }

        $last = Internship::orderBy('id', 'desc')->take($i)->get();
        $selected = Internship::all()->whereIn('id', $chosen);
        return view('reconstages.reconmade')->with(compact('selected', 'last'));
    }

    //get params by name and show the first
    private function getParamByName($name)
    {
        $param = Params::where('paramName', $name)
        ->first();
        return $param;
    }


}
