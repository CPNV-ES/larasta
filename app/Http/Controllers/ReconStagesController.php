<?php
//------------------------------------------------------------
// Nicolas Henry
// SI-T1a
// ReconStagesController.php
//------------------------------------------------------------


namespace App\Http\Controllers;

use App\Contract;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Faker\Provider\DateTime;
use App\Contractstate;
use App\Flock;
use App\Internship;
use Carbon\Carbon;
use App\Params;
use App\Person;

class ReconStagesController extends Controller
{
    // index, base route
    public function index()
    {        
        $datesOfNextInternship = Internship::getDatesOfNextInternship();

        $contractstates = Contractstate::where('openForRenewal',1)->orderBy('id')->get()->pluck('id'); // all internships where contractstate has ready to renewal
        $internships = Internship::whereIn('contractstate_id', $contractstates)->get();
        $internships = $internships->whereNotIn('id',Internship::all()->pluck('previous_id')); //get only internships that haven't reconducted (id not found in other previous_id of internship table)

        return view('reconstages.reconstages')->with(compact("internships", "datesOfNextInternship"));
    }

    /* Page called by reconstages.reconducted */
    public function reconducted(Request $request)
    {
        $beginDate = Carbon::parse($request->input("beginDate"));
        $endDate = Carbon::parse($request->input("endDate"));

        $currentMonth = $beginDate->month;
        $february = new Carbon('first day of february');
        $february = $february->month;

        $july = new Carbon('last day of july');
        $july = $july->month;
        
        $i = 0;
        foreach ($request->internships as $value) {
            $i++;
            
            $salary = Params::getParamByName('internship1Salary')->paramValueInt;
            if ($currentMonth >= $february && $currentMonth <= $july) {
                $salary = Params::getParamByName('internship2Salary')->paramValueInt;
            }

            $old = Internship::find($value);
            /* Create new internship with old value */
            $new = new Internship();
            $new->companies_id = $old->company->id;
            $new->beginDate = $beginDate;
            $new->endDate = $endDate;
            $new->responsible_id = $old->responsible->id;
            $new->admin_id = $old->admin->id;
            $new->intern_id = null;
            $new->contractstate_id = Contractstate::where('stateDescription','Reconduit')->first()->id;
            $new->previous_id = $value;
            $new->internshipDescription = $old->internshipDescription;
            $new->grossSalary = $salary;
            $new->contractGenerated = "0000-01-01 00:00:00";
            $new->save();
        }

        $internships = Internship::orderBy('id', 'desc')->take($i)->get();
        
        return view('reconstages.reconmade')->with(compact('internships'));
    }

    //get params by name and show the first
    private function getParamByName($name)
    {
        $param = Params::where('paramName', $name)
            ->first();
        return $param;
    }
}
