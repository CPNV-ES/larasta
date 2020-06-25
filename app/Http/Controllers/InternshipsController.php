<?php


namespace App\Http\Controllers;

use App\Contractstate;
use App\Lifecycles;
use App\Company;
use App\Internship;
use App\Person;
use App\Visitsstate;
use App\Flock;
use Carbon\Carbon;
use CPNVEnvironment\Environment;
use CPNVEnvironment\InternshipFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFileRequest;
use App\Remark;

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
     * @description sert à arriver sur la page stageform
     */
    public function showForm ($id)
    {
        $newinternships = Companies::find($id);
        $companypersons = Persons::all()->where('company_id',$id);
        return view('entreprises/stageform')->with(compact('newinternships','companypersons'));

    }

    /**
     * @description sert à ajouté les différents éléments dans la base de donnée et d revenir sur la page entreprise
     */
    public function enterFormInDb(Request $request)
    {
        $newinternships = Companies::find($id);
        $addstage = new Internship();
        $addstage->beginDate = $request->input('startDate');
        $addstage->endDate = $request->input('endDate');
        $addstage->responsible_id = $request->input('responsible_id');
        $addstage->admin_id = $request->input('admin_id');
        return view('entreprises/entreprise')->with(compact('newinternships', 'addstage'));

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
        switch ($internshipFilter->getMine() * 2 + $internshipFilter->getInProgress())
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
            ->where('mc.intranetUserId', '=', $me = Auth::user()->id)
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
                ['mc.intranetUserId', '=', Auth::user()->id]
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
        $internship->internshipDescription = htmlentities($internship->internshipDescription);
        $medias = $internship->getMedia('documents');
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


        return view('internships/internshipview', compact('visits','remarks','internship','medias'));
    }

    public function edit($internshipId)
    {
        date_default_timezone_set('Europe/Zurich');
        if (Auth::user()->role <= 1)        
            abort(404);

        $internship = Internship::find($internshipId);
        $medias = $internship->getMedia('documents');
        $contractStates =  $internship->contractstate->contractStates;

        // $responsible
        $responsibles = $internship->company->people->where('role', 2);

        $remarks = $internship->remarks->sortByDesc('remarkDate');

        $years = Flock::getYears();
        
        $visitsStates = Visitsstate::all(); 
        return view('internships/internshipedit')->with(compact('responsibles','remarks','internship','contractStates','medias', 'visitsStates', 'years'));
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
        if (Auth::user()->role < 1){
            abort(404);
            return;
        }

        //update insternship by id
        $internship = Internship::find($id);
        $internshipOld = $internship->replicate();

        $internship->externalLogbook = ($request->externalLogbook == "on");
        $internship->fill($request->all());
        
        if($request->internId){
            $intern = Person::find($request->internId); 
            //$internship->student = $intern;*/ //marche pas jsp pk
            //$internship->intern = $intern; //marche pas jsp pk
            $internship->intern_id = $intern->id;
        }else{
            //$internship->student = null;
            $internship->intern_id = null;
        }
        $internship->save();

        Remark::addMultipleWithDetails($request, $internshipOld, $internship);
        
        return redirect()->action(
            'InternshipsController@edit', ['iid' => $request->id]
        );
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
        $companyPersons = Person::all()->where('company_id', $iid);
        $lastInternship = Internship::where('companies_id', $iid)->orderBy('endDate', 'desc')->first();
        if(is_null($lastInternship)){
            $lastInternship = new Internship;
        }
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
    public function storeLogbookFile(StoreFileRequest $request, $internshipId){
        $internship = Internship::findOrFail($internshipId);
        $oldMedia = $internship->getMedia('externalLogbook')->first();
        $internship->addMediaFromRequest('file')->toMediaCollection('externalLogbook');
        if($oldMedia){
            $oldMedia->delete();
        }
        return back();
    }
    public function storeFile(StoreFileRequest $request, $id, $collection = 'documents')
    {
        $internship = Internship::findOrFail($id);
        $internship->addMediaFromRequest('file')->toMediaCollection($collection);
    }
    public function deleteFile($id,$idMedia, $collection = 'documents')
    {
        $internship = Internship::findOrFail($id);
        $internship->getMedia($collection)->find($idMedia)->delete();
    }
}
