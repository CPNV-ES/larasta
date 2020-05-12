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
        return view('reconstages.reconstages')->with(compact("internships", "datesOfNextInternship"));
    }

    /* Page called by reconstages.reconducted */
    public function reconducted(Request $request)
    {
        $i = 0;
        foreach ($request->internships as $value) {
            $i++;
            $chosen[] = $value;

            $datesOfNextInternship = Internship::getDatesOfNextInternship();
            $newInternshipDate1 = array_first($datesOfNextInternship);
            $newInternshipDate2 = array_last($datesOfNextInternship);

            $old = Internship::find($value);
            $oldMonth = Carbon::createFromFormat('Y-m-d H:i:s', $old->beginDate);

            $salary = Params::getParamByName('internship1Salary')->paramValueInt;
            if ($oldMonth->month > 9) {
                $salary = Params::getParamByName('internship2Salary')->paramValueInt;
            }

            /* Create new internship with old value */
            $new = new Internship();
            $new->companies_id = $old->company->id;
            $new->beginDate = $newInternshipDate1;
            $new->endDate = $newInternshipDate2;
            $new->responsible_id = $old->responsible->id;
            $new->admin_id = $old->admin->id;
            $new->intern_id = null;
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
