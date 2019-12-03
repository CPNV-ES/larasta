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
    /**
     * Display the wish page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View : wish page
     */
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

        // Create param if it does not exist
        if (is_null($selectedFlockYear)) {
            $selectedFlockYear = new Params();
            $selectedFlockYear->paramName = 'dateEndWishes';
            $selectedFlockYear->paramValueInt = -1;
            $selectedFlockYear->save();
        }

        $flocks = null;
        if ($selectedFlockYear != null) {
            $selectedFlockYear = $selectedFlockYear->paramValueInt;
            $flocks = $this->getFlocksWithYear($selectedFlockYear);
        }

        // Get info for teacher : available start years, and date of end for wishes
        $flockYears = null;
        $dateEndWishes = null;
        // Test if current user is a teacher
        if ($currentUser->getLevel() >= 1) {
            // get date end wishes
            $param = Params::getParamByName('dateEndWishes');
            if ($param != null) {
                // Convert the date/time to date only
                $dateEndWishes = date('Y-m-d', strtotime($param->paramValueDate));
            }

            // get flock years
            $flockYears = $this->getFlockYears();
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


    /**
     * Save the display modifications of hte wishMatrix page
     *
     * @param Request $request : POST request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector : redirect to the wish page
     */
    public function save(Request $request)
    {
        // Do only if user is not student
        if (Environment::currentUser()->getLevel() > 0) {
            // Save the date
            if ($request->input('dateEndWishes') != null) {
                // get the date saved in the database
                $param = Params::getParamByName('dateEndWishes');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                }

                // Update the date
                $param->paramValueDate = $request->input('dateEndWishes');
                $param->save();
            }

            // Save the year to display
            if ($request->input('flockYear') != null) {
                // get the year saved in the database
                $param = Params::getParamByName('wishesSelectedYear');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'wishesSelectedYear';
                }

                // update the year
                $param->paramValueInt = $request->input('flockYear');
                $param->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    /**
     * Get all the internships with state 'Reconduit' or 'Confirmé' in the current year,
     * ordered by the name of the company
     *
     * @return mixed : list of internships
     */
    private function getInternships()
    {
        $internships = Internship::whereYear('beginDate', '=', date('Y'))
            ->whereHas('contractstate', function ($query) {
                $query->where('stateDescription', 'Confirmé')
                    ->orWhere('stateDescription', 'Reconduit');
            })
            ->get()
            ->sortBy(function ($internship) {
                return $internship->company->companyName;
            });
        return $internships;
    }

    /**
     * Get all distinct start years of flocks, starting by the latest
     *
     * @return array : starting years of flocks
     */
    private function getFlockYears()
    {
        $flockYears = Flock::distinct()
            ->orderBy('startYear', 'desc')
            ->pluck('startYear');
        return $flockYears;
    }

    /**
     * Get all flocks that started on a specific year, ordered alphabetically
     *
     * @param $year : starting year of the flocks
     * @return mixed : list of flocks
     */
    private function getFlocksWithYear($year)
    {
        $flocks = Flock::where('startYear', '=', $year)
            ->orderBy('flockName')
            ->get();
        return $flocks;
    }
}
