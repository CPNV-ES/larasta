<?php


namespace App\Http\Controllers;

use App\Contractstate;
use App\Internships;
use App\Lifecycles;
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
        $ifilter = new InternshipFilter();
        // Retrieve filter conditions from cookie (or initialize them from database)
        $cookie = $request->cookie('filter');
        if ($cookie == null)
            return $this->changeFilter($request);
        else
            $ifilter = unserialize($cookie);

        return $this->filteredInternships($ifilter);
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
        foreach ($filter as $state)
        {
            $state->checked = false;
            foreach ($request->all() as $fname => $fval)
                if (substr($fname, 0, 5) == 'state')
                    if ($state->id == intval(substr($fname, 5)))
                        $state->checked = ($fval == 'on');
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
     * @param InternshipFilter $ifilter
     * @return $this
     */
    private function filteredInternships(InternshipFilter $ifilter)
    {
        $states = $ifilter->getStateFilter();
        // build list of ids to select by internship state
        foreach ($states as $state)
            if ($state->checked)
                $idlist[] = $state->id;

        if (isset($idlist))
            $iships = DB::table('internships')
                ->join('companies', 'companies_id', '=', 'companies.id')
                ->join('persons as admresp', 'admin_id', '=', 'admresp.id')
                ->join('persons as intresp', 'responsible_id', '=', 'intresp.id')
                ->join('persons as student', 'intern_id', '=', 'student.id')
                ->join('contractstates', 'contractstate_id', '=', 'contractstates.id')
                ->join('flocks', 'student.flock_id', '=', 'flocks.id')
                ->join('persons as mc', 'classMaster_id', '=', 'mc.id')
                ->select(
                    'internships.id',
                    'beginDate',
                    'endDate',
                    'companyName',
                    'admresp.firstname as arespfirstname',
                    'admresp.lastname as aresplastname',
                    'admresp.id as respid',
                    'intresp.firstname as irespfirstname',
                    'intresp.lastname as iresplastname',
                    'student.firstname as studentfirstname',
                    'student.lastname as studentlastname',
                    'mc.intranetUserId as mcid',
                    'mc.initials as mcini',
                    'contractstate_id',
                    'stateDescription')
                ->whereIn('contractstate_id', $idlist)
                ->get();
        else
            $iships = array();

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

        if (isset($keepOnly))
        {
            $finallist = array();
            foreach ($iships as $iship)
                if (array_search($iship->id, $keepOnly))
                    $finallist[] = $iship;
        } else
            $finallist = $iships;

        return view('internships/internships')->with('iships', $finallist)->with('filter', $ifilter);
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

    public function view($iid)
    {
        date_default_timezone_set('Europe/Zurich');
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
                'contractGenerated',
                'stateDescription')
            ->where('internships.id', '=', $iid)
            ->first();

        $visits = DB::table('visits')
            ->select(
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

        return view('internships/internshipview')
            ->with('iship', $iship)
            ->with('visits', $visits)
            ->with('remarks', $remarks);
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
        }
        else
        {
            abort(404);
        }
    }

    public function update($iid)
    {
        if (env('USER_LEVEL') >= 1)
        {
            DB::table('internships')
                ->where('id', '=', $iid)
                ->update(
                    ['beginDate' => $_GET['beginDate'],
                        'endDate' => $_GET['endDate'],
                        'internshipDescription' => $_GET['description'],
                        'admin_id' => $_GET['aresp'],
                        'responsible_id' => $_GET['intresp'],
                        'contractstate_id' => $_GET['stateDescription'],
                        'grossSalary' => $_GET['grossSalary']]
                );

            return redirect()->action(
                'InternshipsController@view', ['iid' => $iid]
            );
        }
        else
        {
            abort(404);
        }
    }

    public function addVisit($iid)
    {
        if (env('USER_LEVEL') >= 1)
        {
            if (isset($_GET['visitDate']) && isset($_GET['visitTime']) && isset($_GET['visitState']) && isset($_GET['visitNumber']) && isset($_GET['grade']))
            {
                if (($_GET['visitDate'] != NULL) && ($_GET['visitTime'] != NULL) && ($_GET['visitState'] != NULL) && ($_GET['visitNumber'] != NULL))
                {
                    DB::table('visits')
                        ->insertGetId(
                            ['moment' => $_GET['visitDate']." ".$_GET['visitTime'].":00", 'confirmed' => $_GET['visitState'], 'number' => $_GET['visitNumber'], 'internships_id' => $iid, 'grade' => $_GET['grade'] ? $_GET['grade'] : NULL]);
                }
            }

            return redirect()->action(
                'InternshipsController@edit', ['iid' => $iid]
            );
        }
        else
        {
            abort(404);
        }
    }

    public function updateVisit($iid)
    {
        if (env('USER_LEVEL') >= 1)
        {
            for ($i = 0; ; $i++)
            {
                if (isset($_GET['visitID'.$i]))
                {
                    if (($_GET['visitDate'.$i] != NULL) && ($_GET['visitTime'.$i] != NULL) && ($_GET['visitState'.$i] != NULL) && ($_GET['visitNumber'.$i] != NULL))
                    {
                        DB::table('visits')
                            ->where("id", "=", $_GET['visitID'.$i])
                            ->update(
                                ['moment' => $_GET['visitDate'.$i]." ".$_GET['visitTime'.$i].":00",
                                    'confirmed' => $_GET['visitState'.$i],
                                    'number' => $_GET['visitNumber'.$i],
                                    'internships_id' => $iid,
                                    'grade' => $_GET['grade'.$i] ? $_GET['grade'.$i] : NULL]);
                    }
                }
                else
                {
                    break;
                }
            }

            if (isset($_GET['visitDate']) && isset($_GET['visitTime']) && isset($_GET['visitState']) && isset($_GET['visitNumber']) && isset($_GET['grade']))
            {
                if (($_GET['visitDate'] != NULL) && ($_GET['visitTime'] != NULL) && ($_GET['visitState'] != NULL) && ($_GET['visitNumber'] != NULL))
                {
                    DB::table('visits')
                        ->insertGetId(
                            ['moment' => $_GET['visitDate']." ".$_GET['visitTime'].":00", 'confirmed' => $_GET['visitState'], 'number' => $_GET['visitNumber'], 'internships_id' => $iid, 'grade' => $_GET['grade'] ? $_GET['grade'] : NULL]);
                }
            }

            return redirect()->action(
                'InternshipsController@view', ['iid' => $iid]
            );
        }
        else
        {
            abort(404);
        }
    }

    public function addRemark($iid)
    {
        if (env('USER_LEVEL') >= 1)
        {
            if (isset($_GET['remarkDate']) && isset($_GET['remarkAuthor']) && isset($_GET['remark']))
            {
                if (($_GET['remarkDate'] != NULL) && ($_GET['remarkAuthor'] != NULL) && ($_GET['remark'] != NULL))
                {
                    DB::table('remarks')
                        ->insertGetId(
                            ['remarkType' => 5, 'remarkOn_id' => $iid, 'remarkDate' => $_GET['remarkDate'], 'author' => $_GET['remarkAuthor'], 'remarkText' => $_GET['remark']]);
                }
            }

            return redirect()->action(
                'InternshipsController@edit', ['iid' => $iid]
            );
        }
        else
        {
            abort(404);
        }
    }
}
