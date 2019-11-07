<?php
//------------------------------------------------------------
// Benjamin Delacombaz
// version 0.7
// WishesMatrixController
// Created 18.12.2017
// Last edit 23.01.2017 by Benjamin Delacombaz
//------------------------------------------------------------

namespace App\Http\Controllers;

use App\Flock;
use App\Wish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Company;
use App\Person;
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

        // TODO : update function to work with other years ???
        // Get companies to display
        $companies = $this->getCompaniesWithInternships();

        // Get the selected year, and all classes from that year
        $selectedFlockYear = Params::getParamByName('wishesSelectedYear');
        $flocks = null;
        if ($selectedFlockYear != null) {
            $selectedFlockYear = $selectedFlockYear->paramValueInt;
            $flocks = $this->getFlocksWithYear($selectedFlockYear);
        }

        // Get the start available years to display
        $flockYears = $this->getFlockYears();

        $dateEndWishes = null;

        // Get info for teacher
        // Test if current user is a teacher
        if ($currentUser->getLevel() >= 1) {
            // get date end wishes
            $param = Params::getParamByName('dateEndWishes');
            if ($param != null) {
                // Convert the date/time to date only
                $dateEndWishes = date('Y-m-d', strtotime($param->paramValueDate));
            }

        }

        return view('wishesMatrix/wishesMatrix')
            ->with([
                'companies' => $companies,
                'currentUser' => $currentUser,
                'dateEndWishes' => $dateEndWishes,
                'selectedYear' => $selectedFlockYear,
                'flocks' => $flocks,
                'flockYears' => $flockYears
            ]);
    }


    public function save(Request $request)
    {
        // Do only if not student
        // !!!!!!!!!!!!!! Value Test !!!!!!!!!!!!!!!!!!!
        if (Environment::currentUser()->getLevel() > 0) // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        {
            // Save the date
            if ($request->input('date') != null) {
                $param = Params::getParamByName('dateEndWishes');
                // Test if param exists
                if ($param != null) {
                    // Update the date
                    $param->paramValueDate = $request->input('date');
                } else {
                    // Insert param
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                    $param->paramValueDate = $request->input('date');
                }
                $param->save();
            }

            // Save the display year
            if ($request->input('displayYear') != null) {
                // Create param if it does not exist
                $param = Params::getParamByName('wishesSelectedYear');
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'wishesSelectedYear';
                }

                // update value
                $param->paramValueInt = $request->input('displayYear');
                $param->save();
            }
        }
    }

    // Get all the companies with state 'Reconduit' or 'Confirmé' in the current year
    private function getCompaniesWithInternships()
    {
        $companies = Company::whereHas('internships', function ($query) {
            $query->whereYear('beginDate', '=', date('Y'));
        })->whereHas('contractstates', function ($query) {
            $query->where('stateDescription', 'Confirmé')
                ->orWhere('stateDescription', 'Reconduit');
        })->get();
        return $companies;
    }

    // Get all the persons from a flock identified by its id,
    // if their initials are not null
    private function getPersonsFromFlock($flock_id)
    {
        // Get persons whose initials are not null
        $persons = Person::where('flock_id', $flock_id)
            ->whereNotNull('initials')
            ->get();
        return $persons;
    }

    // Get wishes of a person identified by their id,
    // if the rank of the wish is > 0
    private function getWishesByPerson($idPerson)
    {
        $wishes = Wish::where('persons_id', $idPerson)
            ->where('wishes.rank', '>', 0)
            ->get();
        return $wishes;
    }

    // Get all distinct start years of flocks
    private function getFlockYears()
    {
        $flocks = Flock::distinct()
            ->get(['startYear']);

        // put all years in an array
        $flockYears = array();
        foreach ($flocks as $flock) {
            $flockYears[] = $flock->startYear;
        }

        return $flockYears;
    }

    // Get all flocks that started on a specific year
    private function getFlocksWithYear($year)
    {
        $flocks = Flock::where('startYear', '=', $year)
            ->get();
        return $flocks;
    }
}
