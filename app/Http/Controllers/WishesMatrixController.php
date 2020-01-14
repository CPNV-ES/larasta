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
use App\Person;
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

        // List of all possible parent internships, having an internship starting this year
        // For testing : date('Y') - 1
        $parentInternships = Internship::whereYear('beginDate', '=', date('Y') - 1)
            ->whereNull('parent_id')
            ->get()
            ->sortBy(function ($internship) {
                return $internship->company->companyName;
            });

        // list of all non attributed internships, starting this year, having the contract state Confirmé or Reconduit
        // For testing : date('Y') - 1
        $internshipsToDisplay = Internship::whereYear('beginDate', '=', date('Y') - 1)
            ->whereHas('contractstate', function ($query) {
                $query->where('stateDescription', 'Confirmé')
                    ->orWhere('stateDescription', 'Reconduit');
            })
            ->whereNull('intern_id')
            ->get();

        // Count, for each parent internship, the number of non attributed internships of its group
        $placesQuantities = array();

        // Get an id of a non attributed internship of the group (can be the d of the parent),
        // used to give the link to the non attributed internship
        $childIds = array();

        // Initialize the count to 0
        foreach ($parentInternships as $parentInternship) {
            $placesQuantities[$parentInternship->id] = 0;
        }

        // Compute the count, and get the child id to display
        foreach ($internshipsToDisplay as $internshipToDisplay) {
            // if the internship is a parent
            if (is_null($internshipToDisplay->parent_id)) {
                // increment its own count
                $placesQuantities[$internshipToDisplay->id] += 1;

                // update the chils id
                $childIds[$internshipToDisplay->id] = $internshipToDisplay->id;

                // if the internship is a child
            } else {
                // increment its parent count
                $placesQuantities[$internshipToDisplay->parent_id] += 1;

                // update the child id
                $childIds[$internshipToDisplay->parent_id] = $internshipToDisplay->id;
            }
        }

        // Get the selected year, and all classes from that year
        $selectedFlockYear = Params::getParamByName('wishesSelectedYear');

        // Create param if it does not exist
        if (is_null($selectedFlockYear)) {
            $param = new Params();
            $param->paramName = 'wishesSelectedYear';
            $param->paramValueInt = -1;
            $param->save();
            $selectedFlockYear = $param;
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
                'parentInternships' => $parentInternships,
                'placesQuantities' => $placesQuantities,
                'childIds' => $childIds,
                'currentUser' => $currentUser,
                'dateEndWishes' => $dateEndWishes,
                'selectedYear' => $selectedFlockYear,
                'flocks' => $flocks,
                'flockYears' => $flockYears
            ]);
    }


    /**
     * Save the display modifications of the wishMatrix page
     *
     * @param Request $request : POST request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector : redirect to the wish page
     */
    public function save(Request $request)
    {
        // validate the data
        $data = $request->validate([
            'dateEndWishes' => 'date|nullable',
            'flockYear' => 'digits:2',
        ]);


        // Do only if user is not student
        if (Environment::currentUser()->getLevel() > 0) {
            // Save the date
            if (isset($data['dateEndWishes'])) {
                // get the date saved in the database
                $param = Params::getParamByName('dateEndWishes');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'dateEndWishes';
                }

                // Update the date
                $param->paramValueDate = $data['dateEndWishes'];
                $param->save();
            }

            // Save the year to display
            if (isset($data['flockYear'])) {
                // get the year saved in the database
                $param = Params::getParamByName('wishesSelectedYear');

                // Create param if it does not exist
                if (is_null($param)) {
                    $param = new Params();
                    $param->paramName = 'wishesSelectedYear';
                }

                // update the year
                $param->paramValueInt = $data['flockYear'];
                $param->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    /**
     * Save the display wishes of a student
     *
     * @param Request $request : POST request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveWishes(Request $request)
    {

        $currentUser = Environment::currentUser();

        // Only students should be able to save their wishes
        if ($currentUser->getLevel() != 0) {
            return redirect('/wishesMatrix');
        }

        $studentId = $currentUser->getId();
        $student = Person::find($studentId);

        // get old wishes of the student
        $oldWishes = $student->wishes->all();

        exit();
        // TODO next point

        // validate the data
        $data = $request->validate([
            'choices' => 'required|json',
        ]);

        // TODO get new wishes from request
        $wishes = $data['wishes'];


        // TODO compare wishes

        // TODO add new wishes

        // TODO update wishes ranks if necessary

        // TODO delete old wishes

        // TODO create log for student

        // TODO create log for wishes

        // return to the wishMatrix view
        // return redirect('/wishesMatrix');
        return redirect('/index');
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
