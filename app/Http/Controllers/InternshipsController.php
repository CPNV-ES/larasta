<?php


namespace App\Http\Controllers;

use App\Contractstates;
use App\Lifecycles;
use App\Company;
use App\Internship;
use App\Person;
use Carbon\Carbon;
use CPNVEnvironment\Environment;
use CPNVEnvironment\InternshipFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class InternshipsController extends Controller
{
    // index, base route
    /**
     * Retrieve filtering criteria from cookie, creat an empty one if needed
     *
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $internshipFilter = new InternshipFilter();
        // Retrieve filter conditions from cookie (or initialize them from database)
        $cookie = $request->cookie('filter');
        if ($cookie == null)
            return $this->changeFilter($request);
        else
            $internshipFilter = unserialize($cookie);

        return $this->filteredInternships($internshipFilter);
    }

    /**
     * Some filtering parameter has changed (or filter is empty)
     *
     * @param Request $request
     * @return $this
     */
    public function changeFilter(Request $request)
    {
        $ifilter = new InternshipFilter();

        // Get states from db (to have descriptions)
        $filter = DB::table('contractstates')->select('id', 'stateDescription')->get();
        // patch list with values from post
        foreach ($filter as $state) {
            $state->checked = false;
            foreach ($request->all() as $fname => $fval) {
                if (substr($fname, 0, 5) == 'state') {
                    if ($state->id == intval(substr($fname, 5))) {
                        $state->checked = ($fval == 'on');
                    }
                }
            }
            $list[] = $state;
        }
        $ifilter->setStateFilter($list);

        // Handle cases that are not states rom the database
        $ifilter->setInProgress(isset($request->all()['inprogress']) ? 1 : 0);
        $ifilter->setMine(isset($request->all()['mine']) ? 1 : 0);

        Cookie::queue('filter', serialize($ifilter), 3000);

        return $this->filteredInternships($ifilter);
    }

    /**
     * Build list of internships that match the filter - and display it
     * @param InternshipFilter $internshipFilter
     * @return $this
     */
    private function filteredInternships(InternshipFilter $internshipFilter)
    {
        $states = $internshipFilter->getStateFilter();
        $isOneFilterActive = false; //contains if at least one filter is active
        // build list of ids to select by internship state
        foreach ($states as $state) {
            if ($state->checked) {
                $idlist[] = $state->id;
                $isOneFilterActive = true;
            }
        }

        if (isset($idlist)){

            $iships = Internship::whereIn('contractstate_id', $idlist)->get();
        }
        else{
            $iships = Internship::all();
        }
        switch ($ifilter->getMine() * 2 + $ifilter->getInProgress())
        {
            case 1:
                $keepOnly = self::getCurrentInternships();
                break;
            case 2:
                $keepOnly = self::getMyInternships();
                break;
            case 3:
                $keepOnly = self::getMyCurrentInternships();
        }

        if (isset($keepOnly)) {
            $finallist = array();
            foreach ($iships as $iship)
                if (array_search($iship->id, $keepOnly))
                    $finallist[] = $iship;
        } else
            $finallist = $iships;

        return view('internships/internships')->with('iships', $finallist)->with('filter', $internshipFilter)->with('isOneFilterActive', $isOneFilterActive);
    }

    /**
     * Returns a list (array of ids, sorted ascending) of internships where the current user was MC
     */
    public static function getMyInternships()
    {
        $iships = DB::table('internships')
            ->join('persons as student', 'intern_id', '=', 'student.id')
            ->join('flocks', 'student.flock_id', '=', 'flocks.id')
            ->join('persons as mc', 'classMaster_id', '=', 'mc.id')
            ->select('internships.id')
            ->where('mc.intranetUserId', '=', $me = Environment::currentUser()->getId())
            ->orderBy('internships.id', 'asc')
            ->get();
        $res = array();
        foreach ($iships as $iship) $res[] = $iship->id;
        return $res;
    }

    /**
     * Returns a list (array of ids, sorted ascending) of internships that are in progress
     */
    public static function getCurrentInternships()
    {
        $iships = DB::table('internships')
            ->select('internships.id')
            ->where([
                ['beginDate', '<=', date('Y-m-d')],
                ['endDate', '>=', date('Y-m-d')],
            ])
            ->orderBy('internships.id', 'asc')
            ->get();
        $res = array();
        foreach ($iships as $iship) $res[] = $iship->id;
        return $res;
    }

    /**
     * Returns a list (array of ids, sorted ascending) of internships that are in progress and where the current user is MC
     */
    public static function getMyCurrentInternships()
    {
        $iships = DB::table('internships')
            ->join('persons as student', 'intern_id', '=', 'student.id')
            ->join('flocks', 'student.flock_id', '=', 'flocks.id')
            ->join('persons as mc', 'classMaster_id', '=', 'mc.id')
            ->select('internships.id')
            ->where([
                ['beginDate', '<=', date('Y-m-d')],
                ['endDate', '>=', date('Y-m-d')],
                ['mc.intranetUserId', '=', Environment::currentUser()->getId()]
            ])
            ->orderBy('internships.id', 'asc')
            ->get();
        $res = array();
        foreach ($iships as $iship) $res[] = $iship->id;
        return $res;
    }

    public function view($internshipId)
    {
        date_default_timezone_set('Europe/Zurich');

        $internship = Internship::find($internshipId);

        $visits = DB::table('visits')
            ->select(
                'moment',
                'confirmed',
                'number',
                'grade')
            ->where('internships_id', '=', $internshipId)
            ->get();

        $remarks = DB::table('remarks')
            ->select(
                'remarkDate',
                'author',
                'remarkText')
            ->where('remarkType', '=', 5)
            ->where('remarkOn_id', '=', $internshipId)
            ->orderby('remarkDate', 'desc')
            ->get();

        return view('internships/internshipview')
            ->with('visits', $visits)
            ->with('remarks', $remarks)
            ->with('internship', $internship);
    }

    public function edit($iid)
    {
        date_default_timezone_set('Europe/Zurich');
        if (env('USER_LEVEL') >= 1) {
            $iship = DB::table('internships')
                ->join('companies', 'companies_id', '=', 'companies.id')
                ->join('persons as admresp', 'admin_id', '=', 'admresp.id')
                ->join('persons as intresp', 'responsible_id', '=', 'intresp.id')
                ->join('persons as student', 'intern_id', '=', 'student.id')
                ->join('contractstates', 'contractstate_id', '=', 'contractstates.id')
                ->join('flocks', 'student.flock_id', '=', 'flocks.id')
                ->join('persons as mc', 'flocks.classMaster_id', '=', 'mc.id')
                ->select(
                    'internships.id',
                    'beginDate',
                    'endDate',
                    'companies_id as compid',
                    'companyName',
                    'grossSalary',
                    'mc.initials',
                    'previous_id',
                    'internshipDescription',
                    'admresp.firstname as arespfirstname',
                    'admresp.lastname as aresplastname',
                    'admresp.id as arespid',
                    'intresp.firstname as irespfirstname',
                    'intresp.lastname as iresplastname',
                    'intresp.id as intrespid',
                    'student.firstname as studentfirstname',
                    'student.lastname as studentlastname',
                    'contractstate_id',
                    'contractGenerated',
                    'stateDescription')
                ->where('internships.id', '=', $iid)
                ->first();

            $resp = DB::table('persons')
                ->select(
                    'id',
                    'firstname',
                    'lastname')
                ->where('role', '=', 2)
                ->where('company_id', '=', $iship->compid);

            $lifecycles = DB::table('lifecycles')->select('to_id')->where('from_id', '=', $iship->contractstate_id);

            $lcycles = [$iship->contractstate_id];
            foreach ($lifecycles->get()->toArray() as $value) {
                array_push($lcycles, $value->to_id);
            }

            $states = DB::table('contractstates')
                ->select(
                    'id',
                    'stateDescription as state')
                ->where('details', '!=', "(obsolet)")
                ->whereIn('id', $lcycles);

            $visits = DB::table('visits')
                ->select(
                    'id',
                    'moment',
                    'confirmed',
                    'number',
                    'grade')
                ->where('internships_id', '=', $iid)
                ->get();

            $remarks = DB::table('remarks')
                ->select(
                    'remarkDate',
                    'author',
                    'remarkText')
                ->where('remarkType', '=', 5)
                ->where('remarkOn_id', '=', $iid)
                ->orderby('remarkDate', 'desc')
                ->get();

            return view('internships/internshipedit')
                ->with('iship', $iship)
                ->with('resp', $resp)
                ->with('states', $states)
                ->with('visits', $visits)
                ->with('remarks', $remarks);
        } else {
            abort(404);
        }
    }

    /**
     * update specific internships with GET data
     *
     * @param Request $request GET data received by internshipsEdit
     * @param $id of interships
     * @return redirect to good page
     */
    public function update(Request $request, $id)
    {

        if (env('USER_LEVEL') >= 1) {
            //update insternship by id
            $internships = Internship::find($id);
            $internships->beginDate = $request->beginDate;
            $internships->endDate = $request->endDate;
            $internships->internshipDescription = $request->description;
            $internships->admin_id = $request->aresp;
            $internships->responsible_id = $request->intresp;
            $internships->contractstate_id = $request->stateDescription;
            $internships->grossSalary = $request->grossSalary;
            $internships->save();

            $textRegex = "([A-Za-z0-9]+)";
            //search all keys on request (exemple: "id" is $key and 5664 is $data)
            foreach ($request->request as $key => $data) {
                //check if the name of request begin by "remark_"
                if (preg_match("#^remark_$textRegex$#", $key)) {
                    //customized remarks
                    switch ($key) {
                        case "remark_beginDate":
                            $request->remark = "La date de début de stage a été modifiée. ";
                            break;
                        case "remark_endDate":
                            $request->remark = "La date de fin de stage a été modifiée. ";
                            break;
                        case "remark_aresp":
                            $request->remark = "Le Responsable administratif du stage a été modifié. ";
                            break;
                        case "remark_intresp":
                            $request->remark = "Le responsable du stage a été modifié. ";
                            break;
                        case "remark_stateDescription":
                            $request->remark = "L'état du stage a été modifié.  ";
                            break;
                        case "remark_grossSalary":
                            $request->remark = "Le salaire du stage a été modifié. ";
                            break;
                        default:
                            //show which field has been changed
                            $request->remark = "Les données du champ " . substr($key, strpos($key, "_") + 1) . " ont été modifiées. ";
                            break;
                    }
                    if (isset($data))
                        $request->remark .= "Raison: $data";

                    self::addRemarks($request);
                }
            }
            return redirect()->action(
                'InternshipsController@edit', ['iid' => $request->id]
            );
        } else {
            abort(404);
        }
    }

    public function addVisit($iid)
    {
        if (env('USER_LEVEL') >= 1) {
            if (isset($_GET['visitDate']) && isset($_GET['visitTime']) && isset($_GET['visitState']) && isset($_GET['visitNumber']) && isset($_GET['grade'])) {
                if (($_GET['visitDate'] != NULL) && ($_GET['visitTime'] != NULL) && ($_GET['visitState'] != NULL) && ($_GET['visitNumber'] != NULL)) {
                    DB::table('visits')
                        ->insertGetId(
                            ['moment' => $_GET['visitDate'] . " " . $_GET['visitTime'] . ":00", 'confirmed' => $_GET['visitState'], 'number' => $_GET['visitNumber'], 'internships_id' => $iid, 'grade' => $_GET['grade'] ? $_GET['grade'] : NULL]);
                }
            }

            return redirect()->action(
                'InternshipsController@edit', ['iid' => $iid]
            );
        } else {
            abort(404);
        }
    }

    public function updateVisit($iid)
    {
        if (env('USER_LEVEL') >= 1) {
            for ($i = 0; ; $i++) {
                if (isset($_GET['visitID' . $i])) {
                    if (($_GET['visitDate' . $i] != NULL) && ($_GET['visitTime' . $i] != NULL) && ($_GET['visitState' . $i] != NULL) && ($_GET['visitNumber' . $i] != NULL)) {
                        DB::table('visits')
                            ->where("id", "=", $_GET['visitID' . $i])
                            ->update(
                                ['moment' => $_GET['visitDate' . $i] . " " . $_GET['visitTime' . $i] . ":00",
                                    'confirmed' => $_GET['visitState' . $i],
                                    'number' => $_GET['visitNumber' . $i],
                                    'internships_id' => $iid,
                                    'grade' => $_GET['grade' . $i] ? $_GET['grade' . $i] : NULL]);
                    }
                } else {
                    break;
                }
            }

            if (isset($_GET['visitDate']) && isset($_GET['visitTime']) && isset($_GET['visitState']) && isset($_GET['visitNumber']) && isset($_GET['grade'])) {
                if (($_GET['visitDate'] != NULL) && ($_GET['visitTime'] != NULL) && ($_GET['visitState'] != NULL) && ($_GET['visitNumber'] != NULL)) {
                    DB::table('visits')
                        ->insertGetId(
                            ['moment' => $_GET['visitDate'] . " " . $_GET['visitTime'] . ":00", 'confirmed' => $_GET['visitState'], 'number' => $_GET['visitNumber'], 'internships_id' => $iid, 'grade' => $_GET['grade'] ? $_GET['grade'] : NULL]);
                }
            }

            return redirect()->action(
                'InternshipsController@view', ['iid' => $iid]
            );
        } else {
            abort(404);
        }
    }

    /**
     * add manually a new remark on InternshipsEdit page
     * @param Request $request GET informations
     * @return redirect to InternshipsEdit page
     */
    public function newRemark(Request $request)
    {
        self::addRemarks($request);

        return redirect()->action(
            'InternshipsController@edit', ['iid' => $request->id]
        );
    }

    /**
     * Function called by entreprise.js in ajax
     * Create a new remark with the text passed by the user
     * @param Request $request (id, remark)
     */
    public function addRemarks(Request $request)
    {
        $type = 5; // Type 5 = internships remark
        $on = $request->id;
        $text = $request->remark;
        RemarksController::addRemark($type, $on, $text);
    }

    public function createInternship($iid)
    {
        //Eloquent request 
        $Internshipcompany = Company::find($iid);
        $companyPersons = Persons::all()->where('company_id', $iid);
        $lastInternship = Internship::where('companies_id', $iid)->orderBy('endDate', 'desc')->first();
        //date variable
        $todaydate = Carbon::now();
        //actual year
        $year = now()->year;
        $nextyear = Carbon::create($year, 0, 0)->addYear();
        //Date for the stage of the first part of the year
        $firstdateInternship = Carbon::create($year, 2, 1);
        $firstenddateInternship = Carbon::create($year, 8, 31);
        //Date for the stage of the seconde part of the year
        $secondedateInternship = Carbon::create($year, 9, 1);
        $secondeenddateInternship = Carbon::create($year, 1, 31);

        if ($todaydate->gt($secondedateInternship)) {
            if ($todaydate->isSameYear($nextyear)) {
                $begindate = $firstdateInternship->addYear();
                $endate = $firstenddateInternship->addYear();
            } else {
                $begindate = $firstdateInternship;
                $endate = $firstenddateInternship;
            }
        } else {
            $begindate = $secondedateInternship;
            $endate = $secondeenddateInternship->addYear();
        }

        return view('internships/internshipcreate')->with(
            [
                'dateend' => $endate->toDateString(),
                'datebegin' => $begindate->toDateString(),
                'company' => $Internshipcompany,
                'persons' => $companyPersons,
                'interships' => $lastInternship
            ]
        );
    }

    public function addInternship(Request $request, $iid)
    {

        $request->validate([
            'beginDate' => 'required',
            'endDate' => 'required',
            'responsible' => 'required|integer',
            'admin' => 'required|integer',
        ],
            [
                'beginDate.required' => 'La date de début est requis',
                'endDate.required' => 'La date de fin est requis',
                'responsible.required' => 'Le responsable est requis',
                'responsible.integer' => 'La responsable doit être un chiffre est non une autre valeur',
                'admin.required' => 'Le admin est requis',
                'admin.integer' => 'Le responsable admin doit être un chiffre est non une autre valeur',
            ]);

        $newInternship = new Internship();
        $newInternship->companies_id = $iid;
        $newInternship->beginDate = $request->input('beginDate');
        $newInternship->endDate = $request->input('endDate');
        $newInternship->responsible_id = $request->input('responsible');
        $newInternship->admin_id = $request->input('admin');
        $newInternship->save();
        return redirect('entreprise/' . $iid . '')->with('message', 'Creation Réussie');
    }
}
