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

use App\Remark;
use App\Wish;
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

        // validate the data
        $data = $request->validate([
            'choices' => 'required|json',
        ]);

        // extract data
        $wishesCollection = json_decode($data['choices'])->wishes;

        // convert the wishes to a map : internship_id => rank
        $wishes = [];
        foreach ($wishesCollection as $wish) {
            $wishes[$wish->internship_id] = $wish->rank;
        }

        $logText = "Modification des souhaits :";
        foreach ($wishes as $internship_id => $rank) {
            $internship = Internship::find($internship_id);
            $logText = $logText . " {$internship->company->companyName}({$rank}),";
        }
        $logText = substr($logText, 0, -1);

        $remark = new Remark();
        $remark->remarktype = 2;
        $remark->remarkOn_id = $student->id;
        $remark->author = $student->initials;
        $remark->remarkText = $logText;
        $remark->save();

        // get old wishes of the student
        $oldWishes = $student->wishes->all();

        foreach ($oldWishes as $oldWish) {
            $internshipId = $oldWish->internship->id;

            // if the new wish is already in the old wishes
            if (array_key_exists($internshipId, $wishes)) {
                $wishRank = $wishes[$internshipId];
                // if the wish rank is different, update the rank
                $oldrank = $oldWish->rank;
                if ($wishRank != $oldrank) {
                    $oldWish->rank = $wishRank;
                    $oldWish->save();

                    $remark = new Remark();
                    $remark->remarktype = 5;
                    $remark->remarkOn_id = $internshipId;
                    $remark->author = $student->initials;
                    $remark->remarkText =
                        "Modification du rang du souhait de {$student->firstname} {$student->lastname}, de {$oldrank} à {$wishRank}";
                    $remark->save();
                }

                // remove the wish from the wishes list
                unset($wishes[$internshipId]);

            } else {
                $oldWish->delete();

                $remark = new Remark();
                $remark->remarktype = 5;
                $remark->remarkOn_id = $internshipId;
                $remark->author = $student->initials;
                $remark->remarkText =
                    "Suppression du souhait de {$student->firstname} {$student->lastname}";
                $remark->save();
            }
        }

        // new wishes
        foreach ($wishes as $internship_id => $rank) {
            $wish = new Wish();
            $wish->internships_id = $internship_id;
            $wish->persons_id = $studentId;
            $wish->rank = $rank;
            $wish->save();

            $remark = new Remark();
            $remark->remarktype = 5;
            $remark->remarkOn_id = $internshipId;
            $remark->author = $student->initials;
            $remark->remarkText =
                "Ajout d'un souhait de {$student->firstname} {$student->lastname}";
            $remark->save();
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
    }

    public function saveWishesPostulations(Request $request)
    {
        // TODO log for internship, student and teacher
        // TODO in view : display modifications
        // TODO in view : prevent click on non wish case

        // validate the data
        $data = $request->validate([
            'postulations' => 'required|json',
        ]);

        // extract data
        $postulationsCollection = json_decode($data['postulations'])->postulations;

        // convert the postulations to a map : wishId => isValidated
        $postulations = [];
        foreach ($postulationsCollection as $postulation) {
            $postulations[$postulation->wishId] = $postulation->isValidated;
        }

        foreach ($postulations as $wishId => $isValidated) {
            $wish = Wish::find($wishId);

            // wish->application <= 0 : no postulation
            // wish->application >= 0 : postulation
            $wasValidated = false;
            if ($wish->application > 0) {
                $wasValidated = true;
            }

            if($wasValidated !== $isValidated) {
                $wish->application = (int)$isValidated;
                $wish->save();
            }
        }

        // return to the wishMatrix view
        return redirect('/wishesMatrix');
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
