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
use App\Internship;
use App\Params;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_encode;

use CPNVEnvironment\Environment;


class WishesMatrixController extends Controller
{
    public function index()
    {
        // !!!!!!!!!!!! Test Value !!!!!!!!!!!!!!!!!!!!!!!!!!
        $currentUser = Environment::currentUser();
        // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

        // Get internships to display
        // ??? Update function to work with other years ???
        $internships = $this->getInternships();

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
                'internships' => $internships,
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
            if ($request->input('dateEndWishes') != null) {
                $param = Params::getParamByName('dateEndWishes');
                // Test if param exists
                if ($param != null) {
                    // Update the date
                    $param->paramValueDate = $request->input('dateEndWishes');
                } else {
                    // Insert param
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                    $param->paramValueDate = $request->input('dateEndWishes');
                }
                $param->save();
            }

            // Save the display year
            if ($request->input('flockYear') != null) {
                // Create param if it does not exist
                $param = Params::getParamByName('wishesSelectedYear');
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'wishesSelectedYear';
                }
                // update value
                $param->paramValueInt = $request->input('flockYear');
                $param->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    /*
     * Get all the companies with state 'Reconduit' or 'Confirmé' in the current year,
     * ordered by the name of the company
     */
    private function getInternships()
    {
        $internships = Internship::whereYear('beginDate', '=', date('Y'))
            ->whereHas('contractstate', function ($query) {
                $query->where('stateDescription', 'Confirmé')
                    ->orWhere('stateDescription', 'Reconduit');
            })
            ->get()
            ->sortBy(function($internship) {
                return $internship->company->companyName;
            });

        return $internships;
    }

    // Get all distinct start years of flocks, starting by the latest
    private function getFlockYears()
    {
        $flocks = Flock::distinct()
            ->orderBy('startYear', 'desc')
            ->get(['startYear']);

        // put all years in an array
        $flockYears = array();
        foreach ($flocks as $flock) {
            $flockYears[] = $flock->startYear;
        }

        return $flockYears;
    }

    // Get all flocks that started on a specific year,
    // ordered alphabetically
    private function getFlocksWithYear($year)
    {
        $flocks = Flock::where('startYear', '=', $year)
            ->orderBy('flockName')
            ->get();
        return $flocks;
    }
}
