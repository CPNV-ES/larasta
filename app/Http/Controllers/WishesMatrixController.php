<?php
//------------------------------------------------------------
// Benjamin Delacombaz
// version 0.7
// WishesMatrixController
// Created 18.12.2017
// Last edit 23.01.2017 by Benjamin Delacombaz
//------------------------------------------------------------

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use SebastianBergmann\Environment\Console;
use function GuzzleHttp\json_encode;
use CPNVEnvironment\Environment;
use App\Params;

class WishesMatrixController extends Controller
{
    public function index()
    {
        // !!!!!!!!!!!! Test Value !!!!!!!!!!!!!!!!!!!!!!!!!!
        $currentUser = Environment::currentUser();
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // Get the flock id
        $currentUserFlockId = $this->getCurrentUser($currentUser->getId());
        // Get companies to display
        $companies = $this->getCompaniesWithInternships();
        // Get list person in same flock id
        $persons = $this->getPersons($currentUserFlockId);
        $wishes = null;
        $dateEndWishes =  null;
        
        // Get all wishes per person
        foreach ($persons as $person)
        {
            $wishes[$person->id] = $this->getWishesByPerson($person->id);
        }

        // Get info for teacher
        // Test if current user is a teacher
        if($currentUser->getLevel() >= 1)
        {
            $param = Params::getParamByName('dateEndWishes');
            if($param != null)
            {
                // Convert the date/time to date only
                $dateEndWishes = date('Y-m-d', strtotime($param->paramValueDate));   
            }
        }
        return view('wishesMatrix/wishesMatrix')->with(['companies' => $companies, 'persons' => $persons, 'wishes' => $wishes, 'currentUser' => $currentUser, 'dateEndWishes' => $dateEndWishes, 'currentUserFlockId' => $currentUserFlockId]);
    }

    public function save(Request $request)
    {
        // Do only if not student
        // !!!!!!!!!!!!!! Value Test !!!!!!!!!!!!!!!!!!!
        if(Environment::currentUser()->getLevel() > 0)
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        {
            // Save the date
            if($request->input('date') != null)
            {
                $param = Params::getParamByName('dateEndWishes');
                // Test if param exists
                if ($param != null)
                {
                    // Update the date
                    $param->paramValueDate = $request->input('date');
                }
                else
                {
                    // Insert param
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                    $param->paramValueDate = $request->input('date');
                }
                $param->save(); 
            }
        }
    }

    private function getCompaniesWithInternships()
    {
        // Get all the companies with state 'Reconduit' or 'Confirmé'
        $companies = Company::whereHas('internships', function ($query) {
            $query->whereYear('beginDate', '=', date('Y'));
        }) ->wherehas('contractstates', function($query) {
            $query->where('stateDescription','Confirmé')
                ->orWhere('stateDescription','Reconduit');
        })->get();



        /*
        $companies = DB::table('companies')
            ->join('internships', 'internships.companies_id', '=', 'companies.id')
            ->join('contractstates', 'internships.contractstate_id', '=', 'contractstates.id')
            ->where('companies.mptOK', 1)
            ->where('contractstates.stateDescription','Confirmé')
            ->orWhere('contractstates.stateDescription','Reconduit')
            ->whereYear('internships.beginDate', '=', date('Y'))
            ->select('companies.id','companies.companyName')
            ->get();
        */
        return $companies;
    }

    // Get persons by class id
    private function getPersons($flock_id)
    {
        $persons = DB::table('persons')
            ->where('persons.flock_id', $flock_id)
            ->whereNotNull('persons.initials')
            ->select('persons.id','persons.initials')
            ->get();
        return $persons;
    }

    // Get wishes by id persons
    private function getWishesByPerson($idPerson)
    {
        $wishes = DB::table('wishes')
            ->join('internships', 'wishes.internships_id', '=', 'internships.id')
            ->join('companies', 'internships.companies_id', '=', 'companies.id')
            ->where('wishes.persons_id', $idPerson)
            ->where('wishes.rank', '>', 0)
            ->select('wishes.rank', 'wishes.internships_id', 'companies.companyName', 'companies.id')
            ->get();
        return $wishes;
    }

    // Get current user by id person
    private function getCurrentUser($idPerson)
    {
        $persons = DB::table('persons')
            ->where('persons.id', $idPerson)
            ->whereNotNull('persons.initials')
            ->select('persons.id','persons.initials', 'persons.flock_id', 'persons.role')
            ->first();
        return $persons;
    }
}
